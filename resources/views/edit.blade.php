<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-outline mb-4">
            <label class="" for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}"/>
          </div>
        
          <div class="form-outline mb-4">
            <label class="" for="name">Room</label>
            <select class="form-select" id="room" name="room" style="width: 5rem">
              <option value="1" {{$user->room_id == 1 ? 'selected' : ''}}>D1</option>
              <option value="2" {{$user->room_id == 2 ? 'selected' : ''}}>D2</option>
              <option value="3" {{$user->room_id == 3 ? 'selected' : ''}}>D3</option>
            </select>
          </div>
          <div class="form-outline mb-4">
            <label class="" for="name">Position</label>
            <select class="form-select" id="auth" name="auth" style="width: 5rem">
              <option value="1" {{$user->auth == 1 ? 'selected' : ''}}>Admin</option>
              <option value="2" {{$user->auth == 2 ? 'selected' : ''}}>Quản lý</option>
              <option value="3" {{$user->auth == 3 ? 'selected' : ''}}>Nhân viên</option>
            </select>
          </div>
          
          <div class="form-outline mb-4">
            <label class="" for="birth_day">Birth Day</label>
            <input type="date" name="birth_day" id="birth_day" class="form-control" value="{{$user->birth_day}}" />
          </div>
          <div class="form-outline mb-4">
            <label class="" for="start_at">Date start work</label>
            <input type="date" name="start_at" id="start_at" class="form-control" value="{{$user->start_at}}"/>
          </div>
        
          <div class="form-outline mb-4">
            <label class="" for="name">Status</label>
            <select class="form-select" id="status" name="status" style="width: 5rem">
              <option value="1" {{$user->status == 1 ? 'selected' : ''}}>Working</option>
              <option value="2" {{$user->status == 2 ? 'selected' : ''}}>Resign</option>
            </select>
          </div>

          <div class="form-outline mb-4">
            <label for="image" class="">Change Avatar</label>
            <input type="file" class="" id="image" name="image" />                       
          </div>
          
          <div class="form-outline mb-4">
            <label class="" for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{$user->phone}}"/>
          </div>

          <button type="submit" class="btn btn-primary btn-block mb-4">Save Change</button>
          <div class="form-outline mb-4">
            @include('layout.alert')  
          </div>
        </form>
    </div>
</body>
</html>