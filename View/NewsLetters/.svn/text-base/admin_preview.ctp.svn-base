<?php	echo 	$this->Html->script('jquery.min.js');	?>
<?php   echo 	$this->Html->script('backend/development/jquery-1.6.2.js');	?>
<?php	echo  	$this->Html->script('backend/development/validate.js');	?>
<?php 	echo  	$this->Html->script('backend/development/common.js'); ?>
<?php 	echo  	$this->Html->script('backend/development/custom.js'); ?>
<?php  	echo 	$this->Html->script('backend/development/ui/ui.core.js');	?>
<?php  	echo 	$this->Html->script('backend/development/ui/ui.widget.js');	?>
<?php  	echo 	$this->Html->script('backend/development/ui/ui.mouse.js');	?>
<?php  	echo 	$this->Html->script('backend/development/ui/ui.sortable.js');	?>
<?php  	echo 	$this->Html->script('backend/development/ui/ui.dialog.js');	?>
<?php 	echo  	$this->Html->script('backend/development/superfish.js'); ?>
<?php  	echo 	$this->Html->script('backend/development/tooltip.js');?>
<?php  	echo 	$this->Html->script('backend/development/cookie.js'); ?> 
<?php  	echo 	$this->Html->script('backend/development/tablesorter.js');	?> 
<?php  	echo 	$this->Html->script('backend/tinymce/tiny_mce.js'); ?>
<?php  	echo 	$this->Html->script('backend/development/tablesorter-pager.js');?>	
<?php 	echo 	$this->Html->script('backend/development/ui.datepicker.js'); ?>
<?php	echo 	$this->Html->css('backend/admin.css');	?>
<?php	echo 	$this->Html->css('backend/smooth.css');?>
<?php	echo 	$this->Html->css('backend/ui/ui.base.css');?>
<?php 	echo 	$this->Html->css('backend/themes/black_rose/ui.css','stylesheet',array('title'=>'style','media'=>'all')); ?>
<?php	echo 	$this->Html->css('backend/themes/black_rose/ui.css');	?>
<?php 	echo 	$this->Html->css('backend/ui/ui.core.css');	?>
<script type="text/javascript">
$(function() {
	var year = (new Date()).getFullYear()
	var current_date= new Date();
	$( ".dispatch_date" ).datepicker({
		dateFormat:'d M yy',
		yearRange:'2000:'+year,
		minDate:current_date,
		changeMonth: true, 
		changeYear: true,
		timepicker:false,
	});
	})
	$(document).ready(function (){
	$('.AcceptDiv').click(function() {
		$('#imgLoader').show();
		$.ajax({
					url:'<?php echo $url1; ?>',
					type:'post',
					success:function(resp)
					 {	
						$('#imgLoader').hide();
						if(resp.trim() == 'true') {
							$('.Email-div').slideDown();
							$('#succesDiv').show();
							setTimeout(function(){$("#succesDiv").fadeOut()},5000);
						}
						//$('.image_display').css('display','none');
					}
				
			});
			return false;	 
	});
	
	$('#frm').validate({
			rules:
			{
				"data[Dispatch][sent_date]":
				{
					required:true,
					//remote:ajax_url+'Members/checkMemberName'
				},
			},
			messages:
			{
				"data[Dispatch][sent_date]":
        		{
           		required:"This field is required.",
        		}
			}
		});
	
	});
</script>
<style>
body
{
background:white;
}

</style>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">        
			<div class="inner-page-title">
				<h2>NewsLetter Preview</h2>
            <!--<div style="float:left; margin-top:-16px; height:20px; margin-left:200px;">
				<span class="ui-icon ui-icon-bookmark" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:100px; float:left; border:0px;"> - Add To NewsLetter</span>
				</div>-->
            <span></span>
			</div>
			<div id = "succesDiv">
			 <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
				<?php } ?>
			</div>
			<div class="id_cont admin_search member_search_management" style="margin-bottom:0px; float:left " >
				<?php echo $common_template; ?>
			
            </div>
			
				<div class="clearfix"></div>
				<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
