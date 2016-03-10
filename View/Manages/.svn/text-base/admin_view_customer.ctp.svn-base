<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>View Contact Details</h2>
               <a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
				<span></span>
             </div>
			
		
			<div class="content-box content-box-header" style="border:none;">
                <div class="column-content-box">
                      <div class="ui-state-default ui-corner-top ui-box-header">
                         <span class="ui-icon float-left ui-icon-notice"></span>
                         	Customer Information
                      </div>
				    <div style="clear:both"></div>    
					<div class="hastable">
						<table id="sort-table"> 
							<tbody> 
								<tr>
								   <td><label>Name</label></td>
								   <td><span>
								   <?php 
										if(strlen($a_customers['Contact']['name'])>80) {
											$str=substr($a_customers['Contact']['name'] ,0,80);
											echo $str.'......';
									}
									else {
										echo $a_customers['Contact']['name']; 
									}								   
								   
								   ?></span></td>
								</tr>
								<tr>
								   <td><label>Email Address</label></td>
								   <td><span>
								   <?php 
								   //echo $a_customers['Contact']['email'];
								   ?>
								   <?php
								//$a=$pt['Post']['body'];
								//echo strlen($pt['Post']['body']);die;
								if(strlen($a_customers['Contact']['email']) >80)
								{
									$str=substr($a_customers['Contact']['email'],0,80);
									echo $str.'......';

								}
								else
								{
									echo $a_customers['Contact']['email'];
								}
								?>
								   </span></td>
								</tr>
								<tr>
								   <td><label>Subject</label></td>
								   <td><span>
								   <?php 
								   	if(strlen($a_customers['Contact']['subject'])>80) {
											$str=substr($a_customers['Contact']['subject'] ,0,80);
											echo $str.'......';
									}
									else {
										echo $a_customers['Contact']['subject']; 
									}	
								   	
								   ?>
								   </span></td>
								</tr>
								<tr>
								   <td><label>Message</label></td>
								   <td >
            			<span>
	             				<?php if(strlen($a_customers['Contact']['message'])>150) {
											$str=substr($a_customers['Contact']['message'] ,0,150);
											echo $str.'......';
									}
									else {
										echo $a_customers['Contact']['message']; 
									}	?>
            			</span>		
								</tr>		
								<tr>
								   <td><label>Member Type</label></td>
								   <td>
								   	<span>
								   <?php echo $a_customers['MemberType']['name'];?>
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
    
        </div>
	</div>
    <div class="clear"></div>
</div>