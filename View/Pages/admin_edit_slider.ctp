<script type="text/javascript">
$(document).ready(function(){
	$('#frm').validate({
			rules:
			{	
				"data[Slider][title]":
       		{
					required:true,
					maxlength:80
        		},
				messages:
			   {
					"data[Slider][title]":
       			{
						required:'Maxlength should be less than 10.',
        			},
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
				<h2>Edit Slider</h2>
               <span></span>
			</div>
            <form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Pages/edit_slider/'.base64_encode(convert_uuencode($slider['Slider']['id']));?>">
				  <fieldset>
				<div class="content-box content-box-header" style="border:none;">
					<div class="column-content-box">
					
					<div class="ui-state-default ui-corner-top ui-box-header">

						<span class="ui-icon float-left ui-icon-notice"></span>

						Slider Information
					</div>
					
					<div class="content-box-wrapper">
               <input name="data[Slider][id]" type="hidden" value="<?php echo $slider['Slider']['id'];?>" />					
					
						<ul>
						 <li>
                   	<label class="desc">Image:<em>*</em></label>
                   	<div style="width:40%;float:left;">
							<input  class="field text" name="slider_image" type="file" value="<?php echo $slider['Slider']['image'];?>"/>
							</div>
							<div style="width:50%;margin-left:114px;">
							<img  src="<?php echo IMPATH.'sliders/'.$slider['Slider']['image'].'&w=200&h=200';?>"/>
							</div>							
						
                  </li> 
						  <li>
							<label class="desc">Title<em>*</em></label>
							<div>
							  <input class="field text full required " value="<?php echo $slider['Slider']['title'];?>" name="data[Slider][title]"/>
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