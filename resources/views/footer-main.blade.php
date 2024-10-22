<?php use Carbon\Carbon;
?>

<footer id="footer" class=" text-white py-4 mt-auto my-nav">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <h4 class="font-rubik font-size-20">{{ config('app.name') }}</h4>
                <p class="font-size-14 font-rale text-white-50 my-bottom">
                    AUTOMATING HEALTH MANAGEMENT! </p>
                <p class="font-size-14 font-rale text-white-50 my-bottom">
                    FAST TREATMENT!</p>
                <p class="font-size-14 font-rale text-white-50 my-bottom">
                    ACCURATE DATA!</p>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <h4 class="font-rubik font-size-20">Subscribe our Newsletter!</h4>
                <form class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mb-2 my-subscribe p-2">Subscribe Now</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
                <h4 class="font-rubik font-size-20">Information</h4>
                <div class="d-flex flex-column flex-wrap">
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">About Us</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Treatment Information</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Privacy Policy</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Terms & Conditions</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-12">
                <h4 class="font-rubik font-size-20">Account</h4>
                <div class="d-flex flex-column flex-wrap">
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">My Account</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Success History</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Laboratory tests</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Newsletters</a>
                </div>
            </div>
        </div>
        <div class="row w-full">
            <section class=" icons my-nav mx-2 ">
                <div class="my-left">
                    <p class="text-white ">
                        &copy;
                        <a href="#"
                            class="my-anchor text-white no-underline">{{ Carbon::now()->year }}-{{ config('app.name') }}.</a>
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
        </div>
    </div>
</footer>
