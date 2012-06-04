<?php
class GaragesController extends AppController {


	var $name = 'Garage';
  var $primaryKey = 'id'; 
 /*
 *  Helper used by the Controller
 **/    
    var $helpers = array('Html','Ajax','Javascript','Form','Session');
 /*
 *  Component used by the Controller
 **/
    var $components = array('RequestHandler','Image','Cookie','Session','Email'); 
   // var $uses 		= array('Category','User','UserCategory','AreaLimit','City','Stores','Content','TempStore','TempStoreCategory','TempStoreLocation','StoreCategory','StoreLocation','EmailManagement');
    
    
    //Pagination configuration
    /*var $paginate = array(
            'limit' => 10,
            'order' => array(
                'Store.created' => 'desc'
            )
        );*/
        var $paginate = array('limit' => 10);

############################################# START: FRONT END ################################

  function index()
   {   
     $this->layout = 'front_default';
     App::import('Model','Store');  
     $this->Store = & new Store();
     
     $this->Session->write('selectedMenu','location');
     
     //To find the zip code details of each City
     App::import('Model','City');
     $this->City = & new City();
 
     
     if(!empty($this->data))
     {
       
        $userSearchedZip = $this->City->findByZip($this->data['Store']['search']) ;
        
    /*    echo "<pre>";
         print_r($userSearchedZip);
         echo "</pre>";
         die('here') ; */
		
    		$this->Session->write('trackedDetails.country_code','');
    		$this->Session->write('trackedDetails.country_code3','');
    		$this->Session->write('trackedDetails.country_name',$userSearchedZip['City']['county']);
    		$this->Session->write('trackedDetails.region','');
    		$this->Session->write('trackedDetails.city',$userSearchedZip['City']['city']);
    		$this->Session->write('trackedDetails.postal_code',$userSearchedZip['City']['zip']);
    		$this->Session->write('trackedDetails.latitude',$userSearchedZip['City']['latitude']);
    		$this->Session->write('trackedDetails.longitude',$userSearchedZip['City']['longitude']);
    		$this->Session->write('trackedDetails.area_code','');
    		$this->Session->write('trackedDetails.dma_code','');
    		$this->Session->write('trackedDetails.metro_code','');
    		$this->Session->write('trackedDetails.continent_code','');
		
        $this->Store->bindModel(array('hasOne'=>array(
        'City'=>array('conditions' => 'City.zip=Store.s_zip', 'type' => 'INNER', 'fields' => '','foreignKey' => '0'),)), false);
        
        $storeDetails = $this->Store->find('all',array('order'=>'Store.id ASC'));
        $val=array();
       
        foreach($storeDetails as $key=>$allDetails)
        {
           
           $val[$key]['nearestStore']  = $this->distance($allDetails['City']['latitude'], $allDetails['City']['longitude'],$userSearchedZip['City']['latitude'], $userSearchedZip['City']['longitude'], "m");
           
           $val[$key]['storeDetails'] = $allDetails;
           
        }
        $fnArr=array();
        
        
        $fnArr = $this->array_sort($val, 'nearestStore', SORT_ASC); // Sort by oldest first
        
        //to find the first three nearest Stores
        $arrChk=array_chunk($fnArr,3);

        $this->Session->write('shortestStoreDetails',$arrChk[0][0]['storeDetails']);
        $this->set('storeDetail',$arrChk[0]);
        
     }  
     else
     {
    		if($this->Session->read('trackedDetails.postal_code')!=''){
    		        
    			$userSearchedZip = $this->City->findByZip($this->Session->read('trackedDetails.postal_code')) ;
    		}
    		else
    		{

    			$userSearchedZip = $this->City->findByCity($this->Session->read('trackedDetails.city'));

    			
    			$this->Session->write('trackedDetails.postal_code',$userSearchedZip['City']['zip']);
    		}
        
        $this->Store->bindModel(array('hasOne'=>array(
        'City'=>array('conditions' => 'City.zip=Store.s_zip', 'type' => 'INNER', 'fields' => '','foreignKey' => '0'),)), false);
        
        $storeDetails = $this->Store->find('all',array('order'=>'Store.id ASC'));
         
        $val=array();
        
        foreach($storeDetails as $key=>$allDetails)
        {
           
           $val[$key]['nearestStore']  = $this->distance($allDetails['City']['latitude'], $allDetails['City']['longitude'],$userSearchedZip['City']['latitude'], $userSearchedZip['City']['longitude'], "m");
           
           $val[$key]['storeDetails'] = $allDetails;
           
        }
        $fnArr=array();
        
         
        $fnArr = $this->array_sort($val, 'nearestStore', SORT_ASC); // Sort by oldest first
        //to find the first three nearest Stores
        $arrChk=array_chunk($fnArr,3);
        
        //$storeDetails = $this->Store->find('all',array('limit'=>1));
        $this->set('storeDetail',$arrChk[0]);  
       
     }
  
   }
/*Get the neareast store for geta quote pop up*/
  function getStorePop($zip)
   {   
	
     $this->layout = 'Ajax'; 
     App::import('Model','Store');  
     $this->Store = & new Store();
       
     //To find the zip code details of each City
     App::import('Model','City');
     $this->City = & new City();
	
        $userSearchedZip = $this->City->findByZip($zip) ;
 	
        $this->Store->bindModel(array('hasOne'=>array(
        'City'=>array('conditions' => 'City.zip=Store.s_zip', 'type' => 'INNER', 'fields' => '','foreignKey' => '0'),)), false);
        
        $storeDetails = $this->Store->find('all',array('order'=>'Store.id ASC'));
        $val=array();
       
        foreach($storeDetails as $key=>$allDetails)
        {
           
           $val[$key]['nearestStore']  = $this->distance($allDetails['City']['latitude'], $allDetails['City']['longitude'],$userSearchedZip['City']['latitude'], $userSearchedZip['City']['longitude'], "m");
           
           $val[$key]['storeDetails'] = $allDetails;
           
        }
        
        $fnArr = $this->array_sort($val, 'nearestStore', SORT_ASC); // Sort by oldest first
        
        //to find the first three nearest Stores
        $arrChk = array_chunk($fnArr,1);

     // pr($arrChk[0][0]);die;
	
	echo "<div class='left_container'>";
	  	echo "<p class='text'>Blossman Gas in ".$arrChk[0][0]['storeDetails']['Store']['s_city'].', '.$arrChk[0][0]['storeDetails']['Store']['s_state']."</p>";
	  	echo "<p class='text'>".$arrChk[0][0]['storeDetails']['Store']['s_address']."</p>";
	  	echo "<p class='text'>".$arrChk[0][0]['storeDetails']['Store']['s_city'].", ".$arrChk[0][0]['storeDetails']['Store']['s_state']." ".$arrChk[0][0]['storeDetails']['Store']['city_id']." </p><div class='clr'></div>";
		echo "<p class='text'>Ph ".$arrChk[0][0]['storeDetails']['Store']['s_phone']."</p>";
		echo "<p class='text'>Fax ".$arrChk[0][0]['storeDetails']['Store']['s_fax']."</p>";
	echo "</div>";
	echo "<div class='right_container'>";
		echo "<p class='text_rr'>Hours:8 a.m to 5 p.m.M-F</p>";
		echo "<p class='text_rr'>";
		 if(!empty($arrChk[0][0]['storeDetails']['Store']['s_email']))
                 {
                	echo $arrChk[0][0]['storeDetails']['Store']['s_email'];
                                   }
                  else
                 {
                    echo "foley@blossmangas.com";
                  }
  			
		echo "</p>";


		echo "<div class='view_main'>";

		echo "<a href='/stores/storeDetails/".base64_encode($arrChk[0][0]['storeDetails']['Store']['id'])."' class='view_text'>VIEW STORE PAGE</a>";




		echo "<div class='arrow_img'><img src='/img/images/arrow_nav.png' width='10' height='13'/></div>";
	 	echo "</div>";
	
		echo "<div class='view_main'>";
			echo "<a href='/stores/storeDirections/".base64_encode($arrChk[0][0]['storeDetails']['Store']['id'])."' class='view_textuu'>GET DIRCTIONS</a>";
			echo "<div class='arrow_img'><img src='/img/images/arrow_nav.png' width='10' height='13'/></div><div class='clr'></div>";
		echo "</div>";
	
	echo "</div>";
	

 
	die();
  
   }

/*End Get the neareast store for geta quote pop up*/
       
   /**
   * function getStoreDistance
   * return distance between two zip codes with google API
   *
   */
    function getStoreDistance($strId = NULL)
    {
      $this->layout = '';
      
      if ( isset($this->params['id'])){
        $strId = $this->params['id'];
      }

      $this->set('strId',$strId);      
    }   
       
       
   /**
   * function distance
   * return the straight distance between two zipcodes
   *
   */               
   function distance($lat1, $lon1, $lat2, $lon2, $unit) { 
 
      $theta = $lon1 - $lon2; 
      $dist = SIN(DEG2RAD($lat1)) * SIN(DEG2RAD($lat2)) +  COS(DEG2RAD($lat1)) * COS(DEG2RAD($lat2)) * COS(DEG2RAD($theta)); 
      $dist = ACOS($dist); 
      $dist = RAD2DEG($dist); 
      $miles = $dist * 60 * 1.1515;
      $unit = STRTOUPPER($unit);
     
      IF ($unit == "K") {
        RETURN ($miles * 1.609344); 
      } ELSE IF ($unit == "N") {
          RETURN ($miles * 0.8684);
        } ELSE {
            RETURN $miles;
          }
    }
 
 //to sort a multidimenssional array   
   function array_sort($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();
    
        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }                                   
                } else {
                    $sortable_array[$k] = $v;
                }
            }
    
            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                break;
                case SORT_DESC:
                    arsort($sortable_array);
                break;
            }
    
            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }
    
        return $new_array;
    }
    
   function storeDetails($id = NULL)
   {
     //echo '<pre>';print_r($this->Session->read());die;
     $this->layout = 'front_default';
     
     $strId = base64_decode($id);
     
     $this->Store->bindModel(array('hasOne'=>array(
        'City'=>array('conditions' => 'City.zip=Store.s_zip', 'type' => 'INNER', 'fields' => '','foreignKey' => '0'),)), false);
    
     $storeDetails = $this->Store->findById($strId);
     //echo '<pre>';print_r($storeDetails);die;
     $this->set('storeDetails',$storeDetails);
      
   }
   
   function storeDirections($id = NULL)
   {
     $this->layout = 'front_default';
     
     $strId = base64_decode($id);
     
     $this->Store->bindModel(array('hasOne'=>array(
        'City'=>array('conditions' => 'City.zip=Store.s_zip', 'type' => 'INNER', 'fields' => '','foreignKey' => '0'),)), false0);
    
     $storeDetails = $this->Store->findById($strId);
     
	// echo '<pre>';print_r($this->Session->read());die;
     $this->set('storeDetails',$storeDetails);
   
   }
  
############################################# END: FRONT ######################################


############################################# START: ADMIND ###################################

//Function to display all posts
	function admin_view(){
	
	    $this->checkSessionAdmin('Admin'); 
	    App::import('Model','Garage');
    	    $this->Garage = & new Garage();   

	   // $all = $this->Garage->find('all');	
			// Allow only authenticated users to access this action.
	       // $this->checkSessionAdmin();		
	
	    //Layout of the admin template
	    
			if( $this->RequestHandler->isAjax()  ){
				$this->layout 			= 'ajax';
			}else{
				$this->layout 			= 'admin';
			}	
	
	    $this->pageTitle 	    = 'Posts Management: View Stores';
	
	    $criteria				      = '';     
	    $data = $this->paginate('Garage'); // Extra parameters added
	   
	    $this->set('data',$data);         
	}

#___________________________________________________________

//Function to display all posts
function admin_add(){
	
 //   $this->checkSessionAdmin('Admin');
    
    $this->layout = 'admin'; 
  	if(!empty($this->data))
  	{
//pr($this->data);die;
	
	    $this->Garage->set($this->data);
	    
	       if ( $this->Garage->validates(array('fieldList' => array('garage_name'))) ) 
		{ 
	     
		  $this->data['Garage']['garage_id']         = $this->data['Garage']['garage_id'];
		  $this->data['Garage']['garage_name']       = $this->data['Garage']['garage_name'];
		  $this->data['Garage']['g_state']           = $this->data['Garage']['g_state'];
		  $this->data['Garage']['g_city']            = $this->data['Garage']['g_city'];
		  $this->data['Garage']['g_zip_code']        = $this->data['Garage']['g_zip_code'];
		  $this->data['Garage']['g_address']         = $this->data['Garage']['g_address'];
		  $this->data['Garage']['g_email']           = $this->data['Garage']['g_email'];
		  $this->data['Garage']['g_phone']           = $this->data['Garage']['g_phone'];

		  $this->data['Garage']['g_open']            = $this->data['Garage']['g_open'];
		  $this->data['Garage']['g_close']           = $this->data['Garage']['g_close'];
		  $this->data['Garage']['rate_hrs']          = $this->data['Garage']['rate_hrs'];
		  $this->data['Garage']['g_description']     = $this->data['Garage']['g_description'];
		  $this->data['Garage']['g_status']          = '1';
		 
		  
		  $this->Garage->save($this->data ,false);
		  $lastInsertedId = $this->Garage->getLastInsertId();
		  
		  /*$this->data['Image']['g_image']       = $this->data['Store']['g_image'];
		  $image_path = $this->Image->upload_image_and_thumbnail($this->data,'g_image',400,200,"uploads",true);
		 
		  $data['StoreImage']['image']          = $image_path;
		  $data['StoreImage']['status']         = '1'; 
		  $data['StoreImage']['store_id']       = $lastInsertedId;
		  
		 
		  $this->StoreImage->save($data); */
		  
		  $this->redirect(array('controller'=>'garages','action'=>'view',$lastInsertedId ,'admin'=>true));
		
		}
		else
		{ 
		    $errors = $this->Store->invalidFields(array('fieldList' => array('garage_name')));
		    $this->Store->set('errors',$errors);
		    
		}//END: Else IF
          }
        
   }

#____________________________________________________________________________________

	function admin_addSpace($id=null){
	
 //   $this->checkSessionAdmin('Admin');
    
	    $this->layout = 'admin'; 
	    $this->set('id',$id);	
	    App::import('Model','GarageAvailSpace');
  	    $this->GarageAvailSpace = & new GarageAvailSpace();	
	
	  	if(!empty($this->data))
	  	{

			/*echo "<pre>";
			print_r($this->data);
			echo "</pre>";die;*/

		    $this->GarageAvailSpace->set($this->data);
		    
		       if ( $this->GarageAvailSpace->validates(array('fieldList' => array('garage_name'))) ) 
			{ 
				  $garageId = $this->data['GarageAvailSpace']['garage_id'];
		     
				  $this->data['GarageAvailSpace']['full_address']         = $this->data['GarageAvailSpace']['full_address'];
				  $this->data['GarageAvailSpace']['facility_type']        = $this->data['GarageAvailSpace']['facility_type'];
				  $this->data['GarageAvailSpace']['status']               = $this->data['GarageAvailSpace']['status'];
				  $this->data['GarageAvailSpace']['space_id']             = $this->data['GarageAvailSpace']['space_id']; 	
				  $this->data['GarageAvailSpace']['location']             = $this->data['GarageAvailSpace']['location']; 
				  $this->data['GarageAvailSpace']['garage_id']            = $garageId;
			
				  $this->GarageAvailSpace->save($this->data ,false);
				  
				  $this->redirect(array('controller'=>'garages','action'=>'addSpace',$garageId ,'admin'=>true));
		
			}
			else
			{
			    $errors = $this->Store->invalidFields(array('fieldList' => array('garage_name')));
			    $this->Store->set('errors',$errors);
		                                                   	    
			}//END: Else IF
		  }

	    $this->pageTitle 	    = 'Posts Management: View Stores';
	
	    $criteria				      = '';     
	    $data = $this->paginate('GarageAvailSpace',array('GarageAvailSpace.garage_id'=>$id)); // Extra parameters added

	 
	    $this->set('data',$data);         

		
        
   }

function admin_addAvailSpace($id=NULL)
  {
  	echo $id;die('herererer');
    $this->checkSessionAdmin('Admin');
     //Layout of the admin template
    $this->layout = 'admin'; 
     $this->set('id',$id);
    App::import('Model','StoreImage');
    $this->StoreImage = & new StoreImage();
    $storeImages = $this->StoreImage->find('all', array('conditions'=>array('store_id'=>$id)));
    $this->set('images',$storeImages);
      
     $this->Store->set($this->data);
       if(!empty($this->data))
       {
         $storeID=$this->data['Store']['Sid'];
      // echo "<pre>";
      // print_r($this->data);exit;
         
         if ( $this->Store->validates(array('fieldList' => array('g_image')))) 
          {   
          
           $this->data['Image']['g_image']       = $this->data['Store']['g_image'];     
           $image_path = $this->Image->upload_image_and_thumbnail($this->data,"g_image",400,200,"uploads",true);
           
            $data['StoreImage']['image']          = $image_path;
            $data['StoreImage']['status']         = '0'; 
            $data['StoreImage']['store_id']       = $storeID;
         
            $this->StoreImage->save($data,false);
            $this->redirect(array('controller'=>'stores','action'=>'more_image',$storeID ,'admin'=>true)); 
         }
        }
        else
        {
            $errors = $this->Store->invalidFields(array('fieldList' => array('g_image')));
            $this->Store->set('errors',$errors);
            
        }//END: Else IF 
       }
    
    
        

	
      #_________________________________________________
function admin_addGarageImage($id=NULL)
  {
      $this->checkSessionAdmin('Admin');
      $this->layout = 'admin'; 
      $this->set('id',$id);	
      App::import('Model','GarageImages');
      $this->GarageImages = & new GarageImages();

      $garageImages = $this->GarageImages->find('all', array('conditions'=>array('garage_id'=>$id)));
      $this->set('images',$garageImages);
      
      
    
       if(!empty($this->data))
       {
	 App::import('Model','GarageImages');
     	 $this->GarageImages = & new GarageImages();
     
	 $this->GarageImages->set($this->data);
      // echo "<pre>";
      // print_r($this->data);exit;


         
         if ( $this->GarageImages->validates(array('fieldList' => array('g_image')))) 
          {   

           $this->data['Image']['g_image']       = $this->data['Image']['g_image'];     
           $image_path = $this->Image->upload_image_and_thumbnail($this->data,"g_image",400,200,"garageImages",true);
             $this->data['GarageImages']['image']          = $image_path;
            $this->data['GarageImages']['garage_id']       = $id;

            $this->GarageImages->save($this->data,false);


            $this->redirect(array('controller'=>'garages','action'=>'addGarageImage',$id ,'admin'=>true)); 
         }
        }
        /*else
        {
            $errors = $this->Store->invalidFields(array('fieldList' => array('g_image')));
            $this->Store->set('errors',$errors);
            
        }//END: Else IF */
       }
     
          
      
     //Layout of the admin template
 
        
  
      #_________________________________________________
      
  /**
   *   This function is used to edit child page
   *   Return    
   *   @param 
   *   @return true or false
  */
function admin_edit($id = null) {
      
      $this->checkSessionAdmin('Admin');          
      $this->layout = 'admin';
      $this->set('id',$id);
 
      $parents = $this->Garage->find('all', array('conditions'=>array('id'=>$id)));
      
     //  echo "<pre>";
     // print_r($parents);  die('here');
       
        $this->set('parents', $parents[0]);
        
       if(!empty($this->data))
       {
	
	$this->Garage->set($this->data);
        if ( $this->Garage->validates(array('fieldList' => array('s_name',))) ) 
        {        

	//pr($this->data);die;
            $this->data['Garage']['garage_id']       = $this->data['Garage']['garage_id'];
            $this->data['Garage']['garage_name']     = $this->data['Garage']['garage_name'];
            $this->data['Garage']['g_state']         = $this->data['Garage']['g_state'];
            $this->data['Garage']['g_city']          = $this->data['Garage']['g_city'];
            $this->data['Garage']['g_zip_code']      = $this->data['Garage']['g_zip_code'];
	    $this->data['Garage']['g_address']       = $this->data['Garage']['g_address'];
	    $this->data['Garage']['g_email']         = $this->data['Garage']['g_email'];
	    $this->data['Garage']['g_phone']         = $this->data['Garage']['g_phone'];
	    $this->data['Garage']['g_open']          = $this->data['Garage']['g_open'];
            $this->data['Garage']['g_close']         = $this->data['Garage']['g_close'];
	    $this->data['Garage']['rate_hrs']        = $this->data['Garage']['rate_hrs'];		
	    		
            
            $this->Garage->id = $id;
            $this->Garage->save($this->data); 
            
             $this->redirect(array('controller'=>'garages','action'=>'view','admin'=>true));
              
                 
         }
         else
         {
           $errors = $this->Store->invalidFields(array('fieldList' => array('s_name','s_address','s_description','s_email','s_store_id','s_fax','s_phone','s_branch_manager','s_branch_admin')));
            $this->Store->set('errors',$errors); 
         }
        }
     
    }	

	function admin_editSpace($id = null,$gid=null) {
      
      $this->checkSessionAdmin('Admin');          
      $this->layout = 'admin';
      $this->set('id',$id);
      $this->set('gid',$gid);
      App::import('Model','GarageAvailSpace');
      $this->GarageAvailSpace = & new GarageAvailSpace();		
 
      $parents = $this->GarageAvailSpace->find('all', array('conditions'=>array('id'=>$id)));
      
     //  echo "<pre>";
     // print_r($parents);  die('here');
       
        $this->set('parents', $parents[0]);
        
       if(!empty($this->data))
       {
	/*echo "<pre>";
	print_r($this->data);
	echo "<pre>";die('thsi'); */         
	$this->Garage->set($this->data);
        if ( $this->GarageAvailSpace->validates(array('fieldList' => array('full_address'))) ) 
        {        
	
            $this->data['GarageAvailSpace']['full_address']       = $this->data['GarageAvailSpace']['full_address'];
            $this->data['GarageAvailSpace']['facility_type']      = $this->data['GarageAvailSpace']['facility_type'];
            $this->data['GarageAvailSpace']['status']             = $this->data['GarageAvailSpace']['status'];
	    $this->data['GarageAvailSpace']['location']             = $this->data['GarageAvailSpace']['location'];
	    $this->data['GarageAvailSpace']['space_id']             = $this->data['GarageAvailSpace']['space_id'];	
         
            $this->GarageAvailSpace->id = $id;
            $this->GarageAvailSpace->save($this->data,false); 
	    $gID    = $this->data['GarageAvailSpace']['Gid'];		
	   	
              $t = $this->GarageAvailSpace->find('all', array('conditions'=>array('id'=>$id)));

             $this->redirect(array('controller'=>'garages','action'=>'addSpace',$gID,'admin'=>true));
              
                 
         }
         else
         {
           $errors = $this->GarageAvailSpace->invalidFields(array('fieldList' => array('full_address')));
            $this->Store->set('errors',$errors); 
         }
        }
     
    }	

#___________________________________________________________	
	
	//Function to Change Status
	function admin_active($id = null){
 	   $this->checkSessionAdmin('Admin');
               
		$this->layout='ajax';
		$store = $this->Garage->read(null,$id);
        
		if($store['Garage']['g_status']=='1'){
			$status = 0;
		} else {
			$status = 1;
		}
		
		$this->Garage->set('g_status', $status);
   		$this->Garage->save();
		
		$this->set('id',$id);
		$this->set('g_status',$status);
		
	}
	//Function to Change Status
	function admin_activeSpace($id = null){
       
		$this->layout='ajax';
		App::import('Model','GarageAvailSpace');
    		$this->GarageAvailSpace = & new GarageAvailSpace();

		$store = $this->GarageAvailSpace->read(null,$id);
        	 //    pr($store);   die('hererer');
		if($store['GarageAvailSpace']['status']=='1'){
			$status = 0;
		} else {
			$status = 1;
		}
		 $this->GarageAvailSpace->id = $id;
		 $this->GarageAvailSpace->saveField('status',$status);
		

		
		$this->set('id',$id);
		$this->set('status',$status);
		
	}
		
#___________________________________________________________	
	
	function admin_change_status()
	{
    $this->checkSessionAdmin('Admin');
    
    $this->layout='ajax';
    App::import('Model','StoreImage');
    $this->StoreImage = & new StoreImage();
   
    $storeId=$this->data['Store']['Storeid'];
    $selectedStatus=$this->data['ProductImage']['selected'];
    
    
    $storeImageDetails = $this->StoreImage->find('all', array('conditions'=>array('store_id'=>$storeId)));
   
    foreach($storeImageDetails as $detailStat)
    {   
       
      if($detailStat['StoreImage']['id']==$selectedStatus)
      {
          $this->StoreImage->id = $selectedStatus;
          $this->StoreImage->saveField('status','1');
      }
      else
      {
      
          $this->StoreImage->id = $detailStat['StoreImage']['id'];
          $this->StoreImage->saveField('status','0');
      }
       
    }

      $this->redirect(array('controller'=>'stores','action'=>'more_image',$storeId,'admin'=>true));
   
   // die('thisi si ');
    
    
  }
	//Function to Delete User
	function admin_delete($id=null){
	  $this->checkSessionAdmin('Admin');
		$this->layout='ajax';
		App::import('Model','Garage');
  	  $this->Garage = & new Garage(); 

	App::import('Model','GarageAvailSpace');
  	$this->GarageAvailSpace = & new GarageAvailSpace(); 

	App::import('Model','GarageImages');
  	$this->GarageImages = & new GarageImages(); 
    
   
	$allImages = $this->GarageImages->find('all',array('conditions'=>array('garage_id'=>$id)));  
	$allSpace = $this->GarageAvailSpace->find('all',array('conditions'=>array('garage_id'=>$id))); 
	

      foreach($allSpace as $space)
      {
	     $this->GarageAvailSpace->delete($space['GarageAvailSpace']['id'],true);		 
      }     
                  
      foreach($allImages as $img)
      {
             $this->Image->delete_image($img['GarageImages']['image'],'garageImages');
	     $this->GarageImages->delete($img['GarageImages']['id'],true);		 
      }     
         
      $this->Garage->delete($id,true);	
		//$this->StoreImage->delete($id,true);	
		
    
    $criteria				      = '';     
    $data = $this->paginate('Garage'); // Extra parameters added
    $this->set('data',$data);
	}

#___________________________________________________________	

	//Function to Delete User
	function admin_deleteSpace($id=null){
	//  $this->checkSessionAdmin('Admin');
		$this->layout='ajax';
		App::import('Model','GarageAvailSpace');
  	  $this->GarageAvailSpace = & new GarageAvailSpace(); 
    
	$this->GarageAvailSpace->delete($id,true);	
	//$this->StoreImage->delete($id,true);	
		
    
    $criteria				      = '';     
    $data = $this->paginate('GarageAvailSpace'); // Extra parameters added
    $this->set('data',$data);
	}
#___________________________________________________________	
	
		//Function to Delete Iamges
	function admin_delete_image($id,$garageid){
	
    $this->checkSessionAdmin('Admin');
	$this->layout='ajax';
	App::import('Model','GarageImages');
    $this->GarageImages = & new GarageImages(); 
  
     $image = $this->GarageImages->findById($id);
  
    $this->Image->delete_image($image['GarageImages']['image'],'garageImages'); 
      
		$this->GarageImages->delete($id,true);
    $this->redirect(array('controller'=>'garages','action'=>'addGarageImage',$garageid,'admin'=>true));	
	
	}
#___________________________________________________________
	//Function to Delete User
	function admin_storeView( $id = null  ) {
	  $this->checkSessionAdmin('Admin');
    $this->layout 			= 'admin';
    $this->set('pageTitle',__('www.blossman.com',true));
    
    $this->_view_store( $id );
	  
	}
	
#_________________________________________________

/**
 * Function reviewStore - To review posted store
 *
 */  
  function _view_store( $id = null ){
      $this->checkSessionAdmin('Admin');
     //MASTER TABLE
     
 		 //Import 
     App::import('Model','Store');
     $this->Store = & new Store();       
 		      
      //Import 
     App::import('Model','StoreCategory');
     $this->StoreCategory = & new StoreCategory();  
 		 
     //Import 
     App::import('Model','StoreLocation');
     $this->StoreLocation = & new StoreLocation();
     
      if($id)
      {
        $StoreDetails = $this->Store->findById($id);       
        $this->set('tempStoreDetails',$StoreDetails); 
      }
      
    // category _________________________________________
      $this->StoreCategory->bindModel(array('belongsTo' =>array("Category")),false); //binding different table for 
      //Fetch all the categories to display on the page
      $condition = array (
                    'conditions' => array('StoreCategory.city_id' => $id ), //array of conditions
      );
      $catList = $this->StoreCategory->find('all', $condition);

    //END: TEMP category _________________________________________
    
    //TEMP location_________________________________________
      //Fetch all the locations to display on the page
      $condition = array (
                    'conditions' => array('StoresLocation.city_id' => $id ), //array of conditions
      );
      $locationList = $this->StoresLocation->find('all', $condition);
    //END: TEMP location_________________________________________

    $this->set('catList',$catList);
    $this->set('locationList',$locationList);     

  }  
 	
   
}
?>
