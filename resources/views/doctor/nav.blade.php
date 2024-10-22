<nav class="navbar navbar-expand-lg my-nav border-bottom border-bottom-dark " data-bs-theme="dark">
    <a class="navbar-brand btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        <i class="fa-solid fa-bars"></i>
    </a>
    <div class="container">
        <a class="navbar-brand fw-light" href="#"><span class="fa-regular fa-hospital me-1"></span>{{ config('app.name') }}</a>
        <button class="navbar-toggler ms-4" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="ms-4 collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item text-with-line my-name">
                    <span class="nav-label">Hi, {{$user->first_name." ".$user->father_name." ".$user->grand_father_name}}!</span>
                    <hr class="line hr-collapse">
                </li>
                <li class="nav-item text-with-line ">
                    <a class="nav-link  {{ Request::is('doctor/triage/*') ? 'active' : '' }}" href="{{route('doctor.triage-list', $user)}}">Triage</a>

                </li>
                <li class="nav-item text-with-line">
                    <a class="nav-link {{ Request::is('doctor/patients/*') ? 'active' : '' }}" href="{{route('doctor.patient-list', $user)}}">Patients</a>


                </li>
            </ul>
        </div>
    </div>
</nav>
