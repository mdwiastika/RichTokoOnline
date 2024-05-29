<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Products';
$sub_title = 'Manajemen Products';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$stmt_products = $pdo->prepare("SELECT * FROM products p 
INNER JOIN categories c ON p.category_id = c.id_category 
INNER JOIN users u ON p.user_id = u.id ORDER BY id_product DESC");
$stmt_products->execute();
$products = $stmt_products->fetchAll();
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
                    <a href="/admin/products/create.php" class="btn btn-success mb-3"><i class="bi bi-plus-lg"></i> Create Data</a>
                    <table id="manajemen-table" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Seller</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($products as $product) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $product['name_product'] ?></td>
                                    <td><?= $product['name_category'] ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= $product['slug_product'] ?></td>
                                    <td>
                                        <a href="/admin/products/edit.php?id=<?= $product['id_product'] ?>" class="btn btn-sm btn-warning text-white fw-bold rounded-3"><i class="bi bi-pen"></i> Edit</a>
                                        <a href="/admin/products/delete.php?id=<?= $product['id_product'] ?>" onclick="confirmDelete(event)" class="btn btn-sm btn-danger fw-bold rounded-3"><i class="bi bi-trash"></i> Delete</a>
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
</script>