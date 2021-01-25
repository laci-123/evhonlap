<?php

//Uncomment for debugging
ini_set('display_errors',1); 
error_reporting(E_ALL);

require "functions.php";

$location = "";
$content = "";



try{
    $location = GETparameters::get_string("hely");
}
catch(OutOfBoundsException $ex){
    $location = "fooldal";
}

try{
    if($location == "slideshow"){
	if(include "script/slideshow.php"){
	    slideshow();
	    return;
	}
	else{
	    IAException_noSuchFile("script/slideshow.php");
	}
    }
    switch($location){
	case "fooldal":
	    if(include "script/fo_oldal.php"){
		$content = fo_oldal();
	    }
	    else{
		IAException_noSuchFile("script/fo_oldal.php");
	    }
	    break;
	case "elerhetosegek": 
	    if(include "script/elerhetosegek.php"){
		$content = elerhetosegek();
	    }
	    else{
		IAException_noSuchFile("script/elerhetosegek.php");
	    }
	    break;
	case "alaklamak": 
	    if(include "script/allando.php"){
		$content = allando();
	    }
	    else{
		IAException_noSuchFile("script/allando.php");
	    }
	    break;	
	case "aktualis":
	    if(include "script/aktualis.php"){
		$content = aktualis();
	    }
	    else{
		IAException_noSuchFile("script/aktualis.php");
	    }
	    break;
	case "archiv": 
	    if(include "script/archiv.php"){
		$content = archiv();
	    }
	    else{
		IAException_noSuchFile("script/archiv.php");
	    }
	    break;
	case "templomepites":
	    if(include "script/templomepites.php"){
		$content = templomepites();
	    }
	    else{
		IAException_noSuchFile("script/templomepites.php");
	    }
	    break;
	case "tisztsegviselok":
	    if(include "script/tisztsegviselok.php"){
		$content = tisztsegviselok();
	    }
	    else{
		IAException_noSuchFile("script/tisztsegviselok.php");
	    }
	    break;
	case "gondolatok":
	    if(include "script/gondolatok.php"){
		$content = gondolatok();
	    }
	    else{
		IAException_noSuchFile("script/gondolatok.php");
	    }
	    break;
	case "tortenet": 
	    if(include "script/tortenet.php"){
		$content = tortenet();
	    }
	    else{
		IAException_noSuchFile("script/tortenet.php");
	    }
	    break;
	case "galéria": 
	    if(include "script/galeria.php"){
		$content = galeria();
	    }
	    else{
		IAException_noSuchFile("script/galeria.php");
	    }
	    break;
	case "galeria_osszes":
	    if(include "script/galeria_osszes.php"){
		$content = galeria_osszes();
	    }
	    else{
		IAException_noSuchFile("script/galeria_osszes.php");
	    }
	    break;
	default:
	    if(include "script/fo_oldal.php"){
		$content = fo_oldal();
	    }
	    else{
		IAException_noSuchFile("script/fo_oldal.php");
	    }
	    break;
    }
}
catch(InvalidArgumentException $ex){
    $content = ERROR_NOT_ACCESSIBLE;
}
catch(FileCannotBeOpenedException $ex){
    $content = ERROR_NOT_ACCESSIBLE;
}

if(include "script/uj.php"){
    $news = uj();
}
else{
    $news = ERROR_NOT_ACCESSIBLE;
}


$dailyWord = get_DailyWord();


if(preg_match("/localhost/", $_SERVER["HTTP_HOST"])){
    $title = "LOCAL";
    $statcounter = "statcounter_dummy.html";
}
else{
    $title = "Budakeszi Evangélikus Egyházközség";
    $statcounter = "statcounter.html";
}


try{
    $main_page = new Page("skeleton.html");
    $main_page->insert("Title", $title);
    $main_page->insert("content", $content);
    $main_page->insert("DailyWord", $dailyWord);
    $main_page->insert("News", $news);
    $main_page->insert_from_file("LastModified", "last_modified.txt");
    $main_page->insert_from_file("StatCounter", $statcounter);
    $main_page->show();
}
catch(Exception $ex){
    echo ERROR_INTERNAL_ERROR.$ex->getMessage();
}
?>
