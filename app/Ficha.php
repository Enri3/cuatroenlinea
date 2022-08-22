<?php
namespace App;

class Ficha{

	public $color;

	public function __construct($color){
		$this->color = $color;
	}

	public function mostrarColor(){
		return $this->color;
	}
}
?>