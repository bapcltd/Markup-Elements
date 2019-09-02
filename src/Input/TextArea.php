<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

/**
* @psalm-type T = array{value?:scalar|array<int, scalar>}
*/
class TextArea
{
	/**
	* @param T $attributes
	*
	* @return array{!element:'textarea', !attributes:array<string, scalar|array<int, scalar>>, !content:array<int, scalar|array<int, scalar>>}
	*/
	public static function FromAttributes(
		array $attributes = []
	) : array {
		$value = (array) ($attributes['value'] ?? '');

		if (array_key_exists('value', $attributes)) {
			unset($attributes['value']);
		}

		/**
		* @var array{!element:'textarea', !attributes:array<string, scalar|array<int, scalar>>, !content:array<int, scalar|array<int, scalar>>}
		*/
		$out = [
			'!element' => 'textarea',
			'!attributes' => $attributes,
			'!content' => $value,
		];

		return $out;
	}
}
