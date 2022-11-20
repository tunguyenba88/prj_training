<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="add/store" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-outline mb-4">
            <label class="" for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control"/>
          </div>
          <div class="form-outline mb-4">
            <label class="" for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control"/>
          </div>
          <div class="form-outline mb-4">
            <label class="" for="name">Room</label>
            <select class="form-select" id="room" name="room" style="width: 5rem">
              <option value="1">D1</option>
              <option value="2">D2</option>
              <option value="3">D3</option>
            </select>
          </div>
          <div class="form-outline mb-4">
            <label class="" for="name">Position</label>
            <select class="form-select" id="auth" name="auth" style="width: 5rem">
              <option value="1">Admin</option>
              <option value="2">Quản lý</option>
              <option value="3">Nhân viên</option>
            </select>
          </div>
          
          <div class="form-outline mb-4">
            <label class="" for="birth_day">Birth Day</label>
            <input type="date" name="birth_day" id="birth_day" class="form-control"/>
          </div>
          <div class="form-outline mb-4">
            <label class="" for="start_at">Date start work</label>
            <input type="date" name="start_at" id="start_at" class="form-control"/>
          </div>
        
          <div class="form-outline mb-4">
            <label class="" for="name">Status</label>
            <select class="form-select" id="status" name="status" style="width: 5rem">
              <option value="1">Working</option>
              <option value="2">Resign</option>
            </select>
          </div>

          <div class="form-outline mb-4">
            <label for="image" class="">Change Avatar</label>
            <input type="file" class="" id="image" name="image" />                       
          </div>
          
          <div class="form-outline mb-4">
            <label class="" for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control"/>
          </div>

          <button type="submit" class="btn btn-primary btn-block mb-4">Add</button>
          <div class="form-outline mb-4">
            @include('layout.alert')  
          </div>
        </form>
    </div>
</body>
</html>