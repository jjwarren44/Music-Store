<?php

define('DB_Server','localhost:3306');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_DATABASE','chinook');

$conn = mysqli_connect(DB_Server,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if (!$conn){
    die('DB connection failed').mysqli_error($conn);
}
$select_db = mysqli_select_db($conn, 'chinook');
if (!$select_db){
    die('DB selection failed').mysqli_error($conn);
}
?>