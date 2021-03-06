<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template T1 as array<string, scalar|list<scalar>>
 * @template T2 as list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'fieldset', T1, T2>
 */
class Fieldset extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'fieldset';
	}
}
