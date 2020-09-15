<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template ELEMENT as 'ol'|'ul'
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 * @template CONTENT as list<list<scalar|array{!element:string}>>
 *
 * @template-extends AbstractElementFromAttributesAndContentCollection<ELEMENT, 'li', ATTRIBUTES, CONTENT>
 */
abstract class AbstractList extends AbstractElementFromAttributesAndContentCollection
{
	protected function ElementNameInner() : string
	{
		return 'li';
	}
}
