<?php
echo "<base href='http://localhost:8000/'>";
$db_host="153.92.15.64";
$db_user="u105852244_administrator3";
$db_password="H@rn1c5h0p#@!2025";
$db_name="u105852244_harnicproducts";

$link = new mysqli($db_host, $db_user, $db_password, $db_name);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>