<?php
$get_content = function()
{	
    $base = "content/igehirdetesek";
    $output = "";
    
    $output .= "<h2>Igehirdetések</h2>\n";

    $dirs = scandir_safe_compact($base);
    arsort($dirs);
    
    foreach($dirs as $directory){
	$date = str_replace("_", ".", $directory);
	$date = str_replace(".html", "", $date);
	$output .= "<div class='igehirdetes_wrapper' title='Igehirdetés, $date'>\n";
	$href = "?hely=igehirdetes&datum=$date";
	$output .= "<div onclick='location.href=\"$href\"' class='igehirdetes_box'>\n";
	$output .= file_get_contents_safe("$base/$directory");
	$output .= "</div>\n";
	$output .= "</div>\n";
    }
    
    return $output;
};
?>
