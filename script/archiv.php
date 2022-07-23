<?php
function get_image($str){
    $img_src = get_string_between($str, "<img src=\"", "\"");
    if($img_src == ""){
        $img_src = "img/allando/lutherrozsa.png";
    }
    return $img_src;
}

$get_content = function(){
    $output = "<h2>Régebbi események</h2>\n";
    $files = scandir_safe_compact("content/archiv/");
    for($i = count($files) - 1; $i >= 0; --$i){
        $file = $files[$i];
        $name = substr($file, 0, strpos($file, "."));
        $output .= "<a href='?hely=hir&cim=$name' class='link_box archiv_box'>\n";
        $file_content = file_get_contents_safe("content/archiv/$file");
        $img_src = get_image($file_content);
        $output .= "<img src='$img_src' alt=''>\n";
        $title = get_string_between($file_content, "<h2>", "</h2>");
        $output .= "<span>$title</span>\n";
        $output .= "</a>";
    }

    return $output;
};
?>
