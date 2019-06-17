<?php

namespace Bingo;

/**
 * Este es un Carton de Ejemplo.
 */
class CartonEjemplo implements CartonInterface {

  protected $numeros_carton = [];

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->numeros_carton = [
      [0, 16, 0, 38, 47, 2, 67, 77, 0], /// cambiar esto de vuelta
      [9, 0, 28, 35, 0, 55, 0, 0, 84],
      [0, 12, 26, 0, 45, 0, 61, 0, 89],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function filas() {
    return $this->numeros_carton;
  }

  /**
   * {@inheritdoc}
   */
  public function columnas() {
  		$coltot = [];
		  $index = 0;
		  foreach( ($this->filas()[0]) as $fila ){
				$coltot[] = array( 	($this->filas()[0][$index]) , 
							($this->filas()[1][$index]) , 
							($this->filas()[2][$index]) );
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
    return in_array($numero, $this->numerosDelCarton());
  }

}
