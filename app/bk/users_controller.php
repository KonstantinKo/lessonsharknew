<?php
class UsersController extends AppController {


	var $name = 'User';
 
 /*
 *  Helper used by the Controller
 **/    
    var $helpers = array('Html','Ajax','Javascript','Form', 'Session');
 /*
 *  Component used by the Controller
 **/
    var $components = array('RequestHandler'); 

//Pagination configuration
var $paginate = array(
        'limit' => 10,
        'order' => array(
            'User.lastname' => 'asc'
        )
    );
	
#_________________________________________________
  /**
   *   This function is used for Admin Login
   *   Return    
   *   @param 
   *   @return true or false
  */
  function admin_login() {
      $this->pageTitle  = __('Admin Login', true);
      $this->layout     = "admin_login";
		
    //If data is submitted
    if (!empty($this->data)){
	

			$userinfo          = $this->User->findByUsername($this->data['User']['username']);

      // Now compare the form-submitted password with the one in the database.
      if(!empty($userinfo['User']['password']) && ($userinfo['User']['password'] == trim(md5($this->data['User']['password']))) && $userinfo['User']['status'] == '1' )
      {

      	// This means they were the same. We can now build some basic session information to remember this user as 'logged-in'.
        //Check if user is Admin or Coder
        if( $userinfo['User']['role'] == "admin" ){
            $this->Session->write('Admin', $userinfo['User']);
            $this->redirect('/admin/users/home');
        }else{
         //Coder
            $this->Session->write('Coder', $userinfo['User']);
            $this->redirect('/admin/coders');
        }      

      }else{
      	//Username/password invalid
      	$this->Session->setFlash(__('Username/Password is wrong.', true));
      	$this->render();
      }
     }//End: Submission   
  	}
#_________________________________________________
  /**
   *   This function is used for Admin Logout
   *   Return    
   *   @param 
   *   @return true or false
  */
  function admin_logout() {        
    session_unset();
    $this->Session->destroy();

    $this->Session->setFlash(__('Log out successful.', true));
    $this->redirect('/admin/users/login'); 
  }
#_________________________________________________

  /**                                              
   *   This function is used to show different available options to Admin
   *   Return    
   *   @param 
   *   @return true or false
  */
  function admin_home(){
	    //Check for authentication
     
  
      $this->pageTitle  = __('Admin Dashboard', true);
      $this->layout     = "admin";
  }
#_________________________________________________

  /**                                              
   *   This function is used to by Admin to view/add/edit/delete
   *   Return    
   *   @param 
   *   @return true or false
  */
	function admin_index() {
	    //Check for authentication
    //  $this->checkSessionAdmin('Admin');

      //Search Session managment - delete it if any is registered
      $this->Session->check('condition') ? $this->Session->delete('condition'):'' ;
      
      $this->pageTitle  = __('Admin: Users Management', true);
      $this->layout     = "admin";
	}                           
#_________________________________________________
  /**                                              
   *   This function is used to by Admin to add a user through AJAX
   *   Return    
   *   @param 
   *   @return true or false
  */

  function admin_add() {

     //If AJAX call has been made 
     if ( $this->RequestHandler->isAjax() ) {
         if ( !empty( $this->data ) ) {
	
         $this->data['User']['password'] = md5($this->data['User']['password']);  
	 $this->User->set($this->data);
	  if ($this->User->validates(array('fieldList' => array('username','password','firstname','lastname'))) ) 
           { 	
		$this->User->save($this->data,false);
           
                 $this->set('message', 'User has been saved');
                 $this->render('admin_add', 'ajax');
            }
	   else
                {
		   $errorMessage="";		
                   $errors = $this->User->invalidFields(array('fieldList' => array('username','password','firstname','lastname',)));
                  foreach ($errors as $val) {
                      $errorMessage .= '<li>'.$val.'</li>';
               	 }
                $this->set('message', $errorMessage);
                $this->render('admin_add', 'ajax');
                    
                }//END: Else IF			

		

          
         }//End: DATA check
     }//End: AJAX If
  }
#_________________________________________________
  /**                                              
   *   This function is used to by Admin to edit a user through AJAX & ModalBox
   *   Return    
   *   @param 
   *   @return true or false
  */

  function admin_edit( $id = null ) {
  $this->set('closeModalbox', false);
		
    if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
    
    //If form has been submitted
		if (!empty($this->data)) {
		$this->data['User']['password'] = md5($this->data['User']['password']);
		  //If validated true then save user
		 $this->User->set($this->data);
		 if ($this->User->validates(array('fieldList' => array('username','password','firstname','lastname'))) ) 
        	   { 
			
				$this->User->save($this->data,false);
				$this->Session->setFlash(__('The User has been saved', true));
				if (! $this->RequestHandler->isAjax()) {
					// redirect back to index page
					$this->redirect(array('action' => 'index'));
				}
				// else
				$this->set('closeModalbox', true);
			}
			 
			else {
				$this->Session->setFlash(__('The Used could not be saved. Please, try again.', true));
			} //End: Check Validation & saving
		}

		//When page first loads, it load user data
    if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
  }
#_________________________________________________ 
  /**                                              
   *   This function is used to by Admin to search users through AJAX
   *   Return    
   *   @param 
   *   @return true or false
  */
  function admin_search() {
    //AJAX request
    //if ( $this->RequestHandler->isAjax() ) {
     $condition = array();
        //If Data submitted through search form
        if( !empty($this->data) ) {
            //Search by ... :) (anyfield)
            foreach ( $this->data['User'] AS $key=>$value  ){
                  if ( !empty($value) ){
                       $condition[] .= $key. ' LIKE "%'.$value.'%" ';
                  }
            } 
            $this->Session->write('condition', $condition);
        }//End: Check Submission
        
            $this->Session->check('condition') ? $condition = $this->Session->read('condition'):'' ;
            
        //fetches paged results
        $data = $this->paginate('User', $condition);
        $this->set('data', $data);
        $this->render('admin_search', 'ajax');
    //}
  }
#_________________________________________________
  /**                                              
   *   This function is used to by Admin to delete users through AJAX
   *   Return    
   *   @param 
   *   @return true or false
  */  
  function admin_delete( $id = null) {
      $this->layout = 'ajax';
      $this->User->delete($id);
      $this->render();	
  }
#_________________________________________________
 
  /**                                              
   *   This function is used to by Admin to change Supervised status through AJAX
   *   Return    
   *   @param $id (of user id)
   *   @return true or false
  */ 
  function admin_changesuperstatus( $id= null) {
      $this->layout   = 'ajax';
      $user           = $this->User->read('User.supervised',$id);

    		if($user['User']['supervised']=='1'){
    			$status = 0;
    		} else {
    			$status = 1;
    		}
		$data         = array('User' => array('id' => $id, 'supervised'=>$status));		
		$this->User->save($data);
		
    		$this->set('id',$id);
		$this->set('status',$status);
  }

//END: ADMIN SECTION ********************************************************************** 

//function is used to register a new user
 function signUp()
   {	
	  App::import('Model','User');
          $this->User = & new User();
     	  $this->layout     = "front_default";
	  if(!empty($this->data))
	  {			
		 $this->User->set($this->data);
				
                if ( $this->User->validates(array('fieldList' => array('username','password','firstname','lastname','email','country','state','city','phone'))) ) 
                { 
                 	$this->data['User']['username']     =    $this->data['User']['username'];
			$this->data['User']['password']     =    md5($this->data['User']['password']);	
			$this->data['User']['firstname']    =    $this->data['User']['firstname'];	
			$this->data['User']['lastname']     =    $this->data['User']['lastname'];	
			$this->data['User']['email']        =    $this->data['User']['email'];	
			$this->data['User']['country']      =    $this->data['User']['country'];
			$this->data['User']['state']        =    $this->data['User']['state'];	
			$this->data['User']['city']         =    $this->data['User']['city'];	
			$this->data['User']['address']      =    $this->data['User']['address'];	
			$this->data['User']['phone']        =    $this->data['User']['phone'];	
				
			$this->User->save($this->data ,false);
			$UserId = $this->User->getInsertID();
			
			$this->Session->write('loggedUserId',$UserId);
			
			$this->Session->setFlash('Registration completed.');
			$this->render();

                }	
                else
                {
			
                    $errors = $this->User->invalidFields(array('fieldList' => array('username','password','firstname','lastname','email','country','state','city', 'phone')));
                    $this->User->set('errors',$errors);
                    
                }//END: Else IF			
   	}

}

//function dashboard is used to show the user dashboard
function dashboard()
{
		 $this->checkSessionUser('userInfo'); 	
		$this->layout     = "front_default";
	//	$this->set('userInfo1',$this->Session->read($userInfo));
}
function addTrade()
{
 //$this->Session->destroy('userInfo');
		$this->checkSessionUser('userInfo'); 
		
		$this->layout     = "front_default";
		App::import('Model','Trade');
        $this->Trade = & new Trade();
		    
		//pr($this->Session->read('userInfo'));die('here');
		if(!empty($this->data))
		{
		
				$this->Trade->set($this->data);
				
                if ( $this->Trade->validates(array('fieldList' => array('symbol','share_size','entry_price'))) ) 
                { 
		
                 	$this->data['Trade']['symbol']        =    $this->data['Trade']['symbol'];
					$this->data['Trade']['share_size']    =    $this->data['Trade']['share_size'];	
					$this->data['Trade']['entry_price']   =    $this->data['Trade']['entry_price'];	
					$this->data['Trade']['notes']         =    $this->data['Trade']['notes'];	
					$this->data['Trade']['share_type']    =    $this->data['Trade']['share_type'];
					$this->data['Trade']['user_id']       =    $_SESSION['userInfo']['User']['id'];	
					
						
					$this->Trade->save($this->data ,false);
					
					$this->Session->setFlash('Trade Added Successfully.');
					$this->render();
		
					}	
					else
					{
				
						$errors = $this->Trade->invalidFields(array('fieldList' => array('symbol','share_size','entry_price')));
						$this->Trade->set('errors',$errors);
						
					}//END: Else IF			
			
			
		}
	//	$this->set('userInfo1',$this->Session->read($userInfo));
}
 function logOut() {        
    session_unset();
    $this->Session->destroy();

  //  $this->Session->setFlash(__('Log out successful.', true));
    $this->redirect('/'); 
  }
//


}
?>
