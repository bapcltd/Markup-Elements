<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template ELEMENT as string
* @template ELEMENT_INNER as string
* @template ATTRIBUTES as array<string, scalar|list<scalar>>
* @template CONTENT as list<list<scalar| array{!element:string, !attributes?:array<string, scalar|list<scalar>>, !content?:list<scalar|array{!element:string}>}>>
*
* @template-extends AbstractElementWithInnerElement<ELEMENT, ELEMENT_INNER>
*/
abstract class AbstractElementFromAttributesAndContentCollection extends AbstractElementWithInnerElement
{
	/**
	* @param ATTRIBUTES $attributes
	* @param CONTENT $content
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content: list<array{!element:ELEMENT_INNER, !content:list<scalar|array{!element:string}>}>}
	*/
	public function FromAttributesAndContentCollection(
		array $attributes,
		array $content
	) : array {
		/**
		* @var list<array{!element:ELEMENT_INNER, !content:list<scalar|array{!element:string}>}>
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
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content: list<array{!element:ELEMENT_INNER, !content:list<scalar|array{!element:string}>}>}
		*/
		$out = [
			'!element' => (new static())->ElementName(),
			'!attributes' => $attributes,
			'!content' => $content,
		];

		return $out;
	}
}
