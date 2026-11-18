<?php

declare(strict_types=1);

// strict_type: php tidak lagi diam2 mengubah type 
function add(int $a, int $b): int {
    return $a+$b;
}

echo add(4,3) . PHP_EOL;

try{
    echo add("4","3");
}catch(TypeError $e){
    echo "Type error: argumen bertipe salah" . PHP_EOL;
}

// Nullable (?type): boleh berisi null atau value bertipe itu
function greet(?string $name = null) : void {
    echo "Hai, " . ($name ?? "tamu") . "!" . PHP_EOL;
}

greet();

greet("Damar");

// Union type: boleh satu atau beberapa type
function formatId(int|string $id) : string {
    return "ID-$id";
}

echo formatId(1) . PHP_EOL;
echo formatId("A1") . PHP_EOL;

// Readonly: hanya boleh diisi sekali di constructor, setelah itu terkunci
class Coordinates{
    public function __construct(
        public readonly int $x,
        public readonly int $y
    ){}
}

$c = new Coordinates(3,2);
echo $c->x . PHP_EOL;

try{
    $c->y=4;
}catch(Error $e){
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

// Enum: kumpulan pilihan
enum Priority {
    case High;
    case Low;
    case Medium;
}

$p = Priority::High;
echo $p->name . PHP_EOL;
var_dump($p === Priority::High);

// Backed enum: setiap pilihan punya nilai (string atau int)
enum Status : string {
    case Unfinished = "unfinished";
    case Finished = "finished";

    public function mark() : string {
        return match($this){
            self::Unfinished => "[ ]",
            self::Finished => "[x]",
        };
    }
}

echo Status::Unfinished->value . PHP_EOL;
echo Status::Finished->mark() . PHP_EOL;

$dariJson = Status::from("unfinished");
echo $dariJson->name . PHP_EOL;
var_dump(Status::tryFrom("random"));

foreach (Status::cases() as $status){
    echo "{$status->name} = {$status->value}" . PHP_EOL;
}

echo json_encode(["status" => Status::Finished]) . PHP_EOL;

class Todo{
    public function __construct(
        public readonly int $id, 
        private string $title,
        private Status $status = Status::Unfinished
    ) {
        $this->title = trim($title);
    }

    public function getId() : int {
        return $this->id;
    }
    public function getTitle() : string {
        return $this->title;
    }
    public function getIsDone() : Status {
        return $this->status;
    }
    public function markDone() : void {
        $this->status = Status::Finished;
    }
    public function show() : void {
        echo "{$this->id}. {$this->status->mark()} {$this->title}" . PHP_EOL;
    }
}


function findTodo(array $todoList, int $id) : ?Todo {
    foreach($todoList as $todo) {
        if ($todo->id === $id) {
            return $todo;
        }
    }
    return null;
}

$todoList = [
    new Todo(1,"title 1"),
    new Todo(2, "title 2"),
];

$todo = findTodo($todoList,1);
if ($todo !== null) {
    $todo->markDone();
    $todo->show();
}

var_dump(findTodo($todoList,99));