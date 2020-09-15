<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Button;

/**
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 * @template CONTENT as list<scalar|array{!element:string}>
 * @template-extends AbstractTypedButton<'button', ATTRIBUTES, CONTENT>
 */
class Button extends AbstractTypedButton
{
	public function ButtonType() : string
	{
		return 'button';
	}
}
