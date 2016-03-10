<script type="text/javascript">
	$(document).ready(function(){
		$("#dispached").click(function(){
    		$("#dis").toggle();
  		});
  		$("#view_deals").click(function(){
    		$("#div_view_deals").toggle();
  		});
  		
      $(document).on('click','.sale_deal_tbl',function(){
				$('.sale_deal_detail').not($(this).next('.sale_deal_detail')).hide(500);
				$(this).next('.sale_deal_detail').toggle(500);
				$('.claim_open, .refund_open').hide();
				$('.bus_adrs_open, .del_adrs_open').hide();
		});  		
  		
  	});
  	
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">        
			<div class="inner-page-title">
				<h2>Dispatched NewsLetter</h2>
            
            <span></span>
			</div>
         <?php if($this->Session->check('success')){ ?>
			<div class="response-msg success ui-corner-all">
				<span>Success message</span>
				<?php echo $this->Session->read('success');?>
			</div>
			<?php unset($_SESSION['success']); ?>
			<?php } ?>
				   
			<?php
			foreach($data as $info)
			{ 
			?>         
			<div class="id_cont admin_search member_search_management" style="margin-bottom:0px; float:left" >
			<a id="dispached" class="sub-bttn" style="background-color:#dddddd; width: 800px; height:18px; margin-top: 2px;margin-left:10px;  display:block;" /><?php echo $info['Dispatch']['sent_date']; ?></a>
			<a id="dispached" class="sub-bttn" style="background-color:#dddddd; height:18px; margin-top: 2px;margin-left:10px;  display:block;" href="<?php echo HTTP_ROOT.'admin/NewsLetters/send_dispatched/'.base64_encode(convert_uuencode($info['Dispatch']['deal_id']))?>"))>Send</a>		
			</div>
			
			<div class="id_cont admin_search member_search_management" style="margin-bottom:0px; float:left;" >
				<div class="hastable">	
					<table id="sort-table" align="center"> 
					<thead> 
						<tr>
							<th style="width:auto; width:200px;" >Image </th>
	                  <th style="width:auto; width:200px;">Title</th>
	                  <th style="width:auto; width:200px;">Category </th>
						</tr> 
					</thead> 
					<tbody> 
						<?php
						
							if(!empty($dispatch_data))
							{
								foreach($dispatch_data as $data)
								{  
							?>
	                    <tr>
							<td><img src="<?php echo IMPATH.'deals/'.@$data['Deal']['image'].'&w=250&h=100';?>"/>		</td>
	                    	<td><?php echo @$data['Deal']['name']?></td>
	                        
							<td><?php echo @$data['DealCategory']['name']; ?></td>                
	                    </tr> 
						<?php	
								}
							} else {
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
			</div>
			<?php
			   } 
			?>
							
				<div class="clearfix"></div>
				<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
