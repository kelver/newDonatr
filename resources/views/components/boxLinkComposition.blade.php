<div class="flex flex-col w-full mt-2 mx-auto" {{ $attributes }}>
    <hr>
    <div class="flex py-0.5 bg-pink-500 text-white">
        <div class="align-center flex-col border-2 rounded-md px-1 border-white m-2">
            <i @click="selected !== 0 ? selected = 0 : selected = null"
               class="cursor-pointer uil-link-alt text-sm"></i>
        </div>
        <div class="align-center flex-col border-2 rounded-md px-1 border-white m-2">
            <i @click="selected !== 1 ? selected = 1 : selected = null"
               class="cursor-pointer uil-link-alt text-sm"></i>
        </div>
        <div class="align-center flex-col border-2 rounded-md px-1 border-white m-2">
            <i @click="selected !== 2 ? selected = 2 : selected = null"
               class="cursor-pointer uil-link-alt text-sm"></i>
        </div>
    </div>
    <div class="data">
        <p x-show="selected == 0" x-transition.duration.500ms x-transition:leave="transition ease-in duration-100"
           class="py-4 px-2">
            This is made with Alpine JS and Tailwind CSS
        </p>
        <p x-show="selected == 1" x-transition.duration.500ms x-transition:leave="transition ease-in duration-100"
           class="py-4 px-2">
            There's no external CSS or JS
        </p>
        <p x-show="selected == 2" x-transition.duration.500ms x-transition:leave="transition ease-in duration-100"
           class="py-4 px-2">
            Pretty cool huh?
        </p>
    </div>
</div>
