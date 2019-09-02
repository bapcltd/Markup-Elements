<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use BAPC\Html\Elements\AbstractElementFromAttributes;

/**
* @template T1 as string
*
* @template-extends AbstractElementFromAttributes<'input', array{type:T1, value?:scalar|array<int, scalar>}, array<empty, empty>>
*/
abstract class AbstractInput extends AbstractElementFromAttributes
{
	/**
	* @param array{value?:scalar|array<int, scalar>} $attributes
	*
	* @return array{!element:'input', !attributes:array{type:T1, value?:scalar|array<int, scalar>}, !content:array<empty, empty>}
	*/
	public static function FromAttributes(
		array $attributes = []
	) : array {
		$attributes['type'] = static::AbstractInputType();

		/**
		* @var array{value?:scalar|array<int, scalar>, type:T1}
		*/
		$attributes = $attributes;

		return parent::FromAttributes($attributes);
	}

	public static function ElementName() : string
	{
		return 'input';
	}

	/**
	* @return T1
	*/
	abstract public static function AbstractInputType() : string;
}
