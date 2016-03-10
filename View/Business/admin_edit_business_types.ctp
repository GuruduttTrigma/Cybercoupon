	<script type="text/javascript">
$(document).ready(function(){
	var cat = $('#cat_id').val();
	$('#frm').validate({
			rules:
			{
				"data[BusinessType][name]":
				{
					required:true,
					remote:ajax_url+'admin/Business/checkeditTypeExist/'+cat
				}
			},
			messages:
			{
				"data[BusinessType][name]":
				{
					required:'Please enter category name.',
					remote:'This type is already exists.'
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
				<h2>Edit Business Type</h2>
               <span></span>
			</div>
            <form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Business/edit_business_types/'.base64_encode(convert_uuencode($id))?>">
              <fieldset>
            <div class="content-box content-box-header" style="border:none;">
			<div class="column-content-box">
            
            <div class="ui-state-default ui-corner-top ui-box-header">

                <span class="ui-icon float-left ui-icon-notice"></span>

                Edit Business Category
            </div>
            
            <div class="content-box-wrapper">
            	<input type="hidden" id="mem_id" value="<?php echo $id; ?>" />
                
                <ul>
                <li>
							<label class="desc" for="firstname">Category Name:<em>*</em></label>
						<div>
						  <input  class="field text full required" name="data[BusinessType][name]" type="text" value="<?php echo $faqs['BusinessType']['name'];?>" />
						</div>
						<input type="hidden" id="cat_id" name="id" value="<?php echo $faqs['BusinessType']['id'];?>">
						
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