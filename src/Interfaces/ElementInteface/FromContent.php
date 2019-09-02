<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\ElementInterface;

use BAPC\Html\Elements\ElementInterface as Base;

/**
* @template ELEMENT as string
* @template ATTRIBUTES as array<string, scalar|array<int, scalar>>
* @template CONTENT as array<int, scalar|array{!element:string}>
*
* @template-extends Base<ELEMENT>
*/
interface FromContent extends Base
{
	/**
	* @param CONTENT $content
	*
	* @return array{!element:ELEMENT, !attributes:ATTRIBUTES, !content:CONTENT}
	*/
	public static function FromContent(
		array $content
	) : array;
}