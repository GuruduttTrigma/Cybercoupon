<table class="col-md-12 col-sm-12 col-xs-12 table-bordered border_none table-striped table-condensed cf show_table">
		<thead class="cf">
			<tr>
				<!--<th class="td_padding td_color" width="65">Image</th>-->
				<th class="td_padding td_color" width="230" >Deal Name</th>
				<th class="td_padding td_color" width="240" > Customer E-mail</th>
				<th class="td_padding td_color" >Purchase Date</th>
				<th class="td_padding td_color" >Total Amount</th>
			</tr>
		</thead>
</table>
<?php 
if(!empty($orderrelation))
{
	foreach($orderrelation as $list)
	{
	//pr($list);
?>				
				<table class="col-md-12 col-sm-12 col-xs-12 table-bordered border_none table-striped table-condensed cf show_table sale_deal_tbl pp" data-saleorder="<?php echo $list['OrderDealRelation']['id']; ?>" >
					<tbody class="word_wp">
						<tr>
							<!--<td class="td_padding" data-title="Image"  width="55" style="border-bottom:none;"><img src="<?php echo IMPATH.'deals/'.$list['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/></td>-->
							<td class="td_padding" data-title="Deal Name"  width="230" style="border-bottom:none;"><?php echo $list['Deal']['name']; ?> </td>
							<td data-title="Customer Name" class="numeric td_padding"   width="240" style="border-bottom:none;"><?php echo @$list['Order']['Member']['email']; ?> </td>
							<td data-title="Purchase Date" class="numeric td_padding"style="border-bottom:none;"><?php echo date('d M Y',strtotime($list['Order']['payment_date'])); ?>
							<!--<a href="javascript:void(0);"><span class=" glyphicon glyphicon-chevron-down"></span></a>-->
							</td>
							<td data-title="Purchase Date" class="numeric td_padding"style="border-bottom:none;">
								<?php echo $list['OrderDealRelation']['sub_total']; ?>
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
									<label>Deal Name:</label>
								</div>
							</div>
							<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
								<div class="edit_field">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
										<div class="form-group">
											<span><?php echo @$list['Deal']['name']; ?><span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
								<div class="form-group">
									<label>Deal Range:</label>
								</div>
							</div>
							<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
								<div class="edit_field">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
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
									<label>Customer Name:</label>
								</div>
							</div>
							<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
								<div class="edit_field">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
										<div class="form-group">
											<span><?php echo $list['Deal']['Member']['name'].' '.$list['Deal']['Member']['surname']; ?>  <span>
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
											<span><?php echo date('d M Y',strtotime($list['Order']['payment_date'])); ?> <span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
								<div class="form-group">
									<label>Voucher Quantity:</label>
								</div>
							</div>
							<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
								<div class="edit_field">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
										<div class="form-group">
											<span><?php echo $list['OrderDealRelation']['qty']; ?>  <span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
								<div class="form-group">
									<label>Amount per quantity:</label>
								</div>
							</div>
							<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
								<div class="edit_field">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
										<div class="form-group">
											<span><?php echo $list['OrderDealRelation']['discount_selling_price']; ?>  <span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
								<div class="form-group">
									<label>Total Amount:</label>
								</div>
							</div>
							<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
								<div class="edit_field">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="form-group">
											<span><?php echo $list['OrderDealRelation']['sub_total']; ?><span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 ">
							<?php /*<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0">
									<div class="form-group">
										<label>Business Address:</label>
									</div>
								</div>
								<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12  hide_address_div m_padding_0 ">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 ">
											<div class="form-group">
												<span><a href="javascript:void(0);" class="address_link bus_link" rel="bus_adrs_open"><span class="glyphicon glyphicon-hand-right"></span>Click here to view Business Address</a><span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- bussiness address -->
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
								<div class="Billings_address_colloups bus_adrs_open" style="display:none;">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>First Name:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
													<div class="form-group">
														<span><?php echo @$list['OrderDealRelation']['billing_first_name']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>Last Name:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo @$list['OrderDealRelation']['billing_last_name']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>Address:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo @$list['OrderDealRelation']['billingaddress_firstline']; ?></span>
														<span><?php echo @$list['OrderDealRelation']['billingaddress_secondline']; ?></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>City:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo @$list['OrderDealRelation']['billingaddress_city']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>State:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo @$list['OrderDealRelation']['billingaddress_state']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>Postal Code:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo @$list['OrderDealRelation']['billingaddress_zip']; ?><span>
													</div>
													<div class="form-group">
														<a href="javascript:void(0);" class=" btn btn-success cancel_delievery_address cancel_open" data-addr_link="bus_link" data-open_page="bus_adrs_open">Cancel</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> */ ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0 ">
								<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
								<div class="form-group">
									<label>Delivery Address:</label>
								</div>
								</div>
							<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12   hide_dilevery_address_div">
								<div class="edit_field">
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="form-group">
											<!--<span><a href="javascript:void(0);" class="address_link del_link" rel="del_adrs_open" style="padding-left:5px"><span class="glyphicon glyphicon-hand-right"></span>Click here to view Delivery Address</a><span>-->
										</div>
									</div>
								</div>
							</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<!--<div class="delivery_address_colloups del_adrs_open" style="display:none;">-->
								<div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>Del First Name:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo $list['OrderDealRelation']['shipping_first_name']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>Last Name:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo $list['OrderDealRelation']['shipping_last_name']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>Address:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo $list['OrderDealRelation']['shippingaddress_firstline']; ?></span>
														<span><?php echo @$list['OrderDealRelation']['shippingaddress_secondline']; ?></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>City:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo $list['OrderDealRelation']['shippingaddress_city']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>State:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo $list['OrderDealRelation']['shippingaddress_state']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>Postal Code:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo $list['OrderDealRelation']['shippingaddress_zip']; ?><span>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
										<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
											<div class="form-group">
												<label>Contact No:</label>
											</div>
										</div>
										<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 ">
											<div class="edit_field">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="form-group">
														<span><?php echo trim($list['Order']['Member']['phone']!='')?$list['Order']['Member']['phone']:"N/A"; ?><span>
													</div>
													<div class="form-group">
														<!--<a href="javascript:void(0);" class="cancel_address cancel_open btn btn-success" data-addr_link="del_link" data-open_page="del_adrs_open">Cancel</a>-->
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
							
 <?php
   } 
}
else
{ ?>
		<tr>
			<td colspan="5">
				<div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
					<h2 class="text-center" style="color:#333;">No Records Found</h2>
					<div class="col-md-12  padding_0 form_div_margin_top"></div>
				</div>
			</td>
		</tr>
<?php
}
?>


<!--------------------------for pagination-------------------------------------------------------------->
   <?php   if(!empty($orderrelation)){   
 $pagParam = $this->Paginator->params();
 //pr($this->params);die;
       $this->Paginator->options(array('url' => array('controller'=>'Suppliers','action'=>'sales_made')));
   ?>
  <div class="pagination_div text-center">	
    		<ul class="pagination search_paging sale_made_pagination">
				<?php if($this->params['paging']['OrderDealRelation']['pageCount']>1) { ?> 		   
					<li><?php echo $this->Paginator->prev('Prev'); ?></li>
					<li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter')); ?> </li>
					<li><?php  echo $this->Paginator->next('Next'); ?></li>
				<?php } ?>
         </ul>					
		</div>					
<?php } ?>


<script>
	$( function() {
   	var targets = $( '[rel~=tooltip]' ),
      target  = false,
      tooltip = false,
      title   = false; 
    	targets.bind( 'mouseenter', function() {
      	target  = $( this );
        	tip     = target.attr( 'title' );
        	tooltip = $( '<div id="tooltip"></div>' );
         if( !tip || tip == '' )
            return false;
         target.removeAttr( 'title' );
 	      tooltip.css( 'opacity', 0 )
         .html( tip )
         .appendTo( 'body' );
 			var init_tooltip = function() {
            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                tooltip.css( 'max-width', $( window ).width() / 2 );
            else
                tooltip.css( 'max-width', 340 ); 
            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                pos_top  = target.offset().top - tooltip.outerHeight() - 20; 
            if( pos_left < 0 ) {
                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                tooltip.addClass( 'left' );
            }
            else 
                tooltip.removeClass( 'left' );
            if( pos_left + tooltip.outerWidth() > $( window ).width() ) {
                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                tooltip.addClass( 'right' );
            }
            else
                tooltip.removeClass( 'right' );
            if( pos_top < 0 ) {
                var pos_top  = target.offset().top + target.outerHeight();
                tooltip.addClass( 'top' );
            }
            else
                tooltip.removeClass( 'top' );
 		          tooltip.css( { left: pos_left, top: pos_top } )
                   .animate( { top: '+=10', opacity: 1 }, 50 );
        	}; 
        	init_tooltip();
        	$( window ).resize( init_tooltip );
         var remove_tooltip = function() {
            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function() {
                $( this ).remove();
            }); 
            target.attr( 'title', tip );
        	};
         target.bind( 'mouseleave', remove_tooltip );
 	      tooltip.bind( 'click', remove_tooltip );
    	});
	});
</script>

