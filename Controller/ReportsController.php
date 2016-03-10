<?php 

ob_start();
class ReportsController extends AppController {   

	var $helper=array('Html','Form','Js','Session','Tool','Manip','Common');

	var $components = array('RequestHandler','Cookie','Session','Email');

	var $uses=array('DealCategory','Deal','Member','PaymentRelease','PaymentHistory','EmailTemplate','Order','OrderDealRelation');


	public function admin_reports() {

		$this->layout = 'admin';
		$conditions = array();
		/*$this->Member->virtualFields = array('totals'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile =  "Requested" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'total_amount_eft'=>'SELECT sum(od.sub_total) from order_deal_relations as od inner join orders on od.order_id = orders.id AND orders.payment_type = "EFT" inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested" AND od.refund_status="No"  AND Deal.member_id= Member.id',
												'total_amount_payu'=>'SELECT sum(od.sub_total) from order_deal_relations as od inner join orders on od.order_id = orders.id AND orders.payment_type = "PAYU" inner join  deals as Deal  on od.deal_id = Deal.id where od.claim_status="ClaimApproved" AND od.reconcile="Requested" AND od.refund_status="No" AND Deal.member_id= Member.id',
												'payment_upto'=>'SELECT payment_date from orders where orders.supplier_id = Member.id group by Member.id',
												'initial_date'=>'SELECT min(orders.payment_date) FROM orders inner join order_deal_relations on orders.id=order_deal_relations.order_id AND orders.order_status="success" AND orders.delete_status="All" inner join deals on order_deal_relations.deal_id=deals.id group by deals.member_id having deals.member_id= Member.id',
												'total_supplier_history_amount'=>'SELECT sum(supplier_amount) FROM payment_histories ph  where ph.member_id = Member.id '
											);*/
		$this->Member->virtualFields = array('amount_received_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE  od.reconcile !="Completed" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_payable_to_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile !="Completed" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_claimed_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile =  "Requested" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',												
												'payment_upto'=>'SELECT payment_date from orders where orders.supplier_id = Member.id group by Member.id',
												'total_supplier_history_amount'=>'SELECT sum(supplier_amount) FROM payment_histories ph  where ph.member_id = Member.id '
											);
		if (!empty($this->request->data))
		{
			$names = trim($_POST['data']['Member']['name']);
			$emails = trim($_POST['data']['Member']['email']);
			$payment_on = trim($_POST['data']['OrderDealRelation']['payment_on']);
			if ($names!= "") 
			{
				$conditions = array_merge($conditions,array('MemberMeta.company_name LIKE'=>'%'.trim($names).'%'));
			}
			if ($emails!= "")
			{
				$conditions = array_merge($conditions,array('Member.email LIKE'=>'%'.trim($emails).'%'));
			}
			$this->Session->delete('payment_upto');
			if (!empty($payment_on) && $payment_on!= "") 
			{
				$paid_on = date('Y-m-d',strtotime($this->data['OrderDealRelation']['payment_on']));
				$paid_on= $paid_on." 23:59:59";			
				$this->Session->write('payment_upto',$paid_on);
				$conditions = array_merge($conditions,array('Member.payment_upto <='=>$paid_on));
			}
		}
		//echo '<pre>';print_r($conditions);die;
		$this->Session->delete('member_search_idz');
		if (!empty($conditions) || @$paid_on!="") 
		{ 
			$conditions = array_merge($conditions,array('Member.member_type'=>3,'Member.status'=>'Active','Member.amount_payable_to_supplier >'=>0)); 
			$member = $this->Member->find('all',array('order'=>array('Member.id desc'),'conditions'=>$conditions,'contain'=>array('MemberMeta','Order')));
			$this->Session->write('export',$conditions);
		}
		else 
		{	
			$conditions = array_merge($conditions,array('Member.member_type'=>3,'Member.status'=>'Active','Member.amount_payable_to_supplier >'=>0));
			$member=$this->Member->find('all',array('order'=>array('Member.id desc'),'conditions'=>$conditions,'contain'=>array('MemberMeta','Order')));
			$this->Session->write('export',$conditions);   
		}
		//pr($member);die;
		$amount_received_from_supplier = 0.00;
		$amount_payable_to_supplier = 0.00;
		$amount_claimed_from_supplier = 0.00;
		if(!empty($member)) :
			foreach ($member as $mems) 
			{
				$memidz_array[] = $mems['Member']['id'];
			}
			foreach($member as $data):	
				$amount_received_from_supplier += (@$data['Member']['amount_received_from_supplier']!=0)?$data['Member']['amount_received_from_supplier']:'0'; 
				$amount_payable_to_supplier += (@$data['Member']['amount_payable_to_supplier']!=0)?($data['Member']['amount_payable_to_supplier']*$data['MemberMeta']['supplier%'])/100:'0'; 
				$amount_claimed_from_supplier += (@$data['Member']['amount_claimed_from_supplier']!=0)?($data['Member']['amount_claimed_from_supplier']*$data['MemberMeta']['supplier%'])/100:'0'; 
		
			endforeach;
			$this->Session->write('member_search_idz',$memidz_array);

		endif;
		//echo $amount_received_from_supplier;echo $amount_payable_to_supplier;echo $amount_claimed_from_supplier;die;
		$this->set(compact('member','amount_received_from_supplier','amount_payable_to_supplier','amount_claimed_from_supplier'));

		$pay_his = $this->PaymentRelease->find('first',array('order'=>array('PaymentRelease.id desc')));
		//pr($pay_his);die;
		$this->set('pay_his',$pay_his);

		

		if ($this->RequestHandler->isAjax()) {

			$this->layout = '';

			$this->autoRender = false;

			$this->viewPath='Elements'.DS.'backend'.DS.'Reports';

			$this->render('reports_list');

		}

	}
	
	function admin_generate_csv_check($member_type=null) 
	{	
	   $conditions = $this->Session->read('export');
		$this->layout = "admin";
		$this->autoRender = false;
		$this->loadModel('Member');
		Configure::write('debug', 2);
		$this->Member->virtualFields = array('amount_received_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE  od.reconcile !="Completed" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_payable_to_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile !="Completed" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_claimed_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile =  "Requested" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',												
												'payment_upto'=>'SELECT payment_date from orders where orders.supplier_id = Member.id group by Member.id',
												'total_supplier_history_amount'=>'SELECT sum(supplier_amount) FROM payment_histories ph  where ph.member_id = Member.id '
											);

		
		$allPayments=$this->Member->find('all',array('conditions'=>$conditions,'order'=>array('Member.id desc')));
		if(!empty($allPayments))
			echo "success";
		else
			echo "failed";
		die;
	}

	function admin_generate_csv($member_type=null) {	

	   $conditions = $this->Session->read('export');

		//pr($conditions);die;

		$this->layout = "admin";

		$this->autoRender = false;

		$this->loadModel('Member');

		Configure::write('debug', 2);
		$this->Member->virtualFields = array('amount_received_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE  od.reconcile !="Completed" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_payable_to_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile !="Completed" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',
												'amount_claimed_from_supplier'=>'SELECT SUM( od.sub_total ) FROM order_deal_relations AS od INNER JOIN orders ON od.order_id = orders.id WHERE od.reconcile =  "Requested" AND od.refund_status =  "No" AND orders.order_status =  "success" AND orders.delete_status !=  "Admin-del" AND orders.supplier_id =Member.id',												
												'payment_upto'=>'SELECT payment_date from orders where orders.supplier_id = Member.id group by Member.id',
												'total_supplier_history_amount'=>'SELECT sum(supplier_amount) FROM payment_histories ph  where ph.member_id = Member.id '
											);

		$data ="Name ,Email, Amount Received From Supplier,Amount Payable To Supplier,Amount Claimed by Supplier,Account Name,Bank Name,Branch code,Account  No.\n";		
		$allPayments=$this->Member->find('all',array('conditions'=>$conditions,'order'=>array('Member.id desc')));
		foreach ($allPayments as $payment) {
			$amount_received_from_supplier= (@$payment['Member']['amount_received_from_supplier']!=0)?$payment['Member']['amount_received_from_supplier']:'0'; 
			$amount_payable_to_supplier= (@$payment['Member']['amount_payable_to_supplier']!=0)?($payment['Member']['amount_payable_to_supplier']*$payment['MemberMeta']['supplier%'])/100:'0'; 
			$amount_claimed_from_supplier=(@$payment['Member']['amount_claimed_from_supplier']!=0)?($payment['Member']['amount_claimed_from_supplier']*$payment['MemberMeta']['supplier%'])/100:'0'; 
			if(!empty($payment['MemberMeta']['account_holder']) && $payment['MemberMeta']['account_holder'] != '')
			{
				$account_holder = $payment['MemberMeta']['account_holder'];
			}
			else
			{
				$account_holder = 'N/A';
			}
			if(!empty($payment['MemberMeta']['bank_name']) && $payment['MemberMeta']['bank_name'] != '')
			{
				$bank_name = $payment['MemberMeta']['bank_name'];
			}
			else
			{
				$bank_name = 'N/A';
			}
			if(!empty($payment['MemberMeta']['branch_code']) && $payment['MemberMeta']['branch_code'] != '')
			{
				$branch_code = $payment['MemberMeta']['branch_code'];
			}
			else
			{
				$branch_code = 'N/A';
			}
			if(!empty($payment['MemberMeta']['account_number']) && $payment['MemberMeta']['account_number'] != '')
			{
				$account_number = $payment['MemberMeta']['account_number'];
			}
			else
			{
				$account_number = 'N/A';
			}
			$data .= $payment['MemberMeta']['company_name'].",";

			$data .= $payment['Member']['email'].",";
			$data .= round(($amount_received_from_supplier>0)?$amount_received_from_supplier:'0',2).",";

			$data .= round(($amount_payable_to_supplier>0)?$amount_payable_to_supplier:'0',2).",";

			$data .= round(($amount_claimed_from_supplier>0)?$amount_claimed_from_supplier:'0',2).",";
			
			$data .= $account_holder.",";
			$data .= $bank_name.",";
			$data .= $branch_code.",";
			$data .= $account_number.",";

			$data .= "\n";	

		}
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

	

	function admin_viewPayHistory() 
	{
		$this->layout = "admin";		
		if (!empty($this->request->data))  
		{
			//pr($this->data);die;
			$conditions = array();	
			$pay_from = @$_POST['data']['PaymentRelease']['payment_from'];
			$pay_to = @$_POST['data']['PaymentRelease']['payment_to'];
			//pr($pay_from);
			//pr($pay_from);
			if(trim( $pay_from)!="") {
			    $pay_from = date('Y-m-d',strtotime($pay_from));
				$pay_from = $pay_from.' 23:59:59';
				$conditions=array_merge($conditions,array('PaymentRelease.payment_date >= ' =>$pay_from));
			}
			if(trim( $pay_to)!="") {
			    $pay_to = date('Y-m-d',strtotime($pay_to));
				$pay_to = $pay_to.' 23:59:59';
				$conditions=array_merge($conditions,array('PaymentRelease.payment_date <= ' =>$pay_to));
			}
			
			//pr($conditions);		die;
			//$conditions = array_merge($conditions,array('PaymentRelease.payment_date LIKE' => '%'.$keyword.'%'));				
			$this->PaymentRelease->virtualFields = array('total_amt'=>'SELECT SUM(total) as total_amt from payment_histories mm group by payment_release_id Having mm.payment_release_id = PaymentRelease.id');
			$history_detail = $this->PaymentRelease->find('all',array('conditions'=>$conditions,'order'=>array('PaymentRelease.id desc')));
			$this->set(compact('history_detail'));
			$this->Session->write('payment',$conditions);
			
		}
		else
		{
			$this->PaymentRelease->virtualFields = array('total_amt'=>'SELECT SUM(total) as total_amt from payment_histories mm group by payment_release_id Having mm.payment_release_id = PaymentRelease.id');
			$history_detail = $this->PaymentRelease->find('all',array('Order'=>array('PaymentRelease.payment_date desc')));
			//pr($history_detail);die;
			$this->set(compact('history_detail'));			
		}
		if ($this->RequestHandler->isAjax()) {
			$this->layout = '';
			$this->autoRender = false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Reports';
			$this->render('history_lists');
		}
	}
	function  admin_payHistoryCsv () 
	{
		$conditions = $this->Session->read('payment');
		$this->layout = "admin";
		$this->autoRender = false;
		Configure::write('debug', 2);
		$this->PaymentRelease->virtualFields = array('total_amt'=>'SELECT SUM(total) as total_amt from payment_histories mm group by payment_release_id Having mm.payment_release_id = PaymentRelease.id');
		$data ="Payment Release Date, Total Amount ,Status\n";
		$history_detail = $this->PaymentRelease->find('all',array('conditions'=>$conditions));
		foreach ($history_detail as $payment) {	
			if($payment['PaymentRelease']['status'] == 1) 
			{ 
				$status = "Complete"; 
			} 
			else 
			{ 
				$status = "Pending"; 
			}
			//$i = 1;
			//$data .= $i.",";
			$data .= date('d F Y',strtotime($payment['PaymentRelease']['payment_date'])).",";
			$data .= $payment['PaymentRelease']['total_amt'].",";
			$data .= $status.",";
			$data .= "\n";
			//$i++;
		}
		$this->Session->delete('payment');
		header("Content-Type: application/csv");	
		$csv_filename = 'Payment_history_'.date("Y-m-d_H-i",time()).'.csv';
		header("Content-Disposition:attachment;filename=".$csv_filename);
		$fd = fopen ($csv_filename, "w");
		fputs($fd,$data);
		fclose($fd);
		echo $data;
		die();	
	}

	function admin_customerPaymentReport () {		

		$this->layout = "admin";
		$conditions = array('Member.member_type'=>4,'Member.status'=>'active');
		$where='';

		if(!empty($this->data['Order']['payment_from']))

		{		

		    $startdate = trim(date('Y-m-d',strtotime($this->data['Order']['payment_from'])));

			$startdate = $startdate." 00:00:00";

			$where.=" AND od.payment_date >= '".$startdate."'";

		}

		if(!empty($this->data['Order']['payment_to']))

		{

		    $enddate =  trim(date('Y-m-d',strtotime($this->data['Order']['payment_to'])));

			$enddate = $enddate." 23:59:59";

		    $where.=" AND od.payment_date <= '".$enddate."'";

		}

		$this->Member->virtualFields = array('totals'=>'SELECT sum(od.sub_total) from orders as od  inner join order_deal_relations on od.id = order_deal_relations.order_id where od.order_status="success" '.$where. ' AND order_deal_relations.refund_status = "No" AND od.member_id= Member.id');

		if (!empty($this->request->data)) {

			$names = trim($_POST['data']['Member']['name']);

			$emails = trim($_POST['data']['Member']['email']);

			if ($names!= "") {

				$conditions = array_merge($conditions,array('OR'=>

													array(

													'Member.name LIKE'=>'%'.trim($names).'%',

													'Member.surname LIKE'=>'%'.trim($names).'%',

													)));

			}

			if ($emails!= "") {

				$conditions = array_merge($conditions,array('Member.email LIKE'=>'%'.trim($emails).'%'));

			}

		

		}

		$allPayments=$this->Member->find('all',array('conditions'=>$conditions,'order'=>array('Member.id desc'),'fields'=>array('Member.id','Member.name','Member.surname','Member.email','Member.totals',),'contain'=>array('MemberMeta','Order'=>array('OrderDealRelation'=>'Deal'))));

		

		$allPayments = Set::sort($allPayments, '{n}.Member.totals', 'desc');

		$this->set(compact('allPayments'));

		

		if ($this->RequestHandler->isAjax()) {

			$this->layout = '';

			$this->autoRender = false;

			$this->viewPath='Elements'.DS.'backend'.DS.'Reports';

			$this->render('customer_report_list');

		}

	}

	

	function admin_viewCustomerPaymentdetail ($id = NULL)

	{

		$this->layout = "admin";
		$member_id= convert_uudecode(base64_decode($id));

		$conditions=array('Order.member_id'=>$member_id,'Order.order_status'=> 'success','OrderDealRelation.refund_status'=>'No');

		$this->OrderDealRelation->virtualFields = array('customerName'=>'SELECT name from members where members.status = "Active" AND members.member_type = 4 AND members.id = '.$member_id,'email'=>'SELECT email from members where members.status = "Active" AND members.member_type = 4 AND members.id = '.$member_id,'deal_name'=>'SELECT option_title from deal_options as do where do.id = OrderDealRelation.deal_option_id');
		$order_info=$this->OrderDealRelation->find('all',array('conditions'=>$conditions,'order'=>'OrderDealRelation.id desc','contain'=>array('Order','Deal'=>array('DealOption','Member'))));
		$this->set('order_info',$order_info);
		$this->set('member_id',$member_id);

	}


	function admin_customer_pdf($customerId = NULL)
	{
		$this->autoRender = false;

		$member_id= convert_uudecode(base64_decode($customerId));

		$conditions=array('Order.member_id'=>$member_id,'Order.order_status'=> 'success','OrderDealRelation.refund_status'=>'No');

		$this->OrderDealRelation->virtualFields = array('email'=>'SELECT email from members where members.status = "Active" AND members.member_type = 4 AND members.id = '.$member_id,'name'=>'SELECT name from members where members.status = "Active" AND members.member_type = 4 AND members.id = '.$member_id,'deal_name'=>'SELECT option_title from deal_options as do where do.id = OrderDealRelation.deal_option_id');

		$order_info=$this->OrderDealRelation->find('all',array('conditions'=>$conditions,'order'=>'OrderDealRelation.id desc','contain'=>array('Order','Deal'=>array('DealOption','Member'))));
		//pr($order_info);die;
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
					<th style="background-color:#E6E6E6;">Order No.</th>
					<th style="background-color:#E6E6E6;">Deal Name</th>
					<th style="background-color:#E6E6E6;">Supplier Name</th>
					<th style="background-color:#E6E6E6;">Date</th>
					<th style="background-color:#E6E6E6;">Payment Type</th>
					<th style="background-color:#E6E6E6;">Total Amount</th>
				</tr>';
		foreach($order_info as $data) {	
			$html.='	
				<tr>
					<td>'.$data["Order"]["order_no"].'</td>
					<td>'.$data["OrderDealRelation"]["deal_name"].'</td>
					<td>'.$data["Deal"]["Member"]["name"].' ' .$data["Deal"]["Member"]["surname"].'</td>
					<td>'.$data["Order"]["payment_date"].'</td>
					<td>'.$data["Order"]["payment_type"].' </td>
					<td>'.$data["Order"]["sub_total"].' </td>
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

	

		$pdfName =  'cybercoupon_invoiceslip_'.$this->random_string1('alnum',5).'.pdf';
		//$pdf = $tcpdf->Output('../webroot/invoicepdf/'.$pdfName, 'F');
		$tcpdf->Output($pdfName, 'F');
		//$file = HTTP_ROOT.'pdf/label/'.$pdfName;  // path of pdf
		//return  $file;
		
		/*************Send Customer to Mail *************/
		/*if(!empty($order_info)) :
		$destLarge = realpath('../../app/webroot/') .$pdfName;
		$pdfTitle = $destLarge;
		$name = trim($order_info[0]['OrderDealRelation']['name']);
		$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'invoice_slip')));
		$common_template= $emailTemp1['EmailTemplate']['description'];
		$common_template = str_replace('{name}',$name,$common_template);
		$email = new CakeEmail();
		$email->template('common_template');
		$email->emailFormat('both');
		$email->viewVars(array('common_template'=>$common_template));       
		$email->to(trim($order_info[0]['OrderDealRelation']['email']));
		$email->from($emailTemp1['EmailTemplate']['from']);
		$email->subject($emailTemp1['EmailTemplate']['subject']);                             
		$email->attachments($pdfTitle);
		if($email->send())
		{
			$this->Session->write('success','Mail Has been sent Successfully!!');
		}
		$this->redirect($this->referer());	
		die();
		endif;*/
		
		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="'.$pdfName.'"');
		readfile($pdfName);
		/*************End Mail***********/
	}
	
	function admin_sendPdfEmail () {

		//pr($_FILES["invoice_pdf"]);pr($_POST);die;
		if(!empty($_FILES["invoice_pdf"]) && !empty($_POST)) :
			$destLarge = $_FILES["invoice_pdf"]["tmp_name"];
			$pdfTitle = $destLarge;
			$name = $_POST['custName'];
			$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'invoice_slip')));
			$common_template= $emailTemp1['EmailTemplate']['description'];
			$common_template = str_replace('{name}',$name,$common_template);
			$email = new CakeEmail();
			$email->template('common_template');
			$email->emailFormat('both');
			$email->viewVars(array('common_template'=>$common_template));       
			$email->to($_POST['email']);
			//$email->cc('promatics.gautam@gmail.com');
			$email->from($emailTemp1['EmailTemplate']['from']);
			$email->subject($emailTemp1['EmailTemplate']['subject']);                             
			//echo '<pre>';print_r($common_template);die;
			$email->attachments($pdfTitle);
			//$email->send();	
			if($email->send())
			{
				$this->Session->write('success','Mail Has been sent Successfully!!');
			}
			$this->redirect($this->referer());	
		else :
		   echo "An error occured";
		   die;	
		endif;
	}
	function send() 
	{
		$this->autoRender = false;		
		//$this->Email->template = 'email/confirm';
		// You can use customised thmls or the default ones you setup at the start
	    $data = "hiii";          
		//$this->set('data', $data);
		$this->Email->from = 'promatics.gurudutt@gmail.com';
		//$this->Email->to = 'promatics.subhash@gmail.com';
		//$this->Email->to = 'chandra.subhash87@outlook.com';
		$this->Email->to = 'promatics.gourav@gmail.com';
		$this->Email->subject = 'PHP Mailer';	     
		//$this->Email->attach($fully_qualified_filename,$new_name_when_attached);
		// You can attach as many files as you like.
		if($this->Email->send("$data"))
        {
			echo "Mail send successfully from <b>".$this->Email->from."</b> to <b>".$this->Email->to."</b>";
        }
        else
        {
			echo "xyz";
			echo "2";die;
        }
        die;
		//the rest of the controller method...
    }
	
}

?>  	   	   