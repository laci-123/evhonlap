<?php
function aktualis()
{
echo '<article class="content">
	<h2>
		Aktuális alkalmak
	</h2>';
	$cimek = array();
	$tartalom = file_get_contents("content/aktualis.html");
	preg_match_all("/<!\-\-§(.*?)§\-\->/s", $tartalom, $cimek);
	if(count($cimek[1]) == 0)
	{
		echo "<p>
					Pillanatnyilag nincs információnk a rendszeres alkalmakon kívüli eseményekről. 
			  </p>";
	}
	else if(count($cimek[1]) > 1)
	{
		echo '<p align="center">';
		for($i = count($cimek[1]); $i > 0; $i--)
		{
			echo "<a class='belso_link' href='#".$i."' style='margin: 5; white-space: nowrap;'>".$cimek[1][count($cimek[1])-$i]."</a>\n";
		}
		echo '</p>
		<hr id="elvalaszto">';
	}
	echo file_get_contents("content/aktualis.html");
	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script>
		function scrollToAnchor(aid){
			var aTag = $("a[name=\'"+ aid +"\']");
			$("html,body").animate({scrollTop: aTag.offset().top},"slow");
		}

		$(".belso_link").click(function() {
			var str = $(this).attr("href");
			scrollToAnchor(str.substring(1));
		});
	</script>
</article>';
}
?>
