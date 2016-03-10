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
			<form id="usr_form" method="post" action="" >
			<table id="sort-table"> 
				<thead> 
					<tr>
					<th style="width:auto;">Business Name</th>
					<th style="width:auto;">Email</th>
					<!--<th style="width:auto;">Member Type</th>                          
					<th style="width:auto;">City</th>--> 
					<th style="width:auto;">Amount Received From Supplier's Sales</th> 
					<th style="width:auto;">Amount Payable To Supplier</th>  
					<!--<th style="width:auto;"> Amount Claimed by Supplier</th> --> 
					<th style="width:auto;"> Amount of CyberCoupon</th>  
					<th style="width:auto;"> Sales Person Commission (20%)</th>  
					<th style="width:auto;">Suppliers Percentage Split</th> 	
					<th style="width:auto;">Registration Date</th>
					<th style="width:auto;">Status</th>
					<th style="width:100px;" class="rmv_sort">Action</th> 
					</tr> 
				</thead> 
				<tbody class="tbody_tr"> 
				<?php 
				//pr($data);die;
				if(!empty($data)) :
					foreach($data as $info) :
					//	pr($data);die;
					$amount_received_from_supplier= (@$info['Member']['amount_received_from_supplier']!=0)?$info['Member']['amount_received_from_supplier']:'0'; 
					$amount_payable_to_supplier= (@$info['Member']['amount_payable_to_supplier']!=0)?($info['Member']['amount_payable_to_supplier']*$info['MemberMeta']['supplier%'])/100:'0'; 
					$amount_claimed_from_supplier=(@$info['Member']['amount_claimed_from_supplier']!=0)?($info['Member']['amount_claimed_from_supplier']*$info['MemberMeta']['supplier%'])/100:'0';
					$amount_of_supplier=(@$info['Member']['amount_received_from_supplier']!=0)?($info['Member']['amount_received_from_supplier']*$info['MemberMeta']['cybercoupon%'])/100:'0';
					$sales_person_commition = (@$info['Member']['amount_received_from_supplier'] !=0)?($info['Member']['amount_received_from_supplier']*20*$info['MemberMeta']['cybercoupon%'])/10000:'0';
					
				?>
				<tr>
					<td style="text-align:center;"><?php echo $info['MemberMeta']['company_name']; ?></td>
					<td style="text-align:center;"><?php echo $info['Member']['email']; ?></td>
					<td style="text-align:center;"><?php echo round(($amount_received_from_supplier>0)?$amount_received_from_supplier:'0',2);?></td>
					<td style="text-align:center;"><?php echo round(($amount_payable_to_supplier>0)?$amount_payable_to_supplier:'0',2); ?></td>
					<!--<td style="text-align:center;"><?php //echo round(($amount_claimed_from_supplier>0)?$amount_claimed_from_supplier:'0',2); ?></td>-->
					<td style="text-align:center;"><?php echo round(($amount_of_supplier>0)?$amount_of_supplier:'0',2); ?></td>
					<td style="text-align:center;"><?php echo round(($sales_person_commition>0)?$sales_person_commition:'0',2); ?></td>
					<td style="text-align:center;"><?php echo $info['MemberMeta']['supplier%'];?></td>
					<td style="text-align:center;"><?php echo date('d F Y',strtotime($info['Member']['registered'])); ?></td>
					<td style="text-align:center;"><?php echo $info['Member']['status']; ?></td>
					<td>
					<?php 
					$newsid = base64_encode(convert_uuencode($info['Member']['id']));
					?>
					<a title="Redeemed Vouchers" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/view_sales_member/".$newsid; ?>">	
						<span class="ui-icon ui-icon-search"></span>
					</a>
					<a title="Payment List" href="<?php echo HTTP_ROOT.'admin/Business/reconcilation/'.$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
							<span class="ui-icon ui-icon-suitcase">
							</span>
					</a>
					<a title="Payment History" href="<?php echo HTTP_ROOT.'admin/Business/payment_history/'.$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
						<span class="ui-icon ui-icon-bookmark"></span>
					</a>
					</td>
				</tr>
				<?php 
					endforeach;
				else :
				
					?>
					<tr>
						<td colspan="7">No Records Found.</td>
					</tr>
					<?php		
				endif;
				?>					
				</tbody>
			</table>
			</form>
			<?php
			if($subadmin_type==1||@$modulepermissions['Members']['module_edit']==1) 
			{ 		  
			?> 
			<div class="" style="float:left; width:100%; margin-top:8px;">
				
				<input type="button" style="width: auto; margin-top: 2px;margin-left:0;" value="Send Email" class="sub-bttn bulk_user_email">
				<div style="display:none;left: 8%;position: absolute; " class="image_display">
					<img style="margin-left:0px;margin-top: 13px;width: 56%; " src="http://localhost/cybercoupon/img/backend/loader.gif">
				</div>
				<input type="button" style="width: auto; margin-top: 2px;margin-left:50px;" value="Make Active" class="sub-bttn bulk_user_active">
				<div style="display:none;left: 18%;position: absolute; " class="image_display_make_active">
					<img style="margin-left:0px;margin-top: 13px;width: 56%; " src="http://localhost/cybercoupon/img/backend/loader.gif">
				</div>
			</div>
			<?php
			}
			 echo $this->element('backend/table_head100');
		  ?>
			
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>