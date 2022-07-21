<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header_ingridients.php'; ?>

<table class="table" id="productTable">
	<thead>
		<tr>			  			
			<th style="width:40%;">Product</th>
			<th style="width:20%;">Rate</th>
			<th style="width:15%;">Quantity</th>			  			
			<th style="width:15%;">Total</th>			  			
			<th style="width:10%;"></th>
		</tr>

		<script type="text/javascript">
			$(document).ready(function(){
				setInterval(function(){
					$("#cek_loadcell").load('cek_loadcell.php')
				}, 250) ;
			});
		</script>
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
			  	<div class="panel panel-default" style="text-align: center;">
			  		<h6> <span id="cek_loadcell"></span></h6> 
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

				<div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-10 col-sm-2">
			    <button type="button" class="btn btn-primary" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>
			    </div>
			  </div>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label">VAT 13%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Discount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Cheque</option>
				      	<option value="2">Cash</option>
				      	<option value="3">Credit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Full Payment</option>
				      	<option value="2">Advance Payment</option>
				      	<option value="3">No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>