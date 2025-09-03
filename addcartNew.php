<?php
session_start();
include 'db.php';

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][$product_id] = $quantity;

header('Location: cart.php');
?>
