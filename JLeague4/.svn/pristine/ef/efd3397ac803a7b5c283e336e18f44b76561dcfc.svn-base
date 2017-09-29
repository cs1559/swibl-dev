<?php

include_once("database.php");

$parms["driver"] = "MySQL";
$parms["host"] = "127.0.0.1";
$parms["database"] = "swibl";
$parms["user"] = "root";
$parms["password"] = "";

print_r($parms);
$db = &fsDatabase::getInstance($parms);
$db->setPrefix("r0bke");
//r0bke
$db->setQuery("select * from #__jleague_seasons");
$rows = $db->loadObjectList();
print_r($rows);