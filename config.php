<?php

define('DBHOST','localhost');
define('DBUSER','root');
define('DBPWD','');
define('DBNAME','advertising');
define('DBCHARSET','utf8');


$conn = new mysqli(DBHOST, DBUSER, DBPWD, DBNAME);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,DBCHARSET);

?>