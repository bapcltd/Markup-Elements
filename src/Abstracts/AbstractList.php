<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template T1 as 'ol'|'ul'
* @template T2 as array<string, scalar|array<int, scalar>>
* @template T3 as array<int, array<int, scalar|array{!element:string}>>
*
* @template-extends AbstractElementFromAttributesAndContentCollection<T1, 'li', T2, T3>
*/
abstract class AbstractList extends AbstractElementFromAttributesAndContentCollection
{
	protected static function ElementNameInner() : string
	{
		return 'li';
	}
}
