<?php 
	function uj(){
                $beginning = "  <br>
                                <hr>
                                <br>

                                <div id='uj_dolgok'>
                                        <h3>Új!</h3>
                              ";

                $end = "</div>";
               
                try{
                        $content = trim(file_get_contents_safe("content/uj.html"));
			if($content == ""){
				    return "";
			}
                }
                catch(InvalidArgumentException $ex){
                        return "";
                }
                catch(FileCannotBeOpenedException $ex){
                        return "";
                }

                if($content == ""){
                        return "";
                }
                
                return $beginning . $content . $end;
	}
?>
