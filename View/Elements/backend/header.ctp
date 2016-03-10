<?php 
$member_type  =  $this->Session->read('Admin.admin_type');  
$admin_id  =  $this->Session->read('Admin.id'); 
$viewQuery = ClassRegistry::init('Member'); 
$viewMember = $viewQuery->find('first',array('conditions'=>array('Member.id'=>$admin_id),'fields'=>array('Member.id','Member.company_user_type'),'recursive'=>-1));
//pr($viewMember);die;
?>
<style>
	a.btn
	{
		color:#fff !important;
	}  
</style>   
<div id="page-header-wrapper">
	<div id="top">   
		<div style="width:0%; float:left; padding:10px;">        	
			<span class="logo" style="color: #FFFFFF;float: left;font-size: 30px;padding: 0 10px;width: 325px;">			
                <span style="padding:10px;color:#009FDA; font-size:32px;" class="logo">
					<a style="color:#009FDA" href="<?php echo HTTP_ROOT;?>admin/auths/dashboard">Cyber Coupon</a>
				</span>
			</span>
		</div>
		<div class="welcome" style="padding-top:0px;">
			<span class="note">
				Welcome 
				<a href="<?php echo HTTP_ROOT;?>admin/auths/dashboard" title="Welcome <?php echo $this->Session->read('Admin.username');?>">
					<?php echo ucfirst($this->Session->read('Admin.username'));?>
				</a>
			</span>
			<a class="btn ui-state-default ui-corner-all" id="log" href="<?php echo HTTP_ROOT ?>admin/auths/logout" style="margin-top: 2px !important;">
				<span class="ui-icon ui-icon-power"></span>
                Logout
			</a>
			<div class="lang">
				<script type="application/javascript">
					function change_setting(){
						var loc = document.setting.select_language.value;
						if(loc !=""){
							window.location=loc;
						}
					}
				</script>
				<ul style="margin-top: -3px;">
					<form action="#" name="setting">
						<select name="select_language"  onchange="return change_setting();">
							<option value="">Account Settings</option>
							<option <?php if($this->params['action']=="admin_edit_profile"){?> selected="selected" <?php }?> value="<?php echo HTTP_ROOT ?>admin/auths/edit_profile">Edit Profile</option>
							<option <?php if($this->params['action']=="admin_change_password"){?> selected="selected" <?php }?> value="<?php echo HTTP_ROOT ?>admin/auths/change_password">Change Password</option>
						</select>
					</form>
				</ul>
            </div><?php /*?><?php */?><!-- close lang-->
        </div><!-- close welcome-->
	</div><!-- close top-->	
</div>
<div class="main_navigation_contain">
	<div class="inner_navigate">
		<ul id="navigation">
			<li>
				 <a href="<?php echo HTTP_ROOT;?>admin/auths/dashboard" class="sf-with-ul">Dashboard</a>
			</li>
			<?php 
			if($member_type=='1' || in_array('1',$parent_modules))
			{ 
			?>
				<li>
					<a href="#" class="sf-with-ul">Content Management</a>
					<ul>
						<?php                     
						if($member_type=='1' || in_array('2',$sub_modules))
						{  
						?>
						<li>
							<a href="<?php echo HTTP_ROOT;?>admin/Manages/cmsPages" class="sf-with-ul">CMS Pages</a>
						</li> 
						<?php 
						} 
						if($member_type=='1' || in_array('3',$sub_modules))
						{ 
						?>  
						<li>
							<a href="<?php echo HTTP_ROOT;?>admin/Manages/emailTemplates" class="sf-with-ul">
								Email Templates
							</a>
						</li>
						<?php
						}
						if($member_type=='1' || in_array('4',$sub_modules))
						{
						?>  
						<li>
							<a href="<?php echo HTTP_ROOT;?>admin/Manages/faqs" class="sf-with-ul">FAQ</a>
						</li>
						<?php
						}
						if($member_type=='1' || in_array('6',$sub_modules))
						{ 
						?> 
							<li>
								<a href="<?php echo HTTP_ROOT;?>admin/Manages/currency_management" class="sf-with-ul">
									Currency Management
								</a>
							</li>
						<?php 
						}
						if($member_type=='1' || in_array('6',$sub_modules))
						{ 
						?> 
							<li>
								<a href="<?php echo HTTP_ROOT;?>admin/Manages/customer_verification" class="sf-with-ul">
								Customer Verification
								</a>
							</li>
						<?php 
						}
						?>
          			</ul>
				</li>
			<?php
			}
			?>    
		<?php
		if($member_type=='1' || in_array('7',$parent_modules))
		{ 
		?>
			<li>
                <a href="#" class="sf-with-ul">Users</a>
				<ul>
					<?php
					if($member_type=='1' || in_array('8',$sub_modules))
					{ 
					?> 
						<li>
							<a href="<?php echo HTTP_ROOT;?>admin/Members/members/<?php echo base64_encode(convert_uuencode(3));?>" class="sf-with-ul">Suppliers</a>
						</li>
					<?php 
					} 
					if($member_type=='1' || in_array('9',$sub_modules))
					{ 
					?>  
					<li>
						<a href="<?php echo HTTP_ROOT;?>admin/Members/customers" class="sf-with-ul">
							Customers
						</a>
					</li>
					<?php
					}
					if($member_type=='1')
					{ 
					?> 
						<li>
                			<a href="<?php echo HTTP_ROOT;?>admin/Members/members/<?php echo base64_encode(convert_uuencode(2));?>" class="sf-with-ul">
								Company Users
							</a>
                		</li>
            		<?php
					}
					if($member_type=='1' || in_array('9',$sub_modules))
					{ 
					?>
					<li>
						<a href="<?php echo HTTP_ROOT;?>admin/Members/uploaded_users" class="sf-with-ul">
							Uploaded Users
						</a>
					</li>
					<?php 
					}
					?>
      			</ul>
			</li>
		<?php
		}
		?>
		<?php
		if($member_type=='2' && $viewMember['Member']['company_user_type']=='sales_person')
		{ 
		?>
			<li>
				<a href="#" class="sf-with-ul">Suppliers</a>
				<ul>
					<a href="<?php echo HTTP_ROOT;?>admin/Members/sales_members/<?php echo base64_encode(convert_uuencode($admin_id));?>" class="sf-with-ul">
						Suppliers 
					</a>
				</ul>
			</li>
		<?php
		}
		?>
		<?php
		if($member_type=='1' || in_array('14',$parent_modules))
		{ 
		?>
      		<li>
				<a href="#" class="sf-with-ul">Deals</a>
				<ul>
                <?php
                if($member_type=='1' || in_array('15',$sub_modules))
                { 
                ?> 
                    <li>
						<a href="<?php echo HTTP_ROOT;?>admin/Manages/deals" class="sf-with-ul">Deals</a>
                  	</li>
				<?php
                }
                if($member_type=='1' || in_array('16',$sub_modules))
                { 
                ?> 
					<li>
                	    <a href="<?php echo HTTP_ROOT;?>admin/Deals/categories" class="sf-with-ul">Deal Categories</a>
                	</li>
                <?php
                }
                if($member_type=='1' || in_array('16',$sub_modules))
                { 
                ?> 	
                	<li>
						<a href="<?php echo HTTP_ROOT;?>admin/Manages/locations" class="sf-with-ul">Deal Locations</a>
                	</li>	
             	<?php
                }
                if($member_type=='1' || in_array('16',$sub_modules))
                { 
                ?> 	
                	<li>
						<a href="<?php echo HTTP_ROOT;?>admin/Manages/deal_list" class="sf-with-ul">Deal Lists/Reports</a>
                	</li>			
                <?php
                }
                if($member_type=='1' || in_array('16',$sub_modules))
                { 
                ?> 
					<li>
                	    <a href="<?php echo HTTP_ROOT;?>admin/Manages/sold_Vouchers" class="sf-with-ul">Sold Vouchers</a>
                	</li>
                <?php
                }          
                ?>                 		 
				</ul>
      		</li>
		<?php
		}
		?> 

		<?php
        if($member_type=='1' || in_array('22',$parent_modules))
        { 
        ?>
      		<li>
                <a href="#" class="sf-with-ul">Orders Details</a>
            	<ul>
					<?php
                    if($member_type=='1' || in_array('23',$sub_modules))
                    { 
                    ?> 
                    	<li>
                    	    <a href="<?php echo HTTP_ROOT;?>admin/Orders/order" class="sf-with-ul">Orders Details</a>
                    	</li>
					<?php
					}
					if($member_type=='1' || in_array('24',$sub_modules))
					{ 
					?> 
						<li>
							<a href="<?php echo HTTP_ROOT;?>admin/Orders/deleted_order" class="sf-with-ul">
								List Of Cancelled Orders
							</a>
                		</li>
					<?php 
					}
					?>
              	</ul>
        	</li>
		<?php
		}
      
        // pr($parent_modules);
        if($member_type=='1' || in_array('25',$parent_modules))
        {   
        ?>
          	<li>
                <a href="#" class="sf-with-ul">NewsLetter</a>
				<ul>
				<?php
				if($member_type=='1' || in_array('26',$sub_modules))
                { 
                ?>
					<li>
                        <a href="<?php echo HTTP_ROOT;?>admin/NewsLetters/newsletter" class="sf-with-ul">
							Create Newsletters (approve & select ads)
						</a> 
					</li>
                <?php
                }
                if($member_type=='1' || in_array('27',$sub_modules))
                { 
                ?> 
					<li>
						<a href="<?php echo HTTP_ROOT;?>admin/NewsLetters/daily_newsletter" class="sf-with-ul">
							Approved and not sent Newsletters
						</a>
					</li>
				<?php
                }
                if($member_type=='1' || in_array('28',$sub_modules))
                { 
                ?>           
                  <?php
                   }
                   if($member_type=='1' || in_array('28',$sub_modules))
                   { 
                  ?> 
                  <li>
                  <a href="<?php echo HTTP_ROOT;?>admin/NewsLetters/dispatched_newsletters" class="sf-with-ul"> Queued for dispatch</a>
                  </li>
                  <?php
                  }
                   if($member_type=='1' || in_array('28',$sub_modules))
                   { 
                  ?> 
                  <li>
                  <a href="<?php echo HTTP_ROOT;?>admin/NewsLetters/archieve_newsletters" class="sf-with-ul">Archived Newsletters</a>
                  </li>
                  <?php
                  }
                  ?>
          		</ul>
          	</li>
       	<?php
	       }
	       if($member_type=='1' || in_array('29',$parent_modules))
          { 
	      ?>
		        <li>
	              <a href="#" class="sf-with-ul">Referrers</a>
	          		<ul>
	               	<li>
	                  	<a href="<?php echo HTTP_ROOT;?>admin/Pages/referrals" class="sf-with-ul">Referrers</a> 
							</li>
	      				
	               </ul>
	          	</li>
          	<?php
          	}
			if($member_type=='1' || in_array('31',$parent_modules))
			{ 
          	?>
          	<li>
            <a href="#" class="sf-with-ul">Claims</a>
          		<ul>
               	<li>
                  	<a href="<?php echo HTTP_ROOT;?>admin/Manages/claim" class="sf-with-ul">Sales Claim</a> 
						</li>
      				<li>
               		<a href="<?php echo HTTP_ROOT;?>admin/Manages/refund" class="sf-with-ul">Refunds by cybercoupon</a>
                  </li>
				 
                </ul>
          	</li>
			<?php 
			} 
			if($member_type=='1' || in_array('34',$parent_modules))
			{ 
			?>
				<li>
					<a href="javascript:void(0)" class="sf-with-ul">Supplier Payment Report</a>
	          	<ul>
					
					<li>
						<a href="<?php echo HTTP_ROOT;?>admin/Reports/reports" class="sf-with-ul">Supplier Payment Report</a>
					</li>
					<li>
						<a href="<?php echo HTTP_ROOT;?>admin/Reports/viewPayHistory" class="sf-with-ul">Payment Release History</a> 
					</li>
					<li>
						<a href="<?php echo HTTP_ROOT;?>admin/Reports/customerPaymentReport" class="sf-with-ul">Customer Payment Report</a> 
					</li>
				</ul>
	         </li>
			 
			<?php 
			}
			?>
 </ul>
</div>
</div>


