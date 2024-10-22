<?php use Carbon\Carbon;
?>
<section class=" icons mt-auto my-nav p-4 bg-primary">
    <div class="icons">
        <p class="text-white mr-auto">
            &copy;
            <a href="#" class="my-anchor text-white no-underline">{{ Carbon::now()->year }}-{{ config('app.name') }}.</a>
            All Rights Reserved.
        </p>
    </div>

    <div class="">

        <a class="text-white me-2" href="#"><i class="fab fa-facebook-f"></i></a>
        <a class="text-white me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
        <a class="text-white me-2" href="#"><i class="fab fa-instagram"></i></a>
        <a class="text-white me-2" href="#"><i class="fab fa-telegram"></i></a>
    </div>
</section>
