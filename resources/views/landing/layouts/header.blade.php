<nav id="nav" class="navbar navbar-expand-lg navbar-light bg-white position-fixed w-100 top-0 shadow-sm py-2">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase fs-5 d-flex align-items-center gap-2" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg') }}" class="nav-logo" alt="logo">
            SISTER SDIT
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
            aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ url('/#fitur') }}">Fitur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ url('/#download') }}">Download</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ url('/#kontak') }}">Kontak</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ url('/login') }}" class="btn btn-success px-4 rounded-pill">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
