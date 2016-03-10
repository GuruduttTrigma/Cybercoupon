<?php echo $this->Html->script('backend/development/ui.datepicker.js');?>
<script id="js">
	$(function(){
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
                  <th style="width:auto;">Image</th>
                  <th style="width:auto;">Deal Name</th>
                  <th style="width:auto;">Customer E-mail</th> 
                  <!--<th style="width:auto;">Redeeming From</th>
                  <th style="width:auto;">Redeeming To</th>-->
                  <th style="width:auto;">Purchase Date</th>
                  <th style="width:auto;">Total Amount</th>
                  <!--<th style="width:auto;">Return Amount</th>     
                  <th style="width:auto;">Status</th> --> 
					<?php
					if($subadmin_type==1 || @$modulepermissions['Claims']['module_edit']==1 ) 
					{ 		  
					?>
					<th style="width: 160px;" class="rmv_sort">Action</th> 
					<?php 
					}
					?>
					</tr> 
				</thead> 
				<tbody> 
					<?php	
						if(!empty($orderrelation)) {					
							foreach($orderrelation as $data):	
					?>
					<tr>
						<td class="td_padding" data-title="Image"  width="55" style="border-bottom:none;"><img src="<?php echo IMPATH.'deals/'.$data['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/></td>
						<td><?php echo $data['Deal']['name']; ?></td>       
						<td><?php echo $data['Deal']['Member']['email']; ?></td>  
						<td><?php echo date('d M Y',strtotime($data['Order']['payment_date'])); ?></td>
       <td><?php echo $data['OrderDealRelation']['sub_total']; ?></td> 
       <!--<td>
										<?php
												if($data['OrderDealRelation']['reconcile']=='Pending') {
												   $percentage=$data['Deal']['Member']['MemberMeta']['cybercoupon%'];
												   echo number_format(($data['OrderDealRelation']['sub_total']*$percentage)/100,2,'.','')." (".$percentage."%)";
												}
												else {
												   echo $data['OrderDealRelation']['sub_total'].' (100%)';
												}
										?>
						</td>				
						<td>
						<?php 
								/*if($data['OrderDealRelation']['refund_status']=='Yes')
								{
								   echo 'Pending';
								}
					         else
					         {*/
					            echo $data['OrderDealRelation']['refund_status'];
					        // }
					 ?>
						
						</td> -->        
						<?php
						if($subadmin_type==1 || @$modulepermissions['Claims']['module_edit']==1 ) 
						{ 		  
						?>	
                     	<td>
                        	<?php $newsid = base64_encode(convert_uuencode($data['OrderDealRelation']['id'])); ?>
                            <a title="View" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Manages/view_detail/".$newsid; ?>">	
                               	<span class="ui-icon ui-icon-search"></span>
                            </a>
                            <!-- <a title="Edit" href="<?php echo HTTP_ROOT."admin/Manages/edit_claim/".$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
                                    <span class="ui-icon ui-icon-pencil"></span>
                            </a>-->
                          
                            <!--<a title="Delete" class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Manages/deleteClaim/".$newsid; ?>" onclick="return confirm('Are you sure you want to delete this Claim?');">
                                    <span class="ui-icon ui-icon-circle-close"></span>
                            </a>-->
                         <?php /*
                                                          
                                  if($data['OrderDealRelation']['refund_status']=="Yes")	
                                  	{ ?>
                                  	<a title="Yes" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Manages/update_refunds/".$newsid; ?>">
                                    	<span class="ui-icon ui-icon-lightbulb"></span>
                                  	</a>
                                  <?php 
                    								 }else { 
                    					 ?>
                                  	<a title="Approved" class="btn_no_text btn ui-state-default ui-corner-all tooltip ui-state-hover" href="javascript:void(0);">
                                      <span class="ui-icon ui-icon-lightbulb"></span>
                                  	</a>
                                  <?php
                            			
                                 }
                           		*/ ?>
                          </td>
						  <?php
						  }
						  ?>
                     </tr>  
                <?php
                   //for module edit condition
                       endforeach; ?>
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
	</div>	<div class="clear"></div>
</div>

