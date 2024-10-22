@extends('receptionist.dashboard')
@section('content')

    <div class="container p-4">
        <div class="row">
            @include('success-message')
        </div>
        <div class="row">

            <div class="row mb-2">
                <form action="{{route('receptionist.patient-list', $user->id)}}" method='GET' class="mt-2 searcher">
                    <input placeholder="...
                " class="form-control w-100 mx-2 d-block" type="text"
                        name="search">
                    <button class="btn btn-primary mx-2 d-block"> Search</button>
                </form>
            </div>
            <a href="{{route('receptionist.show-patient', $user)}}" class="btn btn-primary max-40">+ Create Account</a>
        </div>
        <div class="row">
            <div class="overflow-x-auto">
            <table border="1" style="border-collapse:collapse;" class="table-container">
                <tr class="table-header" >
                    <th class="border">No.</th>
                    <th class="border">Full Name</th>
                    <th class="border">Date of Birth</th>
                    <th class="border">Date of Registration</th>
                    <th class="border">Phone</th>
                    <th class="border"> Edit</th>
                    <th class="border"> Send To Triage</th>
                </tr>
                @foreach($patients as $key=>$other)
                <tr class="table-body" >

                    <td class="border-black">{{$key+1}}</td>
                    <td class="border-black">{{$other->first_name." ".$other->father_name." ".$other->grand_father_name}}</td>
                    <td class="border-black">{{$other->date_of_birth}}</td>
                    <td class="border-black">{{$other->created_at->format('Y-m-d')}}</td>
                    <td class="border-black">{{$other->phone}}</td>
                    <td class="border-black">
                        <a href="{{route('receptionist.edit-patient', [$user->id, $other->id])}}" class="btn btn-primary btn-blue my-2 mx-2">Edit</a>
                    </td>
                    <td class="border-black">


                        @if (!$other->position)
                        <form action="{{ route('receptionist.send', [$user->id, $other->id]) }}" method="POST">
                            @csrf
                            @method('put')
                        <button class="btn btn-primary btn-blue my-2">Send</button>
                        </form>
                    @else
                        <button class="btn btn-primary btn-blue my-2" disabled style="background-color: grey;">Send</button>
                    @endif
                    </td>

                </tr>
                @endforeach


            </table>
            </div>
            <div class="my-2">

            </div>
        </div>
    </div>
@endSection
