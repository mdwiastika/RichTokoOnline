<?php
$copyright = 'MdwiShop';
$title = 'Manajemen User';
$sub_title = 'Manajemen User';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$users = $pdo->query("SELECT * FROM users WHERE NOT role = 'super admin' ORDER BY id")->fetchAll();
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
                    <a href="/admin/users/create.php" class="btn btn-success mb-3"><i class="bi bi-plus-lg"></i> Create Data</a>
                    <table id="manajemen-table" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($users as $user) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['role'] ?></td>
                                    <td>
                                        <a href="/admin/users/edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning text-white fw-bold rounded-3"><i class="bi bi-pen"></i> Edit</a>
                                        <a href="/admin/users/delete.php?id=<?= $user['id'] ?>" onclick="confirmDelete(event)" class="btn btn-sm btn-danger fw-bold rounded-3"><i class="bi bi-trash"></i> Delete</a>
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