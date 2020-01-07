<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type T1 = array<string, scalar|list<scalar>>
* @psalm-type T2 = list<scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'header', T1, T2>
*/
class Header extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'header';
	}
}
