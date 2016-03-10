<div class="col-lg-9 col-sm-10 col-md-10 col-xs-12 padding_0 col-lg-offset-2 col-sm-offset-2 col-md-offset-2 hide_email lvls">
										<div class="row">
											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
												<div class="form-group">
													<label>E-mail:<label>
												</div>
											</div>
											<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
												<div class="edit_field">
													<div class="col-lg-12 padding_0">
														<div class="form-group">
															<span class="getemail"><?php echo $info['Member']['email'];?></span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
												<div class="form-group">
												<a href="javascript:void(0);" class="email_address editButton"><span class="glyphicon glyphicon-edit "></span>Add/Edit</a>
												</div>
											</div>
										</div>
										</div>
										<div class="col-lg-9 col-sm-12 col-md-12 col-xs-12 padding_0 col-lg-offset-2 col-sm-offset-2 col-md-offset-2 show_email edts" style="display:none;">
										    <form id="4"  class="frm" >
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="row">
														<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 ">
															<div class="form-group">
																<label>E-mail Address<em>*</em><label>
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
															<div class="form-group">
																<input type="text" id="eml" name="data[Member][email]" class="form-control required email"/>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="row">
														<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 ">
															<div class="form-group">
																<label>Confirm<em>*</em><label>
															</div>
														</div>
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="form-group">
																<input type="text" name="data[Member][cemail]" class="form-control required email"/>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
													<div class="row">
														<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12  ">
															<div class="form-group">
																<label>Your Password<em>*</em><label>
															</div>
														</div>
														<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
															<div class="form-group">
																<input type="password" id="pswds" name="data[Member][pass]" class="form-control required"/>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 padding_0 ">
													<div class="save_btn">
													<input type="button" class="btn btn-primary svs1" value="Save">
													<input type="reset" class="btn btn-success show_div_second cnls" value="Cancel">
													</div>
												</div>
											</form>
										</div>