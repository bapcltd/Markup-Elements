<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
 * @psalm-type ELEMENT = 'output'
 *
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 * @template T2 as list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'output', ATTRIBUTES, T2>
 */
class Output extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'output';
	}

	/**
	 * @param ATTRIBUTES $attributes
	 *
	 * @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:T2}
	 */
	public function FromAttributes(array $attributes) : array
	{
		/**
		 * @var T2
		 */
		$content = [];

		/** @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:T2} */
		return (new static())->FromAttributesAndContent($attributes, $content);
	}
}
