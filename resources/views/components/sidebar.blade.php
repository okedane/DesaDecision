<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active d-flex flex-column h-100">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="/dashboard-admin"></a>
                </div>
                <div class="toggler">
                    <a href="/dashboard-admin" class='sidebar-hide d-xl-none d-block'><i class='bi bi-x bi-middle'></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu flex-grow-1 d-flex flex-column">
            <ul class="menu d-flex flex-column h-100">
                <li class='sidebar-title'>Menu</li>


                @if(auth()->user()?->role === 'admin')
                <li class="sidebar-item active ">
                    <a href="/dashboard-admin" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('pelamar.index') }}" class='submenu-link'>
                                <i class="bi bi-person-fill"></i>
                                Data Pelamar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pendaftaran.index') }}" class='submenu-link'>
                                <i class="bi bi-file-earmark-check"></i>
                                Status Pendaftaran  
                            </a>
                        </li>
                    </ul>
                </li>
                </li>
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-graph-up"></i>
                        <span>Topsis</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="/kriteria" class='submenu-link'>
                                <i class="bi bi-list-check"></i>
                                Kriteria
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('penilaian.index') }}" class='submenu-link'>
                                <i class="bi bi-clipboard-data"></i>
                                Penilaian
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('topsis.index') }}" class='submenu-link'>
                                <i class="bi bi-calculator"></i>
                                Perhitungan
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('hasil.index') }}" class='submenu-link'>
                                <i class="bi bi-check-circle"></i>
                                Hasil
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Users</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="/user" class='submenu-link'>
                                <i class="bi bi-shield-lock"></i>
                                Admin
                            </a>
                        </li>
                        <li>
                            <a href="/user" class='submenu-link'>
                                <i class="bi bi-person-check"></i>
                                Users
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class='sidebar-title'>Other</li>
                <li class="sidebar-item  ">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Logout</span>
                    </a>
                </li> -->
                @endif

                @if(auth()->user()?->role === 'pelamar')
                <li class="sidebar-item active ">
                    <a href="/dashboard-pelamar" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class='sidebar-title'>Other</li>

                <li class="sidebar-item  ">
                    <a href="/pelamar" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Data Pelamar</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="/berkas" class='sidebar-link'>
                        <i class="bi bi-file-earmark-check"></i>
                        <span>Berkas</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="{{ route('hasil-seleksi.index') }}" class='sidebar-link'>
                        <i class="bi bi-check-circle"></i>
                        <span>Hasil</span>
                    </a>
                </li>



                @endif

                <li class="sidebar-item mt-auto">
                    <form action="{{ route('logout') }}" method="POST" class="w-100">
                        @csrf
                        <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>