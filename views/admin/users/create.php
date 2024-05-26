<?php
$copyright = 'MdwiShop';
$title = 'Manajemen User';
$sub_title = 'Create User';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
?>
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
                <form class="card card-success card-outline mb-4" method="POST" action="./post-create.php">
                    <div class="card-header">
                        <div class="card-title fw-bold">Create User</div>
                    </div>
                    <div class="card-body row">
                        <?php
                        $error = $_SESSION['error'] ?? null;
                        ?>
                        <?php if ($error) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php
                            unset($_SESSION['error']);
                        endif;
                        ?>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control">
                                <?php if ($_SESSION['user']['role'] == 'super admin') : ?>
                                    <option value="admin">Admin</option>
                                <?php endif; ?>
                                <option value="buyer">Buyer</option>
                            </select>
                        </div>

                        <div class="mb-3 col-12 col-md-6">
                            <label for="province" class="form-label">Province</label>
                            <input type="text" name="province" class="form-control" id="province" placeholder="Enter Province">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" id="city" placeholder="Enter City">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" placeholder="Enter Address"></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/users" class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> <!--end::Footer-->
                </form>
            </div>
        </div>
    </div>
</main>
<?php
include_once './../partials/footer.php';
?>
</script>