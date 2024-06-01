<?php
$title = 'Shopcart';
include_once './../partials/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: /auth/login.php');
}
?>
<link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">

<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold">Shopcart</h3>
        </div><!--end grid-->

        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-orange-500"><a href="/">MdwiShop</a></li>
                <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="mdi mdi-chevron-right"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold text-orange-500" aria-current="page">Shopcart</li>
            </ul>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section id="parent-refresh">
    <section class="relative md:py-24 py-16" id="cart-refresh">
        <?php
        $user_id = $_SESSION['user']['id'];
        $carts = $pdo->query("SELECT * FROM carts c
        INNER JOIN variant_products vp ON c.variant_product_id = vp.id_variant_product
        INNER JOIN products p ON vp.product_id = p.id_product
        INNER JOIN users u ON c.user_id = u.id
        WHERE c.user_id = $user_id
        ORDER BY c.id_cart")->fetchAll();
        ?>
        <div class="container relative">
            <div class="grid lg:grid-cols-1">
                <div class="relative overflow-x-auto shadow dark:shadow-gray-800 rounded-md">
                    <table class="w-full text-start">
                        <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                            <tr>
                                <th scope="col" class="p-4 w-4"></th>
                                <th scope="col" class="text-start p-4 min-w-[220px]">Product</th>
                                <th scope="col" class="text-start p-4 w-36 min-w-[200px]">Price</th>
                                <th scope="col" class="p-4 w-56 min-w-[220px]">Qty</th>
                                <th scope="col" class="text-start p-4 w-36 min-w-[200px]">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carts as $cart) : ?>
                                <tr class="bg-white dark:bg-slate-900">
                                    <td class="p-4"><a href="javascript:void(0);" onclick="removeCart(<?= $cart['id_cart'] ?>)"><i class="mdi mdi-window-close text-red-600"></i></a></td>
                                    <td class="p-4">
                                        <span class="flex items-center">
                                            <img src="<?= $cart['img_variant_product'] ?>" class="rounded shadow dark:shadow-gray-800 w-12" alt="">
                                            <span class="ms-3">
                                                <span class="block font-semibold"><?= $cart['name_product'] ?></span>
                                                <span class="text-gray-600 text-sm"><?= $cart['name_variant_product'] ?></span>
                                            </span>
                                        </span>
                                    </td>
                                    <td class="p-4">Rp <?= number_format($cart['price_variant_product'], 0, ',', '.') ?></td>
                                    <td class="p-4 text-center">
                                        <div class="qty-icons">
                                            <button onclick="changeQuantity(this, <?= $cart['id_cart'] ?>, 'decrement')" class="size-9 inline-flex items-center justify-center tracking-wide align-middle text-base text-center rounded-md bg-orange-500/5 hover:bg-orange-500 text-orange-500 hover:text-white minus">-</button>
                                            <input min="0" max="<?= $cart['stock_variant_product'] ?>" name="quantity" value="<?= $cart['quantity'] ?>" type="number" class="h-9 inline-flex items-center justify-center tracking-wide align-middle text-base text-center rounded-md bg-orange-500/5 hover:bg-orange-500 text-orange-500 hover:text-white pointer-events-none w-16 ps-4 quantity">
                                            <button onclick="changeQuantity(this, <?= $cart['id_cart'] ?>, 'increment')" class="size-9 inline-flex items-center justify-center tracking-wide align-middle text-base text-center rounded-md bg-orange-500/5 hover:bg-orange-500 text-orange-500 hover:text-white plus">+</button>
                                        </div>
                                    </td>
                                    <td class="p-4">Rp <?= number_format($cart['price_variant_product'] * $cart['quantity'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 mt-6 gap-6">
                    <div class="lg:col-span-9 md:order-1 order-3">
                        <div class="space-x-1">
                            <a href="#" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle text-base text-center bg-orange-500 text-white rounded-md mt-2">Checkout Now</a>
                        </div>
                    </div>

                    <div class="lg:col-span-3 md:order-2 order-1">
                        <ul class="list-none shadow dark:shadow-gray-800 rounded-md">
                            <?php
                            $subtotal = 0;
                            foreach ($carts as $cart) {
                                $subtotal += $cart['price_variant_product'] * $cart['quantity'];
                            }
                            $taxes = $subtotal * 0.1;
                            $total = $subtotal + $taxes;
                            ?>
                            <li class="flex justify-between p-4">
                                <span class="font-semibold text-lg">Subtotal :</span>
                                <span class="text-slate-400">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                            </li>
                            <li class="flex justify-between p-4 border-t border-gray-100 dark:border-gray-800">
                                <span class="font-semibold text-lg">Taxes :</span>
                                <span class="text-slate-400">Rp <?= number_format($taxes, 0, ',', '.') ?></span>
                            </li>
                            <li class="flex justify-between font-semibold p-4 border-t border-gray-200 dark:border-gray-600">
                                <span class="font-semibold text-lg">Total :</span>
                                <span class="font-semibold">Rp <?= number_format($total, 0, ',', '.') ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--end container-->
    </section><!--end section-->
</section>
<!-- End -->
<script src="/assets/libs/tiny-slider/min/tiny-slider.js"></script>
<?php
include_once './../partials/footer.php';
?>
<script>
    function changeQuantity(element, cartId, action) {
        if (action === 'increment') {
            element.parentNode.querySelector('input[type=number]').stepUp();
        } else if (action === 'decrement') {
            element.parentNode.querySelector('input[type=number]').stepDown();
        }
        const max = element.parentNode.querySelector('input[type=number]').max;
        const quantity = element.parentNode.querySelector('input[type=number]').value;
        console.log('quantity:', quantity);
        console.log('max:', max);
        const url = '/api/set-qty-cart.php';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                cartId: cartId,
                action: action
            },
            success: function(result) {
                result = JSON.parse(result);
                if (result.status === 'success') {
                    console.log('Success:', result);
                    $('#parent-refresh').load(location.href + ' #cart-refresh');
                } else if (result.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message,
                    });
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    function removeCart(idCart) {
        const url = '/api/remove-cart.php';
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete this data?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id_cart: idCart
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.status === 'success') {
                            console.log('Success:', result);
                            $('#parent-refresh').load(location.href + ' #cart-refresh');
                        } else if (result.status === 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.message,
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });

    }
</script>