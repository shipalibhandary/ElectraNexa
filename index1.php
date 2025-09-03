<?php
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Website</title>
</head>
<body>
    <h1>Product List</h1>
    <div>
        <?php while($row = $result->fetch_assoc()): ?>
            <div>
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo $row['description']; ?></p>
                <p>$<?php echo $row['price']; ?></p>
                <a href="product.php?id=<?php echo $row['id']; ?>">View Product</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
