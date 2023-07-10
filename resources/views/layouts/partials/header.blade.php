<nav id="nav" class="position-fixed">
    <div class="d-flex mx-3 py-md-0 py-3 bg-white rounded align-items-center shadow">
        <div class="judull rounded text-uppercase d-sm-flex py-3 px-3 bg-light d-none">
            <img src="{{ asset('img/logo.svg') }}" class="dashboardlogo" alt="logo" />
            <h3 class="ms-3 mb-0 d-none d-sm-block">sister sdit</h3>
        </div>
        <div class="flex-grow-1 mx-3">
            <div class="float-start">
                <button id="buttonSidebar" class="btn btn-success btn-sm hover bg-light text-success rounded fs-5">
                    <i class="bi bi-columns-gap"></i>
                </button>
            </div>
            <div class="float-end d-flex">
                <div class="d-none d-sm-block bg-light py-1 py-sm-2 px-2 px-sm-3 mx-3 mx-sm-3 rounded lh-md">
                    <span id="jam" class="fw-bold"> hari </span>
                </div>
                <div class="dropdown me-3">
                    <button class="btn btn-success btn-sm hover bg-light text-success rounded fs-5" type="button"
                        data-bs-toggle="dropdown" data-bs-toggle="dropdown" id="dropdownmenu" aria-expanded="false">
                        <i class="bi bi-envelope"></i>
                    </button>

                    <div class="dropdown-menu shadow p-3 mt-3 rounded border border-0" aria-labelledby="dropdownmenu">
                        <div class="text-center">
                            <i class="las la-paper-plane la-4x text-success"></i>
                            <p class="text-center mb-3">Pusat Informasi</p>
                            <a href="https://wa.me/6287870783030" target="_blank"
                                class="btn btn-outline-success w-100 mb-3">Call Center Humas</a>
                            <a href="https://wa.me/6285746507030" target="_blank"
                                class="btn btn-outline-success w-100 mb-3">Call Center Keuangan</a>
                            <a href="https://wa.me/6285232213939" target="_blank"
                                class="btn btn-outline-success w-100 mb-3">Call Center Admin</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-success btn-sm hover bg-light text-success rounded fs-5" type="button"
                        data-bs-toggle="dropdown" data-bs-toggle="dropdown" id="dropdownmenu" aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </button>

                    <div class="dropdown-menu shadow p-3 mt-3 rounded border border-0" aria-labelledby="dropdownmenu">
                        <div class="text-center">
                            <i class="las la-user-circle la-4x text-success"></i>
                            <p class="text-center mb-3">Pengaturan Akun</p>
                            <a href="/change-password" class="btn btn-outline-success mb-3 w-100">
                                Ganti Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="btn btn-danger me-3">logout</button>
        </form>

    </div>
</nav>

@push('scripts')
    <script src="{{ asset('js/time.js') }}"></script>
@endpush
