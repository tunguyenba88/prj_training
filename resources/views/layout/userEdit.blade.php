<button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#modal-user">
    Edit Profile
</button>

<div class="modal" tabindex="-1" id="modal-user">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Profile</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('update_profile')}}" method="POST">
        @csrf
        <div class="form-outline mb-4">
            <input type="date" id="birth_day1" name="birth_day1" class="form-control" value="{{$user->birth_day}}"/>
            <label class="form-label" for="form4Example1">Birth Day</label>
        </div>
        
        <div class="form-outline mb-4">
          <input type="text" id="phone1" name="phone1" class="form-control" value="{{$user->phone}}"/>
          <label class="form-label" for="phone1">Number Phone</label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  {{-- @yield('modal_user') --}}