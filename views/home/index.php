<?php
$title = 'Home';
include_once './../partials/header.php';
$categories = $pdo->query("SELECT * FROM categories ORDER BY id_category DESC LIMIT 5")->fetchAll();
$latest_products = $pdo->query("SELECT p.*, MIN(v.price_variant_product) AS price_product, MAX(v.img_variant_product) AS image_product
                                FROM products p
                                LEFT JOIN variant_products v ON p.id_product = v.product_id
                                WHERE v.id_variant_product = (SELECT id_variant_product FROM variant_products WHERE product_id = p.id_product ORDER BY id_variant_product ASC LIMIT 1)
                                GROUP BY p.id_product
                                ORDER BY p.id_product DESC
                                LIMIT 8")->fetchAll();
$popular_products = $pdo->query("SELECT p.*, MIN(v.price_variant_product) AS price_product, MAX(v.img_variant_product) AS image_product
                                FROM products p
                                LEFT JOIN variant_products v ON p.id_product = v.product_id
                                WHERE v.id_variant_product = (SELECT id_variant_product FROM variant_products WHERE product_id = p.id_product ORDER BY id_variant_product ASC LIMIT 1)
                                GROUP BY p.id_product
                                ORDER BY p.views_product DESC
                                LIMIT 4")->fetchAll();
?>
<section class="relative md:flex table w-full items-center md:h-screen py-36 bg-emerald-500/5  bg-opacity-50 bg-[url('./../images/hero/ms-hero.jpg')] md:bg-top bg-center bg-no-repeat bg-cover">
    <div class="absolute top-0 left-0 w-full h-full bg-white opacity-70 backdrop-filter backdrop-blur"></div>
    <div class="container relative">
        <div class="grid grid-cols-1 justify-center">
            <div class="text-center">
                <span class="uppercase font-semibold text-lg">ONE FOR ALL</span>
                <h4 class="md:text-6xl text-4xl md:leading-normal leading-normal font-bold my-3">Discover the Best Collection for Your Style at <span class="text-orange-500">MdwiShop</span></h4>
                <p class="text-lg capitalize">Get the Best Deals for Fashion, Electronics, and More!</p>

                <div class="mt-6">
                    <a href="/products" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle text-center bg-slate-900 text-white rounded-md">Shop Now <i class="mdi mdi-arrow-right"></i></a>
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="grid grid-cols-1 justify-center text-center mb-6">
            <h5 class="font-semibold text-3xl leading-normal mb-4">Browse our Categories</h5>
            <p class="text-slate-400 max-w-xl mx-auto">Shop the latest products from the most popular categories</p>
        </div><!--end grid-->

        <div class="grid lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 pt-6 gap-6">
            <?php foreach ($categories as $category) : ?>
                <div class="group">
                    <a href="/products?category=<?= $category['slug_category'] ?>" class="text-center hover:text-orange-500 flex flex-col justify-center items-center gap-4">
                        <img src="<?= $category['icon_category'] ?>" class="shadow max-w-32 h-auto group-hover:scale-105 transition-all" alt="">
                        <span class="text-xl font-medium mt-3 block"><?= $category['name_category'] ?></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div><!--end grid-->
    </div><!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div class="grid grid-cols-1 justify-center text-center mb-6">
            <h5 class="font-semibold text-3xl leading-normal mb-4">Our Latest Products</h5>
            <p class="text-slate-400 max-w-xl mx-auto">Shop the latest products from the most popular categories</p>
        </div><!--end grid-->

        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 pt-6 gap-6">
            <?php foreach ($latest_products as $product) : ?>
                <?php
                $id_product = $product['id_product'];
                $rating_product = $pdo->query("SELECT star AS rating_product FROM reviews r
                                                INNER JOIN variant_products vp ON r.variant_product_id = vp.id_variant_product
                                                WHERE vp.product_id = $id_product")->fetchAll();
                $average_rating = 0;
                $total_ratings = count($rating_product);
                $average_rating = 0;
                if ($total_ratings > 0) {
                    foreach ($rating_product as $rating) {
                        $star = explode('_', $rating['rating_product']);
                        $average_rating += intval($star[1]);
                    }
                    $average_rating /= $total_ratings;
                }
                ?>
                <div class="group">
                    <div class="relative overflow-hidden shadow group-hover:shadow-lg group-hover rounded-md duration-500">
                        <img src="<?= $product['image_product'] ?>" class="group-hover:scale-110 duration-500 h-80 w-full object-cover" alt="">
                        <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                            <a href="javascript:void(0)" onclick="addToCart(<?= $id_product ?>)" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle duration-500 text-base text-center bg-slate-900 text-white w-full rounded-md">Add to Cart</a>
                        </div>
                        <ul class="list-none absolute top-[10px] start-4">
                            <li><a href="javascript:void(0)" class="bg-red-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">New</a></li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="/product?slug=<?= $product['slug_product'] ?>" class="hover:text-orange-500 text-lg font-medium"><?= $product['name_product'] ?></a>
                        <div class="flex justify-between items-center mt-1">
                            <p>Rp. <?= number_format($product['price_product'], 0, ',', '.') ?></p>
                            <ul class="font-medium text-amber-400 list-none">
                                <?php for ($i = 0; $i < 5; $i++) : ?>
                                    <li class="inline"><i class="mdi mdi-star<?= $i < $average_rating ? '' : '-outline' ?>"></i></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div><!--end grid-->
    </div><!--end container-->

    <div class="container-fluid relative md:mt-24 mt-16">
        <div class="grid grid-cols-1">
            <div class="relative overflow-hidden py-24 px-4 md:px-10 bg-orange-600 bg-[url('../../assets/images/hero/bg3.html')] bg-center bg-no-repeat bg-cover">
                <div class="absolute inset-0 bg-[url('../../assets/images/hero/bg-shape.html')] bg-center bg-no-repeat bg-cover"></div>
                <div class="grid grid-cols-1 justify-center text-center relative z-1">
                    <h3 class="text-4xl leading-normal tracking-wide font-bold text-white">End of Season Clearance <br> Sale upto 30%</h3>
                    <div id="countdown" class="mt-6">
                        <ul class="count-down list-none inline-block space-x-1">
                            <li id="days" class="text-[28px] leading-[72px] h-[80px] w-[80px] font-medium rounded-md shadow shadow-gray-100 inline-block text-center text-white"></li>
                            <li id="hours" class="text-[28px] leading-[72px] h-[80px] w-[80px] font-medium rounded-md shadow shadow-gray-100 inline-block text-center text-white"></li>
                            <li id="mins" class="text-[28px] leading-[72px] h-[80px] w-[80px] font-medium rounded-md shadow shadow-gray-100 inline-block text-center text-white"></li>
                            <li id="secs" class="text-[28px] leading-[72px] h-[80px] w-[80px] font-medium rounded-md shadow shadow-gray-100 inline-block text-center text-white"></li>
                            <li id="end" class="h1"></li>
                        </ul>
                    </div>
                    <div class="mt-4">
                        <a href="/products" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle text-center bg-white text-orange-500 rounded-md"><i class="mdi mdi-cart-outline"></i> Shop Now</a>
                    </div>
                </div><!--end grid-->
            </div>
        </div>
    </div><!--end container-->

    <div class="container relative md:mt-24 mt-16">
        <div class="grid items-end md:grid-cols-2 mb-6">
            <div class="md:text-start text-center">
                <h5 class="font-semibold text-3xl leading-normal mb-4">Popular Items</h5>
                <p class="text-slate-400 max-w-xl">Popular items in MdwiShop</p>
            </div>

            <div class="md:text-end hidden md:block">
                <a href="/products" class="text-slate-400 hover:text-orange-500">See More Items <i class="mdi mdi-arrow-right"></i></a>
            </div>
        </div><!--end grid-->

        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 pt-6 gap-6">
            <?php foreach ($popular_products as $product) : ?>
                <?php
                $id_product = $product['id_product'];
                $rating_product = $pdo->query("SELECT star AS rating_product FROM reviews r
                                                    INNER JOIN variant_products vp ON r.variant_product_id = vp.id_variant_product
                                                    WHERE vp.product_id = $id_product")->fetchAll();
                $average_rating = 0;
                $total_ratings = count($rating_product);
                $average_rating = 0;
                if ($total_ratings > 0) {
                    foreach ($rating_product as $rating) {
                        $star = explode('_', $rating['rating_product']);
                        $average_rating += intval($star[1]);
                    }
                    $average_rating /= $total_ratings;
                }
                ?>
                <div class="group">
                    <div class="relative overflow-hidden shadow group-hover:shadow-lg group-hover rounded-md duration-500">
                        <img src="<?= $product['image_product'] ?>" class="group-hover:scale-110 duration-500 h-80 w-full object-cover" alt="">

                        <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                            <a href="javascript:void(0)" onclick="addToCart(<?= $id_product ?>)" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle duration-500 text-base text-center bg-slate-900 text-white w-full rounded-md">Add to Cart</a>
                        </div>
                        <ul class="list-none absolute top-[10px] start-4">
                            <li><a href="javascript:void(0)" class="bg-red-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">New</a></li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <a href="/product?slug=<?= $product['slug_product'] ?>" class="hover:text-orange-500 text-lg font-medium"><?= $product['name_product'] ?></a>
                        <div class="flex justify-between items-center mt-1">
                            <p>Rp. <?= number_format($product['price_product'], 0, ',', '.') ?></p>
                            <ul class="font-medium text-amber-400 list-none">
                                <?php for ($i = 0; $i < 5; $i++) : ?>
                                    <li class="inline"><i class="mdi mdi-star<?= $i < $average_rating ? '' : '-outline' ?>"></i></li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!--end grid-->

        <div class="grid grid-cols-1 mt-6">
            <div class="text-center md:hidden block">
                <a href="/products" class="text-slate-400 hover:text-orange-500">See More Items <i class="mdi mdi-arrow-right"></i></a>
            </div>
        </div>
    </div><!--end container-->
</section><!--end section-->

<?php
include_once './../partials/footer.php';
?>