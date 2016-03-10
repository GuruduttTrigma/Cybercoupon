<table class="col-md-12 col-sm-12 col-xs-12 table-bordered border_none table-striped table-condensed cf show_table1">
		<thead class="cf">
			<tr>
				<th width="380" class="td_padding td_color" >Your total sales (%<?php echo $member_info['MemberMeta']['supplier%'];?> share)</th>
				<!--<th width="130" class="td_padding td_color" >EFT</th>
				<th width="130" class="td_padding td_color" >Credit Card</th>-->
				<th width="130" class="td_padding td_color" >Payment Date</th>
				<!--<th width="30" class="td_padding td_color" >Action</th>-->
			</tr>
		</thead>
<!--</table>-->
		<tbody>
<?php if(!empty($orderrelation)){//pr($orderrelation);
	foreach($orderrelation as $list){//pr($list);die;
?>				
<!--<table class="col-md-12 col-sm-12 col-xs-12 table-bordered border_none table-striped table-condensed cf show_table sale_deal_tbl1 pp" >
	<tbody>-->
		<tr>
			
			<td class="td_padding" data-title="Total"  width="240" style="height:70px;"><?php echo $list['PaymentHistory']['total']; ?> </td>
			<!--<td data-title="Eft" class="numeric td_padding"   width="130" ><?php echo $list['PaymentHistory']['eft']; ?>  </td>
			<td data-title="PayU" width="130" class="numeric td_padding"><?php echo $list['PaymentHistory']['payu']; ?></td>-->
			<td data-title="Payment Upto" width="130" class="numeric td_padding"><?php echo date('d M Y',strtotime($list['PaymentHistory']['date']));  ?></td>
			<!--<td class="td_padding" data-title="Total"  width="30" ><a href="<?php echo HTTP_ROOT.'suppliers/payment_history/'.base64_encode(convert_uuencode($list['PaymentHistory']['id']))?>" target="_blank"><span class=" glyphicon glyphicon-eye-open"></span></a> </td>-->
			<!--<a href="javascript:void(0);"><span class=" glyphicon glyphicon-chevron-down"></span></a>-->
			</td>
		</tr>
		
<!--	
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 sale_deal_detail" style="display:none;">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="no-more-tables">
			<table class="col-md-12 table-bordered border_none table-striped table-condensed">
				<thead class="">
					<tr>
						<th class="td_padding td_color">Customer Name</th>
						<th class="td_padding td_color">Order No</th>
						<th class="td_padding td_color" >Customer E-mail</th>
						<th class="td_padding td_color" > Purchase Date</th>
						<th class="td_padding td_color" > Amount</th>
					</tr>
				</thead>
				<tbody>
				
					<tr>
						<td class="td_padding" data-title="Customer Name">sdf</td>
						<td class="td_padding" data-title="Order No">sfds</td>
						<td class="td_padding" data-title="Customer E-mail">sdf</td>
						<td data-title="Purchase Date" class="numeric td_padding">sdf</td>
						<td data-title=" Amount" class="numeric td_padding">sdf</td>
					</tr>
					<tr>
						<td class="td_padding" data-title="Customer Name">sdf</td>
						<td class="td_padding" data-title="Order No">sfds</td>
						<td class="td_padding" data-title="Customer E-mail">sdf</td>
						<td data-title="Purchase Date" class="numeric td_padding">sdf</td>
						<td data-title=" Amount" class="numeric td_padding">sdf</td>
					</tr>
				
				</tbody>
			</table>
</div>
	</div>
</div> 		
-->					
<?php } }else{ ?>
<tr>
			<td colspan="5">
				<div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
					<h2 class="text-center"  style="color:#333;">No records found !!!!!!!!!!</h2>
					<div class="col-md-12  padding_0 form_div_margin_top"></div>
				</div>
			</td>
		</tr>
<?php } ?>
</tbody>
</table>
<!--------------------------for pagination-------------------------------------------------------------->
<?php   if (!empty($orderrelation)) {   
 $pagParam = $this->Paginator->params();
 //pr($this->params);die;
       $this->Paginator->options(array('url' => array('controller'=>'Suppliers','action'=>'claim')));
   ?>
  <!--<div class="pagination_div text-center">	-->
  <div class="text-center">	
    		<ul class="pagination search_paging claim_pagination">
				<?php if($this->params['paging']['PaymentHistory']['pageCount']>1) { ?> 		   
					<li><?php echo $this->Paginator->prev('Prev'); ?></li>
					<li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter')); ?> </li>
					<li><?php  echo $this->Paginator->next('Next'); ?></li>
				<?php } ?>
         </ul>					
		</div>					
<?php } ?>