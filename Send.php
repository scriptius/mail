<?php
namespace app;
require 'Shedule.php';

$json = json_decode($_POST['data']);

var_dump( Shedule::Add());
var_dump($json->userId);
return $json;