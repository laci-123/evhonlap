<?php
$get_content = function()
{
    $base = "content/alkalom";
    $file = getparam_string("nev");
    $output = file_get_contents_safe("$base/$file.html");
    return $output;
};
?>
