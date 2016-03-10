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
			<table id="sort-table"> 
				<thead> 
					<tr>
                        <th style="width:auto;">Question</th>
                        <th style="width:auto;">Answer</th>
								<th style="width:auto;">Faq Type</th>
								<th style="width:auto;">Faq Order</th>
								<!--<th style="width:auto;">Registered</th>-->
                  <?php
                      if($subadmin_type==1||@$modulepermissions['Content Management']['module_edit']==1) { 		  
					  
					  ?>
                        <th class="rmv_sort" style="width:auto;">Action</th>
                  <?php } ?>
					</tr> 
				</thead> 
				<tbody> 
					<?php					
						if(!empty($a_faqs)) {
							foreach($a_faqs as $data) { 
						?>
                    <tr>
                    	<td>
                    	<?php
								if(strlen(strip_tags($data['Faq']['question'])) >50) {
									$str=substr(strip_tags($data['Faq']['question']),0,50);
									echo $str.'......';
								}
								else {
									echo strip_tags($data['Faq']['question']);
								}
							?>
							</td>
							<td>
							<?php
								if(strlen(strip_tags($data['Faq']['answer'])) >50) {
									$str=substr(strip_tags($data['Faq']['answer']),0,50);
									echo $str.'......';
																	}
								else {
									echo strip_tags($data['Faq']['answer']);
									
								}
							?>
							</td>
							<td>
							<?php echo ucfirst($data['Faq']['faq_type']); ?>
							</td>
							<td>
											<?php echo $data['Faq']['order']; ?>
											</td>
							<!--<td><?php
								echo $data['FaqCategory']['name'];
								?>
							</td>-->
							<!--<td><?php
								//echo  $data['Faq']['registered'];
								?>
							</td>-->
                        
                        
          
                         
                              <?php
                              if($subadmin_type==1||@$modulepermissions['Content Management']['module_edit']==1)
                			            {
                              ?>
                                  <td>   
                                    <?php $newsid = base64_encode(convert_uuencode($data['Faq']['id'])); ?>
                                    <a title="View" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Manages/view_faq/".$newsid; ?>">	
                                        <span class="ui-icon ui-icon-search"></span>
                                    </a>
                                    <a title="Edit" href="<?php echo HTTP_ROOT."admin/Manages/edit_faq/".$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
                                        <span class="ui-icon ui-icon-pencil"></span>
                                    </a>
                                    <a title="Delete" style="float:left; style="float:left;" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Manages/deleteFAQ/".$newsid; ?>" onclick="return confirm('Are you sure you want to delete this FAQ?');">
                                            <span class="ui-icon ui-icon-circle-close"></span>
                                    </a>
                                 </td>
                                 
                            <?php 
                             }
                            ?>
                            
                       
                    </tr> 
					<?php	
							}
						} else {
					?>
							<tr>
								<td colspan="7">No Record Found.</td>
							</tr>
					<?php		
						}
					?>					
				</tbody>
			</table>
			
             <?php echo $this->element('backend/table_head100'); ?>
			
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>