<?php	echo $this->Html->script('frontend/design/jquery.datetimepicker.js');?>
<?php  echo $this->Html->script('backend/tinymce/tiny_mce.js'); ?>
<?php echo $this->Html->css('frontend/jquery.datetimepicker.css');?>
<?php echo $this->Html->script('frontend/development/bootstrap-multiselect.js'); ?>
<?php echo $this->Html->css('frontend/bootstrap-multiselect.css'); ?>	
<?php echo $this->Html->script('ajaxupload.3.5.js'); ?>
<style>
.imagePreview img
 {
    width: 100px;
    height: 100px;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
    float:left;
    margin-bottom: 10px;
}
    .td_padding 
	{
        color: #555;
    }
    .edit_field .form-group > label 
	{
		color: red !important;
	}
	.form-group, .middle_to 
	{
		color: black;
	}
	#new_deal .form-group #uploadFile
	{
		float: left;
		width: 202px;
	}
	#new_deal .form-group img
	{
		border: 1px solid #22add6;
		border-radius: 20px;
		cursor: pointer;
		display:inline-block;
		margin-top:4px;
		padding: 3px;
		width: 18px;
	}
	table
	{
		width:auto;
	}
</style>
<script>
/*********************Multiple Image Upload Coded By Shivam Chauhan *********************/
$(function(){

	var abc = 'valid';
	$('#submit_btn').click(function(){
		var check_imag=$('#uploadFile').val();
		if(check_imag != ''){
			var cnt = $("input[name='main_image']:checked").length;
			
			if(abc == 'invalid'){
				alert('Please Select only six images');
				return false;
			}
			else if (cnt < 1) 
			{
				alert('Select at least 1 Image to make primary');
				return false;
			}
		}	 
	});

$("#uploadFile").on("change", function(){
        var files = !!this.files ? this.files : [];
		var $i, file,arr=[];
        if (!files.length || !window.FileReader) return; 
       $('.imagePreview').remove();
	   var numfiles = files.length;
	   if(numfiles > 6){
			alert('Please Select only six images');
			abc = 'invalid';
			return false;
		} else {
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
			    var image ='<div class="imagePreview"><img src="'+source.target.result+'" value = "'+arr[$i]+'"/><a class="file_close" id = "del_link" href="javascript:void(0)"><img src="<?php echo HTTP_ROOT;?>img/file_close.png" /></a> <input type="hidden" value="'+n+'_'+$i+'" name ="hidden_img['+$i+']" /><span style="display: block; float: left; height: 20px; line-height: 20px;"><input style="float:left;" type="checkbox" class = "checkbox_list" name = "main_image" value= "'+n+'_'+$i+arr[$i]+'"/></span></div>';
				$('#uploadedImages').append(image);
				$i += 1;
			}
    });
	$(document).on("click",".checkbox_list",function(){
		var checkedState = $(this).prop('checked');		
		if($(this).is(':checked'))	{
			var a = $('.imagePreview').children('img').attr('src');
			$('#myModal').modal('show');
			console.log($imgSrc = $(this).parents('div.imagePreview').children('img').prop('src'));
			 
			$('.imgsrc').children('img').attr('src',$imgSrc).css({'height':'462px','margin':'auto','width':'690px'});
			
		}			
		$('.checkbox_list').each(function () {	
			$(this).prop('checked', false);			
		});			
		$(this).prop('checked', checkedState);
	});
	$(document).on('click', "#del_link" , function(){
			var parent = $(this).parent();
			parent.remove();
		});	
</script>
<script>
$(function(){
	tinyMCE.init({
		inline_styles : true,
		mode : "specific_textareas",
		theme : "advanced",
		editor_selector : "tinymce",
		width: "300",
		height: "210",
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
<style>
.imagePreview {
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
.imagePreview .file_close img {
    float: left;
	height:auto;
    margin: 0;
    width: auto;
}
.imagePreview img{
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
.imgsrc h3{
	font-size: 16px;
   margin-bottom: 8px;

</style>

<!-- Modal -->
<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Message</h4>
      </div>
      <div class="modal-body imgsrc">
		<h3 style="text-align:center;">The main photo that is selected will be the 1 image shown on the Deal listing page for Customers when browsing. </h3>
		<h6 style="text-align:center;">To see a full size version of this image and determine whether its quality will be acceptable once live on the website for your customers, tick this check box. If the full sized image is blurry or pixelated, then you know that is needs to be replaced by another image that looks better. We recommend all images should be between 40-80 KB in size and approximately 680 x 460 pixels. These are guidelines and are not the same with all images as their shapes and quality differ. If in doubt, we advise testing via this feature until you get the look you desire with each of the images you wish to use. For help withre-sizing images, see your "Welcome Pack" which is accessible via the link at the top of your login page. </h6>
		<img class="img-responsive" src="">
      </div>
      
    </div>
  </div>
</div>

<!--Supplier profile area page-->
<div class="supplier_container">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="supplier_heading">
			<h1>Supplier Profile</h1>
		</div>
	</div>
	<?php
		if($this->Session->check('success') || $this->Session->check('success')) 
		{
			if($this->Session->check('success')) 
			{
	?>
				<div style="float:none!important;" class="BaseStatus session_div">
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
			<?php 
			} 	
			else 
			{ ?>
				<div  style="float:none!important;" class="BaseError session_div"><?php echo $this->Session->read('error')?></div>
				<?php unset($_SESSION['error']); ?>
	<?php 
			} 
		} 
	?>
	<div style="float:none!important;" class="ReconcileStatus reconcile_success"></div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
		<div class="supplier_profile_container">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="left_tabs">
					<ul class="nav nav-pills nav-stacked admin-menu">
						<li class="active"><a href="javascript:void(0);" data-target-id="home"><i class="fa fa-home fa-fw">
							</i>My Account</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-target-id="new_deal">
								<i class="fa fa-thumbs-o-up"></i>
								New Deal
							</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-target-id="widgets">
								<i class="fa fa-thumbs-o-up"></i>
								Active Deals
							</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-target-id="queued" class="queuedAnchor">
								<i class="fa fa-archive"></i>
								Queued Deals
							</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-target-id="news_letters">
								<i class="fa fa-thumbs-o-up"></i>
								Sent News Letters
							</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-target-id="total_sales" class="total_sales_tab">
								<i class="fa fa-thumbs-o-up"></i>
								Redeemed Vouchers
							</a>
						</li>
						<!--<li>
							<a href="javascript:void(0);" data-target-id="pages" class="saleAnchor">
								<i class="fa fa-male"></i> 
								Sales Made
							</a>
						</li>-->
						<!-- <li>
							<a href="javascript:void(0);" data-target-id="charts">
								<i class="fa fa-users"></i>
								New Business
							</a>
						</li> -->
						<!--<li>
							<a href="javascript:void(0);" data-target-id="table" class="archivedAnchor">
								<i class="fa fa-archive"></i>
								Archived Deals
							</a>
						</li>-->						
						<!--<li>
							<a href="javascript:void(0);" data-target-id="forms" class="refundAnchor" >
								<i class="fa fa-money"></i>
								Refunds
							</a>
						</li>-->
						<li>
							<a href="javascript:void(0);" data-target-id="library" class="claimAnchor">
								<i class="fa fa-calendar fa-fw"></i>
								Payment History
							</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-target-id="authenticate">
								Authenticate & Claim
							</a>
						</li>
						<li>
							<a href="javascript:void(0);" data-target-id="reconcile" class="reconcileAnchor">
								Claims History
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding_left_0">
				<div class="right_tabs">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="home">
					
					<!-- ************************************ My Account *********************************** -->
					<!-- ************************************ My Account *********************************** -->
						
						<h1>My Account:</h1>
						<label>
						<?php 
							echo ucwords($info['Member']['name'].' '.$info['Member']['surname']);
							//echo $info['MemberMeta']['company_name'];
						?>
						</label>
						<a href="javascript:void(0);" class="edit_field_div edit_field_div1" >
							<span class="glyphicon glyphicon-edit "></span>
							Edit
						</a>
						<div class="under_line_div"></div>
						<div class="col-lg-10 col-sm-10 col-md-10 col-xs-12 padding_0 col-lg-offset-1 hide_div_block">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="form-group color_for_pf">
									<label>Personal Information :</label>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Business Name:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo ucwords($info['MemberMeta']['company_name']);?><span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Trading As:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo ucwords($info['MemberMeta']['trading']);?><span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>First Name:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo ucwords($info['Member']['name']);?><span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Last Name:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo ucwords($info['Member']['surname']);?><span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Physical Address:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo $info['Member']['address'];?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Town/City:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo $info['Member']['city'];?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Nearest Location:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo $info['Location']['name'];?></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Mobile Number:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo $info['Member']['phone'];?><span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Landline Number:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo $info['MemberMeta']['landline'];?><span>
											</div>
										</div>
									</div>
								</div>
							</div>	
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Website:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo $info['MemberMeta']['website'];?><span>
											</div>
										</div>
									</div>
								</div>
							</div>						
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>E-mail:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><?php echo $info['Member']['email'];?><span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
							
							<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Country:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span> India</span>
											</div>
										</div>
									</div>
								</div>
							</div>-->
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">							
								<div class="account_details acc_details_div_2">
									<div class="under_line_div"></div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
									<div class="form-group banking_detail_label">
										<label> Banking Detail: </label>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Name of Bank Account Holder:</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<span><?php echo ucwords($info['MemberMeta']['account_holder']);?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Name of Bank:</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<span><?php echo $info['MemberMeta']['bank_name'];?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Branch Code:</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<span><?php echo $info['MemberMeta']['branch_code'];?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Account No:</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<span><?php echo $info['MemberMeta']['account_number'];?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Type of Account:</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<span><?php echo $info['MemberMeta']['account_type'];?></span>
												</div>
											</div>
										</div>
									</div>
								</div>-->
							<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Change Password:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span> <a href="javascript:void(0);" class="show_pass"><span class="glyphicon glyphicon-hand-right"></span>Click here to change password</a></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12  col-md-12  col-sm-12  col-xs-12 padding_0 change_pass" style="display:none;">
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Old Password</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<input name="data[Member][old_password]" type="text" class="form-control"/>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>New Password</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<input name="data[Member][password]" type="text" class="form-control"/>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Confirm Password</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<input name="data[Member][cnf_password]" type="text" class="form-control"/>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-0 padding_0 ">
									<div class="save_btn">
									<a href="javascript:void();" class="btn btn-primary">Save</a>
									<a href="javascript:void();" class="btn btn-success change_pass">Cancel</a>
									</div>
								</div>
							</div>-->
							</div>
							<!-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Website:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span><a href="javascript:void(0);">www.promaticstechnologies.com</a></span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Industry Name:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span> Travel</span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Company Type:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span> Public Limited Company</span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>No. of Location:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span>1</span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Company Registration No:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span> 1234567</span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>VAT Registration No:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span> 123456</span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
									<div class="form-group">
										<label>Busines Start Date:</label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
									<div class="edit_field">
										<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
											<div class="form-group">
												<span> 23.10.2012</span>
											</div>
										</div>
									</div>
								</div>
							</div> -->
						</div>
						<!-- edit field -->
             		<form id="frm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'Suppliers/profile/'.base64_encode(convert_uuencode($info['Member']['id']))?>">
						<div class="col-lg-9 col-sm-12 col-md-12 col-xs-12 padding_0 col-lg-offset-1 col-sm-offset-1 col-md-offset-1 show_right_div" style="display:none;">
							<input name="data[Member][member_type]" type="hidden" value="3" />
                  	<input name="data[MemberMeta][id]" type="hidden" value="<?php echo $info['MemberMeta']['id'];?>" />
                 		<input type="hidden" id="mem_id" value="<?php echo $info['Member']['id']; ?>" />
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Business Name<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input name="data[MemberMeta][company_name]" type="text" value="<?php echo $info['MemberMeta']['company_name'];?>" class="required form-control"/>
										</div>
									</div>
								</div>
							</div> 
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Trading As<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input name="data[MemberMeta][trading]" type="text" value="<?php echo $info['MemberMeta']['trading'];?>" class="form-control"/>
										</div>
									</div>
								</div>
							</div>                 		
                 		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>First Name<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control required" name="data[Member][name]" value="<?php echo $info['Member']['name'];?>"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Last Name<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input name="data[Member][surname]" type="text" value="<?php echo $info['Member']['surname'];?>" class="form-control required"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Physical Address<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" name="data[Member][address]" value="<?php echo $info['Member']['address'];?>" class="form-control required"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
										<div class="form-group">
											<label>Town/City<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input  name="data[Member][city]" type="text" value="<?php echo $info['Member']['city'];?>" class="form-control required"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Nearest Location<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<select name="data[Member][location]" class="required">
												<option value="">Select Nearest Location</option>
                      <?php foreach ($options as $option){ ?>
										<option value="<?php echo $option['Location']['id'];?>" <?php if($option['Location']['id']==$info['Member']['location']) echo 'selected="selected"'; ?>>
											<?php echo $option['Location']['name']; ?>
									</option>
						
									<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Mobile Number<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input name="data[Member][phone]" maxlength="16" type="text" value="<?php echo $info['Member']['phone'];?>" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Landline Number<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input name="data[MemberMeta][landline]" maxlength="16" type="text" value="<?php echo $info['MemberMeta']['landline'];?>" class="form-control "/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Website<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input name="data[MemberMeta][website]" type="text" value="<?php echo $info['MemberMeta']['website'];?>" class="form-control required"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
										<div class="form-group">
											<label>E-mail<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input name="data[Member][email]" type="text" value="<?php echo $info['Member']['email'];?>" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							
							
							<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Country<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>-->
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Name of Bank Account Holder:<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input  name="data[MemberMeta][account_holder]" type="text" value="<?php echo $info['MemberMeta']['account_holder'];?>" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Name of Bank:<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input  name="data[MemberMeta][bank_name]" type="text" value="<?php echo $info['MemberMeta']['bank_name'];?>" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Branch Code:<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input  name="data[MemberMeta][branch_code]" type="text" value="<?php echo $info['MemberMeta']['branch_code'];?>" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Account No:<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input  name="data[MemberMeta][account_number]" type="text" value="<?php echo $info['MemberMeta']['account_number'];?>" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Type of Account<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
										 <select name="data[MemberMeta][account_type]">
												<option value="">Select Account Type</option>
												<option value="savings">Savings</option>
             								<option value="current">Current</option>
											</select>
										</div>
									</div>
								</div>
							</div>-->							
							<?php /*<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Subscribe NewsLetter<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<div class="sub_news_radio">
												<p><input name="data[Member][newsletters]" type="radio" value="Yes" <?php if($info['Member']['newsletters']=="Yes"){ echo 'checked="checked"'; } ?>/>Yes</p>
											</div>
											<div class="sub_news_radio">
												<p><input name="data[Member][newsletters]" type="radio" value="No" <?php if($info['Member']['newsletters']=="No"){ echo 'checked="checked"'; } ?>/>No</p>
											</div>
										</div>
									</div>
								</div>
							</div>*/ ?>						
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  col-lg-offset-6 col-sm-offset-6 col-md-offset-6 col-xs-offset-0 padding_0">
								<div class="form-group ">
									<input class="form-control checkbox_in_form" id="cp" type="checkbox" /> 												
									<label class="form_inline_for_checkbox" for="cp">Change Password 	</label>
								</div>									
							</div>
							<!--  Gaurav -->							
							<div style="display: none;" class="col-lg-12  col-md-12  col-sm-12  col-xs-12 padding_0 change_pass2">
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Old Password</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<input type="password" class="form-control" name="data[Member1][old_password]">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>New Password</label>
											<label>(Min. 6 characters)</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<input type="password" class="form-control" name="data[Member1][password]" id="pwd">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
										<div class="form-group">
											<label>Confirm Password</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 padding_0">
										<div class="edit_field">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
												<div class="form-group">
													<input type="password" class="form-control" name="data[Member1][cnf_password]">
												</div>
											</div>
										</div>
									</div>
								</div>								
							</div>            
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-0 padding_0 ">
								<div class="save_btn">
									<input type="submit" value="Save" onclick="return ajax_formname('frm','Validates/checkEdit','receiver')" class="btn btn-primary" />
                  			<a href="javascript:void(0);" class="btn btn-success cancel_editing">Cancel</a>
								</div>
							</div>
                	</form>
						</div>
					</div>
					<!-- ******************************* My Deals ************************************************** -->
					<!-- ******************************* My Deals ************************************************** -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content " id="widgets">
						<div class="hide_div_block_deal edit_field_div_deal edit_field_div1_deal">
							<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0">
								<h1>Active Deals
								<label>
									<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  22px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="These are your deals that have been promoted via one or more newsletters and are active on the website for sale"/>
								</label>
								</h1>
							</div>
							<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
	          				<form id="mydeal_search" method="post">
									<div class="search_feature" style="margin-bottom: 0px;">
										<div class="input_round">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_0">
												<input class="startdatesrch2 date_timepicker_start" name="startdate" type="text" placeholder="Start Date" >
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_0">
												<input class="enddatesrch2 date_timepicker_end" name="enddate" type="text" placeholder="End Date" >
											</div>
											<span class="glyphicon glyphicon-search mydeal_search_btn"></span>
										</div>
									</div>
	         				</form>
							</div>
							<div class="under_line_div"></div>
							<div class="no-more-tables mydeal_element2">
	             			<?php echo $this->element('frontend/suppliers/element2'); ?>
						 	</div>
						 </div>
					</div>	
					<!-- *********************************** New Deal ******************************************* -->			
					<!-- *********************************** New Deal ******************************************* -->		
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="new_deal">
						<?php 
						if($bankDetail == 'false')  
						{
						?>
						<div class="alert alert-danger alerter" role="alert">
							<h5>Please first enter your banking details before adding a new deal, as without them we won't know where to pay your commission!<h5>
						</div>
						<?php 
						}
						?>
						<h1>New Deal</h1>
						
						<form id="DealForm" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'Deals/add_deal/'.$this->Session->read('Member.id'); ?>">
						<div class="under_line_div"></div>
						<div class="col-lg-11 col-sm-12 col-md-12 col-xs-12 padding_0  ">
							<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
										<div class="form-group">
											<label>Company Name<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input id="company_name" name="data[Deal][company_name]" type="text" class="form-control required"/>
										</div>
									</div>
								</div>
							</div>-->
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
										<div class="form-group">
											<label>Deal Title<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input id="deal_name" name="data[Deal][name]" type="text" class="form-control required"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Upload Image (max 100kb)<em>*</em>  <label>
													<img rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" title="Your deal images should not be too large as they will slow down the loading of the page for your customers. To find out how to reduce the size of an image, see your 'Welcome Pack' via the link at the top of this page">
												</label></label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
										   <img rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" title="Upload multiple images by selecting the images you wish to upload from your hard drive, and press the CTRL key to select multiple images. Once uploaded,tick/select the checkbox of the image that you wish to appear as your main deal image, and that image will be the first image displayed on your Deal's detail page">
										   <input id="uploadFile" type="file" name="deal_image[]"  multiple="multiple">
											<!--input type="file" name="deal_image" class="required"-->
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="uploadedImages">
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
										<div class="form-group">
											<label>Customer Buying Date Range <em>*</em>
											<label>
											 <img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="The date/s during which a customer may purchase a product or service voucher"   /> </label>
											</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
											<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 padding_0">
												<div class="form-group">
													<input type="text" class="form-control startdate_buy required" readonly="readonly" rel="buy" name="data[Deal][buy_from]" >
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 padding_0 text-center">
												<div class="middle_to">
													To
												</div>
											</div>
											<div class="col-lg-5 col-xs-5 col-md-5 col-xs-5 padding_0">
												<div class="form-group">
													<input type="text" class="form-control enddate_buy required" readonly="readonly" rel="buy" name="data[Deal][buy_to]" >
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
											 <img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="The date by which a customer must use or redeem a purchased voucher, after which date it expires and is invalid"   /> </label>
										</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding_0">
											<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 padding_0">
												<div class="form-group">
													<input type="text" class="form-control startdate_redeem required" readonly="readonly" rel="redeem" name="data[Deal][redeem_from]">
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 padding_0 text-center">
												<div class="middle_to">
													To
												</div>
											</div>
											<div class="col-lg-5 col-xs-5 col-md-5 col-xs-5 padding_0">
												<div class="form-group">
													<input type="text" class="form-control enddate_redeem required" readonly="readonly" rel="redeem" name="data[Deal][redeem_to]">
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
											<select name="data[Deal][category]" class="required">
												<option value="">Select Category</option>
												<?php foreach($dealcat as $key=>$value)
												{
													if(in_array($key,$parent_catog_id))
													{
												?>
												      <option value="0"><?php echo $value;?></option>
												<?php		
													}
													else
													{ 
												?>
												      <option value="<?php echo $key;?>"><?php echo $value;?></option>
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
											<label>Price includes shipping<em>*</em>
											<label>
											<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Select this option if your product selling price includes shipping. If you state No and it does not include shipping, then the customer should be charged for that at the time of placing an order. Whichever option you select, a note will be inserted on to their voucher that states whether shipping is or is not included. All shipping needs to be done via door to door courier delivery"   /> 
											</label>
											<label>
										</div>
									</div>									
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<select name="data[Deal][shipping_price]" class="required">
												<option value="">Select shipping</option>
												<option value="Yes">Yes</option>
												<option value="No">No</option>												
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
											<input id="deal_quantity" name="data[Deal][quantity]" type="text" class="form-control required"/>
										</div>
									</div>
								</div>
							</div>						
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
										<div class="form-group">
											<label>Deal Location<em>*</em>
											<label>
											<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="1 Deal per Location List. If you want a deal to appear in multiple location lists, you need to create a new deal for each location list in which you wish you deal to appear"   /> 
											</label>											
											<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">											
			                     <select name="data[Deal][location][]" class="required ">
									        	<option value="">Select Location</option>
					                <?php 
					                foreach ($options as $option)
					                { 
					                ?>
										  	<option value="<?php echo $option['Location']['id'];?>">
											 <?php echo $option['Location']['name']; ?>
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
											<input id="selling_price" type="text" class="form-control required number sellingprice" name="data2[0][DealOption][selling_price]"/>
										</div>
									</div>
								</div>
							</div>
							<!--<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
										<div class="form-group">
											<label>Discount Option Title 1<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control required" name="data2[0][DealOption][option_title]"/>
										</div>
									</div>
								</div>
							</div>-->
							
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
										<div class="form-group">
											<label>Discounted Selling Price<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="discount1_price required form-control makeDiscount" name="data2[0][DealOption][discount_selling_price]"/>
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
											<input type="text" class="form-control required " readonly="readonly" id="discount1" data-types="discount" data-discountindex="discount1" name="data2[0][DealOption][discount]"/>
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
											<textarea name="data[Deal][description]" class="required tinymce" style="color:#333;"></textarea>
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
													<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Insert any specific terms or conditions that relate to this specific deal

 ie. if a restaurant this could be 'only redeemable for lunchtimes'

 or if an airline, this could be 'only redeemable to fly on specific days'

 or if a guest house this could be 'only redeemable for occupancy for
 during week days'">
												</label>
											</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<textarea name="data[Deal][highlights]" class="required" style="color:#333;"></textarea>
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
													<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Select your preferred date that you wish this deal to appear in this locations newsletter. This is not a guaranteed date and deals will be inserted on a first come first served basis.">
												</label>
											</label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control newsletterdate" readonly="readonly" name="data[Deal][newsletter_sent_date]" >
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
												<input value="physical" class="required" name="data[Deal][delivery_option]" type="radio" />
											</p>
											<p style="color:black;">
												2) This is a physical product that requires delivery and the discounted selling price does NOT include nationwide door-to-door delivery by courier.
												<input value="physical-not-delivery" name="data[Deal][delivery_option]" type="radio" >
											</p>
											<p style="color:black;">
												3) This is not a physical product and does not require delivery, and the
												customer will use the service via receiving a voucher only.
												<input value="non-physical" name="data[Deal][delivery_option]" type="radio" >
											</p>
											
										</div>
									</div>
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
											<input type="checkbox" name="data[Deal][modePayment]">
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
												 week."/></label>
																				
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
            				<input class="option1" type="checkbox" >
								<label for="option1">Optional Fields <em>1:-</em></label>
								<div class="row optional_field" style="display:none;">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
										<div class="form-group">
											<label>Discount Option Title 2<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control option1_input" name="data2[1][DealOption][option_title]"/>
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
													<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Enter the Regular Selling Price, excluding currency symbol. "/>
												</label>
											<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control required number selling_price2" name="data2[1][DealOption][selling_price]" />
										</div>
									</div>
								</div>
							</div>
						
          				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row optional_field" style="display:none;">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
										<div class="form-group">
											<label>Discounted Selling Price 2<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control discounted2_price" id='discounted2_price' name="data2[1][DealOption][discount_selling_price]"/>
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
											<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control option1_input discount2" readonly="readonly" id="discount2"  data-types="discount" data-discountindex="discount2" name="data2[1][DealOption][discount]" />
										</div>
									</div>
								</div>
						</div>
          				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
           					<input class="option1" type="checkbox" >
								<label for="" >Optional Fields <em>2:-</em></label>           
								<div class="row optional_field" style="display:none;">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
										<div class="form-group">
											<label>Discount Option Title 3<label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control option2_input" name="data2[2][DealOption][option_title]"/>
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
												<img src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Enter the Regular Selling Price, excluding currency symbol. "/>
											</label>
										<label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
									<div class="form-group">
										<input type="text" class="form-control required selling_price3 number" name="data2[2][DealOption][selling_price]" />
									</div>
								</div>
							</div>
						</div>
						
          				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
							<div class="row optional_field" style="display:none;">
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
									<div class="form-group">
										<label>Discounted Selling Price 3<label>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
									<div class="form-group">
										<input type="text" class="form-control discounted3_price" name="data2[2][DealOption][discount_selling_price]"/>
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
										<input type="text" class="form-control discount3" readonly="readonly" data-types="discount" id="discount3" data-discountindex="discount3" name="data2[2][DealOption][discount]" />
									</div>
								</div>
							</div>
						</div>
												
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12  col-lg-offset-6 col-sm-offset-6 col-md-offset-6 col-xs-offset-0 padding_0">
								<div class="save_btn">
								<input type="submit" value="Save" id = "submit_btn" class="btn btn-primary" />
                 				<a href="javascript:void(0);" class="btn btn-success cancel_editing">Cancel</a>
								</div>
							</div>
						</div>
      			</form><!--  Deal Form Ends    -->
				</div>
				<!-- *********************************** News Letter ******************************************* -->			
				<!-- *********************************** News Letter  ******************************************* -->		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content " id="news_letters">
					<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0">
						<h1>Sent News Letters</h1>
					</div>
					<div class="under_line_div"></div>
					<div class="no-more-tables news_letters_element">
					<?php echo $this->element('frontend/suppliers/news_letters_element'); ?>
					</div>
				</div>
				<!-- *********************************** Total Sales ******************************************* -->			
				<!-- *********************************** Total Sales  ******************************************* -->		
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="total_sales">
						<div class="col-lg-4 col-sm-6 col-md-4 col-xs-12 padding_0">
							<h1 class="h1">Redeemed Vouchers
							<label>
							<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width: 22px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="These are the customer vouchers that you have received, delivered upon and claimed">
							</label>
							</h1>
						</div>
						<div class="spacer"></div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
								<div class="search_feature">
									<div class="input_round_2">
										<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
											<input type="text" placeholder="Search by Deal Name" name="dealName" class="custName">
											<input type="hidden" id="hiddenname">
										</div>
									</div>
								</div>
							</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						  <div class="date-time">
						  <div class="search_feature">
							<form id="searchbydate">
								<div class="input_round_2">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
										<input class="startdate redeem_sr " id="date_timepicker_start" type="text" name="startdate" placeholder="Start Date" readonly>
										<input type="hidden" id="hiddenstartdate">
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
										<input type="hidden" id="hiddenenddate">
										<input class="enddate redeem_ed " id="date_timepicker_end" type="text" name="enddate" placeholder="End Date" readonly>
									</div>
								</div>
							 </form>
							</div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="search-butn">
							<button class="btn btn-info allsearch">
								search
								<span class="glyphicon glyphicon-search">
								</span>
							</button>
						<div class="image_display" style="display:none;left: 50%;position: absolute;top: -62px; ">
						 <img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
						</div>
						</div>
						</div>
						<div class="under_line_div"></div>
						<div class="no-more-tables sales_total_element3">
             			<?php //echo $this->element('frontend/suppliers/element3'); ?>
					 	</div>
					</div>
				<!-- ********************************* Authenticate Voucher ************************************* -->
				<!-- ********************************* Authenticate Voucher ************************************* -->
				<div id="authenticate" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" style="display: block;">
						<h1>Authenticate & Claim <label>
							<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  22px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title='Suppliers MUST authenticate each and every voucher by entering the unique voucher no. received from the customer for their purchase, and by clicking "Authenticate & Claim" the voucher will be authenticated and if successful, submitted as a claim for payment'/>
						</label></h1>
						<form action="" method="post" id="" >
							<div class="under_line_div"></div>
							<div class="BaseStatus  rhlauth" style="margin-bottom:15px; display:none;">This voucher has been successfully authenticated and may be honoured.</div>
							<div class="col-lg-11 col-sm-12 col-md-12 col-xs-12 padding_0  ">
								
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
											<div class="form-group">
												<label for="voucher_n">Voucher No. <em>* </em>
												<label>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
											<div class="form-group">
												<input type="text" class="form-control required" name="" id="voucher_n">
												<span id="error_voucher_n" style="" class="error"></span>
											</div>
										</div>
									</div>									
								</div>
								<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
											<div class="form-group">
												<label >Upload Voucher
												<label>
														<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  18px; margin-left:3px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title='This is not mandatory and you do not need to upload a voucher for all claims. However, if required and requested to do so, you may need to upload a voucher to allows us to verify a specific voucher or vouchers details'/>
													</label>
												 <label>
											</div>
										</div>
										<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
											<div class="form-group">
												<input id="claim_pdf" type="file" name="pdf" title="This is not mandatory" class="btn-success voucherfile space_doc" style="height:35px;width:100%" id="vfiles" rel="">
												<span id="pdfErrors" style="color:red !important;"  class="error"></span>
											</div>
										<div class="form-group">
												<input type="checkbox"  name="authenticate_only" id = "authenticate_only" value="0"/> Authentication Only
												<img title="Select this option if you only want to verify the authenticity of a voucher without claiming for it" rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  18px;">
										</div>
										</div>
									</div>									
								</div>
															
								<!--........................-->								
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12  col-lg-offset-6 col-sm-offset-6 col-md-offset-6 col-xs-offset-0 padding_0">
									<div class="save_btn">
										<a class="btn btn-primary" id="check_authentication" href="javascript:void(0);">Authenticate & Claim</a>
									</div>
									<div class="image_display" style="display:none;left: 50%;position: absolute;top: -62px; ">
											<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
										</div>
									
								</div>
								<h1 class="new-class-01">Search For Claim 
									<label>
										<img title="Suppliers can search his claims Search results show quickly the vouchers claimed on today's date or any date as well as Voucher Code Total Amount and Claim Status" rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  22px;">
									</label>
								</h1>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<div class="date-time">
										<div class="search_feature">
											<div class="input_round">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
													<input type="text" readonly="" placeholder="Claim date from" name="startdate"  id="date_time_start">
													<input type="hidden" id="hiddenpurchasestartdate">
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 padding_0">
													<input type="hidden" id="hiddenpurchaseenddate">
													<input type="text" readonly="" placeholder="Claim date until" name="enddate"  id="date_time_end">
												</div>
												<span class="glyphicon glyphicon-search claim_search_btn"></span>
											</div>
										</div>						
									</div>			
								</div>
								
							</div>
						</form><!--  Authentication Form Ends    -->
						<div class="claim_totals_element">
							
					 	</div>
					</div>	
					<!-- End Authenticate voucher -->
					<!-- Start tab reconcile-->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="reconcile">
						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0">
							<h1>Claims History
							<label>
							<img rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width: 22px;" title="This shows a history of all claims that you have submitted.">
							</label>
							</h1>									
						</div>
						<div class="under_line_div"></div>
						
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0">
						  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
							<div class="search_feature">
								<div class="input_round_2">
									<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
										<input type="text" placeholder="Search by Customer Name" name="custName" class="claim_custName customInput">
									   <input type="hidden" id="claim_hiddenname">
									   
									</div>
								</div>
							</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">	
							<div class="search_feature">
								<div class="input_round_2">
									<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
										<input type="text" placeholder="Search by Customer E-mail" name="custEmail" class="claim_custEmail customInput">
									   <input type="hidden" id="claim_hiddenemail">
									</div>
								</div>
							</div>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 padding_0 ">
							<div class="search_feature">
							<form id="searchclaimhistory">
								<div class="input_round_2">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_0">
									   <input type="hidden" id="claim_hiddenstartdate">
										<input class="startdate customInput" type="text" id="claim_timepicker_start" name="startdate" placeholder="Purchase date from" >
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding_0">
									   <input type="hidden" id="claim_hiddenenddate">
										<input class="enddate customInput" id="claim_timepicker_end" type="text" name="enddate" placeholder="Purchase date until" >
									</div>
								</div>
							</form>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<h5 class="search-butn">
							<button class="btn btn-info claim_allsearch">
								search
								<span class="glyphicon glyphicon-search">
								</span>
							</button>
						</h5>
						<div class="image_display" style="display:none;left: 50%;position: absolute;top: -62px; ">
						 <img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
						</div>
						</div>
						
						
						<div class="rendered_reconcile">
							<?php //echo $this->element('frontend/suppliers/reconcile'); ?>
						</div>
					</div>
					<!-- End tab reconcile-->
					<!-- ********************************* Sales Made ****************************************** -->
					<!-- ********************************* Sales Made ****************************************** -->
					<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="pages">
						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0">
							<h1>Sales Made</h1>								
						</div>
						<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
							<div class="search_feature">
								<div class="input_round">
									<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
										<input type="text" placeholder="Search by E-mail" name="custEmail" class="custEmail">
										<input type="hidden" id="hiddenemail">
									</div>
									<span class="glyphicon glyphicon-search emlsearch" style="cursor:pointer;"></span>
								</div>
							</div>
						</div>
						<div class="no-more-tables rendered_salemade">
							<?php //echo $this->element('frontend/suppliers/salemade'); ?>
						</div>
					</div>	-->				
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="charts">
						<h1>My Account:</h1>
						<label>Sandeep Soni</label>
						<div class="under_line_div"></div>
						<!-- new business fields -->
						<div class="col-lg-9 col-sm-12 col-md-12 col-xs-12 padding_0 col-lg-offset-1 col-sm-offset-1 col-md-offset-1">
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Business Name<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Address<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
										<div class="form-group">
											<label>Town/City<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Postal Code<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Country<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
										<div class="form-group">
											<label>Website<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Industry Name<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Company Type<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0 ">
										<div class="form-group">
											<label>No. of Location<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12  m_padding_0">
										<div class="form-group">
											<label>Company Registration No.<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>VAT Registration No.<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 m_padding_0">
										<div class="form-group">
											<label>Business Start Date<em>*</em><label>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 padding_0">
										<div class="form-group">
											<input type="text" class="form-control"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-0 padding_0 ">
								<div class="save_btn">
								<a href="javascript:void();" class="btn btn-primary">Save</a>
								<a href="javascript:void();" class="btn btn-success cancel_editing">Cancel</a>
								</div>
							</div>
						</div>						
					</div>
					<!-- ************************************* Archived Deals ****************************************  -->
					<!-- ************************************* Archived Deals ****************************************  -->
					<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="table">
						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0">
							<h1>Archived Deals</h1>	
						</div>
						<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
						   <form id="archiveddeal_search" method="post">
								<div class="search_feature">
									<div class="input_round">
										<div class="col-lg-6  col-sm-6  col-md-6  col-xs-12 padding_0">
											<input class="startdatesrch1 date_timepicker_start" name="startdate" type="text" placeholder="Start Date" >
										</div>
										<div class="col-lg-6  col-sm-6  col-md-6  col-xs-12 padding_0">
											<input class="enddatesrch1 date_timepicker_end" name="enddate" type="text" placeholder="End Date" >
										</div>
										<span class="glyphicon glyphicon-search archiveddeal_search_btn"></span>
									</div>
								</div>
							</form>
						</div>
						<div class="under_line_div"></div>
						<div class="no-more-tables rendered_archiveddeals ">
            			<?php echo $this->element('frontend/suppliers/archived_deal'); ?>							
						</div>						
					</div>-->
					<!-- ************************************* Queued Deals ****************************************  -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="queued">
						<div class="hide_div_block_deal edit_field_div_deal edit_field_div1_deal">
						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0 edit_field_div1_deal">
							<h1>Queued Deals
								<label>
									<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  22px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="These are your deals that you have submitted and are awaiting approval from Admin. They have not been sent out yet and are not live on the website for sale."/>
								</label>
							</h1>	
						</div>
						<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
							<form id="queueddeal_search" method="post">
								<div class="search_feature" style="margin-bottom: 0px;">
									<div class="input_round">
										<div class="col-lg-6  col-sm-6  col-md-6  col-xs-12 padding_0">
											<input class="startdatesrch11 date_timepicker_start" name="startdate" type="text" placeholder="Start Date" >
										</div>
										<div class="col-lg-6  col-sm-6  col-md-6  col-xs-12 padding_0">
											<input class="enddatesrch1 date_timepicker_end" name="enddate" type="text" placeholder="End Date" >
										</div>
										<span class="glyphicon glyphicon-search queueddeal_search_btn"></span>
									</div>
								</div>
							</form>
						</div>
						<div class="under_line_div"></div>
						<div class="no-more-tables rendered_queueddeals ">
            			<?php echo $this->element('frontend/suppliers/queueddeals'); ?>							
						</div>	
						</div>
						<div style="display:none;" class="show_right_div_deal supplier_edit_deal">
						 		<?php //echo $this->element('frontend/suppliers/edit_deal'); ?>														 
						 </div>
					</div>
					<!-- ********************************* Refunds ************************************ -->
					<!-- ********************************* Refunds ************************************ -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="forms">
						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0">
							<h1>Refunds</h1>
						</div>
						<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
							<div class="search_feature">
								<div class="input_round">
									<div class="col-lg-12 col-md-12 col-sm- col-xs-12 padding_0">
										<input type="text" placeholder="E-mail" name="refundEmail" class="refundEmail">
										<input type="hidden" id="hiddenrefundemail">
									</div>
									<span class="glyphicon glyphicon-search emailsearch" style="cursor:pointer;"></span>
								</div>
							</div>
						</div>
						<div class="under_line_div"></div>
						<div class="no-more-tables rendered_refund">
							<?php //echo $this->element('frontend/suppliers/refund'); ?>								
						</div>
					</div>
					<!-- ****************************** Payment History ******************************************* -->
					<!-- ****************************** Payment History ******************************************* -->
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well admin-content" id="library">
						<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 padding_0">
							<h1>Payment History
								<label>
									<img rel="tooltip" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width: 22px;" title="These are your total sales for all vouchers you successfully redeemed within the prescribed period">
								</label>
							</h1>
						</div>
						<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12 padding_0">
							<form id="queueddeal_search" method="post">
								<div class="search_feature" style="margin-bottom: 0px;">
									<div class="input_round">
										<div class="col-lg-6  col-sm-6  col-md-6  col-xs-12 padding_0">
											<input class="startdatesrch11 date_timepicker_start" name="startdate" type="text" placeholder="Start Date" >
										</div>
										<div class="col-lg-6  col-sm-6  col-md-6  col-xs-12 padding_0">
											<input class="enddatesrch1 date_timepicker_end" name="enddate" type="text" placeholder="End Date" >
										</div>
										<span class="glyphicon glyphicon-search payment_search_btn"></span>										
									</div>									
								</div>								
							</form>
						</div>
						<div class="under_line_div"></div>
						
						<div class="no-more-tables rendered_claim">
							<?php //echo $this->element('frontend/suppliers/claim'); ?>								
						</div>
					</div>					
				</div>
			</div>  <!-- end of right tab -->
		</div>
	</div>
	<div id="dtBox"></div>
<!-- End supplier profile area page -->
<script>

function change_price (str,str1,str2) {

	var price = $('.'+str).val();
	var vals;
	var intRegex = /^\d+$/;
	var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
	vals = $('.'+str1).val();
		if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
		{
			$('.'+str2+'_price').val("");
			dis = vals;
			
			if(price != "" && dis !="" && parseInt(dis) <= 100)
			{
				real = price - ((price * dis) / 100);
				var real1 = Math.round(real);
				$('.'+str2+'_price').val(real1);
			}
		}
		else
		{ 
		   $('.'+str2+'_price').val("");
		}
	}
		$(document).ready(function(){
			$('.edit_field_div').click(function(){
				$('.show_right_div').show(500);
				$('.hide_div_block').hide();
				$('.edit_field_div1').hide();
			});
			$('.cancel_editing').click(function(){
				$('.hide_div_block').show(500);
				$('.edit_field_div1').show(500);
				$('.show_right_div ').hide();
			});
			$('.show_pass').click(function(){
				$('.change_pass').show(500);
				$('.show_pass ').hide(500);
			});
			$('.change_pass').click(function(){
				$('.show_pass').show(500);
				$('.change_pass ').hide(500);
			});
		});
</script>
<!--  ************************** Edit deal by gurudutt  Start  ***********              -->
<script>
$(document).ready(function(){
			$(document).on('click','.edit_deal_btn',function(){
				var deal_id=$(this).attr('rel');
				//var target = document.getElementById('loader');
				$(".image_display").show();
		     	$(".image_display").children('img').attr('src',ajax_url+'img/adminImg/loading.gif'); 
		     	$.ajax({
		      	type:'POST',
		      	
		      	url:ajax_url+'Deals/edit_deal/'+deal_id,
		         success:function(resp) 
		         {
		         	//alert(resp)
		         	if(resp == 'success')
		         	{
		         		$('.supplier_edit_deal').html(resp);
			         	$('.show_right_div_deal').show();
			         	$('.edit_field_div1_deal').hide();
		         	}
		         	else
		         	{
		         		$('.supplier_edit_deal').html(resp);
			         	$('.show_right_div_deal').show();
			         	$('.edit_field_div1_deal').hide();
		         	}
		         }
	        });
        });
});
</script>
<!--  ************************** Edit deal by gurudutt  end  ***********              -->
<script>
	$(document).ready(function() {
		$('.msg_from').hover(function(){
			var crnt=$(this);
			$(crnt.children('.del_icon').children('.show_remove')).show();
		},function(){$('.show_remove').hide();});
	});
</script>
		<!-- accordion script -->
<script>
	$(document).ready(function() {
		var navItems = $('.admin-menu li > a');
 		var navListItems = $('.admin-menu li');
 		var allWells = $('.admin-content');
 		var allWellsExceptFirst = $('.admin-content:not(:first)');    
 		allWellsExceptFirst.hide();
 		navItems.click(function(e) {
  			e.preventDefault();
  			navListItems.removeClass('active');
  			$(this).closest('li').addClass('active');        
 			allWells.hide();
  			var target = $(this).attr('data-target-id');
  			$('#' + target).show();
 		});
	});
</script>
<!--    Edit Deal                      -->
<script>
	$(document).ready(function() {
			var target = $(this).attr('edit-id');
  			$('#' + target).show();
 		});
	
</script>
<!-- **************************************************** upload button script *****************   -->
<script type = "text/javascript">
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
</script>
<!-- ************************************************ End upload button script ******************** -->
<!-- ************************************************* hide row script ******************************* -->

<script>
	$( function() {
   	var targets = $( '[rel~=tooltip]' ),
      target  = false,
      tooltip = false,
      title   = false; 
    	targets.bind( 'mouseenter', function() {
      	target  = $( this );
        	tip     = target.attr( 'title' );
        	tooltip = $( '<div id="tooltip"></div>' );
         if( !tip || tip == '' )
            return false;
         target.removeAttr( 'title' );
 	      tooltip.css( 'opacity', 0 )
         .html( tip )
         .appendTo( 'body' );
 			var init_tooltip = function() {
            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                tooltip.css( 'max-width', $( window ).width() / 2 );
            else
                tooltip.css( 'max-width', 340 ); 
            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                pos_top  = target.offset().top - tooltip.outerHeight() - 20; 
            if( pos_left < 0 ) {
                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                tooltip.addClass( 'left' );
            }
            else 
                tooltip.removeClass( 'left' );
            if( pos_left + tooltip.outerWidth() > $( window ).width() ) {
                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                tooltip.addClass( 'right' );
            }
            else
                tooltip.removeClass( 'right' );
            if( pos_top < 0 ) {
                var pos_top  = target.offset().top + target.outerHeight();
                tooltip.addClass( 'top' );
            }
            else
                tooltip.removeClass( 'top' );
 		          tooltip.css( { left: pos_left, top: pos_top } )
                   .animate( { top: '+=10', opacity: 1 }, 50 );
        	}; 
        	init_tooltip();
        	$( window ).resize( init_tooltip );
         var remove_tooltip = function() {
            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function() {
                $( this ).remove();
            }); 
            target.attr( 'title', tip );
        	};
         target.bind( 'mouseleave', remove_tooltip );
 	      tooltip.bind( 'click', remove_tooltip );
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
    	var current_date=year+'/'+month+'/'+day;
			
			$('.startdate_buy').datetimepicker({
				timepicker:false,
				format:'Y-m-d',
				scrollInput:false,
				minDate:current_date,
				onSelectDate:function(selectedDate){ 
				   
				   $(':input[name="data[Deal][redeem_to]"]').val('');
	     			$(':input[name="data[Deal][redeem_from]"]').val('');
	     			 
					$('.enddate_buy').datetimepicker({
						timepicker:false,
						format:'Y-m-d',
						scrollInput:false,
						minDate:selectedDate
				   });
				   $('.startdate_redeem').datetimepicker({
						timepicker:false,
						format:'Y-m-d',
						scrollInput:false,
						minDate:selectedDate
				   })		
				   //$('.enddate_buy').datetimepicker("option", { minDate: $(".startdate_buy").datetimepicker('getDate')})
				   
				
				}
			});
  	 	
	
			$('.enddate_buy').datetimepicker({
				timepicker:false,
				format:'Y-m-d',
				scrollInput:false,
				onSelectDate:function(selectedDate){ 
				   
	     			var buy_from=$(':input[name="data[Deal][buy_from]"]').val();
	     			if(buy_from!='')
	     				var start_redeem_min=new Date(buy_from);
				   else
				   	var start_redeem_min=current_date;
				   	
				   
				   $('.startdate_redeem').datetimepicker({
						timepicker:false,
						format:'Y-m-d',
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
							format:'Y-m-d',
							scrollInput:false,
							minDate:min_redeem_to
					   })	
              }
              else if(enddate_buy!='')
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'Y-m-d',
							scrollInput:false,
							minDate:enddate_buy
					   })
              }				   
				  else if(startdate_redeem!='')
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'Y-m-d',
							scrollInput:false,
							minDate:startdate_redeem
					   })
              }
				   
				   	
				   
				
				}       
			});		
		
	     $('.startdate_redeem').datetimepicker({
				timepicker:false,
				format:'Y-m-d',
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
							format:'Y-m-d',
							scrollInput:false,
							minDate:min_redeem_to
					   })	
              }
              else if(enddate_buy!='')
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'Y-m-d',
							scrollInput:false,
							minDate:enddate_buy
					   })
              }				   
				  else if(startdate_redeem!='')
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'Y-m-d',
							scrollInput:false,
							minDate:startdate_redeem
					   })
              }
              else
              {
              	  $('.enddate_redeem').datetimepicker({
							timepicker:false,
							format:'Y-m-d',
							scrollInput:false,
							minDate:current_date
					   })
              	
              } 
				
				}
			});
  	 	
			
			$('.enddate_redeem').datetimepicker({
				timepicker:false,
				format:'Y-m-d',
				scrollInput:false,
				onSelectDate:function(selectedDate){ 
				
				}       
			});
	 
 	
  	$('.startdatesrch').datetimepicker({
		timepicker:false,
		format:'j M Y',
		scrollInput:false,
		maxDate:current_date
		
	 });	  
	$('.enddatesrch').datetimepicker({
		timepicker:false,
		format:'j M Y',
		scrollInput:false,
		maxDate:current_date
		
	});
	var buyfrom =$(".startdate_buy").val();
	$('.newsletterdate').datetimepicker({
		timepicker:false,
		format:'Y-m-d',
		scrollInput:false,
		minDate:buyfrom
		
	});
});

</script>
<script type = "text/javascript">
	$(document).ready(function(){
		var memb = $('#mem_id').val();
		//$('#editDealForm112').validate({});
 		$('#DealForm').validate({
 		rules: {
		     	"data[Deal][name]": {
		       	remote: {
		        	    url: ajax_url+'deals/unique_deal'
		        	}
		     	},
		     	"data[Deal][category]": {
		     		remote: {
		        	    url: ajax_url+'deals/parent_category'
		        	}
		     	}, 
   
		     	"data2[DealOption][selling_price]": {
		        cus_no:true
		     	},
		     	"data2[Deal][discount]": {
		      	cus_no:true,
		        	range: [0, 100]
		     	},
		     	"data[Deal][delivery_option]": {
		     		required:true,
		     	},
				
				"deal_image[]":
				{
					required:true,
					maxFileSize: 
					{
						"unit": "KB",
						"size": 100
					}
				},
				
	   	},
	   	messages: {
	   		"data[Deal][name]": {
	        		remote:'This deal name already exist'
	     		},
            "data[Deal][category]": {
	        		remote:'Please select any subcategory.'
	     		},
	     		"data2[DealOption][selling_price]": {
	        		required:'required'
	     		},
	     		"data2[Deal][discount]": {
	        		required:'required'
	     		},
	     		"data[Deal][delivery_option]": {
		     			required:'Please select one of these options',
		     	}
	     	},
			
		
			
	});
 	$('#frm').validate({
			rules:
			{
				"data[Member][email]":
				{
					required:true,
					email:true,
					remote:ajax_url+'Suppliers/checkEditMemberEmail/'+memb
				},
			"data[Member1][old_password]":
				{
					required:true,
					remote:ajax_url+'Suppliers/checkPasswordpro/'+memb
				},
         "data[Member1][password]":
				{
					required:true,
					minlength: 6
				},
				"data[Member1][cnf_password]":
				{
					required:true,
					equalTo:'#pwd'
				},
				"data[Member][phone]":
				{
					required:true,
					cus_phone:true
				},
				"data[MemberMeta][landline]":
				{
					required:false,
					cus_phone:true
				},
				
				
			},
			messages:
			{
				"data[Member][email]":
				{
					required:'Please enter email.',
					email:'Please enter valid email.',
					remote:'Email address already exists.'
				},
       "data[Member1][old_password]":
				{
					required:"This field is required.",
					remote: 'Wrong old password.'
				}, 
				"data[Member1][password]":
				{
					required:"This field is required.",
					minlength: 'Password should be atleast 6 characters long.'
				},
				"data[Member1][cnf_password]":
				{
					required:"This field is required.",
					equalTo:'The two new password fields do not match.'
				},
			     
				
			}
		
		
		});
		$.validator.addMethod("cus_phone", function(value, element) {
			var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
			return (!pattern.test(value));
		}, "Not valid  number.");
		$.validator.addMethod("cus_no", function(value, element) {
			var pattern = /[A-Za-z_-£$%&*()}{@#~?><>,|=_¬]+/i;
			return (!pattern.test(value));
		}, "Not valid number.");
		
		
})
</script>

	<!-- Gaurav  -->
<script>
		$(document).ready(function(){
					//........checkbox for edit password..
					if($('#cp').is(':checked'))
					   $('.change_pass2').slideDown();
					else
							$('.change_pass2').slideUp(); 
						$('#cp').on('click',function()
						{
								if($('#cp').is(':checked'))
									$('.change_pass2').slideDown();
								else
								$('.change_pass2').slideUp();
								$('.change_pass2').find(':input').val('');
						});
   
       //--------for optional deal block when we add new deal

         //$('.optional_field1').hide();        
         //$('.optional_field2').hide();
        
       $('.option1').each(function(){
	        if($(this).is(':checked'))
	        {
					$(this).siblings('div.optional_field').slideDown();
	               $(this).siblings('div.optional_field').find('input').addClass('required');
	               
	               $(this).parent('div').next('div').children('div.optional_field').slideDown();
	               $(this).parent('div').next('div').children('div.optional_field').find('input').addClass('required');
	               
	               $(this).parent('div').next('div').next('div').children('div.optional_field').slideDown();
	               $(this).parent('div').next('div').next('div').children('div.optional_field').find('input').addClass('required');

                    $(this).parent('div').next('div').next('div').children('div.optional_field').slideDown();
	               $(this).parent('div').next('div').next('div').children('div.optional_field').find('input').addClass('required');  				   
	            	
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
                              
       
         $(document).on('click','.option1',function(){
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
            	
            	//$(this).parent('div').next('div').children('div.optional_field:nth-child(2)').children().find('.option1_input').addClass('required');
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
            
        });
         
        

        
/*------------------for mydeal on supplier profile----------- function working on page reload*/
		$.ajax({
      	type:'POST',
         url:ajax_url+'Suppliers/mydeal',
         success:function(resp) {
         	$('.mydeal_element2').html(resp); 
				$('.pagination').children().find('.current').addClass('pageactive');
         }
      });
        /*--------- for ajax pagination--------------*/
   	$(document).on('click',".my_deal_pagination a",function(){
      	var currentUrl=$(this).attr("href");
         $.ajax({
		   	type:"POST",
		      url:currentUrl,
		      success:function(result) {
		      	$(".mydeal_element2").html(result);
				   $('.pagination').children().find('.current').addClass('pageactive');
           }
		   });
       	return false;
    	}); 
/* ------------------------------------ For New Letter ------------------------ */
	$.ajax({
      	type:'POST',
         url:ajax_url+'Suppliers/news_letters',
         success:function(resp) {
         	$('.news_letters_element').html(resp); 
				$('.pagination').children().find('.current').addClass('pageactive');
         }
      });
        
   	$(document).on('click',".news_letters_pagination a",function(){
      	var currentUrl=$(this).attr("href");
         $.ajax({
		   	type:"POST",
		      url:currentUrl,
		      success:function(result) {
		      	$(".news_letters_element").html(result);
				   $('.pagination').children().find('.current').addClass('pageactive');
           }
		   });
       	return false;
    	}); 
	
		

/* ------------------------- For News Letter End -------------------------------- */		
/*--------- for mydeal serach on suppliers profile page--------------*/ 
	$('.mydeal_search_btn').on('click',function(){ 
		$(".image_display").show();
	  	$(".image_display").children('img').attr('src',ajax_url+'img/adminImg/loading.gif'); 
      	$.ajax({
	         type:'GET',
	         url:ajax_url+'Suppliers/mydeal',
	         data:$('#mydeal_search').serialize(),
	         success:function(result) {
				$('.image_display').css('display','none');
	             $(".mydeal_element2").html(result);
	         }                 
         });
	});
		 
	
	$(document).on('click','.submitvoucher',function(){
			var id = $(this).prev().val();
			var code = $('#voucherTxt'+id).val();
			var file = $('#vfiles'+id).val();
			var files = new FileReader();
			//alert(id)
			//alert(file)
			if (code !="")
			{	//alert('cd')
					$('#codeErrors'+id).html('');
					
							
								//	$( '#voucher'+id ).submit( function( e ) {
									$.ajax({
											type: 'post',
											url : ajax_url+'Suppliers/check_claim',
											data:{'code':code,'id':id},
											success:function(resps)
											{
													//alert(resp)
													if(resps == "true")
													{
																var pdfname = $('#claim_pdf'+id).val();
																$.ajax({
																		type: 'post',
																		url : ajax_url+'Suppliers/submit_claim',
																		data:{'pdfname':pdfname,'id':id},
																		success:function(resp)
																		{
																			if(resp=="success")
																			{
																					$('#clm'+id).after('<div class="col-md-12 col-sm-12 col-xs-12 "><h6 class="text-center" style="color: #22add6;">Claim has been sent for Cybercoupon approval.</h6></div>');
																					$('#resn'+id).remove();
																					$('#clm'+id).remove();
																					$('#rhlbtn'+id).remove();
																			}
																		}
																});
													}
													else
													{
															$('#codeErrors'+id).html(resps);
													}
											}
									});
								//	});
							
					
					
			}
			else
			{	
					$('#codeErrors'+id).html('This field is required.');
					//document.getElementById("codeErrors"+id).innerHTML='This field is required.';
			}
	})
	
	$(document).on('change','.space_doc',function(e) {
			var id = $(this).attr('id');
			var n = $(this).attr('rel');
			//alert(n);return false;
            file = document.getElementById(id);
            //file = $(this).files;
            var type = file.value.substring(file.value.lastIndexOf('.') + 1);
            type = type.toUpperCase();
            if (type != 'PDF') {
                //alert('file not supported format');
				$('#pdfErrors'+n).html('Accept pdf file only.');
				$(this).val('');
                return false;
            }
            var data = new FormData();
            data.append('pdf', file.files[0]);
            var request = new XMLHttpRequest();
           // $('#loader').show();
            var target = document.getElementById('loader');
           // var spinner = new Spinner(opts).spin(target);
		   
		   url = ajax_url+'Suppliers/upload_claim_pdf';
			var request = new XMLHttpRequest();
			//alert(request.Data);
            request.open('POST', url);
			//alert(request);
            request.send(data);
		   
		    request.onreadystatechange = function() {
                if (request.readyState == 4 ) 
				{
					//var resp = JSON.parse(request.response);
					//   $('#loader').hide();
                    //console.log(request.status + ': ' + request.responseText);
					//   document.getElementById("txtHint").innerHTML=request.responseText;
					$('#pdfErrors'+n).html('');
					//alert(request.responseText);
					$('#claim_pdf'+n).val(request.responseText);
					//alert('Transfer complete.');						
                }
            };
            
        });
		
		$(document).on('click','.submit_reason',function(){
				var id = $(this).prev().val();
				var reason = $('#reason_'+id).val();
				var thisObj = $(this);
				//alert(reason)
				$('#reasonErrors'+id).html('');
				if(reason!="")
				{
						$.ajax({
								type: 'post',
								url : ajax_url+'Suppliers/submit_refund',
								data:{'reason':reason,'id':id},
								success:function(resp)
								{
									if (resp=="success") {
											$('#clm'+id).after('<div class="col-md-12 col-sm-12 col-xs-12 "><h6 class="text-center" style="color: #22add6;">Refund request is sent for Cybercoupon approval.</h6></div>');
											$('.refundmsg_'+id).siblings('h6').html('Refund request is sent for Cybercoupon approval.');
											$('#resn'+id).remove();
											$('#clm'+id).remove();
											$('#rhlbtn'+id).remove();
									}
									else {
										$('#reasonErrors'+id).html(resp);
									}
								}
						});
				}
				else
				{
						$('#reasonErrors'+id).html('This field is required.');
				}
		});
	/**** FOR Authentication CHECKBOX IF CHECKED OR NOT **********/
		$("input#authenticate_only").change(function(){
			if($(this).is(':checked'))
			{
				$('#authenticate_only').val('1');
			}
			else
			{
				$('#authenticate_only').val('0');
			}
		});
	/********************** ******************/	
		// authenticate tab functionality
		$('#check_authentication').on('click',function(){
				var voucherNo = $('#voucher_n').val();
				var pdfname = $('#claim_pdf').val();
				var auth_only = $('#authenticate_only').val();
				$('#error_voucher_n').html('');
				$('#error_authenticate_n').html('');
				if(voucherNo!="")
				{
				$(".image_display").show();
				$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
						$.ajax({
								type:"POST",
								url : ajax_url+'Suppliers/check_authentication',
								data:{'voucherNo':voucherNo,'pdfname':pdfname,'auth_only':auth_only},
								success:function(result)
								{
									$('.image_display').css('display','none');
									if(result=="true")
										{
											$('#claim_pdf').val('');
											$('.rhlauth').show();
											setTimeout( function() {$('.rhlauth').hide();}, 4*1000);
										}
										else
										{
											$('#error_voucher_n').html(result);
										}
								}
						});
				}
				else
				{ 
						if(voucherNo=="")
						{
								$('#error_voucher_n').html('This field is required.');
						}
						else
						{
								$('#error_voucher_n').html('');
						}
						/*if(securityNo=="")
						{
								$('#error_authenticate_n').html('This field is required.');
						}
						else
						{
								$('#error_authenticate_n').html('');
						}*/
				}
		});
	/*-----------for Archived Deals on supplier profile----(promatics)----- function working on page reload*/
	$(document).on('click',".archivedAnchor",function(){
		$(".rendered_archiveddeals").css({'opacity':'0.2'});
		$.ajax({
			type:"POST",
			url : ajax_url+'Suppliers/archived_deals',
			success:function(result) {
				$(".rendered_archiveddeals").html(result);
				$('.pagination').children().find('.current').addClass('pageactive');
				$(".rendered_archiveddeals").css({'opacity':'1'});
				// $(".dynaColor").css({'color':'#7f7f7f'});
			}
		});      
   });   
	$(document).on('click',".my_archived_pagination a",function(){
      	var currentUrl=$(this).attr("href");
         $.ajax({
		   	type:"POST",
		      url:currentUrl,
		      success:function(result) {
		      	$(".rendered_archiveddeals").html(result);
				   $('.my_archived_pagination').children().find('.current').addClass('pageactive');
           }
		   });
       	return false;
   });
    /*--------- For Archived Deal Serach on suppliers profile page--------------*/ 
	$('.archiveddeal_search_btn').on('click',function(){ 
      	$.ajax({
	         type:'GET',
	         url:ajax_url+'Suppliers/archived_deals',
	         data:$('#archiveddeal_search').serialize(),
	         success:function(result) {
	             $(".rendered_archiveddeals").html(result);
	         }                 
         });
	});
	/*-----------for Queued Deals on supplier profile----(promatics)----- function working on page reload*/
	$(document).on('click',".queuedAnchor",function(){
		$(".rendered_queueddeals").css({'opacity':'0.2'});
		$.ajax({
			type:"POST",
			url : ajax_url+'Suppliers/queued_deals',
			success:function(result) {
				$(".rendered_queueddeals").html(result);
				$('.pagination').children().find('.current').addClass('pageactive');
				$(".rendered_queueddeals").css({'opacity':'1'});
				// $(".dynaColor").css({'color':'#7f7f7f'});
			}
		});      
   });   
	$(document).on('click',".my_queued_pagination a",function(){
      	var currentUrl=$(this).attr("href");
         $.ajax({
		   	type:"POST",
		      url:currentUrl,
		      success:function(result) {
		      	$(".rendered_queueddeals").html(result);
				   $('.my_queued_pagination').children().find('.current').addClass('pageactive');
           }
		   });
       	return false;
   });
    /*--------- For queued Deal Serach on suppliers profile page--------------*/ 
	$('.queueddeal_search_btn').on('click',function(){ 
	$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
      	$.ajax({
	         type:'GET',
	         url:ajax_url+'Suppliers/queued_deals',
	         data:$('#queueddeal_search').serialize(),
	         success:function(result) {
			 $('.image_display').css('display','none');
	             $(".rendered_queueddeals").html(result);
	         }                 
         });
	});
	
	/*--------upload again pdf --------*/
	$(document).on('click','.submitvoucher1',function(){
			var id = $(this).prev().val();
			var file = $('#vfiles'+id).val();
			$('#pdfErrors'+id).html('');
			if (file !="") {
				var pdfname = $('#claim_pdf'+id).val();
				$.ajax({
						type: 'post',
						url : ajax_url+'Suppliers/resubmit_claim_pdf',
						data:{'pdfname':pdfname,'id':id},
						success:function(resp)
						{
							if (resp=="success")	{
								$('#vfiles'+id).val('');
								$('#vfiles'+id).after('<span id="" style="color:green !important;"  class="succ_msg lok">Voucher uploaded successfully.</span>');
								setTimeout( function() {$('.lok').hide();}, 4*1000);								
							}
						}
				});
			}
			else {
				$('#pdfErrors'+id).html('This field is required');
			}
	})
	
	$(document).on('click','.submitvoucher2',function(){
			var id = $(this).prev().val();
			var file = $('#vfiles'+id).val();
			$('#pdfErrors'+id).html('');
			if (file !="") {
				var pdfname = $('#claim_pdf'+id).val();
				$.ajax({
						type: 'post',
						url : ajax_url+'Suppliers/resubmit_reason_pdf',
						data:{'pdfname':pdfname,'id':id},
						success:function(resp)
						{
							if (resp=="success")	{
								$('#vfiles'+id).val('');
								$('#vfiles'+id).after('<span id="" style="color:green !important;"  class="succ_msg lok">Voucher uploaded successfully.</span>');
								setTimeout( function() {$('.lok').hide();}, 4*1000);								
							}
						}
				});
			}
			else {
				$('#pdfErrors'+id).html('This field is required');
			}
	})
	/*   Refund   */
	$('.pagination').children().find('.current').addClass('pageactive');
       $(document).on('click',".refund_pagination a",function(){
       	var currentUrl=$(this).attr("href");
			var email1 = $('.refundEmail').val();
			$(".rendered_refund").css({'opacity':'0.2'});
			var email = $('#hiddenrefundemail').val();
			//alert(email)
           $.ajax({
		        type:"POST",
		       url:currentUrl,
			  // url : ajax_url+'Suppliers/refund',
			  data:{'email':email},
		        success:function(result)
		        {
					$(".rendered_refund").html(result);
				    $('.pagination').children().find('.current').addClass('pageactive');
					$(".rendered_refund").css({'opacity':'1'});
				}
		     });
       return false;
    }); 	
	$(document).on('click',".refundAnchor",function(){
			$(".rendered_refund").css({'opacity':'0.2'});
			$.ajax({
		        type:"POST",
				url : ajax_url+'Suppliers/refund',
		        success:function(result)
		        {
					$(".rendered_refund").html(result);
					 $('.pagination').children().find('.current').addClass('pageactive');
					 $(".rendered_refund").css({'opacity':'1'});
					// $(".dynaColor").css({'color':'#7f7f7f'});
				}
		    });
      
    }); 
    $(document).on('click','.emailsearch',function(){
				var email = $('.refundEmail').val();
				$('#hiddenrefundemail').val(email);
				$(".rendered_refund").css({'opacity':'0.2'});
				$.ajax({
								type:"POST",
								url : ajax_url+'Suppliers/refund',
								data:{'email':email},
								success:function(result)
								{
										$(".rendered_refund").html(result);
										$('.pagination').children().find('.current').addClass('pageactive');
										$(".rendered_refund").css({'opacity':'1'});
								}
						});
			 
		});
		
    $('.refundEmail').keyup(function(e) {
			//alert('hi')
			if (e.which == 13) {
				var email = $('.refundEmail').val();
				$('#hiddenrefundemail').val(email);
				$(".rendered_refund").css({'opacity':'0.2'});
				$.ajax({
								type:"POST",
								url : ajax_url+'Suppliers/refund',
								data:{'email':email},
								success:function(result)
								{
										$(".rendered_refund").html(result);
										$('.pagination').children().find('.current').addClass('pageactive');
										$(".rendered_refund").css({'opacity':'1'});
								}
				});
			}
		});
		/*  ************************  Claim ******************  */
		$('.pagination').children().find('.current').addClass('pageactive');
       $(document).on('click',".claim_pagination a",function(){
       	var currentUrl=$(this).attr("href");
			var email1 = $('.claimEmail').val();
			$(".rendered_refund").css({'opacity':'0.2'});
			var email = $('#hiddenclaimemail').val();
			//alert(email)
           $.ajax({
		        type:"POST",
		       url:currentUrl,
			  // url : ajax_url+'Suppliers/claim',
			  data:{'email':email},
		        success:function(result)
		        {
					$(".rendered_claim").html(result);
				    $('.pagination').children().find('.current').addClass('pageactive');
					$(".rendered_claim").css({'opacity':'1'});
				}
		     });
       return false;
    }); 	
	$(document).on('click',".claimAnchor",function(){
			$(".rendered_refund").css({'opacity':'0.2'});
			$.ajax({
		        type:"POST",
				url : ajax_url+'Suppliers/claim',
		        success:function(result)
		        {
					$(".rendered_claim").html(result);
					 $('.pagination').children().find('.current').addClass('pageactive');
					 $(".rendered_claim").css({'opacity':'1'});
					// $(".dynaColor").css({'color':'#7f7f7f'});
				}
		    });
      
    }); 
    $(document).on('click','.emailclaimsearch',function(){
				var email = $('.claimEmail').val();
				$('#hiddenclaimemail').val(email);
				$(".rendered_claim").css({'opacity':'0.2'});
				$.ajax({
								type:"POST",
								url : ajax_url+'Suppliers/claim',
								data:{'email':email},
								success:function(result)
								{
										$(".rendered_claim").html(result);
										$('.pagination').children().find('.current').addClass('pageactive');
										$(".rendered_claim").css({'opacity':'1'});
								}
						});
			 
		});
		
    $('.claimEmail').keyup(function(e) {
			//alert('hi')
			if (e.which == 13) {
				var email = $('.claimEmail').val();
				$('#hiddenclaimemail').val(email);
				$(".rendered_claim").css({'opacity':'0.2'});
				$.ajax({
								type:"POST",
								url : ajax_url+'Suppliers/claim',
								data:{'email':email},
								success:function(result)
								{
										$(".rendered_claim").html(result);
										$('.pagination').children().find('.current').addClass('pageactive');
										$(".rendered_claim").css({'opacity':'1'});
								}
				});
			}
		});
		/*  reconcile tab */
	
	
	/*$(document).on('click','#reconcile_sent',function(){
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		$.ajax({
	        type:'post',
	        url:ajax_url+'Business/update_status_sent_reconcile',
	        success:function(result) {
	            if (result =="success") {
					$.ajax({
						type:'post',
						url:ajax_url+'Business/reconcile_all',
						//data:$('#archiveddeal_search').serialize(),
						success:function(result) {
							$(".rendered_reconcile").html(result);
							$('.reconcile_success').html('Your request sent successfully.').css('border','1px solid #39B053');
							$('.reconcile_success').show();
							$('#mask').remove();
							setTimeout( function() {$('.reconcile_success').html(''); $('.reconcile_success').hide();}, 4*1000);	
						}                 
					});
				}
	         }                 
         });
	});*/
	
	$(document).on('click','#reconcile_account_msg',function(){
		//alert('sdf')
		$('.reconcile_success').html('Sorry! First fill your account detail.').css({'border':'1px solid #FF0015','background-color':'#F8E2E9','color':'#ff0015'});
		$('.reconcile_success').show();
		setTimeout( function() {$('.reconcile_success').html(''); $('.reconcile_success').hide();}, 4*1000);
	});
	
	$(document).on('click','.total_sales_tab',function(){
		$(".sales_total_element3").css({'opacity':'0.5'});
		$.ajax({
	      	type:'POST',
	         url:ajax_url+'Suppliers/sales_total',
	         success:function(resp) {
	         	$('.sales_total_element3').html(resp); 
					$('.pagination').children().find('.current').addClass('pageactive');
					$(".sales_total_element3").css({'opacity':'1'});
	         }
	      });
   });
        /*--------- for ajax pagination--------------*/
   	$(document).on('click',".sales_total_pagination a",function(){
      	var currentUrl=$(this).attr("href");
         $.ajax({
		   	type:"POST",
		      url:currentUrl,
		      success:function(result) {
		      	$(".sales_total_element3").html(result);
				   $('.pagination').children().find('.current').addClass('pageactive');
           }
		   });
       	return false;
    	});
});
jQuery(function(){

 jQuery('.date_timepicker_start').datetimepicker({
  format:'j M Y',
  formatDate:'j M Y',
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('.date_timepicker_end').val()?jQuery('.date_timepicker_end').val():false
   })
  },
  timepicker:false
 });
 jQuery('.date_timepicker_end').datetimepicker({
  format:'j M Y',
  formatDate:'j M Y',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('.date_timepicker_start').val()?jQuery('.date_timepicker_start').val():false
	
	 })
  },
  timepicker:false
 });
 
 $('.mselect').multiselect({
		includeSelectAllOption: false
 });
	
	
	$('.cancel_editing').click(function(){
		$('#DealForm').find("input[type=text], textarea").val("");
		
	})				
	jQuery(function(){
	 jQuery('#date_timepicker_start').datetimepicker({
	  format:'j M Y',
	  formatDate:'j M Y',
	  onShow:function( ct ){
	   this.setOptions({
		maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
	   })
	  },
	  timepicker:false
	 });
	 jQuery('#date_timepicker_end').datetimepicker({
	  format:'j M Y',
	  formatDate:'j M Y',
	  onShow:function( ct ){
	   this.setOptions({
		minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():true
		
		 })
	  },
	  timepicker:false
	 });
	});
	/*************************** Redeemed Vouchers searching by Gurudutt Sharma *****************************************/
	$(".allsearch").click(function()
	{
		var dealName=$(".custName").val();
		var startdate=$("#date_timepicker_start").val();		
		var enddate=$('#date_timepicker_end').val();		
		$(".sales_total_element3").css({'opacity':'0.2'});
		$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
		$.ajax({
			type:"Post",
			url :ajax_url+"Suppliers/sales_total",
			data:{'dealName':dealName,'startdate':startdate,'enddate':enddate},
			success:function(result)
			{
				$('.image_display').css('display','none');
				$(".sales_total_element3").html(result);
				$('.pagination').children().find('.current').addClass('pageactive');
				$(".sales_total_element3").css({'opacity':'1'});
			}			
		});
	});
	/*************************** Payment history searching by Gurudutt Sharma *****************************************/
	$(".payment_search_btn").click(function()
	{
		var startdate=$(this).parent().find('input.startdatesrch11').val();
		var enddate=$(this).parent().find('input.date_timepicker_end').val();	
		$(".rendered_claim").css({'opacity':'0.2'});
		$(".image_display").show();
	 	$(".image_display").children('img').attr('src',ajax_url+'img/adminImg/loading.gif'); 
		$.ajax({
			type:"Post",
			url :ajax_url+"Suppliers/claim",
			data:{'startdate':startdate,'enddate':enddate},
			success:function(result)
			{
				$('.image_display').css('display','none');
				$(".rendered_claim").html(result);
				$('.pagination').children().find('.current').addClass('pageactive');
				$(".rendered_claim").css({'opacity':'1'});
			}			
		});
	});
	
	
	
	
	
	
	
	//.................start jquery at claim history tab.

		jQuery(function(){
		 jQuery('#claim_timepicker_start').datetimepicker({
		  format:'j M Y',
		  formatDate:'j M Y',
		  onShow:function( ct ){
		   this.setOptions({
		    maxDate:jQuery('#claim_timepicker_end').val()?jQuery('#claim_timepicker_end').val():false
		   })
		  },
		  timepicker:false
		 });
		 jQuery('#claim_timepicker_end').datetimepicker({
		  format:'j M Y',
		  formatDate:'j M Y',
		  onShow:function( ct ){
		   this.setOptions({
		    minDate:jQuery('#claim_timepicker_start').val()?jQuery('#claim_timepicker_start').val():false
			
			 })
		  },
		  timepicker:false
		 });
		});
	
	
	$(document).on('click','.reconcileAnchor',function(){
		$.ajax({
	        type:'post',
	        url:ajax_url+'Business/reconcile_all',
	        //data:$('#archiveddeal_search').serialize(),
	        success:function(result) {
	            $(".rendered_reconcile").html(result);
	         }                 
         });
	})
	/*--------- for ajax pagination--------------*/
	$(document).on('click',".claim_history_paging a",function(){
        var currentUrl=$(this).attr("href");
		var email = $('#claim_hiddenemail').val();
		var name = $('#claim_hiddenname').val();
		var startdate = $('#claim_hiddenstartdate').val();
		var enddate = $('#claim_hiddenenddate').val();
           $.ajax({
		        type:"POST",
		        url:currentUrl,
				data:{'email':email,'name':name,'startdate':startdate,'enddate':enddate},
		        success:function(result)
		        {
					$(".rendered_reconcile").html(result);
					$('.claim_history_paging').children().find('.current').addClass('pageactive');
           }
		     });
       return false;
    });
		
	/******************For Clicking Search Button Coded By Shivam Chauhan**************/	
	
	$(document).on('click','.claim_allsearch',function()
	{
		var email = $('.custEmail').val();
		var name = $('.claim_custName').val();
		var startdate = $('#claim_timepicker_start').val();
		var enddate = $('#claim_timepicker_end').val();
		$('#claim_hiddenemail').val(email);
		$('#claim_hiddenname').val(name);
		$('#claim_hiddenstartdate').val(startdate);
		$('#claim_hiddenenddate').val(enddate);
		$(".rendered_reconcile").css({'opacity':'0.2'});
		$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
		$.ajax({
				type:"POST",
				url : ajax_url+'Business/reconcile_all',
				data:{'email':email,'name':name,'startdate':startdate,'enddate':enddate},
				success:function(result)
				{   
					$('.image_display').css('display','none');
					$(".rendered_reconcile").html(result);
					$('.claim_history_paging').children().find('.current').addClass('pageactive');
					$(".rendered_reconcile").css({'opacity':'1'});
				}
		});
		 
	});
	
	/******************After Entering Customer Email Coded By Shivam Chauhan**************/	
	
	$('.claim_custEmail').keyup(function(e) {
		if (e.which == 13) {
			var email = $('.claim_custEmail').val();
			var name = $('.claim_custName').val();
			var startdate = $('#claim_timepicker_start').val();
			var enddate = $('#claim_timepicker_end').val();
			$('#claim_hiddenemail').val(email);
			$('#claim_hiddenname').val(name);
			$('#claim_hiddenstartdate').val(startdate);
			$('#claim_hiddenenddate').val(enddate);
			$(".rendered_reconcile").css({'opacity':'0.2'});
			$.ajax({
					type:"POST",
					url : ajax_url+'Business/reconcile_all',
					data:{'email':email,'name':name,'startdate':startdate,'enddate':enddate},
					success:function(result)
					{
						$(".rendered_reconcile").html(result);
						$('.claim_history_paging').children().find('.current').addClass('pageactive');
						$(".rendered_reconcile").css({'opacity':'1'});
					}
			});
		}
	});
	
	/****************** After Entering Customer Name Coded By Shivam Chauhan **************/	
	
	$('.claim_custName').keyup(function(e) {
		if (e.which == 13) {
			var email = $('.custEmail').val();
			var name = $('.claim_custName').val();
			var startdate = $('#claim_timepicker_start').val();
			var enddate = $('#claim_timepicker_end').val();
			$('#claim_hiddenemail').val(email);
			$('#claim_hiddenname').val(name);
			$('#claim_hiddenstartdate').val(startdate);
			$('#claim_hiddenenddate').val(enddate);
			$(".rendered_reconcile").css({'opacity':'0.2'});
			$.ajax({
					type:"POST",
					url : ajax_url+'Business/reconcile_all',
					data:{'email':email,'name':name,'startdate':startdate,'enddate':enddate},
					success:function(result)
					{
						$(".rendered_reconcile").html(result);
						$('.claim_history_paging').children().find('.current').addClass('pageactive');
						$(".rendered_reconcile").css({'opacity':'1'});
					}
			});
		}
	});


	
	//.................end jquery at claim history tab.
				
});

/*************** searching for Authentication Coded By shivam Chauhan ****************/
jQuery(function(){
	 jQuery('#date_time_start').datetimepicker({
	  format:'j M Y',
	  formatDate:'j M Y',
	  onShow:function( ct ){
	   this.setOptions({
		maxDate:jQuery('#date_time_end').val()?jQuery('#date_time_end').val():false
	   })
	  },
	  timepicker:false
	 });
	 jQuery('#date_time_end').datetimepicker({
	  format:'j M Y',
	  formatDate:'j M Y',
	  onShow:function( ct ){
	   this.setOptions({
		minDate:jQuery('#date_time_start').val()?jQuery('#date_time_start').val():true
		
		 })
	  },
	  timepicker:false
	 });
	});
$(document).ready(function() {
	$(document).on('click','.claim_search_btn',function(){
		var startdate = $('input#date_time_start').val();
		var enddate = $('input#date_time_end').val();
		$(".claim_totals_element").css({'opacity':'0.5'});
		$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
		$.ajax({
	      	type:'POST',
			data:{'startdate':startdate,'enddate':enddate},
			url:ajax_url+'Suppliers/authenticate_total',
			success:function(resp) {
			$('.image_display').css('display','none');				
					$('.claim_totals_element').html(resp); 
					$('.pagination').children().find('.current').addClass('pageactive');
					$(".claim_totals_element").css({'opacity':'1'});
			}
		});
	});
	
	$(document).on('click',".claims_total_pagination a",function(){
		var currentUrl=$(this).attr("href");
		var startdate = $('input#date_time_start').val();
		var enddate = $('input#date_time_end').val();
		$.ajax({
			type:"POST",
			data:{'startdate':startdate,'enddate':enddate},
			url:currentUrl,
			success:function(result) {
				$(".claim_totals_element").html(result);
				$('.pagination').children().find('.current').addClass('pageactive');
			}
		});
		return false;
	});
	/* ------------------------------------------ Selling price on New Deal Start -----------------------------------------------------------------  */
		 
		$(document).on('input','.sellingprice',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			$('.makeDiscount').each(function(){
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
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
				else
				{ 
				   $('#discount1').val('');
				}
			})
     })
     
     $(document).on('input','.makeDiscount,.sellingprice',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			var price = $('.sellingprice').val();
	  			vals = $(this).val();
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
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
				else
				{ 
				   $('#discount1').val('');
				}
			
      })
		$(document).on('input','.discounted2_price',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			$('.selling_price2').each(function(){
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
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
				else
				{ 
				   $('#discount2').val('');
				}
			})
     })
     
     $(document).on('input','.selling_price2,.discounted2_price',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			var price = $('.discounted2_price').val();
	  			vals = $(this).val();
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
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
				else
				{ 
				   $('#discount2').val('');
				}
			
      })
		$(document).on('input','.selling_price3',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			$('.discounted3_price').each(function(){
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
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
				else
				{ 
				   $('#discount3').val('');
				}
			})
     })
     
     $(document).on('input','.discounted3_price,.selling_price3',function(){
  			var vals;
  			var price;
  			var intRegex = /^\d+$/;
			var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;
  			var price = $('.selling_price3').val();
	  			vals = $(this).val();
				if(vals != "" && (intRegex.test(vals) || floatRegex.test(vals)))
				{
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
				else
				{ 
				   $('#discount3').val('');
				}
			
      })
	
	
});
	
</script>
<style>
.input_round{
width:100%;
}
.search_feature .input_round input, .search_feature .input_round input[type="text"]{
	 background: none repeat scroll 0 0 #f5f5f5;
    border: 0 none;
    color: #777;
    font-style: italic;
    margin: 4px 8px 3px;
    width: 94%;
}
.alerter{
text-align:center;
}
</style>