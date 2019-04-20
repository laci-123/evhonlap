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

	function galeria2(){
		$output .= SEGMENT_CONTENTHEADER;
		$output .= SEGMENT_GALERY_TITLE;
		$output .= SEGMENT_GALERY_MENU; 

		$output .= "<ul>\n"; 
		$output .= "<li><a href='#'>Albumok &darr;</a>\n";
		$output .= "<ul>\n";
	
		//Fetching directories, their numbers and their titles, then sorting them
			$dirs = scandir_safe_compact(FOLDER_GALERY);
			foreach($dirs as $directory){
				$datafile = file_get_contents_safe(FOLDER_GALERY.$directory.FILE_ALBUMDATA);
				$data = explode("\n", $datafile);
				//data[0]: number 
				//data[1]: title
				$albums[$data[0]] = new Album($directory, $data[1], $data[0]);
			}
			krsort($albums);

		//Printing out links of albums
			$i = 0;
			foreach($albums as $album){
				$output .= "<li><a href='?hely=galeria2&album=$album->number'>$album->title</a></li>\n";
				if($i > NUM_GALERY_MAXALBUMS){
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

		$output .= "<li><a style='' href='#'>".$albums[$current_album]->title."</a></li>\n";
		$output .= "</ul>\n";
		$output .= SEGMENT_GALERY_MENU_END;

		//Printing out the images
			$images = scandir_safe_compact(FOLDER_GALERY.$albums[$current_album]->filename);
			for($i = 0; $i < count($images); $i++){
				$ext = pathinfo($images[$i])['extension'];
				$file = pathinfo($images[$i])['filename'];
				if($ext == 'jpg' || $ext == 'JPG' || $ext == 'jpeg' || $ext == 'JPEG' || $ext == 'png' || $ext == 'PNG'){
					$output .= "<a href='?hely=slideshow&folder=".$albums[$current_album]->filename."&album=".$current_album."&kep=".$i."'>";
					$output .= "<img src='".FOLDER_GALERY.$albums[$current_album]->filename."/Thumbnails/".$file.".png' width='45%'></a>\n";
				}
			}

		$output .= SEGMENT_CONTENTFOOTER;
		return $output;
	}
?>
