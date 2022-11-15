<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>
    <section>
          @include('layout.navbar')
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="{{$user->image}}" id="image-show" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                  <h5 class="my-3">{{$user->name}}</h5>
                  <div class="d-flex justify-content-center mb-2">
                    <form method="POST" action="" enctype="multipart/form-data">
                      @csrf
                      <input type="file" class="form-control" id="upload" name="image" hidden/>                       
                      <label for="upload" class="btn btn-primary">Change Avatar</label>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Position</p>
                    </div>
                    <div class="col-sm-9">
                      @if ($user->auth == 1)
                        <p class="text-muted mb-0">Admin</p>
                      @endif
                      @if ($user->auth == 2)
                        <p class="text-muted mb-0">Quản Lý Bộ Phận</p>
                      @endif
                      @if ($user->auth == 3)
                        <p class="text-muted mb-0">Nhân Viên</p>
                      @endif
                    </div>
                  </div>  
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Full Name</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$user->name}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$user->email}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Phone</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$user->phone}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Birth Day</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$user->birth_day}}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @include('layout.userEdit')
      <form action="{{ route('change_password') }}" method="GET">
        <button type="submit" class="btn btn-primary">
          Change Password
        </button>
      </form>
      
      @include('layout.footer')
</body>
</html>