<?php 
class PaymentRelease extends AppModel
{
	var $name= 'PaymentRelease';
	var $actsAs=array('Containable');

	 var $hasMany=array(
                 'PaymentHistory'=>array(
							   'className'=>'PaymentHistory',
							   'foreignKey'=>'payment_release_id',
							   'dependent'=>true
                      )
    	 );
	}
?>
