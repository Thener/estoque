<?php

namespace App\Models;

use Carbon\Carbon;

class MoneyUtil {

	public static function moneyToView($valor) {
		
		if (!$valor) {
			return null;
		}		
		
		$pos = strpos($valor, ',');
		if ($pos > 0) {
			return $valor;
		}
				
		return number_format($valor, 2, ',', '.');
	}
	
	public static function moneyToStorage($valor) {
	
		if (!$valor) {
			return null;
		}
	
		$valor = self::moneyToView($valor);
	
		$pos = strpos($valor, ',');
		if ($pos == 0 || $pos === false) {
			return $valor;
		}
	
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
	
		return $valor;
	}

	/**
	 *
	 * Compara se um valor é menor, igual ou maior que outro de referência
	 * @param double $valor1: informar o valor que será comparado
	 * @param double $valor2: informar o valor de referência
	 */
	public static function moneyCompare($valor1, $valor2) {
	
		$valor1 = self::moneyToStorage($valor1);
		$valor2 = self::moneyToStorage($valor2);
	
		if ($valor1 < $valor2) {
			return -1;
		} else if ($valor1 > $valor2) {
			return 1;
		} else {
			return 0;
		}
	
	}	
	
	public static function moneySubtract($valor1, $valor2) {
	
		$valor1 = self::moneyToStorage($valor1);
		$valor2 = self::moneyToStorage($valor2);
	
		return $valor1 - $valor2;
	}

	public static function moneySum($valor1, $valor2) {
	
		$valor1 = self::moneyToStorage($valor1);
		$valor2 = self::moneyToStorage($valor2);
	
		return $valor1 + $valor2;
	}	

}