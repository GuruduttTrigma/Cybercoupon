<?php 
class ReferralCount extends AppModel
{
	var $name= 'ReferralCount';
	var $actsAs=array('Containable');
	var $belongsTo=array(
			
       'Member'=>array(
				'className'=>'Member',
				'foreignKey'=>'member_id'
				),       
    	);
}
?>
