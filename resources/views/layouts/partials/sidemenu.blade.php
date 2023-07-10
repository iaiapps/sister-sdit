@php
    $base = Auth::user();
    $name = $base->name;
    $role = $base->role->name;
    $avatar = Avatar::create(Str::upper($name))->toBase64();
    $date = \Carbon\Carbon::now()->format('d-m-Y');
    // $id_teacher = Teacher::where('teacher_id', $base->id)->get();
    // $id_teacher = $teacher;
@endphp
{{-- @dd($teacher->id) --}}
<aside id="sidebar" class="position-fixed mb-3 rounded bg-white d-none d-sm-block shadow m-3">
    <div id="avatar" class="text-center py-sm-2">
        <img src="{{ $avatar }}" class="my-2 border border-light border-5 rounded-circle" alt="avatar pic" />
        <p class="mb-0 d-none d-sm-block text-capitalize">
            {{ $name }}
        </p>
    </div>
    <hr class="m-0" />

    <ul id="menu" class="nav flex-column px-2 mt-2 pb-2 navbar-nav-scroll bg-white">

        @switch($role)
            @case('Admin')
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-house-door menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-person-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Data Guru/Tendik </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('student.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-people menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Data siswa </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-ui-checks-grid menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Kelola Kelas </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('presence.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-calendar-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Presensi </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('salary.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-coin menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Rekap Gaji </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-person menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Master User </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('school.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-buildings menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">School</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setting.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-gear menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Setting Aplikasi </span>
                    </a>
                </li>
            @break

            @case('Guru/Tendik')
                {{-- menu guru --}}
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start d-block">
                        <i class="bi bi-activity menu-icon"></i>
                        <span class="ms-md-2 d-none d-sm-inline"> Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile') }}"
                        class="nav-link hover d-block text-success py-1 rounded-1 text-center text-sm-start ">
                        <i class="bi bi-person menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Profil </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-card-image menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Dokumen </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('presence.show', [$teacher->id, 'date' => $date]) }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-calendar-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Presensi </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('salary.show', [$teacher->id, 'date' => $date]) }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-coin menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Gaji </span>
                    </a>
                </li>
            @break

            @case('Siswa')
                {{-- menu guru --}}
                <li class="nav-item">
                    <p class="text-center">siswa</p>
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start d-block">
                        <i class="bi bi-activity menu-icon"></i>
                        <span class="ms-md-2 d-none d-sm-inline"> Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('student.profile') }}"
                        class="nav-link hover d-block text-success py-1 rounded-1 text-center text-sm-start ">
                        <i class="bi bi-person menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Profil Siswa </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link hover d-block text-success py-1 rounded-1 text-center text-sm-start ">
                        <i class="bi bi-123 menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> Data SPP </span>
                    </a>
                </li>
            @break

            @case('Keuangan')
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-house-door menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Home </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('presence.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-calendar-check menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Presensi </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('salary.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-coin menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Rekap Gaji </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setting.index') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-gear menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline">Setting Aplikasi </span>
                    </a>
                </li>
            @break

            @default
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link hover text-success py-1 rounded-1 text-center text-sm-start">
                        <i class="bi bi-house-door menu-icon"></i>
                        <span class="ms-2 d-none d-sm-inline"> home </span>
                    </a>
                </li>
        @endswitch
    </ul>
    <hr class="m-0">
    <small class=" d-block p-1 my-1 text-center position-absolute bottom-0 start-50 translate-middle-x">App
        version
        1.1.0</small>
</aside>
