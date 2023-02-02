@props(['title'])

@if ($errors->any())
    <div class="fixed right-0 top-10 bg-red-400 text-white font-bold shadow-lg p-5" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $title }}</li>
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
