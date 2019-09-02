<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template ELEMENT as string
* @template ATTRIBUTES as array<string, scalar|array<int, scalar>>
* @template CONTENT as array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElement<ELEMENT>
*
* @template-implements ElementInterface\FromAttributes<ELEMENT, ATTRIBUTES, CONTENT>
*/
abstract class AbstractElementFromAttributes extends AbstractElement implements ElementInterface\FromAttributes
{
	/**
	* @param ATTRIBUTES $attributes
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
	*/
	public static function FromAttributes(
		array $attributes
	) : array {
		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
		*/
		$out = [
			'!element' => static::ElementName(),
			'!attributes' => $attributes,
			'!content' => [],
		];

		return $out;
	}
}
