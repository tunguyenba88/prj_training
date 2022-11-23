<!DOCTYPE html>
<html>

<head>
    @include('layout.header')
</head>

<body>
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
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
