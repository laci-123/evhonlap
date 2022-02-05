<?php
$get_content_uj = function()
{	
    $output = file_get_contents_safe("content/alkalmaink_uj.html");
    return $output;
};
?>
