
<?php  echo $this->Html->script('backend/development/tablesorter.js');?>
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
</script>

	<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<div class="hastable">
         <?php /*?><?php echo $this->element('backend/table_head'); ?><?php */?>
			<table class="col-md-12 table-bordered border_none table-striped table-condensed cf">
    <thead class="cf">
        <tr>
            <th class="td_padding td_color">Image</th>
            <th class="td_padding td_color" >Deal Name</th>
            <th class="td_padding td_color" >The total number of vouchers sold</th>
       </tr>
    </thead>
    <tbody>
        <?php
            if(!empty($mydeal_info))
             {
                foreach($mydeal_info as $mydeal)
                {
                	//echo "<pre>";print_r($mydeal);die;
                	 ?>
              <tr>
	             <?php
	             if($mydeal['Deal']['active']=='Yes')
	             {
              	 ?>
                <td class="td_padding" data-title="ID"><img src="<?php echo IMPATH.'deals/'.$mydeal['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/></td>
                <td class="td_padding" data-title="Deal Name"><?php echo ucwords($mydeal['Deal']['name']);?></td>
                <?php
                }
                else
                {
                ?>
                <td class="td_padding" data-title="ID"><img src="<?php echo IMPATH.'deals/'.$mydeal['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/></td>
                <td class="td_padding" data-title="Deal Name"><?php echo ucwords($mydeal['Deal']['name']);?></td>
                <?php
                }
                ?>
                <td data-title="Supplier" class="numeric td_padding">
                <?php 
                	if(!empty($mydeal['Deal']['sales_deal'])) {
                		if($mydeal['Deal']['sales_deal'] < 9) {
                			echo ucwords('The total number of vouchers sold for this promotion was '.'<b>'.'0'.$mydeal['Deal']['sales_deal'].'</b>');
							}	
							else {
                			echo ucwords('The total number of vouchers sold for this promotion was '.'<b>'.$mydeal['Deal']['sales_deal'].'</b>');
							}                				
						}
						else {
							echo "00";
							
						}                
                ?>
                </td>
            </tr>
         <?php
             }
          } 
          else
           {
          ?>
        <tr>
			<td colspan="5">
				<div class="col-md-12 col-sm-12 col-xs-12 sign_outr">
					<h2 class="text-center" style="color:#333; font-size:1.3em;">No records found !!!!!!!!!!</h2>
					<div class="col-md-12  padding_0 form_div_margin_top"></div>
				</div>
			</td>
		</tr>
					<?php
					  }	?>
  </tbody>
</table>
			
             <?php echo $this->element('backend/table_head'); ?>
			
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>