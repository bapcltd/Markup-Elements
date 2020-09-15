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
 * @template-extends AbstractElementFromAttributesAndContent<'button', ATTRIBUTES, CONTENT>
 */
class Button extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'button';
	}
}
