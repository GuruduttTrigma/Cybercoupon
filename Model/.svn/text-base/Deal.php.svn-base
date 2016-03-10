<?php 
class Deal extends AppModel
{
	var $name = 'Deal';
	var $actsAs = array('Containable');
	var $belongsTo = array(			
		'DealCategory'=>array(
			'className'=>'DealCategory',
			'foreignKey'=>'category'),
								
		'Location'=>array(
			'className'=>'Location',
			'foreignKey'=>'location'),
		'Member'=>array(
			'className'=>'Member',
			'foreignKey'=>'member_id')     
	);
	var $hasMany = array(
		'DealOption'=>array(
			'className'=>'DealOption',
			'foreignKey'=>'deal_id'),
		'DealImage'=>array(
			'className'=>'DealImage',
			'foreignKey'=>'deal_id',
			'dependent'=>true
        ),
	);
}
?>
