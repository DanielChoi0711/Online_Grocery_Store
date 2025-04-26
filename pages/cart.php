<?php
session_start(); // ✅ 세션 시작을 가장 먼저
include '../header.php';
?>

<h2>My Cart</h2>

<?php
if (!empty($_SESSION['cart'])) {
    // 카트 항목 리스트 출력
    echo "<div class='cart-items'>";

    $total = 0;

    // 카트 내 상품 출력
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $subtotal = $product['quantity'] * $product['unit_price'];
        $total += $subtotal;

        echo "<div class='product-card'>
                <div class='product-card-image'>
                    <img src='../Assets/product_images/{$product['image']}' alt='{$product['name']}' width='100'>
                </div>
                <div class='product-card-details'>
                    <h4>{$product['name']}</h4>
                    <p>Unit Price: \${$product['unit_price']}</p>
                    <p>Quantity: 
                        <form method='POST' action='update_cart.php'>
                            <input type='number' name='quantity' value='{$product['quantity']}' min='1'>
                            <input type='hidden' name='product_id' value='{$product_id}'>
                            <input type='submit' value='Update'>
                        </form>
                    </p>
                    <p>Total: \${$subtotal}</p>
                </div>
                <div class='product-card-actions'>
                    <a href='../api/remove_from_cart.php?id={$product_id}'>Remove</a>
                </div>
              </div>";
    }

    echo "<div class='cart-total'>
            <h3>Total: \${$total}</h3>
          </div>";

    echo "</div>";

    // 카트를 비울 수 있는 버튼
    echo "<form method='POST' action='../api/clear_cart.php'>
            <input type='submit' value='Clear Cart'>
          </form>";

    // 카트 비어있을 때 회색 비활성화 버튼, 그렇지 않으면 활성화 버튼
    if ($total > 0) {
        echo "<form action='checkout.php' method='GET'>
                <input type='submit' value='Proceed to Checkout'>
              </form>";
    } else {
        echo "<form action='#' method='GET'>
                <input type='submit' value='Proceed to Checkout' class='btn-grey' disabled>
              </form>";
        echo "<p><em>Your cart is empty. Please add items to proceed with the order.</em></p>";
    }
} else {
    echo "<p class='empty-cart-message'>Your cart is empty.</p>";
}
?>