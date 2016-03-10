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

</style>
<?php $i= 0;
foreach ($dealimage as $image):?>
	<div class="form-group imagepreview">
		<img  src="<?php echo IMPATH.'deals/'.$image['DealImage']['image_name'];?>" height="200" width="200"/>
		<a class="file_close del_link" href="javascript:void(0)" rel ="<?php echo $image['DealImage']['id'];?>"><img src="<?php echo HTTP_ROOT;?>img/file_close.png" /></a>
		<input type="checkbox" class = "checkbox_list" name = "main_image" value = "<?php echo $image['DealImage']['image_random']?>"<?php if($image['DealImage']['image_type']=='M'):?>checked <?php endif;?>/>
	</div>
<?php $i++;endforeach;?>
	<div id="edit_uploadedImages">
							
	</div>
	<input type="hidden" id="availImages" value=" <?php echo $i; ?>">