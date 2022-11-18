<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="" method="post">
          @csrf
          <div class="form-outline mb-4">
            <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}"/>
            <label class="form-label" for="name">Full Name</label>
          </div>
        
          <div class="form-outline mb-4">
            <select class="form-select" id="room" name="room" style="width: 5rem">
              <option value="1" {{$user->room_id == 1 ? 'selected' : ''}}>D1</option>
              <option value="2" {{$user->room_id == 2 ? 'selected' : ''}}>D2</option>
              <option value="3" {{$user->room_id == 3 ? 'selected' : ''}}>D3</option>
            </select>
          </div>
          <div class="form-outline mb-4">
            <select class="form-select" id="auth" name="auth" style="width: 5rem">
              <option value="1" {{$user->auth == 1 ? 'selected' : ''}}>Admin</option>
              <option value="2" {{$user->auth == 2 ? 'selected' : ''}}>Quản lý</option>
              <option value="3" {{$user->auth == 3 ? 'selected' : ''}}>Nhân viên</option>
            </select>
          </div>
          
          <div class="form-outline mb-4">
            <input type="date" name="birth_day" id="birth_day" class="form-control" value="{{$user->birth_day}}" />
            <label class="form-label" for="birth_day">Birth Day</label>
          </div>
          <div class="form-outline mb-4">
            <input type="text" name="start_at" id="start_at" class="form-control" value="{{$user->start_at}}"/>
            <label class="form-label" for="start_at">Date start work</label>
          </div>
        
          <div class="form-outline mb-4">
            <select class="form-select" id="status" name="status" style="width: 5rem">
                <option value="1" {{$user->status == 1 ? 'selected' : ''}}>Working</option>
                <option value="2" {{$user->status == 2 ? 'selected' : ''}}>Resign</option>
              </select>
          </div>
          
          <div class="form-outline mb-4">
            <input type="text" name="image" id="image" class="form-control" value="{{$user->image}}"/>
            <label class="form-label" for="image">Image</label>
          </div>

          <div class="form-outline mb-4">
            <input type="text" name="phone" id="phone" class="form-control" value="{{$user->phone}}"/>
            <label class="form-label" for="phone">Phone</label>
          </div>

          <button type="submit" class="btn btn-primary btn-block mb-4">Save Change</button>
          <div class="form-outline mb-4">
            @include('layout.alert')  
          </div>
        </form>
    </div>
</body>
</html>