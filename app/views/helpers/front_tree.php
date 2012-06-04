<?php
/**@brief An extended helper class.
 **/
class FrontTreeHelper extends Helper {
	var $tab = "  ";
/**@brief Specifies the other helper classes that are used.
 *
 * See also the SeoHelper (<code>views/helpers/seo.php</code>) class and HtmlHelper class (built-in).
 * */
	var $helpers 	= array('Html','Javascript','Ajax');


	function show($name, $data, $extra = '', $url = '') {
		list($modelName, $fieldName) = explode('/', $name);
		$output = $this->_list_element($data, $modelName, $fieldName, 0, $extra, $url);

		return $this->output($output);
	}

	function _list_element($data, $modelName, $fieldName, $level, $extra = '', $url = '') {
		$tabs = "\n" . str_repeat($this->tab, $level * 2);
		$li_tabs = $tabs . $this->tab;

		//Start: Output
		
		$output = $tabs. '<ul' . $extra . '>';
		foreach ($data as $key=>$val) {
			if(empty($url)) {
				$text = $val[$modelName][$fieldName];
			} else {
				$text = $this->_generate_link($val[$modelName]['id'], $val[$modelName]['active'], $val[$modelName][$fieldName], $url);
			}
			$output .= $li_tabs . '<li>' . $text;
			if(isset($val['children'][0])) {
				$output .= $this->_list_element($val['children'], $modelName, $fieldName, $level+1, '', $url);
				$output .= $li_tabs . '</li>';
			} else {
				$output .= '</li>';
			}
		}
		$output .= $tabs . '</ul>';
		//End: Output
		
		
		return $output;
	}

	function _generate_link($id, $active, $name, $url) {
		if(strstr($url, 'admin')) {
			
			//Show left bar links as per controller
			if( $this->params['controller'] == 'categories' && $this->params['action'] != 'advance_search'  && $this->params['action'] != 'search'  && $this->params['action'] != 'advance_search_result'){	
			$text = $this->Ajax->link($name, '#', array('update'=>'content', 'url' => "/products/showCatFeatured/".$id, 'loading' => 'Effect.BlindDown(\'content\')') );
			}else{
			$text = $this->Html->link($name, '/products/showCatFeatured/'.$id );	
			}
			
		} else {
			$text = '<a href="' . $this->Seo->seolink($url, $name, $id) . '">' . $name . '</a>';
		}
		return $text;
	}

}
?>