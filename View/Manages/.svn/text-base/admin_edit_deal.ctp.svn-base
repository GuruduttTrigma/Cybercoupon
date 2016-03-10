<?php
	echo $this->Html->script('backend/development/ui.datepicker.js');
	echo $this->Html->css('backend/smooth.css');

	
?>
<?php echo $this->Html->script('ajaxupload.3.5.js'); ?>
<!-------------------Upload Button Script-------------->
<script type ="text/javascript">
	$(document).ready(function(){
	var is_supported_browser = !!window.File,
        fileSizeToBytes,
        formatter = $.validator.format;

  		$.validator.addMethod(
        "minFileSize",
        function (value, element, params) {

            var files,
                unit = params.unit || "KB",
                size = params.size || 100,
                min_file_size = fileSizeToBytes(size, unit),
                is_valid = false;

            if (!is_supported_browser || this.optional(element)) {

                is_valid = true;

            } else {

                files = element.files;

                if (files.length < 1) {

                    is_valid = false;

                } else {

                    is_valid = files[0].size >= min_file_size;

                }
            }

            return is_valid;
        },
        function (params, element) {
            return formatter(
                "File must be at least {0}{1} large.",
                [params.size || 100, params.unit || "KB"]
            );
        }
    );
	
	$.validator.addMethod(
        "maxFileSize",
        function (value, element, params) {

            var files,
                unit = params.unit || "KB",
                size = params.size || 100,
                max_file_size = fileSizeToBytes(size, unit),
                is_valid = false;

            if (!is_supported_browser || this.optional(element)) {

                is_valid = true;

            } else {

                files = element.files;

                if (files.length < 1) {

                    is_valid = false;

                } else {

                    is_valid = files[0].size <= max_file_size;

                }
            }

            return is_valid;
        },
        function (params, element) {
            return formatter(
                "File cannot be larger than {0}{1}.",
                [params.size || 100, params.unit || "KB"]
            );
        }
    );
	
	fileSizeToBytes = (function () {

        var units = ["B", "KB", "MB", "GB", "TB"];

        return function (size, unit) {

            var index_of_unit = units.indexOf(unit),
                coverted_size;

            if (index_of_unit === -1) {

                coverted_size = false;

            } else {

                while (index_of_unit > 0) {
                    size *= 1024;
                    index_of_unit -= 1;
                }

                coverted_size = size;
            }

            return coverted_size;
        };
    }());
	});
	tinyMCE.init({
		inline_styles : true,
		mode : "specific_textareas",
		theme : "advanced",
		editor_selector : "tinymce",
		plugins : "pagebreak,style,layer,table,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,autosave",
         
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline" ,
		theme_advanced_buttons2 : "code",
		theme_advanced_buttons3 : false,
		theme_advanced_buttons2 : "code",
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
</script>
<!----------------------______End Upload Button Script------------------>


<script type="text/javascript">
	$(document).ready(function()
	{
		$('.makeDiscount').live('input',function()
		{
			$('.realDiscount').val('');
			var vals;
			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
			$('.makeDiscount').each(function()
			{
				vals = $(this).val();
				//alert(vals)
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
					discountFun();
				}
				else 
				return false;
			})
			function discountFun()
			{
				$('#discount_price1').val(); 
				price = $('input[name="data2[0][DealOption][selling_price]"]').val(); 
				dis = $('input[name="data2[0][DealOption][discount_selling_price]"]').val(); 
				if(price != "" && dis !="")
				{
					real = (price - dis);
					if(real > 0)
					{
						var real1 = Math.floor(real);
						$('#discount1').val(real1);
					}
					else
					{
						$('#discount1').val('');
					}
				}
				else
				{
					$('#discount1').val('');
				}
			}   
		})
		$('.makeDiscount1').live('input',function()
		{
			$('.realDiscount').val('');
			var vals;
			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
			$('.makeDiscount1').each(function()
			{
			   vals = $(this).val();
			   if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
			   {
				 discountFun2();
			   }
			   else 
				 return false;
			})
			function discountFun2()
			{
				$('#discount_price2').val(); 
				price = $('input[name="data2[1][DealOption][selling_price]"]').val(); 
				dis = $('input[name="data2[1][DealOption][discount_selling_price]"]').val(); 
				if(price != "" && dis !="")
				{
					real = (price - dis);
					if(real > 0)
					{
						var real1 = Math.floor(real);
						$('#discount2').val(real1);
					}
					else
					{
						$('#discount2').val('');
					}
				}
				else
				{
					$('#discount2').val('');
				}
			}   
		})	
		$('.makeDiscount2').live('input',function(){
		$('.realDiscount').val('');
		var vals;
		var intRegex = /^\d+$/;
		var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
		$('.makeDiscount2').each(function()
		{
		   vals = $(this).val();
		   if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
		   {
		     discountFun3();
		   }
		   else 
		   return false;
		})
		function discountFun3()
		{
			$('#discount_price3').val(); 
			price = $('input[name="data2[2][DealOption][selling_price]"]').val(); 
			dis = $('input[name="data2[2][DealOption][discount_selling_price]"]').val(); 
			if(price != "" && dis !="")
			{
				real = (price - dis);
				if(real > 0)
				{
					var real1 = Math.floor(real);
					$('#discount3').val(real1);
				}
				else
				{
					$('#discount3').val('');
				}
			}
			else
				{
					$('#discount3').val('');
				}
		}	
	})	
    var deal_id=$('#deal_id').val();
    $('#frm').validate({
			rules:
			{
				"data[Deal][name]": 
				{
					remote: ajax_url+'deals/unique_deal/'+deal_id
				}, 
				"data[Deal][category]": 
				{
					remote: ajax_url+'deals/parent_category'
				},
				"deal_image[]":
				{
					maxFileSize: 
					{
						"unit": "KB",
						"size": 100
					}
				}
			},
			messages:
			{
				"data[Deal][name]":
				{
					remote:'Deal name already exists.'
				},
				"data[Deal][category]":
				{
	        		remote:'Please select any subcategory.'
	     		}			
			}		
		});	
	});	
	$(function() 
	{
		var year = (new Date()).getFullYear()
		var current_date= new Date();
		$( ".buy_from" ).datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			//maxDate:current_date,
			onClose:function(selectedDate){
				$( ".buy_to" ).datepicker("option",{minDate:selectedDate});
				$( ".redeem_from" ).datepicker("option",{minDate:selectedDate});
			}
		});
	})
	$(function() 
	{
		var year = (new Date()).getFullYear() + 5;
		var current_date= new Date();
		$( ".buy_to" ).datepicker(
		{
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			//minDate:current_date,
			onClose:function(selectedDate)
			{
				$( ".buy_from" ).datepicker("option",{maxDate:selectedDate});
			}
		});
	});	
	$(function() 
	{
		var year = (new Date()).getFullYear()
		var current_date= new Date();
		$( ".redeem_from" ).datepicker(
		{
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			onClose:function(selectedDate){
				$( ".redeem_to" ).datepicker("option",{minDate:selectedDate});
			}
		});
	})
	$(function() 
	{
		var year = (new Date()).getFullYear() + 5;
		var current_date= new Date();
		$( ".redeem_to" ).datepicker(
		{
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			//minDate:current_date
			//maxDate:current_date
		});
	});
	$(function() {
		var year = (new Date()).getFullYear() + 5;
		var current_date= new Date();
		$( ".newsletter_date" ).datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			minDate:current_date
			//maxDate:current_date
		});
	});
</script>	
	<script type="text/javascript" >
	$(document).ready(function(){
    /*var d= new Date();
    var day = d.getDate();
    var day2 = d.getDate()+1;
    var month = d.getMonth()+1;
    var year = d.getFullYear();
    var current_date=year+'/'+month+'/'+day;
	 $('.startdate').focus(function(){
		  var opt = $(this).attr('rel');
    if($(':input[name="data[Deal]['+opt+'_to]"]').val()!='')
		{
			var ens = $(':input[namElecticale="data[Deal]['+opt+'_to]"]').val().split(' ');
			var en = ens[0].split('-');
			var end_date = en[0]+'/'+en[1]+'/'+(parseInt(en[2])-1);
			$('.startdate').datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			scrollInput:false,
			maxDate:end_date,
			minDate:current_date
			})
		}
		else
		{
			$('.startdate').datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			scrollInput:false,
			minDate:current_date
			
		})
	}
});
	
	
	$('.enddate').focus(function(){
     var opt = $(this).attr('rel');
		 if($(':input[name="data[Deal]['+opt+'_from]"]').val()!='')
		{
			var ens = $(':input[name="data[Deal]['+opt+'_from]"]').val().split(' ');
			var en = ens[0].split('-');
			var start_date = en[0]+'/'+en[1]+'/'+(parseInt(en[2])+1);
			$('.enddate').datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			scrollInput:false,
			minDate:start_date,
			//maxDate:current_date
			
		})		
		}
		else
			{
		  $('.enddate').datetimepicker({
			timepicker:false,
			format:'Y-m-d',
			scrollInput:false,
			minDate:year+'/'+month+'/'+day2
			
			})		
			}
			
	});*/

});
</script>
<script>
/*********************Multiple Image Upload Coded By Shivam Chauhan *********************/
$(function(){

	var abc = 'valid';
	$('#edit_submit_btn').live('click',function(){
		var cnt = $("input[name='main_image']:checked").length;
			if(abc == 'invalid'){
				alert('Please Select only six images');
				$('#edit_uploadFile').val('');
				return false;
			}
			else if (cnt < 1) 
			{
				alert('Select at least 1 Image to make primary');
				$('#edit_uploadFile').val('');
				return false;
			}
	});

$("#edit_uploadFile").live("change", function(){
        var files = !!this.files ? this.files : [];
		var $i, file,arr=[];
        if (!files.length || !window.FileReader) return; 
		$('.imagePreview').remove();
	   var numfiles = files.length;
	   var avail = $("#availImages").val();
		avail = avail*1;
		if(numfiles > 6){
			alert('Please Select only six images');
			$('#edit_uploadFile').val('');
			abc = 'invalid';
			return false;
		}
		else if((numfiles+avail) > 6) {
				alert('Please Select total six images');
				$('#edit_uploadFile').val('');
				abc = 'invalid';
				return false;
		}else {
		   abc = 'valid';
		   for($i=0;$i<files.length;)
		   {
			if (/^image/.test( files[$i].type))
			{ 		
					file = files[$i];
					arr.push(file.name);
					var reader = new FileReader(); 
					reader.readAsDataURL(files[$i]); 
					reader.onloadend = function(e)
					{   
						showUploadedItems(e, arr);
					
					};
				
					$i++;
			}
		   }
		}
		clearIteration();
	});
	   
	   function clearIteration() { $i=0; }

		$i = 0;
	   	function showUploadedItems (source,arr) {
				var d = new Date();
				var n = d.getTime(); 
				var image ='<div class="imagePreview"><img src="'+source.target.result+'" value = "'+arr[$i]+'"/> <a class="file_close" id = "edit_del_link" href="javascript:void(0)"><img src="<?php echo HTTP_ROOT;?>img/file_close.png" /></a> <input type="hidden" value="'+n+'_'+$i+'" name ="hidden_img['+$i+']" /><input type="checkbox" class = "checkbox_list" name = "main_image" value= "'+n+'_'+$i+arr[$i]+'"/> </div>';
				$('#edit_uploadedImages').append(image);
				$i += 1;
			}
    });
	$('.checkbox_list').live("click",".checkbox_list",function(){
		var checkedState = $(this).prop('checked');	
		$('.checkbox_list').each(function () {	
			$(this).prop('checked', false);			
		});			
		$(this).prop('checked', checkedState);
		if($(this).is(':checked'))			{
			$('.modal-wrapper').show(function(){
			$('.modal-wrapper').click(function(){
				$('.modal-wrapper').hide(function(){			
					$('body').css("overflow","auto1");
				});
			})
		
			});
                        //console.log($(this).parents('.imagepreview').children('img').attr('src')); 
                        //return false; 
			$imgSrc = $(this).parents('.imagepreview').children('img').attr('src');
			 
			$('.modal').children('img')
				.css({'height':'462px','margin':'auto','width':'690px'})
				.attr('src',$imgSrc);
			
			$('.close').click(function(){
				$('.modal-wrapper').hide(function(){
			
			$('body').css("overflow","auto1");
			});
			})
		}			
	});
	$('#edit_del_link').live('click',function(){
			var parent = $(this).parent();
			parent.remove();
		});
		
	$('.del_link').live('click',function(){

			var img_id=$(this).attr('rel');
			var deal_id = $('.edit_deal_id').val();
			if(img_id!='' && deal_id!='') {
				if (confirm('Are you sure you want to delete this image ?')) {
					
					$.ajax({
						type:'post',
						url:ajax_url+'/Manages/deleteDealImage/'+deal_id+'/'+img_id,
						success:function(resp)
						{
							$('#render_data').html(resp);
						}
					});
				}
			}else {
				alert("An error occured!");
			}
		});
		
	$('#delete_all').live('click',function(){
		var deal_id = $('.edit_deal_id').val();
		var image_idz = new Array();
		$(".del_link").each(function() {
		   image_idz.push($(this).attr('rel'));
		});
		if(image_idz!='' && deal_id!='') {
			if (confirm('Are you sure you want to delete all images ?')) {
						
				$.ajax({
					type:'post',
					data:{deal_id:deal_id,image_idz:image_idz},
					url:ajax_url+'/Manages/deleteAllDealImage',
					success:function(resp)
					{
						$('#render_data').html(resp);
					}
				});
			}
		}else {
			   alert("An error occured!");
			}
		
	});
</script>


<script>
function isNumericKey(e)
{
    if (window.event) 
	{
		var charCode = window.event.keyCode; 
	}
    else if (e) 
	{ 
		var charCode = e.which; 
	}
    else 
	{ 
		return true; 
	}
    if (charCode > 31 && (charCode < 48 || charCode > 57)) 
	{ 
		return false; 
	}
    return true;
}
</script>

<style>
.content-box-wrapper div {
    clear: none;
    float: left;
    min-width: 200px;
	position:relative;
}
.form-group.imagepreview > img {
    width: 175px;
	height: 175px;
}
#render_data {
    float: left;
    margin: 10px 0;
    width: 100%;
}
.file_close.del_link {
    position: absolute;
    right: 13px;
    top: -8px;
}

.file_close {
    position: absolute;
    right: 13px;
    top: -7px;
}
.status_label
{
	 float: right;
	 margin-right: 20px;
	 padding:4px;
}
select.full
{
padding:4px;
}
.imagePreview > img {
    height: 175px;
    width: 175px;
}
.content-box-wrapper div {
    clear: none;
    float: left;
    min-width: 200px;
    position: relative;
}
.full_width {
width:100%
}

.dlt_all
{
	float: right;
	width: auto;
}
.modal{
	background: none repeat scroll 0 0 #fff;
   border-radius: 10px;
   box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
   height: auto !important;
   left: 20%;
   margin: 55px 0px;
   padding: 15px;
   position: relative;
   text-align: center;
   width: 750px;
   z-index: 10000;	
}
.modal img{
    height: 470px !important;
    width: 720px;
	 margin-bottom:20px!important;
	 }
.modal h1{
    margin-bottom:15px;
	 font-size:20px;
}

.modal-wrapper{
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3);
    display: none;
    height: 100%;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 9999;
	 overflow:auto;
}

a.close {
    position: relative;
	float:right;
	right: 10px;
    top: 10px;

}
.close > span{
		 font-size:20px;
	 cursor:pointer;
}
</style>
<div class="modal-wrapper">
<div class="modal">
<a class="close" ><span aria-hidden="true">&times;</span></a>
<h1>This is the main image that show on deals detail page.</h1>
<h5 style="margin-bottom:15px;">To see a full size version of this image and determine whether its quality will be acceptable once live on the website for your customers, tick this check box. If the full sized image is blurry or pixelated, then you know that is needs to be replaced by another image that looks better. We recommend all images should be between 40-80 KB in size and approximately 680 x 460 pixels. These are guidelines and are not the same with all images as their shapes and quality differ. If in doubt, we advise testing via this feature until you get the look you desire with each of the images you wish to use. For help with re-sizing images, see your "Welcome Pack" which is accessible via the link at the top of your login page.</h5>
<img src="">
</div>
</div>
<div id="page-layout">
<div id="page-content">
<div id="page-content-wrapper">
<a href="<?php echo HTTP_ROOT;?>admin/manages/deals" class="ui-state-default ui-corner-all float-right ui-button">Back</a>
<div class="inner-page-title">
<h2>Edit Deal</h2>
<span></span>
</div>
<?php //if($member['MemberType']['name']=='customer') {?>
<form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/Manages/editDeal/'.base64_encode(convert_uuencode($member['Deal']['id']))?>">
	<fieldset>
	<input type='hidden' name='supplier_id' value="<?php echo $member['Deal']['member_id']; ?>" id='supplier_id' /> 
   	<div class="content-box content-box-header" style="border:none;">
	
			<div class="column-content-box">   
            <div class="ui-state-default ui-corner-top ui-box-header">
                <span class="ui-icon float-left ui-icon-notice"></span>
	                Edit Deal's Information
            </div>
            <div class="content-box-wrapper">
               <input id="deal_id"  class = "edit_deal_id" name="data[Deal][id]" type="hidden" value="<?php echo $member['Deal']['id'];?>" />
			   <input id="Memberid" type="hidden" value="<?php echo $member['Deal']['id'];?>" />
               <ul>
               	  <li>
                  	<label class="desc">Deal Title:<em>*</em></label>
						<div class ="full_width">
							<input  class="field text full required" name="data[Deal][name]" type="text" value='<?php echo $member["Deal"]["name"];?>'/>
						</div>
                  </li>
                  
                  <li>
                   	<label class="desc">Image:<em>*</em></label>
                   	<div style="width:100%;float:left;">
						<input id="edit_uploadFile" type="file" name="deal_image[]"  multiple="multiple">
						<?php if(!empty($member['DealImage'])) :?>
							<input type="button" id = "delete_all" class="dlt_all submit sub-bttn" value="Delete All">
						<?php endif;?>
					</div>
					<?php if(!empty($member['DealImage'])) :?>
						<div  id ="render_data">
							<?php $i= 0;
							foreach ($member['DealImage'] as $image):?>
								<div class="form-group imagepreview">
									<img  src="<?php echo IMPATH.'deals/'.$image['image_name'];?>" height="200" width="200"/>
									<a class="file_close del_link" href="javascript:void(0)" rel ="<?php echo $image['id'];?>"><img src="<?php echo HTTP_ROOT;?>img/file_close.png" /></a>
									<input type="checkbox" class = "checkbox_list" name = "main_image" value = "<?php echo $image['image_random']?>"<?php if($image['image_type']=='M'):?>checked <?php endif;?>/>
								</div>
								
							<?php $i++;endforeach;?>
							
							<div id="edit_uploadedImages">
							
							</div>
							<input type="hidden" id="availImages" value=" <?php echo $i; ?>">
						</div>
					<?php elseif(!empty($member['Deal']['image'])) :?>
						<div style="width:50%;margin-left:114px;">
							<img  src="<?php echo IMPATH.'deals/'.$member['Deal']['image'];?>" height="200" width="200"/>
						</div>
						<div id="edit_uploadedImages">
						</div>
					<?php else : ?>
						<div style="width:50%;margin-left:114px;">
							<img  src="<?php echo IMPATH.'deals/'.$member['Deal']['image'];?>" height="200" width="200"/>
						</div>
						<div id="edit_uploadedImages">
						</div>
					
					<?php endif;?>	
					
						
                  </li>
                 	<li>
                    <label class="desc">Buying From:<em>*</em></label>
						<div class ="full_width">
						  <input class="field text full required startdate buy_from" rel="buy"   name="data[Deal][buy_from]"  type="text" value="<?php echo date('d M Y',strtotime($member['Deal']['buy_from']));?>"/>
						</div>
                  </li>
                  <li>
                    <label class="desc">Buying To:<em>*</em></label>
						<div class ="full_width">
						  <input class="field text full required enddate buy_to" rel="buy"   name="data[Deal][buy_to]"  type="text" value="<?php echo date('d M Y',strtotime($member['Deal']['buy_to']));?>"/>
						</div>
                  </li>
						<li>
                    <label class="desc">Redeeming From:<em>*</em></label>
						<div class ="full_width">
						  <input  class="field text full required redeem_from startdate" rel="redeem" readonly="readonly" name="data[Deal][redeem_from]"  type="text" value="<?php echo date('d M Y',strtotime($member['Deal']['redeem_from']));?>"/>
						</div>
                  </li>
                  <li>
                    <label class="desc">Redeeming To:<em>*</em></label>
						<div class ="full_width">
						  <input  class="field text full required redeem_to enddate" rel="redeem" readonly="readonly" name="data[Deal][redeem_to]"  type="text" value="<?php echo date('d M Y',strtotime($member['Deal']['redeem_to']));?>"/>
						</div>
                  </li>	
                  <li>		  
              		<label class="desc">Deal's Category<em>*</em></label>
						<div class="inp_holder full_width">
						<!--<select name="data[Deal][category]" class="field text full required" >-->
						<select name="data[Deal][category]" class="field text full required" >						
							<option value="">Select Category</option>
                  	<?php 
                  	foreach ($deal_category as $cat_id=>$cat_name)
                  	{
                  		if(in_array($cat_id,$parent_catog_id))
								{
                  	?>
									<option value="0"><?php echo $cat_name; ?></option>
							  <?php
							   }
								else
								{ 
								?>
								     <option value="<?php echo $cat_id;?>" <?php if($member['Deal']['category'] == $cat_id) echo 'selected="selected"';?> >
									     <?php echo $cat_name; ?>
									  </option>
								<?php
								 } 
							 } 
							 ?>
						</select>
						</div>
						</li>
						<li>
						<li>		  
							<label class="desc">Price includes shipping<em>*</em></label>
							<div class ="full_width">
							<select name="data[Deal][shipping_price]" class="field text full required">
								<option value="">Select</option>
								<option <?php if($member['Deal']['shipping_price'] =='Yes') echo 'selected="selected"';?> value="Yes">Yes</option>
								<option <?php if($member['Deal']['shipping_price'] =='No') echo 'selected="selected"';?> value="No">No</option>												
							</select>
							</div>
						</li>
                  	<label class="desc">Delivery Option:<em>*</em></label>
            			<div class ="full_width">
							<select name="data[Deal][delivery_option]" class="field text full required" >						
								<option value="">Select Category</option>
								<option value="physical" <?php if($member['Deal']['delivery_option'] =='physical') echo 'selected="selected"';?> > This is a physical product that requires delivery and the discounted selling price includes nationwide door-to-door delivery by courier.</option>
								<option value="physical-not-delivery" <?php if($member['Deal']['delivery_option'] =='physical-not-delivery') echo 'selected="selected"';?> > This is a physical product that requires delivery and the discounted selling price does NOT include nationwide door-to-door delivery by courier.</option>
								<option value="non-physical" <?php if($member['Deal']['delivery_option'] =='non-physical') echo 'selected="selected"';?>>This is not a physical product and does not require delivery, and the customer will use the service via receiving a voucher only.</option>								
							</select>
            			</div>
                  </li>
						<li>
                  	<label class="desc">Maximum number of vouchers that can be sold for this deal:<em>*</em></label>
            			<div class ="full_width">
            				<input  class="field text full required" name="data[Deal][quantity]" type="text" value="<?php echo $member['Deal']['quantity'];?>"/>
            			</div>
                  </li>
						 <!--<<label class="desc">Nearest Location<em>*</em></label>
							div class="inp_holder">
								<select name="data[Member][location]" class="field text full required" >
									<option value="">Select Location</option>
                      <?php foreach ($options as $option){ ?>
										<option value="<?php echo $option['Location']['id'];?>" <?php if($member['Member']['location'] == $option['Location']['id']) echo 'selected="selected"';?>>
											<?php echo $option['Location']['name']; ?>
									</option>
						
									<?php } ?>
								</select>
								
							</div>-->
						<li>
						<label class="desc">Deal Location<em>*</em></label>
						<div class ="full_width">
								<!--<p>
								<input class="all_location all_loactionx" type="checkbox" /><span>Select All</span>
								</p>-->
								
                         <?php
									/* change multiple location */
                           /*$location_checked='';
									foreach ($nearest_location as $loc)
									{
									$multiple_loc=explode(',',$member['Deal']['location']);
									
                            if(in_array($loc['Location']['id'],$multiple_loc))
                            {                            
	                             $location_checked=1;
									 }
									?>
									<p class="locationx_padding">
									<input class="each_location each_loactionx" type="checkbox" name="data[Deal][location][]" value="<?php echo $loc['Location']['id']; ?>" <?php if(in_array($loc['Location']['id'],$multiple_loc)) echo 'checked="checked"';?> />
									<span><?php echo $loc['Location']['name']; ?></span>
									</p>
								<?php
								 } */
								?>
							<select name="data[Deal][location][]" class="field text full required ">
								<option value="">Select Location</option>
					                <?php 
					                foreach ($nearest_location as $option)
					                { 
					                ?>
										  	<option value="<?php echo $option['Location']['id'];?>" <?php if($member['Deal']['location'] == $option['Location']['id']) echo 'selected="selected"';?> >
											 <?php echo $option['Location']['name']; ?>
										  	</option>
								       <?php
					                } 
					                ?>
							</select>	
							
						</div>
						<!--  <input type="hidden" class="location_hidn required" value="<?php if($location_checked==1){echo '1';}?>" />-->
						</li>
				   	<li>
                  	<label class="desc">Regular Selling Price:<em>*</em></label>
							<div class ="full_width">
						   	<input  class="field text full required number makeDiscount" name="data2[0][DealOption][selling_price]" type="text" value="<?php echo $member['DealOption'][0]['selling_price'];?>"/>
							</div>
					</li>
                    <!--<li>
                    <label class="desc">Discount option title 1:<em>*</em></label>
                    	<div>
                     	<input  class="field text full " value="<?php //echo $member['DealOption'][0]['option_title'];?>" name="data2[0][DealOption][option_title]">
                    </div>
                   </li> --> 
                    
				<li>
                  	<label class="desc">Discounted Selling Price* <em>*</em></label>
                    	<div class ="full_width">
                     	<input id="discount_price1" maxlength="16" class="field text full required number makeDiscount" name="data2[0][DealOption][discount_selling_price]" type="text" value="<?php echo $member['DealOption'][0]['discount_selling_price'];?>"/>
                    	</div>
                  </li>
						<li>
                  	<label class="desc">Discount Offered:<em>*</em></label>
                    	<div class ="full_width">
                      <input type="hidden" value="<?php echo $member['DealOption'][0]['id'];?>" name="data2[0][DealOption][id]">
                     	<input readonly="readonly" id="discount1" class="field text full required number "  value="<?php echo round($member['DealOption'][0]['discount']);?>" name="data2[0][DealOption][discount]">
                   </div>
                  </li> 
                <h3>Deal Discount Option</h3>
                 <div class ="full_width">
                   <li>
						  
                    <label class="desc">Discount option title 2:</label>
                    	<div class ="full_width">
                     	<input  class="field text full" value="<?php echo @$member['DealOption'][1]['option_title'];?>" name="data2[1][DealOption][option_title]">
								<input  type="hidden" value="<?php echo @$member['Deal']['id'];?>" name="data2[1][DealOption][deal_id]">
                     </div>
                   </li> 
					
					<li>
                    <label class="desc">Discount option Selling Price 2:</label>
                    	<div class ="full_width">
                     	<input  class="field text full makeDiscount1" value="<?php echo @$member['DealOption'][1]['selling_price'];?>" name="data2[1][DealOption][selling_price]">
                     	
                     </div>
                   </li> 
					
                     
				  	     	<li>
                  	<label class="desc">Discounted Selling Price 2</label>
                    	<div class ="full_width">
                     	<input id="discount_price2"  maxlength="16" class="field text full number makeDiscount1" name="data2[1][DealOption][discount_selling_price]" type="text" value="<?php echo @$member['DealOption'][1]['discount_selling_price'];?>"/>
                    	</div>
                  </li>
						<li>
                    <label class="desc">Discount Offered 2:</label>
                    	<div class ="full_width">
                       <input type="hidden" value="<?php echo @$member['DealOption'][1]['id'];?>" name="data2[1][DealOption][id]">
                     	<input id="discount2" readonly="readonly" class="field text full number " value="<?php echo @$member['DealOption'][1]['discount'];?>" name="data2[1][DealOption][discount]">
                     </div>
                   </li> 
                  <li>
                    <label class="desc">Discount option title 3:</label>
                    	<div class ="full_width">
                     	<input  class="field text full " value="<?php echo @$member['DealOption'][2]['option_title'];?>" name="data2[2][DealOption][option_title]">
                     </div>
                   </li>

					<li>
                    <label class="desc">Discount option Selling Price 3:</label>
                    	<div class ="full_width">
                     	<input  class="field text full makeDiscount2" value="<?php echo @$member['DealOption'][2]['selling_price'];?>" name="data2[2][DealOption][selling_price]">
								<input  type="hidden" value="<?php echo @$member['Deal']['id'];?>" name="data2[2][DealOption][deal_id]">
                     </div>
                   </li>
                     
				  	     	     <li>
                  	<label class="desc">Discounted Selling Price 3</label>
                    	<div class ="full_width">
                     	<input id="discount_price3" maxlength="16" class="field text full number makeDiscount2" name="data2[2][DealOption][discount_selling_price]" type="text" value="<?php echo @$member['DealOption'][2]['discount_selling_price'];?>"/>
                    	</div>
              </li>
				  <li>
                     <label class="desc">Discount Offered 3:</label>
                    	<div class ="full_width">
                      <input type="hidden" value="<?php echo @$member['DealOption'][2]['id'];?>" name="data2[2][DealOption][id]">
                     	<input id="discount3" readonly="readonly" class="field text full number " value="<?php echo @$member['DealOption'][2]['discount'];?>" name="data2[2][DealOption][discount]">
                     </div>
                   </li> 
              </div>
                    <li>
                    <label class="desc">Description:</label>
                    <div class ="full_width">
                    		<textarea  class="field text full required tinymce" name="data[Deal][description]" rows="8"><?php echo str_replace('<br />',"\n",$member['Deal']['description']);?></textarea>
                    </div>
                  </li>
                  <li>
                  	 <label class="desc">Fine Print:</label>
                     <div class ="full_width">
                     	  <textarea  class="field text full required" name="data[Deal][highlights]" rows="8"><?php echo @$member['Deal']['highlights'];?></textarea>
                     </div>
                  </li>
                  <li>
                  	 <label class="desc">Preferred Newsletter Date:</label>
                     <div class ="full_width">
                     	  <input type="text"  class="field text full newsletter_date" name="data[Deal][newsletter_sent_date]" value="<?php echo date('d M Y',strtotime($member['Deal']['newsletter_sent_date']));?>">
                     </div>
                  </li>   
					<li>
                  	 <label style="color: #222;font-size: 95%;font-weight: bold;margin-right:15px;">Allow Credit Card Sales:</label>
					 <input type="checkbox" name="data[Deal][modePayment]" <?php if(@trim($member['Deal']['modePayment']) == 'All') { ?> Checked="true" <?php }  ?>>
					</li> 
					</ul>
				</div> <!-- end of content box wrapper -->
			</div>
		</div>  
      <li>
      	<input id = "edit_submit_btn" class="submit sub-bttn"  type="submit" value="Submit"/>
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
<script type="text/javascript" >
$(document).ready(function(){
   $('.each_location').click(function()
	{
		$('.each_location').each(function(index){
			if($(this).is(':checked'))
			{
				$('.location_hidn').val(1);
				return false;
			}
			else
			{
				$('.location_hidn').val('');
			}
			
		});
	});
})

</script>
