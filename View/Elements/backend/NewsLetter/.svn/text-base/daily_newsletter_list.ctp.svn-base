<?php echo $this->Html->script('backend/development/ui.datepicker.js');
  //echo $this->Html->css('backend/smooth.css');
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
	$('.unapprove_newsletter').live('click',function(){
	
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
			$.ajax({
					url:ajax_url+'NewsLetters/deactive_daily_deal',
					type:'post',
					data:post,
					success:function(resp)
					{
							window.location.href = ajax_url+"admin/NewsLetters/daily_newsletter";
					}
			});
		}
		else
		{
			alert("Please check at least one checkbox");
		}
		
	});
  		
  		$("#view_deals").click(function(){
    		$("#div_view_deals").toggle();
  		});
  		$("#email_preview").click(function(){
    		$("#email").toggle();
    		$("#dis").hide();
  		});
  		
  		$(function() {
		var year = (new Date()).getFullYear()
		var current_date= new Date();
		$( ".dispatch_date" ).datepicker({
			dateFormat:'d M yy',
			yearRange:'2000:'+year,
			minDate:current_date,
			changeMonth: true, 
			changeYear: true,
			timepicker:false,
		});
	})
	
		$('#frm1').validate({
			rules:
			{
				"data[member][email]":
				{
					required:true,
					//email:true,
				},
			},
			messages:
			{
				"data[member][email]":
				{
					required:'Please enter email.',
					//email:'Please enter valid email.',
				},
			}
		});
	
	/* $('#approved').live('click',function(){
			if($('#appCheck').is(':checked'))
			{
					$('#newsSend').show();
			}
			else
			{
					$('#newsSend').hide();
			}
	}) */
	
})
</script>
	<?php
			if($subadmin_type==1 ||@$modulepermissions['NewsLetter']['module_edit']==1) 
			{ 		  
			?>   
            <div class="id_cont admin_search member_search_management" style="clear:both;margin-bottom:0px; float:left" >
			    <div class="search_input">	
						<label>Please ensure that you have selected Newsletter For: </label>
						<?php
						 if(!empty($common_loc))
						 {
						 ?>
						<select style="width:200px;" class="news_loaction">
							<?php foreach($common_loc as $common_list){
								$common_list_id=base64_encode(convert_uuencode($common_list['Location']['id']));
								 ?>
								<option value="<?php echo $common_list_id;?>" <?php if($common_list_id==$selected_news_loc){?> selected="selected" <?php } ?> ><?php echo $common_list['Location']['name'];?></option>
							<?php } ?>
						</select>
						<?php
						}
						else
						{
						?>
						   <select style="width:200px;">
								<option value="">N/A</option>
						   </select>
						<?php
						}
						?>
				 </div>
			</div>				  
			 <?php
			 }
			 ?>
	<b style="font-size:20px;background-color:#e6e6e6; clear:both; float:left;" >
	<?php 
	$number_newsletters = count($newslist);
	//echo $number_newsletters;
	if($number_newsletters)
	{
		echo "Total ads ".$number_newsletters;
	}
	elseif(count($newslist) == 0)
	{
		echo "Empty";
	}
	else
	{
		echo "Total ad ".$number_newsletters;
	}
	?>
	</b>
	<div id="page-content">
	
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<div class="hastable">
         <?php /*?><?php echo $this->element('adminElements/table_head'); ?><?php */?>
			<table id="sort-table"> 
				<thead> 
					<tr>
					<th style="width:10px;" class="all">All<input type="checkbox" class="multi_check"></th>
					<th style="width:auto;">Image </th>
					<th style="width:auto;">Deal Title</th>
					<th style="width:auto;">Description</th>
					<th style="width:auto;">Location</th>  
					<!--<th style="width:auto;">Category </th>-->
					<th style="width:auto;">Newsletter request date</th>      
					<!--<th style="width:auto;">Back to Newsletters </th>   -->   
					</tr> 
				</thead> 
				<tbody> 
					<?php
					   $dispatched_cond=1;
						if (!empty($newslist))
						{ 
							$i = 0;
							foreach ($newslist as $data)
							{
								$i++;
								if ($data['Deal']['accept_preview']!='Yes')
								{
								   $dispatched_cond=0;
								}
						?>
                    <tr>
						<td><input type="checkbox" name="data[Deal][id][<?php echo $i; ?>]" value="<?php echo $data['Deal']['id'];?>" class="chk single_check_<?php echo $i;?>"></td>
						<td><img src="<?php echo IMPATH.'deals/'.$data['Deal']['image'].'&w=250&h=100';?>"/>		</td>
                    	<td><?php echo $data['Deal']['name']?></td>
                        <td><?php echo substr(wordwrap($data['Deal']['description'],100,'...'),0,101); ?></td>
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
						<!--<td><?php echo $data['DealCategory']['name']; ?></td>--> 
                       <td><?php echo @$data['Deal']['newsletter_sent_date']?date('d F Y',strtotime($data['Deal']['newsletter_sent_date'])):'Not Yet Sent'; ?></td> 
								<!--<td>
									<a title="Back to Newsletters" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/NewsLetters/update_daily_newsletter/".$data['Deal']['id']; ?>">
                        	   <span class="ui-icon ui-icon-star"></span>
                           </a>
								</td>  -->                 
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
			
				<div style="float:left;">
             <?php echo $this->element('backend/table_head'); ?>
			   </div>
			   
			<?php 
			if($subadmin_type==1 ||@$modulepermissions['NewsLetter']['module_edit']==1) 
			{ 		  
			?>			   
			   
           	<div style="float:left; width:100%; margin-top:3px;" class="">
         	
				<input class="sub-bttn unapprove_newsletter" type="button" value="Unapprove Deals" rel="submit" style="width: 200px; margin-top: 2px;margin-left:0;"/>
         	
				<!--<label id="approved" style="float: left;    font-size: 15px;    font-weight: 700;    margin-left: 20px;    margin-top: 2px;    padding: 8px 2px 1px 5px;    width: 100px">
						<input type="checkbox" id="appCheck" > Approved
				</label>-->
     			<?php 
        		
					if(!empty($newslist))
					{
						if($selected_news_loc!='')
						{
							$preview_href= HTTP_ROOT.'admin/NewsLetters/preview/'.$selected_news_loc;
  			   ?>      
		       <!--<input id="newsSend" class="sub-bttn" type="button" value="Preview" style="width: 170px; margin-top: 2px;margin-left:10px;  display:block;" />-->
				<a class="sub-bttn preview_a" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;" href="<?php echo $preview_href;?>"/>Preview</a>
    			<?php
						}
						else 
						{
    			     ?>
    			       	<a class="sub-bttn" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;" href="javascript:void(0);" onclick="alert('All Deals should belong to a common location.')" />Preview</a>
    			     <?php
						}
    			
					}
					else
					{
				?>	
				<a class="sub-bttn" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;" href="javascript:void(0)" onclick="alert('No one deal available for preview')" >Preview</a>
				<?php
					}
			
       		?>
       		<?php 
        		if(!empty($newslist))
					{
						if($selected_news_loc!='')
						{
					?>
						<a id="email_preview" class="sub-bttn" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;"/>Email Preview</a>
					<?php	
						}
						else
						{
						?>
							<a onclick="alert('All Deals should belong to a common location.')" class="sub-bttn" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;">Email Preview</a>
							
               <?php							
						}
  			   ?>      
				
    			<?php
					}
					else
					{
				?>	
				<a class="sub-bttn" style="background-color:#dddddd; width: 170px; height:18px; margin-top: 2px;margin-left:10px;  display:block;" href="javascript:void(0)" onclick="alert('No one deal available for email preview')" >Email Preview</a>
				<?php
					}
       		?>
       		
				<div class="image_display" style="display:none;left: 31%;position: absolute; ">
					<img src="<?php echo HTTP_ROOT.'img/backend/loader.gif';?>" style="margin-left:0px;margin-top: 13px;width: 56%;"/>
				</div>
			</div>
			<?php 
			}
			?>
			
			<div id="email" style="float:left; width:100%; margin-top:8px;display:none;" class="">
				<div style="float:left; width:100%; margin-top:8px;">
				<form id="frm1" class="email_preview_action" method="post" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/NewsLetters/email_preview/'.$selected_news_loc;?>">				
					<label class="desc">Enter Email:<em>*</em> (You can enter the multiple email separated by comma)</label>
					<div>
						<input class="field text full required" name="data[Member][email]"  type="text"/>
					</div>
					<div>
						<input class="submit sub-bttn" style="margin-top:5px;margin-left:0px;" type="submit" value="Submit"/>
					</div>
				</form>
				</div>		
			</div>
		<div class="clear"></div>
		</div>
	<div class="clear"></div>
</div>