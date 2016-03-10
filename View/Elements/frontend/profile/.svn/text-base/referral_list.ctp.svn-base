<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="margin-bottom:10px;">
		<div class="table-responsive" id="">
			<table class="table table-bordered border_none">
			  <tbody>
			  	<tr>
				  <th style="width:50%;"  class="td_padding td_color">Name</th>
				  <th style="width:50%;" class="td_padding td_color">Email</th>
			  </tr>
	 
				</tbody>
			</table>
			<?php 
		   if (!empty($referres)) 
		   {
			   foreach($referres as $info) 
			   {
			 ?>
			<table class="col-md-12 col-sm-12 col-xs-12 table-bordered border_none table-striped table-condensed cf">	
				<tbody>
					<tr>
						<td style="width:50%;">
							<?php echo $info['Referred']['name'];?>
						</td>
						<td style="width:50%;">
							<?php echo $info['Referred']['email'];?>
						</td>
					</tr>
				</tbody>
			</table>
         <?php
            }
         ?>
           <div class="pagination_div text-center">	
    		     <ul class="pagination search_paging referral_pagination">
					  <li><?php echo $this->Paginator->prev('Prev');?></li>
					  <li><?php echo $this->Paginator->numbers(array('separator'=>false,'class'=>'counter','currentClass'=>'pageactive'));?></li>
					  <li><?php echo $this->Paginator->next('Next');?></li>
				   </ul>					
			  </div>
			<?php
			}
			else 
			{
			?>
			  <table class="col-md-12 col-sm-12 col-xs-12 table-bordered border_none table-striped table-condensed cf">	
				<tbody>
					<tr>
						<td>
							<?php echo 'No records found';?>
						</td>
					</tr>
				</tbody>
			</table>
         <?php				
			}
			?>					
		</div>
	</div>