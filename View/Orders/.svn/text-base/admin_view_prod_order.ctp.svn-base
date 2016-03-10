<script>
$(document).ready(function() 
{
	var product='<?php echo $prod_info['Product']['product_name'];?>';
	$('#show_img').live('click',function()
	{
		var id=$('.pop_capture').html();
			$.fancybox('<div class="sorry-pop"><div class="pop-top"></div><div class="pop-bot" style="float:left">'+id+'</div></div>',{afterClose: function() {
							$('.sorry-pop').remove();
							}
						});
	
	})
	
	/*function printdiv(printpage)
	{
	alert('hiiii');
		var headstr = "<html><head><title></title></head><body>";
		var footstr = "</body>";
		//var newstr = document.all.item(printpage).innerHTML;
		//var newstr = document.all.item('<img width="500" src="<?php echo HTTP_ROOT.'img/custom_checkout/'.$prod_info['Product']['image_name'];?>"/>').innerHTML;
		var newstr='<div style="text-align: center;"><img width="500" src="<?php echo HTTP_ROOT.'img/custom_checkout/'.$prod_info['Product']['image_name'];?>"/></div>';
		var oldstr = document.body.innerHTML;
		document.body.innerHTML = headstr+newstr+footstr;
		window.print();
		document.body.innerHTML = oldstr;
		return false;
	}*/
	function printdiv()
	{
		var content = document.getElementById("captured");
		var pri = document.getElementById("ifmcontentstoprint").contentWindow;
		pri.document.open();
		pri.document.write(content.innerHTML);
		pri.document.close();
		pri.focus();
		pri.print();
	}
	$('#print').live('click',function()
	{
		if(product=='Monster')
		{
			$('#print_img').height(900);
		}
		else if(product=='Major')
		{
			$('#print_img').height(900);
		}
		
		printdiv();
	})
	
	//******************************code for font**********************
	var font_val='<?php echo $prod_info['Product']['engrav_font'];?>';
	if(font_val=='clarendon_blk_btblack')
	{
		$('#font_name').html('Clarendon BT');
	}
	else if(font_val=='clarendon_lt_btlight')
	{
		$('#font_name').html('Clarendon Lt BT');
	}
	else if(font_val=='comic_sans_msregular')
	{
		$('#font_name').html('Comic Sans');
	}
	else if(font_val=='embassy_btregular')
	{
		$('#font_name').html('Embassy BT');
	}
	else if(font_val=='exotc350_bd_btbold')
	{
		$('#font_name').html('Exotc350bt');
	}
	else if(font_val=='futura_md_btmedium')
	{
		$('#font_name').html('Futura Md BT');
	}
	else if(font_val=='ocr-b_10_btregular')
	{
		$('#font_name').html('OCR-B 10 BT');
	}
	else if(font_val=='swis721_btitalic')
	{
		$('#font_name').html('Swis721 Hv BT');
	}
	else
	{
		$('#font_name').html(font_val);
	}
})
</script>
<style>
.product-visual 
{
    text-align: center;
}
.main-url a:hover 
{
    background: none repeat scroll 0 0 #333333;
}
.main-url 
{
    float: left;
    width: 100%;
}
.main-url a 
{
    background-color: rgba(120, 180, 120, 0.8);
    color: rgba(255, 255, 255, 0.8);
    cursor: pointer;
    float: left;
    font-size: 15px;
    letter-spacing: -1px;
    margin: 0 auto;
    padding: 5px 10px;
    position: relative;
    text-align: center;
    text-transform: uppercase;
    width: auto;
}
ul, li, a 
{
    list-style-type: none;
    text-decoration: none;
}

</style>

<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>View Order Details</h2>
               <a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
				<span></span>
             </div>
			
		
			<div class="content-box content-box-header" style="border:none;">
                 <div class="column-content-box">
                      <div class="ui-state-default ui-corner-top ui-box-header">
                         <span class="ui-icon float-left ui-icon-notice"></span>
                         	Order Information
                      </div>
				  <div style="clear:both"></div>    
                      <div class="hastable">
			<table id="sort-table"> 
				<tbody> 
				        <tr>
                           <td><label>Product Name</label></td>
                           <td><span><?php echo $prod_info['Product']['product_name'];?></span></td>
                        </tr>
						<tr>
					   <td><label>Product Image</label></td>
					   <td>
						   <span>
								<a href="javascript:void(0)">
									<img id="show_img" width="15%" src="<?php echo HTTP_ROOT.'img/custom_checkout/'.$prod_info['Product']['image_name'];?>"/>
								</a>
						   </span>
					   </td>
					</tr>
						<tr>
                           <td><label>Base Price</label></td>
                           <td><span><?php echo $prod_info['Product']['base_price'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Wood Color</label></td>
                           <td><span><?php echo $prod_info['Product']['color_wood'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Glass Color</label></td>
                           <td><span><?php echo $prod_info['Product']['color_glass'];?></span></td>
                        </tr>
                    	
                        <tr>
                           <td><label> Bezel color</label></td>
                           <td><span><?php echo $prod_info['Product']['color_bezel'];?></span></td>
                        </tr>
					    
						<tr>
                           <td><label>Frame Color</label></td>
                           <td><span><?php echo $prod_info['Product']['color_frame'];?></span></td>
                        </tr>
						<?php if($prod_info['Product']['product_name']!='Mini')
						{
						?>
						
						<tr>
                           <td><label>Engraving Area #1</label></td>
                           <td><span><?php echo $prod_info['Product']['engrav_text'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Engraving Area #1 Font</label></td>
                           <td><span id="font_name"></span></td>
                        </tr>
						<tr>
                           <td><label>Engraving Area #1 Status</label></td>
                           <td><span><?php echo $prod_info['Product']['engrav_text_status'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Intro</label></td>
                           <td>
						   <span><?php echo $prod_info['Product']['intro'];?></span></td>
                        </tr>
						
						
						<tr>
                           <td><label>Plate (Engraving Area #1)</label></td>
                           <td><span><?php echo $prod_info['Product']['color_plate'];?></span></td>
                        </tr>
						<!---->
						<tr>
                           <td><label>Engraving Area 12 x 10”</label></td>
                           <td><span><?php echo $prod_info['Product']['engr8_text1'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Base Engraving Area 12 x 10”</label></td>
                           <td><span><?php echo $prod_info['Product']['engr8_text2'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Engraving Area 12 x 10” Font</label></td>
                           <td><span><?php echo $prod_info['Product']['engr8_font'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Logo image</label></td>
                           <td>
							   
								<?php 
									if($prod_info['Product']['engr8_logo_name']!='')
									{
								?>
									<span>
										<img src="<?php echo HTTP_ROOT.'img/products_logo/thumb/'.$prod_info['Product']['engr8_logo_name'];?>"/>
								   </span>
								   <a download="<?php echo $prod_info['Product']['engr8_logo_name'];?>" href="<?php echo HTTP_ROOT.'img/products_logo/'.$prod_info['Product']['engr8_logo_name'];?>">Click here to download</a>
								<?php
								}
								else
								{
								?>
									<img src="<?php echo HTTP_ROOT.'img/example_work/'?>image_not_available.gif" height="172" width="181"/>
								<?php }?>
						   </td>
                        </tr>
						<tr>
                           <td><label>Logo price</label></td>
                           <td>
							   <span>
									<?php echo $prod_info['Product']['logo_8_price'];?>
							   </span>
						   </td>
                        </tr>
						<tr>
                           <td><label>Engraving Area – Middle Level (Plate color)</label></td>
                           <td><span><?php echo $prod_info['Product']['color_plat2'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Photo Status</label></td>
                           <td><span><?php echo $prod_info['Product']['pic_status'];?></span></td>
                        </tr>
						<?php
						
							if($prod_info['Product']['pic_status']=='3-pic')
							{
						?>
							<tr>
							   <td><label>Photo1</label></td>
							   <td><span>
							   <img src="<?php echo HTTP_ROOT.'img/products_logo/thumb/'.$prod_info['Product']['pic_name'];?>"/>
								<a download="<?php echo $prod_info['Product']['pic_name'];?>" href="<?php echo HTTP_ROOT.'img/products_logo/'.$prod_info['Product']['pic_name'];?>">Click here to download</a>
							   </span></td>
							</tr>
							<tr>
							   <td><label>Photo2</label></td>
							   <td><span>
							   <img src="<?php echo HTTP_ROOT.'img/products_logo/thumb/'.$prod_info['Product']['pic_name2'];?>"/>
							   <a download="<?php echo $prod_info['Product']['pic_name2'];?>" href="<?php echo HTTP_ROOT.'img/products_logo/'.$prod_info['Product']['pic_name2'];?>">Click here to download</a>
							   </span></td>
							</tr>
							<tr>
							   <td><label>Photo3</label></td>
							   <td><span>
							   <img src="<?php echo HTTP_ROOT.'img/products_logo/thumb/'.$prod_info['Product']['pic_name3'];?>"/>
							   <a download="<?php echo $prod_info['Product']['pic_name3'];?>" href="<?php echo HTTP_ROOT.'img/products_logo/'.$prod_info['Product']['pic_name3'];?>">Click here to download</a>
							   </span></td>
							</tr>
							<tr>
							   <td><label>Plate color (Engraving Area Photo #1)</label></td>
							   <td><span><?php echo $prod_info['Product']['color_plat3'];?></span></td>
							</tr>
							<tr>
							   <td><label>Plate color (Engraving Area Photo #2)</label></td>
							   <td><span><?php echo $prod_info['Product']['color_plat4'];?></span></td>
							</tr>
							<tr>
							   <td><label>Plate color (Engraving Area Photo #3)</label></td>
							   <td><span><?php echo $prod_info['Product']['color_plat5'];?></span></td>
							</tr>
							
							<tr>
							   <td><label>Plate Engraving (Engraving Area Photo #1)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_val'];?></span></td>
							</tr>
							<tr>
							   <td><label>Plate Engraving (Engraving Area Photo #2)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_val4'];?></span></td>
							</tr>
							<tr>
							   <td><label>Plate Engraving (Engraving Area Photo #3)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_val5'];?></span></td>
							</tr>
							
							<tr>
							   <td><label>Font (Engraving Area Photo #1)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_font3'];?></span></td>
							</tr>
							<tr>
							   <td><label>Font (Engraving Area Photo #2)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_font4'];?></span></td>
							</tr>
							<tr>
							   <td><label>Font (Engraving Area Photo #3)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_font5'];?></span></td>
							</tr>
							<?php }
							elseif($prod_info['Product']['pic_status']=='2-pic')
							{
							?>
							<tr>
							   <td><label>Photo1</label></td>
							   <td><span>
							   <img src="<?php echo HTTP_ROOT.'img/products_logo/thumb/'.$prod_info['Product']['pic_name'];?>"/>
								<?php// echo $prod_info['Product']['pic_name'];?>
								<a download="<?php echo $prod_info['Product']['pic_name'];?>" href="<?php echo HTTP_ROOT.'img/products_logo/'.$prod_info['Product']['pic_name'];?>">Click here to download</a>
							   </span></td>
							</tr>
							<tr>
							   <td><label>Photo2</label></td>
							   <td><span>
							   <img src="<?php echo HTTP_ROOT.'img/products_logo/thumb/'.$prod_info['Product']['pic_name2'];?>"/>
							   <?php// echo $prod_info['Product']['pic_name2'];?>
							   <a download="<?php echo $prod_info['Product']['pic_name2'];?>" href="<?php echo HTTP_ROOT.'img/products_logo/'.$prod_info['Product']['pic_name2'];?>">Click here to download</a>
							   </span></td>
							</tr>
							<tr>
							   <td><label>Plate color (Engraving Area Photo #1)</label></td>
							   <td><span><?php echo $prod_info['Product']['color_plat3'];?></span></td>
							</tr>
							<tr>
							   <td><label>Plate color (Engraving Area Photo #2)</label></td>
							   <td><span><?php echo $prod_info['Product']['color_plat4'];?></span></td>
							</tr>
							<tr>
							   <td><label>Plate Engraving (Engraving Area Photo #1)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_val'];?></span></td>
							</tr>
							<tr>
							   <td><label>Plate Engraving (Engraving Area Photo #2)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_val4'];?></span></td>
							</tr>
							<tr>
							   <td><label>Font (Engraving Area Photo #1)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_font3'];?></span></td>
							</tr>
							<tr>
							   <td><label>Font (Engraving Area Photo #2)</label></td>
							   <td><span><?php echo $prod_info['Product']['text_font4'];?></span></td>
							</tr>
						<?php }
						elseif($prod_info['Product']['pic_status']=='yes-pic')
						{
						?>
						<tr>
						   <td><label>Photo1</label></td>
						   <td><span>
						   <img src="<?php echo HTTP_ROOT.'img/products_logo/thumb/'.$prod_info['Product']['pic_name'];?>"/>
							<a download="<?php echo $prod_info['Product']['pic_name'];?>" href="<?php echo HTTP_ROOT.'img/products_logo/'.$prod_info['Product']['pic_name'];?>">Click here to download</a>
						   </span></td>
						</tr>
						<tr>
						   <td><label>Plate color (Engraving Area (Photo #1))</label></td>
						   <td><span><?php echo $prod_info['Product']['color_plat3'];?></span></td>
						</tr>
						<tr>
						   <td><label>Plate Engraving (Engraving Area (Photo #1))</label></td>
						   <td><span><?php echo $prod_info['Product']['text_val'];?></span></td>
						</tr>
						<?php }}
						else{
						?>
						<tr>
                           <td><label>Engraving Area Text</label></td>
                           <td><span><?php echo $prod_info['Product']['engrav_text'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Engraving Area Font</label></td>
                           <td><span><?php echo $prod_info['Product']['engrav_font'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Engraving Area Status</label></td>
                           <td><span><?php echo $prod_info['Product']['engrav_text_status'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Intro</label></td>
                           <td>
						   <span><?php echo $prod_info['Product']['intro'];?></span></td>
                        </tr>
						<tr>
                           <td><label>Plate</label></td>
                           <td><span><?php echo $prod_info['Product']['color_plate'];?></span></td>
                        </tr>
						<?php }?>
						<tr>
						   <td><label>Cord Status</label></td>
						   <td><span><?php echo $prod_info['Product']['card_status'];?></span></td>
						</tr>
						<tr>
						   <td><label>Cord Length</label></td>
						   <td><span><?php echo $prod_info['Product']['card_lt'];?></span></td>
						</tr>
						<tr>
						   <td><label>Cord Price</label></td>
						   <td><span><?php echo $prod_info['Product']['card_price'];?></span></td>
						</tr>
						<tr>
						   <td><label>Power Inputs</label></td>
						   <td><span><?php echo $prod_info['Product']['power_in_status'];?></span></td>
						</tr>
						<tr>
						   <td><label>Power Inputs Price</label></td>
						   <td><span><?php echo $prod_info['Product']['power_in_price'];?></span></td>
						</tr>
						<tr>
						   <td><label>Stand</label></td>
						   <td><span><?php echo $prod_info['Product']['stand_status'];?></span></td>
						</tr>
						<tr>
						   <td><label>Stand Price</label></td>
						   <td><span><?php echo $prod_info['Product']['stand_price'];?></span></td>
						</tr>
						<tr>
						   <td><label>Cord Conduit</label></td>
						   <td><span><?php echo $prod_info['Product']['conduct_status'];?></span></td>
						</tr>
						<tr>
						   <td><label>Inches moving vertically from the FlashPlak base to the height of the outlet</label></td>
						   <td><span><?php echo $prod_info['Product']['conduct_v'];?></span></td>
						</tr>
						<tr>
						   <td><label>inches moving horizontally from that point to the outlet</label></td>
						   <td><span><?php echo $prod_info['Product']['conduct_h'];?></span></td>
						</tr>
						<tr>
						   <td><label>Card Conduct Price</label></td>
						   <td><span><?php echo $prod_info['Product']['conduct_price'];?></span></td>
						</tr>
						<tr>
						   <td><label>Hanger Status</label></td>
						   <td><span><?php echo $prod_info['Product']['hanger_status'];?></span></td>
						</tr>
						<tr>
						   <td><label>Hanger Price</label></td>
						   <td><span><?php echo $prod_info['Product']['handle_price'];?></span></td>
						</tr>
						<tr>
						   <td><label>Handle Status</label></td>
						   <?php
						   if($prod_info['Product']['handle_status']=='')
						   {
						   ?>
						   <td><span><?php echo 'Not applicable';?></span></td>
						   <?php }else{ ?>
						   <td><span><?php echo $prod_info['Product']['handle_status'];?></span></td>
						   <?php } ?>
						</tr>
						<tr>
						   <td><label>Handle Price</label></td>
						   <td><span><?php echo $prod_info['Product']['handle_price'];?></span></td>
						</tr>
						<tr>
						   <td><label>Social Media Status</label></td>
						   <?php
							if($prod_info['Product']['media_status']=='Yes')
							{
						   ?>
							<td><span><?php echo 'Yes,okay';?></span></td>
						   <?php
							}else
							{
						   ?>
							<td><span><?php echo $prod_info['Product']['media_status'];?></span></td>
						   <?php }?>
						</tr>
						
						<tr>
						   <td><label>Notes for the flashplak team</label></td>
						   <?php 
							if($prod_info['Product']['note_flash']!='')
							{
						   ?>
						   <td><span><?php echo $prod_info['Product']['note_flash'];?></span></td>
						   <?php 
							}
							else{
						   ?>
						   <td><span><?php echo 'Not applicable';?></span></td>
						   <?php }?>
						</tr>
                </tbody>
			</table>
			<div class="clear"></div>
		</div>
         <div class="clearfix"></div>
         <div class="clear"></div>
      </div>
       <div class="clear"></div>
	</div>
    
 </div>
	</div>
    <div class="clear"></div>
</div>
<div class="pop_capture" style="display:none">
	<div class="determine">
		<!--<div class="logo-inpop">
			<img src="<?php echo HTTP_ROOT ;?>img/frontend/logo.gif" />
		</div>-->
		<div class="product-visual" id="captured" style="display: block;">
			<img id="print_img" width="500" src="<?php echo HTTP_ROOT.'img/custom_checkout/'.$prod_info['Product']['image_name'];?>"/>
		</div>
		<div class="main-url">
			<a id="download_flash" href="<?php echo HTTP_ROOT.'img/custom_checkout/'.$prod_info['Product']['image_name'];?>" download="<?php echo $prod_info['Product']['image_name'];?>">Save</a>
			<span style="float:right">
			<a id="print" href="javascript:void(0)">Print</a>
			</span>
			<p>www.flashplak.com</p>
		</div>
	</div>
</div>

<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute"></iframe>