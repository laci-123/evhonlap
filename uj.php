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
	<!-- <link rel="stylesheet" type="text/css" href="css/uj.css"> -->
	<style>
	 *{
	     box-sizing: border-box;
	 }

	 body{
	     font-size: 4.5vw;
	     font-family: "Times New Roman", serif;
	     padding: 3vw;
	     padding-bottom: 0.5vw;
	     padding-right: 12vw;
	 }

	 header {
	     display: flex;
	 }

	 header h1 {
	     display: inline;
	     font-size: 5vw;
	     font-family: Helvetica, sans-serif;
	     font-weight: normal;
	 }

	 header a{
	     display: flex;
	     text-decoration: none;
	     color: inherit;
	 }

	 header img{
	     width: 25vw;
	     max-size: 149px;
	     display: block;
	     margin-right: 5vw;
	     object-fit: contain;
	 }

	 hr{
	     border-top: 2px solid #000000;
	 }

	 nav input {
	     opacity: 0;
	     width: 0;
	     height: 0;
	     appearance: none;
	     position: fixed;
	 }

	 label {
	     position: fixed;
	     top: 0;
	     right: 0;
	     z-index: 10;
	     display: flex;
	     align-items: center;
	     width: 7vw;
	     height: 7vw;
	     margin: 4vw;
	 }

	 label span {
	     display: block;
	     width: 100%;
	     background: #000000;
	     height: 1vw;
	     transition: transform 1s;
	 }

	 label span::before,
	 label span::after {
	     content: "";
	     position: absolute;
	     left: 0;
	     right: 0;
	     display: block;
	     height: 1vw;
	     background: #000000;
	     transition: 0.4s
	 }

	 label span::before {
	     top: 0;
	 }

	 label span::after {
	     top: calc(100% - 1vw);
	 }

	 nav ul {
	     position: fixed;
	     top: -15vh;
	     left: 0;
	     right: 25vw;
	     bottom: -15vh;
	     transform: translateX(-101vw);
	     transition: transform 0.2s;
	     background-color: #fbfbfb;
	     padding-top: 20vh;
	     color: #000000;
	     box-shadow: 1vw 0vw 2vw #909090;
	     font-size: 7vw;
	     font-family: Helvetica, sans-serif;
	     border-right: 1vw solid #38929b;
	 }

	 nav ul li{
	     margin-left: 5vw;
	     margin-bottom: 3vh;
	     padding-bottom: 3vh;
	     border-bottom: 3px solid #000000;
	     list-style-type: none;
	     width: 80%;
	 }

	 nav ul li:last-of-type{
	     border: none;
	 }

	 nav ul li a{
	     color: inherit;
	     text-decoration: none;
	 }

	 nav input:checked + label span {
	     transform: rotate(45deg);
	 }

	 nav input:checked + label span::before, input:checked + label span::after {
	     top: calc(50% - 0.5vw);
	     transition: 0.4s;
	 }
	 nav input:checked + label span::after {
	     transform: rotate(90deg);
	 }

	 nav input:checked ~ ul {
	     transform: none;
	     transition: transform 0.6s; 
	 }

	 #sidebar{
	     margin-top: 4em;
	     border: 1vw solid #38929b;
	     padding: 1em;
	 }

	 #napi_ige p{
	     font-style: italic;
	 }

	 #sidebar h2{
	     margin-top: 0;
	     font-weight: normal;
	 }

	 #sidebar hr{
	     display: none;
	 }

	 #elerhetosegek{
	     display: none;
	 }

	 footer{
	     font-size: 10pt;
	     font-family: Helvetica, sans-serif;
	     color: #ffffff;
	     background-color: #38929b;
	     margin-top: 20vw;
	     padding-top: 0.75em;
	     padding-bottom: 0.5em;
	     padding-left: 1em;
	 }

	 @media (min-aspect-ratio: 7/5){
	     nav ul{
		 right: 50vw;
		 font-size: 7vh;
	     }
	 }

	 @media (min-width: 950px){
	     body{
		 font-size: 14pt;
		 padding: 0;
		 padding-right: 0;
	     }

	     header{
		 border-bottom: 2em solid #38929b;
		 margin-bottom: 3em;
	     }

	     header h1{
		 font-size: 22pt;
	     }

	     header img{
		 width: 120px;
		 margin-right: 1em;
	     }

	     h2{
		 font-size: 22pt;
	     }

	     hr{
		 border-top: 1px solid #909090;
		 margin-top: 3em;
		 margin-bottom: 3em;
		 width: 75%;
	     }

	     nav{
		 margin-left: auto;
		 align-self: flex-end;
	     }

	     nav input {
		 display: none;
	     }

	     label {
		 display: none;
	     }

	     nav ul {
		 position: static;
		 font-size: 16pt;
		 margin: 0;
		 padding: 0;
		 transform: none;
		 border: none;
		 box-shadow: none;
		 display: flex;
		 background-color: #ffffff;
	     }

	     nav ul li{
		 margin: 0;
		 margin-right: 1em;
		 margin-bottom: -0.75em;
		 border: none;
		 list-style-type: none;
	     }

	     nav ul li:last-of-type{
		 margin-right: 0.2em;
	     }

	     nav ul li a{
		 color: #000000;
		 transition: color 1s ease-out 100ms
	     }

	     nav ul li a:hover{
		 color: #38929b;
		 text-decoration: underline;
	     }

	     #menu_elerhetosegek{
		 display: none;
	     }

	     main{
		 display: flex;
		 justify-content: space-around;
	     }

	     #content{
		 width: 60%;
	     }

	     #sidebar{
		 border: 1px solid #38929b;
		 width: 30%;
		 align-self: center;
	     }

	     #sidebar hr{
		 display: block;
	     }
	     
	     #napi_ige p{
		 font-size: 16pt;
	     }

	     #elerhetosegek{
		 display: block;
	     }
	     
	     #elerhetosegek ul{
		 font-family: Helvetica, sans-serif;
		 font-size: 12pt;
		 padding-left: 1em;
	     }

	     #elerhetosegek ul li{
		 margin-bottom: 1em;
	     }

	     #elerhetosegek ul li li{
		 margin-bottom: 0;
	     }

	     footer{
		 width: 75%;
		 margin-top: 5em;
		 font-weight: bold;
		 background-image: linear-gradient(to right, #38929b, #ffffff);
	     }
	 }

	 @media (min-width: 1450px){
	     header img{
		 width: 150px;
	     }

	     header h1{
		 font-size: 30pt;
	     }
	     
	     nav ul{
		 font-size: 20pt;
	     }

	     nav ul li{
		 margin-right: 2em;
	     }

	     #content{
		 width: 70%;
	     }

	     #sidebar{
		 width: 20%;
	     }

	     #elerhetosegek ul{
		 padding-left: 2em;
	     }
	 }

	 @media tty{
	     #trigger{
		 display: none;
	     }
	 }
	</style>
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
			<a href="#">Alkalmaink</a>
		    </li>
		    <li id="menu_elerhetosegek">
			<a href="#">Elérhetőségek</a>
		    </li>
		    <li>
			<a href="#">Képgaléria</a>
		    </li>
		    <li>
			<a href="#">Archívum</a>
		    </li>
		    <li>
			<a href="#">Rólunk</a>
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
