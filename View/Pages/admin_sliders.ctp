
<script type="text/javascript">
function searching()
{
	      var t = new Date().getTime();
			t =t.toString();
			$(".image_display").show();
			$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	$.ajax({
		url:ajax_url+'admin/Pages/sliders',
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
        <a href="<?php echo HTTP_ROOT ?>admin/Pages/addSlider" class="ui-state-default ui-corner-all float-right ui-button">Add Slider</a> 
			<div class="inner-page-title">
				<h2>Sliders</h2>
                
				<div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
				<span class="ui-icon ui-icon-search" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - View Slider</span>
				<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - Edit Slider</span>
				<span class="ui-icon ui-icon-circle-close" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:93px; float:left; border:0px;"> - Delete Slider</span>
				<span class="ui-icon ui-icon-lightbulb" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:120px; float:left; border:0px;"> - Status of Slider</span>
				
				</div>
               <!-- <a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:21px; margin-right:-7px;" href="<?php echo HTTP_ROOT.'admin/Manages/generate_csv'?>">Generate CSV</a>-->
               <span></span>
			</div>
            <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
			<?php } ?>	
            
			<!--<div class="id_cont admin_search Deal_search_management" style="margin-bottom:0px; float:left" >
                       
            <form  method="post" action="" id="search">
                
				<div class="search_input">	
						<label>Title</label>
						<input id="input_name" class="field text" type="text"  name="data[Slider][title]"/>
    			</div>
            
              
	         <div class="submit_search_button" style="position:relative;float:left;">
					 
					<input type="button" onclick="searching();"  value="Filter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
					
					<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
					 <img src="" style="margin-left:5px;margin-top: 67px;width: 36%; "/>
					</div>
                </div>
            </form>
            </div>-->
            
            <div class="content-box content-box-header search_list" style="border:none;">
            <?php
				echo $this->element('backend/Pages/sliders_list');
            ?>
			</div>
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>

