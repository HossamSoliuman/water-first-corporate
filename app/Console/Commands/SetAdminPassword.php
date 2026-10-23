<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Creates or re-keys exactly one administrator, identified by email.
 *
 * Shows which database it is connected to, asks for confirmation before
 * writing, and prints the generated password once. It never touches any
 * other account and never deletes anything. If the account exists, only its
 * password and remember-token change (plus admin/active flags if missing).
 */
class SetAdminPassword extends Command
{
    protected $signature = 'admin:set-password
        {email : Login email of the administrator to create or update}
        {--name=Website Administrator : Display name, used only when the account is created}
        {--force : Skip the confirmation prompt (explicit consent for non-interactive use)}';

    protected $description = 'Create the given administrator, or set a new generated password for it (shown once)';

    public function handle(): int
    {
        $email = Str::lower(trim((string) $this->argument('email')));

        if (Validator::make(['email' => $email], ['email' => ['required', 'email:rfc,filter', 'max:255']])->fails()) {
            $this->error("\"{$email}\" is not a valid email address.");

            return self::FAILURE;
        }

        $connection = DB::connection();
        $this->table(['Environment', 'Database driver', 'Database', 'Users in table'], [[
            app()->environment(),
            $connection->getDriverName(),
            $connection->getDatabaseName(),
            (string) User::count(),
        ]]);

        $user = User::whereRaw('lower(email) = ?', [$email])->first();

        if ($user) {
            $this->line("Found account #{$user->id} \"{$user->name}\" <{$user->email}> — administrator: ".($user->is_admin ? 'yes' : 'NO').'.');
            $question = 'Set a NEW password for this account'.($user->is_admin ? '' : ' and grant it administrator access').'? The current password will stop working.';
        } else {
            $this->line("No account exists for {$email}.");
            $question = "Create a new administrator account for {$email}?";
        }

        if (! $this->option('force') && ! $this->confirm($question, false)) {
            $this->warn('Cancelled. Nothing was changed.');

            return self::FAILURE;
        }

        $password = Str::password(24, spaces: false);
        $created = ! $user;

        $user = DB::transaction(function () use ($user, $email, $password): User {
            $user ??= new User(['email' => $email, 'name' => trim((string) $this->option('name')) ?: 'Website Administrator']);

            $user->forceFill([
                'password' => Hash::make($password),
                'is_admin' => true,
                'email_verified_at' => $user->email_verified_at ?? now(),
            ])->setRememberToken(Str::random(60));

            $user->save();

            return $user;
        });

        $this->newLine();
        $this->info(($created ? 'Administrator created.' : 'Password updated.').' Copy the password now — it is not stored anywhere and will not be shown again.');
        $this->table(['Field', 'Value'], [
            ['Login URL', route('login')],
            ['Email (login name)', $user->email],
            ['Password', $password],
            ['Administrator', 'yes'],
            ['User ID', (string) $user->id],
        ]);

        return self::SUCCESS;
    }
}
