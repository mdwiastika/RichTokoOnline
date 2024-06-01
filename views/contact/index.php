<?php
$title = 'Contact';
include_once './../partials/header.php';
?>

<!-- Start Section-->
<section class="relative lg:py-24 py-16">
    <div class="container">
        <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-6">
            <div class="lg:col-span-7 md:col-span-6">
                <img src="assets/images/contact.svg" alt="">
            </div>

            <div class="lg:col-span-5 md:col-span-6">
                <div class="lg:ms-5">
                    <div class="bg-white rounded-md shadow p-6">
                        <h3 class="mb-6 text-2xl leading-normal font-semibold">Get in touch !</h3>

                        <form method="get" action="mailto:marceldwias@gmail.com" name="myForm" id="myForm">
                            <p class="mb-0" id="error-msg"></p>
                            <div id="simple-msg"></div>
                            <div class="grid lg:grid-cols-12 grid-cols-1 gap-3">
                                <div class="lg:col-span-6">
                                    <label for="name" class="font-semibold">Your Name:</label>
                                    <input name="name" id="name" type="text" class="mt-2 w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Name :">
                                </div>

                                <div class="lg:col-span-6">
                                    <label for="email" class="font-semibold">Your Email:</label>
                                    <input name="email" id="email" type="email" class="mt-2 w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Email :">
                                </div>

                                <div class="lg:col-span-12">
                                    <label for="subject" class="font-semibold">Your Question:</label>
                                    <input name="subject" id="subject" class="mt-2 w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Subject :">
                                </div>

                                <div class="lg:col-span-12">
                                    <label for="body" class="font-semibold">Your Comment:</label>
                                    <textarea name="body" id="body" class="mt-2 w-full py-2 px-3 h-28 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Message :"></textarea>
                                </div>
                            </div>
                            <button type="submit" id="submit" name="send" class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-orange-500 text-white rounded-md mt-2">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end container-->

    <div class="container lg:mt-24 mt-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-6">
            <div class="text-center px-6">
                <div class="relative text-transparent">
                    <div class="size-20 bg-orange-500/5 text-orange-500 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm">
                        <i data-feather="phone"></i>
                    </div>
                </div>

                <div class="content mt-7">
                    <h5 class="title h5 text-lg font-semibold">Phone</h5>
                    <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and benefit</p>

                    <div class="mt-5">
                        <a href="tel:+152534-468-854" class="text-orange-500 font-medium">+62 895-3393-90753</a>
                    </div>
                </div>
            </div>

            <div class="text-center px-6">
                <div class="relative text-transparent">
                    <div class="size-20 bg-orange-500/5 text-orange-500 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm">
                        <i data-feather="mail"></i>
                    </div>
                </div>

                <div class="content mt-7">
                    <h5 class="title h5 text-lg font-semibold">Email</h5>
                    <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and benefit</p>

                    <div class="mt-5">
                        <a href="mailto:marceldwias@gmail.com" class="text-orange-500 font-medium">marceldwias@gmail.com</a>
                    </div>
                </div>
            </div>

            <div class="text-center px-6">
                <div class="relative text-transparent">
                    <div class="size-20 bg-orange-500/5 text-orange-500 rounded-xl text-2xl flex align-middle justify-center items-center mx-auto shadow-sm">
                        <i data-feather="map-pin"></i>
                    </div>
                </div>

                <div class="content mt-7">
                    <h5 class="title h5 text-lg font-semibold">Location</h5>
                    <p class="text-slate-400 mt-3">Banjarmlati Lengkong, <br> Jawa Timur, Indonesia</p>

                    <div class="mt-5">
                        <a href="https://maps.app.goo.gl/8uycyph2ezsr4tod8" data-type="iframe" class="video-play-icon read-more lightbox text-orange-500 font-medium">View on Google map</a>
                    </div>
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Section-->

<?php
include_once './../partials/footer.php';
?>