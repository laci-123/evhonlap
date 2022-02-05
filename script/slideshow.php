<?php

$get_content = function(){
    $galery = "img/galeria/";
    $folder = "";
    $files = [];
    $album = 0;
    $kep = 0;
    try{
        $folder = getparam_string("folder")."/";
        $files = scandir_safe_compact($galery.$folder);
        $album = getparam_int("album");
        $kep = getparam_int("kep");
    }
    catch(Exception $ex){
        die("<b>Error: </b>".$ex->getMessage());
    }

    $output = "<article class='content'>\n";
    $output .= "<h2>Galéria</h2>\n";

    $output .= "<div id='images' style='display: none;'>\n";
    foreach($files as $file){
        if(strtolower(substr(strrchr($file, "."), 1)) == "jpg"){ 
            $output .= "<div>$galery$folder$file</div>\n"; 
        }
    }
    $output .= "</div>\n";
    $output .= "<div id='current_image' style='display: none;'>$kep</div>\n";

    $output .= "<a href='?hely=galeria&album=$album' class='backlink'>Vissza</a>\n<br><br>\n";

    $output .= "<div id='slideshow_container'>\n";
    $output .= "<div id='slide'>\n";

    $output .= "<div id='slide_number'>".($kep+1)."/".(count($files) - 2)."</div>";
    $output .= "<img id='the_slide' src='".$galery.$folder.$files[$kep]."' style='width: 100%;'>\n<br>\n";
    $output .= "<a id='prev_slide'>&#10094;</a>\n";
    $output .= "<a id='next_slide'>&#10095;</a>\n";
    $output .= "<div id='slideshow_loading' class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>\n";

    $output .= "</div>\n";
    $output .= "</div>\n";
    $output .= "</article>\n";

    $output .= "<script src='script/slideshow.js'></script>\n";
    return $output;
};

function slideshow($galery, $folder, $files, $album, $kep){
    $output = "<div id='images' style='display: none;'>\n";
    foreach($files as $file){
        if(strtolower(substr(strrchr($file, "."), 1)) == "jpg"){ 
            $output .= "<div>$galery$folder$file</div>\n"; 
        }
    }
    $output .= "</div>\n";
    $output .= "<div id='current_image' style='display: none;'>$kep</div>\n";

    if($album != ""){
	$output .= "<a href='?hely=galeria&album=$album' class='backlink'>Vissza</a>\n<br><br>\n";
    }

    $output .= "<div id='slideshow_container'>\n";
    $output .= "<div id='slide'>\n";

    $output .= "<div id='slide_number'>".($kep+1)."/".(count($files) - 2)."</div>";
    $output .= "<img id='the_slide' src='".$galery.$folder.$files[$kep]."' style='width: 100%;'>\n<br>\n";
    $output .= "<a id='prev_slide'>&#10094;</a>\n";
    $output .= "<a id='next_slide'>&#10095;</a>\n";
    $output .= "<div id='slideshow_loading' class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>\n";

    $output .= "</div>\n";
    $output .= "</div>\n";

    $output .= "<script src='script/slideshow.js'></script>\n";
    return $output;
}

$get_content_uj = function(){
    $galery = "img/galeria/";
    $folder = "";
    $files = [];
    $album = 0;
    $kep = 0;
    $title = "";
    try{
        $folder = getparam_string("folder")."/";
        $files = scandir_safe_compact($galery.$folder);
	$datafile = file_get_contents_safe($galery.$folder."/data.txt");
	$data = explode("\n", $datafile);
        $album = $data[0];
	$title = $data[1];
        $kep = getparam_int("kep");
    }
    catch(Exception $ex){
        die("<b>Error: </b>".$ex->getMessage());
    }

    $output =  "<h2>Galéria</h2>\n";
    $output .= "<h3>$title</h3>\n";

    $output .= slideshow($galery, $folder, $files, $album, $kep);

    return $output;
};
?>
