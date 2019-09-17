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
* @template-extends AbstractElementFromAttributesAndContent<'script', ATTRIBUTES, CONTENT>
*/
class Script extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'script';
	}
}
