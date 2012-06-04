<?php
class ApplicationsController extends AppController {
  var $name = 'Applications';
    
  //no models here
  var $uses = array();
 	// var $components = array('Route');
 /*
  * Helper used by the Controller
 **/    
 var $helpers = array('Html','Ajax','Javascript','Form');

 /*
  * Components used by the Controller
 **/


	function privacy() 
	{
		$this->layout="front_default";
		
		$this->set("title_for_layout",'Privacy Policy - LessonShark');        
  }
    
	function terms() 
	{
    $this->layout="front_default";
		
		$this->set("title_for_layout",'Terms of Use - LessonShark'); 
  }
}