<?php echo $this->Html->css('frontend/jquery.countdown.css');?>
<?php echo $this->Html->script('frontend/development/jquery.countdown.js');?>

<?php echo $this->Html->css('frontend/flexslider.css');?>
<?php echo $this->Html->script('frontend/design/jquery.flexslider.js');?>

<script type="text/javascript" charset="utf-8">
	$(function () {
		var current_date='<?php echo strtotime(date("Y-m-d H:i:s")); ?>';
		//alert(current_date);
		var dealdate='<?php echo strtotime(date("Y-m-d",strtotime($find_deal["Deal"]["buy_to"]))); ?>';
		var until= dealdate-current_date;
		if(until>0) {
			$('#countdown').countdown({until: until});
		}
		else {
			$('#countdown').html('expired');
		}
	}) 
	
</script>
<style>
.login_modal .text_area
{
height:140px;
resize:none;	
margin-bottom:15px;
}
.flex-control-thumbs li
{
	width: 16.66%;
}
.img_container label
{
	float: left;
	margin: 0 5px 0 0;
	width: auto;
}
.img_container span
{
	float: left;
	margin-right: 10px;
	width: auto;
}
</style>
<?php 
	$member_type=$this->Session->read('Member.member_type');
   //echo $member_type;die;
?>
<!--   mymodal_buy pop up for deal option  -->
<div class="modal fade" id="mymodal_buy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content removed_border_radius">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="" >   Choose your Deal   </h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<?php $member_id=$this->Session->read('Member.id');
						$member_type=$this->Session->read('Member.member_type');
						//	echo $member_type;die;
					?>
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<?php // pr($find_deal);
							foreach($find_deal['DealOption'] as $info) {
								if(trim($info['option_title'])!='') {
						?>
						<div class="wrapper_new_modal">
							<div class="main_wrap_modal_inner">
								<div class="left_modal col-md-9 col-sm-9 col-xs-12 col-lg-9 padding_0">
									<div class="col-md-9 col-sm-9 col-lg-9 col-xs-12">
										<a href="javascript:void(0)">	 
											<?php echo $info['option_title'];?>	
										</a>
										<span class="desc_modal_new">  
											Was <?php echo $currency; ?><b>											
											<?php echo round($info['selling_price'])."&nbsp";?></b>	
											Now <?php echo $currency; ?><b>
											<?php echo round($info['discount_selling_price'])."&nbsp"; ?></b>
											You save <?php echo $currency; ?><b>
											<?php echo round($info['discount'])."&nbsp"; ?> 
											</b>
										</span>
									</div>
									<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
										<span class="quantity_span">  </span>
										<span class="sub_quantity_text">  </span>
									</div>
								</div>
								<div class="right_modal col-md-3 col-sm-3 col-lg-3 col-xs-12 padding_0 text-center">
									<!--<a href="<?php echo HTTP_ROOT.'Orders/add_cart/'.$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($info['id']));?>" class="btn btn-success"> Buy Now </a>-->
								<?php if(!empty($member_id) && $member_type == '4' ) {   ?>
									<a href="<?php echo HTTP_ROOT.'Orders/proceed_checkout/'.$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($info['id']));?>" class="btn btn-success"> Buy Now </a>
								<?php } 	else if(!empty($member_id) && $member_type != '4' ) {  ?>
									<a href="javascript:void(0);" class="btn btn-success"  onclick="return alert('Sorry! Supplier can not buy deal.');">Buy Now</a>	
								<?php } else {
										$prev_url=$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($info['id']));
										$login_url=base64_encode(convert_uuencode('Orders/proceed_checkout/'.$prev_url));
										//print($login_url);die;
								?>
									<a href="<?php echo HTTP_ROOT.'Customers/login?redirect='.$login_url;?>" class="btn btn-success"> Buy Now </a>
                   		<?php } ?> 
								</div>		
							</div>	
						</div>
						<?php } }     ?>	
        </div>
      	</div>		
      </div>
   
    </div>
  </div>
</div>	
<!--   end of mymodal_buy pop up for deal option  -->


<!--   mymodal_buygift pop up for deal option  -->
<div class="modal fade" id="mymodal_buygift" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
   	<div class="modal-content removed_border_radius">
      	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="" >   Choose your Deal   </h4>
      	</div>
      	<div class="modal-body">
      		<div class="row">
				   <?php $member_id=$this->Session->read('Member.id');?>
      			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<?php foreach($find_deal['DealOption'] as $info) { ?>
             		<div class="wrapper_new_modal">
							<div class="main_wrap_modal_inner">
								<div class="left_modal col-md-9 col-sm-9 col-xs-12 col-lg-9 padding_0">
									<div class="col-md-9 col-sm-9 col-lg-9 col-xs-12">
										<a href="javascript:void(0)">	 <?php echo $info['option_title'];?>	 	</a>
										<span class="desc_modal_new">  
											<b> 		
											<?php echo $currency."&nbsp"; ?> 
											<?php echo $info['selling_price'];?>	</b>  list-price:<b> 
											<?php echo $info['discount'];?>% </b> off save <b> 
											<?php echo $currency."&nbsp"; ?> 
											<?php echo $info['selling_price']-$info['discount_selling_price'];?>	
											</b>
										</span>																							
									</div>
									<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">
										<span class="quantity_span">  </span>
										<span class="sub_quantity_text">  </span>
									</div>
								</div>
								<div class="right_modal col-md-3 col-sm-3 col-lg-3 col-xs-12 padding_0 text-center">
									<!--<a href="<?php echo HTTP_ROOT.'Orders/add_giftcart/'.$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($info['id']));?>" class="btn btn-success"> Buy Now </a>-->
                    			<?php if(!empty($member_id) && $member_type == '4') { ?>
										<a href="<?php echo HTTP_ROOT.'Orders/gift_checkout/'.$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($info['id']));?>" class="btn btn-success"> Buy Now </a>
                      		<?php } else if(!empty($member_id) && $member_type != '4') { ?>
										<a href="javascript:void(0);" class="btn btn-success" onclick="return alert('Sorry! Supplier can not buy deal.');" >Buy Now</a>	
                      		<?php } else {
                           	$prev_url=$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($info['id']));
										$login_url=base64_encode(convert_uuencode('Orders/gift_checkout/'.$prev_url));
                           ?>
                           	<a href="<?php echo HTTP_ROOT.'Customers/login?redirect='.$login_url;?>" class="btn btn-success"> Buy Now </a>
                       		<?php } ?>
                      		<?php /*<?Php  else { ?>
    									<a href="javascript:void(0);" data-toggle="modal" data-target=".login_pop">Buy Now</a>
                       			<?php }  ?> */?>
								</div>		
							</div>	
						</div>
						<?php } ?>	
        			</div>
      		</div>		
      	</div>
		</div>
  	</div>
</div>	
<!--   end of mymodal_buygift pop up for deal option  -->
	<!--Middle content -->
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="middle_left margin_bottom_add">
			<h1>
  				<a href="javascript:void(0);">
  					<?php echo $find_deal['Deal']['name'];?>
  				</a>
			</h1>
			<div class="row">
				<div class="col-lg-3 col-sm-4 col-md-3 col-xs-12 m_padding-right">
					<div class="buy_section">
						<form method="post" action="<?php echo HTTP_ROOT.'Orders/cat';?>">
							<div class="buy_img">
            				<input type="hidden" value="<?php echo $find_deal['Deal']['uri'];?>" name="buy" />
								<input id="dealId" type="hidden" value="<?php echo $find_deal['Deal']['id'];?>" name="number" />
								  <?php /*
									  pr($find_deal['DealOption']);
									 $deal_option_count=0;
									                        for($find_deal['DealOption'] as $each_deal)
									 {
									 if($each_deal['title']!='')
									 {
									    $deal_option_count+=1;
									 
									 }
									 }
									
									 ?>
									  if($deal_option_count >1)
									  {
									  ?>
									                    <a href="javascript:void(0);" data-toggle="modal" data-target="#mymodal_buy">Buy Now</a>
									 <?php
									} 
									else if($deal_option_count==1)
									{ ?>
									  	     <a href="<?php echo HTTP_ROOT.'Orders/add_cart/'.$find_deal['Deal']['uri'];?>" data-toggle="modal">Buy Now</a>
									 <?php
									}
									 			else
									         { 
									         ?>
									 												             <a href="javascript:void(0);" data-toggle="modal" data-target=".login_pop">Buy Now</a>
									        <?php
									         }
									       */ ?> 
								
								<?php
$total_deal=$find_deal['Deal']['quantity'];
	$sale_deal=$find_deal['Deal']['sales_deal'];	
	$remaining_deal=$total_deal-$sale_deal;
	//pr($find_deal['DealOption']);die;
if($remaining_deal>0)
{ 
  									if(!empty($find_deal['DealOption'][0]['option_title']) && (!empty($find_deal['DealOption'][1]['option_title']) || !empty($find_deal['DealOption'][2]['option_title'])))
  									{ 
  								?>
                    			<a href="javascript:void(0);" data-toggle="modal" data-target="#mymodal_buy">Buy Now</a>
 								<?php } else  if(!empty($member_id) && $member_type == '4') { ?>
  									<a href="<?php echo HTTP_ROOT.'Orders/proceed_checkout/'.$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($find_deal['MaxDealOption']['id']));;?>" data-toggle="modal">Buy Now</a>
 								<?php } else if(!empty($member_id) && $member_type != '4') { ?>
    								<a href="javascript:void(0);" class="btn btn-success"   onclick="return alert('Sorry! Supplier can not buy deal.');">Buy Now</a>
								<?php } 	else {   
									$prev_url=$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($find_deal['MaxDealOption']['id']));
									$login_url=base64_encode(convert_uuencode('Orders/proceed_checkout/'.$prev_url));
  								?>
									<a href="<?php echo HTTP_ROOT.'Customers/login?redirect='.$login_url;?>" data-toggle="modal">Buy Now</a>
  								<?php
          } 

}
else
{
?>
 <a href="javascript:void(0);"  style="opacity:0.8;">Sold Out</a>
<?php
}
?>								
  							</div> 
						</form>
<!--  Modal Link mymodal_buy-->
						<div class="buy_heading">
							<h1 style="font-size:19px;">Was <?php echo $currency; ?> <?php echo round($find_deal['MaxDealOption']['selling_price']);?></h1>
						</div>
						<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_0">
							<div class="price_left">
								<label>Discount</label>
								<span><?php echo $find_deal['MaxDealOption']['discount'];?>%</span>
							</div>
						</div>-->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
							<div class="price_right">
								<!--<label> You Save </label>-->
								<span style="font-size:19px;font-weight:bold;text-align:center;">Now <?php echo $currency; ?> <?php echo round($find_deal['MaxDealOption']['discount_selling_price']);?> </span>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0" style="margin:2px 0 0 0">
							<div class="price_right">
								<!--<label> You Save </label>-->
								<span style="font-size:19px;font-weight:bold;text-align:center;">You save <?php echo $currency; ?> <?php echo round($find_deal['MaxDealOption']['discount']); ?> </span>
							</div>
						</div>
						<div class="buy_it">
<?php 		
	$remaining_deal=$total_deal-$sale_deal;
if($remaining_deal>0)
{
						 	if(!empty($find_deal['DealOption'][0]['option_title']) && (!empty($find_deal['DealOption'][1]['option_title']) || !empty($find_deal['DealOption'][2]['option_title'])))
							{
						?>
						<!--<a href="javascript:void(0);" data-toggle="modal" data-target="#mymodal_buy">Buy Now</a>-->
						<a href="javascript:void(0);" data-target="#mymodal_buygift" data-toggle="modal">
						<img src="<?php echo HTTP_ROOT;?>img/frontend/gift-box.png"/>Buy for a friend</a>
						<?php } else { if(!empty($member_id) && $member_type == '4') { ?>
							<a href="<?php echo HTTP_ROOT.'Orders/gift_checkout/'.$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($find_deal['MaxDealOption']['id']));;?>" data-toggle="modal"><img src="<?php echo HTTP_ROOT;?>img/frontend/gift-box.png"/>Buy for a friend</a>
						<?php } else if(!empty($member_id) && $member_type != '4') { ?>
							<a href="javascript:void(0);" class="btn btn-success"   onclick="return alert('Sorry! Supplier can not buy deal.');"><img src="<?php echo HTTP_ROOT;?>img/frontend/gift-box.png"/>Buy for a friend</a>
						<?php } 	else { 
							$prev_url=$find_deal['Deal']['uri'].'/'.base64_encode(convert_uuencode($find_deal['MaxDealOption']['id']));
							$login_url=base64_encode(convert_uuencode('Orders/gift_checkout/'.$prev_url));
						?>
							<a href="<?php echo HTTP_ROOT.'Customers/login?redirect='.$login_url;?>" data-toggle="modal"><img src="<?php echo HTTP_ROOT;?>img/frontend/gift-box.png"/>Buy for a friend</a>
						<?php } }

}
else
{
?>
 <a href="javascript:void(0);"><img src="<?php echo HTTP_ROOT;?>img/frontend/gift-box.png"/>Sold Out</a>
<?php
}
?>		
						</div>
						<?php 
						if($this->Session->check('Member.id')){ 
							if($this->Session->read('Member.member_type')==4){ 
								if(!empty($wish)){ ?>
								<div class="wishlist add_fav<?php echo $find_deal['Deal']['id']; ?>" style="display:none;">
									<a class="addWish" rel="<?php echo $find_deal['Deal']['id']; ?>"   href="javascript:void(0);">Add to Wishlist</a>
								</div>
								<div class="wishlist remove_fav<?php echo $find_deal['Deal']['id']; ?>" >
									<a class="removeWish" rel="<?php echo $find_deal['Deal']['id']; ?>"   href="javascript:void(0);">Remove from Wishlist</a>
								</div>
								<?php }else{ ?>
								<div class="wishlist add_fav<?php echo $find_deal['Deal']['id']; ?>">
									<a class="addWish" rel="<?php echo $find_deal['Deal']['id']; ?>"   href="javascript:void(0);">Add to Wishlist</a>
								</div>
								<div class="wishlist remove_fav<?php echo $find_deal['Deal']['id']; ?>" style="display:none;">
									<a class="removeWish" rel="<?php echo $find_deal['Deal']['id']; ?>"   href="javascript:void(0);">Remove from Wishlist</a>
								</div>
						<?php  } } }else{ ?>
							<div class="wishlist">
							<a class=""  href="<?php  echo HTTP_ROOT.'Homes/option/login'; ?>">Add to Wishlist</a>
							</div>
						<?php }?>
					 	<div class="wishlist" >
							<b>
							<?php
								//echo $find_deal['Deal']['id'];
								$total_deal=$find_deal['Deal']['quantity'];
								$sale_deal=$find_deal['Deal']['sales_deal'];
								//$viewQuery=ClassRegistry:init('OrderDealRelation');
						 		//$sale_deal=$viewQuery->find('count',array('fields' =>'OrderDealRelation.qty','conditions'=>array('OrderDealRelation.deal_id'=>$find_deal['Deal']['id']),'recursive'=>-1)); 
								//echo $sale_deal;												
								$remaining_deal=$total_deal-$sale_deal;
								if($remaining_deal>0) {
									echo 'Only '.$remaining_deal." "."available";
								}
								else {
									echo "Sold out!";
								}
							?>
							</b>
						</div>
						<?php if($remaining_deal>0) { ?>
						<div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12 padding_0">
							<div class="time_up">
								<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 padding_0 text-center">
									<img src="<?php echo HTTP_ROOT;?>img/frontend/waiting.png"/>
								</div>
								<div class="col-lg-10 col-sm-10 col-md-10 col-xs-12 padding_0">
									<p> This deal is available for the next:</p>
										<!--	<label> 4 days 12:22:22</label>-->
						 				
								</div>
								<label>
												<div class="block_count">												
													<div id="countdown"></div>
												</div>	
									   </label>
							</div>
						</div>
						
						<?php } ?>
						<div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12 padding_0">
							<div class="time_up">
							<?php
							$multiple_loc='';
							$multi_loc=explode(',',$find_deal['Deal']['location']);
							//pr($multi_loc);
							$viewQuery=ClassRegistry::init('Location'); 
                     $dealLocations=$viewQuery->find('all',array('conditions'=>array('Location.id'=>$multi_loc),'recursive'=>-1));	
                     ?>							
							<?php
							if(count($multi_loc)>1) {
								echo "<p><b>Locations</b></p>";
							}	
							else {
								echo "<p><b>Location</b></p>";
							}
									foreach($dealLocations as $data) { 
							?>
							<p style="padding:4px 1px 1px;"><?php echo $data['Location']['name']; ?></p>
							<?php } ?>
							</div>
						</div>
						<!--<div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12 padding_0">
							<div class="time_down">
								<h1>15 bought!</h1>
								<h2><img src="<?php echo HTTP_ROOT;?>img/frontend/right.png"/>Deal is on!</h2>
							</div>
						</div>-->

						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<div class="share_div">
								<label>Recommend to a friend</label>
								<ul class="list-inline list-unstyled">
									<li><a class="social_made_share f" href="javascript:void(0);" rel="deals/view/<?php echo $find_deal['Deal']['uri'];?>"><img src="<?php echo HTTP_ROOT;?>img/frontend/FB1.png"/></a></li>
									<li><a class="social_made_share t" data-twttext="<?php echo $find_deal['Deal']['name'];?>" href="javascript:void(0);" rel="deals/view/<?php echo $find_deal['Deal']['uri'];?>"><img src="<?php echo HTTP_ROOT;?>img/frontend/TWT.png"/></a></li>
									<li>
									<?php
									if($member_id!='')
									{
									?>
									<a data-target="#email_popup" data-toggle="modal" href="javascript:void(0);"><img src="<?php echo HTTP_ROOT;?>img/frontend/EM.png"/></a>
									<?php
									}
									else 
									{
									?>
									<a href="javascript:void(0);" onclick="alert('Please ensure that you are login with Cyber Coupon.');"><img src="<?php echo HTTP_ROOT;?>img/frontend/EM.png"/></a>
									<?php
									}
									?>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-sm-8 col-md-9 col-xs-12">
					<div class="buy_detail">
						<div class="img_container">
							<div class="flexslider">
							
							<!-------- Flex Slider -------->
								<ul class="slides">
									<?php $mainPic_arr = array();
                                        $secondPic_arr = array();
										for($k = 0; $k < sizeof($find_deal['DealImage']); ++$k) : 
										
										if (!empty($find_deal['DealImage'][$k]['image_type']))	{
										
											if ($find_deal['DealImage'][$k]['image_type'] == 'M')	{
											
												$mainPic_arr[] = $find_deal['DealImage'][$k]['image_name'];//Deal image which are main image
											}
											else {
											
												$secondPic_arr[] = $find_deal['DealImage'][$k]['image_name'];//Deal image which are not main image
											}
										}
										?>
									<?php 
									endfor;
									$finalPic_arr = array_merge($mainPic_arr,$secondPic_arr);
									if(!empty($finalPic_arr)) :
										foreach($finalPic_arr as $image):
										?>
										<li data-thumb="<?php echo IMPATH.'deals/'.$image.'&w=690&h=463';?>">
												<img src="<?php echo IMPATH.'deals/'.$image.'&w=690&h=463';?>" />
										</li>
									<?php endforeach;
									else :?>
										<img src="<?php echo IMPATH.'deals/'.$find_deal['Deal']['image'].'&w=690&h=463';?>" />
									<?php endif;	?>
								</ul>
							</div>
							<!--<img src="<?php echo IMPATH.'deals/'.$find_deal['Deal']['image'].'&w=690&h=463';?>" />-->
						</div>
						<div class="img_container">
							<p style="color:black;font-size:13px; margin-bottom:5px;">
							This image does not necessarily depict the actual product or service on 
							offer and is for promotional purposes only.
							</p>
							<label>Name of supplier:</label>
							<span><?php echo @$find_deal['Member']['MemberMeta']['trading'];?></span>
							<label>Website address:</label>
							<?php if($find_deal['Member']['MemberMeta']['website']!=''):?><a href="<?php echo @$find_deal['Member']['MemberMeta']['website'];?>" target="_blank"><span><?php echo @$find_deal['Member']['MemberMeta']['website'];?></span></a><?php else:?><span><?php echo "This supplier does not have a website address";endif;?></span>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
								<div class="hight_light">
									<div class="hightlight_heading">
										<label>Fine Print</label>
									</div>
									<ul class="list-inline list-unstyled">
										<li>
											<p>This deal is sold on the basis of your acceptance to the fine print terms listed below and the standard customer terms and conditions which can be viewed by <a href="<?php echo HTTP_ROOT; ?>term_conditions" >clicking here</a></p>
											<p><!--<span class="glyphicon glyphicon-chevron-right"></span>-->
												<?php echo nl2br($find_deal['Deal']['highlights']) ; ?> 
											</p>
											
											<p>
												<?php 
												if($find_deal['Deal']['delivery_option'] == 'physical' ) 
												{ 									
													echo "This is a physical product that requires delivery and the discounted
												selling price includes nationwide door-to-door delivery by courier.";
												}
												elseif($find_deal['Deal']['delivery_option'] == 'physical-not-delivery')
												{
													echo "This is a physical product that requires delivery and the discounted selling price does NOT include nationwide door-to-door delivery by courier.";
												}
												else
												{
													echo "This is not a physical product and does not require delivery, and the
												customer will use the service via receiving a voucher only.";
												}
												?>
											</p>
											<p>
												<?php
												if($find_deal['Deal']['modePayment'] == 'EFT' ) 
												{ 									
													echo "Only EFT payments are accepted for this deal; no credit card payments are accepted.";
												}											
												?>
											</p>
											
										</li>
									</ul>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
								<div class="fine_point">
									<div class="hightlight_heading">
										<label>Description</label>
									</div>
									<ul class="list-inline list-unstyled">
										<li>
											<p>
											<?php echo $find_deal['Deal']['description'];?>
											</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <!-- <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		<div class="middle_right margin_tp">
			<div class="middle_one_block">
				<div class="deal_heading">
					<h1>More Deals</h1>
				</div>
    			<?php
			 	foreach($deal_info as $info)
				{ //pr($info);die;
				?>
				<a href="<?php echo HTTP_ROOT.'deals/view/'.$info['Deal']['uri'];?>">
					<label>
						<?php echo $currency."&nbsp"; ?> 
						<?php echo $info['DealOption']['discount_selling_price'];?>
					 	instead of 
					 	<?php echo $currency."&nbsp"; ?> 
					 	<?php echo $info['DealOption']['selling_price']; ?>
					</label>
					<p>
					<?php 
						if(strlen($info['Deal']['description']) >68) {
	 						echo substr($info['Deal']['description'],0,68).'...';
	 					}
	 					else {
							echo $info['Deal']['description'];
	 					}
 					?>
					</p>
				</a>
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
						<div class="deal_img">
							<img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=150&h=130';?>"/>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_left_0">
						<div class="deal_price">
							<h1><?php echo $currency."&nbsp"; ?> <?php echo $info['DealOption']['discount_selling_price'];?></h1>
							<label>Instead of <?php echo $currency."&nbsp"; ?> <?php echo $info['Deal']['selling_price']; ?></label>
						</div>
						
					</div>
					<div class="col-lg-12 col-lg-12 col-lg-12 col-lg-6 ">
						<a href="<?php echo HTTP_ROOT.'deals/view/'.$info['Deal']['uri'];?>" class="view_link" ><span class="glyphicon glyphicon-hand-right"></span>View</a>
					</div>
				</div>
				<?php } ?>
			</div>
			<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right">
			<a href="<?php echo HTTP_ROOT.'Homes/alldeal';?>" class="view_link" ><span class="glyphicon glyphicon-hand-right"></span>View all Deals</a>
			</div>-->
			<!--</div>
			</div>
			</div>-->
		
		<!--</div>-->
	</div>
<!--  Login Popup -->
	<div class="modal fade" id="email_popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				  <h4 class="modal-title" id="myLargeModalLabel-1">Message</h4>
				</div>
				<form id="share_mail" method="POST" action="<?php echo HTTP_ROOT.'Deals/share_mail';?>" >
					<div class="modal-body">
						<div class="login_modal">
							<div class="form-group">
								<label>To:</label>
								<input name="data[Recommend][to]" type="text" class="form-control required email"/>
															</div>
						</div>
						<div class="login_modal">
							<label>Message:</label>
							<textarea name="data[Recommend][message]" class="form-control required text_area"></textarea>
						</div>
						<div class="login_forget_pas text-right">
							<!--<a href="javascript:void(0);">Forget your password?</a>-->
						</div>
						<div class="login_forget_pas">
							<input type="Submit" value="Send" class="btn btn-success">
							
						</div>
						
					</div>
				</form>
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal mixer image -->
<script>
	$(document).ready(function() {
		$('#share_mail').validate();
		$('#submitLogin').click(function(){
      	var email=$('#email').val();
         var pwd=$('#password').val();
         $.ajax({
				url:ajax_url+'Auths/Customer_login',
				method:'POST',
            data:$('#login_customer').serialize(),
				success:function(resp) {
            	if(resp=="success") {                            
               	window.location.href = ajax_url+'Orders/cart';
					}
               else { 
						alert('Username & Password Does not match !');
               }
				}			
			});  
		});
		$("#submitLogin").on("click",function(){
    		$('#login_customer').validate({
	       	rules: {
	           "data[Member][log_email]": {
	               required:true,
	  					email:true,
	  		       	remote:ajax_url+'customers/checkMemberEmailLog'
	             },
	            "data[Member][log_password]": {
	             	required:true,
	  				  	remote:ajax_url+'customers/checkMemberPasswordLog'
	             },
				},
	         messages: {
		         "data[Member][log_email]":  {
		         	required:'Please enter email.',
		  				   email:'Please enter valid email.',
		  					remote:'Email address does not exists.'
		         },
		        "data[Member][log_password]": {
		            required:'Please enter password.',
		  					remote:'Incorrect password! Enter a valid password.'
		         }, 
				}		
     		});
		});
		$(document).on('click','.addWish',function(){
			//var deal_id = $('#dealId').val();
			$(this).addClass('ajax_loader');
			var t = $(this);
			var deal_id = $(this).attr('rel');
			$.ajax({
				type: 'POST',
				url: ajax_url+'Customers/add_to_wishlist/'+deal_id,
				success: function(msg) {
					if(msg=="success") {
						t.removeClass('ajax_loader');
						$('.add_fav'+deal_id).hide();
						$('.remove_fav'+deal_id).show();
					}
				}
			});
			return false;
		});
		//
		$(document).on('click','.removeWish',function(){
			//var deal_id = $('#dealId').val();
			$(this).addClass('ajax_loader');
			var t = $(this);
			var deal_id = $(this).attr('rel');
			$.ajax({
				type: 'POST',
				url: ajax_url+'Customers/del_wishlist/'+deal_id,
				success: function(msg) {
					if(msg=="success") {
						t.removeClass('ajax_loader');
						$('.add_fav'+deal_id).show();
						$('.remove_fav'+deal_id).hide();
					}				
				}
			});
			return false;
		});
		//..................for sharing...
		$(document).on("click",".social_made_share",function(){
			var url = $(this).attr("rel");
			var uri = '';
			var input = '';
			uri = ajax_url+url;
			if($(this).hasClass('t'))
        	{ 
         	var input = $(this).data('twttext');
			   var link="https://twitter.com/share?url="+uri+"&text="+input;
        	}   		
			if($(this).hasClass('f'))
        	{
   			var link = "https://www.facebook.com/sharer/sharer.php?app_id=706963819389944&sdk=joey&u="+uri;
        	}
        	window.open(link, "Social Share", "height=400,width=550,resizable=1");
	  	})	;
	});
</script>		

<script>
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: "thumbnails",
			slideshow: false
		});
	});
</script>