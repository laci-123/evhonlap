<?php
$get_content = function()
{	
    $output = file_get_contents_safe("content/alkalmaink.html");
    return $output;
};
?>
