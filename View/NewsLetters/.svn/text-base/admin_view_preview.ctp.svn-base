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
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">        
			<div class="inner-page-title">
				<h2>NewsLetter Preview</h2>
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
					<div class="search_input">	
						<label>Title</label>
						<input id="input_name" type="text"  name="data[Deal][name]" onkeyup = "return handle(event);"/>
					</div>
					<div class="search_input">	
						<label>Description</label>
						<input id="input" type="text"  name="data[Deal][description]" onkeyup = "return handle(event);"/>
					</div>
					<div class="search_input">	
						<label >Location</label>
						<select style="width:200px;" name="data[Deal][location]">
							<option value="">Select</option>
							<?php foreach($loc as $list){ ?>
								<option value="<?php echo $list['Location']['id'];?>"><?php echo $list['Location']['name'];?></option>
							<?php } ?>
						</select>
					</div>
               <div class="id_cont admin_search member_search_management" style="margin-bottom:15px; float:left" ></div>
					<div class="submit_search_button" style="position:relative;float:left;">
							<input type="button" onclick="searching();"  value="Filter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
							<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
									<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
							</div>
					</div>
				</form>
            </div>
				<div class="clearfix"></div>
				<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
