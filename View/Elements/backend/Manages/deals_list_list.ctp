<?php echo $this->Html->script('backend/development/ui.datepicker.js');
 
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
<style>
.margin-bottom {
    float: left;
    font-size: 20px;
    margin-bottom: 15px;
    text-align: left;
    width: 100%;
}
.margin-top {
    float: left;
    font-size: 20px;
    margin-top: 15px;
    text-align: left;
    width: 100%;
}
</style>
	<h1 class= "margin-bottom margin-top" style="font-size:14px;"><b>Total value :<?php echo round($TotalAmount,2);?></h1>
	<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<div class="hastable">
         <?php /*?><?php echo $this->element('adminElements/table_head'); ?><?php */?>
			<table id="sort-table"> 
				<thead> 
					<tr>
						<th style="width:auto;">Supplier company name</th>
                        <th style="width:auto;">Deal Name</th>
                        <th style="width:auto;"> Buy From date</th>
                        <th style="width:auto;"> Buy To date</th> 
                        <!--<th style="width:auto;">Redeeming From</th>
                        <th style="width:auto;">Redeeming To</th>-->
                        <th style="width:auto;">Category</th>     
                        <th style="width:10px;">Number of Vouchers</th>              
                        <th style="width:auto;">Total Value</th>
                        <th style="width:auto;">Sales person</th>                            
					</tr> 
				</thead> 
				<tbody> 
				
					<?php	
					if(!empty($member))
					{					
						foreach($member as $data):	
					?>
                <tr>
						<td><?php echo $data['Member']['MemberMeta']['company_name']?></td>
						<td><?php echo $data['Deal']['name']?></td>
                     <td><?php echo date('d M Y',strtotime($data['Deal']['buy_from'])); ?></td>       
                     <td><?php echo date('d M Y',strtotime($data['Deal']['buy_to'])); ?></td>  
                     <td><?php echo $data['DealCategory']['name']; ?></td> 
                     <td>
                     <?php 
                     	if(!empty($data['Deal']['sales_deal']))
                     	{
                     		echo @$data['Deal']['sales_deal']; 
                     	}
                     	else {
                     		
                     		echo "0.00";
                     	}
                     ?>
                     </td> 
                     <td>
                     <?php 
                     	if(!empty($data['Deal']['sales_deal']))
                     	{
                     		echo $data['Deal']['dis_total_sales_deal'];
								} 
								else {
									echo "0.00";	
								}                    
                     ?>
                     </td> 
                      <td>
						<?php 
						
						?>
								  <?php if(!empty($data['Deal']['Sales_Person']) && ($data['Deal']['Sales_Person']!='')) :echo $data['Deal']['Sales_Person']; else : echo 'NA';endif;?>                   
                      </td> 
                     </tr>  
                <?php    endforeach; ?>
          <?php	
								}
						 		else 
						 		{
							  ?>
							<tr>
								<td colspan="8">No Record Found.</td>
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

