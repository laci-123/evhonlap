<?php 
	/*
	 * Returns the content of the URL given in $url. 
	 * Throws Exception with the internal error message and error code. 
	 * 
	 * in: string
	 * out: string
	 * */
	function get_url($url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$result = curl_exec($curl);
		if($result === false){
			throw new Exception(curl_error($curl), curl_errno($curl));
		}
		
		curl_close($curl);
		
		return $result;
	}
	
	/*
	 * Returns the Daily Word from evangelikus.hu. 
	 * 
	 * in: void
	 * out: string
	 * */
	function get_DailyWord(){
		try{
			$ige = "";
			$tartalom = get_url("https://www.evangelikus.hu/");
			preg_match("/Napi ige: <\/a>(.*?)&nbsp;/s", $tartalom, $ige);
			$ige = preg_replace("/Napi ige: <\/a>/", "", $ige);
			$ige = preg_replace("/<\/p>/", "", $ige);
			$ige = preg_replace("/õ/", "ő", $ige);  
			$ige = preg_replace("/û/", "ű", $ige);
			
			return $ige[0];
		}
		catch(Exception $e){
			return "[Pillanatnyilag nem érhető el.]";
		}
	}
	
	echo "Napi ige: ".get_DailyWord();
?>
