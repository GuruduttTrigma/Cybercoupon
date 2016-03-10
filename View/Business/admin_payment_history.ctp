<style>
	.member_search_management input {
		height:25px;
		width:200px;
	}
	.member_search_management select {
		padding:5px;
		width:200px;
	}
	.admin_search {
		min-height:75px;
	}
	.search_input {
		float:left;
		width:270px;	
		margin-bottom:10px;
		text-align:right;
	}
	.sub-bttn { 
		border: 1px solid #DDDDDD;
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
		width: 61px;
	}
	.pop_center2 {
    background-color: #fff;
    border-bottom: 1px solid #d9d9d9;
    float: left;
    height: auto;
    padding: 9px 17px;
    text-align: left;
    width: 474px;
   }
.pop_center3 {
    background-color: #ececec;
    border-top: 1px solid #fff;
    float: left;
    padding: 15px 17px;
    text-align: left;
    width: 474px;
}

.pop_center1 {
    float: left;
    height: auto;
    margin: 0;
    padding: 0;
    text-align: center;
}
.mask {
    background-image: url("../../../img/backend/pop_base.png");
    float: left;
    left: 0;
    margin: 0 auto;
    min-height: 100%;
    position: fixed;
    text-align: center;
    top: 0;
    width: 100%;
    z-index: 10001;
}
.log_block_width {
    position: absolute;
    right: 566px;
    top: 150px;
    z-index: 2147483647;
}
.pop_inner {
    margin: auto;
    width: 522px;
}
a.pop_cerrar {
    float: right;
    height: auto;
    padding: 0;
    text-align: left;
    width: auto;
}
.pop-up-heading{
float:left;
width:100%;
background:#ECECEC;
text-align:center;
font-size:18px;
color:#006cad;
margin-bottom:25px;
}
.div_input{
float:none;width:100%;max-width:200px;margin:0 auto;
}
.yes-div{
   float: left;
    text-align: center;
    width: 50%;

}
.mail-div{
float:left;
width:100%;
text-align:center;
margin-top:15px;
display:none;
}
.form-box{
float:left;
width:100%;
 margin-bottom: 5px;
}
#loader {
	display: inline-block;
    margin-top: -27px;
    width: auto;
	visibility:hidden;
}
#success_msg {
color:green;
display: inline-block;
margin-top: 5px;
width: auto;
visibility:hidden;
}
#success_msg img {
    float: left;
    margin-right: 3px;
    margin-top: -2px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$('.sendMail').click(function() {
		
		$("#msg_popup").show();
		$('#success_msg').css('visibility','hidden');
		var $div = jQuery('<div />').appendTo('body');
		$div.attr('class', 'mask');
		jQuery(".mask").show();
	});	
	$(".form-radio").change(function (){
		if ($(this).attr("checked")) {
			$(".mail-div").slideDown();
			$("#randomName").slideUp();
			$("#randomName2").slideDown();
			$('.form-radio-button').attr('checked', false);
			var email = $('#custEmail').val();
			var name = $('#customerName').val();
			$('#email').val(email);
			$('#custName').val(name);
		}
		else { 
			$(".mail-div").slideUp();
		}
	});
	$(".form-radio-button").change(function (){
		if ($(this).attr("checked")) {
			$('.form-radio').attr('checked', false);
			$(".mail-div").slideDown();
			$('#email').val('');
			$('#email').attr('readonly',false);
			$('#otherEmail').val('');
			$('#custName').val('');
			$('#randomName').slideDown();
			$('#randomName2').slideUp();
		}
		else { 
			$(".mail-div").slideUp();
		}
	});
	$(".cancl").click(function (){
			
		$("#msg_popup").hide();
		$('.mask').remove();
		$('.form-radio').attr('checked', false);
		$('.form-radio-button').attr('checked', false);
		$('.mail-div').css('display', 'none');
		document.getElementById("pdf_form").reset();
	});
	
	$("#pdf_form").validate();

});
</script>
<?php 	//pr($mem_info); ?>
<div class="pop_inner log_block_width" id="msg_popup" style="display:none;">
	    <div class="pop_center1"><img src="<?php echo HTTP_ROOT;?>img/top_pop.png" width="522" height="11" /></div>
		<form  id="pdf_form" name="pdf_form" enctype="multipart/form-data" method="post"   action ="<?php echo HTTP_ROOT;?>/admin/Business/sendPdfEmail">
			<div class="pop_center2" style="width: 488px">
				<span class="pop_c2_a"> <span id="sender_name"></span></span>
				<a href="javascript: void(0);" class="pop_cerrar cancl"><img src="<?php echo HTTP_ROOT;?>img/cerrar.png" width="16" height="15" /></a>
			</div>
			<input type = "hidden" value = "<?php if(!empty($mem_info['Member']['email'])): echo $mem_info['Member']['email'];endif ;?>" id ="custEmail">
			<input type = "hidden" value = "<?php if(!empty($mem_info['Member']['name'])): echo $mem_info['Member']['name'];endif ;?>" id ="customerName">
			<div class="pop_center3" style="width: 488px;">
				
				<div class="pop-up-heading">
					<h1>Send Email to Supplier</h1>
				</div>
				<div class="div_input">
					<div class="yes-div">
						<input type="CHECKBOX" name="yes" class="form-radio" value="yes">
						<label>
							Supplier's own Email
						</label>
					</div>
					<div class="yes-div">
						<input type="CHECKBOX" name="no" class="form-radio-button" value="no">
						<label>
							Other Email
						</label>
					</div>
					<div class="mail-div">
						<div class="form-box">
							<label class="pop_cen5_c" style="float:left;text-align: left;width: 100%;">Email:</label>
							<input style="float: left;width: 100%;" name="email" id="email" value="" type="email" readonly="readonly" class="pop_cen5_d required email" />
						</div>
						<div class="form-box" id = "randomName" style = "display:none;">
							<label class="pop_cen5_c" style="float:left;text-align: left;width: 100%;">Name:</label>
							<input style="float: left;width: 100%;" name="supplierName" id="custName" value="" type="text" class="pop_cen5_d required" />
						</div>
						<div class="form-box" id = "randomName2" style = "display:none;">
							<label class="pop_cen5_c" style="float:left;text-align: left;width: 100%;">Other Email:</label>
							<input style="float: left;width: 100%;" name="otherEmail" id="otherEmail" value="" type="text" class="pop_cen5_d email" />
						</div>
						<div class="form-box">
							<label class="pop_cen5_c" style="float:left;text-align: left;width: 100%;">Browse PDF:</label>
							<input  name="paymenthistory_pdf" id="pdf" value="" type="file" class="pop_cen5_d required" />
						</div>
						<div class="form-box" style="margin-top:10px;text-align:left;">
							<input type="submit" id="submit" name="submit"  class="send" value="Send">
						</div>
						<span id = "loader"><img src= "<?php echo HTTP_ROOT;?>img/backend/loader.gif"></span>
						
					</div>
				</div>
				
			</div>
		</form>
	</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        <!--	<a href="<?php echo HTTP_ROOT ?>admin/Reports/addReport" class="ui-state-default ui-corner-all float-right ui-button">Add Deal</a>
        	<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:5px; margin-right:5px;" href="<?php echo HTTP_ROOT.'admin/Reports/generate_csv'?>">Generate CSV</a> -->
			<div class="inner-page-title">
				<h2>Payment History for <?php echo $mem_info['MemberMeta']['company_name']; ?></h2>    
				<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;" onclick="history.go(-1)" href="javascript:void(0)">Back</a>
				<!--<div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
					<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;">
					</span>
					<span style="font-size:10px; width:150px; float:left; border:0px;"> - View Detail Payment History
					</span>
							
					
					
				</div>-->
				<span></span>
			</div>
	<!--  ******************   Success 	Message   ************     -->
			<?php if($this->Session->check('success')){ ?>
			<div class="response-msg success ui-corner-all">
				<span>Success message</span>
				<?php echo $this->Session->read('success');?>
			</div>
			<?php unset($_SESSION['success']); ?>
			<?php } ?>
	<!-- ******************* Searching ************************   -->
		<!--	<div class="id_cont admin_search  member_search_management" style="margin-bottom:0px; float:left" >                    
				<form  method="post" action="" id="search">
					<div class="search_input ">	
						<label>Name</label>
						<input id="input_name" type="text"  name="data[Member][name]"/>
					</div>
					<div class="search_input ">	
						<label>Email</label>
						<input id="input_name" type="text"  name="data[Member][email]"/>
					</div>
					           
					<div class="submit_search_button" style="position:relative;float:left;">				  
						<input type="button" onclick="searching();"  value="Filter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
						<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
							<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
						</div>
					</div>
				</form>
			</div>            -->
			<div class="content-box content-box-header search_list" style="border:none;">
			<?php
				echo $this->element('backend/Business/payment_history_list');
			?>
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>

