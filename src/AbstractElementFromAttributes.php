<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template ELEMENT as string
* @template ATTRIBUTES as array<string, scalar|array<int, scalar>>
*
* @template-extends AbstractElement<ELEMENT>
*/
abstract class AbstractElementFromAttributes extends AbstractElement
{
	/**
	* @param ATTRIBUTES $attributes
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:array<empty, empty>}
	*/
	public static function FromAttributes(
		array $attributes = []
	) : array {
		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:array<empty, empty>}
		*/
		$out = [
			'!element' => static::ElementName(),
			'!attributes' => $attributes,
			'!content' => [],
		];

		return $out;
	}
}
