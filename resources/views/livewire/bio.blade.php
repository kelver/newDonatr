@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/phone.css') }}">
    <div>
        <div class="flex flex-row w-full">
            <div class="basis-4/6 -ml-10">
                <div
                    class="mt-4"
                >

                    <x-tabs x-data="{
                        tabActive: 'links',
                        tabs: [
                            { name: 'Links', id: 'links' },
                            { name: 'Estilo', id: 'style' },
                        ],
                    }">
                        <x-slot:tabData>
                            <div class="bg-blend-lighten p-3 rounded-b-sm">
                                <div x-show="tabActive === 'links'">
                                    <livewire:bio-links />
                                </div>
                                <div x-show="tabActive === 'style'">
                                    <x-bioStyle />
                                </div>
                            </div>
                        </x-slot:tabData>
                    </x-tabs>
                </div>

            </div>
            <div class="basis-2/6 -mr-10" style="float: right;">
                <div style="position:fixed;">
                    <div class="phone ios">
                        <div class="screen">
                            <div class="screen-menu">
                                lkasjdasjd
                            </div>
                            <div class="return-btn">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
