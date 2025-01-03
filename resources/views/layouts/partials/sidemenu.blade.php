@php
    $user = Auth::user();

    if ($user->hasRole('admin')) {
        $name = $user->name;
    } else {
        if ($user->teacher->full_name == 'user') {
            $name = $user->name;
        } else {
            $name = $user->teacher->full_name;
        }
    }

    $role = $user->getRoleNames()->first();
    $avatar = Avatar::create(Str::upper($name))->toBase64();
    $date = \Carbon\Carbon::now()->format('d-m-Y');
@endphp
<aside id="sidebar" class="position-fixed mb-3 rounded bg-white d-none d-sm-block shadow m-3 position-relative">
    <div id="avatar" class="text-center py-sm-2">
        <img src="{{ $avatar }}" class="my-2 border border-light border-5 rounded-circle" alt="avatar pic" />
        <p class="mb-0 d-none d-sm-block text-capitalize">
            {{ $name }}
        </p>
    </div>
    <hr class="m-0" />
    <ul id="menu" class="nav flex-column px-2 mt-2 pb-2 navbar-nav-scroll bg-white pb-5">
        @switch($role)
            @case('admin')
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'home' ? 'activee' : '' }} ">
                        <i class="bi bi-house-door menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.teacher.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'admin.teacher.index' ? 'activee' : '' }}">
                        <i class="bi bi-person-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Data Guru/Tendik</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.karyawan.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'admin.tendik.index' ? 'activee' : '' }}">
                        <i class="bi bi-person-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Data Karyawan</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('student.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'teacher.index' ? 'activee' : '' }}">
                        <i class="bi bi-people menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Data siswa </span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="#"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'teacher.index' ? 'activee' : '' }}">
                        <i class="bi bi-ui-checks-grid menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Kelola Kelas </span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('presence.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'admin.presence.index' ? 'activee' : '' }}">
                        <i class="bi bi-calendar-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Presensi </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('presencekaryawan.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'presencekaryawan.index' ? 'activee' : '' }}">
                        <i class="bi bi-calendar-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Presensi Karyawan </span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('salary.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'salary.index' ? 'activee' : '' }}">
                        <i class="bi bi-coin menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Rekap Gaji </span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('mutabaah.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'mutabaah.index' ? 'activee' : '' }}">
                        <i class="bi bi-list-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Mutabaah </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bpi.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'bpi.index' ? 'activee' : '' }}">
                        <i class="bi bi-bar-chart menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">BPI </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('replacement.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'replacement.index' ? 'activee' : '' }}">
                        <i class="bi bi-people menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Guru Pengganti</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'user.index' ? 'activee' : '' }}">
                        <i class="bi bi-person menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Master User </span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.school.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'school.index' ? 'activee' : '' }}">
                        <i class="bi bi-buildings menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">School</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('admin.setting.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'setting.index' ? 'activee' : '' }}">
                        <i class="bi bi-gear menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Setting Aplikasi </span>
                    </a>
                </li>
            @break

            @case('guru')
            @case('tendik')
                {{-- menu guru --}}
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'home' ? 'activee' : '' }} d-block">
                        <i class="bi bi-activity menu-icon"></i>
                        <span class="ms-md-2 d-none d-sm-inline"> Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.profile') }}"
                        class="nav-link hover d-block text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'profile' ? 'activee' : '' }} ">
                        <i class="bi bi-person menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Profil </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('document.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'document.index' ? 'activee' : '' }}">
                        <i class="bi bi-card-image menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Dokumen </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.teacher.presence') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'guru.teacher.presence' ? 'activee' : '' }}">
                        <i class="bi bi-calendar-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Presensi </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.answer.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'guru.answer.index' ? 'activee' : '' }}">
                        <i class="bi bi-list-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Mutabaah </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.bpi.list') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'guru.bpi.list' ? 'activee' : '' }}">
                        <i class="bi bi-bar-chart menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Bpi </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.replacement.list') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'guru.replacement.list' ? 'activee' : '' }}">
                        <i class="bi bi-people menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Guru Pengganti</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('teacher.salary') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'teacher.index' ? 'activee' : '' }}">
                        <i class="bi bi-coin menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Gaji </span>
                    </a>
                </li> --}}
            @break

            @case('karyawan')
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'home' ? 'activee' : '' }} d-block">
                        <i class="bi bi-activity menu-icon"></i>
                        <span class="ms-md-2 d-none d-sm-inline"> Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.profile') }}"
                        class="nav-link hover d-block text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'profile' ? 'activee' : '' }} ">
                        <i class="bi bi-person menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Profil </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('document.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'document.index' ? 'activee' : '' }}">
                        <i class="bi bi-card-image menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Dokumen </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.teacher.presence') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'guru.teacher.presence' ? 'activee' : '' }}">
                        <i class="bi bi-calendar-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Presensi </span>
                    </a>
                </li>
            @break

            {{-- @case('siswa')
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'teacher.index' ? 'activee' : '' }} d-block">
                        <i class="bi bi-activity menu-icon"></i>
                        <span class="ms-md-2 d-none d-sm-inline"> Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.profile') }}"
                        class="nav-link hover d-block text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'teacher.index' ? 'activee' : '' }} ">
                        <i class="bi bi-person menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Profil Siswa </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('document.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'teacher.index' ? 'activee' : '' }}">
                        <i class="bi bi-card-image menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Dokumen </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link hover d-block text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'teacher.index' ? 'activee' : '' }} ">
                        <i class="bi bi-123 menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Data SPP </span>
                    </a>
                </li>
            @break --}}
            {{-- @case('Keuangan')
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'home' ? 'activee' : '' }}">
                        <i class="bi bi-house-door menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('presence.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'presence.index' ? 'activee' : '' }}">
                        <i class="bi bi-calendar-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Presensi </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('salary.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'salary.index' ? 'activee' : '' }}">
                        <i class="bi bi-coin menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Rekap Gaji </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setting.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'setting.index' ? 'activee' : '' }}">
                        <i class="bi bi-gear menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Setting Aplikasi </span>
                    </a>
                </li>
            @break --}}

            @default
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start {{ Route::currentRouteName() == 'home' ? 'activee' : '' }}">
                        <i class="bi bi-house-door menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Home </span>
                    </a>
                </li>
        @endswitch
    </ul>
    <div class="w-100 bg-white py-1 position-absolute bottom-0 start-50 translate-middle-x rounded">
        <hr class="my-1">
        <small class="d-block text-center mb-1">App
            version
            1.3.0</small>
    </div>
</aside>
