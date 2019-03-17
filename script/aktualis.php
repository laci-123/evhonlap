<?php
function aktualis()
{
	$titles = array();
	$content = "";
	$output = "";
	

	$output .= SEGMENT_CONTENTHEADER;
	$output .= SEGMENT_UPCOMINGEVENTS_TITLE;
	
	try{
		$content = file_get_contents_safe(FILE_UPCOMINGEVENTS_CONTENT);
	}
	catch(Exception $ex){
		$output .= ERROR_NOT_ACCESSIBLE;
		$output .= SEGMENT_CONTENTFOOTER;
		return $output;
	}
	
	preg_match_all(REGEX_ENTRY, $content, $titles);
	
	if(count($titles[1]) == 0)
	{
		$output .= MESSAGE_NO_UPCOMING_EVENTS;
		$output .= SEGMENT_CONTENTFOOTER;
		return $output;
	}
	else if(count($titles[1]) > 1){
		$output .= SEGMENT_LINKS_BLOCK;
		for($i = count($titles[1]); $i > 0; $i--)
		{
			$output .= "<a class='belso_link' href='#".$i."'>".$titles[1][count($titles[1])-$i]."</a>\n";
		}
		$output .= SEGMENT_LINKS_BLOCK_END;
		$output .= SEGMENT_SEPARATOR;
	}
		
	$output .= $content;
	
	$output .= SCRIPT_JQUERY;
	$output .= SCRIPT_SCROLL_TO_ANCHOR;
	
	$output .= SEGMENT_CONTENTFOOTER;
	
	return $output;
}
?>
