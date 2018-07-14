<?php 
	require "functions.php";
	
	$location = "";
	$content_file = "";
	
	
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
			include FILE_UPCOMINGEVENTS;
			aktualis();
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
			include FILE_THOUGHTS;
			gondolatok();
			break;
		case GET_VALUE_HISTORY: 
			$content_file = FILE_HISTORY;
			break;
		case GET_VALUE_GALERY: 
			include FILE_GALERY;
			galeria();
			break;
		case GET_VALUE_GALERYALL:
			include FILE_GALERYALL;
			galeria_osszes();
			break;
		default:
			$content_file = FILE_MAINPAGE;
			break;
	}
				
	$dailyWord = get_DailyWord();
	
	try{
		$main_page = new Page(FILE_FRAME);
		$main_page->insert_from_file(PLACEHOLDER_CONTENT, $content_file);
		$main_page->insert(PLACEHOLDER_DAILYWORD, $dailyWord);
		$main_page->show();
	}
	catch(Exception $ex){
		echo ERROR_OTHER_ERROR.$ex->getMessage();
	}
?>
