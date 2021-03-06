<?php
class NewsLettersController extends AppController {
		var $name="NewsLetters";
		var $components = array('RequestHandler','Cookie','Session','Email');
		var $uses = array('Member','Location','EmailTemplate','DealCategory','DealOption','ArchieveNewsletter','Dispatch');
		
		function beforeFilter() {
			parent::beforeFilter();	
		}
		public $strs = '';		
		
		//.......................old newsletter..............................
		/* function admin_newsletter() {
			$this->layout = "admin";
			$currentDate = Date('Y-m-d H:i:s');
			$loc = $this->Location->find('all');
			$this->set('loc',$loc);
			if ($this->request->is('ajax')) {
				$title=trim($_POST['data']['Deal']['name']);
				$desc=trim($_POST['data']['Deal']['description']);
				$loc=$_POST['data']['Deal']['location'];
				$conditions=array();
				if ($title!="") {
					$conditions=array_merge($conditions,array('Deal.name LIKE'=>'%'.$title.'%'));
				}
				if ($desc!="") {
					$conditions=array_merge($conditions,array('Deal.description LIKE'=>'%'.$desc.'%'));
				}
				if ($loc!="") {
					$conditions=array_merge($conditions,array('Deal.location LIKE'=>$loc.'%'));
				}
				$conditions=array_merge($conditions,array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'No'));
				$newslist = $this->Deal->find('all',array('conditions'=>$conditions,'order'=>array('Deal.id desc')));
				$this->set(compact('newslist'));
				if ($this->RequestHandler->isAjax()) {
					$this->layout='';
					$this->autoRender=false;
					$this->viewPath='Elements'.DS.'backend'.DS.'NewsLetter';
					$this->render('newsletter_list');
				}
			}
			else
			{
				$newslist = $this->Deal->find('all',array('conditions'=>array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'No'),'order'=>array('Deal.id desc')));
				$this->set(compact('newslist'));
			}
			
		}
		function active_daily_deal() {
			$this->autoRender = false;
			if ($this->Deal->updateAll(array('Deal.daily_newsletter'=>'"Yes"'),array('Deal.id'=>$_POST))) {
					$this->Session->write('success','Deals has been add to daily newsletter successfully.');
					echo "success";die;
			}
			else {
					$this->Session->write('error','There is some error please try later.');
					echo "error";die;
			}
		}
		function admin_daily_newsletter() {
			$this->layout = "admin";
                        //ini_set('memory_limit', '256M');
			$currentDate = Date('Y-m-d H:i:s');
			$newslist = $this->Deal->find('all',array('conditions'=>array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes'),'order'=>array('Deal.id desc')));
			$this->set(compact('newslist'));
		}
		function deactive_daily_deal() {
				$this->autoRender = false;
				if($this->Deal->updateAll(array('Deal.daily_newsletter'=>'"No"'),array('Deal.id'=>$_POST))) {
					$this->Session->write('success','Deals has been removed from daily newsletter successfully.');
					echo "success";die;
				}
				else {		
						$this->Session->write('error','There is some error please try later.');
						echo "error";die;
				}
		}
		function send_newsletter() {
			$this->autoRender = false;
			$currentDate = Date('Y-m-d H:i:s');
			$currDate = Date('Y-m-d');
			$meminfo = $this->Member->find('all',array('conditions'=>array('Member.status'=>'Active','Member.newsletters'=>'Yes')));
			
			foreach($meminfo as $list) {
				$memloc1 = $list['Member']['news_location'];
				$memloc2 = array_filter(explode(',',$memloc1));
				$in_cnt = 0;
				if(!empty($memloc2)) {
					$memloc = $memloc2;
					$in_cnt = count($memloc2);
				}
				else {
					$memloc = $this->Location->find('list',array('fields'=>array('id')));
					
				}
				
				
				$location_condition=array();			
				$conditions =array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes');
				$fetch_deals=$this->Deal->find('all',array('conditions'=>$conditions,'fields'=>array('Deal.id','Deal.location'),'recursive'=>'-1'));				
   			foreach($fetch_deals as $other_deal)
				{
					$each_deals=$other_deal['Deal']['location'];
					$sub_deals=explode(',',$each_deals);
					$search_arr=$memloc2;
					$result=array_intersect($sub_deals,$search_arr);
					
					if(count($result)>0)
					{
			    		$location_condition[]=$other_deal['Deal']['id'];
					}
				}
				
				if(!empty($location_condition))
				{
						if (count($location_condition)>1)
						{		
										$conditions=array_merge($conditions,array('Deal.id in'=>$location_condition));
						}
						else
						{
										$conditions=array_merge($conditions,array('Deal.id'=>$location_condition));
						}
			   }
				else
				{
				     $conditions=array_merge($conditions,array('Deal.id'=>-1));
				}
				
				
				$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id)');
				$count = $this->Deal->find('count',array('conditions'=>$conditions,'order'=>array('Deal.id desc')));
				$limit = 20;
				$loop = ceil($count/$limit);
				$offset = 0;
				$dealId = $this->Deal->find('list',array('conditions'=>$conditions,'order'=>array('Deal.id desc'),'fields'=>array('id')));
				
					
				for($i=0;$i<$loop;$i++) {						
					$content='';
					$deals = $this->Deal->find('all',array('conditions'=>$conditions,'order'=>array('Deal.id desc'),'offset'=>$offset,'limit'=>$limit));
				   $offset +=$limit;	
					$counter=1;
					foreach($deals as $deal) {
						$img = IMPATH.'deals/'.$deal['Deal']['image'].'&w=100&h=100';
						$title = $deal['Deal']['name'];
						if(strlen($deal['Deal']['description'])>350)
							$desc = substr($deal['Deal']['description'],0,350).'...';
						else
							$desc = $deal['Deal']['description'];
							$viewurl = HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
							$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:'N/A';
							$price = @$deal['Deal']['price']?$deal['Deal']['price']:'N/A';
						if($counter%2==0) {
							$content .='<tr>
           <td colspan="4"><table style="width:100%;float:left;padding: 5px 4px 3px 4px;background:#f4f7f9;border-radius:5px;border:1px solid #ddd;"><tr style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;"><td style="width:125px;"> <img src="'.$img.'" style="float:left;width:100%;min-height:120px; padding:5px; border:1px solid #ddd;" /> </td><td colspan="3" style="" valign="top"><span style="color:#444;word-wrap:break-word;float:left;width:100%;font-size:16px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:10px;margin-left: 10px;">'.$title. '</span><span style="color:#999;margin-top:15px;word-wrap:break-word;display:inline-block;float:left;width:100%; font-size:16px; margin-left: 10px; ">'.$desc.'</span></td></tr><tr><td colspan=""><table cellpadding="5px;"><tr><td style="font-size:14px;border-right:1px solid #ddd;color:#acacac ;text-align:center;"><b> 	Discount </b>'.$dis.'</td> <td style="font-size:14px;color:#acacac;text-align:center;"> <b> 	Price </b> 	Rs.'.$price.'</td></tr></table></td><td colspan="" style="text-align:right;" valign="center"><a href="'.$viewurl.'" style="text-align:right;background: #228dd6; background: -moz-linear-gradient(top, #228dd6 0%, #428bca 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#228dd6), color-stop(100%,#428bca));background: -webkit-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -o-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -ms-linear-gradient(top, #228dd6 0%,#428bca 100%);background: linear-gradient(to bottom, #228dd6 0%,#428bca 100%);border:1px solid #006699;color:#fff;  margin-right:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;"> View It  </a></td></tr></table></td>
			</tr>';
					}
						else
						{
							$content .=
							'<tr>
          <td colspan="4"><table style="width:100%;float:left;padding: 5px 4px 3px 4px;background:#f4f7f9;border-radius:5px;border:1px solid #ddd;" cellpadding="5px" cellspacing="0"><tr style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;"><td colspan="3" style="" valign="top"><span style="color:#444;word-wrap:break-word;float:left;width:100%;font-size:16px;font-weight:bold; display:inline-block;float:left;width:100%;  margin-right:10px; ">'.$title.'</span><span style="color:#999;margin-top:15px;word-wrap:break-word;display:inline-block;float:left;width:100%; font-size:16px; margin-right: 10px; ">'.$desc.'</span></td><td style="width:125px;"> <img src="'.$img.'" style="float:right;width:100%; min-height:120px; padding:5px; border:1px solid #ddd;" /> </td></tr><tr><td colspan="3" style="text-align:left;" valign="center"><a href="'.$viewurl.'" style="text-align:right;background: #228dd6; background: -moz-linear-gradient(top, #228dd6 0%, #428bca 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#228dd6), color-stop(100%,#428bca));background: -webkit-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -o-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -ms-linear-gradient(top, #228dd6 0%,#428bca 100%);background: linear-gradient(to bottom, #228dd6 0%,#428bca 100%);border:1px solid #006699;color:#fff;  margin-left:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;"> View It  </a></td><td colspan="" style="text-align:right;"><table cellpadding="5px;" style="text-align:right;float:right;"><tr><td style="font-size:14px;border-right:1px solid #ddd;color:#acacac ;text-align:center;"><b> 	Discount </b>'.$dis.'</td><td style="font-size:14px;color:#acacac;text-align:center;"><b> 	Price </b> 	Rs.'.$price.'</td> </tr></table></td></tr></table></td>
			</tr>';
							
						}
						$counter++;
					}
					$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter')));
					$common_template= $emailTemp1['EmailTemplate']['description'];
												
										
					$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
					$common_template = str_replace('{content}',$content,$common_template);
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));
					$email->to($list['Member']['email']);
					$email->from($emailTemp1['EmailTemplate']['from']);
					$email->subject($emailTemp1['EmailTemplate']['subject']);
					$email->send();					
				}
					
			}
			
			$all_list=$this->Deal->find('all',array('conditions'=>array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes'),'order'=>array('Deal.id desc'),'fields'=>array('id')));
			$all_daily_ids = $this->ArchieveNewsletter->find('list',array('conditions'=>array('ArchieveNewsletter.date'=>$currDate),'fields'=>'deal_id'));
			foreach($all_list as $list) {    
				$data1 = array();
				
				if(!in_array($list['Deal']['id'],$all_daily_ids)) {
						$data1['ArchieveNewsletter']['deal_id'] = $list['Deal']['id'];
						$data1['ArchieveNewsletter']['date'] = $currDate;
						$this->ArchieveNewsletter->create();
						$this->ArchieveNewsletter->save($data1);
				}
				else {
				
				}
			}			
			$this->Deal->updateAll(array('Deal.newsletter_sent_date'=>'"'.$currDate.'"'),array('Deal.id'=>$dealId));
			$this->Session->write('success','NewsLetter sent successfully.');
			echo "success";die;
		}		
		function admin_archieve_newsletter() {
			$this->layout = "admin";
			$newslist = $this->ArchieveNewsletter->find('all',array('order'=>array('ArchieveNewsletter.date desc'),'recursive'=>2));
			$this->set(compact('newslist'));
			
		}
		function admin_delete_archieve() {
			$this->autoRender = false;
			if($this->ArchieveNewsletter->deleteAll(array('ArchieveNewsletter.id'=>$_POST))) {
				$this->Session->write('success','Record have been deleted successfully.');
				echo "success";die;
			}
			else {		
					$this->Session->write('error','There is some error please try later.');
					echo "error";die;
			}
		} */ 
      /*.......................end of old newsletter..............................*/


      function admin_newsletter() {
			$this->layout = "admin";
			$currentDate = Date('Y-m-d');
         ini_set('memory_limit', '256M');
			$loc = $this->Location->find('all');
			$cat = $this->DealCategory->find('all',array('conditions'=>array('DealCategory.parent_id'=>'','DealCategory.active'=>'Yes'),'recursive'=>-1));
        
			//$deal_category = $this->DealCategory->generateTreeList($conditions=array('DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '&nbsp&nbsp&nbsp&nbsp');
			//$this->set('deal_category',$deal_category);
			
			//........start alphabatical category order...
			$alphabatical_category=$this->_AlphabaticalCategory2();
			$this->set('deal_category',$alphabatical_category); 
			//........end alphabatical category order...
        
			//pr($loc);die;
			$this->set('loc',$loc);
			$this->set('cat',$cat);
			if (!empty($this->request->data)) 
			{
				//$this->Deal->virtualFields = array('last_news_sent'=>'select status from dispatch_deals as d where d.supplier_id= Member.id');
				$member_email=trim($_POST['data']['Member']['email']);
				$title=trim($_POST['data']['Deal']['name']);
				//$desc=trim($_POST['data']['Deal']['description']);
				$locat=$_POST['data']['Deal']['location'];
				$catog=$_POST['data']['Deal']['category'];
				$conditions=array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.supplier_newsletter_status'=>'pending','Deal.daily_newsletter'=>'No','Deal.newsletter_sent_date <= '=>$currentDate);
				
				if ($member_email!="") {
					$conditions=array_merge($conditions,array('Member.email LIKE'=>'%'.$member_email.'%'));
				}
				if ($title!="") {
					$conditions=array_merge($conditions,array('Deal.name LIKE'=>'%'.$title.'%'));
				}
				/*if ($desc!="") {
					$conditions=array_merge($conditions,array('Deal.description LIKE'=>'%'.$desc.'%'));
				}*/
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
				if ($catog!="") 
				{
					$parents_child=$this->DealCategory->children($catog);
					$childs=array();
					if(!empty($parents_child))
					{
						foreach($parents_child as $cat_childd)
						{
						  $childs[]=$cat_childd['DealCategory']['id'];
						}
					}
					array_push($childs,$catog);
					array_unique($childs);
					if(count($childs)>1)
					   $conditions=array_merge($conditions,array('Deal.category in'=>$childs));
					else
				      $conditions=array_merge($conditions,array('Deal.category'=>$childs[0]));
				}
				$this->Session->write('cNews', $conditions);
				$this->paginate = array('limit'=>20,'order'=>array('Deal.id desc'),'conditions'=>$conditions);
				$newslist = $this->paginate('Deal');
				$this->set(compact('newslist'));
				
				if ($this->RequestHandler->isAjax()) 
				{
					$this->layout='';
					$this->autoRender=false;
					$this->viewPath='Elements'.DS.'backend'.DS.'NewsLetter';
					$this->render('newsletter_list');
				}
			}
			else
			{	$condition = array();
				if($this->Session->check('cNews'))
				{
					$condition = $this->Session->read('cNews');
				}
				
				$this->paginate = array('limit'=>20,'conditions'=>array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'No','Deal.supplier_newsletter_status'=>'pending','Deal.newsletter_sent_date <= '=>$currentDate),'order'=>array('Deal.id desc'));
				$newslist = $this->paginate('Deal',$condition);
				$this->set(compact('newslist'));
			}
		}
		function active_daily_deal() {
			$this->autoRender = false;
			if ($this->Deal->updateAll(array('Deal.daily_newsletter'=>'"Yes"'),array('Deal.id'=>$_POST))) {
					$this->Session->write('success','Deals has been added to Approved and not sent successfully.');
					echo "success";die;
			}
			else {
					$this->Session->write('error','There is some error please try later.');
					echo "error";die;
			}
		}
		function admin_daily_newsletter($selected_news_loc=NULL)
		{
			$this->layout = "admin";
                        ini_set('memory_limit', '256M');
			$currentDate = Date('Y-m-d');
			$newslist = $this->Deal->find('all',array('conditions'=>array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.supplier_newsletter_status'=>'pending','Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes','Deal.accept_preview NOT'=>'Dispatched'),'contain'=>array('Location'),'order'=>array('Deal.id desc')));
			
			$i=0;
			foreach($newslist as $each_deals)
			{
				$loc_deal=explode(',',$each_deals['Deal']['location']);
				if($i==0)
				   $deal_location=$loc_deal;
				//$deal_location[$i]=$each_deals['Deal']['location'];
				$deal_location=array_intersect($deal_location,$loc_deal);
				$i++;
			}
			if(!empty($deal_location))
				$common_loc = $this->Location->find('all',array('conditions'=>array('Location.id'=>$deal_location)));
			else 
				$common_loc=array();
				
			
			if(!empty($common_loc))
			{
				if(trim($selected_news_loc)!='')
				{
					$newsletter_single_id=convert_uudecode(base64_decode($selected_news_loc));
               $common_list_id=array();
					foreach($common_loc as $common_list)
					{
						$common_list_id[]=$common_list['Location']['id'];
					}
					if(in_array($newsletter_single_id,$common_list_id))
					    $selected_news_loc=$selected_news_loc;
					else
				       $selected_news_loc=base64_encode(convert_uuencode($common_loc[0]['Location']['id']));
				}
				else
				   $selected_news_loc=base64_encode(convert_uuencode($common_loc[0]['Location']['id']));
			}
			else 
			{
			    $selected_news_loc='';
			}
			$this->set('common_loc',$common_loc);
			$loc = $this->Location->find('all');
			$this->set('loc',$loc);
			$this->set(compact('newslist'));
			$this->set('selected_news_loc',$selected_news_loc);	
		}
		function deactive_daily_deal() {
				$this->autoRender = false;

				if($this->Deal->updateAll(array('Deal.daily_newsletter'=>'"No"','Deal.accept_preview'=>'"No"'),array('Deal.id'=>$_POST))) {
					$this->Session->write('success','Deals has been removed from Approved and not sent successfully.');
					echo "success";die;
				}
				else {		
						$this->Session->write('error','There is some error please try later.');
						echo "error";die;
				}
		}
		function send_newsletter() {
			$this->autoRender = false;
			$currentDate = Date('Y-m-d H:i:s');
			$currDate = Date('Y-m-d');
			$meminfo = $this->Member->find('all',array('conditions'=>array('Member.status'=>'Active','Member.newsletters'=>'Yes')));
			//pr($meminfo);die;
			foreach($meminfo as $list) {
				
				$memloc1 = $list['Member']['news_location'];
				$memloc2 = array_filter(explode(',',$memloc1));
				$in_cnt = 0;
				if(!empty($memloc2)) {
					$memloc = $memloc2;
					$in_cnt = count($memloc2);
				}
				else {
					$memloc = $this->Location->find('list',array('fields'=>array('id')));
					
				}
				
				
				$location_condition=array();			
				$conditions =array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes','Deal.supplier_newsletter_status'=>'pending');
				$fetch_deals=$this->Deal->find('all',array('conditions'=>$conditions,'fields'=>array('Deal.id','Deal.location'),'recursive'=>'-1'));				
   			foreach($fetch_deals as $other_deal)
				{
					$each_deals=$other_deal['Deal']['location'];
					$sub_deals=explode(',',$each_deals);
					$search_arr=$memloc2;
					$result=array_intersect($sub_deals,$search_arr);
					
					if(count($result)>0)
					{
			    		$location_condition[]=$other_deal['Deal']['id'];
					}
				}
				
				if(!empty($location_condition))
				{
						if (count($location_condition)>1)
						{		
										$conditions=array_merge($conditions,array('Deal.id in'=>$location_condition));
						}
						else
						{
										$conditions=array_merge($conditions,array('Deal.id'=>$location_condition));
						}
			   }
				else
				{
				     $conditions=array_merge($conditions,array('Deal.id'=>-1));
				}
				
				
				$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id)');
				$count = $this->Deal->find('count',array('conditions'=>$conditions,'order'=>array('Deal.id desc')));
				$limit = 20;
				$loop = ceil($count/$limit);
				$offset = 0;
				$dealId = $this->Deal->find('list',array('conditions'=>$conditions,'order'=>array('Deal.id desc'),'fields'=>array('id')));
				
					
				for($i=0;$i<$loop;$i++) {						
					$content='';
					$deals = $this->Deal->find('all',array('conditions'=>$conditions,'order'=>array('Deal.id desc'),'offset'=>$offset,'limit'=>$limit));
				   $offset +=$limit;	
					$counter=1;
					foreach($deals as $deal) {
						$img = IMPATH.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
						$title = $deal['Deal']['name'];
						if(strlen($deal['Deal']['description'])>300)
							$desc = substr($deal['Deal']['description'],0,300).'...';
						else
							$desc = $deal['Deal']['description'];
							$viewurl = HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
							$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:0;
							$price = @$deal['Deal']['price']?$deal['Deal']['price']:0;
						if($counter%2==0) {
							$content .='<tr>
           <td colspan="4"><table style="width:100%;float:left;padding: 5px 4px 3px 4px;background:#f4f7f9;border-radius:5px;border:1px solid #ddd;"><tr style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;"><td style="width:125px;"> <img src="'.$img.'" style="float:left;width:100%;min-height:120px; padding:5px; border:1px solid #ddd;" /> </td><td colspan="3" style="" valign="top"><span style="color:#444;word-wrap:break-word;float:left;width:100%;font-size:16px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:10px;margin-left: 10px;">'.$title. '</span><span style="color:#999;margin-top:15px;word-wrap:break-word;display:inline-block;float:left;width:100%; font-size:16px; margin-left: 10px; ">'.$desc.'</span></td></tr><tr><td colspan=""><table cellpadding="5px;"><tr><td style="font-size:14px;border-right:1px solid #ddd;color:#acacac ;text-align:center;"><b> 	Discount </b>'.$dis.'</td> <td style="font-size:14px;color:#acacac;text-align:center;"> <b> 	Price </b> 	R '.$price.'</td></tr></table></td><td colspan="" style="text-align:right;" valign="center"><a href="'.$viewurl.'" style="text-align:right;background: #228dd6; background: -moz-linear-gradient(top, #228dd6 0%, #428bca 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#228dd6), color-stop(100%,#428bca));background: -webkit-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -o-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -ms-linear-gradient(top, #228dd6 0%,#428bca 100%);background: linear-gradient(to bottom, #228dd6 0%,#428bca 100%);border:1px solid #006699;color:#fff;  margin-right:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;"> View It  </a></td></tr></table></td>
			</tr>';
					}
						else
						{
							$content .=
							'<tr>
          <td colspan="4"><table style="width:100%;float:left;padding: 5px 4px 3px 4px;background:#f4f7f9;border-radius:5px;border:1px solid #ddd;" cellpadding="5px" cellspacing="0"><tr style="border-top:1px solid #ddd;border-bottom:1px solid #ddd;"><td colspan="3" style="" valign="top"><span style="color:#444;word-wrap:break-word;float:left;width:100%;font-size:16px;font-weight:bold; display:inline-block;float:left;width:100%;  margin-right:10px; ">'.$title.'</span><span style="color:#999;margin-top:15px;word-wrap:break-word;display:inline-block;float:left;width:100%; font-size:16px; margin-right: 10px; ">'.$desc.'</span></td><td style="width:125px;"> <img src="'.$img.'" style="float:right;width:100%; min-height:120px; padding:5px; border:1px solid #ddd;" /> </td></tr><tr><td colspan="3" style="text-align:left;" valign="center"><a href="'.$viewurl.'" style="text-align:right;background: #228dd6; background: -moz-linear-gradient(top, #228dd6 0%, #428bca 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#228dd6), color-stop(100%,#428bca));background: -webkit-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -o-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -ms-linear-gradient(top, #228dd6 0%,#428bca 100%);background: linear-gradient(to bottom, #228dd6 0%,#428bca 100%);border:1px solid #006699;color:#fff;  margin-left:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;"> View It  </a></td><td colspan="" style="text-align:right;"><table cellpadding="5px;" style="text-align:right;float:right;"><tr><td style="font-size:14px;border-right:1px solid #ddd;color:#acacac ;text-align:center;"><b> 	Discount </b>'.$dis.'</td><td style="font-size:14px;color:#acacac;text-align:center;"><b> 	Price </b> 	R '.$price.'</td> </tr></table></td></tr></table></td>
			</tr>';
							
						}
						$counter++;
					}
					$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter')));
					
					$unsubscribe_link = HTTP_ROOT.'NewsLetters/unsubscribe_link/'.base64_encode(convert_uuencode($list['Member']['id']));
					$common_template= $emailTemp1['EmailTemplate']['description'];
												
										
					$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
					$common_template = str_replace('{unsubscribe_link}',$unsubscribe_link,$common_template);
					$common_template = str_replace('{content}',$content,$common_template);
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));
					$email->to($list['Member']['email']);
					//$email->from($emailTemp1['EmailTemplate']['from']);
					$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Newsletter'));
					$email->subject($emailTemp1['EmailTemplate']['subject']);
					$email->send();					
				}
					
			}
			
			$all_list=$this->Deal->find('all',array('conditions'=>array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes'),'order'=>array('Deal.id desc'),'fields'=>array('id')));
			$all_daily_ids = $this->ArchieveNewsletter->find('list',array('conditions'=>array('ArchieveNewsletter.date'=>$currDate),'fields'=>'deal_id'));
			foreach($all_list as $list) {    
				$data1 = array();
				
				if(!in_array($list['Deal']['id'],$all_daily_ids)) {
						$data1['ArchieveNewsletter']['deal_id'] = $list['Deal']['id'];
						$data1['ArchieveNewsletter']['date'] = $currDate;
						$this->ArchieveNewsletter->create();
						$this->ArchieveNewsletter->save($data1);
				}
				else {
				
				}
			}			
			$this->Deal->updateAll(array('Deal.newsletter_sent_date'=>'"'.$currDate.'"'),array('Deal.id'=>$dealId));
			$this->Session->write('success','NewsLetter sent successfully.');
			echo "success";die;
		}		
		
		function admin_delete_archieve() {
			$this->autoRender = false;
			if($this->ArchieveNewsletter->deleteAll(array('ArchieveNewsletter.id'=>$_POST))) {
				$this->Session->write('success','Record have been deleted successfully.');
				echo "success";die;
			}
			else {		
					$this->Session->write('error','There is some error please try later.');
					echo "error";die;
			}
		}
		function admin_update_daily_newsletter($id=null)
		{
			//echo $id;die;
			$this->Deal->updateAll(array('Deal.daily_newsletter'=>'"No"'),array('Deal.id'=>$id));
			$this->Session->write('success','Deal Back to Newsletters.');
			$this->redirect(array('controller'=>'NewsLetters','action'=>'daily_newsletter'));
			
		}
		function admin_preview($newsletter_locid=null)
		{
			$this->layout = "";
			//$this->autoRender = false;
			
			$newsletter_single=convert_uudecode(base64_decode($newsletter_locid));
			$newsletter_single_loc = $this->Location->find('first',array('conditions'=>array('Location.id'=>$newsletter_single),'fields'=>array('Location.id','Location.name')));
			$newsletter_location=$newsletter_single_loc['Location']['name'];
         
			$currentDate = date('Y-m-d');
			$currDate = date('Y-m-d');
			$conditions =array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes','Deal.accept_preview NOT'=>'Dispatched','Deal.supplier_newsletter_status'=>'pending');
			//$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
			$this->Deal->virtualFields = array('dis'=>'select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
			$count = $this->Deal->find('count',array('conditions'=>$conditions,'order'=>array('Deal.id desc')));
			$limit = 20;
			$loop = ceil($count/$limit);
			$offset = 0;
			$dealId = $this->Deal->find('list',array('conditions'=>$conditions,'order'=>array('Deal.id desc'),'fields'=>array('id')));
			$mystr = '';
			for($i=0;$i<$loop;$i++)
			{						
				
				$deals = $this->Deal->find('all',array('conditions'=>$conditions,'order'=>array('Deal.id desc'),'offset'=>$offset,'limit'=>$limit));
				
			   $offset +=$limit;	
				$loop_deals=array();
				$d=0;
				foreach($deals as $deal)
				{
					//pr($deal);die;
					$template_locations=explode(',',$deal['Deal']['location']);
					
					$each_template_locations=$template_locations;
               array_unique($each_template_locations);                           
               $dealtemp_options = $this->Location->find('all',array('conditions'=>array('Location.id'=>$each_template_locations),'fields'=>array('Location.id','Location.name')));
               $deal_location_text='';
               foreach($dealtemp_options as $temp_loc)
               {
               	$deal_location_text.=$temp_loc['Location']['name'].", ";
               }
               $deal_location_text=rtrim($deal_location_text,', ');
               if(strlen($deal_location_text)>40)
						$deal_location_text = substr($deal_location_text,0,40).'..';
					else
						$deal_location_text = $deal_location_text;
					
					$img = IMPATH.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
					if(strlen($deal['Deal']['name'])>100)
						$title = substr($deal['Deal']['name'],0,100).'...';
					else
						$title = $deal['Deal']['name'];
						
						$viewurl = HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
						$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:0;
						$price = @$deal['Deal']['price']?$deal['Deal']['price']:0;
						
						$loop_deals[$d]['img']=$img;
						$loop_deals[$d]['title']=$title;
						$loop_deals[$d]['viewurl']=$viewurl;
						$loop_deals[$d]['selling_price']=$deal['Deal']['selling_price'];
                  $loop_deals[$d]['discounted_selling_price']=$price;
						$loop_deals[$d]['dis']=$dis;
						$loop_deals[$d]['category']=$deal['DealCategory']['name'];
                  $loop_deals[$d]['location']=$newsletter_location; //$deal_location_text
						
					$d++;	
				}
				$loop_deals=array_chunk($loop_deals,2);				
				
				$content='';
				foreach($loop_deals as $each_loop)
				{
					$content .='<tr>';
					foreach($each_loop as $each_trdeal)
					{
				        $content .='<td width="50%">
								        	<table style="width:100%;float:left;padding:0;background:#fff;box-shadow: 0 0 5px #999;border:1px solid #ddd;">
								        		<tr style="	">
								        			<td style="">
								        				 <img style="width:100%;" src="'.$each_trdeal['img'].'" /> 
								        			</td>
								        		 </tr>
								        			<tr>
								        			<td style="" valign="top">
								        					<span style="word-wrap:break-word;float:left;width:100%;font-size:15px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:15px;margin-left: 10px; color:#428bca;">'.$each_trdeal['title'].'</span>
								        												        					
																			        			
								        			</td>
								        			
								        			</tr>
								        			
								        			<tr>
														<td>
															<p style="float:left;width:auto; color:#555;margin-left:10px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">Was </span>  <label style="color:#999;text-decoration: line-through;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['selling_price'].'</label></p>
															<p style="float:left;width:auto; color:#555; margin-left:4px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">, Now</span> <span style="color:#87c540;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['discounted_selling_price'].'</span></p>
															<a href="'.$each_trdeal['viewurl'].'" style="text-align:right;color:#fff;  margin-left:21%; margin-bottom:10px; text-decoration: none; font-size: 14px;padding:5px 8px; border-radius: 5px;float:left; background-color:#228dd6;"> View It  </a>													
														</td>				        			
								        			</tr>
								        			
								        			
								        		</table>
								        	</td>';						
					}
					$content .='</tr>';
					
				}
				
				array_unique($template_locations);
			   $temp_options = $this->Location->find('all',array('conditions'=>array('Location.id'=>$template_locations),'fields'=>array('Location.id','Location.name')));
            $template_location_text='';
            foreach($temp_options as $temp_loc)
            {
            	$template_location_text.=$temp_loc['Location']['name'].",";
            }
            $template_location_text=rtrim($template_location_text,',');	
				
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter')));
				$common_template= $emailTemp1['EmailTemplate']['description'];
				$url=HTTP_ROOT.'admin/NewsLetters/daily_newsletter/'.$newsletter_locid;							
				$url1=HTTP_ROOT.'admin/NewsLetters/accept_preview/'.$newsletter_locid;							
				$HTTP_ROOT=rtrim(HTTP_ROOT,'/');	
				//echo 	$HTTP_ROOT;die;	
				//$java = 'javascript:void(0)';
				$common_template = str_replace('{unsubscribe_link}','javascript:void(0)',$common_template);		
				$common_template = str_replace('{DomainPath}',$HTTP_ROOT,$common_template);
				$common_template = str_replace('{content}',$content,$common_template);
				$common_template = str_replace('{newsletter_date}',date('d F Y'),$common_template);
				$common_template = str_replace('{locations}',$newsletter_location,$common_template);
				//$common_template = str_replace('{locations}',$template_location_text,$common_template);
							
				$common_template .= '<div style="width:100%;float:left;background:#1578BB;">
<div style="width:100%;margin:0 auto;"><table cellpadding="10px" style="overflow:scroll;width:100%;margin:1px auto;border-collapse:collapse;background:#fff;">
					<tbody>
						<tr style="background:#ddd;">
						<td width="33.33%"></td>
						<td valign="center" style="text-align:center;" colspan="3">
						<a style="display: inline-block;text-align:center;background: #228dd6; margin-left:10px; background: -moz-linear-gradient(top, #228dd6 0%, #428bca 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#228dd6), color-stop(100%,#428bca));background: -webkit-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -o-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -ms-linear-gradient(top, #228dd6 0%,#428bca 100%);background: linear-gradient(to bottom, #228dd6 0%,#428bca 100%);border:1px solid #006699;color:#fff; margin-left:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;" href='.$url.' > Back  </a>
						<a style="text-align:center;background: #228dd6;background: -moz-linear-gradient(top, #228dd6 0%, #428bca 100%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#228dd6), color-stop(100%,#428bca));background: -webkit-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -o-linear-gradient(top, #228dd6 0%,#428bca 100%);background: -ms-linear-gradient(top, #228dd6 0%,#428bca 100%);background: linear-gradient(to bottom, #228dd6 0%,#428bca 100%);border:1px solid #006699;color:#fff;margin-bottom:20px; margin-top:20px; margin-left:10px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;" href="javascript:void(0)" class = "AcceptDiv"> Accept  </a>
						
						</td>
						<td width="33.33%"></td>
						
						</tr>
						<tr style="background:white;">
							<td width="33%">
							
							</td>
							<td colspan="3" style="text-align:center;display:none;" id = "imgLoader">
								<img src="'.HTTP_ROOT.'img/backend/loader.gif" style="margin-left:0px;margin-top: 13px;width: 10%;text-align:center;"/>
							</td>
							<td width="23%"></td>
						</tr>
					<tr class="Email-div"  style = "display:none;margin-top:10px;margin-bottom:10px;background:#ddd;">
						<td width="40%">
							
						</td>
						<td colspan="3">
						<form id="frm" class="email_preview_action" method="post" enctype="multipart/form-data" action = "'.HTTP_ROOT.'admin/NewsLetters/dispatched/'.$newsletter_locid.'">
							<label style="float:left;width:100%;text-align:center;">Select Date:<em>*</em></label>
							<input class="field text required dispatch_date" style="float:left;width:100%;" rel="buy" readonly="readonly"  name="data[Dispatch][sent_date]"  type="text"/>
							<input class="submit sub-bttn" id = "dispached" style="float:left;width:100%;margin-top:5px;margin-left:0px;background: linear-gradient(#228dd6 , #428bca );color:white;padding:5px;border-radius:1px solid #006cad;" type="submit" value="Load Newsletter for Dispatch"/>
						</form>
						</td>
						<td width="40%">
							
						</td>
					</tr>
					</tbody>
				</table></div></div>
				';		
				$this->set('common_template',$common_template);
				$this->set('url1',$url1);
				//echo $common_template;
				
			}
		}
		function admin_email_preview($newsletter_locid=null)
		{
			$this->layout = "admin";
			$this->autoRender = false;
			
			$newsletter_single=convert_uudecode(base64_decode($newsletter_locid));
			$newsletter_single_loc = $this->Location->find('first',array('conditions'=>array('Location.id'=>$newsletter_single),'fields'=>array('Location.id','Location.name')));
			$newsletter_location=$newsletter_single_loc['Location']['name'];			
			
			if(!empty($this->request->data)) {
				$data1=$this->request->data;
				$member_emails=explode(',',$data1['Member']['email']);
				//pr($data1);die;
				$currentDate = date('Y-m-d');
				$currDate = date('Y-m-d');
				
				$conditions =array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.supplier_newsletter_status'=>'pending','Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes','Deal.accept_preview NOT'=>'Dispatched');
				
				//$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
				$this->Deal->virtualFields = array('dis'=>'select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
				$count = $this->Deal->find('count',array('conditions'=>$conditions,'order'=>array('Deal.id desc')));
				$limit = 20;
				$loop = ceil($count/$limit);
				$offset = 0;
				$dealId = $this->Deal->find('list',array('conditions'=>$conditions,'order'=>array('Deal.id desc'),'fields'=>array('id')));
				$mystr = '';					
				for($i=0;$i<$loop;$i++) 
				{
					$deals = $this->Deal->find('all',array('conditions'=>$conditions,'order'=>array('Deal.id desc'),'offset'=>$offset,'limit'=>$limit));
					
					$offset +=$limit;	
				$loop_deals=array();
				$d=0;
				foreach($deals as $deal)
				{
					$template_locations=explode(',',$deal['Deal']['location']);
					
					$each_template_locations=$template_locations;
               array_unique($each_template_locations);                           
               $dealtemp_options = $this->Location->find('all',array('conditions'=>array('Location.id'=>$each_template_locations),'fields'=>array('Location.id','Location.name')));
               $deal_location_text='';
               foreach($dealtemp_options as $temp_loc)
               {
               	$deal_location_text.=$temp_loc['Location']['name'].", ";
               }
               $deal_location_text=rtrim($deal_location_text,', ');
               if(strlen($deal_location_text)>40)
						$deal_location_text = substr($deal_location_text,0,40).'..';
					else
						$deal_location_text = $deal_location_text;
					
					$img = IMPATH.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
					if(strlen($deal['Deal']['name'])>40)
						$title = substr($deal['Deal']['name'],0,40).'...';
					else
						$title = $deal['Deal']['name'];
						
						$viewurl = HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
						$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:0;
						$price = @$deal['Deal']['price']?$deal['Deal']['price']:0;
						
						$loop_deals[$d]['img']=$img;
						$loop_deals[$d]['title']=$title;
						$loop_deals[$d]['viewurl']=$viewurl;
						$loop_deals[$d]['selling_price']=$deal['Deal']['selling_price'];
                  $loop_deals[$d]['discounted_selling_price']=$price;
						$loop_deals[$d]['dis']=$dis;
						$loop_deals[$d]['category']=$deal['DealCategory']['name'];
                  $loop_deals[$d]['location']=$newsletter_location; //$deal_location_text
						
					$d++;	
				}
				$loop_deals=array_chunk($loop_deals,2);				
				
				$content='';
				foreach($loop_deals as $each_loop)
				{
					$content .='<tr>';
					foreach($each_loop as $each_trdeal)
					{
				        $content .='<td width="50%">
								        	<table style="width:100%;float:left;padding:0;background:#fff;box-shadow: 0 0 5px #999;border:1px solid #ddd;">
								        		<tr style="	">
								        			<td style="">
								        				 <img style="width:100%;" src="'.$each_trdeal['img'].'" /> 
								        			</td>
								        		 </tr>
								        			<tr>
								        			<td style="" valign="top">
								        					<span style="word-wrap:break-word;float:left;width:100%;font-size:15px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:15px;margin-left: 10px; color:#428bca;">'.$each_trdeal['title'].'</span>
								        												        					
																			        			
								        			</td>
								        			
								        			</tr>
								        			
								        			<tr>
														<td>
															<p style="float:left;width:auto; color:#555;margin-left:10px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">Was </span>  <label style="color:#999;text-decoration: line-through;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['selling_price'].'</label></p>
															<p style="float:left;width:auto; color:#555; margin-left:4px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">, Now</span> <span style="color:#87c540;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['discounted_selling_price'].'</span></p>
															<a href="'.$each_trdeal['viewurl'].'" style="text-align:right;color:#fff;  margin-left:21%; margin-bottom:10px; text-decoration: none; font-size: 14px;padding:5px 8px; border-radius: 5px;float:left; background-color:#228dd6;"> View It  </a>	
													
														</td>				        			
								        			</tr>
								        			
								        			
								        		</table>
								        	</td>';
						
					 }
					 $content .='</tr>';
					
				  }
				  
				  
               array_unique($template_locations);
				   $temp_options = $this->Location->find('all',array('conditions'=>array('Location.id'=>$template_locations),'fields'=>array('Location.id','Location.name')));
               $template_location_text='';
               foreach($temp_options as $temp_loc)
               {
               	$template_location_text.=$temp_loc['Location']['name'].",";
               }
               $template_location_text=rtrim($template_location_text,',');				  
				  
					$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter')));
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$HTTP_ROOT=rtrim(HTTP_ROOT,'/');
					$common_template = str_replace('{DomainPath}',$HTTP_ROOT,$common_template);
					$common_template = str_replace('{unsubscribe_link}','javascript:void(0)',$common_template);
					$common_template = str_replace('{content}',$content,$common_template);
					$common_template = str_replace('{newsletter_date}',date('d F Y'),$common_template);
					$common_template = str_replace('{locations}',$newsletter_location,$common_template);
					//$common_template = str_replace('{locations}',$template_location_text,$common_template);
					//pr($common_template);die;			
					//echo $data1['member']['email'];die;
						foreach($member_emails as $member_email)
					   {
					   	$member_email=trim($member_email);
					   	if($member_email!='')
					   	{	
								$email = new CakeEmail();
								$email->template('common_template');
								$email->emailFormat('both');
								$email->viewVars(array('common_template'=>$common_template));
								$email->to($member_email);
								$email->from($emailTemp1['EmailTemplate']['from']);
								//$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Newsletter'));
								$email->subject($emailTemp1['EmailTemplate']['subject']);
								//pr($email);die;
								$email->send();
							}
						}
					//pr($data1);die;
					//$data1['Dispatch']['sent_date'] = date('Y-m-d H:i:s');
						$this->Session->write('success','Email has been sent successfully.');
						$this->redirect(array('controller'=>'NewsLetters','action'=>'daily_newsletter/'.$newsletter_locid));
					}
			}			
		}
		function admin_load_newsletter_for_dispatch()
		{
			$this->layout = "admin";
			
			
		}
		function admin_accept_preview($newsletter_locid=null) {
			
         //$newsletter_locid=convert_uudecode(base64_decode($newsletter_locid));
		 $this->autoRender=false;
		 if ($this->request->is('ajax')) {	
		//if(!empty($this->request->data)) {	
				$currentDate = Date('Y-m-d');
				$newslist = $this->Deal->find('all',array('conditions'=>array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes','Deal.accept_preview NOT'=>'Dispatched'),'order'=>array('Deal.id desc')));
				//pr($newslist);die;
				foreach($newslist as $news)
				{
					$deal_id[]=$news['Deal']['id'];
				}
				//pr($deal_id);
				$updation=$this->Deal->updateAll(array('Deal.accept_preview'=>'"Yes"'),array('Deal.id'=>$deal_id));
				if($updation) {
					  echo "true"; 	
					  $this->Session->write('success','NewsLetters has been accepted successfully.');
					  die;
				} 
				else {
					echo "false";
					die;
				}	
				//$this->redirect(array('controller'=>'NewsLetters','action'=>'daily_newsletter/'.$newsletter_locid));
			}
		}
		function admin_dispatched($newsletter_locid=null) 
		{       
                         ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 600);
			$this->layout = "admin";
			$currentDate=date('Y-m-d');
			
			if(!empty($this->request->data)) 
			{
				$this->loadModel('DispatchDeal');
			   $each_dispatch=$this->Deal->find('all',array('conditions'=>array('Deal.buy_from <= '=>$currentDate,'Deal.buy_to >='=>$currentDate,'Deal.supplier_newsletter_status'=>'pending','Deal.active'=>'Yes','Deal.daily_newsletter'=>'Yes','Deal.accept_preview'=>'Yes'),'fields'=>array('Deal.id','Member.id'),'contain'=>array('Member'),'order'=>array('Deal.id desc')));
			
				if(!empty($each_dispatch))
			   {
			   	$dispatch_data['Dispatch']['sent_date'] = date('Y-m-d',strtotime($this->request->data['Dispatch']['sent_date']));
			   	if($newsletter_locid!='') :
                                        $conditions = array();
                                        $news_location = convert_uudecode(base64_decode($newsletter_locid));
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
                                  $totalMem=$this->Member->find('count',array('conditions'=>$conditions,'contain'=>array()));
					//pr($totalMem);die;
					
			   	    $dispatch_data['Dispatch']['newsletter_location'] = $news_location;
			   	    $dispatch_data['Dispatch']['customer_count'] = $totalMem;
			   	endif;
			   	if($this->Dispatch->save($dispatch_data)) 
					{
						$dispatch_id=$this->Dispatch->getLastInsertId();
						$deals_id=array();
	               foreach($each_dispatch as $each_dis)
						{
							$deals_id[]=$each_dis['Deal']['id'];
							$dispatch_entry=array();
							$dispatch_entry['DispatchDeal']['dispatch_id']=$dispatch_id;
							$dispatch_entry['DispatchDeal']['deal_id']=$each_dis['Deal']['id'];
							$dispatch_entry['DispatchDeal']['supplier_id']=$each_dis['Member']['id'];
							$this->DispatchDeal->create();
							$this->DispatchDeal->save($dispatch_entry);
						}
						
						if(count($deals_id)>1)
						{
                     $updation= $this->Deal->updateAll(array('Deal.accept_preview'=>'"Dispatched"'),array('Deal.id in'=>$deals_id));
                  }						
						else
						{
							
							$updation= $this->Deal->updateAll(array('Deal.accept_preview'=>'"Dispatched"'),array('Deal.id'=>$deals_id[0]));
                  }						
							
						if($updation)
						{
							$this->Session->write('success','Dispatched NewsLetters has been added successfully.');
							$this->redirect(array('controller'=>'NewsLetters','action'=>'dispatched/'.$newsletter_locid));
						}
					}	
				}
				else
				{
					$this->Session->write('error','You must have to accept newsletter preview.');
					$this->redirect(array('controller'=>'NewsLetters','action'=>'daily_newsletter/'.$newsletter_locid));
				}
			}
			else 
			{
				//$this->Session->write('error','You must have to accept newsletter preview.');
				$this->redirect(array('controller'=>'NewsLetters','action'=>'daily_newsletter/'.$newsletter_locid));
			}
			
		}
		
  function admin_dispatched_newsletters() 
  {		
		     $this->layout = "admin";
		     $options = $this->Location->find('all',array('fields'=>array('Location.id','Location.name')));				
       $menadatory_loc=array();		
						if(!empty($options))
						{
							foreach($options as $each_option)
							{
								$menadatory_loc[$each_option['Location']['id']]=$each_option['Location']['name'];
							}
						}
				 $this->set('location',$menadatory_loc);
			  if (!empty($this->request->data))
					{
					   $conditions = array('Dispatch.status'=>'pending');
					   $startdate = trim(@$_POST['data']['StartDate']);
					   $enddate = trim(@$_POST['data']['EndDate']);
					   $location = trim(@$_POST['data']['location']);
					   
						  if($startdate !="")
						  {
										$startDate = date('Y-m-d',strtotime($startdate));
										$conditions =array_merge($conditions,array('Dispatch.sent_date >= '=>$startDate));
						  }
						  if($enddate !="")
						  {
								  $endDate = date('Y-m-d',strtotime($enddate));
							   	$conditions =array_merge($conditions,array('Dispatch.sent_date <='=>$endDate));
						  }
						  if($location !="")
						  {
							   	$conditions =array_merge($conditions,array('Dispatch.newsletter_location'=>$location));
						  }
						  
						  $all=$this->Dispatch->find('all',array('conditions'=>	$conditions,'contain'=>array('Location','DispatchDeal'=>array('Deal'=>array('fields'=>array('Deal.id','Deal.name','Deal.member_id','Deal.image','Deal.location','Deal.category'),'DealCategory'))),'order'=>array('Dispatch.sent_date DESC')));
					   $this->set('dispatched',$all);			
			  }
			  else 
			  {
				    $all=$this->Dispatch->find('all',array('conditions'=>array('Dispatch.status'=>'pending'),'contain'=>array('Location','DispatchDeal'=>array('Deal'=>array('fields'=>array('Deal.id','Deal.name','Deal.member_id','Deal.image','Deal.location','Deal.category'),'DealCategory'))),'order'=>array('Dispatch.sent_date ASC')));
								 
			  }
			  //pr($all);die;
			  $this->set('dispatched',$all);
			  if ($this->RequestHandler->isAjax())
			  {
					$this->layout='';
					$this->autoRender=false;
					$this->viewPath= 'Elements'.DS.'backend'.DS.'NewsLetter';
					$this->render('dispatched_newsletter_list');
			  }
			  
				
		}
		function admin_archieve_newsletters() 
		{		
		    $this->layout = "admin";
		    $options = $this->Location->find('all',array('fields'=>array('Location.id','Location.name')));				
			$menadatory_loc=array();		
			if(!empty($options))
			{
				foreach($options as $each_option)
				{
					$menadatory_loc[$each_option['Location']['id']]=$each_option['Location']['name'];
				}
			}
			$this->set('location',$menadatory_loc);					
					
			if (!empty($this->request->data))
			{
				$conditions = array('Dispatch.status'=>'sent');
				$startdate = trim(@$_POST['data']['StartDate']);
				$enddate = trim(@$_POST['data']['EndDate']);
				$location = trim(@$_POST['data']['location']);

				if($startdate !="")
				{
							$startDate = date('Y-m-d',strtotime($startdate));
							$conditions =array_merge($conditions,array('Dispatch.sent_date >= '=>$startDate));
				}
				if($enddate !="")
				{
					  $endDate = date('Y-m-d',strtotime($enddate));
					$conditions =array_merge($conditions,array('Dispatch.sent_date <='=>$endDate));
				}
				if($location !="")
				{
					$conditions =array_merge($conditions,array('Dispatch.newsletter_location'=>$location));
				}

				$all=$this->Dispatch->find('all',array('conditions'=>	$conditions,'contain'=>array('Location','DispatchDeal'=>array('Deal'=>array('fields'=>array('Deal.id','Deal.name','Deal.member_id','Deal.image','Deal.location','Deal.category'),'DealCategory'))),'order'=>array('Dispatch.sent_date DESC')));
				$this->set('dispatched',$all);			
			}
			else 
			{
				$all=$this->Dispatch->find('all',array('conditions'=>array('Dispatch.status'=>'sent'),'contain'=>array('Location','DispatchDeal'=>array('Deal'=>array('fields'=>array('Deal.id','Deal.name','Deal.member_id','Deal.image','Deal.location','Deal.category'),'DealCategory'))),'order'=>array('Dispatch.sent_date DESC')));
				$this->set('dispatched',$all);			 
			}
			//pr($all);die;
			if ($this->RequestHandler->isAjax())
			{
				$this->layout='';
				$this->autoRender=false;
				$this->viewPath= 'Elements'.DS.'backend'.DS.'NewsLetter';
				$this->render('dispatched_newsletter_list');
			}
		}		
		
		function admin_send_dispatched($id=NULL)
		{
			$this->layout = "admin";
			$dispatched_id=convert_uudecode(base64_decode($id));
			$this->loadModel('DispatchDeal');
			$currentDate=date('Y-m-d');
			$dispatch=$this->Dispatch->find('first',array('conditions'=>array('Dispatch.sent_date <='=>$currentDate,'Dispatch.status'=>'pending')));
			//pr($dispatch);die;
			if(!empty($dispatch))
			{
            if($dispatch['Location']['id']!='')				
				    $newsletter_location=$dispatch['Location']['name'];
				else
				    $newsletter_location='';
				
				$deals_id=array();
				foreach($dispatch['DispatchDeal'] as $dispatch_deal_id)
				{
					$deals_id[]=$dispatch_deal_id['deal_id'];
				}
				
						
				//$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) limit 1');
				//$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');			
	         $this->Deal->virtualFields = array('dis'=>'select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');		
				if(count($deals_id)>1)
				   $conditions =array('Deal.id in'=>$deals_id);
	         else
	            $conditions =array('Deal.id'=>$deals_id);
	         
          
           $options = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes','Location.mandatory_location'=>'Yes'),'fields'=>array('Location.id','Location.name')));				
           $menadatory_loc=array();		
				if(!empty($options))
				{
					foreach($options as $each_option)
					{
						$menadatory_loc[]=$each_option['Location']['id'];
					}
				}          
          

         $meminfo = $this->Member->find('all',array('conditions'=>array('Member.status'=>'Active','Member.member_type'=>'4','Member.newsletters'=>'Yes'),'fields'=>array('id','email','location','news_location','news_location_updation')));
			
         $emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter')));
				
			//pr($meminfo);
			foreach($meminfo as $list)
			{
				//echo "member_id_".$list['Member']['id'];
				$memloc1 = $list['Member']['news_location'];
				$mem_location = array_filter(explode(',',$memloc1));
				
				if($list['Member']['news_location_updation']=='No')
            {
            	$mem_location=array_merge($mem_location,$menadatory_loc);
            	array_unique($mem_location);
            }	
            //echo "deal_condition";
            //pr($conditions);
					$user_deals = $this->Deal->find('all',array('conditions'=>$conditions,'fields'=>array('Deal.id','Deal.location')));
              // pr($user_deals);die;               
               $members_deal=array();					
					foreach($user_deals as $user_deal1)
					{
						$user_deal1['Deal']['location'];
						$eachdeal_loc = array_filter(explode(',',$user_deal1['Deal']['location']));
						$result=array_intersect($mem_location,$eachdeal_loc);
						
						if(count($result)>0)
						{
						    $members_deal[]=$user_deal1['Deal']['id'];
						}
					}
					//echo "member_deal";
					//pr($members_deal);
					
					if(!empty($members_deal))
					{	
					
					   $count = $this->Deal->find('count',array('conditions'=>array('Deal.id'=>$members_deal),'order'=>array('Deal.id desc'),'fields'=>array('id')));
				
						//$count = count($count_each_user_deal);
						$limit = 20;
						$loop = ceil($count/$limit);
						$offset = 0;
						//echo "count_";
						//pr($count);
						//echo "loop_".$loop;
						$mystr = '';					
						for($i=0;$i<$loop;$i++)
						{		
								$deals = $this->Deal->find('all',array('conditions'=>array('Deal.id'=>$members_deal),'order'=>array('Deal.id desc'),'offset'=>$offset,'limit'=>$limit));
								$offset +=$limit;	
								$loop_deals=array();
								$template_locations=array();
								$d=0;
								foreach($deals as $deal)
								{
									$template_locations=explode(',',$deal['Deal']['location']);
									
                           $each_template_locations=$template_locations;
                           array_unique($each_template_locations);                           
                           $dealtemp_options = $this->Location->find('all',array('conditions'=>array('Location.id'=>$each_template_locations),'fields'=>array('Location.id','Location.name')));
	                        $deal_location_text='';
	                        foreach($dealtemp_options as $temp_loc)
	                        {
	                        	$deal_location_text.=$temp_loc['Location']['name'].", ";
	                        }
	                        $deal_location_text=rtrim($deal_location_text,', ');
	                        if(strlen($deal_location_text)>40)
										$deal_location_text = substr($deal_location_text,0,40).'..';
									else
										$deal_location_text = $deal_location_text;										
									
									$img = IMPATH.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
									if(strlen($deal['Deal']['name'])>40)
										$title = substr($deal['Deal']['name'],0,40).'...';
									else
										$title = $deal['Deal']['name'];
										
										$viewurl = HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
										$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:0;
										$price = @$deal['Deal']['price']?$deal['Deal']['price']:0;
										
										$loop_deals[$d]['img']=$img;
										$loop_deals[$d]['title']=$title;
										$loop_deals[$d]['viewurl']=$viewurl;
										$loop_deals[$d]['selling_price']=$deal['Deal']['selling_price'];
				                  $loop_deals[$d]['discounted_selling_price']=$price;
										$loop_deals[$d]['dis']=$dis;
										$loop_deals[$d]['category']=$deal['DealCategory']['name'];
				                  $loop_deals[$d]['location']=$newsletter_location; //$deal_location_text;
										
									$d++;	
								}
								$loop_deals=array_chunk($loop_deals,2);				
								
								$content='';
								foreach($loop_deals as $each_loop)
								{
									$content .='<tr>';
									foreach($each_loop as $each_trdeal)
									{
								        $content .='<td width="50%">
								        	<table style="width:100%;float:left;padding:0;background:#fff;box-shadow: 0 0 5px #999;border:1px solid #ddd;">
								        		<tr style="	">
								        			<td style="">
								        				 <img style="width:100%;" src="'.$each_trdeal['img'].'" /> 
								        			</td>
								        		 </tr>
								        			<tr>
								        			<td style="" valign="top">
								        					<span style="word-wrap:break-word;float:left;width:100%;font-size:15px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:15px;margin-left: 10px; color:#428bca;">'.$each_trdeal['title'].'</span>
								        												        					
																			        			
								        			</td>
								        			
								        			</tr>
								        			
								        			<tr>
														<td>
															<p style="float:left;width:auto; color:#555;margin-left:10px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">Was </span>  <label style="color:#999;text-decoration: line-through;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['selling_price'].'</label></p>
															<p style="float:left;width:auto; color:#555; margin-left:4px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">, Now</span> <span style="color:#87c540;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['discounted_selling_price'].'</span></p>
															<a href="'.$each_trdeal['viewurl'].'" style="text-align:right;color:#fff;  margin-left:21%; margin-bottom:10px; text-decoration: none; font-size: 14px;padding:5px 8px; border-radius: 5px;float:left; background-color:#228dd6;"> View It  </a>													
														</td>				        			
								        			</tr>
								        			
								        			
								        		</table>
								        	</td>';
										
									}
									$content .='</tr>';
									
								}
								
								array_unique($template_locations);
							   $temp_options = $this->Location->find('all',array('conditions'=>array('Location.id'=>$template_locations),'fields'=>array('Location.id','Location.name')));
                        $template_location_text='';
                        foreach($temp_options as $temp_loc)
                        {
                        	$template_location_text.=$temp_loc['Location']['name'].",";
                        }
                        $template_location_text=rtrim($template_location_text,',');	
							//echo 'content_'.$content;
				            $common_template='';
								$common_template= $emailTemp1['EmailTemplate']['description'];
								$common_template = str_replace('{unsubscribe_link}','javascript:void(0)',$common_template);
								$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
								$common_template = str_replace('{content}',$content,$common_template);
								$common_template = str_replace('{newsletter_date}',date('d F Y'),$common_template);
								$common_template = str_replace('{locations}',$newsletter_location,$common_template);
								//$common_template = str_replace('{locations}',$template_location_text,$common_template);
								
									
								$email = new CakeEmail();
								$email->template('common_template');
								$email->emailFormat('both');
								$email->viewVars(array('common_template'=>$common_template));
								$email->to($list['Member']['email']);
								//$email->from($emailTemp1['EmailTemplate']['from']);
								$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Newsletter'));
								$email->subject($emailTemp1['EmailTemplate']['subject']);
								$email->send();
								
							} //for loop member info				
					
					   } // if of member deals each member newsletter
					   
				  } ////for newsletter counts info

             
//die;
			      $dispatch_update=$this->Dispatch->updateAll(array('Dispatch.status'=>'"sent"'),array('Dispatch.id'=>$dispatch['Dispatch']['id']));
			      
			      if($dispatch_update)
			      {
				      $this->Session->write('success','Dispatched NewsLetters has been added successfully.');
						$this->redirect(array('controller'=>'NewsLetters','action'=>'dispatched_newsletters'));
					}
			}
			else
			{
				$this->Session->write('error','Dispatched NewsLetters has been failed.');
				$this->redirect(array('controller'=>'NewsLetters','action'=>'dispatched_newsletters'));
			}
			
			
		}
		
function admin_archivepreview($dispatch_id=null)
{
			 $this->layout = "";
			 $this->autoRender = false;
			
     $dispatch_id=convert_uudecode(base64_decode($dispatch_id));
     $conditions=array('Dispatch.id'=>$dispatch_id);
     $dispatch_newsletter=$this->Dispatch->find('first',array('conditions'=>$conditions));

						$newsletter_location=$dispatch_newsletter['Location']['name'];
						$count = count($dispatch_newsletter['DispatchDeal']);
						$limit = 20;
						if($count>=$limit)
							  $newsletter_counts=array_chunk($dispatch_newsletter['DispatchDeal'],$limit);
						else
							  $newsletter_counts[]=$dispatch_newsletter['DispatchDeal'];
					
						
						
						$dispatch_deal_id=array();
						$d=0;
						foreach($newsletter_counts as $each_counts)
						{
									foreach($each_counts as $each)
									{
										 $dispatch_deal_id[$d][]=$each['deal_id'];
									}
									$d++;
						}
						//$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
						$this->Deal->virtualFields = array('dis'=>'select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
						foreach($dispatch_deal_id as $deal_ids)
						{
							 $deals = $this->Deal->find('all',array('conditions'=>array('Deal.id'=>$deal_ids),'order'=>array('Deal.id desc'),'fields'=>array('id','name','image','uri','dis','price','selling_price'),'contain'=>array('DealCategory'=>array('id','name'))));
         $loop_deals=array();
										$d=0;
										foreach($deals as $deal)
										{
														$img = IMPATH.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
														if(strlen($deal['Deal']['name'])>100)
															$title = substr($deal['Deal']['name'],0,100).'...';
														else
															$title = $deal['Deal']['name'];
															
															$viewurl = HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
															$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:0;
															$price = @$deal['Deal']['price']?$deal['Deal']['price']:0;
															
															$loop_deals[$d]['img']=$img;
															$loop_deals[$d]['title']=$title;
															$loop_deals[$d]['viewurl']=$viewurl;
															$loop_deals[$d]['selling_price']=$deal['Deal']['selling_price'];
									       $loop_deals[$d]['discounted_selling_price']=$price;
															$loop_deals[$d]['dis']=$dis;
															$loop_deals[$d]['category']=$deal['DealCategory']['name'];
									       $loop_deals[$d]['location']=$newsletter_location; //$deal_location_text
															
														$d++;	
										}
										
										 	$loop_deals=array_chunk($loop_deals,2);				
								
								$content='';
								foreach($loop_deals as $each_loop)
								{
									  $content .='<tr>';
											foreach($each_loop as $each_trdeal)
											{
										        $content .='<td width="50%">
								        	<table style="width:100%;float:left;padding:0;background:#fff;box-shadow: 0 0 5px #999;border:1px solid #ddd;">
								        		<tr style="	">
								        			<td style="">
								        				 <img style="width:100%;" src="'.$each_trdeal['img'].'" /> 
								        			</td>
								        		 </tr>
								        			<tr>
								        			<td style="" valign="top">
								        					<span style="word-wrap:break-word;float:left;width:100%;font-size:15px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:15px;margin-left: 10px; color:#428bca;">'.$each_trdeal['title'].'</span>
								        												        					
																			        			
								        			</td>
								        			
								        			</tr>
								        			
								        			<tr>
														<td>
															<p style="float:left;width:auto; color:#555;margin-left:10px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">Was </span>  <label style="color:#999;text-decoration: line-through;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['selling_price'].'</label></p>
															<p style="float:left;width:auto; color:#555; margin-left:4px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">, Now</span> <span style="color:#87c540;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['discounted_selling_price'].'</span></p>
															<a href="'.$each_trdeal['viewurl'].'" style="text-align:right;color:#fff;  margin-left:21%; margin-bottom:10px; text-decoration: none; font-size: 14px;padding:5px 8px; border-radius: 5px;float:left; background-color:#228dd6;"> View It  </a>													
														</td>				        			
								        			</tr>
								        			
								        			
								        		</table>
								        	</td>';
												
											}
											$content .='</tr>';
									}
										
										//<a href="'.$each_trdeal['viewurl'].'" style="text-align:right;color:#228dd6;  margin-left:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;float:right;"> View It  </a>
									
										$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter')));
										$common_template= $emailTemp1['EmailTemplate']['description'];				
										$HTTP_ROOT=rtrim(HTTP_ROOT,'/');
										$common_template = str_replace('{unsubscribe_link}','javascript:void(0)',$common_template);											
										$common_template = str_replace('{DomainPath}',$HTTP_ROOT,$common_template);
										$common_template = str_replace('{content}',$content,$common_template);
										$common_template = str_replace('{newsletter_date}',date('d F Y',strtotime($dispatch_newsletter['Dispatch']['sent_date'])),$common_template);
										$common_template = str_replace('{locations}',$newsletter_location,$common_template);
										echo $common_template;
	
       }

		}
  function admin_archiveEmail($dispatch_id=null)
  {
			   $this->layout = "";
			   $this->autoRender = false;
			 
						if(!empty($this->request->data))
						{
								$data1=$this->request->data;
								//pr($data1);die;
								$member_emails=explode(',',$data1['Member']['email']); 
				     $dispatch_id=$data1['Dispatch']['id'];
				     $conditions=array('Dispatch.id'=>$dispatch_id);
				     $dispatch_newsletter=$this->Dispatch->find('first',array('conditions'=>$conditions));
				
										$newsletter_location=$dispatch_newsletter['Location']['name'];
										$count = count($dispatch_newsletter['DispatchDeal']);
										$limit = 20;
										if($count>=$limit)
											  $newsletter_counts=array_chunk($dispatch_newsletter['DispatchDeal'],$limit);
										else
											  $newsletter_counts[]=$dispatch_newsletter['DispatchDeal'];
									
										
										
										$dispatch_deal_id=array();
										$d=0;
										foreach($newsletter_counts as $each_counts)
										{
													foreach($each_counts as $each)
													{
														 $dispatch_deal_id[$d][]=$each['deal_id'];
													}
													$d++;
										}
										//$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
										//$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
										$this->Deal->virtualFields = array('dis'=>'select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount_selling_price=(select min(discount_selling_price) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
										foreach($dispatch_deal_id as $deal_ids)
										{
											 $deals = $this->Deal->find('all',array('conditions'=>array('Deal.id'=>$deal_ids),'order'=>array('Deal.id desc'),'fields'=>array('id','name','image','uri','dis','price','selling_price'),'contain'=>array('DealCategory'=>array('id','name'))));
				         $loop_deals=array();
														$d=0;
														foreach($deals as $deal)
														{
																		$img = IMPATH.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
																		if(strlen($deal['Deal']['name'])>100)
																			$title = substr($deal['Deal']['name'],0,100).'...';
																		else
																			$title = $deal['Deal']['name'];
																			
																			$viewurl = HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
																			$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:0;
																			$price = @$deal['Deal']['price']?$deal['Deal']['price']:0;
																			
																			$loop_deals[$d]['img']=$img;
																			$loop_deals[$d]['title']=$title;
																			$loop_deals[$d]['viewurl']=$viewurl;
																			$loop_deals[$d]['selling_price']=$deal['Deal']['selling_price'];
													       $loop_deals[$d]['discounted_selling_price']=$price;
																			$loop_deals[$d]['dis']=$dis;
																			$loop_deals[$d]['category']=$deal['DealCategory']['name'];
													       $loop_deals[$d]['location']=$newsletter_location; //$deal_location_text
																			
																		$d++;	
														}
													 $loop_deals=array_chunk($loop_deals,2);				
													 $content='';
														foreach($loop_deals as $each_loop)
														{
															  $content .='<tr>';
																	foreach($each_loop as $each_trdeal)
																	{
													        $content .='<td width="50%">
								        	<table style="width:100%;float:left;padding:0;background:#fff;box-shadow: 0 0 5px #999;border:1px solid #ddd;">
								        		<tr style="	">
								        			<td style="">
								        				 <img style="width:100%;" src="'.$each_trdeal['img'].'" /> 
								        			</td>
								        		 </tr>
								        			<tr>
								        			<td style="" valign="top">
								        					<span style="word-wrap:break-word;float:left;width:100%;font-size:15px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:15px;margin-left: 10px; color:#428bca;">'.$each_trdeal['title'].'</span>
								        												        					
																			        			
								        			</td>
								        			
								        			</tr>
								        			
								        			<tr>
														<td>
															<p style="float:left;width:auto; color:#555;margin-left:10px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">Was </span>  <label style="color:#999;text-decoration: line-through;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['selling_price'].'</label></p>
															<p style="float:left;width:auto; color:#555; margin-left:4px;margin-top: 5px;"><span style="float:left;width:auto;margin-top:0px;">, Now</span> <span style="color:#87c540;margin-left:5px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R '.$each_trdeal['discounted_selling_price'].'</span></p>
															<a href="'.$each_trdeal['viewurl'].'" style="text-align:right;color:#fff;  margin-left:21%; margin-bottom:10px; text-decoration: none; font-size: 14px;padding:5px 8px; border-radius: 5px;float:left; background-color:#228dd6;"> View It  </a>													
														</td>				        			
								        			</tr>
								        			
								        			
								        		</table>
								        	</td>';
															
														 }
														   $content .='</tr>';
												}
													
													
													//<a href="'.$each_trdeal['viewurl'].'" style="text-align:right;color:#228dd6;  margin-left:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;float:right;"> View It  </a>
													
												
													$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter')));
													$common_template= $emailTemp1['EmailTemplate']['description'];				
													$HTTP_ROOT=rtrim(HTTP_ROOT,'/');
													$common_template = str_replace('{unsubscribe_link}','javascript:void(0)',$common_template);	
													$common_template = str_replace('{DomainPath}',$HTTP_ROOT,$common_template);
													$common_template = str_replace('{content}',$content,$common_template);
													$common_template = str_replace('{newsletter_date}',date('d F Y',strtotime($dispatch_newsletter['Dispatch']['sent_date'])),$common_template);
													$common_template = str_replace('{locations}',$newsletter_location,$common_template);
													//echo $common_template;die;
													
													$email_sent=0;
													foreach($member_emails as $each_member)
													{
																$email = new CakeEmail();
																$email->template('common_template');
																$email->emailFormat('both');
																$email->viewVars(array('common_template'=>$common_template));
																$email->to(trim($each_member));
																//$email->from($emailTemp1['EmailTemplate']['from']);
																$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Newsletter'));
																$email->subject($emailTemp1['EmailTemplate']['subject']);
																if($email->send())
																{
																		$email_sent=1;
																}
				          }
				          if($email_sent==1)
				            echo "success";
				          else
				            echo "error"; 
				          die;
			       }
       
		}

		}
		
		function admin_sendEmail () 
		{	
		   //pr($_POST);die;
		   $supplier_email='';
		   $salesperson_email='';
		   $email_members=array();
		   if($_POST['supplier_selection']=='yes')
		   {
		   	$supplier_email= trim($_POST['supplier_email']);
		   	array_push($email_members,$supplier_email);
		   }
		   if($_POST['salesperson_selection']=='yes')
		   {
		   	$salesperson_email= trim($_POST['salesperson_email']);
		   	array_push($email_members,$supplier_email);
		   }
		   	
		   $otherEmail= trim($_POST['otherEmail']);
		   if($otherEmail!='')
		   {
		   	array_push($email_members,$otherEmail);
		   }
			if(!empty($email_members))
			{
				//pr($_POST);die;
				//echo $_POST['otherEmail'];
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'reject_newsletter')));
				
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$name = $_POST['userName'];
					$content = $_POST['reason'];
					$common_template = str_replace('{unsubscribe_link}','javascript:void(0)',$common_template);
					$common_template = str_replace('{name}',$name,$common_template);
					$common_template = str_replace('{reason_content}',$content,$common_template);
					$email_sent = 0;
				foreach($email_members as $each_member)
				{
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));
					$email->to(trim($each_member));
					$email->from($emailTemp1['EmailTemplate']['from']);
					$email->subject($emailTemp1['EmailTemplate']['subject']);
					if($email->send())
					{
						$email_sent=1;
					}
				}
				if($email_sent==1)
					echo "success";
				else
					echo "error"; 
					die;
			}
			else
			{
				echo "error";
				die;
			}
		}
		function unsubscribe_link($id = null)
		{
			
			$this->layout = "public";			
			$member_id = convert_uudecode(base64_decode($id));
			/*$member_id = 65;
			$news_letter_location = 1;
			$data = $this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id)));
			pr($data);die;
			echo $data['Member']['news_location'];
			$new_location = explode(',',$data['Member']['news_location']);
			pr($new_location);die;
			foreach($new_location as $location)
			{
				if($news_letter_location == $location)
				{
					continue;
				}
				else
				{
					@$location1 .=$location.',';
				}
			}
			//echo $location1;
			//echo "<br>";
			$location2 = rtrim($location1,',');
			//echo $location2;die;*/
			//$this->Member->updateAll(array('Member.newsletters'=>"'No'",'Member.news_location'=>"'".$location2."'"),array('Member.id'=>$member_id));
			$this->Member->updateAll(array('Member.newsletters'=>"'No'"),array('Member.id'=>$member_id));
		}
		function admin_sendDispatchEmail($id = null)
		{
			
			$this->layout = "public";	
			$reqData = $this->data;
			//prx($reqData);
			foreach($reqData['news_letters_data'] as $data)
			{
				$info = explode('_',$data);
				$supplierId = $info[0];
				$dealId = $info[1];
				$dispatchId = $info[2];
				//echo $supplier_id;die;
				$this->Deal->virtualFields = array('dispatchDate'=>'SELECT sent_date FROM dispatches AS ds WHERE ds.id='.$dispatchId,'company_name'=>'SELECT company_name FROM member_metas AS ds WHERE ds.member_id=Deal.member_id');
				$dealInfo = $this->Deal->find('first',array('conditions'=>array('Deal.id'=>$dealId),'contain'=>array('Location','Member'=>array('MemberMeta'=>array('company_name'))),'fields'=>array('Deal.id','Deal.name','Deal.dispatchDate','Location.id','Location.name','Member.id','Member.name','Member.surname','Member.email','Deal.company_name')));
				//prx($dealInfo);
				
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'dispatch_newsletter_detail')));
				
				$common_template= $emailTemp1['EmailTemplate']['description'];
				$mem_name = $dealInfo['Deal']['company_name'];
				$mem_email = $dealInfo['Member']['email'];
				$deal_name = $dealInfo['Deal']['name'];
				$dispatch_date = date('d F Y',strtotime($dealInfo['Deal']['dispatchDate']));
				//echo $mem_email;
				$common_template = str_replace('{name}',$mem_name,$common_template);
				$common_template = str_replace('{dealName}',$deal_name,$common_template);
				$common_template = str_replace('{dispatchdate}',$dispatch_date,$common_template);
				//pr($common_template);die;
				$email = new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$common_template));
				$email->to(trim($mem_email));
				//$email->from($emailTemp1['EmailTemplate']['from']);
				$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Newsletter'));
				$email->subject($emailTemp1['EmailTemplate']['subject']);
				$email->send();
			}
			$this->Session->write('success','Dispatched Email has been sent successfully.');
			$this->redirect(array('controller'=>'NewsLetters','action'=>'dispatched_newsletters'));
			
		}
		function admin_crons_send_dispatch_newsletter()
		{
			$this->layout = "public";
			$all=$this->Dispatch->find('all',array('conditions'=>array('Dispatch.status'=>'pending'),'contain'=>array('Location','DispatchDeal'=>array('Deal'=>array('fields'=>array('Deal.id','Deal.name','Deal.member_id','Deal.image','Deal.location','Deal.category'),'DealCategory'))),'order'=>array('Dispatch.sent_date ASC')));
			pr($all);die;
							
			
		}
	}
?>