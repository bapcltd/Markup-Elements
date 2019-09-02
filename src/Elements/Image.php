<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template T1 as string
*
* @template-extends AbstractElementFromAttributes<'img', array<string, scalar|array<int, scalar>>, array<empty, empty>>
*/
class Image extends AbstractElementFromAttributes
{
	public static function ElementName() : string
	{
		return 'img';
	}
}
