<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {

  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   * @dataProvider cartones 
   */

  public function testUnoANoventa(CartonInterface $carton) {
	//$carton = new CartonEjemplo;
	$bien = true;
	foreach ($carton->numerosDelCarton() as $num){
		if($num >=1 && $num <= 90){
		
		}else{
			$bien = false;
		}
	}
	
    $this->assertTrue($bien);
  }

  /**
   * Verifica que cada fila de un carton tenga exactamente 5 celdas ocupadas.
   * @dataProvider cartones 
   */


  public function testCincoNumerosPorFila(CartonInterface $carton) {
	//$carton = new CartonEjemplo;
	$flag = true;
	foreach( $carton->filas() as $fila ){
		$cont = 0;
		foreach( $fila as $num ){
			if($num != 0){
				$cont++;
			}
		}
		if($cont!=5){
			$flag = false;		
		}		

	}


    $this->assertTrue($flag);
  }

  /**
   * Verifica que para cada columna, haya al menos una celda ocupada.
   * @dataProvider cartones 
   */
  public function testColumnaNoVacia(CartonInterface $carton) {
	//$carton = new CartonEjemplo;
	$flag = false;
	foreach($carton->columnas() as $col ){
		foreach($col as $num){
				if($num != 0){
					$flag = true;
				}
		}	
	}
    $this->assertTrue($flag);
  }

  /**
   * Verifica que no haya columnas de un carton con tres celdas ocupadas.
   * @dataProvider cartones 
   */
  public function testColumnaCompleta(CartonInterface $carton) {
	//$carton = new CartonEjemplo;
	$flag = true;	
	foreach( $carton->columnas() as $col ){	
		$cant = 0;	
		foreach( $col as $num ){
			if($num != 0){
			$cant++;			
			}
		}
		if($cant == 3){
		$flag = false;
		}
	}
    $this->assertTrue($flag);
  }

  /**
   * Verifica que solo hay exactamente tres columnas que tienen solo una celda
   * ocupada.
   * @dataProvider cartones 
   */
  public function testTresCeldasIndividuales(CartonInterface $carton) {
	//$carton = new CartonEjemplo;
	$cantcolunacelda = 0;	
	$flag = false;
	foreach($carton->columnas() as $col){
		$cant = 0;
		foreach($col as $num){
			if($num != 0){
				$cant++;		
			}
		}
		if($cant == 1){	
			$cantcolunacelda++;		
		}
	}
	if($cantcolunacelda == 3){
			$flag = true;
	}
    $this->assertTrue($flag);
  }

  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   * @dataProvider cartones 
   */
  public function testNumerosIncrementales(CartonInterface $carton) {
	$flag = true;
	$iter = 0;
	$maxant = 0 ;
	$minact = 0 ;
	foreach($carton->columnas() as $col){
		$iter++;
		
		if($iter>1){
			
			$minact= min(array_filter($col));
			if( $maxant > $minact ){
				$flag = false;						
			}
			$maxant = max(array_filter($col));			

		}else{
		$maxant = max(array_filter($col));
		}
	}
	
    $this->assertTrue($flag);
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   * @dataProvider cartones    
   */
 
  public function testFilasConVaciosUniformes(CartonInterface $carton) {
   //$carton = new CartonEjemplo;
   $flag = true;

	foreach($carton->filas() as $fila){
		$antcero = false;
		foreach($fila as $num){
			if($num == 0 && $antcero == true){
				$flag = false;			
			}
			if($num == 0){
				$antcero = true;			
			}else{
				$antcero = false;			
			}
		}
	}
	
    $this->assertTrue($flag);
  }

 public function cartones(){ 
	return array(
      new CartonEjemplo,
	  new CartonJs
    );
}

}
