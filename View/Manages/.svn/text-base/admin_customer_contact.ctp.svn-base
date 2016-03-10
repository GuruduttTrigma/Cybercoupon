<style>
	.member_search_management input {
		height:25px;
		width:200px;
	}
	.member_search_management select {
		padding:5px;
		width:200px;
	}
	.admin_search {
		min-height:75px;
	}
	.search_input {
		float:left;
		/*width:350px;*/
		width:295px;
		margin-bottom:10px;
		text-align:right;
	}
	.sub-bttn { 
		border: 1px solid #DDDDDD; 
		color: #851A1A;
		cursor: pointer;
		float: left;
		font-size: 12.5px;
		font-weight: bold;
		height: 12px;
		margin-left: 13px;
		outline: medium none;
		padding: 7px 6px 6px;
		text-align: center;
		width: 61px;
	}
</style>
<script type="text/javascript">
function searching() {
	var member_type = $('#member_type').val();
    var t = new Date().getTime();
	t =t.toString();
	$(".image_display").show();
	$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	 $.ajax({
		url:ajax_url+'admin/Manages/customer_contact/'+member_type,
		url:ajax_url+'admin/Manages/customer_contact/'+member_type,
		type:'post',
		data:$("#search").serialize(),
		success:function(resp) {
		//	alert(resp)
		$('.search_list').html(resp);
		$(".image_display").hide();
		}
	}); 
	return false;
}
function clear_filter() {
	$(".image_display").show();
	$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	 $.ajax({
		url:ajax_url+'admin/Members/clear_member_filter',
		type:'post',
		data:'',
		success:function(resp) {
			var resp=$.trim(resp);
			if(resp=='done') {
				window.location.href=ajax_url+"admin/Members/members";
			}
		}		
	}); 
	return false;
}
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        	<!--<a href="<?php echo HTTP_ROOT ?>admin/Manages/addcustomer" class="ui-state-default ui-corner-all float-right ui-button">Contact us</a>-->
			<div class="inner-page-title">
				<h2>
					<?php 
						if($member_type=='4') { 
							echo ucfirst('Customer'); 
						}
						else if($member_type=='3') { 
							echo ucfirst('Supplier'); 
						}
						else if($member_type=='2') { 
							echo ucfirst('User'); 
						}
						else { 
							echo 'Contact-Us';
						} 
					?> List
				</h2>
                <div style="float:left; margin-top:-16px; height:20px; margin-left:185px;">
					<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - View Contact</span>
					<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - Edit Contact</span>
					<span class="ui-icon ui-icon-circle-close" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:93px; float:left; border:0px;"> - Delete Contact</span>
					<!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:1px; margin-left:10px;" href="<?php echo HTTP_ROOT.'admin/Manages/generate_csv'?>">Generate CSV</a>				
					<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:1px; margin-left:200px;" href="<?php echo HTTP_ROOT.'admin/Manages/generate_xsl'?>">Generate XSL</a>	-->							
				</div>                
				<span></span>
			</div>
			<div class="id_cont admin_search member_search_management" style="margin-bottom:15px;" >          
				<form  method="post" action="" id="search">    
					<label>Name</label>
					<input id="input_name" type="text"  name="data[Customer][name]" onkeyup = "return handle(event);"/>
					<input type="hidden" id="member_type" value="<?php echo base64_encode(convert_uuencode($member_type));?>">
					<label>Email</label>
					<input id="input_name" type="text"  name="data[Customer][email]" onkeyup = "return handle(event);"/>
					<div style="margin-left:500px; margin-top:-30px;">
						<input type="button" onclick="searching();" value="Filter" class="sub-bttn" style="width:75px; height:30px; border:1px solid #d5d5d5;" />
						<div class="image_display" style="display:none;">
              				<img src="" style="margin-left:150px;margin-top: -30px;"/>
                 		</div>
					</div>
				</form>
			</div>
            <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
			<?php } ?>	                  
            <div class="content-box content-box-header search_list" style="border:none;">
				<?php
					echo $this->element('backend/Manages/customer_list');
				?>
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
