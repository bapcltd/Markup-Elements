<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template T1 as array<string, string|list<scalar>>
 * @template T2 as list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'address', T1, T2>
 */
class Address extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'address';
	}
}
