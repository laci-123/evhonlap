<?php 
class Album{
    public $filename;
    public $title;
    public $id;

    function __construct($filename, $title, $id){
        $this->filename = $filename;
        $this->title = $title;
        $this->id = $id;
    }
}

const MAXALBUMS = 5;
const FOLDER_GALERY = "img/galeria/";

$get_content = function(){
    $output = "<h2>Galéria</h2>\n";
    $output .= "<nav id='galeria_menu'>\n";

    
    // Fetching directories, their numbers and their titles, then sorting them
    $dirs = scandir_safe_compact(FOLDER_GALERY);
    $albums = array();
    foreach($dirs as $directory){
        $datafile = file_get_contents_safe(FOLDER_GALERY.$directory."/data.txt");
        $data = explode("\n", $datafile);
        $id = $data[0];
        $title = $data[1];
        $albums[] = new Album($directory, $title, $id);
    }
    usort($albums, function($a, $b){return $b->id - $a->id;});

    
    // Finding current album
    try{
        $current_id = getparam_int("album"); // throws OutOfboundsException when there is no such int GET parameter
        if($current_id <= 0){
            throw new OutOfBoundsException("Incorrect album ID: $current_id");
        }
    }
    catch(OutOfBoundsException $ex){
        if(count($albums) > 0){
            $current_id = $albums[0]->id;
        }
        else{
            throw new Exception("Couldn't find any pictures. ");
        }
    }

    $current_album = $albums[0];
    for($i = 0; $i < count($albums); $i++){
        if($albums[$i]->id == $current_id){
            $current_album = $albums[$i];
        }
    }

    // Printing out current album
    $output .= "<input type='checkbox' id='galeria_trigger'>";
    $output .= "<label for='galeria_trigger'>$current_album->title</label>\n";
    $output .= "<ul>\n"; 

    // Printing out links of albums
    $i = 0;
    foreach($albums as $album){
	if($album->id == $current_album->id){
	    continue;
	}
	$output .= "<li><a href='?hely=galeria&album=$album->id'>$album->title</a></li>\n";
	if($i > MAXALBUMS){
	    break;
	}
	$i++;
    }
    $output .= "<li><a href='?hely=galeria_osszes'>Régebbiek...</a></li>\n";	    
    $output .= "</ul>\n";

    $output .= "</nav>\n";

    // Printing out the images
    $images = scandir_safe_compact(FOLDER_GALERY.$current_album->filename);
    for($i = 0; $i < count($images); $i++){
	$info = pathinfo($images[$i]);
	$file = $info['filename'];
	$ext = "";
	if(isset($info['extension'])){
	    $ext = $info['extension'];
	}

	if($ext == 'jpg' || $ext == 'JPG' || $ext == 'jpeg' || $ext == 'JPEG' || $ext == 'png' || $ext == 'PNG'){
	    $output .= "<a href='?hely=slideshow&folder=".$current_album->filename."&kep=".$i."'>";
	    $output .= "<img src='".FOLDER_GALERY.$current_album->filename."/Thumbnails/".$file.".png' class='galeria_kep'></a>\n";
	}
    }

    return $output;
};
?>
