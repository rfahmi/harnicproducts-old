<?php
$ip = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
$accessdate = date("Ymd"); // Mendapatkan accessdate sekarang
$accesstime   = time(); //
// Mencek berdasarkan IPnya, apakah user sudah pernah mengakses hari ini
$s = $link->query("SELECT * FROM statistik WHERE ip='$ip' AND accessdate='$accessdate'");

// Kalau belum ada, simpan data user tersebut ke database
if($s->num_rows == 0){
    $link->query("INSERT INTO statistik(ip, accessdate, accesstime) VALUES('$ip','$accessdate','$accesstime')");
}
// Jika sudah ada, update
else{
    $link->query("UPDATE statistik SET accesstime='$accesstime' WHERE ip='$ip' AND accessdate='$accessdate'");
}

$pengunjung = $link->query("SELECT * FROM statistik WHERE accessdate='$accessdate' GROUP BY ip")->num_rows;
?> 