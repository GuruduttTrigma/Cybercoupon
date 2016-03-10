<div id="middle_container">
	<div id="middle_inner">
		<div class="middle_main">
			<div class="mini-builder">
				<div class="progression">
					<div class="cart">Your Order Detail</div>
				</div>
				<div class="gt_ofr_main">
					<div class="outer_of_table">
							<table class="table_block" width="100%" cellspacing="0" cellpadding="0" border="0">
							<thead>
								<tr class="iphcrt head_padding">
									<th>Product Image</th>
									<th>Product Name</th>
									<!--th>Price(per quantity)</th-->
									<th>Quantity</th>
									<th>Sub Total</th>
								</tr>
							</thead>
							<?php
								if(!empty($v_example))
								{
									foreach($v_example as $team)
									{ ?>
									<tbody>
										<tr class="iphcrt head_padding">
											<td>
												<img width="70" style=" margin-right:15px;" src="<?php echo HTTP_ROOT.'img/custom_checkout/'.$team['OrderProductRelation']['image']; ?>">
											</td>
											<td>
												<p class="pnam130"><?php echo $team['OrderProductRelation']['product_name']; ?></p>
											</td>
											<!--td>$365</td-->
											<td><?php echo $team['OrderProductRelation']['quantity']; ?></td>
											<td>$<?php echo $team['OrderProductRelation']['dis_sub_total']; ?></td>
										</tr>
									</tbody>
							<?php	
									}
								} ?>
						</table>
						<div class="shpng_clcltn">
							<div class="shpng_clcltn_lft order_detail_lft">
								<h4>Shipping Address</h4>
								<label><?php echo $order_info['MemberAddress']['name']; ?></label>
								<label><?php echo $order_info['MemberAddress']['address']; ?>&nbsp;&nbsp;<?php echo @$order_info['MemberAddress']['address2']; ?> </label>
								<label><?php echo $order_info['MemberAddress']['city']; ?>, <?php echo $order_info['MemberAddress']['State']['name']; ?>,  <?php echo $order_info['MemberAddress']['Country']['name']; ?></label>
								<label><?php echo $order_info['MemberAddress']['zip']; ?></label>
							</div>
							<div class="shpng_clcltn_lft order_detail_lft">
								<h4>Billing Address</h4>
								<label><?php echo $order_info['BillingAddress']['name']; ?></label>
								<label> <?php echo $order_info['BillingAddress']['address1']; ?>&nbsp;&nbsp;<?php echo @$order_info['BillingAddress']['address2']; ?></label>
								<label><?php echo $order_info['BillingAddress']['city']; ?>, <?php echo $order_info['BillingAddress']['State']['name']; ?>, <?php echo $order_info['BillingAddress']['Country']['name']; ?></label>
								<label><?php echo $order_info['BillingAddress']['zip_code']; ?></label>
							</div>
							<div class="shpng_clcltn_lft order_detail_lft border_last">
								<h4>Order Total</h4>
								<label class="total_width">Grand Total (Including Shipping & Tax): <span>$<?php echo $order_info['Order']['payment_gross']; ?></span> </label>
							</div>
						</div>		
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>