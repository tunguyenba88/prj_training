@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="{{ route('updateProfileCustom') }}" method="POST">
            @csrf
            <div class="form-outline mb-4">
                <input type="date" id="birth_day1" name="birth_day1" class="form-control" value="{{ $user->birth_day }}" />
                <label class="form-label" for="form4Example1">{{ __('profile.birth_day') }}</label>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="phone1" name="phone1" class="form-control" value="{{ $user->phone }}" />
                <label class="form-label" for="phone1">{{ __('profile.phone') }}</label>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('profile.save') }}</button>
            <div class="form-outline mb-4">
                @include('layout.alert')
            </div>
        </form>
    </div>

    @include('layout.footer')
@endsection
