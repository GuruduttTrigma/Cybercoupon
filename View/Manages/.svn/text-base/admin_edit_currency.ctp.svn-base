<script type="text/javascript">
$(document).ready(function(){
	$('#frm').validate();
});
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<a href="javascript:void(0)" onClick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
			<div class="inner-page-title">
				<h2>Edit Currency</h2>
               <span></span>
			</div>
            <form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Manages/edit_currency/'.base64_encode(convert_uuencode($id))?>">
              <fieldset>
            <div class="content-box content-box-header" style="border:none;">
			<div class="column-content-box">
            
            <div class="ui-state-default ui-corner-top ui-box-header">

                <span class="ui-icon float-left ui-icon-notice"></span>

                Edit Currency
            </div>
            
            <div class="content-box-wrapper">
            	<input type="hidden" id="mem_id" value="<?php echo $id; ?>" />
                
                <ul>
                    <li>
                    <label class="desc">Currency Symbol<em>*</em></label>
                    <div>
                      
					  <input type="text"  class="field text full required" value="<?php echo $currency['CurrencyManagement']['currency'];?>" name="data[CurrencyManagement][currency]" >
                    </div>
                  </li>
                  <li>
                  <label class="desc">Currency Codes<em>*</em></label>
					  		<div>
					  		<select class="field text full required" name="data[CurrencyManagement][currency_code]" style="padding:3px;" >
						   	<option  <?php if($currency['CurrencyManagement']['currency_code']=="ZAR"){ echo 'selected="selected"'; } ?>>ZAR</option>   
						   	<!--<option <?php if($currency['CurrencyManagement']['currency_code']=="EUR"){ echo 'selected="selected"'; } ?>>EUR</option>   
						   	<option <?php if($currency['CurrencyManagement']['currency_code']=="CAD"){ echo 'selected="selected"'; } ?>>CAD</option>   
						   	<option <?php if($currency['CurrencyManagement']['currency_code']=="GBP"){ echo 'selected="selected"'; } ?>>GBP</option>   
						  	 	<option <?php if($currency['CurrencyManagement']['currency_code']=="JPY"){ echo 'selected="selected"'; } ?>>JPY</option>   						   
						    	<option <?php if($currency['CurrencyManagement']['currency_code']=="ZAR"){ echo 'selected="selected"'; } ?>>ZAR</option>  
						    	<option <?php if($currency['CurrencyManagement']['currency_code']=="NZD"){ echo 'selected="selected"'; } ?>>NZD</option>  
						    	<option <?php if($currency['CurrencyManagement']['currency_code']=="CHF"){ echo 'selected="selected"'; } ?>>CHF</option>  
						    	<option <?php if($currency['CurrencyManagement']['currency_code']=="AUD"){ echo 'selected="selected"'; } ?>>AUD</option> 						    	
								-->							
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