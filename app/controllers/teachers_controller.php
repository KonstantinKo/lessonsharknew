<?php
App::import('Sanitize');

class TeachersController extends AppController {

	var $name = 'Teachers';
  /* *  Helper used by the Controller **/    
  var $helpers = array('Html','Ajax','Javascript','Form','Session','Xml','GoogleChart', 'Tools');
  /* *  Component used by the Controller **/
  var $components = array('RequestHandler','Cookie','Session','Email', 'Upload', 'Tools'); 

  var $paginate = array('limit' => 10);
  
  var $uses = null;

	#############################################START: FrontEnd###################################

  ################################# Below: Utility Functions ####################################

  /**
   * Function to get teacher data and redirect to 404 if ID's not found.
   *
   * @param int $id The teacher's ID
   * @return array $teacher The teacher's data
   * @todo Redirect to 404 instead of home
   */
  private function getTeacher($id) {
  	App::import('Model','User');
		$this->User = & new User();

  	$teacher = $this->User->findById($id);

  	if(empty($teacher))
		{
			//should go to 404 page though
			$this->redirect(array('controller' => 'homes', 'action' => 'index'));
			exit;
		}

		$teacher['fullname'] = $teacher['User']['firstname'].' '.$teacher['User']['lastname'];

		return $teacher;
  }

  /**
   * Function to get data of the currently logged in user
   *
   * @param int $id The requested teacher's ID
   * @return array $userinfo The currently logged in User's data
   * @todo Redirect to 404 instead of home
   */
  private function getUserInfo(&$id, $onlyAdmin = false) {
  	$userinfo = null;

		if($this->Session->check('User') && empty($id))
		{
			//we already are logged in, so you can't be here
			$userinfo['User'] = $this->Session->read('User');

			if ($onlyAdmin && $userinfo['User']['role'] != "admin") {
				$this->Session->setFlash("You don't have permission to view that site", "default", array("class" => "error"));
				$this->redirect(array('controller' => 'homes', 'action' => 'index'));
				exit;
			}
			$id = $userinfo['User']['id']; #following commented out because it seemed unnecessary
			/*
			if( $userinfo['User']['role'] == "admin" && !$onlyAdmin)
	   	{
				//$this->Session->write('Admin', $userinfo['User']);
		    $this->redirect(array('controller' => 'users', 'action' => 'admin_home'));
				exit;
			}
	    else if ($userinfo['User']['role'] == 'teacher' )
	    {
			 	//Coder
				//$this->Session->write('teacher', $userinfo['User']);
				$id = $userinfo['User']['id'];
			}
			else
			{
				//we are a student
			}
			*/
		}
		else if($this->Session->check('User'))
		{
			//we already are logged in, so you can't be here
			$userinfo['User'] = $this->Session->read('User');
			
			if ($onlyAdmin && $userinfo['User']['role'] != "admin") {
				$this->Session->setFlash("You don't have permission to view that site", "default", array("class" => "error"));
				$this->redirect(array('controller' => 'homes', 'action' => 'index'));
				exit;
			}

			#following commented out because it seemed unnecessary
			/*
			if( $userinfo['User']['role'] == "admin" && !$onlyAdmin )
	   	{
				//$this->Session->write('Admin', $userinfo['User']);
		    $this->redirect(array('controller' => 'users', 'action' => 'admin_home'));
				exit;
			}
	    else if ($userinfo['User']['role'] == 'teacher')
	    {
	    	//don't need to do anything
			}
			else
			{
			 	//we are a student
			}
			*/
		}
		else if(empty($id))
		{
			//should go to 404 page though
			//we aren't logged in and don't know what teacher to show
			$this->redirect(array('controller' => 'homes', 'action' => 'index'));
			exit;
		}

		return $userinfo;
  }

  /**
   * Function to compare, whether the requested teacher is the logged in user
   *
   * @param array $teacher The teacher data
   * @param array $userinfo The user data from the session
   * @return bool $is_me True if teacher is logged-in user, false if not.
   */
  private function getIsMe($teacher, $userinfo) {
  	$is_me = false;
			
		if($teacher['User']['id'] === $userinfo['User']['id'])
			$is_me = true;

		return $is_me;
  }

  /**
   * Function to check, whether the currently logged-in user is allowed to view this page
   *
   * @param int $id The requested teacher ID
   * @return int $id The adjusted ID if none was given but permission exists.
   * @todo Exchange thrown error with redirect + flash
   */
  private function checkEditPermission($id = null) {
  	$user = $this->Session->read('User');

  	if ($id) { // if ID given, check whether logged in user has that ID or user is admin
  		if ($id != $user['id'] && $user['role'] != "admin")
  			throw new ErrorException("Not authorized. Change this to a redirect with flash message later.");
  	} else {
  		$id = $user['id'];
  	}

  	return $id;
  }

	######################### Below: Code deemed more or less complete ############################
function register()
{
		global $PSALT;	

		if($this->Session->check('User'))
		{
			//we already are logged in, so you can't be here
			$userinfo['User'] = $this->Session->read('User');
			
			if( $userinfo['User']['role'] == "admin" )
			{
				//$this->Session->write('Admin', $userinfo['User']);
				$this->redirect(array('controller' => 'users', 'action' => 'admin_home'));
				exit;
			}
			else if ($userinfo['User']['role'] == 'teacher' )
			{
				//Coder
				//$this->Session->write('teacher', $userinfo['User']);
				$this->redirect(array('controller' => 'teachers', 'action' => 'contentProfile'));
				exit;
			}
			else
			{
				//we are a student
			}
		}

		$this->layout = "front_default";
		
		$this->set("title_for_layout", 'Teacher registration - LessonShark');
		   
		App::import('Model','User');
		$this->User = & new User();
		//App::import('Model','Profile');
		//$this->Profile = & new Profile();
		
		//used to start validation rule setup
		$this->User->set( $this->data['User'] );
		$this->User->Profile->set( $this->data['Profile'] );
		
		if( !empty( $this->data ) ) 
		{

			// Transform ZIP
			$profileData = $this->User->Profile->zipToCity($this->data['Profile']['zip']);
			if ($profileData)
			{
				$this->data['Profile']['city'] = $profileData['city'];
				$this->data['Profile']['state_id'] = $profileData['state_id'];
			}
		
			if ($this->User->validates(array('fieldList' => array('password','cpassword','firstname','lastname','email'))) && $this->User->Profile->validates(array('fieldList' => array('zip'))) )
			//if($this->User->saveAll($this->data, array("validate" => 'first')))
			{
				//updates
				$this->data['User']['password'] = md5($this->data['User']['email'].$this->data['User']['password'].$PSALT);
				$this->data['User']['cpassword'] = $this->data['User']['password'];
				$this->data['User']['role'] = 'teacher';
				
				if($this->User->saveAll($this->data, array("validate" => false)))
				{
					//need to auto login here and set session					
					$this->Session->destroy();
					
					$userinfo = $this->User->findByEmail($this->data['User']['email']);
					
					$this->Session->write('User', $userinfo['User']);
	
					//create a profile for this user
					#$profiles['Profile']['user_id'] = $userinfo['User']['id'];
					
					#if($this->User->Profile->save($profiles,false))
					#{		
					#}
	
					$this->redirect(array('controller' => 'teachers', 'action' => 'contentProfile'));
					exit;
				}
			}
			else
			{	
				//apparently this code isn't necessary, as validate => 'only' works to handle this
				$errors = $this->User->invalidFields(array('fieldList' => array('password','cpassword','firstname','lastname','email')));
				$this->User->set('errors',$errors);
								
				$errorsProfile = $this->User->Profile->invalidFields(array('fieldList' => array('zip')));
				$this->User->Profile->set('errors',$errors);
			}//END: Else IF

		}//End: DATA check
	}


 


	//I am a teacher loging in I go here first
	function contentProfile($id=null)    // this function is for teacher profile learn tab  
	{
		$userinfo = $this->getUserInfo($id);
		//we should now have a valid teacher id set in $id
		
		$teacher = $this->getTeacher($id);
		$lessons = $this->User->TeacherDesciplineField->findDistinctLessons($id);
		$allLessons = $this->User->TeacherDesciplineField->getLessons($id);
		$descLessons = $this->User->TeacherDesciplineDescription->getLessonDesc($id);
		
		$this->set('lessons', $lessons);
		$this->set('allLessons', $allLessons);
		$this->set('descLessons', $descLessons);
		
		$searchable = false;
		$this->set('searchable', $searchable);
		
		//echo '<pre>';
		//print_r($descLessons);
		//echo '</pre>';
		
				
		$is_me = $this->getIsMe($teacher, $userinfo);
		
		$this->set('is_me', $is_me);
		
		$this->set('teachername', $teacher['fullname']);
		$this->set('teacher', $teacher);
			
		$this->layout = "front_teacher";
		
		$this->set("title_for_layout", $teacher['fullname'].'\'s music teacher profile and book lessons now! - LessonShark');
		
		$this->set('tab', 'learn');
		
		$this->set('id', $id);
		
		//stuff to do later
		$bgcheck = false;
		$ratings = array();
		
		$this->set('bgcheck', $bgcheck);
		$this->set('ratings', $ratings);
			
	/*		$this->Session->write('tabname1','learn');
			$errorMessage                 ="";	
			$this->set('message', $errorMessage); 
			$flag                         ="";	
			$this->set('flag', $flag); 
			$message                      ='';
			App::import('Model','TeacherDesciplineField');
			$this->TeacherDesciplineField                                 = & new TeacherDesciplineField();	    
			 $discipline = $this->TeacherDesciplineField->find('all',array('conditions'=>array('tid'=>$id))); 
	                	 $arr_d=array();$count=1;
	                //$this->set('discipline_old',$discipline);
			foreach($discipline as $des)
	                    {
	                        $ds1=$des['TeacherDesciplineField']['dsid'];
	                        $arr_d[$ds1][$count]=$des;
	                        $count++;
	                    }
	                
				     		
				$this->set('discipline',$arr_d);
			 App::import('Model','TeacherDescipline');
	                    $this->TeacherDesciplines = & new TeacherDescipline();
	                    //$users=$this->TeacherDesciplines->find('all');
	                    $this->set('flag',$flag);
	                    $categories = $this->TeacherDesciplines->find('all');
	                    $discplines = Set::combine($categories, "{n}.TeacherDesciplines.dsid","{n}.TeacherDesciplines.dname");
	                    
			   $this->set('discpline_old', $discplines);	*/	
		
	}


	######################### Below: Code we are currently working on ############################


  function profileMedia($id) {	

		$this->Session->write('tabname','media'); 
		$errorMessage       ="";	
		$this->set('message', $errorMessage); 
		$this->set('id',$id);
		$this->pageTitle    = __('Admin: Users Management', true);
		$this->layout                 = "teacher_default";
		App::import('Model','TeacherMedia');
	 	$this->TeacherMedia =& new TeacherMedia();        

	 	$this->TeacherMedia->set($this->data);
		if ( !empty( $this->data ) )
		{    
		
			/*if ($this->TeacherMedia->validates(array('fieldList' => array('url','label'))) ) 
		   	   {*/
 	   	foreach ($this->data['TeacherMedia']['label'] as $key=>$value)
			{
				$details1['TeacherMedia']['url']   = $this->data['TeacherMedia']['url'][$key];
				$details1['TeacherMedia']['label'] = $this->data['TeacherMedia']['label'][$key];
				$details1['TeacherMedia']['tid']   = $id;

				$this->TeacherMedia->saveAll($details1);
			}
			//$this->redirect('/teachers/profileLocation/'.$id);
			   /*}
			else
			  {


			   $errorMessage="";		
			   $errors = $this->TeacherMedia->invalidFields(array('fieldList' => array('url','label')));
			   foreach ($errors as $val) 
				 {
				      $errorMessage .= '<li>'.$val.'</li>';
	      			 }
		       	 
		   	 }*/
			$this->set('message', $errorMessage); 
			$this->Session->write('tabname','media');
		}

   } //end of add profile media function

 	/**
   * Edit Media is used to edit media enterd by particular teacher.
   *
   * It's possible to enter in the URL, or embed code of a Soundcloud,
   * Vimeo, or YouTube file. There can also be one featured piece of media.
   *
   * @param int $id The user-ID of the teacher the media belongs to. 
   */
  public function editMedia($id = null) {
  	$this->checkEditPermission($id);

  	// Access verified.

  	$this->Session->write('tabname','media');

		$this->pageTitle	= __('Admin: Users Management', true);
		$this->layout			= "teacher_edit";#teacher_default
		$this->set('id', $id);
		$this->set('tab', 'media');

		App::import('Model', 'TeacherMedia');
		$this->TeacherMedia =& new TeacherMedia();

		// Handle Submitted Data:

		if ($this->RequestHandler->isPost() && $this->data) {
			$this->TeacherMedia->set($this->data);
			$this->data = $this->TeacherMedia->beforeEverything();

			if ($this->TeacherMedia->saveAll($this->data['TeacherMedia'], array('validate' => true)))
			{
				$this->Session->setFlash("Media saved successfully.", "default", array("class" => "saved edit_media_notify"));
			} else { //Save failed.
				$this->Session->setFlash("Saving media failed.", "default", array("class" => "error edit_media_notify"));
				$errors = $this->TeacherMedia->invalidFields();
				#debug($errors);
			}

		}

		$media = $this->TeacherMedia->find('all',
			array('conditions' => array('user_id' => $id)));
		$this->set('media', $media);

		if(!isset($errors))
			$errors = null;
		$this->set(compact("errors"));
	} // end of edit media function


	public function contentMedia($id=null)
	{
		$this->Session->write('tabname1','media');

		$userinfo = $this->getUserInfo($id);
		$teacher = $this->getTeacher($id);
		$is_me = $this->getIsMe($teacher, $userinfo);

		$this->set(compact('teacher', 'is_me'));
		$this->set('teachername', $teacher['fullname']);

		//$teacher= $_SESSION['teacher']; 
		//$id=$teacher['id'];	
		//$errorMessage                 ="";	
		//$this->set('message', $errorMessage); 
		//$flag                         ="";	
		//$this->set('flag', $flag); 
		//$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "front_teacher"; #teacher_profile
		$this->set('tab', 'media');
		
		App::import('Model','TeacherMedia');
	 	$this->TeacherMedia 	=& new TeacherMedia();  
		$media = $this->TeacherMedia->find('all', array(
			'conditions' => array('user_id' => $id)));  
		$this->set('media',$media);
		$this->set('id', $id);

		//stuff to do later (COPY)
		$bgcheck = false;
		$ratings = array();
		
		$this->set('bgcheck', $bgcheck);
		$this->set('ratings', $ratings);
	}

	public function delmedia($id)
	{
		App::import('Model','TeacherMedia');
		$this->TeacherMedia = & new TeacherMedia();  
		 
		if ($this->TeacherMedia->delete(array('TeacherMedia.id' => $id)))
		{
			$this->Session->setFlash("Successfully deleted a piece of media.");
		} else {
			$this->Session->setFlash("Deletion failed. Your login might have expired.");
		}
		
		$this->redirect($this->referer());
	}

	public function editCredential($id=null)
	{
		$id = $this->checkEditPermission($id);

		$teacher = $this->getTeacher($id);

		$this->pageTitle  = __('Admin: Users Management', true);
		$this->layout     = "teacher_edit";
		
		$this->Session->write('tabname', 'credential');
		$this->set('id', $id);
		$this->set('tab', 'credential');
		/*
		$teacher= $_SESSION['teacher'];
		$id=$teacher['id'];
		$errorMessage                 ="";
		$this->set('message', $errorMessage);
		$flag                         ="";
		$this->set('flag', $flag);
		$message                      ='';
		*/
		
		App::import('Model','TeacherExperience');
		$this->TeacherExperience = & new TeacherExperience();
		

		// Handle Submitted Data:

		if ($this->RequestHandler->isPost() && $this->data) {
			#debug($this->data);
			if ($this->TeacherExperience->save($this->data['TeacherExperience']))
			{
				$this->Session->setFlash("Credentials saved successfully.", "default", array("class" => "saved edit_credentials_notify"));
			} else { //Save failed.
				$this->Session->setFlash("Saving Credentials failed.", "default", array("class" => "error edit_credentials_notify"));
				$errors = $this->TeacherExperience->invalidFields();
				#debug($errors);
			}

		}

		$credentials = $this->TeacherExperience->find('first',
			array('conditions' => array('user_id' => $id)));
		$this->set(compact('credentials'));

		if(!isset($errors))
			$errors = null;
		$this->set(compact("errors"));

		/*
		if ( !empty( $this->data ) )
		{    	
			if($this->data['TeacherExperience']['hidd'] =='temp' )
			{
				$details['TeacherExperience']['education'] 	= $this->data['TeacherExperience']['education'] ;
				$details['TeacherExperience']['teaching'] 	= $this->data['TeacherExperience']['teaching'];
				$details['TeacherExperience']['tid']				= $id;
				$details['TeacherExperience']['performance']= $this->data['TeacherExperience']['performance'] ;
					
				$this->TeacherExperience->save($details,false);			
	    }
			else
			{
				
				$details['TeacherExperience']['education'] 	= $this->data['TeacherExperience']['education'];
				$details['TeacherExperience']['teaching'] 	= $this->data['TeacherExperience']['teaching'];
				$details['TeacherExperience']['tid']		=$id;
				$details['TeacherExperience']['id']		=$this->data['TeacherExperience']['hidd'];
				$details['TeacherExperience']['performance'] 	= $this->data['TeacherExperience']['performance'];
				
				$this->TeacherExperience->save($details['TeacherExperience'],false);
			}
		}
		$teacherexperience = $this->TeacherExperience->find('all',array('conditions'=>array('tid'=>$id)));
		$this->set('teacherexperience',$teacherexperience);
		*/
	}

	public function contentCredential($id=null)
	{
		$this->Session->write('tabname1','experience');

		$userinfo = $this->getUserInfo($id);
		$teacher = $this->getTeacher($id);
		$is_me = $this->getIsMe($teacher, $userinfo);

		$this->set(compact('teacher', 'is_me'));
		$this->set('teachername', $teacher['fullname']);

		/*
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		*/
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "front_teacher";
		$this->set("tab", "experience");

		App::import('Model','TeacherExperience');
		$this->TeacherExperience =& new TeacherExperience();
		$teacherexperience       = $this->TeacherExperience->find('first',array('conditions'=>array('user_id'=>$id)));
		$this->set('teacherexperience', $teacherexperience);

		$this->set('id', $id);

		//stuff to do later (COPY)
		$bgcheck = false;
		$ratings = array();
		
		$this->set('bgcheck', $bgcheck);
		$this->set('ratings', $ratings);
	}

	/**
	 * Displays the form to capture data for a TruDiligence BG check.
	 *
	 * @param int $id The ID of the teacher the background check is for.
	 */
	public function backgroundCheck($id = null) {
		$id = $this->checkEditPermission($id);

		$teacher = $this->getTeacher($id);

		$this->pageTitle  = __('LessonShark Background Check', true);
		$this->layout     = "teacher_edit";
		
		$this->Session->write('tabname', 'credential');
		$this->set(compact('id', 'teacher'));
		$this->set('tab', 'credential');


		App::import('Model','Profile');
		$this->Profile = & new Profile();
		

		// Handle Submitted Data:
		#if($this->RequestHandler->isPost()) echo "yes"; else echo "no";
		if (($this->RequestHandler->isPost() && $this->data) || ($this->RequestHandler->isPut() && $this->data)) {
			#debug($this->data);
			$this->data['Profile']['validation_requested'] = 1;
			#if ($this->Profile->save($this->data['Profile']))
			if ($this->Profile->saveAll($this->data))
			{
				$this->Session->setFlash("Background check initiated.", "default", array("class" => "saved edit_background_notify"));
				$this->redirect(array("controller" => "teachers", "action" => "editCredential"));
			} else { //Save failed.
				$this->Session->setFlash("There were errors with your background information.", "default", array("class" => "error edit_background_notify"));
				$errors = $this->Profile->invalidFields();
				#debug($errors);
			}
		}

		$background = $this->Profile->find('first',
			array('conditions' => array('user_id' => $id)));
		$this->set(compact('background'));

		App::import('Model','State');
		$this->State = & new State();
		$states = $this->State->find('list');
		$this->set(compact("states"));

		if(!isset($errors))
			$errors = null;
		$this->set(compact("errors"));

	}

	function contentBackgroundCheck() {
		$this->Session->write('tabname1','experience');

		$userinfo = $this->getUserInfo($id, true);
		$teacher = $this->getTeacher($id);
		$is_me = $this->getIsMe($teacher, $userinfo);

		$this->set(compact('teacher', 'is_me'));
		$this->set('teachername', $teacher['fullname']);

		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "front_teacher";
		$this->set("tab", "experience");

		#App::import('Model','TeacherBackground');
		#$this->TeacherBackground  = & new TeacherBackground();
		#$teacherbackgrounds       = $this->TeacherBackground->find('all', array('conditions'=>array('approved'=>'0')));
		#$this->set(compact('teacherbackgrounds'));

		$teacherbackgrounds = $this->User->find('all', array(
			'conditions'=>array('Profile.validation_requested'=>'1'),
			'recursive' => 2));
		$this->set(compact('teacherbackgrounds'));

		$this->set('id', $id);

		//stuff to do later (COPY)
		$bgcheck = false;
		$ratings = array();
		
		$this->set('bgcheck', $bgcheck);
		$this->set('ratings', $ratings);
	}

	public function approveBackground($id, $what) {
		$myID = null;
		$userinfo = $this->getUserInfo($myID, true);

		$field = ($what == "background") ? "approved_background" : "approved_degree";

		App::import('Model','Profile');
		$this->Profile =& new Profile();
		$profile_id = $this->Profile->find("first", array("conditions" => array("user_id" => $id)));
		$this->Profile->id = $profile_id['Profile']['id'];
		$expSaved = $this->Profile->saveField($field, "1");

		$profileSaved = false;
		if ($expSaved) {
			$profileSaved = $this->Profile->saveField("validation_requested", "0");
		}

		if ($expSaved && $profileSaved) {
			$this->Session->setFlash("Approval saved.", "default", array("class" => "saved"));
		} else {
			$this->Session->setFlash("Saving approval failed.", "default", array("class" => "error"));
		}

		$this->redirect($this->referer());
	}

	



	function editLocation($locid = null, $task = null)
	{
		//task is either add, edit, delete
		$id = null;
		$userinfo = null;
		
		$userinfo = $this->getUserInfo($id);
		$teacher = $this->getTeacher($id);
		$is_me = $this->getIsMe($teacher, $userinfo);

		$this->set(compact('teacher', 'is_me'));
		$this->set('teachername', $teacher['fullname']);
		
		App::import('Model','TeacherLocation');
		$this->TeacherLocation = & new TeacherLocation();
		
		$locations = $this->TeacherLocation->getLocations($id);
		
		$this->set('locations', $locations);
		
		$this->set('locationtype', '');
				
			
		$this->layout="teacher_edit";
		
		$this->set("title_for_layout", 'Edit locations - LessonShark');
		
		$this->set('tab', 'location');
		$this->set('id', $id);
		
		$this->set('userinfo', $userinfo);
		
		//echo '<pre>';
		//print_r($this->data);
		//echo '</pre>';
		
		$errors = array();
		$hasErrors = false;
		
		$save = false;
		
		//used to start validation rule setup
		$this->TeacherLocation->set( $this->data );
		
		if( !empty( $this->data ) ) 
		{
			//figure out what type of location we are: home or studio
			$type = $this->data['TeacherLocation']['type'];

			// Transform ZIP
			//$locationData = $this->TeacherLocation->User->Profile->zipToCity($this->data['TeacherLocation']['zip']);
			//$this->data['TeacherLocation']['city'] = $locationData['city'];
			//$this->data['TeacherLocation']['state'] = $location['state'];
		
			if($type == 'home')
			{
				if ($this->TeacherLocation->validates(array('fieldList' => array('name','zip','radius'))) ) 
				{ 	
					
					//$this->data['User']['username'] = $this->data['User']['username'];
					
				 	//updates
					/*$this->data['User']['password'] = md5($this->data['User']['email'].$this->data['User']['password'].$PSALT);
					$this->data['User']['role'] = 'teacher';	
		
								
					//$this->User->save($this->data ,false);
					*/
					if($this->TeacherLocation->saveAll($this->data, array("validate" => false)))
					{
						
						//need to auto login here and set session					
						/*$this->Session->destroy();
						
						$userinfo = $this->User->findByEmail($this->data['User']['email']);
						
						$this->Session->write('User', $userinfo['User']);
	
						//create a profile for this user
						#$profiles['Profile']['user_id'] = $userinfo['User']['id'];
						
						#if($this->User->Profile->save($profiles,false))
						#{		
						#}
	
						$this->redirect(array('controller' => 'teachers', 'action' => 'contentProfile'));
						exit;*/
					}
				}
				else
				{
					$errors = $this->TeacherLocation->invalidFields(array('fieldList' => array('name','zip','radius')));
					$this->TeacherLocation->set('errors',$errors);
					
					
				}//END: Else IF
			}
			else //$type = 'studio'
			{
				if ($this->TeacherLocation->validates(array('fieldList' => array('name', 'address1', 'city', 'state', 'zip'))) ) 
				{ 	
					
					//$this->data['User']['username'] = $this->data['User']['username'];
					
				 	//updates
					/*$this->data['User']['password'] = md5($this->data['User']['email'].$this->data['User']['password'].$PSALT);
					$this->data['User']['role'] = 'teacher';	
		
								
					//$this->User->save($this->data ,false);
					
					if($this->User->saveAll($this->data, array("validate" => false)))
					{
						
						//need to auto login here and set session					
						$this->Session->destroy();
						
						$userinfo = $this->User->findByEmail($this->data['User']['email']);
						
						$this->Session->write('User', $userinfo['User']);
	
						//create a profile for this user
						#$profiles['Profile']['user_id'] = $userinfo['User']['id'];
						
						#if($this->User->Profile->save($profiles,false))
						#{		
						#}
	
						$this->redirect(array('controller' => 'teachers', 'action' => 'contentProfile'));
						exit;
					}*/
				}
				else
				{	
					$errors = $this->TeacherLocation->invalidFields(array('fieldList' => array('name', 'address1', 'city', 'state', 'zip')));
					$this->TeacherLocation->set('errors',$errors);
				}//END: Else IF
			}

		}//End: DATA check
		
		//$this->set('errors', $errors);
		$this->set('hasErrors', $hasErrors);
		$this->set('save', $save);
		
		echo '<pre>';
		print_r($errors);
		echo '</pre>';
		
		//old Indian team code below
                /*$teacher= $_SESSION['teacher']; 
                $id=$teacher['id'];	
		$this->Session->write('tabname','location'); 
		$errorMessage       ="";	
		$this->set('message', $errorMessage); 
		$this->set('id',$id);
		$this->pageTitle    = __('Admin: Users Management', true);
		$this->layout                 = "teacher_default";
		//die('page under progress');
			
		App::import('Model','TeacherLocation');
		$this->TeacherLocation =& new TeacherLocation();
		$this->TeacherLocation->set($this->data);
		
		
			
	if ( !empty( $this->data ) )
		{ 
            //pr($this->data);die;
            if($locId=='null')
            {  
            
            if($this->data['TeacherLocation']['type']=='home')
			{
			  if ($this->TeacherLocation->validates(array('fieldList' => array('type','zip','radius'))) ) 
		   	     {
				$details['TeacherLocation']['city'] 	= $this->data['TeacherLocation']['city1'];
				$details['TeacherLocation']['zip'] 	= $this->data['TeacherLocation']['zip'];
				$details['TeacherLocation']['radius'] 	= $this->data['TeacherLocation']['radius'];
				$details['TeacherLocation']['tid']      =$id;
				//pr($details);die;	
				$this->TeacherLocation->save($details,false);
				//$this->redirect('/admin/users/profileAvailability/'.$id);
			     }
			   else
			    {


				   $errorMessage="";		
				   $errors = $this->TeacherLocation->invalidFields(array('fieldList' => array('type','zip','radius',)));
				   foreach ($errors as $val) 
					 {
					      $errorMessage .= '<li>'.$val.'</li>';
		      			 }
			       	 
			    }
			  $this->set('message', $errorMessage); 
			}
		  else if($this->data['TeacherLocation']['type']=='studio')
		   {		
			  if ($this->TeacherLocation->validates(array('fieldList' => array('type','address1','address2','city','state'))) ) 
		   	     {
				$details['TeacherLocation']['zip'] 	= $this->data['TeacherLocation']['zip1'];
				$details['TeacherLocation']['type'] 	= $this->data['TeacherLocation']['type'];
				$details['TeacherLocation']['address1'] = $this->data['TeacherLocation']['address1'];
				$details['TeacherLocation']['address2'] = $this->data['TeacherLocation']['address2'];
				$details['TeacherLocation']['city'] 	= $this->data['TeacherLocation']['city'];
				$details['TeacherLocation']['state'] 	= $this->data['TeacherLocation']['state'];

				$details['TeacherLocation']['tid']      =$id;
				//pr($details);die;
				$this->TeacherLocation->save($details,false);
				//$this->redirect('/admin/users/profileAvailability/'.$id);
			     }
			   else
			    {


				   $errorMessage="";		
				   $errors = $this->TeacherLocation->invalidFields(array('fieldList' => array('type','address1','address2','city','state',)));
				   foreach ($errors as $val) 
					 {
					      $errorMessage .= '<li>'.$val.'</li>';
		      			 }
			       	 
			    }
			$this->set('message', $errorMessage); 
	            }
		 else 
		   {
			
		   } 
                   //cp
                }
             else
                {
              // pr($this->data);die;
                  if($this->data['TeacherLocation']['type']=='home')
			{  
                             $value1=$this->data['TeacherLocation']['hidd'];
                             $conditions=array('TeacherLocation.id' => $value1);
                             // pr($conditions);die;
			     $this -> TeacherLocation -> delete($conditions);
                               
			  if ($this->TeacherLocation->validates(array('fieldList' => array('type','zip','radius'))) ) 
		   	     {
                                $details['TeacherLocation']['id']       =$value1;
				$details['TeacherLocation']['city'] 	= $this->data['TeacherLocation']['city1'];
				$details['TeacherLocation']['zip'] 	= $this->data['TeacherLocation']['zip'];
				$details['TeacherLocation']['radius'] 	= $this->data['TeacherLocation']['radius'];
				$details['TeacherLocation']['tid']      =$id;
				//pr($details);die;	
				$this->TeacherLocation->save($details,false);
				//$this->redirect('/admin/users/profileAvailability/'.$id);
			     }
			   else
			    {


				   $errorMessage="";		
				   $errors = $this->TeacherLocation->invalidFields(array('fieldList' => array('type','zip','radius',)));
				   foreach ($errors as $val) 
					 {
					      $errorMessage .= '<li>'.$val.'</li>';
		      			 }
			       	 
			    }
			  $this->set('message', $errorMessage); 
			}
		  else if($this->data['TeacherLocation']['type']=='studio')
		   {		
			    $value1=$this->data['TeacherLocation']['hidd'];
                            $conditions=array('TeacherLocation.id' => $value1);
			  if ($this->TeacherLocation->validates(array('fieldList' => array('type','address1','address2','city','state'))) ) 
		   	     { 
				$details['TeacherLocation']['id']       =$value1;
				$details['TeacherLocation']['zip'] 	= $this->data['TeacherLocation']['zip1'];
				$details['TeacherLocation']['type'] 	= $this->data['TeacherLocation']['type'];
				$details['TeacherLocation']['address1'] = $this->data['TeacherLocation']['address1'];
				$details['TeacherLocation']['address2'] = $this->data['TeacherLocation']['address2'];
				$details['TeacherLocation']['city'] 	= $this->data['TeacherLocation']['city'];
				$details['TeacherLocation']['state'] 	= $this->data['TeacherLocation']['state'];

				$details['TeacherLocation']['tid']      =$id;
				//pr($details);die;
				$this->TeacherLocation->save($details,false);
				//$this->redirect('/admin/users/profileAvailability/'.$id);
			     }
			   else
			    {


				   $errorMessage="";		
				   $errors = $this->TeacherLocation->invalidFields(array('fieldList' => array('type','address1','address2','city','state',)));
				   foreach ($errors as $val) 
					 {
					      $errorMessage .= '<li>'.$val.'</li>';
		      			 }
			       	 
			    }
			$this->set('message', $errorMessage); 
	            }
		 else 
		   {
			
		   }   

                }

	       }
		if($locId)
		{			
			$ser=$this->params['pass'][1];
			$id=$this->params['pass'][0];
			$loc = $this->TeacherLocation->find('all',array('conditions'=>array('id'=>$ser))); 
			$this->set('loc',$loc);	
		}
		else
		{	
			$loc='';
			$this->set('loc',$loc);	
		}	
		$teacherlocation       = $this->TeacherLocation->find('all',array('conditions'=>array('tid'=>$id)));  
		$this->set('teacherlocation',$teacherlocation);*/


	}//end  of location edit profile function


	######################### Below: Code not yet dealt with ############################


   function profileAvailability($id) //this function is for adding availability to teacher profile 
        {

		die('page under progress');
		$errorMessage="";	
		$this->set('message', $errorMessage); 
		$location='';
		$this->set('id',$id);
		$this->pageTitle  = __('Admin: Users Management', true);
		App::import('Model','TeacherAvailability');
		$this->TeacherAvailability =& new TeacherAvailability();
		$this->layout     = "admin";
			    
		$this->TeacherAvailability->set($this->data);
		if ( !empty( $this->data ) ) // this condition checks if data comes though form or not
		{  //echo '<pre>'; print_r($this->data);
		
			if ($this->TeacherAvailability->validates(array('fieldList' => array('dayofweek','location','starttime','endtime'))) ) 
		   	   {
			 	$details['TeacherAvailability']['location'] 	= $this->data['TeacherAvailability']['location'];
				$details['TeacherAvailability']['dayofweek'] 	= $this->data['TeacherAvailability']['dayofweek'];
				$details['TeacherAvailability']['tid']=$id;
				$details['TeacherAvailability']['starttime'] 	= $this->data['TeacherAvailability']['starttime'];
				$details['TeacherAvailability']['endtime'] 	= $this->data['TeacherAvailability']['endtime'];
				$details['TeacherAvailability']['startdate'] 	= $this->data['TeacherAvailability']['startdate'];
				$details['TeacherAvailability']['enddate'] 	= $this->data['TeacherAvailability']['enddate'];		
				$this->TeacherAvailability->save($details,false);
				//$this->redirect('/admin/users/addProfileExperience/'.$id);	
		 	  }
		       else
			  {


				   $errorMessage="";		
				   $errors = $this->TeacherAvailability->invalidFields(array('fieldList' => array('dayofweek','location','starttime','endtime',)));
			   foreach ($errors as $val) 
				 {
				      $errorMessage .= '<li>'.$val.'</li>';
	      			 }
		       	 
		   	 }
			$this->set('message', $errorMessage); 
	
		 }
		App::import('Model','TeacherLocation');
		$this->TeacherLocation =& new TeacherLocation();
	
		$categories      = $this->TeacherLocation->find(all);
		$location        = Set::combine($categories, "{n}.TeacherLocation.id","{n}.TeacherLocation.city");

		$this->set('location',$location);
		$this->Session->check('condition') ? $this->Session->delete('condition'):'' ;


	}// end of add availability function
     function profilePolicy($id)
	{	
		$this->Session->write('tabname','policy');
		 $errorMessage="";	
		 $this->set('message', $errorMessage); 
		 $this->pageTitle  = __('Admin: Users Management', true);
		 $this->layout     = "teacher_default";
		 

		 $this->set('id',$id);

		App::import('Model','TeacherPolicy');
		$this->TeacherPolicy = & new TeacherPolicy();	               
		 $this->TeacherPolicy->set($this->data);
		if ( !empty( $this->data ) )
		{    
			
		  if ($this->TeacherPolicy->validates(array('fieldList' => array('makeuplesson','cancelation'))) ) 
		     {
			$details['TeacherPolicy']['tid'] 	    = $id;
			$details['TeacherPolicy']['makeuplesson']   = $this->data['TeacherPolicy']['makeuplesson'];
			$details['TeacherPolicy']['cancelation']    = $this->data['TeacherPolicy']['cancelation'];


			foreach($this->data['TeacherPolicy']['title'] as $key=>$value)
			{

			

				$details['TeacherPolicy']['title']   = $this->data['TeacherPolicy']['title'][$key];
				$details['TeacherPolicy']['details'] = $this->data['TeacherPolicy']['details'][$key];

				$this->TeacherPolicy->saveAll($details);
			}
	 			$this->set('id',$id);
		     }	
		     else
			{
			   $errorMessage="";		
			   $errors = $this->TeacherPolicy->invalidFields(array('fieldList' => array('makeuplesson','cancelation',)));
			   foreach ($errors as $val) 
				 {
				      $errorMessage .= '<li>'.$val.'</li>';
	      			 }
		       	 
		   	}
					 $this->set('message', $errorMessage); 
		
			//$this->redirect('/admin/users/addProfileMedia/'.$id);
		}
    } // end of function add profile policy   	


function editPolicy($id=null)
	{	
                $teacher= $_SESSION['teacher']; 
                $id=$teacher['id'];	
		$this->Session->write('tabname','policy');
		 $errorMessage="";	
		 $this->set('message', $errorMessage); 
		 $this->pageTitle  = __('Admin: Users Management', true);
		 $this->layout     = "teacher_default";
		 
		
		 $this->set('id',$id);

		App::import('Model','TeacherPolicy');
		$this->TeacherPolicy = & new TeacherPolicy();	               
		 $this->TeacherPolicy->set($this->data);
		if ( !empty( $this->data ) )
		{    
			
		
		  if ($this->TeacherPolicy->validates(array('fieldList' => array('makeuplesson','cancelation'))) ) 
		     {	
			$details['TeacherPolicy']['tid'] 	    = $id;
			$details['TeacherPolicy']['makeuplesson']   = $this->data['TeacherPolicy']['makeuplesson'];
			$details['TeacherPolicy']['cancelation']    = $this->data['TeacherPolicy']['cancelation'];
			
			$details1['TeacherPolicy']['tid'] 	    = $id;
			$details1['TeacherPolicy']['makeuplesson']  = $this->data['TeacherPolicy']['makeuplesson'];
			$details1['TeacherPolicy']['cancelation']   = $this->data['TeacherPolicy']['cancelation'];
			
			foreach($this->data['TeacherPolicy']['title'] as $key=>$value)
			{

			

				if($this->data['TeacherPolicy']['hidd'][$key]!='temp')
			    	    {
					$conditions=array('TeacherPolicy.id'  => $value);
					$this->TeacherPolicy-> delete($conditions);
					$details['TeacherPolicy']['id']       = $this->data['TeacherPolicy']['hidd'][$key];
		                        $details['TeacherPolicy']['title']    = $this->data['TeacherPolicy']['title'][$key];
					$details['TeacherPolicy']['details']  = $this->data['TeacherPolicy']['details'][$key];
					
					$this->TeacherPolicy->saveAll($details);
					//$details='';
				    }	
	 			else
				    {
				
		                        $details1['TeacherPolicy']['title']   = $this->data['TeacherPolicy']['title'][$key];
					$details1['TeacherPolicy']['details'] = $this->data['TeacherPolicy']['details'][$key];
									
					$this->TeacherPolicy->saveAll($details1);
				    }   	
			}
	 			$this->set('id',$id);
		     }	
		     else
			{
			   $errorMessage="";		
			   $errors = $this->TeacherPolicy->invalidFields(array('fieldList' => array('makeuplesson','cancelation',)));
			   foreach ($errors as $val) 
				 {
				      $errorMessage .= '<li>'.$val.'</li>';
	      			 }
		       	 
		   	}
			
			
			
			//$this->redirect('/admin/users/addProfileMedia/'.$id);
		}

		$this->set('message', $errorMessage); 
			$teacherpolicy       = $this->TeacherPolicy->find('all',array('conditions'=>array('tid'=>$id)));  
			$this->set('teacherpolicy',$teacherpolicy);
    } // end of function add profile policy   	

// strating of edit general tab

	function editGeneral($area = null)
	{
		//area should be booking, age, picture only
		
		global $PROFILE_PICTURES_PATH;
		global $PSALT;
		
		$id = null;
		$userinfo = null;
		
		if($this->Session->check('User'))
		{
			//we already are logged in, so you can't be here
			$userinfo['User'] = $this->Session->read('User');
			
			if( $userinfo['User']['role'] == "admin" )
		   	{
				//$this->Session->write('Admin', $userinfo['User']);
			    $this->redirect(array('controller' => 'users', 'action' => 'admin_home'));
				exit;
			}
		    else if ($userinfo['User']['role'] == 'teacher' )
		    {
				 //Coder
			    //$this->Session->write('teacher', $userinfo['User']);
			    $id = $userinfo['User']['id'];
			    
			    
			 }
			 else
			 {
			 	//we are a student
			 	
			 }     
		}
			
		else if(empty($id))
		{
			//we aren't logged in and don't know what teacher to show
			$this->redirect(array('controller' => 'homes', 'action' => 'login'));
			exit;
		}
		
		App::import('Model','User');
		$this->User = & new User();
		
		$profile = $this->User->Profile->findByUserId($userinfo['User']['id']);
		$userinfo['Profile'] = $profile['Profile'];
			
		$this->layout="teacher_edit";
		
		$this->set("title_for_layout", 'Edit general profile - LessonShark');
		
		$this->set('tab', 'general');
		$this->set('id', $id);
		
		$this->set('userinfo', $userinfo);
				
		$save = false;
		$error = false;
		
		//error array
		$errors['age_limit'] = false;
		$errors['image_empty'] = false;
		$errors['image_upload'] = false;
		
		//verify what to show for saving/errors
		if($this->Session->check('TeachersEditGeneral.save') && $this->Session->read('TeachersEditGeneral.save'))
		{
			$save = true;

			$this->Session->delete('TeachersEditGeneral.save');
		}
		
		
		
		
		if(empty($this->data))
		{
			$this->data['Profile'] = $userinfo['Profile'];
		}		
		else 
	    {
	    	switch ($area)
	    	{
			    case "booking":
			    	//echo '<pre>';print_r($this->data);echo '</pre>';
			    	
			    	if(empty($this->data['Profile']['booking_status']))
			    		$this->data['Profile']['booking_status'] = $userinfo['Profile']['booking_status'];
			    	
			    	if(!empty($this->data['Profile']['booking_status'])) 
					{
						if($this->data['Profile']['booking_status'] == 'open')
							$this->data['Profile']['booking_status'] = 'closed';
						else
							$this->data['Profile']['booking_status'] = 'open';
					 	
						//echo $this->data['Profile']['booking_status'];
							
						//save						
						$fields = array
						(
							'booking_status'
	    				);					
						
						$this->User->Profile->id = $userinfo['Profile']['id'];
						if($this->User->Profile->save($this->data, false))
						{
							//booking is saved
							$this->Session->write('TeachersEditGeneral.save', true, $fields);
							
							$this->redirect(array('controller' => 'teachers', 'action' => 'editGeneral'));
						}
						
					}
			    	
			        break;
			    //////////////////////////////////////////////
			    case "age":
			    	
			    	//if(!empty($this->data['Profile']['age_limit'])) 
					//{
						if(empty($this->data['Profile']['age_limit']) || is_numeric($this->data['Profile']['age_limit']))
						{	
							//save						
							$fields = array
							(
								'age_limit'
		    				);					
							
							$this->User->Profile->id = $userinfo['Profile']['id'];
							if($this->User->Profile->save($this->data, false))
							{
								//booking is saved
								$this->Session->write('TeachersEditGeneral.save', true, $fields);
								
								$this->redirect(array('controller' => 'teachers', 'action' => 'editGeneral'));
							}
						}
						else 
						{
							//we have an error since its not numeric
							$error = true;
							$errors['age_limit'] = true;
							
							$userinfo['Profile']['age_limit'] = $this->data['Profile']['age_limit'];
						}
						
					//}
			    	
			    	
			    	
			    	
			        break;
			    //////////////////////////////////////////////
			    case "picture":
			    	
			    	$picture_file = null;
			    	$extension = null;
			    	
			    	if(empty($this->data['Profile']['image']['name']))
					{
						$error = true;
						$errors['image_empty'] = true;
					}
					else
					{
						//upload a photo if one exists
						if($this->Upload->validateUploadImage($this->data['Profile']['image']) == 0)
						{
			 				$date = date('m-d-Y h:i:s a');
			 				$key = md5($userinfo['Profile']['id'].$date.$PSALT);
										 				
							$picture[0] = array( 100, 100, "s" );
							$picture[1] = array( 360, 360, "m" );
							$picture[2] = array( 640, 640, "l" );
			
							//make sure thumbnail is square
							$picture[3] = array( 248, 248, "t" );
							
							$imageinfo = getimagesize( $this->data['Profile']['image']['tmp_name'] );
							
							$picture_file = '';
							$extension = $this->Upload->getExtension($imageinfo[2]);
			
							foreach($picture as $pic)
							{
								if($pic[2] != 't')
								{
									//this image is regular and NOT a thumbnail
									
									// figure out the new image size
									$width = $imageinfo[0];
									$height = $imageinfo[1];
					
									$maxWidth = $pic[0];
									$maxHeight = $pic[1];
									
									$x = 0;
									$y = 0;
									
									if($pic[2] != 'm')
									{
										//all the medium picture to be its regular size if it is small
										if( ($width < $maxWidth) && ($height < $maxHeight) )
										{
											//picture is too small, make it bigger
											$newWidth = $width;
											$newHeight = $height;
											
											while( ($newWidth < $maxWidth) && ($newHeight < $maxHeight) )
											{
												$newWidth += $width;
												$newHeight += $height;
											}
											
											$width = $newWidth;
											$height = $newHeight;
										}
									}
					
									if( ($width >= $height) && ($width > $maxWidth) )
									{
										$height = $height * $maxWidth / $width;
										$width = $maxWidth;
									}
									else if( ($height > $width) && ($height > $maxHeight) )
									{
										$width = $width * $maxHeight / $height;
										$height = $maxHeight;
									}
									
									$srcFile = $this->data['Profile']['image']['tmp_name'];
									$picture_file = $key;
									$dstFile = $picture_file . $pic[2] . "." . $extension;
									$noExtension = $picture_file . $pic[2] . ".";
									
									//make the profile folder if it doesn't exist
									If(!file_exists($PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id']))
										mkdir($PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id']);
											
									if( $this->Upload->copyImageFile($srcFile,$imageinfo[2],$PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id'].DS.$dstFile,$x,$y,$imageinfo[0],$imageinfo[1],0,0,intval($width),intval($height)) )
									{
										$error = true;
										$errors['image_upload'] = true;
									}
									else
									{
										//delete the other 2 types of pictures that could have been created already
										$this->Upload->deleteImages($imageinfo[2], $PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id'].DS.$noExtension);
									}
								}
								else
								{
									//generate a square thumbnail
									
									// figure out the new image size
									$width = $imageinfo[0];
									$height = $imageinfo[1];
					
									$thumb_size = $pic[0];
									$x = 0;
									$y = 0;
														
									if($width >= $height)
									{
										$x = ceil(($width - $height) / 2 );
										$width = $height;
									}
									elseif($height > $width)
									{
										$y = ceil(($height - $width) / 2);
										$height = $width;
									}
					
									$srcFile = $this->data['Profile']['image']['tmp_name'];
									$picture_file = $key;
									$dstFile = $picture_file . $pic[2] . "." . $extension;
									$noExtension = $picture_file . $pic[2] . ".";
									
									//make the profile folder if it doesn't exist
									if(!file_exists($PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id']))
										mkdir($PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id']);
									
									if( $this->Upload->copyImageFile($srcFile,$imageinfo[2],$PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id'].DS.$dstFile,$x,$y,$width,$height,0,0,$thumb_size,$thumb_size) )
									{
										$error = true;
										$errors['image_upload'] = true;
									}
									else
									{
										//delete the other 2 types of pictures that could have been created already
										$this->Upload->deleteImages($imageinfo[2], $PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id'].DS.$noExtension);
									}
								}
							}
						}
						else
			    		{
							$error = true;
							$errors['image_upload'] = true;
						}
			
			    		if(!empty($this->data) && ($error == false))
						{
							$this->data['Profile']['image'] = $picture_file;
							$this->data['Profile']['image_extension'] = $extension;
							
							$fields = array
							(
								'image',
								'image_extension'
	    					);				
							
							$this->User->Profile->id = $userinfo['Profile']['id'];
							if($this->User->Profile->save($this->data, false))
							{
								$this->Session->write('TeachersEditGeneral.save', true, $fields);
								
								$this->redirect(array('controller' => 'teachers', 'action' => 'editGeneral'));
							}
						}
					}
	
			    	
			        break;
	    	}
	    }
	    
	    $this->set('save', $save);
		$this->set('error', $error);
		$this->set('errors', $errors);
		

		/*$teacher= $_SESSION['teacher']; 
		$id=$teacher['id'];		
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->Session->write('tabname','general');*/      
		
	}

 	
	
//CDW: crazy function to handle teeachers add and updating their offerings to students
//go to edit profile and then the 'learn' tab
function editProfile()
	{
		$id = null;
		$userinfo = null;
		
		$userinfo = $this->getUserInfo($id);
		$teacher = $this->getTeacher($id);
		$is_me = $this->getIsMe($teacher, $userinfo);

		$this->set(compact('teacher', 'is_me'));
		$this->set('teachername', $teacher['fullname']);
		
		App::import('Model','User');
		$this->User = & new User();
		
		$profile = $this->User->Profile->findByUserId($userinfo['User']['id']);
		$userinfo['Profile'] = $profile['Profile'];
		
		
			
		$this->layout="teacher_edit";
		
		$this->set("title_for_layout", 'Edit lesson offerings - LessonShark');
		
		$this->set('tab', 'learn');
		$this->set('id', $id);
		
		$this->set('userinfo', $userinfo);
		
		App::import('Model','TeacherDescipline');
		$this->TeacherDescipline = & new TeacherDescipline();
		
		$desciplines = $this->TeacherDescipline->getDesciplines();
		$this->set('desciplines', $desciplines);
		
		$lessons = $this->User->TeacherDesciplineField->findDistinctLessons($id);
		$allLessons = $this->User->TeacherDesciplineField->getLessons($id);
		$descLessons = $this->User->TeacherDesciplineDescription->getLessonDesc($id);
		
		$locations = $this->User->TeacherDesciplineField->TeacherLocation->getLocations($id);
		$loc_count = count($locations);
		$this->set('loc_count', $loc_count);
		$this->set('locations', $locations);
		
		//echo '<pre>';
		//print_r($this->data);
		//echo '</pre>';
		
		$errors = array();
		$hasErrors = false;
		
		$save = false;
		
		//verify what to show for saving/errors
		if($this->Session->check('TeacherOfferings.save') && $this->Session->read('TeacherOfferings.save'))
		{
			$save = true;

			$this->Session->delete('TeacherOfferings.save');
		}
		
		if(empty($this->data))
		{
			//we have no data, but lets use the data from desciplines if there is any
			foreach($desciplines as $d)
	    	{
	    		$name = strtolower($d['TeacherDescipline']['dname']);
	    		
	    		//loop through all the lessons we have on this descipline
				
				$this->data['Offerings']['has_'.$name] = 0;
	    		$this->data['Offerings']['count_'.$name] = 0;
	    		
	    		//create defaults
	    		$this->data[$name][0]['duration'] = null;
	    		$this->data[$name][0]['location'] = 0;
	    		$this->data[$name][0]['rate'] = null;
	    		$this->data[$name][0]['teacher_descipline_field_id'] = null;
	    		$this->data[$name]['description'] = null;
	    		$this->data[$name]['description_id'] = null;
	    		
	    		$i = 0;
	    		
	    		foreach($allLessons as $e => $a)
	    		{	
	    			if($a['TeacherDescipline']['dname'] == ucfirst($name))
	    			{
	    				$this->data['Offerings']['has_'.$name] = 1;
	    				$this->data['Offerings']['count_'.$name] = $i + 1;
	    				
	    				$this->data[$name][$i]['duration'] = $a['TeacherDesciplineField']['duration']; 
						$this->data[$name][$i]['location'] = $a['TeacherDesciplineField']['teacher_location_id'];
						$this->data[$name][$i]['rate'] = $a['TeacherDesciplineField']['rate'];
						$this->data[$name][$i]['teacher_descipline_field_id'] = $a['TeacherDesciplineField']['id'];
						
						$i++;
	    			}	
	    		}
	    		
	    		foreach($descLessons as $y => $f)
	    		{
	    			if($f['TeacherDescipline']['dname'] == ucfirst($name))
	    			{
	    				$this->data[$name]['description'] = $this->Tools->br2nl($f['TeacherDesciplineDescription']['description']); 
						$this->data[$name]['description_id'] = $f['TeacherDesciplineDescription']['id'];
					}	
	    		}
	    		
	    		//create defaults for none
	    		$this->data['none'][0]['duration'] = null;
	    		$this->data['none'][0]['location'] = 0;
	    		$this->data['none'][0]['rate'] = null;
	    		$this->data['none'][0]['teacher_descipline_field_id'] = null;
	    		$this->data['none']['description'] = null;
	    		$this->data['none']['description_id'] = null;
	    	}
		}		
		else //we are not empty
	    {
	    	//loop through all data and check for errors
	    	foreach($desciplines as $d)
	    	{
	    		$name = strtolower($d['TeacherDescipline']['dname']);
	    		
	    		if(!empty($this->data['Offerings']['has_'.$name]) && $this->data['Offerings']['has_'.$name] == 1)
	    		{
	    			if(empty($this->data[$name]['description']))
	    			{
	    				$errors[$name]['description'] = 'Description is required.';
	    				$hasErrors = true;
	    			}
	    			
	    			//now we loop through all the duration, lessons, and rates for errors
	    			foreach($this->data[$name] as $k => $v)
	    			{
	    				if(is_numeric($k))
				  		{
		    				if(empty($v['duration']))
		    				{
		    					$errors[$name][$k]['duration'] = 'Duration is required.';
		    					$hasErrors = true;
		    				}
		    				else if(!is_numeric($v['duration']))
		    				{
		    					$errors[$name][$k]['duration'] = 'Enter only numeric values.';
		    					$hasErrors = true;
		    				}
		    				
		    				if($v['location'] == -1)
		    				{
		    					$errors[$name][$k]['location'] = 'Create a location first.';
		    					$hasErrors = true;
		    				}
		    				else if($v['location'] == 0)
		    				{
		    					$errors[$name][$k]['location'] = 'Location is required.';
		    					$hasErrors = true;
		    				}
		    				
		    				if(empty($v['rate']))
		    				{
		    					$errors[$name][$k]['rate'] = 'Rate is required.';
		    					$hasErrors = true;
		    				}
		    				else if(!preg_match('/^[0-9]+(?:\.[0-9]{2}){0,1}$/', $v['rate']))
		    				{
		    					$errors[$name][$k]['rate'] = 'Enter only dollar currency values.';
		    					$hasErrors = true;
		    				}
				  		}
	    			}
	    		}
	    	}
	    	
	    	$saveErrors = 0;
	    	
	    	if(!$hasErrors)
	    	{
	    		$hasContent = false;
	    		
	    		//save the stuff here
	    		
	    		foreach($desciplines as $d)
	    		{	    			
	    			//loop through all desciplines
	    			$name = strtolower($d['TeacherDescipline']['dname']);
	    			$did = $d['TeacherDescipline']['id'];
	    			
	    			//we have something to save
	    			if($this->data['Offerings']['has_'.$name] == 1)
	    			{
	    				$hasContent = true;
	    				
	    				$all = $this->data[$name];
	    				
	    				//loop through each duration, location, rate offering
	    				foreach($all as $z => $val)
	    				{
	    					//save if its correct and not description stuff
	    					if(is_numeric($z))
	    					{
	    						//clear out this variable
	    						$save = '';
	    							
	    						$save['user_id'] = $id;
	    						$save['teacher_location_id'] = $val['location'];
	    						$save['teacher_descipline_id'] = $did;	
	    						$save['rate'] = $val['rate'];
	    						$save['duration'] = $val['duration'];
	    						
	    						if(!empty($val['teacher_descipline_field_id']))
	    							$this->User->TeacherDesciplineField->id = $val['teacher_descipline_field_id'];
	    						else 
	    							$this->User->TeacherDesciplineField->create();
	    						
	    						if($this->User->TeacherDesciplineField->save($save, false))
	    						{
	    							//this one has been saved
	    						}
	    						else 
	    						{
	    							$saveErrors++;
	    						}	    						
	    					}	
	    				}
	    				
	    				//now save descriptions
	    				
	    				//clear out this variable
	    				$save = '';
	    							
    					$save['user_id'] = $id;
    					$save['teacher_descipline_id'] = $did;	
    					$save['description'] = nl2br($this->data[$name]['description']);
    					    					
    					if(!empty($all['description_id']))
    						$this->User->TeacherDesciplineDescription->id = $all['description_id'];
    					else 
    						$this->User->TeacherDesciplineDescription->create();
    					
    					if($this->User->TeacherDesciplineDescription->save($save, false))
    					{
    						//this one has been saved
    					}
    					else 
    					{
    						$saveErrors++;
    					}
	    			}
	    		}
	    		
	    		if($saveErrors == 0)
	    		{
	    			//all data has been successfully saved
	    			
	    			if($hasContent)
	    				$this->Session->write('TeacherOfferings.save', true, 'all');
							
					$this->redirect(array('controller' => 'teachers', 'action' => 'editProfile'));
	    		}
	    		else 
	    		{
	    			//problem occurred when data was saving to db
	    		}
	    	}	    	
	    	
    		/*if(empty($this->data['Profile']['age_limit']) || is_numeric($this->data['Profile']['age_limit']))
			{	
				//save						
				$fields = array
				(
					'age_limit'
    			);					
				
				$this->User->Profile->id = $userinfo['Profile']['id'];
				if($this->User->Profile->save($this->data, false))
				{
					//booking is saved
					$this->Session->write('TeachersEditGeneral.save', true, $fields);
					
					$this->redirect(array('controller' => 'teachers', 'action' => 'editGeneral'));
				}
			}
			else 
			{
				//we have an error since its not numeric
				$error = true;
				$errors['age_limit'] = true;
				
				$userinfo['Profile']['age_limit'] = $this->data['Profile']['age_limit'];
			}*/
	    }
	    
	    
	    //echo '///////////////////////////////////////////////////////<pre>';
		//print_r($errors);
		//echo '</pre>';
	    
	    $this->set('errors', $errors);
		$this->set('hasErrors', $hasErrors);
		$this->set('save', $save);
		
		/*$teacher= $_SESSION['teacher']; 
		$id=$teacher['id'];		
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_default";


		$this->set('id',$id);

		App::import('Model','TeacherDesciplineField');
		$this->TeacherDesciplineField                                 = & new TeacherDesciplineField();	    
		App::import('Model','TeacherLocation');
		$this->TeacherLocation                               	      = & new TeacherLocation();	      	           
		// $this->TeacherDesciplineFields->set($this->data);
		$categories = $this->TeacherLocation->find('all' ,array('conditions'=>array('tid'=>$id)));
			$location = Set::combine($categories, "{n}.TeacherLocation.city","{n}.TeacherLocation.city");
						
			$this->set('location',$location);	
		//if($this->data){pr($this->data);}
			
		
                 if($this->data)
		   { 
			
		   	//pr($this->data);die;
		     if($idnew=='no')
		       {	
                         
			//pr($this->data);die;
			$details['TeacherDesciplineField']['tid'] 	      = $id;
                        $details['TeacherDesciplineField']['description']     = $this->data['TeacherDesciplineField']['description'];
                        $details['TeacherDesciplineField']['dsid']            = $this->data['TeacherDesciplineField']['dsid'];
                        $dsid=$this->data['TeacherDesciplineField']['dsid'];
			$details1['TeacherDesciplineField']['tid'] 	      = $id;
                        $details1['TeacherDesciplineField']['description']    = $this->data['TeacherDesciplineField']['description'];
                        $details1['TeacherDesciplineField']['dsid']           = $this->data['TeacherDesciplineField']['dsid'];
		
                        foreach($this->data['TeacherDesciplineField']['rate'] as $key=>$value)
                        {	
			  if($this->data['TeacherDesciplineField']['hidd'][$key]!='temp')
		    	    {
				$conditions=array('TeacherDesciplineField.id' => $value);
				//$this -> TeacherDesciplineField -> delete($conditions);
				$details['TeacherDesciplineField']['id']     = $this->data['TeacherDesciplineField']['hidd'][$key];
                                $details['TeacherDesciplineField']['rate']     = $value;
				$details['TeacherDesciplineField']['duration'] = $this->data['TeacherDesciplineField']['duration'][$key];
                                $details['TeacherDesciplineField']['location'] = $this->data['TeacherDesciplineField']['location'][$key];
				//pr($details);
                                $this->TeacherDesciplineField->saveAll($details);
				//$details='';
			    }	
 			else
			    {
				
                                $details1['TeacherDesciplineField']['rate']     = $value;
				$details1['TeacherDesciplineField']['duration'] = $this->data['TeacherDesciplineField']['duration'][$key];
                                $details1['TeacherDesciplineField']['location'] = $this->data['TeacherDesciplineField']['location'][$key];
											
				$this->TeacherDesciplineField->saveAll($details1);
			    }                     
			}
                     
                     
                      }// end of if
		     else
			{
				$details['TeacherDesciplineField']['tid'] 	      = $id;
				$details['TeacherDesciplineField']['description']     = $this->data['TeacherDesciplineField']['description'];
				$details['TeacherDesciplineField']['dsid']            = $this->data['TeacherDesciplineField']['dsid'];


				foreach($this->data['TeacherDesciplineField']['rate'] as $key=>$value)
				{

					$details['TeacherDesciplineField']['rate']     = $value;

					$details['TeacherDesciplineField']['duration'] = $this->data['TeacherDesciplineField']['duration'][$key];
					$details['TeacherDesciplineField']['location'] = $this->data['TeacherDesciplineField']['location'][$key];
				       // pr($details);
					$this->TeacherDesciplineField->saveAll($details);
				}				
			   


			}	
		  }	
		  	 $discipline = $this->TeacherDesciplineField->find('all',array('conditions'=>array('tid'=>$id))); 
                	 $arr_d=array();$count=1;
                //$this->set('discipline_old',$discipline);
		foreach($discipline as $des)
                    {
                        $ds1=$des['TeacherDesciplineField']['dsid'];
                        $arr_d[$ds1][$count]=$des;
                        $count++;
                    }
                
			$this->Session->write('tabname','learn');               		
			$this->set('discipline',$arr_d);	
                    App::import('Model','TeacherDesciplines');
                    $this->TeacherDesciplines = & new TeacherDesciplines();
                    //$users=$this->TeacherDesciplines->find('all');
                    $this->set('flag',$flag);
                    $categories = $this->TeacherDesciplines->find('all');
                    $discplines = Set::combine($categories, "{n}.TeacherDesciplines.dsid","{n}.TeacherDesciplines.dname");
                    
		   $this->set('discpline_old', $discplines);
			$idnew='';
			 $this->set('idnew', $idnew);*/

	}
	
	//CDW: simple ajax page to delete offerings from the database if they were previously save
	function ajax_offering_delete($descipline_name = -1, $field_id = -1)
    {
    	$this->layout = 'empty';
    	
    	if($this->Session->check('User'))
		{
			//we already are logged in, so you can't be here
			$userinfo['User'] = $this->Session->read('User');
			$user_id = $userinfo['User']['id'];
			  	
			//CDW: should be descipline_id but for time constraints I have the name (which should be unique)
    		if($descipline_name != -1)
    		{
    			App::import('Model','TeacherDescipline');
				$this->TeacherDescipline = & new TeacherDescipline();
				
				$desc = $this->TeacherDescipline->getDesc($descipline_name);
				$desc_id = $desc['TeacherDescipline']['id'];
				
				//TeacherDesciplineFields updates
				$fields1 = array
				(
					'TeacherDesciplineField.deleted' => 1
				);
				
				$conditions1 = array
				(
					'TeacherDesciplineField.user_id' => $user_id,
					'TeacherDesciplineField.teacher_descipline_id' => $desc_id
				);

				$this->TeacherDescipline->TeacherDesciplineField->updateAll
				(
					$fields1,
					$conditions1
				);
				
				//TeacherDesciplineDescriptions updates
				$fields2 = array
				(
					'TeacherDesciplineDescription.deleted' => 1
				);
				
				$conditions2 = array
				(
					'TeacherDesciplineDescription.user_id' => $user_id,
					'TeacherDesciplineDescription.teacher_descipline_id' => $desc_id
				);

				$this->TeacherDescipline->TeacherDesciplineDescription->updateAll
				(
					$fields2,
					$conditions2
				);
				
    		}
    	
    		if($field_id != -1)
    		{
    			App::import('Model','TeacherDesciplineField');
				$this->TeacherDesciplineField = & new TeacherDesciplineField();
				
				$lesson = $this->TeacherDesciplineField->findLesson($field_id);
				
				$this->TeacherDesciplineField->id = $field_id;
				$this->TeacherDesciplineField->saveField('deleted', 1, true);
				
				//if we have no offerings, delete the description too
				$count = $this->TeacherDesciplineField->lessonCount($user_id, $lesson['TeacherDesciplineField']['teacher_descipline_id']);

				if($count == 0)
				{
					App::import('Model','TeacherDesciplineDescription');
					$this->TeacherDesciplineDescription = & new TeacherDesciplineDescription();
					
					$desc_id = $this->TeacherDesciplineDescription->findDescription($user_id, $lesson['TeacherDesciplineField']['teacher_descipline_id']);

					$this->TeacherDesciplineDescription->id = $desc_id['TeacherDesciplineDescription']['id'];
					$this->TeacherDesciplineDescription->saveField('deleted', 1, true);
				}
    		}
		} 
    } //end ajax_offering_delete
    
	
	
	
	function editAvailability($area = null)
		{
			//area should be booking, age, picture only

			global $PSALT;

			$id = null;
			$userinfo = null;

			if($this->Session->check('User'))
			{
				//we already are logged in, so you can't be here
				$userinfo['User'] = $this->Session->read('User');

				if( $userinfo['User']['role'] == "admin" )
			   	{
					//$this->Session->write('Admin', $userinfo['User']);
				    $this->redirect(array('controller' => 'users', 'action' => 'admin_home'));
					exit;
				}
			    else if ($userinfo['User']['role'] == 'teacher' )
			    {
					 //Coder
				    //$this->Session->write('teacher', $userinfo['User']);
				    $id = $userinfo['User']['id'];


				 }
				 else
				 {
				 	//we are a student

				 }     
			}

			else if(empty($id))
			{
				//we aren't logged in and don't know what teacher to show
				$this->redirect(array('controller' => 'homes', 'action' => 'login'));
				exit;
			}

			App::import('Model','User');
			$this->User = & new User();

			$profile = $this->User->Profile->findByUserId($userinfo['User']['id']);
			$userinfo['Profile'] = $profile['Profile'];

			$this->layout="teacher_edit";

			$this->set("title_for_layout", 'Edit Availability - LessonShark');

			$this->set('tab', 'Availability');
			$this->set('id', $id);

			$this->set('userinfo', $userinfo);

			$save = false;
			$error = false;

			/*error array
			$errors['age_limit'] = false;
			$errors['image_empty'] = false;
			$errors['image_upload'] = false; */

			//verify what to show for saving/errors
			if($this->Session->check('TeachersEditGeneral.save') && $this->Session->read('TeachersEditGeneral.save'))
			{
				$save = true;

				$this->Session->delete('TeachersEditGeneral.save');
			}




			if(empty($this->data))
			{
				$this->data['Profile'] = $userinfo['Profile'];
			}		
			else 
		    {
		    	switch ($area)
		    	{
				    case "booking":
				    	//echo '<pre>';print_r($this->data);echo '</pre>';

				    	if(empty($this->data['Profile']['booking_status']))
				    		$this->data['Profile']['booking_status'] = $userinfo['Profile']['booking_status'];

				    	if(!empty($this->data['Profile']['booking_status'])) 
						{
							if($this->data['Profile']['booking_status'] == 'open')
								$this->data['Profile']['booking_status'] = 'closed';
							else
								$this->data['Profile']['booking_status'] = 'open';

							//echo $this->data['Profile']['booking_status'];

							//save						
							$fields = array
							(
								'booking_status'
		    				);					

							$this->User->Profile->id = $userinfo['Profile']['id'];
							if($this->User->Profile->save($this->data, false))
							{
								//booking is saved
								$this->Session->write('TeachersEditGeneral.save', true, $fields);

								$this->redirect(array('controller' => 'teachers', 'action' => 'editGeneral'));
							}

						}

				        break;
				    //////////////////////////////////////////////
				    case "age":

				    	//if(!empty($this->data['Profile']['age_limit'])) 
						//{
							if(empty($this->data['Profile']['age_limit']) || is_numeric($this->data['Profile']['age_limit']))
							{	
								//save						
								$fields = array
								(
									'age_limit'
			    				);					

								$this->User->Profile->id = $userinfo['Profile']['id'];
								if($this->User->Profile->save($this->data, false))
								{
									//booking is saved
									$this->Session->write('TeachersEditGeneral.save', true, $fields);

									$this->redirect(array('controller' => 'teachers', 'action' => 'editGeneral'));
								}
							}
							else 
							{
								//we have an error since its not numeric
								$error = true;
								$errors['age_limit'] = true;

								$userinfo['Profile']['age_limit'] = $this->data['Profile']['age_limit'];
							}

						//}




				        break;
				    //////////////////////////////////////////////
				    case "picture":

				    	$picture_file = null;
				    	$extension = null;

				    	if(empty($this->data['Profile']['image']['name']))
						{
							$error = true;
							$errors['image_empty'] = true;
						}
						else
						{
							//upload a photo if one exists

							if($this->Upload->validateUploadImage($this->data['Profile']['image']) == 0)
							{
				 				$date = date('m-d-Y h:i:s a');
				 				$key = md5($userinfo['Profile']['id'].$date.$PSALT);

								$picture[0] = array( 100, 100, "s" );
								$picture[1] = array( 360, 360, "m" );
								$picture[2] = array( 640, 640, "l" );

								//make sure thumbnail is square
								$picture[3] = array( 248, 248, "t" );

								$imageinfo = getimagesize( $this->data['Profile']['image']['tmp_name'] );

								$picture_file = '';
								$extension = $this->Upload->getExtension($imageinfo[2]);

								foreach($picture as $pic)
								{
									if($pic[2] != 't')
									{
										//this image is regular and NOT a thumbnail

										// figure out the new image size
										$width = $imageinfo[0];
										$height = $imageinfo[1];

										$maxWidth = $pic[0];
										$maxHeight = $pic[1];

										$x = 0;
										$y = 0;

										if($pic[2] != 'm')
										{
											//all the medium picture to be its regular size if it is small
											if( ($width < $maxWidth) && ($height < $maxHeight) )
											{
												//picture is too small, make it bigger
												$newWidth = $width;
												$newHeight = $height;

												while( ($newWidth < $maxWidth) && ($newHeight < $maxHeight) )
												{
													$newWidth += $width;
													$newHeight += $height;
												}

												$width = $newWidth;
												$height = $newHeight;
											}
										}

										if( ($width >= $height) && ($width > $maxWidth) )
										{
											$height = $height * $maxWidth / $width;
											$width = $maxWidth;
										}
										else if( ($height > $width) && ($height > $maxHeight) )
										{
											$width = $width * $maxHeight / $height;
											$height = $maxHeight;
										}

										$srcFile = $this->data['Profile']['image']['tmp_name'];
										$picture_file = $key;
										$dstFile = $picture_file . $pic[2] . "." . $extension;
										$noExtension = $picture_file . $pic[2] . ".";

										//make the profile folder if it doesn't exist
										If(!file_exists($PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id']))
											mkdir($PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id']);

										if( $this->Upload->copyImageFile($srcFile,$imageinfo[2],$PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id'].DS.$dstFile,$x,$y,$imageinfo[0],$imageinfo[1],0,0,intval($width),intval($height)) )
										{
											$error = true;
											$errors['image_upload'] = true;
										}
										else
										{
											//delete the other 2 types of pictures that could have been created already
											$this->Upload->deleteImages($imageinfo[2], $PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id'].DS.$noExtension);
										}
									}
									else
									{
										//generate a square thumbnail

										// figure out the new image size
										$width = $imageinfo[0];
										$height = $imageinfo[1];

										$thumb_size = $pic[0];
										$x = 0;
										$y = 0;

										if($width >= $height)
										{
											$x = ceil(($width - $height) / 2 );
											$width = $height;
										}
										elseif($height > $width)
										{
											$y = ceil(($height - $width) / 2);
											$height = $width;
										}

										$srcFile = $this->data['Profile']['image']['tmp_name'];
										$picture_file = $key;
										$dstFile = $picture_file . $pic[2] . "." . $extension;
										$noExtension = $picture_file . $pic[2] . ".";

										//make the profile folder if it doesn't exist
										if(!file_exists($PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id']))
											mkdir($PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id']);

										if( $this->Upload->copyImageFile($srcFile,$imageinfo[2],$PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id'].DS.$dstFile,$x,$y,$width,$height,0,0,$thumb_size,$thumb_size) )
										{
											$error = true;
											$errors['image_upload'] = true;
										}
										else
										{
											//delete the other 2 types of pictures that could have been created already
											$this->Upload->deleteImages($imageinfo[2], $PROFILE_PICTURES_PATH.$userinfo['Profile']['user_id'].DS.$noExtension);
										}
									}
								}
							}
							else
				    		{
								$error = true;
								$errors['image_upload'] = true;
							}

				    		if(!empty($this->data) && ($error == false))
							{
								$this->data['Profile']['image'] = $picture_file;
								$this->data['Profile']['image_extension'] = $extension;

								$fields = array
								(
									'image',
									'image_extension'
		    					);				

								$this->User->Profile->id = $userinfo['Profile']['id'];
								if($this->User->Profile->save($this->data, false))
								{
									$this->Session->write('TeachersEditGeneral.save', true, $fields);

									$this->redirect(array('controller' => 'teachers', 'action' => 'editGeneral'));
								}
							}
						}


				        break;
		    	}
		    }

		    $this->set('save', $save);
			$this->set('error', $error);
			$this->set('errors', $errors);


			/*$teacher= $_SESSION['teacher']; 
			$id=$teacher['id'];		
			$errorMessage                 ="";	
			$this->set('message', $errorMessage); 
			$flag                         ="";	
			$this->set('flag', $flag); 
			$message                      ='';
			$this->Session->write('tabname','general');*/      

		}

	
	

//code for prfile frontend




function leftSide() // this function is used for fetching left side of the teacher profile through request action
{

}
	
function contentOpening($id=null)
{
		
		$this->Session->write('tabname1','opening');
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_profile";
		App::import('Model','Event');
		$this->Event = & new Event();	
		App::import('Model','TeacherLocation');
		$this->TeacherLocation =& new TeacherLocation();
		$teacherlocation       = $this->TeacherLocation->find('all',array('conditions'=>array('tid'=>$id)));
		$arr_loc=array();		
		 foreach($teacherlocation as $location)
				{ 
				  $arr_loc[$location['TeacherLocation']['city']]= $location['TeacherLocation']['city']; 
	    	  		}				
		$this->set('id', $id);
		$this->set('teacherlocation', $arr_loc);
		$event       = $this->Event->find('all',array('conditions'=>array('tid'=>$id))); 
		

 
		if($this->data)
		{	
			if($this->data['TeacherLocation']['m'])
			{
			  $mon=$this->data['TeacherLocation']['m'];
			}
			if($this->data['TeacherLocation']['t'])
			{
				$mon=$this->data['TeacherLocation']['t'];
			}
			if($this->data['TeacherLocation']['th'])
			{
				$mon=$this->data['TeacherLocation']['th'];
			}
			if($this->data['TeacherLocation']['s'])
			{
				$mon=$this->data['TeacherLocation']['s'];
			}
		
		
			$day		= date("Y-m-d");
			$daya		=$mon;
			$tday		=date('Y-m-d',strtotime($daya,strtotime($day)));
			$mysqlstart	='2012-02-07 00:00:00';
			$mysqlend  	='2012-02-07 12:00:00'; 
			$conditions 	= array('Event.tid'=>$id,'Event.start BETWEEN ? AND ?'=> array($mysqlstart,$mysqlend));
			$fetchdata	=$this->Event->find('all',array('conditions'=>$conditions)); 
		
			foreach($fetchdata as $data1)
			{
				$start  =$data1['Event']['start'];	$end=$data1['Event']['end'];
			}
			$start 		= explode(" ", $start);
			$end 		= explode(" ", $end);
			$start 		= explode(":", $start[1]);
			$end 		= explode(":", $end[1]);
			
			$this->set('start',$start[0]);
			$this->set('end', $end[0]);		
			$loc1=$this->data['TeacherLocation']['dsid'];
			if($this->data['TeacherLocation']['m'])
			{
			  $con=array('Event.tid'=>$id,'Event.title'=>$loc1);
			}
			else
			{
			   $con=array('Event.tid'=>$id,);	
			}
			$this->Event->bindModel(                          
		      array('hasOne'          => array(
		            'TeacherLocation' => array(
		            'conditions'      => array('Event.title=TeacherLocation.City','Event.tid='.$id),
		            'order'           => '',
		            'fields'          => '',
		            'foreignKey'      => false,
		            'dependent'       => true
		           )
		
		)), false);        
			$all=$this->Event->find('all',array('conditions'=>$con)); 
		} 
		else
		{
		      $this->Event->bindModel(                          
		      array('hasOne'        => array(
		            'TeacherLocation' => array(
		            'conditions'      => array('Event.title=TeacherLocation.City','Event.tid='.$id),
		            'order'           => '',
		            'fields'          => '',
		            'foreignKey'      => false,
		            'dependent'       => true
		           )
		
		)), false);        
			$all=$this->Event->find('all',array('conditions'=>array('Event.tid'=>$id))); 

		}
		
		
		
		
		//$this->set('all',$all);
		//pr($all);
		$arr_zip=array();		
		foreach($all as $all1 ){ $id=$all1['TeacherLocation']['id'];$arr_zip[$id]=$all1['TeacherLocation']['zip'];}
		//pr($arr_zip);
		$this->set('all',$arr_zip);
}

function contentPolicy($id=null)
{

		$this->Session->write('tabname1','policy');
		//$teacher= $_SESSION['teacher']; 
		//$id=$teacher['id'];	
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_profile";
		App::import('Model','TeacherPolicy');
		$this->TeacherPolicy = & new TeacherPolicy();	
		$teacherpolicy       = $this->TeacherPolicy->find('all',array('conditions'=>array('tid'=>$id))); 
		
		$this->set('teacherpolicy',$teacherpolicy);
}

}
?>