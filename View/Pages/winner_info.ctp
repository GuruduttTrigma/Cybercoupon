<?php //pr($this->params);die; ?>
<style> 
	select.full {
		padding:4px;
	}
</style>
<div class="login_wrapper">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="new_user_area">
		<?php ?> 	
			<div class="login_heading" >
				<h1>
					<span class=""></span>
					<?php 
						if(isset($content)) {										
							echo $content['CmsPage']['page_title'];
						}
					?>
				</h1>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 terms" style="word-wrap: break-word" >
				<p >
					<?php 
						if(isset($content)) {										
							echo $content['CmsPage']['content'];
						}
						else {							
							echo 'Data is not available.';
						}		
					?>
				</p>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">			
			<div style="text-align:center; margin-top: 22px;">
							<img  src="<?php echo IMPATH.'CMS/'.$content['CmsPage']['image'];?>" height="200" width="200"/>
			</div>	
			</div>
		<?php  ?>	
		</div>
	</div>
</div>