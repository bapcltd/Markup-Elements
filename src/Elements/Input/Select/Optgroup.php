<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input\Select;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
 * @template T1 as array{label:string}
 * @template T2 as list<scalar|array{!element:'option', !attributes:array{value:string}|array<string, scalar|list<scalar>>, !content:list<scalar|array{!element:string}>}>
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
