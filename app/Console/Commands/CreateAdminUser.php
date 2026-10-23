<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Provisions one additional administrator from the server's command line.
 *
 * The site logs in by email + password, so the email is the login name.
 * The password is generated here, stored only as a hash, and printed once
 * to this terminal — it is never logged or written to disk. Running the
 * command again for an email that already exists changes nothing, so
 * existing administrators can never be overwritten or reset by it.
 */
class CreateAdminUser extends Command
{
    protected $signature = 'admin:create
        {--email= : Login email for the new administrator (default: webadmin@ + the APP_URL domain)}
        {--name=Website Administrator : Display name shown in the admin panel}';

    protected $description = 'Create an additional administrator with a generated password (shown once)';

    public function handle(): int
    {
        $email = Str::lower(trim((string) ($this->option('email') ?: $this->defaultEmail())));
        $name = trim((string) $this->option('name'));

        $validator = Validator::make(compact('email', 'name'), [
            'email' => ['required', 'email:rfc,filter', 'max:255'],
            'name' => ['required', 'string', 'max:100'],
        ], ['email.required' => 'Pass --email=you@yourdomain.com (APP_URL has no usable domain to build a default from).']);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $existing = User::whereRaw('lower(email) = ?', [$email])->first();

        if ($existing) {
            $this->warn("An account for {$email} already exists (id {$existing->id}, ".($existing->is_admin ? 'administrator' : 'not an administrator').').');
            $this->warn('Nothing was changed. Use --email to create a different administrator.');

            return self::SUCCESS;
        }

        $password = Str::password(24, spaces: false);

        $user = DB::transaction(function () use ($email, $name, $password): User {
            $user = new User;
            $user->forceFill([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'is_admin' => true,
                'email_verified_at' => now(),
            ])->save();

            return $user;
        });

        $this->newLine();
        $this->info('Administrator created. Copy the password now — it is not stored anywhere and will not be shown again.');
        $this->table(['Field', 'Value'], [
            ['Login URL', route('login')],
            ['Email (login name)', $user->email],
            ['Password', $password],
            ['Name', $user->name],
            ['User ID', (string) $user->id],
        ]);
        $this->line('Change it after first login under Admin → Users → Edit if you prefer your own password.');

        return self::SUCCESS;
    }

    private function defaultEmail(): ?string
    {
        $host = Str::of((string) parse_url((string) config('app.url'), PHP_URL_HOST))->lower()->replaceStart('www.', '')->toString();

        if ($host === '' || $host === 'localhost' || ! str_contains($host, '.')) {
            return null;
        }

        return "webadmin@{$host}";
    }
}
