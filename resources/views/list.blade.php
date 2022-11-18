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
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
        </select>
      </form>
      <form action="list" method="GET" onchange="submit()">
        @csrf
        <select class="form-select" id="select" name="select" style="width: 5rem">
          <option value="0" {{$select == 0 ? 'selected' : ''}}>Status</option>
          <option value="1" {{$select == 1 ? 'selected' : ''}}>Working</option>
          <option value="2" {{$select == 2 ? 'selected' : ''}}>Resign</option>
        </select>
      </form>
      <form action="{{ route('filter.room') }}" method="GET" onchange="submit()">
        @csrf
        <select class="form-select" id="room" name="room" style="width: 5rem">
          <option value="0" {{$room == 0 ? 'selected' : ''}}>Room</option>
          <option value="1" {{$room == 1 ? 'selected' : ''}}>D1</option>
          <option value="2" {{$room == 2 ? 'selected' : ''}}>D2</option>
          <option value="3" {{$room == 3 ? 'selected' : ''}}>D3</option>
        </select>
      </form>
      <form action="{{route('search')}}" method="GET">
        @csrf
        <div class="input-group">
          <div class="form-outline">
            <input type="text" id="form1" name="form1" value="{{(isset($form1) && $param != '')  ? $param : ''}}" class="form-control"/>
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
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>  
      @foreach ($users as $user)
      <tr>
          <td>
            <div class="d-flex align-items-center">
              <img
                  src="{{$user->image}}"
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
          <td>{{Carbon\Carbon::parse($user->birth_day)->format('d-m-Y')}}</td>
          <td>{{Carbon\Carbon::parse($user->start_at)->format('d-m-Y')}}</td>
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
            <a type="button" class="btn btn-primary btn-rounded" href="/list/edit/{{$user->id}}">
              Edit
            </a>

            <button type="button" class="btn btn-danger btn-rounded" onclick="removeUser({{$user->id}}, 'list/destroy')">
              Delete
            </button>
          </td>
        </tr>    
      @endforeach        
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
      {!! $users->appends(Request::except('page'))->render() !!}
  </div>
@include('layout.footer')
</body>
</html>
