<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
											<div class="subscription_emial">
											<h2>Tell us which multiple newsletters you'd like to receive. You can change these at any time.</h2>
											<form id="newsform">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-3 ">
													<div class="form-group">
														<label class="margin_0">Nearest Location:<em>*</em><label>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<select name="data[Member][location]" class="required mystl">
																<option value="">Select Nearest Location</option>
																<?php if(!empty($loc)) {
																	 foreach($loc as $lc) { ?>
																 <option value="<?php echo $lc['Location']['id'];?>" <?php if($info['Member']['location']==$lc['Location']['id']){ echo 'selected="selected"'; } ?>><?php echo $lc['Location']['name'];?></option>
																<?php } } ?>
														</select>
													</div>
												</div>
											</div>
											</div>
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<div class="row">
													<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
														<div class="form-group">
														<label>Your E-mail:</label>
														</div>
													</div>
													<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 ">
														<div class="form-group">
														<span class="setemail"><?php echo $info['Member']['email'];?></span>
														</div>
													</div>
												</div>
											</div>
											<div class="under_sub"></div>
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<div class="row">
													<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
														<div class="form-group">
														<label>You are
currently subscribed to these Newsletters:</label>
														</div>
													</div>
													<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 ">
														<div class="cap_link">
															<div class="form-group selected_news_loc append_loc">
															
															
															<?php
															if($info['Member']['news_location']!='')
																$newsloc= explode(',',$info['Member']['news_location']);
															else 
																$newsloc= array();
															
														   $manadatory_loc=array();
														   $alldeal_loc=array();
														   if(!empty($loc))
														   {
																foreach($loc as $lc1) 
																{ 
																   $alldeal_loc=$lc1['Location']['id'];
																   if($lc1['Location']['mandatory_location']=='Yes')
																   {
																   	$manadatory_loc[]=$lc1['Location']['id'];
																   }
																}
															}
															//pr($manadatory_loc);die;
															if($info['Member']['news_location_updation']=='Yes')
															{
																$manadatory_loc=array();
															}
															
															$unchanged_loc=$info['Member']['location'];
															$all_news_loc=$newsloc;
                                             array_push($all_news_loc,$info['Member']['location']);
															array_unique($all_news_loc);
															
															$rest_manadatory=array();
															$already_exist_manadatory=array_intersect($manadatory_loc,$all_news_loc);
															if(empty($already_exist_manadatory))
															{
																$rest_manadatory=$manadatory_loc;
															}
															else
															{
																$rest_manadatory=array_diff($already_exist_manadatory,$manadatory_loc);
															}
															
															
														
															if(!empty($all_news_loc))
															{	
																foreach($loc as $lc1) 
																{ 
																   if(in_array($lc1['Location']['id'],$all_news_loc))
																   {
																   	?>
																   	<p class="cross_btn newsptag" rel="<?php echo $lc1['Location']['id']; ?>">
																		<?php 
																		  echo $lc1['Location']['name'];
																		 if($lc1['Location']['id']!=$unchanged_loc)
																       {
																		 ?>
																			<a href="javascript:void(0);" class="crossptag">
													 							<span class="glyphicon glyphicon-remove"></span>
																			</a>
																		<?php
																		 } 
																		 ?>
																		</p>
																	<?php
																   }
																   if(!empty($manadatory_loc)  && in_array($lc1['Location']['id'],$rest_manadatory))
																   { 
																   	?>
																   	<p class="cross_btn newsptag" rel="<?php echo $lc1['Location']['id']; ?>">
																		<?php 
																		  echo $lc1['Location']['name'];
																		 ?>
																			<a href="javascript:void(0);" class="crossptag">
													 							<span class="glyphicon glyphicon-remove"></span>
																			</a>
																		</p>
																	<?php
																	}
																	   
																	
																}
															}
															
															
										              ?>
															
														
															</div>
														</div>
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 ">
															<div class="form-group">
																<h2>You can subscribe to additional newsletters by selecting from the dropdown list below:</h2>
															</div>
														</div>
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 ">
															<div class="form-group">
																<select class="newsletter_loc locSub">
																	<option value="">Additional News Letters</option>
																	<?php
																		 foreach($loc as $lc) { ?>
																	 <option class="locs" value="<?php echo $lc['Location']['id'];?>" ><?php echo $lc['Location']['name'];?></option>
																	<?php }  ?>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
												<div class="under_sub"></div>
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<div class="row">
													<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
													</div>
													

		<div class="col-lg-9 col-sm-9 col-md-9 col-xs-12 ">
		</div>
		<!--	<div class="under_sub"></div>-->
			<div class="hidden_sub">
			<?php	
			if(!empty($newsloc))
			{
				foreach($newsloc as $list)
				{  ?>
					<input class="newsletter_hidden" name="data[News][]" id="input_<?php echo $list; ?>" type="hidden" value="<?php echo $list; ?>">
			<?php
			   }
			} 
			if(!empty($manadatory_loc))
		   {
		   	foreach($rest_manadatory as $eachdatory)
		   	{ 
		   ?>
		   	<input class="newsletter_hidden" name="data[News][]" id="input_<?php echo $eachdatory; ?>" type="hidden" value="<?php echo $eachdatory; ?>">
			<?php
			   }
			}
			?>
			</div>
		<div class="col-lg-9 col-sm-9 col-md-9 col-xs-9 col-sm-offset-3 col-md-offset-3 col-xs-offset-0 ">
			<input type="button" class="btn btn-primary newsSave" value="Save">
			<div class="image_display" style="float:left;display:none;">
                   <img src="<?php echo HTTP_ROOT.'img/backend/loader.gif'; ?>" />
                </div>
		</div>
</form>

												</div>
											</div>
											</div>
										</div>