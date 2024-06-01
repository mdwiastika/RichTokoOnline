<footer class="footer bg-dark-footer relative text-gray-200">
    <div class="container relative">
        <div class="grid grid-cols-12">
            <div class="col-span-12">
                <div class="py-[60px] px-0">
                    <div class="grid md:grid-cols-12 grid-cols-1 gap-6">
                        <div class="lg:col-span-3 md:col-span-12">
                            <a href="#" class="text-[22px] focus:outline-none">
                                <img src="assets/logo-2-no-bg.png" class="w-40" alt="">
                            </a>
                            <p class="mt-6 text-gray-300">Stay Connected with Us for Exclusive Offers and Updates</p>
                            <ul class="list-none mt-6">
                                <li class="inline"><a href="https://www.linkedin.com/in/marcel-dwi-astika-6b93a0260/" target="_blank" class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 rounded-md hover:text-orange-500 text-slate-300"><i data-feather="linkedin" class="h-4 w-4 align-middle" title="Linkedin"></i></a></li>
                                <li class="inline"><a href="https://www.facebook.com/mdwiastika" target="_blank" class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 rounded-md hover:text-orange-500 text-slate-300"><i data-feather="facebook" class="h-4 w-4 align-middle" title="facebook"></i></a></li>
                                <li class="inline"><a href="https://www.instagram.com/marcelastika/" target="_blank" class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 rounded-md hover:text-orange-500 text-slate-300"><i data-feather="instagram" class="h-4 w-4 align-middle" title="instagram"></i></a></li>
                                <li class="inline"><a href="https://twitter.com/mdwiastika" target="_blank" class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 rounded-md hover:text-orange-500 text-slate-300"><i data-feather="twitter" class="h-4 w-4 align-middle" title="twitter"></i></a></li>
                                <li class="inline"><a href="mailto:marceldwias@gmail.com" class="size-8 inline-flex items-center justify-center tracking-wide align-middle text-base border border-gray-800 rounded-md hover:text-orange-500 text-slate-300"><i data-feather="mail" class="h-4 w-4 align-middle" title="email"></i></a></li>
                            </ul><!--end icon-->
                        </div>

                        <div class="lg:col-span-6 md:col-span-12">
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">Our Category</h5>
                            <div class="grid md:grid-cols-12 grid-cols-1">
                                <?php foreach ($parent_categories as $parent_category) : ?>
                                    <div class="md:col-span-4">
                                        <ul class="list-none footer-list mt-6">
                                            <li><a href="#" class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i class="mdi mdi-format-align-justify"></i> <?= $parent_category['name_parent_category'] ?></a></li>
                                            <?php
                                            $categories = json_decode($parent_category['categories'], true);
                                            foreach ($categories as $category) : ?>
                                                <li class="mt-[10px]"><a href="/products?category=<?= $category['slug_category'] ?>" class="text-gray-300 hover:text-gray-400 duration-500 ease-in-out"><i class="mdi mdi-chevron-right"></i> <?= $category['name_category'] ?> </a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="lg:col-span-3 md:col-span-4">
                            <h5 class="tracking-[1px] text-gray-100 font-semibold">Newsletter</h5>
                            <p class="mt-6">Sign up and receive the latest tips via email.</p>
                            <form>
                                <div class="grid grid-cols-1">
                                    <div class="my-3">
                                        <label class="form-label">Write your email <span class="text-red-600">*</span></label>
                                        <div class="form-icon relative mt-2">
                                            <i data-feather="mail" class="size-4 absolute top-3 start-4"></i>
                                            <input type="email" class="ps-12 rounded w-full py-2 px-3 h-10 bg-gray-800 border-0 text-gray-100 focus:shadow-none focus:ring-0 placeholder:text-gray-200 outline-none" placeholder="Email" name="email" required="">
                                        </div>
                                    </div>

                                    <button type="submit" id="submitsubscribe" name="send" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle duration-500 text-base text-center bg-orange-500 text-white rounded-md">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1">
            <div class="py-[30px] px-0 border-t border-slate-800">
                <div class="grid lg:grid-cols-4 md:grid-cols-2">
                    <div class="flex items-center lg:justify-center">
                        <i class="mdi mdi-truck-check-outline align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Free delivery</h6>
                    </div>

                    <div class="flex items-center lg:justify-center">
                        <i class="mdi mdi-archive align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Non-contact shipping</h6>
                    </div>

                    <div class="flex items-center lg:justify-center">
                        <i class="mdi mdi-cash-multiple align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Money-back quarantee</h6>
                    </div>

                    <div class="flex items-center lg:justify-center">
                        <i class="mdi mdi-shield-check align-middle text-lg mb-0 me-2"></i>
                        <h6 class="mb-0 font-medium">Secure payments</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-[30px] px-0 border-t border-slate-800">
        <div class="container relative text-center">
            <div class="grid items-center">
                <div class="text-center">
                    <p class="mb-0">© <script>
                            document.write(new Date().getFullYear())
                        </script> Mdwishop. Design with <i class="mdi mdi-heart text-red-600"></i> by <a href="https://mdwitech.vercel.app/" target="_blank" class="text-reset">Mdwiastika</a>.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-orange-500 text-white justify-center items-center"><i class="mdi mdi-arrow-up"></i></a>
<script src="assets/libs/tobii/js/tobii.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<script src="assets/js/plugins.init.js"></script>
<script src="assets/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function addToCart(product_id) {
        if (<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
            $.ajax({
                url: '/controllers/add-cart.php',
                type: 'POST',
                data: {
                    product_id: product_id
                },
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Product has been added to cart',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Product failed to add to cart',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        } else {
            window.location.href = '/auth/login.php';
        }
    }
</script>
</body>

</html>