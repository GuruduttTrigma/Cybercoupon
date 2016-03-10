<script type="text/javascript">
	
$(document).ready(function(){

      $('.category_submit').click(function(){
        var parent_category=$('#DealCategoryParentId').val();
        var newcategory=$('#category_name').val();
        var current_categoryid=0;
        if($.trim(newcategory)!='')
        {
	        $.ajax({
	              type:'POST',
	              url:ajax_url+'deals/unique_dealcategory',
	              data:{current_categoryid:current_categoryid,parent_category:parent_category,newcategory:newcategory},
	              success:function(result)
	              {
		                if($.trim(result)=='ok')
		                {
		                   $('#category_name').next('label').text('');
                         $('#add_dealcategory').submit();
		                }
		                else
		                {
		                   $('#category_name').next('label').text('This deal name already exist.');
                         return false;
		                }
	              }
	         })
         }
         else
         {
            $('#category_name').next('label').text('This field is required.');
            return false;
         }
         
      });
         
});	
	
</script>

<div id="page-layout">
  <div id="page-content">
      <div id="page-content-wrapper">
          <div class="inner-page-title">
              <h2>Add Deal Category Page</h2>
              <a href="javascript:void(0)" onclick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
              <span></span>
          </div>
           
          <div class="content-box content-box-header" style="border:none;">
              <div class="column-content-box">
                  <div class="ui-state-default ui-corner-top ui-box-header">
                      <span class="ui-icon float-left ui-icon-notice"></span>
                     Add Deal Category Information 
                  </div>
                  
                  <div id="tabs"> 						 
                    <form action="<?php echo HTTP_ROOT.'admin/Deals/add_category'?>" method="post" id="add_dealcategory">
                        <div class="content-box-wrapper">
                         
                           <ul>
                                
                                <li>
                                  <label class="desc" >Parent</label>
                                    <div>
                                       <?php  echo $this->Form->input('DealCategory.parent_id',array('label'=>'', 'class'=>'text full field1')); ?>
                                    </div>
                                    
                                </li>
                                
                                <li>
                                    <label class="desc">Name</label>
                                    <div>
                                         <input id="category_name" class="field text full" name="data[DealCategory][name]" type="text" value="" />
                                         <label class="error"></label>
                                    </div>
                                    
                                </li>
                                
                                <li>
                                  <label class="desc" >Status:</label>
                                <div>
											<select name="data[DealCategory][active]"  style="width:99%; height:36px;">
												<option value="Yes">Active</option>
												<option value="No">Inactive</option>
											</select>                                
                                </div>
                              	</li>
                                <li>
                                    <input class="sub-bttn category_submit" type="button" value="Submit"/>
                                </li>
                          </ul>                        
                        </div>                    
                    </form>
                  </div>
                  
               </div>
              <div class="clearfix"></div>
              <div class="clear"></div>
         </div>
          <div class="clear"></div>
     </div>
   </div>
   <div class="clear"></div>
</div>