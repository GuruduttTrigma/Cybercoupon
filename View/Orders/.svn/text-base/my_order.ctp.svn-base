<?php $newsid = base64_encode(convert_uuencode($mem_info['Member']['id'])); ?>
<div id="middle_container">
	<div id="middle_inner">
		<div class="middle_main">
		<div class="success_msg"><?php if(@$this->Session->read('success')!=''){ echo $this->Session->read('success'); unset($_SESSION['success']); }  ?></div>
			<div class="stupro_head">
                <?php 
						if(trim($mem_info['Member']['image'])!='')
						{
							echo $this->Html->image('frontend/profileImg/thumbnail/'.$mem_info['Member']['image'],array('width'=>30,'height'=>30));
						}
						else
						{
						
							echo $this->Html->image('frontend/thumb-user.png',array('width'=>30,'height'=>30));
						}
				?>
			    <div class="wlcm_name">
                    <b>Hello,</b>
                    <span><?php echo $mem_info['Member']['name']; ?></span>
                </div>
                <div class="chnge_pswd">
                    <a href="<?php echo HTTP_ROOT.'Members/change_password/'.$newsid;?>">Change Password</a>
                </div>
             </div>
            <div class="stupro_body">
               	<h3>My Profile</h3>
               	<div class="profile_left">
					<?php 
						if(trim($mem_info['Member']['image'])!='')
						{
							echo $this->Html->image('frontend/profileImg/medium/'.$mem_info['Member']['image'],array('width'=>172,'height'=>181));
						}
						else
						{
						
							echo $this->Html->image('frontend/user.png',array('width'=>172,'height'=>181));
						}
					?>
					<div class="edt_pro">
                       	<a href="<?php echo HTTP_ROOT.'Members/edit_profile/'.$newsid;?>">Edit my profile</a>
                    </div>
					<div class="edt_pro">
                      	<a href="<?php echo HTTP_ROOT.'Orders/my_order/'.$newsid;?>">My Orders</a>
                    </div>
                </div>
                <div class="profile_right">
                   	<p>My Order List</p>
					<div class="track_result">	
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<thead>
								<tr class="head_padding">
									<th>S.No</th>
									<th>Order Number</th>
									<th>Order Date</th>
									<th>Total Amount</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<?php if(!empty($order_info)){
								$i=1; 
								foreach($order_info as $list){ ?>
							<tbody>
								<tr class="odd order_odd">
									<td><?php echo $i;?></td>
									<td><?php echo $list['Order']['order_no']; ?></td>
									
									<td><?php echo date('Y-M-d H:i',strtotime($list['Order']['payment_date'])); ?></td>
									<td>$<?php echo $list['Order']['payment_gross']; ?></td>
									<td><?php echo $list['OrderStatus']['name']; ?></td>
									<td>
										 <?php $order_id = base64_encode(convert_uuencode($list['Order']['id'])); ?>
										<a title="Delete" href="<?php echo HTTP_ROOT."Orders/update_delete_status/".$order_id; ?>" onclick="return confirm('Are you sure you want to delete this record?');"></a>
										<a title="View Order" href="<?php echo HTTP_ROOT."Orders/order_detail/".$order_id; ?>" class="view"></a>
									</td>
								</tr>
							</tbody>
								<?php
								$i++; 
								}
							}
							else
							{ ?>
							
								<tr class="odd order_odd"><td colspan="6"><strong> No Order found.</strong></td> </tr>
							
							<?php } ?>
							
						</table>
					</div>
				</div>
            </div>      
        </div>
	</div>
</div>