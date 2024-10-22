@extends('doctor.dashboard')
@section('content')

<div class="conatiner p-4">
{{-- flab-request --}}
<div class="lab-request-form">
    <form class="lab-request-form"  method="POST" action="{{route('doctor.add-lab', [$user->id, $other->id, $history->id])}}">
        @csrf
        <h2 class="text-center">Laboratory Request Form</h2>

        <!-- Complete Blood Count -->
        <div class="section">
            <h3>Complete Blood Count</h3>
            <label><input type="checkbox" name="lab[]" value="RBC"> RBC</label>
            <label><input type="checkbox" name="lab[]" value="HGB"> HGB</label>
            <label><input type="checkbox" name="lab[]" value="HCT"> HCT</label>
            <label><input type="checkbox" name="lab[]" value="MVC"> MVC</label>
            <label><input type="checkbox" name="lab[]" value="MCII"> MCII</label>
            <label><input type="checkbox" name="lab[]" value="MCHC"> MCHC</label>
            <label><input type="checkbox" name="lab[]" value="PLT"> PLT</label>
        </div>

        <!-- Urinalysis -->
        <div class="section">
            <h3>Urinalysis</h3>
            <label><input type="checkbox" name="lab[]" value="Color"> Color</label>
            <label><input type="checkbox" name="lab[]" value="Appearance"> Appearance</label>
            <label><input type="checkbox" name="lab[]" value="Urine Chemical test"> Urine Chemical test</label>
            <label><input type="checkbox" name="lab[]" value="Urine micros"> Urine micros</label>
            <label><input type="checkbox" name="lab[]" value="HCG"> HCG</label>
        </div>

        <!-- Parasitology -->
        <div class="section">
            <h3>Parasitology</h3>
            <label><input type="checkbox" name="lab[]" value="Test samp"> Test samp</label>
            <label><input type="checkbox" name="lab[]" value="Microscopic stool"> Microscopic stool</label>
            <label><input type="checkbox" name="lab[]" value="Color"> Color</label>
            <label><input type="checkbox" name="lab[]" value="Consistency"> Consistency</label>
            <label><input type="checkbox" name="lab[]" value="Microscopy"> Microscopy</label>
        </div>

        <!-- Microbiology -->
        <div class="section">
            <h3>Microbiology</h3>
            <label><input type="checkbox" name="lab[]" value="Test"> Test</label>
            <label><input type="checkbox" name="lab[]" value="Gram stain"> Gram stain</label>
            <label><input type="checkbox" name="lab[]" value="KOH"> KOH</label>
            <label><input type="checkbox" name="lab[]" value="Wet Mount"> Wet Mount</label>
        </div>

        <button type="submit" class="btn btn-primary">Send</button>
        @error('lab')
                            <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
                        @enderror
    </form>
</div>

</div>
@endSection
