<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type T1 = array<string, scalar|array<int, scalar>>
* @psalm-type T2 = array<int, array{!element:'td'|'th', !content:array<int, scalar|array{!element:string}>}>
*
* @template-extends AbstractElementFromAttributesAndContent<'tr', T1, T2>
*/
class TableRow extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'tr';
	}
}
