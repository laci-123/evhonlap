<?php 
function get_content(){
    return file_get_contents_safe("content/tortenet.html");
}

function get_content_uj(){
    return get_content();
}
?>
