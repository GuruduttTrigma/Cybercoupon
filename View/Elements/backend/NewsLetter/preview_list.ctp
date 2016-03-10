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
$(".all").children("span").removeClass('ui-icon');
$(".rmv_sort").children("span").css("margin-top",'12px');
});
$(document).ready(function(){
	$('.multi_check').live('click',function(){ 
		var test_str = $('.pagedisplay').val();
		var n=test_str.indexOf("to");
		var n2=test_str.indexOf("of");
		var no_of_record = parseInt(test_str.substring(n+2,n2).trim());
		if($(this).is(':checked'))
		{
			var i=1;
			for(i=1;i<=no_of_record;i++)
			{
				$('.single_check_'+i).attr('checked','checked');
			}
		}
		else
		{
			var i=1;
			for(i=1;i<=no_of_record;i++)
			{
				$('.single_check_'+i).removeAttr('checked');
			}
		}
	});
	
	$('.chk').live('click',function(){
		$('.multi_check').removeAttr('checked');
	});
	$('.po').live('click',function(){
	
		var test_str = $('.pagedisplay').val();
		var n=test_str.indexOf("to");
		var n2=test_str.indexOf("of");
		var no_of_record = parseInt(test_str.substring(n+2,n2).trim());
		var post={};
		var count = 0;
		$('.chk').each(function(key,value){
			if($(this).is(':checked'))
			{
				count++;
				post[key]=$(this).val();
			}
		 });
		var action=$('#action_list').val();
		
		if(count>0)
		{
			$(".image_display").show();
			$.ajax({
					url:ajax_url+'NewsLetters/active_daily_deal',
					type:'post',
					data:post,
					success:function(resp)
					 {
					 //alert('hi')
						$('.image_display').css('display','none');
						window.location.href=ajax_url+"admin/NewsLetters/newsletter";
					 }
			});
		}
		else
		{
			alert("Please check at least one checkbox");
		}
		
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
						<th style="width:10px;" class="all">All<input type="checkbox" class="multi_check"></th>
						 <th style="width:auto;">Image</th>
						<th style="width:auto;">Title</th>
						<th style="width:auto;">Description</th>
						<th style="width:auto;">Location</th>  
						<th style="width:auto;">Category </th>
						<th style="width:auto;">Sent On </th>
						<th style="width:auto;">Newsletters Status</th>
                        
						          <!-- <th style="width: 145px;" class="rmv_sort">Action</th> -->
					</tr> 
				</thead> 
				<tbody> 
					<?php
					
						if(!empty($newslist))
						{ $i = 0;
							foreach($newslist as $data)
							{  $i++;
						?>
                    <tr>
						<td><input type="checkbox" name="data[Deal][id][<?php echo $i; ?>]" value="<?php echo $data['Deal']['id'];?>" class="chk single_check_<?php echo $i;?>"></td>
						<td><img src="<?php echo IMPATH.'deals/'.$data['Deal']['image'].'&w=250&h=100';?>"/>		</td>
                    	<td><?php echo $data['Deal']['name']?></td>
                        <td><?php echo substr(wordwrap($data['Deal']['description'],100,'...'),0,101); ?></td>
                        <td><?php echo $data['Location']['name']; ?></td> 
						<td><?php echo $data['DealCategory']['name']; ?></td> 
						<td><?php echo @$data['Deal']['newsletter_sent_date']?date('d M Y',strtotime($data['Deal']['newsletter_sent_date'])):'Not Yet Sent'; ?></td> 
						<td><?php 
									if(date('d M Y',strtotime($data['Deal']['newsletter_sent_date']))==date('d M Y')) 
									{	
									
										echo "Current";
									}
									else 
									{
									
									echo "Overdue";	
									}
							  ?>
						</td>
                        <?php /*?>
                          <td>
                            <?php $newsid = base64_encode(convert_uuencode($data['Deal']['id'])); ?>
													   <a title="View" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/view_member/".$newsid; ?>">	
                                <span class="ui-icon ui-icon-search"></span>
                            </a>
                            
                            <? 
                            if($data['Member']['status']=="Active")
							{
								?>
                              <a title="Add To NewsLetter" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/statusMember/".$newsid; ?>">
                                <span class="ui-icon ui-icon-bookmark"></span>
                            </a>
                            <?php
							}
							else
							{
							?>

                            <a title="Remove From NewsLetter" class="btn_no_text btn ui-state-default ui-corner-all tooltip ui-state-hover" href="<?php echo HTTP_ROOT."admin/Members/statusMember/".$newsid; ?>">
                                <span class="ui-icon ui-icon-bookmark"></span>
                            </a>
                            <?php
							}
							?>
                        </td>
						<?php */ ?>
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
			<div style="float:left; width:100%; margin-top:8px;" class="">
         
				</div>
				<div style="float:left;">
             <?php echo $this->element('backend/table_head'); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>