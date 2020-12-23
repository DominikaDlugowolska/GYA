<?php
$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

$obj = json_decode($age);
echo $obj->access_token;
?>