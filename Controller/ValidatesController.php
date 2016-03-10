<?php 
//ob_start();

class ValidatesController extends AppController 
{
  var $name= "Validates";
	var $helpers = array('Form','Html','Javascript');
	var $components = array('RequestHandler','Cookie','Session','Email');
	var $uses = array('Member');
	
	function frontLogin()
	{
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			$errors=$this->checklogin($this->data);
			
			if(is_array($errors))
			{
				foreach($this->data['Member'] as $key => $value )
				{
					if(array_key_exists($key, $errors ) )
					{		
						foreach($errors [ $key ] as $k => $v )
						{
							$errors_msg .= "error|$key|$v";
						}
					}
					else 
					{
						$errors_msg .= "ok|$key\n";
					}
				}
			}
			echo $errors_msg;
			exit; 
		}
	}
	function checklogin($data)
	{
		$errors="";
		if(trim($data['Member']['email'])=="")
		{
			$errors['email'][]="Please enter email.\n";
		}
		if(trim($data['Member']['email'])!="")
		{
			if($this->isValidEmail(trim($data['Member']['email'])))
			{
				$errors['email'][]="Please enter valid email\n";
			}
		}
		if(trim($data['Member']['password'])=="")
		{
			$errors['password'][]="Please enter password.\n";
		}
		
		if(trim($data['Member']['email'])!="" && trim($data['Member']['password'])!="")
		{
			if($this->memberNotExist(trim($data['Member']['email']),trim($data['Member']['password'])))
			{
				$errors['password'][] = "Invalid email address or password! please try again. \n";
			}
			elseif($this->memberDeactivateStatus(trim($data['Member']['email']),trim($data['Member']['password'])))
			{
				$errors['password'][] = "Your account is not active now.Please contact to administrator via contact us in our website.\n";
			}
		}
		return $errors;
	}

	function isValidEmail($email)
	{
		  $pattern= "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[.a-zA-Z0-9_-]+)$/";
		  if(preg_match($pattern, $email))
		  {
			return false;
		  } else {
			  return true;
		  }
	}

	function memberNotExist($uname,$password)
	{ 
		$count = $this->Member->find("count",array("conditions"=>array('Member.password'=>md5($password),'Member.email'=>$uname)));
		if($count==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function memberDeactivateStatus($uname,$password)
	{ 
		$count = $this->Member->find("count",array("conditions"=>array('Member.password'=>md5($password),'Member.email'=>$uname,'Member.status'=>"Active")));
		if($count==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function forgetEmail()
	{
		$this->autoRender = false;
		if($this->RequestHandler->isAjax())
		{
			$errors_msg = '';
			$errors = $this->checkforgetEmail($this->data);
			if(is_array($errors))
			{
			  foreach($this->data['Member'] as $key => $value )
			  {
				if(array_key_exists($key, $errors ) )
				{		
					foreach($errors [ $key ] as $k => $v )
					{
						$errors_msg .= "error|$key|$v";
					}
				}
				else 
				{
					$errors_msg .= "ok|$key\n";
				}
			  }
			}
			echo $errors_msg;
			exit;
		}
	}
	function checkforgetEmail($data)
	{
		$errors = '';
		if(trim($data['Member']['email']) =='')
		{
			$errors['email'][]="Please enter email\n";
		}
		if(trim($data['Member']['email']) !='')
		{
			if($this->isValidEmail(trim($data['Member']['email'])))
			{
				$errors['email'][]="Please enter valid email\n";
			}
			
			elseif($this->isLoginEmailExists(trim($data['Member']['email'])))
			{
				$errors['email'][]="Email does not exists\n";
			}
			
		}
		return $errors;
	}

	function isLoginEmailExists($email)
	{
		$user = $this->Member->find('count',array('conditions'=>array('Member.email'=>$email,'Member.status'=>"Active")));
		if($user>0 )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function checkRegister()
	{
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			
			//echo '<pre>';print_r($this->data);die;
			$errors=$this->checkmemberRegister($this->data);
			//echo '<pre>';print_r($this->data);die;
			if(is_array($errors))
			{
				foreach($this->data['Member'] as $key => $value )
				{
					if(array_key_exists($key, $errors ) )
					{		
						foreach($errors [ $key ] as $k => $v )
						{
							$errors_msg .= "error|$key|$v";
						}
					}
					else 
					{
						$errors_msg .= "ok|$key\n";
					}
				}
			}
			echo $errors_msg;
			exit; 
		}
	}

	function checkmemberRegister($data)
	 {
		
		if(trim($data['Member']['name'])=="")
		{
			
			$errors['name'][]="Please enter name.\n";
		}
		/*if(trim($data['Member']['dob'])=="")
		{
			
			$errors['dob'][]="Please enter DOB.\n";
		}
		*/
	   if(trim($data['Member']['email'])=="")
		{
			$errors['email'][]="Please enter email.\n";
		}
		if(trim($data['Member']['city'])=="")
		{
		$errors['city'][]="Please enter city.\n";
		}
         if(trim($data['Member']['email'])!="")
		{
			if($this->isValidEmail($data['Member']['email']))
			{
				$errors['email'][]="Please enter valid email.\n";
			}
			elseif($this->isRegisterEmailExists($data['Member']['email']))
			{
				$errors['email'][]="Email already exists.\n";
			}
		}
        
		if(trim($data['Member']['password'])=="")
		{
			$errors['password'][]="Please enter password.\n";
		}
		if(trim($data['Member']['password'])!="")
		{
			$pwd=trim($data['Member']['password']);
			if(strlen($pwd)<6 )
			{
			$errors['password'][]="Password must be at least 6 character.\n";
			}
		}
		
		if(trim($data['Member']['cpassword'])=="")
		{
			$errors['cpassword'][]="Please confirm your password.\n";
		}
		if(trim($data['Member']['cpassword'])!="")
		{
			if($data['Member']['password'] != $data['Member']['cpassword'])
			{
				$errors['cpassword'][] = "Password and confirm password does not match.\n";
			}
		}
		if(trim($data['Member']['company']==""))
		{
			$errors['company'][] = "Please enter company name.\n";
		}
		if(trim($data['Member']['company_id']==""))
		{
			$errors['company_id'][] = "Please enter company ID.\n";
		}
		if(trim($data['Member']['company_id'])!="")
		{
			/*if($this->isValidCompanyId($data['Member']['company_id']))
			{
				$errors['company_id'][]="Please enter valid company ID.\n";
			}*/
			if($this->isCompanyIdExists($data['Member']['company_id']))
			{
				$errors['company_id'][]="Company ID already exists.\n";
			}
		}
		
		
		if(trim($data['Member']['address']==""))
		{
			$errors['address'][] = "Please enter address.\n";
		}
		
		
		if(trim($data['Member']['state']==""))
		{
			$errors['state'][] = "Please select state.\n";
		}
		if(trim($data['Member']['country']==""))
		{
			$errors['country'][] = "Please select country.\n";
		}
		if(trim($data['Member']['zip_code']==""))
		{
			$errors['zip_code'][] = "Please enter zip code.\n";
		}
		if(trim($data['Member']['phone']==""))
		{
			$errors['phone'][] = "Please enter phone number.\n";
		}
		if(trim(@$data['Member']['zip_code']!=""))
		{
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$data['Member']['zip_code']))
			{
				$errors['zip_code'][]="Please don't insert special characters.\n";
			}
			/*if(!is_numeric(trim($data['Member']['zip_code'])))
			{
				$errors['zip_code'][]="Please enter numeric value only\n";
			}*/
			
		}
		if(trim($data['Member']['phone']!=""))
		{
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_¬]|[a-zA-Z]/',$data['Member']['phone']))
			{
				$errors['phone'][]="Please don't insert characters/special-characters.\n";
			}
			/*if(!is_numeric(trim($data['Member']['phone'])))
			{
				$errors['phone'][]="Please Enter Numeric Value Only\n";
			}*/
		}
		return $errors;
    }
	function checkRegister1()
	{
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			
			//echo '<pre>';print_r($this->data);die;
			$errors=$this->checkmemberRegister1($this->data);
			//echo '<pre>';print_r($this->data);die;
			if(is_array($errors))
			{
				foreach($this->data['Member'] as $key => $value )
				{
					if(array_key_exists($key, $errors ) )
					{		
						foreach($errors [ $key ] as $k => $v )
						{
							$errors_msg .= "error|$key|$v";
						}
					}
					else 
					{
						$errors_msg .= "ok|$key\n";
					}
				}
			}
			echo $errors_msg;
			exit; 
		}
	}

	function checkmemberRegister1($data)
	 {
		
		if(trim($data['Member']['name'])=="")
		{
			
			$errors['name'][]="Please enter name.\n";
		}
		
		
	   if(trim($data['Member']['email'])=="")
		{
			$errors['email'][]="Please enter email.\n";
		}

		if(trim($data['Member']['email'])!="")
		{
			if($this->isValidEmail($data['Member']['email']))
			{
				$errors['email'][]="Please enter valid email.\n";
			}
			elseif($this->isRegisterEmailExists($data['Member']['email']))
			{
				$errors['email'][]="Email already exists.\n";
			}
		}
        
		if(trim($data['Member']['password'])=="")
		{
			$errors['password'][]="Please enter password.\n";
		}
		if(trim($data['Member']['password'])!="")
		{
			$pwd=trim($data['Member']['password']);
			if(strlen($pwd)<6 )
			{
			$errors['password'][]="Password must be at least 6 character.\n";
			}
		}
		
		if(trim($data['Member']['cpassword'])=="")
		{
			$errors['cpassword'][]="Please confirm your password.\n";
		}
		if(trim($data['Member']['cpassword'])!="")
		{
			if($data['Member']['password'] != $data['Member']['cpassword'])
			{
				$errors['cpassword'][] = "Password and confirm password does not match.\n";
			}
		}
		
		if(trim($data['Member']['address']==""))
		{
			$errors['address'][] = "Please enter address.\n";
		}
		if(trim($data['Member']['city']==""))
		{
			$errors['city'][] = "Please select state.\n";
		}
		if(trim($data['Member']['state']==""))
		{
			$errors['state'][] = "Please select state.\n";
		}
		if(trim($data['Member']['country']==""))
		{
			$errors['country'][] = "Please select country.\n";
		}
		if(trim($data['Member']['zip_code']==""))
		{
			$errors['zip_code'][] = "Please enter zip code.\n";
		}
		if(trim($data['Member']['phone']==""))
		{
			$errors['phone'][] = "Please enter phone number.\n";
		}
		if(trim(@$data['Member']['zip_code']!=""))
		{
			/*if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$data['Member']['zip_code']))
			{
				$errors['zip_code'][]="Please don't insert special characters.\n";
			}*/
			if(!is_numeric(trim($data['Member']['zip_code'])))
			{
				$errors['zip_code'][]="Please enter numeric value only\n";
			}
			
		}
		if(trim($data['Member']['phone']!=""))
		{
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_¬]|[a-zA-Z]/',$data['Member']['phone']))
			{
				$errors['phone'][]="Please don't insert characters/special-characters.\n";
			}
			/*if(!is_numeric(trim($data['Member']['phone'])))
			{
				$errors['phone'][]="Please Enter Numeric Value Only\n";
			}*/
		}
		return $errors;
  }
	function isRegisterEmailExists($email)
	{
		$user = $this->Member->find('count',array('conditions'=>array('Member.email'=>$email,'Member.status'=>"Active")));
		if($user>0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function isCompanyIdExists($comp_id)
	{
		$comp = $this->Member->find('count',array('conditions'=>array('Member.company_id'=>$comp_id)));
		if($comp>0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/*function isValidCompanyId($email)
	{
		  $pattern= "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[.a-zA-Z0-9_-]+)$/";
		  if(preg_match($pattern, $email))
		  {
			return false;
		  } else {
			  return true;
		  }
	}*/
	//code for confirm change password
	function change_password()
	{
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			$errors=$this->checknewpassword($this->data);
			if(is_array($errors))
			{
				foreach($this->data['Member'] as $key => $value )
				{
					if(array_key_exists($key, $errors ) )
					{		
						foreach($errors [ $key ] as $k => $v )
						{
							$errors_msg .= "error|$key|$v";
						}
					}
					else 
					{
						$errors_msg .= "ok|$key\n";
					}
				}
			}
			echo $errors_msg;
			exit; 
		}
	}
	function checknewpassword($data)
	{
		if(trim($data['Member']['password'])=="")
		{
			$errors['password'][]="Please enter old password.\n";
		}
		if(trim($data['Member']['npassword'])=="")
		{
			$errors['npassword'][]="Please enter new password.\n";
		}
		if(trim($data['Member']['npassword'])!="")
		{
			$pwd=trim($data['Member']['npassword']);
			if(strlen($pwd)<6 )
			{
			$errors['npassword'][]="Password must be at least 6 character.\n";
			}
		}
		if(trim($data['Member']['cpassword'])=="")
		{
			$errors['cpassword'][]="Please enter confirm password.\n";
		}
		if(trim($data['Member']['cpassword'])!="")
		{
			if($data['Member']['npassword'] != $data['Member']['cpassword'])
			{
				$errors['cpassword'][] = "New password and confirm password does not match.\n";
			}
		}
		if(trim($data['Member']['password'])!="")
		{
			if($this->passwordNotExist(trim($data['Member']['password'])))
			{
				$errors['password'][] = "Invalid old password! Please try again. \n";
			}
			
		}
		return $errors;
	}
	function passwordNotExist($password)
	{ 
		$count = $this->Member->find("count",array("conditions"=>array('Member.password'=>md5($password))));
		if($count==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function checkEdit()
	{
//echo "jjjjj";die;
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			
			echo '<pre>';print_r($this->data);die;
			$errors=$this->checkmemberEdit($this->data);
			//echo '<pre>';print_r($this->data);die;
			if(is_array($errors))
			{
				foreach($this->data['Member'] as $key => $value )
				{
					if(array_key_exists($key, $errors ) )
					{		
						foreach($errors [ $key ] as $k => $v )
						{
							$errors_msg .= "error|$key|$v";
						}
					}
					
					else 
					{
						$errors_msg .= "ok|$key\n";
					}
				}
			}
			echo $errors_msg;
			exit; 
		}
	}
	function checkmemberEdit($data)
	 {
		//echo '<pre>';print_r($data);die;
		if(trim($data['Member']['name'])=="")
		{
			
			$errors['name'][]="Please enter name.\n";
		}
		if(trim($data['Member']['dob'])=="")
		{
			
			$errors['dob'][]="Please enter DOB.\n";
		}
		
	   
		if(trim($data['Member']['company']==""))
		{
			$errors['company'][] = "Please enter company name.\n";
		}
		if(trim($data['Member']['company_id']==""))
		{
			$errors['company_id'][] = "Please enter company ID.\n";
		}
		if(trim($data['Member']['address']==""))
		{
			$errors['address'][] = "Please enter address.\n";
		}
		
		
		if(trim($data['Member']['state']==""))
		{
			$errors['state'][] = "Please select state.\n";
		}
		if(trim($data['Member']['country']==""))
		{
			$errors['country'][] = "Please select country.\n";
		}
		if(trim($data['Member']['zip_code']==""))
		{
			$errors['zip_code'][] = "Please enter zip code.\n";
		}
		if(trim($data['Member']['phone']==""))
		{
			$errors['phone'][] = "Please enter phone number.\n";
		}
		if(trim(@$data['Member']['zip_code']!=""))
		{
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_¬]/',$data['Member']['zip_code']))
			{
				$errors['zip_code'][]="Please don't insert special characters.\n";
			}
			/*if(!is_numeric(trim($data['Member']['zip_code'])))
			{
				$errors['zip_code'][]="Please Enter Numeric Value Only\n";
			}*/
		}
		if(trim(@$data['Member']['phone']!=""))
		{
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_¬]|[a-zA-Z]/',$data['Member']['phone']))
			{
				$errors['phone'][]="Please don't insert special characters.\n";
			}
			/*if(!is_numeric(trim($data['Member']['phone'])))
			{
				$errors['phone'][]="Please Enter Numeric Value Only\n";
			}*/
		}
		if(trim($data['Member']['company_id'])!="")
		{
			
			if($this->isEditCompanyIdExists($data['Member']['company_id']))
			{
				$errors['company_id'][]="Company ID already exists.\n";
			}
				
		}
		
		return $errors;
    }
	function isEditCompanyIdExists($comp_id)
	{
		$mem_id=$this->Session->read('Member.id');
		$comp = $this->Member->find('count',array('conditions'=>array('Member.company_id'=>$comp_id,'Member.id NOT'=>$mem_id)));
		if($comp>0 )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function check_reset()
	{
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			$errors=$this->check_reset_password($this->data);
			if(is_array($errors))
			{
				foreach($this->data['Member'] as $key => $value )
				{
					if(array_key_exists($key, $errors ) )
					{		
						foreach($errors [ $key ] as $k => $v )
						{
							$errors_msg .= "error|$key|$v";
						}
					}
					else 
					{
						$errors_msg .= "ok|$key\n";
					}
				}
			}
			echo $errors_msg;
			exit; 
		}
	}
	function check_reset_password($data)
	{
		if(trim($data['Member']['password'])=="")
		{
			$errors['password'][]="Please enter password.\n";
		}
		if(trim($data['Member']['password'])!="")
		{
			$pwd=trim($data['Member']['password']);
			if(strlen($pwd)<6 )
			{
			$errors['password'][]="Password must be of atleast 6 characters.\n";
			}
		}
		
		if(trim($data['Member']['c_password'])=="")
		{
			$errors['c_password'][]="Please enter confirm password.\n";
		}
		if(trim($data['Member']['c_password'])!="")
		{
			if($data['Member']['password'] != $data['Member']['c_password'])
			{
				$errors['c_password'][] = "Password and Confirm Password does not match.\n";
			}
		}
		
		return $errors;
	}
	
	
	function checkRegister4guest()
	{
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			
			//echo '<pre>';print_r($this->data);die;
			$errors=$this->checkguestRegister($this->data);
			//echo '<pre>';print_r($this->data);die;
			if(is_array($errors))
			{
				foreach($this->data['GuestUser'] as $key => $value )
				{
					if(array_key_exists($key, $errors ) )
					{		
						foreach($errors [ $key ] as $k => $v )
						{
							$errors_msg .= "error|$key|$v";
						}
					}
					else 
					{
						$errors_msg .= "ok|$key\n";
					}
				}
			}
			echo $errors_msg;
			exit; 
		}
	}
	function checkguestRegister($data)
	 {
		$errors='';
		if(trim($data['GuestUser']['guest_name'])=="")
		{
			
			$errors['guest_name'][]="Please enter name.\n";
		}
		
		
	   if(trim($data['GuestUser']['guest_email'])=="")
		{
			$errors['guest_email'][]="Please enter email.\n";
		}

		if(trim($data['GuestUser']['guest_email'])!="")
		{
			if($this->isValidEmail($data['GuestUser']['guest_email']))
			{
				$errors['guest_email'][]="Please enter valid email.\n";
			}
			elseif($this->isRegisterEmailExists($data['GuestUser']['email']))
			{
				$errors['guest_email'][]="Email already exists.\n";
			}
		}
        
		if(trim($data['GuestUser']['guest_password'])=="")
		{
			$errors['guest_password'][]="Please enter password.\n";
		}
		if(trim($data['GuestUser']['guest_password'])!="")
		{
			$pwd=trim($data['GuestUser']['guest_password']);
			if(strlen($pwd)<6 )
			{
			$errors['guest_password'][]="Password must be at least 6 character.\n";
			}
		}
		
		if(trim($data['GuestUser']['guest_cpassword'])=="")
		{
			$errors['guest_cpassword'][]="Please confirm your password.\n";
		}
		if(trim($data['GuestUser']['guest_cpassword'])!="")
		{
			if($data['GuestUser']['guest_password'] != $data['GuestUser']['guest_cpassword'])
			{
				$errors['guest_cpassword'][] = "Password and confirm password does not match.\n";
			}
		}
		
		if(trim($data['GuestUser']['guest_address']==""))
		{
			$errors['guest_address'][] = "Please enter address.\n";
		}
		if(trim($data['GuestUser']['guest_city']==""))
		{
			$errors['guest_city'][] = "Please select state.\n";
		}
		if(trim($data['GuestUser']['guest_state']==""))
		{
			$errors['guest_state'][] = "Please select state.\n";
		}
		if(trim($data['GuestUser']['guest_country']==""))
		{
			$errors['guest_country'][] = "Please select country.\n";
		}
		if(trim($data['GuestUser']['guest_zip_code']==""))
		{
			$errors['guest_zip_code'][] = "Please enter zip code.\n";
		}
		if(trim($data['GuestUser']['guest_phone']==""))
		{
			$errors['guest_phone'][] = "Please enter phone number.\n";
		}
		if(trim(@$data['GuestUser']['guest_zip_code']!=""))
		{
			if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/',$data['GuestUser']['zip_code']))
			{
				$errors['guest_zip_code'][]="Please don't insert special characters.\n";
			}
			/*if(!is_numeric(trim($data['Member']['zip_code'])))
			{
				$errors['zip_code'][]="Please enter numeric value only\n";
			}*/
		}
		return $errors;
	}

function ingr_validate()
	{
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			$errors=$this->checkingr($this->data);
			
			if(is_array($errors))
			{
				foreach($this->data['Cart'] as $key => $value )
				{
					if(array_key_exists($key, $errors ) )
					{		
						foreach($errors [ $key ] as $k => $v )
						{
							$errors_msg .= "error|$key|$v";
						}
					}
					else 
					{
						$errors_msg .= "ok|$key\n";
					}
				}
			}
			echo $errors_msg;
			exit; 
		}
	}
function checkingr($data)
{
	$errors="";
		if(trim($data['Cart']['engrave_text'])=="")
		{
			$errors['engrave_text'][]="This field is required.\n";
		}
		
		if(trim($data['Cart']['font'])=="")
		{
			$errors['font'][]="Please select font.\n";
		}
		if(trim($data['Cart']['img'])=="")
		{
			$errors['img'][]="Please select a image.\n";
		}
		if(trim($data[Cart][color_code])=="")
		{
			$errors['color_code'][]="Please select a color.\n";
		}
		
		return $errors;

	}

	function paymentadress_validate() 
	{
		//echo 'hello';die;
		//return false;
		$this->autoRender=false;
		if($this->RequestHandler->isAjax()) 
		{
			$errors_msg="";
			$errors=$this->payment_address($this->data);
			
			if(is_array($errors))
			{
  				foreach($this->data['OrderDealRelation'] as $key => $value )
  				{
  					if(array_key_exists($key, $errors ) )
  					{		
    						foreach($errors [ $key ] as $k => $v )
    						{
    							 $errors_msg .= "error|$key|$v";
    						}
  					}
  					else 
  					{
  						$errors_msg .= "ok|$key\n";
  					}
  				}
			}
			echo $errors_msg;
			exit; 
		}  
	}
 
	function payment_address($data)
	{
		$errors="";     
		if(trim($data['OrderDealRelation']['shipping_first_name'])=="")
		{
			$errors['shipping_first_name'][]="This field is required.\n";
		}
		if(trim($data['OrderDealRelation']['shipping_last_name'])=="")
		{
			$errors['shipping_last_name'][]="This field is required.\n";
		}
		if(trim($data['OrderDealRelation']['shippingaddress_firstline'])=="")
		{
			$errors['shippingaddress_firstline'][]="This field is required.\n";
		}
		if(trim($data['OrderDealRelation']['shippingaddress_city'])=="")
		{
			$errors['shippingaddress_city'][]="This field is required.\n";
		}
		if(trim($data['OrderDealRelation']['shippingaddress_state'])=="")
		{
			$errors['shippingaddress_state'][]="This field is required.\n";
		}
		if(trim($data['OrderDealRelation']['shippingaddress_zip'])=="")
		{
			$errors['shippingaddress_zip'][]="This field is required.\n";
		}
		if(trim($data['OrderDealRelation']['shippingaddress_cell_phone_number'])=="")
		{
			$errors['shippingaddress_cell_phone_number'][]="This field is required.\n";
		}
		if(!is_numeric($data['OrderDealRelation']['shippingaddress_cell_phone_number']) && trim(!$data['OrderDealRelation']['shippingaddress_cell_phone_number'])=="")
		{
			$errors['shippingaddress_cell_phone_number'][]="Please enter valid phone number.\n";
		}		   
		if($data['cardpayment']=='EFT')
		{
		   if(($data['OrderDealRelation']['eft']) =='')
		   {
			 $errors['eft'][]="This field is required.\n";
		   } 
		}
		if(($data['OrderDealRelation']['terms']) =='')
		{
		   $errors['terms'][]="Please select.\n"; 
		}
		if(($data['OrderDealRelation']['qty']) =='')
		{
			$errors['qty'][]="This field is required.\n";
			//pr($errors['qty']);
		}    
		return $errors; 
		//die;
	} 
	function forgetcustEmail()
	{
		$this->autoRender = false;
		if($this->RequestHandler->isAjax())
		{
			$errors_msg = '';
			$errors = $this->checkforgetEmailCust($this->data);
			if(is_array($errors))
			{
			  foreach($this->data['Member'] as $key => $value )
			  {
				if(array_key_exists($key, $errors ) )
				{		
					foreach($errors [ $key ] as $k => $v )
					{
						$errors_msg .= "error|$key|$v";
					}
				}
				else 
				{
					$errors_msg .= "ok|$key\n";
				}
			  }
			}
			echo $errors_msg;
			exit;
		}
	}
	function checkforgetEmailCust($data)
	{
		$errors = '';
		if(trim($data['Member']['email']) =='')
		{
			$errors['email'][]="Please enter email\n";
		}
		if(trim($data['Member']['email']) !='')
		{
			if($this->isValidEmail(trim($data['Member']['email'])))
			{
				$errors['email'][]="Please enter valid email\n";
			}
			
			elseif($this->isCustomerEmailExists(trim($data['Member']['email'])))
			{
				$errors['email'][]="Email does not exists\n";
			}
			
		}
		return $errors;
	}	
	function isCustomerEmailExists($email)
	{
		$user = $this->Member->find('count',array('conditions'=>array('Member.email'=>$email,'Member.member_type'=>4,'Member.status'=>"Active")));
		if($user>0 )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
