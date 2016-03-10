	<style>
		.parent{
			padding-left: 0px;
		}
		.child{
			padding-left: 5px!important;
		}
		.locate{
	cursor: pointer;			
			}

	</style>
	<form id="category_form" method="post" action="<?php echo HTTP_ROOT.'deals/search_deal';?>">
		<div class="left_listing">
				<div class="list_heading">	
					<h1 class="locate">Location <span class="glyphicon glyphicon-plus iconshow"></span></h1>				
				</div>	
		</div>	
		<div class="location_div" style="display:none;">	
			<ul class="list-unstyled">
				<li style="padding-left:0px;">
					<input name="data[Location][id][]" class="left_check loc_id allcheck form_submit parent" type="checkbox" value="All" checked> All
				</li>
				<?php
				foreach($location as $loc)
				{ 
				?>
				<li>
					<input name="data[Location][id][]" class="left_check loc_id childcheck form_submit child" type="checkbox" value="<?php echo @$loc['Location']['id'];?>"> <?php echo $loc['Location']['name'];?>
				</li>
				<?php
				}
				?>	   
				<?php 
					if((count($location)) > 4) 
					{ ?>
					   <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

							<div class="list_view">

								<a href="<?php echo HTTP_ROOT.'';?>"><span class="glyphicon glyphicon-hand-right"></span>View More</a>

							</div>

						 </div>-->
				<?php } ?>
			</ul>	
		</div>
		<div class="left_listing">
			<div class="list_heading">
				<h1 class="locate">Categories <span class="glyphicon glyphicon-minus iconshow"></span></h1>
			</div>
		</div>
		<div class="panel_div location_div" style="display:block;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
				<div class="panel ">
					<!-- <input class="category_all" type="checkbox" <?php if(in_array(@$cateogry['DealCategory']['id'],$cateogry)) {echo "checked" ;}?> name="data[Category][id][]" value="<?php echo @$cateogry['DealCategory']['id']; ?>">All</h3>-->
				     <?php
						foreach($deal_cateogry as $cat) 
						{ ?>
							<div class="panel-heading cat_parent_div inner_sub">
								<h3 class="panel-title">
									<input class="left_check form_submit cat_parent p_<?php echo $cat['uri']; ?>" rel="<?php echo $cat['uri']; ?>" type="checkbox"  value="<?php echo $cat['id']; ?>" <?php if ($cate==$cat['uri']) { echo 'checked="checked"'; } ?>>
									<div class="text_plus inner_subtxt">
										<div class="sub_area"> <?php echo $cat['name']; ?> 
											<span>(<?php echo "All";//$cat['count']; ?>) </span>
						 				</div>
						 				<span class="glyphicon glyphicon-plus iconshow"></span>
					 				</div> 	
								</h3>
							</div>
							<?php
							if(!empty($cat['children']))
							{
							?>
								<div class="inner_sub_cat_div">
								<?php														
									foreach($cat['children'] as $sub_cat)
									{
									?>
										<div class="panel-body cat_child_div sub_child">
											<input class="left_check form_submit cat_child_check c_<?php echo $cat['uri']; ?>" data-childcat="<?php echo $cat['uri']; ?>" type="checkbox" name="data[Category][id][]" value="<?php echo $sub_cat['id']; ?>" <?php if ($cate==$cat['uri']) { echo 'checked="checked"'; } ?>/><?php echo $sub_cat['name']; ?> 
											<span>(<?php echo $sub_cat['count']; ?>)</span>
										</div>	
									<?php
									}
								?>
								</div>
							<?php		
							}
						}
					?>	
				</div>
			</div>
		</div>
	</form>
<script type="text/javascript" >
$(document).ready(function(){ 
  	   $('.locate').click(function(){				
			$(this).parent().parent('.left_listing').next('.location_div').toggle();	
		});
		$('.inner_subtxt').click(function(){				
			$(this).parent().parent('.cat_parent_div').next('.inner_sub_cat_div').toggle();	
		});  	
		$('.locate').click(function(){
			if($(this).children('span').hasClass('glyphicon-plus'))
			{
				$(this).children('span').removeClass('glyphicon-plus');				
			   $(this).children('span').addClass('glyphicon-minus');	
			}
			else
			{			
			   $(this).children('span').removeClass('glyphicon-minus');
			   $(this).children('span').addClass('glyphicon-plus');
			}						
		});
		$('.inner_subtxt').click(function(){
			if($(this).children('span').hasClass('glyphicon-plus'))
			{
				$(this).children('span').removeClass('glyphicon-plus');				
			   $(this).children('span').addClass('glyphicon-minus');	
			}
			else
			{			
			   $(this).children('span').removeClass('glyphicon-minus');
			   $(this).children('span').addClass('glyphicon-plus');
			}
						
		});
});	 
</script>
<script>
$(document).ready(function(){	
      $('.cat_parent').each(function(){
      	if($(this).is(':checked'))
      	{
      		$(this).parent().parent('.inner_sub').next('.inner_sub_cat_div').show();
      		
      		if($(this).next('div.inner_subtxt').children('span').hasClass('glyphicon-plus'))
				{
					$(this).next('div.inner_subtxt').children('span').removeClass('glyphicon-plus');				
				   $(this).next('div.inner_subtxt').children('span').addClass('glyphicon-minus');	
				}
				else
				{			
				   $(this).next('div.inner_subtxt').children('span').removeClass('glyphicon-minus');
				   $(this).next('div.inner_subtxt').children('span').addClass('glyphicon-plus');
				}
      	}
      });

		$('.cat_parent').click(function()
		{
		    $(this).parent().parent('div.cat_parent_div').nextUntil('.cat_child_div').children('input').attr('checked',true);
		});


     /*-----------------For location Searching-------------------*/
     /*$('.location_check').click(function(){
         if (!$(this).is(':checked'))
         {
             //return confirm('are you sure you want to uncheck');
         }
         else
         {
           $.ajax({
              type:'POST',
              url:ajax_url+'deals/search_deal',
              data:$('#location_form').serialize(),
              success:function(resp)
              {
                  //alert(resp);
                  $('.all_deal_right').html(resp);
              }          
           });
        }
        
     });*/
      /*-----------------For Catgory Searching-------------------*/
      $('.category_check').click(function(){ 
          if (!$(this).is(':checked'))
          {  
              
          }
          else
          {
             $.ajax({
                 type:'POST',
                 url:ajax_url+'deals/search_catgory_deal',
                 data:$('#category_form').serialize(),
                 success:function(resp)
                 {
                      //alert(resp);
                     $('.all_deal_right').html(resp);
                 }          
              });
           }
     });
});
</script>