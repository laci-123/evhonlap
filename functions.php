<?php
	
	require "constants.php";

	/*
	 * Returns the content of the URL given in $url. 
	 * 
	 * $url: [string] 
	 * returns: [string]
	 * throws: Exception with the internal error message and error code. 
	 * */
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
	
	/*
	 * Returns the Daily Word from evangelikus.hu. 
	 * 
	 * returns: [string]
	 * */
	function get_DailyWord(){
		try{
			$ige = "";
			$tartalom = get_url(URL_EVANGELIKUSHU);
			preg_match("/Napi ige: <\/a>(.*?)&nbsp;/s", $tartalom, $ige);
			$ige = preg_replace("/Napi ige: <\/a>/", "", $ige);
			$ige = preg_replace("/<\/p>/", "", $ige);
			$ige = preg_replace("/õ/", "ő", $ige);  
			$ige = preg_replace("/û/", "ű", $ige);
			
			return $ige[0];
		}
		catch(Exception $e){
			return ERROR_DAILYWORD_NOT_ACCESSIBLE;
		}
	}
	
	/*
	 * Functions to safely get the values of GET parameters. 
	 * 
	 * All functions:
	 * 		$key: [string] 
	 * 		returns: [their respective type named in their name]
	 * 		throws: OutOfBoundsException
	 * 		*/
	class GETparameters{
		public static function get_string($key){
			if(isset($_GET[$key]) and !is_null($_GET[$key])){
				return $_GET[$key];
			}
			else{
				throw new OutOfBoundsException("No string GET parameter belongs to the key '".$key."'");
			}
		}
		
		public static function get_float($key){
			if(isset($_GET[$key]) and is_numeric($_GET[$key])){
				return floatval($_GET[$key]);
			}
			else{
				throw new OutOfBoundsException("No float GET parameter belongs to the key '".$key."'");
			}
		}
		
		public static function get_int($key){
			if(isset($_GET[$key]) and is_numeric($_GET[$key]) and is_int(intval($_GET[$key]))){
				return intval($_GET[$key]);
			}
			else{
				throw new OutOfBoundsException("No integer GET parameter belongs to the key '".$key."'");
			}
		}
		
		public static function get_boolean($key){
			if(isset($_GET[$key])){
				if(strcasecmp($_GET[$key], "true") == 0){
					return true;
				}
				else if(strcasecmp($_GET[$key], "false") == 0){
					return false;
				}
				else{
					throw new OutOfBoundsException("No boolean GET parameter belongs to the key '".$key."'");
				}
			}
			else{
				throw new OutOfBoundsException("No boolean GET parameter belongs to the key '".$key."'");
			}
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
	 * A html page loaded from a template html file. 
	 * The template file can have placeholders which can be filled with the $insert functions. 
	 * The placeholders has to be in {{name}} format, where name is the name of the placeholder. 
	 * */
	class Page{
		private $page;
		private $file_name;
		
		/*
		 * Constructor
		 * 
		 * $template_file: [string] the full or relative path of the teplate html file
		 * throws: 
		 * 		InvalidArgumentException
		 * 		FileCannotBeOpenedException
		 * */
		function __construct($template_file){
			if(!file_exists($template_file)){
				throw new InvalidArgumentException("The file '".$template_file."' does not exist. ");
			}
			$this->page = file_get_contents($template_file);
			if($this->page === false){
				throw new FileCannotBeOpenedException("The file '".$template_file."' cannot be opened. ");
			}
			
			$this->file_name = $template_file;
		}
		
		/*
		 * Replaces the given placeholder in the template html file with $replacement
		 * 
		 * $placeholder: [string] without the '{{' and '}}'
		 * $replacement: [string]
		 * returns: [void]*/
		function insert($placeholder, $replacement){
			$counter = 0;
			$this->page = str_replace("{{".$placeholder."}}", $replacement, $this->page, $counter);
			if($counter === 0){
				throw new InvalidArgumentException("The template file '".$this->file_name."' has no placeholder named '".$placeholder."' ");
			}
		}
		
		/*
		 * Replaces the given placeholder in the template html file with the contents of the file given by $filename 
		 * 
		 * $placeholder: [string] without the '{{' and '}}'
		 * $filename: [string] the full or relative path of the file
		 * returns: [void]
		 * throws: FileCannotBeOpenedException*/
		function insert_from_file($placeholder, $filename){
			if(!file_exists($filename)){
				throw new InvalidArgumentException("The file '".$filename."' does not exist. ");
			}
			$replacement = file_get_contents($filename);
			if($replacement === false){
				throw new FileCannotBeOpenedException("The file '".$filename."' cannot be opened. ");
			}
			
			$this->insert($placeholder, $replacement);
		}
		
		/*
		 * Prints the page
		 * 
		 * returns: [void]*/
		function show(){
			echo $this->page;
		}
	}
	
	/*
 * Returns a segment of a string between a given start and end point
 * (copied from: http://stackoverflow.com/questions/5696412/get-substring-between-two-strings-php)
 * 
 * $string: [string]
 * $start: [string] the start of the segment, inclusive
 * $end: [string] the end of the segment, inclusive
 * returns: [string]*/
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
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
?>