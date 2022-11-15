<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>
@include('layout.navbar')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <form action="list" method="GET" onchange="submit()">
        @csrf
        <select class="form-select" id="select" name="select" style="width: 5rem">
          <option selected></option> 
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
        </select>
      </form>
      <form action="" method="GET">
        @csrf
        <div class="input-group">
          <div class="form-outline">
            <input type="search" id="form1" class="form-control" />
            <label class="form-label" for="form1">Search</label>
          </div>
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>
    </div>
</nav>
<table class="table align-middle mb-0 bg-white">
    <thead class="bg-light">
      <tr>
        <th>Name</th>
        <th>Info</th>
        <th>Status</th>
        <th>Position</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
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
                  <p class="fw-bold mb-1">{{$user->name}}</p>
                </div>
              </div> 
            </td>
            <td>
                <p class="fw-normal mb-1">Email: {{$user->email}}</p>
                <p class="fw-normal mb-1">Phone: {{$user->phone}}</p>
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
            
            @if ($user->auth == 1)
                <td>Admin</td>
            @endif
            @if ($user->auth == 2)
                <td>Quản lý bộ phận</td>
            @endif
            @if ($user->auth == 3)
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
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    {!! $users->links() !!}
  </div>
@include('layout.footer')
</body>
</html>
