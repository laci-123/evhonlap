<?php

const FOLDER_GALERY = "img/galeria/";

function slideshow(){
    $content = "";
    
    try{
	$folder = GETparameters::get_string("folder");
    }
    catch(OutOfBoundsException $ex){
	die("<b>Hibás URL-cím</b>\n<br><br>\n<a href='http://budakeszi.lutheran.hu'>Főoldal</a>");
    }

    try{
	$item = GETparameters::get_int("kep");
    }
    catch(OutOfBoundsException $ex){
	$item = 0;
    }

    try{
	$album_number = GETparameters::get_string("album");
    }
    catch(OutOfBoundsException $ex){
	$album = 1;
    }

    try{
	$files = scandir_safe_compact(FOLDER_GALERY.$folder);
    }
    catch(Exception $ex){
	die("<b>Error: </b>".$ex->getMessage());
    }
    
    $max_index = count($files) - 3;
    
    if($item < 0 or $item > $max_index){
	$item = 0;
    }
    if($item == 0){
	$prev_item = $max_index;
    }
    else{
	$prev_item = $item - 1;
    }
    if($item == $max_index){
	$next_item = 0;
    }
    else{
	$next_item = $item + 1;
    }

    $back_link = "<a id='back_link' href='?hely=galeria&album=".$album_number."'>Vissza a galériába</a>";
    
    $content .= "<a class='link' href='?hely=slideshow&folder=".$folder."&album=".$album_number."&kep=".$prev_item."'>&lt;&lt;Előző&lt;&lt;</a>";
    $content .= "<img src='img/galeria/".$folder."/".$files[$item]."'>\n";
    $content .= "<a class='link' href='?hely=slideshow&folder=".$folder."&album=".$album_number."&kep=".$next_item."'>&gt;&gt;Következő&gt;&gt;</a>";

    if(preg_match("/localhost/", $_SERVER["HTTP_HOST"])){
	$title = "LOCAL";
	$statcounter = "statcounter_dummy.html";
    }
    else{
	$title = "Budakeszi Evangélikus Egyházközség";
	$statcounter = "statcounter.html";
    }

    
    try{
	$main = new Page("slideshow_frame.html");
	$main->insert("back_link", $back_link);
	$main->insert("content", $content);
	$main->insert("Title", $title);
	$main->insert_from_file("StatCounter", $statcounter);
	$main->show();
    }
    catch(Exception $ex){
	echo "<b>Error: </b>".$ex->getMessage();
    }
}

?>
