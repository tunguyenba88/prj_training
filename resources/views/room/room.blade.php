<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>
@include('layout.navbar')
<table class="table align-middle mb-0 bg-white" id="table">
    <thead class="bg-light">
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Manager</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>  
      @foreach ($rooms as $room)
      <tr>
          <td>{{$room->room_name}}</td>
          <td>{{$room->description}}</td>
          <td>{{$room->name}}</td>
          <td>
            <a type="button" class="btn btn-primary btn-rounded" href="/room/edit/{{$room->id}}">
              Edit
            </a>

            <button type="button" class="btn btn-danger btn-rounded" onclick="removeRoom({{$room->id}}, 'room/destroy')">
              Delete
            </button>
          </td>
        </tr>    
      @endforeach        
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
      {!! $rooms->appends(Request::except('page'))->render() !!}
  </div>

  <form action="room/add" method="GET">
    <button type="submit" class="btn btn-primary">
      Add Room
    </button>
  </form>
@include('layout.footer')
</body>
</html>
