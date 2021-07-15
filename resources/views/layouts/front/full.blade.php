@extends('layouts.common.partials.html')
@section('layout')
    @include('layouts.front.partials.head')
    <body id="front">
        @include('layouts.common.partials.noscript')
        <div id="layout" class="d-flex flex-column position-relative">
            @include('layouts.front.partials.nav')
            <div id="template" class="flex-grow-1 position-relative">
                @yield('template')
                @include('layouts.front.partials.cookies')
            </div>
            @include('layouts.front.partials.footer')
        </div>
        @include('layouts.front.partials.cookies-management-policy')
        @include('layouts.front.partials.end')
    </body>
@endsection
