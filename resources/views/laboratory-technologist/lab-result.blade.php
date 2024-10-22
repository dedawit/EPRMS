@extends('laboratory-technologist.dashboard')
@section('content')

<div class="conatiner p-4">
{{-- Triash ??--}}
<div class="password-box-2">
    <div class="form-container">


      <form method="post" action="{{route('lab.patient.store', [$user->id, $labRequest->id])}}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
          <label for="bloodPressure">Patient Name: {{$patient}}</label>
        </div>

        <div class="form-group">
          <label for="weight">Test name: {{$labRequest->test_type}}</label>
        </div>

        <div class="form-group">
          <label for="result">Result:</label>
          <input type="text" id="result" name="result" placeholder="Enter Result..." class="create-account-controls" required>
          @error('result')
                        <span class="fs-6 text-danger mt-2 d-block"></span>
                    @enderror
          <div class="flex items-center">
            <input type="file" class="hidden" id="fileInput-result" name="file-result"

               />
            <div id="button-file">
                <button class="btn btn-success my-2 create-account-controls" type="button" id="openFileDialogBtn-result">
                    Choose File
                </button>
                <span class="file-updown" id="file-span-result" name=""></span>
                <div>
                    @error('file-result')
                        <span class="fs-6 text-danger mt-2 d-block"></span>
                    @enderror
                </div>
                <div>
                    <button class="btn btn-danger hidden " type="button" id="remove-file-result">
                        Remove File
                    </button>
                </div>
            </div>
        </div>

        </div>


        <button type="submit" class="create-account-controls btn btn-primary">Send to a Doctor</button>
      </form>
    </div>
  </div>
</div>

</div>
<script>
      const openFileDialogBtnTask = document.getElementById(
        "openFileDialogBtn-result"
    );

    openFileDialogBtnTask.addEventListener("click", function addTaskFile() {
        const fileInput = document.getElementById("fileInput-result");
        fileInput.click();
        fileInput.addEventListener("change", (event) => {
            const selectedFile = event.target.files[0];
            const detail = document.getElementById("file-span-result");
            const fileName = selectedFile.name;
            const displayName =
                fileName.length > 20
                    ? fileName.substring(0, 20) + "..."
                    : fileName;
            detail.innerHTML = displayName;
            document
                .getElementById("remove-file-result")
                .classList.remove("hidden");
        });
    });

    document
        .getElementById("remove-file-result")
        .addEventListener("click", function () {
            const fileInput = document.getElementById("fileInput-result");
            const fileSpan = document.getElementById("file-span-result");
            fileInput.value = "";
            fileSpan.textContent = "";
            document.getElementById("remove-file-result").classList.add("hidden");
        });
    </script>
@endSection
