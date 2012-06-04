<?php
/*
Purpose: User model class
*/

class TeacherLocation extends AppModel{

	var $name	= 'TeacherLocation';
  
  
  //Validation Rules  
  
	var $belongsTo = array
	(
		'User' => array
		(
			'className' => 'User',
			'foreignKey' => 'user_id'
		)
	);
	
	var $hasMany = array
	(
		'TeacherDesciplineField' => array
		(
			'className' => 'TeacherDesciplineField',
			'foreignKey' => 'teacher_location_id'
		)
	);
	
	function getLocations($user_id)
	{
	  	return $this->find
	  	(
	  		'list',
	  		array
	  		(
	  			'conditions' => array
	  			(
	  				'TeacherLocation.user_id' => $user_id
	  			),
	  			'fields' => array
	  			(
	  				'TeacherLocation.id',
	  				'TeacherLocation.name'
	  			),
	  			'order' => array
	  			(
	  				'TeacherLocation.name ASC'
	  			)
	  		)
	  	);
	}

 var $validate = array
 (
	 'type' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Location type is required.'
                    )
                  ),
       'zip' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Zip is required.'
                    ),
				      'numeric' => array(
				        'rule' => 'numeric',
				        'required' => true,
				        'allowEmpty' => false,
				        'message' => 'Enter only numeric values.'
				      )
                  ),
       
	'radius' => array(
	                    'empty' => array(
	                      'rule' => 'notEmpty',
	                      'required' => true,
	                      'allowEmpty' => false,
	                      'message' => 'Radius is required.'
	                    ),
				      'numeric' => array(
				        'rule' => 'numeric',
				        'required' => true,
				        'allowEmpty' => false,
				        'message' => 'Enter only numeric values.'
				      )
                  ),
          'address1' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Address1 is required.'
                    )
                  ),
       'city' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'City is required.'
                    )
                  ),
       'state' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'State is required.'
                    )
                  ),
       'name' => array(
                    'empty' => array(
                      'rule' => 'notEmpty',
                      'required' => true,
                      'allowEmpty' => false,
                      'message' => 'Name is required.'
                    )
                  ),
       				'unique' => array(
        			'rule' => 'checkUnique',
        			'required' => true,
        			'allowEmpty' => false,
        			'message' => 'Name already exists.'
      )
       
              
  );
  
  
  function checkUnique()
  {
    //App::import('Model','User');
    // $this->User = & new User();
	
    $locationInfo = $this->find('all',array(
      'conditions'=>array(
        'user_id'=>$this->data['TeacherLocations']['user_id']
      )
    ));
	
   	return (empty($locationInfo));
  }
   

 
}

?>
