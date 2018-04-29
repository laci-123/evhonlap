<?php
function get_string_between($string, $start, $end){
	//kimásolva: http://stackoverflow.com/questions/5696412/get-substring-between-two-strings-php
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function gondolatok()
{
echo '<article class="content">
	<h2>
		Gondolatok
	</h2>';
	$cimek = array();
	$tartalom = file_get_contents("content/gondolatok.html");
	preg_match_all("/<!\-\-§(.*?)§\-\->/s", $tartalom, $cimek);
	if(count($cimek[1]) == 0)
	{
		echo "<p>
					Ez a szakasz jelenleg üres. 
			  </p>";
	}
	else if(count($cimek[1]) > 1)
	{
		echo '<p align="center">';
		for($i = count($cimek[1]); $i > 0; $i--)
		{
			echo "<a class='belso_link' href='?hely=gondolatok&cim=".$i."'>".$cimek[1][count($cimek[1])-$i]."</a>\n <br>";
		}
		echo '</p>
		<hr id="elvalaszto">';
	}
	
	$cim = 1;
	if(isset($_GET['cim']))
	{
		$cim = count($cimek[1]) - $_GET['cim'] + 1;
	}
	
	$t = "";
	if($cim != count($cimek[1]))
	{
		$t = get_string_between($tartalom, $cimek[1][$cim-1], $cimek[1][$cim]);
	}
	else
	{
		$t = get_string_between($tartalom, $cimek[1][$cim-1], "</article>");
	}
	$t = str_replace("<!--§", "", $t);
	$t = str_replace("§-->", "", $t);
	$t = preg_replace("/<.r>/", "", $t);
	echo $t;
	
	echo "</article>\n";
}
?>
