<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Reviews';
$sub_title = 'Manajemen Reviews';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$stmt_reviews = $pdo->query("SELECT * FROM reviews r
INNER JOIN variant_products vp ON r.variant_product_id = vp.id_variant_product  
INNER JOIN products p ON vp.product_id = p.id_product 
INNER JOIN users u ON r.user_id = u.id
ORDER BY r.id_review DESC");
$stmt_reviews->execute();
$reviews = $stmt_reviews->fetchAll();
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
                    <a href="/admin/reviews/create.php" class="btn btn-success mb-3"><i class="bi bi-plus-lg"></i> Create Data</a>
                    <table id="manajemen-table" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name User</th>
                                <th>Name Product</th>
                                <th>Star</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($reviews as $review) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $review['name'] ?></td>
                                    <td><?= $review['name_product'] . " (" . $review['name_variant_product'] . ")" ?></td>
                                    <td>
                                        <?php
                                        $number_star = intval(substr($review['star'], 5));
                                        for ($i = 0; $i < 5; $i++) :
                                            if ($i < $number_star) :
                                        ?>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            <?php
                                            else :
                                            ?>
                                                <i class="bi bi-star-fill text-secondary"></i>
                                            <?php
                                            endif;
                                            ?>
                                        <?php
                                        endfor;
                                        ?>
                                    </td>
                                    <td>
                                        <a href="/admin/reviews/edit.php?id=<?= $review['id_review'] ?>" class="btn btn-sm btn-warning text-white fw-bold rounded-3"><i class="bi bi-pen"></i> Edit</a>
                                        <a href="/admin/reviews/delete.php?id=<?= $review['id_review'] ?>" onclick="confirmDelete(event)" class="btn btn-sm btn-danger fw-bold rounded-3"><i class="bi bi-trash"></i> Delete</a>
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