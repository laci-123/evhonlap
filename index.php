<?php

//Uncomment for debugging
 ini_set('display_errors',1); 
   error_reporting(E_ALL);

	require "functions.php";
	
	$location = "";
	$content_file = "";
	$content = "";
	
	
	try{
		$location = GETparameters::get_string(GET_KEY_LOCATION);
	}
	catch(OutOfBoundsException $ex){
		$location = GET_VALUE_MAINPAGE;
	}
	
	switch($location){
		case GET_VALUE_MAINPAGE:
			$content_file = FILE_MAINPAGE;
			break;
		case GET_VALUE_CONTACT: 
			$content_file = FILE_CONTACT;
			break;
		case GET_VALUE_EVENTS: 
			$content_file = FILE_EVENTS;
			break;
		case GET_VALUE_UPCOMINGEVENTS:
			if(include FILE_UPCOMINGEVENTS){
				$content = 	aktualis();
			}
			break;
		case GET_VALUE_NEWS:
			$content_file = FILE_NEWS;
			break;
		case GET_VALUE_ARCHIVE: 
			$content_file = FILE_ARCHIVE;
			break;
		case GET_VALUE_PEOPLE:
			$content_file = FILE_PEOPLE;
			break;
		case GET_VALUE_THOUGHTS:
			if(include FILE_THOUGHTS){
				$content = gondolatok();
			}
			break;
		case GET_VALUE_HISTORY: 
			$content_file = FILE_HISTORY;
			break;
		case GET_VALUE_GALERY: 
			if(include FILE_GALERY){
				$content = galeria();
			}
			break;
		case GET_VALUE_GALERYALL:
			if(include FILE_GALERYALL){
				$content = galeria_osszes();
			}
			break;
        case "slideshow":
            if(include "script/slideshow.php"){
                $content = slideshow();
            }
            echo $content;
            break;
		default:
			$content_file = FILE_MAINPAGE;
			break;
	}
				
	$dailyWord = get_DailyWord();
	
	try{
		if($content == ""){
			$content = file_get_contents_safe($content_file);
		}
		$main_page = new Page(FILE_FRAME);
		$main_page->insert(PLACEHOLDER_CONTENT, $content);
		$main_page->insert(PLACEHOLDER_DAILYWORD, $dailyWord);
		$main_page->show();
	}
	catch(Exception $ex){
		echo ERROR_OTHER_ERROR.$ex->getMessage();
        }
?>
