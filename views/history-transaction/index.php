<?php
$title = 'History Transaction';
include_once './../partials/header.php';
if (!isset($_SESSION['user'])) {
    header('Location: /auth/login.php');
}
?>
<link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">

<!-- Start Hero -->
<section class="relative table w-full py-20 lg:py-24 bg-gray-50 dark:bg-slate-800">
    <div class="container relative">
        <div class="grid grid-cols-1 mt-14">
            <h3 class="text-3xl leading-normal font-semibold">History Transaction</h3>
        </div><!--end grid-->

        <div class="relative mt-3">
            <ul class="tracking-[0.5px] mb-0 inline-block">
                <li class="inline-block uppercase text-[13px] font-bold duration-500 ease-in-out hover:text-orange-500"><a href="/">MdwiShop</a></li>
                <li class="inline-block text-base text-slate-950 dark:text-white mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="mdi mdi-chevron-right"></i></li>
                <li class="inline-block uppercase text-[13px] font-bold text-orange-500" aria-current="page">History Transaction</li>
            </ul>
        </div>
    </div><!--end container-->
</section><!--end section-->
<!-- End Hero -->

<!-- Start -->
<section id="parent-refresh-history">
    <section class="relative md:py-24 py-16" id="history-refresh">
        <?php
        $user_id = $_SESSION['user']['id'];
        $transactions = $pdo->query("SELECT * FROM transactions t
        INNER JOIN users u ON t.user_id = u.id
        WHERE t.user_id = $user_id
        ORDER BY t.id_transaction DESC")->fetchAll();
        ?>
        <form class="container relative" method="post" action="/history">
            <div class="grid lg:grid-cols-1">
                <div class="relative overflow-x-auto shadow dark:shadow-gray-800 rounded-md">
                    <table class="w-full text-start" id="history-table">
                        <thead class="text-sm uppercase bg-slate-50 dark:bg-slate-800">
                            <tr>
                                <th scope="col" class="p-4 w-4"></th>
                                <th scope="col" class="text-start p-4 min-w-[220px]">External ID</th>
                                <th scope="col" class="text-start p-4 w-36 min-w-[200px]">Status</th>
                                <th scope="col" class="p-4 w-56 min-w-[220px]">Address</th>
                                <th scope="col" class="text-start p-4 w-36 min-w-[200px]">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transactions as $transaction) : ?>
                                <tr class="bg-white dark:bg-slate-900">
                                    <td class="p-4">
                                        <a href="/detail-transaction?external_id=<?= $transaction['external_id'] ?>" class="flex items-center justify-center w-8 h-8 bg-blue-600"><i class="mdi mdi-eye text-white"></i></a>
                                    </td>
                                    <td class="p-4"><?= $transaction['external_id'] ?></td>
                                    <td class="p-4">
                                        <?php
                                        $status = $transaction['status'];
                                        $color = '';
                                        switch ($status) {
                                            case 'Pending':
                                                $color = 'text-yellow-500';
                                                break;
                                            case 'Confirmed':
                                                $color = 'text-green-500';
                                                break;
                                            case 'Shipped':
                                                $color = 'text-blue-500';
                                                break;
                                            case 'Delivered':
                                                $color = 'text-purple-500';
                                                break;
                                            case 'Return':
                                                $color = 'text-red-500';
                                                break;
                                            case 'Cancelled':
                                                $color = 'text-gray-500';
                                                break;
                                            default:
                                                $color = 'text-black';
                                                break;
                                        }
                                        ?>
                                        <span class="font-semibold <?php echo $color; ?>"><?php echo $status; ?></span>
                                    </td>
                                    <td class="p-4"><?= $transaction['address'] ?></td>
                                    <td class="p-4">Rp <?= number_format($transaction['total_price'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form><!--end container-->
    </section><!--end section-->
</section>
<!-- End -->
<script src="/assets/libs/tiny-slider/min/tiny-slider.js"></script>
<?php
include_once './../partials/footer.php';
?>
<script>
</script>