<?php

// Class = blueprint/cetakan
// Object = hasil blueprint yang nyata
// Property = data milik object
// Method = function milik object

class Todo {
    public int $id;
    public string $title;
    public bool $isDone = false;

    public function markDone() : void {
        $this->isDone = true;
    }

    public function show() : void {
        $mark = $this->isDone ? "[x]":"[ ]";

        echo "{$this->id}. $mark {$this->title}" . PHP_EOL;
    }
}

// Membuat object dari class
$todo1 = new Todo();
$todo1->id = 1;
$todo1->title = "Todo 1";

$todo2 = new Todo();
$todo2->id = 2;
$todo2->title = "Todo 2";

$todo1->show();
$todo1->markDone();

$todo1->show();
$todo2->show();

var_dump($todo1);
var_dump($todo2);

// Object sebagai parameter function
function doneTodo(Todo $todo) : void {
    $todo->markDone();
}

doneTodo($todo2);

$todo2->show();

// Cek type todo
var_dump($todo1 instanceof Todo);

$listTodo = [$todo1,$todo2];

foreach ($listTodo as $todo) {
    $todo->show();
}