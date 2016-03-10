<div class="card_inner1">
         <?php
          if(empty($cart_member))
          {
         ?>
           	<!----- Card Empty Structure -------->
							<div class="top_arr1"></div>
            <p>Your Shopping Cart is Empty!
             Time to fill your cart pucrchase new letest offering products from
            <a href="<?Php echo HTTP_ROOT.'Homes/index'; ?>">Cyber Coupon</a>
            </p>
           <!----- Card Empty End -------->
      <?php } 
        else { ?>
							<div class="card_full">
								<table class="table">
									<thead>
										<tr>
										  <th colspan="2">Your Cart <span>(<?php echo count($cart_member);?> items)</span></th>
										  <th>Qty</th>
										  <th>Price</th>
										</tr>
									</thead>
									<tbody>
                      <?php foreach($cart_member as $cart)
                     { 
                             if($cart['Deal']['active']=='Yes')
                            {
                    
                    				        $option_arr=$cart['Deal']['DealOption'];
                    				        foreach($option_arr as $each_option)
                    				        {
                                    //pr($each_option);
                    				           if($cart['Cart']['deal_option_id']==$each_option['id'])
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
										<tr>
										  <td><img class="img-responsive" src="<?php echo IMPATH.'deals/'.$cart['Deal']['image'].'&w=50&h=30';?>" /></td>
										  <td><?php echo $selected_option['option_title'] ;?></td>
										  <td><?php echo $cart['Cart']['qty'] ;?></td>
										  <td><?php echo $cart['Cart']['discount_selling_price'] ;?></td>
										</tr>
                <?php 
                        } 

                       }
                    }
                  ?>
									</tbody>
								</table>
								<a href="<?php echo HTTP_ROOT.'Orders/cart';?>" class="btn btn-primary pull-right">VIEW CART</a>
							</div>
              <?php }?>
						</div>