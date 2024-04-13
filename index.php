<?php
    //Uncomment for debugging
    //ini_set('display_errors',1); 
    //error_reporting(E_ALL);
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
                    echo "LOCAL\n";
                }
                else{
                    echo "Budakeszi Evangélikus Egyházközség\n";
                }
            ?>
	</title>
	<link rel="icon" href="img/allando/templom.png">
	<link rel="stylesheet" type="text/css" href="css/uj6.css">
    </head>
    <body>
	<header>
	    <a href="?hely=fooldal" title="Főoldal"><img src="img/allando/templom.png" id="templom_logo" alt="Budakeszi Evangélikus Egyházközség logója">
		<h1>Budakeszi <br>Evangélikus <br>Egyházközség</h1>
            </a>
	    <nav>
		<input type="checkbox" id="trigger"/>
		<label for="trigger" id="trigger_label"><span></span></label>
		<ul id="menu_lista">
		    <li>
                        <a href="?hely=fooldal">
                            <img src="img/allando/lutherrozsa_monochrom_fekete.png" alt="Luther-Rózsa" id="lutherrozsa_mobil">
                        </a>
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
			<a href="?hely=archiv">Hírek</a>
		    </li>
		    <li>
			<a href="?hely=galeria">Képgaléria</a>
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
                            try{
                                echo $get_content();
                            }
                            catch(Exception $e){
                                echo "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el.</p>\n";
                            }
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
                        // An entry in "napiige.txt" looks like this:
                        // 
                        // 2022-11-26:
                        // Az Úr színe előtt járhatok az élők földjén. 
                        // <a href="https://szentiras.hu/RUF/Zsolt 116,9" target="_blank">Zsolt 116,9</a>
                        // 

                        $file = fopen("napiige.txt", "r");
                        if ($file) {
                            $today = date("Y-m-d");
                            $date_regex = "/^([0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]):$/";
                            $read_ige = false;
                            $read_ige_hely = false;
                            $done = false;
                            $ige = "";

                            while (($line = fgets($file)) !== false) {
                                if($read_ige){
                                    $ige = $line;

                                    // if the current line goes into $ige
                                    // then the next line should go to $ige_hely
                                    $read_ige = false;
                                    $read_ige_hely = true;
                                }
                                else if($read_ige_hely){
                                    $ige_hely = $line;
                                    echo "<div id='napi_ige_ige'>${ige}</div><div id='napi_ige_hely'>($ige_hely)</div>\n";

                                    // when we have read both $ige and $ige_hely we are done
                                    $done = true;
                                    break;
                                }

                                if(preg_match($date_regex, $line, $matches)){
                                    $date = $matches[1];

                                    if($date == $today){
                                        // if the current line is today's date
                                        // then the we should read the next line into $ige
                                        $read_ige = true;
                                    }
                                }
                            }

                            fclose($file);

                            if(!$done){
                                // couldn't find an entry with today's date
                                echo "<i>[Pillanatnyilag nem érhető el.]</i>\n";
                            }
                        }
                        else{
                            // couldn't open "napiige.txt"
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
                    else{
                        // do nothing, it isn't that big of a problem if this section is missing
                    }
                }
            ?>
	</footer>

	<script src="script/menu.js">
	</script>

	<?php
            if($isLocal){
                echo "<!-- StatCounter code is here in live version -->\n";
            }
            else{
                $statcounter = "statcounter.html";
                if(file_exists($statcounter)){
                    $content = file_get_contents($statcounter);
                    if($content !== false){
                        echo $content;
                    }
                    else{
                        // do nothing, it isn't that big of a problem if this section is missing
                    }
                }
            }
	?>
    </body>
</html>
