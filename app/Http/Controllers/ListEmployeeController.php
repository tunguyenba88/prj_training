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

        $users = User::paginate(5);
        // dd($users);
        return view('list', compact('users'));

        // return redirect('profile');
    }

    public function search(Request $request)
    {
        if ($request->ajax() || 'NULL') {
            $users = DB::table('users')->where('name', 'LIKE', '%' . $request->form1 . '%')->paginate(5);
            return view('list', compact('users'));
        }
    }
}
