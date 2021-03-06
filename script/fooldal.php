<?php 
$get_content = function(){
    $output =  file_get_contents_safe("content/fooldal.html");

    $files = scandir_safe_compact("content/aktualis/");
    foreach($files as $file){
        $name = substr($file, 0, strpos($file, "."));
        $output .= "<a href='?hely=esemeny&cim=$name' class='link_box aktualis_box'>\n";
        $output .= "<img src='img/cikk/$name.png' alt=''>\n";
        $file_content = file_get_contents_safe("content/aktualis/$file");
        $title = get_string_between($file_content, "<h2>", "</h2>");
        $output .= "<span>$title</span>\n";
        $output .= "</a>";
    }

    $output .= "<div id='fooldal_kepek'>\n";
    if(include "slideshow.php"){
	$galery = "img/galeria/";
	//TODO: automate
	$folder = "keszohidegkut_2022/";
	$album = 41;
	$title = "Keszőhidegkúti tábor 2022";
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
    $archiv = scandir_safe_compact("content/archiv");
    $archiv_last = count($archiv) - 1;
    $archiv_output = file_get_contents_safe("content/archiv/$archiv[$archiv_last]");

    $output .= $archiv_output;
    $output .= "<a href='?hely=archiv' class='backlink'>Régebbi események...</a>\n";
    $output .= "</div>\n<hr>\n";
    $output .= "<script src='script/step_slideshow.js'></script>";

    $output .= file_get_contents_safe("content/aktualis.html");
    
    return $output;
};
?>
