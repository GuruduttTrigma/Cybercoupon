<?php

$data = array();
//echo "<pre>";print_r($nodes);die;
foreach ($nodes as $node){
	
   if($node['DealCategory']['active']=='Yes')
   {
   	$active_img='<img src="'.HTTP_ROOT.'img/active.png" title="Active" style="margin: 0 0 -4px;" />';
   }	
	else
	{		
	   $active_img='<img src="'.HTTP_ROOT.'img/inactive.png" title="Inactive" style="margin: 0 0 -4px;" />';	
	}
	
	$data[] = array(
		"text" => $node['DealCategory']['name']." ".$active_img, 
		"id" => $node['DealCategory']['id'],
		"cls" => "folder",
		"leaf" => ($node['DealCategory']['lft'] + 1 == $node['DealCategory']['rght'])
	);
}

echo $this->Js->object($data);

?>