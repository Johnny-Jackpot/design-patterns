<?php

interface IBook {
    public function turnPage();
    public function open();
    public function getPage();    
}

class Book implements IBook {
    private $page;

    public function open() {
        $this->page = 1;
    }

    public function turnPage() {
        $this->page++;
    }

    public function getPage() {
        return $this->page;
    }
}

interface IElectronicBook {
    public function unlock();
    public function pressNext();
    public function getPage();
}

class Kindle implements IElectronicBook {
    private $page = 1;
    private $totalPages = 100;

    public function pressNext() {
        $this->page++;
    }

    public function unlock() {}

    public function getPage() {
        return [$this->page, $this->totalPages];
    }
}

class EBookAdapter implements IBook {
    protected $eBook;

    public function __construct(IElectronicBook $eBook) {
        $this->eBook = $eBook;
    }

    public function open() {
        $this->eBook->unlock();
    }

    public function turnPage() {
        $this->eBook->pressNext();
    }

    public function getPage() {
        return $this->eBook->getPage()[0];
    }
}

$book = new Book();
$book->open();
$book->turnPage();

var_dump($book);

$kindle = new Kindle();
$anotherBook = new EBookAdapter($kindle);
$anotherBook->open();
$anotherBook->turnPage();

var_dump($anotherBook);