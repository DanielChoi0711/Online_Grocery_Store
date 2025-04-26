<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 절대 경로로 db.php 파일 포함
include(__DIR__ . '/../DB/db.php');

// URL에서 카테고리 ID를 정수로 받음
$category_id = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;

// 해당 카테고리 ID에 해당하는 상품을 직접 조회
$sql = "SELECT * FROM products WHERE category_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $category_id); // i: integer
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="category-products">
    <h2 style="text-align:center;">Shop - <?= $category_id ?></h2>
    
    <ul class="category-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li class="category-item">
                <img src="Assets/Category_images/<?= $row['product_name'] ?>.png" alt="<?= $row['product_name'] ?>">
                <h3><?= $row['product_name'] ?></h3>
                <p>Price: $<?= $row['unit_price'] ?></p>
                <p>Available: <?= $row['in_stock'] ?> in stock</p>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

