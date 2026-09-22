<?php 
$get_content = function(){
    // ======= Üdvözlés =========
    $output =  file_get_contents_safe("content/fooldal.html");
    $output .= "<hr>\n";


    //======= Aktuális alkalmak =========
    // if(include "aktualis.php"){
    //     $output .= aktualis();
    // }

    //======== Főhír =============
    $output .= "<a href='?hely=hir&cim=ot_eves_a_templom' class='link_box archiv_box'>\n";
    $output .= "    <img src='img/cikk/ot_eves_templom.png' alt=''>\n";
    $output .= "    <span>Öt éves a budakeszi templom</span>\n";
    $output .= "</a>\n";
    $output .= "<br>\n";

    // ========= Aktuális eseméynek táblázat =======
    $output .= "<h3>Nyári alkalmak</h3>\n";
    $output .= file_get_contents_safe("content/aktualis.html");
    $output .= "<hr>\n";


    // ======= Képek =========
    if(include "slideshow.php"){
        $output .= "<div id='fooldal_kepek'>\n";
        $galery = "img/galeria/";
        $folder = "napkozis_tabor_2026/";
        $album = 57;
        $title = "Napközis tábor 2026";
        $files = scandir_safe_compact($galery.$folder);
        $output .= "<h3>$title</h3>";
        $output .= slideshow($galery, $folder, $files, "", 0);
        $output .= "<a href='?hely=galeria&album=$album' id='fooldal_kepek_link' title='$title'></a>\n";
        $output .= "</div>\n<hr>\n";
    }
            

    // ======= Ukrajna ========
    $output .=  file_get_contents_safe("content/ukrajna_fooldal.html");
    $output .= "<hr>\n";


    // ======= Páylázat miatt kötelező kormányzati logók =======
    $output .= "<img src='img/cikk/allami_logok.png' width='100%'>\n";
 

    // ========== Slideshow script =======
    $output .= "<script src='script/step_slideshow.js'></script>";
    
    return $output;
};
?>
