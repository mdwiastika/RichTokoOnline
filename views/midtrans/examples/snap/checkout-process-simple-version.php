<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
include_once './../../../connection/connection.php';
session_start();
Config::$serverKey = 'SB-Mid-server-oqul9_MlVfj70z1CJFQEiBL1';
Config::$clientKey = 'SB-Mid-client-tpYRzAqM1pmeORCI';
$username = $_POST['username'];
$email = $_POST['email'];
$user_id = $_SESSION['user']['id'];
$phone_number = $_POST['phone_number'];
$total_price = $_POST['total_price'];
$shipping_price = $_POST['ongkir'];
$status = 'Pending';
$address = $_POST['address'];
$external_id_transaction_previous = $pdo->query("SELECT external_id FROM transactions ORDER BY id_transaction DESC LIMIT 1")->fetchColumn();
$external_id = substr($external_id_transaction_previous, 3) + 1;
$external_id = 'EXT' . str_pad($external_id, 6, '0', STR_PAD_LEFT);
$create_transsaction = $pdo->query("INSERT INTO transactions (external_id, user_id, phone, total_price, shipping_price, status, address) VALUES ('$external_id', $user_id, '$phone_number', $total_price, $shipping_price, '$status', '$address')");
$transaction_id = $pdo->lastInsertId();
$implode_cart_id = implode(',', $_POST['arr_id_cart']);
$carts_seelcted = $pdo->query("SELECT * FROM carts c
                                INNER JOIN variant_products v ON c.variant_product_id = v.id_variant_product
                                INNER JOIN products p ON v.product_id = p.id_product
                                WHERE id_cart IN ($implode_cart_id)")->fetchAll();
foreach ($carts_seelcted as $cart) {
    $create_transaction_detail = "INSERT INTO transaction_details (transaction_id, variant_product_id, quantity) VALUES ($transaction_id, " . $cart['variant_product_id'] . ", " . $cart['quantity'] . ");";
    $pdo->query($create_transaction_detail);
}
$remove_cart = $pdo->query("DELETE FROM carts WHERE id_cart IN ($implode_cart_id)");
// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
$transaction_details = array(
    'order_id' => $external_id,
    'gross_amount' => $total_price, // no decimal allowed for creditcard
);
// Optional
$item_details = array();
foreach ($carts_seelcted as $cart) {
    $item_details[] = array(
        'id' => $cart['variant_product_id'],
        'price' => $cart['price_variant_product'],
        'quantity' => $cart['quantity'],
        'name' => $cart['name_product'],
    );
}
// Optional
$customer_details = array(
    'first_name'    => "$username",
    'email'         => "$email",
    'phone'         => "$phone_number",
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
} catch (\Exception $e) {
    echo $e->getMessage();
}
// echo "snapToken = " . $snap_token;

function printExampleWarningMessage()
{
    if (strpos(Config::$serverKey, 'your ') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    }
}

?>

<!DOCTYPE html>
<html>

<body>
    <button id="pay-button">Pay!</button>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('pay-button').click();
        });
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('<?php echo $snap_token ?>');
        };
    </script>
</body>

</html>