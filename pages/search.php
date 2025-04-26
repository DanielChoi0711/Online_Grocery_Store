<?php include '../header.php'; ?>

</div>

<?php
include('../DB/db.php');
global $conn;
?>

<link rel="stylesheet" href="../css/style.css">

<div class="search-results">
<?php
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $query = "SELECT * FROM products WHERE product_name LIKE ?";
    $stmt = $conn->prepare($query);
    $search_term = "%" . $_GET['search'] . "%";
    $stmt->bind_param('s', $search_term);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        // 재고 상태에 따라 버튼을 동적으로 처리
        $in_stock = $row['in_stock'];
        $button_class = $in_stock > 0 ? 'add-to-cart' : 'add-to-cart out-of-stock';
        $button_text = $in_stock > 0 ? 'Add to Cart' : 'Out of Stock';
        $disabled = $in_stock > 0 ? '' : 'disabled';
        
        echo '<div class="product-card">';
        echo '  <div class="product-left">';
        echo '    <img src="../Assets/product_images/' . htmlspecialchars($row['product_name']) . '.png" alt="' . htmlspecialchars($row['product_name']) . '">';
        echo '    <h3>' . htmlspecialchars($row['product_name']) . '</h3>';
        echo '  </div>';
        echo '  <div class="product-right">';
        echo '    <p>💲 Price: $' . htmlspecialchars($row['unit_price']) . '</p>';
        echo '    <p>📦 Quantity: ' . htmlspecialchars($row['unit_quantity']) . '</p>';
        echo '    <p>✅ Stock: ' . ($row['in_stock'] ? 'Available' : 'Unavailable') . '</p>';
        echo '  </div>';

        // 재고 상태에 따라 버튼 처리
        echo '  <button class="' . $button_class . '" ' . $disabled . ' data-id="' . $row['product_id'] . '">' . $button_text . '</button>';
        
        echo '</div>';
    }
} else {
    echo "Please fill this field.";
}
?>
</div>

<script>
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-id');

        fetch('../api/add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'product_id=' + encodeURIComponent(productId)
        })
        .then(response => response.text())
        .then(data => {
            alert("✅ Item was added successfully!");
        })
        .catch(error => {
            alert("❌ Error: " + error);
        });
    });
});
</script>

<h2 style="text-align:center; margin-top: 30px;">Shop by Category</h2>

<div class="category-grid">
<div class="category-box" onclick="location.href='/Grocery_Store/pages/category.php?cat=Fruits'">
    <img src="../Assets/Category_images/Fruit.png" alt="Fruits">
    <h3>Fruits</h3>
  </div>
  <div class="category-box" onclick="location.href='/Grocery_Store/pages/category.php?cat=Vegetables'">
    <img src="../Assets/Category_images/Vegetable.png" alt="Vegetables">
    <h3>Vegetables</h3>
  </div>
  <div class="category-box" onclick="location.href='/Grocery_Store/pages/category.php?cat=Dairy Products'">
    <img src="../Assets/Category_images/Dairy_product.png" alt="Dairy Products">
    <h3>Dairy Products</h3>
  </div>
  <div class="category-box" onclick="location.href='/Grocery_Store/pages/category.php?cat=Frozen Food'">
    <img src="../Assets/Category_images/Frozen_foods.png" alt="Frozen Food">
    <h3>Frozen Food</h3>
  </div>
  <div class="category-box" onclick="location.href='/Grocery_Store/pages/category.php?cat=Beverages & Snacks'">
    <img src="../Assets/Category_images/Beverage_and_Snack.png" alt="Beverages & Snacks">
    <h3>Beverages & Snacks</h3>
  </div>
  <div class="category-box" onclick="location.href='/Grocery_Store/pages/category.php?cat=Living items'">
    <img src="../Assets/Category_images/Living_items.png" alt="Living Items">
    <h3>Breads</h3>
  </div>
  <div class="category-box" onclick="location.href='/Grocery_Store/pages/category.php?cat=Meats'">
    <img src="../Assets/Category_images/Meat.png" alt="Meats">
    <h3>Meats</h3>
  </div>
  <div class="category-box" onclick="location.href='/Grocery_Store/pages/category.php?cat=pet Supplies'">
    <img src="../Assets/Category_images/Pet_supplies.png" alt="Pet Supplies">
    <h3>Pet Supplies</h3>
  </div>
</div>