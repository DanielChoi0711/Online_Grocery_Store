<?php
session_start();
include('../DB/db.php'); // DB 연결

// 사용자 정보
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$postcode = $_POST['postcode'];

// 장바구니 가져오기
$cart = $_SESSION['cart'] ?? [];

// 재고 확인
foreach ($cart as $productId => $item) {
    $quantity = $item['quantity'];

    $query = "SELECT in_stock FROM products WHERE product_id = $productId";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product || $product['in_stock'] < $quantity) {
        $_SESSION['error_message'] = "Item '{$item['name']}' is out of stock or insufficient for your order.";
        header("Location: ../pages/cart.php");
        exit();
    }
}

// 재고 차감
foreach ($cart as $productId => $item) {
    $quantity = $item['quantity'];
    $updateQuery = "UPDATE products SET in_stock = in_stock - $quantity WHERE product_id = $productId";
    mysqli_query($conn, $updateQuery);
}

// 장바구니 비우기
unset($_SESSION['cart']);

// 주문 완료 페이지 이동
header("Location: ../pages/confirmation.php?name=" . urlencode($name));
exit;
?>