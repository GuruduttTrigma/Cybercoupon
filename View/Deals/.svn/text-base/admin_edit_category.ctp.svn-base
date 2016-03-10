<?php
//if($this->data['DealCategory']['active'] == 'Yes') echo 'selected="selected"';
//echo "<pre>";print_r($this->data['DealCategory']['active']);die;
?>
<script>
$(document).ready(function(){
	
	   $('#add_editcms_info').validate({
          rules:
         {
             "data[DealCategory][name]":
             {
                 required:true,
				           remote:ajax_url+'deals/unique_dealcategory'
             }    
         },
         messages:
         {
           	  "data[DealCategory][name]":
             {
                required:'This field is required.',
                remote:'This deal name already exist'
             } 
         }
    });
    
    $('.category_submit').click(function(){
        var parent_category=$('#DealCategoryParentId').val();
        var newcategory=$('#category_name').val();
        var current_categoryid=$('#edit_cat_id').val();
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
                         $('#edit_dealcategory').submit();
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
              <h2>Edit Navigation Content</h2>
              <input type="hidden" value="<?php echo $this->data['DealCategory']['id']?>" id="edit_cat_id" class="id">
              <a href="<?php echo HTTP_ROOT;?>admin/Deals/categories" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;">Back</a>
              <a href="<?php echo HTTP_ROOT;?>admin/Deals/delete/<?php echo $this->data['DealCategory']['id']?>" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;" onclick="return confirm('Are you sure you want to delete this navigation page?');">Delete</a>
              <?php if($this->data['DealCategory']['parent_id']!=""){?>
              <!--<a href="<?php echo HTTP_ROOT;?>admin/Deals/removeNode/<?php echo $this->data['DealCategory']['id']?>" class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;" onclick="return confirm('Are you sure you want to remove the node this navigation page?');">Remove The Node</a>-->
              <?php }?>
              <span></span>
          </div>
           <?php if($myvar = $this->Session->flash()) { ?>
				 
                     <div class="response-msg success ui-corner-all">
					 		<?php echo $myvar;?>
                     </div>
                        
          <?php }?>
           
        
          <div class="content-box content-box-header" style="border:none;">
              <div class="column-content-box">
                  <div class="ui-state-default ui-corner-top ui-box-header">
                      <span class="ui-icon float-left ui-icon-notice"></span>
                  Edit Navigation Content
                  </div>
                  <div class="error_msg" style="display:none !important;">
                          <img src="<?php echo HTTP_ROOT;?>images/error_new.png" alt="Warning!" width="24" height="24" style="float:left; margin: -5px 10px 0px 0px; " />
                    
                          <span>Please fill the highlighted fields</span><br clear="all"/>
                        </div>
                  <div id="tabs"> 						 
                    <form action="<?php echo HTTP_ROOT.'admin/Deals/edit_category/'.$id?>" method="post" id="edit_dealcategory">
                            <input type="hidden" class="id" value="<?php echo $id;?>">      							
                        <div class="content-box-wrapper">
                         
                           <ul>
                              <li>
                                  <label class="desc" >Parent</label>
                                    <div>
                                    <?php 
									//echo $this->data['Category']['parent_id'];
									echo $this->Form->input('DealCategory.parent_id', array('label'=>'','selected'=>$this->data['DealCategory']['parent_id'],'class'=>'text full field1'));?>

                                    </div>
                                    
                                </li>
                                
                 
                                
                                <li class="ext_link">
                                    <label class="desc" >Category Name</label>
                                    <div>
                                         <input  class="field text full" id="category_name" name="data[DealCategory][name]" type="text" value="<?php echo $this->data['DealCategory']['name'];?>"/>
                                         <label class="error"></label>
                                         <input  class="field text full" name="data[DealCategory][uri]" type="hidden" value="<?php echo $this->data['DealCategory']['name'];?>"/>                                   
                                     </div>
                                </li>
                                <li class="ext_link">
                                    <label class="desc" >Active Display on Homepage</label>
                                    <select name="data[DealCategory][active]" class="field text full required">
													<option value="">Select</option>
													<option value="Yes" <?php if($this->data['DealCategory']['active'] == 'Yes') echo 'selected="selected"';?> >Active</option>
													<option value="No" <?php if($this->data['DealCategory']['active'] == 'No') echo 'selected="selected"';?> >Inactive</option>
												</select>
                                </li>
                           
                       </div>
                                <li>
                                    <input class="sub-bttn category_submit" type="button"  value="Submit"/>
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