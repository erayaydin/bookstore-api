<nav class="side-nav">
    <a href="{{ route('dashboard.index') }}" class="intro-x flex items-center pt-4">
                <span class="hidden xl:block text-white  ml-3" style="font-size: 1.65rem"> Book<span
                        class="font-medium">Store</span>
                </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('dashboard.index') }}" class="side-menu {{ (request()->is('/')) ? 'side-dashboard--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title"> Anasayfa</div>
            </a>
        </li>
        <li>
            <a href="{{ route('category.index') }}" class="side-menu {{ (request()->is('category*')) ? 'side-dashboard--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="edit"></i></div>
                <div class="side-menu__title"> Kategoriler</div>
            </a>
        </li>
        <li>
            <a href="{{ route('publisher.index') }}" class="side-menu {{ (request()->is('publisher*')) ? 'side-dashboard--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="edit"></i></div>
                <div class="side-menu__title"> Yayınevleri</div>
            </a>
        </li>
        <li>
            <a href="{{ route('author.index') }}" class="side-menu {{ (request()->is('author*')) ? 'side-dashboard--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="edit"></i></div>
                <div class="side-menu__title"> Yazarlar</div>
            </a>
        </li>
        <li>
            <a href="{{ route('book.index') }}" class="side-menu {{ (request()->is('book*')) ? 'side-dashboard--active' : '' }}">
                <div class="side-menu__icon"><i data-feather="edit"></i></div>
                <div class="side-menu__title"> Kitaplar</div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>
    </ul>
</nav>
