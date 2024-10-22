
    <div class="row">
        @include('success-message')
    </div>
    @csrf
    <div class="password-box">
        <h3 class="text-center">Change Password</h3>

        <div class="super-container">
            <div class="my-container">
                <label for="old_password" class="text-dark me-2">Old Password:<span
                        class="text-red">*</span></label>
                <input type="password" name="old_password" id="old_password" class="form-control">
            </div>
            @error('old_password')
                <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="super-container">
            <div class="my-container">
                <label for="password" class="text-dark me-2">New Password:<span
                        class="text-red">*</span></label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            @error('password')
                <span class="fs-6 text-danger mt-2 d-block">{{ $message }}</span>
            @enderror
        </div>
        <div class="super-container">
            <div class="my-container">
                <label for="password_confirmation" class="text-dark me-2">Confirm Password:<span
                        class="text-red">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control">
            </div>
        </div>
        <div class="make-center">
            <div class="form-group">
                <input type="submit" name="" class="btn btn-primary m-4" value="Change">
            </div>
        </div>
    </div>
</form>
