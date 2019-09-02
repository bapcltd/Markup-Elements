<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
* @psalm-type T1 = array<string, scalar|array<int, scalar>>
* @psalm-type T2 = array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'output', T1, T2>
*/
class Output extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'output';
	}

	/**
	* @param T1 $attributes
	*
	* @return array{!element:'output', !attributes:T1, !content:array<empty, empty>}
	*/
	public static function FromAttributes(array $attributes) : array
	{
		return static::FromAttributesAndContent($attributes, []);
	}
}
