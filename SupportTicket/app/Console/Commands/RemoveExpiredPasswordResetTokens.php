<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveExpiredPasswordResetTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemoveExpiredPasswordResetTokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks every minute if tokens are expired and if they are remove them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table("password_resets") -> where("created_at", "<", Carbon::now() -> subMinutes(5)) -> delete();

        return Command::SUCCESS;
    }
}
