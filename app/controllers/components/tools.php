<?php
/*
File: /app/controllers/components/tools.php
*/
class ToolsComponent extends Object
{
 
    function br2nl($str)
    {
    	return preg_replace('#<br\s*/?>#i', "", $str);
    	
    	//return $str;//_replace("\n\n", "\n", $str);
    }
}?>