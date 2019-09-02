<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements;

/**
* @psalm-type T1 = array{href:string, class:array<int, string>}
* @psalm-type T2 = array<int, scalar|array{!element:string}>
*/
class AAsButton extends A
{
	/**
	* @param array{href:string} $attributes
	* @param T2 $content
	*
	* @return array{!element:'a', !attributes:T1, !content:T2}
	*/
	public static function FromAttributesAndContent(
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
