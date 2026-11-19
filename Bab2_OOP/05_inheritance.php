<?php

declare(strict_types=1);

class Animal {
    public function __construct(
        protected string $name,
    ){
    }

    public function introduce():void{
        echo "Saya {$this->name}" . PHP_EOL;
    }

    public function sound() : void {
        echo "...." . PHP_EOL;
    }
}

// 1. Extends: class anak mewarisi property dan method dari induk
class Cat extends Animal {
    // Override: menimpa method induk dengan versi sendiri
    public function sound() : void {
        echo "Miawww.." . PHP_EOL;
    }
}

class Dog extends Animal {
    public function sound() : void {
        echo "Guk guk guk.." . PHP_EOL;
    }

    // Method baru hanya dimiliki oleh anak
    public function catchTheBall() : void {
        echo "{$this->name} mengambil bola.." . PHP_EOL;
    }
}

$cat = new Cat("Momo");
$dog = new Dog("Meli");

$cat->introduce();
$cat->sound();
$dog->introduce();
$dog->sound();
$dog->catchTheBall();

// 2. parent:: : memanggil versi induk, lalu menambahkan diatasnya
class Rabbit extends Animal {
    public function __construct(
        string $name,
        public string $color, // menambahkan property baru
    ){
        parent::__construct($name); // Mengisi construct milik parent
    }

    public function introduce() : void {
        echo "Saya {$this->name}, kelinci berwarna {$this->color}." . PHP_EOL;
    }
}

(new Rabbit("Damar","merah"))->introduce();

// 3. Polimorfisme: satu pemanggilan, perilaku berbeda sesuai object-nya

$listHewan = [new Cat("catty"), new Dog("doggy"), new Animal("general")];

foreach ($listHewan as $hewan) {
    echo $hewan::class . ": ";
    $hewan->sound();
}

// Function yang menerima parameter bertipe induk, berarti juga menerima semua tipe turunannya
function introduce(Animal $animal){
    $animal->introduce();
}

introduce(new Cat("Sugeng"));

// 4. instanceof: cek tipe (termasuk tipe induknya)
var_dump($cat instanceof Animal);
var_dump($cat instanceof Cat);
var_dump($cat instanceof Dog);

// 5. final: mencegah pewarisan dan override
class Configuration {
    final public function getVersion() :string { // method ini ga boleh di override
        return "1.0.0";
    }
}

final class Singleton{} // class ini ga boleh diwariskan


// 6. Penerapan di Todo
enum Status : string {
    case Finished = "finished";
    case Unfinished = "unfinished";

    public function getMark(): string{
        return match($this){
            self::Finished => "[x]",
            self::Unfinished => "[ ]"
        };
    }
}


class Todo {
    public function __construct(
        public readonly int $id,
        protected string $title,
        protected Status $status = Status::Unfinished,
    ){
    }

    public function markDone() : void {
        $this->status = Status::Finished;
    }

    public function show() : string {
        return "{$this->id}. {$this->status->getMark()} {$this->title}";
    }

    public static function create(int $id, string $title) : static {
        return new static($id,$title); // static class yang memanggil
    }
}

class TodoDeadline extends Todo{ 
    private ?string $deadline = null;

    public function setDeadline(string $date) : void {
        $this->deadline = $date;
    }

    public function show() : string {
        $base = parent::show();
        return $this->deadline === null ? $base : "$base {deadline: $this->deadline}";
    }
}

$normal = new Todo(1, "Belajar PHP");
$deadline = new TodoDeadline(2, "Menyelesaikan Integrasi Netzme");
$deadline->setDeadline("2026-11-11");

foreach ([$normal,$deadline] as $todo) {
    echo $todo->show() . PHP_EOL;
}

// self vs static
var_dump(Todo::create(1,"test") instanceof Todo);
var_dump(TodoDeadline::create(2,"test2") instanceof TodoDeadline);
// Kalau function create return new self, TodoDeadline::create akan menghasilkan tipe Todo (induk)