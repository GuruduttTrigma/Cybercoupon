<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<script type="text/javascript" >
   //if (window.location.protocol != "https:")
   // window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);
</script>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link href="<?php echo HTTP_ROOT;?>img/favicon.ico" rel="shortcut icon"> 
		<title>Admin Panel</title>
		<?php echo $this->Html->script('jquery.min.js');?>
		<?php echo  $this->Html->script('backend/development/validate.js'); ?>
		<?php echo $this->Html->script('backend/development/ui/ui.core.js');?>
		<?php echo $this->Html->script('backend/development/ui/ui.widget.js');?>
		<?php echo $this->Html->script('backend/development/ui/ui.mouse.js');?>
		<?php echo $this->Html->script('backend/development/ui/ui.button.js');?>
		<?php echo $this->Html->script('backend/development/ui/ui.dialog.js');?>
		<?php echo  $this->Html->script('backend/development/ui/ui.tabs.js'); ?>
		<?php 
			echo $this->Html->css('backend/ui/ui.base.css');
			echo $this->Html->css('backend/ui/ui.login.css');
			echo $this->Html->css('backend/themes/black_rose/ui.css');
			echo $this->Html->css('backend/themes/black_rose/ui.css','stylesheet',array('title'=>'style'));
	  
		?>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#tabs, #tabs2, #tabs5').tabs();
					$('#AdminLogin').validate({
					// var emailid=$('#adminmail').val();
					/*alert($('#adminmail').val())
					rules: {
						"data[Member][email]": {
							required:true,
							email:true,
							remote:ajax_url+'admin/Members/checkMemberEmail',
						}
					},
					messages: {
						"data[Member][email]": {
							required:'Please enter email.',
							email:'Please enter valid email.',
							remote:'Email address already exists.'
						},
					}*/
				});
			});
		</script>
	</head>
	<body>
	<!-- Main -->
		<div id="page_wrapper">
			<div id="page-header"> 
				<div id="page-header-wrapper">             
					<div id="top">
						<div style="width:30%; float:left; padding:10px;">
							<span class="logo" style="padding:10px;color:#009FDA; font-size:32px;">Cyber Coupon</span>
						</div>
					</div>
				</div>
			</div>		   
			<div id="sub-nav">
				<div class="page-title">
					<h1>Forgot Password</h1><br>
				</div>					
			</div>
			<div class="clear"></div>
			<div id="page-layout">
				<div id="page-content">
					<div id="page-content-wrapper">
						<div id="tabs">
							<ul>
								<li><a href="#login">Forgot Password</a></li>
							</ul>
							<div id="login">                    	
							<?php if($this->Session->check('error')){ ?>
								<div class="response-msg error ui-corner-all">
									<span>Error message</span>
									<?php echo $this->Session->read('error');?>
								</div>
								<?php unset($_SESSION['error']); ?>
								<?php } ?>
								<?php echo $this->Form->create('Admin',array("id"=>"AdminLogin",'url' =>'/admin/auths/forgot_password')); ?>
								<ul>
									<li>
										<label for="email" class="desc">Email:</label>
										<div>
											<input type="email" tabindex="1" class="field text full required" name="data[Member][email]" id="adminmail" />
										</div>
									</li>							
									<li class="buttons">
										<div>
											<input type="submit" class="ui-state-default ui-corner-all float-right ui-button" value="Submit" />
											<a href="<?php echo HTTP_ROOT.'admin';?>" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
										</div>
									</li>
								</ul>
								</form>
							</div>					
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>          
		</div>    
	<!-- Main -->
	</body>
</html>
