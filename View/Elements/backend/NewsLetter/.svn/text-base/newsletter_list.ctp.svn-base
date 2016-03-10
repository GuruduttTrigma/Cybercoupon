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
.result-found-text {
    color: green;
    float: right;
    font-size: 13px;
    font-weight: bold;
    padding: 10px 0 ;
}
</style>
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
		/* var test_str = $('.pagedisplay').val();
		var n=test_str.indexOf("to");
		var n2=test_str.indexOf("of");
		var no_of_record = parseInt(test_str.substring(n+2,n2).trim()); */
		
		if($(this).is(':checked'))
		{
			$(".chk").each(function(){
				this.checked=true;
			})  
		}
		else
		{
			$(".chk").each(function(){
				this.checked=false;
			}) 
		}
	});
	
	$('.chk').live('click',function(){
		$('.multi_check').removeAttr('checked');
	});
	$('.approve_daily_newsletter').live('click',function(){
	
		/* var test_str = $('.pagedisplay').val();
		var n=test_str.indexOf("to");
		var n2=test_str.indexOf("of");
		var no_of_record = parseInt(test_str.substring(n+2,n2).trim()); */
		
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
	<div style="float:left; width:100%; margin-bottom:8px;" class="">
		<?php
		if($subadmin_type==1 ||@$modulepermissions['NewsLetter']['module_edit']==1) 
		{ 		  
		?>
			<input class="sub-bttn approve_daily_newsletter" type="button" value="Move ad/s to Approved & Not sent" rel="submit" style="width: 250px; margin-top: 2px;margin-left:0;"/>
		<?php
		}
		?>
		<div class="result-found-text">
			<?php echo count($newslist);?> Results Found
		</div>
		<div class="image_display" style="display:none;left: 30%;position: absolute; ">
			<img src="<?php echo HTTP_ROOT.'img/backend/loader.gif';?>" style="margin-left:0px;margin-top: 13px;width: 56%; "/>
		</div>
	</div>
	<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
	
		<div class="hastable">
         <?php /*?><?php echo $this->element('adminElements/table_head'); ?><?php */?>
			<table id="sort-table"> 
				<thead> 
					<tr>
						<th style="width:10px;" class="all">All<input type="checkbox" class="multi_check"></th>
						 <th style="width:auto;">Image</th>
						<th style="width:auto;">Deal Title</th>
						<!--<th style="width:auto;">Supplier Email</th>-->
						<th style="width:auto;">Location</th>  
						<th style="width:auto;">Category </th>
						<!--<th style="width:auto;">Sent On </th>-->
						<th style="width:auto;">Requested NewsLetter Date</th>
						<th style="width:110px;">Newsletters Status</th>
						<th style="width:110px;">Date Last Ad Ran</th>
						<th style="width: 145px;" class="rmv_sort">Action</th>
					</tr> 
				</thead> 
				<tbody> 
					<?php
					
						if(!empty($newslist))
						{ $i = 0;
							foreach($newslist as $data)
							{  $i++;
						    $viewQuery = ClassRegistry::init('DispatchDeal'); 
							$last_sent_news = $viewQuery->find('first',array('fields'=>array('Dispatch.sent_date'),'order'=>'DispatchDeal.id desc','conditions'=>array('DispatchDeal.supplier_id'=>$data['Deal']['member_id'],'Dispatch.status'=>'sent')));
							//pr($last_sent_news);die;
							$last_sent_newsletter =  @$last_sent_news['Dispatch']['sent_date'];  
							if(trim($last_sent_newsletter) =='')
							{
								$last_sent_newsletter = '';
							}							
						?>
                    <tr>
						<td><input type="checkbox" name="data[Deal][id][<?php echo $i; ?>]" value="<?php echo $data['Deal']['id'];?>" class="chk single_check_<?php echo $i;?>"></td>
						<td><img src="<?php echo IMPATH.'deals/'.$data['Deal']['image'].'&w=250&h=100';?>"/>		</td>
                    	<td><?php echo $data['Deal']['name']?></td>
						<!-- <td><?php echo substr(wordwrap($data['Member']['email'],100,'...'),0,101); ?></td>-->
                        <td>
                        <?php 
                            $sub_deals=explode(',',$data['Deal']['location']);
                            array_unique($sub_deals);
                            $location_name="";
                            foreach($loc as $deal_loc)
                            {
                              if(in_array($deal_loc['Location']['id'],$sub_deals))
                              {
                                $location_name.=$deal_loc['Location']['name'].", ";
                              }
                            }
                            $location_name=rtrim($location_name,', ');
                            //echo substr(wordwrap($location_name,40,'...'),0,40);
                            echo $location_name;
                        ?>
                        </td> 
						<td><?php echo $data['DealCategory']['name']; ?></td> 
						<!--<td><?php echo @$data['Deal']['newsletter_sent_date']?date('d M Y',strtotime($data['Deal']['newsletter_sent_date'])):'Not Yet Sent'; ?></td>--> 
						<td><?php echo date('d F Y',strtotime($data['Deal']['newsletter_sent_date'])); ?></td> 						
						<td>
						<?php 
							$data1 = new DateTime('');
							$data2= new DateTime($data['Deal']['newsletter_sent_date']);
							$overdue = $data2->diff($data1);
							//echo $data1->format('d m y').'<br>';
							//echo $data2->format('d m y').'<br>';
							//echo $overdue->format('y m d');
							if(date('d M Y',strtotime($data['Deal']['newsletter_sent_date']))==date('d M Y')) 
							{	
								echo "Not Sent Yet";
							}
							else 
							{
								//echo "Overdue by ".$overdue->y . " years, " . $overdue->m." months, ".$overdue->d." days ";
								echo "Overdue by ".$overdue->format('%a')." days";	
							}
						?>
						</td>
						<td>
						<?php 
							if($last_sent_newsletter =='')
							{
								echo "Not Yet Sent";
							}
							else
							{
								echo date('d F Y',strtotime($last_sent_newsletter));
							}
						?>
						</td>
						<td>
							<?php $newsid = base64_encode(convert_uuencode($data['Deal']['id'])); ?>
							<?php $memberid = base64_encode(convert_uuencode($data['Deal']['member_id'])); ?>
							<!--<a title="Last Sent NewsLetter" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Manages/view_sent_newsletter/".$memberid; ?>">	
								<span class="ui-icon ui-icon-search"></span>
							</a>-->
							<a title="Edit" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Manages/editDeal_newsletter/".$newsid; ?>">	
								<span class="ui-icon ui-icon-pencil"></span>
							</a>
							<a title="Remove From NewsLetter" class="btn_no_text btn ui-state-default ui-corner-all tooltip ui-state-hover msg_show" href="javascript:void(0);">								
								<span class="ui-icon ui-icon-bookmark"></span>
							</a>
							<input type = "hidden" name = "user_name" value = "<?php echo $data['Member']['name']; ?>">
							<input type = "hidden" name = "user_email" value = "<?php echo $data['Member']['email']; ?>">
						</td>						
                    </tr> 
					<?php	
							}
						} else {
					?>
						<tr>
							<td colspan="8">No Record Found.</td>
						</tr>
					<?php		
						}
					?>					
				</tbody>
			</table>
			<div style="float:left;">
             <ul class="pagination sales_total_pagination" style="align:center;">
				<?php if($this->params['paging']['Deal']['pageCount']>1) { ?> 		   
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