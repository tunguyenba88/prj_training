<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
</head>

<body>
    @include('layout.navbar')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-mdb-toggle="dropdown" aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <form action="{{ route('filter') }}" method="GET">
                        @csrf
                        <li>
                            <select class="form-select" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="1">Working</option>
                                <option value="2">Resign</option>
                            </select>
                        </li>
                        <li>
                            <select class="form-select" id="room" name="room">
                                <option value="">Select Room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">
                                        {{ $room->room_name }}
                                    </option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <button type="submit" class="btn btn-primary">
                                Confirm
                            </button>
                        </li>
                    </form>
                </ul>
            </div>
            @if (Auth::user()->id == 1)
                <form action="{{ route('import-csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="submit" value="Import CSV" name="file" class="btn btn-warning">
                    <input type="file" name="file" accept=".xlsx">
                </form>
            @endif

            <form action="{{ route('export-csv') }}" method="POST">
                @csrf
                <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
            </form>

            <form action="{{ route('search') }}" method="GET">
                @csrf
                <div class="input-group">
                    <div class="form-outline">
                        <input type="text" id="form1" name="form1" value="{{ old('from1') }}"
                            class="form-control" />
                        <label class="form-label" for="form1">Search</label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
            </form>
        </div>
        </div>
    </nav>
    <table class="table align-middle mb-0 bg-white" id="table">
        <thead class="bg-light">
            <tr>
                <th>Name</th>
                <th>Info</th>
                <th>@sortablelink('birth_day', 'Birth Day')</th>
                <th>@sortablelink('created_at', 'Started')</th>
                <th>Status</th>
                <th>Position</th>
                @if (Auth::user()->id == 1)
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ $user->image }}" alt="" style="width: 45px; height: 45px"
                                class="rounded-circle" />
                            <div class="ms-3">
                                <a class="fw-bold mb-1" href="list/profile/{{ $user->id }}">{{ $user->name }}</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">Email: {{ $user->email }}</p>
                        <p class="fw-normal mb-1">Phone: {{ $user->phone }}</p>
                    </td>
                    <td>{{ Carbon\Carbon::parse($user->birth_day)->format('d-m-Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($user->start_at)->format('d-m-Y') }}</td>
                    @if ($user->status == 1)
                        <td>
                            <span class="badge badge-success rounded-pill d-inline">Đang làm việc</span>
                        </td>
                    @else
                        <td>
                            <span class="badge badge-warning rounded-pill d-inline">Đã Nghỉ Việc</span>
                        </td>
                    @endif

                    @if ($user->auth == 1)
                        <td>Admin</td>
                    @endif
                    @if ($user->auth == 2)
                        <td>Quản lý bộ phận</td>
                    @endif
                    @if ($user->auth == 3)
                        <td>Nhân viên</td>
                    @endif
                    @if (Auth::user()->id == 1)
                        <td>
                            <a type="button" class="btn btn-primary btn-rounded"
                                href="/list/edit/{{ $user->id }}">
                                Edit
                            </a>

                            <button type="button" class="btn btn-danger btn-rounded"
                                onclick="removeUser({{ $user->id }}, 'list/destroy')">
                                Delete
                            </button>

                            <button type="button" class="btn btn-success btn-rounded"
                                onclick="resetPassword('{{ $user->email }}', 'reset/password')">
                                Reset
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $users->appends(Request::except('page'))->render() !!}
    </div>
    @if (Auth::user()->id == 1)
        <form action="list/add" method="GET">
            <button type="submit" class="btn btn-primary">
                Add Employee
            </button>
        </form>
    @endif
    @include('layout.footer')
</body>

</html>
