<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type T1 = array<string, scalar|array<int, scalar>>
* @psalm-type T2 = array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'th', T1, T2>
*/
class TableCellHeading extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'th';
	}
}
