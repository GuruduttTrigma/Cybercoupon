<?php
class ManagesController extends AppController {
	var $name = "Manages";
	var $helper=array('Html','Form','Js','Session','Tool','Tooladvance');
	var $components = array('RequestHandler','Cookie','Session','Email');
	var $uses=array('Faq','Member','FaqCategory','EmailTemplate','CmsPage','Location','Customer','Contact','Deal','DealCategory','DealImage');
	var $value;
	
	/******************************* FAQ functions ********************* */
	function admin_faq() {
		$this->layout = 'admin';
		//$a_faqs=$this->Faq->find('all',array('order'=>array('Faq.id DESC')));
		$a_faqs=$this->Faq->find('all',array('order'=>array('Faq.order ASC','Faq.id DESC')));
		$this->set(compact('a_faqs'));
		//$this->value = 5;
		
	}
	public function admin_addfaq() {
		$this->layout='admin';
		$options = $this->FaqCategory->find('all',array('fields'=>array('FaqCategory.id','FaqCategory.name'),'order'=>'FaqCategory.id desc'));
		$this->set('options',$options);
		if(!empty($this->request->data)) {
			$data1=$this->request->data;
			//pr($data1);die;
			$data1['Faq']['registered'] = date('Y-m-d H:i:s');
			if($this->Faq->save($data1)) {
				$this->Session->write('success','FAQ has been added successfully.');
				$this->redirect(array('action'=>'admin_faq'));
			}
		}
	}
	public function admin_deleteFAQ($id=null) {
		$this->autoRender = false;
		$faq_id=convert_uudecode(base64_decode($id));
		if($this->Faq->delete($faq_id)) {
			$this->Session->write('success','FAQ has been deleted successfully');
			$this->redirect(array('action'=>'admin_faq'));
		}
	}
	function admin_view_faq($id=null) {
		$this->layout='admin';
		$faqs_id=convert_uudecode(base64_decode($id));
		$faqs=$this->Faq->find('first',array('conditions'=>array('Faq.id'=>$faqs_id)));
		$this->set(compact('faqs'));
	}
	function admin_edit_faq($id=null) {
		$this->layout = 'admin';
		$faq_id=convert_uudecode(base64_decode($id));
		$this->set('id',$faq_id);
		$faqs=$this->Faq->find('first',array('conditions'=>array('Faq.id'=>$faq_id)));
		$this->set(compact('faqs'));
		
		if(!empty($this->data)) {
			$this->Faq->id=$faq_id;
			//pr($this->data);die;
			if($this->Faq->save($this->data)) {
				$this->Session->write('success','FAQ has been updated successfully.');
				$this->redirect(array('action'=>'admin_faqs'));
			}
		}
		

	}
	public function admin_faqs() {
		$this->layout = 'admin';
		$category=$this->FaqCategory->find('all',array('order'=>array('FaqCategory.id DESC')));
		$this->set('faq_cat',$category);
		//pr($this->request->data);die;
		if(!empty($this->request->data)) {
			//pr($this->request->data);die;
			$type=trim($this->request->data['Faq']['faq_type']);
			$conditions=array();
			//echo $type;die;
			if($type!="") {
				$conditions=array_merge($conditions,array('Faq.faq_type'=>$type));
			}		
		}
		if(@$conditions!="") {
			$codes=$this->Faq->find('all',array('conditions'=>$conditions,'order'=>array('Faq.order ASC','Faq.id desc')));
		}
		else {
			$codes=$this->Faq->find('all',array('order'=>array('Faq.order ASC','Faq.id desc')));
		}
		//if($this->RequestHandler->isAjax
		$this->set('a_faqs',$codes);
		if($this->RequestHandler->isAjax()) {
			$this->layout='';
			$this->autoRender=false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Manages';
			$this->render('faq_list');
		}
	}
	/* **************************FAQ category functions *************** */
	function admin_faq_category() {
		$this->layout = 'admin';
		$a_faqs=$this->FaqCategory->find('all',array('order'=>array('FaqCategory.id DESC')));
		$this->set(compact('a_faqs'));	
	}	
	public function admin_add_faq_category() {
		$this->layout='admin';
		if(!empty($this->request->data)) {
			$data1=$this->request->data;
			$data1['FaqCategory']['registered'] = date('Y-m-d H:i:s');
			$data1['FaqCategory']['active'] = 'Yes';
			//pr($data1);die;
			if($this->FaqCategory->save($data1)) {
				$this->Session->write('success','FAQ Category has been added successfully.');
				$this->redirect(array('action'=>'admin_faq_category'));
			}
		}
	}
	public function admin_delete_faq_category($id=null) {
		$this->autoRender = false;
	    $faq_id=convert_uudecode(base64_decode($id));
		if($this->FaqCategory->delete($faq_id)) {
			$this->Session->write('success','FAQ Category has been deleted successfully');
			$this->redirect(array('action'=>'admin_faq_category'));
		}
	}	
	function admin_edit_faq_category($id=null) {
		$this->layout = 'admin';
		$faq_id=convert_uudecode(base64_decode($id));
		$this->set('id',$faq_id);
		$faqs=$this->FaqCategory->find('first',array('conditions'=>array('FaqCategory.id'=>$faq_id)));
		$this->set(compact('faqs'));
		if(!empty($this->data)) {
			//echo "<pre>";print_r($this->data);die;
			$this->FaqCategory->id=$faq_id;
			if($this->FaqCategory->save($this->data)) {
				$this->Session->write('success','FAQ Category has been updated successfully.');
				$this->redirect(array('action'=>'admin_faq_category'));
			}
		}
	}
	function admin_update_faq_category($id=NULL) {		
		$ctr_id = convert_uudecode(base64_decode($id));
		$old_data = $this->FaqCategory->read('active',$ctr_id);
		if($old_data['FaqCategory']['active']=="Yes") {
			if($this->FaqCategory->updateAll(array('FaqCategory.active'=>"'No'"),array('FaqCategory.id'=>$ctr_id))) {
				$this->Session->write('success','Category has been deactivated successfully');
				$this->redirect(array('action'=>'admin_faq_category'));
			}
		}
		else {
			if($this->FaqCategory->updateAll(array('FaqCategory.active'=>"'Yes'"),array('FaqCategory.id'=>$ctr_id))) {
				$this->Session->write('success','Category has been activated successfully');
				$this->redirect(array('action'=>'admin_faq_category'));
			}
		}
	}
	/* ************************CMS pages function******************************* */
	public function admin_cmsPages($id=null) {
		$this->layout = 'admin';
		$cms_id=convert_uudecode(base64_decode($id));
		//echo $cms_id;die;
		$cms=$this->CmsPage->find('all',array('conditions'=>array('CmsPage.status'=>'Active'),'order'=>'CmsPage.id asc'));
		$this->set('cmsPages',$cms);
	}
	function admin_editCmsPage($edit_id = NULL) {
		$editId = convert_uudecode(base64_decode($edit_id));
		$this->layout = 'admin';
		$cmsEdit = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.id'=>$editId)));
		$this->set('cmsEdit',$cmsEdit);
		//pr($_FILES);die;
		if(!empty($this->request->data)) {
			$data = $this->request->data;		
			//pr($data);die;
			$cms_uri=$this->uri($this->data['CmsPage']['page_title']);
			$data['CmsPage']['uri'] = $cms_uri;
			
			//.....................if image existance
			//pr($_FILES);die;
			 if(@$_FILES['cms_image']['tmp_name']!='')
			{
				 $view = new View($this);
				$html = $view->loadHelper('Tool');
				$upload_img_name= 'winners_'.$editId.'_'.time().'.'.$html->ext($_FILES['cms_image']['name']);	
				$uploaded_type =$html->file_type ($html->ext($_FILES['cms_image']['name']));
				/*if($uploaded_type!='image')
				{
					echo 'please upload image.';die;
				}*/
				$r = $html->upload(array (
							   'field_name'=>'cms_image',
							   'field_index'=>$editId,
							   'file_name'=>$upload_img_name,
							   'upload_path'=>DATAPATH.'CMS/')
							 );
				if($r)
				{
					$data['CmsPage']['image'] = $upload_img_name;
				}
			}
			//.....................end of image existance.
			$this->CmsPage->id = $editId;
			if($this->CmsPage->save($data)) {
				//pr($data);die;
				$this->Session->write('success','CMS Page has been updated successfully.');
				$this->redirect(array('controller'=>'Manages','action'=>'cmsPages'));
			}
		}
	}	
	function admin_checkeditCategoryExist($id=NULL) {
		//echo $id;die;
		$name = trim($_REQUEST['data']['FaqCategory']['name']);
		$this->autoRender = false;
		$count = $this->FaqCategory->find('count',array('conditions'=>array('FaqCategory.name'=>$name,'FaqCategory.id NOT'=>$id)));
		if($count) {
			echo "false";die;
		}
		else {
			echo "true";die;
		}	
	}
	function admin_checkaddCategoryExist() {
		$name=trim($_REQUEST['data']['FaqCategory']['name']);
		$this->autoRender = false;
		$count=$this->FaqCategory->find('count',array('conditions'=>array('FaqCategory.name'=>$name)));
		if($count > 0) {
			echo "false";die;
		}
		else {
			echo "true";die;
		}
	}			
	function admin_customer_contact($member_type=null) {
		$this->layout = 'admin';
		$member_type=convert_uudecode(base64_decode($member_type));
		$this->set('member_type',$member_type);		
		$a_customers=$this->Contact->find('all');
		//pr($a_customers);die;
		$this->set(compact('a_customers'));	
		$this->set(compact('member_type'));
		$conditions=array();
		if(!empty($this->data)) {
			//echo "<pre>";print_r($this->data); die;					
			$data=$this->data;
			$conditions=array();
			$cemail = trim($_POST['data']['Customer']['email']);
			$cname = trim($_POST['data']['Customer']['name']);
			//echo $cname;die;
			if(@$cname!="") {
				$conditions = array_merge($conditions, array(
				'OR' => array('Contact.name  LIKE' => "%" . trim($this->data['Customer']['name'].'%'))));
				//pr($conditions);die;			
			}
			if(@$cemail!="") {
				$conditions=array_merge($conditions,array('Contact.email LIKE'=>'%'.$cemail.'%'));
			}
			$this->Session->write('search.conditions',$conditions);
		}	
		if(@$conditions && !empty($conditions)) {
			$conditions=array_merge($conditions,array('Contact.member_type'=>$member_type));
			$a_customers=$this->Contact->find('all',array('order'=>'Contact.id desc','conditions'=>$conditions));
			//pr($a_customers);die;
			$this->set('a_customers',$a_customers);	
		}
		else {
     		 $conditions=array_merge($conditions,array('Contact.member_type'=>$member_type));			 
			 $contct=$this->Contact->find('all',array('order'=>'Contact.id desc','conditions'=>$conditions));
			 //$this->set('contct',$contct);
			 $this->set('a_customers',$contct);	
			 //pr($a_customers);die;
		}
		if($this->RequestHandler->isAjax()) {
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath = 'Elements'.DS.'backend'.DS.'Manages';
			$this->render('customer_list');
		}
	}		 
	function admin_generate_csv() {	 
		$conditions = $this->Session->read('export');	
  		//pr($conditions);die;		
  		$this->layout="admin";
  		$this->autoRender=false;
  		$this->loadModel('Deal');
  		Configure::write('debug', 2);
  		$data ="Name,Buy From,Buy To,Category,Posted Buy,Active \n";
  		$allPayments=$this->Deal->find('all', array('conditions'=>$conditions,'order'=>'Deal.id desc','recursive'=>0));		
  		//pr($allPayments);die;			   
  		foreach($allPayments as $payment) {	
			$data .= $payment['Deal']['name'].",";
			$data .=$payment['Deal']['buy_from'].",";
			$data .=$payment['Deal']['buy_to'].",";
			$data .=$payment['DealCategory']['name'].",";
			$data .=$payment['Member']['name']." ".$payment['Member']['surname'].",";
			$data .=$payment['Deal']['active'].",";
			//$totalDeal = $this->Member->find('count', array('conditions' => array('Member.id' => '<> NULL ')));	
			//pr($totalDeal);											
			$data .="\n";	
  		}
  		//pr($data);die;
  		$this->Session->delete('Member_sess');
  		header("Content-Type: application/csv");			
  		$csv_filename = 'Deals_list_'.date("Y-m-d_H-i",time()).'.csv';
  		header("Content-Disposition:attachment;filename=".$csv_filename);
  		$fd = fopen ($csv_filename, "w");
  		fputs($fd,$data);
  		fclose($fd);
  		echo $data;
  		die();
	}
	function admin_generate_xsl() {
		$this->autoRender=false;
		ini_set('max_execution_time', 1600); 
		$results=$this->Contact->find('all',array('fields'=>array('name','email','phone','subject','message'),'order'=>'Contact.id desc'));		
		//$results = $this->Contact->find('all', array());// set the query function
 		foreach($results as $result) {
		@$header_row.= $result['Contact']['name']."\t". $result['Contact']['email'] ."\t ".$result['Contact']['phone']." \t".$result['Contact']['Subject']."\t"."\n";
		}		
		$filename = "export_".date("Y.m.d").".xls";
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		echo($header_row);
	}
	/* ************************* Customer Function **************************** */
	function admin_addcustomer() {
		$this->layout='admin';
		if(!empty($this->request->data)) {
			$data1=$this->request->data;
			if($this->Contact->save($data1)) {
				$this->Session->write('success','FAQ has been added successfully.');
				$this->redirect(array('action'=>'admin_customer_contact'));
			}
		}
	}
	function admin_deleteCustomer($id) {
		$this->autoRender = false;
	    $customer_id=convert_uudecode(base64_decode($id));
		if($this->Contact->delete($customer_id)) {
			$this->Session->write('success','Contact has been deleted successfully');
			$this->redirect(array('action'=>'admin_customer_contact'));
		}
	}
	function admin_view_customer($id=null) {
		$this->layout = 'admin';
		$customer=convert_uudecode(base64_decode($id));
		//$customers=$this->Contact->find('first');
		$customers=$this->Contact->find('first',array('conditions'=>array('Contact.id'=>$customer)));	   
		//pr($customers);die;
		$this->set('a_customers',$customers);
	}
	function admin_edit_customer($id=null) {
		//echo $id;die;
		$this->layout = 'admin';
		$customer_id=convert_uudecode(base64_decode($id));
		$this->set('id',$customer_id);
		$customers=$this->Contact->find('first',array('conditions'=>array('Contact.id'=>$customer_id)));
		$this->set(compact('customers'));
		//echo $customer_id;die;
		if(!empty($this->data)) { 
			$this->Contact->id=$customer_id;
			if($this->Contact->save($this->data)) {
				$this->Session->write('success','FAQ has been updated successfully.');
				$this->redirect(array('action'=>'admin_customer_contact'));
			}
		}
	}
	/* ************************** Deal Function********************* */
	function admin_deals()
	{
		$this->layout = 'admin';
		$member=$this->Deal->find('all');
		$this->set(compact('member'));
		$conditions=array();
		$currentDate = date('Y-m-d'); 
		$loc = $this->Location->find('all');
		/*  Regular Expression Start */
		//$data = $this->Deal->query('select * from deals');
		//pr($data);die;
		//$info=$this->admin_edit_customer();
		//pr($info);
		/* Regular Expression End */
		$this->Deal->virtualFields = array('company_name'=>'SELECT company_name FROM member_metas where Deal.member_id=member_metas.member_id');		
		if(!empty($this->request->data))
		{
			$conditions=array_merge($conditions,array('Deal.delete_status'=>'No'));
			$mySearchParams  = $_POST;
			$this->Session->write('mySearchParams',$mySearchParams);
			$names=trim($_POST['data']['Deal']['name']);
			$active=trim($_POST['data']['Deal']['active']);
			$bfrom = trim($_POST['data']['Deal']['buy_from']);
			$bto = trim($_POST['data']['Deal']['buy_to']);
			$buyfrom=trim(date('Y-m-d',strtotime($_POST['data']['Deal']['buy_from'])));
			$buyto=trim(date('Y-m-d',strtotime($_POST['data']['Deal']['buy_to'])));
			$company_name=trim(@$_POST['data']['Member']['MemberMeta']['company_name']);
                        $locat=$_POST['data']['Deal']['location'];
			//echo $company_name;die;
			if($names!="") {
				$conditions=array_merge($conditions,array('Deal.name LIKE'=>'%'.$names.'%'));
			}
			if($bfrom!="") {
				  $conditions=array_merge($conditions,array('Deal.buy_from >= ' =>$buyfrom));
			}
			if($bto!="") {
				$conditions=array_merge($conditions,array('Deal.buy_to <= ' =>$buyto));
			}	
			if($active!="") {
				$conditions=array_merge($conditions,array('Deal.active'=>$active));
			}
			if($company_name!="") {
				$conditions=array_merge($conditions,array('Deal.company_name LIKE'=>'%'.$company_name.'%'));
			}

                        if ($locat!="") 
				{				
					$loclist = $this->Deal->find('all',array('conditions'=>$conditions,'fields'=>array('id','location'),'recursive'=>'-1'));
					$location_deals=array();
					foreach($loclist as $deal_loc)
					{
					  $sub_deals=explode(',',$deal_loc['Deal']['location']);
					  array_unique($sub_deals);
					  if(in_array($locat,$sub_deals))
					  {
						$location_deals[]=$deal_loc['Deal']['id'];
					  }
					}
					if(!empty($location_deals))
					{
						if(count($location_deals)>1)
						   $conditions=array_merge($conditions,array('Deal.id in'=>$location_deals));
						else
					      $conditions=array_merge($conditions,array('Deal.id'=>$location_deals[0]));
					}
					else
					{
						$conditions=array_merge($conditions,array('Deal.location'=>$locat));
					}
					
				}
                        
			$this->Session->write('cond', $conditions);
			
		}
		else {
			
			$conditions = $this->Session->read('cond');
		}
		if(!empty($conditions) && $conditions!="")
		{
			$conditions = $this->Session->read('cond');
			$this->paginate=array('limit'=>10,'conditions'=>$conditions,'order'=>array('FIELD(Deal.active, "No", "Yes") ASC'),'contain'=>array('Member'=>array('MemberMeta'),'DealCategory','Location','DealOption','DealImage'));
			$deal_count = $this->Deal->find('count',array('conditions'=>$conditions));
			$member=$this->paginate('Deal');
			//pr($member);die;
		}
		else   
		{
			if(empty($conditions))
			{
				if ($this->Session->check('cond') && empty($this->request->data)) {
					$conditions = $this->Session->read('cond');    
				} 
				else {
					$this->Session->delete('cond');
					$conditions = array();
				}
			}
			$this->paginate=array('limit'=>10,'conditions'=>array('Deal.delete_status'=>'No','Deal.active'=>'No'),'order'=>array('FIELD(Deal.active, "No", "Yes") ASC'),'contain'=>array('Member'=>array('MemberMeta'),'DealCategory','Location','DealOption','DealImage'));
			$member=$this->paginate('Deal');
			$deal_count = $this->Deal->find('count',array('conditions'=>array('Deal.delete_status'=>'No','Deal.active'=>'No'),'contain'=>array()));
			//pr($member);die;
		}
		
		pr($member);die;
		$this->set(compact('member','loc','deal_count'));
		$this->Session->write('export',@$conditions);		
		if($this->RequestHandler->isAjax()) {
			$this->layout='';
			$this->autoRender=false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Manages';
			$this->render('deals_list');
		}
	}	
	function admin_view_Deal($id=null) {
		$this->layout='admin';
		$member_id=convert_uudecode(base64_decode($id));
		$member=$this->Deal->find('first',array('conditions'=>array('Deal.id'=>$member_id),'contain'=>array('Member'=>array('MemberMeta'),'DealCategory','Location','DealOption')));
		//pr($member);die;
		$this->set(compact('member'));
	}	
	function admin_editDeal($id=null) {
		$this->layout='admin';
		$this->loadModel('DealOption');
		$member_id=convert_uudecode(base64_decode($id));
		$member=$this->Deal->find('first',array('conditions'=>array('Deal.id'=>$member_id)));
		//pr($member);die;
		$this->set(compact('member'));
		//$deal_category = $this->DealCategory->generateTreeList($conditions=array('DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '&nbsp&nbsp&nbsp&nbsp');
		//$this->set('deal_category',$deal_category);
		
		//........start alphabatical category order...
		$alphabatical_category=$this->_AlphabaticalCategory2();
		$this->set('deal_category',$alphabatical_category); 
		//........end alphabatical category order...
		
		$parent_catog = $this->DealCategory->generateTreeList($conditions=array('DealCategory.parent_id'=>'','DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '');
		$parent_catog_id=array_keys($parent_catog);
		$this->set('parent_catog_id',$parent_catog_id);
		$nearest_location = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		//pr($nearest_location);die;	
		//pr($options['Deal']['category']);die;
		
		$this->set('nearest_location',$nearest_location);	
		//pr($this->data['Deal']['image']);die;
		if(!empty($this->data) && !empty($this->data['main_image'])) {
			$data1 = $this->data;
			$supplier_id = $this->data['supplier_id'];
			//pr($data1);die;
			$var = strpos($data1['main_image']," ");
			$main_image = ($var>0)?str_replace(" ","",$data1['main_image']):$data1['main_image'];
			$deal_uri=$this->uri($this->data['Deal']['name']);
			$data1['Deal']=$this->data['Deal'];
			$data1['Deal']['uri']=$deal_uri;
			$data1['Deal']['buy_from']=date('Y-m-d',strtotime($this->data['Deal']['buy_from']));
			$data1['Deal']['buy_to']=date('Y-m-d',strtotime($this->data['Deal']['buy_to']));
			$data1['Deal']['redeem_from']=date('Y-m-d',strtotime($this->data['Deal']['redeem_from']));
			$data1['Deal']['redeem_to']=date('Y-m-d',strtotime($this->data['Deal']['redeem_to']));
			$data1['Deal']['description'] = $this->data['Deal']['description'];
			if(trim($this->data['Deal']['newsletter_sent_date'])!='')
			{
				$data1['Deal']['newsletter_sent_date']=date('Y-m-d',strtotime($this->data['Deal']['newsletter_sent_date']));
				$data1['Deal']['supplier_newsletter_status']='pending';
			}
			else
			{
				$data1['Deal']['supplier_newsletter_status']='no';
			}
			/* --------------------- Payment Mode by Gurudutt Sharma Start --------------------------- */
			if(@$data1['Deal']['modePayment'] == 'on')
			{
				$data1['Deal']['modePayment'] = 'All';
			}
			else
			{
				$data1['Deal']['modePayment'] = 'EFT';
			}
			/* --------------------- Payment Mode by Gurudutt Sharma End --------------------------- */
			// $data1['Deal']['image'] = $file;       
			//pr($data1['Deal']);die;
			if (!empty($_FILES['deal_image']['name'][0]) && (@$_FILES['deal_image']['name'][0]!=''))
			{
			
				$Image = array();
				$count=count($_FILES['deal_image']['name']);
				for($i=0;$i<$count;$i++)
				{
					$view = new View($this);
					$html = $view->loadHelper('Tooladvance');
					$var = strpos($_FILES['deal_image']['name'][$i]," ");
					$good_image = ($var>0)?str_replace(" ","",$_FILES['deal_image']['name'][$i]):$_FILES['deal_image']['name'][$i];
					$upload_img_name= 'deals_'.$member_id.'_'.time().'_'.$good_image;
					$uploaded_type =$html->file_type ($html->ext($good_image));
					if ($uploaded_type!='image')
					{
						echo 'please upload image.';die;
					}
					$r = $html->upload(array (
						   'field_name'=>'deal_image',
						   'field_index'=>$member_id,
						   'file_name'=>$upload_img_name,
						   'upload_path'=>DATAPATH.'deals/',
							'cnt'=> $i)
						);
				 
					$Image['DealImage']['image_name']=$upload_img_name;      
					$Image['DealImage']['deal_id']=$member_id;
					$Image['DealImage']['supplier_id'] = $supplier_id;
					$Image['DealImage']['image_random']= $data1['hidden_img'][$i].$good_image;
					$Image['DealImage']['status']= 'Inactive';
					$this->DealImage->create();
					$this->DealImage->save($Image);                 
						 
				} 
			}
			$saved_images = $this->DealImage->find('all',
			array(
					'conditions' => array(
						'DealImage.deal_id' => $member_id,'DealImage.supplier_id' => $supplier_id
					)
				)
			);
			foreach ($saved_images as $value) {
				if($value['DealImage']['image_random'] == $main_image){
					$this->DealImage->id = $value['DealImage']['id'];
					$savingdata['DealImage']['status']= "Active";
					$savingdata['DealImage']['image_type']= "M";
					$upload_img_name = $value['DealImage']['image_name'];
					$this->DealImage->save($savingdata);
				}
				else {
					$this->DealImage->id = $value['DealImage']['id'];
					$savingdata['DealImage']['status']= "Inactive";
					$savingdata['DealImage']['image_type']= "S";
					$this->DealImage->save($savingdata);
				
				}
				
			}
			$data1['Deal']['image'] =  $upload_img_name;
			$multiple_location='';
			foreach($data1['Deal']['location'] as $each_loc)
			{
			   $multiple_location.=$each_loc.",";
			}
			$multiple_location=rtrim($multiple_location,',');
			$data1['Deal']['location']=$multiple_location;
			//pr($data1);die;
			if($this->Deal->save($data1)); 
			{				
				$data1['Deal']['active']='yes';
				//pr($data1);
				$this->Deal->id=$member_id;
				$this->Deal->save($data1);
				//pr($data1);die;
				$data1['data2'][0]['DealOption']['option_title'] = $this->data['Deal']['name'];
				foreach($data1['data2'] as $data3)
				{
					$this->DealOption->create();
					if(!empty($data3['DealOption']['option_title']))
					{	
						if(!empty($data3['DealOption']['id'])) {
							$this->DealOption->id = $data3['DealOption']['id'];
						} else {
							unset($data3['DealOption']['id']);
						}
						//pr($data3);
						$this->DealOption->save($data3);	
					}
					
				}
            //die;				
				$this->redirect(array('action'=>'admin_deals'));
			}
			$this->Session->write('success','Deal has updated successfully.');
			$this->redirect(array('action'=>'admin_deals'));
		}	
	}
	function admin_editDeal_newsletter($id=null) {
		$this->layout='admin';
		//echo "hii";die;
		$this->loadModel('DealOption');
		$member_id=convert_uudecode(base64_decode($id));
		$member=$this->Deal->find('first',array('conditions'=>array('Deal.id'=>$member_id)));
		$this->set(compact('member'));
		//$deal_category = $this->DealCategory->generateTreeList($conditions=array('DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '&nbsp&nbsp&nbsp&nbsp');
		//$this->set('deal_category',$deal_category);
		
		//........start alphabatical category order...
		$alphabatical_category=$this->_AlphabaticalCategory2();
		$this->set('deal_category',$alphabatical_category); 
		//........end alphabatical category order...
		
		$parent_catog = $this->DealCategory->generateTreeList($conditions=array('DealCategory.parent_id'=>'','DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '');
		$parent_catog_id=array_keys($parent_catog);
		$this->set('parent_catog_id',$parent_catog_id);
		$nearest_location = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		//pr($nearest_location);die;	
		//pr($options['Deal']['category']);die;
		
		$this->set('nearest_location',$nearest_location);	
		//pr($this->data['Deal']['image']);die;
		if(!empty($this->data) && !empty($this->data['main_image'])) 
		{
			//pr($this->data);die;
			//$file=$this->data['Deal']['image']['name'];
			//$this->data['Deal']['image']=$file;
			//$file1=$this->data['Deal']['image']
			$data1 = $this->data;
			$supplier_id = $this->data['supplier_id'];
			$var = strpos($data1['main_image']," ");
			$main_image = ($var>0)?str_replace(" ","",$data1['main_image']):$data1['main_image'];
			//pr($this->data);die;
			$deal_uri=$this->uri($this->data['Deal']['name']);
			$data1['Deal']=$this->data['Deal'];
			$data1['Deal']['uri']=$deal_uri;
			$data1['Deal']['buy_from']=date('Y-m-d',strtotime($this->data['Deal']['buy_from']));
			$data1['Deal']['buy_to']=date('Y-m-d',strtotime($this->data['Deal']['buy_to']));
			$data1['Deal']['redeem_from']=date('Y-m-d',strtotime($this->data['Deal']['redeem_from']));
			$data1['Deal']['redeem_to']=date('Y-m-d',strtotime($this->data['Deal']['redeem_to']));
			$data1['Deal']['description'] = $this->data['Deal']['description'];
			if(trim($this->data['Deal']['newsletter_sent_date'])!='')
			{
				$data1['Deal']['newsletter_sent_date']=date('Y-m-d',strtotime($this->data['Deal']['newsletter_sent_date']));
				$data1['Deal']['supplier_newsletter_status']='pending';
			}
			else
			{
				$data1['Deal']['supplier_newsletter_status']='no';
			}
			// $data1['Deal']['image'] = $file;       
			//pr($data1['Deal']);die;
			if (!empty($_FILES['deal_image']['name'][0]) && (@$_FILES['deal_image']['name'][0]!=''))
			{
			
				$Image = array();
				$count=count($_FILES['deal_image']['name']);
				for($i=0;$i<$count;$i++)
				{
					$view = new View($this);
					$html = $view->loadHelper('Tooladvance');
					$var = strpos($_FILES['deal_image']['name'][$i]," ");
					$good_image = ($var>0)?str_replace(" ","",$_FILES['deal_image']['name'][$i]):$_FILES['deal_image']['name'][$i];
					$upload_img_name= 'deals_'.$member_id.'_'.time().'_'.$good_image;
					$uploaded_type =$html->file_type ($html->ext($good_image));
					if ($uploaded_type!='image')
					{
						echo 'please upload image.';die;
					}
					$r = $html->upload(array (
						   'field_name'=>'deal_image',
						   'field_index'=>$member_id,
						   'file_name'=>$upload_img_name,
						   'upload_path'=>DATAPATH.'deals/',
							'cnt'=> $i)
						);
				 
					$Image['DealImage']['image_name']=$upload_img_name;      
					$Image['DealImage']['deal_id']=$member_id;
					$Image['DealImage']['supplier_id'] = $supplier_id;
					$Image['DealImage']['image_random']= $data1['hidden_img'][$i].$good_image;
					$this->DealImage->create();
					$this->DealImage->save($Image);                 
						 
				} 
			}
			$saved_images = $this->DealImage->find('all',
			array(
					'conditions' => array(
						'DealImage.deal_id' => $member_id,'DealImage.supplier_id' => $supplier_id
					)
				)
			);
			foreach ($saved_images as $value) {
				if($value['DealImage']['image_random'] == trim($main_image)){
					$this->DealImage->id = $value['DealImage']['id'];
					$savingdata['DealImage']['status']= "Active";
					$savingdata['DealImage']['image_type']= "M";
					$upload_img_name = $value['DealImage']['image_name'];
					$this->DealImage->save($savingdata);
				}
				else {
					$this->DealImage->id = $value['DealImage']['id'];
					$savingdata['DealImage']['status']= "Inactive";
					$savingdata['DealImage']['image_type']= "S";
					$this->DealImage->save($savingdata);
				
				}
				
			}
			$data1['Deal']['image'] =  $upload_img_name;
			$multiple_location='';
			foreach($data1['Deal']['location'] as $each_loc)
			{
			   $multiple_location.=$each_loc.",";
			}
			$multiple_location=rtrim($multiple_location,',');
			$data1['Deal']['location']=$multiple_location;
			//pr($data1);die;
			if($this->Deal->save($data1)); 
			{				
				$data1['Deal']['active']='yes';
				//pr($data1);
				$this->Deal->id=$member_id;
				$this->Deal->save($data1);
				//pr($data1);die;
				$data1['data2'][0]['DealOption']['option_title'] = $this->data['Deal']['name'];
				foreach($data1['data2'] as $data3)
				{
					$this->DealOption->create();
					if(!empty($data3['DealOption']['option_title']))
					{	
						if(!empty($data3['DealOption']['id'])) {
							$this->DealOption->id = $data3['DealOption']['id'];
						} else {
							unset($data3['DealOption']['id']);
						}
						//pr($data3);
						$this->DealOption->save($data3);	
					}
				} 
				$this->redirect(array('controller'=>'NewsLetters','action'=>'newsletter'));
			}
			$this->Session->write('success','Deal has updated successfully.');
			$this->redirect(array('controller'=>'NewsLetters','action'=>'newsletter'));
		}	
	}
	function admin_deleteDeal($id) {
		$this->autoRender=false;
		$deal_id = convert_uudecode(base64_decode($id));
		$deal = $this->Deal->find('first',array('conditions'=>array('Deal.id'=>$deal_id),'contain'=>false,'fields'=>array('id','name','uri')));
		//pr($deal);die;
		$deal_uri = $deal['Deal']['uri'];
		$deal_name = $deal['Deal']['name'];
		$currDate = time();
		$update_uri = $deal_uri.'_'.$currDate;
		$update_name = $deal_name.' '.$currDate;
		if($this->Deal->updateAll(array('Deal.delete_status'=>"'Yes'",'Deal.active'=>"'No'",'Deal.name'=>"'".$update_name."'",'Deal.uri'=>"'".$update_uri."'"),array('Deal.id'=>$deal_id))) {
			$this->Session->write('success','Deal has been deleted successfully');
			$this->redirect(array('action'=>'admin_deals'));
		}
	}
	function admin_update_deals($id=NULL) {		
		//pr($id);
  		$ctr_id = convert_uudecode(base64_decode($id));
		//pr($ctr_id);die;
		$data1 = $this->Deal->find('first',array('conditions'=>array('Deal.id'=>$ctr_id),'contain'=>array('Member'=>'MemberMeta')));
		//pr($data1);die;
  		$old_data = $this->Deal->read('active',$ctr_id);
  		if($old_data['Deal']['active']=="Yes") {	
    			if($this->Deal->updateAll(array('Deal.active'=>"'No'"),array('Deal.id'=>$ctr_id))) {
    				$this->Session->write('success','Deal has been deactivated successfully');
    				$this->redirect(array('action'=>'admin_deals'));
    			}
  		}
  		else {
    		if($this->Deal->updateAll(array('Deal.active'=>"'Yes'"),array('Deal.id'=>$ctr_id))) 
			{
				$emailTemp1 = $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'deal_approved')));
				$name = $data1['Deal']['name'];
				$supplier = $data1['Member']['MemberMeta']['company_name'];
				$email1=$data1['Member']['email'];
				
				$common_template = $emailTemp1['EmailTemplate']['description'];
				$common_template = str_replace('{name}',$name,$common_template);
				$common_template = str_replace('{supplier}',$supplier,$common_template);
						
				//	pr($email1);
				//echo "<pre>";print_r($common_template);die;
				$email = new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$common_template));
				$email->to($email1);
				$email->from($emailTemp1['EmailTemplate']['from']);
				$email->subject($emailTemp1['EmailTemplate']['subject']);  
				if($email->send())
				{
					$this->Session->write('success','Deal has been activated successfully');
					$this->redirect(array('action'=>'admin_deals'));
				}
				else
				{
					$this->Session->write('error','An error occur mail does not send');
					$this->redirect(array('action'=>'admin_deals'));
				}
				
    		}
  		}
	}
	function admin_update_featured_deals($id=null) {
		$deal_id=convert_uudecode(base64_decode($id));  
		//pr($deal_id);die;
		$old_data =$this->Deal->read('featured',$deal_id);
		// pr($old_data);die;
		if($old_data['Deal']['featured']=='Yes') {
			if($this->Deal->updateAll(array('Deal.featured'=>"'No'"),array('Deal.id'=>$deal_id))) {
				$this->Session->write('success','Deal has been unfeatured successfully');
				$this->redirect(array('action'=>'admin_deals'));
			}
		}
		else {
			if($this->Deal->updateAll(array('Deal.featured'=>"'Yes'"),array('Deal.id'=>$deal_id))) {
				$this->Session->write('success','Deal has been featured successfully');
				$this->redirect(array('action'=>'admin_deals'));
			}
		}
	}
	/* *********************** Email Templates Function **********************  */
	function admin_emailTemplates()  {
		configure::write('debug',2);
		$this->layout='admin';
		$email_template = $this->EmailTemplate->find('all',array('conditions'=>array('EmailTemplate.status'=>'active'),'order'=>'EmailTemplate.id DESC'));
		$this->set('templates',$email_template);
	}
	function admin_edit_template($id=null) {
		$this->layout='admin';
		//echo $id;die;
		$id1=convert_uudecode(base64_decode($id));
		//echo $id1;die;
		$this->set('id',$id1);
		$template=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>$id1)));
		//pr($template);		
		$this->set('template',$template);
		
		if(!empty($this->request->data)) {
			//pr($this->request->data);die;
			if($this->request->data['EmailTemplate']['description']!="") {
				  if($this->Session->check('email_desc_error')) {
					  $this->Session->delete('email_desc_error');
				  }
				   //echo $id;die;
				  //pr($this->EmailTemplate->id);die;
				  if(@$_FILES['first_step_approval']['tmp_name']!='')
				  {
				  $view = new View($this);
				  $html = $view->loadHelper('Tool');
					$upload_img_name= 'first_step_approval'.'.'.$html->ext($_FILES['first_step_approval']['name']);	
					//pr($upload_img_name);	      
		      	$uploaded_type =$html->file_type ($html->ext($_FILES['first_step_approval']['name']));
					//pr($uploaded_type);
					//echo 	DATAPATH;die;      	
		      	$r = $html->upload(array (
		                           'field_name'=>'first_step_approval',
		                           'field_index'=>'',
		                           'file_name'=>$upload_img_name,
		                           'upload_path'=>DATAPATH.'first_step_approval/')
		                         );
		                        // pr($r);die;
		         if($r) {
		            $data = array();
		            $this->request->data['EmailTemplate']['first_step_approval'] =  $upload_img_name;
		            }
		        }
		        //pr($this->request->data);die;
		        $data1=$this->request->data;
		        $this->EmailTemplate->id=$id1;  
		        //echo $id1;
		        //echo $this->EmailTemplate->id;die;  
				  if($this->EmailTemplate->save($data1)) { 						
				  		$this->Session->setFlash('Email Template  Updated Successfully.');
				  		$this->redirect(array('controller'=>'Manages','action'=>'emailTemplates'));
				  }
			}
			else {
				$this->Session->write('email_desc_error','Please enter test description.');
			}
		}
	}
	/*function admin_status_first_step_approval($id=null) {	
		//$id1=convert_uudecode(base64_decode($id));
		//echo $id1;die;
		$id1=$id;
		$template=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>$id1)));
		//pr($template);die;
		if($template)
		{
			
			if($template['EmailTemplate']['pdf_send']=="Yes") {
				//echo "fdfdfd";die;
				if($this->EmailTemplate->updateAll(array('EmailTemplate.pdf_send'=>"'No'"),array('EmailTemplate.id'=>$id1))) {
					$this->Session->setFlash('Email Template  Updated Successfully.');
					$this->redirect(array('controller'=>'Manages','action'=>'emailTemplates'));
				}
			}
			
			if($template['EmailTemplate']['pdf_send']=="No") {
				//echo "gggddg";die;
				if($this->EmailTemplate->updateAll(array('EmailTemplate.pdf_send'=>"'Yes'"),array('EmailTemplate.id'=>$id1))) {
					$this->Session->setFlash('Email Template  Updated Successfully.');
					$this->redirect(array('controller'=>'Manages','action'=>'emailTemplates'));
				}
			}
			//echo "gggddg";die;
			$this->Session->setFlash('Email Template  Updated Successfully.');
			$this->redirect(array('controller'=>'Manages','action'=>'emailTemplates'));
		}
		else {
		
			$this->redirect(array('action'=>'emailTemplates'));
		}
	}/*
	/* ********************* Currency Management Function *****************  */
	function admin_currency_management()  {
		$this->layout='admin';
		$this->loadModel('CurrencyManagement');
		$currency=$this->CurrencyManagement->find('all');
		//pr($currency);die;
		$this->set(compact('currency'));		
	}
	function admin_add_currency() { 
		$this->layout='admin';
		$this->loadModel('CurrencyManagement');		
		if(!empty($this->request->data)) {
			$data1=$this->request->data;
			//pr($data1);die;
			$data1['CurrencyManagement']['registered'] = date('Y-m-d H:i:s');
			if($this->CurrencyManagement->save($data1)) {
				$this->Session->write('success','Currency has been added successfully.');
				$this->redirect(array('action'=>'admin_currency_management'));
			}
		}
	}
	function admin_view_currency($id=null) {
		$this->layout='admin';
		$this->loadModel('CurrencyManagement');				
		$currency_id=convert_uudecode(base64_decode($id));
		$currency=$this->CurrencyManagement->find('first',array('conditions'=>array('CurrencyManagement.id'=>$currency_id)));
		$this->set(compact('currency'));	
	}
	function admin_edit_currency($id=null) {	
		$this->layout='admin';
		$this->loadModel('CurrencyManagement');				
		$currency_id=convert_uudecode(base64_decode($id));
		$this->set('id',$currency_id);
		$currency=$this->CurrencyManagement->find('first',array('conditions'=>array('CurrencyManagement.id'=>$currency_id)));
		$this->set(compact('currency'));
		if(!empty($this->data)) {
			$this->CurrencyManagement->id=$currency_id;
			if($this->CurrencyManagement->save($this->data)) {
				$this->Session->write('success','Currency has been updated successfully.');
				$this->redirect(array('action'=>'admin_currency_management'));
			}
		}
	}
	function admin_deleteCurrency($id=null) {
		$this->autoRender = false;
		$this->loadModel('CurrencyManagement');						
		$currency_id=convert_uudecode(base64_decode($id));
		if($this->CurrencyManagement->delete($currency_id)) {
			$this->Session->write('success','Currency has been deleted successfully');
			$this->redirect(array('action'=>'admin_currency_management'));
		}
	}
	function admin_update_currency($id=null) {
		$ctr_id = convert_uudecode(base64_decode($id));
		$this->loadModel('CurrencyManagement');						
		$old_data = $this->CurrencyManagement->read('active',$ctr_id);
		if($old_data['CurrencyManagement']['active']=="Yes") {
			if($this->CurrencyManagement->updateAll(array('CurrencyManagement.active'=>"'No'"))) {
				//$old_data['CurrencyManagement']['active']=="NO";
				$this->CurrencyManagement->active=$ctr_id;
				$this->CurrencyManagement->save($this->data);
				$this->Session->write('success','Currency has been changed successfully');
				$this->redirect(array('action'=>'admin_currency_management'));
			}
		}
		else {
			if($this->CurrencyManagement->updateAll(array('CurrencyManagement.active'=>"'NO'"))) {
				//pr($this->data);die;
				$data1 = $this->data;
				$data1['CurrencyManagement']['active'] = "YES";
				$this->CurrencyManagement->active=$ctr_id;
				
				$this->CurrencyManagement->save($data1);			
				$this->Session->write('success','Currency has been changed successfully');
				$this->redirect(array('action'=>'admin_currency_management'));
			}
		}
	}	
	/* ************************* Claim Refund Function *******************   */
	function admin_claim() {	
		$this->layout='admin';	
		$this->loadModel('OrderDealRelation');	
		$orderrelation = $this->OrderDealRelation->find('all',array('conditions'=>array('OrderDealRelation.claim_status NOT'=>'NoClaim','OrderDealRelation.reconcile NOT'=>"Completed"),'order'=>array('OrderDealRelation.c_r_date'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
		$this->set(compact('orderrelation'));
		//pr($orderrelation);die;
		if(!empty($this->request->data)) {
			$names=trim($_POST['data']['Deal']['name']);
			$status=trim($_POST['data']['OrderDealRelation']['claim_status']);
			$conditions=array();
			if($names!="") {
				//echo $names;die;
				$conditions=array_merge($conditions,array('Deal.name LIKE'=>'%'.$names.'%'));
				//echo '<pre>';print_r($conditions);die;			
			}
			if(@$status!="") {
				
				$conditions=array_merge($conditions,array('OrderDealRelation.claim_status'=>$status));
				//pr($conditions);die;
			}
			//pr($conditions);die;
		}
		if(@$conditions!="") {
			$conditions = array_merge($conditions,array('OrderDealRelation.claim_status NOT'=>'NoClaim','OrderDealRelation.refund_status'=>'No','OrderDealRelation.reconcile NOT'=>"Completed"));//,'OrderDealRelation.refund_status'=>'No'
			 $orderrelation = $this->OrderDealRelation->find('all',array('conditions'=>$conditions,'order'=>array('OrderDealRelation.c_r_date'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
			$this->Session->write('export',@$conditions);				
		}
		else {
			$orderrelation = $this->OrderDealRelation->find('all',array('conditions'=>array('OrderDealRelation.claim_status NOT'=>'NoClaim','OrderDealRelation.refund_status'=>'No','OrderDealRelation.reconcile NOT'=>"Completed"),'order'=>array('OrderDealRelation.c_r_date'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
			$conditions = array('OrderDealRelation.claim_status NOT'=>'NoClaim','OrderDealRelation.reconcile NOT'=>"Completed");			
			$this->Session->write('export',@$conditions);				
		}
		$this->set(compact('orderrelation'));
		$this->Session->write('export',@$conditions);		
		if($this->RequestHandler->isAjax()) {
			$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Manages';
			$this->render('claims_list');
		}
	}
	function admin_view_detail($id=null) {
		$this->layout='admin';
		$this->loadModel('OrderDealRelation');				
		$orderdealrelation_id=convert_uudecode(base64_decode($id));
		//echo $orderdealrelation_id;die;
		$orderdealrelation = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.id'=>$orderdealrelation_id),'order'=>array('OrderDealRelation.id'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
		//pr($orderdealrelation);die;		
		$this->set(compact('orderdealrelation'));			
	}
	function admin_update_Claims($id=null) {
		$this->autoRender = false;
		$ctr_id = convert_uudecode(base64_decode($id));
		$claim_status = $_POST['claim_status'];
		$this->loadModel('OrderDealRelation');				
		//$old_data = $this->OrderDealRelation->read('claim_status',$ctr_id);
		$cur_date = Date('Y-m-d H:i:s');
		if($this->OrderDealRelation->updateAll(array('OrderDealRelation.claim_status'=>'"'.$claim_status.'"','OrderDealRelation.reconcile'=>"'Requested'",'OrderDealRelation.reconcile_sent_on'=>'"'.$cur_date.'"'),array('OrderDealRelation.id'=>$ctr_id))) {
			$orderrelation = $this->OrderDealRelation->find('first',array('conditions'=>array('OrderDealRelation.id'=>$ctr_id),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
			//pr($orderrelation);die;
			$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'claim_status')));
			$common_template= $emailTemp1['EmailTemplate']['description'];
			$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
			$common_template = str_replace('{sname}',$orderrelation['Deal']['Member']['name']." ".$orderrelation['Deal']['Member']['surname'],$common_template);
			$common_template = str_replace('{claim_status}',str_replace('Claim','',$orderrelation['OrderDealRelation']['claim_status']),$common_template);
			$common_template = str_replace('{order_no}',$orderrelation['Order']['order_no'],$common_template);
			$email = new CakeEmail();
			$email->template('common_template');
			$email->emailFormat('both');
			$email->viewVars(array('common_template'=>$common_template));       
			$email->to($orderrelation['Deal']['Member']['email']);
			//$email->cc('promatics.gautam@gmail.com');
			$email->from($emailTemp1['EmailTemplate']['from']);
			$email->subject($emailTemp1['EmailTemplate']['subject']);                             
			//echo '<pre>';print_r($common_template);die;
			//$email->attachments($pdfTitle);
			//$email->send();	
			$this->Session->write('success','Claim status has been change successfully');
			die;
			//$this->redirect(array('action'=>'admin_claim'));
		}
		
	}
	function admin_refund() {
		$this->layout='admin';	
		$this->loadModel('OrderDealRelation');	
			if(!empty($this->request->data)) {
				$names=trim($_POST['data']['Deal']['name']);
				//$status=trim($_POST['data']['OrderDealRelation']['refund_status']);
				//echo $status;
				$conditions=array();
				if($names!="") {
					$conditions=array_merge($conditions,array('Deal.name LIKE'=>'%'.$names.'%'));
				}
				/*if(@$status!="") {
					$conditions=array_merge($conditions,array('OrderDealRelation.refund_status'=>$status));
					
				}*/
			}
			if(@$conditions!="") {
 				//'OrderDealRelation.claim_status'=>'NoClaim',
				$conditions = array_merge($conditions,array('OrderDealRelation.refund_status NOT'=>'No','OrderDealRelation.claim_status'=>'ClaimApproved','OrderDealRelation.reconcile NOT'=>"Completed"));
				//pr($conditions);
				$orderrelation = $this->OrderDealRelation->find('all',array('conditions'=>$conditions,'order'=>array('OrderDealRelation.c_r_date'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'=>array('MemberMeta'=>array('fields'=>array('supplier%','cybercoupon%')))),'DealOption')));
				$this->Session->write('export',@$conditions);							
			}
			else {
				//'OrderDealRelation.claim_status'=>'NoClaim',
				$orderrelation = $this->OrderDealRelation->find('all',array('conditions'=>array('OrderDealRelation.refund_status NOT'=>'No','OrderDealRelation.claim_status'=>'ClaimApproved','OrderDealRelation.reconcile NOT'=>"Completed"),'order'=>array('OrderDealRelation.c_r_date'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'=>array('MemberMeta'=>array('fields'=>array('supplier%','cybercoupon%')))),'DealOption')));
				//$this->set(compact('orderrelation'));
				//pr($orderrelation);die;
				$conditions = array('OrderDealRelation.refund_status NOT'=>'No');						
				$this->Session->write('export',@$conditions);									
			}
				//pr($orderrelation);die;
				$this->set(compact('orderrelation'));
				$this->Session->write('export',@$conditions);		
				if($this->RequestHandler->isAjax())
            {
							$this->layout='';
							$this->autorender=false;
							$this->viewPath='Elements'.DS.'backend'.DS.'Manages';
							$this->render('refund_list');
				}
	}
	function admin_update_refunds($id=null) 
	{
		$ctr_id = convert_uudecode(base64_decode($id));
		$refund_status = $_POST['refund_status'];
		
		$this->loadModel('OrderDealRelation');				
		$old_data = $this->OrderDealRelation->read('refund_status',$ctr_id);
		if($old_data['OrderDealRelation']['refund_status']=="No" || $old_data['OrderDealRelation']['refund_status']=="Yes") 
		{
			if($this->OrderDealRelation->updateAll(array('OrderDealRelation.refund_status'=>'"'.$refund_status.'"'),array('OrderDealRelation.id'=>$ctr_id))) 
			{
				$this->Session->write('success','Refund is Approved');
			}
		}
		die;
	}
	function admin_generate_csv_claim() {	 
		$conditions = $this->Session->read('export');	
  		$this->layout="admin";
		$this->loadModel('OrderDealRelation');	
		$this->loadModel('Member');			
  		$data ="Deal Name,Supplier Email,Customer Email,Purchase Date,Claim Status,Payment Status,Payment Type,Total Amount,Transaction Id \n";
		$orderrelation = $this->OrderDealRelation->find('all',array('conditions'=>$conditions,'order'=>array('OrderDealRelation.c_r_date'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
		//$orderdealrelation=$orderrelation['Deal']['Member']['email'] ; 		
		//echo $orderdealrelation;die;  		
  		//pr($orderrelation);die;			   
  		foreach($orderrelation as $orderrelation) {	
			$data .= $orderrelation['Deal']['name'].",";
			$data .= @$orderrelation['Deal']['Member']['email'].",";
			$data .= @$orderrelation['Order']['Member']['email'].",";
			$data .= date('d M Y',strtotime($orderrelation['Order']['payment_date'])).",";
			$data .= $orderrelation['OrderDealRelation']['claim_status'].",";					
			$data .= $orderrelation['OrderDealRelation']['reconcile'].",";					
			$data .= $orderrelation['Order']['payment_type'].",";					
			$data .= $orderrelation['Order']['sub_total'].",";					
			$data .= $orderrelation['Order']['transaction_id'].",";					
			$data .= "\n";	
  		}
  		//pr($data);die;
  		//$this->Session->delete('Member_sess');
  		//header("Content-Type: application/csv");			
  		$csv_filename = 'Sales_Claim_list_'.date("Y-m-d_H-i",time()).'.csv';
  		header("Content-Disposition:attachment;filename=".$csv_filename);
  		$fd = fopen ($csv_filename, "w");
  		fputs($fd,$data);
  		fclose($fd);
  		echo $data;
  		die();
	}
	function admin_generate_csv_refund() {	 
		$conditions = $this->Session->read('export');	
  		//pr($conditions);die;		
  		$this->layout="admin";
		$this->loadModel('OrderDealRelation');	
		$this->loadModel('Member');			
  		$data ="Deal Name,Customer Email,Purchase Date,Total Amount \n";
		$orderrelation = $this->OrderDealRelation->find('all',array('conditions'=>$conditions,'order'=>array('OrderDealRelation.c_r_date'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'=>array('MemberMeta'=>array('fields'=>array('supplier%','cybercoupon%')))),'DealOption')));
		//pr($orderrelation);die;			   
  		foreach($orderrelation as $orderrelation) {	
			$data .= $orderrelation['Deal']['name'].",";
			$data .= @$orderrelation['Deal']['Member']['email'].",";
			$data .= date('d M Y',strtotime($orderrelation['Order']['payment_date'])).",";
			$data .= $orderrelation['OrderDealRelation']['sub_total'].",";			
			/*if($orderrelation['OrderDealRelation']['reconcile']=='Pending') {
				$percentage=$orderrelation['Deal']['Member']['MemberMeta']['cybercoupon%'];
				$data .= number_format(($orderrelation['OrderDealRelation']['sub_total']*$percentage)/100,2,'.','')." (".$percentage."%)".",";
			}
			else {
				$data .= $orderrelation['OrderDealRelation']['sub_total'].' (100%)'.",";
			}					
			/*if($orderrelation['OrderDealRelation']['refund_status']=='Yes') {
				$data .='Pending'.",";
			}
         else {
           $data .=$orderrelation['OrderDealRelation']['refund_status'].",";
         }	
			$data .= $orderrelation['Order']['transaction_id'].",";  
			*/       			
			$data .= "\n";	
  		}
  		//pr($data);die;
  		//$this->Session->delete('Member_sess');
  		//header("Content-Type: application/csv");			
  		$csv_filename = 'Refund_Claim_list_'.date("Y-m-d_H-i",time()).'.csv';
  		header("Content-Disposition:attachment;filename=".$csv_filename);
  		$fd = fopen ($csv_filename, "w");
  		fputs($fd,$data);
  		fclose($fd);
  		echo $data;
  		die();
	}
	function admin_price_limits() {
		$this->layout='admin';
		$this->loadModel('PriceLimit');
		$data=$this->PriceLimit->find('first',array('conditions'=>array('PriceLimit.id'=>1)));
		$this->set('info',$data);
		//pr($data);
		if(!empty($this->request->data)) {
			$data1=$this->request->data;
			//pr($data1);die;
			$this->PriceLimit->id=1;
			if($this->PriceLimit->save($data1)) {
				//echo "hiii";die;
				$this->Session->write('success','Deal Price Limit has been added successfully.');
				$this->redirect(array('action'=>'admin_price_limits'));
			}
		}
	}
	function admin_sold_Vouchers() 
	{
		$this->layout='admin';	
		$conditions = array('Member.member_type'=>3,'Member.status'=>'Active');
		if (!empty($this->request->data)) {
			$names = trim($_POST['data']['Member']['name']);
			$emails = trim($_POST['data']['Member']['email']);
			if ($names!= "") {
				$conditions = array_merge($conditions,array('MemberMeta.company_name LIKE'=>'%'.$names.'%'));
			}
			if ($emails!= "") {
				$conditions = array_merge($conditions,array('Member.email LIKE'=>'%'.$emails.'%'));
			}
			
		}
		if (!empty($conditions)) { 
			$member = $this->Member->find('all',array('conditions'=>$conditions));
			$this->Session->write('export',$conditions);
		}
		else {
			$member=$this->Member->find('all',array('conditions'=>$conditions,'order'=>array('Member.id desc')));
			$this->Session->write('export',$conditions);    	
		}
		//pr($member);die;
		$this->set(compact('member'));
		if ($this->RequestHandler->isAjax()) {
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Manages';
			$this->render('sold_vouchers_list');
		}
	}
	function admin_locations() {
		 $this->layout = 'admin';
		  //Configure::write('debug', 2);
		 $locations=$this->Location->find('all');
		 //pr($locations);die;
		 $this->set('info',$locations);
	} 
	function admin_view_deal_vouchers($id=null) {
		
		$this->layout='admin';		
		//echo $id;die;
		$this->loadModel('Deal');
			$member_id=convert_uudecode(base64_decode($id));
			
			$conditions=array('Deal.member_id'=>$member_id,'Deal.delete_status'=>'No','Deal.sales_deal >='=>'0');
			$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on orders.id=order_deal_relations.order_id where `order_deal_relations.deal_id`= Deal.id and orders.order_status="success" and order_deal_relations.claim_status!="ClaimCancelled" ');		
			$this->paginate=array('order'=>'Deal.id desc','limit'=>MINLIMIT,'contain'=>array('DealCategory','Location'));
			$mydeal_info=$this->paginate('Deal',$conditions);
  	     	$this->set('mydeal_info',$mydeal_info);
	}
	function admin_edit_location($id=null) {
		$this->layout='admin';
		$location_id=convert_uudecode(base64_decode($id));
		$location=$this->Location->find('first',array('conditions'=>array('Location.id'=>$location_id,)));
		//pr($location);die;
		$this->set(compact('location'));
		if(!empty($this->data)) {
			$this->Location->id=$location_id;
			//pr($this->data);die;
			if($this->Location->save($this->data)) {
				$this->Session->write('success','Location has been updated successfully.');
				$this->redirect(array('controller'=>'manages','action' => 'admin_locations','admin' => true));
			}
		}	
	}
	public function admin_deleteLocation($id=null) {
		$this->autoRender = false;
		$location_id=convert_uudecode(base64_decode($id));
		if($this->Location->delete($location_id)) {
			$this->Session->write('success','Location has been deleted successfully');
			$this->redirect(array('controller'=>'manages','action' => 'admin_locations','admin' => true));
		}
	}
	function admin_update_location($id=NULL) {		
		$location_id = convert_uudecode(base64_decode($id));
		// pr($ctr_id);
  		$old_data = $this->Location->read('active',$location_id);
  		if($old_data['Location']['active']=="Yes") {
    			if($this->Location->updateAll(array('Location.active'=>"'No'"),array('Location.id'=>$location_id))) {
    				$this->Session->write('success','Location has been deactivated successfully');
			$this->redirect(array('controller'=>'manages','action' => 'admin_locations','admin' => true));
    			}
  		}
  		else {
    		if($this->Location->updateAll(array('Location.active'=>"'Yes'"),array('Location.id'=>$location_id))) {
    			$this->Session->write('success','Location has been activated successfully');
			$this->redirect(array('controller'=>'manages','action' => 'admin_locations','admin' => true));
    		}
  		}
	}
	function admin_update_mandatory_location($id=NULL) {		
		$location_id = convert_uudecode(base64_decode($id));
		// pr($ctr_id);
  		$old_data = $this->Location->read('mandatory_location',$location_id);
  		//pr($old_data);die;
  		if($old_data['Location']['mandatory_location']=="Yes") {
    			if($this->Location->updateAll(array('Location.mandatory_location'=>"'No'"),array('Location.id'=>$location_id))) {
    				$this->Session->write('success','Location is not Mandatory');
			$this->redirect(array('controller'=>'manages','action' => 'admin_locations','admin' => true));
    			}
  		}
  		else {
    		if($this->Location->updateAll(array('Location.mandatory_location'=>"'Yes'"),array('Location.id'=>$location_id))) {
    			$this->Session->write('success','Location is Mandatory ');
			$this->redirect(array('controller'=>'manages','action' => 'admin_locations','admin' => true));
    		}
  		}
	}
	function admin_addLocation() {
		
		$this->layout='admin';
		if(!empty($this->request->data)) {
			$data1=$this->request->data;
			//pr($data1);die;
			if($this->Location->save($data1)) {
				$this->Session->write('success','Location has been added successfully.');
			$this->redirect(array('controller'=>'manages','action' => 'admin_locations','admin' => true));
			}
		}
	}
	function admin_deal_list() {
		$this->layout='admin';
		$member=$this->Deal->find('all');
		
		$this->set(compact('member'));
		$conditions=array('Deal.delete_status'=>'No');
		$this->Deal->virtualFields = array('Sales_Person'=>'select CONCAT(name," ",surname) as name from `members` as sl where sl.id=(SELECT sales_parent FROM `members` as m where m.sales_parent in (select id from members as e where m.sales_parent = e.id) and m.id = Deal.member_id)','sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on orders.id=order_deal_relations.order_id where `order_deal_relations.deal_id`= Deal.id and orders.order_status!="failed"','dis_total_sales_deal'=>'SELECT SUM(discount_selling_price) FROM order_deal_relations inner join orders on orders.id=order_deal_relations.order_id where `order_deal_relations.deal_id`= Deal.id and orders.order_status!="failed"');		
		
		if(!empty($this->request->data)) {
			$mySearchParams  = $_POST;
			$this->Session->write('mySearchParams',$mySearchParams);
			
			$bfrom = trim($_POST['data']['Deal']['buy_from']);
			$bto = trim($_POST['data']['Deal']['buy_to']);
			$buyfrom=trim(date('Y-m-d',strtotime($_POST['data']['Deal']['buy_from'])));
			$buyto=trim(date('Y-m-d',strtotime($_POST['data']['Deal']['buy_to'])));
			$name=trim($_POST['data']['Deal']['SalesPersonName']);
			
			if($bfrom!="") {
				  $conditions=array_merge($conditions,array('Deal.buy_from >= ' =>$buyfrom));
			}
			if($bto!="") {
				$conditions=array_merge($conditions,array('Deal.buy_to <= ' =>$buyto));
			}
			if($name!="" && !empty($name)) {
				  $conditions=array_merge($conditions,array('Deal.Sales_Person LIKE'=>'%'.$name.'%'));
			}	
			
		}
		if(@$conditions!="") {
			//pr($conditions);die;													//$conditions=array_merge($conditions,array('Deal.name NOT'=>'admin','Deal.id NOT'=>'1')); 
			$member=$this->Deal->find('all',array('conditions'=>$conditions,'order'=>'Deal.id desc','contain'=>array('Member'=>array('MemberMeta'),'DealCategory','Location','DealOption')));
			//pr($member);die;
		}
		else {
			$member=$this->Deal->find('all',array('conditions'=>array('Deal.delete_status'=>'No'),'order'=>'Deal.id desc','contain'=>array('Member'=>array('MemberMeta'),'DealCategory','Location','DealOption')));
			//pr($member);die;
		}
		$TotalAmount = 0.00;
		foreach($member as $data):	
				$TotalAmount += (@$data['Deal']['dis_total_sales_deal']!=0)?$data['Deal']['dis_total_sales_deal']:'0'; 
		endforeach;
		$sales_persons=$this->Member->find('all',array('conditions'=>array('Member.company_user_type'=>'sales_person'),'fields'=>array('id','name','surname'),'recursive'=>-2));
		$this->set(compact('member','TotalAmount','sales_persons'));
		//pr($sales_persons);die;
		$this->Session->write('export',@$conditions);		
		if($this->RequestHandler->isAjax()) {
			$this->layout='';
			$this->autoRender=false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Manages';
			$this->render('deals_list_list');
		}
	}
	function admin_view_sales_persons() {
		$this->layout='admin';
	}
	function admin_customer_verification()
	{
		$this->layout='admin';
		$this->loadModel('CustomerVarification');
		$getdata = $this->CustomerVarification->find('first');
		$this->set('reqdata',$getdata);
		//pr($this->request->data);die;
		if(!empty($this->request->data)) 
		{
			$data = $this->request->data;
			//pr($data);die;
			if(!empty($data['CustomerVarification']['varification_status']))
			{
				$data['CustomerVarification']['varification_status']='email_varification';
				if($this->CustomerVarification->updateAll(array('CustomerVarification.varification_status'=>"'".$data['CustomerVarification']['varification_status']."'"),array('CustomerVarification.id'=>1)))
				{
					$this->redirect(array('controller'=>'manages','action' => 'admin_customer_verification','admin' => true));
				}
			}	
			
			else
			{
				$data['CustomerVarification']['varification_status']='direct_varification';
				if($this->CustomerVarification->updateAll(array('CustomerVarification.varification_status'=>"'".$data['CustomerVarification']['varification_status']."'"),array('CustomerVarification.id'=>1)))
				{
					$this->redirect(array('controller'=>'manages','action' => 'admin_customer_verification','admin' => true));
				}
			}
		}
		
	}
	function admin_view_customer_verication($id = Null) 
	{
		$this->layout='admin';
		$this->loadModel('CustomerVarification');
		$req_id=convert_uudecode(base64_decode($id));
		$reqdata = $this->CustomerVarification->find('first',array('conditions'=>array('CustomerVarification.id'=>$req_id)));
		//pr($reqdata);die;
		$this->set('reqdata',$reqdata);
	}
	public function admin_edit_customer_verification($id = Null) 
	{
		$this->layout='admin';
		$this->loadModel('CustomerVarification');
		$req_id=convert_uudecode(base64_decode($id));
		$reqdata = $this->CustomerVarification->find('first',array('conditions'=>array('CustomerVarification.id'=>$req_id)));
		$this->set('reqdata',$reqdata);
		//pr($_POST);die;
	}
	public function admin_view_sent_newsletter($id = Null)
	{
		$this->layout='admin';
		$this->loadModel('Deal');
		$this->loadModel('Dispatch');
		$this->loadModel('DispatchDeal');
		$login_supplier_id=$this->Session->read('Member.id');
		$member_id=convert_uudecode(base64_decode($login_supplier_id));		
		$conditions=array('DispatchDeal.supplier_id'=>$member_id,'Dispatch.status'=>'sent');
		$all = $this->DispatchDeal->find('first',array('conditions'=>$conditions,'order'=>'DispatchDeal.id desc','recursive'=>2));
		//pr($all);
		$this->set('data',$all);	
	}
	
	function deleteDealImage($deal_id = NULL,$image_id = NULL)
	{
		$this->loadModel('DealImage');
		if($deal_id!='' && $image_id!=''):
			$conditions=array('DealImage.id'=>$image_id,'DealImage.deal_id'=>$deal_id); 
			$this->DealImage->deleteAll($conditions);
			$this->Deal->updateAll(array('Deal.image'=>'" "'),array('Deal.id'=>$deal_id));
			
			$dealimage=$this->DealImage->find('all',array('conditions'=>array('DealImage.deal_id'=>$deal_id)));
			$this->set('dealimage',$dealimage);
			
			if ($this->RequestHandler->isAjax()) {
				$this->layout="";
				$this->autoRender=false;
				$this->viewPath = 'Elements'.DS.'backend'.DS.'Manages';
				$this->render('edit_deal_image');
			}
		endif;
	}
	function deleteAllDealImage()
	{
		$this->loadModel('DealImage');
		$deal_id = $_POST['deal_id'];
		$image_idz = $_POST['image_idz'];
		$matched_array = implode("','",$image_idz);
		if($deal_id!='' && $matched_array!=''):
			$this->DealImage->query("DELETE FROM deal_images WHERE deal_images.deal_id = ".$deal_id." AND deal_images.id IN ('".$matched_array."')");
			$this->Deal->updateAll(array('Deal.image'=>'" "'),array('Deal.id'=>$deal_id));
			
			$dealimage=$this->DealImage->find('all',array('conditions'=>array('DealImage.deal_id'=>$deal_id)));
			$this->set('dealimage',$dealimage);
			
			if ($this->RequestHandler->isAjax()) {
				$this->layout="";
				$this->autoRender=false;
				$this->viewPath = 'Elements'.DS.'backend'.DS.'Manages';
				$this->render('edit_deal_image');
			}
		endif;
	
	}
}
?>