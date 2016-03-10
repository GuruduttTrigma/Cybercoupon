<style>
    .custmr_tip label img {
    border: 1px solid #22add6;
    border-radius: 20px;
    cursor: pointer;
    padding: 3px;
    width: 18px;
    margin-left: 3px;
}	
</style>
<script>
	$( function() {
   	var targets = $( '[rel~=tooltip]' ),
      target  = false,
      tooltip = false,
      title   = false; 
    	targets.bind( 'mouseenter', function() {
      	target  = $( this );
        	tip     = target.attr( 'title' );
        	tooltip = $( '<div id="tooltip"></div>' );
         if( !tip || tip == '' )
            return false;
         target.removeAttr( 'title' );
 	      tooltip.css( 'opacity', 0 )
         .html( tip )
         .appendTo( 'body' );
 			var init_tooltip = function() {
            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                tooltip.css( 'max-width', $( window ).width() / 2 );
            else
                tooltip.css( 'max-width', 340 ); 
            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                pos_top  = target.offset().top - tooltip.outerHeight() - 20; 
            if( pos_left < 0 ) {
                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                tooltip.addClass( 'left' );
            }
            else 
                tooltip.removeClass( 'left' );
            if( pos_left + tooltip.outerWidth() > $( window ).width() ) {
                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                tooltip.addClass( 'right' );
            }
            else
                tooltip.removeClass( 'right' );
            if( pos_top < 0 ) {
                var pos_top  = target.offset().top + target.outerHeight();
                tooltip.addClass( 'top' );
            }
            else
                tooltip.removeClass( 'top' );
 		          tooltip.css( { left: pos_left, top: pos_top } )
                   .animate( { top: '+=10', opacity: 1 }, 50 );
        	}; 
        	init_tooltip();
        	$( window ).resize( init_tooltip );
         var remove_tooltip = function() {
            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function() {
                $( this ).remove();
            }); 
            target.attr( 'title', tip );
        	};
         target.bind( 'mouseleave', remove_tooltip );
 	      tooltip.bind( 'click', remove_tooltip );
    	});
	});
</script>
<script type="text/javascript">
	/*$(document).ready(function() {		
		$("#submitLogin").on("click",function(){
			$('#AdminLogin').validate({
				rules: {
					"data[Member][log_email]": {
						required:true,
						email:true,
						remote:ajax_url+'customers/checkMemberEmailLog'
					},
					"data[Member][log_password]": {
						required:true,
						remote:
						{
						   url:ajax_url+'customers/checkMemberPasswordLog',
						   type:"POST",
						   data:
						   {
						      email:function()
						      {
						         return $('input[name="data[Member][log_email]"]').val();
						      }
						   }
						}
					}
				},
				messages: {
					"data[Member][log_email]": {
						required:'Please enter email.',
						email:'Please enter valid email.',
						remote:'This email address does not exist!'
					},
					"data[Member][log_password]": {
						required:'Please enter password.',
						remote:'Incorrect password! Enter a valid password.'
					} 
				}	
			});
		})
		var email = '<?php echo @$remEmail;?>';
		var pass = '<?php echo @$remPass;?>';
		if(email != '' && pass != '') { 
			$('.remcheck').prop("checked",true); 
		}
	});*/
</script>

<script>
$(document).ready(function()
{
	//$('#customer_form').validate();  
	$('.submit_frm').on('click',function()
	{
		$('.ac_error').remove();
		//alert('hello')
		if($('#customer_form').valid())
	    {
			if($(':checkbox[name=terms]').prop("checked") == false)
			{
				//alert('not checked')
				//$('#customer_form').submit();
				$('.accept_term').append('<label class="error ac_error">Please accept legal terms before submitting the form.</label>');
					return false; 
			}
			else
			{ 
				$('#customer_form').submit(); 
			}
		}
		else
		{
			return false;	
		}
	})
	$('#customer_form').validate({
		rules: {
			"data[Member][email]": {
				required:true,
				email:true,
				remote:ajax_url+'customers/checkMemberEmail'
			},
			"data[Member][id_number]": {
				required:true,
			},
			"data[Member][name]": {
				required:true,
			},
			"data[Member][surname]": {
				required:true,
			},
			"data[Member][password]": {
				required:true,
				minlength: 6
			},
			"data[Member][cpassword]": {
				required:true,
				equalTo:'#pwd'
			},
			"data[Member][phone]": {
				required:true,
				cus_phone:true
			},
			"data[Member][city]": {
				required:true,
			},
			"data[Member][postal_code]": {
				required:true,
			},
			"data[Member][address]": {
				required:true,
			},
			"data[Member][location]": {
				required:true,
			},      
		},
		messages: {
			"data[Member][email]": {
				required:'Please enter email.',
				email:'Please enter valid email.',
				remote:'Email address already exists.'
			},
			"data[Member][name]": {
				required:'Please enter name.',
				//remote:'User name already exists.'
			},
			"data[Member][id_number]": {
				required:'Please enter id number.',
				//remote:'User name already exists.'
			},
			"data[Member][surname]": {
				required:'Please enter surname.',
				//remote:'User name already exists.'
			},
			"data[Member][password]": {
				required:"Please enter password.",
				minlength: 'Password should be atleast 6 characters long.'
			},
			"data[Member][cpassword]": {
				required:"Please enter confirm password.",
				equalTo:'Password and confirm password does not match.'
			},
			"data[Member][phone]": {
				required:"Please enter phone number.",
				cus_phone:"please enter valid phone number."
			},
			"data[Member][city]": {
				required:"Please enter city name.",
			},
			"data[Member][postal_code]": {
				required:"Please enter postal code.",
			},
			"data[Member][address]": {
				required:'Please enter address.',
			},
			"data[Member][location]": {
				required:'Please select nearest location.',
			}				
		}
	});
	$.validator.addMethod("cus_phone", function(value, element) {
		var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
		return (!pattern.test(value));
	}, "Not valid phone number.");
})
</script>

<script type="text/javascript">
	$(document).ready(function() {	
		$('#forgot_form').validate({
				rules: {
					"data[Member][log_email]": {
						required:true,
						email:true,
						//remote:ajax_url+'customers/checkMemberEmailLog'
					}
				},
				messages: {
					"data[Member][log_email]": {
						required:'Please enter email.',
						email:'Please enter valid email.',
						//remote:'Email address does not exists.'
					} 
				}	
			});
	
});
<?php if($this->Session->check('success') || $this->Session->check('error')) :
?>
$(window).load(function(){
	$.ajax({
		type:'post',
		url: ajax_url+'Customers/update_status_forgot',
		success: function(resp) {
		
		}
	});
$('#myModal2').modal('show');
});

<?php endif;?>
</script>

<!--  Modal content for the mixer image example -->
  <div id = "myModal" class="modal fade pop-up-10" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content forgot_content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          
        </div>
        <div class="modal-body forgot_body">
        		<div class="login_heading">
					<h1><span class=" glyphicon glyphicon-log-in"></span>Forgot Password</h1>
				</div>
			<form action="<?php echo HTTP_ROOT;?>Customers/forgot_password" id="forgot_form" method="post" novalidate="novalidate">
				<div class="left_login no_border">
					<!--<img src="images/or.png"/>-->
					<h3 class="text-center"></h3>
					<div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 padding_0">
						<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
							<label style="color:#5cb85c;">E-mail</label>
						</div>
						<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
							<div class="form-group">
								<input type="text" value="" class="form-control " name="data[Member][log_email]">
								<span style="margin-left:0px !important; padding-left:0px !important; color:red" class="errAjax" id="err_email"></span>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-sm-8  col-md-8 col-xs-12 col-lg-offset-3 col-sm-offset-3 col-md-offset-3 ">
						<div class="login_btn">
							<input type="submit" value="Get Password" id="submitForgot" class="btn btn-success ">
						</div>
					</div>
				</div>
			</form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal mixer image -->
  
 <!-- Forgot Success Message Pop Up-->
 
 <div id = "myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content forgot_content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          
        </div>
        <div class="modal-body forgot_body">
        		<div class="login_heading">
					<h1><span class=" glyphicon glyphicon-log-in"></span>Success Message</h1>
				</div>
			<div class="login_wrapper">
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="new_user_area">
						<div class="login_heading"></div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 payment">
							<p>Thank you, your new password has been sent to the e-mail
			address that you provided. Please ensure that you change your password for
			security reasons. Kind Regards The Cyber Coupon Team</p>
						</div>
					</div>

				</div>
			</div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal mixer image -->
  
<!-- Forgot Success Message Pop Up End-->

<!-- login area -->
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
	<div class="login_container">
	<?php
		if($this->Session->check('refer_success'))
		{
			$refer_mmessage=$this->Session->read('refer_success');
			$this->Session->delete('refer_success');
		}
               if($this->Session->check('success'))
		{
			$this->Session->delete('success');
		}
                if($this->Session->check('error'))
		{      
                        $this->Session->delete('error');
		}
		if($this->Session->check('refer_error'))
		{       
			$refer_mmessage=$this->Session->read('refer_error');
			$this->Session->delete('refer_error');
		}
		unset($_SESSION['refer_success']);
		unset($_SESSION['refer_error']);
		unset($_SESSION['success']);
                unset($_SESSION['error']);
	?>
	<div class="BaseStatus session_div" style="<?php if(@$refer_mmessage && $refer_mmessage!=''){?>display: block;<?php }else{?>display: none;<?php } ?>">
		<?php echo $refer_mmessage;?>
	</div>
	<div class="login_heading">
		<h1><span class=" glyphicon glyphicon-log-in"></span>Sign In</h1>
	</div>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
<div class="gurudutt">
	<h5>(If you received a newsletter, you are already registered (Perhaps by a friend hoping to qualify for great prizes. You can too by referring friends!) In these instances you should sign in with your email address as your username and click on the "lost password" link and you will be emailed a new password)</h5>
</div>
</div>
</div>	
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3 col-sm-offset-3">
	<?php 
		if($page_info!='') {
			$login_uri= HTTP_ROOT.'Customers/login?redirect='.base64_encode(convert_uuencode($page_info));
		}
		else {
			$login_uri= HTTP_ROOT.'Customers/login';
		}
	?>
		<form method="post" id="AdminLogin" action="<?php echo $login_uri;?>">
			<div class="left_login no_border">
				<!--<img src="images/or.png"/>-->
				<h3 class="text-center">Sign in with your Cyber Coupon account details</h3>
				<div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 padding_0">
					<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
						<label>E-mail</label>
					</div>
					<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
						<div class="form-group">
							<input  name="data[Member][log_email]" class="form-control " value="<?php echo @$remEmail;?>" type="text">
							<span class="error"><?php echo @$error['log_email'][0]; ?></span>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 padding_0">
					<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
						<label>Password</label>
					</div>
					<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12">
						<div class="form-group">
							<input name="data[Member][log_password]" class="form-control required" value="<?php echo @$remPass;?>" type="password">
							<span class="error"><?php echo @$error['log_password'][0]; ?></span>	
							<span class="error"><?php echo @$error1; ?></span>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-sm-8  col-md-8 col-xs-12 col-lg-offset-3 col-sm-offset-3 col-md-offset-3 ">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
						<div class="form-group">
							<!--a href="<?php echo HTTP_ROOT;?>customers/forgot_password">Forgot Your Password?</a-->
							<a href="#" data-toggle="modal" data-target=".pop-up-10">Forgot Your Password?</a>
							
						</div>
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
						<div class="form-group">
							<p>
								<input type="checkbox" name="data[Member][check]" class="remcheck"/>
								Remember me
							</p>
						</div>
					</div>
					<div class="login_btn">
						<input type="submit" class="btn btn-success " id="submitLogin" value="Login"/>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>			
	
	<h2 class="text-center h2_color"><a href="<?php echo HTTP_ROOT.'Homes/option/register';?>">New to Cyber Coupon? Register now!</a> </h2>
 </div>
		<style>
		.gurudutt{
		   color: #5c94ab !important;
    margin: 0 auto;
    max-width: 610px;
		}
		.gurudutt h5{
		 color: #428bca;
    font-size: 14px;
    text-align: center;
	 word-spacing:3px;
		}
		</style>