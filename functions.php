<?php

//Returns a segment of a string between a given start and end point 
//(from: http://stackoverflow.com/questions/5696412/get-substring-between-two-strings-php)
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, strval($start));
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

//Returns the content of the URL given in $url. 
function get_url($url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($curl);
    if($result === false){
        throw new Exception(curl_error($curl), curl_errno($curl));
    }
    
    curl_close($curl);
    
    return $result;
}

function getparam_string($key){
	if(isset($_GET[$key]) and !is_null($_GET[$key])){
	    return $_GET[$key];
	}
	else{
	    throw new OutOfBoundsException("No string GET parameter belongs to the key '".$key."'");
	}
}

function getparam_int($key){
	if(isset($_GET[$key]) and is_numeric($_GET[$key]) and is_int(intval($_GET[$key]))){
	    return intval($_GET[$key]);
	}
	else{
	    throw new OutOfBoundsException("No integer GET parameter belongs to the key '".$key."'");
	}
}


/*
 * Exception for not being able to open a (probably existing) file. */
class FileCannotBeOpenedException extends Exception{
    function __construct($message){
	parent::__construct($message);
    }
}



/*
 * Gets contents of a file safely
 */
function file_get_contents_safe($filename){
    if(!file_exists($filename)){
	throw new InvalidArgumentException("The file '".$filename."' does not exist. ");
    }
    $content = file_get_contents($filename);
    if($content === false){
	throw new FileCannotBeOpenedException("The file '".$filename."' cannot be opened. ");
    }
    
    return $content;
}


/*
 * Safely gets a list of files in the given directory
 */
function scandir_safe($dirname){
    if(!file_exists($dirname)){
	throw new InvalidArgumentException("The directory '".$dirname."' does not exist. ");
    }
    $files = scandir($dirname);
    if($files === false){
	throw new FileCannotBeOpenedException("'".$dirname."' cannot be opened or is not a directory. ");
    }
    
    return $files;
}

/*
 * Safely gets a list of files in the given directory, without "." (same directory) and ".." (parent directory). 
 */
function scandir_safe_compact($dirname){
    $files = scandir_safe($dirname);
    if(($key = array_search(".", $files)) !== false){
	unset($files[$key]);
    }
    if(($key = array_search("..", $files)) !== false){
	unset($files[$key]);
    }
    return array_values($files);
}

