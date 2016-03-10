<style>
div.test {
    word-wrap: break-word;
} 
</style>
<?php  
	echo $this->Html->script('frontend/design/jquery.datetimepicker.js');?>
<?php  
	echo $this->Html->css('frontend/jquery.datetimepicker.css');  
?>
<!-- new user -->
<div class="login_wrapper">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="new_user_area">
			<div class="login_heading margin_bottom_20_imp">
				<h1>
					<span class="glyphicon glyphicon-comment"></span>
					Customer Faq
				</h1>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 margin_bottom_add">
		<div id="accordion" class="panel-group my_panel margin_bottom_add ">
			<?php //pr($faqdata); die; ?>
			<?php
					$i=1; 
					foreach($faq as $data)
					{
      /*$html=$data['Faq']['answer'];
					$start = strpos($html, '<p>');
					$end = strpos($html, '</p>', $start);
					$paragraph = substr($html, $start+3, $end-$start);
					$rest=substr($html, $end);
					$complete=$paragraph.$rest;*/
	  ?>			
			<div class="panel panel-default">
				<div class="panel-heading test">
					<h4 class="panel-title ">
						<a class="new_class_for_a collapsed" href="#collapse<?php echo $i; ?>" data-parent="#accordion" data-toggle="collapse">
							<?php echo "<B>Question</B>.".$data['Faq']['question']; ?>
						</a>
					</h4>
				</div>
				<div id="collapse<?php echo $i; ?>" class="panel-collapse collapse" style="height: 0px;">
					<div class="panel-body test"><?php echo "<b>Answer. </b>".$data['Faq']['answer']; ?>  </div>
				</div>
			</div>
			<?php $i=$i+1; }  ?>
		</div>
	</div>
</div>		
<script>
	$(document).ready(function(){
		$('.search').click(function(){
			$(".image_display").show();
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
		$(document).on('click',".pagination a",function(){
			var currentUrl=$(this).attr("href");
			$.ajax({
				type:"POST",
				url:currentUrl,
				data:$('#advance_search').serialize(),
				success:function(result) {
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
		$('.enddate').on('focus',function(){
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