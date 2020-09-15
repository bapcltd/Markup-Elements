<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 *
 * @template-extends AbstractRequiresTableRows<'tbody', ATTRIBUTES>
 */
class TableBody extends AbstractRequiresTableRows
{
	public function ElementName() : string
	{
		return 'tbody';
	}
}
