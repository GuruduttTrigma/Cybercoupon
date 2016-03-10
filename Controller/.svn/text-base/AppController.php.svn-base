<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {	
	var $components = array('Cookie','Email','Session','RequestHandler');
	var $helpers= array('Js','Html','Form','Session','Paginator');

	function CheckAdminSession() 
	{
 		$adminSession=$this->Session->read('Admin');
     	if(isset($adminSession['id']) && isset($adminSession['email'])) 
		{
		    $this->loadModel('ModulePermission');
		    $this->loadModel('AdminModule');
			$permissions=$this->ModulePermission->find('all',array('conditions'=>array('ModulePermission.member_id'=>$adminSession['id'],'Member.member_type'=>2),'contain'=>array('AdminModule','Member'=>array('id','name','member_type'))));
			$parent_module=array();
			$global_permission=array();
			if(!empty($permissions)) 
			{ 
    		 	foreach($permissions as $permisn) 
				{  				
      				if($permisn['ModulePermission']['view_permission']==1) 
					{
						array_push($parent_module,$permisn['ModulePermission']['module_id']);
						$global_permission[$permisn['AdminModule']['module']]['module_id']=$permisn['ModulePermission']['module_id'];
						$global_permission[$permisn['AdminModule']['module']]['module_name']=$permisn['AdminModule']['module'];
            			$global_permission[$permisn['AdminModule']['module']]['module_view']=$permisn['ModulePermission']['view_permission'];
                		if($permisn['ModulePermission']['edit_permission']==1) 
						{ 
            				$global_permission[$permisn['AdminModule']['module']]['module_edit']=1;
            			}
            			else 
						{  
            				$global_permission[$permisn['AdminModule']['module']]['module_edit']=0;
            			}
						
   					}
   				}
			}
    		else 
			{
				$parent_module=array();
				$global_permission=array();
			}	
			$sub_modules=$this->AdminModule->find('list');
			$sub_modules_keys=array_keys($sub_modules);
			//pr($global_permission);
			$this->set('parent_modules',$parent_module);
			$this->set('sub_modules',$sub_modules_keys);
			$this->set('modulepermissions',$global_permission);
			$subadmin_type=$this->Session->read('Admin.admin_type');
			$this->set('subadmin_type',$subadmin_type);
			return true;
		}
		else 
		{		
			return false;
		}	
	}
	
  function beforeFilter() 
  {
		$this->loadModel('Deal');
		if($this->params->action=='view')
		{

		   $global_deal_uri=$this->params->pass[0];
			$uri_exist=$this->Deal->find('count',array('conditions'=>array('Deal.active'=>'Yes','Deal.uri'=>$global_deal_uri)));
			if($uri_exist>0)
			{
				$find_deal=$this->Deal->find('first',array('conditions'=>array('Deal.active'=>'Yes','Deal.uri'=>$global_deal_uri),'fields'=>array('Deal.id','Deal.image'),'contain'=>array()));
				$global_image_name=$find_deal['Deal']['image'];
				$view = new View($this);
				$html = $view->loadHelper('Tool');
				$sub = $html->subdir($find_deal['Deal']['id']).$global_image_name;
				$custom_path=DATAPATH.'deals/'.$sub;
				$this->set('custom_path',$custom_path);
				
				$global_deal_uri_path=IMPATH.'deals/'.$global_image_name;
				$this->set('global_deal_uri_path',$global_deal_uri_path);
			}
		}
    	//$this->disableCache();
    	/*if($_SERVER['HTTPS']!=”on”)
    	{ 
    	   $redirect= “https://”.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    	   header(“Location:$redirect”); 
    	}*/
    	//pr($this->Session->read('Admin'));die;
    	if(!$this->CheckAdminSession() && $this->request->prefix=='admin' && !in_array($this->request->action,array('admin_login','admin_forgot_password','admin_reset_password'))) {
    		$this->redirect(array('controller'=>'auths','action' => 'login','admin' => true));
    		exit();
    	}
		if(!$this->Session->check('Member') && $this->request->prefix!='admin' && in_array($this->request->action,array('view_profile','profile','edit_profile','change_password'))) {
      		$this->redirect(array('controller'=>'Homes','action' => 'index'));
      		exit();
    	}  		
		$this->loadModel('DealCategory');
		$this->loadModel('Cart');
		$this->loadModel('Deal');
		$this->loadModel('Location');
		/*----------for header cateogroy----------*/
		$cateogry_head=$this->DealCategory->find('threaded',array('order'=>'DealCategory.name ASC'));
		//echo "<pre>";print_r($cateogry_head);die;
		$parent_cat=array();
		$i=0;
		foreach ($cateogry_head as $eachcat)
		{
		//if($eachcat['DealCategory']['active']=='Yes') 
			//{	
            //pr($eachcat);			
			
					$active_count=0;
					if(!empty($eachcat['Deal']))
					{
						foreach ($eachcat['Deal'] as $active_deal) {
							if ($active_deal['active']=='Yes') {
								$active_count++;
							}
						}
					}
					   $child_existance=0;
					   
						   if (!empty($eachcat['children']))
							{
								foreach ($eachcat['children'] as $each_children) {
									if(!empty($each_children['Deal']))
									{
										foreach ($each_children['Deal'] as $active_deal) {
											if($active_deal['active']=='Yes') {
												$child_existance=1;
											}
										}
									}
								}
							}
					//pr($eachcat);		
					//echo $active_count;	echo $child_existance;	
					if ($child_existance==1)
					{
						$parent_cat[$i]['id']=$eachcat['DealCategory']['id'];
						$parent_cat[$i]['name']=$eachcat['DealCategory']['name'];
						$parent_cat[$i]['uri']=$eachcat['DealCategory']['uri'];
						$parent_cat[$i]['count']=$active_count;
						if (!empty($eachcat['children'])) {
							$j=0;
							foreach ($eachcat['children'] as $each_children)
							{
								if($each_children['DealCategory']['active']=='Yes') 
								{
									$active_count=0;
									foreach ($each_children['Deal'] as $active_deal) {
										if($active_deal['active']=='Yes') {
											$active_count++;
										}
									}
									if($active_count>0)
									{
										$parent_cat[$i]['children'][$j]['id']=$each_children['DealCategory']['id'];
										$parent_cat[$i]['children'][$j]['name']=$each_children['DealCategory']['name'];
										$parent_cat[$i]['children'][$j]['uri']=$each_children['DealCategory']['uri'];
										$parent_cat[$i]['children'][$j]['count']=$active_count;
										$j++;
									}
								}
							}
						}
						else {
							$parent_cat[$i]['children']=array();
						}
						$i++;
					}
			//}
		}
		//pr($parent_cat);die;
		//pr($cateogry_head);die;
		$this->set('cateogry_head',$parent_cat);
		/*----------for location----------*/
		$options = $this->Location->find('all',array('fields'=>array('Location.id','Location.name')));
		$this->set('options',$options);
		/* .........for currency ......*/
		$this->loadModel('CurrencyManagement');
		$currency1=$this->CurrencyManagement->find('first',array('conditions'=>array('CurrencyManagement.active'=>'Yes')));
		if(!empty($currency1))
		{
				$currency=$currency1['CurrencyManagement']['currency'];
		  $currency_code=$currency1['CurrencyManagement']['currency_code'];
		}
		else
		{
				$currency='R';
				$currency_code='ZAR';
		}
		$this->set('currency',$currency);
		$this->set('currency_code',$currency_code);
		/*@@@@@@@@@@@@@@@@@@@@ for cms @@@@@@@@@@@@@@@@*/
		$this->loadModel("CmsPage");
		$aboutUs = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.id'=>1)));	
		$termCondition = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.id'=>2)));	
		$privacyPolicy = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.id'=>3)));					
		$copyright = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.id'=>24)));					
		$this->set('aboutUs',$aboutUs);
		$this->set('termCondition',$termCondition);
		$this->set('privacyPolicy',$privacyPolicy);			
		$this->set('copyright',$copyright);			
		$prev_deal=$this->Deal->find('all',array('conditions'=>array('Deal.active'=>'Yes','Deal.buy_from <'=>date("Y-m-d"),'Deal.buy_to <'=>date("Y-m-d")),'fields'=>array('Deal.id'),'recursive'=>'-1'));
		if (!empty($prev_deal))
		{
			$this->Deal->updateAll(array('Deal.active'=>"'No'"),array('Deal.active'=>'Yes','Deal.buy_from <'=>date("Y-m-d"),'Deal.buy_to <'=>date("Y-m-d")));
		}
		//..........end check deal activity....

      //....................cms for competion..
      $competitions = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'competitions')));
		$this->set('competitions',$competitions);
		$banner = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'Banner')));

		$this->set('banner',$banner);
		$winner = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'winner')));
		$this->set('competition_winner',$winner);

	}
	public function uri ($msg) {
		$msg = trim($msg);
    	$abc = '_abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
    	$trs = array (' '=>'_', 'á'=>'a', 'é'=>'e', 'í'=>'i', 'ó'=>'o', 'ú'=>'u', 'à'=>'a', 'è'=>'e', 'ì'=>'i',
    				'ò'=>'o', 'ù'=>'u', 'ä'=>'a', 'ë'=>'e', 'ï'=>'i', 'ö'=>'o', 'ü'=>'u', 'Á'=>'a', 'É'=>'e',
    				'Í'=>'i', 'Ó'=>'o', 'Ú'=>'u', 'À'=>'a', 'È'=>'e', 'Ì'=>'i', 'Ò'=>'o', 'Ù'=>'u', 'Ä'=>'a',
    				'Ë'=>'e', 'Ï'=>'i', 'Ö'=>'o', 'Ü'=>'u', 'ç'=>'c', 'Ç'=>'c', 'ñ'=>'n', 'Ñ'=>'n');
    	
    	$trs2 = array ('_egrave_'=>'e','_agrave_'=>'a','_igrave_'=>'i','_ograve_'=>'o','_ugrave_'=>'u','_ntilde_'=>'n',
    				'_oacute_'=>'o','_aacute_'=>'a','_eacute_'=>'e','_iacute_'=>'i','_uacute_'=>'u');
    	
    	foreach ($trs as $key=>$tr) $msg = str_replace ($key, $tr, $msg);
    	$lenabc = mb_strlen ($abc, 'utf8');
    	$len    = mb_strlen ($msg, 'utf8');
    	$find   = false;
    	$nmsg   = '';
    	for ($i=0;$i<=$len;$i++) {
    		$lt = mb_substr ($msg,$i,1,'utf8');
    		$u  = false;
    		if ($lt!='') $u  = mb_strpos ($abc,$lt,0,'utf8');
    		if ($u) {
    			$nmsg .= $lt;
    		} else {
    			$nmsg .= '_';
    		}
    	};
    	$msg = $nmsg;
		$msg = str_replace ('_-_', '_',$msg);
		$msg = str_replace ('_-_', '_',$msg);
		$msg = str_replace ('___', '_',$msg);
		$msg = str_replace ('__',  '_',$msg);
    	$msg = mb_convert_encoding ($msg, 'ASCII', mb_detect_encoding($msg));
    	$msg = strtolower(rawurlencode($msg));
    	
    	foreach ($trs2 as $key=>$tr) $msg = str_replace ($key, $tr, $msg);
			if (substr($msg,-1)=='_')    $msg = substr ($msg,0,strlen($msg)-1);
    	   		return $msg;
	}		
	function random_string($type = 'numeric', $len = 8) {
  		switch($type) {
  			case 'alnum' :
  			case 'numeric' :
  			case 'nozero' :
  			switch ($type) {
				case 'alnum' : $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
				case 'numeric' : $pool = '0123456789';
				break;
				case 'nozero' : $pool = '123456789';
				break;
  			}
  			$str = '';
  			for ($i=0; $i < $len; $i++) {
  				 $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
  			}
			return $str;
			break;
			case 'unique' : return md5(uniqid(mt_rand()));
			break;
  		}
	}	
	function random_string1($type = 'numeric', $len = 8) {			
		switch ($type) {
			case 'alnum' : $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'numeric' : $pool = '0123456789';
				break;
			case 'nozero' : $pool = '123456789';
				break;
			case 'calnum' : $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'unique' : return md5(uniqid(mt_rand()));
				break;
		}
		$str = '';
		for ($i=0; $i < $len; $i++)
		{
			 $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		return $str;
	}
	function max_key($array) {
		$max = max($array);
		foreach ($array as $key => $val) {
			if ($val == $max) return $key;
		}
	}
	/*---------------------random string genrator for forgot password-------------------------*/
    function RandomStringGenerator($length = 6) {
		$string='';
		$pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		for($i=0;$i<=$length;$i++) {
			$string .= $pattern{rand(0,61)};
		}
		return $string;
	}
	protected function _AlphabaticalCategory()
	{
		$dealcat = $this->DealCategory->find('threaded',array('conditions'=>array('DealCategory.active'=>'Yes'),'fields'=>array('id','parent_id','name'),'order'=>'DealCategory.name ASC','recursive'=>-1));
		if(!empty($dealcat))
		{
			$other_array=array('other','others','Other','Others');
			$alphabatical_category=array();
         $parentOther=array();
			foreach($dealcat as $parent_deal)
			{
				if(in_array(trim($parent_deal["DealCategory"]["name"]),$other_array))
				{
					$parentOther['id']=$parent_deal["DealCategory"]["id"];
               $parentOther['name']=$parent_deal["DealCategory"]["name"];
					//$parentOther=array($parent_deal["DealCategory"]["id"]=>$parent_deal["DealCategory"]["name"]);
				}
				else
				   $alphabatical_category[$parent_deal["DealCategory"]["id"]]=$parent_deal["DealCategory"]["name"];
		
				
				if(!empty($parent_deal['children']))
				{
					$findOther=array();
					foreach($parent_deal['children'] as $cat_child)
					{
						if(in_array(trim($cat_child["DealCategory"]["name"]),$other_array))
						{
							//$findOther=array($cat_child["DealCategory"]["id"]=>'&nbsp&nbsp&nbsp&nbsp'.$cat_child["DealCategory"]["name"]);
							$findOther['id']=$cat_child["DealCategory"]["id"];
                     $findOther['name']=$cat_child["DealCategory"]["name"];
						}
						else
						{
						   $alphabatical_category[$cat_child["DealCategory"]["id"]]='&nbsp&nbsp&nbsp&nbsp'.$cat_child["DealCategory"]["name"];
					   }
					}
					if(!empty($findOther))
					{
						//$alphabatical_category=array_merge($alphabatical_category,$findOther);
						$alphabatical_category[$findOther['id']]='&nbsp&nbsp&nbsp&nbsp'.$findOther['name'];
					}
				}
			}
			if(!empty($parentOther))
			{
				//$alphabatical_category=array_merge($alphabatical_category,$parentOther);
				$alphabatical_category[$parentOther['id']]=$parentOther['name'];
			}
		}
		else 
		{
			$alphabatical_category=array();
		}
		
		return $alphabatical_category;
	} 
	protected function _AlphabaticalCategory2()
	{
		$dealcat = $this->DealCategory->find('threaded',array('fields'=>array('id','parent_id','name'),'order'=>'DealCategory.name ASC','recursive'=>-1));
		if(!empty($dealcat))
		{
			$other_array=array('other','others','Other','Others');
			$alphabatical_category=array();
         $parentOther=array();
			foreach($dealcat as $parent_deal)
			{
				if(in_array(trim($parent_deal["DealCategory"]["name"]),$other_array))
				{
					$parentOther['id']=$parent_deal["DealCategory"]["id"];
               $parentOther['name']=$parent_deal["DealCategory"]["name"];
					//$parentOther=array($parent_deal["DealCategory"]["id"]=>$parent_deal["DealCategory"]["name"]);
				}
				else
				   $alphabatical_category[$parent_deal["DealCategory"]["id"]]=$parent_deal["DealCategory"]["name"];
		
				
				if(!empty($parent_deal['children']))
				{
					$findOther=array();
					foreach($parent_deal['children'] as $cat_child)
					{
						if(in_array(trim($cat_child["DealCategory"]["name"]),$other_array))
						{
							//$findOther=array($cat_child["DealCategory"]["id"]=>'&nbsp&nbsp&nbsp&nbsp'.$cat_child["DealCategory"]["name"]);
							$findOther['id']=$cat_child["DealCategory"]["id"];
                     $findOther['name']=$cat_child["DealCategory"]["name"];
						}
						else
						{
						   $alphabatical_category[$cat_child["DealCategory"]["id"]]='&nbsp&nbsp&nbsp&nbsp'.$cat_child["DealCategory"]["name"];
					   }
					}
					if(!empty($findOther))
					{
						//$alphabatical_category=array_merge($alphabatical_category,$findOther);
						$alphabatical_category[$findOther['id']]='&nbsp&nbsp&nbsp&nbsp'.$findOther['name'].' ('.$parent_deal["DealCategory"]["name"].')';
					}
				}
			}
			if(!empty($parentOther))
			{
				//$alphabatical_category=array_merge($alphabatical_category,$parentOther);
				$alphabatical_category[$parentOther['id']]=$parentOther['name'];
			}
		}
		else 
		{
			$alphabatical_category=array();
		}
		
		return $alphabatical_category;
	} 
	
   public function beforeRender()
   {
       $this->disableCache();
   }
   function referral_link()
	{
	  $this->loadModel('Referral');
	  $this->loadModel('Member');
	  $this->autoRender=false;
	  $referral_email=trim($_POST['referral_email']);
	  $referee_id=trim($_POST['referee_id']);
	  $conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Member.email'=>$referral_email);
	  $existance=$this->Member->find('first',array('conditions'=>$conditions,'fields'=>array('id','name','surname','email'),'recursive'=>0));
	  //pr($existance);die;
	  $referral_message='';
	  if(!empty($existance))
	  {
	  	   $existance_referral_id=$existance['Member']['id'];
	  	   if($referee_id>0)
	    	{
	    		if($existance_referral_id!=$referee_id)
	    		{
		    		 $referred_conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Referral.refer_id'=>$referee_id);
					 //pr($referred_conditions);
					 $parent_referral=$this->Referral->find('first',array('fields'=>array('Referral.id','Referral.refer_id','Referral.member_id','Member.email'),'conditions'=>$referred_conditions));
				    //pr($parent_referral);die;
				    if(!empty($parent_referral))
				    {
					    	$referral_id=$parent_referral['Referral']['id'];
					    	if($parent_referral['Referral']['member_id']!=$existance_referral_id)
					    	{
					    		$this->Referral->updateAll(array('Referral.member_id'=>$existance_referral_id),array('Referral.id'=>$referral_id));
					    	   $referral_message='linkupdatesuccess@@'.$referral_id.'@@'.$existance['Member']['email'];
					    	   //$referral_message='<span style="color:#0A601D;">Your link has been updated successfully.<span>';
					    	}
					    	else
					    	{
					    		$referral_message='<span style="color:red;">You are already linked to this user.<span>';
					    	}
				    }
				    else
				    {
					    	$new_refree['Referral']=array(
									    	                   'member_id'=>$existance_referral_id,
									    	                   'refer_id'=>$referee_id
									    	                 );
					    	if($this->Referral->save($new_refree))
					    	{
					    		$referralId=$this->Referral->getLastInsertId();
					    		$referral_message='linksuccess@@'.$referralId.'@@'.$existance['Member']['email'];
					    	}
				    	
				    }
			    }
			    else 
			    {
			    	 $referral_message='<span style="color:red;">You can not link yourself.</span>';
			    }
	    	}
	    	else
	    	{
	    		$referral_message='linkavailability@@'.$existance['Member']['email'];
	    	}
	  	
	  }
	  else
	  {
	  	 $referral_message='<span style="color:red;">Sorry, '.$referral_email.' is not registered as a customer. Please ensure you have the correct email address and try again.<span>';
	  }
	  
	  return $referral_message;
	  
	}
	function referral_unlink()
	{
		$this->loadModel('Referral');
		$this->loadModel('Member');
		$this->autoRender=false;
		//pr($_POST);die;
		$referral_email=trim($_POST['referral_email']);
		$referee_id=trim($_POST['referee_id']);
		@$referralId=trim($_POST['referral_id']);
		$referral_message='';
		if($referralId>0)
		{
    		 $referred_conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Referral.id'=>$referralId);
			 $parent_referral=$this->Referral->find('first',array('fields'=>array('Referral.id','Referral.refer_id'),'conditions'=>$referred_conditions));
		    if(!empty($parent_referral))
		    {
			    	$referral_id=$parent_referral['Referral']['id'];
			    	if($this->Referral->delete($referral_id))
			    	{
			    	   $referral_message='unlinksuccess';
			    	}
		    }
		    else
		    {
		    	 $referral_message='<span style="color:red;">User does not exist in our database.<span>';
		    }
		}
		return $referral_message;		
	}	 
}
?>