<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Parent Categories';
$sub_title = 'Manajemen Parent Categories';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$parent_categories = $pdo->query("SELECT * FROM parent_categories")->fetchAll();
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
                    <a href="/admin/parent-categories/create.php" class="btn btn-success mb-3"><i class="bi bi-plus-lg"></i> Create Data</a>
                    <table id="manajemen-table" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Icon</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($parent_categories as $parent_category) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $parent_category['name_parent_category'] ?></td>
                                    <td><img src="<?= $parent_category['icon_parent_category'] ?>" alt="" class="img-rounded d-block"></td>
                                    <td><?= $parent_category['slug_parent_category'] ?></td>
                                    <td>
                                        <a href="/admin/parent-categories/edit.php?id=<?= $parent_category['id_parent_category'] ?>" class="btn btn-sm btn-warning text-white fw-bold rounded-3"><i class="bi bi-pen"></i> Edit</a>
                                        <a href="/admin/parent-categories/delete.php?id=<?= $parent_category['id_parent_category'] ?>" onclick="confirmDelete('Are you sure you want to delete the data?')" class="btn btn-sm btn-danger fw-bold rounded-3"><i class="bi bi-trash"></i> Delete</a>
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