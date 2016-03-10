<?php  echo $this->Html->script('frontend/design/jquery.datetimepicker.js');?>
<?php  echo $this->Html->css('frontend/jquery.datetimepicker.css');  ?>
<style>
.margintop10{
	margin-top: 10px;
}
.padding_heading {
    margin-bottom: 12px;
}
.help_business
{margin-top: 37px;}
.modal-content {
    border: 5px solid #e5e5e5;
     border-radius: 3px;
     }
.click_here
{

margin:6px 0px 6px 0px;
}
.click_here_top
{

margin:0px 0px 6px 0px;
}
.click_here_bottom
{

margin:6px 0px 0px 0px;
}
</style>
<script>
$(document).ready(function(){
$('#SupplierForm').validate({
		rules:
			{
				"data[Member][email]":
				{
					required:true,
					email:true,
					remote:ajax_url+'customers/checkMemberEmail'
				},
				
				"data[Member][phone]":
				{
					required:true,
					cus_phone:true
				},
				"data[MemberMeta][landline]":
				{
					required:true,
					cus_phone:true
				},
       "data[MemberMeta][website]":
        {
          	complete_url:true
        }
       
			},
			messages:
			{
				"data[Member][email]":
				{
					required:'This field is required.',
					email:'Please enter valid email.',
					remote:'Email address already exists.'
				},
			 "data[Member][phone]":
				{
					required:"This field is required.",
					cus_phone:"Please enter valid phone number."
				},
				"data[MemberMeta][landline]":
				{
					required:"This field is required.",
					cus_phone:"Please enter valid landline number."
				},
          "data[MemberMeta][website]":
          {
          	complete_url:"Please enter valid Url."
          }
		  }
});
$.validator.addMethod("cus_phone", function(value, element) {
		var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
		return (!pattern.test(value));
	}, "Not valid number.");

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
})
</script>

<!-- Supplier area page -->
				<div class="supplier_container">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<div class="supplier_heading">
							<h1>Want to work with Cyber Coupon?</h1>
						</div>
						<div class="suplier_content">
							<?php echo ucfirst($Want_to_work_with_Cybercoupon['CmsPage']['content']); ?>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="suplier_form">
               	<form action="<?php echo HTTP_ROOT;?>Suppliers/register" method="post" id="SupplierForm">
							<div class="padding_heading">
								<p><em>*</em> Required Field</p>
							</div>
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
									<div class="about_business">
										<div class="padding_heading">
											<h1>About your business</h1>
										</div>
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[MemberMeta][company_name]" placeholder="Business Name*" class="form-control required">
												</div>
											</div>
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[MemberMeta][trading]" placeholder="Trading As*" class="form-control">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[Member][name]" placeholder="Your first name*" class="form-control required">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[Member][surname]" placeholder="Your last name*" class="form-control required">
												</div>
											</div>
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[Member][address]" placeholder="Physical Address (no PO Box's)*" class="form-control required">
												</div>
											</div>
                        			<div class="clearfix"></div>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[Member][city]" placeholder="Town/City*" class="form-control required">
												</div>
											</div>
                        			<?php /*<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<select name="data[Member][location]" class="required">
														<option value="">Nearest Location*</option>
														<?php if(!empty($cities)) {
                                     foreach($cities as $cty) { ?>
                                 <option value="<?php echo $cty['Location']['id'];?>"><?php echo $cty['Location']['name'];?></option>
                                <?php } } ?>  
													</select>
												</div>
											</div> */ ?>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" maxlength="16" placeholder="Mobile Number*" name="data[Member][phone]" class="form-control required">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" maxlength="16" placeholder="Landline Number*" name="data[MemberMeta][landline]" class="form-control required">
												</div>
											</div>
											
											<!--<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<select name="country" class="required">
														<option value="">Country*</option>
														<option>South Africa</option>
													</select>
												</div>
											</div>-->

											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[MemberMeta][website]" placeholder="Website*" class="form-control required">
												</div>
											</div>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" placeholder="Email address*" name="data[Member][email]" class="form-control required">
												</div>
											</div>
											<div class="clearfix"></div>
											<!--<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<select name="data[MemberMeta][business_category]" class="required">
														<option value="">In what Industry do you do business?*</option>
														<?php if(!empty($business_cat)){
                                      foreach($business_cat as $type){ ?>
                                      <option value="<?php echo $type['BusinessCategory']['id'];?>"><?php echo $type['BusinessCategory']['name'];?></option>
                                    <?php } }?>
                             </select>
												</div>
											</div> -->
											<!--<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<select name="data[MemberMeta][business_type]" class="required">
														<option value="">Company Type*</option>
														<?php if(!empty($business_type)){
                                      foreach($business_type as $type){ ?>
                                      <option value="<?php echo $type['BusinessType']['id'];?>"><?php echo $type['BusinessType']['name'];?></option>
                                    <?php } }?>
                             </select>
												</div>
											</div>-->
											<!--<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<select name="data[MemberMeta][total_locations]" class="required">
														<option value="">How many locations do you have?*</option>
														<option>None-Mobile</option>
														<option>1</option>
													</select>
												</div>
											</div>-->
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[MemberMeta][registration_no]" placeholder="Company Registration Number (N/A-if not registered)" class="form-control">
												</div>
											</div>
											<div class=""></div>
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" name="data[MemberMeta][vat_registration_no]" placeholder=" VAT Registration Number (N/A if not registered)" class="form-control">
												</div>
											</div>
											<!--
											<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
												<div class="form-group">
													<input type="text" id="datepicker" readonly="readonly" name="data[MemberMeta][start_date]" placeholder=" Business Start Date (dd/mm/yyyy)*" class="form-control required">
												</div>
											</div>-->
											
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
									<div class="help_business">
										<div class="padding_heading">
											<h1>How  can we help your business?</h1>
										</div>
											<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<label class="radio-inline">
												  <input name="data[MemberMeta][joining_cause]" id="radio1" value="deals" checked="checked" type="radio"> 
												  <span><strong>Featured Deals:</strong> 	Get me tons of exposure and new customers.</span>
												</label>
											</div>
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<label class="radio-inline">
												  <input name="data[MemberMeta][joining_cause]" id="radio2" value="goods"  type="radio"> 
												  <span><strong>Cybercoupon Goods:</strong> Introduce my product to a larger audience.</span>
												</label>
											</div>-->
											<div class="row">
											<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
												<div class="form-group">
												<textarea name="data[MemberMeta][cause_description]" placeholder="Tell us what products or services you want to promote?" class="required"></textarea>	
												</div>
											</div>
											<div class="clearfix"></div>
											<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<div class="form-group">
													<p>
														<input type="checkbox" name="data[Member][newsletters]" value="Yes" />
														Yes, I want to receive emails about the latest Cyber Coupon news, products and services.
													</p>
												</div>
											</div>-->
											<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12 margintop10">
												<input type="Submit" class="btn btn-primary" value="Submit" />
                           <!-- <a href="javascript:void(0);" class="btn btn-primary">Submit</a>-->
											</div>
											<div class="col-lg-10 col-sm-10 col-md-10 col-xs-12 margintop10">
												<p class="click_here_top"><span class="margintop10">To see the reasons why you should use us, <a href="#" data-toggle="modal" data-target="#myModal1"><img src="<?php echo HTTP_ROOT; ?>img/frontend/click_here.png"></a></span>
												</p>
												<p class="click_here"><span class="margintop10">To see the discount you should offer customers based on your industry, <a href="#" data-toggle="modal" data-target="#myModal2"><img src="<?php echo HTTP_ROOT; ?>img/frontend/click_here.png"></a></span>
												</p>
												<p class="click_here"><span class="margintop10">To see the commission we will take per sale we bring you, <a href="#" data-toggle="modal" data-target="#myModal3"><img src="<?php echo HTTP_ROOT; ?>img/frontend/click_here.png"></a></span>
												</p>
												<p class="click_here"><span class="margintop10">To see if your business type is eligible to offer its products via Cyber Coupon,  <a href="#" data-toggle="modal" data-target="#myModal4"><img src="<?php echo HTTP_ROOT; ?>img/frontend/click_here.png"></a></span>
												</p>
												<p class="click_here_bottom"><span class="margintop10">To see answers to the Supplier Frequently Asked Questions,<a class="" href="<?php echo HTTP_ROOT; ?>homes/suppliers_faq" target="_blank"> <img src="<?php echo HTTP_ROOT; ?>img/frontend/click_here.png"></a></span></p>
												<!--<p class="click_here"><span class="margintop10">Competitions,  <a href="#" data-toggle="modal" data-target="#myModal5"><img src="<?php echo HTTP_ROOT; ?>img/frontend/click_here.png"></a></span></p>-->
											</div>
										</div>
									</div>
								</div>
							</div>
                </form>
                <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" style="word-wrap: break-word;"><?php echo ucfirst($reasons['CmsPage']['page_title']); ?></h4>
      </div>
      <div class="modal-body" style="word-wrap: break-word;">
        <?php echo ucfirst($reasons['CmsPage']['content']); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" style="word-wrap: break-word;"><?php echo ucfirst($discount['CmsPage']['page_title']); ?></h4>
      </div>
      <div class="modal-body" style="word-wrap: break-word;">
               <?php echo ucfirst($discount['CmsPage']['content']); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" style="word-wrap: break-word;"><?php echo ucfirst($commission['CmsPage']['page_title']); ?></h4>
      </div>
      <div class="modal-body" style="word-wrap: break-word;">
        <?php echo ucfirst($commission['CmsPage']['content']); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" style="word-wrap: break-word;"><?php echo ucfirst($business_type['CmsPage']['page_title']); ?></h4>
      </div>
      <div class="modal-body" style="word-wrap: break-word;">
        <?php echo ucfirst($business_type['CmsPage']['content']); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel" style="word-wrap: break-word;"><?php echo ucfirst($competitions['CmsPage']['page_title']); ?></h4>
      </div>
      <div class="modal-body" style="word-wrap: break-word;">
        <?php echo ucfirst($competitions['CmsPage']['content']); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

						</div>
					</div>
				</div>
				<!-- End Supplier area page -->