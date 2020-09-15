<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use function array_map;
use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;
use function in_array;

/**
 * @template T as array{name:string, value?:list<string>}
 * @template CONTENTS_OPTION as array{!element:'option', !attributes:array{value:string}, !content:list<scalar|array{!element:string}>}
 * @template CONTENTS_OPTGROUP as array{!element:'optgroup', !attributes:array{label:string}, !content:scalar|list<array{!element:'option', !attributes:array{value:string}, !content:list<scalar|array{!element:string}>}>}
 *
 * @template-extends AbstractElementFromAttributesAndContent<'select', T, list<CONTENTS_OPTION|CONTENTS_OPTGROUP>>
 */
class Select extends AbstractElementFromAttributesAndContent
{
	public function ElementName() : string
	{
		return 'select';
	}

	/**
	 * @param T $attributes
	 * @param list<CONTENTS_OPTION|CONTENTS_OPTGROUP> $content
	 *
	 * @return array{!element:'select', !attributes:T, !content:list<CONTENTS_OPTION|CONTENTS_OPTGROUP>}
	 */
	public function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		/** @var list<string>|null */
		$value = $attributes['value'] ?? null;

		if (isset($value)) {
			foreach ($content as $k => $maybe) {
				if ('option' === $maybe['!element']) {
					/**
					 * @var CONTENTS_OPTION
					 */
					$maybe = $maybe;

					$content[$k] = static::MaybeMarkSelected(
					$maybe,
					$value
				);
				} else {
					/**
					 * @var list<CONTENTS_OPTION>
					 */
					$maybe = $content[$k]['!content'];

					$content[$k]['!content'] = array_map(
					/**
					 * @param CONTENTS_OPTION $maybe
					 */
					static function (array $maybe) use ($value) : array {
						return static::MaybeMarkSelected(
							$maybe,
							$value
						);
					},
					$maybe
				);
				}
			}

			unset($attributes['value']);
		}

		/**
		 * @var T
		 */
		$attributes = $attributes;

		/**
		 * @var list<CONTENTS_OPTION|CONTENTS_OPTGROUP>
		 */
		$content = $content;

		$out = parent::FromAttributesAndContent($attributes, $content);

		return $out;
	}

	/**
	 * @param array{!element:'option', !attributes:array{value:string}, !content:list<scalar|array{!element:string}>} $maybe
	 *
	 * @return array{!element:'option', !attributes:array{value:string, selected:bool}, !content:list<scalar|array{!element:string}>}
	 */
	protected static function MaybeMarkSelected(array $maybe, array $values) : array
	{
		$maybe['!attributes']['selected'] = in_array(
			$maybe['!attributes']['value'],
			$values,
			true
		);

		return $maybe;
	}
}
