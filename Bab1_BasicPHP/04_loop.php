<?php

// For loop
for ($i = 1; $i <=5; $i++){
    if ($i == 2) {
        continue;
    }
   
    echo "Iterasi ke-$i".PHP_EOL;
    if ($i == 4) {
        break;
    }
}

// While loop
$counter = 5;
while($counter > 0) {
    echo "Counter $counter" . PHP_EOL;
    $counter--;
}

// Do while: jalankan sekali pengecekan kondisi terakhir
$angka = 10;
do{
    echo "Ini tetap jalan, angka = $angka" . PHP_EOL;
    $angka++;
}while($angka <5);

// Foreach
$item = ["Apel", "Duren", "Nangka"];

foreach($item as $v) {
    echo "Buah $v" .PHP_EOL;
}

// Exercise fizzbuzz

for($i = 0; $i <= 20; $i++){
    if ($i % 3 == 0 && $i % 5 == 0) {
        echo "FizzBuzz";
    }else if ($i % 3 == 0) {
        echo "Fizz";
    }else if ($i % 5 == 0) {
        echo "Buzz";
    }else {
        echo $i;
    }
    echo PHP_EOL;
}