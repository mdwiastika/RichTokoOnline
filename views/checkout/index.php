<?php
$title = 'Home';
include_once './../partials/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: /auth/login.php');
    exit;
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$selected_carts = $_POST['selected_cart'];
$implode_selected_carts = implode(',', $selected_carts);
$carts_checkout = $pdo->query("SELECT * FROM carts JOIN variant_products ON carts.variant_product_id = variant_products.id_variant_product JOIN products ON variant_products.product_id = products.id_product WHERE carts.id_cart IN ($implode_selected_carts)")->fetchAll();
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key:f84094ac95ea8f30f0af5afa20ef0250"
    ),
));

$response_province = curl_exec($curl);
$err_province = curl_error($curl);
$propvinces = json_decode($response_province, true)['rajaongkir']['results'];
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container.select2-container--default {
        margin-top: 8px !important;
        padding: 4px 0px 4px 8px !important;
        border: 1px solid #e5e7eb !important;
    }

    .select2-selection__rendered {
        border: 0px !important;
        outline: 0px !important;
    }
</style>
<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 bg-gray-50">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold">Checkout</h3>
        </div><!--end grid-->

        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-orange-500"><a href="/">MdwiShop</a></li>
                <li class="inline-block text-base text-slate-950 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="mdi mdi-chevron-right"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold text-orange-500" aria-current="page">Checkout</li>
            </ul>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container relative">
        <form method="POST" action="/midtrans/examples/snap/checkout-process-simple-version.php" class="grid lg:grid-cols-12 md:grid-cols-2 grid-cols-1 gap-6">
            <div class="lg:col-span-8">
                <div class="p-6 rounded-md shadow">
                    <h3 class="text-xl leading-normal font-semibold">Billing address</h3>

                    <div>
                        <div class="grid lg:grid-cols-12 grid-cols-1 mt-6 gap-5">
                            <div class="lg:col-span-6">
                                <label class="form-label font-semibold">Name : <span class="text-red-600">*</span></label>
                                <input type="text" class="w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0 mt-2" placeholder="Name:" id="name" name="name" required value="<?php echo $_SESSION['user']['name']; ?>">
                            </div>

                            <div class="lg:col-span-6">
                                <label class="form-label font-semibold">Username : <span class="text-red-600">*</span></label>
                                <input type="text" class="w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0 mt-2" placeholder="Username:" id="username" name="username" required value="<?php echo $_SESSION['user']['username']; ?>">
                            </div>

                            <div class="lg:col-span-6">
                                <label class="form-label font-semibold">Email : <span class="text-red-600">*</span></label>
                                <input type="email" class="w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0 mt-2" placeholder="Email:" id="email" name="email" required value="<?php echo $_SESSION['user']['email']; ?>">
                            </div>

                            <div class="lg:col-span-6">
                                <label class="form-label font-semibold">Phone Number : <span class="text-red-600">*</span></label>
                                <input type="text" class="w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0 mt-2" placeholder="Phone Number:" id="phone_number" name="phone_number" required value="<?php echo $_SESSION['user']['phone_number']; ?>">
                            </div>

                            <div class="lg:col-span-6">
                                <label class="form-label font-semibold">Province : <span class="text-red-600">*</span></label>
                                <select class="w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0 mt-2" id="province" name="province" required>
                                    <option value="">Select Province</option>
                                    <?php foreach ($propvinces as $province) : ?>
                                        <option value="<?= $province['province_id'] ?>"><?= $province['province'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="lg:col-span-6">
                                <label class="form-label font-semibold -3">City : <span class="text-red-600">*</span></label>
                                <select class="w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0 mt-2" id="city" name="city" required>
                                </select>
                            </div>

                            <div class="lg:col-span-12">
                                <label class="form-label font-semibold">Address : <span class="text-red-600">*</span></label>
                                <textarea class="w-full py-2 px-3 h-20 bg-transparent rounded outline-none border border-gray-100 focus:ring-0 mt-2" placeholder="Address:" id="address" name="address" required><?php echo $_SESSION['user']['address']; ?></textarea>
                            </div>
                        </div>
                        <h3 class="text-xl leading-normal font-semibold mt-6">Jasa Pelayanan</h3>
                        <div class="lg:col-span-6">
                            <label class="form-label font-semibold -3">Kurir : <span class="text-red-600">*</span></label>
                            <select class="w-full py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0 mt-2" id="kurir" name="kurir" required>
                                <option value="">Select Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS INDONESIA</option>
                            </select>
                        </div>
                        <table class="mt-6">
                            <thead>
                                <tr>
                                    <th class="py-2 px-3 font-semibold">Select</th>
                                    <th class="py-2 px-3 font-semibold">Jasa Pengiriman</th>
                                    <th class="py-2 px-3 font-semibold">ETD</th>
                                    <th class="py-2 px-3 font-semibold">Harga</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-ongkir">
                            </tbody>
                        </table>

                        <div class="mt-4">
                            <input type="submit" class="py-2 px-5 inline-block tracking-wide align-middle duration-500 text-base text-center bg-orange-500 text-white rounded-md w-full" value="Continue to checkout">
                        </div>
                    </div>

                </div>

            </div><!--end col-->

            <div class="lg:col-span-4">
                <div class="p-6 rounded-md shadow">
                    <div class="flex justify-between items-center">
                        <h5 class="text-lg font-semibold">Your Cart</h5>

                        <a href="javascript:void(0)" class="bg-orange-500 flex justify-center items-center text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full h-5"><?= count($carts_checkout); ?></a>
                    </div>

                    <?php
                    $sub_total = 0;
                    foreach ($carts_checkout as $item) : ?>
                        <?php
                        $total_price = 0;
                        $total_price += $item['price_variant_product'] * $item['quantity'];
                        $taxes = 0.05 * $total_price;
                        ?>
                        <input type="hidden" name="arr_id_cart[]" value="<?= $item['id_cart']; ?>">
                        <div class="mt-4 rounded-md shadow">
                            <div class="p-3 flex justify-between items-center">
                                <div>
                                    <h5 class="font-semibold"><?= $item['name_product']; ?></h5>
                                    <p class="text-sm text-slate-400">(<?= $item['quantity'] ?>) <?= $item['name_variant_product']; ?></p>
                                </div>

                                <p class="text-slate-400 font-semibold">Rp <?= number_format($item['price_variant_product'] * $item['quantity'], 0, ',', '.') ?></p>
                            </div>
                        </div>
                        <?php
                        $sub_total += $item['price_variant_product'] * $item['quantity'];
                        $taxes = 0.05 * $sub_total;
                        $total = $sub_total + $taxes;
                        ?>
                    <?php endforeach; ?>
                    <div class="mt-4 rounded-md shadow">
                        <div class="p-3 flex justify-between items-center">
                            <div>
                                <h5 class="font-semibold">Sub Total</h5>
                            </div>

                            <p class="text-slate-400 font-semibold">Rp <?= number_format($sub_total, 0, ',', '.') ?></p>
                        </div>
                    </div>
                    <div class="mt-4 rounded-md shadow">
                        <div class="p-3 flex justify-between items-center">
                            <div>
                                <h5 class="font-semibold">Taxes (5%)</h5>
                            </div>

                            <p class="text-slate-400 font-semibold">Rp <?= number_format($taxes, 0, ',', '.') ?></p>
                        </div>
                    </div>

                    <div class="mt-4 rounded-md shadow">
                        <div class="p-3 flex justify-between items-center">
                            <div>
                                <h5 class="font-semibold">Shipping Cost</h5>
                            </div>

                            <p class="text-slate-400 font-semibold" id="price-ongkir">Rp <?= number_format(0, 0, ',', '.') ?></p>
                        </div>
                    </div>
                    <div class="mt-4 rounded-md shadow">
                        <div class="p-3 flex justify-between items-center">
                            <div>
                                <h5 class="font-semibold">Total</h5>
                            </div>
                            <input type="hidden" name="total_price" id="total_price">
                            <p class="text-slate-400 font-semibold" id="price-total">Rp <?= number_format($total, 0, ',', '.') ?></p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </form><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->
<?php
include_once './../partials/footer.php';
?>
<?php
if (isset($_SESSION['success'])) {
    echo "<script>Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '" . $_SESSION['success'] . "'
        });</script>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '" . $_SESSION['error'] . "'
        });</script>";
    unset($_SESSION['error']);
}
?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('#province').change(function() {
        let provinceId = $(this).val();
        $.ajax({
            url: '/api/get-city.php',
            method: 'GET',
            data: {
                province_id: provinceId
            },
            success: function(response) {
                let cities = JSON.parse(response);
                let citySelect = $('#city');
                citySelect.empty();
                $.each(cities, function(index, city) {
                    citySelect.append($('<option></option>').attr('value', city.city_id).text(city.type + ' ' + city.city_name));
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    $('#kurir').change(function() {
        let kurir = $(this).val();
        let prov_id = $('#province').val();
        let kab_id = $('#city').val();
        $.ajax({
            url: '/api/check-ongkir.php',
            method: 'POST',
            data: {
                kurir: kurir,
                prov_id: prov_id,
                kab_id: kab_id
            },
            success: function(response) {
                response = JSON.parse(response);
                let html_tbody = '';
                response.forEach(function(item) {
                    html_tbody += '<tr>';
                    html_tbody += '<td class="py-2 px-3"><input type="radio" name="ongkir" value="' + item.cost[0].value + '" onclick="setPriceOngkir(this)"></td>';
                    html_tbody += '<td class="py-2 px-3">' + item.service + '</td>';
                    html_tbody += '<td class="py-2 px-3">' + item.cost[0].etd + ' days</td>';
                    html_tbody += '<td class="py-2 px-3">Rp ' + item.cost[0].value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</td>';
                    html_tbody += '</tr>';
                });
                $('#tbody-ongkir').html(html_tbody);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

    function setPriceOngkir(element) {
        let priceOngkir = element.value;
        $('#price-ongkir').text('Rp ' + priceOngkir.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        let priceTotal = parseInt('<?= $total ?>') + parseInt(priceOngkir);
        $('#price-total').text('Rp ' + priceTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('#total_price').val(priceTotal);
    }
</script>