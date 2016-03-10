<script>
$(document).ready(function() {
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
			}
		});
	});
</script>
<style>
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
.imagepreview:nth-child(2n+1)
{
	margin: 0 0 10px;
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
	.imagepreview:nth-child(2n+1)
	{
		margin: 0 0 10px 10px;
	}
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
	<input type="hidden" id="availImages" value=" <?php echo $i; ?>"/>