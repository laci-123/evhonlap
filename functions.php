<?php

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
 * 
 * $filename: [string] the absolute or relative path of the file
 * returns: [string]
 * throws: 
 * 		InvalidArgumentException
 * 		FileCannotBeOpenedException*/
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
 * 
 * $dirname: [string] the absolute or relative path of the directory
 * returns: [array of string]
 * throws:
 * 		InvalidArgumentException
 * 		FileCannotBeOpenedException*/
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
 * $dirname: [string] the absolute or relative path of the directory
 * returns [array of string]
 * throws:
 *	IvalidArgumentException
 *	FileCannotBeOpenedException */
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

