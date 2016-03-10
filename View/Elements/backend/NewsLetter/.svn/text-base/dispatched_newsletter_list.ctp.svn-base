<style>
.newsletter-success {
    color: #9a1a1a;
    float: left;
    font-weight: bold;
    padding: 10px;
}

</style>

<div style="margin-bottom:0px; float:left; padding: 10px 0px 10px 0px;" >
	<b style="font-size:20px;"><?php echo count($dispatched)." Newsletters";?></b>
</div>	
<script>
	$(function(){
		$(".preview_a").click(function(){
			$(this).
			parent().
			parent().
			next().
			children().
			find('form').
			submit();
		})	
  });
</script>
<?php
	if(!empty($dispatched))
	{
		foreach($dispatched as $each_dispatched)
		{ 
				//echo "<pre>";print_r($each_dispatched);die;
			$news_loc=(trim($each_dispatched['Location']['name'])!='')?$each_dispatched['Location']['name']:'';
			$preview_href= HTTP_ROOT.'admin/NewsLetters/archivepreview/'.base64_encode(convert_uuencode($each_dispatched['Dispatch']['id']));
			?>     
			<div class="dispatch_deal_tbl" style="margin-bottom:0px; float:left" >
				<a id="" class="sub-bttn dispached" style="background-color:#dddddd; width: 100%; height:18px; margin-top: 2px;margin-left:10px;  display:block;" ><?php echo date('d F Y',strtotime($each_dispatched['Dispatch']['sent_date'])).', '.$news_loc.' ('.$each_dispatched['Dispatch']['status'].') '; ?></a>
				<span><input class="sub-bttn preview_a" type="submit" value="Send Email To Inform Suppliers of Their Dispatch Date" name="Send Email" style="width: auto; margin-top: -35px;"></span>
					
			</div>
			
			<div class="dispatch_deal_detail" style="margin-bottom:10px; float:left;display:none;" >
				<div class="hastable">	
					<table id="" align="center"> 
						<thead> 
							<tr>
								<th style="width:auto; width:200px;" >Image </th>
								<th style="width:auto; width:200px;">Title</th>
								<th style="width:auto; width:200px;">Category </th>
								<th style="width:auto; width:200px;">Location </th>
							</tr> 
						</thead> 
						<tbody> 
						<?php	
						$memDeal = array();
						if(!empty($each_dispatched['DispatchDeal']))
						{	
						   $i = 0; 
							foreach($each_dispatched['DispatchDeal'] as $dispatched_deal)
							{  
									
								$memDeal[$i]['supplier_id'] = $dispatched_deal['supplier_id'];
								$memDeal[$i]['deal_id']  = $dispatched_deal['deal_id'];
								$memDeal[$i]['dispatch_id']  = $dispatched_deal['dispatch_id'];
								
								$dispatch_loc=explode(',',$dispatched_deal['Deal']['location']);
								array_unique($dispatch_loc);
								$location_txt='';
								foreach($location as $loc_id=>$loc_name)
								{
									if(in_array($loc_id,$dispatch_loc))
									{
										$location_txt.=$loc_name.", ";
									}
								}
								$location_txt=rtrim($location_txt,', ');
								?>
								<tr>
									<td>
									   <img src="<?php echo IMPATH.'deals/'.@$dispatched_deal['Deal']['image'].'&w=250&h=100';?>"/>	
									</td>
									<td><?php echo @$dispatched_deal['Deal']['name']?></td>
									<td><?php echo @$dispatched_deal['Deal']['DealCategory']['name']; ?></td>
									<td><?php echo $location_txt; ?></td>                
								</tr> 
							<?php	
								$i++;
							}
							//prx(http_build_query($memDeal));die;
						}
						else
						{
						?>
							<tr>
								<td colspan="7">No Record Found.</td>
							</tr>
						<?php		
						}
						?>					
						</tbody>
					</table>
			   </div>
			   <div class="clearfix"></div>
			   <?php
			   if($each_dispatched['Dispatch']['status']=='sent')
			   {
			   ?>
			   <!--<div class="" style="float:left; width:100%; margin-top:8px;">
			      <a href="<?php //echo HTTP_ROOT.'admin/NewsLetters/send_dispatched/'.base64_encode(convert_uuencode($each_dispatched['Dispatch']['id']));?>" class="sub-bttn" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;">Send NewsLetter</a>
			   </div>-->
				<?php
				if($subadmin_type==1 ||@$modulepermissions['NewsLetter']['module_edit']==1) 
				{ 		  
					?>     
					<div style="float:left; width:100%; margin-top:8px;">
						<a class="sub-bttn preview_a" target="_blank" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;" href="<?php echo $preview_href;?>">Preview</a>
						<a class="sub-bttn email_preview" class="sub-bttn" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;">Email Send</a>
                       <span class="newsletter-success">Newsletter sent to <?php echo $each_dispatched['Dispatch']['mailsentTo'];?> customers successfully!</span>						
					</div>
					<?php 
				}
					?>
				<div style="float:left; width:100%; margin-top:8px;display:none;">
					<div style="float:left; width:100%; margin-top:8px;">
						<form class="email_preview" method="post" enctype="multipart/form-data" action="">				
							<label class="desc">Enter Email:<em>*</em> (You can enter the multiple email separated by comma)</label>
							<div>
								<input class="field text full required" name="data[Member][email]"  type="text"/>
							</div>
							<div>
								<input name="data[Dispatch][id]" value="<?php echo $each_dispatched['Dispatch']['id'];?>" type="hidden"/>
								<input class="submit sub-bttn email_preview_btn" style="margin-top:5px;margin-left:0px;" type="button" value="Submit"/>
							</div>
						</form>
					</div>		
				</div>			
				<div class="response-msg success ui-corner-all" style="display: none;"></div>
				<?php
				}
				//pr($memDeal);
				if($each_dispatched['Dispatch']['status']=='pending')
			   {
					if($subadmin_type==1 ||@$modulepermissions['NewsLetter']['module_edit']==1) 
					{ 		  
						?>     
						<div style="float:left; width:100%; margin-top:8px;">		   
							<form id="_newse_letter_send_data" name="NewsLetters" method="Post"  action="<?php echo HTTP_ROOT.'admin/NewsLetters/sendDispatchEmail/'; ?>" >
								<?php $j = 0; ?>	
								<?php foreach( $memDeal as $deal ) { ?>
										<input type="hidden"  name="news_letters_data[<?php echo $j; ?>]" value="<?php echo $deal['supplier_id'].'_'.$deal['deal_id'].'_'.$deal['dispatch_id']; ?>" />
								<?php $j++; } ?>
								<input  class="sub-bttn preview_a" style="width: auto;display:none" type="submit"  name="Send Email" value="Send Email To Inform Suppliers of Their Dispatch Date" />
							</form>
						</div>
						<?php 
					}
				}
				?>			 
			</div>
			<?php
		} 
	}
	else 
	{
	?>
		<div class="dispatch_deal_tbl" style="margin-bottom:0px; float:left; padding: 10px 0px 10px 0px;" >
			<span style="margin-left:10px;"> No record founds.</span>
		 </div>
	<?php
	}
	?>
<script type="text/javascript" >
  $('.email_preview').click(function(){
  	    $(this).parent('div').next('div').toggle();
  	});
  	
  	$('.email_preview_btn').click(function(){
  		
      $(this).closest('.email_preview').validate(); 
			  		if($(this).closest('.email_preview').valid())
			  		{
			  			   var email_send=$(this);
			  		    var dispatch_id=$(this).siblings('input[type=hidden]').val();
			  		    var url= ajax_url+'admin/NewsLetters/archiveEmail';
			  		    $.ajax({
				  		    	  type:'POST',
				  		    	  url:url,
				  		    	  data:$(this).closest('form').serialize(),
				  		    	  success:function(resp)
										  		    	  {
										  		    	  	  if(resp=='success')
										  		    	  	  {
										  		    	  	  	  email_send.parent('div').prev('div').children('input').val('');
										  		    	  	  	  email_send.closest('.email_preview').parent().parent().hide();
										  		    	  	  	
										  		    	  	  	
										  		    	  	  	  $('.success').show();
										  		    	  	  	  $('.success').html('Email has been sent successfully.');
										  		    	  	  	  setTimeout(function(){
										  		    	  	  	  	  $('.success').hide();
										  		    	  	  	  	},1000);
										  		    	  	  	
										  		    	  	  	}
										  		    	 }
			  		    	
			  		   });
  		    	
  		    }
  		})
</script>