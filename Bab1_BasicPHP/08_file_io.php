<?php

// DIR: folder tempat file ini berada.
$folder = __DIR__ . "/data";
$fileTeks = $folder . "/notes.txt";
$fileJson = $folder . "/todos.json";

// Buat folder kalau ga ada
if (!is_dir($folder)) {
    mkdir($folder,0755,true);
} 

// Menulis file: membuat file baru atau menimpa isi file
file_put_contents($fileTeks,"Baris Pertama" . PHP_EOL);

// Menambah isi file tanpa menimpa: flag FILE_APPEND
file_put_contents($fileTeks, "Baris Kedua" . PHP_EOL, FILE_APPEND);
file_put_contents($fileTeks, "Baris Ketiga". PHP_EOL, FILE_APPEND);

// Membaca isi file jadi string
$isiFile = file_get_contents($fileTeks);
echo $isiFile;

// Membaca perbaris jadi array
$baris = file($fileTeks, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
print_r($baris);

if (file_exists($fileTeks)){
    echo "File ada, ukuran: " . filesize($fileTeks) . " byte" . PHP_EOL;
}

// Mencoba membaca file yang tidak ada (Warning + false)
$none = @file_get_contents($folder . "/none.txt"); // '@' menekan warning
var_dump($none);

// Hapus file
unlink($fileTeks);

// JSON
$todos = [
    ["id" => 1, "title" => "Test ABC"],
    ["id" => 2, "title" => "Test XYZ"],
];

$json = json_encode($todos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo $json . PHP_EOL;

// Simpan ke File
file_put_contents($fileJson,$json);

// Baca File JSON -> String, parameter true menjadikan array associative
$todoJson = json_decode(file_get_contents($fileJson),true);
echo count($todoJson) . PHP_EOL;
echo $todoJson[0]["title"] . PHP_EOL;
