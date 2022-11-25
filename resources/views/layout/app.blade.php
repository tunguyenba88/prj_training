<!DOCTYPE html>
<html>

<head>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="/js/main.js"></script>
</head>

<body>
    <div class="row">
        <div class="col-md-2 col-md-offset-6 text-right">
            <strong>Select Language: </strong>
        </div>
        <div class="col-md-4">
            <select class="form-control changeLang">
                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                <option value="vn" {{ session()->get('locale') == 'vn' ? 'selected' : '' }}>Vietnam</option>
            </select>
        </div>
    </div>
    <main>
        @yield('content')
    </main>
</body>
<script type="text/javascript">
    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function() {
        console.log(12313);
        window.location.href = url + "?lang=" + $(this).val();
    });
</script>

</html>
