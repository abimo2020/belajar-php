<?php

// Array
$buah = ["apel", "jeruk","nanas"];

echo $buah[0] . PHP_EOL;
echo count($buah) . PHP_EOL;

$buah[] = "mangga";
array_push($buah,"pisang");
$buah[1] = "anggur";

// Associative Array
$mahasiswa = [
    "nama" => "ryo",
    "umur" => 7,
];

echo $mahasiswa["nama"] . PHP_EOL;
$mahasiswa["jurusan"] = "pelawak";
echo $mahasiswa["jurusan"] . PHP_EOL;
unset($mahasiswa["umur"]);

// Cek key
var_dump(isset($mahasiswa["nama"]));
var_dump(isset($mahasiswa["umur"]));
echo ($mahasiswa["umur"]??"Belum diisi") . PHP_EOL;

// Foreach untuk indexed array
foreach($buah as $b) {
    echo "Nama buah: $b" . PHP_EOL;
}

// Foreach ambil indeks dan isinya
foreach($buah as $k => $v) {
    echo "Buah ke-$k: $v" . PHP_EOL;
}

// Foreach key-value assoc array
foreach($mahasiswa as $k => $v) {
    echo "$k: $v" . PHP_EOL;
}

// Multidimensi array
$todos = [
    ["id" => 1, "title"=> "Belajar PHP", "is_done" => false],
    ["id" => 2, "title" => "Belajar Golang", "is_done" => true],
];

$todos[] = ["id" => 3, "title" => "Belajar C#","is_done" => false];

foreach ($todos as $todo) {
    $mark = $todo["is_done"]?"[x]":"[]";
    echo "$mark {$todo["title"]}" . PHP_EOL;
}

// Fungsi array
$angka = [3,2,5,7,1];

echo implode(", ",$angka) . PHP_EOL;
var_dump(in_array(1, $angka));
sort($angka);
echo implode(", ",$angka) . PHP_EOL;
echo max($angka) . " ". min($angka) . PHP_EOL;

$tanpa1 = array_filter($angka, fn($n) => $n != 1);
$dikali2 = array_map(fn($n) => $n * 2, $angka);
echo implode(" ,",$angka);

var_dump($tanpa1); // index 0 hilang karena hasil filter jadi dimulai 1
$newTodo = array_values($tanpa1); // merapikan ulang index, index dimulai dari 0 lagi
var_dump($newTodo); 

// Exercises
$doneTodo = array_filter($todos,fn($value) =>$value["is_done"] );
var_dump($doneTodo);
echo count($doneTodo) . PHP_EOL;
print_r($doneTodo);