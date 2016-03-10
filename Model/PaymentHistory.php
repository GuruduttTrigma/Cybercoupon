<?php 
class PaymentHistory extends AppModel
{
	var $name= 'PaymentHistory';
	var $actsAs=array('Containable');

	 var $belongsTo=array(
			       'Member'=>array(
							   'className'=>'Member',
							   'foreignKey'=>'member_id'
                        ),
                 'PaymentRelease'=>array(
							   'className'=>'PaymentRelease',
							   'foreignKey'=>'payment_release_id'
                      )
    	 );
	}
?>
