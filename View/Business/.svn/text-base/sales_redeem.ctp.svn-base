<?php  echo $this->Html->script('frontend/design/jquery.datetimepicker.js');?>
<?php  echo $this->Html->css('frontend/jquery.datetimepicker.css');?>
<!-- Supplier profile area page -->
<div class="supplier_container">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
		<div class="supplier_profile_container">
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="right_tabs">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="pages">
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<h1><!--Sales Made-->Redeemed Vouchers</h1>								
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
								<div class="search_feature">
									<div class="input_round">
										<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
											<input type="text" placeholder="Search by Deal name" name="custName" class="custName">
											<input type="hidden" id="hiddenname">
										</div>
										<!---<span class="glyphicon glyphicon-search emlsearch" style="cursor:pointer;"></span>-->
									</div>
								</div>
							</div>
							<input type="hidden" id="deal_id" value="<?php echo $deal_id;?>">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
							<div class="search_feature">
								<div class="input_round">
									<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
										<input type="text" placeholder="Search by customer email" name="custEmail" class="custEmail">
										<input type="hidden" id="hiddenemail">
									</div>
									<!---<span class="glyphicon glyphicon-search emlsearch" style="cursor:pointer;"></span>-->
								</div>
							</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						  <div class="date-time">
						  <div class="search_feature">
							<form id="searchbydate">
								<div class="input_round">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
										<input class="startdate" type="text" id="date_timepicker_start" name="startdate" placeholder="Purchase date from" readonly>
										<input type="hidden" id="hiddenstartdate">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
										<input type="hidden" id="hiddenenddate">
										<input class="enddate" id="date_timepicker_end" type="text" name="enddate" placeholder="Purchase date until" readonly>
									</div>
								</div>
							 </form>
							</div>
							</div>
						</div>
						<h5 class="search-butn">
							<button class="btn btn-info allsearch">
								search
								<span class="glyphicon glyphicon-search">
								</span>
							</button>
						</h5>
						<div class="no-more-tables rendered_salemade">
							<?php //echo $this->element('frontend/suppliers/salemade'); ?>
						</div>
					</div>
				

					
					</div> <!--end of right tab -->
				</div>
				</div>
			</div>
		</div>
<script>
jQuery(function(){
 jQuery('#date_timepicker_start').datetimepicker({
  format:'j M Y',
  formatDate:'j M Y',
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
   })
  },
  timepicker:false
 });
 jQuery('#date_timepicker_end').datetimepicker({
  format:'j M Y',
  formatDate:'j M Y',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
	
	 })
  },
  timepicker:false
 });
});

$(document).ready(function()
{
	var deal_id=$('#deal_id').val();
	$.ajax({
		      type:"POST",
				url : ajax_url+'Suppliers/sales_made',
				data:{'deal_id':deal_id},
		      success:function(result)
		        {
					 $(".rendered_salemade").html(result);
					 $('.pagination').children().find('.current').addClass('pageactive');
					 $(".rendered_salemade").css({'opacity':'1'});
				}
		   });
	
	/*********************For Pagination Coded By Shivam Chauhan*************/
	
   $('.pagination').children().find('.current').addClass('pageactive');
       $(document).on('click',".sale_made_pagination a",function(){
       	var currentUrl=$(this).attr("href");
			var email1 = $('.custEmail').val();
			$(".rendered_salemade").css({'opacity':'0.2'});
			var email = $('#hiddenemail').val();
			var name = $('#hiddenname').val();
			var startdate = $('#hiddenstartdate').val();
			var enddate = $('#hiddenenddate').val();
			 $.ajax({
		        type:"POST",
		        url:currentUrl,
			     data:{'email':email,'deal_id':deal_id,'name':name,'startdate':startdate,'enddate':enddate},
		        success:function(result)
		        {
					$(".rendered_salemade").html(result);
				    $('.pagination').children().find('.current').addClass('pageactive');
					$(".rendered_salemade").css({'opacity':'1'});
				}
		     });
       return false;
    }); 	
	
	/****** For Search Button Coded By Shivam Chauhan **********/
	
	$(document).on('click','.allsearch',function()
	{
		var email = $('.custEmail').val();
		var name = $('.custName').val();
		var deal_id=$('#deal_id').val();
		var startdate = $('#date_timepicker_start').val();
		var enddate = $('#date_timepicker_end').val();
		$('#hiddenemail').val(email);
		$('#hiddenname').val(name);
		$('#hiddenstartdate').val(startdate);
		$('#hiddenenddate').val(enddate);
		$(".rendered_salemade").css({'opacity':'0.2'});
		$.ajax({
					type:"POST",
					url : ajax_url+'Suppliers/sales_made',
					data:{'email':email,'deal_id':deal_id,'name':name,'startdate':startdate,'enddate':enddate},
					success:function(result)
					{     	
							$(".rendered_salemade").html(result);
							$('.pagination').children().find('.current').addClass('pageactive');
							$(".rendered_salemade").css({'opacity':'1'});
					}
				});
			 
	});
	
	/******For Customer Email Coded By shivam Chauhan *******/
	
	$('.custEmail').keyup(function(e) {
		if (e.which == 13) {
			var email = $('.custEmail').val();
			var name = $('.custName').val();
			var deal_id=$('#deal_id').val();
			var startdate = $('#date_timepicker_start').val();
			var enddate = $('#date_timepicker_end').val();
			$('#hiddenemail').val(email);
			$('#hiddenname').val(name);
			$('#hiddenstartdate').val(startdate);
			$('#hiddenenddate').val(enddate);
			$(".rendered_salemade").css({'opacity':'0.2'});
			$.ajax({
					type:"POST",
					url : ajax_url+'Suppliers/sales_made',
					data:{'email':email,'deal_id':deal_id,'name':name,'startdate':startdate,'enddate':enddate},
					success:function(result)
					{
							$(".rendered_salemade").html(result);
							$('.pagination').children().find('.current').addClass('pageactive');
							$(".rendered_salemade").css({'opacity':'1'});
					}
			});
		}
	});
	
	/******For Customer Name Coded By shivam Chauhan *******/
	
	$('.custName').keyup(function(e) {
		if (e.which == 13) {
			var email = $('.custEmail').val();
			var name = $('.custName').val();
			var deal_id=$('#deal_id').val();
			var startdate = $('#date_timepicker_start').val();
			var enddate = $('#date_timepicker_end').val();
			$('#hiddenemail').val(email);
			$('#hiddenname').val(name);
			$('#hiddenstartdate').val(startdate);
			$('#hiddenenddate').val(enddate);
			$(".rendered_salemade").css({'opacity':'0.2'});
			$.ajax({
					type:"POST",
					url : ajax_url+'Suppliers/sales_made',
					data:{'email':email,'deal_id':deal_id,'name':name,'startdate':startdate,'enddate':enddate},
					success:function(result)
					{
							$(".rendered_salemade").html(result);
							$('.pagination').children().find('.current').addClass('pageactive');
							$(".rendered_salemade").css({'opacity':'1'});
					}
			});
		}
	});
     
     $(document).on('click','.show_table',function(){
				$('.hide_table').toggle(500);
		});	
		$(document).on('click','.address_link',function(){
			var open_page=$(this).attr('rel');
			$(this).hide(500);
			$('.'+open_page).show(500);
		});	
		$(document).on('click','.cancel_open',function(){
			var link_tag=$(this).data('addr_link');
			var open_page=$(this).data('open_page');
			$('.'+link_tag).show(500);
			$('.'+open_page).hide(500);
		});     
		$(document).on('click','.claim_refund',function(){
			var open_page=$(this).data('page_open');
			$('.claim_open, .refund_open').hide(500);
			//$(this).parents('.rhl').next().hide(500);
			//$(this).parents('.rhl').next().next().hide(500);
			$('.'+open_page).show(500);
		});
		$(document).on('click','.cancel_claim_refund',function(){
			var open_page=$(this).data('open_page');
			$('.'+open_page).hide(500);
		});	
		//cells deal accordion
		$(document).on('click','.sale_deal_tbl',function(){
				$('.sale_deal_detail').not($(this).next('.sale_deal_detail')).hide(500);
				$(this).next('.sale_deal_detail').toggle(500);
				$('.claim_open, .refund_open').hide();
				$('.bus_adrs_open, .del_adrs_open').hide();
		});	
     
     
     
});
</script>
