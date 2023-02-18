<?php
function hir($file){
    return file_get_contents_safe("content/archiv/$file.html");
}

$get_content = function()
{
    $file = getparam_string("cim");
    $output = hir($file);
    $output .= '<br><a href="?hely=archiv" class="backlink">Vissza</a>';
    return $output;
};
?>
