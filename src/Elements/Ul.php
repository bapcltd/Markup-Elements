<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template T1 as array<string, scalar|list<scalar>>
 * @template T2 as list<list<scalar|array{!element:string}>>
 *
 * @template-extends AbstractList<'ul', T1, T2>
 */
class Ul extends AbstractList
{
	public function ElementName() : string
	{
		return 'ul';
	}
}
