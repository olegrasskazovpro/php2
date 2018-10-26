<?php

class Rectangle
{
	protected $height;
	protected $width;

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
}

class Square extends Rectangle
{
	public function setHeight($height): void
	{
		parent::setHeight($height);
		$this->width = $height;
	}

	public function setWidth($width): void
	{
		parent::setWidth($width);
		$this->height = $width;
	}
}

$figure = new Square();
$figure->setHeight(4);
$figure->setWidth(5);

function calcArea(Rectangle $object){
	return $object->getHeight() * $object->getWidth();
}

var_dump(calcArea($figure));