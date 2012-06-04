<!--
<div class="media_main_input_left">
	<div class="media_main_plus_img"><?php echo $html->image('plus_img.png'); ?></div>
	<input id="TeacherMediaLabel<?php echo $i ?>" name="data[TeacherMedia][label][]"
		type="text" placeholder="Media Label" class="media_main_input"
		<?php if ($media) echo "value='{$media['TeacherMedia']['label']}'"; ?> />
</div>

<div class="media_main_input_right">
	<input id="TeacherMediaUrl<?php echo $i ?>" name="data[TeacherMedia][url][]" 
		type="text" class="media_main_input_right_input" placeholder="Embed Code"
	<?php 
	if ($media) {
		switch ($media['TeacherMedia']['site']) {
			case 'youtube':
				$url = 'http://www.youtube.com/watch?v='.$media['TeacherMedia']['url'];
				break;
			case 'vimeo':
				$url = 'http://www.vimeo.com/'.$media['TeacherMedia']['url'];
				break;
			case 'soundcloud':
				$url = 'http://www.soundcloud.com/tracks/'.$media['TeacherMedia']['url'];
				break;
			default:
				$url = '';
		}
		echo "value='{$url}' />";
		echo "<div class='media_main_input_right_delet'>";
		// echo $html->link(__('Delete', true), array( 'controller' => 'teachers', 'action' => 'delmedia',$id,$media1['TeacherMedia']['id']),array('id'=>'deletebutton'),'Are you sure you want to delete?');
		echo "</div>";
	} else {
		echo "/>";
	}
	?>
</div>
-->
<?php
$labeloptions = array(
	"placeholder" => "(Media Label)", 
	"class" => "media_main_input", 
	"label" => false,
	"div" => array("class" => "media_main_input_left"));
$urloptions = array(
	"placeholder" => "(Embed Code)", 
	"class" => "media_main_input_right_input", 
	"label" => false,
	"div" => array("class" => "media_main_input_right"),
	"maxlength" => false);

if ($media)
	$labeloptions["value"] = htmlspecialchars_decode($media['TeacherMedia']['label'], ENT_QUOTES);

if ($media || isset($this->params['data']['TeacherMedia'][$i]['url']))
{
	$baseURL = ($media) ? $media['TeacherMedia']['url'] : $this->params['data']['TeacherMedia'][$i]['url'];
	$baseSite = ($media) ? $media['TeacherMedia']['site'] : $this->params['data']['TeacherMedia'][$i]['site'];
	
	switch ($baseSite) {
		case 'youtube':
			$url = 'http://www.youtube.com/watch?v='.$baseURL;
			break;
		case 'vimeo':
			$url = 'http://www.vimeo.com/'.$baseURL;
			break;
		case 'soundcloud':
			$url = 'http://api.soundcloud.com/tracks/'.$baseURL;
			break;
		default:
			$url = '';
	}
	$urloptions["value"] = $url;
}

if (isset($errors[$i])) {
	if (isset($errors[$i]['site']))
		$urloptions["after"] = "Please fill out this field.";
	if (isset($errors[$i]['label']))
		$labeloptions["after"] = "Please fill out this field.";
}



echo $form->input("TeacherMedia.$i.label", $labeloptions);
echo $form->input("TeacherMedia.$i.url", $urloptions);
if ($media)
{
	echo $form->hidden("TeacherMedia.$i.user_id", array("value" => $media['TeacherMedia']['user_id']));
	echo $form->hidden("TeacherMedia.$i.id", array("value" => $media['TeacherMedia']['id']));

	echo "<div class='media_main_input_right_delet'>";
	echo $html->link(__('Delete', true), array( 'controller' => 'teachers', 'action' => 'delmedia', $media['TeacherMedia']['id']),array('id'=>'deletebutton'),'Are you sure you want to delete?');
	echo "</div>";
}
else
{
	echo $form->hidden("TeacherMedia.$i.user_id", array("value" => $user_id));
}
?>