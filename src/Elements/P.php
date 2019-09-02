<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type ATTRIBUTES = array<string, scalar|array<int, scalar>>
* @psalm-type CONTENT = array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'p', ATTRIBUTES, CONTENT>
*/
class P extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'p';
	}
}
