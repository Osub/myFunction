<?php
/**
 * Private method to convert an array into an object
 *
 * @since v1.0.0
 */
if(!function_exists('arrayToObject')){
	function arrayToObject($array) {
		if(!is_array($array)) {
			return $array;
		}

		$object = new stdClass();
		if (is_array($array) && count($array) > 0) {
			foreach ($array as $name=>$value) {
				$name = strtolower(trim($name));
				if (!empty($name)) {
					$object->$name = $value;
				}
			}
			return $object;
		}
		else {
			return FALSE;
		}
	}
}
	