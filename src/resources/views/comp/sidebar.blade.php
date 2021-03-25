@php
$menu_file = config('crudi.menu_dir_path').'/base.php';
if (file_exists($menu_file)) {
    $menu = require_once $menu_file;
} else {
    $menu = [];
}
@endphp
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="c-sidebar-brand-full">
            <img src="{{ config('crudi.logo_path') }}" height="46" alt="Logo">
        </div>
    </div>
    <ul class="c-sidebar-nav">
        @foreach($menu as $item)

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link {{ activeMenuItem($item['active_on']) }}"
                   href="{{ $item['route'] }}">
                    <i class="c-sidebar-nav-icon {{ $item['icon'] }} {{ config('crudi.is_rtl',false)?'mr-1':"ml-1" }}"></i> {{ $item['title'] }}
                </a>
            </li>
        @endforeach

        <!-- TODO: Support DropDown -->
{{--        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">--}}
{{--            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                Base--}}
{{--            </a>--}}
{{--            <ul class="c-sidebar-nav-dropdown-items">--}}
{{--                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><span--}}
{{--                            class="c-sidebar-nav-icon"></span> Breadcrumb</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
    </ul>
</div>
<!-- Sidebar -->
