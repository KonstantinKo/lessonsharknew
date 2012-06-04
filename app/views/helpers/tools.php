<?php
/**@brief An extended helper class.
 **/
class ToolsHelper extends Helper
{
	function cleanup($output)
    {
    	$output = htmlentities($output);
    	
		return $output;
    }
    
	function cleanupAndKeepBR($output)
    {
    	$output = preg_replace('#<br\s*/?>#i', "", $output);
    	$output = htmlentities($output);
    	$output = nl2br($output);
    	
		return $output;
    }
}
?>