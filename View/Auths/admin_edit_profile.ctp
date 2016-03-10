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
		//$('#edit_profile').validate();
		var validator = $("#edit_profile").validate({					
			rules: {
				"data[Member][email]": {
					required:true,
					remote:ajax_url+'auths/check_admin_email'
				},
				"data[Member][name]": {
					required:true,
				},
				"data[Member][surname]": {
					required:true,
				},
			},
		   messages: {
				"data[Member][email]": {
					required: 'This field is required',
					remote:'This email id is already exist.'
				},
				"data[Member][name]": {
					required: 'This field is required',
				},
				"data[Member][surname]": {
					required: 'This field is required',
				},
			}
		}); 
	});
	$.validator.addMethod("admin_phone", function(value, element) {
		var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
		return (!pattern.test(value));
	}, "Not valid phone number.");
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
		<?php if($this->Session->check('error')){?>
			<div class="response-msg error ui-corner-all">
				<span>Error message</span>
				<?php echo $this->Session->read('error');?>
			</div>
			<?php unset($_SESSION['error']); ?>
		<?php }?>
			<div class="inner-page-title">
				<h2>Edit Profile</h2>
				<a href="<?php echo HTTP_ROOT;?>admin/auths/dashboard" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
				<span></span>
			</div> 
			<?php if($var=$this->Session->flash()){ ?>
			<div class="response-msg success ui-corner-all">
				<?php echo $myvar;?>
			</div>
			<?php }?>
			<div class="content-box content-box-header" style="border:none;">
				<div class="column-content-box">
					<div class="ui-state-default ui-corner-top ui-box-header">
						<span class="ui-icon float-left ui-icon-notice"></span>
						Profile Information 
					</div>
					<div id="tabs"> 						 
						<form action="<?php echo HTTP_ROOT.'admin/auths/edit_profile'?>" method="post"  enctype="multipart/form-data" 
                        id="edit_profile">                      
							<div id="tabs">							
								<div class="content-box-wrapper">
									<fieldset>
										<ul>
											<li>
												<label class="desc" >Name</label>
												<div>
													<?php echo $this->Form->input('Member.name',array('label'=>'','id'=>'uname',
													'class'=>'field text full required'))?>
												</div>
											</li>
											<li>
												<label class="desc" >Surname</label>
												<div>
													<?php echo $this->Form->input('Member.surname',array('label'=>'','id'=>'surname',
													'class'=>'field text full required'))?>
												</div>
											</li>      
											<li>
												<label class="desc" >Email</label>
												<div>
													<?php echo $this->Form->input('Member.email',array('label'=>'','id'=>'email','class'=>'field text full required email'))?>
												</div>
											</li>
											<?php if($subadmin_type==2) { ?>
											<li>
												<label class="desc" >Phone</label>
												<div>
													<?php echo $this->Form->input('Member.phone',array('label'=>'','id'=>'email','class'=>'field text full required admin_phone'))?>
												</div>
											</li>
											<?php }  ?>
											<li>
												<label class="desc" >Image</label>
												<div style="width:26%;float:left">
													<?php echo $this->Form->input('Member.image',array('label'=>'','id'=>'image', 'type'=>'file', 'name'=>'profile_image'))?> 
												</div>
												<?php echo $this->HTML->image(		'backend/admin/thumbnail/'.$this->data['Member']['image'],array('width'=>70));?>       
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