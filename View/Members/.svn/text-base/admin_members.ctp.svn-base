<?php  echo $this->Html->script('backend/development/ui.datepicker.js');?>		 
<script id="js">
$(function(){	

		
$(".tablesorter-header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');
$(".rmv_sort").children("span").removeClass('ui-icon');
$(".rmv_sort").children("span").css("margin-top",'12px');
});

 //jQuery.noConflict();
	$(function() {
	var year = (new Date()).getFullYear()
	var current_date= new Date();
	$(".datepicker").datepicker({
		dateFormat:'dd M yy',
		yearRange:'1950:'+year,
		changeMonth: true, 
		changeYear: true,
		//maxDate:current_date
		
	});
	})
	$(function() {
		var year = (new Date()).getFullYear()
		var current_date= new Date();
		$(".buy_from").datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			//maxDate:current_date,
			onClose: function( selectedDate ) {
			   $( ".buy_to" ).datepicker( "option", "minDate", selectedDate );
		    }
		});
	})
	$(function() {
		var year = (new Date()).getFullYear() + 5;
		var current_date= new Date();
		$(".buy_to").datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
			//minDate:current_date
			//maxDate:current_date
			onClose: function( selectedDate ) {
            $( ".buy_from" ).datepicker( "option", "maxDate", selectedDate );
        }
		});
	})
	

</script>
<style>
.member_search_management input
{
	height:25px;
	width:200px;
}
.member_search_management select
{
	padding:5px;
	width:200px;
}
.admin_search
{
	min-height:75px;
}
.search_input
{
	float:left;
	/*width:350px;*/
	//width:271px;
	
	//margin-bottom:10px;
	//text-align:right;
}
.sub-bttn { border: 1px solid #DDDDDD;
    color: #851A1A;
    cursor: pointer;
    float: left;
    font-size: 12.5px;
    font-weight: bold;
    height: auto;
    margin-left: 13px;
    outline: medium none;
    padding: 7px 6px 6px;
    text-align: center;
    width: 61px;}
</style>
<script type="text/javascript">
function searching()
{
		var member_type = $('#member_type').val();

	   var t = new Date().getTime();
			t =t.toString();
			$(".image_display_search").show();
			$(".image_display_search").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	$.ajax({
		url:ajax_url+'admin/Members/members/'+member_type,
		type:'post',
		data:$("#search").serialize(),
		success:function(resp)
		 {
		   $('.image_display_search').css('display','none');
		   $('.search_list').html(resp);
		 }
	});
	return false;
}

</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
<?php
if($member_type=='2')
{
    if($subadmin_type==1||@$modulepermissions['Members']['module_edit']==1) 
	{
?>
     <a href="<?php echo HTTP_ROOT.'admin/Members/addMember/'.base64_encode(convert_uuencode($member_type));?>" class="ui-state-default ui-corner-all float-right ui-button">Add Company-User</a>
<?php
	}
}
?> 
<?php
if($member_type=='4')
{
    if($subadmin_type==1||@$modulepermissions['Members']['module_edit']==1) 
	{
?>
		<a href="<?php echo HTTP_ROOT.'admin/Members/add_customers/'.base64_encode(convert_uuencode($member_type));?>" class="ui-state-default ui-corner-all float-right ui-button" style="margin-left:10px;">Add Customers</a>
		<a href="<?php echo HTTP_ROOT.'admin/Members/upload_customers/'.base64_encode(convert_uuencode($member_type));?>" class="ui-state-default ui-corner-all float-right ui-button">Upload Customers</a>
	
<?php
	}
}
?>
 <?php /*   <a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:1px; margin-left:10px;" href="<?php echo HTTP_ROOT.'admin/Members/generate_csv/'.base64_encode(convert_uuencode($member_type));?>">Generate CSV</a>				
			<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:1px; margin-left:200px;" href="<?php echo HTTP_ROOT.'admin/Members/generate_xsl/'.base64_encode(convert_uuencode($member_type)); ?>">Generate XSL</a>			
*/ ?>
			<div class="inner-page-title">
				<h2>
     <?php 
     if($member_type=='3')
     {
        echo 'Suppliers';
     }
     else if($member_type=='2')
     {
        echo 'Company Users';
     }
     else
     {
         echo 'Users';
     }
     ?>
    </h2>
                
				<div style="float:left; margin-top:-16px; height:20px; margin-left:200px;">
				<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:200px; float:left; border:0px;"> - 1st step approval <b>/</b> 2nd step approval</span>
				<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - Edit Member</span>
				<span class="ui-icon ui-icon-circle-close" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:93px; float:left; border:0px;"> - Delete Member</span>
				<span class="ui-icon ui-icon-lightbulb" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:120px; float:left; border:0px;"> - Status of Member</span>
				
				</div>
               <!-- <a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:21px; margin-right:-7px;" href="<?php echo HTTP_ROOT.'admin/Members/generate_csv'?>">Generate CSV</a>-->
               <span></span>
			</div>
            <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
			<?php } ?>	
          <div class="response-msg success ui-corner-all send_success" style="display: none;">
					<span>Success message</span>
					OTP has been send successfully.
  			</div>	
			<div class="id_cont admin_search member_search_management" style="margin-bottom:15px; float:left" >
                       
            <form  method="post" action="" id="search">
                <?php
				if($member_type =='3')
				{
				?>
				<div class="search_input">	
					<label>Business Name</label>
					<input id="input_name" type="text"  name="data[MemberMeta][business_name]" onkeyup = "return handle(event);"/>
                </div>
				<?php 
				}
				else
				{
				?>
				<div class="search_input">	
					<label>First Name</label>
					<input id="input_name" type="text"  name="data[Member][name]" onkeyup = "return handle(event);"/>
                </div>
				<div class="search_input">	
					<label>Surname</label>
					<input id="input_name" type="text"  name="data[Member][surname]" onkeyup = "return handle(event);"/>
                </div>
				<?php 
				}
				?>
               <input type="hidden" id="member_type" value="<?php echo base64_encode(convert_uuencode($member_type));?>">
               <div class="search_input">	
					<label>Email</label>
					<input id="input" type="text"  name="data[Member][email]" onkeyup = "return handle(event);"/>
                </div>
				<?php if($member_type !='2') { ?>
                <div class="search_input">	
					<label>City</label>
					<input id="input" type="text"  name="data[Member][city]" onkeyup = "return handle(event);"/>
                </div>
				<?php } ?>
				<?php if($member_type !='3' && $member_type !='2') { ?>  
				<div class="search_input">	
                	<label >Newsletter</label>
						<select name="data[Member][news_location]">
							<option value="">All</option>
							<?php if(!empty($cities)) {
							foreach($cities as $cty) { ?>
								<option value="<?php echo $cty['Location']['id'];?>"><?php echo $cty['Location']['name'];?></option>
						<?php } } ?>
						</select>
							
				</div>
				
				<?php } ?>
				         <input type="hidden" name="data[Member][language]" id="check123"  />
			  <?php if($member_type =='3') { ?>
				<div class="search_input">	
					<label >Status</label>
					<select style="width:200px;" name="data[Member][status]">
						<option value="all">All</option>
						<option value="Active">Active</option>
						<option value="Suspended">Suspended</option>
						<option value="3" selected="">1st step pending</option>
						<option value="2">2nd step pending</option>
					</select>
				</div>
			<?php } elseif($member_type =='2') { ?>
			<div class="search_input">	
					<label >Status</label>
					<select style="width:200px;" name="data[Member][status]">
						<option value="">Select</option>
						<option value="Active">Active</option>
						<option value="Inactive">Pending</option>
						<option value="unsuspended">Unsuspended</option>
						<option value="suspended">Suspended</option>
					</select>
			</div>
			<?php } else {?>
			<div class="search_input">	
					<label >Status</label>
					<select style="width:200px;" name="data[Member][status]">
						<option value="">Select</option>
						<option value="Active">Active</option>
						<option value="Inactive">Inactive</option>
					</select>
			</div>
			<?php } ?>
			
			  <div class="search_input">	
					<label>From</label>
					<input id="startDate" class="field text startdate buy_from " style=" border-radius: 3px;  padding:1px; height:25px;width:200px;"  type="text"  name="data[Member][registered]" readonly="readonly" onkeyup = "return handle(event);"/>
			</div>
				
			<div class="search_input">	
				<label>To</label>
				<input id="endDate" class="field text endDate buy_to " type="text" style=" border-radius: 3px;  padding:1px; height:25px;width:200px;" name="data[Member][register_to]" readonly="readonly"  onkeyup = "return handle(event);"/>
			</div>
               
                <div class="submit_search_button" style="position:relative;float:left;">
				 
				 
					<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:29px;float: right;" />
					
					<div class="image_display_search" style="display:none;left: 40%;position: absolute;top: -62px; ">
					 <img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
					</div>
                </div>
            </form>
            </div>
            
            <div class="content-box content-box-header search_list sales_total_pagination" style="border:none;">
            <?php
				echo $this->element('backend/Members/members_list');
            ?>
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
