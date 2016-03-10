<div class="no-more-tables">
<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
	<thead class="cf">
		<tr>
			<th class="td_padding td_color">Customer Name</th>
			<th class="td_padding td_color">Voucher No.</th>
			<th class="td_padding td_color" >Customer E-mail</th>
			<th class="td_padding td_color" > Purchase Date</th>
			<th class="td_padding td_color" > Amount</th>
		</tr>
	</thead>
	<tbody>
	<?php if (!empty($reconcile_list)){
		
			foreach($reconcile_list as $list): ?>
		<tr>
			<td class="td_padding" data-title="Customer Name"><?php echo $list['Order']['Member']['name'].' '.$list['Order']['Member']['surname']; ?></td>
			<td class="td_padding" data-title="Order No"><?php echo $list['OrderDealRelation']['voucher_code']; ?></td>
			<td class="td_padding" data-title="Customer E-mail"><?php echo $list['Order']['Member']['email']; ?></td>
			<td data-title="Purchase Date" class="numeric td_padding"><?php echo date('d M Y',strtotime($list['Order']['payment_date'])); ?></td>
			<td data-title=" Amount" class="numeric td_padding"><?php echo $currency,$list['OrderDealRelation']['sub_total']; ?></td>
		</tr>
	<?php endforeach; 
				}
				else { ?>
				<tr class="mrgntbl">
						<td class="td_padding table_No_record" colspan="5" data-title="">No Records Found</td>
				</tr>
	<?php		}
	?>	
	</tbody>
</table>
						</div>
						<!--------------------------for pagination-------------------------------------------------------------->
   <?php   if(!empty($reconcile_list)){   
 $pagParam = $this->Paginator->params();
 //pr($this->params);die;
       //$this->Paginator->options(array('url' => array('controller'=>'Suppliers','action'=>'sales_made')));
   ?>
  <div class="pagination_div text-center">	
    		<ul class="pagination">
				<?php if($this->params['paging']['OrderDealRelation']['pageCount']>1) { ?> 		   
					<li><?php echo $this->Paginator->prev('Prev'); ?></li>
					<li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter')); ?> </li>
					<li><?php  echo $this->Paginator->next('Next'); ?></li>
				<?php } ?>
         </ul>					
		</div>					
<?php } ?>