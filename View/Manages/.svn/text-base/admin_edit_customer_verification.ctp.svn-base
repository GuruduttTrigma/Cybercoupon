<script type="text/javascript">
$(document).ready(function(){
	$('#frm').validate();
	$('.sub-bttn').click(function(){
		var status = $(".status").val();
		var id = $(".id").val();
		$.ajax({
			type: 'Post',
			url : ajax_url+"Manages/admin_edit_customer_verification",
			data: {'varification_status':status,'id':id},
		})
	});
});
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onClick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">
				Back
			</a>
			<div class="inner-page-title">
				<h2>Edit Customer Verification</h2>
				<span></span>
			</div>
            <div class="content-box content-box-header" style="border:none;">
				<div class="column-content-box">            
					<div class="ui-state-default ui-corner-top ui-box-header">
						<span class="ui-icon float-left ui-icon-notice"></span>
						Edit Customer Verification
					</div>            
					<div class="content-box-wrapper">
						<input type="hidden" id="mem_id" value="<?php echo $reqdata['CustomerVarification']['id']; ?>" />                
						<ul>
							<li>
								<label class="desc">Customer verification Status<em>*</em></label>
								<div>
									<select class="field text full required status" name="data[CustomerVarification][varification_status]" style="padding:3px;" >
										<option  <?php if($reqdata['CustomerVarification']['varification_status']=="direct_verification"){ echo 'selected="selected"'; } ?>>
											Direct Verification
										</option>   
										<option <?php if($reqdata['CustomerVarification']['varification_status']=="email_verification"){ echo 'selected="selected"'; } ?>>
											Email Verification
										</option>   													
									</select>
								</div>
							</li>
							<li>
								<label class="desc">Id<em>*</em></label>
								<div>									  
									<input class="field text full required id" name="data[CustomerVarification][id]" value="<?php echo $reqdata['CustomerVarification']['id'];?>" >
								</div>
							</li>
						</ul>              
					</div> <!-- end of content box wrapper -->            
				</div>
            </div>            
			<li>
				<input class="submit sub-bttn" type="submit" value="Submit"/>
			</li>            
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>