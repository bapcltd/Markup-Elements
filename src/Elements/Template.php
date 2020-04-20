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
 * @template-extends AbstractElementFromAttributesAndContent<'template', T1, T2>
 */
class Template extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'template';
	}
}
