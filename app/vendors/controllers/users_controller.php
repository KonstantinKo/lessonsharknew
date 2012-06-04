<?php
class UsersController extends AppController
 {


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
  function admin_login() 
     {
	      $this->pageTitle  = __('Admin Login', true);
	      $this->layout     = "admin_login";
		
	   	 //If data is submitted
	    if (!empty($this->data))
             {
	

		$userinfo = $this->User->findByUsername($this->data['User']['username']);

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
		    $this->Session->write('Coder', $userinfo['User']);
		    $this->redirect('/admin/coders');
		 }      

	      }
            else
              {
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
  function admin_logout()
    {        
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
  function admin_home()
  {
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
	function admin_index()
         {
	    //Check for authentication
           //  $this->checkSessionAdmin('Admin');

          //Search Session managment - delete it if any is registered
         $this->Session->check('condition') ? $this->Session->delete('condition'):'' ;
      
         $this->pageTitle  = __('Admin: Users Management', true);
         $this->layout     = "admin";
	}   

function admin_addProfile($id = NULL) //this function is for creating teacher profile first step learn tab   
{	
	$errorMessage="";	
	$this->set('message', $errorMessage); 
	$flag="";	
	$this->set('flag', $flag); 
	$message='';
	$this->pageTitle  = __('Admin: Users Management', true);
	$this->layout     = "admin";


	$this->set('id',$id);

	App::import('Model','TeacherDesciplineField');
	$this->TeacherDesciplineField = & new TeacherDesciplineField();	               
	// $this->TeacherDesciplineFields->set($this->data);
	if ( !empty( $this->data ) )
	{    
		//pr($this->data);die;
		/*if ($this->TeacherDesciplineField->validates(array('fieldList' => array('dsid'))) ) 
           		{*/
		$details['TeacherDesciplineField']['tid'] 	   = $id;
		$details['TeacherDesciplineField']['description'] = $this->data['TeacherDesciplineField']['description'];
		$details['TeacherDesciplineField']['dsid']        = $this->data['TeacherDesciplineField']['dsid'];


		foreach($this->data['TeacherDesciplineField']['rate'] as $key=>$value)
		{

			$details['TeacherDesciplineField']['rate']     = $value;

			$details['TeacherDesciplineField']['duration'] = $this->data['TeacherDesciplineField']['duration'][$key];
			$details['TeacherDesciplineField']['location'] = $this->data['TeacherDesciplineField']['location'][$key];
		//pr($details);die;
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

function admin_addProfileMedia($id)
{	 $errorMessage="";	
	$this->set('message', $errorMessage); 
	$this->set('id',$id);
	$this->pageTitle  = __('Admin: Users Management', true);
	$this->layout     = "admin";
	App::import('Model','TeacherMedia');
 	$this->TeacherMedia =& new TeacherMedia();        

 	$this->TeacherMedia->set($this->data);
	if ( !empty( $this->data ) )
	{    
		
		if ($this->TeacherMedia->validates(array('fieldList' => array('url','label'))) ) 
           	   {
		$details['TeacherMedia']['url']   = $this->data['TeacherMedia']['url'];
		$details['TeacherMedia']['label'] =$this->data['TeacherMedia']['label'];
	        $details['TeacherMedia']['tid']   =$id;
		$this->TeacherMedia->save($details);
		$this->redirect('/admin/users/addProfileLocation/'.$id);
		   }
		else
	          {


		   $errorMessage="";		
		   $errors = $this->TeacherMedia->invalidFields(array('fieldList' => array('url','label')));
		   foreach ($errors as $val) 
			 {
		              $errorMessage .= '<li>'.$val.'</li>';
      			 }
	       	 
           	 }
		$this->set('message', $errorMessage); 
	
	}

}
//end of add profile media function

function admin_addProfileLocation($id)
{	 $errorMessage="";	
	$this->set('message', $errorMessage); 	
	$this->set('id',$id);
	$this->pageTitle  = __('Admin: Users Management', true);
	$this->layout ="admin";
        App::import('Model','TeacherLocation');
        $this->TeacherLocation =& new TeacherLocation();
	$this->TeacherLocation->set($this->data);
	if ( !empty( $this->data ) )
	{    
		
	  if ($this->TeacherLocation->validates(array('fieldList' => array('type'))) ) 
   	     {
		$details['TeacherLocation']['zip'] 	= $this->data['TeacherLocation']['zip'];
		$details['TeacherLocation']['type'] 	= $this->data['TeacherLocation']['type'];
		$details['TeacherLocation']['radius'] 	= $this->data['TeacherLocation']['radius'];
		$details['TeacherLocation']['address1'] = $this->data['TeacherLocation']['address1'];
		$details['TeacherLocation']['address2'] = $this->data['TeacherLocation']['address2'];
		$details['TeacherLocation']['city'] 	= $this->data['TeacherLocation']['city'];
		$details['TeacherLocation']['state'] 	= $this->data['TeacherLocation']['state'];

		$details['TeacherLocation']['tid']=$id;
		
		$this->TeacherLocation->save($details,false);
		$this->redirect('/admin/users/addProfileAvailability/'.$id);
	     }
           else
	    {


		   $errorMessage="";		
		   $errors = $this->TeacherLocation->invalidFields(array('fieldList' => array('type',)));
		   foreach ($errors as $val) 
			 {
		              $errorMessage .= '<li>'.$val.'</li>';
      			 }
	       	 
            }
		$this->set('message', $errorMessage); 
	
					
	}

}//end  of location add profile function

function admin_addProfileAvailability($id)                    //this function is for adding availability to teacher profile 
{       $errorMessage="";	
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

function admin_addProfileExperience($id) // this  function is for adding experience of teacher
{               
		 $errorMessage="";	
		$this->set('message', $errorMessage); 
		$this->pageTitle  = __('Admin: Users Management', true);
		App::import('Model','TeacherExperience');
		$this->TeacherExperience =& new TeacherExperience();
		$this->layout     = "admin";
                $this->set('id', $id);
                $this->TeacherExperience->set($this->data);
                if(!empty($this->data)) //this condition checks if data is passed from experiece form or not
		{
			if ($this->TeacherExperience->validates(array('fieldList' => array('experience'))) ) 
           			{
					$details['TeacherExperience']['experience']   	=	$this->data['TeacherExperience']['experience'];
					$details['TeacherExperience']['tid']		=$id;
					$this->TeacherExperience->save($details,false);
					$this->redirect('/admin/users/addProfilePolicy/'.$id);	
				}
			else
				{
				   $errorMessage="";		
				   $errors = $this->TeacherExperience->invalidFields(array('fieldList' => array('experience',)));
				   foreach ($errors as $val) 
					 {
				              $errorMessage .= '<li>'.$val.'</li>';
		      			 }
			       	 
		           	}
				 $this->set('message', $errorMessage); 

		//		 $this->render('admin_addProfileExperience', 'ajax');
		}

}
// end of function add experience

function admin_addProfilePolicy($id)
{	
	$errorMessage="";	
		$this->set('message', $errorMessage); 
	 $this->pageTitle  = __('Admin: Users Management', true);
	 $this->layout     = "admin";
         

	 $this->set('id',$id);

	App::import('Model','TeacherPolicy');
	$this->TeacherPolicy = & new TeacherPolicy();	               
	 $this->TeacherPolicy->set($this->data);
	if ( !empty( $this->data ) )
	{    
	  if ($this->TeacherPolicy->validates(array('fieldList' => array('makeuplesson','cancelation'))) ) 
             {
		$details['TeacherPolicy']['tid'] 	   = $id;
		$details['TeacherPolicy']['makeuplesson']  = $this->data['TeacherPolicy']['makeuplesson'];
		$details['TeacherPolicy']['cancelation']   = $this->data['TeacherPolicy']['cancelation'];


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

function admin_detail() // function to find total sign up student, total cancel student, total profit of lessonshark
{

	$this->pageTitle             = __('Admin: Users Management', true);
	$this->layout                = "admin";
	App::import('Model','CancelDetail');
	$this->CancelDetail          = & new CancelDetail();
	App::import('Model','TeacherStudentDetail');
	$this->TeacherStudentDetail  = & new TeacherStudentDetail();
	App::import('Model','TeacherPayment');
	$this->TeacherPayment        = & new TeacherPayment();
	
	
	//// fetch total student cancelled 
	
	//pr($this->data);
	$total_rev=0;$total_revenue=0;
	if(isset($this->data))
	 {
			
		
		$start_search           = $this->data['datestart'];
		$end_search             = $this->data['dateend'];
		if($this->data['datestart']=='start' || $this->data['dateend']=='end')
		{
			 $condition_rev='';
			 $condition_cancel='';	
			$condition='';
		}		
		else
		{	
			$condition=array('type'=>'0','created BETWEEN ? and ?'=>array($start_search, $end_search));	
			$condition_cancel=array('type'=>0,'cancel_date BETWEEN ? and ?'=>array($start_search, $end_search));
			$condition_rev=array('payment_date BETWEEN ? and ?'=>array($start_search, $end_search));
		}
		$total_revenue          = $this->TeacherPayment->find('all',array('conditions'=>$condition_rev));
		

		foreach($total_revenue as $total_income)
		{

			$total_rev      +=$total_income['TeacherPayment']['amount'];
		}
		//$total_student_cancel    = $this->CancelDetail->find('count',array('conditions'=>array('type'=>1,'cancel_date BETWEEN ? and ?'=>array($start_search, $end_search))));
		
		$total_teacher_cancel    = $this->CancelDetail->find('count',array('conditions'=>$condition_cancel));

		//$condition_student       =array('type'=>'1','created BETWEEN ? and ?'=>array($start_search, $end_search));
		//$student_total           =$this->paginate('User', $condition_student);
		
		//$teacher_total           =$this->User->find('all',array('conditions'=>array('type'=>'0','created BETWEEN ? and ?'=>array($start_search, $end_search))));
		
		$teacher_total  = $this->paginate('User', $condition);
		$condition_payment=array('TeacherPayment.payment_date BETWEEN ? and ?'=>array($start_search, $end_search));
		 if($this->data['datestart']=='start' || $this->data['dateend']=='end'){ $condition_payment='';}
	 }
	else
	 {	
                $start_search           = '';
		$end_search             ='';
		$total_rev1 = $this->TeacherPayment->find('all');
		foreach($total_rev1 as $total_income)
		{

			$total_rev      +=$total_income['TeacherPayment']['amount'];
		}
                $total_student_cancel='0';$total_teacher_cancel='0';
		//$total_student_cancel    = $this->CancelDetail->find('count',array('conditions'=>array('type'=>1)));
		
		$total_teacher_cancel    = $this->CancelDetail->find('count',array('conditions'=>array('type'=>0)));
		
	
		$condition=array('type'  =>'0');
		$teacher_total           = $this->paginate('User', $condition);
		$condition_student               =array('type'=>'1');
		//$student_total           =$this->paginate('User', $condition_student);
		$condition_payment='';
		
	 }

		$this->set('total_rev',$total_rev);
		//$this->set('total_student_cancel',$total_student_cancel);
		$this->set('total_teacher_cancel',$total_teacher_cancel);


		//$student_total         = $this->User->find('count',array('conditions'=>array('type'=>'1')));    // total student sign ups
		
	$teacher_total;  // fetch  total number of teacher

	$this->set('teacher_total',$teacher_total);
	//$this->set('student_total',$student_total);
	
	
	$this->User->bindModel(                          
              array('hasMany'        => array(
                   'TeacherStudentDetail'=> array(
                   'conditions'      => '',
                   'order'           => '',
                   'fields'          => '',
                   'foreignKey'      => 'tid',
                   'dependent'       => true
                   ),
		
                   'TeacherPayment'=> array(
                   'conditions'      =>$condition_payment,
                   'order'           => '',
                   'fields'          =>'',
                   'foreignKey'      => 'tid',
                   'dependent'       => true
                )
		
	)), false);        

$all=$this->User->find('all');
$arr = array();
foreach ($all as $all1)   
    {
     if($all1['TeacherPayment'])
      {
         //pr($all1['TeacherPayment']);
         foreach($all1['TeacherPayment'] as $value1)
		{
		 
		  if(array_key_exists( $value1['tid'], $arr))
		    {
			   $tid= $value1['tid'];
		           $amount= $arr[$value1['tid']]['amount']+$value1['amount'];
			   $arr[$tid]['amount']=$amount;
			   $count= $arr[$value1['tid']]['count']+1;
			   $arr[$tid]['count']=$count;
			 
		    }
		  else
		    {
			   $tid=$value1['tid'];
		           $arr[$tid]['amount']=$value1['amount'];
			   $arr[$tid]['count']=1;	 
		   
		    }			 	
		  
		}   
       
      }
    }
    
      $profit='';
     foreach($arr as $key=>$value)
	{
	   
            if($key['count']<=7)
	     { 
	       	$amount = $value['amount'];
		$amountT =	(12*$amount)/100;
		$profit+=$amountT;
		
	     }
	   else if($key['count']<=15)
		{
		$amount1 = $value['amount'];
		$amountT =	(10*$amount)/100;
 	        $profit+=$amountT;
			
		}
           else if($key['count']<=60)
		{
		  $amount1 = $value['amount'];
		  $amountT =	(8*$amount)/100;
		  $profit+=$amountT;
                }
	   else
               {

               } 
 		
           	
	}
         $profit1=$profit;
         $total_teacher_profit=$total_rev-$profit1;
         $this->set('total_teacher_profit',$total_teacher_profit);
         $this->set('profit1',$profit1);
//        foreach ($all1['TeacherPayment'] as $all2){ pr($all2);}}
	
        $arr = array();
	
	$teacher          = $this->TeacherPayment->find('all', array('conditions'=>array('payment_date BETWEEN ? and ?'=>array($start_search, $end_search))));//,array('conditions'=>));

	
//pr($teacher);die;
	foreach($teacher as $value)
	{
		foreach($value['TeacherPayment'] as $value1)
		{
		 
		  if(array_key_exists( $value1['tid'], $arr))
		    {
			   $tid= $value1['tid'];
		           $amount= $arr[$value1['tid']]['amount']+$value1['amount'];
			   $arr[$tid]['amount']=$amount;
			   $count= $arr[$value1['tid']]['count']+1;
			   $arr[$tid]['count']=$count;
			 
		    }
		  else
		    {
			   $tid=$value1['tid'];
		           $arr[$tid]['amount']=$value1['amount'];
			   $arr[$tid]['count']=1;	 
		   
		    }			 	
		  
		}
	}
     $profit='';
     foreach($arr as $key=>$value)
	{
	   
            if($key['count']<=7)
	     { 
	       	$amount = $value['amount'];
		$amountT =	(12*$amount)/100;
		$profit+=$amountT;
		
	     }
	   else if($key['count']<=15)
		{
		$amount1 = $value['amount'];
		$amountT =	(10*$amount)/100;
 	        $profit+=$amountT;
			
		}
           else if($key['count']<=60)
		{
		  $amount1 = $value['amount'];
		  $amountT =	(8*$amount)/100;
		  $profit+=$amountT;
                }
	   else
               {

               } 
 		
           	
	}

	//$this->set('total_student_cancel',$total_student_cancel);
	///$this->set('student_total', $student_total);
	$this->set('profit', $profit); 
	
        $teacher_detail = $this->User->find('all',array('conditions'=>array('type'=>'0')));   
        $this->set('teacher_detail',$teacher_detail);  
  // pr( $teacher_detail);die;
}
// end of global detail function for lessonshark


function admin_student() // function to find total sign up student, total cancel student, total profit of lessonshark
{

	$this->pageTitle             = __('Admin: Users Management', true);
	$this->layout                = "admin";
	App::import('Model','CancelDetail');
	$this->CancelDetail          = & new CancelDetail();
	App::import('Model','TeacherStudentDetail');
	$this->TeacherStudentDetail  = & new TeacherStudentDetail();
	App::import('Model','TeacherPayment');
	$this->TeacherPayment        = & new TeacherPayment();
	
	
	//// fetch total student cancelled 
	
	//pr($this->data);
	$total_rev=0;$total_revenue=0;
	if(isset($this->data))
	 {
			
		
		$start_search           = $this->data['datestart'];
		$end_search             = $this->data['dateend'];
		$total_revenue          = $this->TeacherPayment->find('all',array('conditions'=>array('payment_date BETWEEN ? and ?'=>array($start_search, $end_search))));
		if($this->data['datestart']=='start' || $this->data['dateend']=='end' )
		{
			 $condition_rev='';
			 $condition_cancel='';	
			 $condition='';
			 $condition_student='';
		}		
		else
		 {
			$condition=array('type'=>1,'cancel_date BETWEEN ? and ?'=>array($start_search, $end_search));
			$condition_student       =array('type'=>'1','created BETWEEN ? and ?'=>array($start_search, $end_search));	
		 }	

		foreach($total_revenue as $total_income)
		{

			$total_rev      +=$total_income['TeacherPayment']['amount'];
		}
		$total_student_cancel    = $this->CancelDetail->find('count',array('conditions'=>$condition));
		
		

		
		$student_total           =$this->paginate('User', $condition_student);
		
		//$teacher_total           =$this->User->find('all',array('conditions'=>array('type'=>'0','created BETWEEN ? and ?'=>array($start_search, $end_search))));
		//$condition=array('type'=>'0','created BETWEEN ? and ?'=>array($start_search, $end_search));
		//$teacher_total  = $this->paginate('User', $condition);

		 
	 }
	else
	 {	$start_search           = '';
		$end_search             ='';
		$total_rev1 = $this->TeacherPayment->find('all');
		foreach($total_rev1 as $total_income)
		{

			$total_rev      +=$total_income['TeacherPayment']['amount'];
		}
		$total_student_cancel    = $this->CancelDetail->find('count',array('conditions'=>array('type'=>1)));
		
		$total_teacher_cancel    = $this->CancelDetail->find('count',array('conditions'=>array('type'=>0)));
		
	
		//$condition=array('type'  =>'0');
		//$teacher_total           = $this->paginate('User', $condition);
		$condition_student               =array('type'=>'1');
		$student_total           =$this->paginate('User', $condition_student);
	
		
	 }

		$this->set('total_rev',$total_rev);
		$this->set('total_student_cancel',$total_student_cancel);
		

		//$student_total         = $this->User->find('count',array('conditions'=>array('type'=>'1')));    // total student sign ups
		
	//$teacher_total;  // fetch  total number of teacher

	//$this->set('teacher_total',$teacher_total);
	$this->set('student_total',$student_total);
}



function admin_showStat($id)  // function to show stat chart based on teacher
{	
	
	$this->pageTitle  = __('Admin: Users Management', true);
	$this->layout     = "admin";
	App::import('Model','TeacherStudentDetail');            
    	$this->TeacherStudentDetail = & new TeacherStudentDetail();

	App::import('Model','TeacherPayment');
    	$this->TeacherPayment = & new TeacherPayment();
	
        
	$this->User->bindModel(                          
              array('hasMany'        => array(
                   'TeacherStudentDetail'=> array(
                   'conditions'      => '',
                   'order'           => '',
                   'fields'          => '',
                   'foreignKey'      => 'tid',
                   'dependent'       => true
                   ),
		
                   'TeacherPayment'=> array(
                   'conditions'      => '',
                   'order'           => '',
                   'fields'          =>'',
                   'foreignKey'      => 'tid',
                   'dependent'       => true
                )
		
	)), false);            // used bind model to make relationship betwen User ,TeacherStudentDetail,TeacherPayment table.



	

	$teacher      = $this->User->find('all',array('conditions'=>array('type'=>'0','id'=>$id)));
        $count_student=0; $teacher_income=0;
	foreach($teacher as $teacher1) 
	{ 
		foreach($teacher1['TeacherStudentDetail']as $teacher2 ) // fetch total student according to  teacher id
		   {    
			$count_student++;  
		   }
		   foreach($teacher1['TeacherPayment']as $teacher_payment )  // fetch total income according to  teacher id
                   {  
			  $teacher_income=$teacher_payment['amount'];
			 
		   }	
        }
      
         
	if($count_student<=7)
	     { 
	       	$amount = $teacher_income;
		$amountT =	(88*$amount)/100;
		
		$teacher_profit=$amountT;
	     }
	   else if($count_student<=15)
		{
		$amount1 = $teacher_income;
		$amountT =	(90*$amount)/100;
 	        $teacher_profit=$amountT;
			
		}
           else if($count_student<=60)
		{
		  $amount1 = $teacher_income;
		  $amountT =	(92*$amount)/100;
		  $teacher_profit=$amountT;
                }
	   else
               {

               } 

	
        $this->set('teacher_profit', $teacher_profit);// teacher's profit
        $this->set('count_student', $count_student);// count student based on teacher id
	$this->set('teacher', $teacher);
	$student_detail_date      = $this->TeacherStudentDetail->find('all',array('conditions'=>array('tid'=>$id)));
	$count_this_month_student =0;
	$count_last_month_student =0;

 foreach($student_detail_date as $student)
	{
         
	 $student_record   = $this->User->find('all',array('conditions'=>array('id'=>$student['TeacherStudentDetail']['stid'])));
         foreach($student_record as $student_record1)
             { 
		$timestamp        = strtotime($student_record1['User']['created']);  //user sign up date
		$date1            = date('d-m-Y', $timestamp);
		$firstday         = date("m/d/Y", strtotime(date('m').'/01/'.date('Y').' 00:00:00'));  //first day of month
		$firstday1        = strtotime($firstday);
		
		$currentday       = strtotime(date("d-m-Y"));  //current day
	
		$last_month_last  =date("Y-m-t", strtotime("-1 month") ) ;   // fetch last day of last month
		$last_month_first = date("Y-m-1", strtotime("-1 month") ) ; // fetch first day of last month
		$last_month_first1=strtotime($last_month_first);  // fetch first day of last month
		$last_month_last1 =strtotime($last_month_last); // fetch last day of last month

		if($timestamp>=$last_month_first1 && $timestamp<=$last_month_last1 )
		  {
			$count_last_month_student++;
		  }
		if($timestamp>=$firstday && $timestamp<=$currentday )
		 {
		   $count_this_month_student++;
		 }
             }
	}

	  $this->set('count_this_month_student', $count_this_month_student); 
	  $this->set('count_last_month_student', $count_last_month_student);
	
        //code for fetching data of teacher prfofie and calculating % of teacher profile completed
	App::import('Model','TeacherDesciplineField');            
    	$this->TeacherDesciplineField = & new TeacherDesciplineField();
	$discipline      = $this->TeacherDesciplineField->find('count',array('conditions'=>array('tid'=>$id)));
	
	
	App::import('Model','TeacherMedia');            
    	$this->TeacherMedia = & new TeacherMedia();
	$media      = $this->TeacherMedia->find('count',array('conditions'=>array('tid'=>$id)));
	
	App::import('Model','TeacherLocation');            
    	$this->TeacherLocation = & new TeacherLocation();
	$location      = $this->TeacherLocation->find('count',array('conditions'=>array('tid'=>$id)));
	
	
	App::import('Model','TeacherAvailability');            
    	$this->TeacherAvailability = & new TeacherAvailability();
	$availability      = $this->TeacherAvailability->find('count',array('conditions'=>array('tid'=>$id)));
	

	App::import('Model','TeacherExperience');            
    	$this->TeacherExperience = & new TeacherExperience();
	$experience      = $this->TeacherExperience->find('count',array('conditions'=>array('tid'=>$id)));
	
	

	App::import('Model','TeacherPolicy');            
    	$this->TeacherPolicy = & new TeacherPolicy();
	$policy      = $this->TeacherPolicy->find('count',array('conditions'=>array('tid'=>$id)));
	
	$profile_complete=0;
	if($discipline>0)
	 {
	   $profile_complete+=25;
	 }
	if($media>0)
	 {
	   $profile_complete+=15;
	 }
	if($location>0)
	 {
	   $profile_complete+=15;
	 }
	if($availability>0)
	 {
	   $profile_complete+=15;
	 }
	if($experience>0)
	 {
	   $profile_complete+=15;
	 }
	if($policy>0)
	 {
	   $profile_complete+=15;		
	 }
	$this->set('profile_complete', $profile_complete);
      //echo $count_this_month_student;echo $count_last_month_student;
 }  // end of function that is used for showing stat of teacher


function admin_teacherManagement() 
{
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

function admin_add() 
 {

     //If AJAX call has been made 
  if ( $this->RequestHandler->isAjax() )
       {
         if ( !empty( $this->data ) ) 
          {
	
		 $this->data['User']['password'] = md5($this->data['User']['password']);  
		 $this->User->set($this->data);
		  if ($this->User->validates(array('fieldList' => array('username','password','firstname','lastname'))) ) 
		   { 	
			$this->data['User']['username'] = $this->data['User']['username'];

			$this->data['User']['password'] = md5($this->data['User']['password']);	

			$this->data['User']['firstname'] = $this->data['User']['firstname'];	

			$this->data['User']['lastname'] = $this->data['User']['lastname'];	

			$this->data['User']['email'] = $this->data['User']['email'];	

			$this->data['User']['zip'] = $this->data['User']['zip'];	
		        $this->data['User']['type'] ='1';	
		        

			$this->User->save($this->data ,false);
			$this->set('message', 'Student has been saved');
			$this->render('admin_add', 'ajax');
		    }
		 else
		    {
			   $errorMessage="";		
		           $errors = $this->User->invalidFields(array('fieldList' => array('username','password','firstname','lastname',)));
		           foreach ($errors as $val) 
				{
		                  $errorMessage .= '<li>'.$val.'</li>';
		         	}
		        $this->set('message', $errorMessage);
		        $this->render('admin_add', 'ajax');
		            
		    }//END: Else IF			

		

          
          }//End: DATA check
       }//End: AJAX If
 
 } // end of function add 


	  function admin_addTeacher() {  
                
	     //If AJAX call has been made 
	   if ( $this->RequestHandler->isAjax() ) {
         if ( !empty( $this->data ) ) {
	
         $this->data['User']['password'] = md5($this->data['User']['password']);  
	 $this->User->set($this->data);
	  if ($this->User->validates(array('fieldList' => array('username','password','firstname','lastname'))) ) 
           { 	
		$this->data['User']['username'] = $this->data['User']['username'];

		$this->data['User']['password'] = md5($this->data['User']['password']);	

		$this->data['User']['firstname'] = $this->data['User']['firstname'];	

		$this->data['User']['lastname'] = $this->data['User']['lastname'];	

		$this->data['User']['email'] = $this->data['User']['email'];	

		$this->data['User']['zip'] = $this->data['User']['zip'];	
                $this->data['User']['type'] ='0';	
                

		 $this->User->save($this->data ,false);
                 $this->set('message', 'Teacher has been saved');
                 $this->render('admin_add', 'ajax');
            }

		   else
		        {
			   $errorMessage="";		
		           $errors = $this->User->invalidFields(array('fieldList' => array('username','password','firstname','lastname',)));
		          foreach ($errors as $val) {
		              $errorMessage .= '<li>'.$val.'</li>';
		       	 }
                      //pr($errorMessage);die;
		        $this->set('message', $errorMessage);
		        $this->render('admin_addTeacher', 'ajax');
		            
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
		 if ($this->User->validates(array('fieldList' => array('password','firstname','lastname'))) ) 
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

	//Search by ...  (anyfield)

	foreach ( $this->data['User'] AS $key=>$value ){

	if ( !empty($value) ){

	$condition[] .= $key. ' LIKE "%'.$value.'%" ';

	}

	} 
       
       // $condition[] .= $key. '= '.$value.' ';
       // print_r($condition);
	$this->Session->write('condition', $condition);
       
	

	}//End: Check Submission



	$this->Session->check('condition') ? $condition = $this->Session->read('condition'):'' ;
	$condition[].= 'type="1"';

	//fetches paged results

	$data = $this->paginate('User', $condition);



	$this->set('data', $data);

	$this->render('admin_search', 'ajax');

	//}

	}	

    function admin_searchTeacher()
         { 
        //AJAX request


	//if ( $this->RequestHandler->isAjax() ) {

	$condition = array();

	//If Data submitted through search form

	if( !empty($this->data) ) {

	//Search by ...  (anyfield)

	foreach ( $this->data['User'] AS $key=>$value ){

	if ( !empty($value) ){

	$condition[] .= $key. ' LIKE "%'.$value.'%" ';

	}

	} 
       
       // $condition[] .= $key. '= '.$value.' ';
       // print_r($condition);
	$this->Session->write('condition', $condition);

	

	}//End: Check Submission



	$this->Session->check('condition') ? $condition = $this->Session->read('condition'):'' ;
	$condition[].= 'type="0"';

	//fetches paged results

	$data = $this->paginate('User', $condition);



	$this->set('data', $data);

	$this->render('admin_searchTeacher', 'ajax');

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
     	  $this->layout     = "admin";
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
			 $this->redirect('/'); 

                }	
                else
                {
			
                    $errors = $this->User->invalidFields(array('fieldList' => array('username','password','firstname','lastname','email','country','state','city', 'phone')));
                    $this->User->set('errors',$errors);
                    
                }//END: Else IF			
   	}

}

}
?>
