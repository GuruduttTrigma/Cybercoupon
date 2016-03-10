<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
	<thead class="cf">
		<tr>
		   <th class="td_padding td_color">Image</th>
			<th class="td_padding td_color">Deal Name</th>
			<th class="td_padding td_color">Location</th>
			<th class="td_padding td_color">Date submitted</th>
			<th class="td_padding td_color">Date requested to run.</th>
			<th class="td_padding td_color">Action</th>
		</tr>
	</thead>
	<?php if(!empty($queued)){
				foreach($queued as $archive){//pr($archive);die;
	?>	
	<tbody>
		<tr>
		   <td class="td_padding" data-title="ID"><a href="<?php echo HTTP_ROOT.'deals/view/'.$archive['Deal']['uri'];?>" ><img src="<?php echo IMPATH.'deals/'.$archive['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/></a></td>
			<td class="td_padding" data-title="Deal Name"><?php echo ucwords($archive['Deal']['name']);?></td>
			<td class="td_padding" data-title="Deal Location"><?php echo ucwords($archive['Location']['name']);?></td>
			<td class="numeric td_padding" data-title="Date To"><?php echo date("d M Y",strtotime($archive['Deal']['buy_from']));?></td>
			<td class="numeric td_padding" data-title="Date To"><?php echo date("d M Y",strtotime($archive['Deal']['newsletter_sent_date']));?></td>
			<td>
				<a class="edit_deal_btn" rel="<?php echo $archive['Deal']['id']; ?>" data-target-id="edit-id" title="Edit Deal" href="javascript:void(0);"><span class="glyphicon glyphicon-edit "></span></a>
			</td>
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
<div class="text-center">
<ul class="pagination my_queued_pagination" style="align:center;">
<?php if($this->params['paging']['Deal']['pageCount']>1) { ?> 		   
	<li><?php echo $this->Paginator->prev('Prev');?></li>
   <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
   <li><?php  echo $this->Paginator->next('Next');?></li>
<?php } ?>
</ul>
</div>		