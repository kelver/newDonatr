<div {{ $attributes }}>
    <div class="flex mx-2 mb-4 space-x-4 text-sm font-extrabold border-b border-gray-300">
        <template x-for="tab in tabs" :key="tab.id">
            <div class="hover:text-indigo-600 py-2 cursor-pointer uk-link-reset text-gray-800"
                 :class="{'text-indigo-600 border-b border-indigo-600': tabActive === tab.id}"
                 @click="tabActive = tab.id" x-text="tab.name"></div>
        </template>
    </div>

    {{ $tabData }}
</div>
