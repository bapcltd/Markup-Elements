<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template T1 as array<string, scalar|array<int, scalar>>
* @template T2 as array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'button', T1, T2>
*/
class Button extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'button';
	}
}
