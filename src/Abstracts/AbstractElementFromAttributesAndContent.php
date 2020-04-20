<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template ELEMENT as string
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 * @template CONTENT as list<scalar|array{!element:string}>
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
	public function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		/**
		 * @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
		 */
		$out = [
			'!element' => (new static())->ElementName(),
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
	public function FromAttributes(array $attributes) : array
	{
		/**
		 * @var list<scalar>
		 */
		$content = [];

		/**
		 * @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
		 */
		return (new static())->FromAttributesAndContent($attributes, $content);
	}

	/**
	 * @param CONTENT $content
	 *
	 * @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
	 */
	public function FromContent(array $content) : array
	{
		/**
		 * @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
		 */
		return (new static())->FromAttributesAndContent([], $content);
	}
}
