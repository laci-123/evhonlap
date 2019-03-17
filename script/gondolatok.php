<?php
function gondolatok()
{	
	$titles = array();
	$content = "";
	$entry = 0;
	$actual_content = "";
	$output = "";
	
	$output .= SEGMENT_CONTENTHEADER;
	$output .= SEGMENT_THOUGHTS_TITLE;
	
	try{
		$content = file_get_contents_safe(FILE_THOUGHTS_CONTENT);
	}
	catch(Exception $ex){
		$output .= ERROR_NOT_ACCESSIBLE;
		$output .= SEGMENT_CONTENTFOOTER;
		return $output;
	}
	
	preg_match_all(REGEX_ENTRY, $content, $titles);
	
	if(count($titles[1]) == 0)
	{
		$output .= MESSAGE_EMPTY_SECTION;
		$output .= SEGMENT_CONTENTFOOTER;
		return $output;
	}
	
	$output .= SEGMENT_LINKS_BLOCK;
	for($i = count($titles[1]); $i > 0; $i--)
	{
		$output .= "<a class='belso_link' href='?hely=gondolatok&cim=".$i."'>".$titles[1][count($titles[1])-$i]."</a>\n";
	}
	$output .= SEGMENT_LINKS_BLOCK_END;
	$output .= SEGMENT_SEPARATOR;
	
	try{
		$entry = count($titles[1]) - GETparameters::get_int(GET_VALUE_THOUGHTS_TITLE) + 1;
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
	
	$output .= SEGMENT_CONTENTFOOTER;
	
	return $output;
}
?>
