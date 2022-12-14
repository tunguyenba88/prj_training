<table class="table align-middle mb-0 bg-white" id="table">
    <thead class="bg-light">
        <tr>
            <th>Name</th>
            <th>Info</th>
            <th>@sortablelink('birth_day', 'Birth Day')</th>
            <th>@sortablelink('created_at', 'Started')</th>
            <th>Status</th>
            <th>Position</th>
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
            </tr>
        @endforeach
    </tbody>
</table>
