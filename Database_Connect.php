<?php

//mysql db connection information
$hostname = "localhost"; //host
$database = "urls";
$username = "root"; 
$password = ""; 
$site = mysql_connect($hostname, $username, $password); 

mysql_select_db($database, $site);
//

$server_name = "http://".$_SERVER['HTTP_HOST']."/";

//create the urls table if it's not already there:
mysql_query("CREATE TABLE IF NOT EXISTS `url_table` (
  `url_id` int  auto_increment ,
  `full_url` TEXT default NULL,
  `short_url` TEXT default NULL,
  
  
  PRIMARY KEY  (`url_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;");
//

?>