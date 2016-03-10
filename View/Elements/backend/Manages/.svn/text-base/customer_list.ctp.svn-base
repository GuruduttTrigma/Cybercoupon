<?php  echo $this->Html->script('backend/development/tablesorter.js');?>
<script id="js">
$(function()
{
	var pagerOptions = 
	{
		container: $(".pager"),
		ajaxUrl: null,
		ajaxProcessing: function(ajax)
		{
			if (ajax && ajax.hasOwnProperty('data')) 
			{
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
});</script>

	<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<div class="hastable">
         <?php /*?><?php echo $this->element('backend/table_head'); ?><?php */?>
			<table id="sort-table"> 
				<thead> 
					
					<tr>
                        <th style="width:auto;">Name</th>
								<th style="width:auto;">Email Address</th>
								<!--<th style="width:auto;">Phone Number</th> -->
                        <th style="width:auto;">Subject</th>
                        <th style="width:auto;">Message</th>
                                                <th style="width:auto;">Member Type</th>
                        <th style="width:auto;">Action</th>
					</tr> 
				</thead> 
				<tbody> 
					<?php					
						if(!empty($a_customers)) {
							foreach($a_customers as $data) {  
						?>
                    <tr>
                    	<td>
                    		<?php
                    			if(strlen($data['Contact']['name'])>25) {
										$str=substr($data['Contact']['name'] ,0,25);
										echo $str.'......';
									}
									else {
										echo $data['Contact']['name']; 
									}
									 
								?>
							</td>							
							<td>
								<?php
									//$a=$pt['Post']['body'];
									//echo strlen($pt['Post']['body']);die;
									if(strlen($data['Contact']['email']) >25) {
										$str=substr($data['Contact']['email'],0,25);
										echo $str.'......';
									}
									else {
										echo $data['Contact']['email'];
									}
								?>
							</td>
							<!--<td>
								<?php
									 echo $data['Contact']['phone']; 								
								?>
							</td> -->
							<td>
								<?php
									//$a=$pt['Post']['body'];
									//echo strlen($pt['Post']['body']);die;
									if(strlen($data['Contact']['subject']) >35) {
										$str=substr($data['Contact']['subject'],0,35);
										echo $str.'......';
									}
									else {
										echo $data['Contact']['subject'];
									}
								?>
							</td>
							<td>
								<?php
								//$a=$pt['Post']['body'];
								//echo strlen($pt['Post']['body']);die;
								if(strlen($data['Contact']['message']) >35)
								{
									$str=substr($data['Contact']['message'],0,35);
									echo $str.'......';

								}
								else
								{
									echo $data['Contact']['message'];
								}
								?>
							</td>   
							<td>
								<?php
								 //echo $data['Member_type']['name']; 
								 ?>								
								<?php
								if($data['Contact']['member_type']!=0)
								{
									   echo $data['MemberType']['name'];
								}
								else
								{
								   echo "Guest User"; 
								}								
								?>
/*  for subadmin module */
      <?php
          if($member_type=='3')
          {
              $selected_module_name='Supplier List';
          }
          else if($member_type=='4')
          {
              $selected_module_name='Customer List';
          }
          else if($member_type=='2')
          {
              $selected_module_name='User List';
          }
          else
          {
              $selected_module_name='Guest List';
          }
      ?>
							</td>                                            
                          <td>
                              <?php $newsid = base64_encode(convert_uuencode($data['Contact']['id'])); ?>

                              <a title="View" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Manages/view_customer/".$newsid; ?>">	
                                  <span class="ui-icon ui-icon-search"></span>
                              </a>
                              <?php if(!empty($data['Contact']['member_id'])) { ?>                            
                              <a title="User Detail" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/view_member/".base64_encode(convert_uuencode($data['Contact']['member_id'])); ?>">	
                                  <span class="ui-icon ui-icon-lightbulb"></span>
                              </a>
                              <?php } ?>
                              <!--<a title="Edit" href="<?php echo HTTP_ROOT."admin/Manages/edit_customer/".$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
                                  <span class="ui-icon ui-icon-pencil"></span>
                              </a>-->
                               
                              <?php
                              if($subadmin_type==1||@$modulepermissions[$selected_module_name]['module_edit']==1)
                			            {
                                  if($subadmin_type==1||($subadmin_type==2 && (@$modulepermissions[$selected_module_name]['delete_permission']==1)))
                          			        {
                            			    ?>    
                                    <a title="Delete" class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip"
                                                   href="<?php echo HTTP_ROOT."admin/Manages/deleteCustomer/".$newsid; ?>" onclick="return confirm('Are you sure you want to delete this Contact?');">
                                          <span class="ui-icon ui-icon-circle-close"></span>
                                        </a>
                              <?php
                                  }
                               }
                              ?>
                       </td>
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
			
             <?php echo $this->element('backend/table_head'); ?>
			
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>