<?php
class EventsController extends AppController 
{


	var $name = 'Events';
	var $helpers = array('Html','Ajax','Javascript','Form','Session','Xml','GoogleChart');
	/* *  Component used by the Controller **/
	var $components = array('RequestHandler','Cookie','Session','Email'); 

	var $paginate = array('limit' => 10);
	function calendar()
	{
	$this->Session->write('tabname','availability'); 
	$this->layout       	= "teacher_default";
	}
	function feed() 
	{
		$this->Session->write('tabname','availability'); 
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
	function add($allday=null,$day=null,$month=null,$year=null,$hour=null,$min=null,$id=null)
	 {
			App::import('Model','TeacherLocation');
			$this->TeacherLocation =& new TeacherLocation();
			$user=2;
			$categories = $this->TeacherLocation->find('all');
			$location = Set::combine($categories, "{n}.TeacherLocation.city","{n}.TeacherLocation.city");
			$this->set('location',$location);	
                      //	$location = $this->TeacherLocation->find('city',array('conditions'=>array('tid'=>$user)));
			//pr($location);
			//$this->set('location',$location);
	    if (empty($this->data))
		 {
			
			//Set default duration: 1hr and format to a leading zero.
			$hourPlus=intval($hour)+1;
			if (strlen($hourPlus)==1) 
			{
			    $hourPlus = '0'.$hourPlus;
			}
	 
			//Create a time string to display in view. The time string
			//is either  "Fri 26 / Mar, 09 : 00 â€�? 10 : 00" or
			//"All day event: (Fri 26 / Mar)"
			if ($allday=='true')
			 {	
			    $event['Event']['allday'] = 1;
			    $displayTime = 'All day event: ('
				. date('D',strtotime($day.'/'.$month.'/'.$year)).' '.
				$day.' / '. date("M", mktime(0, 0, 0, $month, 10)).')';
			} 
			else
			 {
			    $event['Event']['allday'] = 0;
			    $displayTime = date('D',strtotime($day.'/'.$month.'/'.$year)).' '
				.$day.' / '.date("M", mktime(0, 0, 0, $month, 10)).
				', '.$hour.' : '.$min.' &mdash; '.$hourPlus.' : '.$min;
			 }
			$this->set("displayTime",$displayTime);
		 
			//Populate the event fields for the add form 
			$event['Event']['title'] = 'Event description';
			$event['Event']['start'] = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
			$event['Event']['end'] = $year.'-'.$month.'-'.$day.' '.$hourPlus.':'.$min.':00';
			$this->set('event',$event);
		 
			//Do not use a view template.
			
	      } 
	    else 
		{	
			
			
			//Create and save the new event in the table.
			//Event type is set to editable - because this is a user event.
			$this->Event->create();
			$this->data['Event']['title'] = $this->data["Event"]["title"];
			$this->data['Event']['editable']='1';
				
			$this->Event->save($this->data);
					
			$this->redirect('/events/calendar');
			
			 //$this->redirect(array('controller' => "events", 'action' => "calendar");
   		}
}

//events_controller.php
function edit ($id=null) 
{
    if (empty($this->data))
         {
            if ($id==null)
                {
                //fail gracefully in case of error
                return;
                }
            $ev = $this->Event->findById($id);
            $ev['Event']['start']=date('Y-m-d h:i:s',strtotime($ev['Event']['start']));
            $ev['Event']['end']=date('Y-m-d h:i:s',strtotime($ev['Event']['end']));
            $this->set("event",$ev);
            if ($ev['Event']['allday']=='1') {
                $displayTime = 'All day event';
            } else {
                $displayTime = date('D M d, H:i',strtotime($ev['Event']['start'])) . '&mdash;' . date('H:i',strtotime($ev['Event']['end']));
            }
            $this->set('displayTime',$displayTime);
            
        }
       else
           {
            $this->Event->id = $this->data['Event']['id'];
            $this->Event->saveField('title',$this->data['Event']['title']);
            $this->redirect(array('controller' => "events", 'action' => "calendar",substr($this->data['Event']['start'],0,4),
            substr($this->data['Event']['start'],5,2),substr($this->data['Event']['start'],8,2)));
           }
}
function delete($id=null)
{
         $value1=$id;
         $conditions=array('Event.id' => $value1);
         $this -> Event -> delete($conditions);
         $this->redirect(array('controller' => "events", 'action' => "calendar",substr($this->data['Event']['start'],0,4),
         substr($this->data['Event']['start'],5,2),substr($this->data['Event']['start'],8,2)));
                             
}
function resize ($id=null,$dayDelta,$minDelta)
  {
	
    if ($id!=null) 
	{
	    $ev = $this->Event->findById($id);
	    $ev['Event']['end']=date('Y-m-d H:i:s',strtotime(''.$dayDelta.' days '.$minDelta.' minutes',strtotime($ev['Event']['end'])));
	    $this->Event->save($ev);
	}
    	$this->redirect(array('controller' => "events", 'action' => "calendar",substr($ev['Event']['start'],0,4),substr($ev['Event']    ['start'],5,2),substr($ev['Event']['start'],8,2)));
  }


	

}
?>
