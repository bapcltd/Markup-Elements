<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
 * @template T1 as array{type:'submit'}
 * @template T2 as list<scalar|array{!element:string}>
 *
 * @template-extends AbstractElementFromAttributesAndContent<'button', T1, T2>
 */
class SubmitButton extends AbstractElementFromAttributesAndContent
{
	/**
	 * @return array{!element:'button', !attributes:array{type:'submit'}, !content:T2}
	 */
	public function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		$attributes['type'] = 'submit';

		/**
		 * @var T1
		 */
		$attributes = $attributes;

		/**
		 * @var array{!element:'button', !attributes:array{type:'submit'}, !content:T2}
		 */
		$out = parent::FromAttributesAndContent($attributes, $content);

		return $out;
	}

	public function ElementName() : string
	{
		return 'button';
	}
}
