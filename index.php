<?php
header("Access-Control-Allow-Orgin: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");


echo json_encode(array("status" => "Please access the site with http://".$_SERVER['HTTP_HOST']."/api/<model>/<arguments>"));

?>
