<?php 
class DealCategory extends AppModel
{
	var $name= 'DealCategory';
	var $actsAs=array('Tree');
	
	
	var $hasMany=array(
        'Deal'=>array(
           'className'=>'Deal',
           'foreignKey'=>'category',
           'dependent'=>true
           )
        );
  	
	
	
	

}
?>
