<?php 
$get_content = function(){
    return file_get_contents_safe("content/tisztsegviselok.html");
};

$get_content_uj = function(){
    return get_content_uj();
};
?>
