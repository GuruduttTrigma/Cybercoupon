<?php 
	echo $this->Html->script('backend/development/ui.datepicker.js');
	echo $this->Html->css('backend/smooth.css');
?>
<style>
.content-box h3 {
    font-size: 1.5em !important;
}
.content-box-header h2, .content-box-header h3, .content-box-header h4 {
    border-bottom: 1px dotted #ccc !important;
    font-family: "Segoe UI",Frutiger,Tahoma,Helvetica,"Helvetica Neue",Arial,sans-serif;
    font-weight: bold;
    margin: 0 0 10px;
    padding: 0 0 10px;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
 	var memb = $('#mem_id').val();
	$('#frm').validate({
			rules:
			{
				"data[Member][email]":
				{
					required:true,
					email:true,
					remote:ajax_url+'admin/Members/checkEditMemberEmail/'+memb
				},
				"data[Member][password]":
				{
					required:true,
					minlength: 6
				},
				"data[Member][con_password]":
				{
					required:true,
					equalTo:'#pwd'
				},
				"data[Member][password_copy]":
				{
					required:true,
					minlength: 6
				},
				"data[Member][con_password_copy]":
				{
					required:true,
					equalTo:'#pwd1'
				},
				"data[Member][phone]":
				{
					cus_phone:true
				},
				"data[Member][city]":
				{
					required:true,
				},
				"data[Member][postal_code]":
				{
					required:true,
				},
           "data[MemberMeta][website]":
				{
					required:true,
					complete_url:true
				}
				
			},
			messages:
			{
				"data[Member][email]":
				{
					required:'Please enter email.',
					email:'Please enter valid email.',
					remote:'Email address already exists.'
				},
				"data[Member][password]":
				{
					required:"This field is required.",
					minlength: 'Password should be atleast 6 characters long.'
				},
				"data[Member][con_password]":
				{
					required:"This field is required.",
					equalTo:'Password and confirm password does not match.'
				},
				"data[Member][password_copy]":
				{
					required:"This field is required.",
					minlength: 'Password should be atleast 6 characters long.'
				},
				"data[Member][con_password_copy]":
				{
					required:"This field is required.",
					equalTo:'Password and confirm password does not match.'
				},
				"data[Member][city]":
				{
					required:"please enter city name.",
					
				},
				"data[Member][postal_code]":
				{
					required:"please enter postal code.",
					
				},
          "data[MemberMeta][website]":
        {
           required:"This field is required.",
					complete_url:"Please enter valid Url."
        }
            
				
			}
		
		
		});
		
		$.validator.addMethod("cus_phone", function(value, element) {
		  var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
		  return (!pattern.test(value));
		}, "Not valid number.");
	jQuery.validator.addMethod("complete_url", function(val, elem) {
      if (val.length == 0) { return true; }
       if(!/^(https?|ftp):\/\//i.test(val))
        {
	        val = 'http://'+val; // set both the value
	        $(elem).val(val); // also update the form element
        }
      return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
    });

		
	});
	
	


	$(function() {
		var year = (new Date()).getFullYear()
		var current_date= new Date();
		$( ".datepicker" ).datepicker({
			dateFormat:'dd M yy',
			yearRange:'1950:'+year,
			changeMonth: true, 
			changeYear: true,
			maxDate:current_date,
		});		
	})
</script>
<style>
.status_label
{
	 float: right;
	 margin-right: 20px;
	 padding:4px;
}
select.full
{
padding:4px;
}
</style>
<script>
function isNumericKey(e)
{
    if (window.event) { var charCode = window.event.keyCode; 
	}
    else if (e) { var charCode = e.which; }
    else { return true; }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) { return false; }
    return true;
}
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onclick="history.go(-1)" style="" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
			<div class="inner-page-title">
				<h2>Edit Customer</h2>
               <span></span>
			</div>
         <form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Members/edit_customer/'.base64_encode(convert_uuencode($member['Member']['id']))?>">
            <fieldset>
					<div class="content-box content-box-header" style="border:none;">
						<div class="column-content-box">            
							<div class="ui-state-default ui-corner-top ui-box-header">
								<span class="ui-icon float-left ui-icon-notice"></span>
									Edit Customer's Information
							</div>            
							<div class="content-box-wrapper">
								<input type="hidden" id="mem_id" value="<?php echo $id; ?>" />
								<input name="data[Member][member_type]" type="hidden" value="4" />
								<ul>					
									<li>
										<label class="desc">First Name<em>*</em></label>
										<div>
											<input  class="field text full required" name="data[Member][name]" type="text" value="<?php echo $member['Member']['name'];?>"/>
										</div>
									</li>
									<li>
										<label class="desc">Last Name<em>*</em></label>
										<div>
											<input  class="field text full required" name="data[Member][surname]" type="text" value="<?php echo $member['Member']['surname'];?>"/>
										</div>
									</li>  
									<li>
										<label class="desc">Email Address<em>*</em></label>
										<div>
										 <input  class="field text full email required" name="data[Member][email]" type="text" value="<?php echo $member['Member']['email'];?>"/>
										</div>
									</li>
									<li>
										<label class="desc">Password<em>*</em></label>
										<div>
										  <input id="pwd1"  class="field text full required" name="data[Member][password_copy]" type="text" value="<?php echo $member['Member']['password_copy'];?>" />
										</div>
									</li>
									<li>
										<label class="desc">Confirm Password<em>*</em></label>
										<div>
											<input  class="field text full required" name="data[Member][con_password_copy]" type="text" value="<?php echo $member['Member']['password_copy'];?>" />
										</div>
									</li>
									<li>
									<label class="desc">Address</label>
									<div>
										<textarea  class="field text full" name="data[Member][address]"><?php echo $member['Member']['address'];?></textarea>
									</div>
									</li>
									<label class="desc">Nearest Location<em>*</em></label>
									<div class="inp_holder">
									<select name="data[Member][location]" class="field text full required" >
										<option value="">Select Location</option>
										<?php foreach ($options as $option){ ?>
											<option value="<?php echo $option['Location']['id'];?>" <?php if($member['Member']['location'] == $option['Location']['id']) echo 'selected="selected"';?>>
												<?php echo $option['Location']['name']; ?>
											</option>
							
										<?php } ?>
									</select>								
									</div>
									<li>
										<label class="desc">Mobile number</label>
										<div>
											<input maxlength="16" class="field text full cus_phone" name="data[Member][phone]" type="text" value="<?php echo $member['Member']['phone'];?>"/>
										</div>
									</li>				  
								</ul>              
							</div> <!-- end of content box wrapper -->            
						</div>
					</div>            
              <li>
                <input class="submit sub-bttn" type="submit" value="Submit"/>
              </li>
            </fieldset>
         </form>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
<style>
    .ui-tabs,.ui-widget,.ui-widget-content,.ui-corner-all
     {
         padding: 0.2em;
        margin: 0 0 1em;
        font-weight:bold;
	         outline:none;
        -moz-border-radius:3px;
	        -webkit-border-radius:3px; 
        /*background: none repeat-x scroll 50% 50% rgba(0, 0, 0, 0);*/
        border: 1px solid #ddd;
        color: #444;
      }
    
.trv_mainhideshow_data {
    background: none repeat scroll 0 0 #fff !important;
    float: left;
    width: 100%;
}

.trv_mainhideshow_data label {
    float: left;
    margin-bottom: 10px;
    margin-right: 30px;
    width: auto;
}
.trv_mainhideshow_data label a {
    color: #323232 !important;
    font-family: open_sanslight;
    font-size: 14px;
}

</style>
