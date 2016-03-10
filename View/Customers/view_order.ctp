			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							<div class="new_user_area">
								<div class="login_heading">
									<h1><span class=""></span>View Order</h1>
								</div>
						<div class="no-more-tables">
       <?php
       if(!empty($sub_info))
        { ?>  
							<table class="col-md-12 col-lg-12 col-xs-12 col-sm-12 table-bordered new_table border_none table-striped table-condensed cf">
								<thead class="cf">
									<tr>
										<th class="td_padding td_color text-center1" width="140" >Order No#</th>
										<th class="td_padding td_color text-center"  width="160"  >Image</th>
										<th class="td_padding td_color td_width_adjust"  width="180" >Deal Name</th>
										<th class="td_padding td_color td_width_adjust"  width="140" >Order Status</th>
										<th class="td_padding td_color td_width_adjust2"   width="50" > Qty</th>
										<th class="td_padding td_color ">Total</th>
										<?php if($sub_info['Order']['order_status'] == 'success') {  ?>
										<th class="td_padding td_color ">Download Voucher</th>
										<?php } ?>
								</thead>
								<tbody>
      			
								<tr>
										<td class="numeric td_padding text-center1 img_td"  width="140"  data-title="Image">
												 <?php echo $sub_info['Order']['order_no']; ?>
										</td>
		         <td class="numeric td_padding text-center img_td" data-title="Image"  width="160" >
												 <div class="tb_img_outer"> <img src="<?php echo IMPATH.'deals/'.$sub_info['Deal']['image'].'&w=50&h=30';?>"/> </div>
										</td> 	
										<td class="numeric td_padding text-center1 img_td" data-title="Image"  width="180" >
												 <?php echo $sub_info['DealOption']['option_title']; ?>
										</td> 
										<td class="numeric td_padding text-center1 img_td" data-title="Image"  width="140" >
											<?php 
												if($sub_info['Order']['order_status'] == 'success')
												{
													echo "Successful"; 
												}
												elseif($sub_info['Order']['order_status'] == 'pending')
												{
													echo "Pending";
												}
												else
												{
													echo "Failed";
												}
											?>
										</td> 
										<td class="numeric td_padding text-center1 img_td" data-title="Image"   width="50" >
												 <?php echo $sub_info['OrderDealRelation']['qty']; ?>
										</td>
										<td class="numeric td_padding text-center1 img_td" data-title="Image">
												 <?php echo $currency; ?><?php echo $sub_info['OrderDealRelation']['sub_total']; ?>
										</td> 
										<?php if($sub_info['Order']['order_status'] == 'success') {  ?>
										<td class="numeric td_padding text-center1 img_td" data-title="Image">
											<a title="Download" style="margin-left:25px;" href="<?php echo HTTP_ROOT.'voucher_pdf/'.$sub_info['OrderDealRelation']['voucher_pdf']; ?>" download="<?php echo $sub_info['OrderDealRelation']['voucher_pdf']; ?>" onclick="return confirm('Are you sure you want to Download this voucher?');">
												<span class=" glyphicon glyphicon-save"></span>
											</a>
										</td> 
										<?php } ?>
							 </tr>
				   
							</table>
							 <?php 
				     }
						
				  ?>
       </div>
					<br>
				</div>
		</div>
<!-- End login area -->
<script>
	$(document).ready(function(){
		$(document).on('click','.delete',function(){		
		var form= $(this).parents('.frm');
		var frmId= $(this).parents('.frm').attr('id');
		alert(frmId);
		$.ajax({
				 type: 'post',
				 url: ajax_url+'Customers/delete/'+frmId,
				 async: false,
				 data:form.serialize(),
				 success:function(resp){
						render.html(resp);
						//$('.session_div').show();
						$('.globel_user_name').html($('#edit_mem_name').val());
						$('.session_div').show().html('Your profile has been updated successfully.');
													$('html,body').animate({scrollTop: $("#scrool").offset().top-50},'slow');
													setTimeout( function() {$('.session_div').hide().html('');}, 4*1000);
				 	}
				})
		
		})
		});
</script>
