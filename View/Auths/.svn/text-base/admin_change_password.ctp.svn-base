<style>
	form li span {
		width:100%;
	}
	tr.mceLast {
		display:none;
	}
</style>	
<script type="text/javascript">
	$(document).ready(function() {
		/*$('#change_password').validate();		   $("#old_password").rules('add',{remote:ajax_url+"users/check_password",
		messages: {remote: "Old password entered is wrong"}});
		$("#confirm_password").rules('add',{equalTo: "#password",
		messages: {equalTo: "The two new password fields do not match?"}});*/
		var validator = $("#change_password").validate({
			rules: {
					"data[Member][old_password]": {
					required:true,
					remote:ajax_url+'auths/check_password'
					},
					"data[Member][confirm_password]": {
					required: true,
					equalTo:'#password'
				}
			},
			messages: {
					"data[Member][old_password]": {
					required: 'This field is required',
					remote:'Old password entered is wrong'
				},
					"data[Member][confirm_password]": {
					required:'This field is required',
					equalTo:'The two new password fields do not match.'
				}
			}
		}); 
	});	   
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>Change Password</h2>
				<a href="<?php echo HTTP_ROOT;?>admin/auths/dashboard" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
				<span></span>
			</div>
			<?php if($this->Session->check('error')){ ?>
				<div class="response-msg error ui-corner-all">
					<span>Error message</span>
					<?php echo $this->Session->read('error');?>
				</div>
				<?php $this->Session->delete('error'); ?>
			<?php } ?>
			<div class="content-box content-box-header" style="border:none;">
				<div class="column-content-box">
					<div class="ui-state-default ui-corner-top ui-box-header">
						<span class="ui-icon float-left ui-icon-notice"></span>
						Change password 
					</div>
					<div id="tabs"> 						 
						<form action="<?php echo HTTP_ROOT.'admin/auths/change_password'?>" method="post" id="change_password">                      
							<div id="tabs">							
								<div class="content-box-wrapper">
									<fieldset>
										<ul>
											<li>
												<label class="desc" >Old Password</label>
												<div>
													<?php echo $this->Form->input('Member.old_password',array('autocomplete'=>'off','label'=>'','id'=>'old_password','class'=>'field text full required','type'=>'password'))?>
												</div>
											</li>
											<li>
												<label class="desc" >New Password</label>
												<div>
													<?php echo $this->Form->input('Member.password',array('label'=>'','id'=>'password',
													'class'=>'field text full required','type'=>'password'))?>
												</div>
											</li>
											<li>
												<label class="desc" >Confirm New Password</label>
												<div>
													<?php echo $this->Form->input('Member.confirm_password',array('label'=>'','id'=>'confirm_password',
													'class'=>'field text full required','type'=>'password'))?>
												</div>
											</li>
											<li>
												<input class="sub-bttn" type="submit" value="Submit"/>
											</li>
										</ul>
									</fieldset>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>