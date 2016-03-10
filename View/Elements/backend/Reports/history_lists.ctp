<?php 
	echo $this->Html->script('backend/development/ui.datepicker.js');
?>
<script id="js">$(function(){
	var pagerOptions = {
		container: $(".pager"),
		ajaxUrl: null,
		ajaxProcessing: function(ajax){
			if (ajax && ajax.hasOwnProperty('data')) {
				return [ ajax.data, ajax.total_rows ];
			}
		},
		updateArrows: true,
		page: 0,
		size: 10,

		removeRows: false,

		cssNext: '.next', // next page arrow
		cssPrev: '.prev', // previous page arrow
		cssFirst: '.first', // go to first page arrow
		cssLast: '.last', // go to last page arrow
		cssGoto: '.gotoPage', // select dropdown to allow choosing a page

		cssPageDisplay: '.pagedisplay', // location of where the "output" is displayed
		cssPageSize: '.pagesize', 
		cssDisabled: 'disabled' 
	};

	$("table")
		.tablesorter({
			theme: 'blue',
			widgets: ['zebra']
		})
		.bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
			var msg = '" event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') +
				' page ' + (c.page + 1) + '/' + c.totalPages;
			$('#display')
				.append('<li>"' + e.type + msg + '</li>')
				.find('li:first').remove();
		})
		.tablesorterPager(pagerOptions);
		$('button:contains(Add)').click(function(){
			// add two rows
			var row = '<tr><td>StudentXX</td><td>Mathematics</td><td>male</td><td>33</td><td>39</td><td>54</td><td>73</td><td><button class="remove" title="Remove this row">X</button></td></tr>' +
				'<tr><td>StudentYY</td><td>Mathematics</td><td>female</td><td>83</td><td>89</td><td>84</td><td>83</td><td><button class="remove" title="Remove this row">X</button></td></tr>',
				$row = $(row);
			$('table')
				.find('tbody').append($row)
				.trigger('addRows', [$row]);
		});

		$('table').delegate('button.remove', 'click' ,function(){
			var t = $('table');
			$(this).closest('tr').remove();
			t.trigger('update');
		});

		$('button:contains(Destroy)').click(function(){
			var $t = $(this);
			if (/Destroy/.test( $t.text() )){
				$('table').trigger('destroy.pager');
				$t.text('Restore Pager');
			} else {
				$('table').tablesorterPager(pagerOptions);
				$t.text('Destroy Pager');
			}
		});

		$('.toggle').click(function(){
			var mode = /Disable/.test( $(this).text() );
			$('table').trigger( (mode ? 'disable' : 'enable') + '.pager');
			$(this).text( (mode ? 'Enable' : 'Disable') + 'Pager');
		});
		$('table').bind('pagerChange', function(){
			// pager automatically enables when table is sorted.
			$('.toggle').text('Disable Pager');
		});
$(".tablesorter-header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');
$(".rmv_sort").children("span").removeClass('ui-icon');
$(".rmv_sort").children("span").css("margin-top",'12px');
});

 //jQuery.noConflict();
	$(function() {
	var year = (new Date()).getFullYear()
	var current_date= new Date();
	$( ".datepicker" ).datepicker({
		dateFormat:'dd M yy',
		yearRange:'1950:'+year,
		changeMonth: true, 
		changeYear: true,
		maxDate:current_date
	});
	})

</script>
	<div id="page-content">
		<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
			<div class="hastable">
			 <?php /*?><?php echo $this->element('adminElements/table_head'); ?><?php */?>
				<table id="sort-table"> 
					<thead> 
						<tr>
							<!--<th style="width:auto;">S.no.</th>-->
							<th style="width:auto;">Payment Release Date</th>
							<th style="width:auto;">Total</th>
							<th style="width:auto;">Status</th>
							<th style="width:auto;">Action</th>
							<!--<th style="width: 160px;" class="rmv_sort">Action</th> -->
						</tr> 
					</thead> 
					<tbody> 
					
						<?php	
						if(!empty($history_detail))
						{					
							foreach($history_detail as $data):	
							$i = 1;
							$pay_release_id = base64_encode(convert_uuencode($data['PaymentRelease']['id']));
						?>
					<tr>
						<!--<td>
						<?php 
							//echo $i;
						?>
						</td>-->
						<td style = "text-align:center;"><?php echo date('d F Y',strtotime($data['PaymentRelease']['payment_date']));?></td>
						<td style = "text-align:center;"><?php echo $data['PaymentRelease']['total_amt'];?></td>
						<td style = "text-align:center;"><?php if($data['PaymentRelease']['status'] == 1) { echo "Complete";} else { echo "Pending";}?></td>
						<td>
						<a title="Payment Details History" href="<?php echo HTTP_ROOT.'admin/Business/view_payment_history/'.$pay_release_id;?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
							<span class="ui-icon ui-icon-search">
						</span>
						</a>
						</td>
						</tr>  
						<?php
						   $i++;
						   endforeach; ?>
						<?php	
									}
									else 
									{
								  ?>
								<tr>
									<td colspan="7">No Records Found.</td>
								</tr>
								<?php } ?>	
					</tbody>
				</table>
				
				 <?php echo $this->element('backend/table_head'); ?>
			

			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>

