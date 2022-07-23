<?php
$get_content = function()
{
    $file = getparam_string("cim");
    $output = file_get_contents_safe("content/archiv/$file.html");
    $output .= '<br><a href="?hely=archiv" class="backlink">Vissza</a>';
    return $output;
};
?>
