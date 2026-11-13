<?php

const FILE_TODO = __DIR__ . "/data/todos.json";

function muatTodo(string $path):array{
    if (!file_exists($path)){
        return [];
    }
    $content = file_get_contents($path);
    if ($content === "") {
        return [];
    }    
    return json_decode($content,true)??[];
}

function simpanTodo(string $path, array $todos):void{
    $folder = dirname($path);
    if (!is_dir($folder)){
        mkdir($folder,0755,true);
    }
    $json = json_encode($todos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($path,$json);
}

function tampilkanMenu(): void {
    echo PHP_EOL . "=== TODO LIST ===" . PHP_EOL;
    echo "1. Lihat Todo" . PHP_EOL;
    echo "2. Tambah Todo" . PHP_EOL;
    echo "0. Keluar" . PHP_EOL;
}

function tambahTodo(array $todos,string $title): array {
    if (strlen($title) > 50) {
        echo "Title tidak boleh lebih dari 50 karakter." . PHP_EOL;
        return $todos;
    }
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

$todos = muatTodo(FILE_TODO);

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
            simpanTodo(FILE_TODO,$todos);
            echo "Todo telah ditambahkan." . PHP_EOL;
            break;
        case '0':
            echo "Sampai jumpa!" . PHP_EOL;
            exit;
        default:
            echo "Pilihan tidak valid coba lagi." . PHP_EOL;
    }
}