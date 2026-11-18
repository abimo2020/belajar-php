<?php

// Constructor: function yang langsung jalan ketika buat object baru
class OldTodo{
    private int $id;
    private string $title;
    private bool $isDone = false;

    public function __construct(int $id, string $title)
    {
        $this->id = $id;
        $this->title = trim($title);
    }

    public function getId() : int {
        return $this->id;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getIsDone() : bool {
        return $this -> isDone;
    }

    public function setTitle(string $title) : void {
        $title = trim($title);
        if ($title === ""){
            echo "Judul tidak boleh kosong" . PHP_EOL;
            return;
        }
        $this->title = $title;
    }

    public function markDone() : void {
        $this->isDone = true;
    }
}

$todo = new OldTodo(1, "Title 1"); // Parameter wajib diisi saat object dibuat
echo $todo->getTitle() . "|" . PHP_EOL;

$todo->setTitle(""); // Error validation: judul kosong
$todo->setTitle("Judul baru");
echo $todo->getTitle() . PHP_EOL;

// Error saat mengakses property private
// echo $todo->id;

// Error saat mengubah private property
// $todo->title = "Ini error";

// Visibility: public, private, protected
class Ex {
    public string $a = "Public"; // Bisa diakses dimana saja
    private string $b = "Private"; // Hanya bisa diakses di dalam classnya saja
    protected string $c = "Protected"; // Bisa diakses oleh class dan turunannya

    public function show() : void {
        echo "{$this->a}, {$this->b}, {$this->c}" . PHP_EOL;
    }
}

$ex = new Ex();
$ex->show();

$ex->a = "Public diupdate";
// $ex->b = "Private diupdate"; // Error akses private property
// $ex->c = "Protected diupdate"; // Error akses protected property
$ex->show();

// Constructor promotion (PHP 8+): versi ringkas
class Todo{
    public function __construct(
        private int $id, 
        private string $title,
        private bool $isDone = false
    ) {
        $this->title = trim($title);
    }

    public function getId() : int {
        return $this->id;
    }
    public function getTitle() : string {
        return $this->getTitle();
    }
    public function getIsDone() : bool {
        return $this->isDone;
    }
    public function markDone() : void {
        $this->isDone = true;
    }
    public function show() : void {
        $mark = $this->isDone ? "[x]" : "[ ]";
        echo "{$this->id}. $mark {$this->title}" . PHP_EOL;
    }
}

$newTodo = new Todo(1,"Title 1");
$newTodo->show();
$newTodo->markDone();
$newTodo->show();