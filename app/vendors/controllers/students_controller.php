<?php
class StudentsController extends AppController 
{


   var $name = 'Students';
   /* *  Helper used by the Controller **/    
   var $helpers = array('Html','Ajax','Javascript','Form','Session','Xml','GoogleChart');
   /* *  Component used by the Controller **/
    var $components = array('RequestHandler','Cookie','Session','Email'); 

    var $paginate = array('limit' => 10);

############################################# START: FrontEnd ###################################

   function index()   // this function is for creating student account
   {                                                                
		$errorMessage                 ="";	
		$this->set('message', $errorMessage); 
		$flag                         ="";	
		$this->set('flag', $flag); 
		$message                      ='';
		$this->pageTitle              = __('Admin: Users Management', true);
		$this->layout                 = "student_profile";
		App::import('Model','User');
		$this->User          		      = & new User();
		App::import('Model','TeacherDesciplineField');
		$this->TeacherDesciplineField         = & new TeacherDesciplineField();	
		$id=14;
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
	$this->set('$des',$arr_des);
	
	App::import('Model','TeacherStudentDetail');
	$this->TeacherStudentDetail = & new TeacherStudentDetail();	
	if ( !empty( $this->data ) ) 
          {
		
		 $this->data['User']['password']		  		 = $this->data['User']['password'];  
		 $this->User->set($this->data);
	
		  /*if ($this->User->validates(array('fieldList' 	 	 => array('password','cpassword','firstname','email','zip'))) ) 
		   { */	
			if($this->data['User']['type1']=='student')
			{	
				//$this->data['User']['username'] = $this->data['User']['username'];

				$this->data['User']['password']  		 = md5($this->data['User']['password']);	

				$this->data['User']['firstname']  		 = $this->data['User']['firstname'];	

				$this->data['User']['lastname']  		 = $this->data['User']['lastname'];	

				$this->data['User']['email']     		 = $this->data['User']['email'];	

				$this->data['User']['zip']       		 = $this->data['User']['zip'];	
				$this->data['User']['type']      			 ='1';	
				
				//pr($this->data);die;
				$this->User->save($this->data ,false);
				//$this->set('message', 'Teacher has been saved');
				$userid=$this->User->getLastInsertId();   
				$ds=$arr_des[$this->data['User']['dsid1']];
			
				$details['TeacherStudentDetail']['stid']     	 = $userid;

				$details['TeacherStudentDetail']['dsname']  	 =$ds; 	
				$details['TeacherStudentDetail']['tid']   	 = $id;
				$details['TeacherStudentDetail']['noofyear']   	 = $this->data['User']['noofyear'];	
				$details['TeacherStudentDetail']['noofmonth']    = $this->data['User']['noofmonth'];
							
				$this->TeacherStudentDetail->save($details);

			}
			else
			{
				
				//$this->data['User']['username'] = $this->data['User']['username'];
				
				$this->data['User']['password']   = md5($this->data['User']['password1']);	

				$this->data['User']['firstname']  = $this->data['User']['firstname1'];	

				$this->data['User']['lastname']   = $this->data['User']['lastname1'];	

				$this->data['User']['email']      = $this->data['User']['email1'];	

				$this->data['User']['zip']        = $this->data['User']['zip1'];	
				$this->data['User']['parentfname']  = $this->data['User']['parentfname'];
				$this->data['User']['parentlname']  = $this->data['User']['parentlname'];
				$this->data['User']['studenttype']  = $this->data['User']['type1'];
				$this->data['User']['type']       ='1';	
				
				
				$this->User->save($this->data ,false);
				//$this->set('message', 'Teacher has been saved');
				$userid=$this->User->getLastInsertId();   
				$ds=$arr_des[$this->data['User']['dsid']];
			
				$details['TeacherStudentDetail']['stid']     	 = $userid;

				$details['TeacherStudentDetail']['dsname']  	 =$ds; 	
				$details['TeacherStudentDetail']['tid']   	 = $id;
				$details['TeacherStudentDetail']['age']   	 = $this->data['User']['age'];
				
				//pr($details);die;			
				$this->TeacherStudentDetail->save($details);

			}
		 /*   }
		 else
		    {
			
			   $errorMessage                  ="";		
		           $errors                        = $this->User->invalidFields(array('fieldList' => array('password','cpassword','firstname','lastname','zip','email',)));
			   $this->User->set('errors',$errors);
		       
		            
		    }//END: Else IF			*/

		

          
          }//End: DATA check
	
	
	
   }
	function billingInfo()    // by this function is for book lesson process before payment .it is used for calculation for payment
	{
		$errorMessage                	      	="";	
		$this->set('message', $errorMessage); 
		$flag                         		="";	
		$this->set('flag', $flag); 
		$message                      		='';
		$this->pageTitle              		= __('Admin: Users Management', true);
		$this->layout                 		= "student_profile";
		$discipline = $this->requestAction(array('controller' => 'students', 'action' => 'getdesc') );	
		//pr($discipline);die;
		$this->set('discipline', $discipline);// this will be used when shedule page made
		
		   
			/*if  (in_array  ('curl', get_loaded_extensions()))
				{
				 echo 'ok a';
				}
			else
			{
				echo 'auka a';
			}*/

		  /*  $ch = curl_init('https://wepayapi.com/v2/account/create');
		    
		    $arguments = array(
			'name'          => 'API Test Account',
			'description'   => 'This is test account to show off the WePay API'
			);
		    
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, 
			array('Authorization: Bearer a69a1c55656540771a0fcef7db418931abb185589dd549b97dbe14f5ce4bd108'));
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $arguments);
		
		    // execute the api call
		   echo  $result = curl_exec($ch);
		    // echo the json response
		    echo json_decode($result);
     		*/
		 /*  $ch = curl_init('https://stage.wepayapi.com/v2/user'); // the URL of the call
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, 
			array('Authorization: Bearer 8c2e8cba3b6bfbece404e81f80bfa1b39be51e0a78b9fb79e9c477f9db9b577b'));
		
		    // execute the api call
		    echo $result = curl_exec($ch);
		    // echo the json response
		    //echo json_decode($result);
    
		    // echo the json response
		    //echo json_decode($result);
    
		    // echo the json response*/
		  	/*$ch = curl_init('https://stage.wepayapi.com/v2/user'); // the URL of the call
   		 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   		 	curl_setopt($ch, CURLOPT_HTTPHEADER, 
       			array('Authorization: Bearer a69a1c55656540771a0fcef7db418931abb185589dd549b97dbe14f5ce4bd108'));
        
   		 	// execute the api call
   			echo $result = curl_exec($ch);
    			// echo the json response
   			// echo json_decode($result); */
		/* $ch = curl_init('https://stage.wepay.com/v2/oauth2/token?client_id=91196&redirect_uri=http://www.lessonshark.com/dev1/students/billingInfo&client_secret=4be0159c32&code=1bab385f4f35a6c66848ff6fe4fd9e95d4826111a826c9e314');
		 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   		 	curl_setopt($ch, CURLOPT_HTTPHEADER);
        
   		 	// execute the api call
   			echo $result = curl_exec($ch);
    		*/	
		/*   $ch = curl_init('https://stage.wepay.com/v2/checkout/create/?client_id=91196&redirect_uri=http://www.lessonshark.com/dev1/students/billingInfo&client_secret=4be0159c32&code=1bab385f4f35a6c66848ff6fe4fd9e95d4826111a826c9e314');
		 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   		 	curl_setopt($ch, CURLOPT_HTTPHEADER);
        	*/
			//$ch = curl_init('https://stage.wepay.com/v2/checkout/create?account_id=7601048&amount=100&short_description=Simple&type=PERSONAL&redirect_uri=http://www.lessonshark.com/dev1/students/billingInfo');

			/*$ch = curl_init('https://stage.wepay.com/v2/checkout/create?account_id=7601048&amount=100&short_description=Simple&type=PERSONAL&redirect_uri=http://www.lessonshark.com/dev1/students/billingInfo');


		 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   		 	curl_setopt($ch, CURLOPT_HTTPHEADER);
   		 	// execute the api call
   			echo $result = curl_exec($ch);*/
	
			$ch = curl_init('https://stage.wepayapi.com/checkout/create');

			$arguments = array(
			'account_id' => '45917',
			'amount' => '1.00',
			'short_description' => 'This is test account to show off the WePay API',
			'type' => 'PERSONAL',
			'redirect_uri' =>'http://lessonshark.com/',
			'mode' => 'iframe'
			);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, 
			array('Authorization: Bearer <ff214bd5296dbf399606f52a624425236f7e8457cfb24c49db7fb64eb4278469>'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $arguments);

			// execute the api call
			$result = curl_exec($ch);
			// echo the json response
			pr($result.'HI');
			echo json_decode($result);


  		

	}
	function billing()
	{
	 		$ch = curl_init('https://stage.wepayapi.com/checkout/create');

			$arguments = array(
			'account_id' => '45917',
			'amount' => '1.00',
			'short_description' => 'This is test account to show off the WePay API',
			'type' => 'PERSONAL',
			'redirect_uri' =>'http://lessonshark.com/',
			'mode' => 'iframe'
			);

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, 
			array('Authorization: Bearer <ff214bd5296dbf399606f52a624425236f7e8457cfb24c49db7fb64eb4278469>'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $arguments);

			// execute the api call
			$result = curl_exec($ch);
			// echo the json response
			pr($result.'HI');
			echo json_decode($result);
		die;
		
	}
	
	
	function getdesc()
	 {
		$sid=54;
		App::import('Model','TeacherStudentDetail');
		
		$this->TeacherStudentDetail 		= & new TeacherStudentDetail();	
		$choose_des = $this->TeacherStudentDetail->find('all',array('conditions'=>array('stid'=>$sid)));
		//pr($choose_des); 
		foreach($choose_des as $choose)
		{ 
			$tid=$choose['TeacherStudentDetail']['tid'];  //tid for fetching teacher packages
			$dsname=$choose['TeacherStudentDetail']['dsname']; //dsname for fetching ds id
		
		}
		App::import('Model','TeacherDesciplines');
		$this->TeacherDesciplines = & new TeacherDesciplines();
		$dsid = $this->TeacherDesciplines->find('all',array('conditions'=>array('dname'=>$dsname)));
		foreach($dsid as $ds)
		{
			$ds_fetch=$ds['TeacherDesciplines']['dsid'];
		}
		
		
		App::import('Model','TeacherDesciplineField');
		$this->TeacherDesciplineField           = & new TeacherDesciplineField();	 
		$discipline = $this->TeacherDesciplineField->find('all' ,array('conditions'=>array('tid'=>$tid, 'dsid'=>$ds_fetch )));
		return $discipline;
	 }	
		
	function checkShedule()    
	{	
		
		$errorMessage                	      	="";	
		$this->set('message', $errorMessage); 
		$flag                         	      	="";	
		$this->set('flag', $flag); 
		$message                      	      	='';
		$this->pageTitle              	      	= __('Admin: Users Management', true);
		$this->layout                 	      	= "student_profile";
		$sid				      	=54;		
		$discipline = $this->requestAction(array('controller' => 'students', 'action' => 'getdesc') );	
		
		$this->set('discipline', $discipline);// this will be used when shedule page made
		  
	}
	function editStudent()     // this function used for editing student account
	{
		//$teacher= $_SESSION['teacher']; 
		//$id=$teacher['id'];
		$id=52;		
		$errorMessage                	      	="";	
		$this->set('message', $errorMessage); 
		$flag                         		="";	
		$this->set('flag', $flag); 
		$message                      		='';
		$this->pageTitle              		= __('Admin: Users Management', true);
		$this->layout                 		= "student_profile";
		App::import('Model','User');
		$this->User          		        = & new User();
		
		App::import('Model','Billing');
		$this->Billing     		= & new Billing();	
		
		$billing                                = $this->Billing->find('all',array('conditions'=>array('userid'=>$id))); 	
		//$this->set('teacher',$teacher);
		$this->set('billing', $billing);
		$hidd='';                
                if($this->data)
                {		
			$this->data['User']['password'] = $this->data['User']['password'];  
		 	$this->User->set($this->data);
		//  if ($this->User->validates(array('fieldList' => array('firstname','email','zip'))) ) 
		   //{ 		 echo 'herte';die;	
				 $hidd=$this->data['User']['hidd1'];	
				 // pr($this->data);die;
                                 $details['User']['id']          		 = $this->data['User']['hidd'];
                                 $details['User']['firstname']          	 = $this->data['User']['firstname1'];
                                 $details['User']['lastname']          		 =  $this->data['User']['lastname1'];
                                 $details['User']['email']             		 = $this->data['User']['email'];
                                 $details['User']['password ']         		 = md5($this->data['User']['password']);	
				 $details['User']['zip']                	 = $this->data['User']['zip'];
                                 // pr($details);die;
                                 $this->User->save($details,false);
				if($hidd)
				 {					
				 $details1['Billing']['id']         	 = $this->data['User']['hidd1'];
				 }
				 $details1['Billing']['cardfname']         = $this->data['User']['cardfname'];
				 $details1['Billing']['cardlname']         = $this->data['User']['cardlname'];
				 $details1['Billing']['billingaddress']    = $this->data['User']['billingaddress'];
				 $details1['Billing']['city']          	 = $this->data['User']['city'];
				 $details1['Billing']['state']          	 = $this->data['User']['state'];				 
				 $details1['Billing']['zip']    		 = $this->data['User']['zip1'];
				 $details1['Billing']['cardtype']          = $this->data['User']['cardtype'];
				 $details1['Billing']['cardnumber']        = $this->data['User']['cardnumber'];			
				 $details1['Billing']['ccv']            	 = $this->data['User']['ccv'];
				 //$details1['BillingDetail']['paypalid']          = $this->data['User']['paypalid'];				 
	 
				// pr($details1);die;
				 $this->Billing->save($details1,false);
		 // }
		 /* else
		       {
				echo 'here in vhgf'; die;
			   $errorMessage                  ="";		
		           $errors                        = $this->User->invalidFields(array('fieldList' => array('password','cpassword','firstname','lastname','zip','email',)));
			   $this->User->set('errors',$errors);
		       
		            
		    }*/		
                }	
			$teacher                                = $this->User->find('all',array('conditions'=>array('id'=>$id)));  
			$billing                                = $this->Billing->find('all',array('conditions'=>array('userid'=>$id))); 	
		$this->set('teacher',$teacher);
		$this->set('billing', $billing);
			
	}
	function closeAccount()  /// this function will set status to zero in users table then the account will be disable or unuse able
	{
		$id=52;
		//$teacher= $_SESSION['teacher']; 
		//$id=$teacher['id'];
		App::import('Model','User');
		$this->User = & new User();
		$details['User']['id']=$id;
		$details['User']['status']=0;
		$this->User->save($details,false);
		$this->redirect('/students/editStudent');
		
	}		
	function dashHistory()  // this function is for dashboard history
	{
		//$teacher= $_SESSION['teacher']; 
		//$id=$teacher['id'];
		$id=52;
		$errorMessage                	      	="";	
		$this->set('message', $errorMessage); 
		$flag                         		="";	
		$this->set('flag', $flag); 
		$message                      		='';
		$this->pageTitle              		= __('Admin: Users Management', true);
		$this->layout                 		= "student_profile";
		App::import('Model','TeacherStudentDetail');
		$this->TeacherStudentDetail = & new TeacherStudentDetail();
		$teacherid                  = $this->TeacherStudentDetail->find('all',array('conditions'=>array('stid'=>$id)));	
		foreach($teacherid as $teacher){  $tid=$teacher['TeacherStudentDetail']['tid']; }
		$this->set('tid', $tid);	
		App::import('Model','User');
		$this->User          		 = & new User();
		$teacher_record                  = $this->User->find('all',array('conditions'=>array('id'=>$tid)));	
		$this->set('record',$teacher_record);
		App::import('Model','TeacherPayment');
		$this->TeacherPayment            = & new TeacherPayment();
		App::import('Model','StudentLesson');
			$this->StudentLesson 	= & new StudentLesson();
		$payment                        = $this->TeacherPayment->find('all',array('conditions'=>array('stid'=>$id)));
		$this->set('payment', $payment);
		if($this->data)
		{
			$month=$this->data['Student']['month'];
			$year=$this->data['Student']['year'];
			$start_search=$year.'-'.$month.'-01';
			$end_search=$year.'-'.$month.'-30';
		  	$condition=array('conditions'=>array('stid'=>$id ,'payment_date BETWEEN ? and ?'=>array($start_search, $end_search)));
		}
		else
		 {
			$condition=array('conditions'=>array('stid'=>$id ));
		 }
		$comment='';
		$com='';
		$comment1                 	= $this->StudentLesson->find('all',array('conditions'=>array('stid'=>$id)));	
		foreach($comment1 as $comment)
		{
			$com=$comment['StudentLesson']['comment'];
		} 
		$this->set('comment', $com);
		$payment                        = $this->TeacherPayment->find('all',$condition);
		$this->set('payment', $payment);

		
			
		
	}
	function editShedule()
		{
		 	$id=52;
			App::import('Model','TeacherStudentDetail');
			$this->TeacherStudentDetail 	= & new TeacherStudentDetail();
			App::import('Model','TeacherDesciplines');
			$this->TeacherDesciplines	= & new TeacherDesciplines();
			App::import('Model','TeacherDesciplineField');
			$this->TeacherDesciplineField   = & new TeacherDesciplineField();	
			$teacherid                  	= $this->TeacherStudentDetail->find('all',array('conditions'=>array('stid'=>$id)));	
			App::import('Model','Request');
			$this->Request			= & new Request();	
			if($this->data)
			{
				
				$this->data['Request']['loc']  			 	 = $this->data['User']['location'];	
				$this->data['Request']['time']  			 = $this->data['User']['time'];	
				$this->data['Request']['day']     			 = $this->data['User']['day'];	
				$this->data['Request']['duration']       		 = $this->data['User']['duration'];	
				$this->data['Request']['tid']      		 	 = $this->data['User']['hidd'];
				$this->data['Request']['stid']      			 = $id;
				$this->Request->save($this->data ,false);	
				$this->redirect('/students/dashHistory');
			}		
			foreach($teacherid as $teach)
			{
				$tid=$teach['TeacherStudentDetail']['tid']; $dis=$teach['TeacherStudentDetail']['dsname'];
			}	
			$did                  		= $this->TeacherDesciplines->find('all',array('conditions'=>array('dname'=>$dis)));
			foreach($did as $ds)
			{
				$dsid=$ds['TeacherDesciplines']['dsid'];
			}
			$tdf                  		= $this->TeacherDesciplineField->find('all',array('conditions'=>array('dsid'=>$dsid,'tid'=>$tid )));
			$loc=array();
			$duration=array();
			foreach($tdf as $fields)
			{
				$loc[$fields['TeacherDesciplineField']['location']]=$fields['TeacherDesciplineField']['location'];
				$duration[$fields['TeacherDesciplineField']['duration']]=$fields['TeacherDesciplineField']['duration'];
			}
			
			$this->set('tid', $tid);
			$this->set('loc', $loc);	
			$this->set('duration', $duration);
			//$this->set('teacherid',$teacherid);
		}
	function comment()
		{
			$id=52;
			App::import('Model','TeacherStudentDetail');
			$this->TeacherStudentDetail 	= & new TeacherStudentDetail();
			App::import('Model','StudentLesson');
			$this->StudentLesson 	= & new StudentLesson();
			App::import('Model','TeacherDesciplineField');
			$this->TeacherDesciplineField   = & new TeacherDesciplineField();	
			$teacherid                  	= $this->TeacherStudentDetail->find('all',array('conditions'=>array('stid'=>$id)));
			
			foreach($teacherid as $teach)
			{
				$tid=$teach['TeacherStudentDetail']['tid']; $dis=$teach['TeacherStudentDetail']['ds_lesson_id'];
			}
			if($this->data)
			{
			   
				$details['StudentLesson']['comment']  		 = $this->data['User']['comment'];	

				$details['StudentLesson']['tid']  		 = $tid;	

				$details['StudentLesson']['stid']     		 = $id;	

				$details['StudentLesson']['dsid']       		 = $dis;	
				//$this->data['StudentLesson']['dateoflesson']      	 = '';
				//pr($this->details);die;
				
				$this->StudentLesson->save($details ,false);	
				$this->redirect('/students/dashHistory');     
				
			}
		}
	
   
}
?>
