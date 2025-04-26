<?php
// place_order.php

// 장바구니 세션 확인
session_start();
$cart = $_SESSION['cart']; // 예시로 세션에 저장된 장바구니 데이터

// 재고 확인 (DB에서 상품 정보를 조회)
foreach ($cart as $item) {
    $productId = $item['product_id'];
    $quantity = $item['quantity'];

    // 재고 수량 확인
    $query = "SELECT in_stock FROM products WHERE product_id = $productId";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    if ($product['in_stock'] < $quantity) {
        // 재고가 부족하면 에러 메시지 출력하고 장바구니로 리디렉션
        $_SESSION['error_message'] = "Item {$item['product_name']} is out of stock or insufficient for your order.";
        header("Location: cart.php");
        exit();
    }
}

// 재고가 충분하면 주문 처리
// 주문 DB에 저장
// 이메일 발송 등 추가 작업
?>