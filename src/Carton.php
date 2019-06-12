<?php
namespace Bingo;
include('CartonInterface.php');
include('FabricaCartones.php');
include('CartonEjemplo.php');  


class Carton implements CartonInterface {
	protected $numeros_carton = [];

  public function __construct(array $p_carton) {
		$this->numeros_carton = $this->darvuelta($p_carton);
  }

  public function filas() {
		return $this->numeros_carton;
  }

 public function darvuelta($arr){
		$rta = [];
	$indey = 0;
	foreach($arr as $col){
			$index = 0;
		foreach($col as $num){
			$rta[$index][$indey] =$num ;
			$index++;
		}	
	$indey++;
	}
	return $rta;
 }

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
//$carton = (new Carton( (new FabricaCartones)->intentoCarton() ) );
/*$index = 0;
foreach( ($carton->filas()[0]) as $fila ){
	echo ($carton->filas()[0][$index]) . " " . ($carton->filas()[1][$index]) . " " . ($carton->filas()[2][$index]) . "\n" ;
			  
		$index++;
	
}*/

//print_r( $carton->columnas());
//echo "askjdhakjsdas\n\n";
//print_r( (new CartonEjemplo)->columnas());

