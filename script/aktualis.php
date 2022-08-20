<?php
$get_content = function(){
    $output = "<h2>Aktuális</h2>\n";
    $files = scandir_safe_compact("content/aktualis/");
    foreach($files as $file){
        $name = substr($file, 0, strpos($file, "."));
        $output .= "<a href='?hely=esemeny&cim=$name' class='link_box aktualis_box'>\n";
        $img_name = preg_replace("/^[0-9]*_/", "", $name);
        $output .= "<img src='img/cikk/$img_name.png' alt=''>\n";
        $file_content = file_get_contents_safe("content/aktualis/$file");
        $title = get_string_between($file_content, "<h2>", "</h2>");
        $output .= "<span>$title</span>\n";
        $output .= "</a>";
    }
    $output .= file_get_contents_safe("content/aktualis.html");

    return $output;
};
?>
