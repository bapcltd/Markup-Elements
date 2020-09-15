<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 *
 * @template-extends AbstractRequiresTableRows<'tfoot', ATTRIBUTES>
 */
class TableFooter extends AbstractRequiresTableRows
{
	public function ElementName() : string
	{
		return 'tfoot';
	}
}
