<?php 
$get_content = function(){
    // ======= Üdvözlés =========
    $output =  file_get_contents_safe("content/fooldal.html");
    $output .= "<hr>\n";

    // ========= Aktuális eseméynek táblázat =======
    /* $output .= "<h3>Júniusi alkalmak</h3>\n";
     * $output .= file_get_contents_safe("content/aktualis.html");
     * $output .= "<hr>\n";
     */

    //======= Aktuális alkalmak =========
    if(include "aktualis.php"){
        $output .= aktualis();
        $output .= "<hr>\n";
    }
    

    // ======= Ukrajna ========
    $output .=  file_get_contents_safe("content/ukrajna_fooldal.html");
    $output .= "<hr>\n";

    // ======== Főhír =============
        if(include "hir.php"){
            $output .= "<div id='fooldal_archiv'>\n";
            $output .= hir("nyari_taborok_2023");
            $output .= "<a href='?hely=archiv' class='backlink'>Régebbi események...</a>\n";
            $output .= "</div>\n<hr>\n";
        }

    // ======= Képek =========
    if(include "slideshow.php"){
        $output .= "<div id='fooldal_kepek'>\n";
        $galery = "img/galeria/";
        $folder = "balatonszarszo_2023/";
        $album = 48;
        $title = "Gyülekezeti hétvége Balatonszárszón";
        $files = scandir_safe_compact($galery.$folder);
        $output .= "<h3>$title</h3>";
        $output .= slideshow($galery, $folder, $files, "", 0);
        $output .= "<a href='?hely=galeria&album=$album' id='fooldal_kepek_link' title='$title'></a>\n";
        $output .= "</div>\n";
    }
 
    // ========== Slideshow script =======
    $output .= "<script src='script/step_slideshow.js'></script>";
    
    return $output;
};
?>
