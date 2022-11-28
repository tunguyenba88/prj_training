@extends('layout.app')
@section('content')
    @if (Auth::user()->id < 3)
        @include('layout.navbar')
    @endif
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-mdb-toggle="dropdown" aria-expanded="false">
                    {{ __('users.filter') }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <form action="{{ route('filter') }}" method="GET">
                        @csrf
                        <li>
                            <select class="form-select" id="status" name="status">
                                <option value="">{{ __('users.select_status') }}</option>
                                <option value="1">{{ __('users.work') }}</option>
                                <option value="2">{{ __('users.resign') }}</option>
                            </select>
                        </li>
                        <li>
                            <select class="form-select" id="room" name="room">
                                <option value="">{{ __('users.select_department') }}</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->department_name }}
                                    </option>
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <button type="submit" class="btn btn-primary">
                                {{ __('users.filter') }}
                            </button>
                        </li>
                    </form>
                </ul>
            </div>
            @if (Auth::user()->id == 1)
                <form action="{{ route('import') }}" method="GET">
                    <button type="submit" class="btn btn-primary">
                        {{ __('users.import') }}
                    </button>
                </form>
            @endif

            <form action="{{ route('export-csv') }}" method="POST">
                @csrf
                <input type="submit" value="{{ __('users.export') }}" name="export_csv" class="btn btn-success">
            </form>

            <form action="{{ route('search') }}" method="GET">
                @csrf
                <div class="input-group">
                    <div class="form-outline">
                        <input type="text" id="form1" name="form1" value="{{ request()->form1 }}"
                            class="form-control" />
                        <label class="form-label" for="form1">{{ __('users.search') }}</label>
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
                <th>{{ __('users.name') }}</th>
                <th>{{ __('users.info') }}</th>
                <th>@sortablelink('birth_day', __('users.birth_day'))</th>
                <th>@sortablelink('created_at', __('users.start_at'))</th>
                <th>{{ __('users.status') }}</th>
                <th>{{ __('users.position') }}</th>
                @if (Auth::user()->id == 1)
                    <th>{{ __('users.action') }}</th>
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
                        <p class="fw-normal mb-1">{{ __('users.email') }}: {{ $user->email }}</p>
                        <p class="fw-normal mb-1">{{ __('users.phone') }}: {{ $user->phone }}</p>
                    </td>
                    <td>{{ Carbon\Carbon::parse($user->birth_day)->format('d-m-Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($user->start_at)->format('d-m-Y') }}</td>
                    @if ($user->status == 1)
                        <td>
                            <span class="badge badge-success rounded-pill d-inline">{{ __('users.work') }}</span>
                        </td>
                    @else
                        <td>
                            <span class="badge badge-warning rounded-pill d-inline">{{ __('users.resign') }}</span>
                        </td>
                    @endif

                    @if ($user->auth == 1)
                        <td>{{ __('users.admin') }}</td>
                    @endif
                    @if ($user->auth == 2)
                        <td>{{ __('users.manager') }}</td>
                    @endif
                    @if ($user->auth == 3)
                        <td>{{ __('users.employee') }}</td>
                    @endif
                    @if (Auth::user()->id == 1)
                        <td>
                            <a type="button" class="btn btn-primary btn-rounded"
                                href="/employees/edit/{{ $user->id }}">
                                {{ __('users.edit') }}
                            </a>

                            <button type="button" class="btn btn-danger btn-rounded"
                                onclick="removeUser({{ $user->id }}, 'employees/destroy')">
                                {{ __('users.delete') }}
                            </button>
                            <form action="{{ route('resetPassword') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $user->email }}" name="email">
                                <button type="submit" class="btn btn-success btn-rounded">
                                    {{ __('users.add') }}
                                </button>
                            </form>
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
        <form action="{{ route('addUser') }}" method="GET">
            <button type="submit" class="btn btn-primary">
                {{ __('users.add_employee') }}
            </button>
        </form>
    @endif
@endsection
