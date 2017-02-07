<?php

interface IHead
{
    public function drawHead($x, $y);
}

class RedHead implements IHead
{
    public function drawHead($x, $y)
    {
        echo "Red Head x: ${x}, y: ${y}" . PHP_EOL;
    }
}

class WhiteHead implements IHead
{
    public function drawHead($x, $y)
    {
        echo "White head x: ${x}, y: ${y}" . PHP_EOL;
    }
}

interface IBody
{
    public function drawBody($x, $y);
}

class RedBody implements IBody
{
    public function drawBody($x, $y)
    {
        echo "Red body x: ${x}, y: ${y}";
    }
}

class WhiteBody implements IBody
{
    public function drawBody($x, $y)
    {
        echo "White body x: ${x}, y: ${y}";
    }
}
//this is abstruct factory
interface ISnowman
{
    public function drawHead($x, $y);
    public function drawBody($x, $y);
}

//concrete factory
class WhiteSnowman implements ISnowman
{
    protected $head;
    protected $body;
    
    public function __construct()
    {
        $this->head = new WhiteHead();
        $this->body = new WhiteBody();
    }
    
    public function drawHead($x, $y)
    {
        $this->head->drawHead($x, $y);
    }
    
    public function drawBody($x, $y)
    {
        $this->body->drawBody($x, $y);
    }
}

//concrete factory
class RedSnowman implements ISnowman
{
    protected $head;
    protected $body;

    public function __construct()
    {
        $this->head = new RedHead();
        $this->body = new RedBody();
    }

    public function drawHead($x, $y)
    {
        $this->head->drawHead($x, $y);
    }

    public function drawBody($x, $y)
    {
        $this->body->drawBody($x, $y);
    }
}

function snowman(ISnowman $snowman)
{
    $snowman->drawHead(1, 1);
    $snowman->drawBody(1, 2);
}

$typeSnowman = 'red';
if ($typeSnowman === 'red')
    $snowman = new RedSnowman();
else
    $snowman = new WhiteSnowman();

snowman($snowman);