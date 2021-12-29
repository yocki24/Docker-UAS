        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
                <div class="sidebar-brand-icon">
                    @if (isset($site_settings->logo))
                    <img src="{{asset('storage/'.$site_settings->logo.'')}}" width="40" alt="">
                    @else
                    <img src="{{asset('img/logo.png')}}" width="40" alt="">
                    @endif

                </div>
                <div class="sidebar-brand-text mx-3">PILKETOS <br> OSMANUSGI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
                <a class="nav-link" href="{{route('admin.dashboard')}}">

                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                DATA USER
            </div>

            {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('admin.master.index')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Admin</span></a>
            </li> --}}

            <li class="nav-item {{ Request::segment(2) === 'teacher' ? 'active' : null }}">
                <a class="nav-link" href="{{route('admin.teacher.index')}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Guru</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item {{ Request::segment(2) === 'student' ? 'active' : null }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Siswa</span>
                </a>
                <div id="collapseTwo" class="collapse {{ Request::segment(2) === 'student' ? 'show' : null }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{route('admin.student.create')}}">Tambah Siswa</a>
                        <a class="collapse-item {{ Request::get('class') === 'x' ? 'active' : null }}" href="{{route('admin.student.index', ['class' => 'x'])}}">Kelas X</a>
                        <a class="collapse-item {{ Request::get('class') === 'xi' ? 'active' : null }}" href="{{route('admin.student.index', ['class' => 'xi'])}}">Kelas XI</a>
                        <a class="collapse-item {{ Request::get('class') === 'xii' ? 'active' : null }}" href="{{route('admin.student.index', ['class' => 'xii'])}}">Kelas XII</a>
                    </div>
                </div>
            </li>

            <div class="sidebar-heading">
                DATA KANDIDAT KETUA
            </div>

            <li class="nav-item {{ Request::segment(2) === 'candidate' ? 'active' : null }}">
                <a class="nav-link" href="{{route('admin.candidate.index')}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Kandidat</span></a>
            </li>

            <div class="sidebar-heading">
                LAPORAN
            </div>

            <li class="nav-item {{ Request::segment(2) === 'pemilih' ? 'active' : null }}">
                <a class="nav-link" href="{{route('admin.pemilih.index')}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Laporan Pemillih</span></a>
            </li>

            <li class="nav-item {{ Request::segment(2) === 'setting' ? 'active' : null }}">
                <a class="nav-link" href="{{route('admin.setting.index')}}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
