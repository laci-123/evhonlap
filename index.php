<?php

//Uncomment for debugging
 	//ini_set('display_errors',1); 
   	//error_reporting(E_ALL);

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
	
	try{
		if($location == GET_VALUE_SLIDESHOW){
			if(include FILE_SLIDESHOW){
				slideshow();
				return;
			 }
			 else{
			 	throw new InvalidArgumentException("The file '".FILE_SLIDESHOW."' does not exist.");
			}
		}
		switch($location){
			case GET_VALUE_MAINPAGE:
				if(include FILE_MAINPAGE){
					$content = fo_oldal();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_MAINPAGE."' does not exist.");
				}
				break;
			case GET_VALUE_CONTACT: 
				if(include FILE_CONTACTS){
					$content = elerhetosegek();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_CONTACTS."' does not exist.");
				}
				break;
			case GET_VALUE_EVENTS: 
				if(include FILE_EVENTS){
					$content = allando();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_EVENTS."' does not exist.");
				}
				break;	
			case GET_VALUE_UPCOMINGEVENTS:
				if(include FILE_UPCOMINGEVENTS){
					$content = aktualis();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_UPCOMINGEVENTS."' does not exist.");
				}
				break;
			case GET_VALUE_ARCHIVE: 
				if(include FILE_ARCHIVE){
					$content = archiv();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_ARCHIVE."' does not exist.");
				}
				break;
			case GET_VALUE_CHARITY:
				if(include FILE_CHARITY){
					$content = templomepites();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_CHARITY."' does not exist.");
				}
				break;
			case GET_VALUE_PEOPLE:
				if(include FILE_PEOPLE){
					$content = tisztsegviselok();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_PEOPLE."' does not exist.");
				}
				break;
			case GET_VALUE_THOUGHTS:
				if(include FILE_THOUGHTS){
					$content = gondolatok();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_THOUGHTS."' does not exist.");
				}
				break;
			case GET_VALUE_HISTORY: 
				if(include FILE_HISTORY){
					$content = tortenet();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_HISTORY."'does not exist.");
				}
				break;
			case GET_VALUE_GALERY: 
				if(include FILE_GALERY){
					$content = galeria();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_GALERY."'does not exist.");
				}
				break;
			case GET_VALUE_GALERYALL:
				if(include FILE_GALERYALL){
					$content = galeria_osszes();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_GALERYALL."'does not exist.");
				}
				break;
			case "galeria2":	//Experimental
				if(include "script/galeria2.php"){
					$content = galeria2();
				}
				else{
					throw new InvalidArgumentException("The file 'script/galeria2.php' does not exist.");
				}
				break;
			default:
				if(include FILE_MAINPAGE){
					$content = fo_oldal();
				}
				else{
					throw new InvalidArgumentException("The file '".FILE_MAINPAGE."' does not exist.");
				}
				break;
		}
	}
	catch(InvalidArgumentException $ex){
		$content = ERROR_NOT_ACCESSIBLE;
	}
				
	$dailyWord = get_DailyWord();
	
	try{
		$main_page = new Page(FILE_FRAME);
		$main_page->insert(PLACEHOLDER_CONTENT, $content);
		$main_page->insert(PLACEHOLDER_DAILYWORD, $dailyWord);
		$main_page->insert_from_file(PLACEHOLDER_LASTMODIFIED, FILE_LASTMODIFIED);
		$main_page->show();
	}
	catch(Exception $ex){
		echo ERROR_INTERNAL_ERROR.$ex->getMessage();
    }
?>
