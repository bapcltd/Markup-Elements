<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input\Select;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
* @psalm-type T1 = array<string, scalar|array<int, scalar>>
* @psalm-type T2 = array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'option', T1, T2>
*/
class Option extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'option';
	}
}
