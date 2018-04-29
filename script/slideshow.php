<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
		<title>Budakeszi Evangélikus Egyházközség</title>
		<link rel='icon' href='img/allando/lutherrozsa.ico'>
		<link rel="stylesheet" type="text/css" href="/css/slideshow.css">
		<!--Megjelent a 13.0 verzióhoz-->
<?php
	$folder = "";
	if(isset($_GET['folder']))
	{
		$folder = $_GET['folder']; 
	}
	else
	{
		echo "<body>
			  <h1>
				Hiba!
			  </h1>
			  <p>
				A slideshow.php-nak meg kell adni, hogy melyik foldert jelenítse meg. 
			  </p>
			  </body>
			  </html>";
		return;
	}
	$album = 0;
	if(isset($_GET['album']))
	{
		$album = $_GET['album'];
	}
?>
	</head>
	<body>
		<div class="slideshow">
<?php
				$files = scandir($_SERVER['DOCUMENT_ROOT']."/img/galeria/$folder");
				$pics = array();
				for($i = 0; $i < count($files); $i++)
				{
					if(pathinfo($files[$i])['extension'] == 'jpg' or pathinfo($files[$i])['extension'] == 'JPG')
					{
						$pics[] = $files[$i];
					}
				}
				for($i = 0; $i < count($pics); $i++)
				{
					echo "<div id='$pics[$i]'>\n";
					echo "<a class='link_back' href='#".$pics[(($i > 0) ? $i-1 : count($pics)-1)]."'>Előző</a>\n";
					echo "<img src='/img/galeria/$folder/$pics[$i]'>\n";
					echo "<a class='link_frwd' href='#".$pics[(($i < count($pics)-1) ? $i+1 : 0)]."'>Következő</a>\n";
					echo "</div>";
				}
			
echo "</div>";
echo "<a id='up' href='http://budakeszi.lutheran.hu/?hely=galeria&album=$album' >Vissza a galériába</a>";
?>
	</body>
</html>
