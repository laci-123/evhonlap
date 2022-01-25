<?php 
$get_content = function(){
    return file_get_contents_safe("content/fooldal.html");
};

$get_content_uj = function(){
    $output =  file_get_contents_safe("content/fooldal_uj.html");
    
    $output .= "<p style='font-family: monospace; margin-top: 6em; margin-bottom: 6em;'>%%%%%%%% Ide jönnek majd az aktuális alkalmak. %%%%%%%%</p>\n";
    
    if(include "slideshow.php"){
	$galery = "img/galeria/";
	$folder = "szenteste_2021/";
	try{
	    $files = scandir_safe_compact($galery.$folder);
            $output .= slideshow($galery, $folder, $files, "", 1);
	}
	catch(Exception $ex){
            $output .= "<b>Error: </b>".$ex->getMessage();
	}
    }

    $output .= "<p style='font-family: monospace; margin-top: 6em; margin-bottom: 6em;'>%%%%%%%% Ide jönnek majd a hírek. %%%%%%%%</p>\n";

    $output .= file_get_contents_safe("content/alkalmak.html");
    
    return $output;
};
?>
