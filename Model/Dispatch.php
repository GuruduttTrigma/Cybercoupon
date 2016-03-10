<?php 
class Dispatch extends AppModel
{
	var $name= 'Dispatch';
	var $actsAs=array('Containable');
	var $hasMany=array(
			
       'DispatchDeal'=>array(
				'className'=>'DispatchDeal',
				'foreignKey'=>'dispatch_id'),
		);
   var $belongsTo=array(
    
           'Location'=>array(
                'className'=>'Location',
                'foreignKey'=>'newsletter_location'
          
               )    
      );

	}
?>
