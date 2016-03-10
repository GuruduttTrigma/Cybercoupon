<?php echo $this->Html->script('backend/development/ui.datepicker.js');
  echo $this->Html->css('backend/smooth.css');
//pr($selected_parent_id);

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
$(document).ready(function()
{
	$('.makeDiscount').keyup(function()
	{
  		var vals;
  		var intRegex = /^\d+$/;
		  var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  		$('.makeDiscount').each(function()
  		{
   		vals = $(this).val();
   		if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
   		{
     			discountFun();
   		}
   		else 
   			return false;
  		})
		function discountFun()
		{
			$('#discount_price1').val(); 
			price = $('input[name="data[MemberMeta][supplier%]"]').val(); 
			dis = $('#discount1').val();
			//alert(price)
			//alert(dis)
			if(price != "" && dis !="" && parseInt(dis) <= 100)
			{
			real =100 - price ;
   	$('#discount_price1').val(real);
}
}
})

});
</script>
<script>
	$(document).ready(function()
	{
		$('.edit_permission').click(function(){
			if($(this).val()==1)
			{
			  $(this).parent().prev('.new-admin-table-row-part2').children('input.no_view').attr('checked',false);
			  $(this).parent().prev('.new-admin-table-row-part2').children('input.yes_view').attr('checked',true);
			}
		})
		$('input.no_view').click(function(){
			if($(this).val()==0)
			{
			  $(this).parent().next('.new-admin-table-row-part3').children('.yes_edit').attr('checked',false);
			  $(this).parent().next('.new-admin-table-row-part3').children('.no_edit').attr('checked',true);
			}
		})
	});	
</script>
<script type="text/javascript">
$(document).ready(function(){
 var ifchecked = "<?php echo $member['Member']['company_user_type']; ?>";
 if(ifchecked === 'sales_person') {
 
		$('.edit_permission').attr('disabled',true);
		$('.edit_view').attr('disabled',true);
		$('.new-admin-table').css('opacity','0.5');
	}

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
					//remote:ajax_url+'Members/checkMemberName'
				},
				"data[Member][postal_code]":
				{
					required:true,
					//remote:ajax_url+'Members/checkMemberName'
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
		
	 $('#SalesPerson').click(function(){
      if($(this).is(':checked'))
      {
			$('.edit_permission').attr('disabled',true);
			$('.edit_view').attr('disabled',true);
			$('.new-admin-table').css('opacity','0.5');
      }
      else
      {
			$('.edit_permission').attr('disabled',false);
			$('.edit_view').attr('disabled',false);
			$('.new-admin-table').css('opacity','1');
      }
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
				<h2>Edit <?php echo ucfirst($member['MemberType']['name']);?></h2>
               <span></span>
			</div>
  <?php if($member['MemberType']['name']=='customer') {?>
            <form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Members/edit_member/'.base64_encode(convert_uuencode($member['Member']['id']))?>">
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
					<!--<li>
                    <label class="desc">Title<em>*</em></label>
						<div>
						 
						  <select name="data[Member][title]" class="field text full required">
								<option value="">Please Choose</option>
								<option <?php if($member['Member']['title']=="Mr."){ echo 'selected="selected"'; } ?>>Mr.</option>
								<option <?php if($member['Member']['title']=="Mrs."){ echo 'selected="selected"'; } ?>>Mrs.</option>
								<option <?php if($member['Member']['title']=="Ms."){ echo 'selected="selected"'; } ?>>Ms.</option>
								<option <?php if($member['Member']['title']=="Miss."){ echo 'selected="selected"'; } ?>>Miss.</option>
							</select>
						</div>
                    </li>-->
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
             
					<!--<li>
                    <label class="desc">DOB<em>*</em></label>
						<div>
						  <input  class="field text full required datepicker" readonly="readonly" name="data[Member][dob]" type="text" value="<?php echo date('d-m-Y',strtotime($member['Member']['dob']));?>" readonly="readonly"/>
						</div>
                    </li>-->
					<!--<li>
					<label class="desc">Company<em>*</em></label>
						<div>
						  <input  class="field text full required" name="data[Member][company]" type="text" value="<?php echo $member['Member']['company'];?>"/>
						</div>
                    </li>
					<li>
                    <label class="desc">Id number<em>*</em></label>
						<div>
						  <input  class="field text full required" name="data[Member][id_number]" type="text" value="<?php echo $member['Member']['id_number'];?>"/>
						</div>
                    </li>-->
                  
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
                  <!--<li>
                    <label class="desc">City<em>*</em></label>
						<div>
						  <input  class="field text full required" name="data[Member][city]" type="text" value="<?php echo $member['Member']['city'];?>"/>
						</div>
                    </li>
                    <li>
                    <label class="desc">Postal Code<em>*</em></label>
						<div>
						  <input  class="field text full required" name="data[Member][postal_code]" type="text" value="<?php echo $member['Member']['postal_code'];?>"/>
						</div>
                    </li>-->
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
<?php } ?>

<?php if($member['MemberType']['name']=='supplier') {?>

     <form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Members/edit_member/'.base64_encode(convert_uuencode($member['Member']['id']))?>">
              <fieldset>
            <div class="content-box content-box-header" style="border:none;">
			<div class="column-content-box">
            
            <div class="ui-state-default ui-corner-top ui-box-header">

                <span class="ui-icon float-left ui-icon-notice"></span>

                Edit Supplier's Information
            </div>
            
            <div class="content-box-wrapper">
            	<input type="hidden" id="mem_id" value="<?php echo $id; ?>" />
                
                <ul>
                  <input name="data[Member][member_type]" type="hidden" value="3" />
                  <input name="data[MemberMeta][id]" type="hidden" value="<?php echo $member['MemberMeta']['id'];?>" />
							<li>
							<label class="desc">Company name<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[MemberMeta][company_name]" type="text" value="<?php echo $member['MemberMeta']['company_name'];?>" />
							</div>
						  </li>
						  <li>
							<label class="desc">Trading name<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[MemberMeta][trading]" type="text" value="<?php echo $member['MemberMeta']['trading'];?>" />
							</div>
						  </li>						  
						  <li>
							<label class="desc">Name<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][name]" type="text" value="<?php echo $member['Member']['name'];?>" />
							</div>
						  </li>
               <li>
							<label class="desc">Last Name<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][surname]" type="text" value="<?php echo $member['Member']['surname'];?>" />
							</div>
						  </li>
						  <li>
							<label class="desc">Landline number<em>*</em></label>
							<div>
							  <input maxlength="16" class="field text full required cus_phone" name="data[MemberMeta][landline]" type="text" value="<?php echo $member['MemberMeta']['landline'];?>" />
							</div>
						  </li>  
                 		<li>
							<label class="desc">Mobile number<em>*</em></label>
							<div>
							  <input maxlength="16" class="field text full required cus_phone" name="data[Member][phone]" type="text" value="<?php echo $member['Member']['phone'];?>" />
							</div>
						  </li>  
						  <li>
							<label class="desc">Address<em>*</em></label>
							<div>
							  <textarea class="field text full required" name="data[Member][address]" type="text"><?php echo $member['Member']['address'];?></textarea>
							</div>
						  </li>
                		<li>
							<label class="desc">Email Address<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][email]" type="text" value="<?php echo $member['Member']['email'];?>" />
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
                		
						  <li>
						  </li>
							<li>
							<label class="desc">City<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][city]" type="text" value="<?php echo $member['Member']['city'];?>" />
							</div>
						  </li>
						  <li>
							<label class="desc">Nearest Location<em>*</em></label>
							<div class="inp_holder">
								<select name="data[Member][location]" class="field text full required" >
									<option value="">Select Nearest Location</option>
                      <?php foreach ($options as $option){ ?>
										<option value="<?php echo $option['Location']['id'];?>" <?php if($option['Location']['id']==$member['Member']['location']) echo 'selected="selected"'; ?>>
											<?php echo $option['Location']['name']; ?>
									</option>
						
									<?php } ?>
								</select>
								
							</div>
                <li>
							<label class="desc">Company Website<em>*</em></label>
							<div>
							  <input  class="field text full" name="data[MemberMeta][website]" type="text" value="<?php echo $member['MemberMeta']['website'];?>" />
							</div>
						  </li>
               <!-- <li>
               <label class="desc">Business Type<em>*</em></label>
							<div class="inp_holder">
								<select name="data[MemberMeta][business_type]" class="field text full required" >
									<option value="">Select Business Type</option>
                      <?php foreach ($business_type as $business_type){ ?>
										<option value="<?php echo $business_type['BusinessType']['id'];?>" <?php if($business_type['BusinessType']['id']==$member['MemberMeta']['business_type']) echo 'selected="selected"'; ?> >
											<?php echo $business_type['BusinessType']['name']; ?>
									</option>
						
									<?php } ?>
								</select>
								
							</div>
               </li>
                <li>  
                <label class="desc">Business Category<em>*</em></label>
							<div class="inp_holder">
								<select name="data[MemberMeta][business_category]" class="field text full required" >
  									<option value="">Select Category</option>
              <?php foreach ($business_cat as $business_cat){ ?>
  										<option value="<?php echo $business_cat['BusinessCategory']['id'];?>" <?php if($business_cat['BusinessCategory']['id']	==$member['MemberMeta']['business_category']) echo 'selected="selected"'; ?> >
  											<?php echo $business_cat['BusinessCategory']['name']; ?>
  									</option>
  						
									<?php } ?>
								</select>
								
							</div>
                </li>-->
                 <!--<li>
               <label class="desc">Total Locations<em>*</em></label>
							<div class="inp_holder">
								<select name="data[Member][location]" class="field text full required" >
									<option value="">Select Locations</option>
                      <?php foreach ($options as $option){ ?>
										<option value="<?php echo $option['Location']['id'];?>" >
											<?php echo $option['Location']['name']; ?>
									</option>
						
									<?php } ?>
								</select>
								
							</div>
                </li>--> 
               <li>
							<label class="desc">Business Start Date<em>*</em></label>
							<div>
							  <input  class="field text full required datepicker" readonly="readonly" name="data[MemberMeta][start_date]" type="text" value="<?php echo date('M d Y',strtotime($member['MemberMeta']['start_date']));?>"  />
							</div>
						  </li>
               		<li>
							<label class="desc">Company Registration Number</label>
							<div>
								<?php 
								if($member['MemberMeta']['registration_no'] != '')
								{
									$comRegNo = $member['MemberMeta']['registration_no']; 
								}
								else
								{
									$comRegNo = "";
								}
								?>
								<input  class="field text full " name="data[MemberMeta][registration_no]" type="text" value="<?php echo $comRegNo; ?>" />
							</div>
						  </li>
               <li>
							<label class="desc">VAT Registration Number</label>
							<div>
							<?php 
							if($member['MemberMeta']['vat_registration_no'] != '')
							{
								$vatRegNo = $member['MemberMeta']['vat_registration_no']; 
							}
							else
							{
								$vatRegNo = "";
							}
							?>
							<input  class="field text full " name="data[MemberMeta][vat_registration_no]" type="text" value="<?php echo $vatRegNo;?>" />
							</div>
						  	</li>
						  	<li>
							<label class="desc">How can we help your business?<em></em></label>
							<div>
                      <textarea  class="field text full " readonly="readonly" name="data[MemberMeta][cause_description]"><?php echo $member['MemberMeta']['cause_description'];?></textarea>
							</div>
						  	</li>
						  	<div class="ui-state-default ui-corner-top ui-box-header">
						  		<span class="ui-icon float-left ui-icon-notice"></span>	
                				Supplier's Agreement Information 
								<label>
									<?php 
									if($amount_payable_to_supplier > 0) 
									{
										$amount_payable = $amount_payable_to_supplier;
									}
									else
									{
										$amount_payable = $amount_payable_to_supplier;
									}
									?>
									<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width: 10px;" src="<?php echo HTTP_ROOT.'img/frontend/tooltip.png' ?>" rel="tooltip" title="This % cannot be changed until all outstanding claims from this supplier have been settled. The unsettled amount is <?php echo $amount_payable; ?>. ">
								</label>
            			</div>						  
						  <li>
							<label class="desc">Supplier %<em>*</em></label>
							<div>
								<?php 
								if($amount_payable_to_supplier > 0 ) 
								{
								?>									
									<input readonly="readonly" min="0" max="100" class="field text full required number" type="text" value="<?php if(!empty($member['MemberMeta']['supplier%'])) { echo $member['MemberMeta']['supplier%']; } else { echo "70"; }?>" />
								<?php 
								}
								else
								{
								?>
									<input id="discount1" min="0" max="100" class="field text full required number makeDiscount" name="data[MemberMeta][supplier%]" type="text" value="<?php if(!empty($member['MemberMeta']['supplier%'])) { echo $member['MemberMeta']['supplier%']; } else { echo "70"; }?>" />
								<?php
								}
								?>
							</div>
						  	</li> 
						  	<li>
							<label class="desc">Cyber Coupon %<em>*</em></label>
							<div>
							  <input  id="discount_price1" class="field text full required number" name="data[MemberMeta][cybercoupon%]" type="text" value="<?php if(!empty($member['MemberMeta']['cybercoupon%'])) { echo $member['MemberMeta']['cybercoupon%']; } else { echo "30"; }?>" readonly=""  />
							</div>
						  	</li> 
							<li>
							<label class="desc">Choose Sales Person<em>*</em></label>
							<div>
								<select id = "choose_sales_person" name = "data[Member][sales_parent]">
									<option value = "">Select Sales Person</option>
									<?php if ($sales_persons != '' && !empty($sales_persons)) :
										foreach($sales_persons as $sales_person):
									?>
										<option value = "<?php echo $sales_person['Member']['id'];?>" <?php if($sales_person['Member']['id'] == $member['Member']['sales_parent']):?> selected <?php endif;?>> <?php echo $sales_person['Member']['name'].' '. $sales_person['Member']['surname'];?></option>
									<?php 
										endforeach;
									endif;
								  ?>
								</select>
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
             

<?php } ?>
      <?php if($member['MemberType']['name']=='company') {?> 
          <form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Members/edit_member/'.base64_encode(convert_uuencode($member['Member']['id']))?>">
            <fieldset>
                    <div class="content-box content-box-header" style="border:none;">
        			       <div class="column-content-box">
                    
                    <div class="ui-state-default ui-corner-top ui-box-header">
        
                        <span class="ui-icon float-left ui-icon-notice"></span>
        
                        Edit User's Information
                    </div>
                    
                    <div class="content-box-wrapper">
                    	<input type="hidden" id="mem_id" value="<?php echo $id; ?>" />
                        
            <ul>
                <input name="data[Member][member_type]" type="hidden" value="2" />
                <input name="data[MemberMeta][id]" type="hidden" value="<?php echo $member['Member']['id'];?>"/>
        						  <li>
            							<label class="desc">Name<em>*</em></label>
            							<div>
            							  <input  class="field text full required" name="data[Member][name]" type="text" value="<?php echo $member['Member']['name'];?>" />
            							</div>
        						  </li>
              <li>
          							 <label class="desc">Surname<em>*</em></label>
          							<div>
          							  <input  class="field text full required" name="data[Member][surname]" type="text" value="<?php echo $member['Member']['surname'];?>" />
          							</div>
        						  </li>
              <li>
            							 <label class="desc">Telephone number<em>*</em></label>
            							<div>
            							  <input maxlength="16" class="field text full required cus_phone" name="data[Member][phone]" type="text" value="<?php echo $member['Member']['phone'];?>" />
            							</div>
        						  </li>  
									<li>
          							<label class="desc">Email Address<em>*</em></label>
          							<div>
          							  <input  class="field text full required" name="data[Member][email]" type="text" value="<?php echo $member['Member']['email'];?>" />
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
    							<label class="desc">Sales Person</label>
    							<div>
    							  <input  class="field text" id = "SalesPerson" name="data[Member][company_user_type]" type="checkbox" value = "sales_person" <?php  if($member['Member']['company_user_type'] == 'sales_person') { ?> checked  <?php } ?>/>
    							
								<input type = "hidden" name = "data[Member][company_user_type_checked]" value = "<?php if($member['Member']['company_user_type'] == 'sales_person'):echo '1';else: echo '0';endif;?>">
								</div>
						  </li>
        					</ul>
            </div> <!-- end of content box wrapper -->
           </div>
        </div>
            <!--------start subadmin ---------->
      <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all"> 
			 <label class="desc" for="firstname">Assign Role:</label>
				 <br>
				 <br>
				<div id="tabs-1" class="tab_content">
		       <label class="desc assign_label" for="firstname" style="display:none;">Assign Permissions:</label>
		        <br>
		             <div class="new-admin-table">
			         	<div class="new-admin-table-header-row">
			         		<div class="new-admin-table-row-part1">
			         			Module
			         		</div>
			         		<div class="new-admin-table-row-part2">
			         			View Rights
			         		</div>
			         		<div class="new-admin-table-row-part3">
			         			Editing Rights
			         		</div>
			         	</div>
			         	
			         	
			         <?php
						$permissions=$member['ModulePermission'];
						foreach($Categorylist as $cat)
						{
				          	$module_id=$cat['AdminModule']['id'];
				          	if(in_array($cat['AdminModule']['id'],$selected_module_id))
				          	{
				          		$each_permission_mod=$permission_mod[$cat['AdminModule']['id']];
				          		$update_module_id=(isset($each_permission_mod['id']))?$each_permission_mod['id']:0;
				          		$view_value=(isset($each_permission_mod['view_permission']))?$each_permission_mod['view_permission']:0;
				          		$edit_value=(isset($each_permission_mod['edit_permission']))?$each_permission_mod['edit_permission']:0;
				          	}
				          	else 
				          	{
				          		$update_module_id=0;
				          		$view_value=0;
				          		$edit_value=0;
				          	}
			          ?>
			         	<div class="new-admin-table-row">
			         		<div class="new-admin-table-row-part1">
			         			<?php 
			         			if($cat['AdminModule']['module']=='Members')
			         			{
			         				echo "Customers & Suppliers";
			         			}
								elseif($cat['AdminModule']['module']=='Referrals')
			         			{
			         				echo "Referrers";
			         			}
								elseif($cat['AdminModule']['module']=='Reconcilation Report')
			         			{
			         				echo "Payment options";
			         			}
			         			else
			         			{
			         				 echo $cat['AdminModule']['module']; 
			         			}
			                    //echo $cat['AdminModule']['module']; 
			                  ?>
			         		</div>
			         		<input type="hidden" name="ModulePermission[<?php echo $module_id;?>][id]" value="<?php echo $update_module_id;?>" />
			         		<div class="new-admin-table-row-part2">
			         			<input class="edit_view yes_view" type="radio" name="ModulePermission[<?php echo $module_id;?>][view]" value="1" <?php if($view_value==1){?> checked="true" <?php } ?> />Yes
			                 	<input class="edit_view no_view" type="radio"  name="ModulePermission[<?php echo $module_id;?>][view]" value="0" <?php if($view_value==0){?> checked="true" <?php } ?> />No
							</div>
			         		<div class="new-admin-table-row-part3">
			         			<input class="edit_permission yes_edit" type="radio"  name="ModulePermission[<?php echo $module_id;?>][edit]" value="1" <?php if($edit_value==1){?> checked="true" <?php } ?> />Yes
			                 	<input class="edit_permission no_edit" type="radio" name="ModulePermission[<?php echo $module_id;?>][edit]" value="0" <?php if($edit_value==0){?> checked="true" <?php } ?> />No
			               </div>
			         	</div>
		         <?php             
			        }
			       ?>
			         	
			       </div>
		           
				  <li>
		          <input class="submit sub-bttn" type="submit" value="Submit"/>
		        </li>
		    </div>
       </div>
            
        </fieldset>
     </form>
    <?php } ?>     
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
