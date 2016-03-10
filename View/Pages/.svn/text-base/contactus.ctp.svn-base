<?php  //echo $this->Html->script('frontend/design/jquery.datetimepicker.js');?>
<?php  //echo $this->Html->css('frontend/jquery.datetimepicker.css');  ?>
<!--. . . . .live chat start......-->
<script type="text/javascript">
	var swiftscriptelemgvtdgf912c = document.createElement("script");
	swiftscriptelemgvtdgf912c.type="text/javascript";
	var swiftrandom = Math.floor(Math.random()*1001); 
	var swiftuniqueid="gvtdgf912c"; 
	var swifttagurlgvtdgf912c="https://badgergroup.kayako.com/visitor/index.php?/Default/LiveChat/HTML/HTMLButton/cHJvbXB0dHlwZT1jaGF0JnVuaXF1ZWlkPWd2dGRnZjkxMmMmdmVyc2lvbj00LjY3LjAmcHJvZHVjdD1mdXNpb24mY3VzdG9tb25saW5lPSZjdXN0b21vZmZsaW5lPSZjdXN0b21hd2F5PSZjdXN0b21iYWNrc2hvcnRseT0KN2I1M2NmMjVlYjYxYjgzZjMzNTk4M2M1ZDQxMjBiNmI1Y2E0OTQyOA==";
	setTimeout("swiftscriptelemgvtdgf912c.src=swifttagurlgvtdgf912c;document.getElementById('swifttagcontainergvtdgf912c').appendChild(swiftscriptelemgvtdgf912c);",1);
</script>
<!--. . . . .end of live chat......-->
<script>
$(document).ready(function(){
$('#ContactForm').validate({
		rules:
			{	
				"data[Contact][name]":
       		{
					required:true,
        		},
				"data[Contact][email]":
				{
					required:true,
					email:true,
					//remote:ajax_url+'customers/checkMemberEmail'
				},
				
				"data[Contact][phone]":
				{
					required:true,
					cus_phone:true
				},
				"data[Contact][subject]":
       		{
					required:true
        		},
        		"data[Contact][message]":
       		{
					required:true
        		}
      	},
			messages:
			{
				"data[Contact][name]":
       		{
					required:'This field is required.',
        		},
				"data[Contact][email]":
				{
					required:'This field is required.',
					email:'Please enter valid email.',
					remote:'Email address already exists.'
				},
			 "data[Contact][phone]":
				{
					required:"This field is required.",
					cus_phone:"Please enter valid phone number."
				},
				"data[Contact][subject]":
       		{
					required:'This field is required.'
        		},
				"data[Contact][message]":
       		{
					required:'This field is required.'
        		}    		
			}
});
$.validator.addMethod("cus_phone", function(value, element) {
		var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
		return (!pattern.test(value));
	}, "Not valid phone number.");

/*jQuery.validator.addMethod("complete_url", function(val, elem) {
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

var d= new Date();
 var day = d.getDate();
    var month = d.getMonth()+1;
    var year = d.getFullYear();
	
var final_date=year+'/'+month+'/'+day;

	
			$('#datepicker').datetimepicker({
			timepicker:false,
			format:'d-m-Y',
			scrollInput:false,
			maxDate:final_date
	});
})*/
});
</script>

<style>
select.full
{
	padding:4px;
}
</style>
<div class="login_wrapper">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="new_user_area">
			<div class="login_heading margin_bottom_42">
				<h1>
					<!--<span class=" glyphicon glyphicon-phone-alt"></span>-->
						Contact Us
				</h1>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6">
					<div class="thumbnail">
						<img src="<?php echo HTTP_ROOT; ?>img/frontend/contactus2.jpg" alt="" >
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 col-lg-6 margintop10 text-center">
					
									
					   	<p class=""> <i class="glyphicon glyphicon-envelope contactusicon"></i><span>	 Contact the email help desk via our email ticketing system via this email address - </span><a href="#">support&#64;cybercouponsa.com </a> </p> 
					<br>
					
					
					
					<!--<p class="speak"><a href="#">support@cybercouponsa.com </a></p>-->
					
					<p class="speak">OR</p>
					<br>
					<p class="speak_2">Speak to us via Live Chat <br>
						by clicking on the icon below<br>
						Available from Mon - Fri/08h00-17h00</p>
					<div>
									     <div id="proactivechatcontainergvtdgf912c"></div>
								        <table border="0" cellspacing="2" cellpadding="2">
								            <tr>
								                <td align="center" id="swifttagcontainergvtdgf912c">
								                    <div style="display: inline;" id="swifttagdatacontainergvtdgf912c"></div>
								                </td> 
								            </tr>
								            <tr>
								                <td align="center">
								                    <div style="MARGIN-TOP: 2px; WIDTH: 100%; TEXT-ALIGN: center;">
								                        <span style="FONT-SIZE: 9px; FONT-FAMILY: Tahoma, Arial, Helvetica, sans-serif;">
								                            <a href="http://www.kayako.com/products/live-chat-software/" style="TEXT-DECORATION:none; COLOR: #000000" target="_blank">Live Chat Software</a>
								                            <span style="COLOR: #000000"> by </span>Kayako
								                        </span>
								                    </div>
								                </td>
								            </tr>
								        </table>
									</div>			
			</div>
		</div>
	</div>
</div>

