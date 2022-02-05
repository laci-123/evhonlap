<?php
$get_content_uj = function()
{
    $file = getparam_string("cim");
    return file_get_contents_safe("content/aktualis/$file.html");
};
?>
