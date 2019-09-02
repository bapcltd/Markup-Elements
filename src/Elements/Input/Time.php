<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use DateTimeInterface;

/**
* @template T1 as 'time'|'time'
*
* @template-extends AbstractInput<T1>
*/
class Time extends AbstractInput
{
	public static function AbstractInputType() : string
	{
		return 'time';
	}

	/**
	* @param array{value?:scalar|array<int, scalar>|DateTimeInterface} $attributes
	*
	* @return array{!element:'input', !attributes:array{type:T1, value?:scalar|array<int, scalar>}, !content:array<empty, empty>}
	*/
	public static function FromAttributes(
		array $attributes
	) : array {
		if (isset($attributes['value']) && $attributes['value'] instanceof DateTimeInterface) {
			$attributes['value'] = $attributes['value']->format('H:i:s');
		}

		/**
		* @var array{value?:scalar|array<int, scalar>}
		*/
		$attributes = $attributes;

		/**
		* @var array{!element:'input', !attributes:array{type:T1, value?:scalar|array<int, scalar>}, !content:array<empty, empty>}
		*/
		return parent::FromAttributes($attributes);
	}
}
