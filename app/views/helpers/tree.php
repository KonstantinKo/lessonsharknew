<?php
/**@brief An extended helper class.
 **/
class TreeHelper extends Helper {
	var $tab = "  ";
/**@brief Specifies the other helper classes that are used.
 *
 * See also the SeoHelper (<code>views/helpers/seo.php</code>) class and HtmlHelper class (built-in).
 * */
	var $helpers = array('Html');

	function show($name, $data, $extra = '', $url = '') {
		list($modelName, $fieldName) = explode('/', $name);
		$output = $this->_list_element($data, $modelName, $fieldName, 0, $extra, $url);

		return $this->output($output);
	}

	function _list_element($data, $modelName, $fieldName, $level, $extra = '', $url = '') {
		$tabs = "\n" . str_repeat($this->tab, $level * 2);
		$li_tabs = $tabs . $this->tab;

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

		return $output;
	}

	function _generate_link($id, $active, $name, $url) {
		if(strstr($url, 'admin')) {
			$text = '<div style=" height: 20px;border-bottom: 1px solid #666666; border-top: 1px dashed #666666"><a href="' . $this->Html->url($url . $id) . '" class="lft_link">' . $name . '</a></div> <div style="background-color:#f3f3f3">'.$this->Html->link('Edit','/admin/categories/edit/'.$id,array('class'=>'blueLinks','title'=>'Edit')).' | '.$this->Html->link('View','/admin/categories/show/'.$id,array('class'=>'blueLinks','title'=>'View')).' | '.$this->Html->link('Delete','/admin/categories/delete/'.$id,array('class'=>'link_red','title'=>'Delete',''),'Are you sure that you want to delete?').'</div>';
		} else if(strstr($url, 'partner')) {
			$text = '<div style=" height: 20px;border-bottom: 1px solid #666666; border-top: 1px dashed #666666"><a href="' . $this->Html->url($url . $id) . '" class="lft_link">' . $name . '</a></div> <div style="background-color:#f3f3f3">'.$this->Html->link('Edit','/partners/category_edit/'.$id,array('class'=>'blueLinks','title'=>'Edit')).' | '.$this->Html->link('View','/partners/category_show/'.$id,array('class'=>'blueLinks','title'=>'View')).' |
			'.$this->Html->link('View Products','/partners/category/'.$id,array('class'=>'blueLinks','title'=>'View Products','')).' | '.$this->Html->link('Delete','/partners/category_delete/'.$id,array('class'=>'link_red','title'=>'Delete',''),'Are you sure that you want to delete?').'</div>';
		} else {
			$text = '<a href="' . $this->Seo->seolink($url, $name, $id) . '">' . $name . '</a>';
		}
		return $text;
	}

}
?>