<?php 
	echo $this->Html->script('backend/development/ui.datepicker.js');
  	echo $this->Html->css('cake.generic.css');
?>
<script type="text/javascript">
$(document).ready(function()
{
    $('#frm').validate({
				rules:
				{
					'data[Member][file]': {
						required: true,
					},
					
				},
				messages:
				{
					'data[Member][file]':
					{
						remote: 'Please Select CSV file!'
					}
					
				}
		});

	
});
function Checkfiles()
{
	var fup = document.getElementById('filename');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);

	if(ext =="csv")
	{
		return true;
	}
	else
	{
		alert("Upload CSV files only");
		$('#filename').val('');
		return false;
	}
}
</script>
<script type="text/javascript">
	$(function() {		
		$('#image').bind('change',function(){		
			var imagePath = $('#image').val();//document.FormTwo.picFile.value;
			var pathLength = imagePath.length;
			var lastDot = imagePath.lastIndexOf(".");
			var fileType = imagePath.substring(lastDot,pathLength);	
			var fileType = fileType.toLowerCase();				
			$('#file_hidden').val(imagePath); 				
		});		
	});
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">
				Back
			</a>
			<?php if($this->Session->check('error')){ ?>
			<div class="response-msg success ui-corner-all"> 
				<span>Success message</span> 
				<?php echo $this->Session->read('error');?> 
			</div>
			<?php 
				$this->Session->delete('error'); ?>
			<?php } ?>
			<div class="inner-page-title">
				<h2>Upload Customers</h2>
               <span></span>
			</div>
			<form class="forms" id="frm" method="post" action="<?php echo HTTP_ROOT;?>admin/Members/upload_customers" enctype="multipart/form-data">
				<fieldset>
					<div class="content-box content-box-header" style="border:none;">
						<div class="column-content-box">  
            				<div class="content-box-wrapper">
								<ul>
									<li>
										<label class="desc">Upload CSV<em>*</em></label>
										<div>
											<input style="width:35%" class="required" name="data[Member][file]" type="file" id="filename" onchange="Checkfiles(this)"/>								
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