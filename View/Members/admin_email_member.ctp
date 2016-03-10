<?php 
	echo $this->Html->script('backend/development/ui.datepicker.js');
  	echo $this->Html->css('backend/smooth.css');
?>
<script type="text/javascript">
$(document).ready(function()
{
	var memb = $('#mem_id').val();
	$('#frm').validate({
		rules:
		{
			"data[Member][email]":
			{
				required:true,
				email:true,
				remote:ajax_url+'admin/Members/checkEditMemberEmail/'+memb
			},
		},
		messages:
		{
			"data[Member][email]":
			{
				required:'Please enter email.',
				email:'Please enter valid email.',
				remote:'Email address already exists.'
			},
		}
	});
});
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
			<div class="inner-page-title">
				<h2>Send Mail</h2>
               <span></span>
			</div>
			<?php if($member['MemberType']['name']=='supplier' or $member['MemberType']['name']=='customer') {?>
				<form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Members/email_member/'.base64_encode(convert_uuencode($member['Member']['id']))?>">
					<fieldset>
   					<div class="content-box content-box-header" style="border:none;">
							<div class="column-content-box">  
            				<div class="ui-state-default ui-corner-top ui-box-header">
                				<span class="ui-icon float-left ui-icon-notice"></span>
										Send Mail to <?php echo $member['MemberType']['name'];?>
            				</div>
            				<div class="content-box-wrapper">
            	<input type="hidden" id="mem_id" value="<?php echo $id; ?>" />
               	<ul>
                   <input name="data[Member][id]" type="hidden" value="<?php echo $member['Member']['id'];?>" />
                  	<input name="data[Member][member_type]" type="hidden" value="<?php echo $member['MemberType']['id'];?>" />
                  	<input name="data[MemberMeta][id]" type="hidden" value="<?php echo $member['MemberMeta']['id'];?>" />
						  	<li>
								<label class="desc">Email Address<em>*</em></label>
								<div>
									<input readonly="" class="field text full required" name="data[Member][email]" type="text" value="<?php echo $member['Member']['email'];?>" />
								</div>
						  	</li>
						  	<li>
								<label class="desc">Message<em>*</em></label>
								<div>
							  		<textarea class="field text full required" rows="6" name="data[Member][message]" type="text"></textarea>
								</div>
						  	</li>  
						</ul>
            </div> <!-- end of content box wrapper -->
           </div>
			</div>
            
              <li>
                <input class="submit sub-bttn" type="submit" value="Submit"/>
              </li>
            </fieldset>
            </form>
             

<?php } ?>
            
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>