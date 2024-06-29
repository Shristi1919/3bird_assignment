<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      </head>
<body>
    <script>
        $(document).ready(function() {
            @if(Session::has('success_message'))
                toastr.success("{{ Session::get('success_message') }}", 'Success');
            @endif

            @if(Session::has('error_message'))
                toastr.error("{{ Session::get('error_message') }}", 'Error');
            @endif

            @if(Session::has('info_message'))
                toastr.info("{{ Session::get('info_message') }}", 'Info');
            @endif

            @if(Session::has('warning_message'))
                toastr.warning("{{ Session::get('warning_message') }}", 'Warning');
            @endif
        });
    </script>
</body>
</html>
