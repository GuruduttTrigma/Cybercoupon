<script>
$(document).ready(function(){
	$('#add_referee').validate({
			rules:
			{	
				"data[Referee][Referee_email]":
       		    {
					required:true,
					email:true,
					remote:
					{
						url:ajax_url+'admin/Pages/checkadd_referee',
						type:"POST",
						data:
					    {
						  Referral_id:function()
						  {
							 return $('input[name="data[Referral][Referral_id]"]').val();
						  },
						  Referral_email:function()
						  {
							 return $('input[name="data[Referral][Referral_email]"]').val();
						  }
					    }
					}
        		}
			},
			messages:
			{
				"data[Referee][Referee_email]":
       			{
					required:'This field is required.',
					email:'Please enter valid email.',
					remote:'This email id already linked to some other customer or does not exist in database.'
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
				<h2>Re-link New Referrer</h2>
               <span></span>
			</div>
			<form id="add_referee" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Pages/addReferred/'.base64_encode(convert_uuencode($referre['Member']['id']));?>">
				<fieldset>
					<div class="content-box content-box-header" style="border:none;">
						<div class="column-content-box">
							<div class="ui-state-default ui-corner-top ui-box-header">
								<span class="ui-icon float-left ui-icon-notice"></span>
								Referred Information
							</div>	
														
							<div class="content-box-wrapper">
								<div class="row">
									<div id="edit-1-email" >
									    <div class="col-md-6 col-sm-9 col-xs-12 col-lg-6">
											<label class="desc">Original Referrer (Parent)<em>*</em></label>
											<p style="margin-bottom:5px;">
											    <input type="hidden" name="data[Referral][Referral_id]" value="<?php echo $referre['Member']['id'];?>">
												<input type="text" name="data[Referral][Referral_email]" class="field text full" readOnly="readOnly" value="<?php echo $referre['Member']['email'];?>">
											</p>
										</div>
										<div class="col-md-6 col-sm-9 col-xs-12 col-lg-6">
										    
											<label class="desc">New Referral (Slave)<em>*</em></label>
											<p style="margin-bottom:5px;">
												<input type="text" name="data[Referee][Referee_email]" class="field text full required email" value="">
											</p>
										</div>
										<div class="col-md-6 col-lg-6 col-xs-12 col-sm-3">
											<input type="submit" class="submit sub-bttn submit-linkbtn" value="Submit" />
										</div>
									</div>
								</div>
							</div> 		
						</div>
					</div>				
				</fieldset>
            </form>            
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>