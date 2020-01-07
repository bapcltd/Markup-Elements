<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\ElementInterface\FromAttributes;

use BAPC\Html\Elements\ElementInterface\FromAttributes as Base;

/**
* @template ELEMENT as string
* @template ATTRIBUTES as array<string, scalar|list<scalar>>
* @template CONTENT as list<scalar|array{!element:string}>
*
* @template-extends Base<ELEMENT, ATTRIBUTES, CONTENT>
*/
interface AndContent extends Base
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
	) : array;
}
