<?php echo $this->Html->css('frontend/bootstrap-select.css');
 echo $this->Html->script('frontend/design/bootstrap-select.js');?>


<?php

	$phpSelf = explode('/',$_SERVER['REQUEST_URI']);

	$myAction = end($phpSelf);
//echo "<pre>";print_r($phpSelf);
//echo $myAction;
//die;
	if($myAction=="")
	{
		$myAction=$phpSelf[1];
	}
$contrl_action='';
 if(@$phpSelf[2]!='' && @$phpSelf[3]!='')
 {    
    $quest_exist=strrpos($phpSelf[3], "?");
    if($quest_exist)
    {
       $quest_action=explode('?',$phpSelf[3]);
       $find_action =$quest_action[0];
    }
    else
    {
       $find_action=$phpSelf[3];
    }   

    $contrl_action=$phpSelf[2]."/".$find_action;
 }
//echo $contrl_action;
//pr($phpSelf);
//echo "<br>";
//pr($myAction);
//echo "<pre>";print_r($cart_member);die;
?>
<!-- header area page -->
<style>
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
    background-color: #72b626;
    
}
.singup{
font-weight:bold;
font-size:20px;
}
.loged{
font-weight:bold;
font-size:20px;
}
.log_sign{
font-size:16px;
}
.referStatus_success {
    background-color: #cbfdd6;
    border: 1px solid #39b053;
    clear: both;
    color: #0a601d;
    float: left;
    font-weight: bold;
    line-height: 29px;
    margin: 1%;
    text-align: center;
    width: 98%;
}
.referStatus_error {
    background-color: #F8E2E9;
    border: 1px solid #FF0015;
    clear: both;
    color: #0a601d;
    float: left;
    font-weight: bold;
    line-height: 29px;
    margin: 1%;
    text-align: center;
    width: 98%;
}
</style>
<div class="header_cyber">
		  <div class="col-lg-4 col-sm-12 col-md-5 col-xs-12">
					<div class="logo_area">
						<a href="<?php echo HTTP_ROOT; ?>"><img src="<?php echo HTTP_ROOT;?>img/frontend/logo2.png" class="img-responsive"></a>
					</div>
				</div>
				<div class="col-lg-8 col-sm-12 col-md-7 col-xs-12">
					<div class="right_contet">
						<ul class="list-unstyled list-inline pull-right">
      
        
          <?php
         
              $data =  $this->Session->read('Member.name');
              $data_id =  $this->Session->read('Member.id');
              $user_type= $this->Session->read('Member.member_type');
                  //echo $data;die;
           ?>
          <?php if(isset($data) && !empty($data) && $user_type=='2')
            { ?>
                  <li><a href="<?php echo HTTP_ROOT;?>Customers/view_profile/<?php echo $data_id;?>"><span class="glyphicon glyphicon-user"></span><span><?php echo ucfirst($data);?></span></a></li>
                  <li><a href="<?php echo HTTP_ROOT;?>Customers/logout"><span class=" glyphicon glyphicon-log-out"></span>logout</a></li>
           <?php
				}
            else if(isset($data) && !empty($data) && $user_type=='3')
             {
            ?>
                   <li><a href="<?php echo HTTP_ROOT.'homes/suppliers_faq';?>"><span class="glyphicon"></span><span>Supplier FAQ</span></a></li>
				       <li><a href="<?php echo HTTP_ROOT; ?>welcome_pack"><span class="glyphicon"></span><span>Welcome pack, click here</span></a></li>
                   <li><a href="<?php echo HTTP_ROOT;?>Suppliers/profile/<?php echo $data_id;?>"><span class="glyphicon glyphicon-user"></span><span><?php echo "My Profile";?></span></a></li>
              		 <li><a href="<?php echo HTTP_ROOT;?>Suppliers/logout"><span class=" glyphicon glyphicon-log-out"></span>logout</a></li>
           	<?php
              }
              else if(isset($data) && !empty($data) && $user_type=='4')
              {?>
                     <li><a href="<?php echo HTTP_ROOT;?>Customers/view_profile/<?php echo $data_id;?>"><span class="glyphicon glyphicon-user"></span><span class="globel_user_name"><?php echo "My Profile";?></span></a></li>
          		        <li><a href="<?php echo HTTP_ROOT;?>Suppliers/logout"><span class=" glyphicon glyphicon-log-out"></span>logout</a></li>
          <?php
              }
             else
             {
             ?> 
                <li><a href="<?php echo HTTP_ROOT;?>Homes/option/register" style="font-size: 15px;font-weight: normal;"><span class="glyphicon glyphicon-user"></span>To start receiving your benefits and discounts, 
				     <span class="singup">sign up here!</span></a></li>
					  <li><a href="<?php echo HTTP_ROOT;?>Homes/option/login" class="loged"><span class=" glyphicon glyphicon-log-in log_sign"></span>Login</a></li>
				<?php 
					}
				 ?>
         </ul>
         <p class="font_win">Win two tickets to Dubai and many more prizes! <a href="" data-toggle="modal" data-target="#competition_cms">Click here</a> for more info</p>
       <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-right padding_0">
								
		    </div>
            <!-- end of search area -->
						</div>
				</div>

				<!-- End header area page -->
				<!-- navigation area page -->
				<div class="col-lg-12 padding_0">
					<div class="navigation_wraper">
					<a href="" data-toggle="modal" data-target="#banner_cms">
						<img src="<?php echo HTTP_ROOT.'img/frontend/Badge Matching Theme.png'?>" class="lauch"/>
					</a>
						<div class="navbar navbar-default " role="navigation">
							<div class="navbar-header">
							  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    								<span class="sr-only">Toggle navigation</span>
    								<span class="icon-bar"></span>
    								<span class="icon-bar"></span>
    								<span class="icon-bar"></span>
							  </button>
							</div>
							<div class="navbar-collapse collapse">
						  <ul class="nav navbar-nav ">
							  	<li><a class="<?php echo in_array($myAction,array('cybercoupon','index'))?'active':'';?>" href="<?php echo HTTP_ROOT.'homes/index' ;?>"><span class=" glyphicon glyphicon-home"></span>Home</a></li>
								<li class="dropdown">
										<?php
										$works_arr=array('suppliers','customers','overview','faq');
										?>
            <a href="javascript:void(0);"  class="dropdown-toggle <?php echo in_array($myAction,$works_arr)?'active':'';?>" data-toggle="dropdown">How it works<b class="caret"></b></a>
								   <ul class="dropdown-menu">	
		        			<li><a class="" href="<?php echo HTTP_ROOT; ?>overview">Overview</a></li>	
		        			<li><a class="" href="<?php echo HTTP_ROOT; ?>customers">For Customers</a></li>	
		        			<li><a class="" href="<?php echo HTTP_ROOT; ?>homes/faq">Customer FAQ</a></li>	
		        			<li><a class="" href="<?php echo HTTP_ROOT; ?>suppliers">For Suppliers</a></li>	
		        		</ul>			          
          <?php
          $head_cat_arr=array();
          foreach($cateogry_head as $cat)
	         {
	            $head_cat_arr[]=$cat['id'];
           }
	         ?>
							  <li class="dropdown browr"><a class="<?php echo in_array($myAction,$head_cat_arr)||in_array($contrl_action,array('deals/alldeal'))?'active':'';?>" href="javascript:void(0);"  class="dropdown-toggle" data-toggle="dropdown">Browse Categories<b class="caret"></b></a>
									<ul class="dropdown-menu">
					<li><a class="" href="<?php echo HTTP_ROOT.'deals/alldeal'; ?>">All Deals</a></li>				
               <?php
               //$head_cat_arr=[];
               foreach($cateogry_head as $cat)
               {
                  //$head_cat_arr[]=$cat['DealCategory']['id'];
               ?>
                    <li><a class="" href="<?php echo HTTP_ROOT.'deals/alldeal/'.$cat['uri']; ?>"><?php echo $cat['name']; ?> </a></li>
               <?php 
			   } 
			   ?>
									</ul>
								</li>
								</li>
								<!--<li><a class="<?php //echo in_array($myAction,array('alldeal'))||in_array($contrl_action,array('homes/alldeal'))?'active':'';?>" href="<?php echo HTTP_ROOT.'homes/alldeal'; ?>"></span>All Deals</a></li>-->
								<!--<li><a class="<?php echo in_array($myAction,array('featured_deal'))?'active':'';?>" href="<?php echo HTTP_ROOT.'homes/featured_deal'; ?>"></span>Featured Deals</a></li>-->
								<li><a class="<?php echo in_array($myAction,array('advance_search'))?'active':'';?>" href="<?php echo HTTP_ROOT.'Homes/advance_search';?>">Search</a></li>
								<li><a class="<?php echo in_array($myAction,array('contactus'))?'active':'';?>" href="<?php echo HTTP_ROOT.'Pages/contactus';?>">Contact Us</a></li>
								<li><a class="<?php echo in_array($myAction,array('refer'))?'active':'';?>" href="javascript:void(0);" data-target="#refer_popup" data-toggle="modal">Refer a Friend</a></li>
								<?php if (isset($data) && !empty($data) && $user_type=='3') {  ?>
								<!--<li><a class="<?php echo in_array($myAction,array('suppliers_faq'))?'active':'';?>" href="<?php echo HTTP_ROOT.'homes/suppliers_faq';?>">Supplier FAQ</a></li>-->
							<?php	}  ?>
							</ul>
							</div><!--/.nav-collapse -->
						  
						</div>
					</div>
				</div>
				<!-- End navigation area page -->
</div>  <!--end of header-cyber -->  

<div class="modal fade" id="refer_popup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				  <h4 class="modal-title" id="myLargeModalLabel-1">Refer a Friend</h4>
				</div>
				<div>
				  <div class="refer_message" style="display:none;"></div>
				</div>
				<form id="refer_friend" method="POST" action="" >
					<div class="modal-body">
					
                  <div class="login_modal">
							<div class="form-group">
								<label>Your Name:</label>
								<input name="data[Refer][from_name]" type="text" class="form-control required"/>
							</div>
						</div>					
					   <div class="login_modal">
							<div class="form-group">
								<label>Your Friend's name:</label>
								<input name="data[Refer][to_name]" type="text" class="form-control required"/>
							</div>
						</div>
						<div class="login_modal">
							<div class="form-group">
								<label>Your Friend's email:</label>
								<input name="data[Refer][email]" type="text" class="form-control required email"/>
							</div>
						</div>
						<div class="login_forget_pas">
							<input type="button" value="Send" class="btn btn-success refer_a_friend_btn" style="float:left;">
							<div class="refer_loader" style="display:none;"> <img src="" ></div>
						</div>
						
					</div>
				</form>
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal mixer image -->	
	
	
	<div class="modal fade" id="competition_cms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel" style="word-wrap: break-word;"><?php echo ucfirst($competitions['CmsPage']['page_title']); ?></h4>
	      </div>
	      <div class="modal-body" style="word-wrap: break-word;">
	        <?php echo ucfirst($competitions['CmsPage']['content']); ?>
	      </div>
		  <?php
		  //pr($competitions);
			if($competition_winner['CmsPage']['link_status']=='Yes')
			{
			?>			
				<div class="modal-body" style="word-wrap: break-word;">
					<a href="<?php echo HTTP_ROOT; ?>Pages/winner_info/" target ="_blank">WInner</a>	
				</div>
			<?php 
			}
?>			
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="banner_cms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="myModalLabel" style="word-wrap: break-word;"><?php echo ucfirst($banner['CmsPage']['page_title']); ?></h4>
	      </div>
	      <div class="modal-body" style="word-wrap: break-word;">
	        <?php echo ucfirst($banner['CmsPage']['content']); ?>
	      </div>		
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			
	      </div>
	    </div>
	  </div>
	</div>
        
<script>
	$('.selectpicker').selectpicker();
</script>   
<script>
   $(document).ready(function(){
      	
      $('#refer_friend').validate();
		 
			 $('.refer_a_friend_btn').click(function(){
			 	if($('#refer_friend').valid())
		      {
		      	 $(".refer_loader").show();
			       $(".refer_loader").children('img').attr('src',ajax_url+'img/backend/loader.gif');
				      $.ajax({
				        url:ajax_url+'Customers/refer_friend',
				        type:'POST',
				        data:$('#refer_friend').serialize(),
				        success:function(resp)
				        {
				          if(resp="success")
				          {
				          	$('.refer_message').show();
				            $('.refer_message').html('You have successfully referred your friend!');
				            $('.refer_message').removeClass('referStatus_error');
				            $('.refer_message').addClass('referStatus_success');
				            $('#refer_friend').find("input[type=text]").val('');
				          }
				          else
				          {
				          	$('.refer_message').show();
				            $('.refer_message').html('Something is going wrong.');
				            $('.refer_message').removeClass('referStatus_success');
				            $('.refer_message').addClass('referStatus_error');
				          }
				          $('.refer_loader').css('display','none');
				        }
				      
				      })
				      return false;
			     }
			 })
		       	
       
      	
      	
      	
	  
	  $('.dropdown').hover(function() {

		  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(100);

		}, function() {

		  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105)

		});

       var cart_action='<?php echo $myAction;?>';
           $('.cart').hover(function(){
              $('.card_main1').show();
            });
            $('.header_cyber').hover(function(){
              $('.card_main1').hide();
            });
             $('.cart_ip').hover(function(){        

             $('.card_main1').show();
            });
            $('.header_cyber').hover(function()
            {
              $('.card_main1').hide();
            });

           /*----------For deal seraching by location from header----------------*/
          $('#location').on('change',function(){
                $('#search_form').submit();
                
            });
          $('.global_serach').on('click',function(){
                $('#search_form').submit();
                
            });
  });
</script>                           
