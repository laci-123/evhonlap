<?php
function slideshow(){
	$content = "";
	
	try{
		$folder = GETparameters::get_string(GET_VALUE_FOLDER);
	}
	catch(OutOfBoundsException $ex){
		die(ERROR_WRONG_URL);
	}
	try{
		$item = GETparameters::get_int(GET_VALUE_ITEM);
	}
	catch(OutOfBoundsException $ex){
		$item = 2;
	}
	try{
		$album_number = GETparameters::get_string(GET_VALUE_ALBUM);
	}
	catch(OutOfBoundsException $ex){
		$album = 1;
	}
	try{
		$files = scandir_safe("img/galeria/$folder");
	}
	catch(Exception $ex){
		die(ERROR_OTHER_ERROR.$ex->getMessage());
    }
	
	$back_link = SEGMENT_SLIDESHOW_BACKLINK.$album_number.SEGMENT_SLIDESHOW_BACKLINK_END;
	
	if($item < 2 or $item > count($files) - 3){
		$item = 2;
	}
	if($item == 2){
		$prev_item = count($files) - 3;
	}
	else{
		$prev_item = $item - 1;
	}
	if($item == count($files) - 3){
		$next_item = 2;
	}
	else{
		$next_item = $item + 1;
	}
	
	$content .= SEGMENT_SLIDESHOW_LINK.$folder."&kep=".$prev_item."&album=".$album_number.SEGMENT_SLIDESHOW_LINK_PREV;
	$content .= "<img src='img/galeria/".$folder."/".$files[$item]."'>\n";
	$content .= SEGMENT_SLIDESHOW_LINK.$folder."&kep=".$next_item."&album=".$album_number.SEGMENT_SLIDESHOW_LINK_NEXT;
	
	try{
		$main = new Page(FILE_SLIDESHOW_FRAME);
		$main->insert(PLACEHOLDER_BACK_LINK, $back_link);
		$main->insert(PLACEHOLDER_CONTENT, $content);
		$main->show();
	}
	catch(Exception $ex){
		echo ERROR_OTHER_ERROR.$ex->getMessage();
    }
}

?>
