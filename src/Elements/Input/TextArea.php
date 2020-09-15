<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use function array_key_exists;
use BAPC\Html\Elements\AbstractElementFromAttributes;

/**
 * @template CONTENT as list<scalar>
 *
 * @template-extends AbstractElementFromAttributes<'textarea', array<string, scalar|list<scalar>>, CONTENT>
 */
class TextArea extends AbstractElementFromAttributes
{
	/**
	 * @return array{
	 *	!element:'textarea',
	 *	!attributes:array<string, scalar|list<scalar>>,
	 *	!content:CONTENT
	 * }
	 */
	public function FromAttributes(
		array $attributes
	) : array {
		/**
		 * @var list<scalar>
		 */
		$value = (array) ($attributes['value'] ?? '');

		if (array_key_exists('value', $attributes)) {
			unset($attributes['value']);
		}

		/**
		 * @var array{
		 *	!element:'textarea',
		 *	!attributes:array<string, scalar|list<scalar>>,
		 *	!content:CONTENT
		 * }
		 */
		return [
			'!element' => (new static())->ElementName(),
			'!attributes' => $attributes,
			'!content' => $value,
		];
	}

	public function ElementName() : string
	{
		return 'textarea';
	}
}
