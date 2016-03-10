<script type="text/javascript">
$(document).ready(function(){
	$("#frm").validate();
});	

</script>
<style>
td.test {
    word-wrap: break-word;
} 
</style>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>Customer Verification</h2>
				<span></span>
             </div>		
			<div class="content-box content-box-header" style="border:none;min-height:200px;">
				<div style=" margin-top: 100px;">
					
					<div class="" style="float:left; width:36%; margin-top:8px;">
					   <label style="font-size:18px;">Require Customer Email Addresses to be Verified:</label>
					</div>
					<div style="float:left; width:40%; margin-top:8px;">
					<form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Manages/customer_verification';?>">
						<div class="" style="float:left; width:20%; margin-top:8px;">
							<input type="checkbox" style="margin-left:10px;" value="<?php echo $reqdata['CustomerVarification']['varification_status']; ?>" name="data[CustomerVarification][varification_status]"
							<?php 
								if($reqdata['CustomerVarification']['varification_status']=="email_varification")
								{ 
									echo 'checked="checked"'; 
								} 
							?>
							>
							<input type="hidden" value="<?php echo $reqdata['CustomerVarification']['id']; ?>"  name="data[CustomerVarification][id]">
						</div>
						<div class="" style="float:left; width:50%;">
						  <input class="sub-bttn " type="submit" value="Save" style="width: auto; margin-top: 2px;margin-left:0;">
						</div>
					</form>
					</div>
			
	</div>
	</div>
	</div>
    <div class="clear"></div>
</div>