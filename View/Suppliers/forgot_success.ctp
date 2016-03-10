<div class="login_wrapper">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="new_user_area">
			<div class="login_heading"></div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 payment">
				<p>Thank you, your new password has been sent to the e-mail
address that you provided. Please ensure that you change your password for
security reasons. Kind Regards The Cyber Coupon Team</p>
				<a href="<?php echo HTTP_ROOT.'Homes/option/login'; ?>">Click here to login</a>
			</div>
		</div>
	</div>
</div>
<script>
$(window).load(function(){
	$.ajax({
		type:'post',
		url: ajax_url+'Suppliers/update_status_forgot',
		success: function(resp) {
		
		}
	});
})
</script>