<?php

declare(strict_types=1);

// 1. trait: kumpulan property dan method yang bebas digunakan di class manapun
trait GotTime{
    private ?string $createdAt;

    public function recordCreatedAt() : void {
        $this->createdAt = date("D-M-Y H:i:s");
    }

    public function getCreatedAt() : string {
        return $this->createdAt;
    }
}

// penggunaan trait (use)
class Todo {
    use GotTime;
    public function __construct(
        public readonly int $id,
        private string $title,
    )
    {
        $this->recordCreatedAt();
    }
    
    public function getTitle() : string {
        return $this->title;
    }
}

class Note {
    use GotTime; // bisa digunakan lagi di class lain

    public function __construct(
        private string $value,
    )
    {
        $this->recordCreatedAt();
    }
}

$todo = new Todo(1,"Bebas");
$note = new Note("Catatan");

echo $todo->getCreatedAt() . PHP_EOL;
echo $note->getCreatedAt() . PHP_EOL;

var_dump($todo instanceof GotTime); // todo tidak berhubungan lewat perwarisan (false), hanya berbagi kode yang sama

trait CanRecordLog {
    private array $log = [];

    public function recordLog(string $message) : void {
        $this->log[] = "[". date("H:i:s") . "] $message";
    }

    public function getLogs() : array {
        return $this -> log;
    }
}

// 2. Satu class bisa punya banyak trait 
class Order {
    use GotTime, CanRecordLog;

    public function __construct(
        public readonly int $id,
    ){
        $this->recordCreatedAt();
        $this->recordLog("Pesanan $id telah dibuat");
    }
}

$order = new Order(101);
$order->recordLog("Pesanan diterima");

print_r($order->getLogs());

// 3. Trait boleh punya abstract method: class pemakai wajib implementasi
trait CanShow{
    abstract public function getTitle() : string;

    public function show() : string {
        return "=== " . strtoupper($this->getTitle()) . " ===";
    }
}

class Article {
    use CanShow;

    public function getTitle() : string {
        return "Belajar trait";
    }
}

echo (new Article()) -> show() . PHP_EOL;

// 4. Trait boleh punya static method dan static property
trait Count {
    private static int $count = 0;

    public static function addCount() : int{
        return ++self::$count;
    } 
}

class A{use Count;}
class B{use Count;}

A::addCount();
A::addCount();
 
echo A::addCount() . PHP_EOL;
echo B::addCount() . PHP_EOL;

// Conflict trait: trait punya nama method yang sama
trait Halo {
    public function greet() : string {
        return "Halo";
    }
}

trait Hai {
    public function greet(): string {
        return "Hai";
    }
}

class Greeter {
    use Halo, Hai{
        Halo::greet insteadof Hai;
        Hai::greet as alternativeGreet;
    }
}

$greeter = new Greeter();
echo $greeter->greet() . PHP_EOL;
echo $greeter->alternativeGreet() . PHP_EOL;

// 6. trait + interface
interface CanArray {
    public function toArray() : array;
}

trait ToArrayAutomatic {
    public function toArray() : array {
        return get_object_vars($this);
    }
}

class Product implements CanArray {
    use ToArrayAutomatic;

    public function __construct(
        public string $name,
        public float $price,
    ){}
}

print_r((new Product("Kulkas", 8000))->toArray());

// 7. Trait tidak bisa dibuat instance dan dipakai sebagai type
// $t = GotTime();
function test(GotTime $x){} // Type-hint ke trait tidak bisa untuk dipakai memeriksa object