<table class="col-md-12 col-sm-12 col-xs-12 table-bordered border_none table-striped table-condensed cf show_table">
		<thead class="cf">
			<tr>
				<th class="td_padding td_color" width="65">Image</th>
				<th class="td_padding td_color" width="200" >Deal Name</th>
				<th class="td_padding td_color" width="200" > Customer E-mail</th>
				<th class="td_padding td_color" >Supplier(<?php echo @$orderrelation[0]['Deal']['Member']['MemberMeta']['supplier%'] ;?>%)</th>
     <th class="td_padding td_color" >Company(<?php echo @$orderrelation[0]['Deal']['Member']['MemberMeta']['cybercoupon%'] ;?>%)</th>
     <th class="td_padding td_color" >Status</th>
			</tr>
		</thead>
</table>
<?php if(!empty($orderrelation)){//pr($orderrelation);
				foreach($orderrelation as $list){//pr($list);die;
?>				
				<table class="col-md-12 col-sm-12 col-xs-12 table-bordered border_none table-striped table-condensed cf show_table sale_deal_tbl pp" data-saleorder="<?php echo $list['OrderDealRelation']['id']; ?>" >
					<tbody>
						<tr>
							<td class="td_padding" data-title="Image"  width="55" style="border-bottom:none;"><img src="<?php echo IMPATH.'deals/'.$list['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/></td>
							<td class="td_padding" data-title="Deal Name"  width="170" style="border-bottom:none;"><?php echo substr($list['Deal']['name'],0,30); ?> </td>
							<td data-title="Customer Name" class="numeric td_padding"   width="175" style="border-bottom:none;"><?php echo @$list['Order']['Member']['email']; ?> </td>
							<td data-title="Purchase Date" width="100" class="numeric td_padding"style="border-bottom:none;">
									<?php 
									$percentage=$list['Deal']['Member']['MemberMeta']['supplier%'];
									echo $currency.number_format(($list['OrderDealRelation']['sub_total']*$percentage)/100,2,'.','');
									?> 
							</td>
        <td data-title="Purchase Date" width="100" class="numeric td_padding"style="border-bottom:none;">
									<?php 
									$percentage=$list['Deal']['Member']['MemberMeta']['cybercoupon%'];
									echo $currency.number_format(($list['OrderDealRelation']['sub_total']*$percentage)/100,2,'.','');
									?> 
							</td>
        <td data-title="Refund Status" class="numeric td_padding"style="border-bottom:none;">
          <?php 
											if($list['OrderDealRelation']['refund_status']=='Approved' && $list['OrderDealRelation']['supplier_refund_status']=='Approved')
											{
											   echo "Completed";
											}
											else
											{
											  echo "Pending";
											}
								 ?>
							<!--<a href="javascript:void(0);"><span class=" glyphicon glyphicon-chevron-down"></span></a>-->
							</td>
						</tr>
					</tbody>
				</table>
							
			
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 sale_deal_detail" style="display:none;">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="collapse_div">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label class="defuat-color">Customer Name:</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
														<div class="form-group">
															<span><?php 
																				echo $list['Order']['Member']['name']." ";
																				echo $list['Order']['Member']['surname']; 
																	?> 
															<span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label>Customer E-mail:</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
														<div class="form-group">
															<span><?php echo $list['Order']['Member']['email']; ?><span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label>Transaction Date:</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
														<div class="form-group">
															<span><?php echo date('d M Y',strtotime($list['Order']['payment_date'])); ?><span>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label>Supplier Amount(<?php echo $list['Deal']['Member']['MemberMeta']['supplier%'] ;?>%):</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
														<div class="form-group">
															<span>
                 <?php 
																	$percentage=$list['Deal']['Member']['MemberMeta']['supplier%'];
																	echo $currency.number_format(($list['OrderDealRelation']['sub_total']*$percentage)/100,2,'.','');
															?>
															<span>
														</div>
													</div>
												</div>
											</div>
										</div>

           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label>Company Amount(<?php echo $list['Deal']['Member']['MemberMeta']['cybercoupon%'] ;?>%):</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
														<div class="form-group">
															<span>
                 <?php 
																	$percentage=$list['Deal']['Member']['MemberMeta']['cybercoupon%'];
																	echo $currency.number_format(($list['OrderDealRelation']['sub_total']*$percentage)/100,2,'.','');
															?>
															<span>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label>Item Name:</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
														<div class="form-group">
															<span><?php echo $list['Deal']['name']; ?><span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label>Purchase Deal Range:</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
														<div class="form-group">
															<span><?php echo date('d M Y',strtotime($list['Deal']['buy_from'])); ?><span>
															<span class="to_div">-To-</span>
															<span><?php echo date('d M Y',strtotime($list['Deal']['buy_to'])); ?><span>
														</div>
													</div>
												</div>
											</div>
										</div>
           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label>Refund Status By Company:</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
														<div class="form-group">
															<span>
							          <?php 
																		if($list['OrderDealRelation']['refund_status']=='Approved')
																		{
																		   echo "Completed";
																		}
																		else
																		{
																		  echo "Pending";
																		}
															 ?>
                 <span>
														</div>
													</div>
												</div>
											</div>
										</div>
<?php
if($list['OrderDealRelation']['supplier_refund_status']!='No')
{
?>
           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
													<label>Refund Status By Supplier:</label>
												</div>
											</div>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
														<div class="form-group">
																	<select style="color:#999">
																	<option value="Pending" <?php if($list['OrderDealRelation']['supplier_refund_status']=='Pending'){?> selected='selected' <?php } ?>>Pending</option>
																	<option value="Approved" <?php if($list['OrderDealRelation']['supplier_refund_status']=='Approved'){?> selected='selected' <?php } ?>>Approved</option>
																	</select>					
														</div>
														<div class="form-group">
																	<input type="hidden" value="<?php echo $list['OrderDealRelation']['id'];?>">
																	<a class="btn btn-primary supplier_refund" href="javascript:void(0);">Submit</a>
														</div>
													</div>
												</div>
											</div>
										</div>
<?php
}
?>

           <h6 class="text-center supplier_refund_msg" style="color: #22add6;display:none;"></h6>

										
									</div>
								</div>
							</div> 
							
<?php } }
else{ ?>
		        <div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
											<h2 class="text-center" style="color:#333;">No Records Found</h2>
											<div class="col-md-12  padding_0 form_div_margin_top">
												
									  </div>
									</div>
<?php } ?>


<!--------------------------for pagination-------------------------------------------------------------->
   <?php  if(!empty($orderrelation)){   
 $pagParam = $this->Paginator->params();
 //pr($this->params);die;
       $this->Paginator->options(array('url' => array('controller'=>'Suppliers','action'=>'refund')));
   ?>
  <div class="pagination_div text-center">	
    		<ul class="pagination search_paging refund_pagination">
				<?php if($this->params['paging']['OrderDealRelation']['pageCount']>1) { ?> 		   
					<li><?php echo $this->Paginator->prev('Prev'); ?></li>
					<li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter')); ?> </li>
					<li><?php  echo $this->Paginator->next('Next'); ?></li>
				<?php } ?>
     </ul>					
		</div>					
<?php } ?>

<script>
$(document).ready(function()
{
		$('.supplier_refund').click(function(){

       var order_relation_id=$(this).prev('input').val();
       var refund_status=$(this).val();
						$.ajax({
						   url:ajax_url+'Suppliers/supplier_refund_status',
									method:'POST',
							  data:{order_relation_id:order_relation_id,refund_status:refund_status},
									success:function(resp)
									{
											$('.supplier_refund_msg').show();
											if(resp=='success')
											{		       
														$('.supplier_refund_msg').html('Your refund status has been updated successfully.');
											}
											else
											{
											   //$('.supplier_refund_msg').html('Your refund status has not updated.');
											}
						   }
						})		
					
		})
});
</script>