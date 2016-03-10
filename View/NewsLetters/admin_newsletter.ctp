<script type="text/javascript">
	function searching() {
		$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
		$.ajax({
			url:ajax_url+'admin/NewsLetters/newsletter',
			type:'post',
			data:$("#search").serialize(),
			success:function(resp) {
				$('.image_display').css('display','none');
				$('.search_list').html(resp);
			}
		});
		return false;
	}
	
	$(document).ready(function () {
		$("#message_form").validate(
		{ 
			submitHandler: function(form) {
				$("#loader").css('visibility','visible');
				$.ajax({
					url:ajax_url+'admin/NewsLetters/sendEmail',
					type:'post',
					data:$("#message_form").serialize(),
					success:function(resp) { 
						if(resp == 'success') {
						
							$("#loader").css('visibility','hidden');
							$('#success_msg').css('visibility','visible');
						}else {
							alert('An Error Ocurred!');
						}
					}
				});
			return false;
			} 
        });

		
		$('.msg_show').click(function() {
		
			$("#msg_popup").show();
			var name = $(this).next('input[name=user_name]').val();
			var email = $(this).next().next('input[name=user_email]').val();
			$('#userName').val(name);
			$('#email').val(email);
			$('#success_msg').css('visibility','hidden');
			var $div = jQuery('<div />').appendTo('body');
			$div.attr('class', 'mask');
			jQuery(".mask").show();
		});
		$(".cancl").click(function (){
			
			$("#msg_popup").hide();
			$('.mask').remove();
			//$('.form-radio').attr('checked', false);
			document.getElementById("message_form").reset();
		});
		
		//.......................cancel newsletter setting
		$('.popup_checkbox').each( function(index, vlaue)
		{
			if($(this).is('checked'))
			{
				var select_value=$(this).attr('rel');
				var split_value=select_value.split('_');
				var person_type=split_value[0];
				var box_type=split_value[1];
				if(box_type=='yes')
				{
					$("."+person_type+"_div").show();
				}
				else
				{
					$("."+person_type+"_div").hide();
				}
			}
		});
		
		
		$('.popup_checkbox').click(function(){
				var select_value=$(this).attr('rel');
				var split_value=select_value.split('_');
				var person_type=split_value[0];
				var box_type=split_value[1];
				if(box_type=='yes')
				{
					$("."+person_type+"_div").show();
				}
				else
				{
					$("."+person_type+"_div").hide();
				}
		})
		
		
		
		
		//......................end of cancel newsletter pop up
		
	});

</script>
<style>
.search_input {
    float: left;
    margin-bottom: 10px;
    text-align: right;
    width: 282px;
}
.pop_center2 {
    background-color: #fff;
    border-bottom: 1px solid #d9d9d9;
    float: left;
    height: auto;
    padding: 9px 17px;
    text-align: left;
    width: 474px;
}
.pop_center3 {
    background-color: #ececec;
    border-top: 1px solid #fff;
    float: left;
    padding: 15px 17px;
    text-align: left;
    width: 474px;
}

.pop_center1 {
    float: left;
    height: auto;
    margin: 0;
    padding: 0;
    text-align: center;
}
.mask {
    background-image: url("../../img/backend/pop_base.png");
    float: left;
    left: 0;
    margin: 0 auto;
    min-height: 100%;
    position: fixed;
    text-align: center;
    top: 0;
    width: 100%;
    z-index: 10001;
}
.log_block_width {
    position: absolute;
    right: 566px;
    top: 150px;
    z-index: 2147483647;
}
.pop_inner {
    margin: auto;
    width: 522px;
}
a.pop_cerrar {
    float: right;
    height: auto;
    padding: 0;
    text-align: left;
    width: auto;
}
.pop-up-heading{
float:left;
width:auto;
background:#ECECEC;
text-align:center;
font-size:18px;
color:#006cad;
margin-bottom:25px;
}
.pop-up-heading_other{
float:left;
width:100%;
background:#ECECEC;
text-align:center;
font-size:18px;
color:006cad;
margin-bottom:20px;
}
.div_input {
    float: left;
    margin: 0 auto;
    max-width: 200px;
    width: 100%;
}
.yes-div{
   float: left;
    text-align: center;
    width: 50%;

}
.mail-div{
float:left;
width:100%;
text-align:center;
margin-top:15px;
}
.form-box{
float:left;
width:100%;
}
#loader {
	display: inline-block;
    margin-top: -27px;
    width: auto;
	visibility:hidden;
}
#success_msg {
color:green;
display: inline-block;
margin-top: 5px;
width: auto;
visibility:hidden;
}
#success_msg img {
    float: left;
    margin-right: 3px;
    margin-top: -2px;
}
</style>

<div class="pop_inner log_block_width" id="msg_popup" style="display:none;">
	    <div class="pop_center1"><img src="<?php echo HTTP_ROOT;?>img/top_pop.png" width="522" height="11" /></div>
		<form action="" id="message_form" name="message_form" method="post" >
			<input type="hidden" name="userName" id="userName" value="">
			<div class="pop_center2" style="width: 488px">
				<span class="pop_c2_a"> <span id="sender_name"></span></span>
				<a href="javascript: void(0);" class="pop_cerrar cancl"><img src="<?php echo HTTP_ROOT;?>img/cerrar.png" width="16" height="15" /></a>
			</div>
			
			<div class="pop_center3" style="width: 488px;">
				<div class="new-class-75">
				<div class="pop-up-heading" >
					<h1 style="float: left; width: auto;">Send Email to Supplier</h1>
				</div>
				<div>
					<div class="yes-div">
						<input type="radio" name="supplier_selection" class="popup_checkbox" rel="supplier_yes" value="yes" checked="true">
						<label>
							Yes
						</label>
					</div>
					<div class="yes-div">
						<input type="radio" name="supplier_selection" class="popup_checkbox" rel="supplier_no" value="no">
						<label>
							No
						</label>
					</div>
				</div>
				</div>
				<div class="new-class-75">
				<div class="pop-up-heading_other" >
					<h1 style="float: left; width: auto;color:#006cad;">Send Email to Sales Person</h1>
				</div>
				<div>
					<div class="yes-div_sales">
						<input type="radio" name="salesperson_selection" class="popup_checkbox" rel="sales_yes" value="yes" checked="true">
						<label>
							Yes
						</label>
					</div>
					<div class="yes-div">
						<input type="radio" name="salesperson_selection" class="popup_checkbox" rel="sales_no" value="no">
						<label>
							No
						</label>
					</div>
				</div>
				</div>
				<!--<div class="pop-up-heading_other">
					<h1>Are you sure you want to send email ?</h1>
				</div>-->
				<div class="div_input" style="float: left;margin: 0 auto;width: 100%;">
					
					<div class="mail-div">
						<div class="form-box supplier_div">
							<div class="new-class-76">
							<label class="pop_cen5_c label_email" style="float:left;">Supplier Email:</label>
							</div>
							<div class="new-class-77">
							<input name="supplier_email" id="email" style="width:220px;" type="text" class="pop_cen5_d required email" />
							</div>
						</div>
						<div class="form-box sales_div">
							<div class="new-class-76">
							<label class="pop_cen5_c label_sales" style="float:left;" >Salesperson Email:</label>
							</div>
							<div  class="new-class-77">
							<input name="salesperson_email" style="width:220px;"  type="text" class="pop_cen5_d required email" />
							</div>
						</div>
						<div class="form-box">
							<div  class="new-class-76">
							<label class="pop_cen5_c" style="float:left;margin-top:10px;">Other Email:</label>
							</div>
							<div  class="new-class-77">
							<input style="width:220px;" name="otherEmail" type="email" class="pop_cen5_d email" />
							</div>
							<input type='hidden' name='hidden' id='hidden' value='' class='hidden'>
						</div>
						<div class="form-box">
							<div  class="new-class-76">
							<label class="pop_cen5_c" style="float:left;margin-top:10px;">Reason:</label>
							</div>
							<div  class="new-class-77">
							<textarea style="width:220px;min-height:50px;resize:vertical;" class= "required" name = "reason"></textarea>
							</div>
						</div>
						<div class="form-box" style="margin-top:10px;text-align:left;">
						<label>&nbsp;</label>
							<input type="submit" id="submit" name="submit"  class="send" value="Send">
						</div>
						<span id = "loader"><img src= "<?php echo HTTP_ROOT;?>img/backend/loader.gif"></span>
						<span id = "success_msg"><img src= "<?php echo HTTP_ROOT;?>/img/test-pass-icon.png">Mail Has been sent successfully!!</span>
					</div>
				</div>
				
			</div>
		</form>
	</div>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">        
			<div class="inner-page-title">
				<h2>Create Newsletters (approve & select ads)</h2>
            <!--<div style="float:left; margin-top:-16px; height:20px; margin-left:200px;">
				<span class="ui-icon ui-icon-bookmark" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:100px; float:left; border:0px;"> - Add To NewsLetter</span>
				</div>-->
            <span></span>
			</div>
         <?php if($this->Session->check('success')){ ?>
			<div class="response-msg success ui-corner-all">
				<span>Success message</span>
				<?php echo $this->Session->read('success');?>
			</div>
			<?php unset($_SESSION['success']); ?>
			<?php } ?>	            
			<div class="id_cont admin_search member_search_management" style="margin-bottom:0px; float:left" >
               <form  method="post" action="" id="search">
					<!--<div class="search_input">	
						<label>Description</label>
						<input id="input" type="text"  name="data[Deal][description]"/>
					</div>-->
					<?php 
					if($this->Session->check('cNews'))
					{
						$condition = $this->Session->read('cNews');
					}
					?>
					<div class="search_input">	
						<label >Location</label>
						<select style="width:200px;" name="data[Deal][location]">
							<option value="">Select</option>
							<?php foreach($loc as $list){ ?>
								<option value="<?php echo $list['Location']['id'];?>"><?php echo $list['Location']['name'];?></option>
							<?php } ?>
						</select>
					</div>
					<div class="search_input">	
						<label >Category</label>
						<select style="width:200px;" name="data[Deal][category]">
							<option value="">Select</option>
							<?php 
                  	foreach ($deal_category as $cat_id=>$cat_name)
                  	{
                  		
							?>
							     <option value="<?php echo $cat_id;?>">
								     <?php echo $cat_name; ?>
								  </option>
							<?php
							} 
							?>
						</select>
					</div>
					<div class="search_input">	
						<label>Supplier Email</label>
						<input id="input_name" type="text"  name="data[Member][email]" onkeyup = "return handle(event);"/>
					</div>
					<div class="search_input">	
						<label>Deal Title</label>
						<input id="input_name" type="text"  name="data[Deal][name]" onkeyup = "return handle(event);"/>
					</div>
               <div class="id_cont admin_search member_search_management" style="margin-bottom:15px; float:left" ></div>
					<div class="submit_search_button" style="position:relative;float:left;">
							<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
							<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
									<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
							</div>
					</div>
				</form>
            </div>            
            <div class="content-box content-box-header search_list sales_total_pagination" style="border:none;">
            <?php
					echo $this->element('backend/NewsLetter/newsletter_list');
            ?>
				</div>
				<div class="clearfix"></div>
				<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>

<style>
.new-class-75{width: 100%; float: left;}
.pop-up-heading_other{width: auto;}
.yes-div{width: 50px;}
.pop-up-heading{min-width: 243px;}
.pop-up-heading_other{min-width: 250px;}
.yes-div_sales{width: 50px; float: left;}
.div_input{max-width: 100%;}
.form-box label{min-width: 80px; text-align: left; }
.form-box{margin: 5px 0; }
.new-class-76{min-width: 130px; float: left;}
.new-class-77{width: auto; float: left;}
.new-class-77 input{width: 100%;}
.new-class-77 .error{width: 100%; float: left;clear: both; min-width: 100%;}
</style>


