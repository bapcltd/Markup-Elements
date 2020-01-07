<?php
/**
* @author Marv Blackwell
*/
declare(strict_types=1);

namespace BAPC\Html\Elements\Input;

use BAPC\Html\Elements\AbstractElementFromAttributes;

/**
* @template T1 as string
*
* @template-extends AbstractElementFromAttributes<'input', array{type:T1, value?:scalar|list<scalar>}, array<empty, empty>>
*/
abstract class AbstractInput extends AbstractElementFromAttributes
{
	/**
	* @param array{value?:scalar|list<scalar>} $attributes
	*
	* @return array{!element:'input', !attributes:array{type:T1, value?:scalar|list<scalar>}, !content:array<empty, empty>}
	*/
	public function FromAttributes(
		array $attributes
	) : array {
		$attributes['type'] = static::AbstractInputType();

		/**
		* @var array{value?:scalar|list<scalar>, type:T1}
		*/
		$attributes = $attributes;

		/**
		* @var array{!element:'input', !attributes:array{type:T1, value?:scalar|list<scalar>}, !content:array<empty, empty>}
		*/
		return parent::FromAttributes($attributes);
	}

	public function ElementName() : string
	{
		return 'input';
	}

	/**
	* @return T1
	*/
	abstract public function AbstractInputType() : string;
}
