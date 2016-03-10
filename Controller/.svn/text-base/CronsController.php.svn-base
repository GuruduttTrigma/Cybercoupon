<?php
class CronsController extends AppController {
		var $name="Crons";
		var $components = array('RequestHandler','Cookie','Session','Email');
		var $uses = array('Member','Location','EmailTemplate','Dispatch','DealCategory','DealOption','ArchieveNewsletter','CustomerNewsletter');
		
		function beforeFilter() 
		{
			parent::beforeFilter();	
		}
		public $strs = '';
		
		
		function send_dispatched($id=NULL)
		{
			
			ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 1000);
			$this->layout = "admin";
			//if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); }
			
			$this->autoRender = false;
			$this->loadModel('DispatchDeal');
			$currentDate=date('Y-m-d');
			if($id!='')
			{
				//$dispatched_id = $id;
				$dispatched_id=convert_uudecode(base64_decode($id));
				$dispatch=$this->Dispatch->find('first',array('conditions'=>array('Dispatch.sent_date <='=>$currentDate,'Dispatch.status'=>'pending','Dispatch.id'=>$dispatched_id)));
			}
			else 
			{
				$dispatch=$this->Dispatch->find('first',array('conditions'=>array('Dispatch.sent_date <='=>$currentDate,'Dispatch.status'=>'pending')));
			}			
			if(!empty($dispatch))
			{
				if($dispatch['Location']['id']!='')				
				    $newsletter_location = $dispatch['Location']['name'];
				else
				    $newsletter_location='';
				
				$deals_id=array();
				foreach($dispatch['DispatchDeal'] as $dispatch_deal_id)
				{
					$deals_id[]=$dispatch_deal_id['deal_id'];
				}
				
				//$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) limit 1','selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');
				
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
			$last_date=date("Y-m-d H:i:s", strtotime(" -24 hours"));//yesterday
                        $todays_date=date("Y-m-d H:i:s");
			$this->CustomerNewsletter->deleteAll(array('CustomerNewsletter.sent_date <= '=>$last_date));
			$idz = array();
			$sent_news = $this->CustomerNewsletter->find('all',array('conditions'=>array('CustomerNewsletter.sent_status'=>'A','CustomerNewsletter.sent_date <= '=>$todays_date)));	
			foreach($sent_news as $sent_news):
			
				$idz[] = $sent_news['CustomerNewsletter']['customer_id'];
			endforeach;
			$total_count = $dispatch['Dispatch']['customer_count'];
			
			$meminfo = $this->Member->find('all',array('conditions'=>array('Member.status'=>'Active','Member.member_type'=>'4','Member.newsletters'=>'Yes','NOT' => array('Member.id' => $idz)),'fields'=>array('id','email','location','news_location','news_location_updation'),'limit'=>100,'contain'=>false));
			
			$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter')));
			//echo "<pre>";print_r($dispatch);	
			//echo "<pre>";print_r($meminfo);die;
			foreach($meminfo as $list)
			{
				//echo "member_id_".$list['Member']['email'];
				$memloc1 = $list['Member']['news_location'];
				$mem_location = array_filter(explode(',',$memloc1));
			        //echo "<pre>";print_r($mem_location);
				$mem_location = array_merge($mem_location,array($list['Member']['location']));
				//echo "<pre>";print_r($mem_location);
				if($list['Member']['news_location_updation']=='No')
				{
					$mem_location=array_merge($mem_location,$menadatory_loc);
					array_unique($mem_location);
				}	
				//echo "deal_condition";
				//echo "<pre>";print_r($conditions);
				$user_deals = $this->Deal->find('all',array('conditions'=>$conditions,'fields'=>array('Deal.id','Deal.location')));
				//echo "user_deals_";              
				//echo "<pre>"; print_r($user_deals);  die;           
               $members_deal=array();					
					foreach($user_deals as $user_deal1)
					{
						$eachdeal_loc = array_filter(explode(',',$user_deal1['Deal']['location']));
						$result=array_intersect($mem_location,$eachdeal_loc);
						if(count($result)>0)
						{
						    $members_deal[]=$user_deal1['Deal']['id'];
						}
					}
                    //echo "<pre>"; print_r($members_deal);
					//echo "member_deal";
					//pr($members_deal);die;
					//if($list['Member']['email']=="promatics.subhash@gmail.com")
					//{
						//echo "<pre>"; print_r($members_deal);die;
					//}
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
									$impath='https://cybercouponsa.com/im.php?f=';
									$img = $impath.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
									if(strlen($deal['Deal']['name'])>40)
										$title = substr($deal['Deal']['name'],0,40).'...';
									else
										$title = $deal['Deal']['name'];
										
										$HTTP_ROOT='https://cybercouponsa.com/';
										$viewurl = $HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
										$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:'N/A';
										$price = @$deal['Deal']['price']?$deal['Deal']['price']:'N/A';
										
										$loop_deals[$d]['img']=$img;
										$loop_deals[$d]['title']=$title;
										$loop_deals[$d]['viewurl']=$viewurl;
										$loop_deals[$d]['selling_price']=$deal['Deal']['selling_price'];
										$loop_deals[$d]['discounted_selling_price']=$price;
										$loop_deals[$d]['dis']=$dis;
										$loop_deals[$d]['category']=$deal['DealCategory']['name'];
										$loop_deals[$d]['location']=$newsletter_location;//$deal_location_text;
										
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
							$unsubscribe_link = $HTTP_ROOT.'NewsLetters/unsubscribe_link/'.base64_encode(convert_uuencode($list['Member']['id']));
							
				            $common_template='';
								$common_template= $emailTemp1['EmailTemplate']['description'];									
								$common_template = str_replace('{DomainPath}',$HTTP_ROOT,$common_template);
								$common_template = str_replace('{unsubscribe_link}',$unsubscribe_link,$common_template);
								$common_template = str_replace('{content}',$content,$common_template);
								$common_template = str_replace('{newsletter_date}',date('d F Y'),$common_template);
								$common_template = str_replace('{locations}',$newsletter_location,$common_template);
								//$common_template = str_replace('{locations}',$template_location_text,$common_template);
								//$test_email=array('promatics.subhash@gmail.com');
								//$test_email=array('rg@cyberschoolgroup.com','richardgain@gmail.com','tamlinschutte@gmail.com','promatics.subhash@gmail.com','promatics.adhish@gmail.com','info@cyberschoolgroup.com');
								if(in_array($list['Member']['email'],$list['Member']))
								{
									
									$email = new CakeEmail();
									$email->smtpOptions = array(
												'port' => '25',
												'timeout' => '30',
												'host' => 'smtp.topnet.tn',
											);
				
									$email->delivery = 'smtp';
									$email->reset();
									$email->template('common_template');
									$email->emailFormat('both');
									$email->viewVars(array('common_template'=>$common_template));
									$email->to($list['Member']['email']);
									//$email->to('promatics.shivam@gmail.com');
									$email->from($emailTemp1['EmailTemplate']['from']);
									//$email->from(array($emailTemp1['EmailTemplate']['from'] => 'Cyber Coupon Newsletter'));
									$email->subject($emailTemp1['EmailTemplate']['subject']);
									if($email->send()):
										$todayz_date=date("Y-m-d H:i:s");
										$saved_data['CustomerNewsletter']['customer_id'] = $list['Member']['id'];
										$saved_data['CustomerNewsletter']['sent_date'] = $todayz_date;
										$saved_data['CustomerNewsletter']['sent_status'] = 'A';
										$this->CustomerNewsletter->create();
										$this->CustomerNewsletter->save($saved_data);
									endif;
								
								}
								
						} //for loop member info				
					
					} // if of member deals each member newsletter
					else {
					
							$todayz_date=date("Y-m-d H:i:s");
							$saved_data['CustomerNewsletter']['customer_id'] = $list['Member']['id'];
							$saved_data['CustomerNewsletter']['sent_date'] = $todayz_date;
							$saved_data['CustomerNewsletter']['sent_status'] = 'I';
							$this->CustomerNewsletter->create();
							$this->CustomerNewsletter->save($saved_data);
						}
			
				$sent_count_news = $this->CustomerNewsletter->query("SELECT COUNT(DISTINCT customer_id) as custcount FROM customer_newsletters WHERE customer_newsletters.sent_status='A' AND customer_newsletters.sent_date <='".$todays_date."'");

$this->Dispatch->updateAll(array('Dispatch.mailsentTo'=> $sent_count_news[0][0]['custcount']),array('Dispatch.id'=>$dispatch['Dispatch']['id']));

				if($sent_count_news[0][0]['custcount'] == $total_count):
					$dispatch_update=$this->Dispatch->updateAll(array('Dispatch.status'=>'"sent"'),array('Dispatch.id'=>$dispatch['Dispatch']['id']));
		   
					if($dispatch_update)
					{
						return;
					}
				endif;
			} 	////for newsletter counts info
						
			}
			else
			{
				return;
			}
			
		}
		
		function test_dispatched($id=NULL)
		{
			$this->layout = "admin";
			if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); }
			
			$this->autoRender = false;
			$this->loadModel('DispatchDeal');
			$currentDate=date('Y-m-d');
			if($id!='')
			{
				$dispatched_id=convert_uudecode(base64_decode($id));
			   $dispatch=$this->Dispatch->find('first',array('conditions'=>array('Dispatch.sent_date <='=>$currentDate,'Dispatch.status'=>'pending','Dispatch.id'=>$dispatched_id)));
         }
         else 
         {
         	$dispatch=$this->Dispatch->find('first',array('conditions'=>array('Dispatch.sent_date <='=>$currentDate,'Dispatch.status'=>'pending')));
         }			
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
							
	         $this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1','selling_price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) LIMIT 1');		
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
									$impath='https://cybercouponsa.com/im.php?f=';
									$img = $impath.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
									if(strlen($deal['Deal']['name'])>40)
										$title = substr($deal['Deal']['name'],0,40).'...';
									else
										$title = $deal['Deal']['name'];
										
										$HTTP_ROOT='https://cybercouponsa.com/';
										$viewurl = $HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
										$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:'N/A';
										$price = @$deal['Deal']['price']?$deal['Deal']['price']:'N/A';
										
										$loop_deals[$d]['img']=$img;
										$loop_deals[$d]['title']=$title;
										$loop_deals[$d]['viewurl']=$viewurl;
										$loop_deals[$d]['selling_price']=$deal['Deal']['selling_price'];
				                  $loop_deals[$d]['discounted_selling_price']=$price;
										$loop_deals[$d]['dis']=$dis;
										$loop_deals[$d]['category']=$deal['DealCategory']['name'];
				                  $loop_deals[$d]['location']=$newsletter_location;//$deal_location_text;
										
									$d++;	
								}
								$loop_deals=array_chunk($loop_deals,2);				
								
								$content='';
								foreach($loop_deals as $each_loop)
								{
if(count($each_loop)==1)
{
									$content .='<tr>';
									foreach($each_loop as $each_trdeal)
									{

								        $content .='<td width="50%" style=" padding:10px 10px 10px 10px;border:1px solid #ddd;">
								        	<table style="width:100%;padding:0; ">
								        		<tr>
								        			<td style="">
								        				 <img style="width:100%;" src="'.$each_trdeal['img'].'" /> 
								        			</td>
								        		 </tr>
								        			<tr>
								        			<td style="" valign="top">
								        					<dl style="word-wrap:break-word;width:100%;font-size:15px;font-weight:bold;width:100%; margin-top:15px;margin-left: 10px; color:#428bca;">'.$each_trdeal['title'].'</dl>
								        					<dl style="color:#444;margin-top:5px;word-wrap:break-word;width:100%; font-size:15px; margin-left: 10px; ">'.$each_trdeal['category'].'</dl>
								        					<dl style="color:#999;margin-top:5px;word-wrap:break-word;width:100%; font-size:15px; margin-left: 10px; ">'.$each_trdeal['location'].'</dl>
								        					
																			        			
								        			</td>
								        			
								        			</tr>
								        			
								        			<tr>
														<td>
														   <dl style="width:auto; color:#555;margin-left:10px;">
														   <span style="width:auto;margin-top:0px;">Was</span>
														   <label style="color:#999;text-decoration: line-through;margin-left:0px;margin-top:0px;word-wrap:break-word;width:auto;">R'.$each_trdeal["selling_price"].'</label>
														   <span style="width:auto;margin-top:0px;">, Now</span> 
														   <span style="color:#87c540;margin-left:0px;margin-top:0px;word-wrap:break-word;width:auto;">R'.$each_trdeal["discounted_selling_price"].'</span>
														   </dl>
														   <a href="'.$each_trdeal["viewurl"].'" style="text-align:right;color:#228dd6;  margin-left:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;"> View It  </a>													
														</td>				        			
								        			</tr>
								        			
								        			
								        		</table>
								        	</td>';
										 
									}
									$content .='</tr>';
}
else
{

$content .='<tr>';
									foreach($each_loop as $each_trdeal)
									{

								        $content .='<td width="50%" style="padding:10px 10px 10px 10px;border:1px solid #ddd;">
								        	<table style="width:100%;padding:0;">
								        		<tr style="">
								        			<td style="">
								        				 <img style="width:100%;" src="'.$each_trdeal['img'].'" /> 
								        			</td>
								        		 </tr>
								        			<tr>
								        			<td style="" valign="top">
								        					<span style="word-wrap:break-word;float:left;width:100%;font-size:15px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:15px;margin-left: 10px; color:#428bca;">'.$each_trdeal['title'].'</span>
								        					<span style="color:#444;margin-top:5px;word-wrap:break-word;display:inline-block;float:left;width:100%; font-size:15px; margin-left: 10px; ">'.$each_trdeal['category'].'</span>
								        					<span style="color:#999;margin-top:5px;word-wrap:break-word;display:inline-block;float:left;width:100%; font-size:15px; margin-left: 10px; ">'.$each_trdeal['location'].'</span>
								        					
																			        			
								        			</td>
								        			
								        			</tr>
								        			
								        			<tr>
														<td>
														   <p style="float:left;width:auto; color:#555;margin-left:10px;">
														   <span style="float:left;width:auto;margin-top:0px;">Was</span>
														   <label style="color:#999;text-decoration: line-through;margin-left:0px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R'.$each_trdeal["selling_price"].'</label>
														   <span style="float:left;width:auto;margin-top:0px;">, Now</span> 
														   <span style="color:#87c540;margin-left:0px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R'.$each_trdeal["discounted_selling_price"].'</span>
														   </p>
														   <a href="'.$each_trdeal["viewurl"].'" style="text-align:right;color:#228dd6;  margin-left:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;float:right;"> View It  </a>													
														</td>				        			
								        			</tr>
								        			
								        			
								        		</table>
								        	</td>';
										
									}
									$content .='</tr>';

}
									
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
								$common_template = str_replace('{DomainPath}',$HTTP_ROOT,$common_template);
								$common_template = str_replace('{content}',$content,$common_template);
								$common_template = str_replace('{newsletter_date}',date('d F Y'),$common_template);
								$common_template = str_replace('{locations}',$newsletter_location,$common_template);
								//$common_template = str_replace('{locations}',$template_location_text,$common_template);
								$test_email=array('richardgain@gmail.com','tamlinschutte@gmail.com','promatics.rahul11@gmail.com','promatics.adhish@gmail.com','promatics.sahilnarula@gmail.com','promatics.sahil.johar@gmail.com','promatics.subhash@gmail.com');
								if(in_array($list['Member']['email'],$test_email))
								{				
								
									
								$email = new CakeEmail();
								$email->template('common_template');
								$email->emailFormat('both');
								$email->viewVars(array('common_template'=>$common_template));
								$email->to($list['Member']['email']);
								$email->from($emailTemp1['EmailTemplate']['from']);
								$email->subject($emailTemp1['EmailTemplate']['subject']);
								$email->send();
								
								}
								
							} //for loop member info				
					
					   } // if of member deals each member newsletter
					   
				  } ////for newsletter counts info

             
//die;
			      $dispatch_update=$this->Dispatch->updateAll(array('Dispatch.status'=>'"sent"'),array('Dispatch.id'=>$dispatch['Dispatch']['id']));
			      
			      if($dispatch_update)
			      {
				      return;
					}
			}
			else
			{
				return;
			}
			
		}

               function test_dispatched_test($id=NULL)
		{
			$this->layout = "admin";
			//if (!defined('CRON_DISPATCHER')) { $this->redirect('/'); exit(); }
			
			$this->autoRender = false;
			$this->loadModel('DispatchDeal');
			$currentDate=date('Y-m-d');
			if($id!='')
			{
				//$dispatched_id=convert_uudecode(base64_decode($id));
                                $dispatched_id=43;
			   $dispatch=$this->Dispatch->find('first',array('conditions'=>array('Dispatch.sent_date <='=>$currentDate,'Dispatch.status'=>'sent','Dispatch.id'=>$dispatched_id)));
         }
         else 
         {
         	$dispatch=$this->Dispatch->find('first',array('conditions'=>array('Dispatch.sent_date <='=>$currentDate,'Dispatch.status'=>'pending')));
         }			
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
				
						
				$this->Deal->virtualFields = array('dis'=>'select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id','price'=>'select discount_selling_price from deal_options as d where d.deal_id=Deal.id AND d.discount=(select max(discount) as diss from deal_options as do group by deal_id having do.deal_id=Deal.id) limit 1');			
	         		
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
									$impath='https://cybercouponsa.com/im.php?f=';
									$img = $impath.'deals/'.$deal['Deal']['image'].'&w=700&h=500';
									if(strlen($deal['Deal']['name'])>40)
										$title = substr($deal['Deal']['name'],0,40).'...';
									else
										$title = $deal['Deal']['name'];
										
										$HTTP_ROOT='https://cybercouponsa.com/';
										$viewurl = $HTTP_ROOT.'deals/view/'.$deal['Deal']['uri'] ;
										$dis = @$deal['Deal']['dis']?$deal['Deal']['dis']:'N/A';
										$price = @$deal['Deal']['price']?$deal['Deal']['price']:'N/A';
										
										$loop_deals[$d]['img']=$img;
										$loop_deals[$d]['title']=$title;
										$loop_deals[$d]['viewurl']=$viewurl;
										$loop_deals[$d]['selling_price']=$deal['Deal']['selling_price'];
				                  $loop_deals[$d]['discounted_selling_price']=$price;
										$loop_deals[$d]['dis']=$dis;
										$loop_deals[$d]['category']=$deal['DealCategory']['name'];
				                  $loop_deals[$d]['location']=$newsletter_location;//$deal_location_text;
										
									$d++;	
								}
								$loop_deals=array_chunk($loop_deals,2);				
								
								$content='';
								foreach($loop_deals as $each_loop)
								{
                           $content .='<tr>';
									foreach($each_loop as $each_trdeal)
									{
								        $content .='<td width="50%" style="padding:10px 10px 10px 10px;border:1px solid #ddd;">
								        	<table style="width:100%;padding:0;">
								        		<tr style="">
								        			<td style="">
								        				 <img style="width:100%;" src="'.$each_trdeal['img'].'" /> 
								        			</td>
								        		 </tr>
								        			<tr>
								        			<td style="" valign="top">
								        					<span style="word-wrap:break-word;float:left;width:100%;font-size:15px;font-weight:bold;display:inline-block;float:left;width:100%; margin-top:15px;margin-left: 10px; color:#428bca;">'.$each_trdeal['title'].'</span>
								        					<span style="color:#444;margin-top:5px;word-wrap:break-word;display:inline-block;float:left;width:100%; font-size:15px; margin-left: 10px; ">'.$each_trdeal['category'].'</span>
								        					<span style="color:#999;margin-top:5px;word-wrap:break-word;display:inline-block;float:left;width:100%; font-size:15px; margin-left: 10px; ">'.$each_trdeal['location'].'</span>
								        					
																			        			
								        			</td>
								        			
								        			</tr>
								        			
								        			<tr>
														<td>
														   <p style="float:left;width:auto; color:#555;margin-left:10px;">
														   <span style="float:left;width:auto;margin-top:0px;">Was</span>
														   <label style="color:#999;text-decoration: line-through;margin-left:0px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R'.$each_trdeal["selling_price"].'</label>
														   <span style="float:left;width:auto;margin-top:0px;">, Now</span> 
														   <span style="color:#87c540;margin-left:0px;margin-top:0px;word-wrap:break-word;display:inline-block;float:left;width:auto;">R'.$each_trdeal["discounted_selling_price"].'</span>
														   </p>
														   <a href="'.$each_trdeal["viewurl"].'" style="text-align:right;color:#228dd6;  margin-left:0px; text-decoration: none; font-size: 14px;padding:10px; border-radius: 5px;float:right;"> View It  </a>													
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
								$common_template = str_replace('{DomainPath}',$HTTP_ROOT,$common_template);
								$common_template = str_replace('{content}',$content,$common_template);
								$common_template = str_replace('{newsletter_date}',date('d F Y'),$common_template);
								$common_template = str_replace('{locations}',$newsletter_location,$common_template);
								//$common_template = str_replace('{locations}',$template_location_text,$common_template);
                        //$test_email=array('promatics.rahul11@gmail.com','promatics.adhish@gmail.com','promatics.sahilnarula@gmail.com','promatics.sahil.johar@gmail.com','promatics.subhash@gmail.com');								
								$test_email=array('promatics.rahul11@gmail.com','promatics.adhish@gmail.com','promatics.sahilnarula@gmail.com','promatics.sahil.johar@gmail.com','promatics.subhash@gmail.com');
								if(in_array($list['Member']['email'],$test_email))
								{
									$email = new CakeEmail();
									$email->template('common_template');
									$email->emailFormat('both');
									$email->viewVars(array('common_template'=>$common_template));
									$email->to($list['Member']['email']);
									$email->from($emailTemp1['EmailTemplate']['from']);
									$email->subject($emailTemp1['EmailTemplate']['subject']);
									$email->send();
								
								}
								
							} //for loop member info				
					
					   } // if of member deals each member newsletter
					   
				  } ////for newsletter counts info


			      $dispatch_update=$this->Dispatch->updateAll(array('Dispatch.status'=>'"sent"'),array('Dispatch.id'=>$dispatch['Dispatch']['id']));
			      
			      if($dispatch_update)
			      {
				      return;
					}
			}
			else
			{
				return;
			}
			
		}


}
?>