<?php require_once 'includes/header_ingridients.php'; ?>

<table class="table" id="productTable">
	<thead>
		<tr>			  			
			<th style="width:40%;">Product</th>
			<th style="width:20%;">Rate</th>
			<th style="width:15%;">Quantity</th>			  			
			<th style="width:15%;">Total</th>			  			
			<th style="width:10%;"></th>
		</tr>
	</thead>

	<tbody>
	<?php
	$arrayNumber = 0;
	for($x = 1; $x < 2; $x++) { ?>
		<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			<td style="margin-left:20px;">
			  	<div class="form-group">

			  	<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  	<option value="">~~SELECT~~</option>
			  	<?php
			  	$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  	$productData = $connect->query($productSql);

			  	while($row = $productData->fetch_array()) {									 		
			  	echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";} // /while 
			  	?>
		  		</select>
			  	</div>
			</td>
			  				
			<td style="padding-left:20px;">			  					
			  	<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  	<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			</td>

			<td style="padding-left:20px;">
			  	<div class="form-group">
			  	<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  	</div>
			</td>

			<td style="padding-left:20px;">			  					
			  	<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  	<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			</td>

			<td>
			<button class="btn btn-warning removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			</td>
		</tr>
		<?php
		 $arrayNumber++;
		} // /for
		?>
	</tbody>
</table>


<?php require_once 'includes/footer.php'; ?>