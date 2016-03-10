<style>
.member_search_management input
{
	height:25px;
	width:200px;
}
.member_search_management select
{
	padding:5px;
	width:90px;
}
.admin_search
{
	min-height:75px;
}
.search_input
{
	float:left;
	/*width:350px;*/
	width:250px;
	
	margin-bottom:10px;
	text-align:left;
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
	$(".image_display").children('img').attr('src',ajax_url+'img/adminImg/loading.gif');
	 $.ajax({
		url:ajax_url+'admin/manages/faqs',
		type:'post',
		data:$("#search").serialize(),
		success:function(resp)
		{
		$('.search_list').html(resp);
		$(".image_display").hide();
		}
		
	}); 
	return false;
}
function clear_filter()
{
	$(".image_display").show();
	$(".image_display").children('img').attr('src',ajax_url+'img/adminImg/loading.gif');
	 $.ajax({
		url:ajax_url+'admin/manages/clear_manages_filter',
		type:'post',
		data:'',
		success:function(resp)
		{
			var resp=$.trim(resp);
			if(resp=='done')
			{
				window.location.href=ajax_url+"admin/manages/manages";
			}
		}
		
	}); 
	return false;
}
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<?php
                if($subadmin_type==1||@$modulepermissions['Content Management']['module_edit']==1) 
			{ 		  
			?>
				<?php				
					$memberid = base64_encode(convert_uuencode($referral_idz));
				?>
				<a style="margin-right:10px;" class="ui-state-default ui-corner-all float-right ui-button" href="<?php echo HTTP_ROOT.'admin/Pages/referrals';?>">Back</a>
				<?php if($subadmin_type==1 || @$modulepermissions['Referrals']['module_edit']==1 )  { ?> 
				<a title="Add Referral" class="ui-state-default ui-corner-all float-right ui-button" href="<?php echo HTTP_ROOT.'admin/Pages/addReferred/'.$memberid; ?>" style="" >Click Here to Re-Link </a>
				<?php } ?>				
				<span></span>
			<?php
			}
			?>
			<div class="inner-page-title">
				<h2>Referral customers list</h2>            
               <span></span>
			</div>
        <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
			<?php } ?>	
            
            
            <div class="content-box content-box-header search_list sales_total_pagination" style="border:none;">
            <?php
				echo $this->element('backend/Pages/view_reffer_list');
            ?>
			</div>
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
