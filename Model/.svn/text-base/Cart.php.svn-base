<?php 
class Cart extends AppModel
{
	var $name= 'Cart';
	var $actsAs=array('Containable');


	var $belongsTo=array(
       'Member'=>array(
								   'className'=>'Member',
								   'foreignKey'=>'member_id',
            //'type' => 'INNER'
        ),
       'Deal'=>array(
								  'className'=>'Deal',
								  'foreignKey'=>'deal_id',
           //'type' => 'INNER'
           
        ),
       'Friend'=>array(
								  'className'=>'Friend',
								  'foreignKey'=>'friend_id'
           
        ),
    	);
  


	}
?>
