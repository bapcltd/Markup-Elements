<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template ELEMENT as string
* @template ELEMENT_INNER as string
* @template ATTRIBUTES as array<string, scalar|array<int, scalar>>
* @template CONTENT as array<int, array<int, scalar| array{!element:string, !attributes?:array<string, scalar|array<int, scalar>>, !content?:array<int, scalar|array{!element:string}>}>>
*
* @template-extends AbstractElementWithInnerElement<ELEMENT, ELEMENT_INNER>
*/
abstract class AbstractElementFromAttributesAndContentCollection extends AbstractElementWithInnerElement
{
	/**
	* @param ATTRIBUTES $attributes
	* @param CONTENT $content
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content: array<int, array{!element:ELEMENT_INNER, !content:array<int, scalar|array{!element:string}>}>}
	*/
	public static function FromAttributesAndContentCollection(
		array $attributes,
		array $content
	) : array {
		/**
		* @var array<int, array{!element:ELEMENT_INNER, !content:array<int, scalar|array{!element:string}>}>
		*/
		$content = array_map(
			function (array $inner) : array {
				return [
					'!element' => static::ElementNameInner(),
					'!content' => $inner,
				];
			},
			$content
		);

		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content: array<int, array{!element:ELEMENT_INNER, !content:array<int, scalar|array{!element:string}>}>}
		*/
		$out = [
			'!element' => static::ElementName(),
			'!attributes' => $attributes,
			'!content' => $content,
		];

		return $out;
	}
}
