<?php
$current_page = basename($_SERVER['PHP_SELF']);
$hide_search_box = in_array($current_page, ['cart.php', 'checkout.php', 'confirmation.php']);
?>

<header>
    <div class="logo">
    <img src="<?php echo ($_SERVER['PHP_SELF'] === '/index.php' ? 'Assets/Logo.png' : '../Assets/Logo.png'); ?>" alt="Logo">
    </div>

     <!-- 서치박스: cart.php, checkout.php, confirmation.php 제외한 페이지에 표시 -->
     <?php if (!$hide_search_box): ?>
        <form action="pages/search.php" method="get" class="search-box">
            <input type="text" name="search" placeholder="Find Groceries" required autofocus />
            <button type="submit">🔍</button>
        </form>
    <?php endif; ?>

    <div class="cart-link">
        <a href="pages/cart.php">🛒 My cart</a>
    </div>
</header>


<link rel="stylesheet" href="../css/style.css" />


<?php
$excludedPages = ['cart.php', 'checkout.php', 'confirmation.php'];
$currentPage = basename($_SERVER['PHP_SELF']);

if (!in_array($currentPage, $excludedPages)) {
    include 'pages/category.php';
}
?>