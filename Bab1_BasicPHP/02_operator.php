<?php

$a = 10;
$b = 3;

// Aritmatika
echo $a + $b . PHP_EOL;
echo $a - $b . PHP_EOL;
echo $a * $b . PHP_EOL;
echo $a / $b . PHP_EOL;
echo $a % $b . PHP_EOL;
echo $a ** $b . PHP_EOL;
echo intdiv($a,$b) . PHP_EOL;

// Assigment
$total = 1000;
$total += 20;
$total += 10;
$total *= 2;
$total++;
echo $total . PHP_EOL;

// String: concate menggunakan '.'
$depan = "Aryo";
$belakang = "Bimo";
echo $depan . " " . $belakang . PHP_EOL;
$belakang .= " Tambahan"; // Bimo Tambahan
echo $belakang . PHP_EOL;

// Perbandingan
var_dump(5 == "5");
var_dump(5 === "5");
var_dump(5 != 6);
var_dump(5 !== "5");
var_dump(5 > 7);
var_dump(7 <= 7);

// Logika
$punyaAnak = true;
$umur = 15;
var_dump($punyaAnak && $umur > 10 );
var_dump($umur < 10 || $punyaAnak);
var_dump($punyaAnak);

// Null coalescing
$alamat = null;
echo ($alamat??"Alamat kosong") . PHP_EOL;

// Ternary
$status = $umur > 10 ? "Remaja" : "Anak-anak";
echo $status . PHP_EOL;

// Test
var_dump(5%2 == 0);
var_dump(0 == "abc");
var_dump(0 === "abc");