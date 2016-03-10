<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<div class="inner-page-title">
				<h2>View Slider Details</h2>
               <a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
				<span></span>
             </div>
			
		
			<div class="content-box content-box-header" style="border:none;">
                <div class="column-content-box">
                      <div class="ui-state-default ui-corner-top ui-box-header">
                         <span class="ui-icon float-left ui-icon-notice"></span>
                         	Slider Information
                      </div>
				    <div style="clear:both"></div>    
					<div class="hastable">
						<table id="sort-table"> 
							<tbody> 
								<tr>
								   <td><label>Image</label></td>
								   <td>
								   	<span>
									<img src="<?php echo IMPATH.'sliders/'.$slider['Slider']['image'].'&w=200&h=200';?>"/>									
								   	</span>
								   </td>
								</tr>
								<tr>
								   <td><label>Title</label></td>
								   <td>
								   	<span>
								   		<?php echo $slider['Slider']['title']; ?>
								   	</span>
								   </td>
								</tr>
								<tr>
								   <td><label>Active</label></td>
								   <td>
								   	<span>
								   		<?php echo $slider['Slider']['active'];?>
								   	</span>
								   </td>
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