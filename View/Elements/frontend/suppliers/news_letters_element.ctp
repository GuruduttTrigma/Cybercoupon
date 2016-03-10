<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
    <thead class="cf">
        <tr>
            <th class="td_padding td_color">Image</th>
            <th class="td_padding td_color" >Deal Name</th>
            <th class="td_padding td_color" >Description</th>
       </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($data))
             {
             	foreach($data as $mydeal)
                {
                	//pr($mydeal);die;
                	if($mydeal['Dispatch']['status']=='sent') 
                	{
                
                	 ?>
              <tr>
	            <?php 
				if($mydeal['Deal']['active']=='No')
				{
				?> 
                <td class="td_padding" data-title="ID">
					<img src="<?php echo IMPATH.'deals/'.$mydeal['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/>
				</td>
                <td class="td_padding" data-title="Deal Name">
					<?php echo ucwords($mydeal['Deal']['name']);?>
				</td>   
				<?php 
				}
				else
				{
				?>
				<td class="td_padding" data-title="ID">
					<a href="<?php echo HTTP_ROOT.'deals/view/'.$mydeal['Deal']['uri'];?>">
						<img src="<?php echo IMPATH.'deals/'.$mydeal['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/>
					</a>
				</td>
                <td class="td_padding" data-title="Deal Name">
					<a href="<?php echo HTTP_ROOT.'deals/view/'.$mydeal['Deal']['uri'];?>" target="_blank">
						<?php echo ucwords($mydeal['Deal']['name']);?>
					</a>
				</td>  
				<?php 
				}
				?>
                <td data-title="Supplier" class="numeric td_padding">
                <?php 
                	
						echo "This deal was promoted in a newsletter that was sent out on ".date('d M Y',strtotime($mydeal['Dispatch']['sent_date'])). " in ". $mydeal['Deal']['Location']['name'].".";
						//echo $mydeal['Dispatch']['status'];               
                ?>
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
 <ul class="pagination news_letters_pagination" style="align:center;">
    <?php if($this->params['paging']['DispatchDeal']['pageCount']>1) { ?> 		   
      <li><?php echo $this->Paginator->prev('Prev');?></li>
      <li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
     	<li><?php  echo $this->Paginator->next('Next');?></li>
    <?php } ?>
</ul>		
</div>