<?php

namespace Bingo;

class Carton {
			protected $carton = [];

		  public function __construct(array $p_carton) {
				$this->carton = $p_carton;
		  }

		  public function filas() {
				return $this->numeros_carton;
		  }


		  public function columnas() {
			   $coltot = [];
				  $index = 0;
				  foreach( $this->numeros_carton[$index] as $fila ){
						$coltot[] = [$this->numeros_carton[0][$index],$this->numeros_carton[1][$index] , $this->numeros_carton[2][$index] ];
					  $index++;
				  }
				  
				return $coltot;
		  }



		public function tieneNumero(int $numero) {
				return	in_array($numero, $this->numerosDelCarton());
		  }

}
