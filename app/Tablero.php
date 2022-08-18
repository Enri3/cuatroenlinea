<?php
namespace App;

use App\Piece;

interface interfaseTablero{

    public function ponerFicha(int $col, array $colorFicha) //pone una ficha en el tablero.
    public function iniciarTablero() //inicializa el tablero y las dimenciones en 0.
}

class Tablero implements interfaseTablero{

    protected int $dim_x;
    protected int $dim_y;

    protected array $tablero;
}

public function __construct(int $dim_x = 7, int $dim_y = 6){

    if(dim_x < 4 and dim_y < 4){
        throw new Exception('Las dimensiones deben tener al menos 4 de ancho y largo para poder jugar.');
    }

    $this->dim_x = $dim_x
    $this->dim_y = $dim_y
}

public function ponerFicha(int $col, array $colorFicha){

    if($col < 0 || $col > $this->dim_x){
        throw new Exception('No se pueden poner fichas por fuera del tablero.');
    }

    if(strlen($this->tablero[$col]) >= $this->dim_y){
        throw new Exception('Esta columna se encuentra llena.');
    }

    if($colorFicha != 'rojo' && $colorFicha != 'azul'){
        throw new Exception('Solo se aceptan fichas rojas y azules.');
    }

    $this->tablero[$col]->append($colorFicha);
}

public function iniciarTablero(){

    for ($i=0; $i <= $this->dim_x; $i++){
        for ($h=0; $h < $this->dim_y; $h++){
            $this->tablero[dim_x][dim_y] = '';
        }
    }    

    $this->dim_x = 0;
    $this->dim_y = 0;
}
?>