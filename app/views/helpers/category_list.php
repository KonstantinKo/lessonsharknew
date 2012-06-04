<?php
/**@brief An extended helper class.
 **/
class CategoryListHelper extends Helper {
	var $tab = ".";
/**@brief Specifies the other helper classes that are used.
 *
 * See also the SeoHelper (<code>views/helpers/seo.php</code>) class and HtmlHelper class (built-in).
 * */
	var $helpers = array('Html');

	function select($name, $data, $extra = '', $cat_id = null, $default = true) {

		list($modelName, $fieldName) = explode('/', $name);
		
		$selName = "parent_id";
		$output	= "<select name='data[".$modelName."][".$selName."]"."' class=".$extra.">";
		if($default != false){
		$output .= '<option class="selOpt_sub" value="0">Parent Category</option>'."\n";
		}
		$output .= $this->_list_element($data, $modelName, $fieldName, 0, $cat_id);
		$output	.= "</select>";
		return $this->output($output);
	}

	function _list_element($data, $modelName, $fieldName, $level, $cat_id) {
		
		$tabs = str_repeat($this->tab, $level * 2);
		$li_tabs = $tabs . $this->tab;
		$output = '';
		foreach ($data as $key=>$val) {

				$text = $this->_generate_link($val[$modelName]['id'], $val[$modelName]['active'], $val[$modelName][$fieldName]);
				
				$selected = null;
				if($val[$modelName]['id'] == $cat_id){
					$selected = 'selected';
				}
				
				//Do not add space when its parent category
				if($val[$modelName]['parent_id']!= 0){
					$output .=  '<option class="selOpt_sub" value="'.$val[$modelName]['id'].'" '.$selected.'>' . $li_tabs . $text."\n";
				}else{
					//Parent Cate
					$output .=  '<option class="selOpt_par" value="'.$val[$modelName]['id'].'" '.$selected.'>' . $text;
				}
			if(isset($val['children'][0])) {
				$output .= $this->_list_element($val['children'], $modelName, $fieldName, $level+1, $cat_id);
				//$output .= '</option>';
			} else {
				$output .= '</option>'."\n";
			}
		}
		//$output .= $tabs . '</ul>';

		return $output;
	}

	function _generate_link($id, $active, $name) {

			$text =  $name ;
			return $text;
	}

}
?>