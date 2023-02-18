<?php
function aktualis(){
    $output = "";

    $toc = file_get_contents_safe("content/aktualis/aktualis.txt");
    $lines = preg_split("/\n/", $toc);

    $filename = "";
    $title = "";
    $thumbnail = "";
    $now_reading = "filename";

    foreach($lines as $line){
        if(preg_match("/^ *#.*/", $line)){
            // ignore comments (lines staring with '#')
            continue;
        }

        if(preg_match("/^ *$/", $line) and $now_reading != "emptyline"){
            // ignore extra empty lines
            continue;
        }
        
        switch($now_reading){
            case "filename":
                $filename = $line;
                
                $now_reading = "title";
                break;
            case "title":
                $title = $line;

                $now_reading = "thumbnail";
                break;
            case "thumbnail":
                $thumbnail = $line;

                $now_reading = "emptyline";
                break;
            case "emptyline":
                $output .= "<a href='?hely=esemeny&cim=$filename' class='link_box aktualis_box'>\n";
                $output .= "    <img src='img/cikk/$thumbnail' alt=''>\n";
                $output .= "    <span>$title</span>\n";
                $output .= "</a>\n";

                $now_reading = "filename";
                break;
        }
    }

    return $output;
}

$get_content = function(){
    $output = "<h2>Aktuális</h2>\n";

    $output .= aktualis();

    $output .= file_get_contents_safe("content/aktualis.html");

    return $output;
};
?>
