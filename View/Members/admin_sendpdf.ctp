
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onClick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
			<div class="inner-page-title">
				<h2>Send Pdf</h2>
               <span></span>
			</div>
			<form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT;?>admin/Members/sendpdf/<?php echo base64_encode(convert_uuencode($member['Member']['id']))?>">
				  <fieldset>
				<div class="content-box content-box-header" style="border:none;">
					<div class="column-content-box">
					
					<div class="ui-state-default ui-corner-top ui-box-header">

						<span class="ui-icon float-left ui-icon-notice"></span>

						Send pdf
					</div>
					
					<div class="content-box-wrapper">
						<ul>  
							<li>
							<label class="desc">Email<em>*</em></label>
							<div>							 
   							<input class="field text full " readonly="readonly" type="text" name="Email" value="<?php echo $member['Member']['email'];; ?>" >
							</div>
						  </li>
						  <li>
							<label class="desc">PDF</label>
							<div>							 
   							<input type="file" name="Pdf" >
							</div>
						  </li>
						</ul>
				  </div> <!-- end of content box wrapper -->
					</div>
				</div>
				  <li>
					<input class="submit sub-bttn" type="submit" value="Submit"/>
				  </li>
				</fieldset>
            </form>
            
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>