<?php
$get_content = function(){
    $output = "<h2>Régebbi események</h2>\n";
    $files = scandir_safe_compact("content/archiv/");
    for($i = count($files) - 1; $i >= 0; --$i){
        $file = $files[$i];
        $name = substr($file, 0, strpos($file, "."));
        $output .= "<a href='?hely=hir&cim=$name' class='link_box'>\n";
        $output .= "<img src='img/cikk/$name.png' alt=''>\n";
        $file_content = file_get_contents_safe("content/archiv/$file");
        $title = get_string_between($file_content, "<h3>", "</h3>");
        $output .= "<span>$title</span>\n";
        $output .= "</a>";
    }

    return $output;
};
?>
