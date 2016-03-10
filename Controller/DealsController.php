<?php 
ob_start();
class DealsController extends AppController
{   
   var $helper=array('Html','Form','Js','Session','Tool','Tooladvance','Manip','Common');
	  var $components = array('RequestHandler','Cookie','Session','Email');
	  var $uses=array('DealCategory','Deal','Member','DealImage');

	function view($uri)
	{
		//	echo $uri;die;
		$this->layout='public';
		$this->loadModel('DealOption');
		$this->loadModel('Deal');
		$this->loadModel('Wishlist');
		$id=$this->Session->read('Member.id');
		$session_id=convert_uudecode(base64_decode($id));
		// pr($session_id);
		$this->set('session_id',$session_id);
		if(isset($_SESSION['take_tour']) && $_SESSION['take_tour'] == 1):
			$_SESSION['take_tour']='';
			unset($_SESSION['take_tour']);
		endif;
		// $feed_id=$this->Wishlist->find('list',array('conditions'=>array('Wishlist.member_id'=>$session_id),'fields'=>array('feed_id')));

		/*   ===========  Multiple location  =============== */
		/*$multiple_location='';
		foreach($data1['Deal']['location'] as $each_loc)
		{
		$multiple_location.=$each_loc.",";
		}
		$multiple_location=rtrim($multiple_location,',');
		$data1['Deal']['location']=$multiple_location;*/
		/*   ========================== */
		$uri_exist=$this->Deal->find('count',array('conditions'=>array('Deal.active'=>'Yes','Deal.uri'=>$uri))); 	  
		$deal_info=$this->Deal->find('all',array('conditions'=>array('Deal.active'=>'Yes'),'order'=>'Deal.id desc','limit'=>'3','contain'=>array('DealOption','DealImage')));
		//pr($deal_info);die;
		$deal_info2=array();
		foreach($deal_info as $deal_info1)
		{
			foreach($deal_info1['DealOption'] as $select_key=>$select_value)
			{
				$dealoption[$select_key]=$select_value['discount'];
			}
			$select_opt=$this->max_key($dealoption);
			$deal_info1['DealOption']=@$deal_info1['DealOption'][$select_opt];
			$deal_info1['DealImage']=@$deal_info1['DealImage'];
			$deal_info2[]=$deal_info1;
		}
		//pr($deal_info2);die;
		$this->set('deal_info',$deal_info2);    
		//pr($deal_info);die;
		if($uri_exist)
		{
			//$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on order_deal_relations.order_id=orders.id and orders.order_status="success" where `deal_id`= Deal.id');
			$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on order_deal_relations.order_id=orders.id and orders.order_status!="failed" && orders.delete_status!="Admin-del"  where order_deal_relations.refund_status!="Yes"  && `deal_id`= Deal.id');		
			$find_deal=$this->Deal->find('first',array('conditions'=>array('Deal.active'=>'Yes','Deal.uri'=>$uri),'contain'=>array('Member'=>array('MemberMeta'),'Location','DealOption','DealImage')));
			//pr($find_deal);die;
			foreach($find_deal['DealOption'] as $select_key=>$select_value)
			{
				$dealoption[$select_key]=$select_value['discount_selling_price'];
			}
			$select_opt = array_keys($dealoption,min($dealoption));
			//pr($select_opt);die;
			//pr($dealoption);die;
			$select = $select_opt[0];
			$find_deal['MaxDealOption']=$find_deal['DealOption'][0];
			//$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on order_deal_relations.order_id=orders.id and orders.order_status!="failed" && orders.delete_status!="Admin-del"  where order_deal_relations.refund_status!="Yes"  && `deal_id`= Deal.id');		
			$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on order_deal_relations.order_id=orders.id and orders.order_status!="failed" && orders.delete_status!="Admin-del"  where order_deal_relations.refund_status!="Yes"  && `deal_id`= Deal.id');		   
			$wish = $this->Wishlist->find('first',array('conditions'=>array('Wishlist.member_id'=>$session_id,'Wishlist.deal_id'=>$find_deal['Deal']['id'])));
			//$wishId = $wish['Wishlist']['id'];
			$this->set(compact('wish'));
			if(empty($find_deal['DealOption']))
			$this->redirect(array('controller'=>'Deals','action'=>'deal_not_exist'));
			//pr($find_deal);die;
			$this->set('find_deal',$find_deal);
			$today_date=date('Y-m-d H:i:s');
			$this->Deal->updateAll(array('Deal.mac_ip'=>"'".$_SERVER['REMOTE_ADDR']."'",'Deal.updated'=>"'".$today_date."'"),array('Deal.id'=>$find_deal['Deal']['id']));
		}
		else
		{
			$this->redirect(array('controller'=>'Deals','action'=>'deal_not_exist'));
		}
		//$uri$this->uri('h ');
	} 

  function send_message($to=null,$from=null,$msg=null)
  {
     $this->loadModel('Message');
     if(!empty($to) && !empty($from))
     {
 				    $data=$this->data;
         $data['Message']['to_id'] = $to;
         $data['Message']['from_id'] = $from;
         $data['Message']['status'] = 'unread';
         $data['Message']['message'] = $msg;
         $data['Message']['conversation_id'] = $this->random_string();
         $this->Message->save($data);
        // $this->Session->write('success','Your Message has been sent successfully.');
         echo "Message has been sucessfully added";
     }
    die;
  }

  function admin_categories()
  {
       
     $this->layout = 'admin';
  }

 function admin_moveup($id=NULL)
 {
	    if($id==NULL)
            die("No ID received");
        $this->DealCategory->id=$id;
        if($this->DealCategory->moveUp()==false)
            $this->Session->setFlash('The Deal Category could not be moved up.');
        $this->redirect(array('action'=>'index'));
 }

function admin_movedown($id=null)
 {
        if($id==null)
            die("No ID received");
        $this->DealCategory->id=$id;
        if($this->DealCategory->moveDown()==false)
            $this->Session->setFlash('The Deal Category could not be moved down.');
        $this->redirect(array('action'=>'index'));
 }
	
 function admin_removeNode($id=null)
 {
	   if($id==null)
		     die("Nothing to Remove");
	   if($this->DealCategory->removeFromTree($id,true)==false)
	   {
		      $this->Session->write('error','The Deal Category can\'t be removed.');
	   }
	   else
	   {
		      $this->Session->write('success','The Deal Category removed successfully.');	
	   }
        $this->redirect(array('action'=>'index'));	
 }
	
	function admin_getnodes()
	{
		// retrieve the node id that Ext JS posts via ajax
		//print_r($this->params);
		
		$parent = trim(intval($this->params['data']['node']));
		//echo $parent;
		// find all the nodes underneath the parent node defined above
		// the second parameter (true) means we only want direct children
		$nodes = $this->DealCategory->children($parent, true);
		//echo "<pre>";print_r($nodes);die;
		// send the nodes to our view
		$this->set(compact('nodes'));
		//$this->DealCategory->recover();
	}
	
	function admin_reorder()
	{
		
		// retrieve the node instructions from javascript
		// delta is the difference in position (1 = next node, -1 = previous node)
		////echo "<pre>";print_r($this->params);die;
		$node = trim(intval($this->params['data']['node']));
		$delta = trim(intval($this->params['data']['delta']));
		
		if ($delta > 0) {
			$this->DealCategory->moveDown($node, abs($delta));
		} elseif ($delta < 0) {
			$this->DealCategory->moveUp($node, abs($delta));
		}
		
		// send success response
		exit('1');
		
	}
	
	function admin_reparent()
	{
		
		$node = intval($this->params['data']['node']);
		$parent = intval($this->params['data']['parent']);
		$position = intval($this->params['data']['position']);
		
		// save the employee node with the new parent id
		// this will move the employee node to the bottom of the parent list
		
		$this->DealCategory->id = $node;
		$this->DealCategory->saveField('parent_id', $parent);
		
		// If position == 0, then we move it straight to the top
		// otherwise we calculate the distance to move ($delta).
		// We have to check if $delta > 0 before moving due to a bug
		// in the tree behaviour (https://trac.cakephp.org/ticket/4037)
		
		 if ($position == 0)
		 {
			    $this->DealCategory->moveUp($node, true);
		 }
		 else
		 {
			   $count = $this->DealCategory->childCount($parent, true);
			   $delta = $count-$position-1;
			   if ($delta > 0)
			   {
				    $this->DealCategory->moveUp($node, $delta);
			   }
		}
		
		// send success response
		exit('1');
		
	}

function admin_add_category()
{
		$this->layout='admin';
		
  		if (!empty($this->data)) {
				if($this->data['DealCategory']['parent_id']==0)
				{
					 $data2['DealCategory']['parent_id']=NULL;
				}
				else
				{
				  	$data2['DealCategory']['parent_id']=$this->data['DealCategory']['parent_id'];
				}
				$data1['DealCategory']['parent_id']=$data2['DealCategory']['parent_id'];
				$data1['DealCategory']['name']=$this->data['DealCategory']['name'];
				$deal_category_uri=$this->uri($this->data['DealCategory']['name']);
				if($data1['DealCategory']['parent_id']!=0 && $data1['DealCategory']['parent_id']!='' && (trim(strtolower($this->data['DealCategory']['name'])=='others') || trim(strtolower($this->data['DealCategory']['name'])=='other')))
				{
			     $deal_category_uri=$deal_category_uri."_".$data1['DealCategory']['parent_id'];
				}
        		$data1['DealCategory']['uri'] =$deal_category_uri;
       		// pr($data1);die;
					$this->DealCategory->create();
					$this->DealCategory->save($data1);
					
					$id=$this->DealCategory->getLastInsertId();
				
					$this->Session->write('success','DealCategory added successfully.');
					$this->redirect(array('Controller'=>'Deals','action'=>'admin_categories'));
        } else {
            $parents[] = "[ No Parent ]";
            $Categorylist = $this->DealCategory->generateTreeList(null,null,null," - ");
            if($Categorylist)
            {
                foreach ($Categorylist as $key=>$value)
                {
                    $cat_arr=explode(' - ',$value);
																		//if(count($cat_arr)==1 || count($cat_arr)==2)
																		if(count($cat_arr)==1)																	
																		{
																		    $parents[$key] = $value;
																		}
		              }
		            $this->set(compact('parents'));
	           }
        }
 }

function admin_edit_category($id=null)
{
		$this->layout='admin';
		configure::write('debug',2); 
		$rec=$this->DealCategory->find('first',array('conditions'=>array('DealCategory.parent_id'=>$id)));
		//pr($rec);die;
		$this->set('parent',$rec);
		if (!empty($this->data))
		{
				//echo "<pre>";print_r($this->data);die;	
				$data1=$this->data;
				$data1['DealCategory']['id']=$id;
				$parents_child=$this->DealCategory->children($id);
				//echo "<pre>";print_r($parents_child);die;
				if(!empty($parents_child))
				{
					$childs=array();
					if(count($parents_child)>1)
					{
						foreach($parents_child as $cat_childd)
						{
						 $childs[]=$cat_childd['DealCategory']['id'];
						}
						$this->DealCategory->updateAll(array('DealCategory.active'=>"'".$data1["DealCategory"]["active"]."'"),array('DealCategory.id in'=>$childs));
					}
					else 
					{
						foreach($parents_child as $cat_childd)
						{
						 $childs[]=$cat_childd['DealCategory']['id'];
						}
					   $this->DealCategory->updateAll(array('DealCategory.active'=>"'".$data1['DealCategory']['active']."'"),array('DealCategory.id'=>$childs));
					}
					
				}
			
            $deal_category_uri=$this->uri($this->data['DealCategory']['name']);
            if($data1['DealCategory']['parent_id']!=0 && $data1['DealCategory']['parent_id']!='' && (trim(strtolower($this->data['DealCategory']['name'])=='others') || trim(strtolower($this->data['DealCategory']['name'])=='other')))
				{
			     $deal_category_uri=$deal_category_uri."_".$data1['DealCategory']['parent_id'];
				}

				if($data1['DealCategory']['parent_id']==0)
				{
					$data1['DealCategory']['parent_id']=NULL;
				}
				
            $data1['DealCategory']['uri'] =$deal_category_uri;
				$this->DealCategory->save($data1);
				
		  $this->Session->write('success','DealCategory updated successfully.');
      $this->redirect(array('action'=>'admin_categories'));
		
    }
   else
   {
		$this->redirect(array('action'=>'admin_categories'));
           if($id==null) die("No ID received");
			        $this->set('id',$id);
           $this->data = $this->DealCategory->read(null, $id);
			        //echo "<pre>";print_r($this->data);die;
            $parents[0] = "[ No Parent ]";
            $Categorylist = $this->DealCategory->generateTreeList(array('DealCategory.active'=>'Yes'),null,null," - ");
            if(!empty($Categorylist))
            { 
                foreach ($Categorylist as $key=>$value)
                {
                    $cat_arr=explode(' - ',$value);
							//if(count($cat_arr)==1 || count($cat_arr)==2)
							if(count($cat_arr)==1)
							{
								 $parents[$key] = $value;
							}
                }
            }
			   //$this->DealCategory->recover();		
            $this->set(compact('parents'));
   }
 }

 function admin_delete($id=null)
 {
       if($id==null)
            die("No ID received");
      $this->DealCategory->id=$id;
      if($this->DealCategory->delete()==false)
			   {	
			        
           	$this->Session->setFlash('error','The DealCategory could not be deleted.');
			   }
			   else
			   {
            //$this->Deal->deleteAll(arra);				        
				        $this->Session->write('success','DealCategory deleted successfully.');
			   }
        $this->redirect(array('action'=>'admin_categories'));
  }


	function add_deal($dealer_id=NULL)
	{
		$this->loadModel('DealOption');
		$this->autoRender = false;
		if(!empty($this->data)) 
		{
			$data2=$_POST['data2'];
			//pr($data2);die;
			$mem_id =  $this->Session->read('Member.id');
			if($mem_id=='')
			{
				$mem_id = $dealer_id; 
			}
			$data1 = $this->data;
			if($data1['main_image']!= '' && !empty($data1['main_image'])) :
				//echo "<pre>";print_r($data1);die;
				$data1['Deal']['member_id'] = convert_uudecode(base64_decode($mem_id));
				$deal_uri=$this->uri($this->data['Deal']['name']);
				$data1['Deal']['uri'] =  $deal_uri;
				//$data1['Deal']['buy_from']=date("Y-m-d H:i:s");
				$data1['Deal']['registered']=date('Y-m-d H:i:s');	
				$data1['Deal']['description'] = $this->data['Deal']['description'];
				/* For changing supplier newsletter status (Start) */					
				if($data1['Deal']['newsletter_sent_date'] != '')
				{
					//echo "hii";die;
					$data1['Deal']['supplier_newsletter_status']='pending';
				}
				else
				{
					$data1['Deal']['supplier_newsletter_status']='no';
				}
				/* ---------------------- Mode of Payment by Gurudutt Sharma Start------------------------------- */
				if(@$data1['Deal']['modePayment'] == 'on')
				{
					$data1['Deal']['modePayment'] = 'All';
				}
				else
				{
					$data1['Deal']['modePayment'] = 'EFT';
				}
				/* ---------------------- Mode of Payment by Gurudutt Sharma End------------------------------- */
				//echo $data1['Deal']['supplier_newsletter_status'];die;
				/* For changing supplier newsletter status (End) */			
				$multiple_location='';
				foreach($data1['Deal']['location'] as $each_loc)
				{
				   $multiple_location.=$each_loc.",";
				}
				$multiple_location=rtrim($multiple_location,',');
	 
				$data1['Deal']['location']=$multiple_location;

				$this->Deal->save($data1);
				$id = $this->Deal->getLastInsertId();
				if($id!="") 
				{   
					if (!empty($_FILES['deal_image']['name']) && $data1['main_image'] != '')
					{
						$Image = array();
						$count=count($_FILES['deal_image']['name']);
						$var = strpos($data1['main_image']," ");
						$main_image = ($var>0)?str_replace(" ","",$data1['main_image']):$data1['main_image'];
						//echo "<pre>";print_r($_FILES['deal_image']);
						for($i=0;$i<$count;$i++)
						{
							$view = new View($this);
							$html = $view->loadHelper('Tooladvance');
							$var = strpos($_FILES['deal_image']['name'][$i]," ");
							$good_image = ($var>0)?str_replace(" ","",$_FILES['deal_image']['name'][$i]):$_FILES['deal_image']['name'][$i];
							$upload_img_name= 'deals_'.$id.'_'.time().'_'.$good_image;
							$uploaded_type =$html->file_type ($html->ext($good_image));
							if ($uploaded_type!='image')
							{
								echo 'please upload image.';die;
							}
							$r = $html->upload(array (
								   'field_name'=>'deal_image',
								   'field_index'=>$id,
								   'file_name'=>$upload_img_name,
								   'upload_path'=>DATAPATH.'deals/',
									'cnt'=> $i)
								);
						 
							$Image['DealImage']['image_name']=$upload_img_name;      
							$Image['DealImage']['deal_id']=$id;
							$Image['DealImage']['supplier_id']=$data1['Deal']['member_id'];
							$Image['DealImage']['image_random']= $data1['hidden_img'][$i].$good_image;
							$this->DealImage->create();
							$this->DealImage->save($Image);                 
								 
						} 
						$upload_img_name = '';
						if ($r) 
						{
							$saved_images = $this->DealImage->find('all',
							array(
									'conditions' => array(
										'DealImage.deal_id' => $id,'DealImage.supplier_id' => $data1['Deal']['member_id']
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
								
							$j++;
							}
							
							$data = array();
							$data['Deal']['image'] =  $upload_img_name;
					  
							$this->Deal->id = $id;
							if($this->Deal->save($data))
							{
								$last_id=$this->Deal->getLastInsertId();
								$deal_id=$this->Deal->find('first',array('conditions'=>array('Deal.id'=>$last_id)));
								$data2[0]['DealOption']['option_title']=$this->data['Deal']['name'];
								foreach($data2 as $data3)
								{
									if($data3['DealOption']['selling_price'] != '' )
									{
										$data3['DealOption']['deal_id'] = $deal_id['Deal']['id'];
										$this->DealOption->create();
										$this->DealOption->save($data3);
									}
								}
								//  die;
								$this->Session->write('success','Your ad has been saved and submitted for approval. Once it has been approved its status will show as "Approved".'); 
								$this->redirect(array('controller'=>'suppliers','action'=>'profile',$mem_id)); 
							}
							else 
							{
								$this->Session->write('error','An Error Occur! Please try again later.'); 
								$this->redirect(array('controller'=>'suppliers','action'=>'profile',$mem_id));
								//header('Location: http://pluto.promaticstechnologies.com/cybercoupon/Suppliers/profile/'.$mem_id);
							}
						}
					}
				}
				else
				{
					$this->Session->write('error','An Error Occur! Please try again later.'); 
					$this->redirect(array('controller'=>'suppliers','action'=>'profile',$mem_id));
				}
			else :
				$this->Session->write('error','An Error Occur! Please try again later.'); 
				$this->redirect(array('controller'=>'suppliers','action'=>'profile',$mem_id));
			endif;	
		}
		
	}
  
  function parent_category()
	{
		$this->layout='';
		$this->autoRender=false;
		$cat_id=$_REQUEST['data']['Deal']['category'];
		if($cat_id!=0 && $cat_id!='')
		{
			echo "true";die;
		}
		else
		{
			echo "false";die;
		}
  	
	}
  
	function unique_deal($deal_id=NULL)
	{
		 $this->layout='';
		 $this->autoRender=false;
		 $deal_name=$_REQUEST['data']['Deal']['name'];
		 $deal_uri=$this->uri($deal_name);
		 pr($deal_uri);die;
		 if($deal_id!='')
		 {
			  $unique_deal=$this->Deal->find('count',array('conditions'=>array('Deal.uri'=>$deal_uri,'Deal.id NOT'=>$deal_id)));
		 }
		 else 
		 {
			$unique_deal=$this->Deal->find('count',array('conditions'=>array('Deal.uri'=>$deal_uri)));
		 }
		if($unique_deal>0)
		{
			  echo "false";die;
		}
		else
		{
			echo "true";die;
		}
  	}

  function unique_dealcategory()
	{
     $this->layout='';
     $this->autoRender=false;
     $deal_name=$_POST['newcategory'];
     $parent_id=$_POST['parent_category'];
     $current_categoryid=$_POST['current_categoryid'];
     if(trim(strtolower($deal_name))=='others' || trim(strtolower($deal_name))=='other')
     {
     	  $deal_uri=$this->uri('others');
     }
     else 
     {
        $deal_uri=$this->uri($deal_name);
     }
     
     if($parent_id!=0 && $parent_id!='')
		{
		   $deal_uri=$deal_uri."_".$parent_id;
		}
     if($current_categoryid!=0)
		{
		   $unique_deal=$this->DealCategory->find('count',array('conditions'=>array('DealCategory.uri'=>$deal_uri,'DealCategory.id NOT'=>$current_categoryid)));
		}
      else
      {
         $unique_deal=$this->DealCategory->find('count',array('conditions'=>array('DealCategory.uri'=>$deal_uri)));
      }
     
    
     if($unique_deal>=1)
     {
     	  echo "failed";die;
     }
     else
     {
        echo "ok";die;
     }
  	}

 function alldeal($cat=NULL)
 {
	$this->layout='public';
	//$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on order_deal_relations.order_id=orders.id and orders.order_status!="failed" && orders.delete_status!="Admin-del"  where order_deal_relations.refund_status!="Yes"  && `deal_id`= Deal.id');	
	$this->Deal->virtualFields = array('sales_deal'=>'SELECT SUM(qty) FROM order_deal_relations inner join orders on orders.id=order_deal_relations.order_id  where `order_deal_relations.deal_id`= Deal.id  && order_deal_relations.refund_status!="Yes" && orders.delete_status!="Admin-del" and orders.order_status!="failed"','max_discount_selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by do.deal_id having do.deal_id=Deal.id) limit 1','max_selling_price'=>'select selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by do.deal_id having do.deal_id=Deal.id) limit 1');
	if($cat!='')
	{		
	  $deal_cat_id=$this->DealCategory->find('first',array('conditions'=>array('DealCategory.uri'=>$cat)));
	}
	else if($cat=='')
	{
		$deal_cat_id['DealCategory']['id']='all';
	}
	//pr($deal_cat_id);die;
	if (!empty($deal_cat_id)) {
		$this->loadModel('Deal');
		$this->loadModel('DealCategory');
		$today=date('Y-m-d');
		$this->loadModel('Wishlist');
		$id=$this->Session->read('Member.id');
		$today_date=date('Y-m-d');
		$this->set('cate',$cat);
		$sess_id=convert_uudecode(base64_decode($id));
		if ($sess_id!="") {
			$favid=$this->Wishlist->find('list',array('conditions'=>array('Wishlist.member_id'=>$sess_id),'fields'=>array('deal_id')));
			$this->set('fav_id',$favid);
		}
		else {
			$favid = array();
			$this->set('fav_id',$favid);
		}
		$allcategory=$this->DealCategory->find('threaded',array('order'=>'DealCategory.name ASC'));
		
		//pr($allcategory);die;
		//$test_child=$this->DealCategory->children(97);
		//echo "<pre>";print_r($test_child);die;
		$parent_cat=array();
		$other_array=array('other','others','Other','Others');
		$parentOther=array();
		$i=0;
		foreach ($allcategory as $eachcat)
		{
			//if($eachcat['DealCategory']['active']=='Yes') 
		   //{
					$active_count=0;
					foreach ($eachcat['Deal'] as $active_deal)
					{
						if ($active_deal['active']=='Yes') {
							$active_count++;
						}
					}
					   $child_existance=0;
					   
						   if (!empty($eachcat['children']))
						   {
								foreach ($eachcat['children'] as $each_children) {
									foreach ($each_children['Deal'] as $active_deal)
									{
										if($active_deal['active']=='Yes') {
											$child_existance=1;
										}
									}
								}
							}
						
					if ($active_count>0 || $child_existance==1)
					{
						if(in_array(trim($eachcat['DealCategory']['name']),$other_array))
						{
							$parentOther['id']=$eachcat['DealCategory']['id'];
		               $parentOther['name']=$eachcat['DealCategory']['name'];
		               $parentOther['uri']=$eachcat['DealCategory']['uri'];
							$parentOther['count']=$active_count;
							//$parentOther=array($parent_deal["DealCategory"]["id"]=>$parent_deal["DealCategory"]["name"]);
						}
						else
						{	
								
								$parent_cat[$i]['id']=$eachcat['DealCategory']['id'];
								$parent_cat[$i]['name']=$eachcat['DealCategory']['name'];
								$parent_cat[$i]['uri']=$eachcat['DealCategory']['uri'];
								$parent_cat[$i]['count']=$active_count;
						}	
						
						
						if (!empty($eachcat['children']))
						{
							$findOther=array();
							$j=0;
							foreach ($eachcat['children'] as $each_children)
							{
								//if($each_children['DealCategory']['active']=='Yes') 
		                 // {
									$active_count=0;
									foreach ($each_children['Deal'] as $active_deal) 
									{
										if($active_deal['active']=='Yes')
										{
											$active_count++;
										}
									}
									if($active_count>0)
									{
										if(in_array(trim($each_children['DealCategory']['name']),$other_array))
										{
											$findOther['id']=$each_children['DealCategory']['id'];
						               $findOther['name']=$each_children['DealCategory']['name'];
						               $findOther['uri']=$each_children['DealCategory']['uri'];
											$findOther['count']=$active_count;
											//$parentOther=array($parent_deal["DealCategory"]["id"]=>$parent_deal["DealCategory"]["name"]);
										}
										else
										{
										
											$parent_cat[$i]['children'][$j]['id']=$each_children['DealCategory']['id'];
											$parent_cat[$i]['children'][$j]['name']=$each_children['DealCategory']['name'];
											$parent_cat[$i]['children'][$j]['uri']=$each_children['DealCategory']['uri'];
											$parent_cat[$i]['children'][$j]['count']=$active_count;
											$j++;
										}
									}
								//}
							}
							
							if(!empty($findOther))
							{
								$parent_cat[$i]['children'][$j]['id']=$findOther['id'];
								$parent_cat[$i]['children'][$j]['name']=$findOther['name'];
								$parent_cat[$i]['children'][$j]['uri']=$findOther['uri'];
								$parent_cat[$i]['children'][$j]['count']=$findOther['count'];
							}
							
						}
						else
						{
							$parent_cat[$i]['children']=array();
						}
						
						$i++;
					}
			//}
		}
		if(!empty($parentOther))
		{
			$parent_cat[$i]['id']=$parentOther['id'];
			$parent_cat[$i]['name']=$parentOther['name'];
			$parent_cat[$i]['uri']=$parentOther['uri'];
			$parent_cat[$i]['count']=$parentOther['count'];
		}
		
		$this->set('deal_cateogry',$parent_cat);
		//pr($parent_cat);die;	   
		/*--------------for deal loction on alldeal page---------------*/
		//$deal_location=$this->Deal->find('all',array('conditions'=>array('Deal.category'=>$deal_cat_id['DealCategory']['id'],'Deal.active'=>'yes'),'fields'=>array('Deal.id','Deal.location','Location.name'),'contain'=>array('Location'),'group'=>'Location.name'));
  $deal_location=$this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes'),'fields'=>array('Location.id','Location.name')));
		
		$this->set('location',$deal_location);
		if ($this->request->is('ajax'))
  {
					$conditions=array('Deal.active'=>'yes');
					$category_conditions=array('Deal.active'=>'yes');
					if (!empty($this->data['Category']))
     {
							$cnt = count($this->data['Category']['id']);
							if ($cnt>1)
        {
								  $conditions=array_merge($conditions,array('Deal.category IN'=>$this->data['Category']['id']));
           $category_conditions=array_merge($conditions,array('Deal.category IN'=>$this->data['Category']['id']));
							}
							else
        {
								  $conditions=array_merge($conditions,array('Deal.category'=>$this->data['Category']['id'][0]));
           $category_conditions=array_merge($conditions,array('Deal.category'=>$this->data['Category']['id'][0]));
							}
	       
					}
					if (!empty($this->data['Location']))	{
						if ($this->data['Location']['id'][0]!="All")
       {
          $location_condition=array();
          $fetch_deals=$this->Deal->find('all',array('conditions'=>$category_conditions,'fields'=>array('Deal.id','Deal.location'),'recursive'=>'-1'));
//pr($fetch_deals);
          foreach($fetch_deals as $other_deal)
									{
											$each_deals=$other_deal['Deal']['location'];
											$sub_deals=explode(',',$each_deals);
											$search_arr=$this->data['Location']['id'];
											$result=array_intersect($sub_deals,$search_arr);
//pr($sub_deals);
//pr($search_arr);
//pr($result);
											if(count($result)>0)
											{
											    $location_condition[]=$other_deal['Deal']['id'];
											}
									}
//pr($fetch_deals);die;
//pr($location_condition);
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
					//pr($conditions);die;

						}
						
					}
					$this->paginate=array('limit'=>MINLIMIT,'order'=>'Deal.id desc');
					$deal=$this->paginate('Deal',$conditions);
					$this->set('deal',$deal);
					//pr($_POST);die;
		}
		else
		{ 
         if($deal_cat_id['DealCategory']['id']=='all')
         {			
				$conditions=array('Deal.active'=>'Yes');
			}
			else 
			{
				$allChildren = $this->DealCategory->children($deal_cat_id['DealCategory']['id']);
				$cidz = array();
				foreach ($allChildren as $child_cat) 
				{
					$cidz[] = $child_cat['DealCategory']['id'];
					
				}
				
				array_push($cidz,$deal_cat_id['DealCategory']['id']);
				$cnts = count($cidz);
				if ($cnts>1)
				{
					$conditions=array('Deal.category IN'=>$cidz,'Deal.active'=>'Yes');
				}
				else
				{
					$conditions=array('Deal.category'=>$cidz,'Deal.active'=>'Yes');
				}
			}
			$this->paginate=array('limit'=>MINLIMIT,'order'=>'Deal.id desc');
			
			$deal=$this->paginate('Deal',$conditions);
			$this->set('deal',$deal);
		}
		
		if ($this->RequestHandler->isAjax()) {
			$this->layout="";
			$this->autoRender=false;
			$this->viewPath = 'Elements'.DS.'frontend'.DS.'deals';
			$this->render('all_deal_right_list');
		}
    }
    else {
       $this->redirect(array('controller'=>'Homes','action'=>'error'));
    }
 }
 
    function search_deal()
    {
       //pr($a);die;
       $this->loadModel('Deal');
      // pr($_POST);die;  
       $data=@$_POST['data'];
       //pr($data);
       $location_arr=$data['Location']['id'];
      // pr($location_arr);die;
       $this->paginate=array('limit'=>MINLIMIT,'order'=>'Deal.id desc');
       $conditions=array('Deal.location'=>$location_arr,'Deal.active'=>'yes');
       $deal=$this->paginate('Deal',$conditions);
       $this->set('deal',$deal);
       // pr($deal);die;
       if($this->RequestHandler->isAjax())
       {
          $this->layout="";
          $this->autoRender=false;
          $this->viewPath = 'Elements'.DS.'frontend'.DS.'deals';
  			       $this->render('all_deal_right_list');
       }    
    }

    function search_catgory_deal()
    {
       $this->loadModel('Deal');
       $data=@$_POST['data'];
       //pr($data);die;
       $category_arr=$data['Category']['id'];
       $this->paginate=array('limit'=>MINLIMIT,'order'=>'Deal.id desc');
       $conditions=array('Deal.category'=>$category_arr,'Deal.active'=>'yes');
       $deal=$this->paginate('Deal',$conditions);
       $this->set('deal',$deal);
       //pr($deal);die;
       if($this->RequestHandler->isAjax())
       {
            $this->layout="";
            $this->autoRender=false;
            $this->viewPath = 'Elements'.DS.'frontend'.DS.'deals';
    			$this->render('all_deal_right_list');
       }    
   }
	function share_mail() {
		$this->layout="public";
		$this->loadModel('EmailTemplate');
		if(!empty($this->data)) {
			$data=$this->data;
			$member_id=convert_uudecode(base64_decode($this->Session->read('Member.id')));
			$admin_info=$this->Member->find('first',array('conditions'=>array('Member.id'=>$member_id),'recursive'=>-1));
			$data['Recommend']['from']=$admin_info['Member']['email'];
			//pr($data);
			$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'share_mail')));
			//echo 'email'."<pre>";print_r($emailTemp1);die;
			$from=$data['Recommend']['from'];
			//pr($from);
			$common_template= $emailTemp1['EmailTemplate']['description'];
			//echo "<pre>";print_r($common_template);
			$common_template= str_replace('{from}',$from,$common_template);
			$emailto=$data['Recommend']['to'];	
			$emailfrom=$data['Recommend']['from'];	
			//pr($emailto);die;
			//pr($common_template);die;
			$email = new CakeEmail();
			$email->template('common_template');
			$email->emailFormat('both');
			$email->viewVars(array('common_template'=>$common_template));
			$email->to($emailto);
			//$email->cc('promatics.gurudutt@gmail.com');
			$email->from($emailfrom);
			$email->subject($emailTemp1['EmailTemplate']['subject']);  
			//pr($email);
			$email->send();
			//pr($common_template);die;
			//$this->Session->write('success','New Password send to your email account successfully !');	
			$this->redirect(array('controller'=>'homes','action'=>'index'));
		}
	 
	 } 
	 function edit_deal($id=null) {
	 	//$id=convert_uudecode(base64_decode($id));
	 	$this->loadModel('DealOption');
		$deal=$this->Deal->find('first',array('conditions'=>array('Deal.id'=>$id)));
		$nearest_location = $this->Location->find('all',array('conditions'=>array('Location.active'=>'Yes')));
		$this->set('edit_deal',$deal);
		//pr($deal);die;			
		$this->set('nearest_location',$nearest_location);
			
		//$deal_category = $this->DealCategory->generateTreeList($conditions=array('DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '&nbsp&nbsp&nbsp&nbsp');
		//$this->set('deal_category',$deal_category);
		//........start alphabatical category order...
		$alphabatical_category=$this->_AlphabaticalCategory2();
		$this->set('deal_category',$alphabatical_category); 
      //........end alphabatical category order...
		
		$parent_catog = $this->DealCategory->generateTreeList($conditions=array('DealCategory.parent_id'=>'','DealCategory.active'=>'Yes'), $keyPath=null, $valuePath=null, $spacer= '');
		$parent_catog_id=array_keys($parent_catog);
		$this->set('parent_catog_id',$parent_catog_id);
		if(!empty($this->data) && !empty($this->data['main_image'])) 
		{
			$data2=$_POST['data2'];
			//pr($data2);die;
			$mem_id =  $this->Session->read('Member.id');
			if($mem_id=='')
			{
				$mem_id = $dealer_id; 
			}
			$data1 = $this->data;
			//pr($data1);die;
			$deal_uri=$this->uri($this->data['Deal']['name']);
			$data1['Deal']['uri'] =  $deal_uri;
			$data1['Deal']['buy_from'] =  date('Y-m-d',strtotime($this->data['Deal']['buy_from']));
			$data1['Deal']['buy_to'] =  date('Y-m-d',strtotime($this->data['Deal']['buy_to']));
			$data1['Deal']['redeem_from'] =  date('Y-m-d',strtotime($this->data['Deal']['redeem_from']));
			$data1['Deal']['redeem_to'] =  date('Y-m-d',strtotime($this->data['Deal']['redeem_to']));
			$data1['Deal']['newsletter_sent_date'] =  date('Y-m-d',strtotime($this->data['Deal']['newsletter_sent_date']));
			$data1['Deal']['description'] = $this->data['Deal']['description'];
			if($data1['Deal']['newsletter_sent_date'] != '')
			{
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
			$multiple_location='';
			foreach($data1['Deal']['location'] as $each_loc)
			{
			   $multiple_location.=$each_loc.",";
			}
			$multiple_location=rtrim($multiple_location,',');
 
   		$data1['Deal']['location']=$multiple_location;
		$supplier_id = convert_uudecode(base64_decode($mem_id));
		$var = strpos($data1['main_image']," ");
		$main_image = ($var>0)?str_replace(" ","",$data1['main_image']):$data1['main_image'];
		if (!empty($_FILES['deal_image']['name'][0]) && (@$_FILES['deal_image']['name'][0]!=''))
			{
				
				$Image = array();
				$count=count($_FILES['deal_image']['name']);
				//echo "<pre>";print_r($_FILES['deal_image']);
				for($i=0;$i<$count;$i++)
				{
					$view = new View($this);
					$html = $view->loadHelper('Tooladvance');
					$var = strpos($_FILES['deal_image']['name'][$i]," ");
					$good_image = ($var>0)?str_replace(" ","",$_FILES['deal_image']['name'][$i]):$_FILES['deal_image']['name'][$i];
					$upload_img_name= 'deals_'.$id.'_'.time().'_'.$good_image;
					$uploaded_type =$html->file_type ($html->ext($good_image));
					if ($uploaded_type!='image')
					{
						echo 'please upload image.';die;
					}
					$r = $html->upload(array (
						   'field_name'=>'deal_image',
						   'field_index'=>$id,
						   'file_name'=>$upload_img_name,
						   'upload_path'=>DATAPATH.'deals/',
							'cnt'=> $i)
						);
				 
					$Image['DealImage']['image_name']=$upload_img_name;      
					$Image['DealImage']['deal_id']=$id;
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
						'DealImage.deal_id' => $id,'DealImage.supplier_id'=>$supplier_id
					)
				)
			);
			$j=0;
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
			$j++;
			}
			$data1['Deal']['image'] =  $upload_img_name;
			//$data1['Deal']['id']=$id;
			//pr($data1);die;
			$this->Deal->id = $id;
			if($this->Deal->save($data1))
			{	$data2[0]['DealOption']['option_title']=$this->data['Deal']['name'];
				foreach($data2 as $data3)
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
				$this->Session->write('success','Your ad has been saved and submitted for approval. Once it has been approved its status will show as "Approved".'); 
				$this->redirect(array('controller'=>'suppliers','action'=>'profile',$mem_id)); 
				
			}
			else 
			{
				$this->Session->write('error','An Error Occur! Please try again later.'); 
				$this->redirect(array('controller'=>'suppliers','action'=>'profile',$mem_id));
									
			}
			//$id = $this->Deal->getLastInsertId();
			
		}
		if ($this->RequestHandler->isAjax()) {
			$this->layout="";
			$this->autoRender=false;
			$this->viewPath = 'Elements'.DS.'frontend'.DS.'suppliers';
			$this->render('edit_deal');
		}
	}
	 
	function deleteDealImage($deal_id = NULL,$image_id = NULL)
	{
		$this->loadModel('DealImage');
		$mem_id =  $this->Session->read('Member.id');
		$member_id = convert_uudecode(base64_decode($mem_id));
		if($deal_id!='' && $image_id!=''):
			$conditions=array('DealImage.id'=>$image_id,'DealImage.deal_id'=>$deal_id,'DealImage.supplier_id'=>$member_id); 
			$this->DealImage->deleteAll($conditions);
			$this->Deal->updateAll(array('Deal.image'=>'" "'),array('Deal.id'=>$deal_id,'Deal.member_id'=>$member_id));
			
			$dealimage=$this->DealImage->find('all',array('conditions'=>array('DealImage.deal_id'=>$deal_id,'DealImage.supplier_id'=>$member_id)));
			$this->set('dealimage',$dealimage);
			
			if ($this->RequestHandler->isAjax()) {
				$this->layout="";
				$this->autoRender=false;
				$this->viewPath = 'Elements'.DS.'frontend'.DS.'suppliers';
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
		$mem_id =  $this->Session->read('Member.id');
		$member_id = convert_uudecode(base64_decode($mem_id));
		if($deal_id!='' && $matched_array!=''):
			$this->DealImage->query("DELETE FROM deal_images WHERE deal_images.deal_id = ".$deal_id." AND deal_images.id IN ('".$matched_array."')");
			$this->Deal->updateAll(array('Deal.image'=>'" "'),array('Deal.id'=>$deal_id));
			
			$dealimage=$this->DealImage->find('all',array('conditions'=>array('DealImage.deal_id'=>$deal_id,'DealImage.supplier_id'=>$member_id)));
			$this->set('dealimage',$dealimage);
			
			if ($this->RequestHandler->isAjax()) {
				$this->layout="";
				$this->autoRender=false;
				$this->viewPath = 'Elements'.DS.'frontend'.DS.'suppliers';
				$this->render('edit_deal_image');
			}
		endif;
		die;
	}
	function deal_not_exist() {

		$this->layout ="public";



	}
	
	 

}
?>  	   	   