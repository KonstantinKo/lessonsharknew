<?php
/**@brief An extended helper class.
 **/
class ApplicationHelper extends Helper
{
	function cleanup($output)
    {
    	$putput = htmlentities($output);
    	
		return $outpput;
    }
}
?>