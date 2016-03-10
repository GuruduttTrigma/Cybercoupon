<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>View Deal Details</h2>
               <a href="<?php echo HTTP_ROOT;?>admin/manages/deals" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
       <span></span>
             </div>
	<div class="response-msg success ui-corner-all send_success" style="display: none;">
					<span>Success message</span>
					OTP has been send successfully.
  </div>		
		<?php //if($member['MemberType']['name']=='customer') {?>
			<div class="content-box content-box-header" style="border:none;">
                 <div class="column-content-box">
                      <div class="ui-state-default ui-corner-top ui-box-header">
                         <span class="ui-icon float-left ui-icon-notice"></span>
                         	Customer's Information
                      </div>
				  <div style="clear:both"></div>    
                      <div class="hastable">
			<table id="sort-table"> 
				<tbody>						
				        <tr>         
                           <td><label>Deal Title:</label></td>
                           <td><span><?php echo $member['Deal']['name'];?></span></td>
                        </tr>
                        <tr>         
                           <td><label>Company Name:</label></td>
                           <td><span><?php echo @$member['Member']['MemberMeta']['company_name'];?></span></td>
                        </tr>
                   		<tr>
                           <td><label>Customer Buying Date Range:</label></td>
                           <td><span><?php echo date('d M Y',strtotime($member['Deal']['buy_from']))." To ".date('d M Y',strtotime($member['Deal']['buy_to']));?></span></td>
                        </tr>
                         <tr>
                           <td><label>Customer Redeeming Deadline:</label></td>
                           <td><span><?php echo date('d M Y',strtotime($member['Deal']['redeem_from']))." To ".date('d M Y',strtotime($member['Deal']['redeem_to']))	;?></span></td>
                        </tr>
                        <tr>
                           <td><label>Deal's Category:</label></td>
                           <td><span><?php echo $member['DealCategory']['name'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Price includes shipping:</label></td>
                           <td><span><?php echo $member['Deal']['shipping_price'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>Delivery Option:</label></td>
                           <td><span><?php echo $member['Deal']['delivery_option'];?></span></td>
                        </tr>
						      	
                        <tr>
                           <td><label>Deal Location:</label></td>
                           <td><span>
                           							<?php
										/*$multiple_loc='';
							$multi_loc=explode(',',$member['Deal']['location']);
							//pr($multi_loc);
							$viewQuery=ClassRegistry::init('Location'); 
                     $dealLocations=$viewQuery->find('all',array('conditions'=>array('Location.id'=>$multi_loc),'recursive'=>-1));	
                     ?>							
							<?php
								foreach($dealLocations as $data) { 
							?>
							<?php echo $data['Location']['name'].","; ?>
							<?php } ?>
                           <?php
									$multiple_loc='';
									$multi_loc=explode(',',$member['Deal']['location']);
									//pr($multi_loc);die;
									if(count($multi_loc)>1) {
									  $multiple_loc='Multiple Location';
									}
									if(@$multiple_loc!='') {
										echo $multiple_loc;
										
									}
									else	{
										echo $member['Location']['name'];
									}*/				
									echo $member['Location']['name'];				
									?></span></td>
                        </tr>
                        <tr>
                           <td><label>Voucher Quantity:</label></td>
                           <td><span><?php echo $member['Deal']['quantity'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>Regular Selling Price:</label></td>
                           <td><span><?php echo $member['DealOption'][0]['selling_price'];?></span></td>
                        </tr>
                          <tr>
                           <td><label>%Discount:</label></td>
                           <td><span><?php echo $member['DealOption'][0]['discount'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Discounted Selling Price:</label></td>
                           <td><span><?php echo $member['DealOption'][0]['discount_selling_price'];?></span></td>
                        </tr>
                       <tr>
                           <td><label>Description</label></td>
                           <td><span><?php echo $member['Deal']['description'];?></span></td>
                        </tr>
                          <tr>
                           <td><label>Highlight</label></td>
                           <td><span><?php echo $member['Deal']['highlights'];?></span></td>
                        </tr>
                         <tr>
                           <td><label>Discount Option Title 2:</label></td>
                           <td><span>
												<?php
                                          if(!empty($member['DealOption'][1]['option_title'])) 
                                          {
                                              echo $member['DealOption'][1]['option_title'];
                                          }
                                          else
                                          {
                                              echo "N.A.";
                                          }
                                      ?></span></td>
                         </tr>
						 <tr>
                           <td><label>Discount Option Selling Price 2:</label></td>
                           <td><span><?php
                                          if(!empty($member['DealOption'][1]['selling_price'])) 
                                          {
                                              echo $member['DealOption'][1]['selling_price'];
                                          }
                                          else
                                          {
                                              echo "N.A.";
                                          }
                                      ?>
                              </span>
                          </td>
                         </tr>
                          <tr>
                           <td><label>%Discount Option 2:</label></td>
                           <td><span><?php
                                          if(!empty($member['DealOption'][1]['discount'])) 
                                          {
                                              echo $member['DealOption'][1]['discount'];
                                          }
                                          else
                                          {
                                              echo "N.A.";
                                          }
                                      ?>
                              </span>
                          </td>
                         </tr>
							<tr>
                           <td><label>Discounted Selling Price 2:</label></td>
                           <td><span><?php
                                          if(!empty($member['DealOption'][1]['discount_selling_price']))  
                                          {                                      
                                              echo $member['DealOption'][1]['discount_selling_price'];
                                          }
                                          else
                                          {
                                              echo "N.A.";
                                          }
                                     ?>
                              </span>
                          </td>
                         </tr>
                          <tr>
                           <td><label>Discount Option Title 3:</label></td>
                           <td><span>
                                  <?php
                                          if(!empty($member['DealOption'][2]['option_title']))  
                                          {                                      
                                              echo $member['DealOption'][2]['option_title'];
                                          }
                                          else
                                          {
                                              echo "N.A.";
                                          }
                                     ?>
                              </span>
                          </td>
                         </tr>
						  <tr>
                           <td><label>Discount Option Selling Price 3:</label></td>
                           <td><span>
                                  <?php
                                          if(!empty($member['DealOption'][2]['selling_price']))  
                                          {                                      
                                              echo $member['DealOption'][2]['selling_price'];
                                          }
                                          else
                                          {
                                              echo "N.A.";
                                          }
                                     ?>
                              </span>
                          </td>
                         </tr>
                          <tr>
                           <td><label>%Discount Option 3:</label></td>
                           <td><span>
                                    <?php
                                          if(!empty($member['DealOption'][2]['discount']))  
                                          {                                      
                                              echo $member['DealOption'][2]['discount'];
                                          }
                                          else
                                          {
                                              echo "N.A.";
                                          }
                                     ?>
                              </span>
                          </td>
                         </tr>
						                     <tr>
                           <td><label>Discounted Selling Price 3:</label></td>
                           <td><span>
                                  <?php
                                          if(!empty($member['DealOption'][2]['discount_selling_price']))
                                          {
                                              echo $member['DealOption'][2]['discount_selling_price'];
                                          }
                                          else
                                          {
                                              echo "N.A.";
                                          }
                                     ?>                              
                              </span></td>
                         </tr>
						<tr>
                           <td><label>NewsLetter Sent Date</label></td>
                           <td><span><?php echo date('d M Y',strtotime($member['Deal']['newsletter_sent_date']));?></span></td>
                        </tr>
						<tr>
                           <td><label>Allow Credit Card Sales</label></td>
							<td>
								<span>
								<?php 
								if($member['Deal']['modePayment'] == 'All')
								{
									echo "Yes";
								}
								else
								{
									echo "No";
								}
								?>
								</span>
							</td>
                        </tr>
                </tbody>

			</table>
			<div class="clear"></div>
		</div>
         <div class="clearfix"></div>
         <div class="clear"></div>
      </div>
       <div class="clear"></div>
	</div>
    <?php //}?>
 </div>
	</div>
    <div class="clear"></div>
</div>
<script type="text/javascript" >
$(document).ready(function(){
	$('.send_otp').live('click',function(){
     $.ajax({
     type: 'post',
     url: ajax_url+'Members/send_otp',
     data:{email : '<?php echo $member['Member']['email'];?>',id: '<?php echo $member['Member']['id'];?>'},
     success: function(msz){
         if(msz == 'done')
          {
           $('.send_otp').remove();
           $('.change_st').text('');
           $('.change_st').text('Active');
           $('.send_success').css('display','block');
           }
           
        }
     })
     setTimeout(function(){
      $('.send_success').css('display','none');
     },7000);
  })
})
</script>