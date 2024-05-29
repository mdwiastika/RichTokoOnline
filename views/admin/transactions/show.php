<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Transactions';
$sub_title = 'Manajemen Transactions';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$id = $_GET['id'];
$transaction = $pdo->query("SELECT * FROM transactions t
                            INNER JOIN users u ON t.user_id = u.id
                            WHERE t.id_transaction = $id")->fetch();
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0"><?= $title ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= $title ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <form class="card card-info card-outline mb-4 col-12" method="POST" action="./post-create.php" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="card-title
                        fw-bold">Detail Transaction</div>
                    </div>
                    <div class="card-body detil-transaction-card">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>No. Resi</th>
                                <td><?= $transaction['external_id'] ?></td>
                            </tr>
                            <tr>
                                <th>Buyer</th>
                                <td><?= $transaction['name'] ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?= $transaction['status'] ?></td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td><?= date('Y-m-d H:i', strtotime($transaction['created_at'])); ?></td>
                            </tr>
                            <tr>
                                <th>Shipping Price</th>
                                <td>Rp. <?= number_format($transaction['shipping_price'], 0, '.', ',') ?></td>
                            </tr>
                            <tr>
                                <th>Total Price: </th>
                                <td class="text-danger fw-bold">Rp. <?= number_format($transaction['total_price'], 0, '.', ',') ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?= $transaction['address'] ?></td>
                            </tr>
                            <tr>
                                <th>Whatsapp</th>
                                <?php
                                $phone_number = $transaction['phone'];
                                $phone_number = preg_replace('/^0/', '62', preg_replace('/[+\-\s]/', '', $phone_number));
                                ?>
                                <td><a href="https://wa.me/<?= $phone_number ?>" class="btn btn-success" target="_blank"><i class="bi bi-whatsapp"></i> Whatsapp</a></td>
                            </tr>
                        </table>
                        <div class="product detail mt-4">
                            <h4>Product</h4>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Variant</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    $list_transactions = $pdo->query("SELECT * FROM transaction_details td
                                    INNER JOIN variant_products vp ON td.variant_product_id = vp.id_variant_product
                                    INNER JOIN products p ON vp.product_id = p.id_product
                                    WHERE td.transaction_id = $id");
                                    foreach ($list_transactions as $list_transaction) {
                                        $subtotal = $list_transaction['price_variant_product'] * $list_transaction['quantity'];
                                        $total += $subtotal;
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $list_transaction['name_product'] ?></td>
                                            <td><?= $list_transaction['name_variant_product'] ?></td>
                                            <td>Rp. <?= number_format($list_transaction['price_variant_product'], 0, '.', ',') ?></td>
                                            <td><?= $list_transaction['quantity'] ?></td>
                                            <td>Rp. <?= number_format($subtotal, 0, '.', ',') ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Total</td>
                                        <td>Rp. <?= number_format($total, 0, '.', ',') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer row">
                        <div class="col-12 d-flex justify-content-between">
                            <div class="">
                                <a href="/admin/transactions" class="btn btn-warning">Kembali</a>
                            </div>
                            <div class="">
                                <?php if ($transaction['status'] == 'Pending') : ?>
                                    <a href="/admin/transactions/action.php?id=<?= $transaction['id_transaction'] ?>&status=Confirmed" class="btn btn-success" onclick="confirmAction(event, 'Confirm')">Confirm</a>
                                <?php elseif ($transaction['status'] == 'Confirmed') : ?>
                                    <a href="/admin/transactions/action.php?id=<?= $transaction['id_transaction'] ?>&status=Shipped" class="btn btn-primary" onclick="confirmAction(event, 'Shipped')">Shipped</a>
                                <?php elseif ($transaction['status'] == 'Shipped') : ?>
                                    <a href="/admin/transactions/action.php?id=<?= $transaction['id_transaction'] ?>&status=Delivered" class="btn btn-success" onclick="confirmAction(event, 'Delivered')">Delivered</a>
                                <?php elseif ($transaction['status'] == 'Delivered') : ?>
                                    <a href="/admin/transactions/action.php?id=<?= $transaction['id_transaction'] ?>&status=Return" class="btn btn-danger" onclick="confirmAction(event, 'Return')">Return</a>
                                <?php endif; ?>
                                <?php
                                if ($transaction['status'] == 'Pending' || $transaction['status'] == 'Confirmed' || $transaction['status'] == 'Shipped' || $transaction['status'] == 'Delivered') {  ?>
                                    <a href="/admin/transactions/action.php?id=<?= $transaction['id_transaction'] ?>&status=Cancelled" class="btn btn-danger" onclick="confirmAction(event, 'Cancel')">Cancel</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
include_once './../partials/footer.php';
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const iconParentCategory = document.querySelector('#icon_category');
    const showImg = document.querySelector('#show-img');

    function showImage() {
        const file = iconParentCategory.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                showImg.src = e.target.result;
            }
            reader.readAsDataURL(file);
            showImg.style.display = 'block';
        }
    }
    iconParentCategory.addEventListener('change', function() {
        showImage();
    });

    function confirmAction(element, action) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: `Do you want to ${action} this data?`,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = element.target.href;
            }
        });
    }
</script>