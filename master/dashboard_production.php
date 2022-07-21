<?php require_once 'includes/header_production.php'; ?>

<?php 

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$totalRevenue = "";
while ($orderResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $orderResult['paid'];
}

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$connect->close();

?>




<div class="row">
	
	
	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader" style="background-color:#A9A9A9;">
		    <h1><?php if($totalRevenue) {
		    	echo $totalRevenue;
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>


		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-ok-sign"></i> Total Product ~ A</p>
		  </div>
		</div>
	</div> 

	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader" style="background-color:#A9A9A9;">
		    <h1><?php if($totalRevenue) {
		    	echo $totalRevenue;
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>


		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-ok-sign"></i> Total Product ~ B</p>
		  </div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card">
		  <div class="cardHeader" style="background-color:#A9A9A9;">
		    <h1><?php if($totalRevenue) {
		    	echo $totalRevenue;
		    	} else {
		    		echo '0';
		    		} ?></h1>
		  </div>

		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-ok-sign"></i> Total Product ~ C</p>
		  </div>
		</div> 
	</div>



	
</div> <!--/row-->



<?php require_once 'includes/footer.php'; ?>