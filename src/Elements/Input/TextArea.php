<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use BAPC\Html\Elements\AbstractElementFromAttributes;

/**
* @psalm-type CONTENT = array<int, scalar>
*
* @template-extends AbstractElementFromAttributes<'textarea', array<string, scalar|array<int, scalar>>, CONTENT>
*/
class TextArea extends AbstractElementFromAttributes
{
	/**
	* @return array{
		!element:'textarea',
		!attributes:array<string, scalar|array<int, scalar>>,
		!content:CONTENT
	}
	*/
	public static function FromAttributes(
		array $attributes
	) : array {
		/**
		* @var array<int, scalar>
		*/
		$value = (array) ($attributes['value'] ?? '');

		if (array_key_exists('value', $attributes)) {
			unset($attributes['value']);
		}

		/**
		* @var array{
			!element:'textarea',
			!attributes:array<string, scalar|array<int, scalar>>,
			!content:array<int, scalar>
		}
		*/
		return [
			'!element' => static::ElementName(),
			'!attributes' => $attributes,
			'!content' => $value,
		];
	}

	public static function ElementName() : string
	{
		return 'textarea';
	}
}
