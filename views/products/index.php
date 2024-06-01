<?php
$title = isset($_GET['category']) ? 'Categories' : 'Products';
include_once './../partials/header.php';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : '1';
$sql = "SELECT p.*, MIN(v.price_variant_product) AS price_product, MAX(v.img_variant_product) AS image_product
        FROM products p
        LEFT JOIN variant_products v ON p.id_product = v.product_id
        ";
if (!empty($category)) {
    $id_category = $pdo->query("SELECT id_category FROM categories WHERE slug_category = '$category'")->fetchColumn();
    $sql .= " WHERE category_id = :category";
}
if (!empty($search)) {
    $sql .= (!empty($category) ? " AND" : " WHERE") . " name_product LIKE :search";
}
$sql .= " AND v.id_variant_product = (SELECT id_variant_product FROM variant_products WHERE product_id = p.id_product ORDER BY id_variant_product ASC LIMIT 1)
GROUP BY p.id_product
ORDER BY p.id_product DESC";
if (!empty($page)) {
    $limit = 9;
    $offset = ($page - 1) * $limit;
    $sql .= " LIMIT $limit OFFSET $offset";
}
$stmt = $pdo->prepare($sql);
if (!empty($category) && !empty($id_category)) {
    $stmt->bindParam(':category', $id_category);
}
if (!empty($search)) {
    $searchTerm = "%$search%";
    $stmt->bindParam(':search', $searchTerm);
}
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt_total = $pdo->prepare(str_replace("LIMIT $limit OFFSET $offset", "", $sql));
if (!empty($category) && !empty($id_category)) {
    $stmt_total->bindParam(':category', $id_category);
}
if (!empty($search)) {
    $stmt_total->bindParam(':search', $searchTerm);
}
$stmt_total->execute();
$total_data = count($stmt_total->fetchAll());
$total_pagination = ceil($total_data / $limit);
?>
<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 md:pt-28 bg-gray-50">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold">All Products</h3>
        </div><!--end grid-->

        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-orange-500"><a href="/">MdwiShop</a></li>
                <li class="inline-block text-base text-slate-950 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="mdi mdi-chevron-right"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold text-orange-500" aria-current="page">All Products</li>
            </ul>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section class="relative md:py-24 py-16">
    <div class="container relative">
        <div class="grid md:grid-cols-12 sm:grid-cols-2 grid-cols-1 gap-6">
            <div class="lg:col-span-3 md:col-span-4">
                <div class="rounded shadow-md p-4 sticky top-20">
                    <h5 class="text-xl font-medium">Filter</h5>

                    <form class="mt-4">
                        <div>
                            <label for="searchname" class="font-medium">Search:</label>
                            <div class="relative mt-2">
                                <i data-feather="search" class="absolute size-4 top-[9px] end-4"></i>
                                <input type="hidden" name="category" value="<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>">
                                <input type="text" class="h-9 pe-10 rounded px-3 bg-white border border-gray-100 focus:ring-0 outline-none" name="search" id="searchItem" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="py-2 px-4 bg-orange-500 text-white rounded hover:bg-orange-600">Search</button>
                        </div>
                    </form>
                </div>
            </div><!--end col-->

            <div class="lg:col-span-9 md:col-span-8">
                <div class="md:flex justify-between items-center mb-6">
                    <span class="font-semibold">Showing <?= $offset + 1 . ' - ' . (($limit + $offset > $total_data) ? $total_data : $limit + $offset) ?> of <?= $total_data ?> items</span>

                    <!-- <div class="md:flex items-center">
                        <label class="font-semibold md:me-2">Sort by:</label>
                        <select class="form-select form-input md:w-36 w-full md:mt-0 mt-1 py-2 px-3 h-10 bg-transparent rounded outline-none border border-gray-100 focus:ring-0">
                            <option value="">Featured</option>
                            <option value="">Sale</option>
                            <option value="">Alfa A-Z</option>
                            <option value="">Alfa Z-A</option>
                            <option value="">Price Low-High</option>
                            <option value="">Price High-Low</option>
                        </select>
                    </div> -->
                </div>
                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
                    <?php foreach ($products as $product) : ?>
                        <?php
                        $id_product = $product['id_product'];
                        $rating_product = $pdo->query("SELECT star AS rating_product FROM reviews r
                                                    INNER JOIN variant_products vp ON r.variant_product_id = vp.id_variant_product
                                                    WHERE vp.product_id = $id_product")->fetchAll();
                        $average_rating = 0;
                        $total_ratings = count($rating_product);
                        $average_rating = 0;
                        if ($total_ratings > 0) {
                            foreach ($rating_product as $rating) {
                                $star = explode('_', $rating['rating_product']);
                                $average_rating += intval($star[1]);
                            }
                            $average_rating /= $total_ratings;
                        }
                        ?>
                        <div class="group">
                            <div class="relative overflow-hidden shadow group-hover:shadow-lg group-hover rounded-md duration-500">
                                <img src="<?= $product['image_product'] ?>" class="group-hover:scale-110 duration-500 h-80 w-full object-cover" alt="">

                                <div class="absolute -bottom-20 group-hover:bottom-3 start-3 end-3 duration-500">
                                    <a href="javascript:void(0)" onclick="addToCart(<?= $id_product ?>)" class="py-2 px-5 inline-block font-semibold tracking-wide align-middle duration-500 text-base text-center bg-slate-900 text-white w-full rounded-md">Add to Cart</a>
                                </div>
                                <ul class="list-none absolute top-[10px] start-4">
                                    <li><a href="javascript:void(0)" class="bg-orange-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded h-5">-50% Off</a></li>
                                </ul>
                            </div>

                            <div class="mt-4">
                                <a href="/product/<?= $product['slug_product'] ?>" class="hover:text-orange-500 text-lg font-medium"><?= $product['name_product'] ?></a>
                                <div class="flex justify-between items-center mt-1">
                                    <p>Rp. <?= number_format($product['price_product'], 0, ',', '.') ?></p>
                                    <ul class="font-medium text-amber-400 list-none">
                                        <?php for ($i = 0; $i < 5; $i++) : ?>
                                            <li class="inline"><i class="mdi mdi-star<?= $i < $average_rating ? '' : '-outline' ?>"></i></li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                        </div><!--end content-->
                    <?php endforeach; ?>
                </div><!--end grid-->

                <div class="grid md:grid-cols-12 grid-cols-1 mt-6">
                    <div class="md:col-span-12 text-center">
                        <nav aria-label="Page navigation example">
                            <ul class="inline-flex items-center -space-x-px">
                                <?php for ($i = 1; $i <= $total_pagination; $i++) : ?>
                                    <?php
                                    $current_page = isset($_GET['page']) ? $_GET['page'] : '1';
                                    ?>
                                    <li>
                                        <?php if (isset($_GET['category']) && isset($_GET['search'])) : ?>
                                            <a href="?category=<?= $_GET['category'] ?>&search=<?= $_GET['search'] ?>&page=<?= $i ?>" class="size-[40px] inline-flex justify-center items-center text-slate-400 <?= $current_page == $i ? 'bg-orange-500 text-white' : 'bg-white' ?> hover:text-white border border-gray-100 hover:border-orange-500 hover:bg-orange-500"><?= $i ?></a>
                                        <?php elseif (isset($_GET['category'])) : ?>
                                            <a href="?category=<?= $_GET['category'] ?>&page=<?= $i ?>" class="size-[40px] inline-flex justify-center items-center text-slate-400 <?= $current_page == $i ? 'bg-orange-500 text-white' : 'bg-white' ?> hover:text-white border border-gray-100 hover:border-orange-500 hover:bg-orange-500"><?= $i ?></a>
                                        <?php elseif (isset($_GET['search'])) : ?>
                                            <a href="?search=<?= $_GET['search'] ?>&page=<?= $i ?>" class="size-[40px] inline-flex justify-center items-center text-slate-400 <?= $current_page == $i ? 'bg-orange-500 text-white' : 'bg-white' ?> hover:text-white border border-gray-100 hover:border-orange-500 hover:bg-orange-500"><?= $i ?></a>
                                        <?php else : ?>
                                            <a href="?page=<?= $i ?>" class="size-[40px] inline-flex justify-center items-center text-slate-400 <?= $current_page == $i ? 'bg-orange-500 text-white' : 'bg-white' ?> hover:text-white border border-gray-100 hover:border-orange-500 hover:bg-orange-500"><?= $i ?></a>
                                        <?php endif; ?>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div><!--end col-->
                </div><!--end grid-->
            </div><!--end col-->
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end section-->
<!-- End -->

<?php
include_once './../partials/footer.php';
?>