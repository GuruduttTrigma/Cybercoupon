<script>
  $(document).ready(function(){
      $('.gift_link').click();
  });
</script>
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
                      
                     <input name="data[Friend][id]" type="hidden" id="friend_id" value="<?php echo @$success[0];?>"  />
                       
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
									  													 <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <p> <input class="form-control dl1 print" type="radio" id="delivery2" name="d1" value="dprint" />  <label for="delivery2"> I'll print it myself </label> </p> </div>	
									  										</div>	
									  								</div>
									  								
									  						</div>
									  						<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
									  									<div class="wrap_modal_form_inner color_new_form">											  										
									  										<div class="row">
									  													 <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <label for="msg">Message(Optional): </label>  </div>	
									  													 <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12"> <textarea class="form-control required" type="text"  name="data[Friend][message]" id="msg" placeholder="Tell them why they are so lucky" cols="100%" rows="15"></textarea>  </div>	
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
<!-- end of friend gift pop up-->

<!--		Place order Top starts	-->
<?php
 $login_id=$this->Session->read('Member.id');
 $total=0; 
?>

						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							<div class="new_user_area">
								<div class="login_heading">
									<h1><span class=""></span>Your Order</h1>
								</div>
							<!--	<div class="sub_heading_new"> 
											<h4>  You have <?php echo count($cart);?> item in your cart. </h4></br>						
								</div> -->
						<div class="no-more-tables">
       <?php
          if(!empty($cart))
           {
          ?>  
							<table class="col-md-12 col-lg-12 col-xs-12 col-sm-12 table-bordered new_table border_none table-striped table-condensed cf">
								<thead class="cf">
									<tr>
									 <th class="td_padding td_color text-center">Image</th>
										<th class="td_padding td_color td_width_adjust">Deal</th>
										<th class="td_padding td_color td_width_adjust2"> Qty</th>
										<th class="td_padding td_color"> Single Amount </th>
										<th class="td_padding td_color ">Total</th>
										<th class="td_padding td_color ">Action</th>
										<!--<th class="td_padding td_color"> Shipping Cost </th>
										<th class="td_padding td_color "> Standard R</th>  -->
									</tr>
								</thead>
								<tbody>
      <?php foreach($cart as $info)
      { 

        if($info['Deal']['active']=='Yes')
        {

				        $option_arr=$info['Deal']['DealOption'];
				        foreach($option_arr as $each_option)
				        {
//pr($each_option);
				           if($info['Cart']['deal_option_id']==$each_option['id'])
				           {
				              $selected_option=$each_option;
                   break;
				           }
               else
                {
                    $selected_option=array();

                }
				        }
//pr($info);die;
//echo "jjj";pr($selected_option);die;
        if(!empty($selected_option))
        {
      ?>
									<tr class="cart_<?php echo $info['Cart']['id'];?>">
            <td class="numeric td_padding text-center img_td" data-title="Image">
											 <div class="tb_img_outer"> <img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=50&h=30';?>" /> </div>
										 </td> 	
										<td data-title="Description" class="td_padding">
									  		<?php echo $selected_option['option_title'];?>  
										</td>
										<td class="numeric td_padding " data-title="Amount"> 
												<div class="form-group inline_element">
														<select class="select">	
														<?php
														 for($j=1;$j<=5;$j++)
														 {
														 	?>
														  	<option value="<?php echo $j;?>" <?php if($j==$info['Cart']['qty']){?> selected="selected" <?php } ?> ><?php echo $j;?></option>
														 	<?php
														 	}
														 	?>
																														
														</select> 
														<input class="cart_id" type="hidden" value="<?php echo $info['Cart']['id'];?>"/>
                
												</div>		
											<span class="X_symb"> X </span>
										</td>
										<td class="numeric td_padding td_cart_dis_price" data-title="Single Amount"><span><?php echo $currency."&nbsp"; ?></span> <span class="cart_dis_price"> <?php echo $info['Cart']['discount_selling_price'];?><span></td>
										<td class="numeric td_padding td_cart_sub_total" data-title="Total"><span><?php echo $currency."&nbsp"; ?></span> <span class="cart_sub_total"><?php echo $info['Cart']['sub_total'];?></span></td>
									 <td class="numeric td_padding text-center" data-title="Action">
               <a class="delete_cart" rel="<?php echo $info['Cart']['id'];?>" href="javascript:void(0)"> <i class="glyphicon glyphicon-trash"></i>
               </a>
           </td>
							 </tr>
				    <?php 
				        $total += $info['Cart']['sub_total']; 

              }    // if selected option is not empty.
            }
				     }
				   ?>
						</table>
            <?php }
             else
            {
            ?>
							<div style="text-align:center; border:none;">
             </br>Uh oh... Your cart is empty!</br></br>
           </div>	
							<?php } ?>
						</div>
					 <div class="gift_div_new add_friend">
										<a href="javascript:void(0);" class="gift_link" data-toggle="modal" data-target="#mymodal_gift"> <img src="<?php echo HTTP_ROOT.'img/frontend/gift-box.png'; ?>"> Give this Cybercoupon as a Gift . </a>
						</div>
    <div class="gift_div_new edit_friend" style="display:none;">
								<a href="javascript:void(0);" class="gift_link" data-toggle="modal" data-target="#mymodal_gift"> <img src="<?php echo HTTP_ROOT.'img/frontend/gift-box.png'; ?>">	 Gift for: <span id="edit_name"></span>	Edit the Gift info . </a>
					</div>	
					 <!--<div class="gift_div_new">
								<div class="edt_main_otr">	
											<div class="edt_div"><img src="<?php echo HTTP_ROOT.'img/frontend/gift-box.png'; ?>"> Gift for:</div><a href="javascript:void(0);" class="gift_link crs" data-toggle="modal" data-target="#mymodal_gift">Edit the Gift info .</a><img src="<?php echo HTTP_ROOT.'img/frontend/cros.png'; ?>">
								</div>
						</div>-->
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
       <?php
          if(!empty($cart))
           {
          ?>  
						<div class="last_data">
							<span style="margin-right:5px;padding:0px;"> Total Amount  </span>  
							<span class="amt_last"><span style="margin-right:5px;color:#333;padding:0px;"> <?php echo $currency."&nbsp"; ?> </span><span class="cart_all_total" style="margin-right:5px;color:#333;padding:0px;"><?php echo $total;?></span></span>														
						</div>	
         <?php } ?>
						<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
													<div class="btn_outer_div_wrap">
																<a href="javascript:void(0)" class="btn btn-default">  Continue Shopping </a>
                  <?php
                  if(!empty($cart) && $login_id != '')
                  {
                  ?>  													
																   <a href="<?php echo HTTP_ROOT.'Orders/proceed_checkout';?>" class="btn btn-success">  Proceed To Checkout </a>			
                  <?php
	                 }
	                 else
	                 {
	                ?>
	                    <a href="<?php echo HTTP_ROOT.'Customers/login?redirect='.base64_encode(convert_uuencode($this->params->url));?>" class="btn btn-success">  Proceed To Checkout </a>	
	                <?php
                  } ?>								
													</div>						
						</div>
			 </div>
			</div>
	</div>
				<!-- End login area -->
    
<script>
  $(document).ready(function(){

      $('.delete_cart').click(function(){
					    var cart_id=$(this).attr('rel');
					    $this=$(this);
              $.ajax({
																	url:ajax_url+'Orders/delete_cart/'+cart_id,
																	method:'POST',
																	success:function(resp)
																	{
                           //$this.parent('td').parent('tr').remove();
                           $('tr.cart_'+cart_id).remove();
                           var removed_price=$this.parent('td').prev('td').children('.cart_sub_total').html();
                           var cart_all_total=$('.cart_all_total').html();
                           var remain_price=parseFloat(cart_all_total) - parseFloat(removed_price);
                           $('.cart_all_total').html(remain_price);
                           var cart_count_val=$('.cart_count').html();
                           $('.cart_count').html(cart_count_val-1);
																	}				
								     	});  
        });  
 
				/*$('.delete_cart').click(function(){
					    var cart_id=$('.cart_id').val();
					    $this=$(this);
              $.ajax({
																	url:ajax_url+'Orders/delete_cart/'+cart_id,
																	method:'POST',
																	success:function(resp)
																	{
                           $this.parent('td').parent('tr').remove();
                           var removed_price=$this.parent('td').prev('td').children('.cart_sub_total').html();
                           var cart_all_total=$('.cart_all_total').html();
                           var remain_price=parseFloat(cart_all_total) - parseFloat(removed_price);
                           $('.cart_all_total').html(remain_price);
                           var cart_count_val=$('.cart_count').html();
                           $('.cart_count').html(cart_count_val);
																	}				
								     	});  
        });*/
              
         	$('.select').change(function(){
          	      var qty=$(this).val();
          	      var cart_all_total=$('.cart_all_total').html();
          	      var cart_single_total=$(this).parent('div').parent('td').siblings('.td_cart_sub_total').children('.cart_sub_total').html();
        	       var cart_single_price=$(this).parent('div').parent('td').siblings('.td_cart_dis_price').children('.cart_dis_price').html();
          	      var cart_id=$(this).next('.cart_id').val();
          			    $this=$(this);
				           $.ajax({
														url:ajax_url+'Orders/update_cart',
														method:'POST',
														data:{cart_id:cart_id,quantity:qty,cart_single_price:cart_single_price,cart_single_total:cart_single_total,total_amount:cart_all_total},
														success:function(resp)
														{
                   var price=resp.split('-');
                   if(price[0]=='success')
                   {
			                   $this.parent('div').parent('td').siblings('.td_cart_sub_total').children('.cart_sub_total').html(price[1]);
			                   $('.cart_all_total').html(price[2]);
                      $('.head_cart_tbody').children('tr.cart_'+cart_id).children('td.single_td_qnt').html(qty);
           							 }
           							 else
           							 {
           							 			alert('Somthing going in wrong way.');
           							 	}
														}				
												});  
          	});
   });
</script>
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
                                // alert(success[0]);
                                //alert(success[1]);
                                // alert(success[2]);
                                $('#friend_id').val(success[1]);
                                $('#edit_name').text(success[2]);
                                $('.giftpopup_cancel').click(); 
          																									   //alert(resp)   
                                $('.add_friend').hide();
                                $('.edit_friend').show();
                                               
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