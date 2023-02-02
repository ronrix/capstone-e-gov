<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin side of Municipality of Pililla Rizal" >
        <title>Admin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data :class="$store.darkMode.on === 'dark' ? 'dark' : ''">
        <div class="dark:bg-primary-dark light:bg-white">
            <div class="container mx-auto">
                @include('partials._dnl')
                {{-- view output --}}
                {{$slot}}
            </div>
        </div>
    </body>
</html>
