
					 							<div class="col-md-12 col-xs-12 col-sm-12 padding_0">
														 <div class="col-md-12 col-sm-12 col-xs-12 padding_0">
                              <?php
                              foreach($deal_info as $info)
                              {
                              ?>
														 					<div class="wrap_list_inner">
                                  <div class="row">
																											<div class="col-md-4 col-sm-5 col-xs-12 col-lg-4">
																																																															
																															<div class="inner_img_contain">
																																	<div class="outer_img_contain">
																																				<img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=250&h=200';?>" class="img-responsive"/>
																																	</div>
																															</div>
																															<div class="price_container">
																																			<p class="col-md-6 col-sm-6-col-xs-6 col-sm-6 border_right_new"> 
																																						<span>  Discount  </span>
																																						<span>  <?php echo $info['DealOption'][0]['discount'];?>%  </span>
																																			</p>		
																																			<p class="col-md-6 col-sm-6-col-xs-6 col-sm-6"> 
																																					<span>  Price  </span>
																																					<span> <?php echo $currency; ?> <?php echo $info['Deal']['selling_price'];?>  </span>
																																			</p>
																																			<!--<div class="cntr_wishlist">
																																				<input type="button" id="ll" rel="ss" value="Add To Wishlist" />
																																			</div>-->
																																				<?php if($this->Session->check('Member.id')){ 
										if($this->Session->read('Member.member_type')==4){ 
						?>
							<div class="cntr_wishlist  add_fav<?php echo $info['Deal']['id']; ?>">
								<a class="addWish" id="before<?php echo $info['Deal']['id']; ?>" rel="<?php echo $info['Deal']['id']; ?>"   href="javascript:void(0);">Add to Wishlist</a>
								
							</div>
							<div class="cntr_wishlist remove_fav<?php echo $info['Deal']['id']; ?>" style="display:none;">
								<a class="removeWish" rel="<?php echo $info['Deal']['id']; ?>"   href="javascript:void(0);">Remove from Wishlist</a>
							</div>
						<?php } 
							}else{ ?>
							<div class="cntr_wishlist">
								<a class=""  href="<?php  echo HTTP_ROOT.'Homes/option/login'; ?>">Add to Wishlist</a>
							</div>
						<?php } ?>																																
																															</div>																																			
																																		
																											</div>
																											<div class="col-md-8 col-sm-7 col-xs-12 col-lg-8">
																																 
																																 <div class="wrap_span_list">
																																		<span><?php echo $info['Deal']['name'];?> </span>																			
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
																																	<div class="wrap_div_btn text-right" >
																																				<a href="<?php echo HTTP_ROOT.'deals/view/'.$info['Deal']['uri'] ;?>" class="btn-success btn"> View More </a>
																																	</div>																														
																											</div>
																							</div>
                             </div>
                               <?php
                                    }
                                  ?>	
														 		<!--  fifth Div -->
																					<!-- Pagination -->
																			<div class="pagination_div text-center">				
																						<ul class="pagination search_paging">
                                <?php if($this->params['paging']['Deal']['pageCount']>1) { ?> 		   
                                  <li><?php echo $this->Paginator->prev('Prev');?></li>
                                  <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
                                 	<li><?php  echo $this->Paginator->next('Next');?></li>
                                <?php } ?>
                               </ul>			
				  													</div>																							
															</div>
					 							</div>
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