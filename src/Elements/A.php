<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @psalm-type T1 = array{href:string}
 * @psalm-type T2 = list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'a', T1, T2>
 */
class A extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'a';
	}

	/**
	 * @param T1 $attributes
	 * @param T2 $content
	 *
	 * @return array{!element:'a', !attributes:T1, !content:T2}
	 */
	public function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		return parent::FromAttributesAndContent($attributes, $content);
	}
}
