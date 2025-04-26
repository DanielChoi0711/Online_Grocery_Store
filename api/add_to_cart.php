<?php
session_start();
include('../DB/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // DB에서 해당 product_id의 상품 정보 불러오기
$stmt = $conn->prepare("SELECT product_name, unit_price, image_path FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // 세션 장바구니 초기화 (최초 1번만 실행됨)
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // 상품이 이미 있으면 수량만 증가
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            // 새로운 상품이면 정보와 함께 추가
            $_SESSION['cart'][$product_id] = [
                'name' => $product['product_name'],
                'quantity' => 1,
                'unit_price' => $product['unit_price'],
                'image' => $product['image_path']  // 🔥 여기 추가됨
            ];
        }

        echo "success";
    } else {
        echo "product not found";
    }
} else {
    echo "invalid request";
}
?> 

echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>";