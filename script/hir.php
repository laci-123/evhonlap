<?php
$get_content = function()
{
    $file = getparam_string("cim");
    return file_get_contents_safe("content/archiv/$file.html");
};
?>
