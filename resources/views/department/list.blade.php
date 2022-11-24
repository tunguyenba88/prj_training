<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.header')
</head>

<body>
    @if (Auth::user()->id < 3)
        @include('layout.navbar')
    @endif
    <table class="table align-middle mb-0 bg-white" id="table">
        <thead class="bg-light">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Manager</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->department_name }}</td>
                    <td>{{ $department->description }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a type="button" class="btn btn-primary btn-rounded"
                            href="/department/edit/{{ $department->id }}">
                            Edit
                        </a>

                        <button type="button" class="btn btn-danger btn-rounded"
                            onclick="removeRoom({{ $department->id }}, 'department/destroy')">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $departments->appends(Request::except('page'))->render() !!}
    </div>

    <form action="department/add" method="GET">
        <button type="submit" class="btn btn-primary">
            Add Room
        </button>
    </form>
    @include('layout.footer')
</body>

</html>
