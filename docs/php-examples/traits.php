<?php

interface Logger {
    public function log($message): void;
}

trait Loggable {
    public function log($message): void {
        echo "Logging: $message\n";
    }
}
class User implements Logger {
    use Loggable;
    public function __construct(public string $name) {

    }

    public function save(): void {
        $this->log("User {$this->name} saved");
    }
}

$user = new User("Helios");
$user->save();