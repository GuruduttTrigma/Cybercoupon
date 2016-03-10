<script>
	$(document).ready(function(){
		var deal_id = $('.edit_deal_id').val();
 		$('#editDealForm').validate({
 			ignore: [],
	   	rules: {
		     	"data[Deal][name]": {
		       	remote: {
		        	    url: ajax_url+'deals/unique_deal/'+deal_id
		        	}
		     	},
		     	"data[Deal][category]": {
		     		remote: {
		        	    url: ajax_url+'deals/parent_category'
		        	}
		     	},    
		     	"data2[DealOption][selling_price]": {
		        //cus_no:true
		     	},
		     	"data2[Deal][discount]": {
		      	//cus_no:true,
		        	//range: [0, 100]
		     	},
		     	"data[Deal][delivery_option]": {
		     		required:true,
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
	   	messages: {
	   		"data[Deal][name]": {
	        		remote:'This deal name already exist'
	     		},
            "data[Deal][category]": {
	        		remote:'Please select any subcategory.'
	     		},
	     		"data2[Deal][selling_price]": {
	        		required:'required'
	     		},
	     		"data2[Deal][discount]": {
	        		required:'required'
	     		},
	     		"data[Deal][delivery_option]": {
		     			required:'Please select one of these options',
		     	}
	     	}
	});
	
   $('.option1').each(function(){
        if($(this).is(':checked'))
        {
				$(this).siblings('div.optional_field').slideDown();
               $(this).siblings('div.optional_field').find('input').addClass('required');
               
               $(this).parent('div').next('div').children('div.optional_field').slideDown();
               $(this).parent('div').next('div').children('div.optional_field').find('input').addClass('required');
               
               $(this).parent('div').next('div').next('div').children('div.optional_field').slideDown();
               $(this).parent('div').next('div').next('div').children('div.optional_field').find('input').addClass('required');             	
            	
			   $(this).parent('div').next('div').next('div').next('div').children('div.optional_field').slideDown();
               $(this).parent('div').next('div').next('div').next('div').children('div.optional_field').find('input').addClass('required');   			   

        }
		  else
        {
				$(this).siblings('div.optional_field').slideUp();
               $(this).siblings('div.optional_field').find('input').removeClass('required');
               
               $(this).parent('div').next('div').children('div.optional_field').slideUp();
               $(this).parent('div').next('div').children('div.optional_field').find('input').removeClass('required');
               
               $(this).parent('div').next('div').next('div').children('div.optional_field').slideUp();
               $(this).parent('div').next('div').next('div').children('div.optional_field').find('input').removeClass('required');             	
            	
			   $(this).parent('div').next('div').next('div').next('div').children('div.optional_field').slideUp();
               $(this).parent('div').next('div').next('div').next('div').children('div.optional_field').find('input').removeClass('required');   			   

        }
    	
    })	
	
	$('.cancel_editing_deal').click(function(){
		$('.hide_div_block_deal').show(500);
		$('.edit_field_div1_deal').show(500);
		$('.show_right_div_deal ').hide();
	});
	
});
</script>

<script>
$(document).ready(function(){
		var d= new Date();
    	var day = d.getDate();
    	var day2 = d.getDate()+1;
    	var month = d.getMonth()+1;
		var year = d.getFullYear();
    	//var current_date=year+'/'+month+'/'+day;
    	var current_date=day+" "+month+" "+year;	
	$('.mselect').multiselect({
		includeSelectAllOption: false
   });	
   $('.newsletterdate').datetimepicker({
		timepicker:false,
		format:'d M Y',
		scrollInput:false,
		minDate:current_date						
	});
		
});
</script>
<script type="text/javascript" >
$(document).ready(function(){
   	var d= new Date();
    	var day = d.getDate();
    	var day2 = d.getDate()+1;
    	var month = d.getMonth()+1;
   	var year = d.getFullYear();
    	//var current_date=year+'/'+month+'/'+day;
    	var current_date=day+" "+month+" "+year;
			
			$('.startdate_buy').datetimepicker({
				timepicker:false,
				format:'d M Y',
				scrollInput:false,
				//minDate:current_date,
				onSelectDate:function(selectedDate){ 
				   
				   $(':input[name="data[Deal][redeem_to]"]').val('');
	     			$(':input[name="data[Deal][redeem_from]"]').val('');
	     			 
					$('.enddate_buy').datetimepicker({
						timepicker:false,
						format:'d M Y',
						scrollInput:false,
						minDate:selectedDate
				   });
				   $('.startdate_redeem').datetimepicker({
						timepicker:false,
						format:'d M Y',
						scrollInput:false,
						minDate:selectedDate
				   })	
					
				   //$('.enddate_buy').datetimepicker("option", { minDate: $(".startdate_buy").datetimepicker('getDate')})
				   
				
				}
			});
  	 	
	
			$('.enddate_buy').datetimepicker({
				timepicker:false,
				format:'d M Y',
				scrollInput:false,
				onSelectDate:function(selectedDate){ 
				   
	     			var buy_from=$(':input[name="data[Deal][buy_from]"]').val();
	     			if(buy_from!='')
	     				var start_redeem_min=new Date(buy_from);
				   else
				   	var start_redeem_min=current_date;
				   	
				   
				   $('.startdate_redeem').datetimepicker({
						timepicker:false,
						format:'d M Y',
						scrollInput:false,
						minDate:start_redeem_min
				   })
				   
				  var startdate_redeem=$(':input[name="data[Deal][redeem_from]"]').val();
				  var enddate_buy=selectedDate;
				   
              if(enddate_buy!='' && startdate_redeem!='')
              {
              	   var enddate_buy=new Date(enddate_buy);
              	   var startdate_redeem=new Date(startdate_redeem);
              	
              	   if(Date.parse(enddate_buy) > Date.parse(startdate_redeem)) 
					   {
							var min_redeem_to = enddate_buy;
						}
						else
						{
							var min_redeem_to = startdate_redeem;
						}
						
						$('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'d M Y',
							scrollInput:false,
							minDate:min_redeem_to
					   })	
              }
              else if(enddate_buy!='')
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'d M Y',
							scrollInput:false,
							minDate:enddate_buy
					   })
              }				   
				  else if(startdate_redeem!='')
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'d M Y',
							scrollInput:false,
							minDate:startdate_redeem
					   })
              }
				   
				   	
				   
				
				}       
			});		
		
	     $('.startdate_redeem').datetimepicker({
				timepicker:false,
				format:'d M Y',
				scrollInput:false,
				onSelectDate:function(selectedDate){ 


              var startdate_redeem=selectedDate;
				  var enddate_buy=$(':input[name="data[Deal][buy_to]"]').val();
				   
              if(enddate_buy!='' && startdate_redeem!='')
              {
              	   var enddate_buy=new Date(enddate_buy);
              	   var startdate_redeem=new Date(startdate_redeem);
              	
              	   if(Date.parse(enddate_buy) > Date.parse(startdate_redeem)) 
					   {
							var min_redeem_to = enddate_buy;
						}
						else
						{
							var min_redeem_to = startdate_redeem;
						}
						
						$('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'d M Y',
							scrollInput:false,
							minDate:min_redeem_to
					   })	
              }
              else if(enddate_buy!='')
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'d M Y',
							scrollInput:false,
							minDate:enddate_buy
					   })
              }				   
				  else if(startdate_redeem!='')
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'d M Y',
							scrollInput:false,
							minDate:startdate_redeem
					   })
              }
              else
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'d M Y',
							scrollInput:false,
							minDate:current_date
					   })
              	
              } 
				
				}
			});
  	 	
	
			$('.enddate_redeem').datetimepicker({
				timepicker:false,
				format:'d M Y',
				scrollInput:false,
				onSelectDate:function(selectedDate){ 
				
				}       
			});
	/* ------------------------------------------ Selling price on New Deal Start -----------------------------------------------------------------  */
			
		 
		$(document).on('input','#edit_deal_selling_price',function(){
			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			$('#edit_deal_makeDiscount').each(function(){
				price = $('#edit_deal_selling_price').val(); 
				vals = $('#edit_deal_makeDiscount').val(); 
		      //console.debug(price); return false;
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
					if(price != "" && vals !="")
					{
						real = (price - vals);
						if(real >= 0)
						{
							var real1 = Math.floor(real);
							$('#edit_deal_discount1').val(real1);
						}
						else
						{
							$('#edit_deal_discount1').val('');
						}
					}
					else
					{
						$('#edit_deal_discount1').val('');
					}
				}
				else
				{ 
				   $('#edit_deal_discount1').val('');
				}
			})
     })
     
     $(document).on('input','#edit_deal_makeDiscount,#edit_deal_selling_price',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
	  			price = $('#edit_deal_selling_price').val(); 
				vals = $('#edit_deal_makeDiscount').val(); 
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
					if(price != "" && vals !="")
					{
						real = (price - vals);
						if(real >= 0)
						{
							var real1 = Math.floor(real);
							$('#edit_deal_discount1').val(real1);
						}
						else
						{
							$('#edit_deal_discount1').val('');
						}
					}
					else
					{
						$('#edit_deal_discount1').val('');
					}
				}
				else
				{ 
				   $('#edit_deal_discount1').val('');
				}
			
      })	 
		$(document).on('input','#edit_deal_selling_price2',function(){
			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			$('#edit_deal_makeDiscount2').each(function(){
				price = $('#edit_deal_selling_price2').val(); 
				vals = $('#edit_deal_makeDiscount2').val(); 
		      //console.debug(price); return false;
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
					if(price != "" && vals !="")
					{
						real = (price - vals);
						if(real >= 0)
						{
							var real1 = Math.floor(real);
							$('#edit_deal_discount2').val(real1);
						}
						else
						{
							$('#edit_deal_discount2').val('');
						}
					}
					else
					{
						$('#edit_deal_discount2').val('');
					}
				}
				else
				{ 
				   $('#edit_deal_discount2').val('');
				}
			})
     })
     
     $(document).on('input','#edit_deal_makeDiscount2,#edit_deal_selling_price2',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
	  			price = $('#edit_deal_selling_price2').val(); 
				vals = $('#edit_deal_makeDiscount2').val(); 
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
					if(price != "" && vals !="")
					{
						real = (price - vals);
						if(real >= 0)
						{
							var real1 = Math.floor(real);
							$('#edit_deal_discount2').val(real1);
						}
						else
						{
							$('#edit_deal_discount2').val('');
						}
					}
					else
					{
						$('#edit_deal_discount2').val('');
					}
				}
				else
				{ 
				   $('#edit_deal_discount2').val('');
				}
			
      })	 
		$(document).on('input','#edit_deal_selling_price3',function(){
			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			$('#edit_deal_makeDiscount3').each(function(){
				price = $('#edit_deal_selling_price3').val(); 
				vals = $('#edit_deal_makeDiscount3').val(); 
		      //console.debug(price); return false;
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
					if(price != "" && vals !="")
					{
						real = (price - vals);
						if(real >= 0)
						{
							var real1 = Math.floor(real);
							$('#edit_deal_discount3').val(real1);
						}
						else
						{
							$('#edit_deal_discount3').val('');
						}
					}
					else
					{
						$('#edit_deal_discount3').val('');
					}
				}
				else
				{ 
				   $('#edit_deal_discount3').val('');
				}
			})
     })
     
     $(document).on('input','#edit_deal_makeDiscount3,#edit_deal_selling_price3',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
	  			price = $('#edit_deal_selling_price3').val(); 
				vals = $('#edit_deal_makeDiscount3').val(); 
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
					if(price != "" && vals !="")
					{
						real = (price - vals);
						if(real >= 0)
						{
							var real1 = Math.floor(real);
							$('#edit_deal_discount3').val(real1);
						}
						else
						{
							$('#edit_deal_discount3').val('');
						}
					}
					else
					{
						$('#edit_deal_discount3').val('');
					}
				}
				else
				{ 
				   $('#edit_deal_discount3').val('');
				}
			
      })	 
});
</script>
<script>
$(function(){
	tinyMCE.init({
		inline_styles : true,
		mode : "specific_textareas",
		theme : "advanced",
		width: "300",
		height: "210",
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
});
</script>
<script>
/*********************Multiple Image Upload Coded By Shivam Chauhan *********************/
$(function(){

	var abc = 'valid';
	$('#edit_submit_btn').click(function(){
		var cnt = $("input[name='main_image']:checked").length;
			if(abc == 'invalid'){
				alert('please Select only six images');
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

$("#edit_uploadFile").on("change", function(){
        var files = !!this.files ? this.files : [];
		var $i, file,arr=[];
        if (!files.length || !window.FileReader) return; 
		$('.imagePreview').remove();
	   var numfiles = files.length;
	   var avail = $("#availImages").val();
		avail = avail*1;
		if(numfiles > 6){
			alert('Please Select only six images');
			abc = 'invalid';
			$('#edit_uploadFile').val('');
			return false;
		}
		else if((numfiles+avail) > 6) {
				alert('Please Select only six images');
				$('#edit_uploadFile').val('');
				abc = 'invalid';
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
	$(document).on("click",".checkbox_list",function(){
		var checkedState = $(this).prop('checked');		
		if($(this).is(':checked'))			{
		$('#myModal').modal('show');
		}			
		$('.checkbox_list').each(function () {	
			$(this).prop('checked', false);			
		});			
		$(this).prop('checked', checkedState);
	});
	$(document).on('click', "#edit_del_link" , function(){
			var parent = $(this).parent();
			parent.remove();
		});
	
	$('.del_link').on('click',function(){

			var img_id=$(this).attr('rel');
			var deal_id = $('.edit_deal_id').val();
			if(img_id!='' && deal_id!='') {
				if (confirm('Are you sure you want to delete this image ?')) {
					
					$.ajax({
						type:'post',
						url:ajax_url+'/Deals/deleteDealImage/'+deal_id+'/'+img_id,
						success:function(resp)
						{
							$('#render_data').html(resp);
					
						
						}
					});
				}
			}else {
				alert('An error occured!');
			}
		});
	$('#delete_all').on('click',function(){
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
					url:ajax_url+'/Deals/deleteAllDealImage',
					success:function(resp)
					{
						$('#render_data').html(resp);
					}
				});
				return false;
			}
		}else {
			   alert("An error occured!");
			}
		
	});
</script>
<style>
.new-class-101 img {
    border: 1px solid #22add6;
    border-radius: 20px;
    cursor: pointer;
    display: inline-block;
    margin-top: 4px;
    padding: 3px;
    width: 18px;
}
.new-class-101 > input {
    float: left;
    width: 202px;
}
.imagepreview img
 {
    width: 100px;
    height: 100px;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    float:left;
    margin-bottom: 10px;
}
.imagepreview {
    float: left;
    margin: 0 0 10px 10px;
	position:relative;
    width: 100px;
}

.file_close {
    float: left;
    position: absolute;
    right: -7px;
    top: -7px;
    width: 15px;
}
.imagepreview .file_close img {
    float: left;
	height:auto;
    margin: 0;
    width: auto;
}
.imagepreview img{
	max-width:100%;
	width:100%;
}
.modal-dialog.modal-sm {
    z-index: 1041;
}
.modal-backdrop.fade {
    opacity: 0.5;
}
.modal-backdrop{
height:100%;
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
label img {
    border: 1px solid #22add6;
    border-radius: 20px;
    cursor: pointer;
    padding: 3px;
    width: 18px;
}
@media(max-width:767px)
{
	
}
.margin_btm{
margin-bottom:10px;
}
</style>


<h1>Edit Deal</h1>
<form id="editDealForm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'Deals/edit_deal/'.$edit_deal['Deal']['id'];?>">
	<div class="under_line_div"></div>
	<div class="col-lg-11 col-sm-12 col-md-12 col-xs-12 padding_0 ">
	   <input type="hidden" class="edit_deal_id" name="data[Deal][id]" value="<?php echo $edit_deal['Deal']['id']?>" />		
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
					<div class="form-group">
						<label>Deal Title<em>*</em><label>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
					<div class="form-group ">
						<input id="deal_name" value='<?php echo $edit_deal["Deal"]["name"];?>' name="data[Deal][name]" type="text" class="form-control required"/>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
					<div class="form-group ">
						<label>Upload Image (max 100kb)<em>*</em>  <label>
								<img rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" title="Your deal images should not be too large as they will slow down the loading of the page for your customers. To find out how to reduce the size of an image, see your 'Welcome Pack' via the link at the top of this page"/>
						</label></label>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
					<div class="form-group new-class-101">
						<img rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" title="Upload multiple images by selecting the images you wish to upload from your hard drive, and press the CTRL key to select multiple images. Once uploaded,tick/select the checkbox of the image that you wish to appear as your main deal image, and that image will be the first image displayed on your Deal's detail page"/>
						<input id="edit_uploadFile" type="file" name="deal_image[]"  multiple="multiple"/>
						<!--<input name="deal_image" type="file"/>	-->											
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id ="render_data">
						<?php $i= 0;
						foreach ($edit_deal['DealImage'] as $image):?>
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
					<div class="pull-right margin_btm">
						<button class="btn btn-danger" id ="delete_all" >Delete All</button>
					</div>
				</div>
			</div>
			<!--<div class="row">
			   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
					
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
					<div class="form-group">
						<img  src="<?php //echo IMPATH.'deals/'.$edit_deal['Deal']['image'];?>" height="200" width="200"/>
					</div>
				</div>
			</div>-->
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
					<div class="form-group">
						<label>Customer Buying Date Range <em>*</em>
						<label>
						 <img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="The date/s during which a customer may purchase a product or service coupon"   /> </label>
						</label>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 padding_0">
							<div class="form-group">
								<input value="<?php echo date('d M Y',strtotime($edit_deal['Deal']['buy_from']));?>" type="text" class="form-control startdate_buy required" readonly="readonly" rel="buy" name="data[Deal][buy_from]" >
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 padding_0 text-center">
							<div class="middle_to">
								To
							</div>
						</div>
						<div class="col-lg-5 col-xs-5 col-md-5 col-xs-5 padding_0">
							<div class="form-group">
								<input value="<?php echo date('d M Y',strtotime($edit_deal['Deal']['buy_to']));?>" type="text" class="form-control enddate_buy required" readonly="readonly" rel="buy" name="data[Deal][buy_to]" >
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 hide_readmee">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
					<div class="form-group ">
						<label>Customer Redeeming Deadline<em>*</em>
						<label>
						 <img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="The date by which a customer must use or redeem a purchased coupon, after which date it expires and is invalid"   /> </label>
					   </label>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 padding_0">
							<div class="form-group">
								<input value="<?php echo date('d M Y',strtotime($edit_deal['Deal']['redeem_from']));?>" type="text" class="form-control startdate_redeem required" readonly="readonly" rel="redeem" name="data[Deal][redeem_from]">
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 padding_0 text-center">
							<div class="middle_to">
								To
							</div>
						</div>
						<div class="col-lg-5 col-xs-5 col-md-5 col-xs-5 padding_0">
							<div class="form-group">
								<input value="<?php echo date('d M Y',strtotime($edit_deal['Deal']['redeem_to']));?>" type="text" class="form-control enddate_redeem required" readonly="readonly" rel="redeem" name="data[Deal][redeem_to]">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
					<!--........................-->							
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
					<div class="form-group">
						<label>Deal's Category<em>*</em><label>
					</div>
				</div>									
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
					<div class="form-group">
						<select name="data[Deal][category]" class="required" >						
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
								     <option value="<?php echo $cat_id;?>" <?php if($edit_deal['Deal']['category'] == $cat_id) echo 'selected="selected"';?> >
									     <?php echo $cat_name; ?>
									  </option>
								<?php
								 } 
							 } 
							 ?>
						</select>														
					</div>
				</div>
			</div>
		</div>	
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
					<div class="form-group">
						<label>Price includes shipping<em>*</em><label>
					</div>
				</div>									
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
					<div class="form-group">
						<select name="data[Deal][shipping_price]" class="required" >						
							<option value="">Select </option>
							<option <?php if($edit_deal['Deal']['shipping_price'] =='Yes') echo 'selected="selected"';?> value="Yes">Yes</option>
							<option <?php if($edit_deal['Deal']['shipping_price'] =='No') echo 'selected="selected"';?> value="No">No</option>												
						</select>														
					</div>
				</div>
			</div>
		</div>	
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
					<div class="form-group">
						<label>Voucher Quantity:<em>*</em>
						<label>
						<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="The total number of vouchers you are prepared to offer for this deal"   /> 
						</label>
						</label>																			
						</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
					<div class="form-group">
						<input id="deal_quantity" name="data[Deal][quantity]" value="<?php echo $edit_deal['Deal']['quantity']; ?>" type="text" class="form-control required"/>
					</div>
				</div>
			</div>
		</div>						
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Deal Location<em>*</em><label>
						</div>
					</div>
					<!--<input type="hidden" class="location_hidn required" value="<?php if(@$location_checked==1){echo '1';}?>" />-->
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">											
							<select name="data[Deal][location][]" class="required">					                    
								<?php
									$location_checked='';
									foreach ($nearest_location as $loc)
									{
										$multiple_loc=explode(',',$edit_deal['Deal']['location']);
										if(in_array($loc['Location']['id'],$multiple_loc))
										{                            
											$location_checked=1;
										}
										?>
										<option value="<?php echo $loc['Location']['id'];?>" <?php if(in_array($loc['Location']['id'],$multiple_loc)) echo 'selected="selected"';?> >
										<?php echo $loc['Location']['name']; ?>
										</option>
									<?php
									}
								?>
							</select>																				
						</div>
						<!--<input class="location_hidn required" type="hidden" value=""/>	-->
					</div>
				</div>
			</div>										
					<!--......................-->
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Regular Selling Price<em>*</em>
							<label>
							<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Enter the Regular Selling Price, excluding currency symbol. "   /> 
							</label>											
							<label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input type="text" class="form-control required " id="edit_deal_selling_price" name="data2[8][DealOption][selling_price]" value="<?php echo $edit_deal['DealOption'][0]['selling_price']; ?>" />
						</div>
					</div>
				</div>
			</div>
					
			
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Discounted Selling Price<em>*</em><label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input id="edit_deal_makeDiscount" class="form-control required number makeDiscount" name="data2[0][DealOption][discount_selling_price]" type="text" value="<?php echo $edit_deal['DealOption'][0]['discount_selling_price'];?>"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Discount Offered<em>*</em>
								<label>
									<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="This is the percentage discount that you are offering customers for this particular deal"/>
								</label>
							<label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<!--<input id="discount1" type="text" class="form-control required makeDiscount" name="data2[0][DealOption][discount]" value="<?php //$data['0']['DealOption']['discount']; ?>"/>
							 -->
							 <input type="hidden" value="<?php echo $edit_deal['DealOption'][0]['id'];?>" name="data2[0][DealOption][id]">
   						 <input class="form-control required " id="edit_deal_discount1" value="<?php echo round($edit_deal['DealOption'][0]['discount']);?>" name="data2[0][DealOption][discount]">												
						</div>
					</div>
				</div>
			</div>    				
   		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
						<div class="form-group ">
							<label>Description<em>*</em>
								<label>
									<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Add the description about your deals in point form"/>
								 </label>
							</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<textarea name="data[Deal][description]"  class="form-control required tinymce" style="color:#333;"><?php echo $edit_deal['Deal']['description'] ?></textarea>
						</div>
					</div>
				</div>
			</div>							
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
						<div class="form-group ">
							<label>Fine Print<em>*</em>
								<label>
									<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Insert any specific terms or conditions that relate to this specific deal ie. if a restaurant this could be 'only redeemable for lunchtimes' or if an airline, this could be 'only redeemable to fly on specific days' or if a guest house this could be 'only redeemable for occupancy' for during week days'"/>
								</label>
							</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<textarea name="data[Deal][highlights]" class="form-control required" style="color:#333;"><?php echo $edit_deal['Deal']['highlights'] ?></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
						<div class="form-group ">
							<label>Select Newsletter Date
								<label>
									<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="You can select the valuable date for sending this deal as a newsletter for the customers.">
								</label>
							</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input value="<?php echo date('d M Y',strtotime($edit_deal['Deal']['newsletter_sent_date']));?>" type="text" class="form-control newsletterdate" readonly="readonly" name="data[Deal][newsletter_sent_date]" >
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
						<div class="form-group ">
							<label>Delivery Options (1 option is mandatory)<em>*</em>
								
							</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group ">
							<p style="color:black;">
								1) This is a physical product that requires delivery and the discounted
								selling price includes nationwide door-to-door delivery by courier.
								<input value="physical" class="required" name="data[Deal][delivery_option]" type="radio" <?php if($edit_deal['Deal']['delivery_option']=='physical'){ ?>checked="true" <?php } ?> />
							</p>
							<p style="color:black;">
								2)This is a physical product that requires delivery and the discounted selling price does NOT include nationwide door-to-door delivery by courier.
								<input value="physical-not-delivery" name="data[Deal][delivery_option]" type="radio" <?php if($edit_deal['Deal']['delivery_option']=='physical-not-delivery'){ ?>checked="true" <?php } ?> >
							</p>
							<p style="color:black;">
								3) This is not a physical product and does not require delivery, and the
								customer will use the service via receiving a voucher only.
								<input value="non-physical" name="data[Deal][delivery_option]" type="radio" <?php if($edit_deal['Deal']['delivery_option']=='non-physical'){ ?>checked="true" <?php } ?> >
							</p>
							
						</div>
					</div>
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
								<div class="form-group ">
									<label>Allow Credit Card Sales</label>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
								<div class="form-group" >
									<input type="checkbox" name="data[Deal][modePayment]" <?php if(@trim($edit_deal['Deal']['modePayment']) == 'All') { ?> Checked="true" <?php }  ?>>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label> Additional Deal Selling Options:
								<label><img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="You will use these optional fields if you wish to offer a deal that has an
								additional 1 or 2 choices, ie, if you wish to promote, for example, 3
								options of Yoga classes, with the 1st one being X price for 3 lessons per
								week, that would be your main deal listed above, and then a 2nd option of Y
								price for 5 lessons per week, and a 3rd option of Z price for 7 lessons per
								week."/>
																	
								</label>
							</label>
						</div>
					</div>
					<!--<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input type="text" class="form-control" name="data2[0][DealOption][option_title]"/>
						</div>
					</div>-->
				</div>
			</div>
					
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<input class="option1" type="checkbox" <?php if(trim(@$edit_deal['DealOption'][1]['option_title'])!='' || trim(@$edit_deal['DealOption'][1]['discount'])!=''){?> checked="true" <?php } ?>>
				<?php if(isset($edit_deal['DealOption'][1]['id']) && !empty($edit_deal['DealOption'][1]['id']) ) { ?>
						<input type="hidden" value="<?php echo $edit_deal['DealOption'][1]['id']; ?>" name="data2[1][DealOption][id]" /> 
				<?php } ?>
				<input type="hidden" value="<?php echo $edit_deal['Deal']['id']; ?>" name="data2[1][DealOption][deal_id]" /> 
				<label for="option1">Optional Fields <em>1:-</em></label>
				<div class="row optional_field" style="display:none;">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Discount Option Title 2</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input type="text" class="form-control option1_input" name="data2[1][DealOption][option_title]" value="<?php echo @$edit_deal['DealOption'][1]['option_title'];?>"/>
						</div>
					</div>
				</div>
		 	</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row optional_field" style="display:none;">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Regular Selling Price 2
								<label>
									<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Enter the Regular Selling Price, excluding currency symbol."/>
								</label>
							<label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input type="text" class="form-control required number" id="edit_deal_selling_price2" name="data2[1][DealOption][selling_price]" value = "<?php echo @$edit_deal['DealOption'][1]['selling_price'];?>" />
						</div>
					</div>
				</div>
			</div>
 			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row optional_field" style="display:none;">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Discounted Selling Price 2</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input type="text" id="edit_deal_makeDiscount2" class="form-control discounted2_price" value="<?php echo @$edit_deal['DealOption'][1]['discount_selling_price'];?>"  name="data2[1][DealOption][discount_selling_price]"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row optional_field" style="display:none;">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Discount Offered 2
								<label>
									<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="This is the percentage discount that you are offering customers for this particular deal"/>
								</label>
							</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input id="edit_deal_discount2" readonly="readonly" type="text" class="form-control option1_input" value = "<?php echo @$edit_deal['DealOption'][1]['discount'];?>" data-types="discount" data-discountindex="discount2" name="data2[1][DealOption][discount]" />
						</div>
					</div>
				</div>
			</div>
 			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
  				<input class="option1" type="checkbox" <?php if(trim(@$edit_deal['DealOption'][2]['option_title'])!='' || trim(@$edit_deal['DealOption'][2]['discount'])!=''){?> checked="true" <?php } ?> >
				<?php if(isset($edit_deal['DealOption'][2]['id']) && !empty($edit_deal['DealOption'][2]['id']) ) { ?>
						<input type="hidden" value="<?php echo $edit_deal['DealOption'][2]['id']; ?>" name="data2[2][DealOption][id]" /> 
				<?php } ?>
				<input type="hidden" value="<?php echo $edit_deal['Deal']['id']; ?>" name="data2[2][DealOption][deal_id]" /> 
				<label for="" >Optional Fields <em>2:-</em></label>           
				<div class="row optional_field" style="display:none;">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Discount Option Title 3</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input type="text" class="form-control option2_input" name="data2[2][DealOption][option_title]" value="<?php echo @$edit_deal['DealOption'][2]['option_title'];?>"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row optional_field" style="display:none;">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Regular Selling Price 3
								<label>
									<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Enter the Regular Selling Price, excluding currency symbol."/>
								</label>
							<label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input type="text" class="form-control required sell_price3 number" id="edit_deal_selling_price3" value = "<?php echo @$edit_deal['DealOption'][2]['selling_price'];?>" name="data2[2][DealOption][selling_price]" />
						</div>
					</div>
				</div>
			</div>
  			
 			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row optional_field" style="display:none;">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Discounted Selling Price 3</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input id="edit_deal_makeDiscount3" type="text" class="form-control " name="data2[2][DealOption][discount_selling_price]" value="<?php echo @$edit_deal['DealOption'][2]['discount_selling_price'];?>"/>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
				<div class="row optional_field" style="display:none;">
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
						<div class="form-group">
							<label>Discount Offered 3
								<label>
									<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="This is the percentage discount that you are offering customers for this particular deal"/>
								</label>
							</label>
						</div>
					</div>
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
						<div class="form-group">
							<input id="edit_deal_discount3" readonly="readonly" type="text" class="form-control dis3" data-types="discount" data-discountindex="discount3" name="data2[2][DealOption][discount]" value="<?php echo @$edit_deal['DealOption'][2]['discount'];?>"/>
						</div>
					</div>
				</div>
			</div>
					
							
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12  col-lg-offset-6 col-sm-offset-6 col-md-offset-6 col-xs-offset-0 padding_0">
				<div class="save_btn">
					<input type="submit" id = "edit_submit_btn" value="Save" class="btn btn-primary" />
					<a href="javascript:void(0);" class="btn btn-success cancel_editing_deal">Cancel</a>
				</div>
			</div>
	</div>
</form><!--  Deal Form Ends    -->	