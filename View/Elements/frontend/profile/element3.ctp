<div class="col-lg-9 col-sm-10 col-md-10 col-xs-12 padding_0 col-lg-offset-2 col-sm-offset-2 col-md-offset-2 hide_delivery lvls">
											<div class="row">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<div class="form-group">
														<label>Delivery Address:<label>
													</div>
												</div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
													<div class="edit_field">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
															<div class="form-group">
																<span><a href="javascript:void(0);" class="show_address_div editButton" ><span class="glyphicon glyphicon-hand-right "></span> Here You can enter your delivery address</a> </span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-9 col-sm-12 col-md-12 col-xs-12 padding_0 col-lg-offset-2 col-sm-offset-2 col-md-offset-2 delivery_address edts" style="display:none;">
										<form id="3"  class="frm" >
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-3 ">
													<div class="form-group">
														<label>Address<em>*</em><label>
													</div>
												</div>
												
												<div class="col-lg-6">
													<div class="form-group">
														<textarea class="form-control required"  name="data[MemberMeta][shippingaddress_firstline]" placeholder="Address"><?php echo @$info['MemberMeta']['shippingaddress_firstline']; ?></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-3 ">
													<div class="form-group">
														<label>City<em>*</em><label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input type="text" class="form-control required" name="data[MemberMeta][shippingaddress_city]" value="<?php echo @$info['MemberMeta']['shippingaddress_city']; ?>"/>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-3 ">
													<div class="form-group">
														<label>Postcode<em>*</em><label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input type="text" class="form-control required number" name="data[MemberMeta][shippingaddress_zip]" value="<?php echo @$info['MemberMeta']['shippingaddress_zip']; ?>"/>
													</div>
												</div>
											</div>
										</div>										
										<div class="col-lg-5 col-lg-offset-3 padding_0 ">
											<div class="save_btn">
													<input type="button" class="btn btn-primary svs" value="Save">
													<input type="reset" class="btn btn-success show_div_second cnls" value="Cancel">
											</div>
										</div>
										</form>
										</div>