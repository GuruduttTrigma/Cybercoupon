<?php echo $this->Html->script('backend/development/ui.datepicker.js');
  echo $this->Html->css('backend/smooth.css');
?>


<script type="text/javascript">
$(document).ready(function(){
	
$('.makeDiscount').live('input',function(){
  $('.realDiscount').val('');
  var vals;
  var intRegex = /^\d+$/;
var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  $('.makeDiscount').each(function(){
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
price = $('input[name="data[Deal][selling_price]"]').val(); 
dis = $('#discount1').val();
//alert(price)
//alert(dis)
if(price != "" && dis !="" && parseInt(dis) <= 100)
{
	real = price - ((price * dis) / 100);
   $('#discount_price1').val(real);
}
else
{
	$('#discount_price1').val('');
	}
}   
})	

$('.makeDiscount1').live('input',function(){
  $('.realDiscount').val('');
  var vals;
  var intRegex = /^\d+$/;
var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  $('.makeDiscount').each(function(){
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

$('#discount_price2').val(); 
price = $('input[name="data[Deal][selling_price]"]').val(); 
dis = $('#discount2').val();
//alert(price)
//alert(dis)
if(price != "" && dis !="" && parseInt(dis) <= 100)
{
	real = price - ((price * dis) / 100);
   $('#discount_price2').val(real);
}
}   
})		
	
$('.makeDiscount2').live('input',function(){
  $('.realDiscount').val('');
  var vals;
  var intRegex = /^\d+$/;
var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  $('.makeDiscount').each(function(){
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
$('#discount_price3').val(); 
price = $('input[name="data[Deal][selling_price]"]').val(); 
dis = $('#discount3').val();
//alert(price)
//alert(dis)
if(price != "" && dis !="" && parseInt(dis) <= 100)
{
	real = price - ((price * dis) / 100);
   $('#discount_price3').val(real);
}
}   
})	
	
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
           //required:true,
					complete_url:true
        },
        "data[MemberMeta][registration_no]":
        {
          required:true,
          remote:ajax_url+'admin/Members/checkCompanyRegistrationEdit/'+memb
        },
			 "data[MemberMeta][vat_registration_no]":
        {
          required:true,
          remote:ajax_url+'admin/Members/checkCompanyRegistrationValEdit/'+memb
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
					required:"please enter city name.",
					
				},
          "data[MemberMeta][website]":
        {
           //required:"This field is required.",
					complete_url:"Please enter valid Url."
        },
        "data[MemberMeta][registration_no]":
        {
           required:'This field is required.',
           remote: "This company is already registered with us."
        },
        "data[MemberMeta][vat_registration_no]":
        {
           required:'This field is required.',
           remote: "This company is already registered with us."
        }, 
        
				
			}
		
		
		});
		
		$.validator.addMethod("cus_phone", function(value, element) {
		var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
		return (!pattern.test(value));
		}, "Not valid phone number.");
jQuery.validator.addMethod("complete_url", function(val, elem) {
    // if no url, don't do anything
    if (val.length == 0) { return true; }

    // if user has not entered http:// https:// or ftp:// assume they mean http://
    if(!/^(https?|ftp):\/\//i.test(val)) {
        val = 'http://'+val; // set both the value
        $(elem).val(val); // also update the form element
    }
    // now check if valid url
    // http://docs.jquery.com/Plugins/Validation/Methods/url
    // contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
    return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
});

		
	});
	
	


	$(function() {
		var year = (new Date()).getFullYear()
		var current_date= new Date();
		$( ".buy_from" ).datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			maxDate:current_date,
		});
	})
	$(function() {
		var year = (new Date()).getFullYear() + 5;
		var current_date= new Date();
		$( ".buy_to" ).datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			minDate:current_date
			//maxDate:current_date
		});
	})
	
	$(function() {
		var year = (new Date()).getFullYear()
		var current_date= new Date();
		$( ".redeem_from" ).datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			maxDate:current_date,
		});
	})
	$(function() {
		var year = (new Date()).getFullYear() + 5;
		var current_date= new Date();
		$( ".redeem_to" ).datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			minDate:current_date
			//maxDate:current_date
		});
	});
</script>	
	<script type="text/javascript" >
	$(document).ready(function(){
    /*var d= new Date();
    var day = d.getDate();
    var day2 = d.getDate()+1;
    var month = d.getMonth()+1;
    var year = d.getFullYear();
    var current_date=year+'/'+month+'/'+day;
	 $('.startdate').focus(function(){
		  var opt = $(this).attr('rel');
    if($(':input[name="data[Deal]['+opt+'_to]"]').val()!='')
		{
			var ens = $(':input[namElecticale="data[Deal]['+opt+'_to]"]').val().split(' ');
			var en = ens[0].split('-');
			var end_date = en[0]+'/'+en[1]+'/'+(parseInt(en[2])-1);
			$('.startdate').datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			scrollInput:false,
			maxDate:end_date,
			minDate:current_date
			})
		}
		else
		{
			$('.startdate').datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			scrollInput:false,
			minDate:current_date
			
		})
	}
});
	
	
	$('.enddate').focus(function(){
     var opt = $(this).attr('rel');
		 if($(':input[name="data[Deal]['+opt+'_from]"]').val()!='')
		{
			var ens = $(':input[name="data[Deal]['+opt+'_from]"]').val().split(' ');
			var en = ens[0].split('-');
			var start_date = en[0]+'/'+en[1]+'/'+(parseInt(en[2])+1);
			$('.enddate').datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			scrollInput:false,
			minDate:start_date,
			//maxDate:current_date
			
		})		
		}
		else
			{
		  $('.enddate').datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			scrollInput:false,
			minDate:year+'/'+month+'/'+day2
			
			})		
			}
			
	});*/

});
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
<a href="<?php echo HTTP_ROOT;?>admin/manages/locations" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
<div class="inner-page-title">
<h2>Edit Deal</h2>
<span></span>
</div>
<?php //if($member['MemberType']['name']=='customer') {?>
<form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Manages/edit_location/'.base64_encode(convert_uuencode($location['Location']['id']))?>">
	<fieldset>
   	<div class="content-box content-box-header" style="border:none;">
			<div class="column-content-box">   
            <div class="ui-state-default ui-corner-top ui-box-header">
                <span class="ui-icon float-left ui-icon-notice"></span>
	                Edit Location's Information
            </div>
            <div class="content-box-wrapper">
               <input name="data[Location][id]" type="hidden" value="<?php echo $location['Location']['id'];?>" />
               <ul>
               	  <li>
                  	<label class="desc">Location Name:<em>*</em></label>
            						<div>
            							<input  class="field text full required" name="data[Location][name]" type="text" value="<?php echo $location['Location']['name'];?>"/>
            						</div>
                  </li>
                  
                  
                 
                  
						<li>
                  	<label class="desc">Delivery Option:<em>*</em></label>
            			<div>
							<select name="data[Location][active]" class="field text full required" >						
								<option value="">Select</option>
								<option value="Yes" <?php if($location['Location']['active'] =='Yes') echo 'selected="selected"';?> >Yes</option>
								<option value="No" <?php if($location['Location']['active'] =='No') echo 'selected="selected"';?>>No</option>								
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
<div class="clearfix"></div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
<script type="text/javascript" >
$(document).ready(function(){
   $('.each_location').click(function()
	{
		$('.each_location').each(function(index){
			if($(this).is(':checked'))
			{
				$('.location_hidn').val(1);
				return false;
			}
			else
			{
				$('.location_hidn').val('');
			}
			
		});
	});
})

</script>

