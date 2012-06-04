<?php
/* SVN FILE: $Id$ */
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.model
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.model
 */
class AppModel extends Model
{
	var $actsAs = array('Containable');
	
	function beforeFind($query)
	{	
		//current model
		if(array_key_exists('deleted', $this->_schema))
		{
			if(empty($query['conditions']))
			{
				$query['conditions'] = array($this->name . '.deleted' => 0);
			}
			else
			{
				$query['conditions'] = array_merge(array($this->name . '.deleted' => 0), (array) $query['conditions']);
			}
		}
		
		//hasAndBelongsToMany
		foreach(array_keys($this->hasAndBelongsToMany) as $model)
		{
			if(array_key_exists('deleted', $this->$model->_schema))
			{
				if(empty($this->hasAndBelongsToMany[$model]['conditions']))
				{
					$this->hasAndBelongsToMany[$model]['conditions'] = array($model . '.deleted' => 0);
				}
				else
				{
					$this->hasAndBelongsToMany[$model]['conditions'] = array_merge(array($model . '.deleted' => 0), (array) $this->hasAndBelongsToMany[$model]['conditions']);
					//$query['conditions'] = array_merge(array($model . '.deleted' => 0), (array) $query['conditions']);
				}
			}
		}
		
		//hasMany
		foreach(array_keys($this->hasMany) as $model)
		{	
			if(array_key_exists('deleted', $this->$model->_schema))
			{
				if(empty($this->hasMany[$model]['conditions']))
				{
					$this->hasMany[$model]['conditions'] = array($model . '.deleted' => 0);
				}
				else
				{
					$this->hasMany[$model]['conditions'] = array_merge(array($model . '.deleted' => 0), (array) $this->hasMany[$model]['conditions']);
					//$query['conditions'] = array_merge(array($model . '.deleted' => 0), (array) $query['conditions']);
				}
			}
		}
	
		//hasOne
		foreach(array_keys($this->hasOne) as $model)
		{
			if(array_key_exists('deleted', $this->$model->_schema))
			{
				if(empty($this->hasOne[$model]['conditions']))
				{
					$this->hasOne[$model]['conditions'] = array($model . '.deleted' => 0);
				}
				else
				{
					$this->hasOne[$model]['conditions'] = array_merge(array($model . '.deleted' => 0), (array) $this->hasOne[$model]['conditions']);
					//$query['conditions'] = array_merge(array($model . '.deleted' => 0), (array) $query['conditions']);
				}
			}
		}
		
		return $query;
	}

	################## Validation Functions ##################

  /**
   * Ensures the ID that is tried to modify actually belongs to the claimed user_id.
   *
   * Asserts that user_id of the media ID is equal to the user_id of the request
   *
   * @param array $check Contains the ID to update.
   */
  public function checkIdOwnership($check) {
    $owner = $this->find('first', array('fields' => 'user_id', 'conditions' => array($this->name.'.id' => $check['id'])));
    return ($owner[$this->name]['user_id'] == $this->data[$this->name]['user_id']);
  }

  /**
   * A generic method to check whether the user requesting this edit has the right to do so.
   *
   * @param array $check Contains the teacher ID.
   */
  public function checkPermission($check) {
  	App::import('CakeSession');

    $session = new CakeSession();
    $user = $session->read("User");

    if ($user["role"] == "admin")
      return true;

    if ($user["id"] == $check['user_id'])
      return true;
    
    return false;
  }
	
}
?>