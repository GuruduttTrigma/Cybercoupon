<?php 
class ModulePermission extends AppModel
{
	var $name= 'ModulePermission';
	var $actsAs=array('Containable');

	 var $belongsTo=array(
			       'AdminModule'=>array(
							   'className'=>'AdminModule',
							   'foreignKey'=>'module_id'
        ),
         'Member'=>array(
							   'className'=>'Member',
							   'foreignKey'=>'member_id'
        )
    	 );
		
   
   
	}
?>