<?php
include_once('api.php');

$api = new api();
echo $api->getApi($_GET["canal"]);
?>