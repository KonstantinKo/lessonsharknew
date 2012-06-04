<?php
class ContentController extends AppController {
    var $name = 'Content';
   // var $components = array('Route');
    /*
 *  Helper used by the Controller
 **/    
    var $helpers = array('Html','Ajax','Javascript','Form');
 /*
 *  Component used by the Controller
 **/
    var $components = array('RequestHandler','Image','Cookie'); 
   
//Pagination configuration
var $paginate = array(                     
        'limit' => 10,
        'order' => array(
            'User.lname' => 'asc'
        )
    );

    
  /*function _getPath($id) {
        $path = '';
        $pages = $this->Content->getpath($id);
        foreach($pages as $i) {
            $path .= '/'.$i['Content']['slug'];
        }
        return $path;
    }  */
    
    #_________________________________________________
  /**
   *   This function is used to get list of slug
   *   Return    
   *   @param 
   *   @return true or false
  */
function _getListDepth($data) {
        $result = array();
        foreach ($data as $i) {
            $newData = $i;
            $newData['Content']['depth'] = count($this->Content->getpath($i['Content']['id'])) - 1;
            unset($newData['Content']['body']);
            unset($newData['children']);
            $result[] = $newData;
            if(is_array($i['children'])) {
                $children = $this->_getListDepth($i['children']);
                foreach($children as $k) {
                    $result[] = $k;
                }
            }
        }
        return $result;
    }
    #_________________________________________________
    
          //function is used to show the residential page header.
   function residentialHeader()
   {
       $this->layout  = "";        
          
   }
  /**
   *   This function is used to display view CMS 
   *   Return    
   *   @param 
   *   @return true or false
  */
     function admin_view($id) {
     $this->checkSessionAdmin('Admin');
     $this->layout = 'admin';
        $content = $this->Content->findById($id);
        if(empty($content)) {
            $this->Session->setFlash('Invalid content request', 'default', array('class' => 'bad'));
            $this->redirect('/');
        }else{
            $this->keywords = $content['Content']['keywords'];
            $this->description = $content['Content']['description'];
            $this->set('content', $content['Content']);
        }
    }
       #_________________________________________________
  /**
   *   This function is used to display listing of parent pages and thier child
   *   Return    
   *   @param 
   *   @return true or false
  */
    function admin_index() {
        $this->checkSessionAdmin('Admin');
       $this->layout = 'admin';
      /* $pages = $this->Content->find('threaded',array(
                                        'conditions'=>array(
                                            'OR'=>array(
                                                array('parent_id'=>'0'),
                                                array('type'=>'3')
                                                
                                                )
                                              )
                                            )
                                          );*/ 
    $pages = $this->Content->find('threaded');
        $this->set('pages',$pages);
      //echo '<pre>';print_r($pages);
      
        /*if(empty($pages)) {
            $this->Session->setFlash('There are no pages to display', 'default', array('class'=>'bad'));
        }else{
            $this->set('page_count', count($pages));
            $this->set('pages', $this->_getListDepth($pages));
        }*/
    }
     #_________________________________________________
  /**
   *   This function is used to add child page
   *   Return    
   *   @param 
   *   @return true or false
  */
    function admin_add() {
        
        $this->checkSessionAdmin('Admin');
        $this->layout = 'admin';
        $parents = $this->Content->find('all', array('order' => 'title','conditions'=>array('parent_id'=>'0')));
       
        $this->set('parents', $parents); 
      if(!empty($this->data)) {
        /*  echo "<pre>";
        print_r($this->data);
        echo "<pre>";exit;*/
        //  $image_path = $this->Image->upload_image_and_thumbnail($this->data,"h_image",960,300,"header",true);
          $this->data['Content']['parent_id']         = $this->data['Content']['parent_id'];
          $this->data['Content']['title']             = $this->data['Content']['title'];
          $this->data['Content']['slug']              = $this->data['Content']['slug']; 
          $this->data['Content']['body']              = $this->data['Content']['body'];
        //  $this->data['Content']['h_image']           = $image_path;
          $this->data['Content']['type']              = '3';
          
          $this->Content->save($this->data ,false);
         
          $this->redirect(array('controller'=>'content','action'=>'index','admin'=>true)); 
            
        
            
        }
    }
       #_________________________________________________
       
        #_________________________________________________
	   
	     /**
   *   This function is used to add child page
   *   Return    
   *   @param 
   *   @return true or false
  */
    function admin_addPage() {
            
       $catId = $this->data['Content']['parent_id'];

        $this->checkSessionAdmin('Admin');
        $this->layout = 'admin';
        
        $parents = $this->Content->find('all', array('order' => 'title','conditions'=>array('parent_id'=>$catId,'type'=>'2' )));
        
          
        $this->set('id', $catId);
        $this->set('parents', $parents);
        if(!empty($this->data)) {
    
            if($this->Content->save($this->data)) {
                //$page_id = $this->Content->getLastInsertId();
                //$route = "Router::connect('".$this->_getPath($page_id)."', array('controller' => 'content', 'action' => 'view', '".$page_id."'));";
                //$this->Route->add($route);
               // $this->Session->setFlash('Page Created', 'default', array('class'=>'good'));
                $this->redirect(array('controller'=>'content','action'=>'index','admin'=>true));
            }
        }
    }
       #_________________________________________________
	   
	        /**
   *   This function is used to add child page
   *   Return    
   *   @param 
   *   @return true or false
  */
    function admin_addSubCat() {
    
  
        $parentCatId = $this->data['Content']['parent_id'];

        $this->checkSessionAdmin('Admin');
        $this->layout = 'admin';
        $parents = $this->Content->find('all', array('order' => 'title','conditions'=>array('id'=>$parentCatId)));
      
        $this->set('parents', $parents[0]);
      
    }
       #_________________________________________________
    /**
   *   This function is used to edit child page
   *   Return    
   *   @param 
   *   @return true or false
  */   
       function admin_saveSubCat() {
       
      /* echo "<pre>";
       print_r($this->data);
       echo "</pre>";exit;  */
          if(!empty($this->data)) {
          
            $this->data['Content']['parent_id']         = $this->data['Content']['parent_id'];
            $this->data['Content']['title']             = $this->data['Content']['title'];
            $this->data['Content']['slug']              = $this->data['Content']['slug'];
            $this->data['Content']['body']              = $this->data['Content']['body']; 
            $this->data['Content']['type']              = '2';
            if(!empty($this->data['Image']['h_image']['name']))
            {
                $image_path = $this->Image->upload_image_and_thumbnail($this->data,"h_image",960,300,"header",true);                                  
                $this->data['Content']['h_image']       = $image_path; 
            
            }
            
         
            $this->Content->save($this->data ,false);
            
            $this->redirect(array('controller'=>'content','action'=>'add','admin'=>true));
          }   
          
          
          
       
    }
      
  
    #_________________________________________________   
    
    
  /**
   *
   *     
   *   This function is used to edit child page
   *   Return    
   *   @param 
   *   @return true or false
  */
      function admin_edit($id = null) {
      
      $this->layout = 'admin';
      $this->set('id',$id);
      
        $parents = $this->Content->find('all', array('order' => 'title','conditions'=>array('parent_id'=>'0')));
        $this->set('parents', $parents);
        
        if(!empty($this->data)) {
          
         
              if(!empty($this->data['Image']['h_image']['name']))
              {
                $image_path = $this->Image->upload_image_and_thumbnail($this->data,"h_image",960,300,"header",true);
                $this->data['Content']['h_image']             = $image_path;
                
                if($this->data['Content']['h_image']!='')
                {
                  $this->Image->delete_image($this->data['Content']['old_image'],'header'); 
                                   
                }  
              }
               
                $this->data['Content']['title']             = $this->data['Content']['title'];
                $this->data['Content']['slug']              = $this->data['Content']['slug']; 
                $this->data['Content']['body']              = $this->data['Content']['body'];
                $this->data['Content']['type']              = '3';
               
                $this->Content->id = $id; 
                $this->Content->save($this->data); 
                
                    /*if($this->data['Content']['old_parent_id'] != $this->data['Content']['parent_id']) {
                        $route = "Router::connect('".$this->data['Content']['old_path']."', array('controller' => 'content', 'action' => 'view', '".$this->data['Content']['id']."'));";
                        $this->Route->remove($route);
                        $route = "Router::connect('".$this->_getPath($this->data['Content']['id'])."', array('controller' => 'content', 'action' => 'view', '".$this->data['Content']['id']."'));";
                        $this->Route->add($route);
                    }*/
                   // $this->Session->setFlash('Page Updated', 'default', array('class'=>'good'));
                    $this->redirect('index');
             
          
        }else{
            $page = $this->Content->findById($id);  
            
           
            $pageSubCat = $this->Content->find('all',array('conditions'=>array('parent_id'=>$page['Content']['id'])));            
            
            
            if(empty($page)) {
                $this->Session->setFlash('Invalid Page ID', 'default', array('class'=>'bad'));
                $this->redirect('index');
            }else{
                  if(!empty($pageSubCat))
                  {
                     $this->set('pageSubCat',$pageSubCat);
                     $this->data = $page;
                     $this->data['Content']['old_parent_id'] = $page['Content']['parent_id']; 
                  }
                  else
                  {
                      $this->set('pageSubCat','');
                      $this->data = $page;
                      $this->data['Content']['old_parent_id'] = $page['Content']['parent_id'];  
                //$this->data['Content']['old_path'] = $this->$page['Content']['id'];
                  }
               
              
            }
        }
    }
      #_________________________________________________  
      
        /**
   *
   *     
   *   This function is used to edit Sub category
   *   Return    
   *   @param 
   *   @return true or false
  */
      function admin_editCat($id = null) {
      
      $this->layout = 'admin';
      $this->set('id',$id);
      
        $parents = $this->Content->find('all', array('order' => 'title','conditions'=>array('parent_id'=>'0')));
        $this->set('parents', $parents);
        
        if(!empty($this->data)) {
                           
              if(!empty($this->data['Image']['h_image']['name']))
              {
                $image_path = $this->Image->upload_image_and_thumbnail($this->data,"h_image",960,300,"header",true);
                $this->data['Content']['h_image']             = $image_path;
                
                if($this->data['Content']['h_image']!='' and $this->data['Content']['old_image']!='')
                {
                  $this->Image->delete_image($this->data['Content']['old_image'],'header'); 
                                   
                }  
              }
               
                $this->data['Content']['title']             = $this->data['Content']['title'];
                $this->data['Content']['slug']              = $this->data['Content']['slug']; 
                $this->data['Content']['body']              = $this->data['Content']['body'];
                $this->data['Content']['type']              = '2';
               
                $this->Content->id = $id; 
                $this->Content->save($this->data); 
                
                    /*if($this->data['Content']['old_parent_id'] != $this->data['Content']['parent_id']) {
                        $route = "Router::connect('".$this->data['Content']['old_path']."', array('controller' => 'content', 'action' => 'view', '".$this->data['Content']['id']."'));";
                        $this->Route->remove($route);
                        $route = "Router::connect('".$this->_getPath($this->data['Content']['id'])."', array('controller' => 'content', 'action' => 'view', '".$this->data['Content']['id']."'));";
                        $this->Route->add($route);
                    }*/
                   // $this->Session->setFlash('Page Updated', 'default', array('class'=>'good'));
                    $this->redirect('index');
            
        }else{
            $page = $this->Content->findById($id);  
            
           
            $pageSubCat = $this->Content->find('all',array('conditions'=>array('parent_id'=>$page['Content']['id'])));            
            
            
            if(empty($page)) {
                $this->Session->setFlash('Invalid Page ID', 'default', array('class'=>'bad'));
                $this->redirect('index');
            }else{
                  if(!empty($pageSubCat))
                  {
                     $this->set('pageSubCat',$pageSubCat);
                     $this->data = $page;
                     $this->data['Content']['old_parent_id'] = $page['Content']['parent_id']; 
                  }
                  else
                  {
                      $this->set('pageSubCat','');
                      $this->data = $page;
                      $this->data['Content']['old_parent_id'] = $page['Content']['parent_id'];  
                //$this->data['Content']['old_path'] = $this->$page['Content']['id'];
                  }
               
              
            }
        }
    }
      #_________________________________________________  
      
      
      
      
  /**
   *   This function is used to delete child page
   *   Return    
   *   @param 
   *   @return true or false
  */
    function admin_delete($id) {
        $page = $this->Content->findById($id);
        if(empty($page)) {
            $this->Session->setFlash('Invalid Page ID', 'default', array('class'=>'bad'));
        }else{
         
          
            
           
            //$path = $this->_getPath($id);
            if($this->Content->delete($id)) {
            $this->Image->delete_image($page['Content']['h_image'],'header'); 
                //$route = "Router::connect('".$path."', array('controller' => 'content', 'action' => 'view', '".$page['Content']['id']."'));";
                //$this->Route->remove($route);
                
                $this->Session->setFlash('Page Deleted', 'default', array('class'=>'good'));
            }else{
                $this->Session->setFlash('Failed to delete page', 'default', array('class'=>'bad'));
            }
        }
        $this->redirect('index');
    }   
    //function is used to show the footer pages
    function show()
    {
       $content1=$this->Content->find('all',array('conditions'=>array('parent_id'=>'1' ),'order'=>'id'));
       
       $content2=$this->Content->find('all',array('conditions'=>array('parent_id'=>'2'),'order'=>'id'));
       $content3=$this->Content->find('all',array('conditions'=>array('parent_id'=>'3'),'order'=>'id'));
       
       $this->set('content1',$content1);  
       $this->set('content2',$content2);
       $this->set('content3',$content3);
      
    }   
    function page($slug)
    {
       $this->layout = 'front_default'; 
       
       $pageCont=$this->Content->find('all',array('conditions'=>array('slug'=>$slug)));
       
       
       
       $pageParent=$this->Content->findById($pageCont[0]['Content']['parent_id']);
       
       if($pageParent['Content']['parent_id']!=0)
       {
         $pageOfSubCat=$this->Content->findById($pageParent['Content']['parent_id']);
         $this->set('pageOfSubCat',$pageOfSubCat);      
       }
       else
       {
           $pageOfSubCat=$this->Content->findById($pageParent['Content']['parent_id']);
         $this->set('pageOfSubCat',$pageOfSubCat);     
       }
       
      if($pageCont[0]['Content']['type']==3)
      { 
          if( $pageParent['Content']['parent_id']!=0 and $pageOfSubCat['Content']['id']==15)
          {
            $this->Session->write('selectedMenu','services');
          } 
          
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==28)
         {
            $this->Session->write('selectedMenu','ExistingCust');
          }
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==63)
          {
             $this->Session->write('selectedMenu','appliances');
          } 
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==51)
          {
             $this->Session->write('selectedMenu','propane');
          } 
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==58)
          {
             $this->Session->write('selectedMenu','family');
          } 
      }
      else if($pageCont[0]['Content']['type']==2)
      {
          if( $pageParent['Content']['parent_id']!=15)
          {
            $this->Session->write('selectedMenu','services');
          } 
         
      }
      else if($pageCont[0]['Content']['type']==1)
      {
          if( $pageCont[0]['Content']['id']==15)
          {
            $this->Session->write('selectedMenu','services');
          } 
          else if( $pageCont[0]['Content']['id']==28)
          {
            $this->Session->write('selectedMenu','ExistingCust');
          } 
      }

       
    
       $this->set('pageParent',$pageParent);
       $this->set('pageContent',$pageCont[0]);  
       
      
    }
    
    //function is used to show the propane pages
    
    function propane($slug)
    {
       $this->layout = 'front_default'; 
       $this->Session->write('selectedMenu','propane');
       $pageCont=$this->Content->find('all',array('conditions'=>array('slug'=>$slug)));
       
       
       
       $pageParent=$this->Content->findById($pageCont[0]['Content']['parent_id']);
       
       if($pageParent['Content']['parent_id']!=0)
       {
         $pageOfSubCat=$this->Content->findById($pageParent['Content']['parent_id']);
         $this->set('pageOfSubCat',$pageOfSubCat);      
       }
       else
       {
           $pageOfSubCat=$this->Content->findById($pageParent['Content']['parent_id']);
         $this->set('pageOfSubCat',$pageOfSubCat);     
       }
       
      if($pageCont[0]['Content']['type']==3)
      { 
          if( $pageParent['Content']['parent_id']!=0 and $pageOfSubCat['Content']['id']==15)
          {
            $this->Session->write('selectedMenu','services');
          } 
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==28)
         {
            $this->Session->write('selectedMenu','ExistingCust');
          }
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==63)
          {
             $this->Session->write('selectedMenu','appliances');
          } 
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==51)
          {
             $this->Session->write('selectedMenu','propane');
          } 
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==58)
          {
             $this->Session->write('selectedMenu','family');
          } 
      }

       
    
       $this->set('pageParent',$pageParent);
       $this->set('pageContent',$pageCont[0]);  
       
      
    }
    
    
    
     ////////////////////////////////////
     
    function family($slug)
    {
       $this->layout = 'front_default'; 
       $this->Session->write('selectedMenu','family');
       $pageCont=$this->Content->find('all',array('conditions'=>array('slug'=>$slug)));
       
       
       
       $pageParent=$this->Content->findById($pageCont[0]['Content']['parent_id']);
       
       if($pageParent['Content']['parent_id']!=0)
       {
         $pageOfSubCat=$this->Content->findById($pageParent['Content']['parent_id']);
         $this->set('pageOfSubCat',$pageOfSubCat);      
       }
       else
       {
           $pageOfSubCat=$this->Content->findById($pageParent['Content']['parent_id']);
         $this->set('pageOfSubCat',$pageOfSubCat);     
       }
       
      if($pageCont[0]['Content']['type']==3)
      { 
          if( $pageParent['Content']['parent_id']!=0 and $pageOfSubCat['Content']['id']==15)
          {
            $this->Session->write('selectedMenu','services');
          } 
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==28)
         {
            $this->Session->write('selectedMenu','ExistingCust');
          }
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==63)
          {
             $this->Session->write('selectedMenu','appliances');
          } 
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==51)
          {
             $this->Session->write('selectedMenu','propane');
          } 
          else if($pageParent['Content']['parent_id']==0 and $pageParent['Content']['id']==58)
          {
             $this->Session->write('selectedMenu','family');
          } 
      }

       
    
       $this->set('pageParent',$pageParent);
       $this->set('pageContent',$pageCont[0]);  
       
      
    }
    
    
    
    
    
    
    
    
    ///////////////////////////////////////
    
    
     //Function is used to show the data for our services page. 
   function ourServicesPage()
   {
  
      App::import('Model','Content');
      $this->Content = & new Content();
       /*fetching sub categories of Our services main category*/
      $scrollParent= $this->Content->find('all',array('conditions'=>array('id'=>'15')) );
    
      
      $scrollCategory= $this->Content->find('all',array('conditions'=>array('parent_id'=>$scrollParent[0]['Content']['id']),'limit'=>'3') );
      
      /*fetch page of Agricultural details*/
      
      $scrollAgricultural = $this->Content->find('all',array('conditions'=>array('id'=>'48')) );
      $scrollAutoGas = $this->Content->find('all',array('conditions'=>array('id'=>'40')) );
      $scrollMover = $this->Content->find('all',array('conditions'=>array('id'=>'41')) );
      
      $this->set('scrollParent',$scrollParent);
      $this->set('scrollCat',$scrollCategory);
      
      $this->set('scrollAgri',$scrollAgricultural[0]);
      $this->set('scrollAutoGas',$scrollAutoGas[0]);
      $this->set('scrollMover',$scrollMover[0]);
   }
      #_________________________________________________  
      
      
   function admin_managePage() {
        $this->checkSessionAdmin('Admin');
       $this->layout = 'admin';
     
      $pages = $this->Content->find('all',array('conditions'=>array('parent_id'=>'0')));
  
      $this->set('pages',$pages);
      //echo '<pre>';print_r($pages);
      
        /*if(empty($pages)) {
            $this->Session->setFlash('There are no pages to display', 'default', array('class'=>'bad'));
        }else{
            $this->set('page_count', count($pages));
            $this->set('pages', $this->_getListDepth($pages));
        }*/
    }
    
                                                         
                                                         
              /**
   *
   *     
   *   This function is used to edit Sub category
   *   Return    
   *   @param 
   *   @return true or false
  */
      function admin_editRoot($id = null) {
      
      $this->layout = 'admin';
      $this->set('id',$id);
      
        $parents = $this->Content->find('all', array('order' => 'title','conditions'=>array('parent_id'=>'0')));
        $this->set('parents', $parents);
        
        if(!empty($this->data)) {
                           
              if(!empty($this->data['Image']['h_image']['name']))
              {
                $image_path = $this->Image->upload_image_and_thumbnail($this->data,"h_image",960,300,"header",true);
                $this->data['Content']['h_image']             = $image_path;
                
                if($this->data['Content']['h_image']!='' and $this->data['Content']['old_image']!='')
                {
                  $this->Image->delete_image($this->data['Content']['old_image'],'header'); 
                                   
                }  
              }
               
                $this->data['Content']['title']             = $this->data['Content']['title'];
                $this->data['Content']['slug']              = $this->data['Content']['slug']; 
                $this->data['Content']['body']              = $this->data['Content']['body'];
                $this->data['Content']['type']              = '1';
               
                $this->Content->id = $id; 
                $this->Content->save($this->data); 
                
                    $this->redirect('managePage');
            
        }else{
            $page = $this->Content->findById($id);  
            
           
            $pageSubCat = $this->Content->find('all',array('conditions'=>array('parent_id'=>$page['Content']['id'])));            
            
            
            if(empty($page)) {
                $this->Session->setFlash('Invalid Page ID', 'default', array('class'=>'bad'));
                $this->redirect('index');
            }else{
                  if(!empty($pageSubCat))
                  {
                     $this->set('pageSubCat',$pageSubCat);
                     $this->data = $page;
                     $this->data['Content']['old_parent_id'] = $page['Content']['parent_id']; 
                  }
                  else
                  {
                      $this->set('pageSubCat','');
                      $this->data = $page;
                      $this->data['Content']['old_parent_id'] = $page['Content']['parent_id'];  
                //$this->data['Content']['old_path'] = $this->$page['Content']['id'];
                  }
               
              
            }
        }
    }
      #_________________________________________________  
       function footer($slug)
    {
       $this->layout = 'front_default'; 
        $this->Session->write('selectedMenu','propane');
       $pageCont=$this->Content->find('all',array('conditions'=>array('slug'=>$slug)));
       
       
       
       $pageParent=$this->Content->findById($pageCont[0]['Content']['parent_id']);
       
       if($pageParent['Content']['parent_id']!=0)
       {
         $pageOfSubCat=$this->Content->findById($pageParent['Content']['parent_id']);
         $this->set('pageOfSubCat',$pageOfSubCat);      
       }
       else
       {
           $pageOfSubCat=$this->Content->findById($pageParent['Content']['parent_id']);
         $this->set('pageOfSubCat',$pageOfSubCat);     
       }
       
   

       
    
       $this->set('pageParent',$pageParent);
       $this->set('pageContent',$pageCont[0]);  
       
      
    }
    
      function admin_editFooterPages($id = null) {
      
      $this->layout = 'admin';
      $this->set('id',$id);
      
        $parents = $this->Content->find('all', array('order' => 'title','conditions'=>array('parent_id'=>'0')));
        $this->set('parents', $parents);
        
        if(!empty($this->data)) {
                           
              if(!empty($this->data['Image']['h_image']['name']))
              {
                $image_path = $this->Image->upload_image_and_thumbnail($this->data,"h_image",960,300,"header",true);
                $this->data['Content']['h_image']             = $image_path;
                
                if($this->data['Content']['h_image']!='' and $this->data['Content']['old_image']!='')
                {
                  $this->Image->delete_image($this->data['Content']['old_image'],'header'); 
                                   
                }  
              }
               
                $this->data['Content']['title']             = $this->data['Content']['title'];
                $this->data['Content']['slug']              = $this->data['Content']['slug']; 
                $this->data['Content']['body']              = $this->data['Content']['body'];
                $this->data['Content']['type']              = '4';
               
                $this->Content->id = $id; 
                $this->Content->save($this->data); 
                
                    /*if($this->data['Content']['old_parent_id'] != $this->data['Content']['parent_id']) {
                        $route = "Router::connect('".$this->data['Content']['old_path']."', array('controller' => 'content', 'action' => 'view', '".$this->data['Content']['id']."'));";
                        $this->Route->remove($route);
                        $route = "Router::connect('".$this->_getPath($this->data['Content']['id'])."', array('controller' => 'content', 'action' => 'view', '".$this->data['Content']['id']."'));";
                        $this->Route->add($route);
                    }*/
                   // $this->Session->setFlash('Page Updated', 'default', array('class'=>'good'));
                    $this->redirect('manageFooterPage');
            
        }else{
            $page = $this->Content->findById($id);  
            
           
            $pageSubCat = $this->Content->find('all',array('conditions'=>array('parent_id'=>$page['Content']['id'])));            
            
            
            if(empty($page)) {
                $this->Session->setFlash('Invalid Page ID', 'default', array('class'=>'bad'));
                $this->redirect('index');
            }else{
                  if(!empty($pageSubCat))
                  {
                     $this->set('pageSubCat',$pageSubCat);
                     $this->data = $page;
                     $this->data['Content']['old_parent_id'] = $page['Content']['parent_id']; 
                  }
                  else
                  {
                      $this->set('pageSubCat','');
                      $this->data = $page;
                      $this->data['Content']['old_parent_id'] = $page['Content']['parent_id'];  
                //$this->data['Content']['old_path'] = $this->$page['Content']['id'];
                  }
               
              
            }
        }
    }
      #_________________________________________________  
      
                   #_________________________________________________
  /**
   *   This function is used to display listing of parent pages and thier child
   *   Return    
   *   @param 
   *   @return true or false
  */
    function admin_manageFooterPage() {
        $this->checkSessionAdmin('Admin');
       $this->layout = 'admin';
     
      $pages = $this->Content->find('all',array('conditions'=>array('parent_id'=>'5')));
  
      $this->set('pages',$pages);
      //echo '<pre>';print_r($pages);
      
        /*if(empty($pages)) {
            $this->Session->setFlash('There are no pages to display', 'default', array('class'=>'bad'));
        }else{
            $this->set('page_count', count($pages));
            $this->set('pages', $this->_getListDepth($pages));
        }*/
    }
     #_________________________________________________
    
     
       
            
}
?>
