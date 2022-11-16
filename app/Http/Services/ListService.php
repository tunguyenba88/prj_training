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
            if ($request->ajax()) {
                $output = '';
                $users = DB::table('users')->where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
                foreach ($users as $user) {
                    $output .= '
                    @foreach ($users as $user)
                    <tr>
                        <td>
                        <div class="d-flex align-items-center">
                            <img
                                src="/images/default.jpeg"
                                alt=""
                                style="width: 45px; height: 45px"
                                class="rounded-circle"
                                />
                            <div class="ms-3">
                            <p class="fw-bold mb-1">' . $user->name . '</p>
                            </div>
                        </div> 
                        </td>
                        <td>
                            <p class="fw-normal mb-1">Email:' . $user->email . '</p>
                            <p class="fw-normal mb-1">Phone:' . $user->phone . '</p>
                        </td>
                        @if ($user->status == 1)
                        <td>
                            <span class="badge badge-success rounded-pill d-inline">Đang làm việc</span>
                        </td>
                        @else
                        <td>
                            <span class="badge badge-warning rounded-pill d-inline">Đã Nghỉ Việc</span>
                        </td>
                        @endif
                        
                        @if (' . $user->auth . '== 1)
                            <td>Admin</td>
                        @endif
                        @if (' . $user->auth . '== 2)
                            <td>Quản lý bộ phận</td>
                        @endif
                        @if (' . $user->auth . '== 3)
                            <td>Nhân viên</td>
                        @endif
                        <td>
                        <button type="button" class="btn btn-primary btn-rounded">
                            Edit
                        </button>

                        <button type="button" class="btn btn-danger btn-rounded">
                            Delete
                        </button>
                        </td>
                    </tr>    
                    @endforeach
                    ';
                }
                return $output;
            }
        } catch (Exception $error) {
            return false;
        }
    }
}
