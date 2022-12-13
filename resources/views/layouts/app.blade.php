@extends('layouts.base')

@section('body')
    <div id="wrapper">
        @if(session()->has('donatr_token_auth'))
            @include('layouts.sidebar')
        @endif

        <div class="main_content" :style="!isLogged ? 'margin-left: 0; width: 100%;' : ''">
            @if(session()->has('donatr_token_auth'))
                @include('layouts.header')
            @endif
            <div class="container m-auto">
                @yield('content')
            </div>
        </div>
    </div>
@endsection
