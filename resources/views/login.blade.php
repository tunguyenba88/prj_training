@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="login/store" method="post">

            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" />
                <label class="form-label" for="email">{{ __('forms.email_title') }}</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control" />
                <label class="form-label" for="password">{{ __('forms.password_title') }}</label>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="checkbox" name="checkbox" id="checkbox"
                            checked />
                        <label class="form-check-label" for="checkbox">{{ __('forms.remember') }}</label>
                    </div>
                </div>

                <div class="col">
                    <!-- Simple link -->
                    <a href="#!">{{ __('forms.forgot') }}</a>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">{{ __('forms.btn_title') }}</button>
            <div class="form-outline mb-4">
                @include('layout.alert')
            </div>
        </form>
    </div>
@endsection
