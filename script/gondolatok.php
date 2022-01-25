<?php
$get_content = function()
{	
    $titles = array();
    $content = "";
    $entry = 0;
    $actual_content = "";
    $output = "";
    
    $output .= "<article class='content'>\n";
    $output .= "<h2>Gondolatok</h2>";
    
    try{
	$content = file_get_contents_safe("content/gondolatok.html");
    }
    catch(Exception $ex){
	$output .= "<p>Ez a tartalom egy váratlan hiba miatt jelenleg nem érhető el. </p>\n";
	$output .= "</article>\n";
	return $output;
    }
    
    preg_match_all("/<!\-\-§(.*?)§\-\->/s", $content, $titles);
    
    if(count($titles[1]) == 0)
    {
	$output .= "<p>Ez a szakasz jelenleg üres. </p>";
	$output .= "</article>\n";
	return $output;
    }
    
    $output .= "<p>";
    for($i = count($titles[1]); $i > 0; $i--)
    {
	$output .= "<a class='belso_link' href='?hely=gondolatok&cim=".$i."'>".$titles[1][count($titles[1])-$i]."</a><br>\n";
    }
    $output .= "</p>";
    $output .= "<hr id='elvalaszto'>";
    
    try{
	$entry = count($titles[1]) - getparam_int("cim") + 1;
    }
    catch(OutOfBoundsException $ex){
	$entry = 1;
    }
    
    
    if($entry != count($titles[1]))
    {
	$actual_content = get_string_between($content, $titles[1][$entry-1], $titles[1][$entry]);
    }
    else
    {
	$actual_content = get_string_between($content, $titles[1][$entry-1], "</article>");
    }
    $actual_content = str_replace("<!--§", "", $actual_content);
    $actual_content = str_replace("§-->", "", $actual_content);
    $actual_content = preg_replace("/<.r>/", "", $actual_content);
    $output .= $actual_content;
    
    $output .= "</article>\n";
    
    return $output;
};

$get_content_uj = function(){
    echo "<p>Itt lesznek majd a gondolatok...</p>";
};
?>
