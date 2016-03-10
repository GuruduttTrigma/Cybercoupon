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
	
	 $('.all_member').click(function(){
      if($(this).is(':checked'))
      {
         $('.each_user').attr('checked',true);
      }
      else
      {
         $('.each_user').attr('checked',false);
      }
  })
  $('.each_user').click(function() {
      
      var total_checkbox=$('input[type=checkbox]').not('.all_member').length;
      var total_checked=$("input:checked").not('.all_member').length;
	 
      if(total_checked<total_checkbox)
      {
          $('.all_member').attr('checked',false);
      }
      if(total_checked==total_checkbox)
      {
          $('.all_member').attr('checked',true);
      }
     
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
	<h1 class= "margin-bottom margin-top" style="font-size:14px;"><b>A total of <?php echo round($amount_received_from_supplier,2);?> was received from suppliers sales for the date range selected; <?php echo round($amount_claimed_from_supplier,2);?> was claimed by suppliers for vouchers delivered upon and <?php echo round($amount_payable_to_supplier,2);?> is being paid out against those claims</b></h1>
	<div id="page-content">
	
		<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
			<div class="hastable">
			 <?php /*?><?php echo $this->element('adminElements/table_head'); ?><?php */?>
				<table id="sort-table"> 
					<thead> 
						<tr>
							 <th style="width:auto;" class="rmv_sort"><input type="checkbox" class="all_member" style="float:left;"/>All</th>
							
							<!--<th style="width:auto;">Email</th>
							<th style="width:auto;">Bank Name</th>
							<th style="width:auto;">Account Type</th>
							<th style="width:auto;">Account Number</th>
							<th style="width:auto;">Transaction From</th>
							<th style="width:auto;">Transaction To</th>-->
							<th style="width:auto;">Amount Received From Supplier</th> 
							<th style="width:auto;">Amount Payable To Supplier</th>
							<!--<th style="width:auto;"> Amount Claimed by Supplier</th>-->
							<th style="width:auto;"> Amount of CyberCoupon</th>
							<th style="width:auto;">Suppliers Percentage Split</th> 
							<th style="width:auto;">Supplier's Name</th> 
							<th style="width:auto;">Supplier's Email</th> 
							<th style="width:auto;">Account Name</th> 
							<th style="width:auto;">Bank Name</th> 
							<th style="width:auto;">Branch code</th> 
							<th style="width:auto;">Account  No.</th> 
							<!--<th style="width:auto;">Total Amount EFT</th> 
							<th style="width:auto;">Total Amount Credit card</th>--> 
							<?php
							if($subadmin_type==1 || @$modulepermissions['Reconcilation Report']['module_edit']==1 ) 
							{ 		  
							?>
							<th style="width:auto;">Payment</th>
							<?php
							}
							?>
						<!--<th style="width: 160px;" class="rmv_sort">Action</th> -->
						</tr> 
					</thead> 
					<tbody> 
					
						<?php	
						if(!empty($member))
						{					
							foreach($member as $data):	
							   $amount_received_from_supplier= (@$data['Member']['amount_received_from_supplier']!=0)?$data['Member']['amount_received_from_supplier']:'0'; 
								$amount_payable_to_supplier= (@$data['Member']['amount_payable_to_supplier']!=0)?($data['Member']['amount_payable_to_supplier']*$data['MemberMeta']['supplier%'])/100:'0'; 
								$amount_claimed_from_supplier=(@$data['Member']['amount_claimed_from_supplier']!=0)?($data['Member']['amount_claimed_from_supplier']*$data['MemberMeta']['supplier%'])/100:'0'; 
								$amount_of_cybercoupon= (@$data['Member']['amount_received_from_supplier']!=0)?($data['Member']['amount_received_from_supplier']*$data['MemberMeta']['cybercoupon%'])/100:'0';
								//pr($data);die;
								if(!empty($data['MemberMeta']['account_holder']) && $data['MemberMeta']['account_holder'] != '')
								{
									$account_holder = $data['MemberMeta']['account_holder'];
								}
								else
								{
									$account_holder = 'N/A';
								}
								if(!empty($data['MemberMeta']['bank_name']) && $data['MemberMeta']['bank_name'] != '')
								{
									$bank_name = $data['MemberMeta']['bank_name'];
								}
								else
								{
									$bank_name = 'N/A';
								}
								if(!empty($data['MemberMeta']['branch_code']) && $data['MemberMeta']['branch_code'] != '')
								{
									$branch_code = $data['MemberMeta']['branch_code'];
								}
								else
								{
									$branch_code = 'N/A';
								}
								if(!empty($data['MemberMeta']['account_number']) && $data['MemberMeta']['account_number'] != '')
								{
									$account_number = $data['MemberMeta']['account_number'];
								}
								else
								{
									$account_number = 'N/A';
								}
						?>
					<tr>
						<td><input type="checkbox" name="members_id[]" value="<?php echo $data['Member']['id']; ?>" class="each_user"/></td>
						
						<!--<td><?php echo $data['Member']['email'];?></td>-->
						<td><?php echo round(($amount_received_from_supplier>0)?$amount_received_from_supplier:'0',2);?></td>
						<td><?php echo round(($amount_payable_to_supplier>0)?$amount_payable_to_supplier:'0',2); ?></td>
						<!--<td><?php //echo round(($amount_claimed_from_supplier>0)?$amount_claimed_from_supplier:'0',2); ?></td>-->
						<td><?php echo round(($amount_of_cybercoupon>0)?$amount_of_cybercoupon:'0',2); ?></td>
						<td><?php echo $data['MemberMeta']['supplier%'];?></td>
						<td><?php echo $data['MemberMeta']['company_name'];?></td>
						<td><?php echo $data['Member']['email'];?></td>
						<td><?php echo $account_holder;?></td>
						<td><?php echo $bank_name;?></td>
						<td><?php echo $branch_code;?></td>
						<td><?php echo $account_number;?></td>
						<?php
						if($subadmin_type==1 || @$modulepermissions['Reconcilation Report']['module_edit']==1 ) 
						{ 		  
						?>
						<td>
							<?php $newsid = base64_encode(convert_uuencode($data['Member']['id'])); ?>   
							<a title="Payment List" href="<?php echo HTTP_ROOT.'admin/Business/reconcilation/'.$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
									<span class="ui-icon ui-icon-suitcase">
									</span>
							</a>
							<a title="Payment History" href="<?php echo HTTP_ROOT.'admin/Business/payment_history/'.$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
								<span class="ui-icon ui-icon-bookmark"></span>
							</a>
							
						</td>
						<?php
						}
						?>
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
				
				 <?php echo $this->element('backend/table_head500'); ?>
			

			<!--<div class="paymentbtn">
				
				<input type="button"   value="Release Payment" class="sub-bttn paidamount" style="width:125px; height:34px;float: right; margin-left:0;" />
				
			</div>-->
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>

