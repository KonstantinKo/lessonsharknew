<?php
class TeachersController extends AppController 
{


	var $name = 'Teachers';
   /* *  Helper used by the Controller **/    
   var $helpers = array('Html','Ajax','Javascript','Form','Session','Xml','GoogleChart');
   /* *  Component used by the Controller **/
    var $components = array('RequestHandler','Cookie','Session','Email'); 

    var $paginate = array('limit' => 10);

############################################# START: FrontEnd ###################################

   function index()
   {                                                                
	$this->layout                                    = "front_default";   
	App::import('Model','User');
	$this->User          			         = & new User();
	if ( !empty( $this->data ) ) 
          {
	
		 $this->data['User']['password'] = $this->data['User']['password'];  
		 $this->User->set($this->data);
		  if ($this->User->validates(array('fieldList' => array('password','cpassword','firstname','email','zip'))) ) 
		   { 	
			
			//$this->data['User']['username'] = $this->data['User']['username'];

			$this->data['User']['password']   = md5($this->data['User']['password']);	

			$this->data['User']['firstname']  = $this->data['User']['firstname'];	

			$this->data['User']['lastname']   = $this->data['User']['lastname'];	

			$this->data['User']['email']      = $this->data['User']['email'];	

			$this->data['User']['zip']        = $this->data['User']['zip'];	
		        $this->data['User']['type']       ='0';	
		        
			
			$this->User->save($this->data ,false);
			$this->set('message', 'Student has been saved');
			
		    }
		 else
		    {
			
			   $errorMessage                  ="";		
		           $errors                        = $this->User->invalidFields(array('fieldList' => array('password','cpassword','firstname','lastname','zip','email',)));
			   $this->User->set('errors',$errors);
		       
		            
		    }//END: Else IF			

		

          
          }//End: DATA check
	
	
	
   }


   function profile($id = NULL) //this function is for creating teacher profile first step learn tab   
    {	
	$teacher= $_SESSION['teacher']; 
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
	// $this->TeacherDesciplineFields->set($this->data);
	$discipline = $this->TeacherDesciplineField->find('all',array('conditions'=>array('tid'=>$id))); 
	App::import('Model','TeacherDesciplines');
	$this->TeacherDesciplines = & new TeacherDesciplines();
	
		$arr_des=array(); 
	foreach($discipline as $des)
	   {
		 if(array_key_exists( $des['TeacherDesciplineField']['dsid'],$arr_des))
		  {
			
		  }
		else
		  {
		  $categories = $this->TeacherDesciplines->find('all',array('conditions'=>array('dsid'=>$des['TeacherDesciplineField']['dsid'])));	
		  foreach ($categories as $cat)
			{
				 $arr_des[$des['TeacherDesciplineField']['dsid']]=$cat['TeacherDesciplines']['dname'];
			}
		
		  
		  }	
	   } 
		if($arr_des){$this->set('des',$arr_des);}
	if ( !empty( $this->data ) )
	{    
		
		/*if ($this->TeacherDesciplineField->validates(array('fieldList' => array('dsid'))) ) 
           		{*/
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
			$flag='1';
 			$this->set('flag',$flag);
		//$this->redirect('/admin/users/addProfile/'.$id);
	/* }
	  else
	       {


		   $errorMessage="";		
		   $errors = $this->TeacherDesciplineField->invalidFields(array('fieldList' => array('dsid',)));
		   foreach ($errors as $val) 
			 {
		              $errorMessage .= '<li>'.$val.'</li>';
      			 }
	       	 
           	}
		$this->set('message', $errorMessage); 
	*/	
		
	       			
	}
	$this->Session->write('tabname','learn');
	App::import('Model','TeacherDesciplines');
	$this->TeacherDesciplines = & new TeacherDesciplines();
	//$users=$this->TeacherDesciplines->find('all');
	$this->set('flag',$flag);
	$categories = $this->TeacherDesciplines->find('all');
	$discpline = Set::combine($categories, "{n}.TeacherDesciplines.dsid","{n}.TeacherDesciplines.dname");
	$this->set('discpline',$discpline);
	//pr($discpline);die;
	$this->Session->check('condition') ? $this->Session->delete('condition'):'' ;
	
    }   
    // end  of add  profile function 	
    function profileMedia($id)
	{	
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
		   	   {*/foreach ($this->data['TeacherMedia']['label'] as $key=>$value)
                           {
                                $details1['TeacherMedia']['url']   = $this->data['TeacherMedia']['url'][$key];
                                $details1['TeacherMedia']['label'] =$this->data['TeacherMedia']['label'][$key];
                                $details1['TeacherMedia']['tid']   =$id;
                                
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

        }
//end of add profile media function	

	function profileLocation($id)
	{	
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
		$teacherlocation       = $this->TeacherLocation->find('all',array('conditions'=>array('tid'=>$id)));  
		$this->set('teacherlocation',$teacherlocation);
		if ( !empty( $this->data ) )
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
					
	       }	

	}//end  of location add profile function



function editLocation($id=null,$locId=null)
	{	
                $teacher= $_SESSION['teacher']; 
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
		$this->set('teacherlocation',$teacherlocation);


	}//end  of location edit profile function


   function profileAvailability($id)                    //this function is for adding availability to teacher profile 
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
	

// edit media used for edit media enterd by particular teacher
    function editMedia($id=null)
	{		
        $teacher= $_SESSION['teacher']; 
	$id=$teacher['id'];
        
			$this->Session->write('tabname','media');
			$this->pageTitle    	= __('Admin: Users Management', true);
			$this->layout       	= "teacher_default";
			App::import('Model','TeacherMedia');
		 	$this->TeacherMedia 	=& new TeacherMedia();  
			$media 			= $this->TeacherMedia->find('all',array('conditions'=>array('tid'=>$id)));  
			$this->set('media',$media);
			$this->set('id',$id);
			
		 if($this->data)
		   { 
			
                       
			foreach($this->data['TeacherMedia']['label'] as $key=>$value)
			 {      
                            
				if($this->data['TeacherMedia']['hidd'][$key])
                                {
				$details['TeacherMedia']['label']     = $value;
				$details['TeacherMedia']['url']	      = $this->data['TeacherMedia']['url'][$key];
				$details['TeacherMedia']['id'] 	      = $this->data['TeacherMedia']['hidd'][$key];
				$details['TeacherMedia']['tid']       = $id;
				$this->TeacherMedia->saveAll($details,array('conditions'=>array('TeacherMedia.tid'=>$id, 'TeacherMedia.id'=>$this->data['TeacherMedia']['hidd'][$key])));
                                }
                               else
                                 {
                                    $details['TeacherMedia']['label']          = $value;
                                    $details['TeacherMedia']['url']	      = $this->data['TeacherMedia']['url'][$key];
                                    //$details['TeacherMedia']['id'] 	      = $this->data['TeacherMedia']['hidd'][$key];
                                    $details['TeacherMedia']['tid']       = $id;
                                   
                                    $this->TeacherMedia->saveAll($details);
                                    
                                 }
				 //$this->TeacherMedia->updateAll( array('conditions'=>array('TeacherMedia.tid'=>$id, 'TeacherMedia.tid'=>$id)));
			 }			
					
		   }	
			
	} 	
// end of edit media function

// strating of edit general tab

	function editGeneral()
	{

		$teacher= $_SESSION['teacher']; 
		$id=$teacher['id'];		
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_default";


		$this->set('id',$id);
		$this->Session->write('tabname','general');      
		
	}

 	
   	function editProfile($id=null,$idnew=Null)
	{	
		$teacher= $_SESSION['teacher']; 
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
			 $this->set('idnew', $idnew);

	}
	function delrecord()
		{
			App::import('Model','TeacherDesciplineField');
			$this->TeacherDesciplineField                                 = & new TeacherDesciplineField();	   
			$ser=$this->params['pass'][1];
			$id=$this->params['pass'][0];
			$conditions=array('TeacherDesciplineField.id' => $ser);
			$this -> TeacherDesciplineField -> delete($conditions);
				
			$this->redirect('/teachers/editProfile/'.$id);
						
		
		}
        function delmedia()
		{
			App::import('Model','TeacherMedia');
			$this->TeacherMedia =& new TeacherMedia();  
			 
			$ser=$this->params['pass'][1];
			$id=$this->params['pass'][0];
			$conditions=array('TeacherMedia.id' => $ser);
			$this -> TeacherMedia -> delete($conditions);
				
			$this->redirect('/teachers/editMedia/'.$id);
						
		
		}
	 function dellocation()
		{
			App::import('Model','TeacherLocation');
			$this->TeacherLocation =& new TeacherLocation();
			 
			$ser=$this->params['pass'][1];
			$id=$this->params['pass'][0];
			
			$conditions=array('TeacherLocation.id' => $ser);
			$this -> TeacherLocation -> delete($conditions);
				
			$this->redirect('/teachers/editLocation/'.$id);
						
		
		}
	 function editloc()
		{
			App::import('Model','TeacherLocation');
			$this->TeacherLocation =& new TeacherLocation();
			 
			
						
		
		}
	function calendar()
	{
	}
	function feed() 
	{
		
		//1. Transform request parameters to MySQL datetime format.
		$mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
		$mysqlend = date('Y-m-d H:i:s', $this->params['url']['end']);

		//2. Get the events corresponding to the time range
		$conditions = array('Event.start BETWEEN ? AND ?'
		=> array($mysqlstart,$mysqlend));
		$events = $this->Event->find('all',array('conditions' =>$conditions));
		//3. Create the json array
		$rows = array();
		for ($a=0; count($events)> $a; $a++) {

		//Is it an all day event?
		$all = ($events[$a]['Event']['allday'] == 1);

		//Create an event entry
		$rows[] = array('id' => $events[$a]['Event']['id'],
		'title' => $events[$a]['Event']['title'],
		'start' => date('Y-m-d H:i', strtotime($events[$a]['Event']['start'])),
		'end' => date('Y-m-d H:i',strtotime($events[$a]['Event']['end'])),
		'allDay' => $all,
		);
		
	
	}

	function createjson($events)
	{
		
	}

		//4. Return as a json array
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->autoLayout = false;
		$this->header('Content-Type: application/json');
		echo json_encode($rows);		
	
	}
	
	function editCredential($id=null)
	{		
		$teacher= $_SESSION['teacher']; 
		$id=$teacher['id'];
		$this->Session->write('tabname','credential');
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_default";
		
		App::import('Model','TeacherExperience');
		$this->TeacherExperience =& new TeacherExperience();
		
		
		if ( !empty( $this->data ) )
		{    	
			if($this->data['TeacherExperience']['hidd']=='temp' ){
				$details['TeacherExperience']['education'] 	= $this->data['TeacherExperience']['education'] ;
				$details['TeacherExperience']['teaching'] 	= $this->data['TeacherExperience']['teaching'];
				$details['TeacherExperience']['tid']=$id;
				$details['TeacherExperience']['performance'] 	= $this->data['TeacherExperience']['performance'] ;
					
				$this->TeacherExperience->save($details,false);			
			    }
			else
			 {
				
				$details['TeacherExperience']['education'] 	= $this->data['TeacherExperience']['education'] ;
				$details['TeacherExperience']['teaching'] 	= $this->data['TeacherExperience']['teaching'];
				$details['TeacherExperience']['tid']		=$id;
				$details['TeacherExperience']['id']		=$this->data['TeacherExperience']['hidd'];
				$details['TeacherExperience']['performance'] 	= $this->data['TeacherExperience']['performance'] ;
					
				$this->TeacherExperience->save($details['TeacherExperience'],false);	
			 }	
		  
		}
		$teacherexperience       = $this->TeacherExperience->find('all',array('conditions'=>array('tid'=>$id)));  
			$this->set('teacherexperience',$teacherexperience);	
			
//
		
	}
	function credentialForm($id)
	{
	
		
	$client = new SoapClient("http://xml.studentclearinghouse.org/ws/wsdl/DegreeVerify.wsdl", array("trace" => 1, "exception" => 0));

	/*
	echo '<pre>';
	var_dump($client->__getFunctions());
	echo '</pre>';
	*/ 
	$options = array(
	'TestFlag' => 'Y',
	'SignonRq' => array(
	'CustId'=>array(
	'CustPermId' => 'D00155',
	'CustLoginId' => 'lessonsha',
	),
	'CustPswd'=>'Lessonshark17'
	),
	'Request' => array(
	'InquiryRq' => array(
	'CurrentPersonInfo' => array(
	'PersonPermId' => '411653094',
	'PersonName' => array(
	'LastName' =>'Blevins',
	'FirstName' =>'Charlie', 
	), 

	),
	'SchoolId' => '003510'
	), 
	), 
	);
	
$result = $client->DegreeVerifyRequest(null,$options);
//$request = $client->__getLastRequest();
// Echo the result
echo "<pre>".print_r($result, true)."</pre>";

	die;
			
		App::import('Model','SchoolDetail');
		$this->SchoolDetail =& new SchoolDetail();
	  	$this->Session->write('tabname','credential');
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_default";
		/*$categories = $this->SchoolDetail->find('all');
pr($categories);die;
	 	$schools = Set::combine($categories, "{n}.SchoolDetail.schoolcode","{n}.SchoolDetail.schoolname");
		$this->set('schools',$schools);*/
		$this->set('id',$id);


		


	}

//code for prfile frontend


function contentProfile($id=null)    // this function is for  teacher profile  learn  tab  
{
		$this->Session->write('tabname1','learn');
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_profile";
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
		 App::import('Model','TeacherDesciplines');
                    $this->TeacherDesciplines = & new TeacherDesciplines();
                    //$users=$this->TeacherDesciplines->find('all');
                    $this->set('flag',$flag);
                    $categories = $this->TeacherDesciplines->find('all');
                    $discplines = Set::combine($categories, "{n}.TeacherDesciplines.dsid","{n}.TeacherDesciplines.dname");
                    
		   $this->set('discpline_old', $discplines);		
	
}


function leftSide() // this function is used for fetching left side of the teacher profile through request action
{

}
function contentMedia($id=null)
{

		$this->Session->write('tabname1','media');
		//$teacher= $_SESSION['teacher']; 
		//$id=$teacher['id'];	
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_profile";
		App::import('Model','TeacherMedia');
	 	$this->TeacherMedia 	=& new TeacherMedia();  
		$media 			= $this->TeacherMedia->find('all',array('conditions'=>array('tid'=>$id)));  
	
		$this->set('media',$media);
		$this->set('id',$id);
		
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
function contentLocation()
{
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_profile";
	
}	
	
function contentCredential($id=null)
{
		$this->Session->write('tabname1','experience');
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "teacher_profile";
		App::import('Model','TeacherExperience');
		$this->TeacherExperience =& new TeacherExperience();
		$teacherexperience       = $this->TeacherExperience->find('all',array('conditions'=>array('tid'=>$id)));  
		$this->set('teacherexperience',$teacherexperience);	
}
 function editTeacher()
	{
		//$teacher= $_SESSION['teacher']; 
		//$id=$teacher['id'];
		 $id=14;	
		$errorMessage                	      	="";	
		$this->set('message', $errorMessage); 
		$flag                         		="";	
		$this->set('flag', $flag); 
		$message                      		='';
		$this->pageTitle              		= __('Admin: Users Management', true);
		$this->layout                 		= "student_profile";
		App::import('Model','User');
		$this->User          		        = & new User();
		$teacher                                = $this->User->find('all',array('conditions'=>array('id'=>$id)));  
		App::import('Model','Billing');
		$this->Billing     		= & new Billing();	
		$billing                                = $this->Billing->find('all',array('conditions'=>array('userid'=>$id))); 	
		$this->set('teacher',$teacher);
		$this->set('billing', $billing);                
                if($this->data)
                {
                                 $details['User']['id']          		 = $this->data['User']['hidd'];
                                 $details['User']['firstname']          	 = $this->data['User']['firstname1'];
                                 $details['User']['lastname']          		 =  $this->data['User']['lastname1'];
                                 $details['User']['email']             		 = $this->data['User']['email'];
                                 $details['User']['password ']         		 = $this->data['User']['password'];
				 $details['User']['zip']                	 = $this->data['User']['zip'];
                                 pr($details);
                                 $this->User->save($details,false);
				 $details1['Billing']['id']         	 = $this->data['User']['hidd1'];
				 $details1['Billing']['paypalid']          = $this->data['User']['paypal'];
				 $details1['Billing']['amazonid']          = $this->data['User']['amazon'];
				
				 $this->Billing->save($details1,false);
                }
			
	}
	function respondRequest()
	{
		 $id=14;	
		$errorMessage                	      	="";	
		$this->set('message', $errorMessage); 
		$flag                         		="";	
		$this->set('flag', $flag); 
		$message                      		='';
		$this->pageTitle              		= __('Admin: Users Management', true);
		$this->layout                 		= "student_profile";
		App::import('Model','TeacherStudentDetail');
		$this->TeacherStudentDetail = & new TeacherStudentDetail();	
		$billing                                = $this->TeacherStudentDetail->find('all',array('conditions'=>array('tid'=>$id))); 	
			
		$this->set('billing', $billing);
	}
	function acceptReject()
	{
		 App::import('Model','TeacherStudentDetail');
		 $this->TeacherStudentDetail = & new TeacherStudentDetail();	
		 $id=$this->params['pass'][0];		 
		 $ser=$this->params['pass'][1];
		 $details1['TeacherStudentDetail']['request']           = $ser;
		 $details1['TeacherStudentDetail']['id']          	= $id;
		 $this->TeacherStudentDetail->save($details1,false);
                 $this->redirect('/teachers/respondRequest');	
	}
	function addStudent()
	{
		 $id=14;	
		 $errorMessage                	      	="";	
		 $this->set('message', $errorMessage); 
		 $flag                         		="";	
		 $this->set('flag', $flag); 
		 $message                      		='';
		 $this->pageTitle              		= __('Admin: Users Management', true);
		 $this->layout                 		= "student_profile";
		 $this->set('id', $id);
		 //App::import('Model','TeacherStudentDetail');
		 //$this->TeacherStudentDetail = & new TeacherStudentDetail();	
		//$uniqueID = uniqid('id', false);

		

		/*Saving data into email_invite table*/

		//$this->data['emailInvite']['first_name'] = $this->data['User']['first_name'];

		//$this->data['emailInvite']['sent_to_email'] = $this->data['User']['sent_to_email'];

		//$this->data['emailInvite']['user_id'] = $userId;

		//$this->data['emailInvite']['key'] = $uniqueID;

		//$this->emailInvite->save($this->data['emailInvite'],false);



		/*Sending email to 0user*/

		//$to = 'gurpreet.rexweb@gmail.com';
		 $url = 'http://www.lessonshark.com/dev1/students';

		 $to  = $this->data['Student']['email'];
		
		 $message = file_get_contents(VIEWS . 'elements' . DS . 'email' . DS . 'student_contact.ctp');

		//$message 	 = str_replace('[firstname]',$this->data['User']['first_name'],$message);
		$message	 =str_replace('[firstname]','This',$message);
		$message	 = str_replace('[url]',$url,$message);
		//$path='abc:def:lod';
		//echo strrpos($path, ":");
		//die;
		$subject = 'An Invitation from Lessonshark';

		$headers = 'MIME-Version: 1.0' . "\n";

		$headers .= 'Content-type: text/html; charset=UTF-8' . "\n";

		// Additional headers 

		$headers .= "From: " . 'gurpreet.rexweb@gmail.com' . "\n";

		// Mail it
		//pr($headers);pr($subject);pr($message);
		
		if(@mail($to, $subject, $message, $headers))
		 {



			$this->Session->setFlash('Your mail has been sent.');

			$this->data = array();

			$this->render();

		} 
		else {

		//$this->set('sentMsg','Mail could not be sent...you may try after a while..');

		$this->Session->setFlash('Mail could not be sent...you may try after a while..');

		$this->render();

		}	

		 
	}
	function studentDetail() /// this function is for teacher dashboard when there is shedule and students title
	{	
		 
		 $id=14;	
		 $errorMessage                	      	="";	
		 $this->set('message', $errorMessage); 
		 $flag                         		="";	
		 $this->set('flag', $flag); 
		 $message                      		='';
		 $this->pageTitle              		= __('Admin: Users Management', true);
		 $this->layout                 		= "student_profile";
		 $this->set('id', $id);
		 App::import('Model','TeacherStudentDetail');
		 $this->TeacherStudentDetail = & new TeacherStudentDetail();	
		 App::import('Model','User');
	         $this->User          			= & new User();
		 if($this->data)
                 {
                                 $details['User']['id']          		 = $this->data['User']['hidd'];
                                 $details['User']['firstname']          	 = $this->data['User']['firstname'];
                                 $details['User']['lastname']          		 =  $this->data['User']['lastname'];
                                 $details['User']['email']             		 = $this->data['User']['email'];
                                 $details['User']['city']         		 = $this->data['User']['city'];
				 $details['User']['zip']                	 = $this->data['User']['zip'];
				 $details['User']['state']         		 = $this->data['User']['state'];
				
                                 //pr($details);die;
				
                                 $this->User->save($details,false);
				
                 }
		 $billing                               = $this->TeacherStudentDetail->find('all',array('conditions'=>array('tid'=>$id))); 	
		 $users                     	 	= $this->User->find('all');
		 $userdetail=array();
		
		foreach($users as $user1)
		{
			$userdetail[$user1['User']['id']]=$user1['User']['firstname'];
		}
		//pr($userdetail);
		 
		//	 
		foreach($billing as $student)
			{
			  	
			  $id_student=$student['TeacherStudentDetail']['stid'];
			 if (array_key_exists($id_student,$userdetail)) 
				{ 
			  	 $id11=$userdetail[$id_student];
				}	
			$student_arr[$id_student]=$id11;
			} 
		 $this->set('student_arr', $student_arr);
  		 $this->set('billing', $billing);

		 //pr($billing);die;
	}
	
	function lessonStudent()
	 {
		 $id=14;	
		 $errorMessage                	      	="";	
		 $this->set('message', $errorMessage); 
		 $flag                         		="";	
		 $this->set('flag', $flag); 
		 $message                      		='';
		 $this->set('id', $id);
		 App::import('Model','TeacherStudentDetail');
		 $this->TeacherStudentDetail = & new TeacherStudentDetail();	
		 App::import('Model','User');
	         $this->User          			= & new User();
		  $billing                               = $this->TeacherStudentDetail->find('all',array('conditions'=>array('tid'=>$id))); 	
		 $users                     	 	= $this->User->find('all');
		 $userdetail=array();
		
		foreach($users as $user1)
		{
			$userdetail[$user1['User']['id']]=$user1['User']['firstname'];
		}
		foreach($billing as $student)
			{
			  	
			  $id_student=$student['TeacherStudentDetail']['stid'];
			  if (array_key_exists($id_student,$userdetail)) 
				{ 
			  	  $id11=$userdetail[$id_student];
				}	
			$student_arr[$id_student]=$id11;
			} 
		   $this->set('student_arr', $student_arr);
  		   $this->set('billing', $billing);
		
		
	 }
	 function studentName()
	  {
		 $id=14;	
		 $errorMessage                	      	="";	
		 $this->set('message', $errorMessage); 
		 $flag                         		="";	
		 $this->set('flag', $flag); 
		 $message                      		='';
		 $this->set('id', $id);
		 App::import('Model','TeacherStudentDetail');
		 $this->TeacherStudentDetail = & new TeacherStudentDetail();	
		 App::import('Model','User');
	         $this->User          			= & new User();
		  $billing                               = $this->TeacherStudentDetail->find('all',array('conditions'=>array('tid'=>$id))); 	
		 $users                     	 	= $this->User->find('all');
		 $userdetail=array();
		
		foreach($users as $user1)
		{
			$userdetail[$user1['User']['id']]=$user1['User']['firstname'];
		}
		foreach($billing as $student)
			{
			  	
			  $id_student=$student['TeacherStudentDetail']['stid'];
			  if (array_key_exists($id_student,$userdetail)) 
				{ 
			  	  $id11=$userdetail[$id_student];
				}	
			$student_arr[$id_student]=$id11;
			} 
		   $this->set('student_arr', $student_arr);
  		   $this->set('billing', $billing);
		
		
	  }	
	function studentDet($sid)   /// this function will give edit form on the click of particular student name by that student record can be updated
		{ 
		App::import('Model','User');
	         $this->User          			= & new User();
		 $users                     	 	= $this->User->find('all');
		 $userdetail=array();
		 if($sid)
		  {
			
			 $user1                       = $this->User->find('all',array('conditions'=>array('id'=>$sid)));
			//pr($user1);
			//return;
			echo '<div id="editdetail" >';
			echo '<form name="User" action="/dev1/teachers/studentDetail" method="post">';
				foreach($user1 as $us)
					{
						 echo '<input type="hidden" class="boxtext" name="data[User][hidd]" value="'.$us['User']['id'].'"> '; 
						 echo '<input type="text" class="boxtext" name="data[User][firstname]" value="'.$us['User']['firstname'].'"> '; 
						 echo '<input type="text" class="boxtext" name="data[User][lastname]" value="'.$us['User']['lastname'].'"> ';						 echo '<input type="text" class="boxtext" name="data[User][email]" value="'.$us['User']['email'].'"> ';
						 echo '<input type="text" class="boxtext" name="data[User][phone]" value="'.$us['User']['phone'].'"> ';						 echo '<input type="text" class="boxtext" name="data[User][city]" value="'.$us['User']['city'].'"> ';
						 echo '<input type="text" name="data[User][state]"  class="boxtext" value="'.$us['User']['state'].'"> ';
						 echo '<input type="text" name="data[User][zip]" class="boxtext" value="'.$us['User']['zip'].'"> ';
						 echo '<input  type="submit" value="Update">';	
					}
			echo '</form></div>';
			echo '<div id="detail">';
		 	foreach($user1 as $us)
			{
				 echo '<div>'  .$us['User']['firstname']. '</div>'; 
				 echo '<div >' .$us['User']['lastname'].  '</div>'; 
				 echo '<div>'  .$us['User']['email'].     '</div>';
				 echo '<div>'  .$us['User']['phone'].     '</div>';
 				 echo '<div>'  .$us['User']['city']. 	  '</div>'; 
				 echo '<div>'  .$us['User']['state']. 	  '<div>' ;
				 echo '<div>'  .$us['User']['zip']. 	  '</div>';
				 echo '<a href="#" onclick="getdetail()" >Edit</a>';	
			}
			echo '</div>';
		  }	
		die;

		}
	function editDetail()
		{
		echo 'chal pya';
		die;
	
		}

	function lessonShedule($id)    // this function will give the lesson detail based on he id passed to this function
	{
		
		App::import('Model','TeacherPayment');
		$this->TeacherPayment   = & new TeacherPayment();
		App::import('Model','StudentLesson');
		$this->StudentLesson 	= & new StudentLesson();
		App::import('Model','MakeupLesson');
		$this->MakeupLesson     = & new MakeupLesson();
		$condition=array('conditions'=>array('stid'=>$id ));
		$start = date('Y-m-d');
		$conditions = array();
		$condition1=array('conditions'=>array('StudentLesson.stid'=>$id ,'StudentLesson.dateoflesson >=' => $start));
                $condition2=array('conditions'=>array('StudentLesson.stid'=>$id ,'StudentLesson.dateoflesson <=' => $start));
                // pr($condition2);die;	
		$payment               	= $this->TeacherPayment->find('all',$condition);
		$lesson              	= $this->StudentLesson->find('all',$condition2);
		$futurelesson           = $this->StudentLesson->find('all',$condition1);
		$makeup              	= $this->MakeupLesson->find('all',$condition);
                 
		 $this->set('futurelesson',  $futurelesson);
		 $this->set('payment',  $payment);	
		 $this->set('lesson',   $lesson);
		 $this->set('makeup',   $makeup);
		
	}
	function attendance()// this function will help to edit the attendance of teacher 
		{
			App::import('Model','StudentLesson');
			$this->StudentLesson 	= & new StudentLesson();
		 	
		      if($this->data)
			{
				pr($this->data);die;	
			 	        //pr($_POST['attendance']);die;
					$field1=$_POST['attendance'];	
					$details['StudentLesson']['id']=$_POST['lessonid'];	
					$details['StudentLesson'][$field1]=1;					
					$details['StudentLesson']['comment']=$_POST['comment'];
						
				    	$this->StudentLesson->save($details ,false);
				   
			}
		}
	function attendanceAjax()
	{
		
 	        App::import('Model','StudentLesson');
		$this->StudentLesson 			= & new StudentLesson();
		$field1=$_POST['attendance'];	
		$details['StudentLesson']['id']    	=$_POST['lessonid'];	
		$details['StudentLesson'][$field1] 	=1;					
		$details['StudentLesson']['comment']	=$_POST['comment'];

		$this->StudentLesson->save($details ,false);
		$condition2=array('conditions'=>array('StudentLesson.id'=>$_POST['lessonid']));
		$lesson              	= $this->StudentLesson->find('all',$condition2);
	
	    	foreach($lesson as $lesson1)
		 {
			if($_POST['attendance']=='tutioncredit')
			{
		echo '<div class="table_left_box_fo"><div class="table_text_date_gree" id="makecpcredit'. $lesson1['StudentLesson']['id'].'">1</div></div>';
            echo '<div class="table_left_box_four"><div class="table_text_date_gree" id="studentbalance '.$lesson1['StudentLesson']['id'].'">+$0</div></div>';
           echo  '<div class="table_left_boxs"><div class="table_text_date_gree" id="profit'.$lesson1['StudentLesson']['id'].'">$'.$lesson1['StudentLesson']['paid'].'</div></div>';
			}
			else if($_POST['attendance']=='nocredit')
			{
				echo '<div class="table_left_box_fo"><div class="table_text_date_gree" id="makecpcredit'. $lesson1['StudentLesson']['id'].'">1</div></div>';
            echo '<div class="table_left_box_four"><div class="table_text_date_gree" id="studentbalance '.$lesson1['StudentLesson']['id'].'">-1 lesson</div></div>';
           echo  '<div class="table_left_boxs"><div class="table_text_date_gree" id="profit'.$lesson1['StudentLesson']['id'].'">$'.$lesson1['StudentLesson']['paid'].'</div></div>';
  
			}
			else if($_POST['attendance']=='makeupcredit')
			{
				echo '<div class="table_left_box_fo"><div class="table_text_date_gree" id="makecpcredit'. $lesson1['StudentLesson']['id'].'">+1</div></div>';
            echo '<div class="table_left_box_four"><div class="table_text_date_gree" id="studentbalance '.$lesson1['StudentLesson']['id'].'">-1 lesson</div></div>';
           echo  '<div class="table_left_boxs"><div class="table_text_date_gree" id="profit'.$lesson1['StudentLesson']['id'].'">$'.$lesson1['StudentLesson']['paid'].'</div></div>';

			}
			else
			{
			}	
		}
		die;
	   
	}	
		function makeup()
		{

		   App::import('Model','MakeupLesson');
		   $this->MakeupLesson = & new MakeupLesson();	    
 		   if($this->data) 
		   { 	 
			  pr($this->data);die;   
			  $this->data['MakeupLesson']['tid']  =14;
			  $this->data['MakeupLesson']['stid'] =52;	
			  $this->data['MakeupLesson']['dateoflesson'] = $this->data['User']['day'];
			  $this->data['MakeupLesson']['monthoflesson'] = $this->data['User']['month'];	
			  $this->data['MakeupLesson']['yearoflesson'] = $this->data['User']['year'];
			//  pr($this->data);die;
			  $this->MakeupLesson->save($this->data ,false);
		
			
		    }
		}
		function deleteMakeup()
		{
			App::import('Model','MakeupLesson');
			$this->MakeupLesson                    = & new MakeupLesson();	   
			echo $id=$this->params['pass'][0];
			$conditions=array('MakeupLesson.id' => $id);
			$this -> MakeupLesson -> delete($conditions);
				
			//$this->redirect('/teachers/editProfile/'.$id);
						
		       
			
		}
	

}
?>

