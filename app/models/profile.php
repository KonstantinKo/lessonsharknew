<?php
/*
Purpose: Profile model class
*/

class Profile extends AppModel
{

	var $name	= 'Profile';
	
	//relationships
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
		),
    'State'
	);

  //Validation Rules
 	public $validate = array(
 	  'id' => array(
      'blankOnCreate' => array(
        'rule' => 'blank',
        'on'   => 'create'
      ),
      'belongsToTeacher' => array(
        'rule' => 'checkIdOwnership',
        'on'   => 'update'
      ),
      'numeric' => array(
        'rule' => 'numeric',
        'on'   => 'update'
      )
    ),
    'user_id' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false
      ),
      'ownedOrAdmin' => array(
        'rule' 		=> 'checkPermission',
        'on' 			=> 'update',
        'message' => "You're not allowed to edit this profile. Your login may have expired."
      ),
      'numeric' => array(
        'rule' => 'numeric'
      )
    ),
		'age_limit' => array(
      'numeric' => array(
      	'rule' 				=> 'numeric',
       	'required' 		=> false,
       	'allowEmpty' 	=> true,
       	'message' 		=> 'Enter only numeric values.'
      )
   	),
   	'zip' => array(
      'numeric' => array(
        'rule' 				=> 'numeric',
        'required' 		=> true,
        'allowEmpty' 	=> false,
        'message' 		=> 'Enter only numeric values.'
      ),
      'empty' => array(
        'rule' 				=> 'notEmpty',
        'required' 		=> true,
        'allowEmpty' 	=> false,
        'message' 		=> 'Zip code is required.'
      )
    ),
	 'state_id' => array(
      'empty' => array(
        'rule' => 'notEmpty',
        'required' 		=> true,
        'allowEmpty'	=> false,
        'message' 		=> 'State is required',
        'on'					=> 'update'
      )
    ),
	 	'city' => array(
      'empty' => array(
        'rule' 				=> 'notEmpty',
        'required' 		=> true,
        'allowEmpty' 	=> false,
        'message' 		=> 'City is required',
        'on' 					=> 'update'
      )
    ),
    'address' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false,
        'message'     => 'Address is required'
      ),
      'length' => array(
        'rule'    => array('maxLength', 40),
        'message' => "Max. 40 characters allowed for the address."
      )
    ),
	  'phone' => array(
      'empty' => array(
        'rule' 				=> 'notEmpty',
        'required' 		=> true,
        'allowEmpty' 	=> false,
        'message' 		=> 'Phone No. is required',
        'on' 					=> 'update'
      ),
	    'numeric' => array(
        'rule' 		=> 'numeric',
        'message' => 'Please enter only numeric values.'
      ),
      'length' => array(
        'rule'    => array('maxLength', 20),
        'message' => "Max. 20 characters allowed for the phone number."
      )
    ),
    'SSN1' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false,
        'message'     => 'SSN is required',
        'on'					=> 'update'
      ),
      'length' => array(
        'rule'    => array('maxLength', 3),
        'message' => "Max. 3 characters allowed for the first part of your SSN."
      )
    ),
    'SSN2' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false,
        'message'     => 'SSN is required',
        'on'					=> 'update'
      ),
      'length' => array(
        'rule'    => array('maxLength', 2),
        'message' => "Max. 2 characters allowed for the second part of your SSN."
      )
    ),
    'SSN3' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false,
        'message'     => 'SSN is required',
        'on'					=> 'update'
      ),
      'length' => array(
        'rule'    => array('maxLength', 4),
        'message' => "Max. 4 characters allowed for the third part of your SSN."
      )
    ),
    'DOB' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false,
        'message'     => 'Date of Birth is required',
        'on'					=> 'update'
      )
    )
	);

 	################### Utility Functions #####################

	/**
   * Takes zip code and auto-fills city and state values.
   *
   * @param string $zip The zip code to look up.
   * @return array $data Contains city and state information.
   */
  public function zipToCity($zip) {
  	$result = $this->query("SELECT state_id, city FROM zip_codes WHERE zip_code = '$zip'");

  	$data = array();
  	
  	if (!empty($result))
  	{
  		$data['city'] = $result[0]['zip_codes']['city'];
  		$data['state_id'] = $result[0]['zip_codes']['state_id'];
  	}

  	return $data;
  }
}

?>