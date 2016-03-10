<style>
.ship_add
{
	height: 200px;
	width: 200px;
}
.ship_details{
float:left;
width:100%;
}
.ship_details_address{
float:left;
width:24%;
}
.head_ship_add{
border:none!important;
color:#000;
margin-bottom: 11px !important;
margin-top: 8px !important;
}
.label_name{
font-size:16px !important;
width:100% !important;
}
.add_para{
font-size:12px !important;
width:auto;
margin-bottom:0px !important;
padding-bottom:0px !important;
}
.contct_person{
margin-top:0px !important;
font-size:12px !important;
padding-top:0px!important;
width:50%;
}
.total-container{
float:left;
width:100%;
}
.your_order_details{
float: left;
margin-left: 30px;
width: 12%;
}
.your_order_sub{
border:none !important;
width:100%;
float:left;

margin-top:6px !important;
}
.sub-tot_pro{
float: left;
font-size: 15px;
padding-left: 54px;
}
.ship_charges{
float: left;
font-size: 15px;
margin-left: 51px;
}
.tax_details{
float: left;
margin-left: 88px;
font-size:15px !important;
}
.grand_total{
float:left;
font-size: 15px !important;
margin-left: 0px;
width: 70%;
}
.grand_total.width_p {
    float: left;
    width: 380px;
}
.total span {
	float: none;
    width: auto;
}
.your_order_details1{
float: left;
    margin-left: 242px;
    width: 13%;
	}
</style>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>View  Orders Details</h2>
				<a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
				<span></span>
			</div>
			<div class="content-box content-box-header" style="border:none;">
         	<div class="column-content-box">
            	<div class="ui-state-default ui-corner-top ui-box-header">
               	<span class="ui-icon float-left ui-icon-notice"></span>    	 
							Order Details Information
               </div>
					<div style="clear:both"></div>    
               <div class="hastable">
						<table id="sort-table"> 
							<thead> 
								<tr>
									<th style="width:75px;">Product Image</th>
									<th style="width:75px;">Deal Name</th>
									<th style="width:75px;">Quantity</th>
									<th style="width:75px;">discount</th>
									<th style="width:75px;">Total Amount(with out discount)</th>									
									<th style="width:75px;">Total Amount(with discount)</th>
									
									<!--<th style="width:75px;">Action</th>-->
								</tr> 
							</thead> 
							<tbody> 
								<?php 
								if(!empty($v_example))
								{
									foreach($v_example['OrderDealRelation'] as $team)
									{
										$viewQuery=ClassRegistry::init('DealOption');
										$all_price=$viewQuery->find('first',array('conditions'=>array('DealOption.id'=>$team['deal_option_id'])));
										?>
									<tr>
										<td><img height="" width="50px" src="<?php echo IMPATH.'deals/'.$team['Deal']['image']; ?>"></td>
										<td><?php 
											     echo $all_price['DealOption']['option_title']; ?></td>
										<td>
										<?php
								      	echo $team['qty']; 
									 ?>
								      </td>
										<td><?php echo $all_price['DealOption']['discount']; ?></td>
										<td><?php echo $all_price['DealOption']['selling_price']; ?></td>			
										<td><?php echo $all_price['DealOption']['discount_selling_price']; ?></td>
										<!--<td>
										   <?php $member_id = base64_encode(convert_uuencode($team['OrderDealRelation']['id'])); ?>
										    <?php if($team['OrderDealRelation']['id']!=0)
												{
											?>
											<a title="View Details" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php //echo HTTP_ROOT."admin/Orders/view_prod_order/".$member_id; ?>">	
												<span class="ui-icon ui-icon-search"></span>
											</a>
											<?php }else{ ?>
											<a title="No Action" class="btn_no_text btn ui-state-default ui-corner-all tooltip ui-state-hover" href="javascript:void(0)">	
												<span class="ui-icon ui-icon-lightbulb"></span>
											</a>
											<?php } ?>
										</td>-->
									</tr> 
								<?php	
									}
								} ?>					
							</tbody>
						</table>
						<div class="clear"></div>
					</div>
				</div>
				<div class="ship_details">
					<div class="ship_details_address">
						<h2 class="head_ship_add"> Shipping Address </h2>
						<?php if(@!$team['id']== 0 || !@$team['id']== NULL){ ?>
						<label class="label_name"> 
							<?php //echo $team['OrderDealRelation']['id']; ?>							
							<?php echo $team['shipping_first_name']; ?>
							<?php echo $team['shipping_last_name']; ?>						
						</label>
						<p class="add_para"><?php echo $team['shippingaddress_firstline']; ?>&nbsp;&nbsp;<?php //echo @$order_info['MemberAddress']['ship_address2']; ?></p>
						<p class="contct_person"><?php echo @$team['shippingaddress_secondline']; ?></p>
						<p class="contct_person"><?php @$team['shippingaddress_city']; ?></p>
						<p class="contct_person"><?php echo @$team['shippingaddress_zip']; ?></p>
						<p class="contct_person"><?php echo @$team['shippingaddress_cell_phone_number']; ?></p>
						<p class="contct_person"><?php echo @$team['shippingaddress_company_name']; ?></p>
						<?php }else{ ?>		
						<p class="add_para">Data is not available </p>				
						<?php } ?>				
					</div>
					<!--<div class="ship_details_address">
						<h2 class="head_ship_add"> Billing Address </h2>
						<?php //if(@!$team['id']== 0 || !@$team['id']== NULL){ ?>					
						<label class="label_name"> 
							<?php//echo $team['billing_first_name']; ?>
							<?php //echo $team['billing_last_name']; ?>						
						</label>
						<p class="add_para"><?php //echo $team['billingaddress_firstline']; ?>&nbsp;&nbsp;</p>
						<p class="contct_person"> <?php //echo $team['billingaddress_secondline']; ?></p>
						<p class="contct_person"><?php //echo $team['billingaddress_city']; ?></p>
						<p class="contct_person"><?php //echo $team['billingaddress_zip']; ?></p>
						<p class="contct_person"><?php //echo $team['billingaddress_cell_phone_number']; ?></p>
						<p class="contct_person"><?php //echo $team['billingaddress_company_name']; ?></p>
						<?php //}else{ ?>		
						<p class="add_para">Data is not available </p>				
						<?php //} ?>				
		
					</div>	-->	
					<div class="your_order_details">
					<h2 class="your_order_sub"> Deal Total </h2>
					<?php if(@!$team['id']== 0 || !@$team['id']== NULL){ ?>
						<label class="label_name"> 
							 Quantity:<?php echo $team['qty']; ?></p>					
							 Discount Selling Price:<?php echo $team['discount_selling_price']; ?></p>
							 Total:<?php
											$qty=$team['qty'];
											$discount_selling_price=$team['discount_selling_price'];						 
							  echo $qty*$discount_selling_price; ?>		
						</label>	
						<?php }else{ ?>		
						<p class="add_para">Data is not available </p>				
						<?php } ?>					
					</div>
					</div>
					
				</div>						
			</div>
	    </div>
	  <div class="clearfix"></div>
   </div>
</div>
<div class="clear"></div>
