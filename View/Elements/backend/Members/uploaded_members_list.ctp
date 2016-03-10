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
		<label style="font-size: 20px;color: #000;"><?php echo 'Total Users: '.$total; ?></label>
		<label style="font-size: 20px;color: #000;float:right;"><?php echo 'Search Result: '.$count; ?></label>
			<form id="usr_form" method="post" action="" >
			<table id="sort-table"> 
				<thead> 
					<tr>
					<th style="width:auto;">First Name</th>
					<th style="width:auto;">Last Name</th>
					<th style="width:auto;">Email</th> 
					<th style="width:auto;">Password</th>  
					<th style="width:auto;">Location</th>  
					<th style="width:auto;">Referrer</th>  
					<th style="width:auto;">Status</th>
					<th style="width:auto;">Repeated</th>
					<th style="width:auto;">Action</th> 
					</tr> 
				</thead> 
				<tbody class="tbody_tr"> 
				<?php  
				if(!empty($info))
				{
					foreach($info as $info1)
					{
						//pr($info);
					?>
						<tr>
							<td style="text-align:center;"><?php echo $info1['UploadedUser']['name']; ?></td>
							<td style="text-align:center;"><?php echo $info1['UploadedUser']['surname']; ?></td>
							<td style="text-align:center;"><?php echo $info1['UploadedUser']['email']; ?></td>
							<td style="text-align:center;"><?php echo $info1['UploadedUser']['password']; ?></td>
							<td style="text-align:center;"><?php echo $info1['UploadedUser']['location']; ?></td>
							<td style="text-align:center;"><?php echo $info1['UploadedUser']['Referrer']; ?></td>
							<td style="text-align:center;"><?php echo $info1['UploadedUser']['status']; ?></td>
							<td style="text-align:center;"><?php echo $info1['UploadedUser']['deleteStatus']; ?></td>
							<td>
							<?php 
							$newsid = base64_encode(convert_uuencode($info1['UploadedUser']['id']));
							?>
							<a title="Delete" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/delete_uploaded_member/".$newsid; ?>">	
								<span class="ui-icon ui-icon-circle-close"></span>
							</a>
							</td>
						</tr>
					<?php 
					}
				}
				else
				{
				?>
				<tr>
					<td colspan="7">No Records Found.</td>
				</tr>	
				<?php 
				}
				?>
				</tbody>
			</table>
			</form>
			<div class="text-center">
			<ul class="pagination sales_total_pagination" style="align:center;">
				<?php if($this->params['paging']['UploadedUser']['pageCount']>1) { ?> 		   
				<li ><?php echo $this->Paginator->prev('Prev');?></li>
				<li><?php echo $this->Paginator->numbers(array('separator' => false,'class'=>'counter'));?> </li>
				<li><?php  echo $this->Paginator->next('Next');?></li>
			<?php } ?>
			</ul>		
			</div>
			<?php
			// echo $this->element('backend/table_head100');
		  ?>
			
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>