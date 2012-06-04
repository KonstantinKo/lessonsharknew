<?php
/*
Purpose: User model class
*/

class TeacherDescipline extends AppModel{

	var $name	= 'TeacherDescipline';
	
	//relationships
	var $hasMany = array
	(
		'TeacherDesciplineField' => array
		(
			'className' => 'TeacherDesciplineField',
			'foreignKey' => 'teacher_descipline_id'
		),
		'TeacherDesciplineDescription' => array
		(
			'className' => 'TeacherDesciplineDescription',
			'foreignKey' => 'teacher_descipline_id'
		)
	); 
  
  
  //Validation Rules  

 var $validate = array(
       'dname' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'First Name is Required'
                    )
                  ),
       
	       
  );
  
  function getDesciplines($user_id = null)
  {
  		return $this->find
	  	(
	  		'all',
	  		array
	  		(
	  			'recursive' => -1,
	  			'fields' => array
	  			(
	  				'TeacherDescipline.id',
	  				'TeacherDescipline.dname'
	  			),
	  			'order' => array
	  			(
	  				'TeacherDescipline.dname ASC'
	  			)
	  		)
	  	);
  }
  
  
  
	function getDesc($name)
	{
	  return $this->find
	  (
	  	'first',
	  	array
	  	(
	  		'conditions' => array
	  		(
	  			'TeacherDescipline.dname' => ucfirst($name)
	  		),
	  		'fields' => array
	  		(
	  			'TeacherDescipline.id',
	  		)
	  	)
	  );
	}
   

 
}

?>
