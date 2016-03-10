<?php
	if (!empty($pay_his)) {
		$payupto = date('d M Y',strtotime($pay_his['PaymentRelease']['payment_date']));
	} else {
		$payupto = "";
	}
	
?>
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
		height: 50px;
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
.lopa{
	 float: left;
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 20px;
    width: 100%;
}

</style>
<script type="text/javascript">
	function searching() {
	    var t = new Date().getTime();
		t =t.toString();
		$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
		$.ajax({
			url:ajax_url+'admin/Reports/reports',
			type:'post',
			data:$("#search").serialize(),
			success:function(resp) {
				$('.image_display').css('display','none');
				$('.search_list').html(resp);
			}
		});
		return false;
	}
	
$(function() {
	var year = (new Date()).getFullYear()
	var current_date= new Date();
	var upto = '<?php echo $payupto; ?>';
	
	$( ".datepicker" ).datepicker({
		dateFormat:'dd M yy',
		yearRange:'2013:'+year,
		changeMonth: true, 
		changeYear: true,
		maxDate:current_date,
		<?php if($payupto!="") { ?>
		minDate: upto
		<?php } ?>
	})
	$('.paidamount').live('click',function(){
		var cnfr = confirm('Are you sure want to make payment to all deal?');
		var col_id = new Array();
		$('input[type=checkbox]').not('.all_member').each(function() {
			if ($(this).attr("checked")) {
				col_id.push($(this).val());
		   }
		});
		$(this).attr('disabled','disabled');
		//$(".search_list").css({'opacity':'0.1'});
		if (cnfr)
		{
			$.ajax({
				url:ajax_url+'admin/Business/update_status_reconcile_payment',
				type:'post',
				data : {'each_user':col_id},
				success:function(resp)
				{	alert(resp);
					$(".search_list").css({'opacity':'1'});
					window.location.href = ajax_url+'admin/Reports/reports';
				}
			});
		}
	});
	
	$('.csvv').live('click',function(){
			$.ajax({
				url:ajax_url+'admin/Reports/generate_csv_check',
				type:'post',
				success:function(resp)
				{
				   if($.trim(resp)=='success')
				   {
				   	$('.paidamount_btn').addClass('paidamount');
                  $('.paidamount_btn').css({'opacity':1});
					   window.location=ajax_url+'admin/Reports/generate_csv';
					}
					else
					{
						alert('No data available')
					}
				}
			});
	});
	
})
	
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:5px; margin-right:5px;" href="<?php echo HTTP_ROOT.'admin/Reports/generate_csv'?>">Generate CSV</a>
			<a href="javascript:void(0)" class="ui-state-default ui-corner-all float-right ui-button paidamount" style="margin-top:5px; margin-right:5px;">Release Payment</a>
			-->			
			<div class="inner-page-title">
				<h2>Supplier Payment Report 
				<label>
						<img title="Displays overall amounts for all suppliers within the date range selected" rel="tooltip" src="<?php echo HTTP_ROOT.'img/frontend/tooltip.png'; ?>" style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width: 10px;">
					</label></h2>    
				
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
			<span class="lopa">
				<h1 style="font-size:14px;" >
					<?php if($payupto!="") { ?>
						 Your last payment release was on <?php echo $payupto; ?>.
					<?php } else { ?>
						No payment released yet.
					<?php } ?>
					
				</h1>
			</span>
	<!-- ******************* Searching ************************   -->
			<div class="id_cont admin_search  member_search_management" style="margin-bottom:0px; float:left" >                    
				
					
					<!--<div class="submit_search_button" style="position:relative;float:left;">				  
						<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
						<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
							<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
						</div>
					</div>
					<?php echo HTTP_ROOT.'admin/Reports/generate_csv'?>
					-->
					<!--<div class="search_input">
						<a href="javascript:void(0)" class="ui-state-default ui-corner-all float-right ui-button paidamount_btn" style="margin-top:5px; margin-left:35px;opacity:0.5;">Release Payment</a>
						<a class="ui-state-default ui-corner-all float-right ui-button csvv" style="margin-top:5px; margin-left:5px;" href="javascript:void(0);">Generate CSV</a>
						
					</div>-->
					<form  method="post" action="" id="search">
						<div class="search_input" style="clear:both;width: 300px;">	
								<label>Pay up to </label>
								<input id="Datepic" style="height: 45%;margin-top: 4px; " class="field text datepicker" type="text"  name="data[OrderDealRelation][payment_on]" readonly="readonly"  onkeyup="return handle(event);"/>
						</div>
						<div class="submit_search_button" style="position:relative;float:left;">				  
								<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
						</div>
						<div class="search_input">
							<a href="javascript:void(0)" class="ui-state-default ui-corner-all float-right ui-button paidamount_btn" style="margin-top:5px; margin-left:35px;opacity:0.5;">Release Payment</a>
							<a class="ui-state-default ui-corner-all float-right ui-button csvv" style="margin-top:5px; margin-left:5px;" href="javascript:void(0);">Generate CSV</a>
							<div class="image_display" style="display:none;left: 40%;position: absolute;top: -30px; ">
								<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
							</div>
						</div>
						<div class="" style="width:100%;position:relative;margin-left:10px; ">
							<div class="search_input" style="width:325px;text-align: inherit;margin-top:15px;">	
								<label>Supplier's Name</label>
								<input id="input_name" type="text"  name="data[Member][name]" onkeyup="return handle(event);"/>
							</div>
							<div class="search_input " style="width:325px; text-align: inherit;margin-top:15px;">	
								<label>Supplier's Email</label>
								<input id="input_name" type="text"  name="data[Member][email]" onkeyup="return handle(event);"/>
							</div>
							<div class="submit_search_button" style="position:relative;float:left;margin-top:15px;">				  
								<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
							</div>
						</div>
					</form>
			</div>            
			<div class="content-box content-box-header search_list" style="border:none;">
			<?php
				echo $this->element('backend/Reports/reports_list');
			?>
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>

