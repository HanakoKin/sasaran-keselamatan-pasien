<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">

                    {{-- Dashboard --}}
                    <li class="{{ Request::is('*dashboard*') ? 'active' : '' }}">
                        <a href="/dashboard">
                            <i class="fal fa-tasks-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @if(Auth::user()->role === 'admin')
                    {{-- User --}}
                    <li class="treeview {{ Request::is('*admin*') ? 'active menu-open' : '' }}">
                        <a href="#">
                            <i class="fal fa-user"></i>
                            <span>User</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('*admin') || Request::is('*admin/*') ? 'active' : '' }}"><a
                                    href="{{ route('users') }}"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Kelola Data user</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    {{-- Lapin --}}
                    <li class="treeview {{ Request::is('*lapin*') ? 'active menu-open' : '' }}">
                        <a href="#">
                            <i class="fal fa-file-medical"></i>
                            <span>Laporan Insiden</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (Auth::user()->role !== 'user')
                            <li class="{{ Request::is('*lapinTable') ? 'active' : '' }}"><a href="/lapinTable"><i
                                        class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Tabel Data Lapin</a></li>
                            @endif
                            <li class="{{ Request::is('*lapin') || Request::is('*lapin/*') ? 'active' : '' }}"><a
                                    href="/lapin"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Kelola Data lapin</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Laporan KPC --}}
                    <li class="treeview {{ Request::is('*lapkpc*') ? 'active menu-open' : '' }}">
                        <a href="#">
                            <i class="fal fa-file-medical-alt"></i>
                            <span>Laporan KPCS</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (Auth::user()->role !== 'user')
                            <li class="{{ Request::is('*lapkpcTable') ? 'active' : '' }}"><a href="/lapkpcTable"><i
                                        class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Tabel Data KPCS</a></li>
                            @endif
                            <li class="{{ Request::is('*lapkpc') || Request::is('*lapkpc/*') ? 'active' : '' }}"><a
                                    href="/lapkpc"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Kelola
                                    Data KPCS</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Lembar Investigasi Sederhana --}}
                    <li class="treeview {{ Request::is('*lemkis*') ? 'active menu-open' : '' }}">
                        <a href="#">
                            <i class="fal fa-file-invoice"></i>
                            <span>Lembar Investigasi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (Auth::user()->role !== 'user')
                            <li class="{{ Request::is('*lemkisTable') ? 'active' : '' }}"><a href="/lemkisTable"><i
                                        class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Tabel Data LEMKIS</a></li>
                            @endif
                            <li class="{{ Request::is('*lemkis') || Request::is('*lemkis/*') ? 'active' : '' }}"><a
                                    href="/lemkis"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Kelola Data LEMKIS</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </section>
    <div class="sidebar-footer">
        <a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Settings"><span
                class="icon-Settings-2"></span></a>
        <a href="mailbox.html" class="link" data-bs-toggle="tooltip" title="Email"><span class="icon-Mail"></span></a>
        <a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Logout"><span
                class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
    </div>
</aside>
