<!DOCTYPE html>
<html lang="en">
	<head>
		<script type="text/javascript" >
		//if (window.location.protocol != "https:")
		//window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);
		</script>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
		$deal_view_action=$this->request->action;
		if($deal_view_action=='view')
		{
			$url=HTTP_ROOT.$this->request->url;
		?>
			<meta property="og:url" content="<?php echo $url;?>"/>		
			<meta property="og:title" content="Cyber Coupon is a wast store for online purchasing"/>
			<meta property="og:description" content=""/>
			<meta name="Description" content="Cybercoupon's mission is to become the world's commerce operating system. By connecting buyers and sellers through price and discovery, we have the opportunity to become one of the world's essential companies, a daily habit for our customers and merchant partners.">
			<meta property="og:image" content="<?php echo @$global_deal_uri_path; ?>" />
			
		<?php
		}
		else
		{
		?>
			<meta name="description" content="">
		<?php
		}
		?>		
		<meta name="author" >
		<title>:: Cyber Coupon ::</title>
		<!-- Bootstrap core CSS -->
		<!-- <link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		<link rel="stylesheet" href="css/slippry.css"> -->
		<?php 	echo $this->Html->css('frontend/bootstrap.css'); ?>
		<?php	echo $this->Html->css('frontend/custom.css'); ?>
		<?php 	echo $this->Html->css('frontend/slippry.css'); ?>
		<?php	echo $this->Html->css('frontend/developer.css'); ?>
		<?php	echo $this->Html->css('frontend/tab_panel.css'); ?>
		<?php 	echo $this->Html->script('jquery.min.js');?>
		<?php  	echo $this->Html->script('frontend/design/jquery.js');?>
		<?php 	echo $this->Html->script('frontend/design/slippry.min.js');?>
		<?php 	echo $this->Html->script('frontend/design/bootstrap.min.js'); ?> 
		<?php 	echo $this->Html->script('frontend/design/bootstrap.file-input.js'); ?> 
		<?php	echo $this->Html->script('frontend/development/validate.js'); ?>
		<?php	echo $this->Html->script('frontend/development/common.js'); ?>
		<?php 	echo $this->Html->script('frontend/development/customvalname.js'); ?>  
	</head>
	<body>
		<div class="main_wraper">
			<div class="container">
				<div class="middle_container">			
				<?php 
					echo $this->element('frontend/header');
					echo $content_for_layout;
					echo $this->element('frontend/footer');
				?>			
				</div>
			</div>
		</div>	
	</body>
</html>