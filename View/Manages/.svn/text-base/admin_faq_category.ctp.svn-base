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
	width:295px;
	
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
	$(".image_display").children('img').attr('src',ajax_url+'img/adminImg/loading.gif');
	 $.ajax({
		url:ajax_url+'admin/Members/members',
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
		url:ajax_url+'admin/Members/clear_member_filter',
		type:'post',
		data:'',
		success:function(resp)
		{
			var resp=$.trim(resp);
			if(resp=='done')
			{
				window.location.href=ajax_url+"admin/Members/members";
			}
		}
		
	}); 
	return false;
}
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="<?php echo HTTP_ROOT ?>admin/Manages/add_faq_category" class="ui-state-default ui-corner-all float-right ui-button">Add FAQ Category</a>
			<div class="inner-page-title">
				<h2>FAQ Categories</h2>
                
				 <div style="float:left; margin-top:-16px; height:20px; margin-left:285px;">
				<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:100px; float:left; border:0px;"> - View FAQ Category</span>
				<span class="ui-icon ui-icon-pencil" style="float:left; margin-left:12px; padding:0px; border:none;"></span><span style="font-size:10px; width:94px;  float:left; border:0px;"> - Edit FAQ Category</span>
				<span class="ui-icon ui-icon-circle-close" style="float:left; margin-left:12px; padding:0px; border:none;"></span><span style="font-size:10px; width:115px; float:left; border:0px;"> - Delete FAQ Category</span>
				
				
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
            
            
            <div class="content-box content-box-header search_list" style="border:none;">
            <?php
				echo $this->element('backend/Manages/faq_category_list');
            ?>
			</div>
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
