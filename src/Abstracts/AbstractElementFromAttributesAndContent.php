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
* @template-implements ElementInterface\FromAttributes\AndContent<ELEMENT, ATTRIBUTES, CONTENT>
* @template-implements ElementInterface\FromContent<ELEMENT, ATTRIBUTES, CONTENT>
*/
abstract class AbstractElementFromAttributesAndContent extends AbstractElement implements
	ElementInterface\FromAttributes\AndContent,
	ElementInterface\FromContent
{
	/**
	* @param ATTRIBUTES $attributes
	* @param CONTENT $content
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
	*/
	public static function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
		*/
		$out = [
			'!element' => static::ElementName(),
			'!attributes' => $attributes,
			'!content' => $content,
		];

		return $out;
	}

	/**
	* @param ATTRIBUTES $attributes
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
	*/
	public static function FromAttributes(array $attributes) : array
	{
		/**
		* @var array<int, scalar>
		*/
		$content = [];

		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
		*/
		return static::FromAttributesAndContent($attributes, $content);
	}

	/**
	* @param CONTENT $content
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
	*/
	public static function FromContent(array $content) : array
	{
		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
		*/
		return static::FromAttributesAndContent([], $content);
	}
}
