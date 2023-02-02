<x-layout>
    <x-notif title="Login" />
    <div class="h-screen w-full flex justify-center items-center">
        <x-form action="/login" class="w-96 mx-auto border border-secondary-gray rounded-md shadow-lg p-5" method="POST">
            @csrf()
            <h1 class="font-bold text-2xl dark:text-white light:text-primary-dark uppercase">Login</h1>
            <input value="{{ old("email") }}" type="text" name="email" placeholder="username or email" class="p-3 my-5 border border-primary-dark outline-none focus:bg-white dark:bg-primary-gray rounded text-secondary-gray">
            <input type="password" name="password" placeholder="password" class="p-3 my-5 border border-primary-dark outline-none focus:bg-white dark:bg-primary-gray rounded text-secondary-gray">
            <input type="submit" value="login" class="bg-primary-red hover:bg-primary-red-300 p-3 text-white font-bold text-lg rounded cursor-pointer">
            <p class="text-xs text-secondary-gray text-center mt-5">login as administrator</p>
        </x-form>
    </div>
</x-layout>