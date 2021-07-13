<!DOCTYPE html>
<html lang="{{ \localizer\locale()->iso6391() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,500,600|IBM+Plex+Serif:400,500,600" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('components.header')
@yield('content')
@include('components.footer')
@include('components.svg')
<script src="{{ mix('js/app.js') }}"></script>
{!! options_find('google_analytics') !!}
</body>
</html>
