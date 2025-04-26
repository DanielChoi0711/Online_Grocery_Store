<?php
session_start();
unset($_SESSION['cart']); // 카트를 비움
header("Location: ../pages/cart.php"); // 다시 cart 페이지로
exit();
?> 