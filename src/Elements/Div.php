<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template ATTRIBUTES as array<string, scalar|array<int, scalar>>
* @template CONTENT as array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'div', ATTRIBUTES, CONTENT>
*/
class Div extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'div';
	}
}
