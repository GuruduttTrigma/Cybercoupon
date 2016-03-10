<?php
         
              $data =  $this->Session->read('Member.name');
              $data_id =  $this->Session->read('Member.id');
              $user_type= $this->Session->read('Member.member_type');
                  //echo $data;die;
           ?>
<div class="login_wrapper">
						<!--		Place order Top starts	-->

						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							<div class="new_user_area">
								<div class="login_heading">
									<h1><span class=""></span>PAYMENT SUCCESSFUL</h1>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 payment">
									<h3>Thank you, your transaction was successfully processed.</h3>
									<p>Hope to see you on our site again soon,</p>
									<p>Kind regards,</p>
									<p>The Cybercoupon Team</p>
									<a href="<?php echo HTTP_ROOT.'homes/index'; ?>">Click here to return to the main site</a>
									<a href="<?php echo HTTP_ROOT;?>Customers/view_profile/<?php echo $data_id;?>">Go to My Profile</a>
								</div>
							</div>
		
							 </div>
					</div>