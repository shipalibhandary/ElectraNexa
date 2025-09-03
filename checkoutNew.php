<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = 1; // Assuming a logged-in user with ID 1
    $total = $_POST['total'];

    $sql = "INSERT INTO orders (user_id, total) VALUES ($user_id, $total)";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $sql = "SELECT price FROM products WHERE id = $product_id";
            $result = $conn->query($sql);
            $product = $result->fetch_assoc();
            $price = $product['price'];
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity, $price)";
            $conn->query($sql);
        }
        unset($_SESSION['cart']);
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    $total = 0;
    foreach ($cart as $product_id => $quantity) {
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();
        $total += $product['price'] * $quantity;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
    </head>
    <body>
        <h1>Checkout</h1>
        <form action="checkout.php" method="post">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <button type="submit">Place Order</button>
        </form>
    </body>
    </html>

<?php
}
?>
