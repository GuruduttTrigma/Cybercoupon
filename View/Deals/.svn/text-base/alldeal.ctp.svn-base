<?php echo $this->Html->script('frontend/development/wishlist.js'); ?>
	<!-- profile area page -->

				<div class="listing_container">

					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

						<div class="supplier_heading">

							<h1><?php echo @$deal['DealCategory']['name'];?></h1>
							
						</div>

					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="row">

							<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">

								    <?php echo $this->element('frontend/deals/all_deal_left_list');?>

							</div>

							<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 all_deal_right">

							     	<?php echo $this->element('frontend/deals/all_deal_right_list');?>
									
							</div>

						</div>

					</div>
    </div>

				<!-- End profile area page -->
<script>
$(document).ready(function()
{
   	
	$(document).on('click',".cat_parent",function(){
		var uri = $(this).attr('rel');
		//alert(uri);
		if ($(this).is(':checked')) {
			$('.c_'+uri).prop('checked',true);
		}
		else {
			$('.c_'+uri).prop('checked',false);
		}
	});
	
	$(document).on('click',".cat_child_check",function(){
		var uri = $(this).data('childcat');
		var count = 0;
		var len = $('.c_'+uri).length;
		$('.c_'+uri).each(function() {
			if ($(this).is(':checked')) {
				count++;
			}
		});
		
		/*if (count > 0) {
			$('.p_'+uri).prop('checked',true);
		}
		if (count === 0) {
			$('.p_'+uri).prop('checked',false);
		}
		else {
			$('.p_'+uri).prop('checked',true);
		}*/
		if (count === len) {
			$('.p_'+uri).prop('checked',true);
		}
		else {
			$('.p_'+uri).prop('checked',false);
		}
	});
	
	$(document).on('click',".allcheck",function(){  
		$(this).prop('checked',true);
		$('.childcheck').prop('checked',false);
	});
	
	$(document).on('click',".childcheck",function(){  
		var count = 0;
		$('.childcheck').each(function(){
			if ($(this).is(':checked')) {
				count++;
			}
		});
		if (count === 0) {
			$('.allcheck').prop('checked',true);
		}
		else {
			$('.allcheck').prop('checked',false);
		}
		
		
	});
	$(document).on('click',".form_submit",function(){
		//$(".row").css('opacity',0.2);
       
           $.ajax({
		        type: "POST",
		        url: ajax_url+'deals/alldeal/'+'<?php echo $cate; ?>',
				data: $('#category_form').serialize(),
		        success:function(result)
		        {
		           $(".all_deal_right").html(result);
				    $('.pagination').children().find('.current').addClass('pageactive');	
				}
		     });
	});
	
	 /*--------- for ajax pagination--------------*/
	$('.pagination').children().find('.current').addClass('pageactive');  
	$(document).on('click',".pagination a",function()
	{
		//$(".row").css('opacity',0.2);
        var currentUrl=$(this).attr("href");
           $.ajax({
		        type:"POST",
		        url:currentUrl,
				data: $('#category_form').serialize(),
		        success:function(result)
		        {
		           $(".all_deal_right").html(result);
				          $('.pagination').children().find('.current').addClass('pageactive');	
           }
		     });
       return false;
    });
	
 });
</script>