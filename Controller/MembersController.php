<?php
ob_start();
class MembersController extends AppController {
	var $helpers = array('Html','Form','Session','Js','Paginator');
	var $components = array('RequestHandler','Cookie','Session','Email');
	var $uses = array('Member','MemberType','Location','BusinessType','BusinessCategory','MemberMeta','EmailTemplate','AdminModule');
	
	function beforeFilter() {
		$this->disableCache();
		parent::beforeFilter();
		if (!$this->CheckAdminSession() && $this->request->prefix=='admin' && !in_array($this->request->action,array('admin_login','admin_forgot_password','admin_reset_password'))) {    
			$this->redirect(array('controller'=>'auths','action' => 'login','admin' => true));
			exit();
		}	
	}
	/*function admin_members() {
		$this->layout='admin';
		$member=$this->Member->find('all',array('order'=>array('Member.id desc'),'conditions'=>array('MemberType.name NOT'=>'admin','MemberType.id NOT'=>'1')));
		$this->set(compact('member'));
	}*/
	function admin_members($member_type=null) {
		$this->layout = 'admin';
		$member_type=convert_uudecode(base64_decode($member_type));
		//$adminId= $this->Session->read('Admin.id');
		//echo $adminId;die;
		$this->set(compact('member_type'));
		$conditions = array();
                if (!empty($this->request->data)) {
			
			$business_name = trim(@$_POST['data']['MemberMeta']['business_name']);
			$names = trim(@$_POST['data']['Member']['name']);
			$surnames = trim(@$_POST['data']['Member']['surname']);
			$emails = trim(@$_POST['data']['Member']['email']);
			$city = trim(@$_POST['data']['Member']['city']);
			$location = trim(@$_POST['data']['Member']['location']);
			$news_location = trim(@$_POST['data']['Member']['news_location']);
			$status = trim(@$_POST['data']['Member']['status']);
			//echo $status;die;
			$reg_from = trim(@$_POST['data']['Member']['registered']);
			$reg_to = trim(@$_POST['data']['Member']['register_to']);
			if ($business_name!= "") {
				$conditions = array_merge($conditions,array('MemberMeta.company_name LIKE'=>'%'.$business_name.'%'));
			}
			if ($names!= "") {
				$conditions = array_merge($conditions,array('Member.name LIKE'=>'%'.$names.'%'));
			}
			if ($surnames!= "") {
				$conditions = array_merge($conditions,array('Member.surname LIKE'=>'%'.$surnames.'%'));
			}
			if ($emails!= "") {
				$conditions = array_merge($conditions,array('Member.email LIKE'=>'%'.$emails.'%'));
			}
			if ($city!= "") {
				$conditions = array_merge($conditions,array('Member.city LIKE'=>$city));
			}			
			if ($status!= "") 
			{
				if($member_type == '3')
				{
					
					if($status == 'Suspended')
					{
						$conditions = array_merge($conditions,array("AND" => array (
																		"Member.first_step_approval " => 'Yes',
																		"Member.second_step_approval " => 'Yes',
																		"Member.status " => 'Inactive'
																	)
																)
															);
					}
					elseif($status == 'Active')
					{
						$conditions = array_merge($conditions,array("AND" => array (
																		"Member.first_step_approval " => 'Yes',
																		"Member.second_step_approval " => 'Yes',
																		"Member.status " => 'Active'
																	)
																)
															);
					}
					elseif($status == '1')
					{
						$conditions = array_merge($conditions,array("Member.first_step_approval " => 'No',
																	));
					}
					elseif($status == '2')
					{
						$conditions = array_merge($conditions,array("AND" => array (
																		"Member.first_step_approval " => 'Yes',
																		"Member.second_step_approval " => 'No',
																	)));
					}
					elseif($status == '3')
					{
						$conditions = array_merge($conditions,array("AND" => array (
																		"Member.first_step_approval " => 'No',
																		"Member.second_step_approval " => 'No',
																		"Member.status " => 'Inactive',
																	)));
					}
					
				}
				if($member_type == '2')
				{
					if($status == 'unsuspended')
					{
						$conditions = array_merge($conditions,array("AND" => array (
																		"Member.status " => 'Active',
																		"Member.first_step_approval " => 'Yes',
																		"Member.second_step_approval " => 'Yes'
																	)
																)
															);
					}
					elseif($status == 'suspended')
					{
						$conditions = array_merge($conditions,array("AND" => array (
																		"Member.status " => 'Inactive',
																		"Member.first_step_approval " => 'Yes',
																		"Member.second_step_approval " => 'Yes'
																	)
																)
															);					
					}
					else
					{
						$conditions = array_merge($conditions,array('Member.status'=>$status));
					}
					
				}
				else
				{
					$conditions = array_merge($conditions,array('Member.status'=>$status));
				}
			}
			if($reg_from!="") {
			      $reg_from=date('Y-m-d',strtotime($reg_from));
				  $conditions=array_merge($conditions,array('Member.registered >= ' =>$reg_from));
				//pr($conditions);die;									
			}
			if($reg_to!="") {
			    $reg_to=date('Y-m-d',strtotime($reg_to));
				$conditions=array_merge($conditions,array('Member.registered <= ' =>$reg_to));
				//pr($conditions);die;									
			}
			if ($location!= "")
			{
				$conditions = array_merge($conditions,array('Member.location'=>$location));
			}
			if ($news_location!= "") 
			{				
				$options = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes','Location.mandatory_location'=>'Yes'),'fields'=>array('Location.id','Location.name')));				
				$menadatory_loc=array();
				//pr($options);die;				
				if(!empty($options))
				{
					foreach($options as $each_option)
					{
						$menadatory_loc[]=$each_option['Location']['id'];
					}
				}
				$location_condition=array();
				$fetch_member=$this->Member->find('all',array('conditions'=>$conditions,'fields'=>array('Member.id','Member.news_location','Member.news_location_updation'),'recursive'=>'-1'));	
	        	foreach($fetch_member as $other_location)
			  	{
			  		
					$each_location=$other_location['Member']['news_location'];
					$sub_location=explode(',',$each_location);
					if($other_location['Member']['news_location_updation']=='No')
					{
						$sub_location=array_merge($sub_location,$menadatory_loc);
						array_unique($sub_location);
					}
					if(in_array($news_location,$sub_location))
					{
					    $location_condition[]=$other_location['Member']['id'];
					}
				}	
				if(!empty($location_condition))
				{
					if (count($location_condition)>1)
					{		
						$conditions=array_merge($conditions,array('Member.id in'=>$location_condition));
					}
					else
					{
						$conditions=array_merge($conditions,array('Member.id'=>$location_condition));
					}
				}
				else
				{
				   $conditions = array_merge($conditions,array('Member.id'=>-1));
				}
			}
			//pr($conditions);die;
			$this->Session->write('con', $conditions);
			/*if ($type!= "") {
				$conditions = array_merge($conditions,array('Mem.name'=>$type));
			} */
			
		} else {
			
			$conditions = $this->Session->read('con');
		}
		
		//$con=$this->Session->write('con',$conditions);
		//echo '<pre>';print_r($conditions);die;
		$this->Member->bindModel(array(
				'belongsTo' =>array(
					'ApprovalSupplier1'=>array(
						'className'=>'Member',
						'foreignKey'=>'member_approve_first_step_approval')
						)
					)
				);
		$this->Member->bindModel(array(
				'belongsTo' =>array(
					'ApprovalSupplier2'=>array(
						'className'=>'Member',
						'foreignKey'=>'member_approve_second_step_approval')
						)
					)
				);		
		
		if (!empty($conditions) || isset($status) && $status  == 'all') 
		{   
		   // pr($conditions);die;
		   
		    if(@$conditions['Member.status']== '3'){
				unset($conditions['Member.status']);
				$conditions = array_merge($conditions,array("Member.first_step_approval " => 'No',"Member.second_step_approval " => 'No',"Member.status"=>'Inactive'));
				$this->Session->write('con', $conditions);
			}
			
		    if(@$conditions['Member.status']=='all'){
				unset($conditions['Member.status']);
				$this->Session->write('con', array(''));
			}
			
			$conditions = array_merge($conditions,array('Member.member_type'=>$member_type,'MemberType.name NOT'=>'admin','MemberType.id NOT'=>'1')); 
			$this->paginate=array('limit'=>10,'order'=>'Member.id desc','conditions'=>$conditions,'contain'=>array('MemberMeta'=>array('company_name'),'Location','MemberType','ModulePermission','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname')));
			$member=$this->paginate('Member',$this->Session->read('con'));
			$this->Session->write('export',$conditions);
			//pr($conditions);
			//pr($member);die;		
			$totalMem=$this->Member->find('count',array('order'=>'Member.id desc','conditions'=>$conditions,'contain'=>array('MemberMeta'=>array('company_name'),'Location','MemberType','ModulePermission','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname'))));
		}
		else 
		{
			//pr($this->Session->check('con'));die;
			
			//echo "jjj";die;
			if(empty($conditions))
			{
				if ($this->Session->check('con') && empty($this->request->data)) {
					$conditions = $this->Session->read('con');    
				} 
				else {
					$this->Session->delete('con');
					$conditions = array();
				}
			}
			//'Member'=>array('id','name','surname','member_type','email','phone','city','location','status','first_step_approval','registered'),
			if($member_type == '3')
			{																		
				$conditions = array_merge($conditions,array("Member.first_step_approval " => 'No',"Member.second_step_approval " => 'No',"Member.status"=>'Inactive'));
			}
			$conditions = array_merge($conditions,array('Member.member_type'=>$member_type));
			//pr($conditions);die;
			$this->Session->write('export',$conditions);
			$this->paginate=array('limit'=>10,'order'=>'Member.id desc','conditions'=>$conditions,'contain'=>array('MemberMeta'=>array('company_name'),'Location','MemberType','ModulePermission','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname')));
			$member=$this->paginate('Member',$conditions);
			//$this->Session->delete('con');
			$totalMem=$this->Member->find('count',array('order'=>'Member.id desc','conditions'=>$conditions,'contain'=>array('MemberMeta'=>array('company_name'),'Location','MemberType','ModulePermission','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname'))));
		}
		$totalMemember=$this->Member->find('count',array('order'=>'Member.id desc','conditions'=>array('Member.member_type'=>$member_type),'contain'=>array('MemberMeta'=>array('company_name'),'Location','MemberType','ModulePermission','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname'))));
		$this->set(compact('member'));
		$this->set(compact('totalMemember'));
		$this->set(compact('totalMem'));
		$this->set('member_type',$member_type);
		$cities = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		$this->set('cities',$cities);  
		
		if ($this->RequestHandler->isAjax()) {
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Members';
			$this->render('members_list');
		}
	}
	function admin_generate_csv($member_type=null) {	
		$member_type = convert_uudecode(base64_decode($member_type)); 
		//echo $member_type;		
		$conditions = $this->Session->read('export');
		//pr($conditions);die;
		if ($conditions['Member.member_type'] =='3') {
			$this->layout = "admin";
			$this->autoRender = false;
			$this->loadModel('Member');
			Configure::write('debug', 2);
			$data = "Name,Email,Phone,Company_Name,Status,Customer_Type \n";
			$allPayments = $this->Member->find('all', array('conditions'=>$conditions,'order'=>'Member.id desc','recursive'=>0));		  
			foreach ($allPayments as $payment) {	
				$data .= $payment['Member']['name'].",";
				$data .= $payment['Member']['email'].",";
				$data .= $payment['Member']['phone'].",";
				$data .= $payment['MemberMeta']['company_name'].",";
				
				$data .=$payment['Location']['active'].",";
				$data .=$payment['MemberType']['name'].",";		
				//$totalDeal = $this->Member->find('count', array('conditions' => array('Member.id' => '<> NULL ')));	
				//pr($totalDeal);											
				$data .="\n";	
			}
			//pr($data);die;
			$this->Session->delete('Member_sess');
			header("Content-Type: application/csv");			
			$csv_filename = 'Payment_list_'.date("Y-m-d_H-i",time()).'.csv';
			header("Content-Disposition:attachment;filename=".$csv_filename);
			$fd = fopen ($csv_filename, "w");
			fputs($fd,$data);
			fclose($fd);
			echo $data;
			die();		
		}
		if ($conditions['Member.member_type'] =='2') {		
			$this->layout="admin";
			$this->autoRender=false;
			$this->loadModel('Member');
			Configure::write('debug', 2);
			$data = "Name,Email,Phone,Company_Name,Status,Customer_Type \n";
			$allPayments = $this->Member->find('all', array('conditions'=>$conditions,'order'=>'Member.id desc','recursive'=>0));		
			//pr($allPayments);die;	   
			foreach ($allPayments as $payment) {	
				$data .= $payment['Member']['name'].",";
				$data .= $payment['Member']['email'].",";
				$data .= $payment['Member']['phone'].",";
				$data .= $payment['MemberMeta']['company_name'].",";
				
				$data .= $payment['Location']['active'].",";
				$data .= $payment['MemberType']['name'].",";		
				//$totalDeal = $this->Member->find('count', array('conditions' => array('Member.id' => '<> NULL ')));	
				//pr($totalDeal);											
				$data .= "\n";	
			}
			//pr($data);die;
			$this->Session->delete('Member_sess');
			header("Content-Type: application/csv");			
			$csv_filename = 'Payment_list_'.date("Y-m-d_H-i",time()).'.csv';
			header("Content-Disposition:attachment;filename=".$csv_filename);
			$fd = fopen ($csv_filename, "w");
			fputs($fd,$data);
			fclose($fd);
			echo $data;
			die();
		}
		if ($conditions['Member.member_type'] =='4') {
			//echo hiiiiiiiiiii;die;
			$this->layout = "admin";
			$this->autoRender = false;
			$this->loadModel('Member');
			Configure::write('debug', 2);
			$data = "Name,Email,Phone,Status,Type \n";
			$allPayments = $this->Member->find('all', array('conditions'=>$conditions,'order'=>'Member.id desc','recursive'=>0));		
			//pr($allPayments);die;
			foreach ($allPayments as $payment) {	
				$data .= $payment['Member']['name'].",";
				$data .= $payment['Member']['email'].",";
				$data .= $payment['Member']['phone'].",";
				$data .= $payment['Location']['active'].",";
				$data .= $payment['MemberType']['name'].",";			
				$data .= "\n";					
			}
			$this->Session->delete('Member_sess');
			header("Content-Type: application/csv");			
			$csv_filename = 'Payment_list'."_".date("Y-m-d_H-i",time()).".csv";
			header("Content-Disposition:attachment;filename=$csv_filename");
			$fd = fopen ($csv_filename, "w");
			fputs($fd,$data);
			fclose($fd);
			echo $data;
			die();
			}
	}
	function admin_generate_xsl($member_type=null) {
		$member_type = convert_uudecode(base64_decode($member_type)); 
		$conditions = $this->Session->read('export');
		//pr($conditions);die;
		if ($conditions['Member.member_type'] == '2') {
			$this->autoRender=false;
			ini_set('max_execution_time', 1600); 
			$header_row="Name,Email,Phone,Customer_Type,Company_Name,Status\n";		
			$results=$this->Member->find('all',array('conditions'=>$conditions));	
			//pr($results);die;
			foreach ($results as $result) {
				@$header_row.= $result['Member']['name'].",". $result['Member']['email'] .",".$result['Member']['phone'] .",".$result['MemberType']['name'].",". $result['MemberMeta']['company_name'] .",". $result['Location']['active'] .","."\n";
			}		
			$filename = "export_".date("Y.m.d").".xls";
			header('Content-type: application/ms-excel');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			echo($header_row);
		}
		if ($conditions['Member.member_type'] =='3') {
			$this->autoRender=false;
			ini_set('max_execution_time', 1600); 
			$header_row = "Name,Email,Phone,Customer_Type,Company_Name,Status\n";		
			$results=$this->Member->find('all',array('conditions'=>$conditions));	
			//pr($results);die;
			foreach ($results as $result) {
				@$header_row.= $result['Member']['name'].",". $result['Member']['email'] .",".$result['Member']['phone'] .",".$result['MemberType']['name'].",". $result['MemberMeta']['company_name'] .",". $result['Location']['active'] .","."\n";
			}		
			$filename = "export_".date("Y.m.d").".xls";
			header('Content-type: application/ms-excel');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			echo($header_row);
		}
		if ($conditions['Member.member_type'] =='4') {
			$this->autoRender = false;
			ini_set('max_execution_time', 1600); 
			$header_row = "Name,Email,Phone,Customer_Type,Company_Name,Status\n";
			$results = $this->Member->find('all',array('conditions'=>$conditions));
			//pr($results);die;
			foreach ($results as $result) {
				@$header_row.= $result['Member']['name'].",". $result['Member']['email'] .",".$result['Member']['phone'] .",".$result['MemberType']['name'].",". $result['MemberMeta']['company_name'] .",". $result['Location']['active'].","."\n";
			}		
			$filename = "export_".date("Y.m.d").".xls";
			header('Content-type: application/ms-excel');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			echo($header_row);
		}
		//unset($_SESSION['$conditions']);
	}
	function admin_addMember($member_type=NULL) {
		$this->layout = 'admin';
		$member_type1 = convert_uudecode(base64_decode($member_type));
		$this->set('member_type',$member_type1);
		$options = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes'),'fields'=>array('Location.id','Location.name')));
		$this->set('options',$options);
     	$business_cat = $this->BusinessCategory->find('all',array('order'=>array('BusinessCategory.id ASC'))); 
     	$this->set(compact('business_cat'));
     	$business_type = $this->BusinessType->find('all',array('order'=>array('BusinessType.id ASC'))); 
     	$this->set(compact('business_type'));     
		$options2 = $this->MemberType->find('all',array('conditions'=>array('MemberType.name NOT'=>'admin','MemberType.id NOT'=>'1'),'fields'=>array('MemberType.id','MemberType.name'),'order'=>'MemberType.name ASC'));
		$this->set('options2',$options2);   
		//...........for sub-admin permission......
		$Categorylist = $this->AdminModule->find('threaded',array('conditions'=>array('AdminModule.active'=>'Yes','AdminModule.parent_id'=>0)));
		//pr($Categorylist);die;
		$this->set('Categorylist',$Categorylist);
		if (!empty($this->request->data)) 
		{
			$module_permission=@$_POST['ModulePermission'];
			//pr($module_permission);die;
			
			
			$data1=$this->request->data;
			$data1['Member']['password_copy']=$this->data['Member']['password'];
			$data1['Member']['password']=md5($this->data['Member']['password']);
			$data1['Member']['status']='Active';
			$data1['Member']['first_step_approval'] = 'Yes';
			$data1['Member']['registered'] = date('Y-m-d H:i:s');
			if ($this->Member->save($data1)) 
			{
				$recentadded_memberid=$this->Member->getLastInsertId();
				//$recentadded_memberid=1;
				
				if ($data1['Member']['member_type'] == '3') 
				{
					$data1['MemberMeta']['member_id'] = $recentadded_memberid;
					$data1['MemberMeta']['start_date'] = @date('Y-m-d',strtotime($data1['MemberMeta']['start_date']));
					$this->MemberMeta->save($data1);
				}
				
				
				//..........for subadmin module.........
				
				$module_permission=@$_POST['ModulePermission'];
				//pr($module_permission);die;
				$this->loadModel('ModulePermission');
				if (!empty($module_permission)) 
				{
					foreach($module_permission as $permission_key=>$permission_value) 
					{
						$final_permission=array();
						$final_permission['ModulePermission']['module_id']=$permission_key;
						$final_permission['ModulePermission']['member_id']=$recentadded_memberid;
						$final_permission['ModulePermission']['view_permission']=$permission_value['view'];
						$final_permission['ModulePermission']['edit_permission']=$permission_value['edit'];
						//pr($final_permission);die;
						$this->ModulePermission->create();
					   $this->ModulePermission->save($final_permission); 
					}
					
				}
				//...........end for subadmin module.....  
				
				
					 
				$emailTemp1 = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'subadmin_email')));
				//echo "<pre>";print_r($emailTemp1);die;	
				//  pr($data1);
				$name = $data1['Member']['name']." ".$data1['Member']['surname'];
				$emailid = $data1['Member']['email'];
				$password = $data1['Member']['con_password'];
				//pr($message);
				//pr($name);
				$common_template = $emailTemp1['EmailTemplate']['description'];
				// echo "<pre>";print_r($common_template);
				$common_template = str_replace('{name}',$name,$common_template);
				$common_template = str_replace('{emailid}',$emailid,$common_template);
				$common_template = str_replace('{password}',$password,$common_template);
				$email1=$data1['Member']['email'];		
				//	pr($email1);
				//echo "<pre>";print_r($common_template);
				$email = new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$common_template));
				$email->to($email1);
				//$email->cc('promatics.rakeshmaurya@gmail.com');
				$email->from($emailTemp1['EmailTemplate']['from']);
				$email->subject($emailTemp1['EmailTemplate']['subject']);  
				$email->send();
				$this->Session->write('success','Member has added successfully.');
				$url='admin_members/'.$member_type;
				//echo $url;die;
				$this->redirect(array('action'=>'admin_members/'.$member_type));
			}
		}
	}
	function admin_checkMemberEmail() {
		//pr($this->data);die;
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
	function admin_checkMemberCompId() {
  		$comp=trim($_REQUEST['data']['Member']['company_id']);
  		$this->autoRender = false;
  		$count=$this->Member->find('count',array('conditions'=>array('Member.company_id'=>$comp)));
  		if($count > 0) {
  			echo "false";die;
  		}
  		else {
  			echo "true";die;
  		}
	}
	function admin_deleteMember($id=null) {
		$this->autoRender=false;
		$member_id=convert_uudecode(base64_decode($id));
		$del_mem=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));
		//pr($del_mem);die;
		$member_type=base64_encode(convert_uuencode($del_mem['MemberType']['id']));
		if($this->Member->delete($member_id)) {
			$this->Session->write('success','Member has been deleted successfully');
			$this->redirect(array('action'=>'admin_members',$member_type));
		}		
	}
	function admin_statusMember($id=NULL) {		
		$member_id = convert_uudecode(base64_decode($id));
		//echo $member_type;die;
		//$old_data = $this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id),'fields'=>array('email','status','name','surname','member_type')));
		$old_data = $this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id),'fields'=>array('email','status','name','surname','member_type','MemberType.name','MemberType.id'),'contain'=>array('MemberType','Deal','ModulePermission')));		
		//pr($old_data);
		$email = $old_data['Member']['email'];
		$memtype = $old_data['Member']['member_type'];
		$MemberType = $old_data['MemberType']['name'];
		//echo $MemberType;die;
		$membtype = base64_encode(convert_uuencode($memtype));
		//pr($membtype);die;		
		//$old_data = $old_data['Member']['status'];
		
		$name = $old_data['Member']['name']." ".$old_data['Member']['surname'];
		//pr($name);die;
		if($old_data['Member']['status']=="Active") {
			$adminId = $this->Session->read('Admin.id');
			$datefiStApp = date('Y-m-d H:i:s');
			if($this->Member->updateAll(array('Member.status'=>"'Inactive'",'Member.second_step_approval'=>"'Yes'",'Member.member_approve_second_step_approval' =>'"' . $adminId .'"','Member.date_approve_second_step_approval' =>'"' . $datefiStApp .'"'),array('Member.id'=>$member_id))) {
				//echo $old_data['MemberType']['name'];die;				
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'decline_user')));
				//echo "<pre>";print_r($emailTemp1);die;	
				$common_template= $emailTemp1['EmailTemplate']['description'];
				//echo $common_template;die;
				$common_template= str_replace('{name}',$name,$common_template);
				$common_template= str_replace('{member_type}',$MemberType,$common_template);
				//echo $common_template;die;
				$emailz = new CakeEmail();
				$emailz->template('common_template');
				$emailz->emailFormat('both');
				$emailz->viewVars(array('common_template'=>$common_template));
				//echo 'done';die;
				$emailz->to($email);
				 
				//$emailz->from($emailTemp1['EmailTemplate']['from']);
				$emailz->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Support'));
				$emailz->subject($emailTemp1['EmailTemplate']['subject']);
				//echo '<pre>';print_r($common_template);die;
				$emailz->send();	
				$this->Session->write('success','Member has been declined.');
				//pr($membtype);die;		      	  
				$this->redirect(array('action'=>'members/'.$membtype));
				//$this->redirect(array('action'=>'members',$membtype));
			}
		}
		else {
			$adminId = $this->Session->read('Admin.id');
			$datefiStApp = date('Y-m-d H:i:s');
			if($this->Member->updateAll(array('Member.status'=>"'Active'",'Member.second_step_approval'=>"'Yes'",'Member.member_approve_first_step_approval' =>'"' . $adminId .'"','Member.date_approve_first_step_approval' =>'"' . $datefiStApp .'"'),array('Member.id'=>$member_id))) { 
				//echo $old_data['MemberType']['name'];die;					
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'approve_user')));
				//pr($emailTemp1);die;				
				$common_template= $emailTemp1['EmailTemplate']['description'];
				$common_template= str_replace('{name}',$name,$common_template);
				$common_template= str_replace('{member_type}',$MemberType,$common_template);				
				// echo 'done';die;
				$emailz = new CakeEmail();
				$emailz->template('common_template');
				$emailz->emailFormat('both');
				$emailz->viewVars(array('common_template'=>$common_template));
				$emailz->to($email);
				//$emailz->from($emailTemp1['EmailTemplate']['from']);
				$emailz->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Support'));
				$emailz->subject($emailTemp1['EmailTemplate']['subject']);
				//echo '<pre>';print_r($common_template);die;
				$emailz->send();
				$this->Session->write('success','Member has been activated successfully');
				//pr($membtype);die;		      	  			
				$this->redirect(array('action'=>'members/'.$membtype));
				//$this->redirect(array('action'=>'members',$membtype));
			}
		}
	}
	function admin_send_rejection($id=NULL) 
	{		
		$member_id = convert_uudecode(base64_decode($id));
		$old_data = $this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id),'fields'=>array('email','status','name','surname','member_type','MemberType.name','MemberType.id'),'contain'=>array('MemberType')));	
		$email = $old_data['Member']['email'];
		$memtype = $old_data['Member']['member_type'];
		$MemberType = $old_data['MemberType']['name'];
		$membtype = base64_encode(convert_uuencode($memtype));		
		$name = $old_data['Member']['name']." ".$old_data['Member']['surname'];
		if($old_data['Member']['status']=="Inactive") 
		{
			$adminId = $this->Session->read('Admin.id');
			if($this->Member->updateAll(array('Member.status'=>"'Inactive'"),array('Member.id'=>$member_id))) 
			{
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'send_rejection')));
				$common_template= $emailTemp1['EmailTemplate']['description'];
				$common_template= str_replace('{name}',$name,$common_template);
				$common_template= str_replace('{member_type}',$MemberType,$common_template);
				$emailz = new CakeEmail();
				$emailz->template('common_template');
				$emailz->emailFormat('both');
				$emailz->viewVars(array('common_template'=>$common_template));
				$emailz->to($email);
				$emailz->cc('supplierrejections@cybercouponsa.com');
				$emailz->from($emailTemp1['EmailTemplate']['from']);
				$emailz->subject($emailTemp1['EmailTemplate']['subject']);
				//echo '<pre>';print_r($common_template);die;
				if($emailz->send())
				{
					$this->Member->delete($member_id);
					$this->Session->write('success','Member has been Rejected.');
					$this->redirect(array('action'=>'members/'.$membtype));
				}	
				else
				{
					$this->Session->write('error','An server error have occur.');
					$this->redirect(array('action'=>'members/'.$membtype));
				}
			}
		}
		$this->Session->write('success','Member has been Rejected.');
		$this->redirect(array('action'=>'members/'.$membtype));
		
	}
	function admin_view_member($id=null) {		
		$this->layout='admin';
		$member_id=convert_uudecode(base64_decode($id));
		$member=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));
		$this->set(compact('member'));
		//pr($member);die;
		$memberm=$this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$member_id)));
		$this->set(compact('memberm'));
	}
	function admin_edit_member($id=null) 
	{
		//echo "hello".$id;die;
  		$this->layout = 'admin';
		$member_id = convert_uudecode(base64_decode($id));
  		$this->set('id',$member_id);
		$this->Member->virtualFields = array('amount_received_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE  od.reconcile !="Completed" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_payable_to_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile !="Completed" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_claimed_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile =  "Requested" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',												
												'payment_upto'=>'SELECT payment_date from orders where orders.supplier_id = Member.id group by Member.id',
												'total_supplier_history_amount'=>'SELECT sum(supplier_amount) FROM payment_histories ph  where ph.member_id = Member.id '
											);
		$Categorylist = $this->AdminModule->find('threaded',array('conditions'=>array('AdminModule.active'=>'Yes','AdminModule.parent_id'=>0)));
		$this->set('Categorylist',$Categorylist);
		//pr($Categorylist);die;
		$options = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes'),'fields'=>array('Location.id','Location.name')));
  		//pr($options);die;	  
		$this->set('options',$options);
		$business_cat = $this->BusinessCategory->find('all',array('conditions'=>array('BusinessCategory.active'=>'Yes'),'order'=>array('BusinessCategory.id ASC'))); 
		$this->set(compact('business_cat'));
		$business_type = $this->BusinessType->find('all',array('conditions'=>array('BusinessType.active'=>'Yes'),'order'=>array('BusinessType.id ASC'))); 
		$this->set(compact('business_type'));  
  		$members=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));
		$sales_persons=$this->Member->find('all',array('conditions'=>array('Member.company_user_type'=>'sales_person'),'contain'=>array()));
		$amount_payable_to_supplier = (@$members['Member']['amount_payable_to_supplier']!=0)?($members['Member']['amount_payable_to_supplier']*$members['MemberMeta']['supplier%'])/100:'0'; 
  		$this->set('member',$members);
  		$this->set(compact('amount_payable_to_supplier','sales_persons'));			
			
		//pr($sales_persons);die;
		//echo "hello".$id;die;
		
		$permission_mod=array();
		$selected_module_id=array();
		$permissions=$members['ModulePermission'];
		foreach($permissions as $permisn) 
		{
			$permission_mod[$permisn['module_id']]=$permisn;
			$selected_module_id[]=$permisn['module_id'];
  		}
		//pr($permission_mod);die;
		//pr($selected_module_id);die;
		$this->set('permission_mod',$permission_mod);	
		$this->set('selected_module_id',$selected_module_id);	
			
			
			
		if(!empty($this->data)) 
		{
			$data1 = $this->data;
			//pr($data1);die;
			$data1['Member']=$this->data['Member'];
			$data1['Member']['dob'] = date('Y-m-d',strtotime(@$this->data['Member']['dob']));
			if(empty($data1['Member']['company_user_type']) && ($data1['Member']['company_user_type_checked'] == 0)):
				$data1['Member']['company_user_type'] = 'company_user';
			endif;	
			//pr($data1);die;
			if($data1['Member']['member_type']=='4') 
			{
			
				$infomem=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));	
				$memLoc = $infomem['Member']['location'];
				$arr = explode(',',$infomem['Member']['news_location']);
				array_push($arr,$this->request->data['Member']['location']);
				$arr = array_unique($arr);
				$str1 =implode(',',$arr);
				$str = trim($str1,',');
				$data1['Member']['news_location'] = $str;
			}
			if($data1['Member']['member_type']=='2') 
			{	
				$data1['Member']['password_copy'] = $data1['Member']['password_copy'];
				$data1['Member']['password'] = md5($data1['Member']['password_copy']);
			}
			if($data1['Member']['member_type']=='4') 
			{	
				$data1['Member']['password_copy'] = $data1['Member']['password_copy'];
				$data1['Member']['password'] = md5($data1['Member']['password_copy']);
			}
			if($data1['Member']['member_type']=='3') 
			{	
				$data1['Member']['password_copy'] = $data1['Member']['password_copy'];
				$data1['Member']['password'] = md5($data1['Member']['password_copy']);
			}
			$this->Member->id=$member_id;
			if($this->Member->save($data1)) 
			{
				if($data1['Member']['member_type']=='3') 
				{
					$data1['MemberMeta']['start_date'] = @date('Y-m-d',strtotime($data1['MemberMeta']['start_date']));
					$this->MemberMeta->save($data1);
				}
				
				//...........for sub-admin permission......
					$module_permission=@$_POST['ModulePermission'];
					 //pr($module_permission);
				    $this->loadModel('ModulePermission');
				    if (!empty($module_permission)) 
				    {
						foreach($module_permission as $permission_key=>$permission_value) 
						{
							$final_permission=array();
							$final_permission['ModulePermission']['module_id']=$permission_key;
							$final_permission['ModulePermission']['member_id']=$member_id;
							$final_permission['ModulePermission']['view_permission']=@$permission_value['view'];
							$final_permission['ModulePermission']['edit_permission']=@$permission_value['edit'];
							
							if ($permission_value['id']!=0) 
							{
								$final_permission['ModulePermission']['id']=$permission_value['id'];
								$this->ModulePermission->updateAll(array('ModulePermission.view_permission'=>$permission_value['view'],'ModulePermission.edit_permission'=>$permission_value['edit']),array('ModulePermission.id'=>$final_permission['ModulePermission']['id']));
							}
							else 
							{
								if(empty($final_permission['ModulePermission']['view_permission']) && empty($final_permission['ModulePermission']['edit_permission'])) :
									$final_permission['ModulePermission']['view_permission'] = 0;
									$final_permission['ModulePermission']['edit_permission'] = 0;
								endif;
								$this->ModulePermission->create();
								$this->ModulePermission->save($final_permission); 
							}
						}
						
				    }
		       //...........end of sub-admin permission......
		       
				$this->Session->write('success','This record has been updated successfully');
				$this->redirect(array('action'=>'admin_members',base64_encode(convert_uuencode($members['Member']['member_type']))));
			}
  		}
	}
	function admin_checkEditMemberEmail($id=NULL) {
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
	function send_otp() {
		$adminId = $this->Session->read('Admin.id');
		$datefiStApp = date('Y-m-d H:i:s');		
		$email = trim($_REQUEST['email']);
      $id = trim($_REQUEST['id']);
		$members = $this->Member->find('first',array('conditions'=>array('Member.id'=>$id,'Member.OTPSent'=>'No')));      
		if (!empty($members)) { 
			$names=$members['Member']['name']." ".$members['Member']['surname'];
			$original_string = array_merge(range(0,9), range('a','z'), range('A', 'Z'));
			$original_string = implode("", $original_string);
			$ra = substr(str_shuffle($original_string), 0, 6);
			$data1['Member']['password_copy']= $ra;
			$data1['Member']['password']= md5($ra);
			$data1['Member']['status']='Active';
			$data1['Member']['OTPSent']='Yes';
			$data1['Member']['second_step_approval']='Yes';
			$data1['Member']['date_approve_second_step_approval']= $datefiStApp;
			$data1['Member']['member_approve_second_step_approval'] = $adminId;
			$this->Member->id=$id;
			if ($this->Member->save($data1)) {
			$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'supplier_otp')));
			$mem_id = $id;
			//echo $mem_id;die;
			$common_template= $emailTemp1['EmailTemplate']['description'];
			$link = HTTP_ROOT.'Suppliers/login';							
			$link = "<a href='".$link."' style='text-decoration:none;color:#00aeef' target='_blank'>".__('Click here to update your profile.')."</a>";						
			$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
			$common_template= str_replace('{name}',$names,$common_template);
			$common_template = str_replace('{email}',$email,$common_template);
			$common_template = str_replace('{password}',$ra,$common_template);
			$common_template = str_replace('{link}',$link,$common_template);
			// echo 'done';die;
        	$emailz = new CakeEmail();
			$emailz->template('common_template');
			$emailz->emailFormat('both');
			$emailz->viewVars(array('common_template'=>$common_template));
			$emailz->to($email);
			$emailz->from($emailTemp1['EmailTemplate']['from']);
			$emailz->subject($emailTemp1['EmailTemplate']['subject']);
			//echo '<pre>';print_r($common_template);die;
			if($emailz->send())
			{
				
				$this->Session->write('success','Otp has been sent successfully.');		  
				echo 'done';die;
			}													
        }
		  }
        else {
				echo 'error';die;
        }  
	}
	function admin_checkCompanyRegistrationEdit($id=null) {
		$val = trim($_REQUEST['data']['MemberMeta']['registration_no']);
		$check = $this->MemberMeta->find('count',array('conditions'=>array('registration_no'=>$val,'member_id not'=>$id)));
		if ($check) { 
			echo 'false';die;
		}
		else {
			echo 'true';die;
		}
	}
  
	function admin_checkCompanyRegistrationValEdit($id=null) {
		$val = trim($_REQUEST['data']['MemberMeta']['vat_registration_no']);
		$check = $this->MemberMeta->find('count',array('conditions'=>array('vat_registration_no'=>$val,'member_id not'=>$id)));
		if($check) { 
			echo 'false';die;
		}
		else  {
			echo 'true';die;
		}
	}
	function admin_email_member($id=null) {
		$this->layout = 'admin';
		$member_id = convert_uudecode(base64_decode($id));
		//echo $member_id;die;
		$this->set('id',$member_id); 
		$members = $this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));
		$this->set('member',$members);
		//pr($members);die;
		if(!empty($this->request->data)) {
      		$data1 = $this->request->data;
			$member_id = $data1['Member']['id'];
			$mem_detail = $this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id),'fields'=>array('id','member_type','name','surname')));
			
			if($mem_detail['Member']['member_type']==3)
			    $emailTemp1 = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'member_email')));
			else 
			    $emailTemp1 = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'cybercoupon_customer_email')));
			
			//echo "<pre>";print_r($emailTemp1);die;	
			//pr($data1);
			$name = $mem_detail['Member']['name']." ".$mem_detail['Member']['surname'];
			$message = $data1['Member']['message'];
			//pr($message);
			//pr($name);         
			$common_template = $emailTemp1['EmailTemplate']['description'];
			//echo "<pre>";print_r($common_template);
			$common_template = str_replace('{name}',$name,$common_template);
			$common_template = str_replace('{message}',$message,$common_template);
			$email1 = $data1['Member']['email'];		
			//pr($email1);
			$common_template = $data1['Member']['message'];
			$email = new CakeEmail();
			$email->template('common_template');
			$email->emailFormat('both');
			$email->viewVars(array('common_template'=>$common_template));
			$email->to($email1);
			$email->from($emailTemp1['EmailTemplate']['from']);
			$email->subject($emailTemp1['EmailTemplate']['subject']);  
            //$email->send();
      		if ($email->send()) {
				//echo '<pre>';print_r($email);die;
				$this->Session->write('success','Email has been sent successfully.');
				$this->redirect(array('action'=>'admin_members',base64_encode(convert_uuencode($mem_detail['Member']['member_type']))));
      		}
      		else {
        		echo "<h1>Message Does not send ! Some error occur.";
      		}		
    	}			
	}
	
	function admin_reconcile($id=null) {
  		$this->layout='admin';
  		$this->loadModel('OrderDealRelation');
  		$memberId=convert_uudecode(base64_decode($id));
  		//echo $memberId;die;
  		$count=$this->OrderDealRelation->query('SELECT COUNT(*)  FROM order_deal_relations INNER JOIN deals on order_deal_relations.deal_id=deals.id where deals.member_id=64');
  		$redeem =$this->OrderDealRelation->find('all',array('conditions'=>array('Deal.member_id'=>$memberId),'group'=>array('OrderDealRelation.deal_id','OrderDealRelation.deal_option_id')));
  		//$redeem = $this->OrderDealRelation->find('all');	
  		//echo $memberId;		
  		//pr($count);
  		//pr($redeem);die;
    }
    function admin_sendpdf($id=null) {
		$this->layout='admin';
		//$email = trim($_REQUEST['email']);
		//$id = trim($_REQUEST['id']);
		$adminId= $this->Session->read('Admin.id');
		$datefiStApp = date('Y-m-d H:i:s');
		$member_id = convert_uudecode(base64_decode($id));
		$this->set('id',$member_id); 
		$members = $this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));
		$this->set('member',$members);
		//pr($_FILES);die;
		//pr($members);die;
		//pr($this->request->data);
			$data=$this->request->data;	
			$names=$members['Member']['name']." ".$members['Member']['surname'];
			$memberEmail=$members['Member']['email'];

			/*--------------------------Email start----------------------------------*/
			
			$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'1st_step_approval')));
			//pr($emailTemp1);	die;	
			$destLarge = realpath('../../app/webroot/img/data/first_step_approval').'/' ;	
			//pr($destLarge);die;			
			$common_template= $emailTemp1['EmailTemplate']['description'];
			$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
			$common_template = str_replace('{name}',$names,$common_template);
			$pdfTitle[] = $destLarge.$emailTemp1['EmailTemplate']['first_step_approval'];		
			$email = new CakeEmail();
			$email->template('common_template');
			$email->emailFormat('both');
			$email->viewVars(array('common_template'=>$common_template));       
			$email->to($memberEmail);
			//$email->cc('promatics.gautam@gmail.com');
			$email->from($emailTemp1['EmailTemplate']['from']);
			$email->subject($emailTemp1['EmailTemplate']['subject']);  
			//$pdfTitle; die;
			//pr($email);                        
			//echo '<pre>';print_r($common_template);die;
			
			if(@$pdfTitle!='' and @$emailTemp1['EmailTemplate']['pdf_send']=='Yes')
			{
			   $email->attachments($pdfTitle);
			}
			//$email->send();	
			if($email->send())
			{
				$this->Member->updateAll(array('Member.first_step_approval'=>"'Yes'",'Member.date_approve_first_step_approval'=>'"'.$datefiStApp.'"','Member.member_approve_first_step_approval'=>'"'.$adminId.'"'),array('Member.id'=>$member_id));
				$this->Session->write('success','1st step approval is successfull');
				$this->redirect(array('action'=>'admin_members',base64_encode(convert_uuencode($members['Member']['member_type']))));					
			}   	
    		
    }
    function admin_resend_customer_activation($customer_id=NULL)
    {
         $this->autoRender=false;			
			$data1=$this->request->data;
		   $customer_decodeid = convert_uudecode(base64_decode($customer_id));
			
			$resend_customer=$this->Member->find('first',array('conditions'=>array('Member.id'=>$customer_decodeid,'Member.member_type'=>4),'fields'=>array('id','member_type','name','email')));              
			$member_type=$resend_customer['Member']['member_type'];
			$member_type_encode=base64_encode(convert_uuencode($resend_customer['Member']['member_type']));			
			if(!empty($resend_customer))
			{
				$activation_code = sha1(microtime());
				if($this->Member->updateAll(array('Member.activation'=>'"' .$activation_code.'"','Member.status'=>'"Inactive"'),array('Member.id'=>$customer_decodeid)))
				{
				   $emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'user_registration')));
					
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$link = HTTP_ROOT.'Customers/activate_account/'.$customer_id."/".$activation_code;							
					$link = "<a href='".$link."' style='text-decoration:none;color:#00aeef' target='_blank'>".__('Click here to activate your account')."</a>";						
					$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
					$common_template = str_replace('{contact_person}',$resend_customer['Member']['name'],$common_template);
					$common_template = str_replace('{link}',$link,$common_template);
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));       
					$email->to($resend_customer['Member']['email']);
					$email->from($emailTemp1['EmailTemplate']['from']);
					$email->subject($emailTemp1['EmailTemplate']['subject']);                             
					//echo '<pre>';print_r($common_template);die;
					if($email->send())
					{
						$this->Session->write('success','Verification email for the customer has been sent successfully.');
						$this->redirect(array('controller'=>'Members','action'=>'members/'.$member_type_encode));
					}
				}
				else 
				{
					$this->Session->write('error','Something is going wrong. Please try again.');
					$this->redirect(array('controller'=>'Members','action'=>'members/'.$member_type_encode));
				}				
				
			}
			else 
			{
				$this->Session->write('error','Something is going wrong. Please try again.');
				$this->redirect(array('controller'=>'Members','action'=>'members/'.$member_type_encode));
			}
			
	}
	function admin_bulk_usermail()
	{
		$member_type=$this->data['User']['member_type'];
      $member_typeid = convert_uudecode(base64_decode($member_type));		
		$user_id=$this->data['User']['user_id'];
		$users=$this->Member->find('all',array('conditions'=>array('Member.id'=>$user_id,'Member.member_type'=>$member_typeid),'fields'=>array('Member.id','Member.name','Member.surname','Member.email'),'recursive'=>-1));
		$email_template=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'email_to_user_in_groups')));
		//pr($users);die;	
		$addition_email['Member']=array('name'=>'Archive User','surname'=>'Cybercoupon','email'=>'richardarchives@gmail.com');
		array_push($users,$addition_email);
		foreach($users as $each_user)
		{
		   $email_description=$email_template['EmailTemplate']['description'];
			$email_description=str_replace('{name}',$each_user['Member']['name'],$email_description);
			$email=new CakeEmail();
			$email->template('common_template');
			$email->viewVars(array('common_template'=>$email_description));
			$email->emailFormat('both');
			$email->to($each_user['Member']['email']);
			$email->subject($email_template['EmailTemplate']['subject']);
			$email->from($email_template['EmailTemplate']['from']);
			$email->send();
		}
		$this->Session->write('success','Email has been sent successfully.');
		die;
	}	
	function admin_send_password($id=null) {
		$this->layout = 'admin';
		$member_id = convert_uudecode(base64_decode($id));
		$this->set('id',$member_id); 
		$mem_detail = $this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id),'fields'=>array('id','email','member_type','name','surname')));	
		
		$new_password=$this->RandomStringGenerator(6);
	   $pwd=md5($new_password);	    
		$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'send_password')));
		
		$name=$mem_detail['Member']['name']." ".$mem_detail['Member']['surname'];
		$emailid=$mem_detail['Member']['email'];
		$password=$new_password;
		
		$common_template= $emailTemp1['EmailTemplate']['description'];
		$common_template= str_replace('{name}',$name,$common_template);
		$common_template= str_replace('{email}',$emailid,$common_template);
		$common_template= str_replace('{password}',$password,$common_template);
		$emailto=$mem_detail['Member']['email'];	
		$email = new CakeEmail();
		$email->template('common_template');
		$email->emailFormat('both');
		$email->viewVars(array('common_template'=>$common_template));
		$email->to($emailto);
		//$email->from($emailTemp1['EmailTemplate']['from']);
		$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Support'));
		$email->subject($emailTemp1['EmailTemplate']['subject']);  
		if($email->send()) {
			$this->Member->updateAll(array('Member.password'=>"'".$pwd."'",'Member.password_copy'=>"'".$new_password."'"),array('Member.id'=>$mem_detail['Member']['id'],'Member.member_type'=>'3'));
			$this->Session->write('success','New Password send to your email account successfully !');
			$this->redirect(array('action'=>'admin_members',base64_encode(convert_uuencode($mem_detail['Member']['member_type']))));
		}
		else {
			echo "<h1>Password Does not send ! Some error occur.</h1>";
		}		
	}	
	function admin_bulk_useractive()
	{
		$member_type=$this->data['User']['member_type'];
		$user_id=$this->data['User']['user_id'];	
		
		$old_data = $this->Member->find('all',array('conditions'=>array('Member.id'=>$user_id),'fields'=>array('email','status','name','surname','member_type','MemberType.name','MemberType.id'),'contain'=>array('MemberType','Deal','ModulePermission')));		
		//pr($member_type);die;
		
		$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'approve_user')));
		
		if($this->Member->updateAll(array('Member.status'=>"'Active'"),array('Member.id'=>$user_id))) 
		{ 
			foreach($old_data as $each_user)
			{
				if($each_user['Member']['status'] == 'Inactive')
				{
					//pr($each_user);die;
					$email = $each_user['Member']['email'];
					$MemberType = $each_user['MemberType']['name'];
					$name = $each_user['Member']['name']." ".$each_user['Member']['surname'];
					
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$common_template= str_replace('{name}',$name,$common_template);
					$common_template= str_replace('{member_type}',$MemberType,$common_template);				
					//echo 'done';die;
				
					$emailz = new CakeEmail();
					$emailz->template('common_template');
					$emailz->emailFormat('both');
					$emailz->viewVars(array('common_template'=>$common_template));
					$emailz->to($email);
					$emailz->from($emailTemp1['EmailTemplate']['from']);
					$emailz->subject($emailTemp1['EmailTemplate']['subject']);
					//echo '<pre>';print_r($common_template);die;
					$emailz->send();
				}
			}
			$this->Session->write('success','Member has been activated successfully');
			$this->redirect(array('action'=>'members/'.$member_type));
		}
	}
	function admin_sales_members($ids = NULL) 
	{	
		$this->layout = 'admin';
		$id = convert_uudecode(base64_decode($ids));
		$this->set('ids',$ids);
		$conditions = array('Member.sales_parent'=>$id);
		if (!empty($this->request->data)) 
		{
			
			$business_name = trim(@$_POST['data']['MemberMeta']['business_name']);
			$emails = trim(@$_POST['data']['Member']['email']);
			$city = trim(@$_POST['data']['Member']['city']);
			$status = trim(@$_POST['data']['Member']['status']);
			$reg_from = trim(@$_POST['data']['Member']['registered']);
			$reg_to = trim(@$_POST['data']['Member']['register_to']);
			//echo $city;die;
			if ($business_name!= "") {
				$conditions = array_merge($conditions,array('MemberMeta.company_name LIKE'=>'%'.$business_name.'%'));
			}
			if ($emails!= "") {
				$conditions = array_merge($conditions,array('Member.email LIKE'=>'%'.$emails.'%'));
			}
			if ($city!= "") {
				$conditions = array_merge($conditions,array('Member.city LIKE'=>$city));
			}			
			if ($status!= "" && $member_type == '3') 
			{
				$conditions = array_merge($conditions,array('Member.status'=>$status));
			}
			if($reg_from!="") {
			     $reg_from=date('Y-m-d',strtotime($reg_from));
				  $conditions=array_merge($conditions,array('Member.registered >= ' =>$reg_from));
				//pr($conditions);die;									
			}
			if($reg_to!="") {
				$reg_to=date('Y-m-d',strtotime($reg_to));
				$conditions=array_merge($conditions,array('Member.registered <= ' =>$reg_to));
				//pr($conditions);die;									
			}
		}
		$this->Member->virtualFields = array('amount_received_from_supplier'=>'SELECT COALESCE(SUM( od.sub_total ),0.00) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE  od.reconcile !="Completed" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_payable_to_supplier'=>'SELECT COALESCE(SUM( od.sub_total ),0.00) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile !="Completed" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_claimed_from_supplier'=>'SELECT COALESCE(SUM( od.sub_total ),0.00) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile =  "Requested" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',												
												);
		$sales_person = $this->Member->find('all',array('conditions'=>$conditions,'order'=>array('Member.id asc')));
		//pr($sales_person );die;
		$this->Session->write('sales_export',$conditions);
		$this->set('data',$sales_person);
		if ($this->RequestHandler->isAjax()) 
		{
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Members';
			$this->render('sales_members_list');
		}
		
	}
	function admin_view_sales_member($id=null) {		
		$this->layout='admin';
		$member_id=convert_uudecode(base64_decode($id));
		$this->set('ids',$member_id);
		//pr($member_id);die;
		$conditions = array();
		if (!empty($this->request->data)) 
		{			
			$deal_name = trim($_POST['data']['Deal']['name']);
			$from = trim($_POST['data']['Deal']['from']);
			$to = trim($_POST['data']['Deal']['to']);
			//echo $deal_name;die;
			if ($deal_name!= "") {
				$conditions = array_merge($conditions,array('Deal.name LIKE'=>'%'.$deal_name.'%'));
				//pr($conditions);die;
			}
			if($from!="") {
			     $from = date('Y-m-d',strtotime($from));
				  $conditions=array_merge($conditions,array('Deal.buy_from >= ' =>$from));
				//pr($conditions);die;									
			}
			if($to!="") {
				$to = date('Y-m-d',strtotime($to));
				$conditions=array_merge($conditions,array('Deal.buy_to <= ' =>$to));
				//pr($conditions);die;									
			}
		}
		$conditions = array_merge($conditions,array('Deal.member_id'=>$member_id,'Deal.delete_status'=>'No','Deal.sales_deal >'=>0));
		//pr($conditions);die;
		$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on orders.id=order_deal_relations.order_id where `order_deal_relations.deal_id`= Deal.id and orders.order_status!="failed" and order_deal_relations.claim_status!="NoClaim" and order_deal_relations.claim_status!="ClaimCancelled" ');	
		$deal=$this->Deal->find('all',array('conditions'=>$conditions));
		$this->set(compact('deal'));
		//pr($deal);die;
		$memberm=$this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$member_id)));
		$this->set(compact('memberm'));
		if ($this->RequestHandler->isAjax()) 
		{
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Members';
			$this->render('view_sales_members_list');
		}
	}
	function admin_sales_generate_csv()
	{
		$this->layout = "admin";
		$this->autoRender = false;
		$this->loadModel('Member');
		Configure::write('debug', 2);
		$data = "Business Name,Email,Amount Received From Supplier,Amount Payable To Supplier,Amount Claimed From Supplier,City,Register Date,Status \n";
		$conditions = $this->Session->read('sales_export');
		$this->Member->virtualFields = array('amount_received_from_supplier'=>'SELECT COALESCE(SUM( od.sub_total ),0.00) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE  od.reconcile !="Completed" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_payable_to_supplier'=>'SELECT COALESCE(SUM( od.sub_total ),0.00) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile !="Completed" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_claimed_from_supplier'=>'SELECT COALESCE(SUM( od.sub_total ),0.00) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile =  "Requested" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',												
												);
		$allPayments = $this->Member->find('all', array('conditions'=>$conditions,'order'=>'Member.id asc','recursive'=>0));	
		//pr($allPayments);die;
		foreach ($allPayments as $payment) {	
			$amount_received_from_supplier= (@$payment['Member']['amount_received_from_supplier']!=0)?$payment['Member']['amount_received_from_supplier']:'0'; 
			$amount_payable_to_supplier= (@$payment['Member']['amount_payable_to_supplier']!=0)?($payment['Member']['amount_payable_to_supplier']*$payment['MemberMeta']['supplier%'])/100:'0'; 
			$amount_claimed_from_supplier=(@$payment['Member']['amount_claimed_from_supplier']!=0)?($payment['Member']['amount_claimed_from_supplier']*$payment['MemberMeta']['supplier%'])/100:'0';
			$data .= $payment['MemberMeta']['company_name'].",";
			$data .= $payment['Member']['email'].",";
			$data .= round(($amount_received_from_supplier>0)?$amount_received_from_supplier:'0',2).",";
			$data .= round(($amount_payable_to_supplier>0)?$amount_payable_to_supplier:'0',2).",";
			$data .= round(($amount_claimed_from_supplier>0)?$amount_claimed_from_supplier:'0',2).",";
			$data .= $payment['Member']['city'].",";			
			$data .= date('d F Y',strtotime($payment['Member']['registered'])).",";
			$data .= $payment['Member']['status'].",";		
			//$totalDeal = $this->Member->find('count', array('conditions' => array('Member.id' => '<> NULL ')));	
			//pr($totalDeal);											
			$data .="\n";	
		}
		//pr($data);die;
		$this->Session->delete('Member_sess');
		header("Content-Type: application/csv");			
		$csv_filename = 'Payment_list_'.date("Y-m-d_H-i",time()).'.csv';
		header("Content-Disposition:attachment;filename=".$csv_filename);
		$fd = fopen ($csv_filename, "w");
		fputs($fd,$data);
		fclose($fd);
		echo $data;
		die();		
	}
	function admin_upload_customers()
	{
		$this->layout ='admin';
		ini_set('memory_limit', '256M');
		$this->loadModel('UploadedUser');
		if(!empty($this->data))
		{	
			$data = $this->data;
			//pr($data);die;
			if(!empty($data['Member']['file']['name']))
			{
				$member_img = $data['Member']['file'];
				
				$medium = 'files/Users Csv/';
				$imgName = pathinfo($member_img['name']);
				$ext = strtolower($imgName['extension']);
				//pr($imgName);die;
				if( $ext == 'csv' )
				{
					$newImgName = sha1($data['Member']['file']['name']).'-'.time().".".$ext;
					if(move_uploaded_file($data['Member']['file']['tmp_name'],$medium = 'files/Users Csv/'.$newImgName))
					{   
						$file = fopen('files/Users Csv/'.$newImgName,"r");
                        $i = 1;
						$error = array();
						while(!feof($file))
						{  
						    $temp = array();
							$temp['UploadedUser'] = array();
							$user_details = array();
							//pr(fgetcsv($file));die;
							$info =	fgetcsv($file);
							//pr($info);die;
							if(!empty($info) ){
								foreach( $info as $key => $val ) {
									
									switch( $key ) {
										case 0:
											$user_details['name'] = $val;
											break;
										case 1:
											$user_details['surname'] = $val;
											break;
										case 2:
											$user_details['email'] = $val;
											break;
										case 3:
											$user_details['password'] = $val;
											break;
										case 4:
											$user_details['location'] = $val;
											break;
										case 5:
											$user_details['Referrer'] = $val;
											break;
										default : break;
									}
								}
							}	
                            $temp['UploadedUser'] =  $user_details ;
							$continue = 0;
							$error[$i] = array();
                                                        
                            $date = date('Y-m-d:h:i:s');
							$temp['UploadedUser']['created'] = $date;
							$temp['UploadedUser']['status'] = 'Pending';
							if( isset( $temp['UploadedUser']['name'] ) && !empty( $temp['UploadedUser']['name'] ) ) {
							   
							} else {
								$error[$i] = array_merge($error[$i],array('name'));
								$continue = true;
                            }

							if( isset( $temp['UploadedUser']['surname'] ) && !empty( $temp['UploadedUser']['surname'] ) ) {
							   
							} else {
								 
								$error[$i] = array_merge($error[$i],array('surname'));
								$continue = true;
                            }
                            
							if(  isset( $temp['UploadedUser']['email'] ) && !empty( $temp['UploadedUser']['email'] )){
							   
							} else {
								 
								$error[$i] = array_merge($error[$i],array('email'));
								$continue = true;
                            }

							if(  isset( $temp['UploadedUser']['password'] ) && !empty( $temp['UploadedUser']['password'] ) ){
							   
							} else {
								 
								$error[$i] = array_merge($error[$i],array('password'));
								$continue = true;
                            }

							if(  isset( $temp['UploadedUser']['location'] ) && !empty( $temp['UploadedUser']['location'] ) ){
							   
							} else {
								 
								$error[$i] = array_merge($error[$i],array('location'));
								$continue = true;
                            }

							if(  isset( $temp['UploadedUser']['Referrer'] ) && !empty( $temp['UploadedUser']['Referrer'] ) ){
							   
							} else {
								 
								$error[$i] = array_merge($error[$i],array('Referrer'));
								$continue = true;
                            }
							$i++; 
							if( $continue ) {		
								continue;
							} 
							if( $i > 1 ) {
								$this->UploadedUser->save($temp);
								$this->UploadedUser->create();
							}                            							
						}
						$last_index =  count($error);
						unset($error[$last_index]);
						array_shift($error);
						$check = false;
						foreach($error as $err){
						    if( !empty( $err ) ) {
								//echo "Some Errors in the File CSV file following is the serial number of users having problem ";
								$check = true;
								break;
							}
							
						}
						fclose($file);
						
						if($check){
							//prx($error);
						}
						$this->Session->write('success','File Upload Successfully');
						$this->redirect(array('controller'=>'Members','action'=>'admin_members/'.base64_encode(convert_uuencode(4)),'admin'=>true));
					}
				} else { 
					$this->Session->write('success','File Upload Error');
					$this->redirect(array('controller'=>'Members','action'=>'admin_members/'.base64_encode(convert_uuencode(4)),'admin'=>true));
				}
			} else {
				$this->Session->write('success','File Upload Error');
				$this->redirect(array('controller'=>'Members','action'=>'admin_members/'.base64_encode(convert_uuencode(4)),'admin'=>true));
			}
		}
		
	}
	function admin_add_customers($id=Null)
	{
		$this->layout = 'admin';
		ini_set('memory_limit', '256M');
		$this->loadModel('UploadedUser');
		$this->loadModel('Referral');
		$this->loadModel('ReferralCount');
		//$data = $this->UploadedUser->find('all',array('conditions'=>array('UploadedUser.id <='=>'16000','UploadedUser.status'=>'Pending','UploadedUser.deleteStatus'=>'No')));
		$data = $this->UploadedUser->find('all',array('conditions'=>array('UploadedUser.status'=>'Pending','UploadedUser.deleteStatus'=>'No')));
		//prx( $data );
		$cities = $this->Location->find('all');
		$i = 0;
		$j = 0;
		foreach($data as $data1)
		{	
			$count = $this->Member->find('count',array('conditions'=>array('Member.email'=>$data1['UploadedUser']['email'])));
			if (!empty($data1)) 
			{
				if($count == 0)
				{
					$data2['Member']['name'] = $data1['UploadedUser']['name'];
					$data2['Member']['surname'] = $data1['UploadedUser']['surname'];
					$data2['Member']['member_type'] = 4;
					$data2['Member']['email'] = $data1['UploadedUser']['email'];
					$data2['Member']['password_copy'] = $data1['UploadedUser']['password'];
					$data2['Member']['password'] = md5($data1['UploadedUser']['password']);
					$data2['Member']['status'] = 'Active';
					$data1['Member']['newsletters'] = 'Yes';
					$data2['Member']['first_step_approval'] = 'Yes';
					$data2['Member']['registered'] = date('Y-m-d H:i:s');
					$data2['Member']['uploadedBy'] = 'CSV';
					foreach($cities as $city)
					{
						if($city['Location']['name'] == $data1['UploadedUser']['location'])
						{
							$data2['Member']['location'] = $city['Location']['id'];
							$data2['Member']['news_location'] = $city['Location']['id'];
						}		
					}
					if(empty($data2['Member']['location']) || $data2['Member']['location'] == '')
					{					
						$data2['Member']['location'] ==	1;
						$data2['Member']['news_location'] ==	1;
					}
					$this->UploadedUser->updateAll(array('UploadedUser.status'=>"'Uploaded'"),array('UploadedUser.id'=>$data1['UploadedUser']['id']));
					$this->Member->create();
					if($this->Member->save($data2)) 
					{
						$recentadded_memberid=$this->Member->getLastInsertId();
						$data3['MemberMeta']['member_id'] = $recentadded_memberid;
						$data3['MemberMeta']['start_date'] = date('Y-m-d H:i:s');
						$this->MemberMeta->create();
						$this->MemberMeta->save($data3);
						
						$referral_email = $data1['UploadedUser']['Referrer'];
						//echo $referral_email;die;
						if($referral_email != '')
						{
							$referral_conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Member.email'=>$referral_email);
							$existance=$this->Member->find('first',array('conditions'=>$referral_conditions,'fields'=>array('id','name','surname','email'),'recursive'=>0));
							//pr($existance);
							if(!empty($existance))
							{
								$new_refree['Referral'] = array(
															'member_id'=>$existance['Member']['id'],
															'refer_id'=>$recentadded_memberid
															);
								$this->Referral->create();							
								$this->Referral->save($new_refree);
								$referrCounts = $this->ReferralCount->find('first',array('conditions'=>array('ReferralCount.member_id'=>$existance['Member']['id']),'contain'=>array()));
								//pr($referrCounts);die;
								if(!empty($referrCounts))
								{
									$refInc = $referrCounts['ReferralCount']['referrer_count'] + 1;
									$this->ReferralCount->updateAll(array('ReferralCount.referrer_count'=>$refInc),array('ReferralCount.member_id'=>$existance['Member']['id']));
								}
								else
								{
									$refer_id =1;
									$referrer_count =1;
									$new_refrees['ReferralCount']=array(
										'member_id'=>$existance['Member']['id'],
										'refer_id'=>1,
										'referrer_count'=>1  
									);
									$this->ReferralCount->create();
									$this->ReferralCount->save($new_refrees);	
									
								}
							}					    	
						}	
					}
					$i++;
				}
				else
				{
					$this->UploadedUser->updateAll(array('UploadedUser.deleteStatus'=>"'Yes'"),array('UploadedUser.id'=>$data1['UploadedUser']['id']));
					$j ++;
				}
			}
		}
		$msg = $i.' Users added Successfully. ';
		$this->Session->write('success',$msg);
		$this->redirect(array('controller'=>'Members','action'=>'admin_members/'.base64_encode(convert_uuencode(4)),'admin'=>true));
		
	}
	function admin_uploaded_users() 
	{
		$this->layout = 'admin';
		$this->loadModel('UploadedUser');
		$total = $this->UploadedUser->find('count');
		$this->set('total',$total);
		$conditions = array();
		$email = trim(@$_POST['data']['UploadedUser']['email']);
		if(!empty($email) && $email != '')
		{
			$conditions = array_merge($conditions,array('UploadedUser.email'=>$email));
			$data = $this->UploadedUser->find('all',array('conditions'=>$conditions));
			$count = $this->UploadedUser->find('count',array('conditions'=>$conditions));
			$this->set('info',$data);
			$this->set('count',$count);
		}
		else
		{
		$this->paginate=array('limit'=>10,'conditions'=>$conditions);
		//$data = $this->UploadedUser->find('all',array('conditions'=>$conditions));
		$data = $this->paginate('UploadedUser',$conditions);
		$count = $this->UploadedUser->find('count',array('conditions'=>$conditions));
		$this->set('info',$data);
		$this->set('count',$count);		
		}
		if ($this->RequestHandler->isAjax()) {
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Members';
			$this->render('uploaded_members_list');
		}
	}
	function admin_delete_uploaded_member($id=null) 
	{
		$this->autoRender = false;
		$this->loadModel('UploadedUser');
		$member_id = convert_uudecode(base64_decode($id));
		if($this->UploadedUser->delete($member_id)) 
		{
			$this->Session->write('success','User has been deleted successfully');
			$this->redirect(array('action'=>'admin_uploaded_users'));
		}		
	}
	function admin_customers() {
		$this->layout = 'admin';
		$member_type = 4;
		ini_set('memory_limit', '256M');
		$this->set(compact('member_type'));
		$conditions = array();
		if (!empty($this->request->data)) {
			
			$names = trim(@$_POST['data']['Member']['name']);
			$surnames = trim(@$_POST['data']['Member']['surname']);
			$emails = trim(@$_POST['data']['Member']['email']);
			$city = trim(@$_POST['data']['Member']['city']);
			$location = trim(@$_POST['data']['Member']['location']);
			$news_location = trim(@$_POST['data']['Member']['news_location']);
			$status = trim(@$_POST['data']['Member']['status']);
			//echo $status;die;
			$reg_from = trim(@$_POST['data']['Member']['registered']);
			$reg_to = trim(@$_POST['data']['Member']['register_to']);
			if ($names!= "") {
				$conditions = array_merge($conditions,array('Member.name LIKE'=>'%'.$names.'%'));
			}
			if ($surnames!= "") {
				$conditions = array_merge($conditions,array('Member.surname LIKE'=>'%'.$surnames.'%'));
			}
			if ($emails!= "") {
				$conditions = array_merge($conditions,array('Member.email LIKE'=>'%'.$emails.'%'));
			}
			if ($city!= "") {
				$conditions = array_merge($conditions,array('Member.city LIKE'=>$city));
			}			
			if ($status!= "") 
			{
				if($member_type == '4')
				{
					if($status == 'unsuspended')
					{
						$conditions = array_merge($conditions,array("AND" => array (
																		"Member.status " => 'Active',
																		"Member.first_step_approval " => 'Yes',
																		"Member.second_step_approval " => 'Yes'
																	)
																)
															);
					}
					elseif($status == 'suspended')
					{
						$conditions = array_merge($conditions,array("AND" => array (
																		"Member.status " => 'Inactive',
																		"Member.first_step_approval " => 'Yes',
																		"Member.second_step_approval " => 'Yes'
																	)
																)
															);					
					}
					else
					{
						$conditions = array_merge($conditions,array('Member.status'=>$status));
					}
				}				
			}
			if($reg_from!="") {
			      $reg_from=date('Y-m-d',strtotime($reg_from));
				  $conditions=array_merge($conditions,array('Member.registered >= ' =>$reg_from));
				//pr($conditions);die;									
			}
			if($reg_to!="") {
			    $reg_to=date('Y-m-d',strtotime($reg_to));
				$conditions=array_merge($conditions,array('Member.registered <= ' =>$reg_to));
				//pr($conditions);die;									
			}
			if ($location!= "")
			{
				$conditions = array_merge($conditions,array('Member.location'=>$location));
			}
			if ($news_location!= "") 
			{				
				$options = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes','Location.mandatory_location'=>'Yes'),'fields'=>array('Location.id','Location.name')));				
				$menadatory_loc=array();
				//pr($options);die;				
				if(!empty($options))
				{
					foreach($options as $each_option)
					{
						$menadatory_loc[]=$each_option['Location']['id'];
					}
				}
				$location_condition=array();
				$fetch_member=$this->Member->find('all',array('conditions'=>$conditions,'fields'=>array('Member.id','Member.news_location','Member.news_location_updation'),'recursive'=>'-1'));	
	        	foreach($fetch_member as $other_location)
			  	{
			  		
					$each_location=$other_location['Member']['news_location'];
					$sub_location=explode(',',$each_location);
					if($other_location['Member']['news_location_updation']=='No')
					{
						$sub_location=array_merge($sub_location,$menadatory_loc);
						array_unique($sub_location);
					}
					if(in_array($news_location,$sub_location))
					{
					    $location_condition[]=$other_location['Member']['id'];
					}
				}	
				if(!empty($location_condition))
				{
					if (count($location_condition)>1)
					{		
						$conditions=array_merge($conditions,array('Member.id in'=>$location_condition));
					}
					else
					{
						$conditions=array_merge($conditions,array('Member.id'=>$location_condition));
					}
				}
				else
				{
				   $conditions = array_merge($conditions,array('Member.id'=>-1));
				}
			}
			$this->Session->write('condtn', $conditions);			
		} 
		else 
		{			
			$conditions = $this->Session->read('condtn');
		}
		$this->Member->bindModel(array(
				'belongsTo' =>array(
					'ApprovalSupplier1'=>array(
						'className'=>'Member',
						'foreignKey'=>'member_approve_first_step_approval')
						)
					)
				);
		$this->Member->bindModel(array(
				'belongsTo' =>array(
					'ApprovalSupplier2'=>array(
						'className'=>'Member',
						'foreignKey'=>'member_approve_second_step_approval')
						)
					)
				);		
		
		if (!empty($conditions) || isset($status) && $status  == 'all') 
		{   
		    //pr($conditions);die;
		   
		    if(@$conditions['Member.status']== '3'){
				unset($conditions['Member.status']);
				$conditions = array_merge($conditions,array("Member.first_step_approval " => 'No',"Member.second_step_approval " => 'No',"Member.status"=>'Inactive'));
				$this->Session->write('condtn', $conditions);
			}
			
		    if(@$conditions['Member.status']=='all'){
				unset($conditions['Member.status']);
				$this->Session->write('condtn', array(''));
			}
			
			$conditions = array_merge($conditions,array('Member.member_type'=>$member_type,'MemberType.name NOT'=>'admin','MemberType.id NOT'=>'1')); 
			//pr($conditions);die;
			$this->paginate=array('limit'=>10,'order'=>'Member.id desc','conditions'=>$conditions,'contain'=>array('Location','MemberType','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname')));
			$member=$this->paginate('Member',$this->Session->read('condtn'));
			$this->Session->write('export',$conditions);
			//pr($conditions);
			//pr($member);die;		
			$totalMem=$this->Member->find('count',array('order'=>'Member.id desc','conditions'=>$conditions,'contain'=>array('Location','MemberType','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname'))));
		}
		else 
		{
			if(empty($conditions))
			{
				if ($this->Session->check('condtn') && empty($this->request->data)) {
					$conditions = $this->Session->read('condtn');    
				} 
				else {
					$this->Session->delete('condtn');
					$conditions = array();
				}
			}
			$conditions = array_merge($conditions,array('Member.member_type'=>$member_type));
			$this->Session->write('export',$conditions);
			$this->paginate=array('limit'=>10,'order'=>'Member.id desc','conditions'=>$conditions,'contain'=>array('Location','MemberType','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname')));
			$member=$this->paginate('Member',$conditions);
			//$this->Session->delete('condtn');
			//pr($member);die;
			$totalMem=$this->Member->find('count',array('order'=>'Member.id desc','conditions'=>$conditions,'contain'=>array('Location','MemberType','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname'))));
		}
		$totalMemember=$this->Member->find('count',array('order'=>'Member.id desc','conditions'=>array('Member.member_type'=>$member_type),'contain'=>array('Location','MemberType','ApprovalSupplier1'=>array('id','name','surname'),'ApprovalSupplier2'=>array('id','name','surname'))));
		$this->set(compact('member'));
		$this->set(compact('totalMemember'));
		$this->set(compact('totalMem'));
		$this->set('member_type',$member_type);
		$cities = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		$this->set('cities',$cities);  
		
		if ($this->RequestHandler->isAjax()) {
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Members';
			$this->render('customers_list');
		}
	}
	function admin_edit_customer($id=null) 
	{
  		$this->layout = 'admin';
		$member_id = convert_uudecode(base64_decode($id));
  		$this->set('id',$member_id);
		$options = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes'),'fields'=>array('Location.id','Location.name')));
		$this->set('options',$options);
  		$customer=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));			
		$this->set('member',$customer);
		if(!empty($this->data)) 
		{
			$data1 = $this->data;
			//pr($data1);die;
			$data1['Member']=$this->data['Member'];
			$data1['Member']['dob'] = date('Y-m-d',strtotime(@$this->data['Member']['dob']));
			//pr($data1);die;						
			$infomem=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));	
			$memLoc = $infomem['Member']['location'];
			$arr = explode(',',$infomem['Member']['news_location']);
			array_push($arr,$this->request->data['Member']['location']);
			$arr = array_unique($arr);
			$str1 =implode(',',$arr);
			$str = trim($str1,',');
			$data1['Member']['news_location'] = $str;			
			$data1['Member']['password_copy'] = $data1['Member']['password_copy'];
			$data1['Member']['password'] = md5($data1['Member']['password_copy']);		
			$this->Member->id=$member_id;
			if($this->Member->save($data1)) 
			{ 
				$this->Session->write('success','This record has been updated successfully');
				$this->redirect(array('action'=>'admin_customers'));
			}
  		}
	}
	
}	
?>