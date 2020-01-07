<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
* @template ELEMENT as 'output'|'output'
* @template ATTRIBUTES as array<string, scalar|list<scalar>>
* @psalm-type T2 = list<scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<ELEMENT, ATTRIBUTES, T2>
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
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:array<empty, empty>}
	*/
	public function FromAttributes(array $attributes) : array
	{
		/**
		* @var list<scalar>
		*/
		$content = [];

		/**
		* @var array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:array<empty, empty>}
		*/
		return (new static())->FromAttributesAndContent($attributes, $content);
	}
}
