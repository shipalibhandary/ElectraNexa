<?php
session_start();
include 'db.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    <?php if (!empty($cart)): ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php foreach ($cart as $product_id => $quantity): ?>
                <?php
                $sql = "SELECT * FROM products WHERE id = $product_id";
                $result = $conn->query($sql);
                $product = $result->fetch_assoc();
                $total += $product['price'] * $quantity;
                ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>$<?php echo $product['price']; ?></td>
                    <td>$<?php echo $product['price'] * $quantity; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3">Total</td>
                <td>$<?php echo $total; ?></td>
            </tr>
        </table>
        <a href="checkout.php">Proceed to Checkout</a>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>
