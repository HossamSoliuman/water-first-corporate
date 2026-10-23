<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmailStatus;
use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use App\Services\Mail\LeadNotifier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmailLogController extends Controller
{
    /**
     * Re-queues a failed lead email. Only failed rows qualify, so a message
     * that was already accepted by the mail server is never sent twice.
     */
    public function retry(EmailLog $emailLog, LeadNotifier $notifier): RedirectResponse
    {
        if (! $emailLog->isRetryable()) {
            return back()->with('error', 'Only failed enquiry emails can be retried.');
        }

        $notifier->retry($emailLog);

        return back()->with('success', 'Email #'.$emailLog->id.' was queued again. Its status is shown in the log.');
    }

    /**
     * Deletes one log row; its enquiry stays in Leads. A queued job for the
     * row finds no log when it runs and sends nothing, so deleting a queued
     * email cancels it. A row a worker is sending right now is refused, since
     * that email may reach the recipient after the log is gone.
     */
    public function destroy(Request $request, EmailLog $emailLog): JsonResponse|RedirectResponse
    {
        if ($emailLog->isBeingSent()) {
            return $this->respond($request, 'Email #'.$emailLog->id.' is being sent right now. Try again in a minute.', 409);
        }

        $wasPending = $emailLog->status === EmailStatus::Queued;

        try {
            $emailLog->delete();
        } catch (Throwable $exception) {
            Log::error("Email log #{$emailLog->id} could not be deleted: ".class_basename($exception));

            return $this->respond($request, 'The email log could not be deleted. Please try again.', 500);
        }

        return $this->respond($request, 'Email log #'.$emailLog->id.' was deleted.'
            .($wasPending ? ' Its pending email was cancelled.' : ''));
    }

    private function respond(Request $request, string $message, int $status = 200): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'failedCount' => EmailLog::where('status', EmailStatus::Failed)->count(),
            ], $status);
        }

        return back()->with($status === 200 ? 'success' : 'error', $message);
    }
}
