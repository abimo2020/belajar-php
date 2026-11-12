<?php 

$nilai = 80;

// If else
if ($nilai > 80) {
    echo "Nilai A+" . PHP_EOL;
}else if ($nilai >70) {
    echo "Nilai B+" . PHP_EOL;
}else {
    echo "Nilai C" . PHP_EOL;
}

$umur = 15;
$punyaAnak = false;

if ($punyaAnak && $umur < 21) {
    echo "Kok normal" . PHP_EOL;
}

// Switch case
$hari = "sabtu";
switch($hari){
    case "senin":
    case "minggu":
        echo "Libur dulu" . PHP_EOL;
        break;
    case "selasa":
        echo "Lembur dah" . PHP_EOL;
        break;
    default:
        echo "Hari biasa" . PHP_EOL;
        break;
}

// Match: fitur PHP 8+, lebih ringkas, return value, perbandingan dengan '==='
$pesan = match($hari)  {
    "sabtu", "minggu" => "Akhir pekan",
    "senin" => "hari kecepit",
    default => "hari masuk kerja", 
};

echo $pesan . PHP_EOL;

$kategori = match(true) {
    $nilai >= 75 => "Pintar",
    $nilai <50 => "Bodoh",
    default => "Belajar lagi deh",
};

echo $kategori .PHP_EOL;

// Exercise

$input = (int) trim(readline("Masukkan angka: "));

$res = match(true){
    $input == 0 => "Bilangan Nol",
    $input > 0 => "Bilangan Positif",
    $input < 0 => "Bilangna Negatif",
};

echo "$input adalah " . $res . PHP_EOL;