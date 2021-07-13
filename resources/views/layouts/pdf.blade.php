<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{ config('app.name') }}</title>
  <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,500|IBM+Plex+Serif:400,500&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
</head>
<body>    
  @yield('content')
</body>
</html>