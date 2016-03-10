<style>
.admin_search {
    margin-top:10px;
    min-height: 45px;
}
.search_input {
    float: left;
    /*margin-bottom: 10px;*/
    text-align: right;
    width: auto;
}
</style>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">        
			<div class="inner-page-title">
				<h2>Approved and not sent</h2>
            <span></span>
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
				echo $this->element('backend/NewsLetter/daily_newsletter_list');
            ?>
			</div>
			<div class="clearfix"></div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
<script>
$('.news_loaction').change(function(){
	var loc=$(this).val();
	var url=ajax_url+'admin/NewsLetters/preview/'+loc;
	var email_prevurl=ajax_url+'admin/NewsLetters/email_preview/'+loc;
	var dispatch_url=ajax_url+'admin/NewsLetters/dispatched/'+loc;
	$('.preview_a').attr('href',url);
	$('.email_preview_action').attr("action",email_prevurl);
	$('.dispatch_action').attr("action",dispatch_url);
})

</script>
