<?php
session_start();
require_once '../DB/db.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>No items in your cart.</p>";
    exit;
}

$cart = $_SESSION['cart'];
$orderDetails = "";
$totalAmount = 0;

foreach ($cart as $productId => $quantity) {
    // Get product info
    $stmt = $pdo->prepare("SELECT product_name, unit_price, in_stock FROM products WHERE product_id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch();

    if ($product && $product['in_stock'] >= $quantity) {
        // Update stock
        $newStock = $product['in_stock'] - $quantity;
        $updateStmt = $pdo->prepare("UPDATE products SET in_stock = ? WHERE product_id = ?");
        $updateStmt->execute([$newStock, $productId]);

        // Calculate total
        $lineTotal = $product['unit_price'] * $quantity;
        $totalAmount += $lineTotal;

        // Add to order details
        $orderDetails .= "<li>{$product['product_name']} - {$quantity} units @ \${$product['unit_price']} = \$" . number_format($lineTotal, 2) . "</li>";
    } else {
        echo "<p>Sorry, '{$product['product_name']}' does not have enough stock.</p>";
        exit;
    }
}

// Clear the cart
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../header.php'; ?>

    <div class="confirmation">
        <h2>✅ Your order has been placed successfully!</h2>
        <p>Thank you for shopping with us. Below are the details of your order:</p>
        <ul>
            <?= $orderDetails ?>
        </ul>
        <p><strong>Total Amount: $<?= number_format($totalAmount, 2) ?></strong></p>
        <p>📧 A confirmation email has been sent to your registered email address.</p>
    </div>

    <?php include '../footer.php'; ?>
</body>
</html>