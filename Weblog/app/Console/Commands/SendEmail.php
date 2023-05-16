<?php

namespace App\Console\Commands;

use App\Mail\WeeklyDigest;
use App\Models\Artical;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get check time
        $time = Carbon::now() -> subDays(7) -> toDateTimeString();

        //get articals
        $articals = (Artical::whereBetween("created_at", [$time, Carbon::now() -> toDateTimeString()]) -> get());

        //get all users
        $users = User::all();

        //send email to all users
        foreach($users as $user)
        {
            Mail::to($user -> email) -> send(new WeeklyDigest($articals));
        }

        return Command::SUCCESS;
    }
}
