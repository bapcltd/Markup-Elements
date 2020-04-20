<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @psalm-type T1 = array<string, scalar|list<scalar>>
 *
 * @template-extends AbstractRequiresTableRows<'tbody', T1>
 */
class TableBody extends AbstractRequiresTableRows
{
	public function ElementName() : string
	{
		return 'tbody';
	}
}
