<aside class="main-sidebar">
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <ul class="sidebar-menu" data-widget="tree">
                    {{-- Dashboard --}}
                    <li class="{{ Request::is('*dashboard*') ? 'active' : '' }}">
                        <a href="/dashboard">
                            <i class="fal fa-tasks-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @if (Auth::user()->role === 'admin')
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
                                        href="{{ route('users') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Kelola Data
                                        user</a>
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

                    {{-- Sensus Harian --}}
                    @php
                        $sensusItems = [
                            'admission',
                            'bank darah',
                            'EEG EMG',
                            'fisioterapi',
                            'farmasi',
                            'gizi produksi',
                            'graha utama Lt V',
                            'graha utama Lt VI',
                            'kamar operasi',
                            'klinik spesialis',
                            'laboratorium',
                            'pav ICU',
                            'pav ICU anak',
                            'pav ICCU',
                            'pav anggrek',
                            'pav cempaka',
                            'pav gladiola',
                            'pav mawar',
                            'pav melati',
                            'pav nusa indah',
                            'pav putra I',
                            'pav putra III',
                            'perina',
                            'radiologi',
                            'unit gawat darurat',
                            'unit rawat jalan',
                            'vk graha 5',
                        ];
                    @endphp

                    @if (Auth::user()->role === 'admin')
                        <li class="treeview {{ Request::is('*sensus*') ? 'active menu-open' : '' }}">
                            <a href="#">
                                <i class="fal fa-file-medical"></i>
                                <span>Sensus Harian</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>

                            <ul class="treeview-menu">

                                @foreach ($sensusItems as $item)
                                    @php
                                        $isActive = request()->is("*$item");
                                        $class = $isActive ? 'active' : '';
                                        $href = url("/sensus/$item");
                                    @endphp

                                    <li class="{{ $class }}">
                                        <a href="{{ $href }}">
                                            <i class="icon-Commit">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            {{ ucwords(str_replace('_', ' ', $item)) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        {{-- @elseif (Auth::user()->role === 'user')
                        @foreach ($sensusItems as $item)
                            @if (Auth::user()->unit === strtoupper(trans($item)))
                                @php
                                    $isActive = request()->is("*$item");
                                    $class = $isActive ? 'active' : '';
                                    $href = url("/sensus/$item");
                                @endphp
                                <li class="{{ $class }}">
                                    <a href="{{ $href }}">
                                        <i class="fal fa-file-medical"></i>
                                        <span>{{ 'Sensus ' . ucwords(str_replace('_', ' ', $item)) }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach --}}
                    @endif

                </ul>
            </div>
        </div>
    </section>
</aside>
