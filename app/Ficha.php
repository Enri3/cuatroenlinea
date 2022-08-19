<?php
namespace App;

class Ficha{

	public function __construct($color){
		$this->color = $color;
	}

	protected $color;

	public function mostrarColor(){
		return $this->color;
	}
}
?>