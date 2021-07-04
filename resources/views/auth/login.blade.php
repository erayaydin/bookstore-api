@extends('layout.master')

@section('page.title', "Giriş")

@section('body.class', 'login')

@section('body')

    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="{{ config('app.name') }}" class="w-6" src="{{ asset('dist/images/logo.svg')}}">
                    <span class="text-white text-lg ml-3"> Book<span class="font-medium">Store</span> </span>
                </a>
                <div class="my-auto">
                    <img alt="{{ config('app.name') }}" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/login-logo.svg')}}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        BookStore Yönetim Paneli
                        <br>
                        E-Kitapları Yönetin.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white dark:text-gray-500">Tüm platform tek yönetim panelinde.</div>
                </div>
            </div>
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Giriş Yap
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Hesabınıza giriş yapın.</div>


                    <form method="post" action="{{ route('auth.do-login') }}">
                        @csrf
                        <div class="intro-x mt-8">
                            <label>
                                <input type="email" name="email" class="intro-x login__input input input--lg border border-gray-300 block" value="{{ old('email') }}" placeholder="E-Posta Adresi">
                            </label>
                            <label>
                                <input type="password" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Parola">
                            </label>
                        </div>


                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="button button--lg w-full xl:w-120 text-white bg-theme-1 xl:mr-3 align-top">Giriş Yap</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@push('page.styles')
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
@endpush

@push('page.scripts')
    <script src="{{ asset('dist/js/app.js') }}"></script>
@endpush
