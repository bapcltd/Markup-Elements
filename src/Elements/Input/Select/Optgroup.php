<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input\Select;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
 * @psalm-type T1 = array<string, scalar|list<scalar>>
 * @psalm-type T2 = list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'optgroup', T1, T2>
 */
class Optgroup extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'optgroup';
	}
}
