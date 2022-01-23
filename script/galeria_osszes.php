<?php
class Line{
    public $title;
    public $index;
    public $number_of_imgs;

    function __construct($title, $index, $number_of_imgs){
        $this->title = $title;
        $this->index = $index;
        $this->number_of_imgs = $number_of_imgs;
    }
}

const FOLDER_GALERY = "img/galeria/";

function get_content()
{
    $output .= "<article class='content'>\n
			<h2>Galéria</h2>\n
			<h3>Összes album</h3>\n";
    $output .= "<div style='margin-left: 50px;'>\n";

    $dirs = scandir_safe_compact(FOLDER_GALERY);
    $lines = array();
    foreach($dirs as $directory){
        $datafile = file_get_contents_safe(FOLDER_GALERY.$directory."/data.txt");
        $data = explode("\n", $datafile);
        $index = $data[0];
        $title = $data[1];
        $imgs = scandir_safe_compact(FOLDER_GALERY.$directory);
        $number_of_imgs = count($imgs) - 2; //not counting data.txt and Thumbnails directory
        $lines[$index] = new Line($title, $index, $number_of_imgs);
    }

    krsort($lines);

    foreach($lines as $line){
        $output .= "<a href='?hely=galeria&album=$line->index'>$line->title</a> ($line->number_of_imgs kép)\n<br>\n";
    }
    
    $output .=  "</div>\n";
    $output .=  "</article>";

    return $output;
}

function get_content_uj(){
    return get_content();
}
?>
