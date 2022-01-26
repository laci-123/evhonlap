<?php 
$get_content = function(){
    return file_get_contents_safe("content/fooldal.html");
};

$get_content_uj = function(){
    $output =  file_get_contents_safe("content/fooldal_uj.html");

    //TODO: automate
    $output .= "<a href='img/cikk/pelda1.pdf' class='link_box aktualis_box_odd'>\n<img src='img/cikk/pelda1.png' alt=''>\n<span>Példa Esemény</span>\n</a>\n";
    $output .= "<a href='img/cikk/pelda2.pdf' class='link_box aktualis_box_even'>\n<img src='img/cikk/pelda2.png' alt=''>\n<span>Teszt Alkalom</span>\n</a>\n";
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
    $output .= "<a href='?hely=archiv' class='link_box'>Régebbi események...</a>\n";
    $output .= "</div>\n<hr>\n";
    $output .= "<script src='script/step_slideshow.js'></script>";

    $output .= file_get_contents_safe("content/alkalmak.html");
    
    return $output;
};
?>
