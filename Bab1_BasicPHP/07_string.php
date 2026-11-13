<?php

$teks = " Belajar PHP Dari Nol ";

// Cek length dan clean string
echo strlen($teks) . PHP_EOL;
echo trim($teks) . PHP_EOL;
echo ltrim($teks) . "|" . PHP_EOL;
echo rtrim($teks) . "|" . PHP_EOL;

$cleanTeks = trim($teks);

// Huruf besar & kecil
echo strtoupper($cleanTeks) . PHP_EOL;
echo strtolower($cleanTeks) . PHP_EOL;
echo ucfirst("aryo bimo") . PHP_EOL;
echo ucwords("aryo bimo") . PHP_EOL;

// Search
var_dump(str_contains($cleanTeks, "PHP"));
var_dump(str_starts_with($cleanTeks, "Belajar"));
var_dump(str_ends_with($cleanTeks,"Nol"));
var_dump(strpos($cleanTeks,"PHP"));
var_dump(strpos($cleanTeks,"Laravel"));

// Ambil sebagian
echo substr($cleanTeks,0,7) . PHP_EOL;
echo substr($cleanTeks,-4) . PHP_EOL;

// Replace
echo str_replace("PHP","Laravel",$cleanTeks) . PHP_EOL;

// String <-> Array
$kata = explode(" ",$cleanTeks);
print_r($kata);
echo implode("-",$kata) . PHP_EOL;


// Format & Padding
echo str_repeat("=",20) . PHP_EOL;
echo str_pad("Hai",7,".") . "|" . PHP_EOL;
echo str_pad("3",3,"0",STR_PAD_LEFT) . PHP_EOL;

printf("Nama: %s, Umur: %d, Nilai: %.2f" . PHP_EOL,"Aryo", 17,85.32);
$laporan = sprintf("%s lulus dengan nilai %.1f","Budi",78.231);
echo $laporan . PHP_EOL;

// Heredoc: teks beberapa baris
$nama = "Sugeng";
$teksPanjang = <<<TEKS
Halo $nama
Selamat datang di Kelas PHP
TEKS;
echo $teksPanjang . PHP_EOL;

// Membadingkan string
var_dump("abc" === "abc");
var_dump(strcasecmp("PHP","php")); // Abaikan besar kecil huruf

// Cek kosong
var_dump(empty(""));
var_dump(empty("0"));
var_dump(trim("    ")==="");

// Exercise
function TitleFormatter(string $str): string {
    $res = trim(strtoupper($str));
    return $res == ""?"Judul Kosong":$res;
}

echo TitleFormatter("Sumber waras") . PHP_EOL;
echo TitleFormatter(" ");