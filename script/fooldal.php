<?php 
$get_content = function(){
    // ======= Üdvözlés =========
    $output =  file_get_contents_safe("content/fooldal.html");
    $output .= "<hr>\n";

    // ======= Aktuális alkalmak =========
    $files = scandir_safe_compact("content/aktualis/");
    foreach($files as $file){
        $name         = substr($file, 0, strpos($file, "."));
        $output       .= "<a href='?hely=esemeny&cim=$name' class='link_box aktualis_box'>\n";
        $img_name     = preg_replace("/^[0-9]*_/", "", $name);
        $output       .= "<img src='img/cikk/Thumbnails/$img_name.png' alt=''>\n";
        $file_content = file_get_contents_safe("content/aktualis/$file");
        $title        = get_string_between($file_content, "<h2>", "</h2>");
        $output       .= "<span>$title</span>\n";
        $output       .= "</a>";
    }
    $output .= "<hr>\n";

    // ======= Ukrajna ========
    $output .=  file_get_contents_safe("content/ukrajna_fooldal.html");
    $output .= "<hr>\n";

    // ======= Képek =========
    $output .= "<div id='fooldal_kepek'>\n";
    if(include "slideshow.php"){
        $galery = "img/galeria/";
        $folder = "musa/";
        $album = 45;
        $title = "Panti Filibus Musa, a Lutheránus Világszövetség elnöke meglátogatta templomunkat";
        try{
            $files = scandir_safe_compact($galery.$folder);
            $output .= "<h3>$title</h3>";
            $output .= slideshow($galery, $folder, $files, "", 0);
            $output .= "<a href='?hely=galeria&album=$album' id='fooldal_kepek_link' title='$title'></a>\n";
        }
        catch(Exception $ex){
                $output .= "<b>Error: </b>".$ex->getMessage();
        }
    }
    $output .= "</div>\n<hr>\n";

    // ======== Hírek =============
    $output .= "<div id='fooldal_archiv'>\n";
    $archiv = scandir_safe_compact("content/archiv");
    $archiv_last = count($archiv) - 1;
    $archiv_output = file_get_contents_safe("content/archiv/$archiv[$archiv_last]");

    $output .= $archiv_output;
    $output .= "<a href='?hely=archiv' class='backlink'>Régebbi események...</a>\n";
    $output .= "</div>\n<hr>\n";
 
    // ========= Aktuális eseméynek táblázat =======
    $output .= file_get_contents_safe("content/aktualis.html");

    // ========== Script =======
    $output .= "<script src='script/step_slideshow.js'></script>";
    
    return $output;
};
?>
