<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

use function array_merge;

/**
 * @template T1 as array{href:string, class:list<string>}
 * @template T2 as list<scalar|array{!element:string}>
 *
 * @template-extends A<T1, T2>
 */
class AAsButton extends A
{
	/**
	 * @param array{href:string} $attributes
	 * @param T2 $content
	 *
	 * @return array{!element:'a', !attributes:T1, !content:T2}
	 */
	public function FromAttributesAndContent(
		array $attributes,
		array $content
	) : array {
		/**
		 * @var T1
		 */
		$attributes = array_merge(
			$attributes,
			[
				'class' => [
					'as-button',
				],
			]
		);

		/**
		 * @var array{!element:'a', !attributes:T1, !content:T2}
		 */
		$out = parent::FromAttributesAndContent($attributes, $content);

		return $out;
	}
}
