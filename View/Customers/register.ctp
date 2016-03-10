<?php  //echo $this->Html->script('frontend/development/common.js');?>
<?php  //echo $this->Html->css('frontend/jquery.datetimepicker.css');  ?>
<script>
$(document).ready(function(){
  //$('#customer_form').validate();  
  $('.submit_frm').on('click',function(){
	  $('.ac_error').remove();
	  if($('#customer_form').valid())
	  {
		  if($(':checkbox[name=terms]').prop("checked") == false)
		  {
			  //$('#customer_form').submit();
			  $('.accept_term').append('<label class="error ac_error">Please accept legal terms before submitting the form.</label>');
			  return false; 
		  }
		  else
		  { 
		    $('#customer_form').submit() ;
		  }
	  }
	  else
	  {
	    return false;	
	  }
  })
 
 $('#customer_form').validate({
			rules:
			{
				"data[Member][email]":
				{
					required:true,
					email:true,
					remote:ajax_url+'customers/checkMemberEmail'
				},
				"data[Member][name]":
				{
					required:true,
				},
         "data[Member][surname]":
				{
					required:true,
				},
				"data[Member][password]":
				{
					required:true,
					minlength: 6
				},
				"data[Member][cpassword]":
				{
					required:true,
					equalTo:'#pwd'
				},
         "data[Member][location]":
				{
					required:true,
         },
         
			},
			messages:
			{
				"data[Member][email]":
				{
					required:'Please enter email.',
					email:'Please enter valid email.',
					remote:'Email address already exists.'
				},
				"data[Member][name]":
				{
					required:'Please enter name.',
					//remote:'User name already exists.'
				},
         "data[Member][surname]":
				{
					required:'Please enter surname.',
					//remote:'User name already exists.'
				},
				"data[Member][password]":
				{
					required:"Please enter password.",
					minlength: 'Password should be at least 6 characters long.' 
				},
				"data[Member][cpassword]":
				{
					required:"Please enter confirm password.",
					equalTo:'The two new password fields do not match.'
				},
           "data[Member][location]":
				{
					required:'Please select nearest location.',
         },
        
				
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
	var email = '<?php echo @$remEmail;?>';
	var pass = '<?php echo @$remPass;?>';
	if(email != '' && pass != '')
	{ $('.remcheck').prop("checked",true); }
});
	</script>
<style>
   .custmr_tip label img {
    border: 1px solid #22add6;
    border-radius: 20px;
    cursor: pointer;
    padding: 3px;
    width: 18px;
    margin-left: 3px;
	
	input, button, select, textarea 
	{
		font-family: "trebuchet_msregular";
		font-size: inherit;
		line-height: inherit;
	}
}	
</style>
<!-- new user -->
	<div class="login_wrapper">
	  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						
			<div class="new_user_area">
				<div class="login_heading">
					<h1><span class=" glyphicon glyphicon-user"></span>New User</h1>
				</div>
				<form id="customer_form" action="<?php echo HTTP_ROOT;?>Customers/register" method="post">
              <div class="col-lg-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2 col-sm-8 col-md-8 col-xs-12">
				      <div class="new_left">
							<input name="data[Member][member_type]" type="hidden" value="4" />	
                    <div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
								<label>First Name<em> *</em></label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<input name="data[Member][name]" placeholder="Name" class="form-control " type="text">
                           <span class="error"><?php echo @$error['name'][0]; ?></span>    
								</div>
							</div>
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
								<label>Surname<em> *</em></label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<input  class="form-control " placeholder="Surname" name="data[Member][surname]"  type="text">
								  <span class="error"><?php echo @$error['surname'][0]; ?></span>
                        </div>
							</div>
							
							
                     <div class="col-lg-5 col-sm-12 col-md-5 col-xs-12 custmr_tip">
								<label>Nearest Location<em> *</em><img rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" title="Select the option that best suits you. The location you select will link you to that area's deals only. That way you only get a newsletter with deals that are relevant to your area. Some deals are distributed and are available on a national basis, and you can link yourself to these as well after registration by logging in to your account. For now, choose your first newsletter and this can be managed and added to later on."></label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<select name="data[Member][location]">
                            <option value="">Select Nearest Location</option>
                            <?php if(!empty($cities)) {
                            foreach($cities as $cty) { ?>
                             <option value="<?php echo $cty['Location']['id'];?>"><?php echo $cty['Location']['name'];?></option>
                            <?php } } ?>
									</select>
								</div>
							</div>
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
								<label>E-mail<em> *</em></label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<input   placeholder="E-mail" name="data[Member][email]" class="form-control " type="text">
                           <span class="error"><?php echo @$error['email'][0]; ?></span>  
								</div>
							</div>
							
							
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
								<label>Password<em> *</em></label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<input  placeholder="Password" name="data[Member][password]" class="form-control " id="pwd" type="password">
								  <span class="error"><?php echo @$error['password'][0]; ?></span>
                        </div>
							</div>
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
								<label>Confirm Password<em> *</em></label>
							</div>
							<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
									<input  placeholder="Confirm Password" name="data[Member][cpassword]" class="form-control " type="password">
								  <span class="error"><?php echo @$error['cpassword'][0]; ?></span>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
								<p>
									If you were referred by another customer you can link yourself to them by 
									entering their email address here.The more customers you refer, the more prizes you can win! To read up more about this, <a data-target="#competition_cms" data-toggle="modal" href="#">Click here</a>.
								</p>
								<p>
									To link yourself to another registered customer, enter their email address in the field below and click the green "Link" icon. If you can't remember their email address,don't let this delay your registration as you can always link yourself later on after registration.
								</p>
							</div>
							<p>&nbsp;</p>
							<div class="col-lg-5 col-sm-12 col-md-5 col-xs-12">
								<label>Referral Email </label>
							</div>
						<div class="col-lg-7 col-sm-12 col-md-7 col-xs-12">
								<div class="form-group">
								  <input type="hidden" value="0">
								  <input type="text" name="data[Referral][referral_email]" placeholder="Email" class="form-control referral_email" value="">
								  <input type="hidden" name="data[Referral][referral_status]" value="0">
								  <div class="referral_msg" style="display: none;">
													
								  </div>
                        </div>
                        
	                   <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
	                   	<p>
	                   	    <input type="hidden" value="0" />click to link 
	                   	    <a href="javascript:void(0);"  class="btn btn-success submit-linkbtn" >
	                   	    	<i class="glyphicon glyphicon-link"></i>
	                   	    </a>
	                   	</p>
	                   </div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							<div class="recquire_field">
								<p><em>* </em> Required</p>
							</div>
						</div>
					</div>   <!--end of left div...-->
						<div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-md-offset-3 col-md-6 col-xs-12">
							<div class="new_right">
								<div class="check_left">
								<p><span class="glyphicon glyphicon-ok"></span>Secure SSL-connection</p>
								<p><span class="glyphicon glyphicon-ok"></span>Privacy assured</p>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
									
									<div class="form-group accept_term">
										<p>
										<input type="checkbox" name="terms" value="Yes">
										I certify I am at least 18 years old and I have read & agree to the
										<a href="javascript:void(0);">
										Terms & Conditions
										</a>
										</p>
									</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center">
										<input type="button" value="Submit" class="btn btn-success submit_frm" />
	                   			<!-- <a href="javascript:void(0);" class="btn btn-success">Let's Go</a>-->
									</div>
									
								</div>
							</div>
						</div>
					</div>
            </form>
			</div>
						
		</div>	
	</div>
				<!-- End login area -->
				
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
