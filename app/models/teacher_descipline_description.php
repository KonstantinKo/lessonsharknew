<?php
/*
Purpose: User model class
*/

class TeacherDesciplineDescription extends AppModel{

	var $name	= 'TeacherDesciplineDescription';
	
	//relationships
	var $belongsTo = array
	(
		'User' => array
		(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
		'TeacherDescipline' => array
		(
			'className' => 'TeacherDescipline',
			'foreignKey' => 'teacher_descipline_id'
		)
	); 
  
  
  //Validation Rules  

 var $validate = array(
       'description' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Description is Required'
                    )
                  )
              
  );
  	
  	function getLessonDesc($user_id)
	{
	  	return $this->find
	  	(
	  		'all',
	  		array
	  		(
	  			'conditions' => array
	  			(
	  				'TeacherDesciplineDescription.user_id' => $user_id
	  			),
	  			'fields' => array
	  			(
	  				'TeacherDesciplineDescription.id',
	  				'TeacherDesciplineDescription.user_id',
	  				'TeacherDesciplineDescription.teacher_descipline_id',
	  				'TeacherDesciplineDescription.description',
	  				'TeacherDescipline.dname'
	  			),
	  			'order' => array
	  			(
	  				'TeacherDescipline.dname ASC'
	  			)
	  		)
	  	);
	}
	
	  function findDescription($user_id, $desc_id)
	  {
	  	return $this->find
	  	(
	  		'first',
	  		array
	  		(
	  			'conditions' => array
	  			(
	  				'TeacherDesciplineDescription.user_id' => $user_id,
	  				'TeacherDesciplineDescription.teacher_descipline_id' => $desc_id
	  			),
	  			'fields' => array
	  			(
	  				'TeacherDesciplineDescription.id'
	  			)
	  		)
	  	);
	  }
   

 
}

?>
