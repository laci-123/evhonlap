
<?php
	function galeria_osszes()
	{
		$dir = "img/galeria";											//a könyvtár, ahol a képek vannak
		$files = scandir($dir);											//ennek a könyvtárnak a tartalma 
		$albums = array();												//a folderek címei (albumok)
		$folders = array();												//a folderek fizikai nevei
		$output = "";
	
		for($i = 2; $i < count($files); $i++)							//2-től, mert a scandir($dir) valamiért két üres elemet is visszaad 
		{
			$file = fopen("img/galeria/".$files[$i]."/data.ini", "r");	//az összes folderben a data.ini file tartalma 
			
			$index = fgets($file);										//az album sorszáma
			$index = preg_replace('/\r?\n$/', '', $index); 				//a sortörésjelek leszedése
			$index = intval($index);		
			
			$insert = fgets($file);										//az album címe
			$insert = mb_convert_encoding($insert, 'UTF-8', 'ASCII');	
			$albums[$index] = $insert;		
			$folders[$index] = $files[$i];
			fclose($file);
		}
		$countAlbums = count($albums)-1;
		ksort($albums);													//az albunok és folderek sorbarendezése 
		ksort($folders);
		
		$output .=  "<article class='content'>\n
			<h2>Galéria</h2>\n
			<h3>Összes album</h3>\n";
		$output .=  "<div style='margin-left: 50px;'>\n";
		for($i = $countAlbums; $i >= 0; $i--)		
		{
			$kepek = scandir("img/galeria/".$folders[$i]);	
			$kepekSzama = count($kepek) - 4;
			$output .=  "<a href='?hely=galeria&album=".$i."'>".$albums[$i]."</a> ($kepekSzama kép)\n<br>\n";
		}
		$output .=  "</div>\n";
		
		$output .=  "</article>";
		
		return $output;
	}
?>
