<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TokenExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tokenExpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks every minute if tokens are expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get all token
        $tokens = DB::table("password_resets") -> get();

        //check all token dates
        foreach($tokens as $token)
        {
            //remove token if it's older than 5 min
            $date1 = Carbon::createFromFormat("Y-m-d H:i:s", Carbon::now() -> subMinutes(5) -> toDateTimeString());
            $date2 = Carbon::createFromFormat("Y-m-d H:i:s", $token -> created_at);
            $result = $date1 -> gt($date2);

            if($result)
            {
                DB::table("password_resets") -> where("token", $token -> token) -> delete();
            }
        }

        return Command::SUCCESS;
    }
}
