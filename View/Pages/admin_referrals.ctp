<?php  echo $this->Html->script('backend/development/tablesorter.js');?>
<script type="text/javascript">
function searching()
{
	var t = new Date().getTime();
	t =t.toString();
	$(".image_display").show();
	$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	$.ajax(
	{
		url:ajax_url+'admin/Pages/referrals',
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
<script type="text/javascript" >
$(document).ready(function(){
	$('.referral').click(function(){
		if($(this).is(':checked'))
		{
		
			$('.customer').attr('checked',false);
			$('.each_user').attr('checked',true);
			var total_checked=$("input.referral").val();
			$( ".showhtml" ).html( "<b style='font-size:14px;'>You are about to send "+total_checked +" emails, click to proceed .</b>" );
		} 	
		else
		{
			$('.referral').attr('checked',false);
			$('.each_user').attr('checked',false);
			var total_checked=0;
			$( ".showhtml" ).html( "<b style='font-size:14px;'>You are about to send "+total_checked +" emails, click to proceed .</b>" );
		}
	})
	$('.customer').click(function(){    
		if($(this).is(':checked'))
		{
			$('.referral').attr('checked',false);
			$('.each_user').attr('checked',false);
			var total_checked = $("input.customer").val();
			var referrer_check = $("input.referral").val();
			var customer_check = total_checked - referrer_check;
			$( ".showhtml" ).html( "<b style='font-size:14px;'>You are about to send "+customer_check +" emails, click to proceed .</b>" );
		} 	
		else
		{
			$('.customer').attr('checked',false);
			$('.each_user').attr('checked',false);
			var customer_check = 0;
			$( ".showhtml" ).html( "<b style='font-size:14px;'>You are about to send "+customer_check +" emails, click to proceed .</b>" );
		}
		
	}); 
	$('.bulk_user_email').click(function(){      
		//var total_checked=$("input:checked").not('.all_user').length;
		var total_checked=$("input.all_user:checked").length;
		if(total_checked>0)
		{
			$(".image_display_bulk").show();
			$(".image_display_bulk").children('img').attr('src',ajax_url+'img/backend/loader.gif');
			$.ajax({
					type:'POST',
					url:ajax_url+'admin/Pages/bulk_usermail',
					data:$('.all_user').serialize(),
					success:function(resp)
					{
	                $('.image_display_bulk').css('display','none');
	                //window.location=ajax_url+'admin/Pages/referrals';
		         }	      
	        })
        }
        else
        {
           alert('Please select atleast one user.')
        }  
	});	
});
</script>
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


</style>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        
			<div class="inner-page-title">
				<h2>Referrers</h2>
				<div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
					<span class="ui-icon ui-icon-lightbulb" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - View Referre</span>		
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
			<div class="id_cont admin_search member_search_management" style="margin-bottom:0px; float:left" >
			   
			<form  method="post" action="" id="search">
				<div class="search_input">	
					<label>First Name</label>
					<input id="input_name" type="text"  name="data[Member][name]" onkeyup = "return handle(event);"/>
            </div>
				<div class="search_input">	
					<label>Surname </label>
					<input id="input_name" type="text"  name="data[Member][surname]" onkeyup = "return handle(event);"/>
				</div>
				<div class="search_input">	
					<label>Email</label>
					<input id="input" type="text"  name="data[Member][email]" onkeyup = "return handle(event);"/>
				</div>
				
				<div class="submit_search_button" style="position:relative;float:left;">
					<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
					<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
					 <img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
					</div>
				</div>
			</form>			   
			   
			</div>
			<div>
				<div style="float:left;width: 100%;margin: 10px 0;	">
				<span style="font-size:20px; float:left; width:auto;"><b>Total Count&nbsp<?php echo count($referral_customers);?>/<?php echo $mem_custmersCount;?></b></span>
				<?php
				if($subadmin_type==1 ||@$modulepermissions['NewsLetter']['module_edit']==1) 
				{ 		  
				?>
				<Span style ="width: auto;margin-left:10px; float:left;">
					<div style="margin:5px 0 ; float:left;">
						<span style="width:80px; float:left;margin-left:50px;">All Referrers</span>
						<input type="checkbox" class="referral all_user" name="referrer" style="float:left; margin-right:10px;" value="<?php echo count($referral_customers);?>">
						<span style="width:80px; float:left;">All Customers</span>
						<input class="customer all_user" type="checkbox" name="customers" style="float:left;" value="<?php echo $mem_custmersCount;?>">						
						<span class="" style="width:80px; float:left;margin-left:50px;">
							<input type="button" style="width: auto;margin-left:0;" value="Send Email" class="sub-bttn bulk_user_email">
							
						</span>
						<div style="display:none;float:left;margin-left:50px; " class="image_display_bulk">
								<img style="margin-left:0px;margin-top: 13px;width: 56%; " src="http://localhost/cybercoupon/img/backend/loader.gif">
							</div>
				<?php 
				}
				?>
					</div>
				</Span>
				</div>
			</div>
			<div class="content-box content-box-header search_list" style="border:none;">
         	<?php
					echo $this->element('backend/Pages/referral_list');
         	?>
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>

