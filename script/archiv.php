<?php
$get_content = function(){
    $output = "<h2>Hírek</h2>\n";

    $toc = file_get_contents_safe("content/archiv/archiv.txt");
    $lines = preg_split("/\n/", $toc);

    $filename = "";
    $title = "";
    $thumbnail = "";
    $now_reading = "filename";

    $default_thumbnail = "allando/lutherrozsa.png";

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

                if($thumbnail == "?"){
                    $thumbnail = $default_thumbnail;
                }

                $now_reading = "emptyline";
                break;
            case "emptyline":
                $output .= "<a href='?hely=hir&cim=$filename' class='link_box archiv_box'>\n";
                $output .= "    <img src='img/$thumbnail' alt=''>\n";
                $output .= "    <span>$title</span>\n";
                $output .= "</a>\n";

                $now_reading = "filename";
                break;
        }
    }

    return $output;
};
?>
