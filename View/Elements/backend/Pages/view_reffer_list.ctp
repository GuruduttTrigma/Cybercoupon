<script id="js">
	$(function()
	{
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
			size: 20,

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
			widgets: ['zebra'],
			headers: { 
		            
		            9: { 
		               	// disable it by setting the property sorter to false 
		                //sorter: false
		               } 
		        	} 
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
<style>
.pagination > li:first-child > a, .pagination > li:first-child > span {
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    margin-left: 0;
}
.pagination > li > a, .pagination > li > span {
    background-color: #fff;
    border: 1px solid #ddd;
    color: #428bca;
    float: left;
    line-height: 1.42857;
    margin-left: -1px;
    padding: 6px 12px;
    position: relative;
    text-decoration: none;
}
</style>
<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<div class="hastable">
			<form id="usr_form" method="post" action="" >
			<table id="sort-table"> 
				<thead> 
					<tr>						
	               <th style="width:auto;">First Name</th>
	               <th style="width:auto;">Surname</th>
	               <th style="width:auto;">Email</th>
						<?php if($subadmin_type==1 || @$modulepermissions['Referrals']['module_edit']==1 )  { ?> 
						<th style="width: 145px;" class="rmv_sort">Action</th>   
						<?php } ?>
					</tr> 
				</thead> 
				<tbody> 
				<?php
				if(!empty($referres))
				{
					foreach($referres as $referred)
					{
						$newsid = base64_encode(convert_uuencode($referred['Referral']['id']));
					?>
					<tr>
						 <td><?php echo $referred['Referred']['name']; ?></td>
						 <td><?php echo $referred['Referred']['surname'];?></td>
						 <td><?php echo $referred['Referred']['email']; ?></td>
						 <?php if($subadmin_type==1 || @$modulepermissions['Referrals']['module_edit']==1 )  { ?> 
						 <td><a title="Unlink" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Pages/deleteReferred/".$newsid; ?>" onclick="return confirm('Are you sure you want to unlink this customer?');">
						<span class="ui-icon ui-icon-circle-close"></span>
						</a>
						</td>
					<?php } ?>
					</tr>
					<?php								
					} 
				}		else
						{
				?>
				<tr>
					<td colspan="7">No Record Found.</td>
				</tr>
					<?php		
				}
					?>					
				</tbody>
			</table>
			</form>
			<div class="hastable showhtml" style="width:100%; margin-top:8px;">
				<ul class="pagination sales_total_pagination " style="align:center;">
				<?php if($this->params['paging']['Referral']['pageCount']>1) { ?> 		   
				<li ><?php echo $this->Paginator->prev('Prev');?></li>
				<li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
				<li><?php  echo $this->Paginator->next('Next');?></li>
			<?php } ?>
			</ul>	
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>