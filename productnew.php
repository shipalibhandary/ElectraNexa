<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <p><?php echo $product['description']; ?></p>
    <p>$<?php echo $product['price']; ?></p>
    <form action="add_to_cart.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <input type="number" name="quantity" value="1" min="1">
        <button type="submit">Add to Cart</button>
    </form>
</body>
</html>
