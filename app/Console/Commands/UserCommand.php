<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Room;
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
        $rooms = Room::whereHas('users', function ($query) {
            $query->whereMonth('birth_day', '=', Carbon::now()->month)->whereDay('birth_day', '=', Carbon::now()->day)->where('auth', 3);
        })->get();
        if (count($rooms)) {
            $listManagers = array();
            $messages = array();
            foreach ($rooms as $room) {
                $manager = User::where('room_id', $room->id)->where('auth', 2)->first();
                if (!is_null($manager)) {
                    array_push($listManagers, $manager);
                    $message = [
                        'title' => 'Happy Birth Day',
                        'task' => 'Happy Birth Day',
                        'data' => '',
                    ];
                    $listUsersHaveBirthday = User::where('room_id', $room->id)
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
