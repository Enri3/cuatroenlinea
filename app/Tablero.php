<?php
namespace App;

use App\Piece;

interface interfaseTablero{

    public function ponerFicha(int $col, array $colorFicha); //pone una ficha en el tablero.
    public function iniciarTablero(); //inicializa el tablero y las dimenciones en 0.
    public function sacarFicha(int $col, int $fil); //saca la ficha especificada.
    public function retroMov(); //vuelve al tablero al estado de la jugada anterior.
    public function acomodarTablero(int $col); //acomoda las fichas flotantes de la columna en caso de que haya.
    public function ultimaFicha(int $col); //devuelve la última ficha de la columna.
}

class Tablero implements interfaseTablero{

    protected int $dim_x;
    protected int $dim_y;

    protected array $tablero;

    protected array $movimientos;
}

public function __construct(int $dim_x = 7, int $dim_y = 6){

    if(dim_x < 4 and dim_y < 4){
        throw new Exception('Las dimensiones deben tener al menos 4 de ancho y largo para poder jugar.');
    }

    $this->dim_x = $dim_x;
    $this->dim_y = $dim_y;

    $this->iniciarTablero();
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

    $this->tablero[$col][$this->ultimaFicha($col)] = $colorFicha;

    $this->movimientos->append($col)
}

public function iniciarTablero(){

    for($i=0; $i <= $this->dim_x - 1; $i++){
        for($h=0; $h < $this->dim_y - 1; $h++){
            $this->tablero[dim_x][dim_y] = '';
        }
    }

    $this->dim_x = 0;
    $this->dim_y = 0;
}

public function sacarFicha(int $col, int $fil){

    if($col < 0 || $fil < 0 || $col > $this->dim_x || $fil > $this->dim_y){
        throw new Exception('Estas intentando sacar una ficha de fuera del tablero.');
    }

    if($this->tablero[$col][$fil] != 'rojo' && $this->tablero[$col][$fil] != 'azul'){
        throw new Exception('La ficha que intentas quitar no existe.');
    }

    $this->tablero[$col][$fil] = '';

    $this->acomodarTablero(int $col);
}

public function retroMov(){

    $this->tablero[end($this->movimientos)][$this->ultimaFicha(end($this->movimientos))] = '';

    array_pop($this->movimientos);
}

public function acomodarTablero(){

    for($i=0; $i < $this->dim_x - 1 && $bandera == 0; $i++){
        for($h=$this->dim_y - 1; $h > 0 && $bandera == 0; $h--){
            if($this->tablero[$i][$h] == 'rojo' || $this->tablero[$i][$h] == 'azul'){
                if($this->tablero[$i][$h-1] == 'rojo' || $this->tablero[$i][$h-1] == 'azul'){
                    $bandera = 1;
                }else{
                    $ultfi = $this->ultimaFicha($i);
                    if($ultfi){
                        $color = $this->tablero[$i][$h];
                        $this->tablero[$i][$ultfi+1] = $color;
                        $this->tablero[$i][$h] = '';
                    }
                }
            }
        }
    }
}

public function ultimaFicha(int $col){

    for($i=0; $i < $this->dim_y - 1; $i++){
        if($this->tablero[$col][$i] == 'rojo' || $this->tablero[$col][$i] == 'azul'){
            if($this->tablero[$col][$i+1] != 'rojo' && $this->tablero[$col][$i] != 'azul'){
                return $i;
            }
        }
    }
    return 0;
}
?>