<?php
$get_content = function()
{
    echo "<!-- cica -->\n";
    $titles = array();
    $content = "";
    $output = "";
    

    $output .= "<article class='content'>\n";
    $output .= "<h2>Aktuális</h2>\n";
    
    try{
	$content = file_get_contents_safe("content/aktualis.html");
    }
    catch(Exception $ex){
	$output .= "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el. </p>\n";
	$output .= "</article>\n";
	return $output;
    }
    
    preg_match_all("/<!\-\-§(.*?)§\-\->/s", $content, $titles);
    
    if(count($titles[1]) == 0)
    {
	$output .= "<p>Pillanatnyilag nincs információnk a rendszeres alkalmakon kívüli eseményekről. </p>\n";
	$output .= "</article>\n";
	return $output;
    }
    else if(count($titles[1]) > 2){
	$output .= "<p align='center'>\n";
	for($i = count($titles[1]); $i > 0; $i--)
	{
	    $output .= "<a class='belso_link' href='#".$i."'>".$titles[1][count($titles[1])-$i]."</a>\n";
	}
	$output .= "</p>\n";
	$output .= "<hr id='elvalaszto'>\n";
    }
    
    $output .= $content;
    
    $output .= "<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>\n";
    $output .= "<script src='script/scrollToAnchor.js'></script>\n";
    
    $output .= "</article>\n";
    
    return $output;
};

$get_content_uj = function()
{
    echo "<p>Itt lesznek majd az aktuális alkalmak...</p>";
};
?>
