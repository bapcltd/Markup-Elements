<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @psalm-type T1 = array<string, scalar|list<scalar>>
 *
 * @template-extends AbstractRequiresTableRows<'tfoot', T1>
 */
class TableFooter extends AbstractRequiresTableRows
{
	public function ElementName() : string
	{
		return 'tfoot';
	}
}
