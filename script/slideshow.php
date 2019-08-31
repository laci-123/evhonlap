<?php
function slideshow(){
	$content = "";
	
	try{
		$folder = GETparameters::get_string(GET_KEY_FOLDER);
	}
	catch(OutOfBoundsException $ex){
		die(ERROR_WRONG_URL);
	}

	try{
		$item = GETparameters::get_int(GET_KEY_ITEM);
	}
	catch(OutOfBoundsException $ex){
		$item = 0;
	}

	try{
		$album_number = GETparameters::get_string(GET_KEY_ALBUM);
	}
	catch(OutOfBoundsException $ex){
		$album = 1;
	}

	try{
		$files = scandir_safe_compact(FOLDER_GALERY.$folder);
	}
	catch(Exception $ex){
		die(ERROR_OTHER_ERROR.$ex->getMessage());
        }
	
	$max_index = count($files) - 3;
	
	if($item < 0 or $item > $max_index){
		$item = 0;
	}
	if($item == 0){
		$prev_item = $max_index;
	}
	else{
		$prev_item = $item - 1;
	}
	if($item == $max_index){
		$next_item = 0;
	}
	else{
		$next_item = $item + 1;
	}

	$back_link = SEGMENT_SLIDESHOW_BACKLINK.$album_number.SEGMENT_SLIDESHOW_BACKLINK_END;
	
	$content .= SEGMENT_SLIDESHOW_LINK.$folder."&album=".$album_number."&kep=".$prev_item.SEGMENT_SLIDESHOW_LINK_PREV;
	$content .= "<img src='img/galeria/".$folder."/".$files[$item]."'>\n";
	$content .= SEGMENT_SLIDESHOW_LINK.$folder."&album=".$album_number."&kep=".$next_item.SEGMENT_SLIDESHOW_LINK_NEXT;
	
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
