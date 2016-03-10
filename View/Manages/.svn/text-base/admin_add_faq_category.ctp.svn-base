	<script type="text/javascript">
$(document).ready(function(){
	$('#frm1').validate({
			rules:
			{
				"data[FaqCategory][name]":
				{
					required:true,
					remote:ajax_url+'admin/Manages/checkaddCategoryExist/'
				}
			},
			messages:
			{
				"data[FaqCategory][name]":
				{
					required:'Please enter category name.',
					remote:'Category name already exists.'
				}
			}
		
		
		});
});
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onClick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
			<div class="inner-page-title">
				<h2>Add Faq Category</h2>
               <span></span>
			</div>
			<form id="frm1" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT;?>admin/Manages/add_faq_category">
				  <fieldset>
				<div class="content-box content-box-header" style="border:none;">
					<div class="column-content-box">
					
					<div class="ui-state-default ui-corner-top ui-box-header">

						<span class="ui-icon float-left ui-icon-notice"></span>

						Faq Category Information
					</div>
					
					<div class="content-box-wrapper">
					
					
						<ul>
						  <li>
						<label class="desc" for="firstname">Category Name:<em>*</em></label>
						<div>
						  <input  class="field text full required" name="data[FaqCategory][name]" type="text"  />
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