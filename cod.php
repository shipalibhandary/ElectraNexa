
<?php

session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
	
	$product_id = $row["product_id"];
	$product_title = $row["product_title"];
	$product_price = $row["product_price"];

	$cart_item_id = $row["id"];
	$qty = $row["qty"];
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ElectraNexa</title>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
		</ul>
		
	</div>
	
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
		
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Cart Checkout Using COD</div>
					<div class="panel-body">
						<table cellpadding="2" cellspacing="2" border="2" class="table table-bordered">
						<tr>
						<th>Sr.No</th>
						<th>Product Name</th>    
						<th>Quantity</th>  
						<th>Product Price</th>                  
						</tr>
						<?php
						require 'db.php';   //include connection
						
						
						$data = mysqli_query($con, "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'");

						if($data === FALSE) { 
						die(mysql_error()); // TODO: better error handling
						}
						

						$total=0;$count=1;
						while($row = mysqli_fetch_array($data)) {?>
						<tr>
						<td><?PHP echo $count?></td>
						<td><?php echo  $row['product_title'];?></td>
						<td><?PHP echo  $row['qty']; ?></td> 
						<td><?PHP echo  $row['product_price']; ?></td> 
						<?PHP 
						$total=$total+$row['product_price'];
						$count++;	
						?>
					
						</tr>
						
						<?php } ?>
						

						</table>
						<div  align="right" style="font-size:20px;"><b>TOTAL AMOUNT = <?PHP echo  $total;?></b></div>
						
					
					</div> 
				</div>	
			</div>	
		</div>
</body>	
</html>
















		