<?php  echo $this->Html->script('frontend/design/jquery.datetimepicker.js');?>
<?php  echo $this->Html->css('frontend/jquery.datetimepicker.css');?>
<?php //$idz = base64_encode(convert_uuencode($deal_info['Deal']['id']));?>
<!-- Supplier profile area page -->
<div class="supplier_container">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
		<div class="supplier_profile_container">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="right_tabs">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="widgets">
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<div class="col-lg-12  padding_0 col-md-12 col-sm-12 col-xs-12">
								<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 padding_0">
									<!--<img src="<?php //echo IMPATH.'deals/'.$deal_info['Deal']['image'].'&w=50&h=50'; ?>" class="img-responsive img-circle"/>-->
								</div>
								<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
									<div class="deal_heading_Re">
										<h1><?php //echo $deal_info['Deal']['name']; ?> </h1>
										
									</div>
								</div>
							</div>
						</div>
						<div class="under_line_div"></div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
						  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
							<div class="search_feature">
								<div class="input_round">
									<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
										<input type="text" placeholder="Search by Customer Name" name="custName" class="custName">
										<input type="hidden" id="hiddenname">
									</div>
								</div>
							</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
							<div class="search_feature">
								<div class="input_round">
									<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
										<input type="text" placeholder="Search by Customer E-mail" name="custEmail" class="custEmail">
										<input type="hidden" id="hiddenemail">
									</div>
								</div>
							</div>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 ">
							<div class="search_feature">
							<form id="searchbydate">
								<div class="input_round">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_0">
										<input type="hidden" id="hiddenstartdate">
										<input class="startdate" type="text" id="claim_timepicker_start" name="startdate" placeholder="Purchase date from" >
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_0">
										<input type="hidden" id="hiddenenddate">
										<input class="enddate" id="claim_timepicker_end" type="text" name="enddate" placeholder="Purchase date until" >
									</div>
								</div>
							</form>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<h5 class="search-butn">
							<button class="btn btn-info allsearch">
								search
								<span class="glyphicon glyphicon-search">
								</span>
							</button>
						</h5>
						</div>
						
						<div class="cnt_ttl">
							<h5><span>Total Item(<?php echo $deal_info['Deal']['item_count']; ?>) </span></h5>
							<h5><span>Total Amount: </span><span><?php echo $currency,$deal_info['Deal']['total_amount']; ?></span></h5>
							<h5><span>Supplier(<?php echo $mem_info['MemberMeta']['supplier%']; ?>%):</span> <span><?php echo $currency,($deal_info['Deal']['total_amount']*$mem_info['MemberMeta']['supplier%'])/100; ?></span></h5>
							<!--<h5><span>CyberCoupon(<?php echo $mem_info['MemberMeta']['cybercoupon%']; ?>%):</span><span> <?php echo $currency,($deal_info['Deal']['total_amount']*$mem_info['MemberMeta']['cybercoupon%'])/100; ?></span></h5>-->
						</div>
						<div class="render_reconcile">
								<?php echo $this->element('frontend/business/reconcile_element'); ?>
						</div>
					</div>
				

					
					</div> <!--end of right tab -->
				</div>
				</div>
			</div>
		</div>
<script>

jQuery(function(){
 jQuery('#claim_timepicker_start').datetimepicker({
  format:'j M Y',
  formatDate:'j M Y',
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('#claim_timepicker_end').val()?jQuery('#claim_timepicker_end').val():false
   })
  },
  timepicker:false
 });
 jQuery('#claim_timepicker_end').datetimepicker({
  format:'j M Y',
  formatDate:'j M Y',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#claim_timepicker_start').val()?jQuery('#claim_timepicker_start').val():false
	
	 })
  },
  timepicker:false
 });
});
$(document).ready(function(){
	$('.pagination').children().find('.current').addClass('pageactive');
	
	    /*--------- for ajax pagination--------------*/
	$(document).on('click',".pagination a",function(){
        var currentUrl=$(this).attr("href");
		var email = $('#hiddenemail').val();
		var name = $('#hiddenname').val();
		var startdate = $('#hiddenstartdate').val();
		var enddate = $('#hiddenenddate').val();
           $.ajax({
		        type:"POST",
		        url:currentUrl,
				data:{'email':email,'name':name,'startdate':startdate,'enddate':enddate},
		        success:function(result)
		        {
					$(".render_reconcile").html(result);
					$('.pagination').children().find('.current').addClass('pageactive');
           }
		     });
       return false;
    });
		
	/******************For Clicking Search Button Coded By Shivam Chauhan**************/	
	
	$(document).on('click','.allsearch',function()
	{
		var email = $('.custEmail').val();
		var name = $('.custName').val();
		var startdate = $('#claim_timepicker_start').val();
		var enddate = $('#claim_timepicker_end').val();
		$('#hiddenemail').val(email);
		$('#hiddenname').val(name);
		$('#hiddenstartdate').val(startdate);
		$('#hiddenenddate').val(enddate);
		$(".render_reconcile").css({'opacity':'0.2'});
		$.ajax({
				type:"POST",
				url : ajax_url+'Business/reconcile_all',
				data:{'email':email,'name':name,'startdate':startdate,'enddate':enddate},
				success:function(result)
				{   
					$(".render_reconcile").html(result);
					$('.pagination').children().find('.current').addClass('pageactive');
					$(".render_reconcile").css({'opacity':'1'});
				}
		});
		 
	});
	
	/******************After Entering Customer Email Coded By Shivam Chauhan**************/	
	
	$('.custEmail').keyup(function(e) {
		if (e.which == 13) {
			var email = $('.custEmail').val();
			var name = $('.custName').val();
			var startdate = $('#claim_timepicker_start').val();
			var enddate = $('#claim_timepicker_end').val();
			$('#hiddenemail').val(email);
			$('#hiddenname').val(name);
			$('#hiddenstartdate').val(startdate);
			$('#hiddenenddate').val(enddate);
			$(".render_reconcile").css({'opacity':'0.2'});
			$.ajax({
					type:"POST",
					url : ajax_url+'Business/reconcile_all',
					data:{'email':email,'name':name,'startdate':startdate,'enddate':enddate},
					success:function(result)
					{
						$(".render_reconcile").html(result);
						$('.pagination').children().find('.current').addClass('pageactive');
						$(".render_reconcile").css({'opacity':'1'});
					}
			});
		}
	});
	
	/****************** After Entering Customer Name Coded By Shivam Chauhan **************/	
	
	$('.custName').keyup(function(e) {
		if (e.which == 13) {
			var email = $('.custEmail').val();
			var name = $('.custName').val();
			var startdate = $('#claim_timepicker_start').val();
			var enddate = $('#claim_timepicker_end').val();
			$('#hiddenemail').val(email);
			$('#hiddenname').val(name);
			$('#hiddenstartdate').val(startdate);
			$('#hiddenenddate').val(enddate);
			$(".render_reconcile").css({'opacity':'0.2'});
			$.ajax({
					type:"POST",
					url : ajax_url+'Business/reconcile_all',
					data:{'email':email,'name':name,'startdate':startdate,'enddate':enddate},
					success:function(result)
					{
						$(".render_reconcile").html(result);
						$('.pagination').children().find('.current').addClass('pageactive');
						$(".render_reconcile").css({'opacity':'1'});
					}
			});
		}
	});
});
</script>