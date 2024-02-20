<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Sanctum\PersonalAccessToken;

class RemoveExpireTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:remove-tokens {--day=7 : The number of days to retain expired tokens}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiration = config('sanctum.expiration');
        $day = $this->option('day');
        if($expiration)
        {
            $tokens = PersonalAccessToken::where('created_at', '<', now()->subMinutes($expiration + ($day * 24 * 60)));
            $tokens->delete();
            $this->info('All expired tokens have been removed');
            return 0;
        }

        $this->warn('expiration has not been set');
    }
}
