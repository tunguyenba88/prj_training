@extends('layout.app')
@section('content')
    <div class="container">
        <div class="card bg-light mt-3">
            <div class="card-body">
                <form action="{{ route('import-csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (count($errors) > 0)
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <div class="alert alert-danger alert-dismissible">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }} <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="file" class="form-control" accept=".xlsx">
                    <br>
                    <button class="btn btn-success">{{ __('users.import') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
