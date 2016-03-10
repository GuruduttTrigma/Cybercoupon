<?php
class SuppliersController extends AppController {
	var $helpers = array('Html','Form','Session','Js','Paginator','Common');
	var $components = array('RequestHandler','Cookie','Session','Email');
	var $uses = array('Member','MemberMeta','BusinessCategory','BusinessType','Location','DealCategory','Deal','Order','OrderDealRelation','EmailTemplate');

	function beforeFilter() {
		$remEmailSup = $this->Cookie->read('email');
		$this->set('remEmailSup',$remEmailSup);
		$remPassSup = $this->Cookie->read('password');
		$this->set('remPassSup',$remPassSup);
		parent::beforeFilter();	
	} 
	function register() {
		$this->layout='public';
		$cities = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
     	$this->set('cities',$cities);
     	$business_cat=$this->BusinessCategory->find('all',array('conditions'=>array('BusinessCategory.active'=>'Yes'),'order'=>array('BusinessCategory.id ASC'))); 
     	$this->set(compact('business_cat'));
     	$business_type=$this->BusinessType->find('all',array('conditions'=>array('BusinessType.active'=>'Yes'),'order'=>array('BusinessType.id ASC'))); 
     	$this->set(compact('business_type'));
     	if (!empty($this->request->data)) 
		{
			$data1=$this->request->data;
			$data1['Member']['status']='Inactive';
			$data1['Member']['member_type']=3;
			//$data1['Member']['news_location']= $data1['Member']['location'];
			$data1['Member']['newsletter'] = (isset($data1['Member']['newsletter'])?'Yes':'No');
			$data1['Member']['registered'] = date('Y-m-d H:i:s');
			// pr($data1);die;  
			if ($this->Member->save($data1)) 
			{
				$data1['MemberMeta']['member_id'] = $this->Member->getLastInsertId();    
				$data1['MemberMeta']['cybercoupon%']='25';
				$data1['MemberMeta']['supplier%']='75';
				//$data1['MemberMeta']['start_date'] = @date('Y-m-d',strtotime($data1['MemberMeta']['start_date']));
        		if ($this->MemberMeta->save($data1)) 
				{
					$mem_id = $this->Member->getLastInsertId();
					$this->loadModel('Member');
					$this->loadModel('EmailTemplate');
					$info=$this->Member->find('first',array('conditions'=>array('Member.id'=>$mem_id),'contain'=>array('MemberMeta','Location')));
					// pr($info);
					//$admin_info=$this->Member->find('first',array('conditions'=>array('Member.member_type'=>'1')));
					// pr($admin_info);die;
	        		$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'supplier_registration')));
					//pr($emailTemp1);				
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$common_template = str_replace('{name}',$info['Member']['name'],$common_template);
					$common_template = str_replace('{business}',$info['MemberMeta']['company_name'],$common_template);
					$common_template = str_replace('{website}',$info['MemberMeta']['website'],$common_template);
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));
					$email->to('stephaniegain@gmail.com');
					//$email->cc('supplierapplications@cybercouponsa.com');
					$email->from($emailTemp1['EmailTemplate']['from']);
					//$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Support'));
					$email->subject($emailTemp1['EmailTemplate']['subject']);
					//echo $emailTemp1['EmailTemplate']['subject']; die;
					//echo '<pre>';print_r($common_template);die;
					$email->send();				
					$this->render('success'); 
				}
			}
		}  
		$reasons = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'reasons')));
		$this->set('reasons',$reasons);
		$discount = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'discount')));
		$this->set('discount',$discount);
		$commission = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'commission')));
		$this->set('commission',$commission);
		$Want_to_work_with_Cybercoupon = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'Want_to_work_with_Cybercoupon')));
		$this->set('Want_to_work_with_Cybercoupon',$Want_to_work_with_Cybercoupon);
		//pr($reasons);die;
		$business_type = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'business_type')));
		$this->set('business_type',$business_type);
		$competitions = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'competitions')));
		$this->set('competitions',$competitions);
  	}  
	function success() {
   	$this->layout='public';
  	}
	function login() { 
		$this->layout='public';
		if (!empty($this->request->data)) { 
			//$this->request->data['Member']['reset']="yes";
			//$this->Member->save($this->request->data);		
			//pr($this->request->data);die;
			$this->Session->delete('Member1');
			$this->Member->set($this->request->data);
			if ($this->Member->validates()) { 
				$data = $this->request->data;
				if ($data['Member']['log_email']!="" && $data['Member']['log_password']!="" && isset($data['Member']['check'])) {
					//echo $data['Member']['log_email'];die;
					$this->Cookie->write('email',$data['Member']['log_email'],false,60*60*24*365);
					$this->Cookie->write('password',$data['Member']['log_password'],false,60*60*24*365);
				}
				else {
					$this->Cookie->delete('email');
					$this->Cookie->delete('password');
				}
				$get_log = $this->Member->find('first',array('conditions'=>array('Member.status'=>'Active','Member.email'=>$data['Member']['log_email'],'Member.password'=>md5($data['Member']['log_password'])))); 
				if	(!empty($get_log)) {
					$this->Session->write('Member.name', $get_log['Member']['name']);
					$this->Session->write('Member.email', $get_log['Member']['email']);
					$this->Session->write('Member.member_type', $get_log['Member']['member_type']);
					$this->Session->write('Member.id', base64_encode(convert_uuencode($get_log['Member']['id'])));
					//$this->redirect(array('controller'=> 'Homes','action'=>'index'));  
					$this->redirect(array('controller'=>'Suppliers','action'=>'profile',base64_encode(convert_uuencode($get_log['Member']['id']))));
				}
				else { 
					$errors1 = 'Invalid email or password!';
					$this->set('error1',$errors1);  
				}
			}
			else {
					$errors = $this->Member->validationErrors;
					$this->set('error',$errors);
			} 
		} 
	}
	/*code for supplier Forgot Password */
	function forgot_password() {
		$this->layout="public";
		/*if($this->CheckAdminSession()) { 
			$this->redirect(array('controller'=>'customers','action' => 'login'));
  		}*/
		if (!empty($this->data)) {
			$data=$this->data;
			//pr($data);
			$email=trim($data['Member']['log_email']);
			//echo $email;
			$admin_info=$this->Member->find('first',array('conditions'=>array('Member.email'=>$email,'Member.member_type'=>'3'),'recursive'=>-1));
			$key=$admin_info['Member']['reset'];
		if($key=='Yes'){
	        if (!empty($admin_info)) {
					$admin_info['Member']['reset']='No';
					$session_email=$admin_info['Member']['email'];
					//echo $session_email;die;
					$this->Session->write('email',$session_email);				
					//echo $admin_info['Member']['reset'];
					$this->Member->save($admin_info);
					//pr($admin_info);die;
	            $new_password=$this->RandomStringGenerator(6);
	            //echo $new_password;
	            //pr($admin_info['Member']['password']);
	            $pwd=md5($new_password);
	            //die;
	            //pr($admin_info);die;
	            $this->Member->updateAll(array('Member.password'=>"'".$pwd."'",'Member.password_copy'=>"'".$new_password."'"),array('Member.id'=>$admin_info['Member']['id'],'Member.member_type'=>'3'));
					//pr($admin_info);die;
	            $emailTemp1= $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'supplier_forgot_password')));
		        	//$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'supplier_registration')));          
	            //echo 'email'."<pre>";print_r($emailTemp1);die;
	            $name=$admin_info['Member']['name']." ".$admin_info['Member']['surname'];
	            $emailid=$admin_info['Member']['email'];
	            $password=$new_password;
	            $common_template= $emailTemp1['EmailTemplate']['description'];
	            $common_template= str_replace('{name}',$name,$common_template);
	            $common_template= str_replace('{email}',$emailid,$common_template);
	            $common_template= str_replace('{password}',$password,$common_template);
	            $emailto=$admin_info['Member']['email'];	
	            //pr($emailto);
					//pr($common_template);die;            
	            $email = new CakeEmail();
	            $email->template('common_template');
	            $email->emailFormat('both');
	            $email->viewVars(array('common_template'=>$common_template));
	            $email->to($emailto);
	            //$email->cc('promatics.gurudutt@gmail.com');
				$email->from($emailTemp1['EmailTemplate']['from']);
	            $email->subject($emailTemp1['EmailTemplate']['subject']);  
	            $email->send();
				$this->redirect(array('controller'=>'suppliers','action'=>'forgot_success'));
	       	}
	       	else {
					$this->redirect(array('controller'=>'suppliers','action'=>'forgot_success'));
		   	}
	    }
        else {
			$this->redirect(array('controller'=>'suppliers','action'=>'forgot_success'));
           	$this->Session->write('error','Invalid Email address.');
		   }
    	} 
    }
  	function forgot_success() {
  		$this->layout='public';
  		 		
   	
 	}
  	function checkMemberEmailLog() {
		$email=trim($_REQUEST['data']['Member']['log_email']);
		$this->autoRender = false;
		$count=$this->Member->find('count',array('conditions'=>array('Member.status'=>'Active','Member.email'=>$email,'Member.member_type'=>3)));
		if ($count > 0) {
			$email_log = base64_encode(convert_uuencode($email));
			$this->Session->write('Member1.logs',$email_log);
			echo "true";die;
		}
		else {
				echo "false";die;
		}
	}
	function checkMemberPasswordLog() {
		$email=$_POST['email'];
		$pass=$_REQUEST['data']['Member']['log_password'];
		//echo $email." ".$pass;die;
		$this->autoRender = false;
		$count = $this->Member->find('count',array('conditions'=>array('Member.status'=>'Active','Member.email'=>$email,'Member.password'=>md5($pass))));
		if ($count > 0) {
			echo "true";die;
		}
		else {
			echo "false";die;
		}
	}
	function profile($id=null) {			
		$this->layout='public';
		$member_id=convert_uudecode(base64_decode($id));
		$info=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id),'contain'=>array('Deal' => 'DealCategory','MemberMeta','Location','MemberType')));
		$this->set(compact('info'));
		//pr($info);die;
		/* ------------------------ Please fill your Contact details -------------------------------*/
		if($info['MemberMeta']['account_holder'] != '' && $info['MemberMeta']['account_number'] != '' && $info['MemberMeta']['bank_name'] != '' && $info['MemberMeta']['branch_code'] != '')
		{
			$this->set('bankDetail','true');
		}
		else
		{
			$this->set('bankDetail','false');
		}
		
		/* ------------------------ Please fill your Contact details -------------------------------*/
		$options = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes'),'fields'=>array('Location.id','Location.name')));
		$this->set('options',$options);
		
		//$dealcat = $this->DealCategory->generateTreeList($conditions=array('DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '&nbsp&nbsp&nbsp&nbsp');
		//$this->set(compact('dealcat'));
		
		//........start alphabatical category order...
		$alphabatical_category=$this->_AlphabaticalCategory2();
		$this->set('dealcat',$alphabatical_category); 
      //........end alphabatical category order...
      
		//echo "<pre>";print_r($dealcat);
		$parent_catog = $this->DealCategory->generateTreeList($conditions=array('DealCategory.parent_id'=>'','DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '');
		$parent_catog_id=array_keys($parent_catog);
		$this->set('parent_catog_id',$parent_catog_id);
		/*$other_field=array();
		foreach($parent_catog_id as $p_id)
		{
			$find_max=$this->DealCategory->find('first',array('conditions'=>array('DealCategory.parent_id'=>$p_id),'fields'=>array('max(DealCategory.id) as max_id','DealCategory.parent_id'),'recursive'=>'-1'));
			$other_field[$find_max[0]['max_id']] = $p_id;
		}
		$this->set('parent_maxchild',$other_field);*/
		//echo "<pre>";print_r($parent_catogs);
		//echo "<pre>";print_r($other_field);
		//die;		
		
		if (!empty($this->data)) {
			$data= $this->data;					
			if ($this->data['Member1']['password'] != "")
				$data['Member']['password_copy'] = $this->data['Member1']['password'];
				$data['Member']['password'] = md5($this->data['Member1']['password']);
			//pr($this->data);die;						
			$this->Member->id = $member_id;
			if ($this->Member->save($data))
			{
				$this->MemberMeta->save($data);
				if(@$data['Member']['password'] !="" && @$data['Member']['password_copy'] !='')
				{
					$this->Session->write('success','Your new password was updated successfully!'); 
					$this->redirect(array('action'=>'profile',$id));
				}
				else 
				{
					$this->Session->write('success','Your profile has been updated successfully.'); 
					$this->redirect(array('action'=>'profile',$id));
				}			
			}
			else 
		   {
				$this->Session->write('error','An Error Occur! Please try again later.'); 
				$this->redirect(array('action'=>'profile',$id));
			}
		}  
	}    
   function mydeal()
   {
		$this->loadModel('Deal');
		if (!empty($_GET)) 
		{
			$data=$_GET;
			if ($data['startdate'] !='') 
			{
				$buyfrom=date('Y-m-d',strtotime($data['startdate']));
			}
			if ($data['enddate'] !='') 
			{
				$buyto=date('Y-m-d',strtotime($data['enddate']));
			}
			$conditions=array('Deal.delete_status'=>'No','Deal.active'=>'Yes');
			//$conditions = array_merge($conditions,array('Deal.active'=>'Yes','Deal.buy_from <='=>date("Y-m-d"),'Deal.buy_to >='=>date("Y-m-d")));
			if (!empty($buyfrom)) 
			{  
				//pr($buyfrom);die;
				$conditions=array_merge($conditions,array('Deal.buy_from >=' =>$buyfrom));
			}
			if (!empty($buyto)) 
			{ 
				//pr('hello buyto');die;
				$conditions=array_merge($conditions,array('Deal.buy_to <=' =>$buyto));
			}
			//pr($conditions);
			$login_supplier_id=$this->Session->read('Member.id');
			$member_id=convert_uudecode(base64_decode($login_supplier_id));
			//echo $member_id;
			$conditions=array_merge($conditions,array('Deal.member_id'=>$member_id));
			$this->paginate=array('fields'=>array('Deal.id','Deal.name','Deal.uri','Deal.image','Deal.buy_from','Deal.buy_to','Deal.active','DealCategory.name','Location.name','Deal.registered','Deal.newsletter_sent_date'),'order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
			$mydeal_info=$this->paginate('Deal',$conditions);
			$this->set('mydeal_info',$mydeal_info);
		   //pr($mydeal_info);die;          
		}
     	else
     	{
			$login_supplier_id=$this->Session->read('Member.id');
			$member_id=convert_uudecode(base64_decode($login_supplier_id));
			$conditions=array('Deal.member_id'=>$member_id,'Deal.delete_status'=>'No','Deal.active'=>'Yes');
			//pr($conditions);
			$check=$this->Deal->find('all',array('conditions'=>$conditions));
			//pr($check);die;
			$this->paginate=array('fields'=>array('Deal.id','Deal.name','Deal.uri','Deal.image','Deal.buy_from','Deal.buy_to','Deal.active','DealCategory.name','Location.name','Deal.registered','Deal.newsletter_sent_date'),'order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
			$mydeal_info=$this->paginate('Deal',$conditions);
			//pr($mydeal_info);die;
  	     	$this->set('mydeal_info',$mydeal_info);
			//pr($mydeal_info);die;
     	}
		if ($this->RequestHandler->isAjax()) {
     		$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
			$this->render('element2');
     	}
	}
  	function logout()
  	{
		$this->Session->delete('Member');
	 	$this->redirect(array('controller'=> 'Homes','action'=>'index')); 
  	}    
  	function checkCompanyRegistration() 
  	{
  		$val = trim($_REQUEST['data']['MemberMeta']['registration_no']);
  		$check = $this->MemberMeta->find('count',array('conditions'=>array('registration_no'=>$val)));
  		if($check) { 
    		echo 'false';die;
  		}
  		else {
    		echo 'true';die;
  		}
  	}
  	function checkCompanyRegistrationVal()	
  	{
   	$val = trim($_REQUEST['data']['MemberMeta']['vat_registration_no']);
   	$check = $this->MemberMeta->find('count',array('conditions'=>array('vat_registration_no'=>$val))); 
    	if ($check) { 
    		echo 'false';die;
  		}
  		else {
    		echo 'true';die;
  		}
  	}
  	function checkPassword($id =null)
  	{
		$adminDetails = $this->Member->findById($id);
		$password = $adminDetails['Member']['password'];
		$oldPassword = md5($_REQUEST['data']['Member']['old_password']);
		if ($password == $oldPassword) {
			echo 'true'; die;
		}
		else {
			echo 'false'; die;
		}
	}
	function checkPasswordpro($id =null) {
  		$adminDetails = $this->Member->findById($id);
  		$password = $adminDetails['Member']['password'];
  		$oldPassword = md5($_REQUEST['data']['Member1']['old_password']);
  		if ($password == $oldPassword) {
  			echo 'true'; die;
  		}
  		else {
  			echo 'false'; die;
  		}
	}
	function checkEditMemberEmail($id=NULL) {
  		//echo $id;die;
  		$email = trim($_REQUEST['data']['Member']['email']);
  		$this->autoRender = false;
  		$count = $this->Member->find('count',array('conditions'=>array('Member.email'=>$email,'Member.id NOT'=>$id)));
  		if ($count) {
  			echo "false";die;
  		}
  		else {
  			echo "true";die;
  		}
	}
		/*-------------Reconcile Modules starts------*/
	function sales_made()
	{
		$this->autoRender = false;
		$dealerId = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		
		$deal_id = $_POST['deal_id'];
		$deal_id = convert_uudecode(base64_decode($deal_id));
		$email = @$_POST['email'];
		$name = @$_POST['name'];
		$startdate = @$_POST['startdate'];
		$enddate = @$_POST['enddate'];
		if ($email!="" || $name!="" || $startdate!="" || $enddate!="") 
		{	$this->OrderDealRelation->virtualFields = array('uemail'=>'select email from members as m where m.id= Order.member_id','name'=>'select name from members as m where m.id= Order.member_id');
			//'OrderDealRelation.claim_status NOT'=>'ClaimApproved',
			$conditions =array('Order.order_status'=>'success','Deal.member_id'=>$dealerId,'OrderDealRelation.uemail LIKE'=>'%'.trim($email).'%','Deal.delete_status'=>'No','OrderDealRelation.deal_id'=>$deal_id,'OrderDealRelation.claim_status !='=>"NoClaim",'OrderDealRelation.claim_status NOT'=>"ClaimCancelled");
			if (@$_POST['name']!="")
			{ 
				$name = $_POST['name'];
				$conditions = array_merge($conditions,array('Deal.name LIKE'=>'%'.trim($name).'%'));
			}
			
			if (@$_POST['startdate']!="")
			{ 
				$startdate = date('Y-m-d',strtotime($_POST['startdate']));
				$conditions = array_merge($conditions,array('Order.payment_date >='=>$startdate));
			}
			if (@$_POST['enddate']!="")
			{
				$enddate = date('Y-m-d',strtotime($_POST['enddate']));
				$conditions = array_merge($conditions,array('Order.payment_date <='=>$enddate));
			}
			$this->paginate=array('limit'=>MINLIMIT,'order'=>array('OrderDealRelation.id'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption'));
			$orderrelation=$this->paginate('OrderDealRelation',$conditions);
			$orderrelation = Set::sort($orderrelation, '{n}.OrderDealRelation.sub_total', 'Desc');
		}
		else
		{
			//$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on orders.id=order_deal_relations.order_id where `order_deal_relations.deal_id`= Deal.id and orders.order_status!="failed" and order_deal_relations.claim_status!="NoClaim" and order_deal_relations.claim_status!="ClaimCancelled" ');	
			//$conditions=array('Deal.member_id'=>$member_id,'Deal.delete_status'=>'No','Deal.sales_deal >='=>'0');			
			
			$conditions =array('Order.order_status'=>'success','Deal.member_id'=>$dealerId,'Deal.delete_status'=>'No','OrderDealRelation.deal_id'=>$deal_id,'OrderDealRelation.claim_status !='=>"NoClaim",'OrderDealRelation.claim_status NOT'=>"ClaimCancelled");
			//pr($conditions);die;
			$this->paginate=array('limit'=>MINLIMIT,'order'=>array('OrderDealRelation.id'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption'));
			$orderrelation=$this->paginate('OrderDealRelation',$conditions);
			//pr($orderrelation);die;
			$orderrelation = Set::sort($orderrelation, '{n}.OrderDealRelation.sub_total', 'desc');
		}
		//$orderrelation = $this->OrderDealRelation->find('all',array('conditions'=>array('OrderDealRelation.claim_status NOT'=>'ClaimApproved','Deal.member_id'=>$dealerId),'contain'=>array('Order','Deal'=>array('Member'))));
		$this->set(compact('orderrelation'));
		//pr($orderrelation);die;
		if ($this->RequestHandler->isAjax())
		{
			$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
			$this->render('salemade');
		}
	}
	function check_claim() 
	{
		$this->autoRender = false;
		$code = $_POST['code'];
		$relId = $_POST['id'];
		$check = $this->OrderDealRelation->find('count',array('conditions'=>array('OrderDealRelation.voucher_code'=>$code,'OrderDealRelation.id'=>$relId)));
		if ($check>0) {
			$dateChk = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.voucher_code'=>$code,'OrderDealRelation.id'=>$relId)));
			$dealChk = $this->Deal->findById($dateChk['OrderDealRelation']['deal_id']);
			$redeemFrom = $dealChk['Deal']['redeem_from'];
			$redeemTo = $dealChk['Deal']['redeem_to'];
			$currentDate = Date('Y-m-d');
			if ($currentDate < $redeemFrom) {
				$dt = date('d M Y',strtotime($redeemFrom));
				echo "You can only redeem after $dt.";die;
			}
			if ($currentDate > $redeemTo) {
				echo "Your order redeem date has been expired.";die;
			}
			echo "true";die;
		}
		else
		{
			echo "Code does not match.";die;
		}
	}
	function upload_claim_pdf() {
	   $this->autoRender = false;
		//echo "<pre>";print_r($_FILES);die;
		$file = $_FILES['pdf'];
		//pr($file);				
		$imgName=$file['name']; 
		$ext = explode('.',$imgName);
		$image = $ext[0].'-'.time();
		$newFileName="claim_pdf_".$image.'.'.$ext[count($ext)-1];
		//echo "hi";die;
		$destLarge = realpath('../../app/webroot/claim_pdf') . '/';
		$tempFile =$file['tmp_name'];
		move_uploaded_file($tempFile,$destLarge.$newFileName);
		echo $newFileName;die;				
	}
	function submit_claim() {
		$this->autoRender = false;
		$claim = $_POST['pdfname'];
		$relId = $_POST['id'];
		$senton = date('Y-m-d H:i:s');
		if ($this->OrderDealRelation->updateAll(array('OrderDealRelation.claim_status'=>"'ClaimSent'",'OrderDealRelation.claim_pdf'=>'"'.$claim.'"','OrderDealRelation.c_r_date'=>'"'.$senton.'"'),array('OrderDealRelation.id'=>$relId))) {
			echo "success";die;
		}
		else {
				echo "error";die;
		}
	}
	function submit_refund() 
	{
		$this->autoRender = false;
		$reason = $_POST['reason'];
		$relId = $_POST['id'];
		$senton = date('Y-m-d H:i:s');
		
		$dateChk = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.id'=>$relId)));
		$dealChk = $this->Deal->findById($dateChk['OrderDealRelation']['deal_id']);
		$redeemFrom = $dealChk['Deal']['redeem_from'];
		$redeemTo = $dealChk['Deal']['redeem_to'];
		$currentDate = Date('Y-m-d');
		if ($currentDate < $redeemFrom) {
			$dt = date('d M Y',strtotime($redeemFrom));
			echo "You can only redeem after $dt.";die;
		}
		if ($currentDate > $redeemTo) {
			echo "Your order redeem date has been expired.";die;
		}
		if ($this->OrderDealRelation->updateAll(array('OrderDealRelation.refund_status'=>"'Yes'",'OrderDealRelation.supplier_refund_status'=>"'Pending'",'OrderDealRelation.refund_reason'=>'"'.$reason.'"','OrderDealRelation.c_r_date'=>'"'.$senton.'"'),array('OrderDealRelation.id'=>$relId))) {
			echo "success";die;
		}
		else {
				echo "There are some error please try later.";die;
		}
	}
	function check_authentication()
	{
		$this->autoRender = false;
		$voucherNo = $_POST['voucherNo'];
		$auth_only = $_POST['auth_only'];
		if(@$_POST['pdfname'] && $_POST['pdfname']!='')
		{
			$claim = $_POST['pdfname'];
		}
		else
		{
			$claim='';
		}
		//$securityNo = $_POST['securityNo'];,'Deal.delete_status'=>'No'
		$check = $this->OrderDealRelation->find('count',array('conditions'=>array('OrderDealRelation.voucher_code'=>$voucherNo,'Order.order_status'=>"success",'Deal.delete_status'=>'No')));
		if ($check>0)
		{
			$dateChk = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.voucher_code'=>
			$voucherNo,'Order.order_status'=>"success",'Deal.delete_status'=>'No')));
			//echo "<pre>";print_r($dateChk);die;
			$dealChk = $this->Deal->findById($dateChk['OrderDealRelation']['deal_id']);
			$redeemFrom = $dealChk['Deal']['redeem_from'];
			$redeemTo = $dealChk['Deal']['redeem_to'];
			$currentDate = Date('Y-m-d');
			$redeemFrom=date('Y-m-d',strtotime($redeemFrom));
			if ($currentDate < $redeemFrom)
			{
				$dt = date('d M Y',strtotime($redeemFrom));
				echo "You can only redeem after $dt.";die;
			}
			elseif ($currentDate > $redeemTo)
			{
				echo "Your order redeem date has been expired.";die;
			}
			elseif ($dateChk['OrderDealRelation']['refund_status']=='Yes')
			{
				echo "You have already request to refund amount.";die;
			}
			elseif (($dateChk['OrderDealRelation']['reconcile']=='Requested') || ($dateChk['OrderDealRelation']['reconcile']=='Completed'))
			{
				echo "You have used this voucher already.";die;
			}
			
			else
			{
				if(!empty($dealChk))
				{
					if($auth_only == 1) {
					
						echo "This Voucher has been authenticated only!";die;
					}
					else 
					{
						$cur_date = date('Y-m-d H:i:s');
						if($claim != '')
						{						
							$this->OrderDealRelation->updateAll(array('OrderDealRelation.claim_status'=>"'ClaimApproved'",'OrderDealRelation.claim_pdf'=>'"'.$claim.'"','OrderDealRelation.reconcile'=>"'Requested'",'OrderDealRelation.reconcile_sent_on'=>'"'.$cur_date.'"','OrderDealRelation.c_r_date'=>'"'.$cur_date.'"'),array('OrderDealRelation.id'=>$dateChk['OrderDealRelation']['id']));
						}
						else
						{						
							$this->OrderDealRelation->updateAll(array('OrderDealRelation.claim_status'=>"'ClaimApproved'",'OrderDealRelation.reconcile'=>"'Requested'",'OrderDealRelation.reconcile_sent_on'=>'"'.$cur_date.'"','OrderDealRelation.c_r_date'=>'"'.$cur_date.'"'),array('OrderDealRelation.id'=>$dateChk['OrderDealRelation']['id']));
						}
					}	
				}
				echo "true";die;
			}
			
		}
		else
		{
			echo "This voucher CANNOT be authenticated and should NOT be honoured.";die;
		}
	}		
	
	function update_status_forgot()
	{
		$this->autoRender = false;		
		$email =  $this->Session->read('email');
 		$this->Member->updateAll(array('Member.reset'=>"'Yes'"),array('Member.email'=>$email));	
	}
	function resubmit_claim_pdf() {
		$this->autoRender = false;
		$claim = $_POST['pdfname'];
		$relId = $_POST['id'];
		//$senton = date('Y-m-d H:i:s');
		if ($this->OrderDealRelation->updateAll(array('OrderDealRelation.claim_pdf'=>'"'.$claim.'"'),array('OrderDealRelation.id'=>$relId))) {
			echo "success";die;
		}
		else {
				echo "error";die;
		}
	}
	
	function resubmit_reason_pdf() {
		$this->autoRender = false;
		$claim = $_POST['pdfname'];
		$relId = $_POST['id'];
		//$senton = date('Y-m-d H:i:s');
		if ($this->OrderDealRelation->updateAll(array('OrderDealRelation.reason_pdf'=>'"'.$claim.'"'),array('OrderDealRelation.id'=>$relId))) {
			echo "success";die;
		}
		else {
				echo "error";die;
		}
	}
	function archived_deals()
	{
		if (!empty($_REQUEST))
		{
			
			$login_supplier_id=$this->Session->read('Member.id');
			$this->loadModel('Deal');
			$member_id=convert_uudecode(base64_decode($login_supplier_id));
      	$data=$_REQUEST;
         if (@$data['startdate'] !='') {
            $buyfrom=date('Y-m-d',strtotime(@$data['startdate']));
         }
         if (@$data['enddate'] !='') {
         	$buyto=date('Y-m-d',strtotime(@$data['enddate']));
         }
			$conditions=array('Deal.member_id'=>$member_id,'Deal.delete_status'=>'No','Deal.active'=>'No','Deal.buy_from <'=>date("Y-m-d"),'Deal.buy_to <'=>date("Y-m-d"));
         
         if (!empty($buyfrom))
         { 
            $conditions=array_merge($conditions,array('Deal.buy_from  >=' =>$buyfrom));
         }
         if (!empty($buyto))
         {       
           $conditions=array_merge($conditions,array('Deal.buy_to <=' =>$buyto));
         }
         //pr($conditions);die;
         $this->paginate=array('order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
         $archiveddeals=$this->paginate('Deal',$conditions);
	     $this->set('archiveddeals',$archiveddeals);
          
      }
      else
      { 
			$login_supplier_id=$this->Session->read('Member.id');
			$this->loadModel('Deal');
			$member_id=convert_uudecode(base64_decode($login_supplier_id));
			$conditions=array('Deal.member_id'=>$member_id,'Deal.delete_status'=>'No','Deal.active'=>'No','Deal.buy_from <'=>date("Y-m-d"),'Deal.buy_to <'=>date("Y-m-d"));
			//pr($conditions);die;
			$this->paginate=array('order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
			$archiveddeals=$this->paginate('Deal',$conditions);
  	     	$this->set('archiveddeals',$archiveddeals);
  	     	
		}
     	if ($this->RequestHandler->isAjax()) {
         $this->layout='';
         $this->autoRender=false;
         $this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
         $this->render('archiveddeals');
      }
	}
	function refund($page_id=NULL)
	{
		$this->autoRender = false;
		$dealerId = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$email = @$_POST['email'];
		$conditions=array('OrderDealRelation.refund_status NOT'=>'No','Deal.member_id'=>$dealerId,'Deal.delete_status'=>'No');

		$this->OrderDealRelation->virtualFields = array('uemail'=>'select email from members as m where m.id= Order.member_id');	
		if(@$email!="")
		{
			$conditions = array_merge($conditions,array('OrderDealRelation.uemail LIKE'=>'%'.$email.'%'));
		}		
		$this->paginate=array('limit'=>MINLIMIT,'order'=>array('OrderDealRelation.id'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'=>array('MemberMeta'=>array('fields'=>array('supplier%','cybercoupon%')))),'DealOption'));
		$orderrelation=$this->paginate('OrderDealRelation',$conditions);		
		$this->set(compact('orderrelation'));
		if ($this->RequestHandler->isAjax()) {
			$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
			$this->render('refund');
		}
	}

	function supplier_refund_status()
	{
	  //echo "<pre>";print_r($_POST);die;
	  $this->autoRender=false;
	  $order_deal_relation_id=$_REQUEST['order_relation_id'];
	  $refund_status=$_REQUEST['refund_status'];
	  $this->OrderDealRelation->updateAll(array('OrderDealRelation.supplier_refund_status'=>'"'.$refund_status.'"'),array('OrderDealRelation.id'=>$order_deal_relation_id));
	  echo "success";die;
	}

	function claim() {
		$this->autoRender = false;
		$this->loadModel('PaymentHistory');
		$this->loadModel('PaymentRelease');
		$dealerId = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$conditions=array('PaymentHistory.member_id'=>$dealerId);
		if (!empty($_POST)) 
		{
			$data=$_POST;
			//pr($data);die;
			if($data['startdate'] !='')
				$startdate=date('Y-m-d',strtotime($data['startdate']));
			if ($data['enddate'] !='')
				$enddate=date('Y-m-d',strtotime($data['enddate']));
			if (!empty($startdate)) 
			{  
				$conditions=array_merge($conditions,array('PaymentHistory.date >=' =>$startdate));
			}
			if (!empty($enddate)) 
			{ 
				$conditions=array_merge($conditions,array('PaymentHistory.date <=' =>$enddate));
			}
			//pr($conditions);die;
			$this->paginate=array('limit'=>MINLIMIT,'order'=>array('PaymentHistory.date'=>'desc'),'group'=>array('PaymentHistory.payment_release_id'));
			$orderrelation=$this->paginate('PaymentHistory',$conditions);			
			$this->set(compact('orderrelation'));
			$member_info=$this->Member->find('first',array('conditions'=>array('Member.id'=>$dealerId),'fields'=>array('MemberMeta.supplier%','MemberMeta.cybercoupon%'),'recursive'=>0));
			$this->set(compact('member_info'));
			
		}
     	else 
     	{
			$this->paginate=array('limit'=>MINLIMIT,'order'=>array('PaymentHistory.date'=>'desc'),'group'=>array('PaymentHistory.payment_release_id'));
			$orderrelation=$this->paginate('PaymentHistory',$conditions);
			
			$this->set(compact('orderrelation'));
			$member_info=$this->Member->find('first',array('conditions'=>array('Member.id'=>$dealerId),'fields'=>array('MemberMeta.supplier%','MemberMeta.cybercoupon%'),'recursive'=>0));
			$this->set(compact('member_info'));
		}
		if ($this->RequestHandler->isAjax()) {
			$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
			$this->render('claim');
		}
	}
	
	function payment_history($id=Null) {
		$this->layout='public';
		$this->loadModel('PaymentHistory');
		$payment_his_id = convert_uudecode(base64_decode($id));
		$dealerId = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		if (!empty($_POST)) 
		{
			$data=$_POST;
			//pr($data);die;
			if($data['startdate'] !='')
				$startdate=date('Y-m-d',strtotime($data['startdate']));
			if ($data['enddate'] !='')
				$enddate=date('Y-m-d',strtotime($data['enddate']));
			if (!empty($startdate)) 
			{  
				$conditions=array_merge($conditions,array('PaymentHistory.date >=' =>$startdate));
			}
			if (!empty($enddate)) 
			{ 
				$conditions=array_merge($conditions,array('PaymentHistory.date <=' =>$enddate));
			}
			//pr($conditions);die;			
		}
		if ($dealerId!="") {
			$mem_info = $this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$dealerId),'fields'=>array('id','member_id','supplier%','cybercoupon%')));
			$this->set(compact('mem_info'));
			$history = $this->PaymentHistory->find('first',array('conditions'=>array('PaymentHistory.id'=>$payment_his_id)));
			$deal_rel_id = explode(',',$history['PaymentHistory']['order_relation_id']);
			$reconcile_list = $this->OrderDealRelation->find('all',array('conditions'=>array('OrderDealRelation.id'=>$deal_rel_id),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
			$this->set(compact('reconcile_list'));
			$this->set(compact('history'));
		} else {
			$this->redirect(array('controller'=>'Homes','action'=>'index'));
		}
	}
	function sales_total() 
	{
		$login_supplier_id=$this->Session->read('Member.id');
		$member_id=convert_uudecode(base64_decode($login_supplier_id));
		if (!empty($_POST)) 
		{
			$data=$_POST;
			//pr($data);
			//echo $data['dealName'];die;
			if($data['dealName'] !='')
         	$dealName=$data['dealName'];
			if(@$data['startdate'] !='')
         	$buyfrom=date('Y-m-d',strtotime($data['startdate']));			
			if (@$data['enddate'] !='')
            $buyto=date('Y-m-d',strtotime($data['enddate']));
            $conditions=array('Deal.member_id'=>$member_id,'Deal.sales_deal >='=>'0');
			//$conditions = array_merge($conditions,array('Deal.active'=>'Yes','Deal.buy_from <='=>date("Y-m-d"),'Deal.buy_to >='=>date("Y-m-d")));
			if (!empty($dealName)) 
			{  
				$conditions=array_merge($conditions,array('Deal.name LIKE' =>'%'.$dealName.'%'));
			}
			if (!empty($buyfrom)) 
			{  
				$conditions=array_merge($conditions,array('Deal.buy_from >=' =>$buyfrom));
			}
			if (!empty($buyto)) 
			{ 
				$conditions=array_merge($conditions,array('Deal.buy_to <=' =>$buyto));
			}
			//pr($conditions);die;
			$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on orders.id=order_deal_relations.order_id where `order_deal_relations.deal_id`= Deal.id and orders.order_status!="failed" and order_deal_relations.claim_status!="NoClaim" and order_deal_relations.claim_status!="ClaimCancelled" ');
			$this->paginate=array('order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
			$mydeal_info=$this->paginate('Deal',$conditions);
			$mydeal_info = Set::sort($mydeal_info, '{n}.Deal.sales_deal', 'desc');
			$this->set('mydeal_info',$mydeal_info);
			
		}
     	else 
     	{
			$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on orders.id=order_deal_relations.order_id where `order_deal_relations.deal_id`= Deal.id and orders.order_status!="failed" and order_deal_relations.claim_status!="NoClaim" and order_deal_relations.claim_status!="ClaimCancelled" ');	
			$conditions=array('Deal.member_id'=>$member_id,'Deal.sales_deal >='=>'0');
			$this->paginate=array('order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
			$mydeal_info=$this->paginate('Deal',$conditions);
			$mydeal_info = Set::sort($mydeal_info, '{n}.Deal.sales_deal', 'desc');
  	     	$this->set('mydeal_info',$mydeal_info);
			//pr($mydeal_info);die;
     	}
		if ($this->RequestHandler->isAjax()) 
		{
     		$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
			$this->render('element3');
     	}
	}
	
	function authenticate_total () {
	
		$login_supplier_id=$this->Session->read('Member.id');
		$member_id=convert_uudecode(base64_decode($login_supplier_id));
		$conditions=array('Order.supplier_id'=>$member_id,'OrderDealRelation.claim_status !='=>'NoClaim');
		if (!empty($_POST)) 
		{	
			$data=$_POST;
			if($data['startdate'] !='')
				$claimfrom=date('Y-m-d',strtotime($data['startdate']));
			if ($data['enddate'] !='')
				$claimto=date('Y-m-d',strtotime($data['enddate']));
			if (!empty($claimfrom)) 
			{  
				$conditions=array_merge($conditions,array('OrderDealRelation.c_r_date >=' =>$claimfrom));
			}
			if (!empty($claimto)) 
			{ 
				$conditions=array_merge($conditions,array('OrderDealRelation.c_r_date <=' =>$claimto));
			}
			
		}
		$this->paginate=array('limit'=>MINLIMIT,'contain'=>array('Order'));
		$mydeal_info=$this->paginate('OrderDealRelation',$conditions);
		$this->set('mydeal_info',$mydeal_info);
		if ($this->RequestHandler->isAjax()) 
		{
     		$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
			$this->render('element_claim_totals');
		}
	}
	
	function news_letters() 
	{
		$this->loadModel('Deal');
		$this->loadModel('Dispatch');
		$this->loadModel('DispatchDeal');
		$login_supplier_id=$this->Session->read('Member.id');
		$member_id=convert_uudecode(base64_decode($login_supplier_id));		
		//echo $member_id;die;
		$conditions=array('DispatchDeal.supplier_id'=>$member_id,'Dispatch.status'=>'sent');
		$this->paginate=array('limit'=>MINLIMIT,'contain'=>array('Dispatch','Deal'=>array('id','name','member_id','image','location','category'),'Deal'=>'Location'));
		$all=$this->paginate('DispatchDeal',$conditions);
		//$this->set('data',$all);
		//$conditions = array('DispatchDeal.supplier_id'=>$member_id);
		//$all=$this->DispatchDeal->find('all',array('conditions'=>array('DispatchDeal.supplier_id'=>$member_id),'contain'=>array('Dispatch','Deal'=>array('id','name','member_id','image','location','category'),'Deal'=>'Location')));
		//pr($all);die;
		$this->set('data',$all);
		if ($this->RequestHandler->isAjax()) 
		{
     		$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
			$this->render('news_letters_element');
     	}
	}
	function queued_deals()
	{
		$currentDate = date('Y-m-d'); 
		//echo $currentDate;die;
                if(!empty($_POST)):
                $data=$_POST;
                   $startdate = $data['startdate'];
                   $enddate = $data['enddate'];
                endif;
		if (!empty($startdate) || !empty($enddate))
		{
			$login_supplier_id=$this->Session->read('Member.id');
			$this->loadModel('Deal');
			$member_id=convert_uudecode(base64_decode($login_supplier_id));
			if (@$data['startdate'] !='') {
				$buyfrom=date('Y-m-d',strtotime(@$data['startdate']));
			}
			if (@$data['enddate'] !='') {
				$buyto=date('Y-m-d',strtotime(@$data['enddate']));
			}
			$conditions=array('Deal.member_id'=>$member_id,'Deal.delete_status'=>'No','Deal.active'=>'No');
                        if (!empty($buyfrom))
			{ 
				$conditions=array_merge($conditions,array('Deal.buy_from  >=' =>$buyfrom));
			}
			if (!empty($buyto))
			{       
				$conditions=array_merge($conditions,array('Deal.buy_to <=' =>$buyto));
			}
			//pr($conditions);die;
			$this->paginate=array('order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
			$queued=$this->paginate('Deal',$conditions);
			$this->set('queued',$queued);          
		}
		else
		{ 
			$login_supplier_id=$this->Session->read('Member.id');
			$this->loadModel('Deal');
			$member_id=convert_uudecode(base64_decode($login_supplier_id));
			$conditions=array('Deal.buy_from >=' =>$currentDate,'Deal.buy_to >=' =>$currentDate,'Deal.member_id'=>$member_id,'Deal.delete_status'=>'No','Deal.active'=>'No');
			//pr($conditions);die;
			$this->paginate=array('order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
			$queued=$this->paginate('Deal',$conditions);
			//pr($archiveddeals);die;
			$this->set('queued',$queued); 	     	
		}
     	if ($this->RequestHandler->isAjax()) {
        $this->layout='';
        $this->autoRender=false;
        $this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
        $this->render('queueddeals');
      }
	}

}
?>