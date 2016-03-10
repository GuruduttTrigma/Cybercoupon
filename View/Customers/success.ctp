<script>
$(document).ready(function() {
	$('.act_link').on('click',function(){ 
		var success_member=$(this).attr('rel');
		  if(confirm('Are you sure to resend activation account link to your inbox.'))
		  {
      	$.ajax({
	         type:'POST',
	         url:ajax_url+'Customers/user_code_activation/'+success_member,
								 success:function(resp)
								 {
											if(resp=='success')
											{
											  $('.session_div').css({'display':'block'});
											  $('.session_div').html('You have successfully send activation link.');
											  setTimeout(function(){
											     $('.session_div').css({'display':'none'});
											  },1000);
											}
											else
											{
												
											}
								 }
         });
     }
	});
});
</script>
<div class="container">
	<div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
	<div class="BaseStatus session_div" style="float: none ! important; display: none;" ></div>
		<h2 class="text-center h2_color "><!--Your Registration Is Almost Complete!-->
			<?php echo $success1['CmsPage']['page_title']; ?>
		</h2>
		<div class="col-md-12  padding_0 form_div_margin_top">
			<div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 labl-norml col-lg-offset-1">
				<!--<p>
				A confirmation message has been sent to your e-mail address you entered. 
				To complete your registration,please select the activation link when the email arrives.
				 If you suspect the email has not arrived, take a look in the spam folder.
				 Your Registration Is Almost Complete.A
					confirmation message has been sent to your e-mail address. To complete your
					registration, please select the activation link when the email arrives. If
					the email does not arrive, take a look in your spam folder.
				 </p>
				<p>
				Note: Please do not refresh this page. 
				</p>-->
				<?php echo $success1['CmsPage']['content']; ?>
				<p class="class">If the email does not arrive, take a look in your spam folder.</p>
				<p class="subclass">Click here to 
				<a href="javascript:void(0);" class="act_link" rel="<?php echo @$success_member; ?>">Resend activation account link to your inbox.</a>
				</p>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".class").keypress(function(){
		$(".subclass").toggle();
	});
});
</script>