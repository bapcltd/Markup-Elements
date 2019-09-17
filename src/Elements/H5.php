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
* @template-extends AbstractElementFromAttributesAndContent<'h5', T1, T2>
*/
class H5 extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'h5';
	}
}
