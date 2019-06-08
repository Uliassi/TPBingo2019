<?php

namespace Bingo;

/**
 * Este es un Carton de generado con
 * https://github.com/vicmagv/bingo-card-generator/blob/master/generar_carton.js
 */
class CartonJs implements CartonInterface {

  protected $numeros_carton = [];

  public function __construct() {
    $this->numeros_carton = [
      [4,0,24,31,40,32,0,0,80],
      [0,13,0,39,48,0,66,72,0],
      [1,0,27,0,0,50,0,73,86],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function filas() {
    return [
      [4,0,24,31,40,32,0,0,80],
      [0,13,0,39,48,0,66,72,0],
      [1,0,27,0,0,50,0,73,86],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function columnas() {
	  $coltot = [];
	  $index = 0;
	  foreach( $this->numeros_carton as $col ){
		  $coltot = $coltot + [$this->numeros_carton[0][$index],$this->numeros_carton[1][$index] , $this->numeros_carton[2][$index] ]
		  $index++;
	  }
	  
    return $coltot;
  }

  /**
   * {@inheritdoc}
   */
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

  /**
   * {@inheritdoc}
   */
  public function tieneNumero(int $numero) {
    return in_array($numero, $this->numeros_carton);
  }

}
