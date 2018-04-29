<?php 
	/*Vigyázat! ha az /img/galeria könyvtárban van egy olyan folder, amiben nincs data.ini file, az is meg fog jelenni az 
	  albumok között, egy üres elemként*/
	
	function galeria()
	{
		
		$dir = "img/galeria";											//a könyvtár, ahol a képek vannak
		$files = scandir($dir);											//ennek a könyvtárnak a tartalma 
		$albums = array();												//a folderek címei (albumok)
		$folders = array();												//a folderek fizikai nevei
		$currentAlbum = "";												//az éppen használt albumok száma
		define("MAX_ALBUMS", 8);										//az albumok legördülő menüben az elemek maximális száma 
		if(isset($_GET['album']))
		{
			$currentAlbum = $_GET['album'];
		}
		$countAlbums = 0; 												//az albumok száma
		$kepperoldal = 5;												//képek száma oldalanként
		if(isset($_GET['szam']))										//a v11 verziótól csak kézzel lehet beállítani az URL címben, a debugolás megkönnyítésére maradt itt
		{
			$kepperoldal = $_GET['szam'];
		}
		$lap = 0;														//hanyadik lap, ha nem jelenik meg az összes kép egyszerre
		if(isset($_GET['lap']))
		{
			$lap = $_GET['lap'];
		}
		
		for($i = 2; $i < count($files); $i++)							//2-től, mert a scandir($dir) valamiért két üres elemet is visszaad 
		{
			$file = fopen("img/galeria/".$files[$i]."/data.ini", "r");	//az összes folderben a data.ini file tartalma 
			
			$index = fgets($file);										//az album sorszáma
			$index = preg_replace('/\r?\n$/', '', $index); 				//a sortörésjelek leszedése
			$index = intval($index);		
			
			$insert = fgets($file);										//az album címe
			$albums[$index] = $insert;		
			$folders[$index] = $files[$i];
			fclose($file);
		}
		
		$countAlbums = count($albums)-1;
		ksort($albums);													//az albunok és folderek sorbarendezése 
		ksort($folders);
		
		echo "<div class='content'>
		<h2>
			Galéria
		</h2>
		<nav id='galeria_menu'>
			<ul>
				<li><a href='#'>Albumok &darr;</a>
					<ul>";
						//var_dump($albums);
						if($countAlbums >= MAX_ALBUMS)					//az albunokra mutató linkek kiírása 
						{
							for($i = $countAlbums; $i > ($countAlbums - MAX_ALBUMS); $i--)			
							{
								echo "<li><a href='?hely=galeria&album=".$i."'>", $albums[$i], "</a></li>\n";
							}
							echo "<li><a href='?hely=galeria_osszes'>Összes album</a></li>\n";
						}
						else											
						{
							for($i = $countAlbums; $i >= 0; $i--)		
							{
								echo "<li><a href='?hely=galeria&album=".$i."'>", $albums[$i], "</a></li>\n";
							}
						}
				echo"</ul>
				</li>
				<li><a style='background-color: white; color: black; padding: 8px 50px;' href='#'>";
						if($currentAlbum != "")							//az aktuális album kiírása 
						{
							echo $albums[$currentAlbum]."</a></li>";
						}
						else
						{
							echo $albums[$countAlbums]."</a></li>";
						}
			echo "</ul>
		</nav>					
		<div>";
			$folder = $countAlbums;										//az aktuális folder száma
			if($currentAlbum != "")
			{
				$folder = $currentAlbum;
			}
			$kepek = scandir("img/galeria/".$folders[$folder]);			//az aktuális folderben levő képek
			$meddig = 5;												//a kiírandó képek száma
			
			if($currentAlbum != "" )
			{
				if($kepperoldal != "a")								//"a" = összes
				{
					$meddig = $kepperoldal;
				}
				else
				{
					$meddig = count($kepek) - 2;						//nem kell a data.ini és a ..
				}
			}
			
			if($lap < 0)
			{
				$lap = 0;
			}
			for($i = ($meddig+1)*$lap; $i <= ($meddig+1)*($lap+1); $i++)
			{
				if($kepek[$i] != "." and $kepek[$i] != ".." and $kepek[$i] != "data.ini")	//nem kell a data.ini és a ..
				{																			//a képek kiírása
					if(is_file("img/galeria/".$folders[$folder]."/".$kepek[$i]))
					{
						echo "<a href='/script/slideshow.php/?folder=".$folders[$folder]."&album=".$currentAlbum."#".$kepek[$i]."'>
								<img src='img/galeria/".$folders[$folder]."/Thubnails/".preg_replace("/\..*/", "", $kepek[$i]).".png"."' width='45%''>
							  </a>\n";
						if($i % 2 == 1)
						{
							echo "<br>\n";
						}
					}
				}
			}
		echo "</div>
			<br>
			<br>
			<div>
				<div id='elozo'>";
				if($lap > 0 and $kepperoldal != "a")								//csak akkor kell "Előző" gomb, ha nem ez az első lap és nicncs egyszerre az összes megjelenítve
				{
					echo "<a href='?hely=galeria&album=$currentAlbum&lap=".($lap - 1)."'>előző</a>";
				}
				echo "</div>
				<div id='kovetkezo'>";
				if(($meddig+1)*($lap+2) <= count($kepek) and $kepperoldal != "a")	//csak akkor kell "Következő" gomb, ha még van több kép és nincs egyszerre az összes megjelenítve
				{
					echo"<a href='?hely=galeria&album=$currentAlbum&lap=".($lap + 1)."'>következő</a>";
				}
				echo "</div>
			</div>
		</div>";
	}
?>
