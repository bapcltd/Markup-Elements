<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input\Select;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
 * @template T1 as array{value:string}|array<string, scalar|list<scalar>>
 * @template T2 as list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'option', T1, T2>
 */
class Option extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'option';
	}
}
