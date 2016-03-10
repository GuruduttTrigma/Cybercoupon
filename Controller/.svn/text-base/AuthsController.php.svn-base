<?php
ob_start();
class AuthsController extends AppController {	
	var $name= "Auths";
	var $helper=array('Html','Form','Js','Paginator','Session');
	var $components = array('RequestHandler','Cookie','Session','Email');
	var $uses = array('Member','EmailTemplate');	
	
	function beforeFilter() {
		$this->disableCache();
		parent::beforeFilter();
		if(!$this->CheckAdminSession() && $this->request->prefix=='admin' && !in_array($this->request->action,array('admin_login','admin_forgot_password','admin_reset_password'))) {
			$this->redirect(array('controller'=>'auths','action' => 'login','admin' => true));
			exit();
		}	
	}	
	function admin_login() {
		$this->layout="";
		if($this->CheckAdminSession()) {
			   $this->redirect(array('controller'=>'auths','action' => 'dashboard','admin' => true));
		}
		if (!empty($this->data)) { 
  			//echo '<pre>';print_r($this->data);die;
  			if($this->data['Member']['email']!="" && $this->data['Member']['password']!="") {			
  				$username = $this->data['Member']['email'];
  				$password = md5($this->data['Member']['password']);
  				//echo $username.' '.$password;die;
  				$getAdminData = $this->Member->find('first',array('conditions' =>array('Member.status'=>'Active','email'=>$username,'password'=>$password,'member_type in'=>array('1','2'))));
  				//pr($getAdminData);die;
  				if(!empty($getAdminData) && ($getAdminData['MemberType']['id']==1||$getAdminData['MemberType']['id']==2)) {
  						//pr($getAdminData);die;				
  						//$this->Member->id=$getAdminData['Member']['id'];
  						//$this->Member->save($data);
  						$this->Session->write('Admin.email', $getAdminData['Member']['email']);
  						$this->Session->write('Admin.id', $getAdminData['Member']['id']);
  						$this->Session->write('Admin.admin_type', $getAdminData['Member']['member_type']);
  						//$this->Session->write('Admin.last_login', $getAdminData['Admin']['last_login']);
  						//$adminSession = $this->Session->read('Admin');
  						//pr($adminSession);die;
  						$this->redirect(array('controller'=>'auths','action' =>'admin_dashboard','admin' => true));
  				}
  			}
  			$this->Session->write('error',AUTHENTICATION_FAILED);		
		}
	}	
	function admin_dashboard() {	
		Configure::write('debug',2);
		$this->layout="admin";
		$adminId = $this->Session->read('Admin.id');
		$adminDetail = $this->Member->findById($adminId);
		$this->set('adminDetails',$adminDetail);
	}	
	function admin_logout() {
		$this->Session->delete('Admin');
		$this->redirect(array('action' => 'login','admin' => true));
	}	
	function admin_edit_profile() {
		$this->layout="admin";
		$adminId = $this->Session->read('Admin.id');
		$data = $this->Member->find('first',array('conditions'=>array('Member.id'=>$adminId))); 
		$this->set('adminDetails',$data);
		if(empty($this->data)) {			
			$this->Member->id = $adminId;
			$this->data = $this->Member->read();
		}		  
		else {
			$data = $this->data;
			//echo '<pre>'; print_r($data); die;
			$imageInfo = $this->Member->findById($adminId);			  			
			if(!empty($_FILES['profile_image']['name'])) {  
				/*$imgName = pathinfo($_FILES['profile_image']['name']);			
				$ext = strtolower($imgName['extension']);
				App::import('Component','resize');	
				$image = new resizeComponent();
				//echo $image;die;
				if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif') {
					unlink('../../app/webroot/img/backend/admin/'.$imageInfo['Member']['image']);		
					unlink('../../app/webroot/img/backend/admin/medium/'.$imageInfo['Member']['image']);		
					unlink('../../app/webroot/img/backend/admin/thumbnail/'.$imageInfo['Member']['image']);	
					//echo "asd";die;
					$destination = realpath('../../app/webroot/img/backend/admin') . '/';
					$filename = time().'-'.$_FILES['profile_image']['name'];
					move_uploaded_file($_FILES['profile_image']['tmp_name'],$destination.$filename);
					$image->resize('../../app/webroot/img/backend/admin/'.$filename,'../../app/webroot/img/backend/admin/medium/'.$filename,'width',170,0,0,0,0,0);
					
					$image->resize('../../app/webroot/img/backend/admin/'.$filename,'../../app/webroot/img/backend/admin/thumbnail/'.$filename,'aspect_fill',70,70,0,0,0,0);
					
					$data['Member']['image'] = $filename;
				}
				else {
					$this->Session->write('error','Please upload .jpg,.png or .gif format of image.');
					$this->redirect(array('controller'=>'auths','action'=>'edit_profile','admin' => true));
				}*/
				$data1 = $this->data;
				$data1['Member']=$this->data['Member'];
				$view = new View($this);
				$html = $view->loadHelper('Tool');
				$upload_img_name= 'dashboard_'.$adminId.'_'.time().'.'.$html->ext($_FILES['profile_image']['name']);	
				$uploaded_type =$html->file_type ($html->ext($_FILES['profile_image']['name']));
				$r = $html->upload(array (
					   'field_name'=>'profile_image',
					   'field_index'=>$adminId,
					   'file_name'=>$upload_img_name,
					   'upload_path'=>DATAPATH.'users/')
					 );
				if($r) {
					$data = array();
					$data1['Member']['image'] =  $upload_img_name;
				}
				if($this->Member->save($data1)); {
					//pr($data1);die;
					$this->Member->id=$adminId;
					$this->Member->save($data1);
					$this->redirect(array('controller'=>'auths','action'=>'dashboard','admin' => true));
				}							
			}
			$this->Member->id = $adminId;
			$this->Member->save($data);
			$this->Member->id = $this->Session->read('Admin.id');
			$this->Session->write('success','Profile has been updated');
			$this->redirect(array('controller'=>'auths','action'=>'dashboard','admin' => true));
		}
	}
	function admin_change_password() {
		$this->layout="admin";
		$adminId = $this->Session->read('Admin.id');
		$this->set('adminId',$adminId);	  
		if(!empty($this->data)) {
			//pr($this->data);die;
			$data = $this->data;
			$data['Member']['id'] = $adminId;
			$data['Member']['password_copy'] = $data['Member']['password'];
			$data['Member']['password'] = md5($data['Member']['password']);
			$this->Member->save($data);
			$this->Session->write('success','Password has been changed successfully');				
			$this->redirect(array('controller'=>'auths','action'=>'dashboard'));
		}
	}	
	function check_password() {
		$adminDetails = $this->Member->findById($this->Session->read('Admin.id'));
		$password = $adminDetails['Member']['password'];
		
		$oldPassword = md5($_REQUEST['data']['Member']['old_password']);

		if($password == $oldPassword)
		{
			echo 'true'; die;
		}
		else
		{
			echo 'false'; die;
		}
	}
 	function check_admin_email() {
		$email = trim($_REQUEST['data']['Member']['email']);
		$this->autoRender = false;
		$count = $this->Member->find('count',array('conditions'=>array('Member.email'=>$email,'Member.id NOT'=>$this->Session->read('Admin.id'))));
		if($count) {
			echo "false";die;
		}
		else {
			echo "true";die;
		}
	 }
	/*
	function admin_forgot_password() {
		$this->layout="";
		if($this->CheckAdminSession()) {
    			$this->redirect(array('controller'=>'auths','action' => 'dashboard','admin' => true));
    		}
		if (!empty($this->data)) { 
    		//echo '<pre>';print_r($this->data);die;
			$count = $this->Member->find('first',array('conditions'=>array('Member.email'=>$this->data['Member']['email'],'Member.member_type'=>'1')));
    		if(empty($count)) {
				$this->Session->write('error','Email ID does not exist!');	$this->redirect(array('controller'=>'auths','action'=>'admin_forgot_password'));   
    		}
    		else {
    			//echo '<pre>';print_r($count);die;
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'forgot_password')));
      			$mem_id = $count['Member']['id'];
				$activation_code = sha1(microtime());
				$datas = array();
				$datas['Member']['verify_text'] = $activation_code;
      			$this->Member->id = $mem_id;
				$this->Member->save($datas);
				$common_template= $emailTemp1['EmailTemplate']['description'];
				$link = HTTP_ROOT.'admin/auths/reset_password/'.base64_encode(convert_uuencode($mem_id))."/".$activation_code;							
				$link = "<a href='".$link."' style='text-decoration:none;color:#00aeef' target='_blank'>".__('Click here to change your password.')."</a>";						
				$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
				$common_template = str_replace('{contact_person}',$count['Member']['name'],$common_template);
				$common_template = str_replace('{link}',$link,$common_template);
				//echo "<pre>";print_r($common_template);die;
				$email = new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$common_template));
				$email->to($this->data['Member']['email']);
				$email->from($emailTemp1['EmailTemplate']['from']);
				$email->subject($count['Member']['email']);
				//echo '<pre>';print_r($common_template);die;
				$email->send();
				$this->Session->write('success','Password reset link has been send to your email account successfully');	
				$this->redirect(array('controller'=>'auths','action'=>'login'));
   			}
		}	
	}
	function admin_reset_password($ids=null,$key=null) {
		$id=convert_uudecode(base64_decode($ids));
		$this->layout="";
		$count = $this->Member->find('count',array('conditions'=>array('Member.id'=>$id,'Member.verify_text'=>$key)));
		if(empty($this->data) && !$count) {
			$this->Session->write('error','Key Expired! Please try again later.');	$this->redirect(array('controller'=>'auths','action'=>'admin_forgot_password')); 
		}
		else { 
			if(!empty($this->data)) {	 
				$datas = array();
				$datas['Member']['password'] = md5($this->data['Member']['password']);
				$datas['Member']['verify_text'] = "";
				$this->Member->id = $id;
				if($this->Member->save($datas)) {
					$this->Session->write('success','Password has been changed successfully.');	$this->redirect(array('controller'=>'auths','action'=>'login'));  
				}
			}
		}
			$this->set('ids',$ids); 
	}
	*/  
	function admin_forgot_password() {
		$this->layout="";
		if($this->CheckAdminSession()) { 
			$this->redirect(array('controller'=>'auths','action' => 'dashboard','admin' => true));
  		}
		if(!empty($this->data)) {
			$data=$this->data;
			//pr($data);die;
			$email=@$data['Member']['email'];
			//echo $email;
			$admin_info=$this->Member->find('first',array('conditions'=>array('Member.email'=>$email,array('Member.member_type'=>array(1,2))),'recursive'=>-1));
			//pr($admin_info);die;
			if(!empty($admin_info)) {
				$new_password=$this->RandomStringGenerator(6);
				//echo $new_password;
				//pr($admin_info['Member']['password']);
				$pwd=md5($new_password);
				//die;
				//pr($admin_info);
				$this->Member->updateAll(array('Member.password'=>"'".$pwd."'",'Member.password_copy'=>"'".$new_password."'"),array('Member.id'=>$admin_info['Member']['id'],array('Member.member_type'=>array('1','2'))));
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'admin_forgot_password')));
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
				//echo "<pre>";print_r($common_template);
				$email = new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$common_template));
				$email->to($emailto);
				//$email->cc('promatics.subhash@gmail.com');
				$email->bcc('promatics.subhash@gmail.com');
				$email->from($emailTemp1['EmailTemplate']['from']);
				$email->subject($emailTemp1['EmailTemplate']['subject']);  
				//echo "<pre>";print_r($common_template);die;
				$email->send();
				$this->Session->write('success','New Password send to your email account successfully !');	
				$this->redirect(array('controller'=>'auths','action'=>'login'));
			}
			else {
				$this->Session->write('error','Invalid Email address.');
			}
		}    
	} 
	function Customer_login() {
  		$this->layout='public';
		if(!empty($this->request->data)) {
			$data = $this->request->data;
    		$get_log = $this->Member->find('first',array('conditions'=>array('Member.status'=>'Active','Member.email'=>$data['Member']['log_email'],'Member.member_type'=>'4','Member.password'=>md5($data['Member']['log_password'])))); 
    		//	pr($get_log);die;
			if(!empty($get_log)) {
			   $this->Session->write('Member.name', $get_log['Member']['name']);
			   $this->Session->write('Member.email', $get_log['Member']['email']);
			   $this->Session->write('Member.member_type', $get_log['Member']['member_type']);
			   $this->Session->write('Member.id', base64_encode(convert_uuencode($get_log['Member']['id'])));
			   echo "success"; die;
			}
			else { 
				echo "error"; die;
			}
        } 
	}
}
?>