<?php 
class DispatchDeal extends AppModel
{
	var $name= 'DispatchDeal';
	var $actsAs=array('Containable');
	var $belongsTo=array(
			
		'Deal'=>array(
				'className'=>'Deal',
				'foreignKey'=>'deal_id'),
				
			'Dispatch'=>array(
				'className'=>'Dispatch',
				'foreignKey'=>'dispatch_id'),
		
		);
}
?>
