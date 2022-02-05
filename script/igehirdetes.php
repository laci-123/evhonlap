<?php
$get_content_uj = function()
{	
    $base = "content/igehirdetesek";
    
    $file = getparam_string("datum");
    $file = str_replace(".", "_", $file);
    $file = "$base/$file.html";

    $output = file_get_contents_safe($file);
    $output = str_replace("h3", "h2", $output);
    $output = str_replace("h4", "h3", $output);
    $output .= "<a href='?hely=igehirdetesek' class='backlink' id='igehirdetes_vissza'>Vissza</a>\n";

    return $output;
};
?>
