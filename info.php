<?php

/*Set it to `true` to allow showing php_info on server. */
$allow = true;

$local = preg_match("/localhost/", $_SERVER["HTTP_HOST"]);

if($local or $allow){
    phpinfo();
}
else{
    echo "Permission denied.";
}
?>
