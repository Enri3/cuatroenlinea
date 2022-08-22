<?php
namespace App;

use App\Ficha;

interface interfaseTablero{

    public function ponerFicha(int $col, Ficha $ficha); //pone una ficha en el tablero.
    public function iniciarTablero(); //inicializa el tablero y las dimenciones en 0.
    public function sacarFicha(int $col, int $fil); //saca la ficha especificada.
    public function retroMov(); //vuelve al tablero al estado de la jugada anterior.
    public function acomodarTablero(int $col, int $fil); //acomoda las fichas flotantes del tablero en caso de que haya.
    public function ultimaFicha(int $col); //devuelve la última ficha de la columna.
}

class Tablero implements interfaseTablero{

    protected int $dim_x;
    protected int $dim_y;

    public array $tablero;

    protected array $movimientos;

    public function __construct(int $dim_x = 7, int $dim_y = 6){

        if($dim_x < 4 && $dim_y < 4){
            throw new Exception('Las dimensiones deben tener al menos 4 de ancho y largo para poder jugar.');
        }

        $this->dim_x = $dim_x;
        $this->dim_y = $dim_y;
        
        $this->movimientos = [];
        
        $this->iniciarTablero();
    }

    public function ponerFicha(int $col, Ficha $ficha){

        if($col < 1 || $col > $this->dim_x){
            throw new \Exception('No se pueden poner fichas por fuera del tablero.');
        }

        if($ficha->color != 'rojo' && $ficha->color != 'azul'){
            throw new \Exception('Solo se aceptan fichas rojas y azules.');
        }
        
        if($this->tablero[$col - 1][$this->dim_y - 1] == 'rojo' || $this->tablero[$col][$this->dim_y - 1] == 'azul'){
            throw new \Exception('La columna esta llena, no se pueden ingresar más fichas.');
        }

        $this->tablero[$col - 1][$this->ultimaFicha($col) + 1] = $ficha->color;
        
        array_push($this->movimientos, $col);
    }

    public function iniciarTablero(){

        for($i=0; $i < $this->dim_x; $i++){
            for($h=0; $h < $this->dim_y; $h++){
                $this->tablero[$i][$h] = '';
            }
        }
    }

    public function sacarFicha(int $col, int $fil){

        if($col < 1 || $fil < 1 || $col > $this->dim_x || $fil > $this->dim_y){
            throw new \Exception('Estas intentando sacar una ficha de fuera del tablero.');
        }

        if($this->tablero[$col - 1][$fil - 1] != 'rojo' && $this->tablero[$col - 1][$fil - 1] != 'azul'){
            throw new \Exception('La ficha que intentas quitar no existe.');
        }

        $this->tablero[$col - 1][$fil - 1] = '';

        $this->acomodarTablero($col, $fil);
    }

    public function retroMov(){

        if($this->movimientos == []){
          throw new \Exception('Aún no se han realizado movimientos.');
        }
        
        $this->tablero[end($this->movimientos)][$this->ultimaFicha(end($this->movimientos))] = '';

        array_pop($this->movimientos);
    }

    public function acomodarTablero(int $col, int $fil){

        if($fil != $this->dim_y){
            if($this->tablero[$col - 1][$fil] == 'rojo' || $this->tablero[$col - 1][$fil] == 'azul'){
                $this->tablero[$col - 1][$fil - 1] = $this->tablero[$col - 1][$fil];
                $this->tablero[$col - 1][$fil] = '';
                $this->acomodarTablero($col, $fil + 1);
            }
        }
    }

    public function ultimaFicha(int $col){

        for($i=0; $i < $this->dim_y; $i++){
            if($this->tablero[$col - 1][0] == ''){
              return -1;
            }else{
                if($this->tablero[$col - 1][$i] == 'rojo' || $this->tablero[$col - 1][$i] == 'azul'){
                    if($i == $this->dim_y - 1){
                        return $i;
                      }else{
                        if($this->tablero[$col - 1][$i+1] == ''){
                          return $i;
                      }
                    }
                }
            }
        }
        return 0;
    }
}

$tablero1 = new Tablero(5,5);
$ficha1 = new Ficha('rojo');
$ficha2 = new Ficha('azul');
$tablero1->ponerFicha(3, $ficha1);
$tablero1->ponerFicha(3, $ficha2);
echo($tablero1->ultimaFicha(3));
echo($tablero1->tablero[3][2]);
?>