@extends('layout.app')
@section('content')
    @if (Auth::user()->id < 3)
        @include('layout.navbar')
    @endif
    <table class="table align-middle mb-0 bg-white" id="table">
        <thead class="bg-light">
            <tr>
                <th>{{ __('department.name') }}</th>
                <th>{{ __('department.description') }}</th>
                <th>{{ __('department.manager') }}</th>
                <th>{{ __('department.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td>{{ $department->department_name }}</td>
                    <td>{{ $department->description }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a type="button" class="btn btn-primary btn-rounded" href="/department/edit/{{ $department->id }}">
                            {{ __('department.edit') }}
                        </a>

                        <button type="button" class="btn btn-danger btn-rounded"
                            onclick="removeDepartment({{ $department->id }}, 'department/destroy')">
                            {{ __('department.delete') }}
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
            {{ __('department.add_department') }}
        </button>
    </form>
    @include('layout.footer')
@endsection
