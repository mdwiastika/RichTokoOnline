<?php
$title = 'History Transaction';
include_once './../partials/header.php';
include_once './../connection/connection.php';
if (!isset($_SESSION['user'])) {
    header('Location: /auth/login.php');
}
$external_id = $_GET['external_id'];
$user = $_SESSION['user'];
$detail_transactions = $pdo->query("SELECT * FROM transaction_details
 INNER JOIN variant_products ON transaction_details.variant_product_id = variant_products.id_variant_product
 INNER JOIN products ON variant_products.product_id = products.id_product
INNER JOIN transactions ON transaction_details.transaction_id = transactions.id_transaction
 WHERE transactions.external_id = '$external_id'")->fetchAll();
$transaction = $pdo->query("SELECT * FROM transactions t
 WHERE t.external_id = '$external_id'")->fetch();

?>
<link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<!-- Start Hero -->
<section class="relative lg:py-24 py-16 bg-slate-50">
    <div class="container relative">
        <div class="md:flex justify-center mt-24">
            <div class="lg:w-4/5 w-full">
                <div class="p-6 rounded-md shadow bg-white" id="download-invoice">
                    <div class="border-b border-gray-100 pb-6">
                        <div class="md:flex justify-between">
                            <div>
                                <img src="/assets/logo-2-no-bg.png" class="w-36 h-auto" alt="">
                                <div class="flex mt-4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="md:flex justify-between">
                        <div class="mt-6">
                            <h5 class="text-lg font-semibold">Invoice Details :</h5>

                            <ul class="list-none">
                                <li class="flex mt-3">
                                    <span class="w-24">Invoice No. :</span>
                                    <span class="text-slate-500"><?= $transaction['external_id']; ?></span>
                                </li>

                                <li class="flex mt-3">
                                    <span class="w-24">Name :</span>
                                    <span class="text-slate-500"><?= $user['name']; ?></span>
                                </li>

                                <li class="flex mt-3">
                                    <span class="w-24">Address :</span>
                                    <span class="text-slate-500"><?= $transaction['address']; ?></span>
                                </li>

                                <li class="flex mt-3">
                                    <span class="w-24">Phone :</span>
                                    <span class="text-slate-500"><?= $transaction['phone']; ?></span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-3 md:w-56">
                            <ul class="list-none">
                                <li class="flex mt-3">
                                    <span class="w-24">Date :</span>
                                    <span class="text-slate-500"><?= date('Y-m-d H:i', strtotime($transaction['created_at'])); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow rounded-md mt-6">
                        <table class="w-full text-start text-slate-500">
                            <thead class="text-sm uppercase bg-slate-50">
                                <tr>
                                    <th scope="col" class="text-center px-6 py-3 w-16">
                                        No.
                                    </th>
                                    <th scope="col" class="text-start px-6 py-3">
                                        Items
                                    </th>
                                    <th scope="col" class="text-center px-6 py-3 w-20">
                                        Qty
                                    </th>
                                    <th scope="col" class="text-center px-6 py-3 w-28">
                                        Price
                                    </th>
                                    <th scope="col" class="text-end px-6 py-3 w-20">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;
                                $subtotal = 0;
                                $taxes = 0;
                                $total = 0;
                                foreach ($detail_transactions as $detail_transaction) : ?>
                                    <?php
                                    $subtotal += $detail_transaction['price_variant_product'] * $detail_transaction['quantity'];
                                    ?>
                                    <tr class="bg-white">
                                        <td class="text-center px-6 py-4">
                                            <?= $index++ ?>
                                        </td>
                                        <th scope="row" class="text-start px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            <?= $detail_transaction['name_product'] ?> (<?= $detail_transaction['name_variant_product'] ?>)
                                        </th>
                                        <td class="text-center px-6 py-4">
                                            <?= $detail_transaction['quantity'] ?>
                                        </td>
                                        <td class="text-center px-6 py-4">
                                            <?= number_format($detail_transaction['price_variant_product'], 0, ',', ',') ?>
                                        </td>
                                        <td class="text-end px-6 py-4">
                                            <?= number_format($detail_transaction['price_variant_product'] * $detail_transaction['quantity'], 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="w-56 ms-auto p-5">
                        <?php
                        $taxes = $subtotal * 0.05;
                        $total = $subtotal + $taxes;
                        $ongkir = $transaction['shipping_price'];
                        $total += $ongkir;
                        ?>
                        <ul class="list-none">
                            <li class="text-slate-500 flex justify-between">
                                <span>Subtotal :</span>
                                <span><?= number_format($subtotal, 0, ',', '.') ?></span>
                            </li>
                            <li class="text-slate-500 flex justify-between mt-2">
                                <span>Taxes :</span>
                                <span><?= number_format($taxes, 0, ',', '.') ?></span>
                            </li>
                            <li class="text-slate-500 flex justify-between mt-2">
                                <span>Shipping :</span>
                                <span><?= number_format($ongkir, 0, ',', '.') ?></span>
                            </li>
                            <li class="flex justify-between font-semibold mt-2">
                                <span>Total :</span>
                                <span><?= number_format($total, 0, ',', '.') ?></span>
                            </li>
                        </ul>
                    </div>

                    <div class="invoice-footer border-t border-gray-100 pt-6">
                        <div class="md:flex justify-between">
                            <div>
                                <div class="text-slate-500 text-center md:text-start">
                                    <h6 class="mb-0">Customer Services : <a href="tel:62895339390753" class="text-amber-500">+62 895-3393-90753</a></h6>
                                </div>
                            </div>

                            <div class="mt-4 md:mt-0">
                                <div class="text-slate-500 text-center md:text-end">
                                    <h6 class="mb-0"><a href="javascript:void(0);" onclick="downloadPdfInvoice()" class="text-white bg-orange-500 py-2 px-4 rounded">Print Inovoice</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<script src="/assets/libs/tiny-slider/min/tiny-slider.js"></script>
<?php
include_once './../partials/footer.php';
?>
<script>
    function downloadPdfInvoice() {
        let element = document.getElementById('download-invoice');

        html2canvas(element, {
            onrendered: function(canvas) {
                let imgData = canvas.toDataURL('image/png');
                let doc = new jsPDF('p', 'mm', 'a4');
                let imgWidth = 210;
                let pageHeight = 295;
                let imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;

                let position = 0;

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                doc.save('<?= $transaction['external_id'] ?>');
            }
        });
    }
</script>