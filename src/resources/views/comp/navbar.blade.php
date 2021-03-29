@php
$menu_file = config('crudi.menu_dir_path').'/account_dropdpwn.php';
if (file_exists($menu_file)) {
    $menu = require_once $menu_file;
} else {
    $menu = [];
}
@endphp
<header class="c-header c-header-light c-header-fixed">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
        <svg class="c-icon c-icon-lg">
            <use xlink:href="{{ asset('vendor/crudi/vendors/@coreui/icons/svg/free.svg#cil-menu') }}"></use>
        </svg>
    </button>
    <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="{{ config('crudi.home_url','/admin') }}">
        {{ config('crudi.logo_path') }}
    </a>


    <ul class="c-header-nav mfs-auto">
        <li class="c-header-nav-item px-3 c-d-legacy-none">
            <button class="c-class-toggler c-header-nav-btn" type="button" id="header-tooltip" data-target="body"
                    data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom"
                    title="Toggle Light/Dark Mode">
                <span style="transform: rotateZ(10deg)" class="c-icon c-d-dark-none">
                    <span class="mdi mdi-moon-waxing-crescent mdi-24px"></span>
                </span>
                <span class="c-icon c-d-default-none">
                    <span class="mdi mdi-white-balance-sunny mdi-24px"></span>
                </span>
            </button>
        </li>
    </ul>
    <ul class="c-header-nav">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar">
                    <img class="c-avatar-img" src="{{ asset('vendor/crudi/assets/avatar.png') }}" alt="user@email.com">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>@lang("crudi::main.account")</strong></div>
                @foreach($menu as $item)
                <a class="dropdown-item" href="{{ $item['route'] }}">
                    <span class="c-icon mfe-2">
                        <span class="{{ $item['icon'] }}"></span>
                    </span>
                    {{ $item['title'] }}
                </a>
                @endforeach
            </div>
        </li>
    </ul>
</header>
