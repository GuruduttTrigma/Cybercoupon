<script>
	$(document).ready(function(){
		$(document).on('click','.delete',function(){		
			var frmId= $(this).attr('rel');
			var $this=$(this);
			//alert(frmId);
			$.ajax({
				type: 'post',
				url: ajax_url+'Customers/delete/'+frmId,
				async: false,
				success:function(resp){
					
					//$('.session_div').show();
					//$('.globel_user_name').html($('#edit_mem_name').val());
					$('.session_div').show().html('Your Order has been deleted successfully.');
					$('html,body').animate({scrollTop: $("#scrool").offset().top-50},'slow');
					setTimeout( function() {$('.session_div').hide().html('');}, 4*1000);
					$this.closest('table').remove();
				}
			})		
		});
		
		//send voucher
		$(document).on('click','.send_voucher',function() {		
			var frmId= $(this).attr('rel');
			var $this=$(this);
			$.ajax({
				type: 'post',
				url: ajax_url+'Customers/send_voucher/'+frmId,
				async: false,
				success:function(resp){
					$('.session_div').show().html('Your voucher pdf send to your mail box.');
					$('html,body').animate({scrollTop: $("#scrool").offset().top-50},'slow');
					setTimeout( function() {$('.session_div').hide().html('');}, 4*1000);
				}
			})		
		})
	});
</script>
<table class="table table-bordered border_none">
	<tr>
	  <th class="td_padding td_color" style="width:20%;">Order No.</th>
	  <th class="td_padding td_color" style="width:30%;">Deal Name</th>
	  <th class="td_padding td_color" style="width:20%;">Supplier</th>
	  <th class="td_padding td_color" style="width:14%;">Date</th>
	  <th class="td_padding td_color" style="width:14%;">Status</th>
	  <th class="td_padding td_color" style="width:23%;">Action</th>
	</tr>											 
</table>
	
		<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">	
			<tbody>
			<?php 
		if (!empty($order_info) and $order_info) {
			foreach($order_info as $info) {
				//	pr($info);die;				
				//  pr($sub_info);die;
					if($info['Order']['delete_status']!='User-del') {
				?>
				<tr>
					<td width="20%" class="td_padding" data-title="ID"><?php echo @$info['Order']['order_no']; ?></td>
					<td width="30%" class="td_padding" data-title="Deal Name"><?php echo @$info['Deal']['name']; ?></td>
					<td width="20%" data-title="Supplier" class="numeric td_padding"><?php echo @$info['Deal']['Member']['MemberMeta']['company_name']; ?></td>
					<td width="14%" data-title="Date" class="numeric td_padding"><?php echo date('d M Y',strtotime(@$info['Order']['payment_date'])); ?></td>
					<td width="14%" data-title="Date" class="numeric td_padding">
					<?php  
					if(@$info['Order']['delete_status'] == 'Admin-del'  && @$info['OrderDealRelation']['reconcile'] == 'Pending')
					{
						echo "Cancel";
					}
					elseif(@$info['Order']['delete_status'] == 'All' && @$info['Order']['order_status'] == 'pending' && @$info['OrderDealRelation']['reconcile'] == 'Pending')
					{
						echo "Pending";
					}
					elseif(@$info['Order']['delete_status'] == 'All' && @$info['Order']['order_status'] == 'success' && @$info['OrderDealRelation']['reconcile'] == 'Pending')
					{
						echo "Success";
					}
					elseif(@$info['OrderDealRelation']['claim_status'] == 'ClaimApproved' && @$info['OrderDealRelation']['refund_status'] != 'No' && @$info['OrderDealRelation']['reconcile'] != 'Pending')
					{
						echo "Refunded";
					}	
					else
					{
						echo "Success";
					}					
					?>
					</td>
					<td width="23%" data-title="Action" class="numeric td_padding" >
						<a href="<?php echo HTTP_ROOT.'Customers/view_order/'.base64_encode(convert_uuencode($info['Order']['id']));?>" target="_blank"><span class=" glyphicon glyphicon-eye-open"></span> View </a>
						<!--<a href="javascript:void(0);" rel="<?php echo base64_encode(convert_uuencode($info['Order']['id']));?>" class="delete" ><span class=" glyphicon glyphicon-remove"></span> Delete</a>-->
						<?php if ($info['Order']['order_status'] == 'success') : ?>
							<a href="javascript:void(0);" rel="<?php echo base64_encode(convert_uuencode($info['Order']['id'])); ?>" class="send_voucher" title="Resend Voucher" ><span class=" glyphicon glyphicon-envelope"></span> Resend Voucher</a>
						<?php endif; ?>
					</td>
				</tr>
				<?php } }  } else { ?>
	 			<div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
					<h2 class="text-center" style="color:#333;">No records found</h2>
					<div class="col-md-12  padding_0 form_div_margin_top"></div>
				</div>
<?php } ?>
					</tbody>
		</table>


<!--------------------------for pagination-------------------------------------------------------------->
 <?php if(!empty($order_info)) {   ?>
  <div class="pagination_div text-center">	
    		<ul class="pagination search_paging order_pagination">
							<?php if($this->params['paging']['OrderDealRelation']['pageCount']>1) { ?> 		   
								<li><?php echo $this->Paginator->prev('Prev');?></li>
								<li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
								<li><?php  echo $this->Paginator->next('Next');?></li>
							<?php } ?>
     </ul>					
		</div>					
<?php } ?>