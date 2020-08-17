<?php

//Uncomment for debugging
//ini_set('display_errors',1); 
//error_reporting(E_ALL);

require "functions.php";

$location = "";
$content = "";



try{
    $location = GETparameters::get_string(GET_KEY_LOCATION);
}
catch(OutOfBoundsException $ex){
    $location = GET_VALUE_MAINPAGE;
}

try{
    if($location == GET_VALUE_SLIDESHOW){
	if(include FILE_SLIDESHOW){
	    slideshow();
	    return;
	}
	else{
	    IAException_noSuchFile(FILE_SLIDESHOW);
	}
    }
    switch($location){
	case GET_VALUE_MAINPAGE:
	    if(include FILE_MAINPAGE){
		$content = fo_oldal();
	    }
	    else{
		IAException_noSuchFile(FILE_MAINPAGE);
	    }
	    break;
	case GET_VALUE_CONTACT: 
	    if(include FILE_CONTACTS){
		$content = elerhetosegek();
	    }
	    else{
		IAException_noSuchFile(FILE_CONTACTS);
	    }
	    break;
	case GET_VALUE_EVENTS: 
	    if(include FILE_EVENTS){
		$content = allando();
	    }
	    else{
		IAException_noSuchFile(FILE_EVENTS);
	    }
	    break;	
	case GET_VALUE_UPCOMINGEVENTS:
	    if(include FILE_UPCOMINGEVENTS){
		$content = aktualis();
	    }
	    else{
		IAException_noSuchFile(FILE_UPCOMINGEVENTS);
	    }
	    break;
	case GET_VALUE_ARCHIVE: 
	    if(include FILE_ARCHIVE){
		$content = archiv();
	    }
	    else{
		IAException_noSuchFile(FILE_ARCHIVE);
	    }
	    break;
	case GET_VALUE_CHARITY:
	    if(include FILE_CHARITY){
		$content = templomepites();
	    }
	    else{
		IAException_noSuchFile(FILE_CHARITY);
	    }
	    break;
	case GET_VALUE_PEOPLE:
	    if(include FILE_PEOPLE){
		$content = tisztsegviselok();
	    }
	    else{
		IAException_noSuchFile(FILE_PEOPLE);
	    }
	    break;
	case GET_VALUE_THOUGHTS:
	    if(include FILE_THOUGHTS){
		$content = gondolatok();
	    }
	    else{
		IAException_noSuchFile(FILE_THOUGHTS);
	    }
	    break;
	case GET_VALUE_HISTORY: 
	    if(include FILE_HISTORY){
		$content = tortenet();
	    }
	    else{
		IAException_noSuchFile(FILE_HISTORY);
	    }
	    break;
	case GET_VALUE_GALERY: 
	    if(include FILE_GALERY){
		$content = galeria();
	    }
	    else{
		IAException_noSuchFile(FILE_GALERY);
	    }
	    break;
	case GET_VALUE_GALERYALL:
	    if(include FILE_GALERYALL){
		$content = galeria_osszes();
	    }
	    else{
		IAException_noSuchFile(FILE_GALERYALL);
	    }
	    break;
	default:
	    if(include FILE_MAINPAGE){
		$content = fo_oldal();
	    }
	    else{
		IAException_noSuchFile(FILE_MAINPAGE);
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
}
else{
    $title = "Budakeszi Evangélikus Egyházközség";
}


try{
    $main_page = new Page(FILE_FRAME);
    $main_page->insert("Title", $title);
    $main_page->insert(PLACEHOLDER_CONTENT, $content);
    $main_page->insert(PLACEHOLDER_DAILYWORD, $dailyWord);
    $main_page->insert("News", $news);
    $main_page->insert_from_file(PLACEHOLDER_LASTMODIFIED, FILE_LASTMODIFIED);
    $main_page->show();
}
catch(Exception $ex){
    echo ERROR_INTERNAL_ERROR.$ex->getMessage();
}
?>
