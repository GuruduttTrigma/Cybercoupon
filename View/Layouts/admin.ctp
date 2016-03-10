<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<script type="text/javascript" >
    //if (window.location.protocol != "https:")
   // window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);
</script>
		<?php  echo $this->Html->meta('favicon.ico',$this->webroot.'img/frontend/favicon.ico',array('type' => 'icon')); ?>
		<meta http-equiv="X-UA-Compatible" content="IE=8" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<title>Admin Panel</title>
		<?php  echo $this->Html->script('jquery.min.js');?>
		<?php  echo $this->Html->script('backend/development/jquery-1.6.2.js');?>
		<?php echo  $this->Html->script('backend/development/validate.js'); ?>
		<?php echo  $this->Html->script('backend/development/common.js'); ?>
		<?php echo  $this->Html->script('backend/development/custom.js'); ?>
		<?php  echo $this->Html->script('backend/development/ui/ui.core.js');?>
		<?php  echo $this->Html->script('backend/development/ui/ui.widget.js');?>
		<?php  echo $this->Html->script('backend/development/ui/ui.mouse.js');?>
		<?php  echo $this->Html->script('backend/development/ui/ui.sortable.js');?>
		<?php  echo $this->Html->script('backend/development/ui/ui.dialog.js');?>
		<?php echo  $this->Html->script('backend/development/superfish.js'); ?>
		<?php  echo $this->Html->script('backend/development/tooltip.js');?>
		<?php  echo $this->Html->script('backend/development/cookie.js'); ?> 
		<?php  echo $this->Html->script('backend/development/tablesorter.js');?> 
		<?php  echo $this->Html->script('backend/tinymce/tiny_mce.js'); ?>
		<?php  echo $this->Html->script('backend/development/tablesorter-pager.js');?>		 
		<?php
			echo $this->Html->css('backend/admin.css');
			echo $this->Html->css('backend/smooth.css');
			echo $this->Html->css('backend/ui/ui.base.css');
			echo $this->Html->css('backend/themes/black_rose/ui.css','stylesheet',array('title'=>'style','media'=>'all'));
			echo $this->Html->css('backend/themes/black_rose/ui.css');	   
			echo $this->Html->css('backend/ui/ui.core.css');
		?>
	</head>
	<body class="home_admin_new">
		<!-- Main -->
		<div id="page_wrapper">
			<div id="page-header">
				<?php echo $this->element('backend/header'); ?>
			</div>			   
			<?php echo $content_for_layout ?>			   
			<div id="footer">
				<?php echo $this->element('backend/footer'); ?>
			</div>
			<div id="copyright">
				Powered by <a href="https://www.cybercouponsa.com" title="cybercouponsa.com">cybercouponsa.com</a>
			</div>			   
		</div>    
		<!-- Main -->
	</body>
</html>