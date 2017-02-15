<?php

interface IRenderable {
    public function renderData();
}

class WebService implements IRenderable {
    private $data;

    public function __construct(string $data) {
        $this->data = $data;
    }

    public function renderData() {
        return $this->data;
    }
}

abstract class RendererDecorator {
    protected $wrapper;

    /**
    * the Decorator MUST implement the RendererInterface contract, this is the key-feature
    * of this design pattern. If not, this is no longer a Decorator but just a dumb
    * wrapper.
    */
    public function __construct(IRenderable $renderer) {
        $this->wrapper = $renderer;
    }

    abstract public function renderData();
}

class XMLRenderer extends RendererDecorator {
    public function renderData() {
        $doc = new DOMDocument();
        $data = $this->wrapper->renderData();
        $doc->appendChild($doc->createElement('content', $data));

        return $doc->saveXML();
    }
}

class JSONRenderer extends RendererDecorator {
    public function renderData() {
        return json_encode($this->wrapper->renderData());
    }
}

$webService = new WebService('hello world!');
$json = new JSONRenderer($webService);
$xml = new XMLRenderer($webService);

var_dump($json->renderData());
var_dump($xml->renderData());