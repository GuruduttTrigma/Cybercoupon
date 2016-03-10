<?php 
class Referral extends AppModel
{
	var $name= 'Referral';
	var $actsAs=array('Containable');
	var $belongsTo=array(
			
       'Member'=>array(
				'className'=>'Member',
				'foreignKey'=>'member_id'
				),
       'Referred'=>array(
				'className'=>'Member',
				'foreignKey'=>'refer_id'
				)
    	);
   



}
?>
