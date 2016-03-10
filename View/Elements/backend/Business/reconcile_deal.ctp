<?php echo $this->Html->script('backend/development/ui.datepicker.js');
$total = 0.0;
//$idz = array();
 ?>
 <!--
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
-->
<style>
.ttl {
    float: right;
    font-size: 20px;
    margin-top: 10px;
	width:100%;
}
.paymentbtn {
    float: left;
    margin-top: 10px;
}
.ppl{
	font-size: 15px;
	font-weight:bold;
	font-style: oblique;
}
.ddl{
	margin-top:10px;
	width:100%;
	float:left;
}
.paty{
	width:21%;
}
.rht{
	float:right;
}
</style>
	<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<div class="hastable">
         <?php /*?><?php echo $this->element('adminElements/table_head'); ?><?php */?>
			<table id="sort-table"> 
				<thead> 
					<tr>
                        <th style="width:auto;">Image</th>
                        <th style="width:auto;">Deal Name</th>
                       
                        <th style="width:auto;"> From</th>
                        <th style="width:auto;"> To</th>
                         <th style="width:auto;"> Category</th>      
						<th style="width:auto;"> Total Item (sales)</th>    
						
						<th style="width:auto;"> Total Amount</th>    
                        <!--<th style="width: 160px;" class="rmv_sort">Action</th> -->
					</tr> 
				</thead> 
				<tbody> 
				
					<?php	
					if(!empty($deal_list))
					{					
						foreach($deal_list as $data):	
						
						$total += @$data['Deal']['total_amount']?$data['Deal']['total_amount']:0;
					?>
                <tr>
					<td class="td_padding" data-title="Image"  width="55" style="border-bottom:none;"><img src="<?php echo IMPATH.'deals/'.$data['Deal']['image'].'&w=50&h=50';?>" class="img-responsive img-circle"/></td>
                    <td><?php echo $data['Deal']['name']; ?></td>       
                     
                     <td><?php echo $data['Deal']['buy_from']; ?></td>            
                     <td><?php echo $data['Deal']['buy_to']; ?></td>   
					 <td><?php echo $data['DealCategory']['name']; ?></td>  
					 <td><?php echo @$data['Deal']['item_count']?$data['Deal']['item_count']:'0'; ?></td> 
					 
					 <td><?php echo @$data['Deal']['total_amount']?$data['Deal']['total_amount']:'0.00'; ?></td> 
                     
                         <?php /*?>                    
                     	<td>
                           <?php $newsid = base64_encode(convert_uuencode($data['Deal']['id'])); ?>
						   
                               <a title="Reconcile" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Business/reconcile/".$newsid; ?>">	
                               	<span class="ui-icon ui-icon-suitcase"></span>
                               </a>
							 
                         <?php
                          if($subadmin_type==1||@$modulepermissions['Deals']['module_edit']==1)
            			            {
                             if($subadmin_type==1||($subadmin_type==2 && (@$modulepermissions['Deals']['edit_permission']==1)))
                    			        {
                          ?>    
                              <!-- <a title="Edit" href="<?php echo HTTP_ROOT."admin/Manages/edit_claim/".$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
                                    <span class="ui-icon ui-icon-pencil"></span>
                                </a>-->
                         <?php
                              }
                             
                              
                           ?>
                          </td>
						  <?php */ ?>
                     </tr>  
                <?php
                   //}  //for module edit condition
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
			<div class="llo">
				<div class="paty">
					<div class="ttl">
						<label> Total : </label>
						<span class="rht"><?php echo @$total?$currency.''.$total:'0.00'; ?></span>
					</div>
					
					<div class="ttl">
						<label> Cybercoupon(<?php echo $mem_info['MemberMeta']['cybercoupon%']; ?>%) : </label>
						<span class="rht"><?php echo @$total?$currency.''.(($total*$mem_info['MemberMeta']['cybercoupon%'])/100):'0.00'; ?></span>
					</div>
					<div class="ttl">
						<label> Supplier(<?php echo $mem_info['MemberMeta']['supplier%']; ?>%) : </label>
						<span class="rht"><?php echo @$total?$currency.''.(($total*$mem_info['MemberMeta']['supplier%'])/100):'0.00'; ?></span>
					</div>
				</div>
				
			</div>
			<div class="ddl">
				<?php if ($total>0.0) { ?>
					<span class="ppl">Note: Please assured that you have already made payment to this supplier before submit the 'Payment Release' button.</span>
				<?php } ?>
				</div>
			<div class="paymentbtn">
				<?php if ($total>0.0) { ?>
					<input type="button"   value="Payment Release" class="sub-bttn paidamount" style="width:125px; height:34px;float: right; margin-left:0;" />
				<?php } ?>
			</div>
             <?php //echo $this->element('backend/table_head'); ?>
			
		</div>
		<div class="clear"></div>
	</div>
	</div>
	<div class="clear"></div>
</div>

