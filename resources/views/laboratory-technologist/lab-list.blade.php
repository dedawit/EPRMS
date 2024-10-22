@extends('laboratory-technologist.dashboard')
@section('content')

    <div class="container p-4">
        <div class="row">
            @include('success-message')
        </div>
        <div class="row">

            <div class="row mb-2">
                <form action="" method='GET' class="mt-2 searcher">
                    <input placeholder="...
                " class="form-control w-100 mx-2 d-block" type="text"
                        name="search">
                    <button class="btn btn-primary mx-2 d-block"> Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="overflow-x-auto">
            <table border="1" style="border-collapse:collapse;" class="table-container">
                <tr class="table-header" >
                    <th class="border">No.</th>
                    <th class="border">Full Name</th>
                    <th class="border">Date of Birth</th>
                    <th class="border">Test type</th>
                    <th class="border"> View</th>

                </tr>
                @foreach($others as $key=>$other)
                <tr class="table-body" >
                    <td class="border-black">{{$key+1}}</td>
                    <td class="border-black">{{$other->first_name." ".$other->father_name." ".$other->grand_father_name}}</td>
                    <td class="border-black">{{$other->date_of_birth}}</td>
                    <td class="border-black">{{$other->test_type}}</td>
                    <td class="border-black"> <a href="{{route('lab.patient', [$user->id, $other->id])}}" class="btn btn-primary btn-blue my-2 ">View</a></td>

                </tr>
                @endforeach


            </table>
            </div>
            <div class="my-2">

            </div>
        </div>
    </div>
@endSection
