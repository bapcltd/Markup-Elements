<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type ATTRIBUTES = array<string, scalar|list<scalar>>
* @psalm-type CONTENT = list<scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'p', ATTRIBUTES, CONTENT>
*/
class P extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'p';
	}
}
