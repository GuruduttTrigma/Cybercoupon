<?php 
ob_start();
class PagesController extends AppController 
{
	var $name= "Pages";
	var $helpers = array('Form','Html','Js','Paginator');
	var $components = array('RequestHandler','Cookie','Session','Email');
	var $uses = array('Contact','Slider','CmsPage','EmailTemplate','Referred');
	//hello	
	function contactus()
	{
		$this->layout='public';
		if(!empty($this->request->data))
		{
			//pr($this->request->data);die;
			$data1=$this->request->data;
			$data1['Contact']['member_type']=$this->Session->read('Member.member_type');
			//pr($data1);

			if($data1['Contact']['member_type']!='') {
				$data1['Contact']['member_id']=convert_uudecode(base64_decode($this->Session->read('Member.id')));
				//pr($data1);die;				
				if ($this->Contact->save($data1)) {	
				$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'contact_recieve')));				
				//pr($data1);			
				$common_template= $emailTemp1['EmailTemplate']['description'];
				$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
				$common_template = str_replace('{contact_person}',$data1['Contact']['name'],$common_template);
				$email = new CakeEmail();
				$email->template('common_template');
				$email->emailFormat('both');
				$email->viewVars(array('common_template'=>$common_template));       
				$email->to('support@cybercouponsa.com');
				//$email->to('promatics.subhash@gmail.com');
				$email->from($data1['Contact']['email']);
				$email->subject($data1['Contact']['subject']);  
				//echo   $data1['Contact']['subject'];                         
				//echo '<pre>';print_r($common_template);die;
					if($email->send())
					{
						$this->Session->write('success','Message has been sent successfully.');
						$this->redirect(array('action'=>'contactus'));
					}
				}
			}
			else {
				
				if($this->Contact->save($data1)) {
					$emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'contact_recieve')));				
					//pr($data1);			
					$common_template= $emailTemp1['EmailTemplate']['description'];
					$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
					$common_template = str_replace('{contact_person}',$data1['Contact']['name'],$common_template);
					$email = new CakeEmail();
					$email->template('common_template');
					$email->emailFormat('both');
					$email->viewVars(array('common_template'=>$common_template));       
					$email->to('support@cybercouponsa.com');
					//$email->to('promatics.subhash@gmail.com');
					$email->from($data1['Contact']['email']);
					$email->subject($data1['Contact']['subject']);  
					//echo   $data1['Contact']['subject'];                         
					//echo '<pre>';print_r($common_template);die;
					if($email->send())
					{
						$this->Session->write('success','Message has been sent successfully.');
						$this->redirect(array('action'=>'contactus'));
					}
				}
			}
		}		
	}
	function sample2()
	{
		$this->layout='public';
	 $this->autoRender=false;
$URL = 'https://dev-enterprise.mygateglobal.com/5x0x0/wsCCPayments.wsdl';

$Mode = '0'; //0 = Test Mode. 1 = Live Mode

//Be sure to populate these variables with the ones you generated in the MyGate Developer Center. Go there now by going to http://developer.mygateglobal.com
$MerchantID = '5ff6e17e-6bfa-48a3-a297-06d9f1253520';
$ApplicationID = 'd69b2f52-bfa6-4098-9e1c-56f6ac066174';

//The GatewayID associated to your Application UID.
$GatewayID = '22';

//Currency and price of transaction
$Currency = 'ZAR';
$Amount = '0.01';

//Credit Card details
$CCName = 'Mr J Soap';
$PAN = '4111111111111111';
$ExpMonth = '10';
$ExpYear  = '2015';
$CVC = '123';
$CardType = '4';

//A U T H O R I S E  P U R C H A S E     (A C T I O N  =  1)

//Ensure that PHP is installed and has the php_soap extension enabled.
$client = new SoapClient($URL);
echo("<br/> Authorization - Action 1 <br/>");	
$arrResults = $client->fProcess(
	$GLOBALS['GatewayID'],             	//Gateway
	$GLOBALS['MerchantID'],          	//MerchantID
	$GLOBALS['ApplicationID'],     		//ApplicationID
	'1',      							//Action
	'',                    				//TransactionIndex
	'Terminal',            				//Terminal
	$GLOBALS['Mode'],                	//Mode
	'',        							//MerchantReference
	$GLOBALS['Amount'],            	    //Amount
	$GLOBALS['Currency'],            	//Currency
	'',                    				//CashBackAmount                                        
	$GLOBALS['CardType'],            	//CardType
	'',                    				//AccountType
	$GLOBALS['PAN'],        			//CardNumber
	$GLOBALS['CCName'],        			//CardHolder
	$GLOBALS['CVC'],                	//CCVNumber
	$GLOBALS['ExpMonth'],            	//ExpiryMonth
	$GLOBALS['ExpYear'],            	//ExpiryYear
	'0',                					//Budget
	'',                    				//BudgetPeriod
	'',                    				//AuthorizationNumber
	'',                    				//PIN
	'',                    				//DebugMode
	'07',               				//eCommerceIndicator                            
	'',                    				//verifiedByVisaXID
	'',                    				//verifiedByVisaCAFF
	'',                    				//secureCodeUCAF
	'',                    				//Unique Client Index - this is used to uniquely identify the client and is used by the MyGate Fraud module. It is an optional parameter. Please see online documentation for details.
	'',                    				//IP Address - this is the IP address of the user using the online gateway (retrieved by yourselves), and is used by the MyGate Fraud module. It is an optional parameter.     Please see online documentation for details.
	'',									//Shipping Country Code - this is the 2-digit shipping country code of the user, and is used by the MyGate Fraud module. It is an optional parameter. Please see online documentation for details.    
	''              
);

//Results are returned from MyGate in an array format with the return parameter name and value seperated by a double-pipe (||)
list($ResultName, $ResultValue) = explode("||",$arrResults[0]);

//The first element of the retrn array ($arrResults[0]) is the Result. 0=Successful, 1=Warning (A result of 1 is returned either when the fraud module is providing a flag or if unnecessary parameters were sent to the API in the request message).
if ($ResultValue >= 0)
{
	//If successful, loop through result array and output results
	echo("Successful Authorization");
	echo("<br />");	
	foreach ($arrResults as $result)
	{
		echo($result);
		echo("<br />");    
	}
	
	echo("<br/> Settlement - Action 3 <br/>");	
	//The TransactionIndex is needed for any further transaction attempts on an authorisation. It is the second array element that is returned ($arrResults[1]).
	list($ResultName, $TransactionID) = explode("||",$arrResults[1]);
	$arrResults2 = $client->fProcess(
		$GLOBALS['GatewayID'], 		//Gateway
		$GLOBALS['MerchantID'],  	//MerchantID
		$GLOBALS['ApplicationID'], 	//ApplicationID
		'3',						//Action
		$TransactionID,				//TransactionIndex
		'',							//Terminal
		'',							//Mode
		'',							//MerchantReference
		'',							//Amount
		'',							//Currency
		'',							//CashBackAmount										
		'',							//CardType
		'',							//AccountType
		'',							//CardNumber
		'',							//CardHolder
		'',							//CCVNumber
		'',							//ExpiryMonth
		'',							//ExpiryYear
		'',							//Budget
		'',							//BudgetPeriod
		'',							//AuthorizationNumber
		'',							//PIN
		'',							//DebugMode
		'',							//eCommerceIndicator							
		'',							//verifiedByVisaXID
		'',							//verifiedByVisaCAFF
		'',							//secureCodeUCAF
		'',                    		//Unique Client Index - this is used to uniquely identify the client and is used by the MyGate Fraud module. It is an optional parameter. Please see online documentation for details.
		'',                    		//IP Address - this is the IP address of the user using the online gateway (retrieved by yourselves), and is used by the MyGate Fraud module. It is an optional parameter.     Please see online documentation for details.
		'',							//Shipping Country Code - this is the 2-digit shipping country code of the user, and is used by the MyGate Fraud module. It is an optional parameter. Please see online documentation for details.    
		''
		);
		
		list($ResultName2, $ResultValue2) = explode("||",$arrResults2[0]);
		
		if ($ResultValue2 >= 0) {
			echo("Successful Settlement");
			echo("<br />");	
			foreach ($arrResults2 as $result2)
			{
				echo($result2);
				echo("<br />");	
			}
		}
		else {
			echo("Failed Settlement");
			echo("<br />");	
			foreach ($arrResults2 as $result2)
			{
				echo($result2);
				echo("<br />");	
			}
		}
}
else {
	echo("Failed Authorization");
	echo("<br />");	
	foreach ($arrResults as $result)
	{
		echo($result);
		echo("<br />");	
	}
}
		die;
		
	}
	
	
	function process_results()
	{
		$this->layout='public';
	}
	
	function admin_sliders() 
	{
		$this->layout='admin';
		$slider=$this->Slider->find('all',array('order'=>array('Slider.id DESC')));
		$this->set(compact('slider'));	
	}
	
	function admin_view_slider($id=null) 
	{
		$this->layout='admin';
		$sliderid=convert_uudecode(base64_decode($id));
		$slider=$this->Slider->find('first',array('conditions'=>array('Slider.id'=>$sliderid)));
		$this->set(compact('slider'));
		//pr($slider);die;		
		
	}
	function admin_edit_slider($id=null) 
	{
		$this->layout='admin';
		$slider_id=convert_uudecode(base64_decode($id));
		//pr($member_id);die;
		$slider=$this->Slider->find('first',array('conditions'=>array('Slider.id'=>$slider_id)));
		//pr($member);die;
		$this->set(compact('slider'));
		if(!empty($this->data))
		{
			$data1 = $this->data;
			
       	$data1['Slider']=$this->data['Slider'];
       	$view = new View($this);
      	$html = $view->loadHelper('Tool');
      	$upload_img_name= 'sliders_'.$slider_id.'_'.time().'.'.$html->ext($_FILES['slider_image']['name']);	
      	$uploaded_type =$html->file_type ($html->ext($_FILES['slider_image']['name']));
      	$r = $html->upload(array (
                           'field_name'=>'slider_image',
                           'field_index'=>$slider_id,
                           'file_name'=>$upload_img_name,
                           'upload_path'=>DATAPATH.'sliders/')
                         );
         if($r) {
            $data = array();
            $data1['Slider']['image'] =  $upload_img_name;
            }
			
			if($this->Slider->save($data1));
			{
				
				
				//pr($data1);die;
				$this->Slider->id=$slider_id;
	      	 $this->Slider->save($data1);
	      	$this->redirect(array('action'=>'admin_sliders'));
         }
			//$this->Session->write('success','Slider has updated successfully.');
			$this->redirect(array('action'=>'admin_sliders'));
		}
	}
	function add_news_images()
	{
		$this->autoRender=false;
	    
		if(!empty($_FILES))
		{
			$file = $_FILES['uploadfile'];
			$imgName=$file['image']; 
			
			$ext = explode('.',$imgName);
			//echo "<pre>";print_r($ext);die;
			$file_extension='.'.$ext[count($ext)-1];
			$image = $ext[0].'-'.time();
			$newFileName=$image.'.'.$ext[count($ext)-1];
				
			App::import('Lib','resize');	
			$image1 = $this->Components->load('resize');
			
			$destLarge = realpath('../../app/webroot/img/frontend/slider/') . '/';
			$tempFile =$file['tmp_name'];
			move_uploaded_file($tempFile,$destLarge.$newFileName);
			list($width, $height, $type, $attr) = getimagesize($destLarge.$newFileName);
			
			if($width > $height)
			{
				$height1=($height/$width)*300;
				$image1->resize('../../app/webroot/img/frontend/slider/'.$newFileName,'../../app/webroot/img/frontend/slider/'.$newFileName,'aspect_fill',300,$height1,0,0,0,0);
				//$this->Example->save(array('fields'=>array()))
				$hight_thumb=($height/$width)*90;
				$image1->resize('../../app/webroot/img/frontend/slider/'.$newFileName,'../../app/webroot/img/frontend/slider/'.$newFileName,'aspect_fill',90,$hight_thumb,0,0,0,0);
				echo $newFileName; die;
			}
			else
			{
				$width1=($width/$height)*300;
				$image1->resize('../../app/webroot/img/frontend/slider/'.$newFileName,'../../app/webroot/img/frontend/slider/'.$newFileName,'aspect_fill',$width1,300,0,0,0,0);
				$width_thumb=($width/$height)*90;
				$image1->resize('../../app/webroot/img/frontend/slider/'.$newFileName,'../../app/webroot/img/frontend/slider/'.$newFileName,'aspect_fill',$width_thumb,90,0,0,0,0);
				echo $newFileName; die;
			}	
		}
	}
	function admin_addSlider() 
	{
		$this->layout='admin';
		if(!empty($this->data)) 
   	{
   		$mem_id =  $this->Session->read('Slider.id');
   		$data1 = $this->data;
    		$data1['Slider']['member_id'] = convert_uudecode(base64_decode($mem_id));
    		$slider_uri=$this->uri($this->data['Slider']['name']);
    		$data1['Slider']['uri'] =  $slider_uri;
    		$data1['Slider']['date'] = date('Y-m-d H:i:s');	
    		$this->Slider->save($data1);
    		$id = $this->Slider->getLastInsertId();
    		if(!empty($id))
    		{
     				if(!empty($_FILES['slider_image']))
					{
      			$view = new View($this);
      			$html = $view->loadHelper('Tool');
      			$upload_img_name= 'sliders_'.$id.'_'.time().'.'.$html->ext($_FILES['slider_image']['name']);	
      			$uploaded_type =$html->file_type ($html->ext($_FILES['slider_image']['name']));
      				if($uploaded_type!='image')
     					{
        					echo 'please upload image.';die;
      				}
      				$r = $html->upload(
      				array (
                    'field_name'=>'slider_image',
                    'field_index'=>$id,
                    'file_name'=>$upload_img_name,
                    'upload_path'=>DATAPATH.'sliders/')
                     );
         if($r) 
         {
         	$data = array();
            $data['Slider']['image'] =  $upload_img_name;
            $this->Slider->id = $id;

         	if($this->Slider->save($data))
				{
					//pr($this->data);die;           
            	$this->Session->write('success','Slider has been created successfully.'); 
				   $this->redirect(array('controller'=>'Pages','action'=>'sliders',$mem_id)); 
            }
            else 
            {
            	$this->Session->write('error','An Error Occur! Please try again later.'); 
				   $this->redirect(array('controller'=>'Pages','action'=>'sliders',$mem_id));
           	}
			}
    	}}
    	else
     	{
      	$this->Session->write('error','An Error Occur! Please try again later.'); 
		 	$this->redirect(array('controller'=>'Pages','action'=>'sliders',$mem_id));
     	}
   	}
	}
	function admin_deleteSlider($id=null) 
	{
	 $this->autoRender = false;
	    $customer_id=convert_uudecode(base64_decode($id));
		if($this->Slider->delete($customer_id))
		{
			$this->Session->write('success','Slider has been deleted successfully');
			$this->redirect(array('action'=>'admin_sliders'));
		}
	}
	function admin_update_sliders($id=NULL) 
	{
		$ctr_id = convert_uudecode(base64_decode($id));
		$old_data = $this->Slider->read('active',$ctr_id);
		if($old_data['Slider']['active']=="Yes")
		{
			if($this->Slider->updateAll(array('Slider.active'=>"'No'"),array('Slider.id'=>$ctr_id)))
			{
				$this->Session->write('success','Slider has been deactivated successfully');
				$this->redirect(array('action'=>'admin_sliders'));
			}
		}
		else
		{
			if($this->Slider->updateAll(array('Slider.active'=>"'Yes'"),array('Slider.id'=>$ctr_id)))
			{
				$this->Session->write('success','Slider has been activated successfully');
				$this->redirect(array('action'=>'admin_sliders'));
			}
		}
	}
	function pages($alias=null)
	{
		$this->layout = 'public';
		//pr($this->params);die;
		//echo $alias;
		$content = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>$alias)));
		$introductory_text = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.id'=>7)));					
		$this->set('content',$content);	
		//pr($content);die;
		$this->set('introductory_text',$introductory_text);	
		//pr($introductory_text);die;											
	}

function phpinfo()
        {
echo phpinfo();die;
}
	function dosoap()
        {
 
           $this->autoRender=false;

//-------------------------------------------------------------------
//-------------------------------------------------------------------
//-------
//-------      Configs comes here
//-------
//-------------------------------------------------------------------
//-------------------------------------------------------------------
$baseUrl = 'https://staging.payu.co.za';
$soapWdslUrl = $baseUrl.'/service/PayUAPI?wsdl';
$payuRppUrl = $baseUrl.'/rpp.do?PayUReference=';
$apiVersion = 'ONE_ZERO';


$safeKey = '{E7A333D4-CC48-4463-BEC6-A4BC1F16DC30}';
$soapUsername = 'Staging Enterprise Integration Store 1';
$soapPassword = 'j3w8swi5';
$merchantReference = "merchant_ref_".time();;

$doTransactionArray = array();
$doTransactionArray['Api'] = $apiVersion;
$doTransactionArray['Safekey'] = $safeKey;
$doTransactionArray['TransactionType'] = 'PAYMENT';		

$doTransactionArray['AdditionalInformation']['merchantReference'] = $merchantReference;
//$doTransactionArray['AdditionalInformation']['notificationUrl'] = ''	;
	
	
$doTransactionArray['Basket']['description'] = "Product Description";
$doTransactionArray['Basket']['amountInCents'] = "10000";
$doTransactionArray['Basket']['currencyCode'] = 'ZAR';


$doTransactionArray['Customer']['merchantUserId'] = "7";
$doTransactionArray['Customer']['email'] = "john@doe.com";
$doTransactionArray['Customer']['firstName'] = 'John';
$doTransactionArray['Customer']['lastName'] = 'Doe';
$doTransactionArray['Customer']['mobile'] = '0211234567';
$doTransactionArray['Customer']['regionalId'] = '1234512345122';
$doTransactionArray['Customer']['countryCode'] = '27';


/*$doTransactionArray['Creditcard']['nameOnCard'] = "Mr John Doe";
$doTransactionArray['Creditcard']['cardNumber'] = "4242424242424242";
$doTransactionArray['Creditcard']['cardNumber'] = "4000000000000234";

$doTransactionArray['Creditcard']['cardExpiry'] = "042014";
$doTransactionArray['Creditcard']['cvv'] = "123";*/

$doTransactionArray['Creditcard']['nameOnCard'] = "John Doe";
$doTransactionArray['Creditcard']['cardNumber'] = "5471196125289392";

$doTransactionArray['Creditcard']['cardExpiry'] = "102020";
$doTransactionArray['Creditcard']['cvv'] = "698"; 
  
$doTransactionArray['Creditcard']['amountInCents'] = $doTransactionArray['Basket']['amountInCents'];


$doTransactionArray['Customfield']['key'] = "subhash";
$doTransactionArray['Customfield']['value'] = "chandra";  


try {
    // 1. Building the Soap array  of data to send - This will make it into the xml as described in the documentation
    $soapDataArray = array();    
    $soapDataArray = array_merge($soapDataArray, $doTransactionArray );
    
    // 2. Creating a XML header for sending in the soap heaeder (creating it raw a.k.a xml mode)
    $headerXml = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
    $headerXml .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
    $headerXml .= '<wsse:Username>'.$soapUsername.'</wsse:Username>';
    $headerXml .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$soapPassword.'</wsse:Password>';
    $headerXml .= '</wsse:UsernameToken>';
    $headerXml .= '</wsse:Security>';
    $headerbody = new SoapVar($headerXml, XSD_ANYXML, null, null, null);

    // 3. Create Soap Header.        
    $ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; //Namespace of the WS. 
    $header = new SOAPHeader($ns, 'Security', $headerbody, true);

    // 4. Make new instance of the PHP Soap client
    $soap_client = new SoapClient($soapWdslUrl, array("trace" => 1, "exception" => 0)); 

    // 5. Set the Headers of soap client. 
    $soap_client->__setSoapHeaders($header); 

    // 6. Do the setTransaction soap call to PayU
    $soapCallResult = $soap_client->doTransaction($soapDataArray); 

    // 7. Decode the Soap Call Result
    $returnData = json_decode(json_encode($soapCallResult),true);

    //$decodedXmlData = json_decode(json_encode((array) simplexml_load_string($soapCallResult)),true);    
    
	
   /* print "<pre>";
    var_dump($decodedXmlData);
    print "</pre>";  
	die;*/

}
catch(Exception $e) {
    var_dump($e);
	die();
}

//-------------------------------------------------------------------
//-------------------------------------------------------------------
//-------
//-------      Checking response
//-------
//-------------------------------------------------------------------
//-------------------------------------------------------------------
if(is_object($soap_client)) {    
    print "-----------------------------------------------\r\n";
    print "Request:\r\n";
    print "-----------------------------------------------\r\n";            
    $requestString = str_replace( '&gt' , '>', $soap_client->__getLastRequest() );    
    $requestString = str_replace( '&gt' , '>', $requestString );    
    $requestString = str_replace( '>' , ">\r\n", $requestString );
    $requestString = str_replace( '</' , "\r\n</", $requestString );
    $requestString = str_replace( "\r\n\r\n" , "\r\n", $requestString );
    $requestString = str_replace( "\r\n\r\n" , "\r\n", $requestString );
    print $requestString;            
    print "\r\n";
    print "-----------------------------------------------\r\n";
    print "Response:\r\n";
    print "-----------------------------------------------\r\n";
    $responseString = str_replace( '&gt' , '>', $soap_client->__getLastResponse() );    
    $responseString = str_replace( '&gt' , '>', $responseString );    
    $responseString = str_replace( '>' , ">\r\n", $responseString );
    $responseString = str_replace( '</' , "\r\n</", $responseString );
    $responseString = str_replace( "\r\n\r\n" , "\r\n", $responseString );    
    print $responseString;            
} 
        }

   function dosoap2()
        {
 
           $this->autoRender=false;

//-------------------------------------------------------------------
//-------------------------------------------------------------------
//-------
//-------      Configs comes here
//-------
//-------------------------------------------------------------------
//-------------------------------------------------------------------
$baseUrl = 'https://staging.payu.co.za';
$soapWdslUrl = $baseUrl.'/service/PayUAPI?wsdl';
$payuRppUrl = $baseUrl.'/rpp.do?PayUReference=';
$apiVersion = 'ONE_ZERO';


$safeKey = '{E7A333D4-CC48-4463-BEC6-A4BC1F16DC30}';
$soapUsername = 'Staging Enterprise Integration Store 1';
$soapPassword = 'j3w8swi5';
$merchantReference = "merchant_ref_".time();
$returnUrl= 'http://pluto.promaticstechnologies.com/cybercoupon/Orders/payment_success';

$doTransactionArray = array();
$doTransactionArray['Api'] = $apiVersion;
$doTransactionArray['Safekey'] = $safeKey;
$doTransactionArray['TransactionType'] = 'PAYMENT';		

$doTransactionArray['AdditionalInformation']['merchantReference'] = $merchantReference;
$doTransactionArray['AdditionalInformation']['returnUrl'] = $returnUrl;
//$doTransactionArray['AdditionalInformation']['notificationUrl'] = ''	;
	
	
$doTransactionArray['Basket']['description'] = "Product Description";
$doTransactionArray['Basket']['amountInCents'] = "10000";
$doTransactionArray['Basket']['currencyCode'] = 'ZAR';


$doTransactionArray['Customer']['merchantUserId'] = "7";
$doTransactionArray['Customer']['email'] = "john@doe.com";
$doTransactionArray['Customer']['firstName'] = 'John';
$doTransactionArray['Customer']['lastName'] = 'Doe';
$doTransactionArray['Customer']['mobile'] = '0211234567';
$doTransactionArray['Customer']['regionalId'] = '1234512345122';
$doTransactionArray['Customer']['countryCode'] = '27';


/*$doTransactionArray['Creditcard']['nameOnCard'] = "Mr John Doe";
$doTransactionArray['Creditcard']['cardNumber'] = "4242424242424242";
$doTransactionArray['Creditcard']['cardNumber'] = "4000000000000234";

$doTransactionArray['Creditcard']['cardExpiry'] = "042014";
$doTransactionArray['Creditcard']['cvv'] = "123";*/

$doTransactionArray['Creditcard']['nameOnCard'] = "John Doe";
$doTransactionArray['Creditcard']['cardNumber'] = "5471196125289392";

$doTransactionArray['Creditcard']['cardExpiry'] = "102020";
$doTransactionArray['Creditcard']['cvv'] = "698"; 
  
$doTransactionArray['Creditcard']['amountInCents'] = $doTransactionArray['Basket']['amountInCents'];


$doTransactionArray['Customfield']['key'] = "subhash";
$doTransactionArray['Customfield']['value'] = "chandra";  


try {
    // 1. Building the Soap array  of data to send - This will make it into the xml as described in the documentation
    $soapDataArray = array();    
    $soapDataArray = array_merge($soapDataArray, $doTransactionArray );
    
    // 2. Creating a XML header for sending in the soap heaeder (creating it raw a.k.a xml mode)
    $headerXml = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
    $headerXml .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
    $headerXml .= '<wsse:Username>'.$soapUsername.'</wsse:Username>';
    $headerXml .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$soapPassword.'</wsse:Password>';
    $headerXml .= '</wsse:UsernameToken>';
    $headerXml .= '</wsse:Security>';
    $headerbody = new SoapVar($headerXml, XSD_ANYXML, null, null, null);

    // 3. Create Soap Header.        
    $ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; //Namespace of the WS. 
    $header = new SOAPHeader($ns, 'Security', $headerbody, true);

    // 4. Make new instance of the PHP Soap client
    $soap_client = new SoapClient($soapWdslUrl, array("trace" => 1, "exception" => 0)); 

    // 5. Set the Headers of soap client. 
    $soap_client->__setSoapHeaders($header); 

    // 6. Do the setTransaction soap call to PayU
    $soapCallResult = $soap_client->doTransaction($soapDataArray); 

    // 7. Decode the Soap Call Result
    $returnData = json_decode(json_encode($soapCallResult),true);

    //$decodedXmlData = json_decode(json_encode((array) simplexml_load_string($soapCallResult)),true);    
    
//echo "<pre>";print_r($soapCallResult);
//echo "<pre>";print_r($returnData);
//die;	
   /* print "<pre>";
    var_dump($decodedXmlData);
    print "</pre>";  
	die;*/

}
catch(Exception $e) {
    var_dump($e);
	die();
}

//-------------------------------------------------------------------
//-------------------------------------------------------------------
//-------
//-------      Checking response
//-------
//-------------------------------------------------------------------
//-------------------------------------------------------------------
if(is_object($soap_client)) {    
    print "-----------------------------------------------\r\n";
    print "Request:\r\n";
    print "-----------------------------------------------\r\n";

    $requestString = str_replace( '&gt' , '>', $soap_client->__getLastRequest() );    
    $requestString = str_replace( '&gt' , '>', $requestString );    
    $requestString = str_replace( '>' , ">\r\n", $requestString );
    $requestString = str_replace( '</' , "\r\n</", $requestString );
    $requestString = str_replace( "\r\n\r\n" , "\r\n", $requestString );
    echo "<pre>";print_r($requestString);
    print "\r\n";
    print "-----------------------------------------------\r\n";

    print "Response:\r\n";
    print "-----------------------------------------------\r\n";

    $responseString = str_replace( '&gt' , '>', $soap_client->__getLastResponse() );
    $responseString = str_replace( '&gt' , '>', $responseString );    
    $responseString = str_replace( '>' , ">\r\n", $responseString );
    $responseString = str_replace( '</' , "\r\n</", $responseString );
    $responseString = str_replace( "\r\n\r\n" , "\r\n", $responseString );
    echo "<pre>";print_r($responseString);

   
    die;      
} 
        }

function dosoap3()
        {
 
           $this->autoRender=false;

//-------------------------------------------------------------------
//-------------------------------------------------------------------
//-------
//-------      Configs comes here
//-------
//-------------------------------------------------------------------
//-------------------------------------------------------------------
$baseUrl = 'https://staging.payu.co.za';
$soapWdslUrl = $baseUrl.'/service/PayUAPI?wsdl';
$payuRppUrl = $baseUrl.'/rpp.do?PayUReference=';
$apiVersion = 'ONE_ZERO';


$safeKey = '{E7A333D4-CC48-4463-BEC6-A4BC1F16DC30}';
$soapUsername = 'Staging Enterprise Integration Store 1';
$soapPassword = 'j3w8swi5';
$merchantReference = "merchant_ref_".time();
$returnUrl= 'http://pluto.promaticstechnologies.com/cybercoupon/Orders/payment_success';

$doTransactionArray = array();
$doTransactionArray['Api'] = $apiVersion;
$doTransactionArray['Safekey'] = $safeKey;
$doTransactionArray['TransactionType'] = 'PAYMENT';		

$doTransactionArray['AdditionalInformation']['merchantReference'] = $merchantReference;
$doTransactionArray['AdditionalInformation']['returnUrl'] = $returnUrl;
//$doTransactionArray['AdditionalInformation']['notificationUrl'] = ''	;
	
	
$doTransactionArray['Basket']['description'] = "Product Description";
$doTransactionArray['Basket']['amountInCents'] = "10000";
$doTransactionArray['Basket']['currencyCode'] = 'ZAR';


$doTransactionArray['Customer']['merchantUserId'] = "7";
$doTransactionArray['Customer']['email'] = "john@doe.com";
$doTransactionArray['Customer']['firstName'] = 'John';
$doTransactionArray['Customer']['lastName'] = 'Doe';
$doTransactionArray['Customer']['mobile'] = '0211234567';
$doTransactionArray['Customer']['regionalId'] = '1234512345122';
$doTransactionArray['Customer']['countryCode'] = '27';


/*$doTransactionArray['Creditcard']['nameOnCard'] = "Mr John Doe";
$doTransactionArray['Creditcard']['cardNumber'] = "4242424242424242";
$doTransactionArray['Creditcard']['cardNumber'] = "4000000000000234";

$doTransactionArray['Creditcard']['cardExpiry'] = "042014";
$doTransactionArray['Creditcard']['cvv'] = "123";*/

$doTransactionArray['Creditcard']['nameOnCard'] = "John Doe";
$doTransactionArray['Creditcard']['cardNumber'] = "5471196125289392";

$doTransactionArray['Creditcard']['cardExpiry'] = "102020";
$doTransactionArray['Creditcard']['cvv'] = "698"; 
  
$doTransactionArray['Creditcard']['amountInCents'] = $doTransactionArray['Basket']['amountInCents'];


$doTransactionArray['Customfield']['key'] = "subhash";
$doTransactionArray['Customfield']['value'] = "chandra";  


try {
    // 1. Building the Soap array  of data to send - This will make it into the xml as described in the documentation
    $soapDataArray = array();    
    $soapDataArray = array_merge($soapDataArray, $doTransactionArray );
    
    // 2. Creating a XML header for sending in the soap heaeder (creating it raw a.k.a xml mode)
    $headerXml = '<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">';
    $headerXml .= '<wsse:UsernameToken wsu:Id="UsernameToken-9" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">';
    $headerXml .= '<wsse:Username>'.$soapUsername.'</wsse:Username>';
    $headerXml .= '<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$soapPassword.'</wsse:Password>';
    $headerXml .= '</wsse:UsernameToken>';
    $headerXml .= '</wsse:Security>';
    $headerbody = new SoapVar($headerXml, XSD_ANYXML, null, null, null);

    // 3. Create Soap Header.        
    $ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd'; //Namespace of the WS. 
    $header = new SOAPHeader($ns, 'Security', $headerbody, true);

    // 4. Make new instance of the PHP Soap client
    $soap_client = new SoapClient($soapWdslUrl, array("trace" => 1, "exception" => 0)); 

    // 5. Set the Headers of soap client. 
    $soap_client->__setSoapHeaders($header); 

    // 6. Do the setTransaction soap call to PayU
    $soapCallResult = $soap_client->doTransaction($soapDataArray); 

    // 7. Decode the Soap Call Result
    $returnData = json_decode(json_encode($soapCallResult),true);

    //$decodedXmlData = json_decode(json_encode((array) simplexml_load_string($soapCallResult)),true);    
    
//echo "<pre>";print_r($soapCallResult);
//echo "<pre>";print_r($returnData);
//die;	
   /* print "<pre>";
    var_dump($decodedXmlData);
    print "</pre>";  
	die;*/

}
catch(Exception $e) {
    var_dump($e);
	die();
}

//-------------------------------------------------------------------
//-------------------------------------------------------------------
//-------
//-------      Checking response
//-------
//-------------------------------------------------------------------
//-------------------------------------------------------------------
	  if(is_object($soap_client)) {    
	    print "-----------------------------------------------\r\n";
	    print "Request:\r\n";
	    print "-----------------------------------------------\r\n";
	
	    $requestString = str_replace( '&gt' , '>', $soap_client->__getLastRequest() );    
	    $requestString = str_replace( '&gt' , '>', $requestString );    
	    $requestString = str_replace( '>' , ">\r\n", $requestString );
	    $requestString = str_replace( '</' , "\r\n</", $requestString );
	    $requestString = str_replace( "\r\n\r\n" , "\r\n", $requestString );
	    print "\r\n";
	    print "-----------------------------------------------\r\n";
	
	    print "Response:\r\n";
	    print "-----------------------------------------------\r\n";
	
	    $xml = $soap_client->__getLastResponse();
	    $xml = preg_replace('/(<\/?)(\w+):([^>]*>)/', '$1$2$3', $xml);
	    $xml = simplexml_load_string($xml);
	    $json = json_encode($xml);
	    $responseArray = json_decode($json,true);
					echo "<pre>";print_r($responseArray);
					    die;      
					} 
   }
   function template_email()
   {
   	$this->layout = "public";
   }
   function template()
   {
      //$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
      $this->layout = "public";
      $common_template='';
      $emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter_test')));
      $common_template= $emailTemp1['EmailTemplate']['description'];			
		//$common_template = str_replace('{content}',$content,$common_template);
		$common_template = str_replace('{newsletter_date}',date('d F Y'),$common_template);
		//$common_template = str_replace('{locations}',$template_location_text,$common_template);
		
			
		$email = new CakeEmail();
		$email->template('common_template');
		$email->emailFormat('both');
		$email->viewVars(array('common_template'=>$common_template));
		$email->to('promatics.abhinit@gmail.com');
		$email->cc('promatics.subhash@gmail.com');
		$email->bcc('promatics.adhish@gmail.com');
		$email->from($emailTemp1['EmailTemplate']['from']);
		$email->subject($emailTemp1['EmailTemplate']['subject']);
		if($email->send())
		{
			echo '<p>Please have a look on newsletter template on you mail.</p>';
			die;
		}
   }
   function template_design2()
   {
   	
   }
   function template_design3()
   {
   	
   }
   function template3()
   {
      //$common_template = str_replace('{DomainPath}',$_SERVER['HTTP_HOST'],$common_template);
      $this->layout = "public";
      $common_template='';
      $emailTemp1= $this->EmailTemplate->find('first',array('conditions'=> array('EmailTemplate.alias' =>'news_letter_test3')));
      $common_template= $emailTemp1['EmailTemplate']['description'];			
		//$common_template = str_replace('{content}',$content,$common_template);
		$common_template = str_replace('{newsletter_date}',date('d F Y'),$common_template);
		
            $impath='https://cybercouponsa.com/im.php?f=';
				$img = $impath.'deals/deals_130_1413976681.jpg&w=700&h=500';
				
				$title='"Sample Ad" 30 Minute Pilates Classes save up to 60% Off ';			
			
			   $each_trdeal['img']=$img;
				$each_trdeal['title']=addslashes($title);
				$each_trdeal['viewurl']='aa';
				$each_trdeal['selling_price']='N/A';
            $each_trdeal['discounted_selling_price']='N/A';
				$each_trdeal['category']=addslashes('beuty &spacrs');
            $each_trdeal['location']='location';//$deal_location_text;
			
			$common_template = str_replace('{img}',$each_trdeal['img'],$common_template);
			$common_template = str_replace('{title}',$each_trdeal['title'],$common_template);
			$common_template = str_replace('{selling_price}',$each_trdeal['selling_price'],$common_template);
			$common_template = str_replace('{discounted_selling_price}',$each_trdeal['discounted_selling_price'],$common_template);
			$common_template = str_replace('{category}',$each_trdeal['category'],$common_template);
			$common_template = str_replace('{location}',$each_trdeal['location'],$common_template);
			$common_template = str_replace('{url}',$each_trdeal['viewurl'],$common_template);
		
			
		$email = new CakeEmail();
		$email->template('common_template');
		$email->emailFormat('both');
		$email->viewVars(array('common_template'=>$common_template));
		$email->to('promatics.subhash@gmail.com');
		//$email->cc('promatics.abhinit@gmail.com');
      //$email->bcc('promatics.adhish@gmail.com');
		$email->from($emailTemp1['EmailTemplate']['from']);
		$email->subject($emailTemp1['EmailTemplate']['subject']);
		if($email->send())
		{
			echo '<p>Please have a look on newsletter template on you mail.</p>';
			die;
		}
   }
   function admin_referrals()
   {   	
		$this->layout='admin';
   	$this->loadModel('Member');
   	$this->loadModel('Referral');
   	$this->loadModel('ReferralCount');
		$conditions=array();   	
   	if(!empty($this->data))
   	{
   		$firstname=@$this->data['Member']['name'];
   		$surname=@$this->data['Member']['surname'];
   		$email=@$this->data['Member']['email'];
   		if($firstname!='')
   		{
   			$conditions=array_merge($conditions,array('Member.name LIKE'=>'%'.$firstname.'%'));
   		}
   		if($surname!='')
   		{
   			$conditions=array_merge($conditions,array('Member.surname LIKE'=>'%'.$surname.'%'));
   		}
   		if($email!='')
   		{
   			$conditions=array_merge($conditions,array('Member.email LIKE'=>'%'.$email.'%'));
   		}
	   	$referral_customers = $this->ReferralCount->find('all',array('conditions'=>$conditions));
	   }
      else 
      {
       	 $referral_customers = $this->ReferralCount->find('all',array('conditions'=>$conditions));
			 //pr($referral_customers);die;
      }
		$this->set('referral_customers',$referral_customers);
		$mem_custmersCounts = $this->Member->query('Select COUNT(m.id) as cust_count from members m Where m.status = "Active" AND m.member_type = 4');
		foreach($mem_custmersCounts[0] as $data)
		{
			$mem_custmersCount = $data['cust_count'];
		}
		$this->set('mem_custmersCount',$mem_custmersCount);
		if($this->RequestHandler->isAjax())
		{
			$this->layout='';
			$this->autoRender=false;
			$this->viewPath='Elements'.DS.'backend'.DS.'Pages';
			$this->render('referral_list');
		}
      
   }
   function admin_viewReferred($referral_id=NULL)
   {
   	$this->layout='admin';
   	$this->loadModel('Referral');
   	$referral_id=convert_uudecode(base64_decode($referral_id));
   	$conditions=array('Referral.member_id'=>$referral_id);
		$this->paginate=array('limit'=>10,'conditions'=>$conditions,'fields'=>array('Member.id','Member.name','Member.surname','Referred.id','Referred.name','Referred.surname','Referred.email','Referral.*'));
		$referres=$this->paginate('Referral',$conditions);
   	$this->set('referres',$referres);
		$this->set('referral_idz',$referral_id);
   }
	function admin_emailReferrer($referral_id=NULL)
	{
		$this->loadModel('Member');
		$this->loadModel('Referral');
		$this->autoRender=false;
		
		$this->Member->virtualFields=array('referred_counts'=>'select count(id) from referrals as referral group by referral.member_id having referral.member_id=Member.id');
		
		$user_id=convert_uudecode(base64_decode($referral_id));
		$conditions=array('Member.id'=>$user_id,'Member.status'=>'Active','Member.member_type'=>4);   	
   	
      $refered=$this->Member->find('first',array('conditions'=>$conditions,'fields'=>array('Member.id','Member.name','Member.surname','Member.email','Member.referred_counts'),'contain'=>array('Referral'=>array('Referred'=>array('id','name','surname','email'))),'order'=>'referred_counts DESC'));
      
	   
       $each_user=array();
      	if($refered['Member']['referred_counts']>0)
       	{
       		$each_user['Member']=$refered['Member'];
       		$j=0;
       	   foreach($refered['Referral'] as $each_referee)
       	   {
       	   	if(!empty($each_referee['Referred']))
       	   	{
       	   	   $each_user['Referrer'][$j]=$each_referee['Referred'];
       	   	   $j++;
       	   	}
       	   }
       	}
       
       	//pr($each_user);die;
		$email_template=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'email_referrer')));
		
			$refree_list='';
			if(!empty($each_user['Referrer']))
			{
				foreach($each_user['Referrer'] as $each_refer)
				{
					$refree_list.='<p><strong>'.$each_refer['name']." ".$each_refer['surname'].'</strong></p>';
				}
			}
			
			
			$email_description=$email_template['EmailTemplate']['description'];
			$email_description=str_replace('{name}',$each_user['Member']['name'],$email_description);
			if(!empty($each_user['Referrer']))
			{
				$email_description = str_replace('{refererr_list}',$refree_list,$email_description);
				$email_description=str_replace('{referrer_count}',$each_user['Member']['referred_counts'],$email_description);
				$email_description=str_replace('{referrer_mesage}','',$email_description);
			}
			else
			{
			   
			   $email_description = str_replace('{refererr_list}','',$email_description);
			   $email_description=str_replace('{referrer_count}','0',$email_description);
			   $email_description=str_replace('{referrer_mesage}','No one yet?',$email_description);
			}
			$email=new CakeEmail();
			$email->template('common_template');
			$email->viewVars(array('common_template'=>$email_description));
			$email->emailFormat('both');
			$email->to($each_user['Member']['email']);
			$email->subject($email_template['EmailTemplate']['subject']);
			$email->from($email_template['EmailTemplate']['from']);
			if($email->send())
			{
				$this->Session->write('success','Email has been sent successfully.');
				$this->redirect(array('action'=>'referrals'));
			}
		
	}
	function admin_bulk_usermail()
	{
		$this->loadModel('Member');
		$this->loadModel('Referral');
		$this->autoRender=false;
		$refered_arr=array();
		if(!empty($_POST['customers']))
		{
			$this->Member->virtualFields=array('referred_counts'=>'select count(id) from referrals as referral group by referral.member_id having referral.member_id=Member.id');		
			$conditions = array('Member.member_type'=>4,'Member.status'=>'active');
			$member=$this->Member->find('all',array('order'=>'Member.id desc','conditions'=>$conditions,'fields'=>array('Member.id','Member.name','Member.surname','Member.email','Member.referred_counts'),'contain'=>array('Referral'=>array('Referred'=>array('id','name','surname','email')))));      		
				
			
			$email_template=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'email_referrer')));
			foreach($member as $each_user)
			{					
				if(empty($each_user['Member']['referred_counts']))
				{	
					//pr($each_user);die;
					$user_name = $each_user['Member']['name'].' '.$each_user['Member']['surname'];
					$email_description=$email_template['EmailTemplate']['description'];
					$email_description=str_replace('{name}',$user_name,$email_description);					   
				   $email_description = str_replace('{refererr_list}','',$email_description);
				   $email_description=str_replace('{referrer_count}','0',$email_description);
				   $email_description=str_replace('{referrer_mesage}','No one yet?',$email_description);				
					//pr($email_description);die;
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
			}
			$this->Session->write('success','Email has been sent successfully.');
			echo "success";die;
		}
		else
		{
			$this->Member->virtualFields=array('referred_counts'=>'select count(id) from referrals as referral group by referral.member_id having referral.member_id=Member.id');		
			$conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Member.referred_counts >'=>0);   	   	
			$referral_customers=$this->Member->find('all',array('conditions'=>$conditions,'fields'=>array('Member.id','Member.name','Member.surname','Member.email','Member.referred_counts'),'contain'=>array('Referral'=>array('Referred'=>array('id','name','surname','email'))),'order'=>'referred_counts DESC'));      
			//pr($referral_customers);die;			
			$i=0;
			foreach($referral_customers as $refered)
			{
				if($refered['Member']['referred_counts']>0)
				{
					$refered_arr[$i]['Member']=$refered['Member'];
					$j=0;
					foreach($refered['Referral'] as $each_referee)
					{
						if(!empty($each_referee['Referred']))
						{
							$refered_arr[$i]['Referrer'][$j]=$each_referee['Referred'];
							
							$j++;
						}
					}
					$i++;
				}
			}   
			$email_template=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.alias'=>'email_referrer')));
			//pr($email_template);die;			
			foreach($refered_arr as $each_user)
			{
				$refree_list='';
				if(!empty($each_user['Referrer']))
				{
					foreach($each_user['Referrer'] as $each_refer)
					{
						$refree_list.='<p><strong>'.$each_refer['name']." ".$each_refer['surname'].'</strong></p>';
					}
				}		
				$user_name = $each_user['Member']['name'].' '.$each_user['Member']['surname'];	
				$email_description=$email_template['EmailTemplate']['description'];
				$email_description=str_replace('{name}',$user_name,$email_description);
				if(!empty($each_user['Referrer']))
				{
					$email_description = str_replace('{refererr_list}',$refree_list,$email_description);
					$email_description=str_replace('{referrer_count}',$each_user['Member']['referred_counts'],$email_description);
					$email_description=str_replace('{referrer_mesage}','',$email_description);
				}
				else
				{
				   
				   $email_description = str_replace('{refererr_list}','',$email_description);
				   $email_description=str_replace('{referrer_count}','0',$email_description);
				   $email_description=str_replace('{referrer_mesage}','No one yet?',$email_description);
				}
				//pr($email_description);die;
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
			echo "success";die;
		}
		
	}
   /*function email_testing()
   {
   	$this->autoRender=false;
   	//$this->load->library('phpmailer');
   	App::import('Vendor','Phpmailer');
      $this->phpmailer= new Phpmailer();
					$subject               =             'testing email';
					$name                  =             'subhash';
					$to_email              =             "promatics.subhash@gamil.com";
					$from_email            =             'promatics.gautam@gmail.com';
					$body                  =             "Hello subhash";
					
					$this->phpmailer->Host = SMTP_SERVER;
					$this->phpmailer->Port = SMTP_PORT;
					$this->phpmailer->Username = SMTP_USERNAME;
					$this->phpmailer->Password = SMTP_PASSWORD;
					//$this->phpmailer->Mailer   = "smtp";
					//$this->phpmailer->SMTPAuth = true;
					$this->phpmailer->AddAddress($to_email);
					$this->phpmailer->IsMail();
					$this->phpmailer->From     = $from_email;
					$this->phpmailer->FromName = $name;
					$this->phpmailer->Subject  =  $subject;
					$this->phpmailer->Body     =  $body;
					$this->phpmailer->IsHTML(true);
					if($this->phpmailer->Send())
					{
						echo 'You have successfully subscribed newsletter';die;
					}
   	         else 
   	         {
   	         	echo "error";die;
   	         }
   }*/
   /*function email_testing2()
   {
   	$this->autoRender=false;
   	//$this->load->library('phpmailer');
   	App::import('Lib','PHPMailerAutoload');
   	$mail = new PHPMailer;
   	
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'user@example.com';                 // SMTP username
			$mail->Password = 'secret';                           // SMTP password
			$mail->SMTPSecure = 'smtp';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 456;                                    // TCP port to connect to
			
			$mail->From = 'from@example.com';
			$mail->FromName = 'Mailer';
			//$mail->addAddress('promatics.subhash@gmail.com', 'Joe User');     // Add a recipient
			$mail->addAddress('promatics.subhash@gmail.com');               // Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
			
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML
			
			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}
   }*/
   function email_testing3()
   {
   	$this->autoRender=false;
		$common_template= "hello subhash";
		
		$email = new CakeEmail();
		$email->template('common_template');
		$email->emailFormat('both');
		$email->viewVars(array('common_template'=>$common_template));
		$email->to('promatics.subhash@gmail.com');
		$email->from('promatics.gurudutt.com');
		$email->subject("testing");
				
		$email->send();
		die;
   }
	function admin_deleteReferred($id = Null) 
	{
		$this->autoRender = false;
		$this->loadModel('Referral'); 
	    $referral_id=convert_uudecode(base64_decode($id));
		if($this->Referral->delete($referral_id))
		{
			$this->Session->write('success','Referral customer has been deleted successfully');
			$this->redirect(array('action'=>'referrals'));
		}

	}
	function admin_checkadd_referee($id = null) 
	{
	    $this->autoRender=false;
		$this->loadModel('Referral');
		$this->loadModel('Member');
		//pr($this->data);die;
	    $referral_id=$this->data['Referral_id'];
	    $Referral_email=$this->data['Referral_email'];
	    $Referee_email=$this->data['Referee']['Referee_email'];
	   
		$conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Member.email'=>$Referee_email);
		$existance=$this->Member->find('first',array('conditions'=>$conditions,'fields'=>array('id','name','surname','email'),'recursive'=>0));
		  
		if(($Referral_email!=$Referee_email) && !empty($existance))
		{
			$referee_id=$existance['Member']['id'];
			$referred_conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Referral.refer_id'=>$referee_id);
			$parent_referral=$this->Referral->find('count',array('fields'=>array('Referral.id','Referral.refer_id','Referral.member_id','Member.email'),'conditions'=>$referred_conditions));
			if($parent_referral>0)
			{
				echo "false";die;
			}
			else
			{
				echo "true";die;
			}
		}
		else
		{
			echo "false";die;
		}
	}
	function admin_addReferred($id = null) 
	{
		$this->layout='admin';
		$this->loadModel('Referral');
		$this->loadModel('Member');
		$referral_decodeid=convert_uudecode(base64_decode($id));
		if(!empty($this->data))
		{
			$referral_id=$this->data['Referral']['Referral_id'];
			$Referral_email=$this->data['Referral']['Referral_email'];
			$Referee_email=$this->data['Referee']['Referee_email'];
		   
			$conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Member.email'=>$Referee_email);
			$existance=$this->Member->find('first',array('conditions'=>$conditions,'fields'=>array('id','name','surname','email'),'recursive'=>0));
			  
			if(($Referral_email!=$Referee_email) && !empty($existance))
			{
				$referee_id=$existance['Member']['id'];
				$referred_conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Referral.refer_id'=>$referee_id);
				$parent_referral=$this->Referral->find('count',array('fields'=>array('Referral.id','Referral.refer_id','Referral.member_id','Member.email'),'conditions'=>$referred_conditions));
				if($parent_referral>0)
				{
					return false;
				}
				else
				{
					$new_refree['Referral']=array(
												   'member_id'=>$referral_id,
												   'refer_id'=>$existance['Member']['id']
												 );
					if($this->Referral->save($new_refree))
					{
						$this->Session->write('success','Referee has been added successfully.');
						$this->redirect(array('controller'=>'pages','action' => 'viewReferred/'.$id,'admin' => true));
					}
				}
			}
			else
			{
				$this->Session->write('error','Referee addition has failed.');
				$this->redirect(array('controller'=>'pages','action' => 'viewReferred/'.$id,'admin' => true));
			}
		
		}
		
		//echo $member_id;die;
		
		$conditions=array('Member.status'=>'Active','Member.member_type'=>4,'Referral.member_id'=>$referral_decodeid);
		$referres = $this->Referral->find('first',array('conditions'=>$conditions,'fields'=>array('Member.id','Member.name','Member.surname','Member.email','Referral.*')));
		//MAXLIMIT
		//echo $referral_decodeid;
		//pr($referres);die;
		$this->set('referre',$referres);	   
	}
	
	function winner_info() {
		$this->layout = 'public';
		//pr($this->request->data);die;
		$content = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.alias'=>'winner')));
		//pr($content);die;
		$this->set(compact('content'));
		
	}

    
}			
