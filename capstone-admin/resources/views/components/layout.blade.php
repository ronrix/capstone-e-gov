<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin side of Municipality of Pililla Rizal" >

        {{-- tailwind CDN --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/app.js') }}"></script>

        <title>Admin</title>
    </head>
    <body>
        {{-- view output --}}
        {{$slot}}
    </body>
</html>
