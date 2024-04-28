<?php 
$get_content = function(){
    // ======= Üdvözlés =========
    $output =  file_get_contents_safe("content/fooldal.html");
    $output .= "<hr>\n";

    // ========= Aktuális eseméynek táblázat =======
    $output .= "<h3>Áprilisi alkalmak</h3>\n";
    $output .= file_get_contents_safe("content/aktualis.html");
    $output .= "<hr>\n";

    // ======== Főhír =============
    // if(include "hir.php"){
        $output .= "<div id='fooldal_archiv'>\n";
        /* $output .= hir("szarszo_2024"); */
        $output .= "<h3>Családi hétvége Balatonszárszón</h3>";
        $output .= "<img src='img/cikk/szarszo.jpg' width='50%'>";
        $output .= "<p>Idén az április 19-21. hétvégén tartottuk a mára hagyományossá váló balatonszárszói hétvégét, a „Szárszót”. A várva-várt eseményen kb. hatvanan vettünk részt, óvodástól nyugdíjasig minden korosztály képviseltette magát... ";
        $output .= "</p>";
        $output .= "<a href='?hely=hir&cim=szarszo_2024' class='backlink'>Folytatás</a>\n";
        $output .= "</div>\n";
        $output .= "<hr>\n";
    // }
    
    //======= Aktuális alkalmak =========
    if(include "aktualis.php"){
        $output .= aktualis();
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
