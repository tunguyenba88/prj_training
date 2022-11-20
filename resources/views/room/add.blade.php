<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
</head>

<body>
    <div class="d-flex justify-content-center" style="margin-top: 10%">
        <form action="add/store" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-outline mb-4">
                <label class="" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" />
            </div>
            <div class="form-outline mb-4">
                <label class="" for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" />
            </div>
            <select name="manager" class="form-select" id="manager">
                <option value="">Select Manager</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <br>
            <button type="submit" class="btn btn-primary btn-block mb-4">Add</button>
            <div class="form-outline mb-4">
                @include('layout.alert')
            </div>
        </form>
    </div>
</body>

</html>
