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
	width:285px;
	
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
.lopa{
	 float: left;
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 20px;
    width: 100%;
}
</style>
<!--
<script>
	$( function() {
   	var targets = $( '[rel~=tooltip]' ),
      target  = false,
      tooltip = false,
      title   = false; 
    	targets.bind( 'mouseenter', function() {
      	target  = $( this );
        	tip     = target.attr( 'title' );
        	tooltip = $( '<div id="tooltip"></div>' );
         if( !tip || tip == '' )
            return false;
         target.removeAttr( 'title' );
 	      tooltip.css( 'opacity', 0 )
         .html( tip )
         .appendTo( 'body' );
 			var init_tooltip = function() {
            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                tooltip.css( 'max-width', $( window ).width() / 2 );
            else
                tooltip.css( 'max-width', 340 ); 
            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                pos_top  = target.offset().top - tooltip.outerHeight() - 20; 
            if( pos_left < 0 ) {
                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                tooltip.addClass( 'left' );
            }
            else 
                tooltip.removeClass( 'left' );
            if( pos_left + tooltip.outerWidth() > $( window ).width() ) {
                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                tooltip.addClass( 'right' );
            }
            else
                tooltip.removeClass( 'right' );
            if( pos_top < 0 ) {
                var pos_top  = target.offset().top + target.outerHeight();
                tooltip.addClass( 'top' );
            }
            else
                tooltip.removeClass( 'top' );
 		          tooltip.css( { left: pos_left, top: pos_top } )
                   .animate( { top: '+=10', opacity: 1 }, 50 );
        	}; 
        	init_tooltip();
        	$( window ).resize( init_tooltip );
         var remove_tooltip = function() {
            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function() {
                $( this ).remove();
            }); 
            target.attr( 'title', tip );
        	};
         target.bind( 'mouseleave', remove_tooltip );
 	      tooltip.bind( 'click', remove_tooltip );
    	});
	});
</script>-->
<script type="text/javascript">
/*function searching()
{
	
	var dt = $('#Datepic').val();
	if (dt != "") {
		$(".image_display").show();
		$(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
		$.ajax({
			url:ajax_url+'admin/Business/reconcilation',
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
}

$(function() {
	var year = (new Date()).getFullYear()
	var current_date= new Date();
	var upto = '<?php echo $payupto; ?>';
	
	$( ".datepicker" ).datepicker({
		dateFormat:'dd M yy',
		yearRange:'2013:'+year,
		changeMonth: true, 
		changeYear: true,
		maxDate:current_date,
		<?php if($payupto!="") { ?>
		minDate: upto
		<?php } ?>
	})
})*/
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
	      <!--<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:5px; margin-right:5px;" href="<?php echo HTTP_ROOT.'admin/Manages/generate_csv'?>">Generate CSV</a>-->
				<div class="inner-page-title">
					<h2>Payment List 
						<label>
							<img style=" border: 1px solid #22add6;border-radius: 20px;cursor: pointer;padding: 3px;width:  10px;" src="<?php echo HTTP_ROOT;?>img/frontend/tooltip.png" rel="tooltip" title="Displays details of deals for this supplier only for the date range selected"/>
						</label>					
					</h2> 
					   
					<a class="ui-state-default ui-corner-all float-right ui-button" style="margin-top:-10px; margin-right:10px;" onclick="history.go(-1)" href="javascript:void(0)">Back</a>
				 	
               </div>
            <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
				<?php } ?>	
				<!--<span class="lopa">
					<?php if($payupto!="") { ?>
						You release the last payment upto <?php //echo $payupto; ?>.
					<?php } else { ?>
						No payment released yet.
					<?php } ?>
				</span>
				<div class="id_cont admin_search  member_search_management" style="margin-bottom:0px; float:left" >
					<form  method="post" action="" id="search">
						<input type="hidden" name="data[Deal][member_id]" value="<?php //echo base64_encode(convert_uuencode($supplier_id)); ?>" />
						<div class="search_input">	
							<label>Pay up to </label>
							<input id="Datepic" class="field text datepicker" type="text"  name="data[OrderDealRelation][payment_on]" readonly="readonly"  />
						</div>
						<div class="submit_search_button" style="position:relative;float:left;">
							<input type="button" onclick="searching();"  value="Filter" class="sub-bttn" style="width:85px; height:34px;float: right;" />
							<div class="image_display" style="display:none;left: 40%;position: absolute;top: -62px; ">
								<img src="" style="margin-left:65px;margin-top: 67px;width: 36%; "/>
							</div>
						</div>
					</form>
				</div>-->
				
			<input type="hidden" value="<?php echo  base64_encode(convert_uuencode($supplier_id)); ?>" id="supId" />
            <div class="content-box content-box-header search_list" style="border:none;">
	            <?php
						echo $this->element('backend/Business/reconcile_deal_list');
	            ?>
			</div>
				<div class="clearfix"></div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
</div>
<div class="clear"></div>

