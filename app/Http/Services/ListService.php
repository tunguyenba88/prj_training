<?php

namespace App\Http\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListService
{
    public function store($request)
    {
        try {
            $list = DB::table('users')->where('name', 'LIKE', '%' . $request . '%')->get();
            return $list;
        } catch (Exception $error) {
            return false;
        }
    }
}
