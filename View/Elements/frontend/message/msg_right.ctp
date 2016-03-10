                 <?php if(!empty($rec)) { ?> 	
                 <div class="msg_talk">
                      <?php //echo $rec[0]['ToMember']['name'];pr($rec);die; ?>
														<label>Conversation with<span> <?php echo @$rec[0]['ToMember']['name'];?> </span>from <?php echo @$rec[0]['FromMember']['name']; ?></label>
													</div>
                   <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 m_padding_0">
														<div class="msg_body_outer">
                       <?php foreach($rec as $info) { ?>
															<div class="msg_body">
                           <?php if(empty($info['FromMember']['image']))
                        		 {
                         		 $path=HTTP_ROOT.'img/user.png';
                       		 		}
                       			else 
                       			{
                          		$path=HTTP_ROOT.'img/frontend/member/'.$info['FromMember']['image'];
                        			} ?>
																<div class="col-lg-2 col-sm-2 col-md-2 col-xs-4 ">
																	<img src="<?php echo $path; ?>" class="img-responsive img-circle"/>
																</div>
																<div class="col-lg-5 col-sm-5 col-md-5 col-xs-12 padding_0">
																	<label><?php echo $info['FromMember']['name'];?></label>
																</div>
																<div class="col-lg-5 col-sm-5 col-md-5 col-xs-12  text-right">
																	<span><?php echo date('d F Y H:i A',strtotime($info['Message']['date_added']));?></span>
																</div>
																<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
																	<div class="msg_content">
																	<p>
																		<?php echo $info['Message']['message'];?>
																	</p>
																	</div>
																</div>
															</div>
                       	<?php } ?>
														</div>
                     <form id="msgform" action="<?php echo HTTP_ROOT.'Customers/send_message';?>" method="post">
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
															<div class="msg_send">
																<textarea id="message" name="data[Message][message]"></textarea>
																<input id="to" type="hidden" name="data[Message][to_id]" value="<?php echo @$rec[0]['ToMember']['id'];?>"/>
																<input id="from" type="hidden" name="data[Message][from_id]" value="<?php echo @$rec[0]['FromMember']['id'];?>"/>
																<input id="conv_id" type="hidden" name="data[Message][from_id]" value="<?php echo @$rec[0]['Message']['conversation_id'];?>"/>
															</div>
															<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right">
																<a href="javascript:void(0);" onclick="reset_form()" class="btn btn-success cancel">Cancel</a>
                        <a href="javascript:void(0);" class="btn btn-primary send">Send</a>
															</div>
														</div>
                     </form>
													</div>
                  <?php } else { ?>
                    <div class="msg-body" style="min-height:180px;">
		                          <p class="no_records">No message found in selected conversation.</p>
				
													</div>
												<?php }?>
					<script>
          $(document).ready(function(){
            $('.send').click(function(){
               var to_id=$('#to').val();
               var from_id=$('#from').val();
               var msg=$('#message').val();
               var convers=$('#conv_id').val();
               //alert(convers);
               // alert(to_id);
             $.ajax({
														url:ajax_url+'Customers/send_message/'+to_id+'/'+from_id+'/'+msg+'/'+convers,
														method:'POST',
														success:function(html)
														{
			                   	$('form').find("input, textarea").val("");
														}				
											  	});  
             });
          $(".cancel").click(function() {
    							$('form').find("input, textarea").val("");
           });
        });
    
</script>								
										