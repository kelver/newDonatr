<div>
    <div class="row">
        <button type="button" wire:click="generateLink"
                class="justify-center m-auto w-11/12 bg-pink-500 flex font-bold hover:bg-pink-600 hover:text-white items-center
       px-4 py-2 rounded text-white">
            <i class="uil-focus-add mr-2"></i>
            Adicionar Link
        </button>

            @if(count($links) > 0)
            @foreach ($links as $index => $link)
            <div class="flex flex-wrap w-full md:w-4/4 items-center h-auto md:mx-auto bg-white shadow-lg h-auto
                rounded-md border-l-8 border-pink-500 my-6">
                <div class="w-full p-1 rounded-md">
                    <div class='w-full'>
                        <div class="relative mb-2 flex  ">
                            <div class="switch-container mr-8">
                                <label class="switch">
                                    <input type="checkbox" wire:model="links.{{ $index }}.status" id="status-{{ $index }}">
                                    <span class="switch-button"></span>
                                </label>
                            </div>
                            <div class="relative mb-2 flex uk-flex-auto justify-end h-6">
                            <span class="cursor-pointer" wire:click="removeLink({{ $index }})">
                                <i class="text-pink-700 uil-trash-alt"></i>
                            </span>
                            </div>
                        </div>
                        <div class="relative mb-2 w-full flex flex-wrap items-stretch">
                            <input wire:model="links.{{ $index }}.title"
                                type="text" id="title-{{ $index }}" name="title" class="max-h-8 relative py-1 px-2 pr-10 w-full
                                outline-none border border-gray-400 rounded bg-white text-sm text-pink-700
                                placeholder-pink-400 font-bold focus:outline-none focus:shadow-outline
                                focus:text-pink-700" placeholder="Título" />
                                <label for="title-{{ $index }}" class="absolute right-0 z-10 py-1 pr-2 w-8 h-full leading-snug
                                    bg-transparent rounded text-base font-normal text-pink-700 text-center flex items-center
                                    justify-center">
                                <i class="uil-book"></i>
                            </label>
                        </div>
                        <div class="relative mb-2 w-full flex flex-wrap items-stretch">
                            <input wire:model="links.{{ $index }}.url"
                                type="text" id="url-{{ $index }}" name="url" class="max-h-8 relative py-1 px-2 pr-10 w-full
                                    outline-none border border-gray-400 rounded bg-white text-xs text-pink-700
                                    placeholder-pink-400 font-bold focus:outline-none focus:shadow-outline
                                    focus:text-pink-700" placeholder="URL" />
                            <label for="url-{{ $index }}" class="absolute right-0 z-10 py-1 pr-2 w-8 h-full leading-snug bg-transparent
                            rounded text-base font-normal text-pink-700 text-center flex items-center justify-center">
                                <i class="uil-link-alt"></i>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="w-full">
                    <x-boxLinkComposition x-data="{ selected: null }"/>
                </div>
            </div>
            @endforeach
            @endif
    </div>
</div>
