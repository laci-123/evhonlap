<?php

//Uncomment for debugging
//ini_set('display_errors',1); 
//error_reporting(E_ALL);

require "functions.php";

const ERROR_NOT_ACCESSIBLE = "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el. </p>\n";
const ERROR_INTERNAL_ERROR = "<b>Váratlan hiba történt. </b> \n<br><br><br>\nRészletek: <br>\n";

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
	    throw new InvalidArgumentException("The file 'script/slideshow.php' does not exist. ");
	}
    }
    if(include "script/$location.php"){
        $content = get_content();
    }
    else{
        throw new InvalidArgumentException("The file 'script/$location' does not exist. ");
    }
}
catch(InvalidArgumentException $ex){
    $content = ERROR_NOT_ACCESSIBLE;
}
catch(FileCannotBeOpenedException $ex){
    $content = ERROR_NOT_ACCESSIBLE;
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
    $main_page->insert_from_file("LastModified", "last_modified.txt");
    $main_page->insert_from_file("StatCounter", $statcounter);
    $main_page->show();
}
catch(Exception $ex){
    echo ERROR_INTERNAL_ERROR.$ex->getMessage();
}
?>
