<?php
Uncomment for debugging
ini_set('display_errors',1); 
error_reporting(E_ALL);
?>
<?php
require "functions.php";

$localaddr = ["127.0.0.1", "::1"];
$isLocal = false;
if(in_array($_SERVER["REMOTE_ADDR"], $localaddr)){
    $isLocal = true;
}
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>
	    <?php
            if($isLocal){
				echo "LOCAL";
            }
            else{
				echo "Budakeszi Evangélikus Egyházközség";
            }
            ?>
	</title>
	<link rel="icon" href="img/allando/templom.png">
	<link rel="stylesheet" type="text/css" href="css/uj4.css">
    </head>
    <body>
	<header>
	    <a href="?hely=fooldal"><img src="img/allando/templom.png" id="templom_logo" alt="Főoldal">
		<h1>Budakeszi <br>Evangélikus <br>Egyházközség</h1></a>
	    <nav>
		<input type="checkbox" id="trigger"/>
		<label for="trigger" id="trigger_label"><span></span></label>
		<ul id="menu_lista">
		    <li>
			<img src="img/allando/lutherrozsa_monochrom_fekete.png" alt="Luther-Rózsa" id="lutherrozsa_mobil">
		    </li>
		    <li>
			<a href="?hely=aktualis">Aktuális</a>
		    </li>
		    <li>
			<a href="?hely=alkalmaink">Alkalmaink</a>
		    </li>
		    <li id="menu_elerhetosegek">
			<a href="?hely=elerhetosegek">Elérhetőségek</a>
		    </li>
		    <li>
			<a href="?hely=galeria">Képgaléria</a>
		    </li>
		    <li>
			<a href="?hely=archiv">Hírek</a>
		    </li>
		    <li>
			<a href="?hely=igehirdetesek">Igehirdetések</a>
		    </li>
		    <li>
			<a href="?hely=rolunk">Rólunk</a>
		    </li>
		</ul>
	    </nav>
	</header>
	<main>
	    <div id="content">
		<?php
			$key = "hely";
			$location = "fooldal";
			if(isset($_GET[$key]) and !is_null($_GET[$key])){
				$location = $_GET[$key];
			}

			if(include "script/$location.php"){
				echo $get_content();
			}
			else{
				echo "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el.</p>\n";
			}
		?>
	    </div>
	    <div id="sidebar">
		<div id="napi_ige">
		    <h2>Napi Ige</h2>
		    <?php
				try{
					$szoveg = "";
					$tartalom = get_url("https://www.evangelikus.hu/");
					preg_match("/Napi ige(.*?)<\/p>/s", $tartalom, $szoveg);
					$ige = get_string_between($szoveg[0], "„", "”");
					$ige_hely = get_string_between($szoveg[0], "(", ")");
					
					echo "<div id='napi_ige_ige'>„${ige}”</div><div id='napi_ige_hely'>($ige_hely)</div>\n";
				}
				catch(Exception $e){
					echo "<i>[Pillanatnyilag nem érhető el.]</i>\n";
				}
		    ?>
		</div>
		<hr>
		<div id="elerhetosegek">
		    <?php
		    if(include "script/elerhetosegek.php"){
				echo $get_content();
		    }
		    else{
				echo "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el.</p>\n";
		    }
		    ?>
		</div>
		<hr>
		<div id="kulso_linkek">
		    <h2>Linkek</h2>
		    <a href="https://www.evangelikustemplom.hu/">Budakeszi Evangélikus Templomért Alapítvány</a>
		    <a href="https://www.youtube.com/channel/UC1ref27GKKDuIHIJ5-u4SuQ">Youtube-csatornánk</a>
		    <a href="https://www.evangelikus.hu/">Magyarországi Evangélikus Egyház</a>
		    <a href="https://eszak.lutheran.hu/">Északi Egyházkerület</a>
		    <a href="https://buda.lutheran.hu/">Budai Egyházmegye</a>
		</div>
	    </div>
	</main>
	<footer>
	    <?php
            $lastmodified = "last_modified.txt";
            if(file_exists($lastmodified)){
                $content = file_get_contents($lastmodified);
                if($content !== false){
                    echo "A honlap utoljára firssítve: $content";
                }
            }
            ?>
	</footer>
	<script src="script/menu.js">
	</script>
	<?php
		$statcounter = "statcounter.html";
		if(file_exists($statcounter)){
			$content = file_get_contents($statcounter);
			if($content !== false){
				echo $content;
			}
		}
	?>
    </body>
</html>
