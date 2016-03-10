<script>
$(document).ready(function(){
	$('#track_order').click(function(){
		var order_no = $('.order_num').val();
		if(order_no!="")
		{
			$.ajax({
				type:"POST",
				url:ajax_url+'Orders/track_order_status',
				data:{order_no:order_no},
				success:function(resp)
				{
					//alert(resp)
					var w = resp.split('OK');
					if(w[0]=="success")
					{
						$('.num').html(w[1]);
						$('.time').html(w[2]);
						$('.statuss').html(w[3]);
						$('.blcked_div').show();
						$('.errAjax').html('');
					}
					else
					{
						$('.blcked_div').hide();
						$('.num').html('');
						$('.time').html('');
						$('.statuss').html('');
						$('.errAjax').html('Enter valid order number.').css('color','red');
					}
				}
			});
		}
		else
		{
			$('.errAjax').html('This field is required.').css('color','red');
			$('.blcked_div').hide();
		}
	});
});
</script>
<style>
.errAjax
{
	margin-left: -7px;
}
</style>
<div id="middle_container">
	<div id="middle_inner">
		<div class="middle_main">
			<div class="middle_content">
				<h2>Track Your Order</h2>
				<div class="box_content_outer">
					<div class="gate_order">
						<span style="line-height:18px;">Enter the Order Number# associated 
						with your order. You can find your Order Number# in the email communications
						sent to you by Flashplak. <!--View detailed Order Status by logging into your account.
						If you do not have an account please create one <a href="<?php echo HTTP_ROOT.''?>">here</a>. --></span>
						<div class="input_outer">
							<div class="input_container">
								
									<div class="input_main">
										<!--div class="input_flds">
											<label>Email Address</label>
											<input type="text" />
										</div-->
										<div class="input_flds">
											<label>Order Number</label>
											<input class="order_num" type="text" />
											<span class="errAjax"></span>
										</div>
									</div>
									<div class="button_outer">
										<div class="button_container">
											<input type="button" id="track_order" value="track order" />
										</div>
									</div>
								
							</div>
						<div class="blcked_div" style="display:none;">
							<h2>Tracking Status</h2>
							<div class="track_result">
								<table width="100%" cellspacing="0" cellpadding="0" border="0">
									<thead>
										<tr>
											<th width="10%">Order Number#</th>
											<th width="11%">Date</th>
											<!--th width="27%">P Name</th-->
											<th width="14%">Order Status</th>
										</tr>
									</thead>
									<tbody>
											<tr class="odd">
												<td rowspan="1" class="num"></td>
												<td rowspan="1" class="time"></td>
												<!--td>iPhone 5 16GB</td-->
												<td class="statuss"></td>
											</tr>
									</tbody>
									
								</table>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>