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
				<a href="<?php echo HTTP_ROOT ?>admin/Manages/addfaq" class="ui-state-default ui-corner-all float-right ui-button">
					Add FAQs
				</a>
			<?php
			}
			?>
			<div class="inner-page-title">
				<h2>FAQs</h2>
                
				 <div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
				<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - View FAQ</span>
				<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - Edit FAQ</span>
				<span class="ui-icon ui-icon-circle-close" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:93px; float:left; border:0px;"> - Delete FAQ</span>
				
				
				</div>
                
               <span></span>
			</div>
				<div class="id_cont admin_search member_search_management" style="margin-bottom:1px;" >
				<form id="search">		          
         	<div class="search_input" style="position:relative;float:left;">	
				<label style="">Faq type </label>
						<select name="data[Faq][faq_type]" style="width:130px;">
							<option value="">Select</option>   
							<option>Customer</option>   
							<option>Supplier</option>   
						</select>
            </div>
            <div style="">
               	<input type="button" onclick="searching();" value="Enter" class="sub-bttn" style="margin-top:2px; width:75px; height:34px; border:1px solid #d5d5d5;" />
                		<div class="image_display" style="display:none;">
              				<img src="" style=""/>
                 		</div>
               </div>
            </form>
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
				echo $this->element('backend/Manages/faq_list');
            ?>
			</div>
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
