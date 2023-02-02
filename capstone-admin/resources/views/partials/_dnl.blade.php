<div class="w-full flex justify-end items-center">
    <span class="text-xs text-secondary-gray mr-3" x-text="$store.darkMode.on + ' mode'"></span>
    <i id="dark" x-show="$store.darkMode.on === 'light'" class="fa-solid fa-circle-half-stroke text-2xl text-primary-dark"  x-data @click="$store.darkMode.toggle()"></i>
    <i id="light"  x-show="$store.darkMode.on === 'dark'" class="fa-solid fa-sun text-2xl text-white"  x-data @click="$store.darkMode.toggle()"></i>
</div>