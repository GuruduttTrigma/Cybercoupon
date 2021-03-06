<?php
class CustomersController extends AppController {
	var $helpers = array('Html','Form','Session','Js','Paginator','Tool');
	var $components = array('RequestHandler','Cookie','Session','Email','resizeback');
	var $uses = array('Member','Location','EmailTemplate','MemberMeta','CustomerVarification','ReferralCount');
	
	function beforeFilter() {
		//$this->disableCache();
		$remEmail = $this->Cookie->read('email');
		$this->set('remEmail',$remEmail);
		$remPass = $this->Cookie->read('password');
		$this->set('remPass',$remPass);
		parent::beforeFilter();	
	}
	function register() {
		$this->layout='public';
		//echo "jjj";die;
		$cities = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		$success = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'customer_confirmation_email')));
		$success_direct_verification = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'customer_direct_verification')));
		$customer_verification = $this->CustomerVarification->find('first');
		//pr($customer_verification);die;
		$this->set('cities',$cities);        
		$this->set('success1',$success);   
		$this->set('success2',$success_direct_verification);   
		if(!empty($this->request->data)) 
		{ 
			//pr($this->request->data);die;
			$data1=$this->request->data;
			//pr($data1);die;
			/* ********************* code of Data save to Member data table by **************************************** */			
			$activation_code = sha1(microtime());              
			$data1['Member']['activation']= $activation_code;
			//echo $data1['Member']['password'];die;
			$data1['Member']['password_copy']= $data1['Member']['password'];
			$data1['Member']['password']=md5($data1['Member']['password']);
			//$data1['Member']['dob'] = @date('Y-m-d',strtotime($data1['Member']['dob']));
			$data1['Member']['status']='Inactive';
			$data1['Member']['newsletters']='Yes';
			$data1['Member']['news_location']= $data1['Member']['location'];
			$data1['Member']['registered'] = date('Y-m-d H:i:s');
			unset($data1['terms']);
			unset($data1['Member']['cpassword']); 
			//pr($data1);die;
			if($this->Member->save($data1)) 
			{
				$mem_id = $this->Member->getLastInsertId();
				
				$referral_email=$data1['Referral']['referral_email'];
				$referral_status=$data1['Referral']['referral_status'];
				if($referral_email!='' && $referral_status==1)
				{
					$this->loadModel('Referral');
					$referral_conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Member.email'=>$referral_email);
					$existance=$this->Member->find('first',array('conditions'=>$referral_conditions,'fields'=>array('id','name','surname','email'),'recursive'=>0));
					if(!empty($existance))
					{
						$new_refree['Referral']=array(
													'member_id'=>$existance['Member']['id'],
													'refer_id'=>$mem_id
													);
						$this->Referral->create();							
						$this->Referral->save($new_refree);
						$referrCounts = $this->ReferralCount->find('first',array('conditions'=>array('ReferralCount.member_id'=>$existance['Member']['id'])));
						//pr($referrCounts);die;
						if(!empty($referrCounts))
						{
							$refInc = $referrCounts['ReferralCount']['referrer_count'] + 1;
							$this->ReferralCount->updateAll(array('ReferralCount.referrer_count'=>$refInc),array('ReferralCount.member_id'=>$existance['Member']['id']));
						}
						else
						{
							$new_refrees['ReferralCount']=array(
								'member_id'=>$existance['Member']['id'],
								'refer_id'=>$mem_id,
								'referrer_count'=>1  
							);
							//pr($new_refrees);die;
							$this->ReferralCount->create();
							$this->ReferralCount->save($new_refrees);	
							
						}
					}					    	
				}				
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'user_registration')));	
				$data3['MemberMeta']['member_id'] = $mem_id;
				$data3['MemberMeta']['shipping_first_name'] = $data1['Member']['name'];
				$data3['MemberMeta']['shipping_last_name'] = @$data1['Member']['surname'];
				//$data3['MemberMeta']['shippingaddress_firstline'] = @$data1['Member']['address'];
				//$data3['MemberMeta']['shippingaddress_city'] = @$data1['Member']['city'];
				//$data3['MemberMeta']['shippingaddress_zip'] = @$data1['Member']['postal_code'];
				$this->MemberMeta->save($data3);
				//direct_varification
				if($customer_verification['CustomerVarification']['varification_status'] == 'email_varification')
				{
					
					//echo $customer_verification['CustomerVarification']['varification_status'];die;
					$toEmail=trim($data1['Member']['email']);
					
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$link = HTTP_ROOT.'Customers/activate_account/'.base64_encode(convert_uuencode($mem_id))."/".$activation_code;							
					$link = "<a href='".$link."' style='text-decoration:none;color:#00aeef' target='_blank'>".__('Click here to activate your account')."</a>";						
					$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
					$common_template = str_replace('{contact_person}',$data1['Member']['name'],$common_template);
					$common_template = str_replace('{link}',$link,$common_template);
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));       
					$email->to($toEmail);
					$email->from($emailTemp1['EmailTemplate']['from']);
					$email->subject($emailTemp1['EmailTemplate']['subject']);                             
					//echo '<pre>';print_r($common_template);die;
					$email->send();	
					$this->set('success_member',base64_encode(convert_uuencode($mem_id)));
					$this->render('success');
				}
				else
				{
					if($this->Member->updateAll(array('Member.status'=>"'Active'",'Member.first_step_approval'=>"'Yes'"),array('Member.id'=>$mem_id)))
					{
						$this->render('success_direct_verification');
					}
				}
			}
		}  
	}	
	function user_code_activation($id=null) {
		
		$ids=convert_uudecode(base64_decode($id));
		$data1=$this->Member->find('first',array('conditions'=>array('Member.id'=>$ids)));
		//pr($data1);die;
		$activation_code = sha1(microtime());              
		$data1['Member']['activation']= $activation_code;		
		$toEmail=trim($data1['Member']['email']);
		$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'user_registration')));
		$common_template= $emailTemp1['EmailTemplate']['description'];
		$link = HTTP_ROOT.'Customers/activate_account/'.base64_encode(convert_uuencode($ids))."/".$activation_code;			$link = "<a href='".$link."' style='text-decoration:none;color:#00aeef' target='_blank'>".__('Click here to activate your account')."</a>";						
		$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
		$common_template = str_replace('{contact_person}',$data1['Member']['name'],$common_template);
		$common_template = str_replace('{link}',$link,$common_template);
		/*
		$email = new CakeEmail();
		$email->template('common_template');
		$email->emailFormat('both');
		$email->viewVars(array('common_template'=>$common_template));       
		$email->to($toEmail);
		$email->from($emailTemp1['EmailTemplate']['from']);
		$email->subject($emailTemp1['EmailTemplate']['subject']);                             
		//echo '<pre>';print_r($common_template);die;
		*/
		$this->Email = new CakeEmail();
		$this->Email->template = 'common_template';
		$this->Email->emailFormat = 'both';
		$this->Email->viewVars = array('common_template'=>$common_template);       
		$this->Email->message = $common_template;
		$this->Email->htnl = 'abc';
		$this->Email->to = $toEmail;
		$this->Email->from = $emailTemp1['EmailTemplate']['from'];
		$this->Email->subject = $emailTemp1['EmailTemplate']['subject'];
		//pr($this->Email);die;
		if($this->Email->send())
		{		
			echo "success";
		}
		/*
		if($email->send())
		{		
			echo "success";
		}
		*/
		else
		{
			echo "error";
		}
		die;
	}
	function activate_account($id=NULL) {
		$id_encode=$id;
		$id=convert_uudecode(base64_decode($id));
		if(!empty($id)) {
			$status=$this->Member->find('first',array('conditions'=>array('Member.id'=>$id),'fields'=>array('Member.status','Member.activation'),'recursive'=>-1));
			if(!empty($status)) {
				if(trim($status['Member']['activation'])!='') {
					if($status['Member']['status']=='Inactive') {
						$adminId = $this->Session->read('Admin.id');
						$datefiStApp = date('Y-m-d H:i:s');
						$u='Active';
						$activ_st='NULL';
						$first_st = 'Yes';
						$this->Member->updateAll(array('Member.activation' =>'"' . $activ_st .'"','Member.status'=>'"' . $u .'"','Member.first_step_approval' =>'"' . $first_st .'"'),array('Member.id'=>$id));
						//$user=$this->Member->find('first',array('conditions'=>array('Member.id'=>$id),'recursive'=>-1));
						//$this->Session->write('Member.id', base64_encode(convert_uuencode($id)));
						//$this->Session->write('Member.name', $user['Member']['name']);
						//$this->Session->write('Member.email', $user['Member']['email']);
						//$this->Session->setFlash('Your account has been activated','success');						//$this->redirect(array('controller'=>'Customers','action'=>'view_profile',$id_encode));
						$this->redirect(array('controller'=>'Customers','action'=>'registration_success')); 
					}
					else {
						$this->redirect(array('controller'=>'Homes','action'=>'expired_link'));
					}	
				}
				else {
					$this->redirect(array('controller'=>'Homes','action'=>'expired_link'));
				}
			}
			else {
				$this->redirect(array('controller'=>'Homes','action'=>'expired_link'));
			}
		}
		else {
			$this->redirect(array('controller'=>'Homes','action'=>'expired_link'));
		}
	}
	function checkMemberEmail() {
		$email=trim($_REQUEST['data']['Member']['email']);
		$this->autoRender = false;
		$count=$this->Member->find('count',array('conditions'=>array('Member.email'=>$email)));
		if($count > 0) {
			echo "false";die;
		}
		else {
			echo "true";die;
		}
	}
	function checkMemberEmailLog() {
		$email=trim($_REQUEST['data']['Member']['log_email']);
		$this->autoRender = false;
		$count=$this->Member->find('count',array('conditions'=>array('Member.email'=>$email,'Member.member_type'=>4),'recursive'=>'-1','fields'=>array('Member.id','Member.status','Member.email','Member.password')));
		if($count > 0) {
			$email_log = base64_encode(convert_uuencode($email));
			$this->Session->write('Member1.logs',$email_log);
			echo "true";die;
		}
		else {
			echo "false";die;
		}
	}
	function checkMemberPasswordLog() {
		$sess_email =  trim($this->Session->read('Member1.logs'));
		$requestemail=trim($_REQUEST['email']);
		if($sess_email!='')
		{
			$email=convert_uudecode(base64_decode($sess_email));
		}
		else
		{
			$email=$requestemail;
		}
		$pass=trim($_REQUEST['data']['Member']['log_password']);
		$this->autoRender = false;
		$count = $this->Member->find('count',array('conditions'=>array('Member.status'=>'Active','Member.email'=>$email,'Member.password'=>md5($pass)),'recursive'=>'-1','fields'=>array('Member.id','Member.status','Member.email','Member.password')));
		
		
		if($count > 0) {
			echo "true";die;
		}
		else {
			echo "false";die;
		}
	}
	function login() {
		$this->layout='public';
		//Configure:write('debug',2);
		$custom_refer=$_SERVER['QUERY_STRING'];
		$last_uri=explode('redirect',$custom_refer);
		$page_info=convert_uudecode(base64_decode(ltrim(end($last_uri),'=')));
		$this->set('page_info',$page_info);
		$cities = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		$this->set('cities',$cities);  
		if($this->Session->read('Member.id')!="")	{
			$this->redirect('/homes/index');
		}
		if(!empty($this->request->data)) {
			$this->Session->delete('Member1');
			$this->Member->set($this->request->data);
			if($this->Member->validates()) { 
				$data = $this->request->data;
				if($data['Member']['log_email']!="" && $data['Member']['log_password']!="" && isset($data['Member']['check'])) {
  					$this->Cookie->write('email',$data['Member']['log_email'],false,60*60*24*365);
  					$this->Cookie->write('password',$data['Member']['log_password'],false,60*60*24*365);
				}
				else {
  					$this->Cookie->delete('email');
  					$this->Cookie->delete('password');
				}
				$get_log = $this->Member->find('first',array('conditions'=>array('Member.status'=>'Active','Member.member_type'=>4,'Member.email'=>$data['Member']['log_email'],'Member.password'=>md5($data['Member']['log_password'])),'recursive'=>'-1','fields'=>array('Member.id','Member.name','Member.member_type','Member.email','Member.password'))); 
				//pr($get_log);die;
				if(!empty($get_log)) {
					$this->Session->write('Member.name', $get_log['Member']['name']);
					$this->Session->write('Member.email', $get_log['Member']['email']);
					$this->Session->write('Member.member_type', $get_log['Member']['member_type']);
					$this->Session->write('Member.id', base64_encode(convert_uuencode($get_log['Member']['id'])));
					//$this->redirect(array('controller'=> 'Homes','action'=>'index'));

					//.............update carts item......
					
					//............end of carts items.......
					if($page_info!='')
					{
						$this->redirect('/'.$page_info.'/');
					}
					else 
					{
						$this->redirect(array('controller'=>'Customers','action'=>'view_profile',base64_encode(convert_uuencode($get_log['Member']['id']))));
					}
				}
				else { 
					$errors1 = 'Invalid email or password!';
					$this->set('error1',$errors1);  
				}
			}
			else {
				$errors = $this->Member->validationErrors;
				//pr($errors);die;
				$this->set('error',$errors);
			} 
		}  
	}
	/*code for customer Forgot Password By Gurudutt*/
	function forgot_password() {
		if(!empty($this->data)) {
			$data=$this->data;
			//pr($data);die;
			$email=$data['Member']['log_email'];
			//echo $email;
			$admin_info=$this->Member->find('first',array('conditions'=>array('Member.email'=>$email,'Member.member_type'=>'4'),'recursive'=>-1));
			//pr($admin_info);
			 $key=$admin_info['Member']['reset'];
                         $session_email=$admin_info['Member']['email'];
			//echo $session_email;die;
			$this->Session->write('email',$session_email);				
			if($key=='Yes'){
			if(!empty($admin_info)) {
				$admin_info['Member']['reset']='No';
				
				//echo $admin_info['Member']['reset'];
				//pr($admin_info);die;
				$this->Member->save($admin_info);
				$new_password=$this->RandomStringGenerator(6);
				//echo $new_password;
				//pr($admin_info['Member']['password']);
				$pwd=md5($new_password);
				//die;
				//pr($admin_info);
				$this->Member->updateAll(array('Member.password'=>"'".$pwd."'",'Member.password_copy'=>"'".$new_password."'"),array('Member.id'=>$admin_info['Member']['id'],'Member.member_type'=>'4'));
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'customer_forgot_password')));
				//echo 'email'."<pre>";print_r($emailTemp1);die;
				$name=$admin_info['Member']['name']." ".$admin_info['Member']['surname'];
				$emailid=$admin_info['Member']['email'];
				$password=$new_password;
				//pr($password);die;
				//pr($name);
				$common_template= $emailTemp1['EmailTemplate']['description'];
				//echo "<pre>";print_r($common_template);
				$common_template= str_replace('{name}',$name,$common_template);
				$common_template= str_replace('{email}',$emailid,$common_template);
				$common_template= str_replace('{password}',$password,$common_template);
				$emailto=$admin_info['Member']['email'];;		
				//pr($emailto);die;
				//pr($common_template);die;
				$email = new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$common_template));
				$email->to($emailto);
				//$email->cc('promatics.gurudutt@gmail.com');
				//$email->from($emailTemp1['EmailTemplate']['from']);
				$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Support'));
				$email->subject($emailTemp1['EmailTemplate']['subject']);  
				$email->send();
				//pr($common_template);die;
				$this->Session->write('success','New Password send to your email account successfully!');	
				//$this->redirect(array('controller'=>'customers','action'=>'forgot_success'));
				$this->redirect($this->referer());
			}
			else {
				$this->Session->write('error_key','Invalid Email address.');
                        }
		} 
		else {
			
           	      $this->Session->write('error','Invalid Email address.');
                     $this->redirect($this->referer());
		   }
		}   
	}
	function logout() {
		$this->Session->delete('Member');
		$this->redirect(array('controller'=> 'Homes','action'=>'index')); 
	}	
	function registration_success() {
		$this->layout='public';
	}
	function view_profile($id=null) {
                $this->layout='public';
		$this->loadModel('Message');
		$this->loadModel('Wishlist');
		$this->loadModel('Referral');
		$member_id=convert_uudecode(base64_decode($id));
		$this->set('member_id',$member_id);
		$currentDate = Date('Y-m-d');
		$this->Deal->virtualFields = array('max_discount'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','max_discount_selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id)','max_selling_price'=>'select selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id)');
		$conditions =array('Wishlist.member_id'=>$member_id);
		$this->paginate=array('limit'=>4,'order'=>array('Deal.active'=>'asc','Wishlist.id'=>'desc'),'contain'=>array('Deal'=>array('Location')));
		$wishDeals=$this->paginate('Wishlist',$conditions);
		
		$this->set(compact('wishDeals'));
		$info=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id),'contain'=>array('MemberType','Location','MemberMeta','ParentReferral','Referral','Order')));
		$loc = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		/*if(@$_POST['wishlist']!="") {	
			if($this->RequestHandler->isAjax()) {
					$this->layout='';
					$this->autoRender=false;
					$this->viewPath='Elements'.DS.'frontend'.DS.'profile';
					$this->render('wish_list');
			}
		}*/
		
		$referral_conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Referral.member_id'=>$member_id);
		$total_referres=$this->Referral->find('count',array('conditions'=>$referral_conditions));
		$total_customers=$this->Member->query('SELECT COUNT(members.id) as cust_count from members WHERE members.status = "Active" AND members.member_type = 4');
		 $referred_conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Referral.refer_id'=>$member_id);
$parent_referral=$this->Referral->find('first',array('fields'=>array('Member.id','Member.name','Member.surname','Member.email','Member.status','Referred.id','Referred.name','Referred.surname','Referred.email','Referral.*'),'conditions'=>$referred_conditions));
		$this->set(compact('info','loc','total_referres','parent_referral','total_customers'));
		//pr($wishDeals);die;
	}
	function myreferrals() 
	{
		$this->loadModel('Referral');
		$member_id=convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Referral.member_id'=>$member_id);
		$this->paginate=array('fields'=>array('Member.id','Member.name','Member.surname','Referred.id','Referred.name','Referred.surname','Referred.email','Referral.*'),'order'=>'Referral.id ASC','limit'=>1);//MAXLIMIT
		$referres=$this->paginate('Referral',$conditions);
		//pr($referres);die;
	   $this->set('referres',$referres);
	   
	   //$total_customers=$this->Member->find('count',array('conditions'=>array('Member.status'=>'Active','Member.member_type'=>4)));
	   //$this->set('total_customers',$total_customers);
		if($this->RequestHandler->isAjax()) 
		{
			$this->layout='';
			$this->autoRender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'profile';
			$this->render('referral_list');
		}
			
	}
	function myorders()
	{
		$this->loadModel('Order');
		$this->loadModel('OrderDealRelation');
		if(!empty($_POST))
		{
			//pr($_POST);
			$orderNumber = @trim($_POST['dealName']);
			$firstDate = $_POST['startdate'];
			$endDate = $_POST['enddate'];
			$conditions = array();
			if($orderNumber !='')
			{
				$conditions = array_merge($conditions,array('Order.order_no LIKE' =>'%'.$orderNumber.'%'));
			}
			if(trim($firstDate) !='')
			{
			    $firstDate = date('Y-m-d',strtotime($firstDate));
				$firstDate = $firstDate.' 23:59:59';
				$conditions = array_merge($conditions,array('Order.payment_date >=' =>$firstDate));
			}
			if(trim($endDate) !='')
			{
			    $endDate = date('Y-m-d',strtotime($endDate));
				$endDate = $endDate.' 23:59:59';
				$conditions = array_merge($conditions,array('Order.payment_date <=' =>$endDate));
			}
			$member_id=convert_uudecode(base64_decode($this->Session->read('Member.id')));
			$conditions=array_merge($conditions,array('Order.member_id'=>$member_id));
			//pr($conditions);
			$this->paginate=array('order'=>'OrderDealRelation.id desc','limit'=>MAXLIMIT,'contain'=>array('Order','Deal'=>array('DealOption','Member'=>array('MemberMeta'=>array('id','company_name')))));
			$order_info=$this->paginate('OrderDealRelation',$conditions);
			$this->set('order_info',$order_info);		
			//pr($order_info);die;
		}
		else 
		{
			//echo MAXLIMIT;die;
			$member_id=convert_uudecode(base64_decode($this->Session->read('Member.id')));
			//$this->paginate=array('order'=>'Order.id desc','limit'=>MAXLIMIT,'contain'=>array('OrderDealRelation'=>array('Deal'=>array('DealOption','Member'))));
			$conditions=array('Order.member_id'=>$member_id);
		//	$order_info=$this->paginate('Order',$conditions);
			//$this->set('order_info',$order_info);
			$this->paginate=array('order'=>'OrderDealRelation.id desc','limit'=>4,'contain'=>array('Order','Deal'=>array('DealOption','Member'=>array('MemberMeta'=>array('id','company_name')))));
			$order_info=$this->paginate('OrderDealRelation',$conditions);
			$this->set('order_info',$order_info);
			//pr($order_info);die;
			
		}
		if($this->RequestHandler->isAjax()) {
						$this->layout='';
						$this->autoRender=false;
						$this->viewPath='Elements'.DS.'frontend'.DS.'profile';
						$this->render('order_list');
			}
	}
	function view_order($id=null) {
		$this->loadModel('Order');
		$this->loadModel('OrderDealRelation');
		$this->layout = 'public';
		$order_id=convert_uudecode(base64_decode($id));
		$orderlisting = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.order_id'=>$order_id)));
		$this->set('sub_info',$orderlisting);
		//pr($orderlisting);die;
	}
	function delete($id=null) {
		$this->loadModel('Order');
		$this->loadModel('OrderDealRelation');
		$this->layout='public';
		$order_id=convert_uudecode(base64_decode($id));
		//$view_order_info=$this->Order->find('all',array('conditions'=>array('Order.id'=>$order_id),'limit'=>2,'contain'=>array('OrderDealRelation'=>array('Deal'=>array('DealOption','Member')))));
		//$this->set('view_order_info',$view_order_info);
		if($this->Order->updateAll(array('Order.delete_status'=>"'User-del'"),array('Order.id'=>$order_id)));
		if($this->RequestHandler->isAjax()) {
		$this->layout='';
		$this->autoRender=false;
		$this->viewPath='Elements'.DS.'frontend'.DS.'profile';
		$this->render('order_list');
		}	
		//pr($orderlisting);
		//pr($view_order_info);die;
	}
	function delete_wishlist($dealid=Null) {
		$this->autoRender = false;
		$this->loadModel('Wishlist');
		//echo $dealid;die;
		$sessId=convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$deal = $this->Wishlist->find('first',array('conditions'=>array('Wishlist.member_id'=>$sessId,'Wishlist.deal_id'=>$dealid)));
		$ids = $deal['Wishlist']['id'];
		$this->Wishlist->delete($ids);
		if($this->RequestHandler->isAjax()) {
		$this->layout='';
		$this->autoRender=false;
		$this->viewPath='Elements'.DS.'frontend'.DS.'profile';
		$this->render('order_list');
		}
	}
	
	/*--------------------for message module----------------------*/ 
	/* function get_conversation($conversation=null)
	{
		$this->loadModel('Message');
		$id=$this->Session->read('Member.id');
		$this->set('id',$id);
		$rec=$this->Message->find('all',array('conditions'=>array('Message.conversation_id'=>$conversation)));
		$this->set('rec',$rec);
		// pr($rec);die;
		if($this->RequestHandler->isAjax()) {
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath = 'Elements'.DS.'frontend'.DS.'message';
			$this->render('msg_right');
		}
	}
	function send_message($to_id=null,$from_id=null,$msg=null,$conv_id=null) {
		$this->loadModel('Message');
		if(!empty($to_id) && !empty($from_id)) {
			$data=$this->data;
			$data['Message']['to_id']=$to_id;
			$data['Message']['from_id']=$from_id;
			$data['Message']['status']='unread';
			$data['Message']['conversation_id']=$conv_id;
			$data['Message']['message']=$msg;
			if($this->Message->save($data)) {
				echo "success"; 
			}
			else { 
				echo "error"; 
			}
		}die;
	}
	function delete_conversation($id=null) {
		$this->loadModel('Message');
		if(!empty($id)) {
			$conditions=array('Message.conversation_id'=>$id);
			$this->Message->deleteAll($conditions);
			echo "success";
		}
		die;
	}*/
	/*--------------------fmessage module- end here---------------------*/ 
	function customer_edit_profile($frmno=Null) {
		$this->autoRender = false;
		$this->loadModel('MemberMeta');
		$sessId=convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$data = $this->request->data;
		if($frmno == 5 ) {
			$data['Member']['password_copy'] = $this->request->data['Member']['password'];
			$data['Member']['password'] =md5($this->request->data['Member']['password']);
			unset($data['Member']['cpassword']);
			unset($data['Member']['opassword']);
		}
		if($frmno == 3) {
			$meta = $this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$sessId)));
			if(!empty($meta)) {
				$this->MemberMeta->id = $meta['MemberMeta']['id'];
				$this->MemberMeta->save($data);
			}
			else {		
				$data['MemberMeta']['member_id'] = $sessId;
				$this->MemberMeta->create();
				$this->MemberMeta->save($data);
			}
		}
		if ($frmno == 2) {
			$infomem=$this->Member->find('first',array('conditions'=>array('Member.id'=>$sessId)));
			//$memLoc = $infomem['Member']['location'];
			// $arr = explode(',',$infomem['Member']['news_location']);
			// array_push($arr,$this->request->data['Member']['location']);
			// $arr = array_unique($arr);
			// $str1 =implode(',',$arr);
			// $str = trim($str1,',');
			
			$this->Member->updateAll(array('Member.address'=>'"'.$data['Member']['address'].'"','Member.phone'=>'"'.$data['Member']['phone'].'"'),array('Member.id'=>$sessId));
			// $data['Member']['news_location'] = $str;
		}
		
		$this->Member->id = $sessId;
		$this->Member->save($data);
		//pr($data);die;
		$info=$this->Member->find('first',array('conditions'=>array('Member.id'=>$sessId)));
		$this->Session->write('Member.name', $info['Member']['name']);
		$this->Session->write('Member.email', $info['Member']['email']);
		$this->set(compact('info'));
		$loc = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		$this->set('loc',$loc);  
		//echo $frmno;die;
		if($this->RequestHandler->isAjax()) {
			$this->layout='';
			$this->autoRender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'profile';
			$this->render('element'.$frmno);
}
	}	
	function check_validation() {
		$this->autoRender = false;
		//pr($this->request->data);die;
		$email = $this->request->data['Member']['email'];
		$pass = md5($this->request->data['Member']['pass']);
		//$password = 
		$sessId=convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$user = $this->Member->find('count',array('conditions'=>array('Member.email'=>$email,'Member.id NOT'=> $sessId)));
		$psw = $this->Member->find('count',array('conditions'=>array('Member.id'=> $sessId,'Member.password'=>$pass)));
		//echo $user.'$$'.$psw.'$$'.$pass;
		if($user > 0 && $psw != 1) {
				echo "both";die;
		}
		else if($user <= 0 && $psw != 1) {
			echo "pass";die;
		}
		else if($user > 0 && $psw == 1) {
			echo "email";die;
		}
		else {
				echo "success";die;
		}
	}
	function check_password() {
		$this->autoRender = false;
		//pr($this->request->data);die;
		$pass = md5($this->request->data['Member']['opassword']);
		$sessId=convert_uudecode(base64_decode($this->Session->read('Member.id')));
		//$user = $this->Member->find('count',array('conditions'=>array('Member.email'=>$email,'Member.id NOT'=> $sessId)));
		$psw = $this->Member->find('count',array('conditions'=>array('Member.id'=> $sessId,'Member.password'=>$pass)));
		//echo $user.'$$'.$psw.'$$'.$pass;
		if($psw != 1) {
			echo "error";die;
		}
		else {
				echo "success";die;
		}
	}	
	/*---------- profile newsletter section start --------*/
	function profile_newsletter() {
		$this->autoRender = false;
		$sessId=convert_uudecode(base64_decode($this->Session->read('Member.id')));
		//echo $sessId;die;
		//pr($this->data);die;
		$data = $this->data;
		$loc = "";
		if(!empty($data['News'])) {
			foreach($data['News'] as $nws) {
					$loc .= $nws.",";
			}
			$data['Member']['news_location'] = trim($loc,',');
		}
		else {
				$data['Member']['news_location'] = NULL;
		}
		$data['Member']['news_location_updation']='Yes';
		//pr($data);
		$this->Member->id = $sessId;
		$this->Member->save($data);
		$info=$this->Member->find('first',array('conditions'=>array('Member.id'=>$sessId)));
		$this->set(compact('info'));
		$loc = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		$this->set('loc',$loc);  
		if($this->RequestHandler->isAjax()) {
					$this->layout='';
					$this->autoRender=false;
					$this->viewPath='Elements'.DS.'frontend'.DS.'profile';
					$this->render('newsletter');
		}
	}
	// Wish list functionality start from here
	function add_to_wishlist($dealid=Null) {
		$this->autoRender = false;
		$this->loadModel('Wishlist');
		$sessId=convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$data = array();
		$deal = $this->Wishlist->find('first',array('conditions'=>array('Wishlist.member_id'=>$sessId,'Wishlist.deal_id'=>$dealid)));
		if(empty($deal)) {
			$data['Wishlist']['member_id'] = $sessId;
			$data['Wishlist']['deal_id']=$dealid;
			$data['Wishlist']['date']=Date('Y-m-d H:i:s');
			$this->Wishlist->create();
			if($this->Wishlist->save($data)) {
					echo "success";die;
			}
			else {
					echo "error";die;
			}
		}
	}
	function del_wishlist($dealid=Null) {
		$this->autoRender = false;
		$this->loadModel('Wishlist');
		$sessId = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$deal = $this->Wishlist->find('first',array('conditions'=>array('Wishlist.member_id'=>$sessId,'Wishlist.deal_id'=>$dealid)));
		$ids = $deal['Wishlist']['id'];
		if($this->Wishlist->delete($ids)) {
				echo "success";die;
		}
		else {
				echo "error";die;
		}
	}
	function voucher_slip($id=Null)
	 {			  		
		$this->autoRender = false;
		$this->loadModel('OrderDealRelation');
		$this->loadModel('CurrencyManagement');
		App::import('Component','resizeback');	
		
		$imageback = new resizebackComponent(new ComponentCollection());
		
		$currency=$this->CurrencyManagement->find('first',array('conditions'=>array('CurrencyManagement.active'=>'Yes')));
		$currency=$currency['CurrencyManagement']['currency'];
		//$session_member = $this->Member->find('first',array('conditions'=>array('Member.id'=>)))
		$voucherInfo = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.id'=>$id),'contain'=>array('Deal'=>array('Member'=>array('MemberMeta')),'DealOption','Order'=>array('Member'))));
		//echo "<pre>";print_r($voucherInfo);die;
		//pr($voucherInfo);
		//echo IMPATH.'deals/'.$voucherInfo['Deal']['image'];die;
		$view = new View($this);
		$html = $view->loadHelper('Tool');
		$sub = $html->subdir($voucherInfo['Deal']['id']).$voucherInfo['Deal']['image'];
		$custom_path=DATAPATH.'deals/'.$sub;
		$imageback->resize('../../app/webroot/'.$custom_path,'../../app/webroot/pdfimg_tmp/'.$voucherInfo['Deal']['image'],'aspect_fill',250,250,0,0,0,0);
		//pr($voucherInfo);die;
		//echo $this->random_string1('calnum',8);die;
		Configure::write('debug',0);
		App::import('Vendor', 'tcpdf',array('file' => 'tcpdf/tcpdf.php'));
		$time = time();
		$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$tcpdf->setPrintFooter(false);
		$tcpdf->setPrintHeader(false);
		$tcpdf->SetAutoPageBreak(true);
		//$tcpdf->SetLineWidth(0.1);
		//echo $voucherInfo['Deal']['shipping_price'];die;
		/*  ------------------ Delivery Option  Start ------------------------  */
		if($voucherInfo['Deal']['delivery_option']=='physical') {
		
			$delivery='* This is a physical product that requires delivery and the discounted selling price includes nationwide door-to-door delivery by courier.';
		}
		elseif ($voucherInfo['Deal']['delivery_option']=='physical-not-delivery') {
			$delivery='* This is a physical product that requires delivery and the discounted selling price does NOT include nationwide door-to-door delivery by courier.';
		}
		else {
			$delivery='* This is not a physical product and does not require delivery.';
		}
		/* ---------------Start To:(Member Name/company_name)------------------ */
		
		if(!empty($voucherInfo['OrderDealRelation']['shippingaddress_company_name']) || $voucherInfo['OrderDealRelation']['shippingaddress_company_name']!='') 
		{
		
			$customer_info = $voucherInfo['OrderDealRelation']['shippingaddress_company_name'];
		}
		else 
		{
			$customer_info = $voucherInfo['Order']['Member']['name'].' '.$voucherInfo['Order']['Member']['surname'];
		}
		$remarks = '';
		if(!empty($voucherInfo['OrderDealRelation']['shippingaddress_customer_remarks']) || $voucherInfo['OrderDealRelation']['shippingaddress_customer_remarks']!='') 
		{
		
			$remarks = '<p style="color:#777;font-size:0.8em;"> * '.trim($voucherInfo['OrderDealRelation']['shippingaddress_customer_remarks']).'</p>';
			$remarksLabel = '<p style="color:#228dd6;font-size:0.9em; line-height:5px;"> Colour/size choice </p>';
		}
	//	echo $customer_info;die;
		/* ---------------End To:(Member Name/company_name)------------------ */
		
		/*  ------------------  Delivery Option  End  --------------------------    */

		/*  ------------------ Shipping Price  Start ------------------------  */
		if($voucherInfo['Deal']['shipping_price']=='Yes' && $voucherInfo['Deal']['delivery_option'] != 'non-physical') {
			     $Shipping_price='* Shipping is included in the purchase price.';
		}
		else
		{
		    	//$Shipping_price='* Shipping is not included in the purchase price and this will be quoted to you by the supplier at the time of placing your order.';
	   		$Shipping_price= '';
		 }		
		/*  ------------------  Shipping Price  End  --------------------------    */
		$deal_term ='* This deal is sold on the basis of your acceptance to the fine print terms listed below and the standard customer terms and conditions which can be viewed at https://www.cybercouponsa.com/term_conditions';
		/*-------------------------- Pdf Page START ------------------------------*/
		$tcpdf->AddPage();
		$html = '<br><br><table style="width:100%;border-left:4px solid #68ac1c;border-right:4px solid #68ac1c;border-top:4px solid #68ac1c;border-bottom:4px solid #68ac1c;" ><tr>
			<td>
		<table cellspacing="0" cellpadding="12 ">
			<tr>
				<td width="45%" style="text-align:center;border-bottom:1px solid red;">
					<img src="'.HTTP_ROOT.'img/frontend/logo2.jpg"/>					
				</td>
				<td  width="55%" style="text-align:right;border-bottom:1px solid red; height:30px; line-height:30px; " >
					<img src="'.HTTP_ROOT.'img/frontend/vocher.png" height="50" style="float:right; margin-top:20px;"/>
				</td>
			</tr>
			
			<tr>
				<td width="30%" >
					
					 <img src="'.HTTP_ROOT.'pdfimg_tmp/'.$voucherInfo['Deal']['image'].'" style="border:3px solid #ccc;width:100px;" />						
				</td>
				<td  width="70%">
					<p style="font-size:0.9em;color:#777;">'.$voucherInfo['DealOption']['option_title'].' </p>
					<p style="font-size:0.9em;color:#228dd6;">Voucher Value: '.$currency.''.$voucherInfo['OrderDealRelation']['qty']*$voucherInfo['DealOption']['selling_price'].'</p>
				</td>
			</tr>
			<tr width="100%" style="border-top:1px dashed #ccc; height: 1px; line-height:1px;">
				<td width="100%" style="border-top:1px dashed #ccc;">
					<p style="color:#228dd6;font-size:0.9em;">Voucher code: '.$voucherInfo['OrderDealRelation']['voucher_code'].' </p>
				</td>
				
			</tr>
			<tr style="height: 1px; line-height:1px;">
				<td style="border-bottom:1px dashed #ccc;width:100%;" >
					<p style="color:#777;font-size:0.8em;;font-style:italic;">Valid from '.date('jS F Y',strtotime($voucherInfo['Deal']['buy_from'])).' to '.date('jS F Y',strtotime($voucherInfo['Deal']['buy_to'])).' </p>
				</td>
			</tr>
			<tr>
				<td style="border-bottom:1px dashed #ccc;width:50%;" >
					<p style="color:#228dd6;font-size:0.9em; line-height:5px;"> Description  </p>
					<p style="color:#777;font-size:0.8em;">'.nl2br($voucherInfo['Deal']['description']).' </p>
				</td>
				<td style="border-bottom:1px dashed #ccc;width:50%;" >
					<p style="color:#228dd6;font-size:0.9em; line-height:5px;"> Fine Print </p>
					<p style="color:#777;font-size:0.8em;">'.$deal_term.'</p>
					<p style="color:#777;font-size:0.8em;">'.$voucherInfo['Deal']['highlights'].'</p>
					<p style="color:#777;font-size:0.8em;">'.$delivery.'</p>
					<p style="color:#777;font-size:0.8em;">'.$Shipping_price.'</p>
               '.$remarksLabel.'
					'.$remarks.'
				</td>
			</tr>
			<tr>
				<td style="border-bottom:1px dashed #ccc;width:100%; " >
					<p style="color:#000;font-size:0.9em; line-height:10px;">How it works:  </p>
					<ul>
						<li style="color:#777;font-size:0.8em; line-height:13px; height: 1px; margin:0;">Use this voucher as a form of payment. </li>
						<li style="color:#777;font-size:0.8em; line-height:13px; height: 1px; margin-bottom:5px;">If you need to present this voucher to the Supplier, then print it out. If you do not need to print it out depending on the Supplier\'s requirements, then you can email it to the Supplier.</li>
						<li style="color:#777;font-size:0.8em; line-height:13px; height: 1px; margin-bottom:5px;">
							To place your order e-mail: '.$voucherInfo['Deal']['Member']['email'].' or call: '.$voucherInfo['Deal']['Member']['phone'].' .
						</li>
					</ul>
					
				</td>
			</tr>
			<tr>
				<td style="border-bottom:1px dashed #ccc;width:100%; line-height:15px;" >
					<p style="color:#000;font-size:0.7em;line-height:10px;">This is your paid invoice:  </p>
					<p style="line-height:7px;font-size:0.7em"><span style="color:#000;font-size:0.9em;">From:  </span><span style="color:#777;font-size:0.8em;">'.$voucherInfo['Deal']['Member']['MemberMeta']['company_name'].', '.$voucherInfo['Deal']['Member']['address'].', '.$voucherInfo['Deal']['Member']['city'].', '.'Tel. '.$voucherInfo['Deal']['Member']['phone'].', '.'Email: '.$voucherInfo['Deal']['Member']['email'].'</span></p>';
					
					if(trim($voucherInfo['Deal']['Member']['MemberMeta']['registration_no'])!='' && trim($voucherInfo['Deal']['Member']['MemberMeta']['vat_registration_no'])!='')
					{
					   $html .='<p style="color:#000;font-size:0.7em;line-height:10px;"><span style="color:#000;font-size:0.9em;">Company Reg. No. </span><span style="color:#777;font-size:0.9em;">'.$voucherInfo['Deal']['Member']['MemberMeta']['registration_no'].'</span>
						<span style="color:#000;font-size:0.9em;"> - VAT Number: </span><span style="color:#777;font-size:0.9em;">'.$voucherInfo['Deal']['Member']['MemberMeta']['vat_registration_no'].'</span></p>';

					}
					elseif(trim($voucherInfo['Deal']['Member']['MemberMeta']['registration_no'])!='')
					{
						$html .='<p style="color:#000;font-size:0.7em;line-height:10px;"><span style="color:#000;font-size:0.9em;">Company Reg. No. </span><span style="color:#777;font-size:0.9em;">'.$voucherInfo['Deal']['Member']['MemberMeta']['registration_no'].'</span>
						</p>';
					}
					elseif(trim($voucherInfo['Deal']['Member']['MemberMeta']['vat_registration_no'])!='')
					{
					  $html .='<p style="color:#000;font-size:0.7em;line-height:10px;"><span style="color:#000;font-size:0.9em;">VAT Number: </span><span style="color:#777;font-size:0.9em;">'.$voucherInfo['Deal']['Member']['MemberMeta']['vat_registration_no'].'</span></p>';
					}	
					$html .='<p style="line-height:7px;font-size:0.7em"><span style="color:#000;font-size:0.9em;">To: </span><span style="color:#777;font-size:0.8em;">'.$customer_info.', '.$voucherInfo['Order']['Member']['address'].', Cellphone No: '.$voucherInfo['Order']['Member']['phone'].', Email Address: '.$voucherInfo['Order']['Member']['email'].' </span></p>
					
					<p style="line-height:7px;font-size:0.7em"><span style="color:#000;font-size:0.9em;">Amount paid:  </span><span style="color:#777;font-size:0.8em;">'.$voucherInfo['Order']['sub_total'].'</span></p>
				</td>
			</tr>
			<tr>
				<td style="width:100%;text-align:center;" ><p style="color:#777;font-size:0.9em; line-height:1px;">Issued on behalf of the supplier by: Cyber Coupon (Pty) Ltd</p><p style="font-size:0.8em;"> <span style="">Email: </span><span style="color:#227dd6;"> support@cybercouponsa.com </span>- or speak to us live via "Live Chat" on <span style="color:#227dd6; ">www.cybercouponsa.com </span></p>
				</td>
			</tr>
		</table>
			</td>
		</tr>
		</table>';
		$bMargin = $tcpdf->getBreakMargin();
		$auto_page_break = $tcpdf->getAutoPageBreak();
		$tcpdf->SetAutoPageBreak(false);
		$tcpdf->SetAutoPageBreak($auto_page_break, $bMargin);
		$tcpdf->setPageMark();	
		$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$tcpdf->SetHeaderMargin(0);
		$tcpdf->SetFooterMargin(0);
		$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
		$tcpdf->writeHTML($html, true, false, true, false, '');	
		/*-------------------------- page END------------------------------*/
		//if (file_exists(HTTP_ROOT.'pdfimg_tmp/'.$voucherInfo['Deal']['image']))
			//unlink(HTTP_ROOT.'pdfimg_tmp/'.$voucherInfo['Deal']['image']);
		while(1) {
			$pdfs = 'cybercoupon_voucher_'.$this->random_string1('alnum',5);
			$getVoucherpdf = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.voucher_pdf'=>$pdfs)));
			if(!empty($getVoucherpdf)) {
				continue;
			}
			else {
				$name = $pdfs;break;
			}
		}
		//$time = time();
		$pdfName = $name.'.pdf';
		$pdf = $tcpdf->Output('../webroot/voucher_pdf/'.$pdfName, 'F');
		$file = HTTP_ROOT.'pdf/label/'.$pdfName;  // path of pdf
		return  $pdfName;die;
	}

	function forgot_success() {
		$this->layout='public';
	}

	function update_status_forgot()
	{
		$this->autoRender = false;		
		$email = $this->Session->read('email');
 		$this->Member->updateAll(array('Member.reset'=>"'Yes'"),array('Member.email'=>$email));	
	}
	/*function refer_friend()
	{
		$this->layout='public';
		if(!empty($this->data))
		{
			//pr($this->data);die;
			$to_name=trim($this->data['Refer']['to_name']);
         $from_name=trim($this->data['Refer']['from_name']);
			$to_mail=trim($this->data['Refer']['email']);
			
			$refer=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'refer_a_friend')));
			$template_description=$refer['EmailTemplate']['description'];
			$template_description = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$template_description);
			$template_description = str_replace('{to_name}',$to_name,$template_description);
         $template_description = str_replace('{from_name}',$from_name,$template_description);
			
			$email=new CakeEmail();
			$email->template('common_template');
			$email->emailFormat('both');
			$email->viewVars(array('common_template'=>$template_description));
			$email->subject();
			$email->to($to_mail);
			$email->from('info@cybercouponsa.com');
			if($email->send())
			{
				$this->Session->write('refer_success','You have successfully refer to your friend.');
			   $this->redirect(array('controller'=>'Customers','action'=>'register'));
			}
		}
		else 
		{
			$this->Session->write('refer_error','Something is going wrong to refer a friend.');
			$this->redirect(array('controller'=>'Customers','action'=>'register'));
		}
	}*/
   function refer_friend()
   {
   	   $this->layout='public';
   	   //pr($this->data);
   	   //pr($_POST);die;
			if(!empty($this->data))
			{
				//pr($this->data);die;
				$to_name=trim($this->data['Refer']['to_name']);
	            $from_name=trim($this->data['Refer']['from_name']);
				$to_mail=trim($this->data['Refer']['email']);
				
				$refer=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'refer_a_friend')));
				$template_description=$refer['EmailTemplate']['description'];
				$template_description = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$template_description);
				$template_description = str_replace('{to_name}',$to_name,$template_description);
				$template_description = str_replace('{from_name}',$from_name,$template_description);
				
				$email=new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$template_description));
				$email->subject($refer['EmailTemplate']['subject']);
				$email->to($to_mail);
				$email->from($refer['EmailTemplate']['from']);
				if($email->send())
				{
				   echo "success";die;
				}
			}
			else 
			{
				echo "error";die;
			}
   	
	}	
	function success() {
		$this->layout="public";
	
	}
	
	function send_voucher($id = NULL) {
		$this->autoRender = false;
		$this->loadModel('Order');
		$orderId = convert_uudecode(base64_decode($id));
		$orderDetails = $this->Order->find('first',array('conditions' => array('Order.id' => $orderId)));
		
		$link = HTTP_ROOT.'voucher_pdf/'.$orderDetails['OrderDealRelation'][0]['voucher_pdf'];							
		$link = "<a href='".$link."' style='text-decoration:none;color:#00aeef' target='_blank'>".__('Click here to download your voucher pdf.')."</a>";		
		//pr($orderDetails);
		$template_desc = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias' => 'resend_voucher_slip')));
		$template_description=$template_desc['EmailTemplate']['description'];
		$template_description = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$template_description);
		$template_description = str_replace('{name}',$orderDetails['Member']['name'],$template_description);
		$template_description = str_replace('{link}',$link,$template_description);
				
		$email=new CakeEmail();
		$email->template('common_template');
		$email->emailFormat('both');
		$email->viewVars(array('common_template'=>$template_description));
		$email->subject($template_desc['EmailTemplate']['subject']);
		$email->to($orderDetails['Member']['email']);
		$email->from($template_desc['EmailTemplate']['from']);
		$email->send();
		echo "success";die;
	}
	
}
?>