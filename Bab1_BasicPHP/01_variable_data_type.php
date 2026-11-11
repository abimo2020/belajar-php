<?php

// Variabel diawali '$'
$nama = "Bimo";         // string
$umur = 26;             // int
$tinggi = 170.5;        // float
$sudahMenikah = false;  // bool
$pekerjaan = null;      // null

// Print pakai "" agar variabel dapat terbaca
echo "Hello $nama" . PHP_EOL;

// Print pakai '' akan mencetak apa adanya
echo 'Hello $nama' . PHP_EOL;

// Cek tipe data dan isinya
var_dump($umur);
var_dump($pekerjaan);
var_dump($tinggi);

// Konstanta
const DB_NAME = "mission_db";
echo DB_NAME . PHP_EOL;

// Casting
$angkaStr = "21";
$angkaInt = (int) $angkaStr;

var_dump($angkaInt);

