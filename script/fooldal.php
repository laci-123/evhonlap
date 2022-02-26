<?php 
$get_content = function(){
    $output =  file_get_contents_safe("content/fooldal.html");

    //TODO: automate
    $output .= "<a href='?hely=esemeny&cim=vilagimanap' class='link_box aktualis_box'>\n<img src='img/cikk/ökumenikus_világmanap.png' alt=''>\n<span>Ökumenikus Világimanap</span>\n</a>\n";
    $output .= "<hr>\n";

    $output .= "<div id='fooldal_kepek'>\n";
    if(include "slideshow.php"){
	$galery = "img/galeria/";
	//TODO: automate
	$folder = "szenteste_2021/";
	$album = 37;
	$title = "Szenteste 2021";
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

    $output .= "<div id='fooldal_archiv'>\n";
    $archiv = file_get_contents_safe("content/archiv.html");
    preg_match_all("/<!\-\-§(.*?)§\-\->/s", $archiv, $archiv_titles);
    $n_titles = count($archiv_titles) - 1;

    $archiv_output = get_string_between($archiv, $archiv_titles[1][$n_titles - 1], $archiv_titles[1][$n_titles]);
    $archiv_output = str_replace("<!--§", "", $archiv_output);
    $archiv_output = str_replace("§-->", "", $archiv_output);
    $archiv_output = str_replace("<hr>", "", $archiv_output);

    $output .= $archiv_output;
    $output .= "<a href='?hely=archiv' class='backlink'>Régebbi események...</a>\n";
    $output .= "</div>\n<hr>\n";
    $output .= "<script src='script/step_slideshow.js'></script>";

    $output .= file_get_contents_safe("content/aktualis.html");
    
    return $output;
};
?>
