<?php  echo $this->Html->script('newadmin/tablesorter.js'); ?>

<script id="js">$(function(){

	var pagerOptions = {

		// target the pager markup - see the HTML block below
		container: $(".pager"),

		// use this url format "http:/mydatabase.com?page={page}&size={size}&{sortList:col}"
		ajaxUrl: null,

		// process ajax so that the data object is returned along with the total number of rows
		// Replacement: { "data" : [{ "ID": 1, "Name": "Foo", "Last": "Bar" }], "total_rows" : 100 }
		ajaxProcessing: function(ajax){
			if (ajax && ajax.hasOwnProperty('data')) {
				// return [ "data", "total_rows" ];
				return [ ajax.data, ajax.total_rows ];
			}
		},
		updateArrows: true,

		// starting page of the pager (zero based index)
		page: 0,

		// Number of visible rows - default is 10
		size: 10,
		removeRows: false,

		// css class names of pager arrows
		cssNext: '.next', // next page arrow
		cssPrev: '.prev', // previous page arrow
		cssFirst: '.first', // go to first page arrow
		cssLast: '.last', // go to last page arrow
		cssGoto: '.gotoPage', // select dropdown to allow choosing a page

		cssPageDisplay: '.pagedisplay', // location of where the "output" is displayed
		cssPageSize: '.pagesize', // page size selector - select dropdown that sets the "size" option

		// class added to arrows when at the extremes (i.e. prev/first arrows are "disabled" when on the first page)
		cssDisabled: 'disabled' // Note there is no period "." in front of this class name

	};

	$("table")

		// Initialize tablesorter
		// ***********************
		.tablesorter({
			theme: 'blue',
			//widthFixed: true,
			widgets: ['zebra'],
		})

		// bind to pager events
		// *********************
		.bind('pagerChange pagerComplete pagerInitialized pageMoved', function(e, c){
			var msg = '" event triggered, ' + (e.type === 'pagerChange' ? 'going to' : 'now on') +
				' page ' + (c.page + 1) + '/' + c.totalPages;
			$('#display')
				.append('<li>"' + e.type + msg + '</li>')
				.find('li:first').remove();
		})

		// initialize the pager plugin
		// ****************************
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

		// Delete a row
		// *************

		$('table').delegate('button.remove', 'click' ,function(){
			var t = $('table');
			// disabling the pager will restore all table rows
			// t.trigger('disable.pager');
			// remove chosen row
			$(this).closest('tr').remove();
			// restore pager
			// t.trigger('enable.pager');
			t.trigger('update');
		});

		// Destroy pager / Restore pager
		// **************
		$('button:contains(Destroy)').click(function(){
			// Exterminate, annhilate, destroy! http://www.youtube.com/watch?v=LOqn8FxuyFs
			var $t = $(this);
			if (/Destroy/.test( $t.text() )){
				$('table').trigger('destroy.pager');
				$t.text('Restore Pager');
			} else {
				$('table').tablesorterPager(pagerOptions);
				$t.text('Destroy Pager');
			}
		});

		// Disable / Enable
		// **************
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
$(".tablesorter-header-inner").each(function(){
	var content=$(this).text();
	if(content=="Action")
	{
		$(this).next().remove();
	}
});
});

</script>

	<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<div class="hastable">

			<table id="tablesorter"> 
				<thead> 
					<tr>
						<th style="width:75px;">Order Number</th>
						<th style="width:75px;">Deal Name</th>
						<!--<th style="width:75px;">Deal Option</th>-->
						<th style="width:75px;">Sub Total</th>
						<th style="width:75px;">Date</th>
						<th style="width:75px;">Order Status</th>
					</tr> 
				</thead> 
				<tbody> 
					<?php
					if(!empty($all))
					{
						foreach($all as $team)
						{ 
							//pr($team);
							
					?>
						
   <tr>
						<td><?php echo $team['Order']['order_no']; ?></td>
						
						<td><?php 
							foreach($team['OrderDealRelation'] as $deal)
							{
								if(trim($deal['DealOption']['option_title'])!='')
								{
									echo $deal['DealOption']['option_title'];
								}
								else
								{
									echo "N/A";
								}
								
							}
							?>
						</td>
     <!--<td>
        <?php 
			//echo @$team['OrderDealRelation']['DealOption']['option_title'];
			//echo "N/A";
		?>
     </td>-->
						<td><?php echo $team['Order']['sub_total']; ?></td>
						<td><?php echo $team['Order']['payment_date']; ?></td>
						<td><?php echo $team['Order']['order_status']; ?></td>
   </tr> 
					<?php	
							
							}
						} else {
					?>
						<tr>
								<td colspan="8" style="width:100px;">No Record Found.</td>
							</tr>
					<?php		
						}
					?>					
				</tbody>
			</table>
         
		 <?php echo $this->element('backend/table_head'); ?>
		
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>