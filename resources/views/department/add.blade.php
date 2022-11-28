@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="add/store" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-outline mb-4">
                <label class="" for="name">{{ __('department.name') }}</label>
                <input type="text" name="department_name" id="department_name" class="form-control"
                    value="{{ old('department_name') }}" />
            </div>
            <div class="form-outline mb-4">
                <label class="" for="description">{{ __('department.description') }}</label>
                <input type="text" name="description" id="description" class="form-control"
                    value="{{ old('description') }}" />
            </div>
            <select name="manager" class="form-select" id="manager">
                <option value="">{{ __('department.select_manager') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('manager') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <br>
            <button type="submit" class="btn btn-primary btn-block mb-4">{{ __('department.add') }}</button>
            <div class="form-outline mb-4">
                @include('layout.alert')
            </div>
        </form>
    </div>
@endsection
