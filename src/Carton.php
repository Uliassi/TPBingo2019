<?php
namespace Bingo;
include('CartonInterface.php');
include('FabricaCartones.php'); 


class Carton implements CartonInterface {
	protected $numeros_carton = [];

  public function __construct( $p_carton) {
		$this->numeros_carton = $p_carton;
  }

  public function columnas() {
		return $this->numeros_carton;
  }


  public function filas() { // tuve que cambiarlo porque estan invertidas filas y columnas
	   $coltot = [];
		  $index = 0;
		  foreach( $this->numeros_carton[$index] as $fila ){
				$coltot[] = [$this->numeros_carton[0][$index],$this->numeros_carton[1][$index] , $this->numeros_carton[2][$index], $this->numeros_carton[3][$index], $this->numeros_carton[4][$index], $this->numeros_carton[5][$index], $this->numeros_carton[6][$index], $this->numeros_carton[7][$index], $this->numeros_carton[8][$index] ];
			  $index++;
		  }
		  
		return $coltot;
  }


  public function numerosDelCarton() {
    $numeros = [];
    foreach ($this->filas() as $fila) {
      foreach ($fila as $celda) {
        if ($celda != 0) {
          $numeros[] = $celda;
        }
      }
    }
    return $numeros;
  }

public function tieneNumero(int $numero) {
	return	in_array($numero, $this->numerosDelCarton() );
  }

}

