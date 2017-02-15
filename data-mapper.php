<?php

class User {
    private $username;
    private $email;

    public static function fromState(array $state) {
        return new self(
            $state['username'],
            $state['email']
        );
    }

    public function __construct($username, $email) {
        $this->username = $username;
        $this->email = $email;
    }

    public function getUserName() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }
}

class StorageAdapter {
    private $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function find($id) {
        return @$this->data[$id];
    }
}

class UserMapper {
    private $adapter;

    public function __construct(StorageAdapter $adapter) {
        $this->adapter = $adapter;
    }

     /**
     * finds a user from storage based on ID and returns a User object located
     * in memory. Normally this kind of logic will be implemented using the Repository pattern.
     * However the important part is in mapRowToUser() below, that will create a business object from the
     * data fetched from storage
     */
     public function findById($id) {
         $result = $this->adapter->find($id);

         if (!$result) throw new Exception("User #$id not found");

         return $this->mapRowToUser($result);
     }

     private function mapRowToUser(array $row) {
         return User::fromState($row);
     }
}

$data = ['username' => 'Johnny', 'email' => 'mail@mail.com'];
$storage = new StorageAdapter([1 => $data]);
$dataMapper = new UserMapper($storage);

$user = $dataMapper->findById(1);
var_dump($user);

$storage2 = new StorageAdapter([]);
$mapper2 = new UserMapper($storage2);
$user2 = $mapper2->findById(1);
var_dump($user2);