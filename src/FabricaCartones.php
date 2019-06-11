<?php

namespace Bingo;

class FabricaCartones {

  public function generarCarton() {
    // Algo de pseudo-código para ayudar con la evaluacion.
	
	$carton = new Carton( $this->intentoCarton() );
	    while ($this->cartonEsValido($carton) == false) {
	    	$carton = new Carton( $this->intentoCarton() ); 
	    }
	return $carton;
  }

  protected function cartonEsValido(CartonInterface $carton) {
    if ($this->validarUnoANoventa($carton) &&
      $this->validarCincoNumerosPorFila($carton) &&
      $this->validarColumnaNoVacia($carton) &&
      $this->validarColumnaCompleta($carton) &&
      $this->validarTresCeldasIndividuales($carton) &&
      $this->validarNumerosIncrementales($carton) &&
      $this->validarFilasConVaciosUniformes($carton)
    ) {
      return TRUE;
    }
 
    return FALSE;
  }

  public function validarUnoANoventa(CartonInterface $carton) {
	$bien = true;
	foreach ($carton->numerosDelCarton() as $num){
		if($num >=1 && $num <= 90){
		
		}else{
			$bien = false;
		}
	}
	if(!$bien){
		 echo "1\n";	
	}
	return $bien;
  }

  protected function validarCincoNumerosPorFila(CartonInterface $carton) { /// NO ANDA ESTOOOOO
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
	if(!$flag){
		 echo "2\n";	
	}
	return $flag;
  }

  protected function validarColumnaNoVacia(CartonInterface $carton) {
	$flag = true;
	foreach($carton->columnas() as $col ){
		$alguno = false;
		foreach($col as $num){
			if($num != 0){
				$alguno = true;
			}
		}
		if(alguno == false){
			$flag = false;
		}	
	}
	if(!$flag){
		 echo "3\n";	
	}
	return $flag;
  }

  protected function validarColumnaCompleta(CartonInterface $carton) {
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
	if(!$flag){
		 echo "4\n";	
	}
	return $flag;
  }

  protected function validarTresCeldasIndividuales(CartonInterface $carton) {
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
	if(!$flag){
		 echo "5\n";	
	}
	return $flag;
  }

  protected function validarNumerosIncrementales(CartonInterface $carton) {
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
	if(!$flag){
		 echo "6\n";	
	}
	return $flag;
  }

  protected function validarFilasConVaciosUniformes(CartonInterface $carton) {
	$flag = true;

	foreach($carton->filas() as $fila){
		$suma = 0;
		foreach($fila as $num){
			if($num == 0){
				$suma++;			
			}else{
				$suma = 0;			
			}
			
			if($suma == 3){
				$flag = false;			
			}
			
		}
	}
	if(!$flag){
		 echo "7\n";	
	}
	return $flag;
  }


  public function intentoCarton() {
    $contador = 0;

    $carton = [
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0]
    ];
    $numerosCarton = 0;

    while ($numerosCarton < 15) {
      $contador++;
      if ($contador == 50) {
        return $this->intentoCarton();
      }
      $numero = rand (1, 90);

      $columna = floor ($numero / 10);
      if ($columna == 9) { $columna = 8;}
      $huecos = 0;
      for ($i = 0; $i<3; $i++) {
        if ($carton[$columna][$i] == 0) {
          $huecos++;
        }
        if ($carton[$columna][$i] == $numero) {
          $huecos = 0;
          break;
        }
      }
      if ($huecos < 2) {
        continue;
      }

      $fila = 0;
      for ($j=0; $j<3; $j++) {
        $huecos = 0;
        for ($i = 0; $i<9; $i++) {
          if ($carton[$i][$fila] == 0) { $huecos++; }
        }

        if ($huecos < 5 || $carton[$columna][$fila] != 0) {
          $fila++;
        } else{
          break;
        }
      }
      if ($fila == 3) {
        continue;
      }

      $carton[$columna][$fila] = $numero;
      $numerosCarton++;
      $contador = 0;
    }

    for ( $x = 0; $x < 9; $x++) {
      $huecos = 0;
      for ($y =0; $y < 3; $y ++) {
        if ($carton[$x][$y] == 0) { $huecos++;}
      }
      if ($huecos == 3) {
        return $this->intentoCarton();
      }
    }
	
    return $carton;
  }


}
