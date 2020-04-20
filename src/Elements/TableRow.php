<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @psalm-type T1 = array<string, scalar|list<scalar>>
 * @psalm-type T2 = list<array{!element:'td'|'th', !content:list<scalar|array{!element:string}>}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'tr', T1, T2>
 */
class TableRow extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'tr';
	}
}
