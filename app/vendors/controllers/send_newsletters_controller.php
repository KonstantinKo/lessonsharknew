<?php
class SendNewslettersController extends AppController {


	var $name = 'SendNewsletters';
  var $primaryKey = 'id'; 
 /*
 *  Helper used by the Controller
 **/    
    var $helpers = array('Html','Ajax','Javascript','Form','Session');
 /*
 *  Component used by the Controller
 **/
    var $components = array('RequestHandler','Image','Cookie','Session','Email'); 
 
    var $paginate = array('limit' => 10);


//Function is used to send newsletter
	function admin_send(){
	
	  $this->checkSessionAdmin('Admin');   
      
    $this->layout = 'admin'; 
    App::import('Model','NewsLetter');
    $this->NewsLetter = & new NewsLetter();
    $allEmails = $this->NewsLetter->find('all');    
    $this->set('allEmails',$allEmails);
    
   
    
  	if(!empty($this->data))
  	{
      $this->SendNewsletter->set($this->data);
       if ( $this->SendNewsletter->validates(array('fieldList' => array('n_subject','n_description')))) 
        {    
            
          $this->data['SendNewsletter']['n_subject']       = $this->data['SendNewsletter']['n_subject'];
          $this->data['SendNewsletter']['n_description']   = $this->data['SendNewsletter']['n_description'];
          
          
          foreach($this->data['SendNewsletters']['chkbox'] as $data)
          {
              $emailId = $this->NewsLetter->find('all', array('conditions'=>array('id'=>$data)));   
              $emailTO = $emailId[0]['NewsLetter']['n_email'];
                              
              $this->Email->from = 'Trade Folio <no@reply.com>';
              $this->Email->to = $emailTO;
              $this->Email->subject = $this->data['SendNewsletter']['n_subject'];
              $mailContent = $this->data['SendNewsletter']['n_description'];
              $this->Email->send($mailContent);
                           
          } 
        
          $this->SendNewsletter->save($this->data);
          $this->Session->setFlash("Email send Sucessfully");
          $this->redirect(array('controller'=>'SendNewsletters','action'=>'send','admin'=>true));
        
        }
        else
        {
            $errors = $this->SendNewsletter->invalidFields(array('n_subject','n_description'));
            $this->SendNewsletter->set('errors',$errors);
            
        }
      }
     
 
	}
	function submitEmail()
 {
   $this->layout     = "front_default";
 }
 
  function show()
  {
       $this->layout     = "front_default";
    
  }   
 
 function submitEmailCheck()
 {
     $this->layout = 'admin'; 
    App::import('Model','NewsLetter');
    
   if ($this->RequestHandler->isAjax())
   {  
       $eidExist = $this->NewsLetter->findByNEmail($this->data['NewsLetter']['n_email']);
   //echo '<pre>';print_r($this->data);die;
       if($this->data['SendNewsletters']['n_email']=='')
       {
          echo 'Please Enter your Email Address';
       }
       else if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $this->data['SendNewsletters']['n_email']))
       {
          echo 'Please Enter Valid email Address';
       }
       else if(!empty($eidExist))
       {
          echo 'Email address already exist in our database';
       }
       else{
         $notifyData['SendNewsletters']['n_email'] = $this->data['SendNewsletters']['n_email'];
         $notifyData['SendNewsletters']['n_status'] = '1';
         
         $this->NewsLetter->save($notifyData);          
       }
   }
       die;
 }

  
}
?>
