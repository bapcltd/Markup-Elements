<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use DateTimeInterface;

/**
* @template-extends AbstractInput<'time'>
*/
class Time extends AbstractInput
{
	public static function AbstractInputType() : string
	{
		return 'time';
	}

	public static function FromAttributes(
		array $attributes = []
	) : array {
		if (isset($attributes['value']) && $attributes['value'] instanceof DateTimeInterface) {
			$attributes['value'] = $attributes['value']->format('H:i:s');
		}

		return parent::FromAttributes($attributes);
	}
}
