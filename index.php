<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

include 'header.php';

switch ($path) {
    case '/':
    case '/index.php':
    case '/home':
        include 'pages/home.php';
        break;
    case '/search':
        include 'pages/search.php';
        break;
    case '/cart':
        include 'pages/cart.php';
        break;
    default:
        echo "<h2>404 - Page not found</h2>";
}

include 'footer.php';
?> 