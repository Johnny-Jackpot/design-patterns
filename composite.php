<?php

interface IRenderable {
    public function render();
}

class Form implements IRenderable {
    private $elements;

    public function render() {
        $formCode = '<form>';

        foreach ($this->elements as $elem) {
            $formCode .= $elem->render();
        }

        $formCode .= '</form>';

        return $formCode;
    }

    public function addElement(IRenderable $elem) {
        $this->elements[] = $elem;
    }
}

class InputElem implements IRenderable {
    public function render() {
        return '<input type="text"/>';
    }
}

class TextElem implements IRenderable {
    private $text;

    public function __construct($text) {
        $this->text = $text;
    }

    public function render() {
        return $this->text;
    }
}

$form = new Form();
$form->addElement(new TextElem('Hello world!'));
$form->addElement(new InputElem());

$embed = new Form();
$embed->addElement(new TextElem('Another text elem'));
$embed->addElement(new InputElem());

$form->addElement($embed);

echo $form->render();
