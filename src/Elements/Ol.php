<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @psalm-type T1 = array<string, scalar|list<scalar>>
 * @psalm-type T2 = list<list<scalar|array{!element:string}>>
 *
 * @template-extends AbstractList<'ol', T1, T2>
 */
class Ol extends AbstractList
{
	public function ElementName() : string
	{
		return 'ol';
	}
}
