<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Categories';
$sub_title = 'Create Categories';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
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
                <form class="card card-success card-outline mb-4" method="POST" action="./post-create.php" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="card-title fw-bold">Create Category</div>
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
                        <div class="mb-3 col-12">
                            <label for="parent_category_id" class="form-label">Parent Category</label>
                            <select name="parent_category_id" id="parent_category_id" class="form-control">
                                <option value="" selected disabled>.:: Pilih Kategori Terlebih Dahulu ::.</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="name_category" class="form-label">Name</label>
                            <input type="text" name="name_category" class="form-control" id="name_category" placeholder="Enter Name">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="icon_category" class="form-label">Icon Category</label>
                            <input type="file" accept="image/*" name="icon_category" class="form-control" id="icon_category" placeholder="Enter Icon_category">
                            <img src="" alt="" class="img-rounded" id="show-img">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/categories" class="btn btn-warning">Kembali</a>
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
    $('#parent_category_id').select2({
        ajax: {
            url: '/api/get-parent-categories.php',
            data: function(params) {
                let query = {
                    search: params.term,
                    type: 'public'
                }
                return query;
            },
            processResults: function(data) {
                let json_data = JSON.parse(data);
                return {
                    results: json_data.map(function(item) {
                        return {
                            id: item.id_parent_category,
                            text: item.name_parent_category
                        }
                    })
                }
            }
        }
    })
</script>