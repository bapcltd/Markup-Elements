<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @psalm-type T1 = array<string, string|list<scalar>>
 * @psalm-type T2 = list<scalar|array{!element:string}>
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
