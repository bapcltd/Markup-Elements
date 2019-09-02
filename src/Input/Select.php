<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use BAPC\Html\Elements\AbstractElementFromAttributesAndContent;

/**
* @psalm-type T = array{name:string, value:array<int, string>}
* @psalm-type CONTENTS_OPTION = array{!element:'option', !attributes:array{value:string}, !content:array<int, scalar|array{!element:string}>}
* @psalm-type CONTENTS_OPTGROUP = array{!element:'optgroup', !attributes:array{label:string}, !content:array<int, array{!element:'option', !attributes:array{value:string}, !content:array<int, scalar|array{!element:string}>}>}
*
* @template-extends AbstractElementFromAttributesAndContent<'select', T, array<int, CONTENTS_OPTION|CONTENTS_OPTGROUP>>
*/
class Select extends AbstractElementFromAttributesAndContent
{
	public static function ElementName() : string
	{
		return 'select';
	}

	/**
	* @psalm-type CONTENTS = array<int, CONTENTS_OPTION|CONTENTS_OPTGROUP>
	*
	* @param T|array<empty, empty> $attributes
	* @param array<int, CONTENTS_OPTION|CONTENTS_OPTGROUP> $content
	*
	* @return array{!element:'select', !attributes:T, !content:CONTENTS}
	*/
	public static function FromAttributesAndContent(
		array $attributes = [],
		array $content = []
	) : array {
		if (isset($attributes['value'])) {
			foreach ($content as $k => $maybe) {
				if ('option' === $maybe['!element']) {
					/**
					* @var CONTENTS_OPTION
					*/
					$maybe = $maybe;

					$content[$k] = static::MaybeMarkSelected(
					$maybe,
					$attributes['value']
				);
				} else {
					/**
					* @var CONTENTS_OPTGROUP
					*/
					$maybe = $content[$k];

					$content[$k]['!content'] = array_map(
					/**
					* @param CONTENTS_OPTION $maybe
					*/
					function (array $maybe) use ($attributes) : array {
						return static::MaybeMarkSelected(
							$maybe,
							$attributes['value']
						);
					},
					$maybe['!content']
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
		* @var array<int, CONTENTS_OPTION|CONTENTS_OPTGROUP>
		*/
		$content = $content;

		/**
		* @var array{!element:'select', !attributes:T, !content:CONTENTS}
		*/
		$out = parent::FromAttributesAndContent($attributes, $content);

		return $out;
	}

	/**
	* @param array{!element:'option', !attributes:array{value:string}, !content:array<int, scalar|array{!element:string}>} $maybe
	*
	* @return array{!element:'option', !attributes:array{value:string, selected:bool}, !content:array<int, scalar|array{!element:string}>}
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
