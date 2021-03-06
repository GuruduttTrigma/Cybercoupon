<?php  
	echo $this->Html->script('frontend/design/owl.carousel.js');
	echo $this->Html->css('frontend/owl.carousel.css'); 
?>	
<style>
	.block_div 
	{
		background: none repeat scroll 0 0 #eaeaea;
		float: left;
		width: 100%;
		margin:9px 0 10px 0;
	}
	.item_in
	{
		padding:0 6px;	
	}
	.block_div p 
	{
		color: #479673;
		float: left;
		font-size: 17px;
		margin: 0;
		padding: 10px;
		text-align: center;
		width: 100%;
	}
	.middle_right
	{
		margin-top: 20px;
	}
	.sy-list li
	{
		height: 375px;
	}
	.sy-list img
	{
		height: 375px;
	}
	.crousl_btn 
	{
		background: transparent;
		color: #777;
		cursor: pointer;
		display: inline-block;
		font-size: 24px;
		margin-bottom: 0;
		min-width: 25px;
		text-align: center;
		vertical-align: middle;
	}
	.btn-right
	{
		position: absolute;
		right:-16px;
		top: 45%;
	}
	.btn-left
	{
		position: absolute;
		left:-18px;
		top: 45%;
	}
	
</style>
<script>	
   $(document).ready(function() 
	{ 
		<?php 
			$i = 10;
			foreach ($alldealsList as $lists) { ?>
			var owl<?php echo $i; ?> = $("#owl-demo-<?php echo $i; ?>");
		    owl<?php echo $i; ?>.owlCarousel({
			    items : 4, //10 items above 1000px browser width
			    itemsDesktop : [1000,3], //5 items between 1000px and 901px
			    itemsDesktopSmall : [900,3], // betweem 900px and 601px
			    itemsTablet: [600,2], //2 items between 600 and 400px
			    itemsTabletSmall: [400,1], //1 items between 400 and 0px
			    //itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
				autoPlay: true,
				scrollPerPage : true,
		    });
			
		    // Custom Navigation Events
		    $(".next-<?php echo $i; ?>").click(function(){
				owl<?php echo $i; ?>.trigger('owl.next');
		    })
		    $(".prev-<?php echo $i; ?>").click(function(){
				owl<?php echo $i; ?>.trigger('owl.prev');
		    })
		    $(".play").click(function(){
				owl<?php echo $i; ?>.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
		    })
		    $(".stop").click(function(){
				owl<?php echo $i; ?>.trigger('owl.stop');
		    })
		<?php $i++;  } ?>
    });
</script>
<?php
    $member_type=$this->Session->read('Member.member_type');
?>

<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 padding_0">
	<div class="block_div"style=" word-wrap: break-word;">
		<?php echo $introductory_text['CmsPage']['content']; ?>
	</div>
</div>	
<?php
if($this->Session->check('success')) 
{
?>
	<div style="float:none!important;" class="BaseStatus session_div">
	<?php echo $this->Session->read('success');?>
	</div>
	<?php unset($_SESSION['success']); ?>
<?php 
} 	
?>			
<!--Text Below Slider ends-->
<!--Middle content -->
<!-- product coategories -->
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
	<?php 
	$i = 10;
	foreach ($alldealsList as $k=>$lists) : 
		if (!empty($lists)) :
	?>
	<div class="prdouct_listing">
		<div class="padding_heading">
			<h1>
				<?php
					echo $k;
				?>
			</h1>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 margin_bottom_15 padding_0">
			<div id="owl-demo-<?php echo $i; ?>">
			<?php
			foreach($lists as $info)
			{
				$total_deal=$info['Deal']['quantity'];
				$sale_deal=$info['Deal']['sales_deal'];
				$remaining_deal=$total_deal-$sale_deal;
			?>
				<div class="item">  
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 item_in">
						<div class="product_block home_active">
						<?php 
						if($remaining_deal>0) 
						{ 
						?>
							<div class="block_img">
								<a href="<?php echo HTTP_ROOT.'deals/view/'.$info['Deal']['uri'];?>">
									<img src="<?php echo IMPATH.'deals/'.$info['Deal']['image'].'&w=700&h=500';?>" class="home_inner"/>
								</a>
							</div>
						<?php 
						} 
						?>
						<div class="block_img_heading">
							<h1>
								<a href="<?php echo HTTP_ROOT.'deals/view/'.$info['Deal']['uri'];?>">
									<?php echo substr($info['Deal']['name'],0,40).'..';?>
								</a>
							</h1>						
							<?php
							$multiple_loc='';
							$multi_loc=explode(',',$info['Deal']['location']);
							//pr($multi_loc);die;
							if(count($multi_loc)>1)
							{
							  $multiple_loc='Multiple Locations';
							}
							if(@$multiple_loc!='')
							{
							?>													
								<label>
									<?php echo $multiple_loc; ?>
								</label>
							<?php 
							} 
							else 
							{ ?>
								<label>
									<?php echo substr($info['Location']['name'],0,20); ?>
								</label>														
							<?php 
							} 
							?>													
							<div class="product_price">
								<label><?php echo $currency."&nbsp".$info['Deal']['max_selling_price'];?></label>
								<h2>
									<?php echo $currency."&nbsp"; ?>
									<?php echo $info['Deal']['max_discount_selling_price'];?>
								</h2>
							</div>
						</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
			</div>
			<a class="crousl_btn prev-<?php echo $i; ?> btn-left">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="crousl_btn next-<?php echo $i; ?> btn-right">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	</div>
	<?php
	$i++;
	endif;
	endforeach; ?>
</div>
