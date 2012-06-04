<?php
class HomesController extends AppController {


	var $name = 'Homes';
 /*
 *  Helper used by the Controller
 **/    
   var $helpers = array('Html','Ajax','Javascript','Form','Session','Xml','GoogleChart');
 /*
 *  Component used by the Controller
 **/
    var $components = array('RequestHandler','Cookie','Session','Email'); 

    var $paginate = array('limit' => 10);
    
    var $uses = null;

############################################# START: FrontEnd ###################################



   function index()
   {       //die('Website is under progress ');                                                                            
		$this->layout     = "front_default_homepage";
		
		$this->set("title_for_layout",'LessonShark - A marketplace for music teachers and students');
   }
   
    function become_a_student()
   {
		$this->layout     = "front_default";
		
		$this->set("title_for_layout",'Become A Student - LessonShark');
   
   }
   
   function aboutus()
	{
		$this->layout        = "front_default";
		
		$this->set("title_for_layout",'About Us - LessonShark');

	}
   function faq()
	{
		$this->layout       ="front_default";
		
		$this->set("title_for_layout",'Need help? Student FAQ - LessonShark');
	}
  function feature()
	{
		$this->layout 	    ="front_default";
		
		$this->set("title_for_layout",'Let students find you - LessonShark');
	}	
  function featureTrack()
	{
		$this->layout 	    ="front_default";
		
		$this->set("title_for_layout",'Track. Bill. Communicate. - LessonShark');
	
	}
	function tour()
	{
		$this->layout	    ="front_default";
		
		$this->set("title_for_layout",'Take a tour - LessonShark');
	}

	
	

	
   function numbers()
    {
		$this->layout="front_default";
		
		$this->set("title_for_layout",'Our platform by the numbers - LessonShark');
    }	
    
	 function faqSecond()
    {
		$this->layout="front_default";
		
		$this->set("title_for_layout",'Need help? Teacher FAQ - LessonShark');
    }

    function login_fancy()
	{
		$this->layout="";
		
	
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
	}
	
	function forgot()
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
		
		$this->set("title_for_layout",'Forgot your password? - LessonShark');
		   
		$errors = null;
		$key = null;
		$show = 'start';
	
		 if (!empty($this->data))
		 {	
			App::import('Model','User');
			$this->User = & new User();
		
			//used to start validation rule setup
			$this->User->set( $this->data );
		
			if( !empty($this->data['User']['email']) ) 
	    	{
		 		$userinfo = $this->User->findByEmail($this->data['User']['email']);
		 		
		 		//$inputPwd = md5($this->data['User']['email'].$this->data['User']['password'].$PSALT);
			
		      	// Now compare the form-submitted password with the one in the database.
		     	if(!empty($userinfo))
			 	{
			 		//we have a matching email	
			 		
			 		//generate the key
			 		$date = date('m-d-Y h:i:s a');
			 		$key = md5($userinfo['User']['email'].$date.$PSALT);
			 		
			 		$this->User->id = $userinfo['User']['id'];
					$this->User->saveField('forgotkey', $key, true);
					
					$show = 'finish';
		      	}
		   		 else
		      	{
                 	//$this->redirect('/');
			      	//Username/password invalid
			      	//$this->Session->setFlash(__('Username/Password is wrong.', true));
			      	//$this->render();
			      	
		      		$errors = 'Email address is invalid.';
		      	}
	    	}
		  	else
		    {
                //$this->redirect('/');
			    //Username/password invalid
			    //$this->Session->setFlash(__('Username/Password is wrong.', true));
			    //$this->render();
			    
		    	$errors = 'Email address is invalid.';
		  	}
	    }//End: Submission   
	    
	    $this->set('errors', $errors);
	    $this->set('show', $show);
	    //only show this now for testing
	    $this->set('key', $key);
	}
	
	function reset($key)
	{
		global $PSALT;
		
		if(empty($key))
		{
			$this->redirect(array('controller' => 'homes', 'action' => 'index'));
			exit;
		}
		
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
		
		$this->set("title_for_layout",'Reset your password - LessonShark');
					
		App::import('Model','User');
		$this->User = & new User();
		
		$userinfo = $this->User->findByForgotkey($key);
		
		if(empty($userinfo))
		{
			$this->redirect(array('controller' => 'homes', 'action' => 'index'));
			exit;
		}
		
		$show = 'start';
		
		//used to start validation rule setup
		$this->User->set( $this->data );
		
		if( !empty( $this->data ) ) 
	    {
		
			 if ($this->User->validates(array('fieldList' => array('password','cpassword'))) ) 
			 { 	
			 	
				//updates
				$this->data['User']['password'] = md5($userinfo['User']['email'].$this->data['User']['password'].$PSALT);
				$this->data['User']['cpassword'] = $this->data['User']['password'];
				$this->data['User']['forgotkey'] = null;
				
				//$this->User->save($this->data ,false);
				
				$this->User->id = $userinfo['User']['id'];
				if($this->User->save($this->data,false))
				{
					//password has been reset
					$show = 'finish';
				}
				
			 }
			 else
		    {	
		       $errors = $this->User->invalidFields(array('fieldList' => array('password','cpassword')));
			   $this->User->set('errors',$errors);
		    }
	    }
	    
	    
	   	$this->set('show', $show);
	   	$this->set('key', $key);
	}
	
	function login()
	{
		global $PSALT;
		
		$this->layout="front_default";
		
		$this->set("title_for_layout",'Login - LessonShark');
		
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
		
		$errors = null;
		
		App::import('Model','User');
		$this->User = & new User();
		
		//used to start validation rule setup
		$this->User->set( $this->data );
		
		 if (!empty($this->data))
		 {		
			if( !empty($this->data['User']['email']) && !empty($this->data['User']['password'] ) ) 
	    	{
		 		$userinfo = $this->User->findByEmail($this->data['User']['email']);
		 		
		 		$inputPwd = md5($this->data['User']['email'].$this->data['User']['password'].$PSALT);
			
		      	// Now compare the form-submitted password with the one in the database.
		     	if($userinfo['User']['password'] == $inputPwd)
			 	{
			 		//we are authenticated	
			 		
			 		//delete the old sessions and start by writing a new one
			 		$this->Session->destroy();
			 		
			 		$this->Session->write('User', $userinfo['User']);
			 		
				   	// This means they were the same. We can now build some basic session information to remember this user as 'logged-in'.
					//Check if user is Admin or Coder
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
					   
				    	//rerouting for testing only
				    	//$this->redirect(array('controller' => 'homes', 'action' => 'index'));
						exit;
					 }
					 else
					 {
					 	//we are a student
					 	
					 }     

		      	}
		   		 else
		      	{
                 	//$this->redirect('/');
			      	//Username/password invalid
			      	//$this->Session->setFlash(__('Username/Password is wrong.', true));
			      	//$this->render();
			      	
		      		$errors = 'Email address/password combination is wrong.';
		      	}
	    	}
		  	else
		    {
                //$this->redirect('/');
			    //Username/password invalid
			    //$this->Session->setFlash(__('Username/Password is wrong.', true));
			    //$this->render();
			    
		    	$errors = 'Email address/password combination is wrong.';
		  	}
	    }//End: Submission   
	    
	    $this->set('errors', $errors);
	}
	
    function logout()
    {        
    	session_unset();
    	$this->Session->destroy();
    	//$this->Session->setFlash(__('Log out successful.', true));
    	$this->redirect(array('controller' => 'homes', 'action' => 'index'));
   	}
   	
	
//_____________________________________________________________________
############################################# END: FrontEnd ################################### 
 
}
?>
