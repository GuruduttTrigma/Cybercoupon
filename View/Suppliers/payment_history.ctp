<?php  echo $this->Html->script('frontend/design/jquery.datetimepicker.js');?>
<?php  echo $this->Html->css('frontend/jquery.datetimepicker.css');?>
<?php  //$idz = base64_encode(convert_uuencode($deal_info['Deal']['id']));?>
<!-- Supplier profile area page -->
<script>
$(document).ready(function(){
	jQuery(function(){
		jQuery('#date_timepicker_start').datetimepicker({
			format:'j M Y',
			formatDate:'j M Y',
			onShow:function( ct ){
				this.setOptions({
					maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
				})
			},
			timepicker:false
		});
		jQuery('#date_timepicker_end').datetimepicker({
			format:'j M Y',
			formatDate:'j M Y',
			onShow:function( ct ){
				this.setOptions({
					minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false		
				})
			},
			timepicker:false
		});
	});
	/******************************** Payment History searching by Gurudutt Sharma *******************************/
	$(".allsearch").click(function()
	{
		var custName=$(".custName").val();
		var startdate=$(this).parent().parent().prev().find('input.startdate').val();
		var enddate=$(this).parent().parent().prev().find('input.enddate').val();		
		$(".sales_total_element3").css({'opacity':'0.2'});
		$.ajax({
			type:"Post",
			url :ajax_url+"Suppliers/payment_history",
			data:{'custName':custName,'startdate':startdate,'enddate':enddate},
			success:function(result)
			{
				$(".sales_total_element3").html(result);
				$('.pagination').children().find('.current').addClass('pageactive');
				$(".sales_total_element3").css({'opacity':'1'});
			}			
		});
	});
});
</script>
<div class="supplier_container">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
		<div class="supplier_profile_container">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="right_tabs">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="widgets">
					
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<div class="col-lg-12  padding_0 col-md-12 col-sm-12 col-xs-12">
								
								<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
									<div class="deal_heading_Re">
										<h1 style="margin-top:0px;">Payment History </h1>
										
									</div>
								</div>
							</div>
						</div>
						
						<?php  ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
							<div class="search_feature">
								<div class="input_round_2">
									<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
										<input type="text" class="custName" name="custName" placeholder="Search by Name">
										<input type="hidden" id="hiddenname">
									</div>
									<!---<span class="glyphicon glyphicon-search emlsearch" style="cursor:pointer;"></span>-->
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
							<div class="search_feature">
							<form id="searchbydate">
								<div class="input_round">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
										<input class="startdate" type="text" id="date_timepicker_start" name="startdate" placeholder="Start Date" readonly>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
										<input class="enddate" id="date_timepicker_end" type="text" name="enddate" placeholder="End Date" readonly>
									</div>
									<span class="glyphicon glyphicon-search searchbydate" ></span>
								</div>
							</form>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="search-butn">
							<button class="btn btn-info allsearch">
								search
								<span class="glyphicon glyphicon-search">
								</span>
							</button>
						</div>
						</div>
						<div class="under_line_div"></div>
						<?php  /* ?>
						<div class="cnt_ttl">
							<h5><span>Total Item(<?php echo $deal_info['Deal']['item_count']; ?>) </span></h5>
							<h5><span>Total Amount: </span><span><?php echo $currency,$deal_info['Deal']['total_amount']; ?></span></h5>
							<h5><span>Supplier(<?php echo $mem_info['MemberMeta']['supplier%']; ?>%):</span> <span><?php echo $currency,($deal_info['Deal']['total_amount']*$mem_info['MemberMeta']['supplier%'])/100; ?></span></h5>
							<h5><lspanabel>CyberCoupon(<?php echo $mem_info['MemberMeta']['cybercoupon%']; ?>%):</span><span> <?php echo $currency,($deal_info['Deal']['total_amount']*$mem_info['MemberMeta']['cybercoupon%'])/100; ?></span></h5>
						</div>
						<?php */ ?>
						<div class="render_reconcile11">
							<div class="no-more-tables">
								<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
									<thead class="cf">
										<tr>
											<th class="td_padding td_color">Customer Name</th>
											<th class="td_padding td_color">Order No</th>
											<th class="td_padding td_color" >Customer E-mail</th>
											<th class="td_padding td_color" > Purchase Date</th>
											<th class="td_padding td_color" >Total Amount</th>
											<th class="td_padding td_color" >Supplier Amount</th>
										</tr>
									</thead>
	<tbody>
	<?php if (!empty($reconcile_list)){
		
			foreach($reconcile_list as $list): ?>
		<tr>
			<td class="td_padding" data-title="Customer Name"><?php echo $list['Order']['Member']['name'].' '.$list['Order']['Member']['surname']; ?></td>
			<td class="td_padding" data-title="Order No"><?php echo $list['Order']['order_no']; ?></td>
			<td class="td_padding" data-title="Customer E-mail"><?php echo $list['Order']['Member']['email']; ?></td>
			<td data-title="Purchase Date" class="numeric td_padding"><?php echo date('d M Y',strtotime($list['Order']['payment_date'])); ?></td>
			<td data-title=" Amount" class="numeric td_padding"><?php echo $currency,$list['OrderDealRelation']['sub_total']; ?></td>
			<td data-title=" Amount" class="numeric td_padding"><?php echo $currency,($list['OrderDealRelation']['sub_total']*$history['PaymentHistory']['supplier_percent'])/100; ?></td>
		</tr>
	<?php endforeach; 
				}
				else { ?>
				<tr class="mrgntbl">
						<td class="td_padding table_No_record" colspan="5" data-title="">No Record Found</td>
				</tr>
	<?php		}
	?>	
	</tbody>
</table>
						</div>
						</div>
					</div>
				

					
					</div> <!--end of right tab -->
				</div>
				</div>
			</div>
		</div>
