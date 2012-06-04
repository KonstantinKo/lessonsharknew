<?php
/**
 * TeacherMedia stores embed IDs of Youtube or Vimeo videos or Soundcloud songs.
 */
class TeacherMedia extends AppModel {

  public $name	= 'TeacherMedia';
  public $belongsTo = array('User');

  //Validation Rules  
  var $validate = array(
    'id' => array(
      'blankOnCreate' => array(
        'rule' => 'blank',
        'on'   => 'create'),
      'belongsToTeacher' => array(
        'rule' => 'checkIdOwnership',
        'on'   => 'update'
      ),
      'numeric' => array(
        'rule' => 'numeric',
        'on'   => 'update'
      )
    ),
    'user_id' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false
      ),
      'ownedOrAdmin' => array(
        'rule' => 'checkPermission',
        'message' => "You're not allowed to edit this profile. Your login may have expired."
      ),
      'numeric' => array(
        'rule' => 'numeric'
      )
    ),
    'label' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowEmpty'  => false,
        'message'     => 'Label is Required'
      ),
      'length' => array(
        'rule'    => array('maxLength', 250),
        'message' => "Please keep the description short. (Below 250 characters)"
      )
    ),
    'url' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowempty'  => false,
        'message'     => 'Embed Code is required'
      ),
      'format' => array(
        'rule' => '/[A-Za-z0-9\-_]/'
      ),
      'length' => array(
        'rule'    => array('maxLength', 12)
      )
    ),
    'site' => array(
      'notEmpty' => array(
        'rule'        => 'notEmpty',
        'required'    => true,
        'allowempty'  => false
      ),
      'oneOf' => array(
        'rule' => array('inList', array('youtube', 'vimeo', 'soundcloud'))
      )
    ),
  );

  ################# Callback Methods ###################

  /**
   * Pseudo Callback, manually called to modify data ONCE before
   *
   * @todo Sanitize clears out special characters that get transmitted - fix that.
   */
  public function beforeEverything() {

    // Sanitize Data
    #debug($this->data);
    $this->data = Sanitize::clean($this->data);
    #debug($this->data);

    // Handle different formats of URLs
    $set = &$this->data[$this->name];
    if (!empty($set)) {
      for ($i = 0; $i < count($set); $i++) {
        if ($set[$i]['url'])
          $set[$i]['url'] = $this->transformURL($set[$i]['url'], $i);
        else if (empty($set[$i]['label']))
          array_splice($set, $i);
      }
    }

    return $this->data;
  }

  public function beforeValidate() {
    #debug($this->data);

    return true;
  }

  public function beforeDelete() {
    $return = false;

    $user_id = $this->find('first', array(
      'fields' => 'TeacherMedia.user_id', 
      'conditions' => array(
        'TeacherMedia.id' => $this->id['TeacherMedia.id'])));
    $return = $this->checkPermission(array("user_id" => $user_id['TeacherMedia']['user_id']));

    #echo ($return) ? "true" : "false";
    return $return;
  }

  ################## Utility Functions ##################

  /**
   * Transforms the user-given input into a usable ID
   *
   * This function works on the assumption that:
   * - A YouTube ID has 11 numbers, letters or characters - appear after video/ OR "v=" GET param
   * - A Vimeo IDs have a variable amount of numbers - appear after vimeo.com/
   * - A SoundCloud ID has a variable amount of numbers or letters - only embed link allowed
   */
  private function transformURL($raw, $i) {

    // Figure out which site this belongs to
    if (strpos($raw, 'soundcloud') !== false)
      $site = 'soundcloud';
    else if (strpos($raw, 'youtube') !== false)
      $site = 'youtube';
    else if (strpos($raw, 'vimeo') !== false)
      $site = 'vimeo';
    else
      $site = false;

    // Save that information
    $this->data[$this->name][$i]['site'] = $site;

    // Get URL-section with the ID by REGEX
    if ($site == "vimeo")
      $url = preg_match("~vimeo.com/([0-9]+|video/[0-9]+)+~", $raw, $matches);
    else
      $url = preg_match("~(soundcloud|youtube).com/\S*(v=|tracks%2F|tracks/|embed/)[A-Za-z0-9\-_]+~", $raw, $matches);

    $url = $matches[0];

    // Throw out everything but the ID
    if ($site == "vimeo") {
      $url = $this->getStuffAfter("/", $url);
    }
    else if ($site == "youtube") {
      $url = $this->getStuffAfter("v=", $url);
      $url = $this->getStuffAfter("/", $url);
    }
    else if ($site == "soundcloud") {
      $url = $this->getStuffAfter("%2F", $url);
      $url = $this->getStuffAfter("/", $url);
    }

    return $url;
  }

  /**
   * Utitliy Function for transformURL to get the part of $string after the last occurence of $delimiter.
   *
   * @param string $delimiter
   * @param string $string
   */
  private function getStuffAfter($delimiter, $string) {
    $string = explode($delimiter, $string);
    $string = $string[count($string)-1];

    return $string;
  }
}
?>