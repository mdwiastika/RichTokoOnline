<?php
$title = 'Contact';
include_once './../partials/header.php';
$slug_product = $_GET['slug'];
$update_view = $pdo->query("UPDATE products SET views_product = views_product + 1 WHERE slug_product = '$slug_product'");
$product = $pdo->query("SELECT * FROM products WHERE slug_product = '$slug_product'")->fetch();
$variant_items = $pdo->query("SELECT * FROM variant_products WHERE product_id = $product[id_product]")->fetchAll();
$id_product = $product['id_product'];
$reviews = $pdo->query("SELECT * FROM reviews r
                        INNER JOIN variant_products vp ON r.variant_product_id = vp.id_variant_product
                        INNER JOIN products p ON vp.product_id = p.id_product
                        INNER JOIN users u ON r.user_id = u.id
                        WHERE p.id_product = $id_product")->fetchAll();
?>
<link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">

<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 md:pt-28 bg-gray-50">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold"><?= $product['name_product'] ?></h3>
        </div><!--end grid-->

        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-orange-500"><a href="/">MdwiShop</a></li>
                <li class="inline-block text-base text-slate-950 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="mdi mdi-chevron-right"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-orange-500"><a href="/products">Products</a></li>
                <li class="inline-block text-base text-slate-950 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="mdi mdi-chevron-right"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold text-orange-500" aria-current="page"><?= $product['name_product'] ?></li>
            </ul>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-6 items-center">
            <div class="lg:col-span-5">
                <div class="tiny-single-item">
                    <?php foreach ($variant_items as $variant_item) : ?>
                        <div class="tiny-slide">
                            <div class="m-0.5">
                                <img src="<?= $variant_item['img_variant_product'] ?>" class="shadow" alt="">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!--end tiny slider-->
            </div><!--end col-->

            <div class="lg:col-span-7">
                <h5 class="text-2xl font-semibold"><?= $product['name_product'] ?></h5>
                <div class="mt-2">
                    <span class="text-slate-400 font-semibold me-1" id="price">Rp <?= number_format($variant_items[0]['price_variant_product'], 0, ',', '.') ?></span>

                    <ul class="list-none inline-block text-orange-400">
                        <?php
                        $average_rating = 0;
                        $total_ratings = count($reviews);
                        $average_rating = 0;
                        if ($total_ratings > 0) {
                            foreach ($reviews as $rating) {
                                $star = explode('_', $rating['star']);
                                $average_rating += intval($star[1]);
                            }
                            $average_rating /= $total_ratings;
                        }
                        for ($i = 0; $i < 5; $i++) : ?>
                            <li class="inline"><i class="mdi mdi-star<?= $i < $average_rating ? '' : '-outline' ?>"></i></li>
                        <?php endfor; ?>
                        <li class="inline text-slate-400 font-semibold"><?= number_format($average_rating, 2, ',', '.') . " ($total_ratings)" ?></li>
                    </ul>
                </div>

                <div class="grid lg:grid-cols-1 grid-cols-1 gap-6 mt-4">
                    <div class="flex items-center">
                        <h5 class="text-lg font-semibold me-2">Variant:</h5>
                        <div class="space-x-1">
                            <?php foreach ($variant_items as $key => $variant_item) : ?>
                                <?php
                                $stock = $variant_item['stock_variant_product'];
                                $price = $variant_item['price_variant_product'];
                                ?>
                                <a href="javascript:void(0);" data-variant-product-id="<?= $variant_item['id_variant_product'] ?>" onclick="selectItemVariant(this, <?= $stock ?>, <?= $price ?>)" class="inline-flex px-4 py-1 items-center justify-center tracking-wide align-middle text-base text-center rounded-md bg-orange-500/5 hover:bg-orange-500 text-orange-500 hover:text-white <?= $key == 0 ? 'item-selected' : '' ?>"><?= $variant_item['name_variant_product'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div><!--end content-->

                    <div class="flex items-center">
                        <h5 class="text-lg font-semibold me-2">Quantity:</h5>
                        <div class="qty-icons ms-3 space-x-0.5">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="size-9 inline-flex items-center justify-center tracking-wide align-middle text-base text-center rounded-md bg-orange-500/5 hover:bg-orange-500 text-orange-500 hover:text-white minus">-</button>
                            <input min="1" max="<?= $variant_items[0]['stock_variant_product'] ?>" id="quantity" name="quantity" value="1" type="number" class="h-9 inline-flex items-center justify-center tracking-wide align-middle text-base text-center rounded-md bg-orange-500/5 hover:bg-orange-500 text-orange-500 hover:text-white pointer-events-none w-16 ps-4 quantity">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="size-9 inline-flex items-center justify-center tracking-wide align-middle text-base text-center rounded-md bg-orange-500/5 hover:bg-orange-500 text-orange-500 hover:text-white plus">+</button>
                        </div>
                    </div><!--end content-->
                </div><!--end grid-->

                <div class="mt-4 space-x-1">
                    <a href="#" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle text-base text-center bg-orange-500 text-white rounded-md mt-2">Shop Now</a>
                    <a href="javascript:void(0);" onclick="addToCartWithVariantProduct()" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle text-base text-center rounded-md bg-orange-500/5 hover:bg-orange-500 text-orange-500 hover:text-white mt-2">Add to Cart</a>
                </div>
            </div><!--end content-->
        </div><!--end grid-->

        <div class="grid md:grid-cols-12 grid-cols-1 mt-6 gap-6">
            <div class="lg:col-span-3 md:col-span-5">
                <div class="sticky top-20">
                    <ul class="flex-column p-6 bg-white rounded-md" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li role="presentation">
                            <button class="px-4 py-2 text-start text-base font-semibold rounded-md w-full hover:text-orange-500 duration-500" id="description-tab" data-tabs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                        </li>
                        <li role="presentation">
                            <button class="px-4 py-2 text-start text-base font-semibold rounded-md w-full mt-3 duration-500" id="review-tab" data-tabs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Review</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-9 md:col-span-7">
                <div id="myTabContent" class="p-6 bg-white rounded-md">
                    <div class="" id="description" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="text-slate-400"><?= $product['description_product'] ?></p>
                    </div>
                    <div class="hidden" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <?php foreach ($reviews as $review) : ?>
                            <div class="mt-8">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <img src="assets/images/client/03.jpg" class="h-11 w-11 rounded-full shadow" alt="">

                                        <div class="ms-3 flex-1">
                                            <a href="#" class="text-lg font-semibold hover:text-orange-500 duration-500"><?= $review['name'] ?></a>
                                            <p class="text-sm text-slate-400"><?= date('Y-m-d H:i', strtotime($review['created_at'])) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 bg-gray-50 rounded-md shadow mt-6">
                                    <ul class="list-none inline-block text-orange-400">
                                        <?php
                                        $star = explode('_', $review['star']);
                                        for ($i = 0; $i < 5; $i++) : ?>
                                            <li class="inline"><i class="mdi mdi-star<?= $i < $star[1] ? '' : '-outline' ?>"></i></li>
                                        <?php endfor; ?>
                                        <li class="inline text-slate-400 font-semibold"><?= $star[1] ?></li>
                                    </ul>

                                    <p class="text-slate-400 italic"><?= $review['description_review'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="p-6 rounded-md shadow mt-8">
                            <h5 class="text-lg font-semibold">Leave A Comment:</h5>

                            <form class="mt-8" onsubmit="createReview(event)">
                                <div class="grid lg:grid-cols-12 lg:gap-6">
                                </div>
                                <div class="grid grid-cols-1">
                                    <div class="mb-5">
                                        <div class="text-start">
                                            <label for="rating" class="font-semibold">Your Rating:</label>
                                            <div class="rating text-orange-400">
                                                <label for="star1">
                                                    <input type="radio" class="hidden" id="star1" value="1" onclick="updateRating(1)">
                                                    <i class="mdi mdi-star-outline" style="font-size: 24px;"></i>
                                                </label>
                                                <label for="star2">
                                                    <input type="radio" class="hidden" id="star2" value="2" onclick="updateRating(2)">
                                                    <i class="mdi mdi-star-outline" style="font-size: 24px;"></i>
                                                </label>
                                                <label for="star3">
                                                    <input type="radio" class="hidden" id="star3" value="3" onclick="updateRating(3)">
                                                    <i class="mdi mdi-star-outline" style="font-size: 24px;"></i>
                                                </label>
                                                <label for="star4">
                                                    <input type="radio" class="hidden" id="star4" value="4" onclick="updateRating(4)">
                                                    <i class="mdi mdi-star-outline" style="font-size: 24px;"></i>
                                                </label>
                                                <label for="star5">
                                                    <input type="radio" class="hidden" id="star5" value="5" onclick="updateRating(5)">
                                                    <i class="mdi mdi-star-outline" style="font-size: 24px;"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="star" id="starInput">
                                    </div>
                                    <div class="mb-5">
                                        <div class="text-start">
                                            <label for="description_review" class="font-semibold">Your Comment:</label>
                                            <div class="form-icon relative mt-2">
                                                <i data-feather="message-circle" class="w-4 h-4 absolute top-3 start-4"></i>
                                                <textarea name="description_review" id="description_review" class="ps-11 w-full py-2 px-3 h-28 bg-transparent rounded outline-none border border-gray-100 focus:ring-0" placeholder="Message :"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="submit" name="send" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle duration-500 text-base text-center bg-orange-500 text-white rounded-md w-full">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
<script src="/assets/libs/tiny-slider/min/tiny-slider.js"></script>
<?php
include_once './../partials/footer.php';
?>
<script>
    function selectItemVariant(element, quantity, price) {
        const items = document.querySelectorAll('.item-selected');
        items.forEach(item => {
            item.classList.remove('item-selected');
        });
        element.classList.add('item-selected');
        document.getElementById('quantity').setAttribute('max', quantity);
        document.getElementById('quantity').value = 1;
        const formattedPrice = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(price);
        document.getElementById('price').innerHTML = formattedPrice;
    }

    function updateRating(rating) {
        document.getElementById('starInput').value = 'star_' + rating;
        const stars = document.querySelectorAll('.rating i');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('mdi-star-outline');
                star.classList.add('mdi-star');
            } else {
                star.classList.remove('mdi-star');
                star.classList.add('mdi-star-outline');
            }
        });
    }

    function createReview(element) {
        element.preventDefault();
        const starInput = document.getElementById('starInput').value;
        const descriptionReview = document.getElementById('description_review').value;
        const userId = <?= isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0 ?>;
        if (userId === 0) {
            Swal.fire({
                title: 'Error',
                text: 'Please login first',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }
        if (starInput.trim() === '') {
            Swal.fire({
                title: 'Error',
                text: 'Please select a rating',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }
        if (descriptionReview.trim() === '') {
            Swal.fire({
                title: 'Error',
                text: 'Please enter your comment',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }
        $.ajax({
            url: '/api/add-review.php',
            type: 'POST',
            data: {
                star: starInput,
                description_review: descriptionReview,
                variant_product_id: <?= $variant_items[0]['id_variant_product'] ?>,
                user_id: userId
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Success',
                        text: 'Review has been created',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                    location.reload();
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to create review',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }

    function addToCartWithVariantProduct() {
        const variantItems = document.querySelectorAll('.item-selected');
        const variantProductId = variantItems[0].getAttribute('data-variant-product-id');
        const quantity = document.getElementById('quantity').value;
        $.ajax({
            url: '/api/add-cart.php',
            type: 'POST',
            data: {
                variant_product_id: variantProductId,
                quantity: quantity,
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
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    }
</script>