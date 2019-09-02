<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type T1 = array<string, string|array<int, scalar>>
* @psalm-type T2 = array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'address', T1, T2>
*/
class Address extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'address';
	}
}
