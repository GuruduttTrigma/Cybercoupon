<div class="col-lg-4 col-sm-4 col-md-4 col-lg-12 padding_0">
     <div class="msg_outer">
          <?php foreach($left_prv_msgs as $msg) { ?>
                 <div class="msg_from">
               <?php if(empty($msg['FromMember']['image']))
                       {
                          $path=HTTP_ROOT.'img/user.png';
                        }
                       else 
                       {
                          $path=HTTP_ROOT.'img/frontend/member/'.$msg['FromMember']['image'];
                        } ?>
                 <div class="conversation">
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
														<img src="<?php echo $path; ?>" class="img-responsive img-circle"/>
	                    <input id="conversation_id" type="hidden" name="data[Message][conversation_id]" value="<?php echo $msg['Message']['conversation_id']  ; ?>" />
	                    <input id="message_id" type="hidden" name="data[Message][id]" value="<?php echo $msg['Message']['id']  ; ?>" />
													</div>
													<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 padding_0">
														<label><?php echo $msg['FromMember']['name']; ?></label>
														<span>
	                  <!--<img src=""/>--><?php echo date('H:i A',strtotime(@$msg['Message']['date_added'])); ?></span>
													</div>
                 </div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right del_icon">
													<a href="javascript:void(0);" class="show_remove" style="display:none;"><span class=" glyphicon glyphicon-trash"></span></a>
												</div>
											</div>
           <?php } ?>
										<!---	<div class="msg_from">
												<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
													<img src="images/photo.jpg.png" class="img-responsive img-circle"/>
												</div>
												<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 padding_0">
													<label>Rahul</label>
													<span><img src="images/msg.png"/>11:30AM</span>
												</div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right del_icon">
													<a href="javascript:void(0);" class="show_remove" style="display:none;"><span class=" glyphicon glyphicon-trash"></span></a>
												</div>
											</div>
											<div class="msg_from">
												<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
													<img src="images/photo.jpg.png" class="img-responsive img-circle"/>
												</div>
												<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 padding_0">
													<label>Jagjeet</label>
													<span><img src="images/msg.png"/>11:30AM</span>
												</div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right del_icon">
													<a href="javascript:void(0);" class="show_remove" style="display:none;"><span class=" glyphicon glyphicon-trash"></span></a>
												</div>
											</div>
											<div class="msg_from">
												<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
													<img src="images/photo.jpg.png" class="img-responsive img-circle"/>
												</div>
												<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 padding_0">
													<label>Chandan</label>
													<span><img src="images/msg.png"/>11:30AM</span>
												</div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right del_icon">
													<a href="javascript:void(0);" class="show_remove" style="display:none;"><span class=" glyphicon glyphicon-trash"></span></a>
												</div>
											</div>
											<div class="msg_from">
												<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
													<img src="images/photo.jpg.png" class="img-responsive img-circle"/>
												</div>
												<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 padding_0">
													<label>Rahul</label>
													<span><img src="images/msg.png"/>11:30AM</span>
												</div>
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right del_icon">
													<a href="javascript:void(0);" class="show_remove" style="display:none;"><span class=" glyphicon glyphicon-trash"></span></a>
												</div>
											</div>---->
										</div>
       </div>
<script>
   $(document).ready(function(){
     $('.conversation').click(function(){
               var c_id=$('#conversation_id').val();
              //alert(c_id);
        $.ajax({
											url:ajax_url+'Customers/get_conversation/'+c_id,
											method:'POST',
											success:function(html)
											{
                   $('.each_conversation').html(html);
											
											}				
							  	});  
                
          });

    $('.del_icon').click(function(){
               var msg_id=$('#conversation_id').val();
             // alert(msg_id);
        $.ajax({
											url:ajax_url+'Customers/delete_conversation/'+msg_id,
											method:'POST',
											success:function(html)
											{
                            alert('Record deleted Successfully');
											}				
							  	});  
                
          });       

    });
</script>	