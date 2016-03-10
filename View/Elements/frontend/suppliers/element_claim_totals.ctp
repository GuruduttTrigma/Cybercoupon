<div class = "no-more-tables">
	<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
		<thead class="cf">
			<tr>
				<!--<th class="td_padding td_color">Image</th>-->
				<th class="td_padding td_color" >Voucher Code</th>
				<th class="td_padding td_color" >Claim Date</th>
				<th class="td_padding td_color" >Total Amount</th>
				<th class="td_padding td_color" >Claim Status</th>
		   </tr>
		</thead>
		<tbody>
			<?php
				if(!empty($mydeal_info))
				{
					foreach($mydeal_info as $mydeal)
					{
						if($mydeal['OrderDealRelation'])
						{
						 ?>
						  <tr>
							<td><?php echo $mydeal['OrderDealRelation']['voucher_code']; ?></td>
							<td><?php echo date('d F y',strtotime($mydeal['OrderDealRelation']['c_r_date']));  ?></td> 
							<td>
								<?php echo $mydeal['OrderDealRelation']['sub_total']; ?>
							</td>
							<td>
								<?php echo $mydeal['OrderDealRelation']['claim_status'];?>
							</td>
						</tr>
				<?php
						}
					}
				} 
			  else
			   {
			  ?>
				<tr>
					<td colspan="5">
						<div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
							<h2 class="text-center" style="color:#333;">No Records Found</h2>
							<div class="col-md-12  padding_0 form_div_margin_top"></div>
						</div>
					</td>
				</tr>
			<?php
			  }	?>
	  </tbody>
	</table>
	<div class="text-center">
	 <ul class="pagination claims_total_pagination" style="align:center;">
		<?php if($this->params['paging']['OrderDealRelation']['pageCount']>1) { ?> 		   
		  <li><?php echo $this->Paginator->prev('Prev');?></li>
		  <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
			<li><?php  echo $this->Paginator->next('Next');?></li>
		<?php } ?>
	</ul>		
	</div>
</div>