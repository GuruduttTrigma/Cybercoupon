<script>
	$(document).ready(function()
	{
		$('#frm').validate();

	});
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onClick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">Back</a>			
			<div class="inner-page-title">
				<h2>Add Currency</h2>
               <span></span>
			</div>
			<form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT;?>admin/Manages/add_currency">
				  <fieldset>
				<div class="content-box content-box-header" style="border:none;">
					<div class="column-content-box">
					
					<div class="ui-state-default ui-corner-top ui-box-header">

						<span class="ui-icon float-left ui-icon-notice"></span>
							Add Currency 
												</div>			
					<div class="content-box-wrapper">
					<ul>
					  	<li> <!-- (You can copy the symbol's html code from <a href="http://character-code.com/currency-html-codes.php" target="_blank">here</a>) -->
					  		<label class="desc">Currency Symbol<em>*</em></label>
							<div>
							  <input  class="field text full required" type="text" name="data[CurrencyManagement][currency]"/>
							</div>
						</li>
						<li>
					  		<label class="desc">Currency Codes<em>*</em></label>
					  		<div>
					  		<select class="field text full required" name="data[CurrencyManagement][currency_code]"  style="padding:3px;">
						   	<option>ZAR</option>   
						   	<!--<option>USD</option>   
						   	<option>EUR</option>   
						   	<option>CAD</option>   
						   	<option>GBP</option>   
						  	 	<option>JPY</option>   						   
						    	<option>ZAR</option>  
						    	<option>NZD</option>  
						    	<option>CHF</option>  
						    	<option>AUD</option> -->						    	
							</select>
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