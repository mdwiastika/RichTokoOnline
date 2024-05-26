<?php
$copyright = 'MdwiShop';
$title = 'Manajemen Products';
$sub_title = 'Create Products';
include_once './../partials/header.php';
include_once './../partials/sidebar.php';
include_once './../../connection/connection.php';
$id_product = $_GET['id'];
$product = $pdo->query("SELECT * FROM products p 
INNER JOIN categories c ON p.category_id = c.id_category
INNER JOIN users u ON p.user_id = u.id 
WHERE id_product = $id_product")->fetch();
$variant_products = $pdo->query("SELECT * FROM variant_products WHERE product_id = $id_product")->fetchAll();
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
        <?php
        ?>
        <div class="container-fluid">
            <div class="row">
                <form class="card card-success card-outline mb-4" method="POST" action="./post-edit.php" enctype="multipart/form-data">
                    <div class="card-header">
                        <div class="card-title fw-bold">Edit Product</div>
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
                        <input type="hidden" name="product_id" value="<?= $id_product ?>">
                        <div class="mb-3 col-12 col-md-6">
                            <label for="category_id" class="form-label"> Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" disabled>.:: Pilih Kategori Terlebih Dahulu ::.</option>
                                <option value="<?= $product['category_id'] ?>" selected><?= $product['name_category'] ?></option>
                            </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="user_id" class="form-label"> User</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" selected disabled>.:: Pilih User Terlebih Dahulu ::.</option>
                                <option value="<?= $product['user_id'] ?>" selected><?= $product['name'] ?></option>
                            </select>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="name_product" class="form-label">Name</label>
                            <input type="text" name="name_product" value="<?= $product['name_product'] ?>" class="form-control" id="name_product" placeholder="Enter Name">
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="description_product" class="form-label">Description</label>
                            <input name="description_product" value='<?= $product['description_product'] ?>' id="description_product" type="hidden" />
                            <div id="div_editor1" class="richtexteditor" style="width: 960px;margin:0 auto;">
                                <?= $product['description_product'] ?>
                            </div>
                        </div>
                        <div class="mb-3 col-12">
                            <button class="btn btn-primary rounded-md" onclick="addVariant(event)"><i class="bi bi-plus"></i> Add Variant Product</button>
                        </div>
                        <div class="col-12">
                            <table class="table-variant table table-bordered">
                                <tr>
                                    <th>No</th>
                                    <th>Name Variant</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($variant_products as $key => $variant_product) : ?>
                                    <tr>
                                        <input type="hidden" name="variant_product_id[]" value="<?= $variant_product['id_variant_product'] ?>">
                                        <td><?= $key + 1 ?></td>
                                        <td><input type="text" value="<?= $variant_product['name_variant_product'] ?>" name="name_variant_product[]" placeholder="Enter Name"></td>
                                        <td><input type="text" value="<?= $variant_product['price_variant_product'] ?>" onkeyup="formatRupiah(this.value, 'Rp. ', this)" name="price_variant_product[]" placeholder="Enter Price"></td>
                                        <td><input type="number" value="<?= $variant_product['stock_variant_product'] ?>" name="stock_variant_product[]" placeholder="Enter Stock"></td>
                                        <td>
                                            <input type="file" onchange="showImage(this)" name="img_variant_product[]">
                                            <img src="<?= $variant_product['img_variant_product'] ?>" alt="" class="img-rounded d-block" id="show-img">
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" onclick="removeVariant(event)"><i class="bi bi-trash"></i> Remove</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/products" class="btn btn-warning">Kembali</a>
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
    $('#category_id').select2({
        ajax: {
            url: '/api/get-categories.php',
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
                            id: item.id_category,
                            text: item.name_category
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

    let editor1 = new RichTextEditor(document.getElementById("div_editor1"));
    editor1.attachEvent("change", function() {
        document.getElementById("description_product").value = editor1.getHTMLCode();
    });
    let no = 1;

    function addVariant(element) {
        element.preventDefault();
        let tableVariant = document.querySelector('.table-variant');
        let html_add = `<tr>
                                    <td>${no++}</td>
                                    <input type="hidden" name="variant_product_id[]">
                                    <td><input type="text" placeholder="Enter Name" name="name_variant_product[]"></td>
                                    <td><input type="text" placeholder="Enter Price" onkeyup="formatRupiah(this.value, 'Rp. ', this)" name="price_variant_product[]"></td>
                                    <td><input type="number" placeholder="Enter Stock" name="stock_variant_product[]"></td>
                                    <td>
                                        <input type="file" onchange="showImage(this)" name="img_variant_product[]">
                                        <img src="" alt="" class="img-rounded" id="show-img">
                                    </td>
                                    <td>
                                        <button class="btn btn-danger rounded-md" onclick="removeVariant(event)"><i class="bi bi-trash"></i> Remove</button>
                                    </td>
                                </tr>`;
        tableVariant.innerHTML += html_add;
    }

    function removeVariant(element) {
        element.preventDefault();
        element.target.parentElement.parentElement.remove();
    }

    function formatRupiah(number, prefix, element) {
        var number_string = number.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            remaining = split[0].length % 3,
            rupiah = split[0].substr(0, remaining),
            ribuan = split[0].substr(remaining).match(/\d{3}/gi);

        if (ribuan) {
            separator = remaining ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        element.value = prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>