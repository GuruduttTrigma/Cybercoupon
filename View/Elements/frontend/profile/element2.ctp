<div class="col-lg-9 col-sm-10 col-md-10 col-xs-12 padding_0 col-lg-offset-2 col-sm-offset-2 col-md-offset-2 user_first lvls">
											<div class="row">
												<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
													<div class="form-group">
														<label>Delivery Address:<label>
													</div>
												</div>
												<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
													<div class="edit_field">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
															<div class="form-group">
																<span> 	<?php echo $info['Member']['address']; ?> <span>
															</div>
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
															<div class="row">
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">																	
																	<div class="form-group">
																		<label>Cellphone/Mobile:</label>
																		<span><?php echo $info['Member']['phone']; ?><span>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<div class="form-group">
													<a href="javascript:void(0);" class="hide_user editButton"><span class="glyphicon glyphicon-edit "></span>Add/Edit</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-9 col-sm-12 col-md-12 col-xs-12 padding_0 col-lg-offset-2 col-sm-offset-2 col-md-offset-2 show_user edts" style="display:none;">
										<form id="2" class="frm" >										
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-3 ">
													<div class="form-group">
														<label>Address<label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input type="text" class="form-control" name="data[Member][address]" value="<?php echo $info['Member']['address']; ?>"/>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-3 ">
													<div class="form-group">
														<label>Mobile Number<label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<input type="text" class="form-control number" name="data[Member][phone]" value="<?php echo $info['Member']['phone']; ?>"/>
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