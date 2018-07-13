<?php 
	require "functions.php";
	
	$content = "<article class='content'>
					Ide jön majd a tényleges tartalom. 
				</article>";
				
	$dailyWord = get_DailyWord();
	
	try{
		$main_page = new Page("main_frame.html");
		$main_page->insert("content", $content);
		$main_page->insert("DailyWord", $dailyWord);
		$main_page->show();
	}
	catch(Exception $ex){
		echo "<b>Error: </b>".$ex->getMessage();
	}
?>
