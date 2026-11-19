<?php 

declare(strict_types=1);

// 1. Abstract class: class setengah jadi, tidak bisa langsung dibuat object (new)
abstract class Shape{
    public function __construct(
        public string $name,
    ){
    }

    // Abstract method: sebuah kontrak. Pewaris class wajib implement method ini
    abstract public function area() : float;

    public function info(): string{
        return sprintf("%s dengan luas %.2f", $this->name,$this->area());
    }
}

// $shape = new Shape("Lingkaran"); // Error cannot intantiate abstract class

class Square extends Shape {
    public function __construct(
        private float $side,
    )
    {
        parent::__construct("Persegi");
    }

    public function area(): float
    {
        return $this->side **2;
    }
}

class Circle extends Shape {
    public function __construct(
        private float $fingers,
    ){
        parent::__construct("Lingkaran");
    }
    public function area(): float
    {
        return M_PI * $this->fingers**2;
    }
}

foreach ([new Square(4), new Circle(5)] as $shape) {
    echo $shape->info() . PHP_EOL;
}

// 2. Interface: kontrak murni, hanya berisi daftar method yang Wajib
interface Storage {
    public function save(array $data): void;
    public function load() : array;
}

class InMemoryStorage implements Storage{
    private array $data = [];

    public function save(array $data): void {
        $this->data = $data;
    }

    public function load() : array {
        return $this->data;
    }
}

class JSONStorage implements Storage {
    public function __construct(
        private string $path,
    ){}

    #[Override]
    public function save(array $data): void
    {
        file_put_contents($this->path,json_encode($data,JSON_PRETTY_PRINT));
    }
    #[Override]
    public function load(): array
    {
        if (!file_exists($this->path)){
            return [];
        }
        return json_decode(file_get_contents($this->path),true) ?? [];
    }
}

// 3. Manfaat utama: kode bergantung pada kontrak, bukan class tertentu
class Note {
    public function __construct(
        private Storage $storage, //type-hint ke interface
    )
    {}

    public function add(string $value) : void {
        $all = $this->storage->load();
        $all[] = $value;
        $this->storage->save($all);
    }

    public function count(): int {
        return count($this->storage->load());
    } 
}

$note1 = new Note(new InMemoryStorage());
$note1->add("Belajar PHP");
echo $note1->count() . PHP_EOL;

$folder = __DIR__ . "/data";
if (!is_dir($folder)){
    mkdir($folder,0755,true);
}

$note2 = new Note(new JSONStorage($folder . "/notes.json"));
$note2->add("Belajar PHP");
echo $note2->count() . PHP_EOL;

// Class Note tidak berubah sama sekali, hanya menukar storage

// 4. Satu class boleh implements banyak interface
interface CanPrint{
    public function print(): string;
}

interface CanArray{
    public function toArray() : array;
}

class Product implements CanPrint,CanArray{
    public function __construct(
        private string $name,
        private float $price,
    ){}

    #[Override]
    public function print(): string
    {
        return "{$this->name}: Rp." . number_format($this->price,0,',','.');
    }

    #[Override]
    public function toArray(): array
    {
        return ["name" => $this->name, "price" => $this->price];
    }
}

$product = new Product("Kopi golda",4500);
echo $product->print() . PHP_EOL;
echo implode(",",$product->toArray()) . PHP_EOL;

// 5. Interface boleh punya konstanta, bisa juga di extends interface lain
interface CanSave extends CanArray{
    const string TABEL = "umum";
    
    public function getId() : int;
}

// 6. Penerapan di Todo
enum Status : string {
    case Finished = "finished";
    case Unfinished = "unfinished";
}

class Todo {
    public function __construct(
        public readonly int $id,
        private string $title,
        private Status $status = Status::Unfinished,
    ){}
}

interface TodoRepository {
    /** @return Todo[] */
    public function getList() : array;
    public function getDetail(int $id) : ?Todo;
    public function save(Todo $todo): void;
    public function delete(int $id):void;
}

class TodoRepositoryInMemory implements TodoRepository{
    /** @var Todo[] */
    private array $todo = [];

    public function getList(): array {
        return array_values($this->todo);
    }

    public function getDetail(int $id): ?Todo {
        return $this->todo[$id] ?? null;
    }

    public function save(Todo $todo) : void {
        $this->todo[$todo->id] = $todo;
    }

    public function delete(int $id) : void {
        unset($this->todo[$id]);
    }
}

$repo = new TodoRepositoryInMemory();
$repo->save(new Todo(1,"Belajar 1"));
$repo->save(new Todo(2,"2 Belajar 2"));
$repo->delete(1);
echo "Total todo: " . count($repo->getList()) . PHP_EOL;
var_dump($repo->getDetail(99));