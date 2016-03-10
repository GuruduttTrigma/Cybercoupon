<script>
	$( function() {
   	var targets = $( '[rel~=tooltip]' ),
		target  = false,
		tooltip = false,
		title   = false; 
    	targets.bind( 'mouseenter', function() 
		{
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
<!----------for friend gift pop up ------------>
<?php 
if($this->params['action']=='gift_checkout')
{ 
?>
	<script>
		  $(document).ready(function()
		  {
			  $('.gift_link').click();
		 });
	</script>
<?php 
} 
?>

<!---------end friend gift pop up ------------>
<?php echo  $this->Html->script('frontend/development/customvalname.js'); ?>
<?php $total=0; ?>				
		<!-- new user -->
<div class="login_wrapper">
						<!--		Place order Top starts	-->
	<form id="payment" enctype="multipart/form-data" name="payment" method="post" action="<?php echo HTTP_ROOT.'Orders/add_payment_information';?>">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="new_user_area">
				<div class="login_heading">
					<h1><span class=""></span>Your Order</h1>
				</div>
				<div class="no-more-tables">
					<table class="col-md-12 table-bordered new_table border_none table-striped table-condensed cf">
						<thead class="cf">
							<tr>
								<th class="td_padding td_color text-center">Image</th>
								<th class="td_padding td_color td_width_adjust">Description</th>
								<th class="td_padding td_color td_width_adjust2">Qty</th>
								<th class="td_padding td_color"> Single Amount </th>
								<th class="td_padding td_color ">Total</th>
							</tr>
						</thead>
						<tbody>			     
							<input type="hidden" name="data[OrderDealRelation1][deal_id]" value="<?php echo $info['Deal']['id'];?>" />
							<input type="hidden" name="data[OrderDealRelation1][supplier_id]" value="<?php echo $info['Deal']['member_id'];?>" />
							<input type="hidden" name="data[OrderDealRelation1][deal_option_id]" value="<?php echo $info['DealOption']['id'];?>" />
							<input type="hidden" class="single_sale_price" name="data[OrderDealRelation1][discount_selling_price]" value="<?php echo $info['DealOption']['discount_selling_price'];?>" />
							<tr>
								<td class="numeric td_padding text-center img_td" width="12%;" data-title="Image">
									<div class="tb_img_outer"> <img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=80&h=70';?>" /> </div>
								</td> 	
								<td data-title="Description" width="33%;" class="td_padding">
								<?php
								//   pr($find_deal);die;
								$remaining_qty=$info['Deal']['quantity']-$info['Deal']['sales_deal'];
								echo $info['DealOption']['option_title'];
								?>  
								</td>
								<td class="numeric td_padding " width="12%;" data-title="Amount"> 
									<div class="form-group inline_element">
										<input type="text" class="checkout_qty" name="data[OrderDealRelation][qty]" value="1" style="text-align: center;width: 46px;" />
										<input type="hidden" class="remaining_qty" value="<?php echo $remaining_qty;?>" />
									</div>		
									<span class="X_symb"> X </span>
									<span id="err_qty" style="float: left;font-size: 12px;" class="errAjax error"></span>  
								</td>
								<td class="numeric td_padding td_cart_dis_price" width="19%;" data-title="Single Amount">
									<span><?php echo $currency."&nbsp"; ?></span> 
									<span class="cart_dis_price"> 
										<?php echo $info['DealOption']['discount_selling_price'];?>
									</span>
								</td>
								<td class="numeric td_padding td_cart_sub_total" data-title="Total">
									<span><?php echo $currency."&nbsp"; ?></span>
									<span class="cart_sub_total">
										<?php echo $info['DealOption']['discount_selling_price'];?>
									</span>													
								</td>
							</tr>
			         </tbody>
					</table>
				</div> 
				<?php 
				if($this->params['action']=='gift_checkout')
				{ ?>
				<div class="gift_div_new add_friend">
    				<a href="javascript:void(0);" class="gift_link" data-toggle="modal" data-target="#mymodal_gift"> <img src="<?php echo HTTP_ROOT.'img/frontend/gift-box.png'; ?>">
						<span class="gift_text">
                        Give this Cybercoupon as a Gift .  
						</span>
                  <span class="edit_gift" style="display:none;">Gift for: <span id="edit_name"></span>	Edit the Gift info .</span>
               </a>
    			</div>
				<?php
				}
				?>
				<div class="new_div_open_wrap" style="display:none;">						
					<div class="col-md-8 col-sm-8 col-xs-12 padding_0 margin_top_add new_div_open">		
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
							<label> Redeem Promotional Code   </label>
						</div>
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
								<div class="form-group">
									<input id="" placeholder="" class="form-control" type="text">
								</div>
							</div>
					</div>
			      <div class="col-md-4 col-sm-4 col-xs-12 text-left margin_top_add">		
			         <a class="btn btn-success" href="javascript:void(0);">Redeem</a>
			      </div>			
			   </div>
				<div class="last_data">
					<span > Total Amount  </span>  
					<span style="margin:0px;"><?php echo $currency."&nbsp"; ?></span><span class="cart_sub_total"> <?php echo $info['DealOption']['discount_selling_price'];?></span>
					<input type="hidden" name="data[OrderDealRelation1][sub_total]" value="<?php echo $info['DealOption']['discount_selling_price'];?>" />														
				</div>	
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">       
        	<div class="login_container">
				<div class="login_heading">
					<h1><span class=""></span>Payment Options</h1>
				</div>
				<div class="col-lg-7 col-sm-7 col-md-7 col-xs-12">
					<div class="new_left margin_bottom_add" style="padding:2px 20px 0 0;">										
						<div class="new_div_wrap_to_show" style="margin-top:0px;">
							<div class="col-md-12 col-sm-12 col-xs-12 padding_0">
								<h1 class="place_order_head">
									<!--Another Delivery Address:--> 
									Delivery Address/Address Details
									<label>
										<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  22px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="We require your physical address for any orders that require delivery. If the product your ordered does not require delivery, then your address is required when making a payment"/>
									</label>
								</h1>
								<div class="under_line_div"></div>	
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
									<label>First Name<em> *</em></label>
								</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
										<input id="inputUsernameEmail" value="<?php echo @$memberInf['Member']['name'];?>" name="data[OrderDealRelation][shipping_first_name]"  placeholder="First Name" class="form-control" type="text">
										<span id="err_shipping_first_name" class="errAjax error"></span>
									</div>
								</div>
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
									<label>Last Name<em> *</em></label>
								</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
										<input id="inputUsernameEmail" value="<?php echo @$memberInf['Member']['surname'];?>" name="data[OrderDealRelation][shipping_last_name]"  placeholder="Last Name" class="form-control" type="text">
										<span id="err_shipping_last_name" class="errAjax error"></span>
									</div>
								</div>
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
									<label>Address 1<em> *</em></label>
								</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
										  <input id="inputUsernameEmail" value="<?php echo @$memberInf['Member']['address'];?>" name="data[OrderDealRelation][shippingaddress_firstline]"   placeholder="Address 1" class="form-control" type="text">
											<span id="err_shippingaddress_firstline" style="" class="errAjax error"></span>
									</div>
								</div>										
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
    								<label>City<em> *</em></label>
    							</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
										  <input id="inputUsernameEmail"  value="<?php echo @$memberInf['Member']['city'];?>" placeholder="City" name="data[OrderDealRelation][shippingaddress_city]" class="form-control" type="text">
											<span id="err_shippingaddress_city" class="errAjax error"></span>
									</div>
								</div>
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
    								<label>Province<em> *</em></label>
    							</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
										 <input id="inputUsernameEmail" value="<?php echo @$memberInf['Member']['state'];?>"  placeholder="State" name="data[OrderDealRelation][shippingaddress_state]" class="form-control" type="text">
										<span id="err_shippingaddress_state" class="errAjax error"></span>
									</div>
								</div>
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
									<label>PostCode<em>*</em></label>
								</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
										<input id="inputUsernameEmail"  value="<?php echo @$memberInf['Member']['postal_code'];?>" placeholder="PostCode" name="data[OrderDealRelation][shippingaddress_zip]"  class="form-control" type="text">
										<span id="err_shippingaddress_zip" class="errAjax error"></span>
									</div>
								</div>
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
									<label>Cell phone number<em>*</em></label>
								</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
											 <input id="inputUsernameEmail" value="<?php echo @$memberInf['Member']['phone'];?>" maxlength="16" placeholder="Cell phone number" name="data[OrderDealRelation][shippingaddress_cell_phone_number]"  class="form-control  " type="text">
											<span id="err_shippingaddress_cell_phone_number" class="errAjax error"></span>
									</div>
								</div>
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
									<label>Company name<em> </em>
									<label>
										<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  15px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="If you are
making this purchase on behalf of a company, enter that company name here.
This company name will then display on the voucher/invoice as the purchaser"/>
									</label>											
									</label>
								</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
											 <input placeholder="Company name" name="data[OrderDealRelation][shippingaddress_company_name]"  value="<?php echo @$memberInf['Member']['shippingaddress_company_name'];?>" class="form-control" type="text">
									</div>
								</div>
								<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
									<label>Colour/size choice<em> </em>
									<label>Colour/size choice<em> </em>
										<label>
											<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  15px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="If applicable, please enter the colour/size of the product you are ordering here"/>
										</label>											
									</label>
								</div>
								<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
									<div class="form-group">
											<input placeholder="Remark" name="data[OrderDealRelation][shippingaddress_customer_remarks]"  value="<?php echo @$memberInf['Member']['shippingaddress_customer_remarks'];?>" class="form-control" type="text" maxlength="120">
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
									<div class="recquire_field">
										<p><em>* </em> Required</p>
									</div>
								</div>														
							</div>
						</div>							
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							<div class="recquire_field margin_top_add">
									<p> Please note, we cannot deliver to P.O. Box addresses. Any order placed with a PO Box address only, will be cancelled. </p>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 margin_top_add">
							<h2 class="notice_head"> Important Notice: </h2>														
							<ol class="new_ol_for_note">
								<li>
									Please be aware that the above delivery address will be used by the relevant supplier/courier company for delivery purposes.																																	
								</li>
								<li> 
									Please provide your Cell Phone number and complete and accurate delivery information (incl. correct postal code ) for the courier company.
								</li>
								<li> Sorry! We cannot deliver to PO Box addresses. </li>
								<li> 
									Deliveries occur between 8am and 5pm Monday - Friday , so a work address is ideal.
									Alternatively choose another address where somebody is home and can sign for the delivery and accept it.  
								</li>
								<li> 
									Please ensure that you enter the Company name (if applicable), address field and all other relevant information. </li>
							</ol>										
						</div>										
					</div>
				</div>
				<div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
					<div class="new_right margin_bottom_add">
						<div class="col-md-12 col-sm-12 col-xs-12 padding_0">
										<h1 class="place_order_head">2.) Choose Payment Method: </h1>
										<div class="under_line_div"></div>													
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							<?php if($info['Deal']['modePayment'] == 'All') { ?>
							<div class="form-group new_form_pay">
								<p class="img_contain"> 
								 <input type="radio" name="cardpayment" value="PAYU" checked="checked" class="r1_class">
									Credit /  Debit Card 		
								</p>
								<p class="img_contain">
													<img src="<?php echo HTTP_ROOT?>img/frontend/v_1.png"  class="v_1"/>												
													<img src="<?php echo HTTP_ROOT?>img/frontend/v_2.png" />												
								</p>
							</div>
							<?php } else { ?>
							
							<p style="color:#444;"> 
								Credit card payments are not offered for this deal and payment may only be made by EFT/bank transfer.
							</p>
							<p></p>
							<?php } ?>
							

							
						 <div class="form-group">
									<p>
										<input type="radio" <?php if($info['Deal']['modePayment'] == 'EFT') :echo "checked"; endif;?> name="cardpayment" value="EFT" class="r1_class">
									  Electronics Funds Transfer (EFT) 
								</p>
</div>
							<div class="eft_wrap credit" <?php if($info['Deal']['modePayment'] == 'All') { ?>style="display:none"<?php } ?>>
										<div class="new_wrap_form">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												 <div class="row">  																			
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="form-group">
																<label>Account Name:</label>
															</div>
														</div>
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="">
																<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
																	<div class="form-group">
																		<span>Cyber Coupon Pty Ltd
	 </span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">  																			
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="form-group">
																<label>Bank Name:</label>
															</div>
														</div>
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="">
																<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
																	<div class="form-group">
																		<span>FNB
	 </span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">  																			
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="form-group">
																<label>Account No.:</label>
															</div>
														</div>
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="">
																<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
																	<div class="">
																		<span>62489846562</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">  																			
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="form-group">
																<label>Branch Code:</label>
															</div>
														</div>
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="">
																<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
																	<div class="form-group">
																		<span>254005</span>
																	</div>
																</div>
															</div>
														</div>
													</div>
													
												</div>	
													<div class="col-md-12 col-sm-12 col-xs-12 padding_0 margin_top_add">
															<label> Transaction reference no.  </label>
													</div>
													<div class="row">
														<div class="col-md-12 col-sm-12 col-xs-12">
															<input type="text" id="" name="data[OrderDealRelation][eft]" readonly value="<?php echo $referenceNo; ?>" placeholder="transaction number" class="form-control">	
		<span id="err_eft" style="" class="errAjax error"></span>
		<span id="user_alert" style="color: #999;margin-top: 5px;">Please ensure that you use the above payment reference no. as your deposit reference when paying us. </span><span><strong> You do not need to send us proof of payment.</strong>
		</span><div></div>
		 <span id="user_alert1" style="color:black;margin-top: 5px;">Once we have received your payment by EFT with the above transaction reference no. we will update this sale as being paid and you will be emailed your voucher, normally within 2 working days.
		</span><div></div>
		<span id="user_alert2" style="margin-top: 5px;">We can only process cleared funds in the above time frame and do not accept cheques as a form of payment.
		</span>
															</div>														
													</div>																	
												
										</div>	
							</div>												
							
							
						
						
						
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							
							<div class="form-group">
								<p>
								<input type="checkbox" value="terms" id="terms_click" rel="terms" class="terms_subscription">
		 <input type="hidden" value="" class="terms" name="data[OrderDealRelation][terms]">Agree to the
								<a href="javascript:void(0);">
								Terms &amp; Conditions
								</a>
		 <span id="err_terms" style="" class="errAjax error"></span>
								</p>
							</div>
							
						
							
						</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
								<div class="eft_wrap_btn">Once you have used or copied the above transaction reference number and
the banking details listed above, <strong>you should<input type="submit" class="btn btn-success" onclick="return ajax_formname('payment','Validates/paymentadress_validate','receiver')" value="Click Here"/>
to complete this transaction and return to the homepage.</strong>
								</div>
								<?php if($info['Deal']['modePayment'] == 'All') { ?>
								<div class="credit_wrap_btn text-center">
								<input type="submit" class="btn btn-success" onclick="return ajax_formname('payment','Validates/paymentadress_validate','receiver')" value="Submit"/>
								</div>	
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
      </div>
	</form>
</div>
 <!--------------start for friend gift pop up code ------------>

<div class="modal fade" id="mymodal_gift" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<form id="friend" method="POST" action="<?Php echo HTTP_ROOT.'Orders/add_friend_gift';?>">
	<div class="modal-content removed_border_radius">
		<div class="modal-header new_modal_header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="">   Gift Options   </h4>
		</div>
      <div class="modal-body gift_body">
			<h1 class="margin_bottom_add new_fill_heading"> Fill out the form below and give the gift of Cybercoupon! </h1>
				<div class="gift_wrap">
					<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 padding_0">  
						<div class="row">											  						
							<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
								<div class="wrap_modal_form_inner">											  										
									<div class="row">
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <label for="rec_name"> To: </label>  </div>	
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">                      
											<input name="data[Friend][id]" type="hidden" id="friend_id" value=""  />                       
											<input name="data[Friend][gift_to]" class="form-control required" type="text" id="rec_name"  placeholder="Recipient's name" />
										</div>	
									</div>	
								</div>
								<div class="wrap_modal_form_inner">											  										
									<div class="row">
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <label for="y_name">From: </label>  </div>	
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <input class="form-control required" name="data[Friend][gift_from]" placeholder="Your name"  type="text" id="y_name" /> </div>	
									</div>	
								</div>									  									
								<div class="wrap_modal_form_inner">											  										
									<div class="row">
										<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <label> Delivery Method: </label> </div>
											<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">  <p> <input class="form-control dl1 emailit" type="radio" id="delivery1" value="demail"  name="d1" />  <label for="delivery1"> Email it </label> </p> 
												<div class="wrap_modal_form_inner specific_email" style="display:none;">  										
													<div class="row">
														<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <label for="email">Email: </label>  </div>	
														<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <input class="form-control required" name="data[Friend][friend_email]" type="email" id="email" placeholder="Email" />  </div>	
													</div>	
												</div>			
											</div>	
											<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <p> <input class="form-control dl1 print" type="radio" id="delivery2" name="d1" value="dprint"checked="checked" />  <label for="delivery2"> I'll print it myself </label> </p> </div>	
									</div>	
								</div>																
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
									<div class="wrap_modal_form_inner color_new_form">											  										
										<div class="row">
											<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <label for="msg">Message(Optional): </label>  </div>	
											<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <textarea class="form-control" type="text"  name="data[Friend][message]" id="msg" placeholder="Tell them why they are so lucky" cols="100%" rows="15"></textarea>  </div>	
										</div>	
									</div>	  							    
							</div> 
						</div>
					</div>
				</div>		
			</div>
			<div class="modal-footer">
				<a href="javascript:void(0)" type="button" class="btn btn-success save_btn_modal friend_gift"> Save</a>
				<a href="javascript:void(0)" type="button" class="giftpopup_cancel" data-dismiss="modal" class="btn btn-default"> Cancel</a>
			</div>
      </form>
   </div>
</div>
</div>
<script>
$(document).ready(function()
{
   $('.friend_gift').click(function(){
      $('#friend').validate();
		if($('#friend').valid())
		{
			$.ajax({
				url:ajax_url+'Orders/add_friend_gift',
				method:'POST',
				data:$('#friend').serialize(),
				success:function(resp)
				{
					var success=resp.split('|');
					//console.log(success);
					//alert(success[0]);
					//alert(success[1]);
					//alert(success[2]);
					$('.giftpopup_cancel').click();
					//return false;
					$('#friend_id').val(success[1]);
					$('#order_friend_id').val(success[1]);
					$('#edit_name').text(success[2]);
					//alert(resp)   
					$('.gift_text').hide();
					$('.edit_gift').show();									 
				}
			});                  
		}
   });
	$('.emailit').click(function()
	{
		$('.specific_email').show();
	});
	$('.print').click(function()
	{
		$('.specific_email').hide();
	});
});
</script>   
<!-----------------end here friend gift pop up -------------->
<script>
	$('.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(600);
	}, function() {
	  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)
	});
</script>
<!-- end drop hover script -->	
<script>
$(document).ready(function(){
	$('.new_radio_del').click(function(){	
		var radio3= 	$(this).val();
		if(radio3=='anotherbilling')
		{
			$('.new_div_wrap_to_show').slideDown();															
		}
		else if(radio3=='samebilling')
		{
			$('.new_div_wrap_to_show').slideUp();	
			//alert('hello')
			$('.first_add').addClass('required');												
		}
	});
	$('.credit_wrap').show();
	<?php if($info['Deal']['modePayment'] == 'All') { ?>
	$('.eft_wrap,.eft_wrap_btn').hide();
	<?php } ?>
	$('.r1_class').click(function(){
		var radio=$(this).val();
		if(radio=='EFT')
		{
				$('.credit_wrap, .credit_wrap_btn').hide();		
				$('#user_alert').slideDown();		
				$('#user_alert1').slideDown();		
				$('#user_alert2').slideDown();		
				$('.eft_wrap, .eft_wrap_btn').slideDown();	
		}
		else if(radio=='PAYU')
		{
			  $('.credit_wrap, .credit_wrap_btn').slideDown();
			  $('.credit').slideUp();			
			  $('#user_alert, .eft_wrap_btn').slideUp();		
			  $('#user_alert1, .eft_wrap_btn').slideUp();		
			  $('#user_alert2, .eft_wrap_btn').slideUp();		
		}
	})		
	if($('#subscription_click').is(':checked'))
	{
		var checked_value=$(this).val();
		var rel_value=$(this).attr('rel');
		$('.'+rel_value).val(checked_value);
	}
	else
	{
		var rel_value=$(this).attr('rel');
		$('.'+rel_value).val('');
	}
	if($('#terms_click').is(':checked'))
	{
		var checked_value=$(this).val();
		var rel_value=$(this).attr('rel');
		$('.'+rel_value).val(checked_value);
	}
	else
	{
		//var checked_value=$(this).val();
		var rel_value=$(this).attr('rel');
		$('.'+rel_value).val('');
	}       
	$('.terms_subscription').on('click',function()
	{
		if($(this).is(':checked'))
		{
			var checked_value=$(this).val();
			var rel_value=$(this).attr('rel');
			$('.'+rel_value).val(checked_value);
		}
		else
		{
			//var checked_value=$(this).val();
			var rel_value=$(this).attr('rel');
			$('.'+rel_value).val('');
		}
	});

   var checkout_qty=$('.checkout_qty').val();
			if(checkout_qty!='')
			{
				var single_sale_price=$('.single_sale_price').val();
				var sub_total=checkout_qty*single_sale_price;
				$('.cart_sub_total').html(sub_total);
				$('.cart_sub_total').next('input').val(sub_total);
			}
			
		$('.checkout_qty').on('input',function()	
		{
			var intRegex = /^\d+$/;
			var checkout_qty=$(this).val();
			var remaining_qty=$('.remaining_qty').val();
			
			if(checkout_qty !='' && intRegex.test(checkout_qty))
			{
				if(parseInt(checkout_qty)<=parseInt(remaining_qty))
				{
					var single_sale_price=$('.single_sale_price').val();
					var sub_total=checkout_qty*single_sale_price;
					$('.cart_sub_total').html(sub_total);
					$('.cart_sub_total').next('input').val(sub_total);
				}
				else
				{
					$('.checkout_qty').val(1);
					var checkout_qty=1;
					var single_sale_price=$('.single_sale_price').val();
					var sub_total=checkout_qty*single_sale_price;
					$('.cart_sub_total').html(sub_total);
					$('.cart_sub_total').next('input').val(sub_total);
					alert('Your entery is exceed than available stock.');
				}
			}	
			else
			{
				if(checkout_qty == 0)
				{
					$('.checkout_qty').val();
				}
				else
				{
					$('.checkout_qty').val(Math.ceil(checkout_qty));
					
				}
			}
		})								
})
</script>		