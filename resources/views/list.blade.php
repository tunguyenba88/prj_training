<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
    <form action="{{route('profile')}}" method="GET">
        @csrf
        <button type="submit" >Profile</button>
    </form>
    <table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Birth Day</th>
      </tr>
    @foreach ($users as $user)
    <tr>
        <th>{{ $user->name }}</th>
        <th>{{ $user->email }}</th>
        <th>{{ $user->birth_day }}</th>
        <th>
        @if ($role == 1)
        <form action="{{route('view')}}" method="POST">
            <button type="submit" value="{{$user->id}}">Xem Profile</button>    
        </form>
        @endif
        </th>
    </tr>
    @endforeach
</table>

<form action="{{route('logout')}}" method="GET">
    @csrf
    <button type="submit" >Logout</button>
</form>
</body>
</html>