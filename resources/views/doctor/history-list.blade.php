@extends('doctor.dashboard')
@section('content')

    <div class="container p-4">
        <div class="row">
            @include('success-message')
        </div>
        <div class="row">

            <div class="row mb-2">

            </div>
        </div>
        <div class="row">
            <div class="overflow-x-auto">
            <table border="1" style="border-collapse:collapse;" class="table-container">
                <tr class="table-header" >
                    <th class="border">No.</th>
                    <th class="border">Date of History</th>
                    <th class="border">Temperature</th>
                    <th class="border">Blood Pressure</th>
                    <th class="border">Weight</th>
                    <th class="border"> View</th>

                </tr>
                @foreach($medicalHistories as $key=>$history)
                <tr class="table-body" >
                    <td class="border-black">{{$key+1}}</td>
                    <td class="border-black">{{$history->created_at->format('Y-m-d')}}</td>
                    <td class="border-black">{{$history->temperature}}</td>
                    <td class="border-black">{{$history->blood_pressure}}</td>
                    <td class="border-black">{{$history->weight}}</td>
                    <td class="border-black"> <a href="{{route('doctor.patient-history', [$user->id, $otherUser->id, $history->id])}}" class="btn btn-primary btn-blue my-2 ">View</a></td>

                </tr>
                @endforeach


            </table>
            </div>
            <div class="my-2">

            </div>
        </div>
    </div>
@endSection
