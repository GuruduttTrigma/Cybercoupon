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
</style>
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
<script type="text/javascript" >
$(document).ready(function(){
	$('.send_otp').live('click',function(){
	var ids = $(this).data('id');
	var mailId = $(this).attr('rel');
     $.ajax({
     type: 'post',
     url: ajax_url+'Members/send_otp',
     data:{email :mailId,id:ids},
     success: function(msz){
         if(msz == 'done')
          {
           /*$('.send_otp').remove();
           $('.change_st').text('');
           $('.change_st').text('Active');
           $('.send_success').css('display','block');*/
           window.location=ajax_url+'admin/Members/members/ISxQYGAKYAo=';
           }
           
        }
     })
     setTimeout(function(){
      $('.send_success').css('display','none');
     },7000);
  })
  
  $('.bulk_user_email').click(function() {
      
      var member_type=$('#member_type').val();
      var total_checked=$("input:checked").not('.all_user').length;
      if(total_checked>0)
      {
         $(".image_display").show();
		   $(".image_display").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	      $.ajax({
	         type:'POST',
	         url:ajax_url+'admin/Members/bulk_usermail',
	         data:$('#usr_form').serialize(),
	         success:function(resp){
	                   $('.image_display').css('display','none');
	                   window.location=ajax_url+'admin/Members/members/'+member_type;
	                }
	      
	        })
        }
        else
        {
           alert('Please select atleast one user.')
        }
  
  }) 
  $('.bulk_user_active').click(function(){
      
      var member_type=$('#member_type').val();
      var total_checked=$("input:checked").not('.all_user').length;
      if(total_checked>0)
      {
         $(".image_display_make_active").show();
		   $(".image_display_make_active").children('img').attr('src',ajax_url+'img/backend/loader.gif');
	      $.ajax({
	         type:'POST',
	         url:ajax_url+'admin/Members/bulk_useractive',
	         data:$('#usr_form').serialize(),
	         success:function(resp){
	                   $('.image_display_make_active').css('display','none');
	                   window.location=ajax_url+'admin/Members/members/'+member_type;
	                }
	      
	        })
        }
        else
        {
           alert('Please select atleast one user.')
        }
  
  })   
  
  
})
</script>
<script type="text/javascript" >
$(document).ready(function(){
	$('.first_step_approval').live('click',function(){
		var ids = $(this).data('id');
		var mailId = $(this).attr('rel');
     $.ajax({
     type: 'post',
     url: ajax_url+'Members/admin_sendpdf',
     data:{email :mailId,id:ids},
     success: function(msz){
         if(msz == 'done')
          {
           /*$('.send_otp').remove();
           $('.change_st').text('');
           $('.change_st').text('Active');
           $('.send_success').css('display','block');*/
           window.location=ajax_url+'admin/Members/customers/ISxQYGAKYAo=';
           }
           
        }
     })
     setTimeout(function(){
      $('.send_success').css('display','none');
     },7000);
  });
  
  $('.all_user').click(function(){
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
      
      var total_checkbox=$('input[type=checkbox]').not('.all_user').length;
      var total_checked=$("input:checked").not('.all_user').length;
	 
      if(total_checked<total_checkbox)
      {
          $('.all_user').attr('checked',false);
      }
      if(total_checked==total_checkbox)
      {
          $('.all_user').attr('checked',true);
      }
     
  });
  /*$('.pagesize').change(function(){
  
      var total_checkbox=$('input[type=checkbox]:visible').not('.all_user').length;
      var total_checked=$("input:checked").not('.all_user').length;
      if(total_checked<total_checkbox)
      {
          $('.all_user').attr('checked',false);
          $('.each_user:visible').attr('checked',true);
      }
      if(total_checked==total_checkbox)
      {
          $('.all_user').attr('checked',true);
          $('.each_user:visible').attr('checked',true);
      }
  
 
      
  
  })*/
  
});
</script>


<?php
	//echo $member_type;die;
    if($member_type=='4')
    {
        $selected_module_name = 'Customer' ;
    }    
?>
<div id="page-content">
	<div id="page-content-wrapper" style="padding:0; margin:0; background:0; box-shadow:0 0 0 0 #fff;">
		<b style="font-size:20px;">
			<?php echo 'Total '.$selected_module_name."s".": ".$totalMemember." "; ?>
		</b>	
		<b style="font-size:20px;float:right;">
			<?php echo 'Search Result: '.$totalMem." ".$selected_module_name."s"; ?>
		</b>		
		<div class="hastable">
			<form id="usr_form" method="post" >
			<table id="sort-table"> 
				<thead> 
					<tr>
					   <th style="width:auto;" class="rmv_sort"><input type="checkbox" class="all_user" style="float:left;"/>All</th>
						<th style="width:auto;">First Name</th>
						<th style="width:auto;">Surname</th>						
						<th style="width:auto;">Email</th>
						<th style="width:auto;">Password</th>
						<th style="width:auto;">Member Type</th>                       
						<th style="width:auto;">Location</th>
						<th style="width:auto;">Register Date</th>
						<th style="width:auto;">Register By</th>
						<th style="width:auto;">Status</th>
						<?php
						if($subadmin_type==1 || @$modulepermissions['Members']['module_edit']==1)
						{
						?>
						<th style="width:280px;" class="rmv_sort">Action</th> 
						<?php 
						}
						?>
					</tr> 
				</thead> 
				<tbody class="tbody_tr"> 
				<?php	
					if(!empty($member))	
					{	?>				
					<input type="hidden" id="member_type" name="data[User][member_type]" value="<?php echo base64_encode(convert_uuencode($member_type));?>" >
					<?php
					foreach($member as $data)
					{	?>
					<tr>
						<td><input type="checkbox" name="data[User][user_id][]" value="<?php echo $data['Member']['id']; ?>" class="each_user"/></td>						
						<td><?php echo $data['Member']['name']?></td>
						<td><?php echo $data['Member']['surname']?></td>	
						<td><?php echo $data['Member']['email']; ?></td>
                  <td>
						<?php 
							if($data['Member']['password_copy'] !='') :
								echo $data['Member']['password_copy']; 
							else :
								echo "N/A";
							endif;
						?>
						</td>
						<td>Customer</td>                       
						<td><?php echo $data['Location']['name']; ?></td> 
						<td><?php echo date('d F Y',strtotime($data['Member']['registered'])); ?></td>
						<?php if($member_type=='4') { ?>
						<td>
							<?php 
							if($data['Member']['uploadedBy'] == 'CSV') 
							{
								echo "CSV";
							}
							else
							{
								echo "Without CSV";
							}
							?>
						</td>
						<?php } ?>						
						<?php 
						if(
						$member_type=='4' && $data['Member']['status']=="Inactive"
						&&
						$data['Member']['first_step_approval']=="Yes" 
						&&
						$data['Member']['second_step_approval']=="Yes" 
						) 
						{
						?>
						<td>
						<?php 
							echo "Suspended"; 							
						?>
						</td>
						<?php 
						}
						elseif(
						$member_type=='4' 
						&& 
						$data['Member']['status']=="Active"
						&&
						$data['Member']['first_step_approval']=="Yes" 
						&& 
						$data['Member']['second_step_approval']=="Yes" 
						) 
						{
						?>
						<td>
						<?php 
							echo "Unsuspended"; 							
						?>
						</td>
						<?php 
						}
						else
						{
						?>
						<td><?php echo $data['Member']['status']; ?></td>
						<?php
						}
						if($subadmin_type==1 || @$modulepermissions['Members']['module_edit']==1)
						{
						?>
                        <td>
						<?php 
							$newsid = base64_encode(convert_uuencode($data['Member']['id']));
						?>
						<a title="View" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/view_member/".$newsid; ?>">	
							<span class="ui-icon ui-icon-search"></span>
						</a>
						<a title="Edit" href="<?php echo HTTP_ROOT."admin/Members/edit_customer/".$newsid; ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip">
							<span class="ui-icon ui-icon-pencil"></span>
						</a>
						<a title="Delete" class="delRec btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/deleteMember/".$newsid; ?>" onclick="return confirm('Are you sure you want to delete this Member?');">
							<span class="ui-icon ui-icon-circle-close"></span>
						</a>
						<?php
						if($data['Member']['status']=="Active")
						{
							if(
								$member_type=='4' && $data['Member']['status']=="Active"
								&&
								$data['Member']['first_step_approval']=="Yes" 
								&&
								!empty($data['Member']['member_approve_first_step_approval'])
							) 
							{
								$admin_name1 = $data['ApprovalSupplier1']['name'].' '.$data['ApprovalSupplier1']['surname'];
							?>
								<a title="<?php echo "Unsuspended By ".$admin_name1.' On '.date('d F Y',strtotime($data['Member']['date_approve_first_step_approval'])); ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/statusMember/".$newsid; ?>">
									<span class="ui-icon ui-icon-lightbulb"></span>
								</a>
							<?php
							}
							elseif(
								$member_type=='4' && $data['Member']['status']=="Active"
								&&
								$data['Member']['first_step_approval']=="Yes" 
								&&
								empty($data['Member']['member_approve_first_step_approval'])
							) 
							{
								$admin_name1 = $data['ApprovalSupplier1']['name'].' '.$data['ApprovalSupplier1']['surname'];
							?>
							<a title="Suspended " class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/statusMember/".$newsid; ?>">
								<span class="ui-icon ui-icon-lightbulb"></span>
							</a>
							<?php
							}
							else
							{
							?>
							<a title="Declined" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT."admin/Members/statusMember/".$newsid; ?>">
								<span class="ui-icon ui-icon-lightbulb"></span>
							</a>
							<?php
							}
						}								
						else
						{
							if(
								$member_type=='4' && $data['Member']['status']=="Inactive"
								&&
								$data['Member']['first_step_approval']=="Yes" 
							) 
							{
							$admin_name2 = $data['ApprovalSupplier2']['name'].' '.$data['ApprovalSupplier2']['surname'];

						?>
							<a title="<?php echo "Suspended By ".$admin_name2.' On '.date('d F Y',strtotime($data['Member']['date_approve_second_step_approval']));  ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip ui-state-hover" href="<?php echo HTTP_ROOT."admin/Members/statusMember/".$newsid; ?>">
								<span class="ui-icon ui-icon-lightbulb"></span>
							</a>
						
						<?php 
							}
							else
							{
							?>
							<a title="Approved" class="btn_no_text btn ui-state-default ui-corner-all tooltip ui-state-hover" href="<?php echo HTTP_ROOT."admin/Members/statusMember/".$newsid; ?>">
								<span class="ui-icon ui-icon-lightbulb"></span>
							</a>
						<?php
							}
						}
						if($data['Member']['member_type']=='4')
						{
						?>
							<a title="Email" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT.'admin/Members/email_member/'.$newsid; ?>">	
								<span class="ui-icon ui-icon-mail-open"></span>
							</a>
						<?php
						}
						if($data['Member']['member_type']=='4')
						{
							?>
							<a title="Resend Activation Link" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="<?php echo HTTP_ROOT.'admin/Members/resend_customer_activation/'.$newsid; ?>">	
								<span class="ui-icon ui-icon-mail-closed"></span>
							</a>
						<?php
						}
					}//END ABOVE THE edit permission of if condition on else condition
                        
            } // end of else condition.
            ?>
			</td>
         </tr>
			<?php
				 } // end of foreach 
				 // end of not empty section.
			else
			{
				?>
				<tr>
					<td colspan="7">No Records Found.</td>
				</tr>
				<?php		
			}
			?>					
				</tbody>
			</table>
			</form>
			<?php
			if($subadmin_type==1||@$modulepermissions['Members']['module_edit']==1) 
			{ 		  
			?> 
			<div class="" style="float:left; width:100%; margin-top:8px;">
				<input type="button" style="width: auto; margin-top: 2px;" value="Make Active" class="sub-bttn bulk_user_active">
				<div style="display:none;left: 18%;position: absolute; " class="image_display_make_active">
					<img style="margin-left:0px;margin-top: 13px;width: 56%; " src="<?php echo HTTP_ROOT.'img/backend/loader.gif'; ?>">
				</div>
			</div>
			<?php
			}				
			?>
			<div class="text-center">
			<ul class="pagination sales_total_pagination" style="align:center;">
				<?php if($this->params['paging']['Member']['pageCount']>1) { ?> 		   
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