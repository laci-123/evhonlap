<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <title>Budakeszi Evangélikus Egyházközség</title>
                <link rel="icon" href="img/allando/lutherrozsa.ico">
                <link rel="stylesheet" type="text/css" href="/css/main.css">
                <link rel="stylesheet" type="text/css" href="/css/menu.css">
                <meta name="description" content="A Budakeszi Evangélikus Egyházközség honlapja">
                <meta name="author" content="Gohér László">
        </head>
        <body>
                <div id="kozepso">
                        <div id="bal">
                                <img id="rozsa" src="img/allando/lutherrozsa.png" alt="luther rózsa" width="100%">
                                <aside id="allando_ige">
                                <i>&bdquo;Ti vagytok a világ világossága. Úgy ragyogjon a ti világosságotok az emberek előtt,
                                hogy lássák jó cselekedeteiteket, és dicsőítsék a ti mennyei Atyátokat.&rdquo; <br>
                                <span style="float: right">(Mt 5, 14.16)</span></i>
                                </aside>
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
                                                        </ul>
                                                </li>
                                                <li><a href="#">Események</a>
                                                        <ul>
                                                                <li><a href="?hely=friss">Friss</a></li>
                                                                <li><a href="?hely=archiv">Archív</a></li>
                                                        </ul>
                                                </li>
                                                <li><a href="#">Rólunk</a>
                                                        <ul>
                                                                <li><a href="?hely=tisztsegviselok">Tisztségviselők</a></li>
                                                                <li><a href="?hely=tortenet">Történet</a></li>
                                                                <li><a href="?hely=galeria">Képgaléria</a></li>
                                                        </ul>
                                                </li>
                                                                                                <li><a href="?hely=gondolatok">Gondolatok</a></li>
                                        </ul>
                                </nav>
                                <?php
                                        if(isset($_GET['hely']) and $_GET['hely'] != '')
                                        {
                                                switch($_GET['hely'])
                                                {
                                                        case "fooldal":
                                                                echo "valami";
                                                                echo file_get_contents("content/fo_oldal.html");
                                                                break;
                                                        case "elerhetosegek":
                                                                echo file_get_contents("content/elerhetosegek.html");
                                                                break;
                                                        case "alkalmak":
                                                                echo file_get_contents("content/allando.html");
                                                                break;
                                                        case "aktualis":
                                                                include "script/aktualis.php";
                                                                aktualis();
                                                                break;
                                                        case "friss":
                                                                echo file_get_contents("content/friss.html");
                                                                break;
                                                        case "archiv":
                                                                echo file_get_contents("content/archiv.html");
                                                                break;
                                                        case "tisztsegviselok":
                                                                echo file_get_contents("content/tisztsegviselok.html");
                                                                break;
                                                        case "gondolatok":
                                                                include "script/gondolatok.php";
                                                                gondolatok();
                                                                break;
                                                        case "tortenet":
                                                                echo file_get_contents("content/tortenet.html");
                                                                break;
                                                        case "galeria":
                                                                include "script/galeria.php";
                                                                galeria();
                                                                break;
                                                        case "galeria_osszes":
                                                                include "script/galeria_osszes.php";
                                                                galeria_osszes();
                                                                break;
                                                        case "luther":
                                                                echo file_get_contents("content/luther.html");
                                                                break;
                                                        default:
                                                                echo file_get_contents("content/fo_oldal.html");
                                                                break;
                                                }
                                        }
                                        else
                                        {
                                                echo file_get_contents("content/fo_oldal.html");
                                        }
                                ?>
                                <footer>
Utoljára frissítve: 2018.04.11
                                </footer>
                        </div>
                        <div id="jobb">
                                <aside id="napi_ige">
                                        <h2>
                                                Napi ige
                                        </h2>
                                        <?php
                                                /*A napi ige leszedése az országos evangélikus honlapról*/
                                                $ige = "nem sikerült";
                                                $tartalom = file_get_contents("http://www.evangelikus.hu/");
                                                //var_dump($tartalom);
                                                preg_match("/Napi ige: <\/a>(.*?)&nbsp;/s", $tartalom, $ige);
                                                $ige = preg_replace("/Napi ige: <\/a>/", "", $ige);
                                                $ige = preg_replace("/<\/p>/", "", $ige);
                                                $ige = preg_replace("/õ/", "ő", $ige);  /*megfelelő ékezetes karakterek beállítása*/
                                                $ige = preg_replace("/û/", "ű", $ige);
                                                //var_dump($ige);
                                                echo $ige[0];
                                                echo "\n";
                                        ?>
                                </aside>
                                <nav>
                                        <h2>
                                                Külső linkek
                                        </h2>
                                        <a href="http://www.evangelikus.hu/">Magyarországi Evangélikus Egyház</a><br>
                                        <br>
                                        <a href="http://eszak.lutheran.hu/egyhazmegyek">Északi Egyházkerület</a><br>
                                </nav>
                        </div>
                </div>
        </body>
</html>
