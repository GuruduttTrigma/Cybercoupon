<?php echo $this->Html->script('backend/development/ui.datepicker.js');
$total = 0.0;
//$idz = array();
 ?>
 
<style>
.ttl {
    float: right;
    font-size: 20px;
    margin-top: 10px;
	width:100%;
}
.paymentbtn {
    float: left;
    margin-top: 10px;
}
.ppl{
	font-size: 15px;
	font-weight:bold;
	font-style: oblique;
}
.ddl{
	margin-top:10px;
	width:100%;
	float:left;
}
.paty{
	width:21%;
}
.rht{
	float:right;
}
</style>
	<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<div class="hastable">
			<?php /*<table id="sort-table"> 
				<thead> 
					<tr>
                  <th style="width:auto;">Deal Name</th>
                
                 
                  <th style="width:auto;"> Purchage On</th>
                  <th style="width:auto;"> Purchage by</th>
						<th style="width:auto;"> Customer Email</th>
                  <th style="width:auto;"> Category</th>      
						<th style="width:auto;"> Quantity</th>    
						<th style="width:auto;"> Payment Type</th>  
						<th style="width:auto;"> Total Amount</th>    
						<th style="width:auto;"> Amount (Supplier)</th> 
                        <!--<th style="width: 160px;" class="rmv_sort">Action</th> -->
					</tr> 
				</thead> 
				<tbody> 
				
					<?php	$eft = 0.0;
								$payu = 0.0;
         $refund = 0.0;

					if(!empty($reconcile_list))
					{					
						foreach($reconcile_list as $data):	
						
						$total += @$data['OrderDealRelation']['sub_total']?$data['OrderDealRelation']['sub_total']:0;
						if ($data['Order']['payment_type']=="EFT") {
							$eft += @$data['OrderDealRelation']['sub_total']?$data['OrderDealRelation']['sub_total']:0; 
						}
						if ($data['Order']['payment_type']=="PAYU") {
							$payu += @$data['OrderDealRelation']['sub_total']?$data['OrderDealRelation']['sub_total']:0; 
						}
                 if ($data['OrderDealRelation']['refund_status']=="Yes") {
							$refund += @$data['OrderDealRelation']['sub_total']?$data['OrderDealRelation']['sub_total']:0; 
						}
					?>
                <tr>
					<td><?php echo $data['Deal']['name']; ?></td>       
					<td><?php echo date('d M Y',strtotime($data['Order']['payment_date'])); ?></td>            
                	<td><?php echo $data['Order']['Member']['name'].' '.@$data['Order']['Member']['surname']; ?></td>   
					<td><?php echo $data['Order']['Member']['email']; ?></td>  
					<td><?php echo $data['Deal']['DealCategory']['name']; ?></td>  
					<td><?php echo $data['OrderDealRelation']['qty']; ?></td> 
					<td><?php echo $data['Order']['payment_type']; ?></td> 
					<td><?php echo $data['OrderDealRelation']['sub_total']; ?></td> 
					<td><?php echo ($data['OrderDealRelation']['sub_total']*$history['PaymentHistory']['supplier_percent'])/100; ?></td> 
                     
                         
                     </tr>  
                <?php
                       endforeach;
								}
						 		else 
						 		{
							  ?>
							<tr>
								<td colspan="7">No Records Found.</td>
							</tr>
							<?php } ?>	
				</tbody>
			</table> */ ?>
			
          <table id="sort-table"> 
				<thead> 
					<tr>
                  <th style="width:auto;"> Payment On</th>
                  <th style="width:auto;"> Company Name</th>
						<th style="width:auto;"> Total Amount</th>    
						<th style="width:auto;"> Amount (Supplier)</th> 
					</tr> 
				</thead> 
				<tbody> 
				
					<?php	
					if(!empty($history_new))
					{					
						  foreach($history_new as $data):
					?>
		               <tr>
								<td><?php echo date('d M Y',strtotime($data['PaymentRelease']['payment_date'])); ?></td>
								<td><?php echo $data['Member']['MemberMeta']['company_name']; ?></td>  
								<td><?php echo $data['PaymentHistory']['total']; ?></td> 
								<td><?php echo $data['PaymentHistory']['supplier_amount']; ?></td>
		               </tr>  
                <?php
                     endforeach;
					}
			 		else 
			 		{
				  ?>
						<tr>
							<td colspan="7">No Records Found.</td>
						</tr>
				 <?php
				   } 
				 ?>	
				</tbody>
			</table>			
			
			<?php /*<div class="llo">
				<div class="paty">
					<div class="ttl">
						<label> Total : </label>
						
						<span class="rht"><?php echo @$total?$currency.''.$total:'0.00'; ?></span>
					</div>
					<div class="ttl">
						<label> Supplier(<?php echo $history['PaymentHistory']['supplier_percent']; ?>%) : </label>
						<span class="rht"><?php echo @$total?$currency.''.(($total*$history['PaymentHistory']['supplier_percent'])/100):'0.00'; ?></span>
					</div>
					
				</div>
				
			</div> */ ?>
             <?php //echo $this->element('backend/table_head'); ?>
			
		</div>
		<div class="clear"></div>
	</div>
	</div>
	<div class="clear"></div>
</div>

