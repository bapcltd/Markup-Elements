<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 * @template CONTENT as list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'div', ATTRIBUTES, CONTENT>
 */
class Div extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'div';
	}
}
