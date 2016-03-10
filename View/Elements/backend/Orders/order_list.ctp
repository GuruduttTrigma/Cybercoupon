<?php  echo $this->Html->script('backend/development/tablesorter.js');?>

<script id="js">
$(function()
{	
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
						<th style="width:75px;">Customer Email</th>
						<th style="width:75px;">Deal Name</th>
						<!--<th style="width:75px;">Deal Option</th>-->
						<th style="width:75px;">Payment Type</th>
						<th style="width:75px;">Transaction Id</th>
						<th style="width:75px;">Voucher Number</th>
						<th style="width:75px;">Sub Total</th>
						<th style="width:75px;">Purchase Date</th>
						<th style="width:75px;">Order Status</th>
						<?php
						if($subadmin_type==1 || @$modulepermissions['Orders List']['module_edit']==1 ) 
						{ 		  
						?>
						<th style="width: 120px;">Action</th> 
						<?php
						}
						?>
					</tr> 
				</thead> 
				<tbody> 
					<?php
					if(!empty($all))
					{
					foreach($all as $team)
					{
					if(!empty($team['Member']['email']))
					{
					//pr($team);die;
					if(!empty($team['OrderDealRelation'][0]['deal_option_id'])) :
						$viewQuery=ClassRegistry::init('DealOption');
						$team[]=$viewQuery->find('first',array('conditions'=>array('DealOption.id'=>$team['OrderDealRelation'][0]['deal_option_id'])));
					endif;
					?>					
                  <tr>
						<td><?php echo $team['Order']['order_no']; ?></td>
						<td><?php 
								if(trim($team['Member']['email'])!='')
								{
								
									echo $team['Member']['email'];
								}
								else
								{
									echo "N/A";
								}						
								
							?></td>
						<td>
							<?php 
								foreach($team['OrderDealRelation'] as $dealrelation)
								{
									//pr($dealrelation);
									echo @$team[0]['DealOption']['option_title'];
								}
							?>
						</td>
						
						<!--<td>
							<?php 
								if(!empty($dealrelation['Deal']['DealOption']))
								{
								foreach(@$dealrelation['Deal']['DealOption'] as $dealoption)
								{
									//pr($dealoption);
									$dealoptionid=$dealoption['id'];
									//echo $dealoptionid;
									$dealid=$dealrelation['deal_option_id'];
									//echo "/".$dealid;
									if($dealoptionid==$dealid)
									{
										echo $dealoption['option_title'];	
										break;
									}									
								}
								}						
							?>
						</td>-->
       <td><?php echo $team['Order']['payment_type']; ?></td>
	   <td><?php echo @$team['Order']['transaction_id']; ?></td>
	   <td>
	        <?php 
					foreach($team['OrderDealRelation'] as $dealrelation)
					{
						//pr($dealrelation);
						echo @$dealrelation['voucher_code'];
					}
				?>
	   </td>
						<td><?php echo $team['Order']['sub_total']; ?></td>
						<td><?php echo date('d M Y',strtotime($team['Order']['payment_date'])); ?></td>
						<?php /*<td>
							<input type="hidden" value="<?php echo $team['Order']['id']; ?>" />
							<select class="order_status">
							<?php 
								foreach($order_status as $os)
								{ 
								?>
									<option value="<?php echo $os['OrderStatus']['id']; ?>" <?php if($os['OrderStatus']['id']== $team['Order']['order_status_id']){ ?> selected="selected"<?php } ?>><?php echo $os['OrderStatus']['name']; ?></option>
																	
								<?php 
								} 	
								?>
							</select>
							<input type="button" class="btn rhl" value="Submit" style="heigth:24px; width:53px; display:none;"/>
						</td> */ ?>
						<?php
						if($subadmin_type==1 ||@$modulepermissions['Orders List']['module_edit']==1) 
						{ 		  
						?>
						<td>
							<input type="hidden" value="<?php echo $team['Order']['id']; ?>" />
							<?php 
							
								if($team['Order']['order_status']=="pending"){
										echo '<select  class="order_status">
													<option value="pending">Pending</option>
													<option value="success">Success</option>
												</select>';
								}
								else{
									echo '<select disabled>
													<option >'.ucfirst($team['Order']['order_status']).'</option>
												</select>';
									//echo ucfirst($team['Order']['order_status']); 
								}
							
							?>
							<input type="button" class="btn rhl" rel="<?php echo $team['Order']['id']; ?>" value="Submit" style="heigth:24px; width:53px; display:none;"/>
						</td>
					<?php 
					}
					else
					{
					?>
						<td>
						<?php echo $team['Order']['order_status']; ?>
						</td>
					<?php 
					}
					?>
					<?php
						if($subadmin_type==1 || @$modulepermissions['Orders List']['module_edit']==1 ) 
						{ 		  
					?>	
			        <td>
                  	<?php $member_id = base64_encode(convert_uuencode($team['Order']['id'])); ?>
                    <a title="View" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Orders/view_order/".$member_id;?>">	
                     	<span class="ui-icon ui-icon-search"></span>
					</a>
					<?php 
					foreach($team['OrderDealRelation'] as $dealrelation)
          			{
            		?> 
						<a title="Download" class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT.'voucher_pdf/'.$dealrelation['voucher_pdf']; ?>" download="<?php echo $dealrelation['voucher_pdf']; ?>" onclick="return confirm('Are you sure you want to Download this voucher?');">
							<span class="ui-icon ui-icon-arrowthickstop-1-s"></span>
						</a>			
					<?php
              		}               
					if($team['Order']['order_status']=="success") 
             		{
            		?> 
					<a title="Resend Voucher" class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Orders/Send_voucher/".$member_id; ?>" onclick="return confirm('Are you sure you want to Send this voucher?');">
                        <span class="ui-icon ui-icon-mail-open"></span>
                    </a>
                    <?php 
					} 
					else 
					{ 
					?>
						<a title="Order Status Pending" class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip ui-state-hover" href="javascript:void(0)">
                           <span class="ui-icon ui-icon-mail-open"></span>
                    </a>			
					<?php
                    }             
					?> 
					<!----------------- Delete/Cancel -------------------------------->
                    <?php 
					foreach($team['OrderDealRelation'] as $dealrelation)
					{
						$reconcile = @$dealrelation['reconcile'];
					}
					if($team['Order']['order_status'] == 'pending')	
					{					
					?>					
            		<a title="Cancel" class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Orders/delete_order/".$member_id; ?>" onclick="return confirm('Are you sure you want to delete this order?');">
                        <span class="ui-icon ui-icon-circle-close"></span>
                    </a>	
					<?php 
					}
					elseif($team['Order']['order_status'] == 'success' && $reconcile == 'Completed')
					{
					?>	
					<a title="Delete" class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Orders/delete_order/".$member_id; ?>" onclick="return confirm('Are you sure you want to delete this order?');">
                        <span class="ui-icon ui-icon-circle-close"></span>
                    </a>
					<?php 
					}
					else
					{
					?>
					<a class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip ui-state-hover" href="javascript:void(0)">
                        <span class="ui-icon ui-icon-circle-close"></span>
                    </a>
					<?php 
					}
					?>
                </td>
				<?php 
				}
				?>
			</tr> 
					<?php	
						}	
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
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>