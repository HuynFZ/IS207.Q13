<?php

class Person {
    public function __construct(public string $name, public int $age) {
    }

    public function introduce(): string {
        return "Hi, I'm " . $this->name . " and I'm " . $this->age . " years old!";
    }
}

$person = new Person("Helios", 20);
echo $person->introduce() . "\n";

class Employee extends Person {
    public function __construct(public string $name, public int $age, public string $position) {
        parent::__construct($name, $age);
    }

    public function introduce(): string {
        return parent::introduce() . " I'm working as a " . $this->position . ".";
    }
}

$people = [
    new Employee("Elio", 20, "Manager"),
    new Person("Kudoo", 21),
];

function introduce(Person $person): string {
    return $person->introduce() . "\n";
}

foreach ($people as $person) {
    echo $person->introduce() . "\n";
}
