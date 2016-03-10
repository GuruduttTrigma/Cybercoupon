<style>
.member_search_management input
{
	height:25px;
	width:200px;
}
.member_search_management select
{
	padding:5px;
	width:200px;
}
.admin_search
{
	min-height:75px;
}
.search_input
{
	float:left;
	/*width:350px;*/
	width:285px;
	
	margin-bottom:10px;
	text-align:right;
}
.sub-bttn { border: 1px solid #DDDDDD;
    color: #851A1A;
    cursor: pointer;
    float: left;
    font-size: 12.5px;
    font-weight: bold;
    height: 12px;
    margin-left: 13px;
    outline: medium none;
    padding: 7px 6px 6px;
    text-align: center;
    width: 61px;}
.lopa{
	 float: left;
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 20px;
    width: 100%;
}
</style>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
	      <!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:5px; margin-right:5px;" href="<?php echo HTTP_ROOT.'admin/Manages/generate_csv'?>">Generate CSV</a>-->
				<div class="inner-page-title">
					<h2>Order Detail Listing</h2>    
				 	<div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
						<!--<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - View Reconcile</span>
						<span class="ui-icon ui-icon-lightbulb" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:120px; float:left; border:0px;"> - S</span>		-->	
					</div>
					 <a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
               <span></span>
				</div>
            <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
				<?php } ?>	
            <div class="content-box content-box-header search_list" style="border:none;">
	            <?php
						echo $this->element('backend/Business/payment_deal_list');
	            ?>
				</div>
				<div class="clearfix"></div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
</div>
<div class="clear"></div>