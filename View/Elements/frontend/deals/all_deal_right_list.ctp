<style>
.prdct_txt{
	/*margin: 0 15px 0 0;*/	
	}
.browse_deal_rgt
{
	min-height: 41px;
}
</style>	
	<div class="right_listing">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
                       <?php if(!empty($deal)) { ?>
										<div class="prdouct_listing">
										<?php foreach($deal as $info) { ?>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 ">

												<div class="product_block">

													<div class="block_img img-height">
													<?php
														$total_deal=$info['Deal']['quantity'];
														$sale_deal=$info['Deal']['sales_deal'];	
														$remaining_deal=$total_deal-$sale_deal;
														if($remaining_deal>0)
														{ ?>
														<a href="<?php echo HTTP_ROOT.'deals/view/'.$info['Deal']['uri']; ?>">
															<img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=701&h=425';?>"/>
														</a>	
														<?php } else { ?>	
														<a href="<?php echo HTTP_ROOT.'deals/view/'.$info['Deal']['uri']; ?>">
															<img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=701&h=425';?>"/>
															<img src="<?php echo HTTP_ROOT.'img/frontend/SOLD2.png';?>" class="active_sold"/>
														</a>	
														<?php } ?>												
													</div>

													<div class="block_img_heading">
          
														<p class="browse_deal_rgt">
              <?php 
                if(strlen($info['Deal']['name']) >= 70)
                {
                   echo substr($info['Deal']['name'],0,70).'...' ;
                } 
                else
                {
                    echo $info['Deal']['name'];
                }



              ?>   
          </p>               
														<?php
														$multiple_loc='';
														$multi_loc=explode(',',$info['Deal']['location']);
														//pr($multi_loc);die;
														if(count($multi_loc)>1)
														{
														  $multiple_loc='Multiple Location';
														}
														if(@$multiple_loc!='')
														{
														?>
														    <label><?php echo $multiple_loc; ?></label>
														<?php
                                          }
														else
														{
														?>
														    <label>
														    <?php //echo $info['Location']['name']; ?>
															<?php														    
														    if(strlen($info['Location']['name']) >= 20)
                										{
                   											echo substr($info['Location']['name'],0,20).'...' ;
                										} 
										                else
										                {
										                    echo $info['Location']['name'];
										                }
										                ?>
														    </label>
														<?php
														}
														?>
														

														<div class="product_price">
															
															<!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 prdct_wishlist padding_0">
																<input type="button" value="Add To Wishlist" />
															</div>-->
															<?php if($this->Session->check('Member.id')){ 
										if($this->Session->read('Member.member_type')==4){ 
						?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prdct_wishlist padding_0  text-center add_fav<?php echo $info['Deal']['id']; ?>">
								<a class="addWish" id="before<?php echo $info['Deal']['id']; ?>" rel="<?php echo $info['Deal']['id']; ?>"   href="javascript:void(0);">Add to Wishlist</a>
								
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prdct_wishlist padding_0 text-center remove_fav<?php echo $info['Deal']['id']; ?>" style="display:none;">
								<a class="removeWish" rel="<?php echo $info['Deal']['id']; ?>"   href="javascript:void(0);">Remove from Wishlist</a>
							</div>
						<?php } 
							}else{ ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prdct_wishlist padding_0 text-center">
								<a class=""  href="<?php  echo HTTP_ROOT.'Homes/option/login'; ?>">Add to Wishlist</a>
							</div>
						<?php } ?>	
															<div style="display:inline-block;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prdct_txt">

																<label ><del><?php echo $currency; ?><?php echo $info['Deal']['max_selling_price']; ?></del></label>
<h2><?php echo $currency; ?><?php echo $info['Deal']['max_discount_selling_price']; ?></h2>
															</div>

														</div>

													</div>

												</div>

											</div>
                    <?php } } else {?>
                         <div>
                             <h1>No Records found !</h1>
                         </div>
                         <?php } ?>

											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">

												<ul class="pagination">
                       <?php  if($this->params['paging']['Deal']['pageCount']>1) { ?> 		   
										                    <li><?php echo $this->Paginator->prev('Prev');?></li>
											                  <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
				 									               <li><?php  echo $this->Paginator->next('Next');?></li>
												       <?php } ?>
												</ul>
                              
											</div>

										</div>

             </div>

			</div>
<script>

					$(document).ready(function(){
					<?php 
						 foreach($deal as $info)
                              {
					if(in_array(@$info['Deal']['id'],$fav_id)){ ?>
						var  fav_id= $('#before'+<?php echo $info['Deal']['id']; ?>).attr('rel');
							$('.add_fav'+fav_id).hide();
							$('.remove_fav'+fav_id).show();
						<?php } } ?>
					});
				
</script>		