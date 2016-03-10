<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>View Details</h2>
            <a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
       		<span></span>
        </div>
			<!--<div class="response-msg success ui-corner-all send_success" style="display: none;">
				<span>Success message</span>
					OTP has been send successfully.
  			</div>	-->	
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
                     	<td><label>Deal Name:</label></td>
                        <td><span><?php echo @$orderdealrelation['Deal']['name'];?></span></td>
                     </tr>
                   	<tr>
                     	<td><label>Deal Range:</label></td>
                        <td>
									<span><?php echo date('d M Y',strtotime(@$orderdealrelation['Deal']['buy_from'])); ?><span>
									<span class="to_div">-To-</span>
									<span><?php echo date('d M Y',strtotime(@$orderdealrelation['Deal']['buy_to'])); ?><span>                           
                        </td>
                    	</tr>
                     <tr>
                     	<td><label>Customer Name:</label></td>
                        <td><span><?php echo $orderdealrelation['Deal']['Member']['name'].' '.@$orderdealrelation['Deal']['Member']['surname']; ?> </span></td>
                     </tr>
                     <tr>
                        <td><label>Transaction Date:</label></td>
                        <td><span><?php echo date('d M Y',strtotime(@$orderdealrelation['Order']['payment_date'])); ?></span></td>
                     </tr>	
                     <tr>
                        <td><label>Voucher Quantity:</label></td>
                        <td><span><?php echo @$orderdealrelation['OrderDealRelation']['qty']; ?></span></td>
                     </tr>
					 <tr>
                        <td><label>Payment Type :</label></td>
                        <td><span><?php echo @$orderdealrelation['Order']['payment_type']; ?></span></td>
                     </tr>
                     <tr>
					 <tr>
                        <td><label>Transaction Id :</label></td>
                        <td><span><?php echo @$orderdealrelation['Order']['transaction_id']; ?></span></td>
                     </tr>
                     <tr>
                     	<td><label>Amount / Item:</label></td>
                        <td><span><?php echo @$orderdealrelation['OrderDealRelation']['discount_selling_price']; ?></span></td>
                     </tr>
                    	<tr>
                     	<td><label>Total Amount:</label></td>
                     	<td><span><?php echo @$orderdealrelation['OrderDealRelation']['sub_total']; ?></span></td>
                  	</tr>
			  		<!--<tr>
							<td><label>Business Address:</label></td>
							<td>
								<span>						
									<B>
										Deal First Name:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											@$orderdealrelation['OrderDealRelation']['billing_first_name']."<br>";?><br>
										Last Name:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											@$orderdealrelation['OrderDealRelation']['billing_last_name']."<br>";?><br>
										Address:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											@$orderdealrelation['OrderDealRelation']['billingaddress_firstline']."&nbsp;".
											",".@$orderdealrelation['OrderDealRelation']['billingaddress_secondline'].
											"<br>";?><br>
										City:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;".@$orderdealrelation['OrderDealRelation']['billingaddress_city']."<br>";?><br>
										Postal Code:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											@$orderdealrelation['OrderDealRelation']['billingaddress_zip']."<br>";?><br>
										
									</B>
	                           </span>
                        </tr>-->
                          <tr>
                           <td><label>Delivery Address: </label></td>
                           <td>
                           <span>
                           <B>
										Deal First Name:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											@$orderdealrelation['OrderDealRelation']['shipping_first_name']."<br>";?><br>
										Last Name:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											@$orderdealrelation['OrderDealRelation']['shipping_last_name']."<br>";?><br>
										Address:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											@$orderdealrelation['OrderDealRelation']['shippingaddress_firstline']."&nbsp;".
											",".@$orderdealrelation['OrderDealRelation']['shippingaddress_secondline'].
											"<br>";?><br>
										City:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;".@$orderdealrelation['OrderDealRelation']['shippingaddress_city']."<br>";?><br>
										Postal Code:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
											@$orderdealrelation['OrderDealRelation']['shippingaddress_zip']."<br>";?><br>
										Contact no:<?php echo "&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
													"&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;"."&nbsp;".
													"&nbsp;"."&nbsp;".
													(@$orderdealrelation['Order']['Member']['phone']!='')?$orderdealrelation['Order']['Member']['phone']:'N/A'."<br>";?><br>
									</B>
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
