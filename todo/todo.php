<?php

function tampilkanMenu(): void {
    echo PHP_EOL . "=== TODO LIST ===" . PHP_EOL;
    echo "1. Lihat Todo" . PHP_EOL;
    echo "2. Tambah Todo" . PHP_EOL;
    echo "0. Keluar" . PHP_EOL;
}

function tambahTodo(array $todos,string $title): array {
    $id = count($todos) + 1;
    $todos[] = ["id" => $id, "title" => $title, "mark_done" => false];
    return $todos;
}

function lihatTodo(array $todos): void {
    if (count($todos) === 0) {
        echo "Belum ada todo" . PHP_EOL;
        return;
    }

    foreach($todos as $todo) {
        $mark = $todo["mark_done"]?"[x]":"[ ]";
        echo "{$todo["id"]}. $mark {$todo["title"]}" . PHP_EOL;
    }
}

$todos = [];

while(true){
    tampilkanMenu();

    $input = trim(readline("Pilih menu: "));

    switch ($input) {
        case '1':
            lihatTodo($todos);
            break;
        case '2':
            $judul = trim(readline("Masukkan judul: "));
            if ($judul === ""){
                echo "Judul tidak boleh kosong." . PHP_EOL;
                break;
            }
            $todos = tambahTodo($todos,$judul);
            echo "Todo telah ditambahkan." . PHP_EOL;
            break;
        case '0':
            echo "Sampai jumpa!" . PHP_EOL;
            exit;
        default:
            echo "Pilihan tidak valid coba lagi." . PHP_EOL;
    }
}