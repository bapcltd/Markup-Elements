<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type T1 = array{for:string}
* @psalm-type T2 = array<int, scalar|array{!element:string}>
*
* @template-extends AbstractElementFromAttributesAndContent<'label', T1, T2>
*/
class Label extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'label';
	}

	/**
	* @param T1 $attributes
	* @param T2 $content
	*
	* @return array{!element:'label', !attributes:T1, !content:T2}
	*/
	public static function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		return parent::FromAttributesAndContent($attributes, $content);
	}
}
