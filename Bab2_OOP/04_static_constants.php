<?php 

declare(strict_types=1);

// Class constants: nilai konstan milik class, diakses menggunakan Class::Constants

class App {
    public const NAME = "Todo CLI";
    public const VERSION = "1.0.0";
    public const MAX_TITLE = 50;

    private const FILE = "todos.json";  

    public static function fileName() : string {
        return self::FILE;
    }
}

echo App::NAME . " v" . App::VERSION . PHP_EOL;
echo "Maksimal judul " . App::MAX_TITLE . " karakter" . PHP_EOL;
echo App::fileName() . PHP_EOL;

// Static property: satu nilai untuk semua object
class Penghitung {
    private static int $jumlah =  0;
    public function __construct(){
        self::$jumlah++;
    }

    public static function total() : int {
        return self::$jumlah;
    }
}

new Penghitung();
new Penghitung();

echo "total object: " . Penghitung::total() . PHP_EOL;

// Static method: dipanggil tanpa membuat object
class Validator {
    public static function isTitleValid(string $judul) : bool {
        return trim($judul) !== "" && mb_strlen($judul) <= App::MAX_TITLE;
    }
}

var_dump(Validator::isTitleValid("   "));
var_dump(Validator::isTitleValid("Belajar PHP"));

// Static method tidak punya $this karena tidak ada objectnya
class Ex {
    public string $name = "contoh";

    public static function try() : void {
        // echo $this->name;
        echo "static method tidak bisa akses \$this" . PHP_EOL;
    }
}

Ex::try();

enum Status : string {
    case Finished = "finished";
    case Unfinished = "unfinished";
}

// Named constructor (static factory): cara lain membuat object dengan nama yang jelas
class Todo {
    public function __construct(
        public readonly int $id,
        private string $title,
        private Status $status = Status::Unfinished,
    ){}

    public static function fromArray(array $data) : self {
        return new self(id: $data["id"],title: $data["title"], status: Status::from($data["status"]));
    }

    public function toArray() : array {
        return [
            "id"     => $this->id,
            "title"  => $this->title,
            "status" => $this->status->value,
        ];
    }
    public function getTitle() : string {
        return $this->title;
    }
}

$json = '[{"id":1,"title":"Test 1","status":"unfinished"},{"id":2,"title":"Test 2","status":"unfinished"}]';
$rawData = json_decode($json,true);

$todos = array_map(fn($data) => Todo::fromArray($data) , $rawData );
echo count($todos) . " todo dimuat, pertama: " . $todos[0]->getTitle() . PHP_EOL;

$backToArray = array_map(fn(Todo $todo) => $todo->toArray(),$todos);
echo json_encode($backToArray, JSON_UNESCAPED_UNICODE) . PHP_EOL;

// self vs static (late static binding): terasa saat inheritance
class Induk {
    public static function buat(): static { // static merupakan dari class pemanggil bukan class ini
        return new static();
    }

}

class Anak extends Induk{

}

var_dump(Anak::buat() instanceof Anak);
