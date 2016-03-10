<script>
function searching()
{
	$.ajax({
		url:ajax_url+'admin/Orders/order',
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
<script>
$(document).ready(function(){
	$('.order_status').live('change',function(){
		$(this).next().show();
	});
	$('.rhl').live('click',function(){
		var order_id = $(this).prev().prev().val();
		var order_status_val = $(this).prev().val();
		$.ajax({
			type:"POST",
			url:ajax_url+'admin/Orders/order_status',
			data:{order_status_val:order_status_val,order_id:order_id},
			success: function(resp){
				window.location.href = ajax_url+'admin/Orders/order';
			}
		});
	
	});
});
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
	height:16px;
	width:198px;
}
.member_search_management select
{
	padding:5px;
	width:200px;
}
.submit_search_button
{
	float:left;
	margin-left:12px;
	margin-top: 2px;
    width: 0px;
}

.reviewer_search_management label
{
	font-weight:bold;
}

</style>

<?php  //echo $this->Html->script('newadmin/sidebar_position.js');?>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2 style="float:left;">Orders Details </h2>
  <div style="width:335px; height:20px; margin-left:151px; padding-top:6px;">
   	<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span>
					<span style="font-size:10px; width:103px; float:left; border:0px;"> - view Orders</span>
              	<!--<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:105px; float:left; border:0px;"> - Edit Example</span>-->
              	<span class="ui-icon ui-icon-circle-close" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:116px; float:left; border:0px;"> - Delete Orders</span>
		</div>
				<!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-21px; margin-right:10px;" href="<?php echo HTTP_ROOT.'admin/Orders/generate_csv'?>">Generate CSV</a>-->
            <span></span>
			</div>
			<?php if($this->Session->check('success')){ ?>
			<div class="response-msg success ui-corner-all">
				<span>Success message</span>
				<?php echo $this->Session->read('success'); ?>
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
			<div class="id_cont admin_search member_search_management" style="margin-bottom:0px; float:left" >            
         	<form  method="post" action="" id="search" >
            	<div class="search_input">	
						<label>Order Number</label>
						<input id="order_no" class="field text" type="text"  name="data[Order][order_no]" onkeyup = "return handle(event);"/>
               </div>
					<div class="search_input">	
						<label>Deal Name</label>
						<input id="deal_name" class="field text" type="text"  name="data[Deal][name]" onkeyup = "return handle(event);"/>
               </div>
               <div class="search_input">	
						<label>Voucher Number</label>
						<input id="order_no" class="field text" type="text"  name="data[OrderDealRelation][voucher_code]" onkeyup = "return handle(event);"/>
               </div>
					 <div class="search_input">	
						<label>Transaction Id</label>
						<input id="transaction_id" class="field text" type="text"  name="data[Order][transaction_id]" onkeyup = "return handle(event);"/>
               </div>
               <div class="search_input">	
						<label>Customer Email</label>
						<input id="order_no" class="field text" type="text"  name="data[Member][email]" onkeyup = "return handle(event);"/>
               </div>
            	<!--<div class="search_input">	
						<label>Deal Name</label>
						<input id="order_user" class="field text" type="text"  name="data[Order][name]"/>
					</div>-->
					<div class="search_input " style="position:relative;float:left;">
						<input type="button" onclick="searching();" value="Enter" class="sub-bttn" style="width:75px; height:30px; border:1px solid #d5d5d5;" />
						<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
						<!--<img src="" style="margin-left:59px;margin-top: 60px;"/>-->
						</div>
					</div>
            </form>
			</div> 
			<div class="content-box content-box-header search_list" style="border:none;">
            <!--............................-->				
         <?php echo $this->element('backend/Orders/order_list');?>
            <!--............................-->
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>