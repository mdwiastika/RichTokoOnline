<?php
$title = 'About Us';
include_once './../partials/header.php';
?>
<!-- Start Hero -->
<section class="relative table w-full items-center py-36 bg-[url('../../assets/images/hero/pages.html')] bg-top bg-no-repeat bg-cover">
    <div class="absolute inset-0 bg-gradient-to-b from-orange-100/60 via-orange-200/80 to-orange-200"></div>
    <div class="container relative">
        <div class="grid grid-cols-1 pb-8 text-center mt-10">
            <h3 class="mb-3 text-4xl leading-normal tracking-wider font-semibold">About Us</h3>

            <p class="text-slate-800 text-lg max-w-xl mx-auto">Believe in Craftsmanship and Luxurious Design.</p>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="absolute text-center z-10 bottom-5 start-0 end-0 mx-3">
        <ul class="tracking-[0.5px] mb-0 inline-block">
            <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out text-black/50 hover:text-white"><a href="/">MdwiShop</a></li>
            <li class="inline-block text-base text-black/50 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="mdi mdi-chevron-right"></i></li>
            <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out text-black" aria-current="page">About</li>
        </ul>
    </div>
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-6">
            <div class="lg:col-span-5 md:col-span-6">
                <img src="assets/images/ms-about.jpg" class="rounded-t-full h-[40rem] w-auto object-cover shadow-md" alt="">
            </div>

            <div class="lg:col-span-7 md:col-span-6">
                <div class="lg:ms-8">
                    <h6 class="text-orange-500 font-semibold uppercase text-lg">Our Shop</h6>
                    <h5 class="font-semibold text-3xl leading-normal my-4">Focusing on Quality <br> Material, Good Design</h5>
                    <p class="text-slate-400 max-w-xl">Selamat datang di halaman "Tentang Kami"! Kami adalah tim yang berdedikasi untuk membuat pengalaman berbelanja online menjadi lebih baik dan lebih mudah bagi Anda. Kami berusaha untuk memberikan layanan terbaik kepada pelanggan kami melalui platform toko online yang inovatif dan ramah pengguna.</p>

                    <div class="flex items-center mt-6">
                        <i data-feather="phone" class="w-6 h-6 me-4"></i>
                        <div class="">
                            <h5 class="title font-bold mb-0">Phone</h5>
                            <a href="tel:+152534-468-854" class="tracking-wide text-orange-500">+62 895-3393-90753</a>
                        </div>
                    </div>

                    <div class="flex items-center mt-6">
                        <i data-feather="map-pin" class="w-6 h-6 me-4"></i>
                        <div class="">
                            <h5 class="title font-bold mb-0">Location</h5>
                            <a href="https://maps.app.goo.gl/8uycyph2ezsr4tod8" data-type="iframe" class="tracking-wide text-center text-orange-500 lightbox">View on Google map</a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-6">
            <div class="lg:col-span-5 md:col-span-6 md:order-2 order-1">
                <img src="assets/images/ms-author.jpg" class="rounded-b-full shadow-md h-[40rem] w-auto object-cover" alt="">
            </div>

            <div class="lg:col-span-7 md:col-span-6 md:order-1 order-2">
                <h6 class="text-orange-500 font-semibold uppercase text-lg">Founder</h6>
                <h5 class="font-semibold text-3xl leading-normal my-4">Marcel Dwi Astika</h5>
                <p class="text-slate-400 max-w-xl">Kami adalah MdwiShop, sebuah tim yang berfokus pada pengembangan aplikasi e-commerce yang revolusioner. Kami terdiri dari para profesional yang berpengalaman dalam berbagai bidang, mulai dari pengembangan perangkat lunak, desain UI/UX, hingga pemasaran digital.</p>

                <ul class="list-none mt-6 space-x-2">
                    <li class="inline"><a href="https://dribbble.com/shreethemes" target="_blank" class="inline-flex hover:text-orange-500"><i data-feather="dribbble" class="size-5 align-middle" title="dribbble"></i></a></li>
                    <li class="inline"><a href="http://linkedin.com/company/shreethemes" target="_blank" class="inline-flex hover:text-orange-500"><i data-feather="linkedin" class="size-5 align-middle" title="Linkedin"></i></a></li>
                    <li class="inline"><a href="https://www.facebook.com/shreethemes" target="_blank" class="inline-flex hover:text-orange-500"><i data-feather="facebook" class="size-5 align-middle" title="facebook"></i></a></li>
                    <li class="inline"><a href="https://www.instagram.com/shreethemes/" target="_blank" class="inline-flex hover:text-orange-500"><i data-feather="instagram" class="size-5 align-middle" title="instagram"></i></a></li>
                    <li class="inline"><a href="https://twitter.com/shreethemes" target="_blank" class="inline-flex hover:text-orange-500"><i data-feather="twitter" class="size-5 align-middle" title="twitter"></i></a></li>
                </ul><!--end icon-->
            </div>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div class="grid grid-cols-1 justify-center text-center mb-4">
            <h6 class="text-orange-500 font-semibold uppercase text-lg">Our Promise</h6>
            <h5 class="font-semibold text-3xl leading-normal my-4">We Designed and <br> Developed Products</h5>
        </div><!--end grid-->

        <div class="grid md:grid-cols-3 grid-cols-1 mt-6 gap-6">
            <!-- Content -->
            <div class="p-6 shadow hover:shadow-md duration-500 rounded-md bg-white">
                <i class="mdi mdi-truck-check-outline text-4xl text-orange-500"></i>

                <div class="content mt-6">
                    <a href="#" class="title h5 text-xl font-medium hover:text-orange-500">Free Shipping</a>
                    <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and benefit</p>

                    <div class="mt-4">
                        <a href="#" class="text-orange-500">Read More <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Content -->

            <!-- Content -->
            <div class="p-6 shadow hover:shadow-md duration-500 rounded-md bg-white">
                <i class="mdi mdi-account-wrench-outline text-4xl text-orange-500"></i>

                <div class="content mt-6">
                    <a href="#" class="title h5 text-xl font-medium hover:text-orange-500">24/7 Support</a>
                    <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and benefit</p>

                    <div class="mt-4">
                        <a href="#" class="text-orange-500">Read More <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Content -->

            <!-- Content -->
            <div class="p-6 shadow hover:shadow-md duration-500 rounded-md bg-white">
                <i class="mdi mdi-cash-multiple text-4xl text-orange-500"></i>

                <div class="content mt-6">
                    <a href="#" class="title h5 text-xl font-medium hover:text-orange-500">Payment Process</a>
                    <p class="text-slate-400 mt-3">The phrasal sequence of the is now so that many campaign and benefit</p>

                    <div class="mt-4">
                        <a href="#" class="text-orange-500">Read More <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Content -->
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<?php
include_once './../partials/footer.php';
?>