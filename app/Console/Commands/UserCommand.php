<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'HPBD';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $departments = Department::whereHas('users', function ($query) {
            $query->whereMonth('birth_day', '=', Carbon::now()->month)->whereDay('birth_day', '=', Carbon::now()->day)->where('auth', 3);
        })->get();
        if (count($departments)) {
            $listManagers = array();
            $messages = array();
            foreach ($departments as $department) {
                $manager = User::where('department_id', $department->id)->where('auth', 2)->first();
                if (!is_null($manager)) {
                    array_push($listManagers, $manager);
                    $message = [
                        'title' => 'Happy Birth Day',
                        'task' => 'Happy Birth Day',
                        'data' => '',
                    ];
                    $listUsersHaveBirthday = User::where('department_id', $department->id)
                        ->whereMonth('birth_day', '=', Carbon::now()->month)
                        ->whereDay('birth_day', '=', Carbon::now()->day)
                        ->where('auth', 3)->get();
                    foreach ($listUsersHaveBirthday as $user) {
                        $message['data'] .= $user->name . ", ";
                    }
                    array_push($messages, $message);
                }
            }
            SendEmail::dispatch($messages, $listManagers);
        }
    }
}
