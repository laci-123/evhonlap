<?php 
$get_content = function(){
    // ======= Üdvözlés =========
    $output =  file_get_contents_safe("content/fooldal.html");
    $output .= "<hr>\n";

    //======= Aktuális alkalmak =========
    if(include "aktualis.php"){
        $output .= aktualis();
    }


    // ========= Aktuális eseméynek táblázat =======
    $output .= "<h3>Januári alkalmak</h3>\n";
    $output .= file_get_contents_safe("content/aktualis.html");
    $output .= "<hr>\n";


    // ======= Képek =========
    if(include "slideshow.php"){
        $output .= "<div id='fooldal_kepek'>\n";
        $galery = "img/galeria/";
        $folder = "ars_sacra_zaro_2025/";
        $album = 56;
        $title = "Ars Sacra Fesztivál 2025";
        $files = scandir_safe_compact($galery.$folder);
        $output .= "<h3>$title</h3>";
        $output .= slideshow($galery, $folder, $files, "", 0);
        $output .= "<a href='?hely=galeria&album=$album' id='fooldal_kepek_link' title='$title'></a>\n";
        $output .= "</div>\n<hr>\n";
    }

            
    //======== Főhír =============
    // if(include "hir.php"){
    //     $output .= hir("adventi_est_2024");
    //     $output .= "<hr>\n";
    // }
    $output .= "<a href='?hely=hir&cim=benczur_emese' class='link_box archiv_box'>\n";
    $output .= "    <img src='img/cikk/ars_sacra_logo.png' alt=''>\n";
    $output .= "    <span>Ars Sacra Fesztivál 2025.09.13 megnyitó</span>\n";
    $output .= "</a>\n";
    $output .= "<hr>\n";


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
