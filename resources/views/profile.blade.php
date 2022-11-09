<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    {{-- <div>{{dd($user)}}</div> --}}
    @if ($user->auth == 1)
        <div>Admin</div>
    @endif
    @if ($user->auth == 2)
        <div>Quan ly bo phan</div>
    @endif
    <div>{{ $user->name }}</div>
    <div>{{ $user->email }}</div>
    <div>{{ $user->birth_day }}</div>
    <div>{{ $user->phone }}</div>    
    <form action="{{route('logout')}}" method="GET">
        @csrf
        <button type="submit" >Logout</button>
    </form>
</body>
</html>