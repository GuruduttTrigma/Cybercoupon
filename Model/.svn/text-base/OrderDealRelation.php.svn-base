<?php 
class OrderDealRelation extends AppModel
{
	var $name= 'OrderDealRelation';
	var $actsAs=array('Containable');

	 var $belongsTo=array(
			       'Deal'=>array(
							   'className'=>'Deal',
							   'foreignKey'=>'deal_id'
        ),
         'DealOption'=>array(
							   'className'=>'DealOption',
							   'foreignKey'=>'deal_option_id'
        ),
		'Order'=>array(
							   'className'=>'Order',
							   'foreignKey'=>'order_id'
        )
    	 );

   
   
	}
?>
