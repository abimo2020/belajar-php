<?php
    while(true){
        echo PHP_EOL . "==== TODO LIST===" . PHP_EOL;
        echo "1. Lihat Todo" . PHP_EOL;
        echo "2. Tambah Todo" . PHP_EOL;
        echo "3. Tandai Selesai" . PHP_EOL;
        echo "0. Keluar" . PHP_EOL;

        $input = trim(readline("Pilih menu: "));

        switch ($input) {
            case '1':
                echo "Fitur lihat todo belum dibuat";
                break;
            case '2':
                echo "Fitur tambah todo belum dibuat";
                break;
            case '3': 
                echo "Fitur tandai selesai belum dibuat";
                break;
            case '0':
                echo "Sampai jumpa!";
                exit;
            default:
                echo "Pilihan tidak valid coba lagi.";
                break;
        }
    }