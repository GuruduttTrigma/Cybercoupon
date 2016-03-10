  <?php // echo $this->Html->script('jquery.min.js');


//.... hello developer..............

?>
<?php
//echo $min_price." ".$max_price;die;

     if(!empty($deal_info)) 
     {
         foreach($deal_info as $info)
							 { 
							  if(!empty($info['DealOption']))
							   {

           $each_deal_options=$info['DealOption'];
		   $multi_sellingprice = array();
           foreach($each_deal_options as $each_deal)
           {
              $multi_discount[]=$each_deal['discount'];
			  $multi_sellingprice[]=$each_deal['selling_price'];
              $max_discount=max($multi_discount);
			  $max_selling_price = max($multi_sellingprice);
				
           }
		   

?>

												 <div class="wrap_list_inner">
<div class="row">
									<div class="col-md-4 col-sm-5 col-xs-12 col-lg-4 mid_img">
																																														
														<div class="inner_img_contain">
																			<div class="outer_img_contain">
																			<?php
														$total_deal=$info['Deal']['quantity'];
														$sale_deal=$info['Deal']['sales_deal'];	
														$remaining_deal=$total_deal-$sale_deal;
														if($remaining_deal>0)
														{ ?>
														<img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=250&h=200';?>" class="img-responsive"/>
														<?php } else { ?>
														<img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=250&h=200';?>" class="img-responsive"/>																						
														<img src="<?php echo HTTP_ROOT.'img/frontend/SOLD2.png';?>" class="active_sold"/>
														<?php } ?> 														
														</div>
														</div>
														<div class="price_container">
																		<p class="col-md-6 col-sm-6-col-xs-6 col-sm-6 border_right_new"> 
																					<span>  Discount  </span>
																					<span> <?php echo $currency."&nbsp"; ?><?php echo round($info['Deal']['max_discount']); ;?> </span>
																		</p>		
																		<p class="col-md-6 col-sm-6-col-xs-6 col-sm-6"> 
																					<span>  Price  </span>
																					<span>  <?php echo $currency."&nbsp"; ?><?php echo round($info['Deal']['max_discount_selling_price']); ?>  </span>
																		</p>		
																																																			
														</div>
														<!--<div class="add_wishlist">
															<input type="button" value="Add to wishlist" />
														</div>-->
															<?php if($this->Session->check('Member.id')){ 
										if($this->Session->read('Member.member_type')==4){ 
						?>
							<div class="add_wishlist  add_fav<?php echo $info['Deal']['id']; ?>">
								<a class="addWish" id="before<?php echo $info['Deal']['id']; ?>" rel="<?php echo $info['Deal']['id']; ?>"   href="javascript:void(0);">Add to Wishlist</a>
								
							</div>
							<div class="add_wishlist remove_fav<?php echo $info['Deal']['id']; ?>" style="display:none;">
								<a class="removeWish" rel="<?php echo $info['Deal']['id']; ?>"   href="javascript:void(0);">Remove from Wishlist</a>
							</div>
						<?php } 
							}else{ ?>
							<div class="add_wishlist">
								<a class=""  href="<?php  echo HTTP_ROOT.'Homes/option/login'; ?>">Add to Wishlist</a>
							</div>
						<?php } ?>
														
																	
									</div>
										<div class="col-md-8 col-sm-7 col-xs-12 col-lg-8">
															 
															 <div class="wrap_span_list">
																	<span><?php echo $info['Deal']['name']; ?> </span>																
    																<p>
    																		<?php 
																															if(strlen($info['Deal']['description'])>490)
																															{
																																	echo substr($info['Deal']['description'],0,490).'...';
																															}
																															else
																															{
																																	echo $info['Deal']['description'];
																															}
																														?>																																										
    										         </p>			
																</div> 	
																<div class="wrap_div_btn text-right">
																			<a href="<?php echo HTTP_ROOT.'deals/view/'.$info['Deal']['uri'] ;?>" class="btn-success btn"> View More </a>
																</div>																														
								</div>
				</div>
					</div>	
										
     <?php
             }
           } 
	       }
	       else
	         {
          ?>	
           
           <div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
											<h2 class="text-center">No records found !!!!!!!!!!</h2>
											<div class="col-md-12  padding_0 form_div_margin_top">
												
									  </div>
									</div>
									        
     <?php } ?>

     <!--------------------------for pagination-------------------------------------------------------------->
   <?php 
     if(!empty($deal_info)) 
     {   
        //$pagParam = $this->Paginator->params();
       // $this->Paginator->options(array('url' => array('controller'=>'Homes','action'=>'search_pagination','admin'=>false)));
  ?>
  <div class="pagination_div text-center">	
    			<ul class="pagination search_paging">
            <?php if($this->params['paging']['Deal']['pageCount']>1) { ?> 		   
              <li><?php echo $this->Paginator->prev('Prev');?></li>
              <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
             	<li><?php  echo $this->Paginator->next('Next');?></li>
            <?php } ?>
         </ul>					
		</div>					
<?php } ?>
<script>

					$(document).ready(function(){
					<?php 
						 foreach($deal_info as $info)
                              {
					if(in_array(@$info['Deal']['id'],$fav_id)){ ?>
						var  fav_id= $('#before'+<?php echo $info['Deal']['id']; ?>).attr('rel');
							$('.add_fav'+fav_id).hide();
							$('.remove_fav'+fav_id).show();
						<?php } } ?>
					});
				
</script>


