<?php echo $this->Html->script('frontend/development/wishlist.js'); ?>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	<div class="login_container">
		<div class="login_heading">
			<h1> Featured Deal   </h1>
		</div>
		<div class="wrap_list_full deal_list">
			<?php echo $this->element('frontend/deals/featured_deal_list');?>
        </div>		
	</div>
</div>	 	
<script>
	$(document).ready(function() {
		/*--------- for ajax pagination--------------*/
		$('.pagination').children().find('.current').addClass('pageactive');     
		$(document).on('click',".pagination a",function(){
			var currentUrl=$(this).attr("href");
			$('.deal_list').css({'opacity':'.5'});
			//alert(currentUrl)
			$.ajax({
				type:"POST",
				url:currentUrl,
				//data:$('#advance_search').serialize(),
				success:function(result) {
					$(".deal_list").html(result);
					$('.deal_list').css({'opacity':'1'});
					$('.pagination').children().find('.current').addClass('pageactive');		
				}
			});
			return false;
		});
	});
</script>