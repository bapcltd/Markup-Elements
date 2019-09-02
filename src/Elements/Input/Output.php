<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
* @template ELEMENT as 'output'|'output'
* @template ATTRIBUTES as array<string, scalar|array<int, scalar>>
* @psalm-type T2 = array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<ELEMENT, ATTRIBUTES, T2>
*/
class Output extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'output';
	}

	/**
	* @param ATTRIBUTES $attributes
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:array<empty, empty>}
	*/
	public static function FromAttributes(array $attributes) : array
	{
		/**
		* @var array<int, scalar>
		*/
		$content = [];

		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:array<empty, empty>}
		*/
		return static::FromAttributesAndContent($attributes, $content);
	}
}
