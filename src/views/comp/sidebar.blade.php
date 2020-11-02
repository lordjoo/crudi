@php
$menu_file = config('menu_dir_oath').'/base.php';
if (file_exists($menu_file)){
    $menu = require_once $menu_file;
} else {
    $menu = [];
}
@endphp
<!-- Sidebar -->
<div id="side-nav" class="sidebar-fixed position-fixed p-md-3 p-0">

    <a class="logo-wrapper waves-effect p-0">
        <img style="max-height: 105px;width: 100%" src="{{asset('img/logo.png')}}" class="img-fluid" alt="">
    </a>

    <div class="list-group list-group-flush">
        @foreach($menu as $item)
            <a href="{{ $item['route'] }}"
               class="list-group-item {{ activeMenuItem($item['active_on']) }} waves-effect">
                <i class="{{ $item['icon'] }} mr-3"></i> {{ $item['title'] }}
            </a>
        @endforeach
    </div>

</div>
<!-- Sidebar -->
