<script type="text/javascript">

$(document).ready(function(){
	var validator = $("#frm").click(function(){
			tinyMCE.triggerSave();
		}).validate({
					ignore: "",
					/*
					rules: {
							
							"data[CmsPage][page_title]":
							{
								//required:true,
								//remote:ajax_url+'admin/Manages/check_cms_title'
							},
							
					 },
				   messages: {
						
						"data[CmsPage][page_title]":
							{
								//required:true,
								//remote:'This title already exists.'
							},
						
					}*/
					rules: {
							"data[CmsPage][content]":
							{
								required:true,
								minlength:10
								//remote:ajax_url+'admin/Manages/contentTag'
							}
					     },
				   messages: {
							 "data[CmsPage][content]":
							 {
								required: 'This field is required',
								//remote: 'content tag'
							 }
						},
				errorPlacement: function(label, element) {
					if (element.is("textarea")) {
						label.insertAfter(element.next());
					} else {
						label.insertAfter(element)
					}
				}
				
	  });
	  validator.focusInvalid = function() {
			// put focus on tinymce on submit validation
			if( this.settings.focusInvalid ) {
				try {
					var toFocus = $(this.findLastActive() || this.errorList.length && this.errorList[0].element || []);
					if (toFocus.is("textarea")) {
						tinyMCE.get(toFocus.attr("id")).focus();
					} else {
						toFocus.filter(":visible").focus();
					}
				} catch(e) {
					// ignore IE throwing errors when focusing hidden elements
				}
			}
		}
});	
tinyMCE.init({
		inline_styles : true,
		mode : "specific_textareas",
		theme : "advanced",
		editor_selector : "tinymce",
		plugins : "pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,phpimage,wordcount,advlist,autosave",
         
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,| ,phpimage" ,
		theme_advanced_buttons2 : "code",
		theme_advanced_buttons3 : false,
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",
	// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		relative_urls : false,
		// Style formats
		style_formats : [
		{title : "Bold text", inline : "b"},
			{title : "Red text", inline : "span", styles : {color : "#ff0000"}},
			{title : "Red header", block : "h1", styles : {color : "#ff0000"}},
			{title : "Example 1", inline : "span", classes : "example1"},
			{title : "Example 2", inline : "span", classes : "example2"},
			{title : "Table styles"},
			{title : "Table row 1", selector : "tr", classes : "tablerow1"}
		],
         
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
});  
//.............

</script>

<style>
.mceIframeContainer iframe
{
	height: 380px !important;
}
table.mceLayout
{
	width:1001px !important;
}
</style>
<div id="page-layout">
<div id="page-content">
<div id="page-content-wrapper">
	<a href="javascript:void(0)" onClick="history.go(-1)" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
   <!--<a href="javascript:void(0)" onclick="history.go(-1)" style="margin-top:-5px; margin-right:10px;" class="ui-state-default ui-corner-all float-right ui-button">Back</a>-->
	<div class="inner-page-title">
		<h2>Edit CMS Page</h2>
   	   <span></span>
	</div>
   <div class="content-box content-box-header" style="border:none;">
	<div class="column-content-box">          
   <div class="ui-state-default ui-corner-top ui-box-header">
		<span class="ui-icon float-left ui-icon-notice"></span>
			Edit CMS Page
   </div>
   <div class="content-box-wrapper">
		<form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT;?>admin/Manages/editCmsPage/<?php echo base64_encode(convert_uuencode($cmsEdit['CmsPage']['id']))?>">
		<fieldset>
		<ul>				
			<li>
				<label class="desc">Page Title:<em>*</em></label>
				<div>
					<input  class="field text full required" id="title" name="data[CmsPage][page_title]" type="text" value="<?php echo $cmsEdit['CmsPage']['page_title'];?>"/>
				</div>
			</li> 
			<div class="">
			<li>
				<label class="desc" for="">Content:<em>*</em></label>
				<div>
					<?php //if($cmsEdit['CmsPage']['id']==7) { ?>

					<?php	 //}	else { ?>
							<textarea style="word-wrap: break-word;" class="field text full tinymce" name="data[CmsPage][content]"><?php echo trim($cmsEdit['CmsPage']['content']);?></textarea>								
					<?php //} ?>		
				</div>
			</li>
			<?php if($cmsEdit['CmsPage']['alias']=='winner') { ?>
			<li>
                   	<label class="desc">Image:<em>*</em></label>
						<div style="width:40%;float:left;">
							<input  class="field text" name="cms_image" type="file" value="<?php echo $cmsEdit['CmsPage']['image'];?>"/>
						</div>
							<div style="width:50%;margin-left:114px;">
							<img  src="<?php echo IMPATH.'CMS/'.$cmsEdit['CmsPage']['image'];?>" height="200" width="200"/>
							</div>							
			</li>
			<li>
                   	<label class="desc">Link Status<em>*</em></label>
						<div  class="inp_holder">							
							<select name="data[CmsPage][link_status]" class="field text full required" style="padding:4px;">
								<option value="">Select</option>
								<option <?php if($cmsEdit['CmsPage']['link_status'] =='Yes') echo 'selected="selected"';?> value="Yes">Yes</option>
								<option <?php if($cmsEdit['CmsPage']['link_status'] =='No') echo 'selected="selected"';?> value="No">No</option>												
							</select>
						</div>													
			</li>
			<?php }?>
			</div>
			<li>
				<input class="submit sub-bttn" type="submit" value="Submit"/>
			</li>
		</ul>
		</fieldset>
		</form>
	</div> <!-- end of content box wrapper --> 
</div>
</div>            
<div class="clearfix"></div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
