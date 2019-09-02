<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template T1 as string
*
* @template-extends AbstractElementFromAttributes<'link', array<string, scalar|array<int, scalar>>, array<empty, empty>>
*/
class Link extends AbstractElementFromAttributes
{
	public static function ElementName() : string
	{
		return 'link';
	}
}
