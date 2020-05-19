<?php

class Rectangle
{
    protected $width;
    protected $height;

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    public function getArea()
    {
        return $this->height * $this->width;
    }
}

class Square extends Rectangle
{
    public function setHeight($value): void
    {
        $this->width = $value;
        $this->height = $value;
    }

    public function setWidth($value): void
    {
        $this->width = $value;
        $this->height = $value;
    }
}

$figure = new Square();
$figure->setHeight(5);
$figure->setWidth(4);
echo $figure->getArea();

