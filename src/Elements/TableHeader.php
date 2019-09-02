<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type T1 = array<string, scalar|array<int, scalar>>
*
* @template-extends AbstractRequiresTableRows<'thead', T1>
*/
class TableHeader extends AbstractRequiresTableRows
{
	public static function ElementName() : string
	{
		return 'thead';
	}
}
