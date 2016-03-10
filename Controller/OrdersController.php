<?php
ob_start();
class OrdersController extends AppController
{
	var $name = "Orders";
	var $helper=array('Html','Form','Js','Session','Tool');
	var $components = array('RequestHandler','Cookie','Session','Email','resizeback');
	var $uses=array('Example','Order','OrderDealRelation','OrderProductRelation','Payment','GuestUser','Member','MemberAddress','OrderStatus','Product','EmailTemplate');
	
	function beforeFilter()
	{
		$this->disableCache();
		parent::beforeFilter();
		if(!$this->CheckAdminSession() && $this->request->prefix=='admin' && !in_array($this->request->action,array('admin_login','admin_forgot_password','admin_reset_password')))
		{    
			$this->redirect(array('controller'=>'users','action' => 'login','admin' => true));
			exit();
		}	
	}

	function admin_order()
	{
		$this->layout = 'admin';
  		$this->Session->delete('order_sess');
		$this->Order->virtualFields = array('dealName'=>'SELECT name FROM deals WHERE deals.id = Order.deals_id');
  		if(!empty($this->request->data))
  		{
			//pr($this->request->data);die;
			$order_sess = $_POST;
			$this->Session->write('order_sess',$order_sess);
			$order_no = trim($_POST['data']['Order']['order_no']);
			$deal_name = trim($_POST['data']['Deal']['name']);
			$voucher_no = trim($_POST['data']['OrderDealRelation']['voucher_code']);
			$transaction_id = trim($_POST['data']['Order']['transaction_id']);
			$customer_email = trim($_POST['data']['Member']['email']);
			$conditions=array();
			//echo $transaction_id;die;
			if($order_no!="")
			{
				  $conditions=array_merge($conditions,array('Order.order_no LIKE'=>'%'.$order_no.'%'));
			}
			if($deal_name!="")
			{
				  $conditions=array_merge($conditions,array('Order.dealName LIKE'=>'%'.$deal_name.'%'));
			}
			if($voucher_no!="")
			{
				  $voucher_conditions=array('OrderDealRelation.voucher_code'=>trim($voucher_no));
			}
			if($transaction_id!="")
			{
				  $conditions=array($conditions,array('Order.transaction_id LIKE'=>'%'.$transaction_id.'%'));
			}
			if($customer_email!="")
			{
				  $conditions=array_merge($conditions,array('Member.email LIKE'=>'%'.$customer_email.'%'));
			}
    	}
  		if(@$conditions!="")
  		{
			//pr($customer_email);die;  
    		$conditions=array_merge($conditions,array('Order.delete_status NOT'=>'Admin-del','Order.order_status NOT'=>'failed','Order.order_status !='=>'cancelled'));
    		if(!empty($voucher_conditions))
    		{
    			$voucher_deal=$this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.voucher_code'=>$voucher_conditions)));
    			$voucher_order_id=$voucher_deal['OrderDealRelation']['order_id'];
			   $all=$this->Order->find('all',array('order'=>'Order.id desc','conditions'=>array('Order.id'=>$voucher_order_id),'contain'=>array('OrderDealRelation'=>array('Deal'=>array('fields'=>array('name'))),'Member'=>array('fields'=>array('name','surname','email')))));
			}
			else
			{
				$all=$this->Order->find('all',array('order'=>'Order.id desc','conditions'=>$conditions,'contain'=>array('OrderDealRelation'=>array('Deal'=>array('fields'=>array('name'))),'Member'=>array('fields'=>array('name','surname','email')))));
			}    		
    		 		
    		//pr($all);die;	
			//$this->paginate=array('order'=>'Order.id desc','limit'=>10,'contain'=>array('OrderDealRelation'=>array('Deal'=>array('DealOption'))));
			//$conditions=array_merge('Order.delete_status NOT'=>'Admin-del');
			//$all=$this->paginate('Order',$conditions);   
    		$this->set(compact('all'));
  		}
  		else
  		{
			$conditions=array('Order.delete_status NOT'=>'Admin-del','Order.order_status NOT'=>'failed','Order.order_status !='=>'cancelled');
			$all=$this->Order->find('all',array('order'=>'Order.id desc','conditions'=>$conditions,'contain'=>array('OrderDealRelation'=>array('Deal'=>array('fields'=>array('name'))),'Member'=>array('fields'=>array('name','surname','email')))));
    		$this->set(compact('all'));
			//pr($all);die;	
  		}
  		if($this->RequestHandler->isAjax())
  		{
    			$this->layout='';
    			$this->autoRender=false;
    			$this->viewPath='Elements'.DS.'backend'.DS.'Orders';
    			$this->render('order_list');
  		}
	}

	function admin_delete_order($id=null)
	{
  		$this->autoRender = false;
  		$order_id = convert_uudecode(base64_decode($id));
  		if($this->Order->updateAll(array('Order.delete_status'=>"'Admin-del'"),array('Order.id'=>$order_id)))
  		{
    			$this->Session->write('success','Record has been deleted successfully');
    			$this->redirect(array('controller'=>'Orders','action'=>'admin_order'));
  		}  
	}
	
	function admin_order_status()
	{
		$order_id = $_POST['order_id'];
  		$order_status_val = $_POST['order_status_val'];
		$payment_order=$this->Order->find('first',array('conditions'=>array('Order.id'=>$order_id)));
		//echo "<pre>";print_r($payment_order);die;
		$this->loadModel('Friend');
		if(!empty($payment_order))
		{
			$memberEmail = $payment_order['Member']['email'];
			$names = $payment_order['Member']['name']." ".$payment_order['Member']['surname'];
			$this->Order->updateAll(array('Order.order_status'=>'"'.$order_status_val.'"'),array('Order.id'=>$order_id));
			/*--------------------------Email start----------------------------------*/
			$destLarge = realpath('../../app/webroot/voucher_pdf') . '/';
			foreach($payment_order['OrderDealRelation'] as $each_ordrerDealRelation)
			{
				 $pdfTitle[] = $destLarge.$each_ordrerDealRelation['voucher_pdf'];
				 $friend = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.id'=>$each_ordrerDealRelation['id'])));
				 if ($friend['OrderDealRelation']['friend_id'] != "" && $friend['OrderDealRelation']['friend_id'] != 0) 
				 {
					$friendInfo = $this->Friend->findById($friend['OrderDealRelation']['friend_id']);
					if ($friendInfo['Friend']['friend_email'] != "") 
					{
						$memberEmail = $friendInfo['Friend']['friend_email'];
						$names = $friendInfo['Friend']['gift_to'];
					}
				 }
			}
 
			$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'order_eft')));
			$common_template= $emailTemp1['EmailTemplate']['description'];
			$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
			$common_template = str_replace('{name}',$names,$common_template);
			$email = new CakeEmail();
			$email->template('common_template');
			$email->emailFormat('both');
			$email->viewVars(array('common_template'=>$common_template));       
			$email->to($memberEmail);
			//$email->cc('promatics.gautam@gmail.com');
			//$email->from($emailTemp1['EmailTemplate']['from']);
			$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Your Order'));
			$email->subject($emailTemp1['EmailTemplate']['subject']);                             
			//echo '<pre>';print_r($common_template);die;
			$email->attachments($pdfTitle);
			//$email->send();	
			if($email->send())
			{
				if ($friendInfo['Friend']['friend_email'] != "")
				{
					$voucher_email = $friendInfo['Friend']['friend_email'];
					$voucher_name = $friendInfo['Friend']['gift_to'];
					$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'friend_notification')));
					//pr($emailTemp1);die;				
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
					$common_template = str_replace('{name}',$payment_order['Member']['name'],$common_template);
					$common_template = str_replace('{friend_name}',$voucher_name,$common_template);
					$common_template = str_replace('{friend_email}',$voucher_email,$common_template);							
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));       
					$email->to($payment_order['Member']['email']);
					$email->from($emailTemp1['EmailTemplate']['from']);
					$email->subject($emailTemp1['EmailTemplate']['subject']);
					//echo '<pre>';print_r($common_template);die;							
					$email->send();
				}	
				$this->Session->write('success','Order status has been changed successfully');
			}
		}
		echo 'success';die;
	}
	
	function admin_view_order($id=Null)
	{
		$this->layout='admin';
		//$this->loadModel('Order');
		$this->loadModel('OrderDealRelation');
  		$member_id=convert_uudecode(base64_decode($id));
		//pr($member_id);
  		$v_example=$this->Order->find('first',array('conditions'=>array('Order.id'=>$member_id),'contain'=>array('OrderDealRelation'=>array('Deal'=>array('DealOption')))));
  		$this->set(compact('v_example'));
  		//pr($v_example);die;
  		//$order_info=$this->Order->find('first',array('conditions'=>array('Order.id'=>$member_id),'contain'=>array('GuestUser'=>array('Country','State'),'MemberAddress'=>array('Country','State'),'BillingAddress'=>array('Country','State'))));
  		$this->set(compact('order_info'));
  		//pr($order_info);die;
	}
	
	function admin_generate_csv()
	{	    
  		$this->layout="admin";
  		$this->autoRender=false;
  		$this->loadModel('Order');
  		$this->Order->virtualFields = array('names'=>'SELECT name AS names FROM members WHERE members.id = Order.member_id','GuestName'=>'SELECT guest_name AS GuestName FROM guest_users WHERE guest_users.id = Order.guest_id');
  		$data ="Order Number, Name,Transaction Id,Total Amount,Date \n";
  		$conditions = array();
  		//echo'<pre>';print_r($allPayments);die;
  		$order_no=trim($this->Session->read('order_sess.data.Order.order_no'));
  		$user_name=trim($this->Session->read('order_sess.order_user_name'));
  		if($order_no!="") 
  		{
  			$conditions=array_merge($conditions,array('Order.order_no LIKE'=>'%'.$order_no.'%'));
  		}
  		if($user_name!="")
  		{
  			 $conditions=array_merge($conditions,array('OR'=>array('Order.names LIKE'=>$user_name.'%','Order.GuestName LIKE'=>$user_name.'%')));
  		}
  		if(!empty($conditions))
  		{
    			$conditions=array_merge($conditions,array('Order.delete_status NOT'=>'Admin-del'));
    			$allPayments=$this->Order->find('all',array('fields'=>array('order_no','txn_id','payment_gross','payment_date','names','GuestName','member_id','guest_id'),'order'=>'Order.id desc','conditions'=>$conditions));
  		}
  		else
  		{ 
  			 $allPayments=$this->Order->find('all',array('fields'=>array('order_no','txn_id','payment_gross','payment_date','names','GuestName','member_id','guest_id'),'order'=>'Order.id desc','conditions'=>array('Order.delete_status NOT'=>'Admin-del')));
  		}
  		//pr($allPayments);die;
  		foreach($allPayments as $payment)
  		{	
    			$data .= $payment['Order']['order_no'].",";
    			if($payment['Order']['member_id']!=0 || $payment['Order']['member_id']!= '0' )
    			{
    				  $data .= (@$payment['Order']['names']?$payment['Order']['names']:'Not Available').",";
    			}
    			else
    			{
    				  $data .= (@$payment['Order']['GuestName']?$payment['Order']['GuestName']:'Not Available').",";
    			}
    			$data .=$payment['Order']['txn_id'].",";
    			$data .=$payment['Order']['payment_gross'].",";
    			$data .= $payment['Order']['payment_date'].",";
    			$data .="\n";					
  		}
  		$this->Session->delete('order_sess');
  		header("Content-Type: application/csv");			
  		$csv_filename = 'Payment_list'."_".date("Y-m-d_H-i",time()).".csv";
  		header("Content-Disposition:attachment;filename=$csv_filename");
  		$fd = fopen ($csv_filename, "w");
  		fputs($fd,$data);
  		fclose($fd);
  		echo $data;
  		die();
	}	
	
	function track_order()
	{
		  $this->layout= "public";
	}

	function my_order()
	{
  		$this->layout= "public";
  		$sess_id = $this->Session->read('Member.id');
  		if($sess_id!="")
  		{
    			$mem_info = $this->Member->find('first',array('conditions'=>array('Member.id'=>$sess_id),'fields'=>array('id','image','name')));
    			$this->set(compact('mem_info'));
    			$order_info = $this->Order->find('all',array('conditions'=>array('Order.member_id'=>$sess_id,'Order.delete_status NOT'=>'User-del'),'order'=>'Order.id desc'));
    			$this->set(compact('order_info'));
  		}
  		else
  		{
  			 $this->redirect(array('controller'=>'Homes','action'=>'index'));
  		}
	}

	function order_detail($id)
	{
  		$this->layout= "public";
  		$sess_id = $this->Session->read('Member.id');
  		$order_id=convert_uudecode(base64_decode($id));
  		if($sess_id!="")
  		{
    			$v_example=$this->OrderDealRelation->find('all',array('conditions'=>array('OrderDealRelation.order_id'=>$member_id)));
    			$this->set(compact('v_example'));
    			
    			//$order_info=$this->Order->find('first',array('conditions'=>array('Order.id'=>$order_id),'contain'=>array('MemberAddress'=>array('Country','State'),'BillingAddress'=>array('Country','State'))));
    			//pr($order_info);die;			
    			$this->set(compact('order_info'));
  		}
  		else
  		{
  			 $this->redirect(array('controller'=>'Homes','action'=>'index'));
  		}
		
	}
	
	function track_order_status()
	{
		$this->autoRender = false;
		//$this->loadModel('OrderStatus');
		$order_no = $_POST['order_no'];
		$order_info = $this->Order->find('first',array('conditions'=>array('Order.order_no'=>$order_no)));
		//pr($order_info);die;
		if(!empty($order_info))
		{
			$O_date = date('Y-m-d H:i',strtotime($order_info['Order']['payment_date']));
			$O_status = $order_info['OrderStatus']['name'];
			echo "success".'OK'.$order_no.'OK'.$O_date.'OK'.$O_status;die;
		}
		else
		{
			echo "error";die;
		}
	}
	
	function update_delete_status($id=NULL)
	{
		$this->autoRender = false;
		$order_id = convert_uudecode(base64_decode($id));
		if($this->Order->updateAll(array('Order.delete_status'=>"'User-del'"),array('Order.id'=>$order_id)))
		{
			$this->Session->write('success','Record has been deleted successfully');
			$this->redirect(array('controller'=>'Orders','action'=>'my_order'));
		}
	}
	
	function admin_deleted_order()
	{
		$this->layout = 'admin';
		$this->Session->delete('order_sess1');
	  	$this->Order->virtualFields = array(
		'orderStatus'=>'SELECT name FROM order_statuses as os WHERE os.id = Order.id',
		//'dealOption'=>'SELECT option_title FROM deal_options left join order_deal_relations on deal_options.id =order_deal_relations.deal_option_id'
		);	
  		if(!empty($this->request->data))
  		{
			$order_sess1 = $_POST;
			$this->Session->write('order_sess1',$order_sess1);
			$order_no = trim($_POST['data']['Order']['order_no']);
			$user_name = trim($_POST['data']['Order']['name']);
			//$this->Order->virtualFields = array('names'=>'SELECT name AS names FROM members WHERE members.id = Order.member_id','GuestName'=>'SELECT guest_name AS GuestName FROM guest_users WHERE guest_users.id = Order.guest_id');
			$conditions=array();
			if($order_no!="")
			{
				  $conditions=array_merge($conditions,array('Order.order_no LIKE'=>'%'.$order_no.'%'));
			}
			if($user_name!="")
			{
				  $conditions=array_merge($conditions,array('DealOption.option_title LIKE'=>'%'.$user_name.'%'));
			}
  		}
  		if(@$conditions!="")
  		{
    		$conditions=array_merge($conditions,array('Order.delete_status'=>'Admin-del'));
    		//$all=$this->Order->find('all',array('conditions'=>$conditions));
			$this->paginate=array('order'=>'Order.id desc','limit'=>10,'contain'=>array('OrderDealRelation'=>array('Deal','DealOption')));
			//$conditions=array('Order.delete_status NOT'=>'Admin-del');
			$all=$this->paginate('Order',$conditions);   
    		$this->set(compact('all'));
  		}
  		else
  		{
      
    		$all=$this->Order->find('all',array('order'=>array('Order.id desc'),'conditions'=>array('Order.delete_status'=>'Admin-del'),'contain'=>array('OrderDealRelation'=>array('Deal','DealOption'))));
			$this->set(compact('all'));
    		//echo'<pre>';print_r($all);die;
  		}
  		if($this->RequestHandler->isAjax())
  		{
			$this->layout='';
			$this->autoRender=false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Orders';
			$this->render('deleted_order_list');
  		}
	}

	function admin_view_prod_order($id=Null)
	{
		$this->layout='admin';
		$member_id=convert_uudecode(base64_decode($id));
		$rel_info=$this->OrderProductRelation->find('first',array('conditions'=>array('OrderProductRelation.id'=>$member_id)));
		$prod_id=$rel_info['OrderProductRelation']['prod_id'];
		$prod_info=$this->Product->find('first',array('conditions'=>array('Product.id'=>$prod_id)));
		$this->set(compact('prod_info'));
	}

	function admin_generate_csv1()
	{	    
		$this->autoRender=false;
		$this->loadModel('Order');
		$this->Order->virtualFields = array('names'=>'SELECT name AS names FROM members WHERE members.id = Order.member_id','GuestName'=>'SELECT guest_name AS GuestName FROM guest_users WHERE guest_users.id = Order.guest_id');
		$data ="Order Number, Name,Transaction Id,Total Amount,Date \n";
		$conditions = array();
		$order_no=trim($this->Session->read('order_sess1.data.Order.order_no'));
		$user_name=trim($this->Session->read('order_sess1.order_user_name'));
		if($order_no!="")
		{
			$conditions=array_merge($conditions,array('Order.order_no LIKE'=>'%'.$order_no.'%'));
		}
		if($user_name!="")
		{
			$conditions=array_merge($conditions,array('OR'=>array('Order.names LIKE'=>$user_name.'%','Order.GuestName LIKE'=>$user_name.'%')));
		}
		if(!empty($conditions))
		{
			$conditions=array_merge($conditions,array('Order.delete_status'=>'Admin-del'));
			$allPayments=$this->Order->find('all',array('fields'=>array('order_no','txn_id','payment_gross','payment_date','names','GuestName','member_id','guest_id'),'order'=>'Order.id desc','conditions'=>$conditions));
		}
		else
		{ 
			$allPayments=$this->Order->find('all',array('fields'=>array('order_no','txn_id','payment_gross','payment_date','names','GuestName','member_id','guest_id'),'order'=>'Order.id desc','conditions'=>array('Order.delete_status'=>'Admin-del')));
		}
		//pr($allPayments);die;
		foreach($allPayments as $payment)
		{	
			$data .= $payment['Order']['order_no'].",";
			if($payment['Order']['member_id']!=0 || $payment['Order']['member_id']!= '0' )
			{
				$data .= (@$payment['Order']['names']?$payment['Order']['names']:'Not Available').",";
			}
			else
			{
				$data .= (@$payment['Order']['GuestName']?$payment['Order']['GuestName']:'Not Available').",";
			}
			$data .=$payment['Order']['txn_id'].",";
			$data .=$payment['Order']['payment_gross'].",";
			$data .= $payment['Order']['payment_date'].",";
			$data .="\n";					
		}
		$this->Session->delete('order_sess1');
		header("Content-Type: application/csv");			
		$csv_filename = 'Payment_list'."_".date("Y-m-d_H-i",time()).".csv";
		header("Content-Disposition:attachment;filename=$csv_filename");
		$fd = fopen ($csv_filename, "w");
		fputs($fd,$data);
		fclose($fd);
		echo $data;
		die();
	}
  
	function place_order()
	{    
		$this->layout='public';    
	}
	function buy_again()
	{ 
		$this->layout='public';
		if(!isset($_SESSION['take_tour']) && $_SESSION['take_tour'] != 1)
		{ 
		    $this->redirect(array('controller'=>'homes','action'=>'index'));
		}
	}
	/*-------for user buy any product to add your cart----------*/ 
	/*-------for user buy any product to add your cart----------*/ 
 
	/*-----------------------------cart to checkout page------------------------------*/
    function proceed_checkout($uri=null,$dealoption_id=null)
    {
		
        $this->layout='public';
        $this->loadModel('MemberMeta');
        $this->loadModel('Deal');
        $this->loadModel('DealOption');
		if(isset($_SESSION['take_tour']) && $_SESSION['take_tour'] == 1)
		{
			$this->redirect(array('controller'=>'orders','action'=>'buy_again'));
		
		}
        $member_id=$this->Session->read('Member.id');
        if($member_id!='')
        {
	        $mem_id =convert_uudecode(base64_decode($member_id));
	        $reference =rand(1,100000000);
	        //echo $reference;die;
	        $this->set('referenceNo',$reference);
	        $memberInfo=$this->Member->find('first',array('conditions'=>array('Member.id'=>$mem_id),'contain'=>'MemberMeta')); 
			$this->set('memberInf',$memberInfo);  
			//pr($memberInfo);die; 
	        $dealoption_id =convert_uudecode(base64_decode($dealoption_id));
	        //$order=$this->Deal->find('first',array('conditions'=>array('Deal.uri'=>$uri,'Deal.active'=>'Yes'),'contain'=>array('DealOption')));
	        $this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on order_deal_relations.order_id=orders.id and orders.order_status!="failed" where `deal_id`= Deal.id');
	        $order=$this->Deal->find('first',array('conditions'=>array('Deal.uri'=>$uri,'Deal.active'=>'Yes','Deal.buy_from <='=>date("Y-m-d"),'Deal.buy_to >='=>date("Y-m-d")),'contain'=>array('DealOption')));
	       //pr($order);die;
	        $deal_option_arr=$order['DealOption'];
			foreach($deal_option_arr as $each_option_arr)
			{
				if($dealoption_id==$each_option_arr['id'])
				{
					  $selected_deal_option=$each_option_arr;
					  break;
				}
				else
				{
					 $selected_deal_option=array();
				}
			}
	      	$order['DealOption']=$selected_deal_option;
	      	$this->set('info',$order);
	        //echo "<pre>";print_r($order);die;
	   
	       	if(!empty($order) && !empty($selected_deal_option))
	      	{
				$member_info_for_shipping_address=$this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$mem_id)));
	             $this->set('mem_ship_adrs',$member_info_for_shipping_address);
	        }
	       	else
	      	{
				//echo "redirect to error page";
	            $this->redirect(array('controller'=>'homes','action'=>'error'));
	      	}
      	}
		else
		{
			$this->redirect(array('controller'=>'homes','action'=>'index'));
		}              
	}
      
    function gift_checkout($uri=null,$dealoption_id=null)
    { 
        //pr($uri);pr($dealoption_id);die;
        $this->layout='public';
        $this->loadModel('MemberMeta');
        $this->loadModel('Deal');
        $this->loadModel('DealOption');
        $member_id=$this->Session->read('Member.id');
        if($member_id!='')
        {
	        $mem_id =convert_uudecode(base64_decode($member_id));
	        $reference =rand(1,100000000);
	        //echo $reference;die;
	        $this->set('referenceNo',$reference);
	        $memberInfo=$this->Member->find('first',array('conditions'=>array('Member.id'=>$mem_id),'contain'=>'MemberMeta')); 
			$this->set('memberInf',$memberInfo);
	        $dealoption_id =convert_uudecode(base64_decode($dealoption_id));
	        $this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on order_deal_relations.order_id=orders.id and orders.order_status!="failed" where `deal_id`= Deal.id');
	        //$order=$this->Deal->find('first',array('conditions'=>array('Deal.uri'=>$uri,'Deal.active'=>'Yes','Deal.buy_from <='=>date("Y-m-d"),'Deal.buy_to >='=>date("Y-m-d")),'contain'=>array('Deal'=>array('DealOption'))));
	      	 $order=$this->Deal->find('first',array('conditions'=>array('Deal.uri'=>$uri,'Deal.active'=>'Yes'),'contain'=>array('DealOption')));
	    		  $deal_option_arr=$order['DealOption'];
	      		foreach($deal_option_arr as $each_option_arr)
	      		{
	          			if($dealoption_id==$each_option_arr['id'])
	        		   {
	            			  $selected_deal_option=$each_option_arr;
	            			  break;
	        		   }
	        		   else
	        		   {
	          			     $selected_deal_option=array();
	        		   }
	      		}
	      		 $order['DealOption']=$selected_deal_option;
	      		 $this->set('info',$order);
	      		if(!empty($order) && !empty($selected_deal_option))
	      		{
	        		$member_info_for_shipping_address=$this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$mem_id)));
					$this->set('mem_ship_adrs',$member_info_for_shipping_address);
	      		}
	      		else
	      		{
	              $this->redirect(array('controller'=>'homes','action'=>'error'));
	      		}
	            $this->render('proceed_checkout'); 
		}
		else
		{
			$this->redirect(array('controller'=>'homes','action'=>'index'));
		}   
	}

    /*--------function for save freind gift--------*/
    function add_friend_gift()
    {
        $this->layout='public';
        $this->autoRender=false;
        //$this->loadModel('Cart');
        $this->loadModel('Friend');
        $member_id=$this->Session->read('Member.id');
        $mem_id =convert_uudecode(base64_decode($member_id));
        //echo $mem_id;die;
        //$cart_info=$this->Cart->find('all',array('conditions'=>array('Cart.member_id'=>$mem_id),'contain'=>array('Deal'=>array('DealOption'))));
        //$this->set('cart',$cart_info);
        if(!empty($this->data) && isset($this->data))
        {
            $data=$this->data;
            $data['Friend']['gift_from'] = $mem_id;
           //pr($data);
            if($this->Friend->save($data))
            {
				if ($data['Friend']['id']!='' || $data['Friend']['id']!=0) { 
                  $friend_id=$data['Friend']['id'];
				}
				else
				{ 
					$friend_id=$this->Friend->getLastInsertId(); 
				}
                $friend_info=$this->Friend->find('first',array('conditions'=>array('Friend.id'=>$friend_id)));
                //pr($friend_info);
                echo 'success|'.$friend_info['Friend']['id'].'|'.$friend_info['Friend']['gift_to'];
                die;
            }
            else
            {
                echo "error";die;
            }
            
        }
		}
 /*--------function for edit freind gift--------*/
     function edit_friend_gift()
     {
        $this->layout='public';
        $this->autoRender=false;
        $this->loadModel('Cart');
        $this->loadModel('Friend');
        $member_id=$this->Session->read('Member.id');
        $mem_id =convert_uudecode(base64_decode($member_id));
        
        //pr($friend_id);
        
        //pr($friend_info);
        if(!empty($this->data) && isset($this->data))
        {
            $data=$this->data;
            if($this->Friend->save($data))
            {
                echo "success";die;
            }
            else
            {
                echo "error";die;
            }
            
       }
		}
    
    
  
    function add_payment_information()
    {		
		$this->layout="public";
		$this->loadModel('OrderDealRelation');
		$this->loadModel('CurrencyManagement');
		$this->loadModel('Friend');
		//Configure::write('debug', 2);
		$member_id=$this->Session->read('Member.id');
		$mem_id =convert_uudecode(base64_decode($member_id));
		$mem = $this->Member->find('first',array('conditions'=>array('Member.id'=>$mem_id),'fields'=>array('id','email','address','city','state',' postal_code'),'recursive'=>'-1'));
		//pr($mem);die;
		$memberEmail = $mem['Member']['email'];
		$currency1=$this->CurrencyManagement->find('first',array('conditions'=>array('CurrencyManagement.active'=>'Yes')));
		$payucurrency_code=$currency1['CurrencyManagement']['currency_code'];
		App::import('Controller', 'Customers');
		$customer = new CustomersController;
		$destLarge = realpath('../../app/webroot/voucher_pdf') . '/';
		$relationId = '';
		//echo "<pre>";print_r($this->data);die;
		if(!empty($this->data))
		{
			//pr($this->data);die;
			$data=$this->data;
 			$merg = array();
 			$data1 = array();
			$data['Order']['order_no'] = uniqid();
			$data['Order']['member_id'] = $mem_id;
			$data['Order']['supplier_id'] = $data['OrderDealRelation1']['supplier_id'];
			$data['Order']['sub_total'] = $data['OrderDealRelation1']['sub_total'];
			$data['Order']['deals_id'] = $data['OrderDealRelation1']['deal_id'];
			$data['Order']['payment_type'] = $data['cardpayment'];
			if($data['cardpayment']!='PAYU')
			{
			   $data['Order']['order_status'] = 'pending';
			   $data['Order']['transaction_id'] = $this->data['OrderDealRelation']['eft'];
			} 
			$data['Order']['payment_date'] = date('Y-m-d H:i:s');
			if($this->Order->save($data))
			{
				$orderId = $this->Order->getLastInsertId();
				$pdfTitle=array();
				$merg['OrderDealRelation']=$data['OrderDealRelation1'];
				while(1)
				{
					$voucher_code = $this->random_string1('calnum',8);
					$getVoucherNo = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.voucher_code'=>$voucher_code)));
					if(!empty($getVoucherNo))
					{
						 continue;
					}
					else
					{
						 $vCode = $voucher_code;break;
					}
				}
				while(1)
				{
					$security_code = $this->random_string1('calnum',8);
					$getSecurityNo = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.security_code'=>$security_code)));
					if(!empty($getSecurityNo))
					{
						 continue;
					}
					else
					{
						 $sCode = $security_code;break;
					}
				}
				$data['OrderDealRelation']['order_id'] = $orderId;
				$data['OrderDealRelation']['voucher_code'] = $vCode;
				$data['OrderDealRelation']['security_code'] = $sCode;
				$data['OrderDealRelation']['shippingaddress_customer_remarks'] = trim($data['OrderDealRelation']['shippingaddress_customer_remarks']);
				$data1['OrderDealRelation'] = array_merge($merg['OrderDealRelation'],$data['OrderDealRelation']);
				$names = $data['OrderDealRelation']['shipping_first_name'];
				$member_addrs=array();
				
				if(trim($mem['Member']['city'])=='')
					$member_addrs['city']	=	"'".$data['OrderDealRelation']['shippingaddress_city']."'";
				if(trim($mem['Member']['address'])=='')
					$member_addrs['address']="'".$data['OrderDealRelation']['shippingaddress_firstline']."'";
				if(trim($mem['Member']['state'])=='')
					$member_addrs['state']="'".$data['OrderDealRelation']['shippingaddress_state']."'";
				if(trim($mem['Member']['postal_code'])=='')
					$member_addrs['postal_code']="'".$data['OrderDealRelation']['shippingaddress_zip']."'";
					//pr($member_addrs);die;
				if(!empty($member_addrs))				
				$this->Member->updateAll($member_addrs,array('Member.id'=>$mem['Member']['id']));
				if($this->OrderDealRelation->save($data1))
				{
						 $relationId = $this->OrderDealRelation->getLastInsertId();
						 $pdfname =$customer->voucher_slip($relationId);
						 $pdfTitle[] = $destLarge.$pdfname;
						 $this->OrderDealRelation->updateAll(array('OrderDealRelation.voucher_pdf'=>'"'.$pdfname.'"'),array('OrderDealRelation.id'=>$relationId));
						 
				}
				//...........start of payu condition...........
				if($data['cardpayment']=='PAYU')
				{
					$payu_order = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.id'=>$relationId)));
					//......................payu integration..............
					//$baseUrl = 'https://staging.payu.co.za'; //staging environment URL
					$baseUrl = 'https://secure.payu.co.za'; //production environment URL
					
					$soapWdslUrl = $baseUrl.'/service/PayUAPI?wsdl';
					$payuRppUrl = $baseUrl.'/rpp.do?PayUReference=';
					$apiVersion = 'ONE_ZERO';

					$returnUrl= 'https://cybercouponsa.com/Orders/payment_result';
					$cancelUrl= 'https://cybercouponsa.com/Orders/payment_cancel';
								
					//set value != 1 if you dont want to auto redirect topayment page
					$doAutoRedirectToPaymentPage = 1;
					//Store config details
					
					$safeKey = '{804A2680-5A31-44F7-A0AA-707AEF565BD7}';
					$soapUsername = '202190';
					$soapPassword = 'HZLBfbEe';

					//$safeKey = '{45D5C765-16D2-45A4-8C41-8D6F84042F8C}';
					//$soapUsername = 'Staging Integration Store 1';
					//$soapPassword = '78cXrW1W';
					
					//$safeKey = '{07F70723-1B96-4B97-B891-7BF708594EEA}';
					//$soapUsername = 'Staging Integration Store 3';
					//$soapPassword = 'WSAUFbw6';						
								
					try {
						// 1. Building the Soap array  of data to send    
						$setTransactionArray = array();    
						$setTransactionArray['Api'] = $apiVersion;
						$setTransactionArray['Safekey'] = $safeKey;
						$setTransactionArray['TransactionType'] = 'PAYMENT';		    
					
						$setTransactionArray['AdditionalInformation']['merchantReference'] = 10330456340;    
						$setTransactionArray['AdditionalInformation']['cancelUrl'] = $cancelUrl;
						$setTransactionArray['AdditionalInformation']['returnUrl'] = $returnUrl;
						  $setTransactionArray['AdditionalInformation']['supportedPaymentMethods'] = 'CREDITCARD,EFT';
						
						$setTransactionArray['Basket']['description'] = $payu_order['DealOption']['option_title'];
						$setTransactionArray['Basket']['amountInCents'] = $payu_order['OrderDealRelation']['sub_total']*100;
						$setTransactionArray['Basket']['currencyCode'] = $payucurrency_code;
					
						//$setTransactionArray['Customer']['merchantUserId'] = "7";
						//$setTransactionArray['Customer']['email'] = "john@doe.com";
						//$setTransactionArray['Customer']['firstName'] = 'John';
						//$setTransactionArray['Customer']['lastName'] = 'Doe';
						//$setTransactionArray['Customer']['mobile'] = '0211234567';
						//$setTransactionArray['Customer']['regionalId'] = '1234512345122';
						$setTransactionArray['Customer']['countryCode'] = '27';

						//$doTransactionArray['Customfield']['key'] = "custom key";
						//$doTransactionArray['Customfield']['value'] = "custom value";		
						
						// 2. Creating a XML header for sending in the soap heaeder (creating it raw a.k.a xml mode)
						$headerXml = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
						$headerXml .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
						$headerXml .= '<wsse:Username>'.$soapUsername.'</wsse:Username>';
						$headerXml .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$soapPassword.'</wsse:Password>';
						$headerXml .= '</wsse:UsernameToken>';
						$headerXml .= '</wsse:Security>';
						$headerbody = new SoapVar($headerXml, XSD_ANYXML, null, null, null);
					
						// 3. Create Soap Header.        
						$ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; //Namespace of the WS. 
						$header = new SOAPHeader($ns, 'Security', $headerbody, true);        
					
						// 4. Make new instance of the PHP Soap client
						$soap_client = new SoapClient($soapWdslUrl, array("trace" => 1, "exception" => 0)); 
					
						// 5. Set the Headers of soap client. 
						$soap_client->__setSoapHeaders($header); 
					
						// 6. Do the setTransaction soap call to PayU
						$soapCallResult = $soap_client->setTransaction($setTransactionArray); 
					
						// 7. Decode the Soap Call Result
						$returnData = json_decode(json_encode($soapCallResult),true);
						//echo "<pre>";print_r($payu_order);
						//echo "<pre>"; print_r($returnData);die; 
						
					  $transaction_id=$returnData['return']['payUReference'];


						if( (isset($returnData['return']['successful']) && ($returnData['return']['successful'] === true) && isset($returnData['return']['payUReference']) ) )
						{	
							$transact_updation=$this->Order->updateAll(array('Order.transaction_id'=>'"'.$transaction_id.'"'),array('Order.id'=>$orderId));

							if($transact_updation)
							{
									header('Location: '.$payuRppUrl.$returnData['return']['payUReference']);
									die();
							}
						}
					}
					catch(Exception $e)
					{

						var_dump($e);
					}
						//....................end of payu integration..........
				}//...........end of payu condition..........
				else
				{
					$_SESSION['take_tour'] = 1;
					$EftMemberId = $this->OrderDealRelation->getLastInsertId();
					$Eft_member = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.id'=>$EftMemberId),'contain'=>array('Order'=>array('Member'=>array('fields'=>array('name','surname','email'))))));
					$names = $Eft_member['Order']['Member']['name'].' '.$Eft_member['Order']['Member']['surname'];
                                        
					$emails = $Eft_member['Order']['Member']['email'];
					$rupees = $Eft_member['Order']['sub_total'];
					$reference_no = $Eft_member['Order']['transaction_id'];
					$emailTemp1 = $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'payment_reference_details')));
                                       
					$common_template = $emailTemp1['EmailTemplate']['description'];
					$common_template = str_replace('{name}',$names,$common_template);
					$common_template = str_replace('{rupees}',$rupees,$common_template);
					$common_template = str_replace('{reference_no}',$reference_no,$common_template);
                                           
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));  
                                             
					$email->to($emails);
                     
					$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Your Payment Reference Details'));
					$email->subject($emailTemp1['EmailTemplate']['subject']);                             
					//echo '<pre>';print_r($common_template);die;
					if($email->send())
					{
						$this->Session->write('success','Your Payment Reference Details has been sent successfully to your mail account');
						$this->redirect(array('controller'=>'Homes','action'=>'index'));
						//$this->redirect(array('action'=>'payment_success'));
					}
				}
			}
			else
			{
				$this->redirect(array('controller'=>'Homes','action'=>'error'));
			}
		}			
	}
    	function payment_result()
    	{
    			 $this->layout = 'public';
        
						 //$baseUrl = 'https://staging.payu.co.za';
						 $baseUrl = 'https://secure.payu.co.za';
						 
							$soapWdslUrl = $baseUrl.'/service/PayUAPI?wsdl';
							$payuRppUrl = $baseUrl.'/rpp.do?PayUReference=';
							$apiVersion = 'ONE_ZERO';
					
							$safeKey = '{804A2680-5A31-44F7-A0AA-707AEF565BD7}';
							$soapUsername = '202190';
							$soapPassword = 'HZLBfbEe';

                     //$safeKey = '{45D5C765-16D2-45A4-8C41-8D6F84042F8C}';
							//$soapUsername = 'Staging Integration Store 1';
							//$soapPassword = '78cXrW1W';

							$PayUReference1=$_SERVER['QUERY_STRING'];
        $PayUReference2=explode('=',$PayUReference1);
        $PayUReference=$PayUReference2[1];
							
							
							try {
							
							    // 1. Building the Soap array  of data to send
							    $soapDataArray = array();
							    $soapDataArray['Api'] = $apiVersion;
							    $soapDataArray['Safekey'] = $safeKey;
							    $soapDataArray['AdditionalInformation']['payUReference'] = $PayUReference;
							
							    // 2. Creating a XML header for sending in the soap heaeder (creating it raw a.k.a xml mode)
							    $headerXml = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
							    $headerXml .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
							    $headerXml .= '<wsse:Username>'.$soapUsername.'</wsse:Username>';
							    $headerXml .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$soapPassword.'</wsse:Password>';
							    $headerXml .= '</wsse:UsernameToken>';
							    $headerXml .= '</wsse:Security>';
							    $headerbody = new SoapVar($headerXml, XSD_ANYXML, null, null, null);
							
							    // 3. Create Soap Header.        
							    $ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; //Namespace of the WS. 
							    $header = new SOAPHeader($ns, 'Security', $headerbody, true);        
							
							    // 4. Make new instance of the PHP Soap client
							    $soap_client = new SoapClient($soapWdslUrl, array("trace" => 1, "exception" => 0)); 
							
							    // 5. Set the Headers of soap client. 
							    $soap_client->__setSoapHeaders($header); 
							
							    // 6. Do the setTransaction soap call to PayU
							    $soapCallResult = $soap_client->getTransaction($soapDataArray); 
							
							    // 7. Decode the Soap Call Result
							    $returnData = json_decode(json_encode($soapCallResult),true);
							    
							    //$decodedXmlData = json_decode(json_encode((array) simplexml_load_string($returnData)),true);
							    
							    //print "<pre>";
							    //var_dump($decodedXmlData);
							    //print "</pre>";  
							
						  	}
							catch(Exception $e) {
								var_dump($e);
							}
						
							//-------      Checking response
				
							if(is_object($soap_client)) {    
							    
 
            $xml = $soap_client->__getLastResponse();
            $xml = preg_replace('/(<\/?)(\w+):([^>]*>)/', '$1$2$3', $xml);
							    $xml = simplexml_load_string($xml);
							    $json = json_encode($xml);
							    $responseArray = json_decode($json,true);
											//echo "<pre>";print_r($responseArray);
            $returnResponseArray=$responseArray['soapBody']['ns2getTransactionResponse']['return'];
            //echo "<pre>";print_r($returnResponseArray);die;
											if($returnResponseArray['resultCode']==00 && $returnResponseArray['successful']==true)
											{
													$transaction_id=$returnResponseArray['payUReference'];
													$payment_order=$this->Order->find('first',array('conditions'=>array('Order.transaction_id'=>$transaction_id)));
//echo "<pre>";print_r($payment_order);die;
               
													if(!empty($payment_order))
													{
                  $transact_updation=$this->Order->updateAll(array('Order.order_status'=>'"success"'),array('Order.transaction_id'=>$transaction_id));

                 /*--------------------------Email start----------------------------------*/
																$destLarge = realpath('../../app/webroot/voucher_pdf') . '/';
																foreach($payment_order['OrderDealRelation'] as $each_ordrerDealRelation)
																{
																     $pdfTitle[] = $destLarge.$each_ordrerDealRelation['voucher_pdf'];
																				$voucher_email=$payment_order['Member']['email'];
																				$voucher_name=$payment_order['Member']['name']." ".$payment_order['Member']['surname'];
				                  if ($each_ordrerDealRelation['friend_id'] != "" && $each_ordrerDealRelation['friend_id'] != 0)
																				{
																						$friendInfo = $this->Friend->findById($each_ordrerDealRelation['friend_id']);
																						if ($friendInfo['Friend']['friend_email'] != "")
																						{
																									$voucher_email = $friendInfo['Friend']['friend_email'];
																									$voucher_name = $friendInfo['Friend']['gift_to'];
																						}
																				}
																}

																
 
																$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'order_eft')));
																$common_template= $emailTemp1['EmailTemplate']['description'];
																$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
																$common_template = str_replace('{name}',$voucher_name,$common_template);
																$email = new CakeEmail();
																$email->template('common_template');
																$email->emailFormat('both');
																$email->viewVars(array('common_template'=>$common_template));       
																$email->to($voucher_email);
																//$email->cc('promatics.gautam@gmail.com');
																//$email->from($emailTemp1['EmailTemplate']['from']);
																$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Your Order'));
																$email->subject($emailTemp1['EmailTemplate']['subject']);                             
																//echo '<pre>';print_r($common_template);die;
																$email->attachments($pdfTitle);
																//$email->send();	
																if($email->send())
										                  {
										                  	if ($friendInfo['Friend']['friend_email'] != "")
																	{
																		$voucher_email = $friendInfo['Friend']['friend_email'];
																		$voucher_name = $friendInfo['Friend']['gift_to'];
																		$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'friend_notification')));
																		//pr($emailTemp1);die;				
																		$common_template= $emailTemp1['EmailTemplate']['description'];
																		$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
																		$common_template = str_replace('{name}',$payment_order['Member']['name'],$common_template);
																		$common_template = str_replace('{friend_name}',$voucher_name,$common_template);
											                     $common_template = str_replace('{friend_email}',$voucher_email,$common_template);							
																		$email = new CakeEmail();
																		$email->template('common_template');
																		$email->emailFormat('both');
																		$email->viewVars(array('common_template'=>$common_template));       
																		$email->to($payment_order['Member']['email']);
																		//$email->from($emailTemp1['EmailTemplate']['from']);
																		$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Your Order'));
																		$email->subject($emailTemp1['EmailTemplate']['subject']);
																		//echo '<pre>';print_r($common_template);die;							
																		$email->send();
																	}
																	$this->redirect(array('action'=>'payment_success'));
										                  }
										               }
											}
											elseif($returnResponseArray['resultCode']!=00 || $returnResponseArray['successful']==false)
											{
											  $this->redirect(array('action'=>'payment_failed'));
											}
											else
											{
											  $this->redirect(array('controller'=>'Homes','action'=>'error'));
											}

           
							}
       
    	}
    function payment_success()
    	{
    			 $this->layout = 'public';


     }
    function payment_failed()
    	{
    			 $this->layout = 'public';


     }
    function payment_cancel()
    	{
    			 $this->layout = 'public';


     }
     function admin_Send_voucher($id=null) 
     {
     		$this->loadModel('OrderDealRelation');
         $this->loadModel('Friend');
  			$member_id=convert_uudecode(base64_decode($id));
  			$v_example=$this->Order->find('first',array('conditions'=>array('Order.id'=>$member_id),'contain'=>array('OrderDealRelation'=>array('Deal'=>array('DealOption')))));
  			$this->set(compact('v_example'));
  			//pr($v_example);die;
  			$transaction_id=$v_example['Order']['transaction_id'];
			$payment_order=$this->Order->find('first',array('conditions'=>array('Order.transaction_id'=>$transaction_id)));
			//echo "<pre>";print_r($payment_order);die;
         if(!empty($payment_order))
			{
         	$transact_updation=$this->Order->updateAll(array('Order.order_status'=>'"success"'),array('Order.transaction_id'=>$transaction_id));
	           /*--------------------------Email start----------------------------------*/
				$destLarge = realpath('../../app/webroot/voucher_pdf') . '/';
				$current_date=date('Y-m-d H:i:s');
				//echo $current_date;
				$redeem_from=$v_example['OrderDealRelation'][0]['Deal']['redeem_from'];
				$redeem_to=$v_example['OrderDealRelation'][0]['Deal']['redeem_to'];
				//pr($v_example);die;
				if($current_date >= $redeem_from and $current_date < $redeem_to)
				{
		   		foreach($payment_order['OrderDealRelation'] as $each_ordrerDealRelation)
					{
						//pr($each_orderDealRelation);die;
			    	  	$pdfTitle[] = $destLarge.$each_ordrerDealRelation['voucher_pdf'];
						$voucher_email=$payment_order['Member']['email'];
						$voucher_name=$payment_order['Member']['name']." ".$payment_order['Member']['surname'];
						//echo $voucher_email;					
						//echo $voucher_name;die;				   
					   if ($each_ordrerDealRelation['friend_id'] != "" && $each_ordrerDealRelation['friend_id'] != 0)
						{
							$friendInfo = $this->Friend->findById($each_ordrerDealRelation['friend_id']);
							if ($friendInfo['Friend']['friend_email'] != "")
							{
								$voucher_email = $friendInfo['Friend']['friend_email'];
								$voucher_name = $friendInfo['Friend']['gift_to'];
							}
						}
					}
					$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'voucher_replacement_email')));
					//pr($emailTemp1);die;				
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
					$common_template = str_replace('{name}',$voucher_name,$common_template);
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));       
					$email->to($voucher_email);
					//$email->cc('promatics.gautam@gmail.com');
					$email->from($emailTemp1['EmailTemplate']['from']);
					$email->subject($emailTemp1['EmailTemplate']['subject']);                             
					//echo '<pre>';print_r($common_template);die;
	
					$email->attachments($pdfTitle);
					//$email->send();	
	
					if($email->send())
					{				
		    			$this->Session->write('success','Voucher has been sent successfully');			        
	    				$this->redirect(array('controller'=>'Orders','action'=>'admin_order'));
					}
					
				}
				else
					{
						$this->Session->write('success','Voucher has been expired, Redeem date was'.' '.date('d-M-Y ',strtotime($redeem_to)));			        
	    				$this->redirect(array('controller'=>'Orders','action'=>'admin_order'));
					}
			} 
	}
}
    /*-------------------------------------end here controller------------------------------------------*/
?>