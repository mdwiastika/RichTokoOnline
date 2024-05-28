<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Transactions';
$sub_title = 'Manajemen Transactions';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$transactions = $pdo->query("SELECT * FROM transactions t
                            INNER JOIN transaction_details td ON t.id_transaction = td.transaction_id
                            INNER JOIN users u ON t.user_id = u.id
                            INNER JOIN variant_products vp ON td.variant_product_id = vp.id_variant_product
                            INNER JOIN products p ON vp.product_id = p.id_product
                            ORDER BY id_transaction")->fetchAll();
?>
<style>
    .dt-input {
        margin-right: 0.5em;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />

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
                <div class="col-12 bg-white p-3 shadow-sm">
                    <table id="manajemen-table" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Resi</th>
                                <th>Buyer</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($transactions as $transaction) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $transaction['external_id'] ?></td>
                                    <td><?= $transaction['name'] ?></td>
                                    <td>
                                        <?php
                                        $status = $transaction['status'];
                                        $button_class = '';
                                        $icon_class = '';

                                        switch ($status) {
                                            case 'Pending':
                                                $button_class = 'btn-warning';
                                                $icon_class = 'bi-clock';
                                                break;
                                            case 'Confirmed':
                                                $button_class = 'btn-primary';
                                                $icon_class = 'bi-check2';
                                                break;
                                            case 'Shipped':
                                                $button_class = 'btn-primary';
                                                $icon_class = 'bi-truck';
                                                break;
                                            case 'Delivered':
                                                $button_class = 'btn-success';
                                                $icon_class = 'bi-check2';
                                                break;
                                            case 'Return':
                                                $button_class = 'btn-info';
                                                $icon_class = 'bi-arrow-return-left';
                                                break;
                                            case 'Cancelled':
                                                $button_class = 'btn-danger';
                                                $icon_class = 'bi-x';
                                                break;
                                            default:
                                                $button_class = 'btn-secondary';
                                                $icon_class = 'bi-question';
                                                break;
                                        }
                                        ?>

                                        <button class="btn btn-sm <?= $button_class ?> fw-bold rounded-3" disabled>
                                            <i class="bi <?= $icon_class ?>"></i> &nbsp;<?= ucfirst($status) ?>
                                        </button>
                                    </td>
                                    <td><?= $transaction['created_at'] ?></td>
                                    <td>
                                        <a href="/admin/transactions/show.php?id=<?= $transaction['id_transaction'] ?>" class="btn btn-sm btn-primary fw-bold rounded-3"><i class="bi bi-eye"></i> Show</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once './../partials/footer.php';
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#manajemen-table').DataTable();
    });

    function confirmDelete(message) {
        const result = confirm(message);
        if (result) {
            return true;
        } else {
            event.preventDefault();
            return false;
        }
    }
</script>