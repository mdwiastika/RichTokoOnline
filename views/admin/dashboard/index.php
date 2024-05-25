<?php
$copyright = 'MdwiShop';
$title = 'Dashboard';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$user_count = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$product_count = $pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
$transaction_count = $pdo->query('SELECT COUNT(*) FROM transactions')->fetchColumn();
$cart_count = $pdo->query('SELECT COUNT(*) FROM carts')->fetchColumn();
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
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm"> <i class="bi bi-person-bounding-box"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Registered Users</span> <span class="info-box-number">
                                <?= $user_count ?>
                                <small>User</small> </span> </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm"> <i class="bi bi-box-fill"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Products</span> <span class="info-box-number"><?= $product_count ?></span> </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm"> <i class="bi bi-cart-fill"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Cart</span> <span class="info-box-number"><?= $cart_count ?></span> </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm"> <i class="bi bi-credit-card-2-front"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Transactions</span> <span class="info-box-number"><?= $transaction_count ?></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once './../partials/footer.php';
?>