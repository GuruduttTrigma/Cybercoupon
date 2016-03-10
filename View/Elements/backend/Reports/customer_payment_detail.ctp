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
	});

</script>
	<div id="page-content">
		<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
			<div class="hastable">
			 <?php /*?><?php echo $this->element('adminElements/table_head'); ?><?php */?>
				<table id="sort-table"> 
					<thead> 
						<tr>
							<th style="width:auto;">Order No.</th>
							<th style="width:auto;">Deal Name</th>
							<th style="width:auto;">Supplier Name</th> 
							<th style="width: auto;">Date</th> 
							<th style="width: auto;">Payment Type</th> 
							<th style="width: auto;">Total Amount</th> 
						</tr> 
					</thead> 
					<tbody> 
					
						<?php	
						if(!empty($order_info))
						{					
							foreach($order_info as $data):	
						?>
					<tr>
						<td style ="text-align:center"><?php echo $data['Order']['order_no'];	?></td>
						<td style ="text-align:center"><?php echo @$data['OrderDealRelation']['deal_name'];?></td>
						<td style ="text-align:center"><?php echo @$data['Deal']['Member']['name']." " .@$data['Deal']['Member']['surname'];?></td>
						<td style ="text-align:center">
							<?php echo date('d F Y',strtotime( $data['Order']['payment_date'])); ?>   
						</td>
						<td style ="text-align:center">
							<?php echo $data['Order']['payment_type']; ?>   
						</td>
						<td style ="text-align:center">
							<?php echo $data['Order']['sub_total']; ?>   
						</td>
						
					</tr>  
						<?php   //for module edit condition
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
			<div>
				<a href= "<?php echo HTTP_ROOT;?>/admin/Reports/customer_pdf/<?php echo base64_encode(convert_uuencode($member_id));?>" class="download_pdf"> Download PDF</a>
			</div>
			<div>
				<input type="button" style="width:125px; height:34px;float: right; margin-left:0;" class="sub-bttn sendMail" value="Send Mail">
			</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<style>

.download_pdf {
    border: 1px solid #dddddd;
    color: #851a1a;
    cursor: pointer;
    float: right;
    font-size: 12.5px;
    font-weight: bold;
    height: 19px;
    margin-left: 3px;
    outline: medium none;
    padding: 7px 6px 6px;
    text-align: center;
    width: 125px;
}
</style>