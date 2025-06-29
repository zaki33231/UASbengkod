@if(auth()->user()->role === 'dokter')
    <li class="nav-item">
        <a href="{{ route('dokter.dashboard') }}" class="nav-link {{ Request::is('dokter') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dokter.memeriksa') }}" class="nav-link {{ Request::is('dokter/memeriksa*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-stethoscope"></i>
            <p>Periksa Pasien</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dokter.riwayat-pasien') }}"
            class="nav-link {{ Request::is('dokter/riwayat-pasien*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i>
            <p>Riwayat Pasien</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dokter.jadwal-periksa.index') }}"
            class="nav-link {{ Request::is('dokter/jadwal-periksa*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>Jadwal Periksa</p>
        </a>
    </li>
@endif
@if(auth()->user()->role === 'admin')
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.pasien.index') }}" class="nav-link {{ Request::is('admin/pasien*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Kelola Pasien</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.dokter.index') }}" class="nav-link {{ Request::is('admin/dokter*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-md"></i>
            <p>Kelola Dokter</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.poli.index') }}" class="nav-link {{ Request::is('admin/poli*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-hospital"></i>
            <p>Kelola Poli</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.obat.index') }}" class="nav-link {{ Request::is('admin/obat*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-pills"></i>
            <p>Kelola Obat</p>
        </a>
    </li>
@endif