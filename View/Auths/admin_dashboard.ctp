<style>
.dash_style {
	float:left; 
	width:auto; 
	margin-top:2px; 
	font-size:13px; 
	color:#6A6A6A;
	margin-left:2px;
}
</style>
<div id="sub-nav">
	<div class="page-title">
		<h1>Dashboard</h1>
	</div>
	<div id="top-buttons"></div>
</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper" style="padding-right:10px; background-color:#F2F2F2; background-image:none;">	
			<?php if($this->Session->check('success')){ ?>
			<div class="response-msg success ui-corner-all">
			<span>Success message</span>
			<?php echo $this->Session->read('success');?>
			</div>
			<?php unset($_SESSION['success']); ?>
			<?php } ?>			
			<div class="dashboards_maininner">
				<div class="dash_boardtopcont">
					<h3>Dashboard</h3>
				</div>
				<div class="dashboard_mainleft">
					<dl class="dash_boardsleftinnerholders">
						<dd class="dash_boardinnerimgcontainer"> <?php //echo $this->HTML->image('backend/admin/'.$adminDetails['Member']['image'],array('width'=>140,'height'=>147)); ?>
							<img src="<?php echo IMPATH.'users/'.$adminDetails['Member']['image'].'&w=200&h=100';?>"/>									       
						</dd>
						<dt class="dashboard_namecontainer"></dt>
					</dl>
				</div>  
				<div class="dash_boardsrightcontainers" style="border:none;">
					<div class="dash_boardsrightinnercontainers">     
						<div class="dash_boardbottomcontainers">
							<div class="dash_boardimgcontainers">
								<dt class="dashboard_namecontainer">
									<?php if($subadmin_type==2) { ?>
										<h4>Company-User Details</h4>
									<?php  } else  { ?>
										<h4>Admin Details</h4>
									<?php } ?>
									<div style="float:left;"><h5 style="width:auto;">Name:</h5></div>
									<div class="dash_style"><?php echo ucwords($adminDetails['Member']['name'].' '.$adminDetails['Member']['surname']); ?></div>
									<div class="clear"></div>
									<div style="float:left;"><h5 style="width:auto;">Email:</h5></div><div class="dash_style"><?php echo $adminDetails['Member']['email']; ?></div>
									<div class="clear"></div>
									<?php if($subadmin_type==2 && !empty($adminDetails['Member']['phone'])) { ?>
									<div style="float:left;"><h5 style="width:auto;">Phone:</h5></div><div class="dash_style"><?php echo $adminDetails['Member']['phone']; ?></div>
									<?php }  ?>
								</dt>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<div class="content-box content-box-header" style="border:none;"></div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
<div class="clear"></div>