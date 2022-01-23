<?php
//Uncomment for debugging
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
	<link rel="stylesheet" type="text/css" href="css/uj.css">
    </head>
    <body>
	<header>
	    <a href="?hely=fooldal"><img src="img/allando/templom.png" id="templom_logo" alt="Főoldal">
	    <h1>Budakeszi <br>Evangélikus <br>Egyházközség</h1></a>
	    <nav>
		<input type="checkbox" id="trigger" role="menu" aria-label="Főmenü megnyitása illetve bezárása"/>
		<label for="trigger"><span></span></label>
		<ul>
		    <li>
			<a href="?hely=alkalmak">Alkalmaink</a>
		    </li>
		    <li id="menu_elerhetosegek">
			<a href="?hely=elerhetosegek">Elérhetőségek</a>
		    </li>
		    <li>
			<a href="?hely=galeria">Képgaléria</a>
		    </li>
		    <li>
			<a href="?hely=archiv">Archívum</a>
		    </li>
		    <li>
			<a href="?hely=tortenet">Rólunk</a>
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
                    echo get_content_uj();
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
		    <h2>Elérhetőségek</h2>
		    <ul>
			<li>
			    <b>Templom:</b> <a href="https://goo.gl/maps/TfnN3yhUEpkhSziCA">Budakeszi, Márity László utca 12.</a><br>
			</li>
			<li>
			    <b>Lelkész:</b> Lacknerné Puskás Sára <br>
			</li>
			<li>
			    <b>Telefon:</b> 06 20 770 00 56 <br>
			</li>
			<li>
			    <b>E-mail: </b>lelkesz@evangelikustemplom.hu<br>
			</li>
			<li>
			    <b>Hitoktató: </b> Harangozó Katalin
			    <ul>
				<li>Telefon: 06 30 28 95 848</li>
				<li>E-mail: kati.harangozo@gmail.com</li>
			    </ul>
			</li>
			<li>
			    <b>Számlaszám:</b> 11784009-20604682 <br>
			</li>
		    </ul>
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
    </body>
</html>
