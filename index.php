<?php
//Uncomment for debugging
ini_set('display_errors',1); 
error_reporting(E_ALL);
?>

<?php
//Returns a segment of a string between a given start and end point
//(from: http://stackoverflow.com/questions/5696412/get-substring-between-two-strings-php)
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

//Returns the content of the URL given in $url. 
function get_url($url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($curl);
    if($result === false){
        throw new Exception(curl_error($curl), curl_errno($curl));
    }
    
    curl_close($curl);
    
    return $result;
}


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
		<link rel="icon" href="img/allando/lutherrozsa.ico">
		<link rel="stylesheet" type="text/css" href="/css/main.css">
		<link rel="stylesheet" type="text/css" href="/css/menu.css">
		<meta name="description" content="A Budakeszi Evangélikus Egyházközség honlapja">
		<meta name="author" content="Gohér László">
	</head>
	<body>
	    <div id="kozepso">
		<div id="bal" class="oldalso">
		    <img id="rozsa" src="img/allando/lutherrozsa.png" alt="luther rózsa" width="100%">
		    <div id="allando_ige">
			<i>&bdquo;Ti vagytok a világ világossága. Úgy ragyogjon a ti világosságotok az emberek előtt,
			    hogy lássák jó cselekedeteiteket, és dicsőítsék a ti mennyei Atyátokat.&rdquo; <br>
			    <span style="float: right">(Mt 5, 14.16)</span></i>
		    </div>
		</div>
		<div id="fo">
		    <h1 id="focim">
			Budakeszi Evangélikus Egyházközség
		    </h1>
		    <nav id="fomenu">
			<ul>
			    <li><a href="?hely=fooldal">Főoldal</a></li>
			    <li><a href="?hely=elerhetosegek">Elérhetőségek</a></li>
			    <li><a href="#">Alkalmak</a>
				<ul>
				    <li><a href="?hely=alkalmak">Állandó alkalmak</a></li>
				    <li><a href="?hely=aktualis">Aktuális</a></li>
				    <li><a href="?hely=archiv">Archív</a></li>
				</ul>
			    </li>
                            <li><a href="?hely=galeria">Képgaléria</a></li>
			    <li><a href="#">Rólunk</a>
				<ul>
				    <li><a href="?hely=tisztsegviselok">Tisztségviselők</a></li>
				    <li><a href="?hely=tortenet">Történet</a></li>
				</ul>
			    </li>
			    <li><a href="?hely=gondolatok">Gondolatok</a></li>
			</ul>
		    </nav>
            <?php
            $key = "hely";
            $location = "fooldal";
            if(isset($_GET[$key]) and !is_null($_GET[$key])){
                $location = $_GET[$key];
            }

            require "functions.php";

            if($location == "slideshow"){
                if(include "script/slideshow.php"){
                    get_content();
                }
                else{
                    echo "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el.</p>\n";
                }
            }
            if(include "script/$location.php"){
                echo get_content();
            }
            else{
                echo "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el.</p>\n";
            }
            ?>
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
		</div>
		<div id="jobb" class="oldalso">
		    <div id="napi_ige">
			<h2>
			    Napi ige
			</h2>
            <?php
            try{
                $szoveg = "";
                $tartalom = get_url("https://www.evangelikus.hu/");
                preg_match("/Napi ige(.*?)<\/p>/s", $tartalom, $szoveg);
                $ige = get_string_between($szoveg[0], "„", "”");
                $ige_hely = get_string_between($szoveg[0], "(", ")");
                
                echo "<div id='napi_ige_ige'>„${ige}”</div><div id='napi_ige_hely'>($ige_hely)</div>";
            }
            catch(Exception $e){
                echo "<i>[Pillanatnyilag nem érhető el.]</i>";
            }
            ?>
		    </div>
		    <nav>
			<h2>
			    Linkek
			</h2>
			<a href="https://www.youtube.com/channel/UC1ref27GKKDuIHIJ5-u4SuQ">
                            Istentiszteletekről készült videók
                        </a><br>
                        <br>
			<a href="http://www.evangelikustemplom.hu">
                            Budakeszi Evangélikus Templomért Alapítvány
                        </a><br>
			<br>
			<a href="http://www.evangelikus.hu/">Magyarországi Evangélikus Egyház</a><br>
			<br>
			<a href="https://eszak.lutheran.hu/">Északi Egyházkerület</a><br>
			<br>
			<a href="https://buda.lutheran.hu/">Budai Egyházmegye</a><br>
		    </nav>
		</div>
	    </div>
        <?php
        $statcounter = "statcounter.html";
        if(!$isLocal && file_exists($statcounter)){
            $content = file_get_contents($statcounter);
            if($content !== false){
                echo $content;
            }
        }
        ?>
	</body>
</html>
