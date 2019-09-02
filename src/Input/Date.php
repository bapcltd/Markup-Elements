<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use DateTimeInterface;

/**
* @template-extends AbstractInput<'date'>
*/
class Date extends AbstractInput
{
	public static function AbstractInputType() : string
	{
		return 'date';
	}

	public static function FromAttributes(
		array $attributes = []
	) : array {
		if (isset($attributes['value']) && $attributes['value'] instanceof DateTimeInterface) {
			$attributes['value'] = $attributes['value']->format('Y-m-d');
		}

		/**
		* @var array{value?:string, type:'date'}
		*/
		$attributes = $attributes;

		return parent::FromAttributes($attributes);
	}
}
