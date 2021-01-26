<?php 
class Album{
    public $filename;
    public $title;
    public $number;

    function __construct($filename, $title, $number){
	$this->filename = $filename;
	$this->title = $title;
	$this->number = $number;
    }
}

const MAXALBUMS = 5;
const FOLDER_GALERY = "img/galeria/";

function galeria(){
    $output =  "<article class='content'>\n";
    $output .= "<h2>Galéria</h2>\n";
    $output .= "<nav id='galeria_menu'>\n"; 

    $output .= "<ul>\n"; 
    $output .= "<li><a href='#'>Albumok &darr;</a>\n";
    $output .= "<ul>\n";
    
    //Fetching directories, their numbers and their titles, then sorting them
    $dirs = scandir_safe_compact(FOLDER_GALERY);
    $albums = array();
    foreach($dirs as $directory){
	$datafile = file_get_contents_safe(FOLDER_GALERY.$directory."/data.txt");
	$data = explode("\n", $datafile);
	//data[0]: number 
	//data[1]: title
	$albums[$data[0]] = new Album($directory, $data[1], $data[0]);
    }
    krsort($albums);

    //Printing out links of albums
    $i = 0;
    foreach($albums as $album){
	$output .= "<li><a href='?hely=galeria&album=$album->number'>$album->title</a></li>\n";
	if($i > MAXALBUMS){
	    break;
	}
	$i++;
    }
    $output .= "<li><a href='?hely=galeria_osszes'>Összes album</a></li>\n";	
    
    $output .= "</ul>\n";
    $output .= "</li>\n";

    //Fetching number of current album
    try{
	$current_album = GETparameters::get_int("album");
	if($current_album <= 0 || count($albums) < $current_album){
	    throw new OutOfBoundsException("Incorrect album ID: $current_album");
	}
    }
    catch(OutOfBoundsException $ex){
	if(count($albums) > 0){
	    $current_album = count($albums) - 1;
	}
	else{
	    throw new Exception("Couldn't find any pictures. ");
	}
    }

    $output .= "<li><a style='background-color: white; color: black; padding: 8px 50px;' href='#'>".$albums[$current_album]->title."</a></li>\n";
    $output .= "</ul>\n";
    $output .= "</nav>\n";

    //Printing out the images
    $images = scandir_safe_compact(FOLDER_GALERY.$albums[$current_album]->filename);
    for($i = 0; $i < count($images); $i++){
	$info = pathinfo($images[$i]);
	$file = $info['filename'];
	$ext = "";
	if(isset($info['extension'])){
	    $ext = $info['extension'];
	}

	if($ext == 'jpg' || $ext == 'JPG' || $ext == 'jpeg' || $ext == 'JPEG' || $ext == 'png' || $ext == 'PNG'){
	    $output .= "<a href='?hely=slideshow&folder=".$albums[$current_album]->filename."&album=".$current_album."&kep=".$i."'>";
	    $output .= "<img src='".FOLDER_GALERY.$albums[$current_album]->filename."/Thumbnails/".$file.".png' width='45%'></a>\n";
	}
    }

    $output .= "</article>\n";
    return $output;
}
?>
