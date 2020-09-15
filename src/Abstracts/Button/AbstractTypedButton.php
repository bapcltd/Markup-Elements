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
 * @template ATTRIBUTES as array<string, scalar|list<scalar>>
 * @template CONTENT as list<scalar|array{!element:string}>
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
	public function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		$attributes['type'] = static::ButtonType();

		return parent::FromAttributesAndContent($attributes, $content);
	}

	/**
	 * @return T1
	 */
	abstract public function ButtonType() : string;
}
