<!DOCTYPE html>
<html lang="en">
<head>
  @include('layout.header')
</head>
<body>
      <form action="login/store" method="post">
        @csrf
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="text" name="email" id="email" class="form-control" />
          <label class="form-label" for="email">Email address</label>
        </div>
      
        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" name="password" id="password" class="form-control" />
          <label class="form-label" for="password">Password</label>
        </div>
      
        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="checkbox" checked />
              <label class="form-check-label" for="checkbox"> Remember me </label>
            </div>
          </div>
      
          <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
          </div>
        </div>
      
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
      
      </form>

@include('layout.footer')
</body>
</html>


