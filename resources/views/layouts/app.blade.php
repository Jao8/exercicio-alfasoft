<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Font Awesome CDN --}}
    <script src="https://kit.fontawesome.com/4d84d7a3b9.js" crossorigin="anonymous"></script>

    <title>{{ $title }}</title>
</head>
<body>
    <div class="{{ $class }}">
        @yield('content')
    </div>
</body>
</html>
