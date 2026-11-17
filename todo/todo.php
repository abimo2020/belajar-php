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
    echo "3. Hapus Todo" . PHP_EOL;
    echo "4. Tandai Selesai Todo" . PHP_EOL;
    echo "0. Keluar" . PHP_EOL;
}

function tambahTodo(array $todos,string $title): array {
    if (strlen($title) > 50) {
        echo "Title tidak boleh lebih dari 50 karakter." . PHP_EOL;
        return $todos;
    }
    $id = generateId($todos);
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

function hapusTodo(array $todos, int $id): array {
    $index = array_search($id, array_column($todos,"id"),true);
    if ($index === false) {
        return $todos;
    }
    unset($todos[$index]);
    return array_values($todos);
}

function generateId(array $todos): int {
    if (count($todos) === 0) {
        return 1;
    }
    return max(array_column($todos,"id"))+1;
}

function tandaiSelesai(array $todos, int $id): array {
    $index = array_search($id, array_column($todos,"id"),true);

    if ($index === false){
        echo "Todo:$id tidak ditemukan". PHP_EOL;
        return $todos;
    }
    $todos[$index]["mark_done"] = true;
    return $todos;
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
        case '3':
            $id = (int) trim(readline("Masukkan id: "));
            $jumlahTodo = count($todos);
            $todos = hapusTodo($todos,$id);
            
            if($jumlahTodo == count($todos)){
                echo "Todo dengan id $id tidak ditemukan.";
                break;
            }

            simpanTodo(FILE_TODO,$todos);
            echo "Todo:$id berhasil dihapus." . PHP_EOL;
            break;

        case '4':
            $id = (int) trim(readline("Masukkan id:"));
            $todos = tandaiSelesai($todos,$id);
            simpanTodo(FILE_TODO,$todos);
            echo "Todo dengan id $id ditandai selesai.";
            break;
        case '0':
            echo "Sampai jumpa!" . PHP_EOL;
            exit;
        default:
            echo "Pilihan tidak valid coba lagi." . PHP_EOL;
    }
}