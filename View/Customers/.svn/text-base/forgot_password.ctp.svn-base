<script type="text/javascript">
	$(document).ready(function() {	
	
		
			$('#AdminLogin').validate({
				rules: {
					"data[Member][log_email]": {	
						required:true,
						email:true,
						remote:ajax_url+'customers/checkMemberEmailLog'
					}
				},
				messages: {
					"data[Member][log_email]": {
						required:'Please enter email.',
						email:'Please enter valid email.',
						remote:'Email address does not exists.'
					}
				}	
			});
		/*$('#submitLogin').on('click', function(){ 
			$('#AdminLogin').validate();
			if($('#AdminLogin').valid())
			{
				$(this).attr('disabled', 'disabled');
				$("#submitLogin").submit();
			}
			else
			{
				 $("#submitLogin").removeAttr("disabled");
			}

		})*/
		var email = '<?php echo @$remEmail;?>';
		if(email != '') { 
			$('.remcheck').prop("checked",true); 
		}
	
	});
</script>
<!-- login area -->
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
	<div class="login_container">
		<div class="login_heading">
			<h1><span class=" glyphicon glyphicon-log-in"></span>Forgot Password</h1>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
			<form method="post" id="AdminLogin" action="<?php echo @$login_uri;?>">
				<div class="left_login no_border">
					<!--<img src="images/or.png"/>-->
					<h3 class="text-center"></h3>
					<div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 padding_0">
						<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
							<label>E-mail</label>
						</div>
						<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
							<div class="form-group">
								<input  name="data[Member][log_email]" class="form-control " class="form-control " value="<?php echo @$remEmail;?>" type="text">
								<span id="err_email" class="errAjax" style="margin-left:0px !important; padding-left:0px !important; color:red"></span>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-sm-8  col-md-8 col-xs-12 col-lg-offset-3 col-sm-offset-3 col-md-offset-3 ">
						<div class="login_btn">
							<input type="submit" class="btn btn-success " id="submitLogin" onclick="return ajax_formname('AdminLogin','Validates/forgetcustEmail','reciever')" value="Get Password"/>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>