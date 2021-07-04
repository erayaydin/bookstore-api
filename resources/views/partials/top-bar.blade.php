<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="{{ route('dashboard.index') }}">Yönetim Paneli</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        @stack("breadcrumbs")
    </div>

    <div class="intro-x dropdown w-8 h-8" >
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            <img alt="{{ auth()->user()->name }}" src="{{ asset('dist/images/profile-1.jpg')}}">
        </div>
        <div class="dropdown-box w-56" style="position: absolute;right: 0;top: 40px">
            <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                    <div class="font-medium">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-theme-41 dark:text-gray-600">Yönetici</div>
                </div>
                <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                    <a href="{{ route('auth.logout') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Çıkış </a>
                </div>
            </div>
        </div>

    </div>
    <!-- END: Account Menu -->
</div>
