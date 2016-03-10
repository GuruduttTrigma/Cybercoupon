<?php echo $this->Html->script('backend/development/ui.datepicker.js');
   echo $this->Html->css('backend/smooth.css');
?>
<script type="text/javascript">
$(document).ready(function(){
$('#company_form').css("display","block");
  var option = 0;
  $('#mem_type').live('change',function(){
    option = $('#mem_type option:selected').attr('rel');
   $(':input[type=text]').val('');
   $(':input[type=password]').val('');
   $('#customer_form').css("display","none");
   $('#supplier_form').css("display","none");
   $('#company_form').css("display","none");
   if(option == 'customer') $('#customer_form').css("display","block");
   else if(option == 'supplier') $('#supplier_form').css("display","block");
   else if(option == 'company') $('#company_form').css("display","block");
  })
$(".member_form").click(function(){
option = $('#mem_type option:selected').attr('rel');
//alert(option)

var form_id=$(this).attr('id');
if(form_id=='company_form')
{
	option='company';
}
  $('#'+form_id).validate({
			rules:
			{
				"data[Member][email]":
				{
					required:true,
					email:true,
					remote:ajax_url+'admin/Members/checkMemberEmail'
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
				"data[Member][con_password]":
				{
					required:true,
					equalTo:'#pwd_'+option
				},
				
				"data[Member][phone]":
				{
					required:true,
					cus_phone:true
				},
				"data[Member][city]":
				{
					required:true,
					//remote:ajax_url+'Members/checkMemberName'
				},
         "data[MemberMeta][website]":
        {
           required:true,
					complete_url:true
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
					required:"This field is required.",
					minlength: 'Password should be atleast 6 characters long.'
				},
				"data[Member][con_password]":
				{
					required:"This field is required.",
					equalTo:'Password and confirm password does not match.'
				},
				
				"data[Member][city]":
				{
					required:"This field is required.",
					
				},
         "data[MemberMeta][website]":
        {
           required:"This field is required.",
					complete_url:"Please enter valid Url."
        },
         
			}
		
		});


});
$('#'+option+'_form').validate();
 
		
	$.validator.addMethod("cus_phone", function(value, element) {
		var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
		return (!pattern.test(value));
	}, "Not valid phone number.");
 jQuery.validator.addMethod("complete_url", function(val, elem) {
    if (val.length == 0) { return true; }

    if(!/^(https?|ftp):\/\//i.test(val)) {
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
		maxDate:current_date
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
select.full
{
	padding:4px;
}
</style>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
    
   	<a href="<?php echo HTTP_ROOT.'admin/Members/members/'.base64_encode(convert_uuencode($member_type)); ;?>" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
			<div class="inner-page-title">
				<h2>Add Company User</h2>
               <span></span>
			</div>

    <!-- <div class="content-box content-box-header" style="border:none;display:block;">
				 <div class="ui-state-default ui-corner-top ui-box-header"> 
						<label class="desc">Member Type<em>*</em></label>
						<div>
							<select name="data[Member][member_type]" id="mem_type" class="field text full required" >
								<?php 
				            foreach($options2 as $option2)
				            {
				              if($option2['MemberType']['id']==2)
				              {
				           ?>
									<option value="<?php echo $option2['MemberType']['id'];?>" rel="<?php echo $option2['MemberType']['name']; ?>">
										<?php echo $option2['MemberType']['name']; ?>
									</option>
					
								<?php
                           }
								 }
								?>
							</select>
						  
					 </div> 
					 
				</div>	
		</div>-->
              
         
  		<form id="company_form" class="member_form" method="post" enctype="multipart/form-data" style="display:none;margin-top:15px;" action="<?php echo HTTP_ROOT.'admin/Members/addMember/'.base64_encode(convert_uuencode($member_type));?>">
				  <fieldset>
				<div class="content-box content-box-header" style="border:none;">
					<div class="column-content-box">
					
					<div class="ui-state-default ui-corner-top ui-box-header">

						<span class="ui-icon float-left ui-icon-notice"></span>

						Sub Admin Information
					</div>
					
					<div class="content-box-wrapper">
					
					  <ul>
            <input name="data[Member][member_type]" type="hidden" value="2" />
						  <li>
							<label class="desc">Name<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][name]" type="text" />
							</div>
						  </li>
						  <li>
							<label class="desc">Surname<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][surname]" type="text" />
							</div>
						  </li>
                						  
						  <li>
							<label class="desc">Email Address<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][email]" type="text" />
							</div>
						  </li>
               <li>
								<label class="desc">Password<em>*</em></label>
								<div>
								  <input class="field text full required" name="data[Member][password]" type="password" id="pwd_company" />
								</div>
						   </li>
						   <li>
								<label class="desc">Confirm Password<em>*</em></label>
								<div>
								  <input  class="field text full required" name="data[Member][con_password]" type="password" />
								</div>
						  </li>
						  <li>
    							<label class="desc">Telephone number</label>
    							<div>
    							  <input maxlength="16" class="field text full" name="data[Member][phone]" type="text" />
    							</div>
						  </li>
						  <li>
    							<label class="desc">Sales Person</label>
    							<div>
    							  <input  class="field text" id = "SalesPerson" name="data[Member][company_user_type]" type="checkbox" value = "sales_person"/>
    							</div>
						  </li>
						  
						</ul>
					  
				    </div> <!-- end of content box wrapper -->
					
					</div>
				</div>
   
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
			          $i=0;      
			          foreach($Categorylist as $cat)
			          { 
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
			                   
			                    $module_id=$cat['AdminModule']['id'];
			                  ?>
			         		</div>
			         		<div class="new-admin-table-row-part2">
			         			<input class="edit_view yes_view" type="radio" name="ModulePermission[<?php echo $module_id;?>][view]" value="1"/>Yes
			                 	<input class="edit_view no_view" type="radio" checked="checked" name="ModulePermission[<?php echo $module_id;?>][view]" value="0"/>No
							</div>
			         		<div class="new-admin-table-row-part3">
			         			<input class="edit_permission yes_edit" type="radio" name="ModulePermission[<?php echo $module_id;?>][edit]" value="1"/>Yes
			                 	<input class="edit_permission no_edit" type="radio" checked="true" name="ModulePermission[<?php echo $module_id;?>][edit]" value="0"/>No
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
<!---------------------------------------------end here sub admin form ---------------------------------->



       <form id="supplier_form" class="member_form" method="post" enctype="multipart/form-data" style="display:none;margin-top:15px;" action="<?php echo HTTP_ROOT.'admin/Members/addMember'.base64_encode(convert_uuencode($member_type));?>">
				  <fieldset>
				<div class="content-box content-box-header" style="border:none;">
					<div class="column-content-box">
					
					<div class="ui-state-default ui-corner-top ui-box-header">

						<span class="ui-icon float-left ui-icon-notice"></span>

						Supplier Information
					</div>
					
					<div class="content-box-wrapper">
					
					
						<ul>
                  <input name="data[Member][member_type]" type="hidden" value="3" />
						  <li>
							<label class="desc">Name<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][name]" type="text" />
							</div>
						  </li>
               <li>
							<label class="desc">Surname<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][surname]" type="text" />
							</div>
						  </li>
                 <li>
							<label class="desc">Telephone number<em>*</em></label>
							<div>
							  <input maxlength="16" class="field text full required cus_phone" name="data[Member][phone]" type="text" />
							</div>
						  </li>  
                <li>
							<label class="desc">Email Address<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][email]" type="text" />
							</div>
						  </li>
						  <li>
								<label class="desc">Password<em>*</em></label>
								<div>
								  <input class="field text full required" name="data[Member][password]" type="password" id="pwd_supplier" />
								</div>
						   </li>
						   <li>
								<label class="desc">Confirm Password<em>*</em></label>
								<div>
								  <input  class="field text full required" name="data[Member][con_password]" type="password" />
								</div>
						  </li>
						  <li>
							<label class="desc">Company Name<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[MemberMeta][company_name]" type="text" />
							</div>
						  </li>
                <li>
							<label class="desc">Address<em>*</em></label>
							<div>
							  <textarea class="field text full required" name="data[Member][address]" type="text"></textarea>
							</div>
						  </li>
						  <li>
						  </li>
							<li>
							<label class="desc">City<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][city]" type="text" />
							</div>
						  </li>
						  <li>
							<label class="desc">Nearest Location<em>*</em></label>
							<div class="inp_holder">
								<select name="data[Member][location]" class="field text full required" >
									<option value="">Select City</option>
                      <?php foreach ($options as $option){ ?>
										<option value="<?php echo $option['Location']['id'];?>" >
											<?php echo $option['Location']['name']; ?>
									</option>
						
									<?php } ?>
								</select>
								
							</div>
                <li>
							<label class="desc">Company Website<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[MemberMeta][website]" type="text" />
							</div>
						  </li>
                <li>
               <label class="desc">Business Type<em>*</em></label>
							<div class="inp_holder">
								<select name="data[MemberMeta][business_type]" class="field text full required" >
									<option value="">Select Business Type</option>
                      <?php foreach ($business_type as $business_type){ ?>
										<option value="<?php echo $business_type['BusinessType']['id'];?>" >
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
										<option value="<?php echo $business_cat['BusinessCategory']['id'];?>" >
											<?php echo $business_cat['BusinessCategory']['name']; ?>
									</option>
						
									<?php } ?>
								</select>
								
							</div>
                </li>
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
							  <input  class="field text full required datepicker"  readonly="readonly" name="data[MemberMeta][start_date]" type="text"  />
							</div>
						  </li>
               <li>
							<label class="desc">Registration Number<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[MemberMeta][registration_no]" type="text" />
							</div>
						  </li>
               <li>
							<label class="desc">VAT Registration Number<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[MemberMeta][vat_registration_no]" type="text" />
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
<form id="customer_form" class="member_form" method="post" enctype="multipart/form-data" style="display:none;margin-top:15px;" action="<?php echo HTTP_ROOT.'admin/Members/addMember/'.base64_encode(convert_uuencode($member_type));?>">
				  <fieldset>
				<div class="content-box content-box-header" style="border:none;">
					<div class="column-content-box">
					
					<div class="ui-state-default ui-corner-top ui-box-header">

						<span class="ui-icon float-left ui-icon-notice"></span>

						Customer Information
					</div>
					
					<div class="content-box-wrapper">
					
	           <input name="data[Member][member_type]" type="hidden" value="4" />				
						<ul>
						  <li>
							<label class="desc">Name<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][name]" type="text" />
							</div>
						  </li>
               <li>
							<label class="desc">Surname<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][surname]" type="text" />
							</div>
						  </li>
                <li>
							<label class="desc">DOB<em>*</em></label>
							<div>
							  <input  class="field text full required datepicker" readonly="readonly" name="data[Member][dob]" type="text"  />
							</div>
						  </li>
						  <li>
							<label class="desc">Email Address<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][email]" type="text" />
							</div>
						  </li>
						  <li>
								<label class="desc">Password<em>*</em></label>
								<div>
								  <input class="field text full required" name="data[Member][password]" type="password" id="pwd_customer" />
								</div>
						   </li>
						   <li>
								<label class="desc">Confirm Password<em>*</em></label>
								<div>
								  <input  class="field text full required" name="data[Member][con_password]" type="password" />
								</div>
						  </li>
               <li>
							<label class="desc">City<em>*</em></label>
							<div>
							  <input  class="field text full required" name="data[Member][city]" type="text" />
							</div>
						  </li>
						  <li>
							<label class="desc">Nearest Location<em>*</em></label>
							<div class="inp_holder">
								<select name="data[Member][location]" class="field text full required" >
									<option value="">Select City</option>
                      <?php foreach ($options as $option){ ?>
										<option value="<?php echo $option['Location']['id'];?>" >
											<?php echo $option['Location']['name']; ?>
									</option>
						
									<?php } ?>
								</select>
								
							</div>
						  
						  
						  <li>
							<label class="desc">Telephone number<em>*</em></label>
							<div>
							  <input  class="field text full required cus_phone" name="data[Member][phone]" type="text" />
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
        background: none repeat-x scroll 50% 50% rgba(0, 0, 0, 0);
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
<script>

   //var already_checked_module=[];
   //var already_checked_parentmodule=[];

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
 
 
   /*        var parent_box=0;
           $.each(already_checked_parentmodule,function(i,module_id){
					
					  if($('.adminheader_'+module_id).is(':checked'))
					  {  
						   $('.main_'+module_id).show();	
						   $('.parentselection_'+module_id).val('1');
						   parent_box=1;										     
					  }
					  else
					  {
						   $('.main_'+module_id).hide();
						   $('.parentselection_'+module_id).val('0');
					  }
           })
            if(parent_box==1)
	         {
	         	$('.assign_label').show();
	         } 
          
       //var already_checked_module=[];
       $('.parent_module').click(function(){
             var child_class=$(this).data('child');
             var split_id=child_class.split('_');
             var module_id=split_id[1];
              if($(this).is(':checked'))
              {
                   var rr=$.inArray(module_id,already_checked_module);
                   if(rr>=0)
                   {
             
                   }
                   else
                   {
                       already_checked_module.push(module_id);
                   }
                			 $('.'+child_class).show();
                   $(this).prev('input').val('1');	
                   $('.parentselection_'+module_id).val('1');										     
              }
              else
              {

                   already_checked_module.splice($.inArray(module_id,already_checked_module),1);
                   $('.child_module').hide();
                   $.each(already_checked_module,function(i,val){
                         $('.main_'+val).show();
                       //  alert('.main_'+val)
                   })
                   //$(this).prev('input').val('0');
                   $('.parentselection_'+module_id).val('0');
 
                     $('.main_'+module_id).children('h3.c2').find('.submodule').attr('checked',false);
    		               $('.main_'+module_id).children('h3.c2').find('.submodule').prev('input').val('0');
    															     $('.main_'+module_id).find('.submodule_permission').attr('checked',false);
    															     $('.main_'+module_id).find('.submodule_permission').prev('input').val('0');
    
                     $('.child_module').each(function(index){
                       var submodule_id=$(this).data('submodule');
                      if(!$.inArray(submodule_id,already_checked_module))
                      {

                       $('.main_'+submodule_id).children('h3.c2').find('.submodule').attr('checked',false);
                       $('.main_'+submodule_id).children('h3.c2').find('.submodule').prev('input').val('0');
																				        $('.main_'+submodule_id).find('.submodule_permission').attr('checked',false);
																			        	$('.main_'+submodule_id).find('.submodule_permission').prev('input').val('0');
                      }
                       
                  })


			
              }
              
              var parent_box2=0;
              $('.parent_module').each(function(){
                   if($(this).is(':checked'))
                   {
                      parent_box2=1;
                   }
              	})
              	if(parent_box2==1)
              	{
              		$('.assign_label').show();
              	}
              	else
              	{
              		$('.assign_label').hide();
              	}
            
            
     });

     $('.submodule_permission').click(function(){
              if($(this).is(':checked'))
              {
                   $(this).siblings('h3.c2')	.children('.submodule')	.attr('checked',true);
                   $(this).siblings('h3.c2')	.children('.submodule')	.prev('input').val('1');	
                   $(this).prev('input').val('1');
                   $(this).siblings('.view_permission').attr('checked',true);
                   $(this).siblings('.view_permission').prev('input').val('1');		     
              }
              else
              {
                  var permission_checkbox=0;
                  $(this).siblings('input').each(function(index){
                      if($(this).is(':checked'))
                      {
                        permission_checkbox=1;
                      }
                   })

                  if(!permission_checkbox)
                  {
                    $(this).siblings('h3.c2')	.children('.submodule').attr('checked',false);
                    $(this).siblings('h3.c2')	.children('.submodule')	.prev('input').val('0');
                  }
                 if($(this).hasClass('view_permission') && (permission_checkbox==1))
															{
															   $(this).attr('checked',true);
                    $(this).prev('input').val('1');
															}
															else
															{
                    $(this).prev('input').val('0');	
                 }
                  //$(this).prev('input').val('0');		
              }
            
            
     });

     $('.submodule').click(function(){
              if($(this).is(':checked'))
              {
                   $(this).parent('h3.c2')	.siblings('.view_permission')	.attr('checked',true);
                   $(this).parent('h3.c2')	.siblings('.view_permission')	.prev('input').val('1');
                   $(this).prev('input').val('1');
              }
              else
              {
                  $(this).prev('input').val('0');
                   $(this).parent('h3.c2')	.siblings('input.submodule_permission').each(function(index){
                      $(this).attr('checked',false);
                      $(this).prev('input').val('0');
                   })	
              }
            
            
     });
*/





 });
</script>