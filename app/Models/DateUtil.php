<?php

namespace App\Models;

use Carbon\Carbon;

class DateUtil {

	public static function today($formato = 'd/m/Y') {
		return Carbon::today()->format($formato);
	}
	
	public static function dateToView($value) {
		if (strpos($value, '/') > 0) {
			return $value;
		}
		return ($value != null) ? date("d/m/Y", strtotime($value)) : null;
	}
	
	public static function dateToStorage($value) {
		if (strpos($value, '-') > 0) {
			return $value;
		}		
		return ($value != null) ? implode('-', array_reverse(explode('/', $value))) : null;
	}
	
	public static function addMonths($dt, $meses) {
		$padrao = (strpos($dt, '-') > 0) ? 'us' : 'br';
		$dt = self::dateToStorage($dt);
		$dt = Carbon::createFromFormat('Y-m-d', $dt)->addMonths($meses)->toDateString();
		return ($padrao == 'br') ? self::dateToView($dt) : $dt;
	}

}