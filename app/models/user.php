<?php
/*
Purpose: User model class
*/

class User extends AppModel{

	var $name	= 'User';
	
	//relationships
	var $hasOne = array
	(
		'Profile' => array
		(
			'className' => 'Profile',
			'foreignKey' => 'user_id'
		),
    'TeacherExperience'
	); 
	
	var $hasMany = array
	(
		'TeacherDesciplineField' => array
		(
			'className' => 'TeacherDesciplineField',
			'foreignKey' => 'user_id'
		),
		'TeacherDesciplineDescription' => array
		(
			'className' => 'TeacherDesciplineDescription',
			'foreignKey' => 'user_id'
		),
		'TeacherLocation' => array
		(
			'className' => 'TeacherLocation',
			'foreignKey' => 'user_id'
		),
    'TeacherMedia'
	);
  
  
  //Validation Rules  

  var $validate = array(
    'id' => array(
      'blankOnCreate' => array(
        'rule' => 'blank',
        'on'   => 'create'),
      'numeric' => array(
        'rule' => 'numeric',
        'on'   => 'update'
      )
    ),
    'username' => array(
      'empty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false,
        'message'     => 'User Name is required',
        'on'          => 'create'
      ),
       'unique' => array(
        'rule'        => 'checkUnique',
        'required'    => true,
        'allowEmpty'  => false,
        'message'     => 'User name already exists',
        'on'          => 'create'
      )
    ),
    'password' => array(
      'empty' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'Password is required.',
        'on'   => 'create'
      )
    ),
    'cpassword' => array(
      'passwordequal' => array(
        'rule' => 'checkpasswords',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'Confirm password does not match.',
        'on'   => 'create'
      ),
      'empty' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'Confirm password is required.',
        'on'   => 'create'
      )
    ),
    'firstname' => array(
      'empty' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'First name is required.'
      )
    ),
    'middlename' => array(
      'length' => array(
        'rule'    => array('maxLength', 45),
        'message' => "Max. 45 characters allowed for the middle name."
      )
    ),
    'lastname' => array(
      'empty' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'Last name is required.'
      )
    ),
    'email' => array(
     'emailIsUnique' => array(
        'rule' => 'checkUniqueEmail',
          'required'    => true,
          'allowEmpty'  => false,
          'message'     => 'Email address already exists.',
          'on'          => 'create'
      ),
      'email' => array(
        'rule' => 'email',
        'message' => 'Enter a valid email address.'
      ),
      'empty' => array(
        'rule' => 'notEmpty',
        'required' => true,
        'allowEmpty' => false,
        'message' => 'Email address is required.'
      )
    )
  );  
   

  function checkUnique()
  {
    //App::import('Model','User');
    // $this->User = & new User();
	
    $userInfo = $this->find('all',array(
      'conditions'=>array(
        'username'=>$this->data['User']['username']
      )
    ));
	
   	return (empty($userInfo));
  }

  function checkUniqueEmail()
  {
    //App::import('Model','User');
    //$this->User = & new User();
	
    $userInfo = $this->find('all',array(
      'conditions'=>array(
        'email'=>$this->data['User']['email']
      )
    ));
	
   	return (empty($userInfo));
  }
  
  function checkoldpasswords() 
  {
  	//App::import('Model','User');
    //$this->User = & new User();
  	
  	$userInfo1 = $this->User->find('all',array(
      'conditions'=>array(
        'id'=>$_SESSION['userInfo']['User']['id']
        )
      )
  	);

   	return (strcmp($userInfo1[0]['User']['password'],md5($this->data['User']['oldpassword'])) ==0 );
  }

  function checkpasswords()
  {
    //pr($this->data);die;
    //return strcmp($this->data['User']['password'],$this->data['User']['repassword']);
    return (strcmp($this->data['User']['password'],$this->data['User']['cpassword']) == 0 );
  }
}
   
?>