<?php

interface IFormatter {
    public function format($text);
}

class PlainTextFormatter implements IFormatter {
    public function format($text) {
        return $text;
    }
}

class HTMLFormatter implements IFormatter {
    public function format($text) {
        return "<p>$text</p>";
    }
}

abstract class Service {
    protected $implementation;

    public function __construct(IFormatter $formatter) {
        $this->implementation = $formatter;
    }

    public function setImplementation(IFormatter $formatter) {
        $this->implementation = $formatter;
    }

    abstract public function get();
}

class HelloWorldService extends Service {
    public function get() {
        return $this->implementation->format('Hello world');
    }
}

$service = new HelloWorldService(new PlainTextFormatter);
var_dump($service->get());

$service->setImplementation(new HTMLFormatter);
var_dump($service->get());