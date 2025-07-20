<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class VerifyUserEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:verify-email {email? : The email address to verify}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify user email addresses or list all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            return $this->verifySpecificUser($email);
        }

        return $this->listAllUsers();
    }

    private function verifySpecificUser($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }

        if ($user->hasVerifiedEmail()) {
            $this->info("User '{$user->name}' ({$user->email}) is already verified.");
            $this->info("Verified at: {$user->email_verified_at}");
            return 0;
        }

        // Manually verify the email
        $user->email_verified_at = Carbon::now();
        $user->save();

        $this->info("✅ Successfully verified email for user: {$user->name}");
        $this->info("Email: {$user->email}");
        $this->info("Role: {$user->role}");
        $this->info("Verified at: {$user->email_verified_at}");

        return 0;
    }

    private function listAllUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        if ($users->isEmpty()) {
            $this->info('No users found in the database.');
            return 0;
        }

        $this->info('=== All User Accounts ===');
        $this->newLine();

        $headers = ['ID', 'Name', 'Email', 'Role', 'Verified', 'Created At'];
        $rows = [];

        foreach ($users as $user) {
            $verified = $user->hasVerifiedEmail() ? '✅ Yes' : '❌ No';
            $verifiedAt = $user->email_verified_at ? $user->email_verified_at->format('Y-m-d H:i:s') : '';
            
            $rows[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $verified . ($verifiedAt ? "\n({$verifiedAt})" : ''),
                $user->created_at->format('Y-m-d H:i:s')
            ];
        }

        $this->table($headers, $rows);

        $this->newLine();
        $this->info("Total users: " . $users->count());
        
        $unverified = $users->where('email_verified_at', null)->count();
        if ($unverified > 0) {
            $this->warn("Unverified users: {$unverified}");
            $this->info("To verify a user: php artisan user:verify-email [email]");
        }

        return 0;
    }
}
