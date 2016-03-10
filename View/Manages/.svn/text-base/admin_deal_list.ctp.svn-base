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
	width:290px;
	margin-bottom:10px;
	text-align:right;
}
.sub-bttn { border: 1px solid #DDDDDD;
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
    width: 61px;}
</style>
<script type="text/javascript">
function searching()
{
	      var t = new Date().getTime();
			t =t.toString();
			$(".image_display").show();
			$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	$.ajax({
		url:ajax_url+'admin/Manages/deal_list',
		type:'post',
		data:$("#search").serialize(),
		success:function(resp)
		 {
		$('.image_display').css('display','none');
		 $('.search_list').html(resp);
		 }
	});
	return false;
}

</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
        <!--	<a href="<?php echo HTTP_ROOT ?>admin/Manages/addDeal" class="ui-state-default ui-corner-all float-right ui-button">Add Deal</a> -->
        <!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:5px; margin-right:5px;" href="<?php echo HTTP_ROOT.'admin/Manages/generate_csv'?>">Generate CSV</a>-->
				<div class="inner-page-title">
				<h2>Deals List/Report</h2>    
				<div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
				<!--<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - View Deal</span>
				<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - Edit Deal</span>
				<span class="ui-icon ui-icon-circle-close" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:93px; float:left; border:0px;"> - Delete Deal</span>
				<span class="ui-icon ui-icon-lightbulb" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:120px; float:left; border:0px;"> - Status of Deal</span>
				-->				
				</div>
            <span></span>
			</div>
            <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
			<?php } ?>	
            
			<div class="id_cont admin_search  member_search_management" style="margin-bottom:0px; float:left" >
                       
            <form  method="post" action="" id="search">
                
				<!--<div class="search_input ">	
						<label>Name</label>
						<input id="input_name" type="text"  name="data[Deal][name]"/>
    </div>-->
            <div class="search_input">	
					<label>Start</label>
					<input id="startDate" style=" border-radius: 3px;  padding:1px; height:25px;width:200px;" class="field text datepicker" type="text"  name="data[Deal][buy_from]" readonly="readonly" onkeyup = "return handle(event);"/>
				</div>
					
				<div class="search_input">	
					<label style="margin-left:16px" >End</label>
					<input id="endDate" style=" border-radius: 3px;  padding:1px; height:25px;width:200px;"  class="field text datepicker" type="text"  name="data[Deal][buy_to]" readonly="readonly"  onkeyup = "return handle(event);"/>
				</div>
				<div class="search_input">	
					<label style="margin-left:16px" >Sales Person</label>
					<select id = "choose_sales_person" name = "data[Deal][SalesPersonName]">
						<option value = "">Select Sales Person</option>
						<?php if ($sales_persons != '' && !empty($sales_persons)) :
							foreach($sales_persons as $sales_person):
						?>
							<option value = "<?php echo $sales_person['Member']['name'].' '. $sales_person['Member']['surname'];?>" > <?php echo $sales_person['Member']['name'].' '. $sales_person['Member']['surname'];?></option>
						<?php 
							endforeach;
						endif;
						?>
					</select>
					<!--<input type="text" onkeyup="return handle(event);" name="data[Deal][name]" id="input_name">-->
				</div>

     <!--<div class="search_input">	
						<label>Status</label>
						<select name="data[Deal][active]" style="width:200px;">
							<option value="">Select</option>   
							<option>Yes</option>   
							<option>No</option>   
						</select>
    </div>-->
              
	         <div class="submit_search_button" style="position:relative;float:left;">
				 
				 
					<input type="button" onclick="searching();"  value="Enter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
					
					<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
					 <img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
					</div>
                </div>
            </form>
            </div>
            
            <div class="content-box content-box-header search_list" style="border:none;">
            <?php
				echo $this->element('backend/Manages/deals_list_list');
            ?>
			</div>
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>

