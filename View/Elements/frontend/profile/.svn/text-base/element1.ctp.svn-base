<?php $dob = explode('-',$info['Member']['dob']);
			$year = (int)$dob[0];
			$month = (int)$dob[1];
			$day = (int)$dob[2];
		//pr($dob);die;
		?>
<div class="col-lg-9 col-sm-10 col-md-10 col-xs-12 padding_0 col-lg-offset-2 col-sm-offset-2 col-md-offset-2 show_div lvls">
										<div class="row">
											<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
												<div class="form-group">
													<label>Name:<label>
												</div>
											</div>
											<div class="col-lg-5 col-sm-5 col-md-5 col-lg-5">
												<div class="edit_field">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
														<div class="form-group">
															<span><?php echo ucwords($info['Member']['name'].' '.$info['Member']['surname']);?><span>
															<input type="hidden" value="<?php echo $info['Member']['name']; ?>" id="edit_mem_name">
														</div>
													</div>
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
														<div class="row">
															<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
												<div class="form-group">
												<a href="javascript:void(0);" class="editButton"><span class="glyphicon glyphicon-edit  "></span>Add/Edit</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-9 col-sm-12 col-md-12 col-xs-12 padding_0 col-lg-offset-2 col-sm-offset-2 col-md-offset-2 show_edit edts" style="display:none;">
										<form id="1" class="frm" >
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12 ">
													<div class="form-group">
														<label>First Name<em>*</em><label>
													</div>
												</div>
												<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
													<div class="form-group">
														<input type="text" class="form-control required" name="data[Member][name]" value="<?php echo $info['Member']['name']; ?>"/>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-3 col-sm-3  col-md-3  col-xs-12 ">
													<div class="form-group">
														<label>Last Name<em>*</em><label>
													</div>
												</div>
												<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
													<div class="form-group">
														<input type="text" class="form-control required" name="data[Member][surname]" value="<?php echo $info['Member']['surname']; ?>"/>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="row">
												<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
													<div class="row">
														<div class="form-group">
															<div class ="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																<div class="auto_select_div">
																	<!--<div class="picker" id="picker1"></div>-->
																</div>
															</div>
														</div>
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
									<div class="clearfix"></div>
<script>
$(document).ready(function(){
	var d= new Date();
			var day = d.getDate();
			var month = d.getMonth()+1;
			var year = d.getFullYear();
	
			var final_date=year+'/'+month+'/'+day;

			$('.datepicker').datetimepicker({
					timepicker:false,
					format:'Y-m-d',
					scrollInput:false,
					maxDate:final_date
			});
			$("#picker1").birthdaypicker({});

        $("#picker2").birthdaypicker({
          futureDates: true,
          maxYear: 2020,
          maxAge: 75,
          defaultDate: "10-17-1980"
        });
        $("#picker3").birthdaypicker({
          dateFormat: "bigEndian",
          monthFormat: "long",
          placeholder: false,
          hiddenDate: false
        });
        $("#picker4").birthdaypicker({
          minAge: 13
        });
		$('.dyy<?php echo $year; ?>').attr('selected',true);
		$('.dmm<?php echo $month; ?>').attr('selected',true);
		$('.ddd<?php echo $day; ?>').attr('selected',true);
		$('#birthdate').val('<?php echo $info['Member']['dob']; ?>');
})
</script>