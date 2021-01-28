
<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            Dashboard
        </a>


        <!-- Links -->
        <div class="d-flex align-items-center" id="basicExampleNav">
            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons  align-items-center">
                <li class="nav-item avatar dropdown is-auth">
                    <a class="nav-link dropdown-toggle d-flex align-items-center " id="navbarDropdownMenuLink-55" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 account-name d-md-block d-none" id="account-name">{{ auth()->user()->name }}</span>
                        <span class="fas fa-user-circle"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md-right dropdown-menu-right dropdown-dark"
                         aria-labelledby="navbarDropdownMenuLink-55">
                        <a onclick="document.getElementById('logout_form').submit()" class="dropdown-item">Log Out</a>
                        <form id="logout_form" method="POST" action="{{ route('admin.logout') }}">@csrf</form>
                    </div>
                </li>
            </ul>
            <!-- Collapse button -->
            <button class="navbar-toggler sideNavToggle" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>


    </div>
</nav>
<!-- Navbar -->
