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
	width:270px;
	
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
</style>
<script type="text/javascript">
function searching()
{
	$(".image_display").show();
	$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	$.ajax({
		url:ajax_url+'admin/Manages/claim',
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
$(document).ready(function(){
	$('.paidamount').click(function(){
		var cnfr = confirm('Are you sure want to make payment to all deal?');
		var dealerId = $('#supId').val();
		$(this).attr('disabled','disabled');

		$(".search_list").css({'opacity':'0.1'});
		if (cnfr)
		{
			$.ajax({
				url:ajax_url+'admin/Business/update_status_release_payment/'+dealerId,
				type:'post',
				
				success:function(resp)
				{
					$(".search_list").css({'opacity':'1'});
					window.location.href = ajax_url+'admin/Business/reconcile_deal/'+dealerId;
					//$('.image_display').css('display','none');
					//$('.search_list').html(resp);
				}
			});
		}
	})
})
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
	      <!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:5px; margin-right:5px;" href="<?php echo HTTP_ROOT.'admin/Manages/generate_csv'?>">Generate CSV</a>-->
				<div class="inner-page-title">
					<h2>Deal Listing</h2>    
				 	<div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
						<!--<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - View Reconcile</span>
						<span class="ui-icon ui-icon-lightbulb" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:120px; float:left; border:0px;"> - S</span>		-->	
					</div>
               <span></span>
				</div>
            <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
				<?php } ?>	
				<!--<div class="id_cont admin_search  member_search_management" style="margin-bottom:0px; float:left" >
	            <form  method="post" action="" id="search">
						<div class="search_input ">	
							<label>Deal Name</label>
							<input id="input_name" type="text"  name="data[Deal][name]"/>
		    			</div>
						
		    			<div class="submit_search_button" style="position:relative;float:left;">
							<input type="button" onclick="searching();"  value="Filter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
							<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
								<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
							</div>
		            </div>
	            </form>
            </div>-->
			<input type="hidden" value="<?php echo  base64_encode(convert_uuencode($supplier_id)); ?>" id="supId" />
            <div class="content-box content-box-header search_list" style="border:none;">
	            <?php
						echo $this->element('backend/Business/reconcile_deal');
	            ?>
				</div>
				<div class="clearfix"></div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
</div>
<div class="clear"></div>

