@extends('receptionist.dashboard')
@section('content')
    <div class="container mt-4 p-4 account-create-box">

        <div class="registration_form">
            <div class="row">
                @include('success-message')
            </div>

            <h3 class="text-center">Edit Patient Account </h3>
            <form action="{{route('receptionist.update-patient', [$user->id, $other->id])}}" method="POST">
                @csrf
                @method('put')


                <div class="form-group">

                    <label for="fname">First Name:</label>
                    <input type="text" id="fname" class="create-account-controls" name="fname" value="{{ $other->first_name ?? '' }}">

                    @error('fname')
                        <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                    @enderror

                    <div class=" ">
                        <label for="lname">Father Name:</label>
                        <input type="text" id="lname" name="lname" class="create-account-controls" value="{{ $other->father_name ?? '' }}">

                        @error('lname')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" ">
                        <label for="gname">Grand Father Name:</label>
                        <input type="text" id="gname" name="gname" class="create-account-controls" value="{{ $other->grand_father_name ?? '' }}">

                        @error('gname')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="">

                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" class="create-account-controls" value="{{ $other->date_of_birth ?? '' }}">

                            @error('dob')
                                <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="">
                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" class="create-account-controls">

                            <option value="M" {{ $other->gender == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ $other->gender == 'F' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="region">Region:</label>
                        <input type="text" id="region" name="region" class="create-account-controls" value="{{ $other->region ?? '' }}">

                        @error('region')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <label for="zone">Zone:</label>
                        <input type="text" id="zone" name="zone" class="create-account-controls" value="{{ $other->zone ?? '' }}">

                        @error('zone')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="">
                        <label for="woreda">Woreda/Sub-city:</label>
                        <input type="text" id="woreda" name="woreda" class="create-account-controls" value="{{ $other->woreda ?? '' }}">

                        @error('woreda')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <label for="woreda">Ketena/Goot:</label>
                        <input type="text" id="woreda" name="ketena" class="create-account-controls" value="{{ $other->ketena ?? '' }}">

                        @error('ketena')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <label for="house">Kebele:</label>
                        <input type="text" id="kebele" name="kebele" class="create-account-controls" value="{{ $other->kebele ?? '' }}">

                        @error('kebele')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <label for="house">House Number:</label>
                        <input type="text" id="house" name="house_number" class="create-account-controls" value="{{ $other->house_number ?? '' }}">

                        @error('house_number')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" class="create-account-controls" value="{{ $other->phone ?? '' }}">

                    @error('phone')
                        <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                    @enderror
                </div>


                {{-- <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="create-account-controls" value="{{ $other->email ?? '' }}">

                    @error('email')
                        <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                    @enderror
                </div> --}}

                <div class="form-group">
                    <div class="">
                        <label for="emergency-name">Emergency Contact Name:</label>
                        <input type="text" id="emergency-name" name="emergency_name" class="create-account-controls" value="{{ $other->emergency_name ?? '' }}">

                        @error('emergency_name')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="">
                        <label for="emergency-phone">Emergency Contact Phone:</label>
                        <input type="tel" id="emergency-phone" name="emergency_phone" class="create-account-controls" value="{{ $other->emergency_phone ?? '' }}">

                        @error('emergency_phone')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Save</button>
            </form>



        </div>

    </div>



@endSection
