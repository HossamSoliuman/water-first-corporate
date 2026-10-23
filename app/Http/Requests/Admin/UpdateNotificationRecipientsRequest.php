<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNotificationRecipientsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    /**
     * Blank rows from the editor are dropped and addresses are trimmed and
     * lower-cased before validation.
     */
    protected function prepareForValidation(): void
    {
        $clean = fn (mixed $list): array => collect(is_array($list) ? $list : [])
            ->map(fn ($email) => is_string($email) ? strtolower(trim($email)) : $email)
            ->filter(fn ($email) => filled($email))
            ->values()
            ->all();

        $this->merge([
            'admin_enabled' => $this->boolean('admin_enabled'),
            'recipients' => $clean($this->input('recipients')),
            'cc' => $clean($this->input('cc')),
            'bcc' => $clean($this->input('bcc')),
        ]);
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        $address = ['email:rfc,filter', 'max:255', 'not_regex:/[\r\n,;]/'];

        return [
            'admin_enabled' => ['boolean'],
            'recipients' => ['array', 'max:20', 'required_if:admin_enabled,true'],
            'recipients.*' => ['distinct', ...$address],
            'cc' => ['array', 'max:20'],
            'cc.*' => ['distinct', ...$address],
            'bcc' => ['array', 'max:20'],
            'bcc.*' => ['distinct', ...$address],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'recipients.required_if' => 'Add at least one recipient, or turn off admin notifications.',
            'recipients.*.email' => 'Recipient ":input" is not a valid email address.',
            'cc.*.email' => 'CC address ":input" is not a valid email address.',
            'bcc.*.email' => 'BCC address ":input" is not a valid email address.',
            'recipients.*.distinct' => 'Each recipient may only be listed once.',
            'cc.*.distinct' => 'Each CC address may only be listed once.',
            'bcc.*.distinct' => 'Each BCC address may only be listed once.',
        ];
    }
}
