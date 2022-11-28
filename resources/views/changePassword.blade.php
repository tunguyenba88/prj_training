@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="{{ route('changePasswordCustom') }}" method="post">
            @csrf
            <div class="form-outline mb-4">
                <input type="password" name="current_password" id="current_password" class="form-control" />
                <label class="form-label" for="current_password">{{ __('profile.current_password') }}</label>
            </div>

            <div class="form-outline mb-4">
                <input type="password" name="new_password" id="new_password" class="form-control" />
                <label class="form-label" for="new_password">{{ __('profile.new_password') }}</label>
            </div>

            <div class="form-outline mb-4">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" />
                <label class="form-label" for="confirm_password">{{ __('profile.confirm_password') }}</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4">{{ __('profile.save') }}</button>
            <div class="form-outline mb-4">
                @include('layout.alert')
            </div>
        </form>
    </div>
    @include('layout.footer')
@endsection
