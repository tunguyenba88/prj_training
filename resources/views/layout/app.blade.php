<!DOCTYPE html>
<html>

<head>
    @include('layout.header')
</head>

<body>
    <div class="form-outline">
        <label class="" for="language">{{ __('messages.language') }}: </label>
        <select class="form-control changeLang" id="language" name="language" style="width: 5%">
            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
            <option value="vn" {{ session()->get('locale') == 'vn' ? 'selected' : '' }}>Vietnam</option>
        </select>
    </div>
    <main>
        @yield('content')
    </main>
    @include('layout.footer')

</body>
<script type="text/javascript">
    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function() {
        console.log(12313);
        window.location.href = url + "?lang=" + $(this).val();
    });
</script>

</html>
