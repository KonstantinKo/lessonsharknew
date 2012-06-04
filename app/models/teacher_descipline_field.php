<?php
/*
Purpose: User model class
*/

class TeacherDesciplineField extends AppModel{

	var $name	= 'TeacherDesciplineField';
	
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
		),
		'TeacherLocation' => array
		(
			'className' => 'TeacherLocation',
			'foreignKey' => 'teacher_location_id'
		)
	); 
  
  
  //Validation Rules  

 var $validate = array(
       'location' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Location is Required'
                    )
                  ),
       
	'rate' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Rate is Required'
                    )
                  ),
          'duration' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Duration is Required'
                    )
                  ),
       'dsid' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Desciplines is Required'
                    )
                  )
              
  );
  
  function findDistinctLessons($user_id)
  {
  	return $this->find
  	(
  		'all',
  		array
  		(
  			'conditions' => array
  			(
  				'TeacherDesciplineField.user_id' => $user_id
  			),
  			'fields' => array
  			(
  				'DISTINCT TeacherDesciplineField.teacher_descipline_id',
  				'TeacherDescipline.dname'
  			),
  			'order' => array
  			(
  				'TeacherDescipline.dname ASC'
  			)
  		)
  	);
  }
  
	  function findLesson($id)
	  {
	  	return $this->find
	  	(
	  		'first',
	  		array
	  		(
	  			'conditions' => array
	  			(
	  				'TeacherDesciplineField.id' => $id
	  			),
	  			'fields' => array
	  			(
	  				'TeacherDesciplineField.teacher_descipline_id',
	  			)
	  		)
	  	);
	  }
	  
	function lessonCount($user_id, $desc_id)
	  {
	  	return $this->find
	  	(
	  		'count',
	  		array
	  		(
	  			'conditions' => array
	  			(
	  				'TeacherDesciplineField.user_id' => $user_id,
	  				'TeacherDesciplineField.teacher_descipline_id' => $desc_id
	  			)
	  		)
	  	);
	  }
  	
  	function getLessons($user_id)
	{
	  	return $this->find
	  	(
	  		'all',
	  		array
	  		(
	  			'conditions' => array
	  			(
	  				'TeacherDesciplineField.user_id' => $user_id
	  			),
	  			'fields' => array
	  			(
	  				'TeacherDesciplineField.id',
	  				'TeacherDesciplineField.user_id',
	  				'TeacherDesciplineField.teacher_location_id',
	  				'TeacherDesciplineField.rate',
	  				'TeacherDesciplineField.duration',
	  				'TeacherDesciplineField.teacher_descipline_id',
	  				'TeacherDescipline.dname',
	  				'TeacherLocation.name'
	  			),
	  			'order' => array
	  			(
	  				'TeacherDescipline.dname ASC'
	  			)
	  		)
	  	);
	}
   

 
}

?>
