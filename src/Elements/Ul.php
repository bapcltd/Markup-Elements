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
* @template-extends AbstractList<'ul', T1, T2>
*/
class Ul extends AbstractList
{
	public function ElementName() : string
	{
		return 'ul';
	}
}
