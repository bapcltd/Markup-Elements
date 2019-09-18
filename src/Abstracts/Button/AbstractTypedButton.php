<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Button;

use BAPC\Html\Elements\Button as Base;

/**
* @template T1 as string
*
* @psalm-type ATTRIBUTES = array<string, scalar|array<int, scalar>>
* @psalm-type CONTENT = array<int, scalar|array{!element:string}>
*
* @template-extends Base<ATTRIBUTES, CONTENT>
*/
abstract class AbstractTypedButton extends Base
{
	/**
	* @param ATTRIBUTES $attributes
	* @param CONTENT $content
	*
	* @return array{!element:'button', !attributes:ATTRIBUTES, !content:CONTENT}
	*/
	public static function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		$attributes['type'] = static::ButtonType();

		return parent::FromAttributesAndContent($attributes, $content);
	}

	/**
	* @return T1
	*/
	abstract public static function ButtonType() : string;
}
