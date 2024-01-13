<?php 
require_once '../Connection/Connection.php';

$host        = "dpg-cm42hn6n7f5s73bsiq90-a.singapore-postgres.render.com";
$port        = "";
$dbname      = "";
$user        = "";
$password    = "";

Connection::setConnection(
    $host,
    $port,
    $user,
    $password,
    $dbname
);
?>
