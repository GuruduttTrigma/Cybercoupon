<script type="text/javascript">
$(document).ready(function(){
	$('#frm').validate();
});
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onClick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
			<div class="inner-page-title">
				<h2>Edit Customer</h2>
               <span></span>
			</div>
            <form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Manages/edit_customer/'.base64_encode(convert_uuencode($id))?>">
              <fieldset>
            <div class="content-box content-box-header" style="border:none;">
			<div class="column-content-box">
            
            <div class="ui-state-default ui-corner-top ui-box-header">

                <span class="ui-icon float-left ui-icon-notice"></span>

                Edit Customer
            </div>
            
            <div class="content-box-wrapper">
            	<input type="hidden" id="mem_id" value="<?php echo $id; ?>" />
                
                <ul>
						  <li>
								<label class="desc">Name<em>*</em></label>
							<div>
						   	<input  class="field text full required" name="data[Contact][name]" type="text" value="<?php echo $customers['Contact']['name']; ?>" />
							</div>
						  </li>
						  <li>
								<label class="desc">Email Address<em>*</em></label>
							<div>
						  		<input  class="field text full required" name="data[Contact][email]" type="text"  value="<?php echo $customers['Contact']['email']; ?>" />
							</div>
						  </li>
						  <li>
								<label class="desc">Phone Number*<em>*</em></label>
							<div>
						  		<input  class="field text full required" name="data[Contact][phone]" type="text" value="<?php echo $customers['Contact']['phone']; ?>" />
							</div>
						  </li>
						  	<li>
								<label class="desc">Subject*<em>*</em></label>
							<div>
						  	<input  class="field text full required" name="data[Contact][subject]" type="text"  value="<?php echo $customers['Contact']['subject']; ?>" />
							</div>
						  </li>			  
						  <li>
								<label class="desc">Message<em>*</em></label>
							<div>
							 	  <textarea class="field text full required" name="data[Contact][message]" /><?php echo $customers['Contact']['message']; ?></textarea>
							</div>
						  </li>
						
                </ul>
              
          </div> <!-- end of content box wrapper -->
            
            </div>
            </div>
            
              <li>
                <input class="submit sub-bttn" type="submit" value="Submit"/>
              </li>
            </fieldset>
            </form>
            
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>