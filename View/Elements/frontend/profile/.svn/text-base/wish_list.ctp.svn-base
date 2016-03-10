<script>
	$(document).ready(function(){
		$(document).on('click','.delete_wishlist',function(){		
		var frmId= $(this).attr('rel');
		var $this=$(this);
		//alert(frmId);
		$.ajax({
				 type: 'post',
				 url: ajax_url+'Customers/delete_wishlist/'+frmId,
				 async: false,
				 success:function(resp){
						$('.session_div').show().html('Your Wishlist has been deleted successfully.');
						$('html,body').animate({scrollTop: $("#scrool").offset().top-50},'slow');
						setTimeout( function() {$('.session_div').hide().html('');}, 4*1000);
						$this.closest('.listing_product').remove();
				 	}
				})
		
		})
		});
</script>	
	<?php if(!empty($wishDeals)){
				foreach($wishDeals as $wishes)
				{
					
	?>
	<div class="listing_product">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<img src="<?php echo IMPATH.'deals/'.$wishes['Deal']['image'].'&w=300&h=181';?>" class="img-responsive"/>
			</div>
			<div class="col-lg-7 col-md-7 col-sm-7 col-lg-12">
				<div class="lising_block">
					<h5><?php echo $wishes['Deal']['name']; ?></h5>
					<label class="expiMsg">
					<?php if($wishes['Deal']['active']=='Yes'){ ?>
					This deal expires on <?php echo date('d M Y',strtotime($wishes['Deal']['buy_to'])); ?>
					<?php }else{ ?>
					This deal has expired and is no longer for sale.
					<?php } ?>
					</label>
					<!--<label>Dublin Vacation with Airfare from Great Value Vacations</label>-->
					<?php
					$multiple_loc='';
					$multi_loc=explode(',',$wishes['Deal']['location']);
					if(count($multi_loc)>1)
					{
					  $multiple_loc='Multiple Location';
					}
					if(@$multiple_loc!='')
					{
					?>	
					<label><?php echo $multiple_loc; ?> </label>
					<?php
					} 
					else
					{ ?>
					<label><?php echo $wishes['Deal']['Location']['name']; ?></label>														
					<?php } ?>
					<label><?php //echo $wishes['Deal']['description'];
											if(strlen($wishes['Deal']['description'])>450)
											{
													echo substr($wishes['Deal']['description'],0,450).'...';
											}
											else
											{
													echo $wishes['Deal']['description'];
											}
					?></label>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-center">
				<div class="view_detail">
					<label><?php echo $currency; ?><?php echo $wishes['Deal']['max_selling_price'];?></label>
					<span><?php echo $currency; ?><?php echo $wishes['Deal']['max_discount_selling_price'];?></span>
					<?php if($wishes['Deal']['active']=='Yes'){ ?>
						<a href="<?php echo HTTP_ROOT.'deals/view/'.$wishes['Deal']['uri'] ;?>" class="btn btn-primary">View</a>
						<a href="javascript:void(0);" class="btn btn-primary delete_wishlist" rel="<?php echo $wishes['Deal']['id'] ;?>">Delete</a>
					<?php }?>
				</div>
				
			</div>
	</div>
<?php } }else{ ?>
 <div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
											<h2 class="text-center" style="color:#333;">No records found !!!!!!!!!!</h2>
											<div class="col-md-12  padding_0 form_div_margin_top">
												
									  </div>
									</div>
<?php } ?>

<!--------------------------for pagination-------------------------------------------------------------->
   <?php   if(!empty($wishDeals)) {   
 $pagParam = $this->Paginator->params();
   ?>
  <div class="pagination_div text-center">	
    		<ul class="pagination search_paging wishlist_pagination">
				<?php if($this->params['paging']['Wishlist']['pageCount']>1) { ?> 		   
					<li><?php echo $this->Paginator->prev('Prev');?></li>
					<li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
					<li><?php  echo $this->Paginator->next('Next');?></li>
				<?php } ?>
         </ul>					
		</div>					
<?php } ?>