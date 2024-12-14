<?php 
$get_content = function(){
    // ======= Üdvözlés =========
    $output =  file_get_contents_safe("content/fooldal.html");
    $output .= "<hr>\n";

    // ========= Aktuális eseméynek táblázat =======
    $output .= "<h3>Decemberi alkalmak</h3>\n";
    $output .= file_get_contents_safe("content/aktualis.html");
    $output .= "<hr>\n";


    //======= Aktuális alkalmak =========
    if(include "aktualis.php"){
        $output .= aktualis();
    }

    
    // ======== Főhír =============
    if(include "hir.php"){
        $output .= hir("adventi_est_2024");
        $output .= "<hr>\n";
    }
    

    // ======= Képek =========
    if(include "slideshow.php"){
        $output .= "<div id='fooldal_kepek'>\n";
        $galery = "img/galeria/";
        $folder = "konfirmacio_2023/";
        $album = 48;
        $title = "Konfirmació 2023";
        $files = scandir_safe_compact($galery.$folder);
        $output .= "<h3>$title</h3>";
        $output .= slideshow($galery, $folder, $files, "", 0);
        $output .= "<a href='?hely=galeria&album=$album' id='fooldal_kepek_link' title='$title'></a>\n";
        $output .= "</div>\n<hr>\n";
    }
    

    // ======= Ukrajna ========
    $output .=  file_get_contents_safe("content/ukrajna_fooldal.html");
 

    // ========== Slideshow script =======
    $output .= "<script src='script/step_slideshow.js'></script>";
    
    return $output;
};
?>
