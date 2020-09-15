<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template T1 as array<string, scalar|list<scalar>>
 * @template T2 as list<array{!element:'td'|'th', !content:list<scalar|array{!element:string}>}>
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
