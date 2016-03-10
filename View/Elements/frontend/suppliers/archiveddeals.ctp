<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
	<thead class="cf">
		<tr>
			<th class="td_padding td_color">Image</th>
			<th class="td_padding td_color">Deal Name</th>
			<th class="td_padding td_color">Date From</th>
			<th class="td_padding td_color">Date To</th>
			<th class="td_padding td_color">Category</th>
			<th class="td_padding td_color">Status</th>
		</tr>
	</thead>
	<?php if(!empty($archiveddeals)){//pr($orderrelation);
				foreach($archiveddeals as $archive){//pr($list);die;
	?>	
	<tbody>
		<tr>
			<td class="td_padding" data-title="Image" width="55" style="border-bottom:none;"><img src="<?php echo IMPATH.'deals/'.$archive['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/></td>
			<td class="td_padding" data-title="Deal Name"><?php echo ucwords($archive['Deal']['name']);?></td>
			<td class="numeric td_padding" data-title="Date From"><?php echo date("d M Y",strtotime($archive['Deal']['buy_from']));?></td>
			<td class="numeric td_padding" data-title="Date To"><?php echo date("d M Y",strtotime($archive['Deal']['buy_to']));?></td>
			<td class="numeric td_padding" data-title="Category"><?php echo $archive['DealCategory']['name'];?></td>
         <?php	
             $expire_status='';		
			    if($archive['Deal']['buy_from'] < date('Y-m-d') && $archive['Deal']['buy_to'] < date('Y-m-d'))
			         $expire_status='purchase';
			    if($archive['Deal']['redeem_from'] < date('Y-m-d') && $archive['Deal']['redeem_to'] < date('Y-m-d'))
			         $expire_status.=" and redeem";
			?>
			<td class="numeric td_padding" data-title="Category"><?php echo $expire_status." date has expired";?></td>
		</tr>
		
		<?php } } else { ?>
		<tr>
			<td colspan="5">
				<div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
					<h2 class="text-center"  style="color:#333;">No Records Found</h2>
					<div class="col-md-12  padding_0 form_div_margin_top"></div>
				</div>
			</td>
		</tr>
		<?php }	?>
	</tbody>
</table>
<ul class="pagination my_archived_pagination" style="align:center;">
<?php if($this->params['paging']['Deal']['pageCount']>1) { ?> 		   
	<li><?php echo $this->Paginator->prev('Prev');?></li>
   <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
   <li><?php  echo $this->Paginator->next('Next');?></li>
<?php } ?>
</ul>		