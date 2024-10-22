@extends('doctor.dashboard')
@section('content')
    <div class="conatiner p-4">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Patient Record</h1>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="mb-0">Patient Information</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" class="form-control create-account-controls"
                                    value="{{$other->first_name." ".$other->father_name." ".$other->grand_father_name}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="text" id="age" class="form-control create-account-controls"
                                value="{{ \Carbon\Carbon::parse($other->date_of_birth)->age }}" readonly>


                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <input type="text" id="gender" class="form-control create-account-controls"
                                    value="{{$other->gender==="M"?"Male":"Female"}}" readonly>

                            </div>
                            <div class="form-group">
                                <label for="bloodPressure">Blood Pressure:</label>
                                <input type="text" id="bloodPressure" class="form-control create-account-controls"
                                    value="{{$history->blood_pressure}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="temperature">Temperature:</label>
                                <input type="text" id="temperature" class="form-control create-account-controls"
                                    value="{{$history->temperature}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight:</label>
                                <input type="text" id="weight" class="form-control create-account-controls"
                                    value="{{$history->weight}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="heartRate">Heart Rate:</label>
                                <input type="text" id="heartRate" class="form-control create-account-controls"
                                    value="{{$history->heart_rate}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="card firstCard">
                        <div class="card-header">
                            <h2 class="mb-0"> Observation History</h2>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="observation">Observation:</label>
                                <textarea id="observation" name="observation" class="form-control create-account-controls text-start" rows="5" required
                                    readonly>
                                    {{ $history->details }}

                                    </textarea>
                            </div>


                        </div>
                        <div class="mt-4 buttn-container">
                            <h2 class="text-center">Laboratory results</h2>
                            <div class="form-group my-lab">

                                <div class="overflow-x-auto">
                                    <table border="1" style="border-collapse:collapse;"
                                        class="table-container-lab table-lab">
                                        <tr class="table-header">
                                            <th class="border">No.</th>
                                            <th class="border">Test type</th>
                                            <th class="border">Result</th>
                                            <th class="border">File</th>


                                        </tr>
                                        @foreach($labRequests as $key=>$lab)
                                        <tr class="table-body">
                                            <td class="border-black">{{$key+1}}</td>
                                            <td class="border-black">{{$lab->test_type}}</td>
                                            <td class="border-black">{{$lab->result?? "Not available"}}</td>
                                            <td class="border-black">
                                            @if($lab->file)
                                            <!-- Button is enabled with file link -->
                                            <a href="{{ Storage::url($lab->file) }}"
                                               download="{{ basename(Storage::url($lab->file)) }}"
                                               class="btn btn-primary btn-blue my-2">
                                                View
                                            </a>
                                        @else
                                            <!-- Button is disabled -->
                                            <a href="#" class="btn btn-primary btn-blue my-2 disabled">View</a>
                                        @endif
                                        </td>




                                        </tr>
                                        @endforeach

                                    </table>
                                </div>

                            </div>
                            <div class="form-group">
                                <span for="medicine" class="text-center mx-4">Medicine:</span>
                                <input type="text" id="medicine" name="medicine"
                                    class="create-account-controls-2"   value="{{ $history->medicine }}" readonly>
                            </div>


                            <div class="form-group">
                                <span for="referral" class="text-center mx-4">Hospital Referred:</span>
                                <input type="text" id="referral" name="referral"
                                    class="create-account-controls-2 mx-2"   value="{{ $history->referral }}" readonly>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endSection
