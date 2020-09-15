<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template T1 as array<string, scalar|list<scalar>>
 * @template T2 as list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'h5', T1, T2>
 */
class H5 extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'h5';
	}
}
