<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
          <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome 5 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>

    </style>


</head>

<body class="body-fill">
    @include('laboratory-technologist.nav')
    {{-- main content --}}
    <!-- Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="font-bold align-center" id="offcanvasExampleLabel">Laboratory technologist's Profile</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="circular-image me-3">
            @if ($user->profile != null)
                            <img src="{{ asset('storage/'.$user->profile) }}"  alt="my profile">
                        @else
                        <img src="{{ asset('storage/doctor.jpg') }}" alt="User">
                        @endif

        </div>
        <div class="user-info flex items-start mb-4">
            <div>
                <h5 class="font-bold text-lg mb-1">{{$user->first_name." ".$user->father_name." ".$user->grand_father_name}}</h5>
                <p class="text-gray-700 mb-1"><i class="fas fa-id-card pl-2"></i> DOB: {{$user->date_of_birth}}</p>
                <p class="text-gray-700 mb-1"><i class="fas fa-envelope pl-2"></i> Email: {{$user->email}}</p>
                <p class="text-gray-700 mb-1"><i class="fas fa-user-tie pl-2"></i> Address: {{$user->region}}</p>
                <p class="text-gray-700 mb-1"><i class="fas fa-building pl-2"></i> Phone: {{$user->phone}}</p>
                <p class="text-gray-700 mb-1"><i class="fas fa-venus-mars pl-2"></i> Gender: {{$user->gender==="M"?"Male":"Female"}}</p>
                <p class="text-gray-700 mb-1"><i class="fas fa-user-tag pl-2"></i> Role: {{$user->role}}</p>
                <div class="align-buttons">
                    <a href="{{ route('lab.show-password', $user->id) }}" class="btn btn-primary mx-2 my-2">Change Password</a>
                </div>
                <div>
                    <form action="{{ route('logout') }}" method="POST" class="my-form">
                        @csrf
                        <button type="submit" class="btn btn-danger mx-2 my-2">Logout</button>
                    </form>

                    <a href="{{route('lab.help', $user)}}" class="btn btn-success mx-2 my-2">Help</a>

                </div>
            </div>
        </div>
    </div>
</div>
    <div class="main-content">
        @yield('content')
    </div>
    <div class="mt-4"></div>



        @include('footer-main')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const offcanvasElement = document.getElementById('offcanvasExample');
            const overlay = document.getElementById('overlay');

            const toggleOverlay = (show) => {
                if (show) {
                    overlay.classList.add('show');
                    document.body.classList.add('blur');
                } else {
                    overlay.classList.remove('show');
                    document.body.classList.remove('blur');
                }
            };

            // Bootstrap offcanvas events
            offcanvasElement.addEventListener('shown.bs.offcanvas', () => toggleOverlay(true));
            offcanvasElement.addEventListener('hidden.bs.offcanvas', () => toggleOverlay(false));

            // Click on overlay to close the offcanvas
            overlay.addEventListener('click', () => {
                const offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                if (offcanvas) offcanvas.hide();
            });
        });
    </script>

</body>

</html>
