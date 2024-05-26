<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Parent Categories';
$sub_title = 'Create Parent Categories';
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
                <form class="card card-success card-outline mb-4" method="POST" action="./post-create.php" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="card-title fw-bold">Create Parent Category</div>
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
                            <label for="name_parent_category" class="form-label">Name</label>
                            <input type="text" name="name_parent_category" class="form-control" id="name_parent_category" placeholder="Enter Name">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="icon_parent_category" class="form-label">Icon Parent Category</label>
                            <input type="file" accept="image/*" name="icon_parent_category" class="form-control" id="icon_parent_category" placeholder="Enter Icon_parent_category">
                            <img src="" alt="" class="img-rounded" id="show-img">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/parent-categories" class="btn btn-warning">Kembali</a>
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
<script>
    const iconParentCategory = document.querySelector('#icon_parent_category');
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
</script>