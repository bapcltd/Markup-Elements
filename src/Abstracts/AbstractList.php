<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @template T1 as 'ol'|'ul'
* @template T2 as array<string, scalar|list<scalar>>
* @template T3 as list<list<scalar|array{!element:string}>>
*
* @template-extends AbstractElementFromAttributesAndContentCollection<T1, 'li', T2, T3>
*/
abstract class AbstractList extends AbstractElementFromAttributesAndContentCollection
{
	protected function ElementNameInner() : string
	{
		return 'li';
	}
}
