<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin side of Municipality of Pililla Rizal" >
        <title>Admin</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body {{ $attributes->merge(["class" => ""])}}>
        {{-- view output --}}
        {{$slot}}
    </body>
</html>
