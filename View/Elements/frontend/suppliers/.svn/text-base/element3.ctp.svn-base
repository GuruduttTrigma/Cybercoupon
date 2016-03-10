<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
    <thead class="cf">
        <tr>
            <!--<th class="td_padding td_color">Image</th>-->
            <th class="td_padding td_color" >Deal Name</th>
            <th class="td_padding td_color" >Buy From</th>
            <th class="td_padding td_color" >Buy To</th>
            <th class="td_padding td_color" >The total number of vouchers redeemed</th>
            <th class="td_padding td_color" >Action</th>
       </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($mydeal_info))
             {
                foreach($mydeal_info as $mydeal)
                {
                	//echo "<pre>";print_r($mydeal);die;
					if($mydeal['Deal']['sales_deal'])
					{
                	 ?>
              <tr>
	             <?php
	             if($mydeal['Deal']['active']=='Yes')
	             {
              	 ?>
                <!--<td class="td_padding" data-title="ID">
					<a href="<?php echo HTTP_ROOT.'deals/view/'.$mydeal['Deal']['uri'];?>" >
						<img src="<?php echo IMPATH.'deals/'.$mydeal['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/>
					</a>
				</td>-->
                <td class="td_padding" data-title="Deal Name">
					<a href="<?php echo HTTP_ROOT.'deals/view/'.$mydeal['Deal']['uri'];?>" >
						<?php echo ucwords($mydeal['Deal']['name']);?>
					</a>
				</td>
                <?php
                }
                else
                {
                ?>
                <!--<td class="td_padding" data-title="ID">
					<a href="javascript:void(0);" onclick="alert('This deal does not approved by cybercoupon team.')">
						<img src="<?php echo IMPATH.'deals/'.$mydeal['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/>
					</a>
				</td>-->
                <td class="td_padding" data-title="Deal Name"><a href="javascript:void(0);" onclick="alert('This deal does not approved by cybercoupon team.')"><?php echo ucwords($mydeal['Deal']['name']);?></a></td>
                <?php
                }
                ?>
				<td><?php echo date('d M Y',strtotime($mydeal['Deal']['buy_from']));  ?></td> 
				<td><?php echo date('d M Y',strtotime($mydeal['Deal']['buy_to'])); ?></td>
                <td data-title="Supplier" class="numeric td_padding">
                <?php 
                	if(!empty($mydeal['Deal']['sales_deal']))
                	{
                		if($mydeal['Deal']['sales_deal'] < 9) {
                			echo ucwords('The Total Number of Vouchers Redeemed for This Deal : '.'<b>'.'0'.$mydeal['Deal']['sales_deal'].'</b>');
							}	
							else {
                			echo ucwords('The Total Number of Vouchers Redeemed for This Deal : '.'<b>'.$mydeal['Deal']['sales_deal'].'</b>');
							}                				
						}
						else
						{
							echo "The Total Number of Vouchers Redeemed for This Deal : <b>00</b>";
							
						}                
                ?>
                </td>
                <td class="numeric td_padding" data-title="Action">
                    <a target="_blank" href="<?php echo HTTP_ROOT.'Business/sales_redeem/'.base64_encode(convert_uuencode($mydeal['Deal']['id']));?>" title="Redeemed Vouchers List"><span class=" glyphicon glyphicon-eye-open"></span></a>
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
 <ul class="pagination sales_total_pagination" style="align:center;">
    <?php if($this->params['paging']['Deal']['pageCount']>1) { ?> 		   
      <li><?php echo $this->Paginator->prev('Prev');?></li>
      <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
     	<li><?php  echo $this->Paginator->next('Next');?></li>
    <?php } ?>
</ul>		
</div>