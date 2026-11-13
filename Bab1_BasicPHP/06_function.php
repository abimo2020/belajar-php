<?php

// Basic function
function Sapa(){
    echo "Hallo" . PHP_EOL;
}

function SapaKamu($nama){
    echo "Hallo, $nama!" . PHP_EOL;
}

function Perkalian($a,$b){
    return $a * $b;
}

Sapa();
SapaKamu("Ayay");

$a = 3;
$b = 2;
echo "Perkalian $a dan $b adalah ". Perkalian($a,$b) . PHP_EOL;

// Function Type Declaration
function Tambah(int $a, int $b): int {
    return $a + $b;
}
echo Tambah(10,20) . PHP_EOL;

// Default function
function SapaWaktu(string $name, string $waktu = "Pagi"){
    echo "Selamat $waktu $name.." . PHP_EOL;
} 

SapaWaktu("Bede");
SapaWaktu(name:"Ryo", waktu:"Malam");

// Return banyak nilai
function hitungStatistik(array $angka): array{
    return [
        "total" => array_sum($angka),
        "rata_rata" => array_sum($angka) / count($angka),
        "terbesar" => max($angka),
    ];
}

$stat = hitungStatistik([1,2,23,4]);
echo "Rata-rata: {$stat["rata_rata"]}";

// Kirim data lewat parameter
function tambahTodo(array $todos, string $judul): array {
    $todos[] = ["judul" => $judul];
    return $todos;
}

$daftar = [];
$daftar = tambahTodo($daftar, "Belajar GO");
$daftar = tambahTodo($daftar, "Belajar PHP");

print_r($daftar);