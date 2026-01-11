<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('profile.index', ['id' => auth()->id()]) }}"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="{{ route('profile.index', ['id' => auth()->id()]) }}" class='sidebar-hide d-xl-none d-block'><i class='bi bi-x bi-middle'></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Menu</li>

                <li class="sidebar-item active ">
                    <a href="/" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Data</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('kategori.index') }}" class='submenu-link'>
                                <i class="bi bi-tags"></i>
                                Kategoriler
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('film.index') }}" class='submenu-link'>
                                <i class="bi bi-film"></i>
                                Films
                            </a>
                        </li>
                    </ul>
                </li>


                <li class='sidebar-title'>Forms &amp; Tables</li>

                <li class="sidebar-item  ">
                    <a href="{{ route('user.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
