<?php
/*
Purpose: User model class
*/

class TeacherExperience extends AppModel
{

public $name = 'TeacherExperience';
public $belongsTo = array("User");

// validation rules
	       
	var $validate = array(
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
        'rule' => 'checkPermission',
        'message' => "You're not allowed to edit this profile. Your login may have expired."
      ),
      'numeric' => array(
        'rule' => 'numeric'
      ),
      'unique' => array(
      	'rule' => 'isUnique'
      )
    ),
		'experience'=> array(
			/*'empty' => array(
				'rule' =>'notEmpty',
				'required' =>true,
				'allowEmpty' =>false,
				'message' => 'Experience is required'
			),*/
      'length' => array(
        'rule'    => array('maxLength', 500),
        'message' => "Please keep the text short. (Below 500 characters)"
      )
		 ),
    'education'=> array(
			'empty' => array(
				'rule' =>'notEmpty',
				'required' =>true,
				'allowEmpty' =>false,
				'message' => 'Education is required'
			),
      'length' => array(
        'rule'    => array('maxLength', 500),
        'message' => "Please keep the text short. (Below 500 characters)"
      )
		),
		'teaching'=> array(
			'empty' => array(
				'rule' =>'notEmpty',
				'required' =>true,
				'allowEmpty' =>false,
				'message' => 'Teaching is required'
			),
      'length' => array(
        'rule'    => array('maxLength', 500),
        'message' => "Please keep the text short. (Below 500 characters)"
      )
		),
		'performance'=> array(
			'empty' => array(
				'rule' =>'notEmpty',
				'required' =>true,
				'allowEmpty' =>false,
				'message' => 'Performance is required'
			),
      'length' => array(
        'rule'    => array('maxLength', 500),
        'message' => "Please keep the text short. (Below 500 characters)"
      )
		),
	);
}
