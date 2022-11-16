<?php

namespace App\Http\Controllers;

use App\Http\Services\ListService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListEmployeeController extends Controller
{
    protected $search;

    public function __construct(ListService $search)
    {
        $this->search = $search;
    }

    public function store(Request $request)
    {
        // dd($request->get('select'));
        $user = Auth::user();
        $role = $user->auth;
        $users = User::paginate($request->get('select', 5));
        if ($user->auth < 3) {
            return view('list', ['role' => $role], compact('users'));
        }
        return redirect('profile');
    }

    public function search(Request $request)
    {
        $data = $this->search->store($request->search);
        return response()->json([
            'error' => false,
            'data'   => $data,
        ]);
    }
}
