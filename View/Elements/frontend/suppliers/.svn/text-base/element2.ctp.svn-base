<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
    <thead class="cf">
        <tr>
            <th class="td_padding td_color" >Deal Name</th>
            <th class="td_padding td_color" > Date Submitted</th>
            <th class="td_padding td_color" > Date requested to Run</th>
            <th class="td_padding td_color" > From</th>
            <th class="td_padding td_color" > To</th>
            <th class="td_padding td_color" >Category</th>
            <!--<th class="td_padding td_color" width="66px;" >Action</th>-->
       </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($mydeal_info))
             {
                foreach($mydeal_info as $mydeal)
                {
                	//echo "<pre>";print_r($mydeal);die;
                	 ?>
              <tr>
	             <?php
	             if($mydeal['Deal']['active']=='Yes')
	             {
              	 ?>
                <td class="td_padding" data-title="Deal Name"><a href="<?php echo HTTP_ROOT.'deals/view/'.$mydeal['Deal']['uri'];?>" ><?php echo ucwords($mydeal['Deal']['name']);?></a></td>
                <?php
                }
                else
                {
                ?>
                <td class="td_padding" data-title="Deal Name"><a href="javascript:void(0);" onclick="alert('This deal does not approved by cybercoupon team.')"><?php echo ucwords($mydeal['Deal']['name']);?></a></td>
                <?php
                }
                ?>
                <td data-title="Supplier" class="numeric td_padding"><?php echo date("d M Y",strtotime($mydeal['Deal']['registered']));?></td>
                <td data-title="Supplier" class="numeric td_padding">
					<?php 
					if($mydeal['Deal']['newsletter_sent_date'] == '1970-01-01 00:00:00')
					{
						echo "N/A";
					
					}
					else
					{
						echo date("d M Y",strtotime($mydeal['Deal']['newsletter_sent_date']));
					}
					?>
					</td>
                <td data-title="Supplier" class="numeric td_padding"><?php echo date("d M Y",strtotime($mydeal['Deal']['buy_from']));?></td>
                <td data-title="Date" class="numeric td_padding"><?php echo date("d M Y",strtotime($mydeal['Deal']['buy_to']));?></td>
                <td data-title="Date" class="numeric td_padding"><?php echo $mydeal['DealCategory']['name'];?></td>
                <?php /*
                if($mydeal['Deal']['active']=='Yes')
                {
              	 ?>
                <td data-title="Action" class="numeric td_padding">
                    <a title="Approved Sale" href="<?php echo HTTP_ROOT.'Business/reconcile/'.base64_encode(convert_uuencode($mydeal['Deal']['id']));?>" target="_blank"><span class=" glyphicon glyphicon-eye-open"></span></a>
               	  <!--<a title="This Deal has been Approved and can no longer be edited" href="javascript:void(0);"><span class="glyphicon glyphicon-edit "></span></a>	     -->           
                </td>
                
                <?php
                }
                else 
                {
                ?>
                <td data-title="Action" class="numeric td_padding">
                    <a title="Approved Sale" href="javascript:void(0);" onclick="alert('This deal does not approved by cybercoupon team.')"><span class=" glyphicon glyphicon-eye-open"></span></a>
                   <!--<a class="edit_deal_btn" rel="<?php echo $mydeal['Deal']['id']; ?>" data-target-id="edit-id" title="Edit Deal" href="javascript:void(0);"><span class="glyphicon glyphicon-edit "></span></a>-->
                </td>
                <?php
                } */
                ?>
            </tr>
         <?php
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
			 }	
			?>
  </tbody>
</table>
<div class="text-center">
 <ul class="pagination my_deal_pagination" style="align:center;">
    <?php if($this->params['paging']['Deal']['pageCount']>1) { ?> 		   
      <li><?php echo $this->Paginator->prev('Prev');?></li>
      <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
     	<li><?php  echo $this->Paginator->next('Next');?></li>
    <?php } ?>
</ul>		
</div>
