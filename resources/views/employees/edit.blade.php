@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-outline mb-4">
                <label class="" for="name">{{ __('users.name') }}</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" />
            </div>

            <div class="form-outline mb-4">
                <label class="" for="name">{{ __('users.department') }}</label>
                <select class="form-select" id="room" name="room">
                    <option value="">{{ __('users.select_room') }}</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ $user->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-outline mb-4">
                <label class="" for="name">Position</label>
                <select class="form-select" id="auth" name="auth">
                    <option value="1" {{ $user->auth == 1 ? 'selected' : '' }}>{{ __('users.admin') }}</option>
                    <option value="2" {{ $user->auth == 2 ? 'selected' : '' }}>{{ __('users.manager') }}</option>
                    <option value="3" {{ $user->auth == 3 ? 'selected' : '' }}>{{ __('users.employee') }}
                    </option>
                </select>
            </div>

            <div class="form-outline mb-4">
                <label class="" for="birth_day">{{ __('users.birth_day') }}</label>
                <input type="date" name="birth_day" id="birth_day" class="form-control"
                    value="{{ $user->birth_day }}" />
            </div>
            <div class="form-outline mb-4">
                <label class="" for="start_at">{{ __('users.start_at') }}</label>
                <input type="date" name="start_at" id="start_at" class="form-control" value="{{ $user->start_at }}" />
            </div>

            <div class="form-outline mb-4">
                <label class="" for="name">{{ __('users.status') }}</label>
                <select class="form-select" id="status" name="status">
                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>{{ __('users.work') }}</option>
                    <option value="2" {{ $user->status == 2 ? 'selected' : '' }}>{{ __('users.resign') }}
                    </option>
                </select>
            </div>

            <div class="form-outline mb-4">
                <label for="image" class="">{{ __('users.change_avatar') }}</label>
                <input type="file" class="" id="image" name="image" />
            </div>

            <div class="form-outline mb-4">
                <label class="" for="phone">{{ __('users.phone') }}</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" />
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4">{{ __('users.save') }}</button>
            <div class="form-outline mb-4">
                @include('layout.alert')
            </div>
        </form>
    </div>
@endsection
