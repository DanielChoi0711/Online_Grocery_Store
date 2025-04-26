<?php
session_start();
require_once('../DB/db.php'); // DB 연결

// 배송 정보 유효성 검사
$required_fields = ['recipient_name', 'email', 'mobile', 'street', 'city', 'state'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        die("Missing delivery detail: $field");
    }
}

// 배송 정보 저장
$delivery = [
    'name' => htmlspecialchars($_POST['recipient_name']),
    'email' => htmlspecialchars($_POST['email']),
    'mobile' => htmlspecialchars($_POST['mobile']),
    'street' => htmlspecialchars($_POST['street']),
    'city' => htmlspecialchars($_POST['city']),
    'state' => htmlspecialchars($_POST['state']),
];

// 장바구니 정보 확인
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) === 0) {
    header("Location: ../pages/cart.php");
    exit;
}

$cart = $_SESSION['cart'];
$errors = [];

foreach ($cart as $item) {
    $product_id = $item['product_id'];
    $quantity_requested = $item['quantity'];

    $stmt = $conn->prepare("SELECT in_stock, product_name FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        $errors[] = "Product ID $product_id not found.";
        continue;
    }

    if ($product['in_stock'] < $quantity_requested) {
        $errors[] = "{$product['product_name']} has only {$product['in_stock']} items left.";
    }
}

if (!empty($errors)) {
    // 재고 부족 → cart 페이지로 돌아감
    $_SESSION['error_messages'] = $errors;
    header("Location: ../pages/cart.php");
    exit;
}

// TODO: 주문 정보를 DB에 저장하는 로직 (옵션)

// 장바구니 비우기
unset($_SESSION['cart']);

// 배송 정보 저장 (선택 사항 - confirmation.php에서 표시할 용도)
$_SESSION['delivery'] = $delivery;

// 주문 확인 페이지로 이동
header("Location: ../pages/confirmation.php");
exit; 