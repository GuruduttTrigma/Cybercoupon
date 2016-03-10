<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>
				     <?php
										if($member['MemberType']['id']=='2')
										{
										echo 'View '.ucfirst($member['MemberType']['name']).' User Details';
										}
										else
										{
										 echo 'View '.ucfirst($member['MemberType']['name']).' Details';
										}
								?>
				</h2>
               <a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
       <span></span>
             </div>
	<div class="response-msg success ui-corner-all send_success" style="display: none;">
					<span>Success message</span>
					OTP has been send successfully.
  </div>		
		<?php if($member['MemberType']['name']=='customer') {?>
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
				           <!--<tr>
                           <td><label>Title</label></td>
                           <td><span><?php echo @$member['Member']['title'];?></span></td>
                        </tr>-->
				        <tr>
                           <td><label>Name</label></td>
                           <td><span><?php echo $member['Member']['name'];?></span></td>
                        </tr>
                   <tr>
                           <td><label>Last Name</label></td>
                           <td><span><?php echo $member['Member']['surname'];?></span></td>
                        </tr>
                         <tr>
                           <td><label>Member Type</label></td>
                           <td><span><?php echo $member['MemberType']['name'];?></span></td>
                        </tr>
                        <!--<tr>
                           <td><label>Id Number</label></td>
                           <td><span><?php echo (trim($member['Member']['id_number'])!='')?$member['Member']['id_number']:'-';?></span></td>
                        </tr>
						<tr>
                           <td><label>DOB</label></td>
                           <td><span><?php echo date("d-m-Y",strtotime($member['Member']['dob']));?></span></td>
                        </tr>-->
					<!--	<tr>
                           <td><label>Company Name</label></td>
                           <td><span><?php echo $member['Member']['company'];?></span></td>
                        </tr> -->
						      	
                        <tr>
                           <td><label> Email Address</label></td>
                           <td><span><?php echo $member['Member']['email'];?></span></td>
                        </tr>
					    <tr>
                           <td><label> Password</label></td>
							<td>
							<span>
							<?php 
							if($member['Member']['password_copy'] != '') :
								echo $member['Member']['password_copy']; 
							else :
								echo "N/A";
							endif;
							?>
							</span>
							</td>
                        </tr>
						      <tr>
                           <td><label>Address</label></td>
                           <td><span><?php echo (trim($member['Member']['address'])!='')?$member['Member']['address']:'-';?></span></td>
                        </tr>
						      <!--<tr>
                           <td><label>City</label></td>
                           <td><span><?php echo $member['Member']['city'];?></span></td>
                        </tr>-->
                        <tr>
                           <td><label>Location</label></td>
                           <td><span><?php echo $member['Location']['name'];?></span></td>
                        </tr>
                        <!--<tr>
                           <td><label>Postal Code</label></td>
                           <td><span><?php echo $member['Member']['postal_code'];?></span></td>
                        </tr>-->
						<!--<tr>
                           <td><label>Nearest Location</label></td>
                           <td><span><?php echo $member['Location']['name'];?></span></td>
                        </tr>-->
						<tr>
                           <td><label>Mobile number</label></td>
                           <td><span><?php echo (trim($member['Member']['phone'])!='')?$member['Member']['phone']:'-';?></span></td>
                        </tr>
						<tr>
                           <td><label>Status</label></td>
                           <td><span><?php echo $member['Member']['status'];?></span></td>
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
    <?php }?>


<?php if($member['MemberType']['name']=='supplier') {?>
			<div class="content-box content-box-header" style="border:none;">
                 <div class="column-content-box">
                      <div class="ui-state-default ui-corner-top ui-box-header">
                         <span class="ui-icon float-left ui-icon-notice"></span>
                         	Supplier's Information
                            <?php if($member['Member']['status']=='Active' && $member['MemberType']['name']=='supplier' && empty($member['Member']['password']) && $subadmin_type != '2' ) {?>
                   <a href="javascript:void(0);" class="ui-state-default ui-corner-all float-right ui-button send_otp" style="margin-top:-6px; margin-right:-2px;">Send OTP</a>
                <?php } ?>
          			</div>
				  <div style="clear:both"></div>    
                      <div class="hastable">
			<table id="sort-table"> 
				<tbody> 
				        <tr>
                           <td><label>Name</label></td>
                           <td><span><?php echo $member['Member']['name'];?></span></td>
                        </tr>
                   <tr>
                           <td><label>Last Name</label></td>
                           <td><span><?php echo $member['Member']['surname'];?></span></td>
                        </tr>
                         <tr>
                           <td><label>Member Type</label></td>
                           <td><span><?php echo $member['MemberType']['name'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>Landline Number</label></td>
                           <td><span><?php echo $member['MemberMeta']['landline'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>Mobile Number</label></td>
                           <td><span><?php echo $member['Member']['phone'];?></span></td>
                        </tr>
						      	
                        <tr>
                           <td><label> Email Address</label></td>
                           <td><span><?php echo $member['Member']['email'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>Company Name</label></td>
                           <td><span><?php echo $member['MemberMeta']['company_name'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>Trading As</label></td>
                           <td><span><?php echo $member['MemberMeta']['trading'];?></span></td>
                        </tr>
                         
						      <tr>
                           <td><label>Address</label></td>
                           <td><span><?php echo $member['Member']['address'];?></span></td>
                        </tr>
						                    <tr>
                           <td><label>City</label></td>
                           <td><span><?php echo $member['Member']['city'];?></span></td>
                        </tr>
					                    	<tr>
                           <td><label>Nearest Location</label></td>
                           <td><span><?php echo $member['Location']['name'];?></span></td>
                        </tr>
                          <tr>
                           <td><label>Business Type</label></td>
                           <td><span><?php echo $memberm['BusinessType']['name'];?></span></td>
                        </tr>
                         <tr>
                           <td><label>Business Category</label></td>
                           <td><span><?php echo $memberm['BusinessCategory']['name'];?></span></td>
                        </tr>  
                        <!--<tr>
                           <td><label>Registration Number</label></td>
                           <td><span><?php echo $member['MemberMeta']['registration_no'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>VAT Registration Number</label></td>
                           <td><span><?php echo $member['MemberMeta']['vat_registration_no'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>VAT Registration Number</label></td>
                           <td><span><?php echo $member['MemberMeta']['vat_registration_no'];?></span></td>
                        </tr>-->
                        <tr>
                           <td><label>Supplier%</label></td>
                           <td><span><?php echo $member['MemberMeta']['supplier%'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Cyber Coupon%</label></td>
                           <td><span><?php echo $member['MemberMeta']['cybercoupon%'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Status</label></td>
                           <td><span class="change_st"><?php echo $member['Member']['status'];?></span></td>
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
    <?php }?>
<?php if($member['MemberType']['name']=='company') {?>
			<div class="content-box content-box-header" style="border:none;">
                 <div class="column-content-box">
                      <div class="ui-state-default ui-corner-top ui-box-header">
                         <span class="ui-icon float-left ui-icon-notice"></span>
                         User Information
                            <?php if($member['MemberType']['name']=='supplier' && empty($member['Member']['password'])) {?>
                   <a href="javascript:void(0);" class="ui-state-default ui-corner-all float-right ui-button send_otp" style="margin-top:-6px; margin-right:-2px;">Send OTP</a>
                <?php } ?>
          			</div>
				  <div style="clear:both"></div>    
                      <div class="hastable">
			<table id="sort-table"> 
				<tbody> 
				        <tr>
                           <td><label>Name</label></td>
                           <td><span><?php echo $member['Member']['name'];?></span></td>
                        </tr>
                   <tr>
                           <td><label>Surname</label></td>
                           <td><span><?php echo $member['Member']['surname'];?></span></td>
                        </tr>
                         <tr>
                           <td><label>Member Type</label></td>
                           <td><span><?php echo $member['MemberType']['name'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>Telephone number</label></td>
                           <td><span><?php echo $member['Member']['phone'];?></span></td>
                        </tr>
						      	
                        <tr>
                           <td><label> Email Address</label></td>
                           <td><span><?php echo $member['Member']['email'];?></span></td>
                        </tr>
                          <!--<tr>
                           <td><label>Company Name</label></td>
                           <td><span><?php echo $member['MemberMeta']['company_name'];?></span></td>
                        </tr>
                         
						<tr>
                           <td><label>Address</label></td>
                           <td><span><?php echo $member['Member']['address'];?></span></td>
                        </tr>
						<tr>
                           <td><label>City</label></td>
                           <td><span><?php echo $member['Member']['city'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Nearest Location</label></td>
                           <td><span><?php echo $member['Location']['name'];?></span></td>
                        </tr>
                          <tr>
                           <td><label>Business Type</label></td>
                           <td><span><?php echo $memberm['BusinessType']['name'];?></span></td>
                        </tr>
                         <tr>
                           <td><label>Business Category</label></td>
                           <td><span><?php echo $memberm['BusinessCategory']['name'];?></span></td>
                        </tr>  
                          <tr>
                           <td><label>Registration Number</label></td>
                           <td><span><?php echo $member['MemberMeta']['registration_no'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>VAT Registration Number</label></td>
                           <td><span><?php echo $member['MemberMeta']['vat_registration_no'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>VAT Registration Number</label></td>
                           <td><span><?php echo $member['MemberMeta']['vat_registration_no'];?></span></td>
                        </tr>
                        <tr>
                           <td><label>Supplier%</label></td>
                           <td><span><?php echo $member['MemberMeta']['supplier%'];?></span></td>
                        </tr>
						                    <tr>
                           <td><label>Cyber Coupon%</label></td>
                           <td><span><?php echo $member['MemberMeta']['cybercoupon%'];?></span></td>
                        </tr>-->
						<tr>
                           <td><label>Status</label></td>
                           <td><span class="change_st"><?php echo $member['Member']['status'];?></span></td>
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
<?php } ?>
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
     data:{email : '<?php echo $member['Member']['email'];?>' ,id: '<?php echo $member['Member']['id'];?>'},
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