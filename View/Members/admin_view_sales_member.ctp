<?php  echo $this->Html->script('backend/development/ui.datepicker.js');?>		 
<script id="js">

$(function() {			
	$(".tablesorter-header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');
	$(".rmv_sort").children("span").removeClass('ui-icon');
	$(".rmv_sort").children("span").css("margin-top",'12px');
});

//jQuery.noConflict();
$(function() {
	var year = (new Date()).getFullYear()
	var current_date= new Date();
	$(".datepicker").datepicker({
		dateFormat:'dd M yy',
		yearRange:'1950:'+year,
		changeMonth: true, 
		changeYear: true,
		//maxDate:current_date
	
	});
})
$(function() {
	var year = (new Date()).getFullYear()
	var current_date= new Date();
	$(".buy_from").datepicker({
		dateFormat:'d M yy',
		yearRange:'2000:'+year,
		changeMonth: true, 
		changeYear: true,
		timepicker:false,
		//maxDate:current_date,
		onClose: function( selectedDate ) {
		   $( ".buy_to" ).datepicker( "option", "minDate", selectedDate );
	    }
	});
})
$(function() {
	var year = (new Date()).getFullYear() + 5;
	var current_date= new Date();
	$(".buy_to").datepicker({
		dateFormat:'d M yy',
		yearRange:'2000:'+year,
		changeMonth: true, 
		changeYear: true,
		timepicker:false,
		//minDate:current_date
		//maxDate:current_date
		onClose: function( selectedDate ) {
         $( ".buy_from" ).datepicker( "option", "maxDate", selectedDate );
     }
	});
})

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
.search_input
{
	float:left;
	/*width:350px;*/
	//width:271px;
	
	//margin-bottom:10px;
	//text-align:right;
}
.sub-bttn { border: 1px solid #DDDDDD;
    color: #851A1A;
    cursor: pointer;
    float: left;
    font-size: 12.5px;
    font-weight: bold;
    height: auto;
    margin-left: 13px;
    outline: medium none;
    padding: 7px 6px 6px;
    text-align: center;
    width: 61px;}
</style>
<script type="text/javascript">

function searching()
{
	var member_id = $('#member_id').val();
	var t = new Date().getTime();
	t =t.toString();
	$(".image_display_search").show();
	$(".image_display_search").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	$.ajax({
		url:ajax_url+'admin/Members/view_sales_member/'+member_id,
		type:'post',
		data:$("#search").serialize(),
		success:function(resp)
		{
			$('.image_display_search').css('display','none');
		   $('.search_list').html(resp);
		}
	});
	return false;
}

</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper"> 
   		<!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:1px; margin-left:10px;" href="<?php //echo HTTP_ROOT.'admin/Members/sales_generate_csv';?>">Generate CSV</a>-->		
			<div class="inner-page-title">
				<h2>
    				<?php echo $memberm['MemberMeta']['company_name']."' s Redeemed Deals"; ?>
    			</h2>   
				<a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
				<div style="float:left; margin-top:-16px; height:20px; margin-left:30%;">
					<!--
					<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - Edit Member</span>
					<span class="ui-icon ui-icon-circle-close" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:93px; float:left; border:0px;"> - Delete Member</span>
					<span class="ui-icon ui-icon-lightbulb" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:120px; float:left; border:0px;"> - View Details</span>
					-->
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
			<div class="response-msg success ui-corner-all send_success" style="display: none;">
				<span>Success message</span>
				OTP has been send successfully.
  			</div>	
			<div class="id_cont admin_search member_search_management" style="margin-bottom:15px; float:left" >                       
            <form  method="post" action="" id="search">
				<input id="member_id" type="hidden" value="<?php echo base64_encode(convert_uuencode($ids)); ?>" />
	           	<div class="search_input">	
						<label>Deal Name</label>
						<input id="input_name" type="text"  name="data[Deal][name]" onkeyup = "return handle(event);"/>
	            </div>					
				<div class="search_input">	
					<label>Purchased From</label>
					<input id="startDate" class="field text startdate buy_from " style=" border-radius: 3px;  padding:1px; height:25px;width:200px;"  type="text"  name="data[Deal][from]" onkeyup = "return handle(event);"/>
				</div>				
				<div class="search_input">	
					<label>Purchased Until</label>
					<input id="endDate" class="field text endDate buy_to " type="text" style=" border-radius: 3px;  padding:1px; height:25px;width:200px;" name="data[Deal][to]" onkeyup = "return handle(event);"/>
				</div>               
	            <div class="submit_search_button" style="position:relative;float:left;">
					<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:29px;float: right;" />
					<div class="image_display_search" style="display:none;left: 40%;position: absolute;top: -62px; ">
						<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
					</div>
	            </div>
            </form>
            </div>            
            <div class="content-box content-box-header search_list" style="border:none;">
            <?php
				echo $this->element('backend/Members/view_sales_members_list');
            ?>
				</div>
				<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>