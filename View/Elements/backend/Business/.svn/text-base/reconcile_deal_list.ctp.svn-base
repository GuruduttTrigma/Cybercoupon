<?php 
	echo $this->Html->script('backend/development/ui.datepicker.js');
	$total = 0.0;
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
         	<table id="sort-table"> 
				<thead> 
					<tr>
                       <!-- <th style="width:auto;">Image</th>-->
                        <th style="width:auto;">Deal Name</th>
                       
                        <th style="width:auto;"> Purchase Date</th>
                        <th style="width:auto;"> Purchased By</th>
						<th style="width:auto;"> Customer Email</th>
                         <th style="width:auto;"> Category</th>      
						<th style="width:auto;"> Quantity</th>    
						
						<th style="width:auto;"> Amount</th>
						<th style="width:auto;"> Supplier share amount</th>       
						<th style="width:auto;"> Supplier share %</th>       
                        <!--<th style="width: 160px;" class="rmv_sort">Action</th> -->
					</tr> 
				</thead> 
				<tbody> 
				
					<?php	
					$eft = 0.0;
					$payu = 0.0;
					$refund = 0.0;

					if(!empty($deal_list))
					{					
						foreach($deal_list as $data):	
						
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
						<!--<td class="td_padding" data-title="Image"  width="55" style="border-bottom:none;">
							<img src="<?php echo IMPATH.'deals/'.$data['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/>
						</td>-->
						<td><?php echo $data['Deal']['name']; ?></td>       
						<td><?php echo date('d M Y',strtotime($data['Order']['payment_date'])); ?></td>            
						<td><?php if(!empty($data['Order']['Member']['name'])) { echo $data['Order']['Member']['name'].' '.@$data['Order']['Member']['surname']; }?></td>   
						<td><?php if(!empty($data['Order']['Member']['email'])) { echo $data['Order']['Member']['email']; }?></td>  
					 	<td><?php echo $data['Deal']['DealCategory']['name']; ?></td>  
					 	<td><?php echo $data['OrderDealRelation']['qty']; ?></td> 					 
						<td><?php echo $data['OrderDealRelation']['sub_total']; ?></td>
						<td><?php echo round(($data['OrderDealRelation']['sub_total']*$mem_info['MemberMeta']['supplier%'])/100,2); ?></td>  
                     
                         <?php /*?>                    
                     	<td>
                           <?php $newsid = base64_encode(convert_uuencode($data['Deal']['id'])); ?>
						   
                               <a title="Reconcile" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Business/reconcile/".$newsid; ?>">	
                               	<span class="ui-icon ui-icon-suitcase"></span>
                               </a>
							 
                         <?php
                          if($subadmin_type==1||@$modulepermissions['Deals']['module_edit']==1)
            			            {
                             if($subadmin_type==1||($subadmin_type==2 && (@$modulepermissions['Deals']['edit_permission']==1)))
                    			        {
                          ?>    
                              <!-- <a title="Edit" href="<?php echo HTTP_ROOT."admin/Manages/edit_claim/".$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
                                    <span class="ui-icon ui-icon-pencil"></span>
                                </a>-->
                         <?php
                              }
                             
                              
                           ?>
                          </td>
						  <?php */ ?>
						  <td><?php echo $mem_info['MemberMeta']['supplier%']; ?></td>

                     </tr>  
                <?php
                   //}  //for module edit condition
                       endforeach; ?>
          <?php	
								}
						 		else 
						 		{
							  ?>
							<tr>
								<td colspan="9">No Records Found.</td>
							</tr>
							<?php } ?>	
				</tbody>
			</table>
			<!--<div class="llo">
				<div class="paty">
					<div class="ttl">
						<label> Total : </label>
						<input type="hidden" id="eft" value="<?php //echo @$eft?(($eft*$mem_info['MemberMeta']['supplier%'])/100):'0.00'; ?>">
						<input type="hidden" id="payu" value="<?php //echo @$payu?(($payu*$mem_info['MemberMeta']['supplier%'])/100):'0.00'; ?>">
						<input type="hidden" id="total_sup" value="<?php //echo @$total?(($total*$mem_info['MemberMeta']['supplier%'])/100):'0.00'; ?>">
						<span class="rht"><?php //echo @$total?$currency.''.$total:'0.00'; ?></span>
					</div>
					
					<div class="ttl">
						<label> Cybercoupon(<?php// echo $mem_info['MemberMeta']['cybercoupon%']; ?>%) : </label>
						<span class="rht"><?php //echo @$total?$currency.''.(($total*$mem_info['MemberMeta']['cybercoupon%'])/100):'0.00'; ?></span>
					</div>
					<div class="ttl">
						<label> Supplier(<?php//echo $mem_info['MemberMeta']['supplier%']; ?>%) : </label>
						<span class="rht"><?php //echo @$total?$currency.''.(($total*$mem_info['MemberMeta']['supplier%'])/100):'0.00'; ?></span>
					</div>
					<div class="ttl">
						<label> Refund: </label>
						<span class="rht"><?php //echo @$refund?'(-)'.$currency.''.($refund):'0.00'; ?></span>
					</div>

				</div>
				
			</div>-->
			<!--<div class="ddl">
				<?php //if ($total>0.0) { ?>
					<span class="ppl">Note: Please assured that you have already made payment to this supplier before submit the 'Payment Release' button.</span>
				<?php //} ?>
				</div>
			<div class="paymentbtn">
				<?php //if ($total>0.0) { ?>
					<input type="button"   value="Payment Release" class="sub-bttn paidamount" style="width:125px; height:34px;float: right; margin-left:0;" />
				<?php //} ?>
			</div>-->
             <?php //echo $this->element('backend/table_head'); ?>
			
		</div>
		<div class="clear"></div>
	</div>
	</div>
	<div class="clear"></div>
</div>

