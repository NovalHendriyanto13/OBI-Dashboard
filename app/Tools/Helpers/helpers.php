<?php

if (! function_exists('variable_get')) {
	function variable_get($k) {
		$variable = new \App\Tools\Variable;
		if ($variable->get($k) == '' ) 
			return null;

		return $variable::get($k);
	}
}