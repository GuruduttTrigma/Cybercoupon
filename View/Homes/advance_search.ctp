<?php  
	echo $this->Html->script('frontend/design/jquery.datetimepicker.js');
	echo $this->Html->script('frontend/design/bootstrap-slider.js');
?>
<?php  
	echo $this->Html->css('frontend/jquery.datetimepicker.css'); 
	echo $this->Html->css('frontend/slider.css'); 
?>
<?php 
	echo $this->Html->script('frontend/development/wishlist.js'); 
?>
<script type="text/javascript">
	$(document).ready(function(){
		//$('.slider').slider();
	 var max_price_limit='<?php echo $max_price;?>';
    $('#ex1').slider({
    	   
			formatter: function(value) {
				return value;
			}
			
	 })
	 
	 $('#ex1').click({
    	   
			formatter: function(value) {
				return value;
			}
			
	 })
	
});

</script>
<style type="text/css">
#ex1Slider .slider-selection {
	background: #BABABA;
}
</style>
<!-- new user -->
<div class="login_wrapper">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="new_user_area">
			<div class="login_heading margin_bottom_42">
				<h1>
					<span class=" glyphicon glyphicon-search"></span> Search  
				</h1>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<form id="advance_search" method="get" action="<?php echo HTTP_ROOT.'homes/advance_search';?>">
					<div class="new_left margin_bottom_add border_right_none">
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">				
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
									<label for="loc">Location</label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<select name="data[Search][location]" class="required">
										<option value="">Select Location</option>
										<?php foreach ($options as $option){ ?>
										<option value="<?php echo $option['Location']['id'];?>">
										<?php echo $option['Location']['name']; ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
								<label for="cat"> Category </label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<select id="cat" name="data[Search][category]" class="required">
										<option value="">Select Category</option>
										<?php foreach($dealcat as $key=>$value){ ?>
										<option value="<?php echo $key;?>"><?php echo $value;?></option>
										<?php } ?>
									</select>	
								</div>
							</div>
						</div>	
						<div class="clearfix"></div>
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
								<label for="name">Item/service</label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<input id="name" name="data[Search][name]" placeholder="" class="form-control" type="text">
								</div>
							</div>
						</div>						
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">				
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12" style="padding-right: 0px;">
								<label for="disc">Price less than(in ZAR)</label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<!--<input id="disc" name="data[Search][selling_price]"  placeholder="" class="form-control" type="text">-->
									
									<input id="less_price" name="data[Search][selling_price]" type="hidden" value="">									
									<input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="<?php echo $min_price;?>" data-slider-max="<?php echo $max_price;?>" data-slider-step="1" data-slider-value="<?php echo $max_price;?>"/>
									<!--<div class="slider slider-horizontal">
										<div class="slider-track">
											<div class="slider-selection">
											</div>
											<!--<div class="slider-handle round">
											</div>-->
											<!--<div class="slider-handle round hide" style="left: 0%;">
											</div>-->
										<!--</div>-->
										<!--<div class="tooltip top">
											<!--<div class="tooltip-arrow">
											</div>
										<div class="tooltip-inner">Current value: 0</div>
										</div>-->
										<!--<input type="text" id="sl1" value="0" class="span2" style="">
									</div>-->
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="clearfix"></div>
						<!--<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">		
						<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
						<label for="d_from"> Deal From </label>
						</div>
						<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
						<div class="form-group">
						<input name="data[Search][deal_from]" class="form-control startdate" type="text">
						</div>
						</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">		
						<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
						<label for="d_to"> Deal To </label>
						</div>
						<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
						<div class="form-group">
						<input name="data[Search][to_deal]" class="form-control enddate" type="text">
						</div>
						</div>
						</div>-->	
						<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">		
							<div class="col-md-offset-5 col-lg-offset-5 col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<a class="btn btn-success search" type="button" href="javascript:void(0)">  Search </a>
								<div class="image_display" style="float:right;display:none;">
									<img src="" />
								</div>
							</div>
						</div>				
					</div>
				</form>
			</div>
		</div> <!--  New User Area  -->
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="login_container">
				<div class="login_heading">
					<h1> Search Results   </h1>
				</div>
				<div class="wrap_list_full">
					<div class="col-md-12 col-xs-12 col-sm-12 padding_0">
						<div class="col-md-12 col-sm-12 col-xs-12 padding_0 advance_search_deal">
							<?php echo $this->element('frontend/Search/search_content');	?>
						</div>	
					</div>
				</div>
			</div>		
		</div>
	</div>	 	
</div>
<script>
	$(document).ready(function() {
		$('.search').click(function() {
			$(".image_display").show();
			var less_price=$('#ex1').prev('div.tooltip').children('.tooltip-inner').html();
			$('#less_price').val(less_price);
			//alert(less_price)
			$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
			$.ajax ({
				url:ajax_url+'homes/advance_search',
				method:'post',
				data:$('#advance_search').serialize(),
				success:function(resp) {
		            $('.advance_search_deal').html(resp);
					$('.pagination').children().find('.current').addClass('pageactive');
					$('.image_display').css('display','none');
					$('html,body').animate({scrollTop: $("#advance_search").offset().top},'slow'); 
				} 
			});
		});
		/*--------- for ajax pagination--------------*/
		$('.pagination').children().find('.current').addClass('pageactive');     
		$(document).on('click',".pagination a",function() {
			var currentUrl=$(this).attr("href");
			$('.advance_search_deal').css({'opacity':'.5'});
			$.ajax({
				type:"POST",
				url:currentUrl,
				data:$('#advance_search').serialize(),
				success:function(result) {
					$('.advance_search_deal').css({'opacity':'1'});
					$(".advance_search_deal").html(result);
					$('.pagination').children().find('.current').addClass('pageactive');
				}
			});
			return false;
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var d= new Date();
		var day = d.getDate();
		var day2 = d.getDate()+1;
		var month = d.getMonth()+1;
		var year = d.getFullYear();
		var current_date=year+'/'+month+'/'+day;
		$('.startdate').on('focus',function() {
			if($(':input[name="data[Search][to_deal]"]').val()!='') {
				var ens = $(':input[name="data[Search][to_deal]"]').val().split(' ');
				var en = ens[0].split('-');
				var end_date = en[0]+'/'+en[1]+'/'+(parseInt(en[2])-1);
				$('.startdate').datetimepicker({
					timepicker:false,
					format:'Y-m-d',
					scrollInput:false,
					maxDate:end_date
				})
			}
			else {
				$('.startdate').datetimepicker({
					timepicker:false,
					format:'Y-m-d',
					scrollInput:false
				})
			}
		});   
		$('.enddate').on('focus',function() {
			if($(':input[name="data[Search][deal_from]"]').val()!='') {
				var ens = $(':input[name="data[Search][deal_from]"]').val().split(' ');
				var en = ens[0].split('-');
				var start_date = en[0]+'/'+en[1]+'/'+(parseInt(en[2])+1);
				$('.enddate').datetimepicker({
					timepicker:false,
					format:'Y-m-d',
					scrollInput:false,
					minDate:start_date
				})
			}
			else {
				$('.enddate').datetimepicker({
						timepicker:false,
						format:'Y-m-d',
						scrollInput:false
				})
			}
		});
	});
</script>