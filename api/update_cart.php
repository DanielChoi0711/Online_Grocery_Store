<?php
session_start();

$product_id = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? null;

if (!$product_id || !$quantity) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid product ID or quantity']);
    exit;
}

// 장바구니에 해당 상품이 존재하면 수량 업데이트
if (isset($_SESSION['cart'][$product_id])) {
    if ($quantity <= 0) {
        // 수량이 0 이하로 설정되면 장바구니에서 해당 상품 삭제
        unset($_SESSION['cart'][$product_id]);
    } else {
        // 수량 업데이트
        $_SESSION['cart'][$product_id] = $quantity;
    }
    echo json_encode(['status' => 'success', 'message' => 'Cart updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Product not in cart']);
}
?> 