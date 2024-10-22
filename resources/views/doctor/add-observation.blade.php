@extends('doctor.dashboard')
@section('content')
    <div class="conatiner p-4">
        <div class="container mt-5 ">
            <div class="row">
                @include('success-message')
            </div>
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
                                    value="{{ $other->first_name . ' ' . $other->father_name . ' ' . $other->grand_father_name }}"
                                    readonly>
                            </div>


                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="text" id="age" class="form-control create-account-controls"
                                    value="{{ date_diff(date_create($other->date_of_birth), date_create('today'))->y }}"
                                    readonly />

                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <input type="text" id="gender" class="form-control create-account-controls"
                                    value="{{ $other->gender === 'M' ? 'Male' : 'Female' }}" readonly>

                            </div>
                            <div class="form-group">
                                <label for="bloodPressure">Blood Pressure:</label>
                                <input type="text" id="bloodPressure" class="form-control create-account-controls"
                                    value="{{ $history->blood_pressure }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="temperature">Temperature:</label>
                                <input type="text" id="temperature" class="form-control create-account-controls"
                                    value="{{$history->temperature}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight:</label>
                                <input type="text" id="weight" class="form-control create-account-controls"
                                    value="{{ $history->weight }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="heartRate">Heart Rate:</label>
                                <input type="text" id="heartRate" class="form-control create-account-controls"
                                    value="{{ $history->heart_rate }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-md-6 ">
                <div class="card ">
                    <div class="card-header">
                        <h2 class="mb-0">Add Observation</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('doctor.add-observation', [$user->id, $other->id, $history->id])}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="observation">Observation:</label>
                                <textarea id="observation" name="observation" class="form-control create-account-controls" rows="5" required> {{ $history->details }}
                                    </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block create-account-controls">Add
                                Observation</button>
                        </form>
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
                        <form action="{{route('doctor.add-medicine', [$user->id, $other->id, $history->id])}}" method="POST">
                            @csrf
                            @method('put')
                        <div class="form-group">
                            <span for="medicine" class="text-center mx-4">Medicine:</span>
                            <input type="text" id="medicine" name="medicine" class="create-account-controls-2"
                                value="{{ $history->medicine }}">
                        </div>
                        <button type="submit"  class="btn btn-warning btn-block create-account-controls-2"
                            style="width:full;">Prescribe Medicine</button>
                    </form>
                        <a href="{{route('doctor.show-lab', [$user->id, $other->id, $history->id])}}"
                            style="width:full; margin-bottom:10px;"class="btn btn-success btn-block create-account-controls-2">Request
                            Lab Assessments</a>

                            <form action="{{route('doctor.add-refer', [$user->id, $other->id, $history->id])}}" method="POST">
                                @csrf
                                @method('put')

                        <div class="form-group">
                            <span for="hospital" class="text-center mx-4">Hospital:</span>
                            <input type="text" id="hospital" name="referral" class="create-account-controls-2 mx-2"
                                value="{{ $history->referral }}">
                        </div>
                        <button type="submit"
                            class="btn btn-secondary btn-blockcreate-account-controls create-account-controls-2"
                            style="width:full; margin-bottom:10px;">Refer to Higher Hospitals</button>
                    </form>

                        <form action="{{route('doctor.finish',[$user->id, $other->id, $history->id])}}" method="POST">
                            @csrf
                            @method('put')


                            <button class="btn btn-primary btn-block create-account-controls-2">Finish
                                Treatment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endSection
