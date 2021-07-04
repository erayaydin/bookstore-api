@extends('layout.master')

@section('body')
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        @include('partials.menu')
        <!-- END: Side Menu -->

        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            @include('partials.top-bar')
            <!-- END: Top Bar -->

            @yield('page.contents')
        </div>
        <!-- END: Content -->
    </div>
@stop

@push('page.styles')
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
@endpush

@push('page.scripts')
    <script src="{{ asset('dist/js/app.js') }}"></script>
@endpush
