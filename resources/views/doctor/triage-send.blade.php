@extends('doctor.dashboard')
@section('content')

<div class="conatiner p-4">

<div class="password-box-2">
    <div class="form-container">


      <form method="post" action="{{route('doctor.add-triage', [$user->id, $other->id])}}">
        @csrf
        <h3 class="text-center" >Basic metrics</h3>
        <div class="form-group">
          <label for="bloodPressure">Blood Pressure:</label>
          <input type="text" id="bloodPressure" name="bloodPressure" class="create-account-controls" placeholder="Enter blood pressure..." required>
        </div>
        <div class="form-group">
          <label for="temperature">Temperature:</label>
          <input type="text" id="temperature" name="temperature" class="create-account-controls" placeholder="Enter temperature..." required>
        </div>

        <div class="form-group">
          <label for="weight">Weight:</label>
          <input type="text" id="weight" name="weight" class="create-account-controls" placeholder="Enter weight..." required>
        </div>

        <div class="form-group">
          <label for="heartRate">Heart Rate:</label>
          <input type="text" id="heartRate" name="heartRate" class="create-account-controls" placeholder="Enter heart rate..." required>
        </div>

        <div class="form-group">
          <label for="doctorSelection">Available Doctors:</label>
          <select id="doctorSelection" name="doctor" class="create-account-controls" required>

            @foreach ($doctors as $doctor)
            <option value="{{ $doctor->id }}">{{ $doctor->first_name." ".$doctor->father_name." ".$doctor->grand_father_name }}</option>
        @endforeach

        </select>
        </div>

        <button type="submit" class="btn btn-primary create-account-controls" >Assign to a Doctor</button>
      </form>
    </div>
  </div>
</div>

</div>
@endSection
