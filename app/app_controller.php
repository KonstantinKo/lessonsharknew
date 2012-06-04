<?php
/* SVN FILE: $Id: app_controller.php 4410 2007-02-02 13:31:21Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2007, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2007, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 4410 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2007-02-02 07:31:21 -0600 (Fri, 02 Feb 2007) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.cake
 */
class AppController extends Controller
{

	#var $components = array('DebugKit.Toolbar');

	function checkSessionAdmin()
  {
    // If the session info hasn't been set...
    if (!$this->Session->check('Admin'))
    {
      // Force the user to login
      $this->redirect('/admin/users/login');
    }
  }

  function checkSessionUser()
  {
    // If the session info hasn't been set...
    if (!$this->Session->check('userInfo'))
    {//pr($_SESSION);die();
      // Force the user to login
      $this->redirect('/');
    }
  }
    
  function beforeRender()
	{
		//somehow beforeFilter doesn't work; maybe the individual controller beforeFilters override it
		$this->disableCache();

		if(!$this->Session->check('User'))
		{
			//session doesn't exist so send user to login page
			$this->set('page', 'loggedOut');
			$this->set('role', 'none');
		}
		else
		{
			//$fname = ucfirst(strtolower($this->Session->read('User.fname')));
			//$lname = ucfirst(strtolower($this->Session->read('User.lname')));
			$fname = $this->Session->read('User.firstname');
			$lname = $this->Session->read('User.lastname');
			$role = $this->Session->read('User.role');
			
			$linitial = substr(ucfirst($this->Session->read('User.lastname')), 0, 1) . '.';

			$this->set('fname', $fname);
			$this->set('lname', $lname);
			$this->set('linitial', $linitial);
			$this->set('page', 'loggedIn');
			$this->set('role', $role);
		}
	}

}
?>
