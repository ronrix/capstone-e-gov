<x-layout>
    <div class="h-screen w-full flex justify-center items-center">
        <x-form action="/login" class="w-96 mx-auto bg-white shadow-lg p-5" method="POST">
            @csrf()
            <h1 class="font-bold text-2xl uppercase">Login</h1>
            <input type="text" name="email" placeholder="username or email" class="p-3 my-5 border border-primary-dark outline-none focus:border-red-theme">
            <input type="password" name="password" placeholder="password" class="p-3 my-5 border border-primary-dark outline-none focus:border-red-theme">
            <input type="submit" value="login" class="bg-primary-dark p-3 text-white font-bold text-lg">
            <p class="text-xs text-secondary-gray text-center mt-5">login as administrator</p>
        </x-form>
    </div>
</x-layout>