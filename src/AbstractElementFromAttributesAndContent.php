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
*/
abstract class AbstractElementFromAttributesAndContent extends AbstractElement
{
	/**
	* @param ATTRIBUTES|array<empty, empty> $attributes
	* @param CONTENT $content
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES|array<empty, empty>, !content:CONTENT}
	*/
	public static function FromAttributesAndContent(
		array $attributes = [],
		array $content = []
	) : array {
		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES|array<empty, empty>, !content:CONTENT}
		*/
		$out = [
			'!element' => static::ElementName(),
			'!attributes' => $attributes,
			'!content' => $content,
		];

		return $out;
	}
}
