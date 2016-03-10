<?php class BusinessController extends AppController {

	var $name= "Business";
	var $helper=array('Html','Form','Js','Paginator','Session');
	var $components = array('RequestHandler','Cookie','Session','Email');
	var $uses = array('Member','BusinessCategory','BusinessType','PaymentRelease','PaymentHistory','EmailTemplate');
	
	function beforeFilter()
	{
			$this->disableCache();
			parent::beforeFilter();
			if(!$this->CheckAdminSession() && $this->request->prefix=='admin' && !in_array($this->request->action,array('admin_login','admin_forgot_password','admin_reset_password')))
			{
				$this->redirect(array('controller'=>'auths','action' => 'login','admin' => true));
				exit();
			}	
	}	
 
/*****************Business Categories***********************************************************/

  function admin_business_category() 
  {
     $this->layout = 'admin';
		$a_cat=$this->BusinessCategory->find('all',array('order'=>array('BusinessCategory.id DESC'))); 
     $this->set(compact('a_cat'));
  }

  public function admin_add_business_category()
	{
		$this->layout='admin';
		if(!empty($this->request->data))
		{
			$data1=$this->request->data;
			$data1['BusinessCategory']['registered'] = date('Y-m-d H:i:s');
			$data1['BusinessCategory']['active'] = 'Yes';
			//pr($data1);die;
			if($this->BusinessCategory->save($data1))
			{
				$this->Session->write('success','Business Category has been added successfully.');
				$this->redirect(array('action'=>'admin_business_category'));
			}
		}
	}
	
	public function admin_delete_business_category($id=null)
	{
		$this->autoRender = false;
	    $faq_id=convert_uudecode(base64_decode($id));
		if($this->BusinessCategory->delete($faq_id))
		{
			$this->Session->write('success','Business Category has been deleted successfully');
			$this->redirect(array('action'=>'admin_business_category'));
		}
	}
	
	function admin_edit_business_category($id=null)
	{
		$this->layout = 'admin';
		$faq_id=convert_uudecode(base64_decode($id));
		$this->set('id',$faq_id);
		$faqs=$this->BusinessCategory->find('first',array('conditions'=>array('BusinessCategory.id'=>$faq_id)));
		$this->set(compact('faqs'));
		if(!empty($this->data))
		{
			//echo "<pre>";print_r($this->data);die;
			$this->BusinessCategory->id=$faq_id;
			if($this->BusinessCategory->save($this->data))
			{
				$this->Session->write('success','Business Category has been updated successfully.');
				$this->redirect(array('action'=>'admin_business_category'));
			}
		}
	}
	
	function admin_update_business_category($id=NULL)
	{		
		$ctr_id = convert_uudecode(base64_decode($id));
		$old_data = $this->BusinessCategory->read('active',$ctr_id);
		if($old_data['BusinessCategory']['active']=="Yes")
		{
			if($this->BusinessCategory->updateAll(array('BusinessCategory.active'=>"'No'"),array('BusinessCategory.id'=>$ctr_id)))
			{
				$this->Session->write('success','Category has been deactivated successfully');
				$this->redirect(array('action'=>'admin_business_category'));
			}
		}
		else
		{
			if($this->BusinessCategory->updateAll(array('BusinessCategory.active'=>"'Yes'"),array('BusinessCategory.id'=>$ctr_id)))
			{
				$this->Session->write('success','Category has been activated successfully');
				$this->redirect(array('action'=>'admin_business_category'));
			}
		}
	}
	
	function admin_checkeditCategoryExist($id=NULL)
	{
		//echo $id;die;
		$name = trim($_REQUEST['data']['BusinessCategory']['name']);
		$this->autoRender = false;
		$count = $this->BusinessCategory->find('count',array('conditions'=>array('BusinessCategory.name'=>$name,'BusinessCategory.id NOT'=>$id)));
		if($count)
		{
			echo "false";die;
		}
		else
		{
			echo "true";die;
		}
		
	}
	function admin_checkaddCategoryExist()
	{
		$name=trim($_REQUEST['data']['BusinessCategory']['name']);
		$this->autoRender = false;
		$count=$this->BusinessCategory->find('count',array('conditions'=>array('BusinessCategory.name'=>$name)));
		if($count > 0)
		{
			echo "false";die;
		}
		else
		{
			echo "true";die;
		}
	}

/*****************Business Types***********************************************************/


	function admin_business_types() 
  {
     $this->layout = 'admin';
		$a_cat=$this->BusinessType->find('all',array('order'=>array('BusinessType.id DESC'))); 
     $this->set(compact('a_cat'));
  }

  public function admin_add_business_types()
	{
		$this->layout='admin';
		if(!empty($this->request->data))
		{
			$data1=$this->request->data;
			$data1['BusinessType']['registered'] = date('Y-m-d H:i:s');
			$data1['BusinessType']['active'] = 'Yes';
			//pr($data1);die;
			if($this->BusinessType->save($data1))
			{
				$this->Session->write('success','Business type has been added successfully.');
				$this->redirect(array('action'=>'admin_business_types'));
			}
		}
	}
	
	public function admin_delete_business_types($id=null)
	{
		$this->autoRender = false;
	    $faq_id=convert_uudecode(base64_decode($id));
		if($this->BusinessType->delete($faq_id))
		{
			$this->Session->write('success','Business type has been deleted successfully');
			$this->redirect(array('action'=>'admin_business_types'));
		}
	}
	
	function admin_edit_business_types($id=null)
	{
		$this->layout = 'admin';
		$faq_id=convert_uudecode(base64_decode($id));
		$this->set('id',$faq_id);
		$faqs=$this->BusinessType->find('first',array('conditions'=>array('BusinessType.id'=>$faq_id)));
		$this->set(compact('faqs'));
		if(!empty($this->data))
		{
			//echo "<pre>";print_r($this->data);die;
			$this->BusinessType->id=$faq_id;
			if($this->BusinessType->save($this->data))
			{
				$this->Session->write('success','Business type has been updated successfully.');
				$this->redirect(array('action'=>'admin_business_types'));
			}
		}
	}
	
	function admin_update_business_types($id=NULL)
	{		
		$ctr_id = convert_uudecode(base64_decode($id));
		$old_data = $this->BusinessType->read('active',$ctr_id);
		if($old_data['BusinessType']['active']=="Yes")
		{
			if($this->BusinessType->updateAll(array('BusinessType.active'=>"'No'"),array('BusinessType.id'=>$ctr_id)))
			{
				$this->Session->write('success','Business type has been deactivated successfully');
				$this->redirect(array('action'=>'admin_business_types'));
			}
		}
		else
		{
			if($this->BusinessType->updateAll(array('BusinessType.active'=>"'Yes'"),array('BusinessType.id'=>$ctr_id)))
			{
				$this->Session->write('success','Business type has been activated successfully');
				$this->redirect(array('action'=>'admin_business_types'));
			}
		}
	}
	
	function admin_checkeditTypeExist($id=NULL)
	{
		//echo $id;die;
		$name = trim($_REQUEST['data']['BusinessType']['name']);
		$this->autoRender = false;
		$count = $this->BusinessType->find('count',array('conditions'=>array('BusinessType.name'=>$name,'BusinessType.id NOT'=>$id)));
		if($count)
		{
			echo "false";die;
		}
		else
		{
			echo "true";die;
		}
		
	}
	function admin_checkaddTypeExist()
	{
		$name=trim($_REQUEST['data']['BusinessType']['name']);
		$this->autoRender = false;
		$count=$this->BusinessType->find('count',array('conditions'=>array('BusinessType.name'=>$name)));
		if($count > 0)
		{
			echo "false";die;
		}
		else
		{
			echo "true";die;
		}
	}
	/*function admin_bill_generation() 
	{

		$this->layout = 'admin';
		$this->loadModel("Invoice");
		$data=$this->Invoice->find('all');
		//pr($data);die;
		$this->set(compact('data'));
	}
	function admin_edit_bill_generation($id=null) 
	{
		$this->layout = 'admin';
		$this->loadModel("Invoice");
		$invoiceId=convert_uudecode(base64_decode($id));
		$this->set('id',$invoiceId);
		$invoices=$this->Invoice->find('first',array('conditions'=>array('Invoice.id'=>$invoiceId)));
		$this->set(compact('invoices'));
		if(!empty($this->data))
		{
			//echo "<pre>";print_r($this->data);die;
			$this->Invoice->id=$invoiceId;
			if($this->Invoice->save($this->data))
			{
				$this->Session->write('success','Bill genration has been updated successfully.');
				$this->redirect(array('action'=>'admin_bill_generation'));
			}
		}
	}
	public function admin_delete_bill_generation($id=null)
	{
		$this->autoRender = false;
		$this->loadModel("Invoice");
	   $invoiceId=convert_uudecode(base64_decode($id));
		if($this->Invoice->delete($invoiceId))
		{
			$this->Session->write('success','Bill generation has been deleted successfully');
			$this->redirect(array('action'=>'admin_bill_generation'));
		}
	}
	function admin_update_bill_generation($id=null) 
	{
		$this->autoRender = false;
		$this->loadModel("Invoice");
	   $invoiceId=convert_uudecode(base64_decode($id));
		$invoiceData = $this->Invoice->read('status',$invoiceId);
		//pr($invoiceData);die;
		if($invoiceData['Invoice']['status']=="Active")
		{
			if($this->Invoice->updateAll(array('Invoice.status'=>"'Inactive'"),array('Invoice.id'=>$invoiceId)))
			{
				$this->Session->write('success','Bill Genration has been deactivated successfully');
				$this->redirect(array('action'=>'admin_bill_generation'));
			}
		}
		else
		{
			if($this->Invoice->updateAll(array('Invoice.status'=>"'active'"),array('Invoice.id'=>$invoiceId)))
			{
				$this->Session->write('success','Bill generation has been activated successfully');
				$this->redirect(array('action'=>'admin_bill_generation'));
			}
		}
	}*/
	/*
		@Reconcile Module Start Here
	*/
	function reconcile($id=Null)
	{
		$this->layout='public';
		$this->loadModel('OrderDealRelation');
		$this->loadModel('MemberMeta');
		$deal_id = convert_uudecode(base64_decode($id));
		$dealerId = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		
		if ($dealerId!="")
		{
			$this->Deal->virtualFields = array('item_count'=>'SELECT count(*) from order_deal_relations as od where od.claim_status="ClaimApproved" AND od.reconcile="Pending" AND od.deal_id='.$deal_id.' AND Deal.member_id='.$dealerId,'total_amount'=>'SELECT sum(sub_total) from order_deal_relations as od where od.claim_status="ClaimApproved" AND od.reconcile="Pending" AND od.deal_id='.$deal_id.' AND Deal.member_id='.$dealerId);
			$deal_info = $this->Deal->findById($deal_id);
			$this->set(compact('deal_info'));
			
			$mem_info = $this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$dealerId),'fields'=>array('id','member_id','supplier%','cybercoupon%')));
			$this->set(compact('mem_info'));
			//pr($mem_info);die;
			$conditions = array();
			
			if ($this->request->is('ajax'))
			{//pr($_POST);die;
				$conditions =array('OrderDealRelation.claim_status'=>'ClaimApproved','Deal.member_id'=>$dealerId,'OrderDealRelation.reconcile'=>'Pending','OrderDealRelation.deal_id'=>$deal_id);
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
			}
			else
			{
				$conditions =array('OrderDealRelation.claim_status'=>'ClaimApproved','Deal.member_id'=>$dealerId,'OrderDealRelation.reconcile'=>'Pending','OrderDealRelation.deal_id'=>$deal_id);
			}
			//pr($conditions);die;
			$this->paginate=array('limit'=>25,'order'=>array('OrderDealRelation.id'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption'));
			$reconcile_list =$this->paginate('OrderDealRelation',$conditions);
			$this->set(compact('reconcile_list'));
			//pr($deal_info);
			//pr($reconcile_list);die;
			if($this->RequestHandler->isAjax())
			{
				$this->layout='';
				$this->autorender=false;
				$this->viewPath='Elements'.DS.'frontend'.DS.'business';
				$this->render('reconcile_element');
			}
		}
		else
		{
			$this->redirect(array('controller'=>'Homes','action'=>'index'));
		}
	}
	
	function admin_reconcile_deal($id = Null)
	{
		$this->layout = 'admin';
		$this->loadModel('Deal');
		$this->loadModel('MemberMeta');
		$supplier_id = convert_uudecode(base64_decode($id));
		$this->set(compact('supplier_id'));
		$this->Deal->virtualFields = array('item_count'=>'SELECT count(*) from order_deal_relations as od where od.claim_status="ClaimApproved" AND od.reconcile="Pending" AND od.deal_id= Deal.id AND Deal.member_id='.$supplier_id,'total_amount'=>'SELECT sum(sub_total) from order_deal_relations as od where od.claim_status="ClaimApproved" AND od.reconcile="Pending" AND od.deal_id= Deal.id AND Deal.member_id='.$supplier_id);
		$conditions=array('Deal.member_id'=>$supplier_id);
		//pr($conditions);die;
		$mem_info = $this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$supplier_id),'fields'=>array('id','member_id','supplier%','cybercoupon%')));
		$this->set(compact('mem_info'));
		//$this->paginate=array('order'=>'Deal.id desc','limit'=>4,'contain'=>array('DealCategory','Location'));
		//$mydeal_info=$this->paginate('Deal',$conditions);
		$deal_list = $this->Deal->find('all',array('conditions'=>$conditions,'order'=>'Deal.id desc'));
  	   $this->set('deal_list',$deal_list);
		//pr($deal_list);die;
	}
	function admin_update_status_release_payment($id= Null)
	{
		$this->autoRender = false;
		$this->loadModel('OrderDealRelation');
		$supplier_id = convert_uudecode(base64_decode($id));
		$conditions =array('OrderDealRelation.claim_status'=>'ClaimApproved','Deal.member_id'=>$supplier_id,'OrderDealRelation.reconcile'=>'Pending');
		$order_rel_ids = $this->OrderDealRelation->find('list',array('conditions'=>$conditions,'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
		//pr($order_rel_ids);die;
		if($this->OrderDealRelation->updateAll(array('OrderDealRelation.reconcile'=>"'Completed'"),array('OrderDealRelation.id'=>$order_rel_ids)))
		{
			$this->Session->write('success','Payment has been released.');
			echo "success";die;
		}
		else
		{
			echo "error";die;
		}
		
	}
	
	function reconcile_total() {
		$this->autoRender = false;
		$this->loadModel('OrderDealRelation');
		$this->loadModel('MemberMeta');
		$dealerId = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$this->Deal->virtualFields = array('item_count'=>'SELECT count(*) from order_deal_relations as od inner join  deals as Deal  on od.deal_id = Deal.id  where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_amount'=>'SELECT sum(sub_total) from order_deal_relations as od inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_amount_eft'=>'SELECT sum(od.sub_total) from order_deal_relations as od inner join orders on od.order_id = orders.id AND orders.payment_type = "EFT" inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_amount_payu'=>'SELECT sum(od.sub_total) from order_deal_relations as od inner join orders on od.order_id = orders.id AND orders.payment_type = "PAYU" inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'item_count_req'=>'SELECT count(*) from order_deal_relations as od inner join  deals as Deal  on od.deal_id = Deal.id  where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_amount_req'=>'SELECT sum(sub_total) from order_deal_relations as od inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_amount_req_eft'=>'SELECT sum(od.sub_total) from order_deal_relations as od inner join orders on od.order_id = orders.id AND orders.payment_type = "EFT" inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_amount_req_payu'=>'SELECT sum(od.sub_total) from order_deal_relations as od inner join orders on od.order_id = orders.id AND orders.payment_type = "PAYU" inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_refund_amount'=>'SELECT sum(sub_total) from order_deal_relations as od inner join  deals as Deal  on od.deal_id = Deal.id where od.refund_status="Yes" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_refund_prev_amount'=>'SELECT sum(sub_total) from order_deal_relations as od inner join  deals as Deal  on od.deal_id = Deal.id where od.refund_status="Yes" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId);
		
		$deal_total = $this->Deal->find('first',array('conditions'=>array('Deal.member_id'=>$dealerId),'contain'=>false,'fields'=>array('item_count','total_amount','item_count_req','total_amount_req','total_amount_eft','total_amount_payu','total_amount_req_eft','total_amount_req_payu','total_refund_amount','total_refund_prev_amount')));
		$mem_info = $this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$dealerId),'contain'=>false));
		$this->set(compact('mem_info'));
		$this->set(compact('deal_total'));
		//pr($mem_info);
		//pr($deal_total);
	
		if ($this->RequestHandler->isAjax()) {
				$this->layout='';
				$this->autorender=false;
				$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
				$this->render('reconcile');
			}
			
	}

	function reconcile_all()
	{
		$this->layout='';
		$this->loadModel('OrderDealRelation');
		
		$this->loadModel('Deal');
		$this->loadModel('MemberMeta');
		$this->autoRender=false;
		//$deal_id = convert_uudecode(base64_decode($id));
		$dealerId = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$this->OrderDealRelation->virtualFields = array('surname'=>'select surname from members as m where m.id= Order.member_id','name'=>'select name from members as m where m.id= Order.member_id');
		$conditions =array('OrderDealRelation.claim_status'=>'ClaimApproved','Deal.member_id'=>$dealerId,'OrderDealRelation.reconcile'=>'Requested');
		if ($dealerId!="")
		{
			$this->Deal->virtualFields = array('item_count'=>'SELECT count(*) from order_deal_relations as od inner join  deals as Deal  on od.deal_id = Deal.id  where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId,'total_amount'=>'SELECT sum(sub_total) from order_deal_relations as od inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested"  AND Deal.member_id='.$dealerId);
			$deal_info = $this->Deal->find('first',array('conditions'=>array('Deal.member_id'=>$dealerId),'contain'=>false,'fields'=>array('item_count','total_amount')));
			$this->set(compact('deal_info'));
			
			$mem_info = $this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$dealerId),'fields'=>array('id','member_id','supplier%','cybercoupon%')));
			$this->set(compact('mem_info'));
			$conditions = array();
			
			if ($this->request->is('ajax'))
			{	
				$this->OrderDealRelation->virtualFields = array('uemail'=>'select email from members as m where m.id= Order.member_id','name'=>'select name from members as m where m.id= Order.member_id','surname'=>'select surname from members as m where m.id= Order.member_id','custname'=>'select CONCAT(name," ",surname) from members as m where m.id= Order.member_id','suppname'=>'select CONCAT(name," ",surname) from members as m where m.id= Deal.member_id');
				$conditions =array('OrderDealRelation.claim_status'=>'ClaimApproved','Deal.member_id'=>$dealerId,'OrderDealRelation.reconcile'=>'Requested');
				if (@$_POST['name']!="")
				{ 
					$name = $_POST['name'];
					$conditions = array_merge($conditions,array('OR'=>array('OrderDealRelation.name LIKE'=>'%'.trim($name).'%','OrderDealRelation.surname LIKE'=>'%'.trim($name).'%','OrderDealRelation.custname LIKE'=>'%'.trim($name).'%')));
				}
				if (@$_POST['email']!="")
				{ 
					$email = $_POST['email'];
					$conditions = array_merge($conditions,array('OrderDealRelation.uemail LIKE'=>'%'.trim($email).'%'));
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
			}
			else
			{
				$conditions =array('OrderDealRelation.claim_status'=>'ClaimApproved','Deal.member_id'=>$dealerId,'OrderDealRelation.reconcile'=>'Requested');
			}
			//pr($conditions);die;
			$this->paginate=array('limit'=>4,'order'=>array('OrderDealRelation.id'=>'desc'),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption'));
			$reconcile_list =$this->paginate('OrderDealRelation',$conditions);
			$this->set(compact('reconcile_list'));
			//pr($deal_info);
			//pr($reconcile_list);die;
			if($this->RequestHandler->isAjax())
			{
				$this->layout='';
				$this->autorender=false;
				$this->viewPath='Elements'.DS.'frontend'.DS.'suppliers';
				$this->render('reconcile');
			}
		}
		else
		{
			$this->redirect(array('controller'=>'Homes','action'=>'index'));
		}
	}
	
	function update_status_sent_reconcile()
	{
		$this->autoRender = false;
		$this->loadModel('OrderDealRelation');
		$cur_date = Date('Y-m-d H:i:s');
		$supplier_id = convert_uudecode(base64_decode($this->Session->read('Member.id')));
		$conditions =array('OrderDealRelation.claim_status'=>'ClaimApproved','Deal.member_id'=>$supplier_id,'OrderDealRelation.reconcile'=>'Pending');
		$order_rel_ids = $this->OrderDealRelation->find('list',array('conditions'=>$conditions,'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
		//pr($order_rel_ids);die;
		if($this->OrderDealRelation->updateAll(array('OrderDealRelation.reconcile'=>"'Requested'",'OrderDealRelation.reconcile_sent_on'=>'"'.$cur_date.'"'),array('OrderDealRelation.id'=>$order_rel_ids)))
		{
			echo "success";die;
		}
		else
		{
			echo "error";die;
		}
		
	}
	
	function admin_reconcilation($id = Null)
	{
		$this->layout = 'admin';
		$this->loadModel('Deal');
		$this->loadModel('OrderDealRelation');
		$this->loadModel('MemberMeta');
		$this->loadModel('PaymentHistory');
		$supplier_id = convert_uudecode(base64_decode($id));
		$this->set(compact('supplier_id'));
		$this->Session->delete('payment_upto');
		if (!empty($this->data)) {
			$paid_on = date('Y-m-d H:i:s',strtotime($this->data['OrderDealRelation']['payment_on'].' 23:59:59'));
			$this->Session->write('payment_upto',$paid_on);
			$supplier_id = convert_uudecode(base64_decode($this->data['Deal']['member_id']));
			$conditions=array('Order.supplier_id'=>$supplier_id,'Order.order_status' => "success", 'Order.delete_status !='=>"Admin-del",'OrderDealRelation.reconcile'=>'Requested','OrderDealRelation.refund_status'=>'No','Order.payment_date <='=>$paid_on);
		} else {
			$conditions=array('Order.supplier_id'=>$supplier_id,'Order.order_status' => "success", 'Order.delete_status !='=>"Admin-del",'OrderDealRelation.reconcile'=>'Requested','OrderDealRelation.refund_status'=>'No');
		}
		
		$mem_name = $this->Member->find('first',array('conditions'=>array('Member.id'=>$supplier_id),'fields'=>array('id','name','surname'),'contain'=>array()));
		$this->set(compact('mem_name'));
		
		$mem_info = $this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$supplier_id),'fields'=>array('id','member_id','supplier%','cybercoupon%')));
		$this->set(compact('mem_info'));
		
		$pay_his = $this->PaymentHistory->find('first',array('conditions'=>array('PaymentHistory.member_id'=>$supplier_id),'order'=>array('PaymentHistory.id desc')));
		$this->set(compact('pay_his'));
		
		$deal_list = $this->OrderDealRelation->find('all',array('conditions'=>$conditions,'order'=>'Deal.id desc','contain'=>array('Deal'=>array('DealCategory'),'Order'=>array('Member'))));
		//pr($conditions);
		//pr($deal_list);die;
		$this->set('deal_list',$deal_list);	
		if($this->RequestHandler->isAjax())
		{
			$this->layout='';
			$this->autorender=false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Business';
			$this->render('reconcile_deal_list');
		}
		//pr($pay_his);die;	
	}
	function admin_update_status_reconcile_payment()
	{
		$this->autoRender = false;
		$this->loadModel('OrderDealRelation');
		$this->loadModel('PaymentHistory');
		$this->loadModel('MemberMeta');
		
		$data1 = array();
		$member_search_ids = $this->Session->read('member_search_idz');
		if(!empty($_POST['each_user'])):
			$member_search_ids = $_POST['each_user'];
		endif;	
		$this->PaymentRelease->create();
		$paydata['PaymentRelease']['payment_date'] = Date('Y-m-d H:i:s');
		$this->PaymentRelease->save($paydata);
		$last_id=$this->PaymentRelease->getLastInsertId();
		foreach ($member_search_ids as $supplier_id) 
		{
			$this->Member->virtualFields = array('amount_received_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE  orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_payable_to_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_claimed_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile =  "Requested" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',												
												'payment_upto'=>'SELECT payment_date from orders where orders.supplier_id = Member.id group by Member.id',
												'total_supplier_history_amount'=>'SELECT sum(supplier_amount) FROM payment_histories ph  where ph.member_id = Member.id '
											);
			$mem_info = $this->Member->find('first',array('conditions'=>array('Member.id'=>$supplier_id),'fields'=>array('Member.id','Member.name','Member.email','amount_received_from_supplier','amount_payable_to_supplier','amount_claimed_from_supplier','MemberMeta.supplier%')));
			$paid_on =$this->Session->read('payment_upto');
			if ($paid_on !="") {
				$conditions =array('Order.supplier_id'=>$supplier_id,'Order.order_status' => "success", 'Order.delete_status !='=>"Admin-del",'Order.payment_date <='=>$paid_on);
			} else {
				$conditions =array('Order.supplier_id'=>$supplier_id,'Order.order_status' => "success", 'Order.delete_status !='=>"Admin-del");
			}
			$id_str = '';
			$order_rel_ids = $this->OrderDealRelation->find('list',array('conditions'=>$conditions,'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member'),'DealOption')));
			if(!empty($order_rel_ids)) :
				$id_str = implode(',',$order_rel_ids);
			endif;
			if($this->OrderDealRelation->updateAll(array('OrderDealRelation.reconcile'=>"'Completed'"),array('OrderDealRelation.id'=>$order_rel_ids)))
			{
				if($mem_info['Member']['amount_claimed_from_supplier'] > 0) :
				
				$this->PaymentHistory->create();
				$data1['PaymentHistory']['member_id'] = $supplier_id;
				$data1['PaymentHistory']['payment_release_id'] = $last_id;
				$data1['PaymentHistory']['total'] = (($mem_info['Member']['amount_payable_to_supplier']*$mem_info['MemberMeta']['supplier%'])/100);
				$data1['PaymentHistory']['supplier_amount'] = (($mem_info['Member']['amount_claimed_from_supplier']*$mem_info['MemberMeta']['supplier%'])/100);
				$data1['PaymentHistory']['order_relation_id'] = $id_str;
				$data1['PaymentHistory']['date'] = Date('Y-m-d H:i:s');
				if ($paid_on !="") {
					$data1['PaymentHistory']['payment_upto'] = $paid_on;
				} else {
					$data1['PaymentHistory']['payment_upto'] = Date('Y-m-d H:i:s');
				}
				$data1['PaymentHistory']['supplier_percent'] = @$mem_info['MemberMeta']['supplier%'];
				$this->PaymentHistory->save($data1);
				$this->Session->write('success','Payment has been released.');
				$this->loadModel('EmailTemplate');
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'payment_report')));
				$common_template= $emailTemp1['EmailTemplate']['description'];
				$total_amt = $data1['PaymentHistory']['supplier_amount'];
				$name = $mem_info['Member']['name'];
				$common_template = str_replace('{name}',$name,$common_template);
				$common_template = str_replace('{total_amount}',$total_amt,$common_template);
				$emailto=$mem_info['Member']['email'];	
				$emailfrom=$emailTemp1['EmailTemplate']['from'];	
				$email = new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$common_template));
				$email->to($emailto);
				$email->from($emailfrom);
				$email->subject($emailTemp1['EmailTemplate']['subject']);  
				$email->send();
				
				endif;
				
			}
			else
			{
				echo "error";die;
			}
			
		}
		die;
	}
	
	function admin_payment_history($id = Null) {
		$this->layout = 'admin';
		$this->loadModel('PaymentHistory');
		$deal_rel_id = array();
		$dealerId = convert_uudecode(base64_decode($id));
		$this->set(compact('dealerId'));
		
		$mem_info = $this->Member->find('first',array('conditions'=>array('Member.id'=>$dealerId),'fields'=>array('Member.id','MemberMeta.company_name','Member.name','Member.surname','Member.email'),'contain'=>array('MemberMeta')));
		$this->set(compact('mem_info'));
		$payment=$this->PaymentHistory->find('all',array('conditions'=>array('PaymentHistory.member_id'=>$dealerId),'order'=>array('PaymentHistory.id desc'),'contain'=>array('Member'=>array('MemberMeta'=>array('id','company_name')),'PaymentRelease')));
		$this->set(compact('payment','dealerId'));
		//pr($payment);die;
	}
	
	function admin_view_payment_detail($id = Null, $supplierId = Null) {
		$this->layout = 'admin';
		$this->loadModel('PaymentHistory');
		$this->loadModel('MemberMeta');
		$this->loadModel('OrderDealRelation');
		$payment_his_id = convert_uudecode(base64_decode($id));
		$dealerId = convert_uudecode(base64_decode($supplierId));
		
		if ($dealerId!="") {
			$mem_info = $this->MemberMeta->find('first',array('conditions'=>array('MemberMeta.member_id'=>$dealerId),'fields'=>array('id','member_id','supplier%','cybercoupon%')));
			$this->set(compact('mem_info'));
			$history = $this->PaymentHistory->find('first',array('conditions'=>array('PaymentHistory.id'=>$payment_his_id),'contain'=>array('Member'=>array('MemberMeta'=>array('id','company_name')),'PaymentRelease')));
			//pr($history);die;
			
			$deal_rel_id = explode(',',$history['PaymentHistory']['order_relation_id']);
			$reconcile_list = $this->OrderDealRelation->find('all',array('conditions'=>array('OrderDealRelation.id'=>$deal_rel_id),'contain'=>array('Order'=>array('Member'),'Deal'=>array('Member','DealCategory'),'DealOption')));
			$this->set(compact('reconcile_list'));
			$this->set(compact('history'));
			
			$history_new = $this->PaymentHistory->find('all',array('conditions'=>array('PaymentHistory.id'=>$payment_his_id),'contain'=>array('Member'=>array('MemberMeta'=>array('id','company_name')),'PaymentRelease')));
			$this->set(compact('history_new'));
			//pr($history_new);die;
		} else {
			$this->redirect(array('controller'=>'auths','action'=>'dashboard','admin'=>true));
		}
	}
	
	function admin_view_payment_history ($id = NULL) {
	
		$this->layout = 'admin';
		$this->loadModel('PaymentHistory');
		$payment_release_id = convert_uudecode(base64_decode($id));
		$conditions = array('PaymentHistory.payment_release_id'=>$payment_release_id);
		$this->PaymentHistory->virtualFields = array('company_name'=>'SELECT company_name from member_metas mm where mm.member_id = Member.id');
		if (!empty($this->request->data)) {
			$names = trim($_POST['data']['Member']['name']);
			$emails = trim($_POST['data']['Member']['email']);
			if ($names!= "") {
				$conditions = array_merge($conditions,array('PaymentHistory.company_name LIKE'=>'%'.trim($names).'%'));
			}
			if ($emails!= "") {
				$conditions = array_merge($conditions,array('Member.email LIKE'=>'%'.trim($emails).'%'));
			}
		}
		if(!empty($names) || !empty($emails)) {
		
			$history = $this->PaymentHistory->find('all',array('conditions'=>$conditions));
			$this->Session->write('export_con',$conditions);
		}
		else {
				$history = $this->PaymentHistory->find('all',array('conditions'=>$conditions));
				$this->Session->write('export_con',$conditions);
		}
		//pr($history);die;
		$this->set(compact('history','payment_release_id'));
		if ($this->RequestHandler->isAjax()) {
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Business';
			$this->render('view_payment_history');
		}
		
	}
	
	function admin_history_generate_csv() {	
	   $conditions = $this->Session->read('export_con');
		$this->layout = "admin";
		$this->autoRender = false;
		Configure::write('debug', 2);
		$data ="Name ,Email,Total Amount,Total Amount Supplier,Total Amount Cyber Coupon\n";		
		$this->PaymentHistory->virtualFields = array('company_name'=>'SELECT company_name from member_metas mm where mm.member_id = Member.id');
		$allPayments=$this->PaymentHistory->find('all',array('conditions'=>$conditions));
		foreach ($allPayments as $payment) {	
			$data .= $payment['PaymentHistory']['company_name'].",";
			$data .= $payment['Member']['email'].",";
			$data .= $payment['PaymentHistory']['total'].",";
			$data .= $payment['PaymentHistory']['supplier_amount'].",";
			$data .= $payment['PaymentHistory']['total']-($payment['PaymentHistory']['supplier_amount']).",";
			$data .= "\n";	
		}
		$this->Session->delete('export_con');
		header("Content-Type: application/csv");			
		$csv_filename = 'Payment_History_list_'.date("Y-m-d_H-i",time()).'.csv';
		header("Content-Disposition:attachment;filename=".$csv_filename);
		$fd = fopen ($csv_filename, "w");
		fputs($fd,$data);
		fclose($fd);
		echo $data;
		die();		
	}
	
	
	function admin_supplier_pdf($supplierId = NULL)
	{
		$this->autoRender = false;
		$member_id= convert_uudecode(base64_decode($supplierId));
		$payment=$this->PaymentHistory->find('all',array('conditions'=>array('PaymentHistory.member_id'=>$member_id),'order'=>array('PaymentHistory.id desc'),'contain'=>array('Member'=>array('MemberMeta'=>array('id','company_name')),'PaymentRelease')));
		//pr($payment);die;
		Configure::write('debug',0);

		App::import('Vendor', 'tcpdf',array('file' => 'tcpdf/tcpdf.php'));

		$time = time();

		$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

		$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$tcpdf->setPrintFooter(false);

		$tcpdf->setPrintHeader(false);

		$tcpdf->SetAutoPageBreak(true);
		/*-------------------------- Pdf Page START ------------------------------*/

		$tcpdf->AddPage();

		$html = '<table style="width:100%;border:4px solid #68ac1c;padding:5px;" >
	<tr>
		<td>
			<table cellspacing="0" cellpadding="10">
				<tr>
					<td width="45%" style="text-align:center;">
						<img src="'.HTTP_ROOT.'img/frontend/logo2.jpg" />					
					</td>
					<td  width="55%" style="text-align:center;height:30px; line-height:30px;">
						<p style="font-size:1.9em; margin-top:20px;">Invoice Slip </p>
					</td>
				</tr>
			</table>	
				<table  border="1" cellspacing="0" cellpadding="10" style="border-collapse:collapse;text-align: center;font-size:11px;">
				<tr>
					<th style="background-color:#E6E6E6;">Supplier Amount</th>
					<th style="background-color:#E6E6E6;">Payment Release Date</th>
					<th style="background-color:#E6E6E6;">Company Name</th>
					
				</tr>';
		foreach($payment as $data) {	
			$html.='	
				<tr>
					<td>'.$data['PaymentHistory']['supplier_amount'].'</td>
					<td>'.date('d M Y',strtotime($data['PaymentHistory']['date'])).'</td>
					<td>'.$data['Member']['MemberMeta']['company_name'].'</td>
					
				</tr>';
			}	
		$html.= '</table>
				
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

		$pdfName =  'cybercoupon_paymenthistory_'.$this->random_string1('alnum',5).'.pdf';
		//$pdf = $tcpdf->Output('../webroot/invoicepdf/'.$pdfName, 'F');
		$tcpdf->Output($pdfName, 'F');
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="'.$pdfName.'"');
		readfile($pdfName);
		die();
	}
	
	function admin_sendPdfEmail () {

		//pr($_FILES["paymenthistory_pdf"]);pr($_POST);die;
		if(!empty($_FILES["paymenthistory_pdf"]) && !empty($_POST))
		{
			$destLarge = $_FILES["paymenthistory_pdf"]["tmp_name"];
			$pdfTitle = $destLarge;
			$name = trim($_POST['supplierName']);
			$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'payment_history')));
			$common_template= $emailTemp1['EmailTemplate']['description'];
			$common_template = str_replace('{name}',$name,$common_template);
			$email = new CakeEmail();
			$email->template('common_template');
			$email->emailFormat('both');
			$email->viewVars(array('common_template'=>$common_template));       
			$email->to(trim($_POST['email']));
			$email->from($emailTemp1['EmailTemplate']['from']);
			$email->subject($emailTemp1['EmailTemplate']['subject']);                             
			$email->attachments($pdfTitle);
			//$email->send();	
			if($email->send())
			{
				if(!empty($_POST['otherEmail']) && $_POST['otherEmail'] !="")
				{
					$email->to(trim($_POST['otherEmail']));
					$email->send();
				}
				$this->Session->write('success','Mail Has been sent Successfully!!');
			}
			$this->redirect($this->referer());	
		}
		else
		{
		   echo "An error occured";
		   die;	
		}
	}
	
	
	function sales_redeem($deal_id=NULL)
	{
		$this->layout='public';
		$this->set('deal_id',$deal_id);
	}
} 
?>