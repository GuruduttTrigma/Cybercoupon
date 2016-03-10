<?php 
class Order extends AppModel
{
	var $name= 'Order';
	var $actsAs=array('Containable');

	 var $belongsTo=array(
			       'Member'=>array(
							   'className'=>'Member',
							   'foreignKey'=>'member_id'
        )
    	 );
   
   var $hasMany=array(
        'OrderDealRelation'=>array(
           'className'=>'OrderDealRelation',
           'foreignKey'=>'order_id',
           'dependent'=>true
        )
   );
	}
?>
