<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Reviews';
$sub_title = 'Create Reviews';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$review_id = $_GET['id'];
$review = $pdo->query("SELECT * FROM reviews r
                    INNER JOIN users u ON r.user_id = u.id
                    INNER JOIN variant_products vp ON r.variant_product_id = vp.id_variant_product
                    INNER JOIN products p ON vp.product_id = p.id_product
                    WHERE id_review = $review_id")->fetch();
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/admin/assets/js/richtexteditor/rte_theme_default.css" />
<script type="text/javascript" src="/admin/assets/js/richtexteditor/rte.js"></script>
<script type="text/javascript" src='/admin/assets/js/richtexteditor/plugins/all_plugins.js'></script>

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
                <form class="card card-success card-outline mb-4" method="POST" action="./post-edit.php" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="card-title fw-bold">Edit Review</div>
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
                        <input type="hidden" name="id_review" id="id_review" value="<?= $review['id_review'] ?>">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="user_id" class="form-label">User Name</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" disabled>.:: Pilih User Terlebih Dahulu ::.</option>
                                <option value="<?= $review['user_id'] ?>" selected><?= $review['name'] ?></option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="variant_product_id" class="form-label">Variant Product</label>
                            <select name="variant_product_id" id="variant_product_id" class="form-control">
                                <option value="" selected disabled>.:: Pilih Variant Product Terlebih Dahulu ::.</option>
                                <option value="<?= $review['variant_product_id'] ?>" selected><?= $review['name_variant_product'] ?>(<?= $review['name_product'] ?>)</option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="star" class="form-label">Star</label>
                            <select name="star" id="star" class="form-control">
                                <option value="" selected disabled>.:: Pilih Rating Terlebih Dahulu ::.</option>
                                <option value="star_1" <?= $review['star'] == 'star_1' ? 'selected' : '' ?>>Star 1</option>
                                <option value="star_2" <?= $review['star'] == 'star_2' ? 'selected' : '' ?>>Star 2</option>
                                <option value="star_3" <?= $review['star'] == 'star_3' ? 'selected' : '' ?>>Star 3</option>
                                <option value="star_4" <?= $review['star'] == 'star_4' ? 'selected' : '' ?>>Star 4</option>
                                <option value="star_5" <?= $review['star'] == 'star_5' ? 'selected' : '' ?>>Star 5</option>

                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="image_review" class="form-label">Image</label>
                            <input type="file" onchange="showImage(this)" accept="image/*" name="image_review" class="form-control" id="image_review" placeholder="Enter Image Review">
                            <img src="<?= isset($review['image_review']) ? $review['image_review'] : '' ?>" alt="" class="img-rounded <?= isset($review['image_review']) ? 'd-block' : '' ?>" id="show-img">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="description_review" class="form-label">Description</label>
                            <input name="description_review" id="description_review" value='<?= $review['description_review'] ?>' type="hidden" />
                            <div id="div_editor1" class="richtexteditor" style="width: 960px;margin:0 auto;">
                                <?= $review['description_review'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/reviews" class="btn btn-warning">Kembali</a>
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

    function showImage(element) {
        const file = element.files[0];
        const showImg = element.nextElementSibling;
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                showImg.src = e.target.result;
            }
            reader.readAsDataURL(file);
            showImg.style.display = 'block';
        }
    }
    $('#parent_reviews_id').select2({
        ajax: {
            url: '/api/get-reviews.php',
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
                            id: item.id_review,
                            text: item.name + `(${item.id_review})`
                        }
                    })
                }
            }
        }
    })
    $('#user_id').select2({
        ajax: {
            url: '/api/get-users.php',
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
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        }
    })
    $('#variant_product_id').select2({
        ajax: {
            url: '/api/get-variant-products.php',
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
                            id: item.id_variant_product,
                            text: item.name_variant_product + ` (${item.name_product})`
                        }
                    })
                }
            }
        }
    })
    let editor1 = new RichTextEditor(document.getElementById("div_editor1"));
    editor1.attachEvent("change", function() {
        document.getElementById("description_review").value = editor1.getHTMLCode();
    });
</script>