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
		width:300px;	
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
</style>

<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        <!--	<a href="<?php echo HTTP_ROOT ?>admin/Reports/addReport" class="ui-state-default ui-corner-all float-right ui-button">Add Deal</a> -->
        	<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:5px; margin-right:5px;" href="<?php echo HTTP_ROOT.'admin/Reports/payHistoryCsv'?>">Generate CSV</a>
			<div class="inner-page-title">
				<h2>Payment Release History</h2>    
				<!--<div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
					<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;">
					</span>
					<span style="font-size:10px; width:88px; float:left; border:0px;"> - View Report
					</span>
					<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;">
					</span>
					<span style="font-size:10px; width:88px; float:left; border:0px;"> - Edit Report
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
			<div class="id_cont admin_search  member_search_management" style="margin-bottom:0px; float:left" >                    
				<form  method="post" action="" id="search">
					<!--<div class="search_input"style="width:425px;">	
						<label>Company/Business name of the Supplier</label>
						<input id="input_name" type="text"  name="data[Member][name]"/>
					</div>
					<div class="search_input ">	
						<label>Email</label>
						<input id="input_name" type="text"  name="data[Member][email]"/>
					</div>-->
					
					<div class="search_input">
							<label>Payment From</label>
							<input id="from" class="field text" type="text"  name="data[PaymentRelease][payment_from]"  />
					</div>
					<div class="search_input">
							<label>Payment To</label>
							<input id="to" class="field text" type="text"  name="data[PaymentRelease][payment_to]"  />
					</div>
					<div class="submit_search_button" style="position:relative;float:left;">				  
						<input type="button" onclick="searching();"  value="Filter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
						<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
							<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
						</div>
					</div>
				</form>
			</div>    
			<div class="content-box content-box-header search_list" style="border:none;">
			<?php
				echo $this->element('backend/Reports/history_lists');
			?>
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
<script>
$(document).ready(function(){	
	var current_date=new Date();
	var year= current_date.getFullYear()+5;
	$('#from').datepicker({
		dateFormat:'d M yy',
		yearRange:'2000:'+year,
		changeMonth:true,
		changeYear:true,
		onClose:function(selectedDate){
			$('#to').datepicker("option","minDate",selectedDate);
		}
	});
	
	$('#to').datepicker({
		dateFormat:'d M yy',
		yearRange:'2000:'+year,
		changeMonth:true,
		changeYear:true,
		onClose:function(selectedDate){
			$('#from').datepicker("option","maxDate",selectedDate);
		}
	});
	
});

function searching() {
	    var t = new Date().getTime();
		t =t.toString();
		$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
		$.ajax({
			url:ajax_url+'admin/Reports/viewPayHistory',
			type:'post',
			data:$("#search").serialize(),
			success:function(resp) {			
				$('.image_display').css('display','none');
				$('.search_list').html(resp);
			}
		});
		return false;
	}
</script>
