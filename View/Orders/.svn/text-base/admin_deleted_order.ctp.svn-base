<script>
function searching()
{
	$.ajax({
		url:ajax_url+'admin/Members/reward_centres',
		type:'POST',
		data:$("#search").serialize(),
		success:function(resp)
		{
			$('.search_list').html(resp);
		}
	});
	return false;
}

</script>
<style type="text/css">
.search_input
{
	float:left;
	padding:5px;
	margin-bottom:10px;
	text-align:right;
}
.member_search_management input
{
	height:22px;
	width:200px;
}
.member_search_management select
{
	padding:5px;
	width:200px;
}
.submit_search_button
{
	float:left;
	margin-left:100px;
	margin-top: 5px;
    width: 0px;
}

.reviewer_search_management label
{
	font-weight:bold;
}

</style>
<script type="text/javascript">
function searching()
{
	$(".image_display").show();
	$(".image_display").children('img').attr('src',ajax_url+'img/adminImg/loading.gif');
	$.ajax({
		url:ajax_url+'admin/Orders/deleted_order',
		type:'post',
		data:$("#search").serialize(),
		success:function(resp)
		{
			$('.image_display').css('display','none');
			$('.search_list').html(resp);
		}
	});
	return false;
}

</script>

<?php  //echo $this->Html->script('newadmin/sidebar_position.js');?>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2 style="float:left;">List Of Cancelled Orders</h2>
                <div style="width:335px; height:20px; margin-left:251px; padding-top:6px;">
                <span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span>
				<span style="font-size:10px; width:103px; float:left; border:0px;"> - view Orders</span>
                <!--<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:105px; float:left; border:0px;"> - Edit Example</span>-->
                
				</div>
				<!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-21px; margin-right:10px;" href="<?php echo HTTP_ROOT.'admin/Orders/generate_csv1'?>">Generate CSV</a>-->
               <span></span>
			</div>
			<?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']);
						//CakeSession::delete('success'); ?>
			<?php } ?>
			<?php if($this->Session->check('error')){ ?>
				<div class="response-msg error ui-corner-all">
					<span>Error message</span>
					<?php echo $this->Session->read('error');?>
				</div>
				<?php unset($_SESSION['error']); ?>
			<?php } ?> 
			
			<div class="id_cont admin_search member_search_management" style="margin-bottom:15px; float:left" >
                       
            <form  method="post" action="" id="search">
                <div class="search_input">	
					<label>Order Number</label>
					<input id="order_no" type="text"  name="data[Order][order_no]" onkeyup = "return handle(event);"/>
                </div>
				<div class="search_input">	
					<label>Name</label>
					<input id="order_user" type="text"  name="data[Order][name]" onkeyup = "return handle(event);"/>
                </div>
				<div class="submit_search_button" style="position:relative;float:left;">
					<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:26px;float: right;" />
					
					<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
						<img src="" style="margin-left:59px;margin-top: 60px;"/>
					</div>
                </div>
            </form>
            </div>
			 
			<div class="content-box content-box-header search_list" style="border:none;">
            <!--............................-->				
            <?php echo $this->element('backend/Orders/deleted_order_list');?>
            <!--............................-->
			</div>
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>