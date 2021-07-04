@extends('layout.page')

@section('page.title', 'Yönetim Paneli')

@push("breadcrumbs")
    <a href="{{ route('dashboard.index') }}" class="breadcrumb--active">Pano</a>
@endpush

@section('page.contents')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Genel Rapor
                    </h2>
                    <a href="" class="ml-auto flex text-theme-1 dark:text-theme-10"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Veriyi Güncelle </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i>
                                    <div class="ml-auto">
                                        @include("partials.report-box", ["increase" => $bookSellIncrease])
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $bookSell }}</div>
                                <div class="text-base text-gray-600 mt-1">Kitap Satışı</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                                    <div class="ml-auto">
                                        @include("partials.report-box", ["increase" => $suggestIncrease])
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $suggest }}</div>
                                <div class="text-base text-gray-600 mt-1">Kitap Önerisi</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-theme-12"></i>
                                    <div class="ml-auto">
                                        @include("partials.report-box", ["increase" => $totalBookIncrease])
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $totalBook }}</div>
                                <div class="text-base text-gray-600 mt-1">Toplam Kitap</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-9"></i>
                                    <div class="ml-auto">
                                        @include("partials.report-box", ["increase" => $totalSessionIncrease])
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $totalSession }}</div>
                                <div class="text-base text-gray-600 mt-1">Kullanıcı Oturumu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
            <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                <!-- BEGIN: Transactions -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Son Aktif 5 Kullanıcı
                        </h2>
                    </div>
                    <div class="mt-5">
                        @foreach($latestUsers as $latestUser)
                        <div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="{{ $latestUser->name }}" src="dist/images/profile-4.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">{{ $latestUser->name }}</div>
                                    <div class="text-gray-600 text-xs">{{ $latestUser->last_login_at?->format("d F Y / H:i") }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
