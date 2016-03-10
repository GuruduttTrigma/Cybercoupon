<!-- footer -->
<script type="text/javascript">

function searching()
{
		var member_type = $('#member_type').val();

	   var t = new Date().getTime();
			t =t.toString();
			$(".image_display").show();
			$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	$.ajax({
		url:ajax_url+'admin/Members/members/'+uri,
		type:'post',
		data:$("#search").serialize(),
		success:function(resp)
		 {
		   $('.image_display').css('display','none');
		   $('.search_list').html(resp);
		 }
	});
	return false;
}

</script>
<div class="col-lg-12 col-lg-12 col-lg-12 col-lg-12 padding_0">
					<div class="footer_wraper">
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-12">
							<div class="contact_us">
								<div class="footer_heading">
									<h1>How it works</h1>
								</div>
								<ul class="list-unstyled">
									<li>
									<a href="<?php echo HTTP_ROOT; ?>overview">Overview</a>								
									</li>
									<li>
									<a href="<?php echo HTTP_ROOT; ?>customers">For Customers</a>								
									</li>
									<li>
									<a href="<?php echo HTTP_ROOT; ?>homes/faq">Customer FAQ</a>
									</li>
									<li>
									<a href="<?php echo HTTP_ROOT; ?>suppliers">For Suppliers</a>																
									</li>																	
								</ul>
							</div>
							
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
							<div class="contact_us m_align">
								<div class="footer_heading">
									<h1>Contact</h1>
								</div>
								<ul class="list-unstyled">
								<li>
								<li>
								<label>To contact us, <a href="<?php echo HTTP_ROOT.'Pages/contactus';?>" class="click">Click here</a></label>
								</li>
								 <!-- live2support.com tracking codes starts -->
								<!--<div>
									<div id="proactivechatcontainerdpwep0bd4o"></div>
										<table border="0" cellspacing="2" cellpadding="2">
											<tr>
												<td align="center" id="swifttagcontainerdpwep0bd4o">
													<div style="display: inline;" id="swifttagdatacontainerdpwep0bd4o"></div>
												</td> 
											</tr>
											<tr>
												<td align="center">
													<div style="MARGIN-TOP: 2px; WIDTH: 100%; TEXT-ALIGN:center;">
														<span style="FONT-SIZE: 9px; FONT-FAMILY: Tahoma, Arial,Helvetica, sans-serif;">
															<a href="http://www.kayako.com/products/live-chat-software/" style="TEXT-DECORATION:
									none; COLOR: #000000" target="_blank">Live Chat Software</a>
															<span style="COLOR: #000000"> by</span>Kayako
														</span>
													</div>
												</td>
											</tr>
										</table>
									</div> -->
									<!--<div>
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
									</div> -->
									
	        
							 <!-- live2support.com tracking codes closed -->								
								</li>
								<!--<li>
								<a href="<?php echo HTTP_ROOT.'Pages/contactus';?>"><span class="glyphicon glyphicon-envelope"></span>info@cybercoupon.co.za</a> 
								</li>-->
								
							</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
							<div class="about_site">
								<div class="footer_heading">
									<h1>About Us</h1>
								</div>
								<ul class="list-unstyled">
								<li>
								<?php //echo $privacyPolicy['CmsPage']['uri']; ?>
								<a  href="<?php echo HTTP_ROOT; ?>about_us">About Us</a>								
								
								</li>
								<li>
								<a  href="<?php echo HTTP_ROOT; ?>term_conditions">Terms & Conditions</a>
								</li>
								<li>
								<a  href="<?php echo HTTP_ROOT; ?>private_policy">Privacy Policy</a>
								</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12  ">
								<div class="inner_contact_us">
									<div class="footer_heading">
										<h1>Follow Us On</h1>
									</div>
									<ul class="list-unstyled list-inline text-center">
										<li><a href="https://www.facebook.com/pages/Cyber-Coupon/519578321519559" target="_blank"><img src="<?php echo HTTP_ROOT;?>img/frontend/f_fb.png"/></a></li>
									</ul>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
								<div class="footer_img">
									<img src="<?php echo HTTP_ROOT;?>img/frontend/Site-Badge1.png"/>
								</div>
							</div>
						</div>
					</div>
				</div>


         <!-- inner footer -->
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
					<div class="site_reserved">
						<p>
						<!--Copyright © 2014 Cyber Coupon - All Rights Reserved.-->
						<?php echo $copyright['CmsPage']['content']; ?>
					</p>
					</div>
				</div>


<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-56342840-1', 'auto');
ga('send', 'pageview');

</script>