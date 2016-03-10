<?php  echo $this->Html->script('backend/development/ui.datepicker.js');?>		
<script id="js">
	
	$(function() {
		var year = (new Date()).getFullYear()
		var current_date= new Date();
		$(".StartDate").datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			//maxDate:current_date,
			onClose: function( selectedDate ) {
			   $( ".EndDate" ).datepicker( "option", "minDate", selectedDate );
		    }
		});
	})
	$(function() {
		var year = (new Date()).getFullYear() + 5;
		var current_date= new Date();
		$(".EndDate").datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			//minDate:current_date
			//maxDate:current_date
			onClose: function( selectedDate ) {
            $( ".StartDate" ).datepicker( "option", "maxDate", selectedDate );
        }
		});
	})
	

</script> 
<style>
	.dispatch_deal_tbl{
	border-top: 0 none !important;
    box-shadow: 1px 1px 2px #666;
    float: left;
    margin: 0 0 8px !important;
    width: 100%;	
	}
	.dispatch_deal_tbl a{
	line-height: 32px;
    margin: 0 !important;
    min-height: 30px;
    padding: 5px 0;
    width: 100%;
	}
	.dispatch_deal_detail{
	width: 100%;	
	}
	.admin_search {
    min-height: 54px;
}
.search_input
{
	float:left;
	width:250px;
	margin-bottom:10px;
	text-align:left;
}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$(".dispached").live('click',function(){
    		$(this).parent().next().toggle();
  		});
  		/* $("#view_deals").click(function(){
    		$("#div_view_deals").toggle();
  		}); */
  		
      $('.dispatch_deal_tbl').live('click',function(){
				$('.dispatch_deal_detail').not($(this).next('.sale_deal_detail')).slideUp(500);
				$(this).next('.dispatch_deal_detail').slideDown(500);
		});  		
  		
  	});
  	
</script>
<script type="text/javascript">
function searching()
{
   $(".image_display").show();
	$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	$.ajax({
		url:ajax_url+'admin/NewsLetters/archieve_newsletters',
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
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">        
			<div class="inner-page-title">
				<h2>Archived Newsletters</h2>
            <span></span>
           		<div class="id_cont admin_search  member_search_management" style="" >
               	<form  method="post" action="" id="search">
               	  <div class="search_input">	
																		<label>Location</label>
															    <select name="data[location]">
																			<option value="">All</option>
																			<?php 
																			foreach($location as $loc_key=>$loc_value)
																			{
																			?>
																				<option value="<?php echo $loc_key;?>"><?php echo $loc_value;?></option>
																		<?php
																		 }
																		 ?>
																		</select>
															 </div>
					            <div class="search_input">	
																		<label>Start</label>
																		<input style="margin-left:0px;margin-top: 0px;width: ;height: 21px; " class="field text StartDate datepicker" type="text"  name="data[StartDate]" onkeyup = "return handle(event);"/>
															 </div>
																	
																<div class="search_input">	
																	<label style="margin-left:16px" >End</label>
																	<input class="field text EndDate datepicker" type="text"  name="data[EndDate]" style="margin-left:0px;margin-top: 0px;width: ;height: 21px; "onkeyup = "return handle(event);"/>
																</div>
																<div class="submit_search_button" style="position:relative;float:left;">
													 				<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
																		<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
														 					<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
																		</div>
	                	</div>
            		</form>
            	</div>
			</div>
         <?php if($this->Session->check('success')){ ?>
			<div class="response-msg success ui-corner-all">
				<span>Success message</span>
				<?php echo $this->Session->read('success');?>
			</div>
			<?php
			   unset($_SESSION['success']);
			 }
			 else 
			 {
			 	if($this->Session->check('error')){
			 	?>
			 	  <div class="response-msg error ui-corner-all">
						<span>Error message</span>
						<?php echo $this->Session->read('error');?>
				  </div>
			<?php
			   unset($_SESSION['error']);
			   }
			 }
			 
			 ?>
			<div class="search_list">   
				<?php echo $this->element('backend/NewsLetter/dispatched_newsletter_list'); ?>
			</div>				
				<div class="clearfix"></div>
				<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
