<?php  echo $this->Html->script('frontend/design/jquery.datetimepicker.js');?>
<?php  echo $this->Html->css('frontend/jquery.datetimepicker.css');  ?>
<?php  echo $this->Html->script('frontend/development/bday-picker.js');  ?>	
	<!-- profile area page -->
				<div class="supplier_container">
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<div class="supplier_heading">
							<h1>My Profile</h1>
									
						</div>
						
					</div>
					<div class="BaseStatus session_div" style="float: none ! important; display: none;" id="scrool"></div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<div class="tab_pabel_container">
							<ul id="tabs">
								<li><a href="#" name="#tab1"><span class="glyphicon glyphicon-user"></span>My Account</a></li>
								<li><a href="#" name="#tab2"><span class="glyphicon glyphicon-gift"></span>My Orders</a></li>
								<!--<li><a href="#" name="#tab3"> <span class="glyphicon glyphicon-comment"></span>My Messages</a></li>-->
								<li><a href="#" name="#tab4"><span class="glyphicon glyphicon-shopping-cart"></span>My wishlist</a></li>
								<li><a href="#" name="#tab5" class="nwl"><span class="glyphicon glyphicon-envelope"></span>My Newsletters</a></li>
								<li><a href="#" name="#tab6"><span class="glyphicon glyphicon-link"></span>My Refferals</a></li>
							</ul>
							<div id="content">
								<div id="tab1">
									<h1>My Account:</h1>
									<label>
										<?php echo ucwords($info['Member']['name'].' '.$info['Member']['surname']);?>
									</label>
									<div class="under_line_div"></div>
									<div class="rendered_div">
											<?php echo $this->element('frontend/profile/element1'); ?>
									</div>
									<!-- user address page -->
									<div class="user_Address rendered_div">
										     <?php echo $this->element('frontend/profile/element2'); ?>
									</div>
									<!-- Delivery address page -->
									<div class="user_Address rendered_div">
											<?php //echo $this->element('frontend/profile/element3'); ?>
									</div>
									<!-- user email address -->
									<div class="user_email rendered_div">
												<?php echo $this->element('frontend/profile/element4'); ?>
									</div>
									<!-- user password -->
									<div class="user_password_div rendered_div">
												<?php echo $this->element('frontend/profile/element5'); ?>
									</div>
									<div class="clearfix"></div>
									
								</div>
								<div id="tab2">
									<h1>My Account:</h1>
									<label><?php echo ucwords($info['Member']['name'].' '.$info['Member']['surname']);?></label>
									<div class="under_line_div"></div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
								<div class="search_feature">
									<div class="input_round_2">
										<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
											<input type="text" placeholder="Search by Order No" name="dealName" class="custName">
											<input type="hidden" id="hiddenname">
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="date-time">
									<div class="search_feature">
									<form id="searchbydate">
										<div class="input_round_2">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
												<input class="startdate redeem_sr " id="date_timepicker_start" type="text" name="startdate" placeholder="Start Date">
												<input type="hidden" id="hiddenstartdate">
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
												<input type="hidden" id="hiddenenddate">
												<input class="enddate redeem_ed " id="date_timepicker_end" type="text" name="enddate" placeholder="End Date" >
											</div>
										</div>
									 </form>
									</div>
								</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="search-butn">
							<button class="btn btn-info allsearch">
								search
								<span class="glyphicon glyphicon-search">
								</span>
							</button>
						<div class="image_display" style="display:none;left: 50%;position: absolute;top: -62px; ">
						 <img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
						</div>
						</div>
						</div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
										<div id="no-more-tables" class="order_element table-responsive">
											<?php echo $this->element('frontend/profile/order_list'); ?>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
<!----------------------for message---------------------------------------------->
								<div id="tab3">
									<h1>My Account:</h1>
									<label><?php //echo $info['Member']['name'].' '.$info['Member']['surname'];?></label>
									<div class="under_line_div"></div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_right_0">
										<div class="msg_histroy">
											<?php //echo $this->element('frontend/message/msg_left');?>
											<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
                   						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 each_conversation">
												    <?php //echo $this->element('frontend/message/msg_right');?>
											    </div>
                						</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
<!----------------------end message---------------------------------------------->
								<div id="tab4">
									<h1>My Account:</h1>
										<label><?php echo ucwords($info['Member']['name'].' '.$info['Member']['surname']);?></label>
										<div class="under_line_div"></div>
									<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 rendered_div2">
										
										
										<?php echo $this->element('frontend/profile/wish_list'); ?>
										
									</div>
									<div class="clearfix"></div>
								</div>
								<div id="tab5">
									<h1>My Account:</h1>
										<label><?php echo ucwords($info['Member']['name'].' '.$info['Member']['surname']);?></label>
										<div class="under_line_div"></div>
										<div class="rendered_div1">
												<?php echo $this->element('frontend/profile/newsletter'); ?>
										</div>
										<div class="clearfix"></div>									
								</div>
								<div id="tab6">
									<h1>My Account:</h1>
										<label><?php echo ucwords($info['Member']['name'].' '.$info['Member']['surname']);?></label>
										<div class="under_line_div"></div>
										<div class="referral_div1">
										
										   <p>
												You have successfully referred "<?php echo $total_referres ;?>" customers that have signed up and linked 
												themselves to your email address upon registering. The more customers you refer, 
												the more prizes you can win! To read up more about this, <a data-target="#competition_cms" data-toggle="modal" href="#">Click here</a>
											</p>
											<p>
												Here is a list of those customers by name and email address.
											</p>
											<div class="row">
												   <div class="referral_element">
														<?php //echo $this->element('frontend/profile/referral_list'); ?>			
													</div>				
													<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
														<div id="edit-2-field">
														
														<?php
														if(!empty($parent_referral))
														{
															$referallEmail=$parent_referral['Member']['email'];
															$referallID=$parent_referral['Referral']['id'];
														}
														else
														{
															$referallEmail='';
															$referallID=0;						
														}
														?>
														<!--<p class="link_section" style="<?php //echo (!empty($parent_referral))?'display:block;':'display:none;';?>">
															<span>You are linked to (<span><?php //echo $referallEmail;?></span>) as your registered referrer</span>
															<span class="pull-right" id="edit-1-b" style="cursor: pointer;"><i class="glyphicon glyphicon-edit"></i> Edit </span>
														</p>-->
														<p class="unlink_section" style="<?php echo (!empty($parent_referral))?'display:none;':'display:block;';?>">
															<span>You are not currently linked to any referrer. To do so, <a id="edit-1-b" href="javascript:void(0);">click here</a></span>
                                          </p>
														</div>
														<div class="row">
															<div id="edit-1-email" style="display: none;">
																<div class="col-md-6 col-sm-9 col-xs-12 col-lg-6">
																	<p style="margin-bottom:5px;">
																	   <input type="hidden" value="<?php echo $info['Member']['id'];?>">
																		<input type="text" class="form-control referral_email" value="<?php echo $referallEmail;?>">
																	</p>
																	<div class="referral_msg" style="display: none;">
																
															      </div>
																</div>
																<div class="col-md-6 col-lg-6 col-xs-12 col-sm-3">
																	<input type="hidden" value="<?php echo $referallID;?>">
																	<button class="btn btn-default submit-linkbtn" type="button"><i class="glyphicon glyphicon-link"></i></button>
																</div>
															</div>
														</div>
													</div>
											</div>
										
										
										
										
												
										</div>
										<div class="clearfix"></div>									
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>				
				</div>
				<!-- End profile area page -->
				
		<!-- tab panel scrip -->
<script>
	function resetTabs()
    {
        $("#content > div").hide(); //Hide all content
        $("#tabs a").attr("id",""); //Reset id's      
    }

    var myUrl = window.location.href; //get URL
    var myUrlTab = myUrl.substring(myUrl.indexOf("#")); // For localhost/tabs.html#tab2, myUrlTab = #tab2     
    var myUrlTabName = myUrlTab.substring(0,4); // For the above example, myUrlTabName = #tab

    (function(){
        $("#content > div").hide(); // Initially hide all content
        $("#tabs li:first a").attr("id","current"); // Activate first tab
        $("#content > div:first").fadeIn(); // Show first tab content
        
        $("#tabs a").on("click",function(e) {
            e.preventDefault();
            if ($(this).attr("id") == "current"){ //detection for current tab
             return       
            }
            else{             
            resetTabs();
            $(this).attr("id","current"); // Activate this
            $($(this).attr('name')).fadeIn(); // Show content for current tab
            }
        });

        for (i = 1; i <= $("#tabs li").length; i++) {
          if (myUrlTab == myUrlTabName + i) {
              resetTabs();
              $("a[name='"+myUrlTab+"']").attr("id","current"); // Activate url tab
              $(myUrlTab).fadeIn(); // Show url tab content        
          }
        }
    })()
		</script>
		<!-- my account script -->
	
		<!-- remove msg script -->
<script>
	$(document).ready(function(){
			$('.msg_from').hover(function(){
						var crnt=$(this);
						$(crnt.children('.del_icon').children('.show_remove')).show();
			},function(){$('.show_remove').hide();});
				
								
			//alert('load')
			// hide show jquery
			$(document).on('click','.editButton',function(){
					$(this).parents('.lvls').hide()
								.next().show(500);
			})
			$(document).on('click','.cnls',function(){
					$(this).parents('.edts').hide()
								.prev().show(500);
			})
			$(document).on('click','.svs',function(){
					var form= $(this).parents('.frm');
					var frmId= $(this).parents('.frm').attr('id');
					var ll_count=0;
					if(frmId==1)
					{
						$('.ll').each(function(){
									if($(this).val()=="")
									{	
											ll_count++;
									}
						})
					}
					else
					{
							ll_count=0;
					}
					if(ll_count>0)
					{
								$('#hh').remove();
								$('.birthday-picker').after('<label id="hh" class="error" for="">This field is required.</label>');
					}
					else
					{
							//alert('jj')
							$('#'+frmId).validate();
							var render = $(this).parents('.rendered_div');
							var valid_status= $('#'+frmId).valid();
							//alert($('.birthday-picker').children('label').length)
							
							if($('.birthday-picker').children('label').length>0)
							{
									$('.birthday-picker').children('label').remove();
									$('.birthday-picker').after('<label id="" class="error" for="">This field is required.</label>');
							}
							//var i = $(document);
							if(valid_status)
							{
							//alert('in'+valid_status)
										$.ajax({
												 type: 'post',
												 url: ajax_url+'Customers/customer_edit_profile/'+frmId,
												 async: false,
												 data:form.serialize(),
												 success:function(resp){
														render.html(resp);
														//$('.session_div').show();
														$('.globel_user_name').html($('#edit_mem_name').val());
														$('.session_div').show().html('Your profile has been updated successfully.');
																					$('html,body').animate({scrollTop: $("#scrool").offset().top-50},'slow');
																					setTimeout( function() {$('.session_div').hide().html('');}, 4*1000);
												 }
										})
							}
							else
							{
									return false;
							}
					}
					//})
			})
			
			
			/*..............start functionality for edit email....................*/
			
			$(document).on('click','.svs1',function(){
					var form= $(this).parents('.frm');
					var frmId= $(this).parents('.frm').attr('id');
					$('#'+frmId).validate({
							rules:
							{
									"data[Member][cemail]":
									{
											equalTo: $('#eml'),
									},
									
							},
							messages:
							{
									"data[Member][cemail]":
									{
											equalTo: "Email and confirm email not match",
									},
									
							}
					});
					var render = $(this).parents('.rendered_div');
					var valid_status= $('#'+frmId).valid();
					
					if(valid_status)
					{
								$.ajax({
										type: 'post',
										url: ajax_url+'Customers/check_validation/',
										async: false,
										data:form.serialize(),
										success:function(resp)
										{
												if(resp=="both")
												{
														$('#eml').after('<label id="eml-error" class="error" for="eml" style="display: inline-block;">Email already exist</label>');
														$('#pswds').after('<label id="pswds-error" class="error" for="pswds">You entered incorrect password.</label>');
												}
												else if(resp=="email")
												{
														$('#eml').after('<label id="eml-error" class="error" for="eml" style="display: inline-block;">Email already exist</label>');
												}
												else if(resp=="pass")
												{
														$('#pswds').after('<label id="pswds-error" class="error" for="pswds">You entered incorrect password.</label>');
												}
												else
												{
															$.ajax({
																	 type: 'post',
																	 url: ajax_url+'Customers/customer_edit_profile/'+frmId,
																	 async: false,
																	 data:form.serialize(),
																	 success:function(resp){
																			render.html(resp);
																			//alert($('.getemail').html())
																			$('.setemail').html($('.getemail').html());
																			
																			$('.session_div').show().html('Your email has been changed successfully.');
																			$('html,body').animate({scrollTop: $("#scrool").offset().top-50},'slow');
																			setTimeout( function() {$('.session_div').hide().html('');}, 4*1000);
																	 }
															})
												}
										}
								})
					}
					else
					{
							return false;
					}
			});
			/*................end ................*/
			/*................start password functionality ................*/
			$(document).on('click','.svs2',function(){
					var form= $(this).parents('.frm');
					var frmId= $(this).parents('.frm').attr('id');
					//alert(frmId)
					$('#'+frmId).validate({
							rules:
							{
									"data[Member][password]":
									{
											minlength: 6,
									},
									"data[Member][cpassword]":
									{
											equalTo: $('#nwpass'),
									},
									
							},
							messages:
							{
									"data[Member][password]":
									{
											minlength: "Password must be greater than 6 characters",
									},
									"data[Member][cpassword]":
									{
											equalTo: "The two new password fields do not match.",
									},
									
							}
					});
					var render = $(this).parents('.rendered_div');
					var valid_status1= $('#'+frmId).valid();
					
					if(valid_status1)
					{
								$.ajax({
										type: 'post',
										url: ajax_url+'Customers/check_password/',
										async: false,
										data:form.serialize(),
										success:function(resp)
										{ // alert(resp)
												if(resp=="error")
												{
														$('#owpass').after('<label id="owpass-error" class="error" for="owpass">You entered incorrect password</label>');
												}
												else
												{
															$.ajax({
																	 type: 'post',
																	 url: ajax_url+'Customers/customer_edit_profile/'+frmId,
																	 async: false,
																	 data:form.serialize(),
																	 success:function(resp){
																			render.html(resp);
																			//alert($('.getemail').html())
																			$('.session_div').show().html('Your new password was updated successfully!');
																			$('html,body').animate({scrollTop: $("#scrool").offset().top-50},'slow');
																			setTimeout( function() {$('.session_div').hide().html('');}, 4*1000);
																	 }
															})
												}
										}
								})
					}
					else
					{
							return false;
					}
			});
			/*................end ................*/
			$(document).on('click','.cnls',function(){
					var form= $(this).parents('.frm');
					var frmId= $(this).parents('.frm').attr('id');
					//if(frmId!=2)
					form.children().find('label.error').text('');
			});
			$(document).on('change','.locSub',function(){
				var id = $(this).val();
				var loc = $(this).find("option:selected").text();
				var count = 0;
				//var optLength = $('.newsletter_loc').children('option').length-1;
				//alert(id)
				$('.newsptag').each(function(){
				//alert($(this).attr('rel'))
						if($(this).attr('rel')==id)
						{
								count = 1;
						}
				});
				//alert(count)
					if(count == 0)
					{
						$('.append_loc').append('<p class="cross_btn newsptag" rel="'+id+'">'+loc+'<a href="javascript:void(0);" class="crossptag"><span class="glyphicon glyphicon-remove"></span></a></p>');
						$('.hidden_sub').append('<input class="newsletter_hidden" name="data[News][]" id="input_'+id+'" type="hidden" value="'+id+'">');
						$('.newsletter_loc').val('');
					}
					else
					{
							alert('Location already selected.');
							$('.newsletter_loc').val('');
					}
				
			});
			/*
			$(document).on('click','.locs',function(){
			
					var loc = $(this).html();
					var id = $(this).val();
					alert(loc)
					var count = 0;
					var optLength = $('.newsletter_loc').children('option').length-1;
					//alert($('.newsletter_loc').children('option').length)
					$('.newsptag').each(function(){
							if($(this).attr('rel')==id)
							{
									count = 1;
							}
					});
					if(count == 0)
					{
						$('.append_loc').append('<p class="cross_btn newsptag" rel="'+id+'">'+loc+'<a href="javascript:void(0);" class="crossptag"><span class="glyphicon glyphicon-remove"></span></a></p>');
						$('.hidden_sub').append('<input class="newsletter_hidden" name="data[News][]" id="input_'+id+'" type="hidden" value="'+id+'">');
						$('.newsletter_loc').val('');
					}
					else
					{
							alert('Location already selected.');
							$('.newsletter_loc').val('');
					}
			})*/
	$(document).on('click','.crossptag',function(){
			var cnfirm = confirm('Are you sure to remove.');
			if(cnfirm)
			{
					var id= $(this).parent().attr('rel');
					$(this).parent().remove();
					$('#input_'+id).remove();
			}
	})
	$(document).on('click','.newsSave',function(){
		$('.image_display').css('display','block');
		$.ajax({
				 type: 'post',
				 url: ajax_url+'Customers/profile_newsletter',
				 async: false,
				 data:$('#newsform').serialize(),
				 success:function(resp){
						$('.rendered_div1').html(resp);
						//alert($('.getemail').html())
						$('.image_display').css('display','none');
						$('.session_div').show().html('Newsletter has been updated successfully.');
						$('html,body').animate({scrollTop: $("#scrool").offset().top-50},'slow');
						setTimeout( function() {$('.session_div').hide().html('');}, 4*1000);
				 }
		})
	})

			/*--------- for ajax pagination--------------*/
	$('.pagination').children().find('.current').addClass('pageactive');     
	$(document).on('click',".wishlist_pagination a",function(){
		var currentUrl=$(this).attr("href");
		$('.rendered_div2').css({'opacity':'.5'});
		var ele ="wish";
		$.ajax({
			type:"POST",
		  	url:currentUrl,
		  	data:{'wishlist':ele},
		  	success:function(result)
		  	{
				$('.rendered_div2').css({'opacity':'1'});
				$(".rendered_div2").html(result);
				$('.pagination').children().find('.current').addClass('pageactive');
		  	}
		});
		return false;
	});
/*$(document).on('change','.lp',function(){
			if($('.birthday-picker').children('label').length>0)
			{ 
					$('.birthday-picker').children('label').remove();
			}
	})*/
	$(document).on('click','.lp',function(){
		if($('.birthday-picker').children('label').length>0)
		{ 
				$('.birthday-picker').children('label').remove();
		}
	})

			/*------------------for mydeal on supplier profile----------- function working on page reload*/
        $.ajax({
                type:'POST',
                url:ajax_url+'Customers/myorders',
                success:function(resp)
                {
                   $('.order_element').html(resp); 
				       $('.pagination').children().find('.current').addClass('pageactive');
                }
             });

        /*--------- for ajax pagination--------------*/
		$('.pagination').children().find('.current').addClass('pageactive');
	    $(document).on('click',".order_pagination a",function()
	    {
	           var currentUrl=$(this).attr("href");
	           $.ajax({
			        type:"POST",
			        url:currentUrl,
			        success:function(result)
			        {
			           $(".order_element").html(result);
					   $('.pagination').children().find('.current').addClass('pageactive');
	              }
			     });
	          return false;
	    });


    /*........for referal section..*/

     $.ajax({
                type:'POST',
                url:ajax_url+'Customers/myreferrals',
                success:function(resp)
                {
                   $('.referral_element').html(resp);
                }
             });

      $(document).on('click',".referral_pagination a",function()
	    {
	           var currentUrl=$(this).attr("href");
	           $.ajax({
			        type:"POST",
			        url:currentUrl,
			        success:function(result)
			        {
			           $(".referral_element").html(result);
	              }
			     });
	          return false;
	    });		
    /*..........end of referral section.....*/			
	});	
	/*----searching start for order no and date-----*/
	$(".allsearch").click(function()
	{
		var dealName=$(".custName").val();
		var startdate=$("#date_timepicker_start").val();		
		var enddate=$('#date_timepicker_end').val();		
		$(".order_element").css({'opacity':'0.2'});
		$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
		$.ajax({
			type:"Post",
			url :ajax_url+"Customers/myorders",
			data:{'dealName':dealName,'startdate':startdate,'enddate':enddate},
			success:function(result)
			{
				$('.image_display').css('display','none');
				$(".order_element").html(result);
				$('.pagination').children().find('.current').addClass('pageactive');
				$(".order_element").css({'opacity':'1'});
			}			
		});
	});	
jQuery(function(){
	 jQuery('#date_timepicker_start').datetimepicker({
	  format:'j M Y',
	  formatDate:'j M Y',
	  onShow:function( ct ){
	   this.setOptions({
		maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
	   })
	  },
	  timepicker:false
	 });
	 jQuery('#date_timepicker_end').datetimepicker({
	  format:'j M Y',
	  formatDate:'j M Y',
	  onShow:function( ct ){
	   this.setOptions({
		minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():true
		
		 })
	  },
	  timepicker:false
	 });
	});			
	
		</script>
		
	