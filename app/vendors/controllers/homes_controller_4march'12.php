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

############################################# START: FrontEnd ###################################

   function index()
   {       //die('Website is under progress ');                                                                            
	$this->layout     = "front_default_all";                    
	
   }
    function index1()
   {
	$this->layout     = "front_default";
	
   }
   function aboutus()
	{
	$this->layout        = "front_default";   

	}
   function faq()
	{
	$this->layout       ="front_default";
	}
  function feature()
	{
	$this->layout 	    ="front_default";	
	}	
  function featureTrack()
	{
		$this->layout 	    ="front_default";		
	
	}
	function tour()
	{
		$this->layout	    ="front_default";	
	}	
	function login()
	{
		 if (!empty($this->data))
		     {
			
			App::import('Model','User');
			$this->User          		 = & new User();

			$userinfo       = $this->User->findByEmail($this->data['User']['email']);
			
		      // Now compare the form-submitted password with the one in the database.
		      if(!empty($userinfo['User']['password']) && ($userinfo['User']['password'] == trim(md5($this->data['User']['password']))) && $userinfo['User']['status'] == '1' )
			 {

		      	// This means they were the same. We can now build some basic session information to remember this user as 'logged-in'.
			//Check if user is Admin or Coder
			if( $userinfo['User']['role'] == "admin" )
		          {
			    $this->Session->write('Admin', $userinfo['User']);
			    $this->redirect('/admin/users/home');
			  }
		       else
		         {
			 //Coder
			    $this->Session->write('teacher', $userinfo['User']);
			    $this->redirect('/teachers/profile');
			 }      

		      }
		    else
		      {
                                $this->redirect('/');
			      	//Username/password invalid
			      	$this->Session->setFlash(__('Username/Password is wrong.', true));
			      	$this->render();
		      }
	    }//End: Submission   
	}
        function logout()
        {        
	    session_unset();
	    $this->Session->destroy();
	    $this->Session->setFlash(__('Log out successful.', true));
	    $this->redirect('/'); 
        }
function showDistance()
   {
	$this->layout     = "";
	 if(!empty($this->data))
	  {
		
		$zip = $this->data['homes']['zip'];
		$adddress = $this->data['homes']['address'];
		App::import('Model','Garage');
     		$this->Garage = & new Garage();
		
		$allGarages = $this->Garage->find('all',array('conditions'=>array('g_zip_code'=> $zip)));
		
		$this->set('address',$adddress);
		$this->set('allGarages',$allGarages);
		
	  }	
   }
   function searchResult()
   {		
	$this->layout     = "front_default_all";
	
	 if(!empty($this->data) or isset($_SESSION['searchQuery']))
	  {
		
		if(isset($this->data))	
		{
			$arriveDate = $this->data['homes']['arriveDate'];
			$returnDate = $this->data['homes']['returnDate'];
			$arriveTime = split(':', $this->data['homes']['arrivalTime']);
			$returnTime = split(':', $this->data['homes']['returnTime']);

		  	$rTime	=	$returnTime[0];
			$aTime	= $arriveTime[0];

			$accTime = $rTime - $aTime;
			$accdays = round(strtotime($returnDate)-strtotime($arriveDate))/60/60/24;
			
			$error = array();
			if($this->data['homes']['address'] == "")
			{
				$error[] = "Please fill the address";
			}
			if($this->data['homes']['zip'] == "")
			{
				$error[] .= "Please fill the zip";
			}
			if($this->data['homes']['arriveDate'] == "Date")
			{
				$error[] .= "Please Select Arrive Date";
			}
       			if($this->data['homes']['arrivalTime'] == "")
			{
				$error[] = "Please Select Arrive Time";
			}

			if( $this->data['homes']['returnDate'] == "Date")
			{
				$error[] .= "Please Select Return Date";
			}
			if($this->data['homes']['returnTime'] == "")
			{
				$error[] = "Please Select Return Time";
			}
			if($this->data['homes']['sapce'] == "")
			{
				$error[] .= "Please fill No of Spaces";
			}
			if($this->data['homes']['location'] == "")
			{
				$error[] .= "Please Select the level of parking";
			}    
			if($this->data['homes']['facility_type'] == "")
			{
				$error[] .= "Please select Parking Preference";
			}
			if($this->data['homes']['carType'] == "")
			{
				$error[] .= "Please Select Type of car";
			}
			
			if($accdays>=0)
			{
				$this->Session->write('days',$accdays);

				if($accdays==0 and $accTime>0)
				{
					$this->Session->write('time',$accTime);
				}
				else if($accdays>0 )
				{
					$this->Session->write('time',$accTime);
				}
				else
				{
					$error[] .= "Please Select the correct Arrive and Return Time";
				}
			}
			else
			{
				$error[] .= "Please Select the correct Arrive and Return date";

				
			}
			

			if(!empty($error))
			{
				$this->Session->write('error',$error);

				$this->redirect('/homes/');
			}	
			else
			{
				$this->Session->write('searchQuery',$this->data);
			}

		}

		
		
		$zip =  $this->Session->read('searchQuery.homes.zip');//$_SESSION['searchQuery']['homes']['zip'];
		$adddress = $this->Session->read('searchQuery.homes.address'); //$_SESSION['searchQuery']['homes']['address'];
		App::import('Model','Garage');
     		$this->Garage = & new Garage();

		App::import('Model','GarageAvailSpace');
     		$this->GarageAvailSpace = & new GarageAvailSpace();

	        $facility_type = "";
		$location = "";

		if( !empty($this->data) ) 
		{
			if(isset($this->data['homes']['facility_type']) and !empty($this->data['homes']['facility_type']))
			{
				 $facility_type = 'GarageAvailSpace.facility_type = "'.$this->data['homes']['facility_type'].'"';
			}

			if(isset($this->data['homes']['location'])and !empty($this->data['homes']['location']))
			{
				 $location = 'GarageAvailSpace.location = "'.$this->data['homes']['location'].'"';
			}
		 }

		$allGarages = $this->Garage->find('all',array('conditions'=>array('g_zip_code'=> $zip)));
		                  
		foreach($allGarages as $key=>$allGarage)
		{	
			$spaceDetails = $this->GarageAvailSpace->find('first',array('conditions'=>array('status'=>0,'GarageAvailSpace.garage_id'=>$allGarage['Garage']['id'] ,$facility_type ,$location)));
			$numRowsSpace = $this->Garage->getNumRows($spaceDetails);

			if($numRowsSpace==0)
			{
				$allGarages[$key]['GarageSpace'] = $this->GarageAvailSpace->find('first',array('conditions'=>array('status'=>0,'GarageAvailSpace.garage_id'=>$allGarage['Garage']['id'] ,$facility_type)));

				$numRowsPref = $this->Garage->getNumRows($allGarages[$key]['GarageSpace']);
				if($numRowsSpace==0)
				{
					$allGarages[$key]['GarageSpace'] = $this->GarageAvailSpace->find('first',array('conditions'=>array('status'=>0,'GarageAvailSpace.garage_id'=>$allGarage['Garage']['id'])));
				}	
				
				
			}
			else
			{
				$allGarages[$key]['GarageSpace'] = $spaceDetails;
			}	

		}

		//pr($allGarages);die;
		$this->set('address',$adddress);
		$this->set('allGarages',$allGarages);
		
	  }	
   }	
   function confirmLocation()
   {
	if(isset($this->data['homes']['select']))
	{
		$this->layout     = "front_default_all";
		$garageSpaceId = $this->data['homes']['select'];
		$arr =explode('-',$this->data['homes']['select']);	
		//pr($arr);die;
		$spaceId  = $arr[0];
		$distance = $arr[1];
		$nameGarege = $arr[2];

		//pr($this->Session->read('searchQuery.homes.address'));die;
		//pr($this->data['homes']['select']);die;

		$this->set('name',$nameGarege);
		$this->set('dist',$distance);

		App::import('Model','Garage');
		$this->Garage = & new Garage();

		App::import('Model','GarageAvailSpace');
		$this->GarageAvailSpace = & new GarageAvailSpace();

		$this->GarageAvailSpace->bindModel(array('hasOne'=>array(
		'Garage'=>array('conditions' => 'GarageAvailSpace.garage_id=Garage.id', 'type' => 'INNER', 'fields' => '','foreignKey' => '0'),)), false);		

		$selectedGarages = $this->GarageAvailSpace->find('all',array('conditions'=>array('GarageAvailSpace.id'=>$garageSpaceId)));

		$this->set('selectedGarages',$selectedGarages[0]);
	}
	else
	{
    		 $this->redirect('/homes/');
	}
	
   }		
	
	function contactUs()
	{  
		$this->layout ="front_default_all";
		App::import('Model','Home');
     		$this->Home = & new Home();
		if(!empty($this->data))
		{
			$this->Home->set($this->data);
			//pr($this->data);die;
			 if ( $this->Home->validates(array('fieldList' => array('fname','lname','email','phone','message'))) ) 
              		  { 	 
				$to = 'gurpreet.rexweb@gmail.com';
				
				$message = file_get_contents(VIEWS . 'elements' . DS . 'email' . DS . 'contact_us.ctp');
				$message = str_replace('[firstname]',$this->data['Home']['fname'],$message);
				$message = str_replace('[lastname]',$this->data['Home']['lname'],$message);
				$message = str_replace('[message]',$this->data['Home']['message'],$message);
				//$message = str_replace('[email]',$userinfo['User']['email'],$message);
				$message = str_replace('[phone]',$this->data['Home']['phone'],$message);
				
				$subject = $this->data['Home']['fname'].' '.$this->data['Home']['lname'].' Contacted You';
				// To send HTML mail, the Content-type header must be set
				$headers = 'MIME-Version: 1.0' . "\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\n";
				// Additional headers
				$headers .= "From: " . $this->data['Home']['email'] . "\n";
				// Mail it
				if(@mail($to, $subject, $message, $headers)) {
				
					$this->Session->setFlash('Your mail has been sent.');
					$this->data = array();
					$this->render();
				} else {
				//$this->set('sentMsg','Mail could not be sent...you may try after a while..');
					$this->Session->setFlash('Mail could not be sent...you may try after a while..');
					$this->render();
				}
			}
			else
			{
		
				$errors = $this->Home->invalidFields(array('fieldList' => array('fname','lname','email','phone','message')));
				//$this->Home->set('errors',$errors);
			                                       	
			}//END: Else IF			
		}
		
	}

	
   function numbers()
    {
	$this->layout="front_default";
    }	
 function faqSecond()
    {
	$this->layout="front_default";
    }	
   
	function chkpage()
	{
		$this->layout = "front_default";

			$zip = '14305';
			$adddress = '1234 Main Street, Washington, DC 20002';
			App::import('Model','Garage');
	     		$this->Garage = & new Garage();
		
		                  	$allGarages = $this->Garage->find('all',array('conditions'=>array('g_zip_code'=> $zip)));
		
			$this->set('address',$adddress);
			$this->set('allGarages',$allGarages);
			
	}
	
//_____________________________________________________________________
############################################# END: FrontEnd ################################### 
 
}
?>
