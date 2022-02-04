<?php


$get_content_uj = function()
{	
    $folder = "content/igehirdetesek";
    $output = "";
    
    $output .= "<h2>Igehirdetések</h2>\n";

    $dirs = scandir_safe_compact($folder);
    arsort($dirs);
    
    foreach($dirs as $directory){
	$output .= "<a href='$folder/$directory' class='igehirdetes_box'>\n";
	$output .= file_get_contents_safe("$folder/$directory");
	$output .= "</a>\n";
    }
    
    
    
    return $output;
};
?>
