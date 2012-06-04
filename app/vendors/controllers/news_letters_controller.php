<?php       
class NewsLettersController extends AppController {


	var $name = 'NewsLetters';
 
    var $helpers = array('Html','Ajax','Javascript','Form','Session');
 /*
 *  Component used by the Controller
 **/
    var $components = array('RequestHandler','Image','Cookie','Session','Email');//,'GeoIp');
//Pagination configuration
var $paginate = array(
        'limit' => 10
      /* order' => array(
            'User.lname' => 'asc' )
        ) */
    );
	
	
  function submitEmail()
  {
    $this->layout     = "front_default";
  }
  
  function submitEmailCheck()
  {
    if ($this->RequestHandler->isAjax()) 
    {   
       // $eidExist = $this->NewsLetter->findByNEmail($this->data['NewsLetter']['n_email']);  
         
        $eidExist = $this->NewsLetter->find('all', array('conditions'=>array('n_email'=>$this->data['NewsLetter']['n_email']))); 
    //echo '<pre>';print_r($this->data);die;
        if($this->data['NewsLetter']['n_email']=='')
        {
           echo 'Please Enter your Email Address';
        }
        else if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $this->data['NewsLetter']['n_email']))
        {
           echo 'Please Enter Valid email Address';
        }
        else if(!empty($eidExist))
        {
           echo 'Email address already exist in our database';
        }
        else{
          $notifyData['NewsLetter']['n_email'] = $this->data['NewsLetter']['n_email'];
          $notifyData['NewsLetter']['n_status'] = '1';
          
          $this->NewsLetter->save($notifyData);          
        }
    }
	die;
  } 
   function show()
  {
       $this->layout     = "front_default";
    
  }       
}
?>